<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit();
}

$name = $_SESSION['name'] ?? 'Admin';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - NHS Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1>Welcome, <?= htmlspecialchars($name) ?> (Admin)</h1>
    <p>This is your admin dashboard where you can manage users and system logs.</p>

    <div class="list-group mt-4" style="max-width: 400px;">
        <a href="manage_users.php" class="list-group-item list-group-item-action">
            Manage Users
        </a>
        <a href="view_logs.php" class="list-group-item list-group-item-action">
            View System Logs
        </a>
        <a href="logout.php" class="list-group-item list-group-item-action text-danger">
            Logout
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
