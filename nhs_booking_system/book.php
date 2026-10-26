<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$email = $_SESSION['email'];

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_email = $role === 'staff' ? trim($_POST['patient_email']) : $email;
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $details = trim($_POST['details']);

    $stmt = $conn->prepare("INSERT INTO appointments (patient_email, appointment_date, appointment_time, details) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $patient_email, $appointment_date, $appointment_time, $details);

    if ($stmt->execute()) {
        $success = "Appointment booked successfully.";
    } else {
        $error = "Failed to book appointment: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - NHS Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/nhs-logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4fafd;
        }
        h3 {
            color: #005eb8;
        }
        .btn-nhs {
            background-color: #005eb8;
            color: white;
            font-weight: 500;
        }
        .btn-nhs:hover {
            background-color: #004a95;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <div class="form-container mx-auto" style="max-width: 600px;">
        <h3 class="mb-4 text-center">Book Appointment</h3>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <?php if ($role === 'staff'): ?>
                <div class="mb-3">
                    <label for="patient_email" class="form-label">Patient Email</label>
                    <input type="email" name="patient_email" id="patient_email" class="form-control" required>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Details / Reason</label>
                <textarea name="details" id="details" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-nhs w-100">Book Appointment</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
