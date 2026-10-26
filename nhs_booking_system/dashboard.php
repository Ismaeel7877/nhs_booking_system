<?php
session_start();
date_default_timezone_set('Europe/London');

include 'includes/db.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
$email = $_SESSION['email'];

// Redirect staff to their dashboard
if ($role === 'staff') {
    header("Location: staff_dashboard.php");
    exit();
}

$tomorrow = date('Y-m-d', strtotime('+1 day'));

// Fetch upcoming appointments (from tomorrow onwards) for the logged-in patient
$stmt = $conn->prepare("SELECT appointment_date, appointment_time FROM appointments WHERE patient_email = ? AND appointment_date >= ? ORDER BY appointment_date ASC, appointment_time ASC LIMIT 5");
$stmt->bind_param("ss", $email, $tomorrow);
$stmt->execute();
$upcoming = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - NHS Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/nhs-logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f4fafd;
        }
        h2, h4 {
            color: #005eb8;
        }
        .btn-nhs {
            background-color: #005eb8;
            color: white;
        }
        .btn-nhs:hover {
            background-color: #004a95;
        }
        .list-group-item a {
            text-decoration: none;
            color: #005eb8;
        }
        .list-group-item a:hover {
            text-decoration: underline;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .appointment-date {
            font-weight: 600;
        }
        .dashboard-box {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <div class="dashboard-box">
        <h2>Welcome to Your Dashboard</h2>
        <p>You are logged in as <strong><?= htmlspecialchars($role) ?></strong> (<?= htmlspecialchars($email) ?>)</p>

        <h4 class="mt-4">Patient Actions</h4>
        <ul class="list-group mb-4">
            <li class="list-group-item"><a href="book.php">📅 Book a New Appointment</a></li>
            <li class="list-group-item"><a href="appointments.php">📖 View All Appointments</a></li>
            <li class="list-group-item"><a href="edit_profile.php">📝 Edit My Profile</a></li>
        </ul>

        <h4>Upcoming Appointments</h4>
        <?php if ($upcoming->num_rows > 0): ?>
            <div class="list-group">
                <?php while ($row = $upcoming->fetch_assoc()): ?>
                    <div class="list-group-item mb-2">
                        <span class="appointment-date"><?= date('l, j F Y', strtotime($row['appointment_date'])) ?></span>
                        at <strong><?= date('H:i', strtotime($row['appointment_time'])) ?></strong>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">You have no upcoming appointments.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
