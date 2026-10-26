<?php
session_start();
include 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = str_ends_with($email, '@nhs.co.uk') ? 'staff' : 'patient';

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No account found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - NHS Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f4f5;
        }
        .login-box {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .btn-nhs {
            background-color: #005eb8;
            color: white;
        }
        .btn-nhs:hover {
            background-color: #004a95;
        }
        .footer-link {
            text-align: center;
            margin-top: 1rem;
        }
        @media (max-width: 576px) {
            .login-box {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-10 login-box">
            <h3 class="text-center mb-4">Log in to your account</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="you@domain.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                </div>

                <button type="submit" class="btn btn-nhs w-100">Login</button>
            </form>

            <div class="footer-link mt-3">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
                <p><a href="help.php">Need help logging in?</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Bootstrap JS (for navbar toggler) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Client-side validation script -->
<script>
    // Bootstrap validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('form');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
