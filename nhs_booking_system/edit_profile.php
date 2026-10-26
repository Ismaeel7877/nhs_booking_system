<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$current_email = $_SESSION['email'];
$error = '';
$success = '';

// Get current user details
$stmt = $conn->prepare("SELECT name, email FROM users WHERE email = ?");
$stmt->bind_param("s", $current_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$current_name = $user['name'];
$current_email_db = $user['email'];
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate name
    if ($name === '') {
        $error = "Name cannot be empty.";
    }
    // Validate passwords
    elseif (!empty($new_password) && $new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    }
    // Validate email uniqueness if changed
    elseif ($new_email !== $current_email_db) {
        $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check_email->bind_param("s", $new_email);
        $check_email->execute();
        $check_result = $check_email->get_result();

        if ($check_result->num_rows > 0) {
            $error = "This email is already registered.";
        }
        $check_email->close();
    }

    // Proceed if no errors
    if (!$error) {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE email = ?");
            $stmt->bind_param("ssss", $name, $new_email, $hashed_password, $current_email_db);
        } else {
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE email = ?");
            $stmt->bind_param("sss", $name, $new_email, $current_email_db);
        }

        if ($stmt->execute()) {
            $_SESSION['email'] = $new_email; // Update session with new email
            $success = "Profile updated successfully.";
            $current_name = $name;
            $current_email_db = $new_email;
        } else {
            $error = "Failed to update profile. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile | NHS Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/images/nhs-logo.png">
    <style>
        body { background-color: #f4f4f4; }
        .nhs-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            border-top: 8px solid #005eb8;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .nhs-header {
            color: #005eb8;
            font-weight: 700;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5" style="max-width: 700px;">
    <h2 class="nhs-header mb-4">Edit Profile</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <div class="nhs-card">
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($current_name); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($current_email_db); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New Password (optional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>

            <button class="btn btn-primary w-100">Save Changes</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
