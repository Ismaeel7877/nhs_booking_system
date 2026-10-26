<?php
session_start();
include 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $postcode = trim($_POST['postcode']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = str_ends_with($email, '@nhs.co.uk') ? 'staff' : 'patient';

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, dob, address, postcode) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $hashed_password, $role, $dob, $address, $postcode);

            if ($stmt->execute()) {
                $success = "Registration successful. You can now log in.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - NHS Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .nhs-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            border-top: 10px solid #005eb8;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .btn-nhs {
            background-color: #005eb8;
            color: white;
            font-weight: bold;
        }
        .btn-nhs:hover {
            background-color: #003d73;
        }
        .nhs-header {
            color: #005eb8;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5" style="max-width: 650px;">
    <div class="nhs-container">
        <h3 class="text-center nhs-header mb-4">Create Your NHS Account</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
                <div class="invalid-feedback">Please enter your full name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
                <div class="invalid-feedback">Please select your date of birth.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2" required></textarea>
                <div class="invalid-feedback">Please enter your address.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Postcode</label>
                <input type="text" name="postcode" class="form-control" pattern="[A-Za-z0-9 ]{5,10}" required>
                <div class="invalid-feedback">Please enter a valid postcode (5-10 characters).</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" minlength="6" required>
                <div class="invalid-feedback">Password must be at least 6 characters long.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" minlength="6" required>
                <div class="invalid-feedback">Please confirm your password.</div>
            </div>

            <button type="submit" class="btn btn-nhs w-100">Register</button>
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
<script>
    // Enable Bootstrap validation styles on submit
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', e => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
