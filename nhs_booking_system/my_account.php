<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';
include("includes/db.php");

$email = $_SESSION['email'];
$query = $conn->prepare("SELECT name, email FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account | NHS Booking System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="assets/images/nhs-logo.png">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
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
        .nhs-label {
            font-weight: 600;
            color: #333;
        }
        .nhs-value {
            color: #444;
        }
    </style>
</head>
<body>
<div class="container mt-5" style="max-width: 700px;">
    <h2 class="nhs-header mb-4">My Account</h2>

    <div class="nhs-card">
        <h5 class="mb-4">Account Information</h5>
        <div class="mb-3">
            <span class="nhs-label">Full Name:</span><br>
            <span class="nhs-value"><?= htmlspecialchars($user['name']); ?></span>
        </div>
        <div class="mb-3">
            <span class="nhs-label">Email Address:</span><br>
            <span class="nhs-value"><?= htmlspecialchars($user['email']); ?></span>
        </div>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
