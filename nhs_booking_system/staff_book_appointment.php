<?php
session_start();

if (!isset($_SESSION['email']) || !str_ends_with($_SESSION['email'], '@nhs.co.uk')) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';
include("includes/db.php");

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = trim($_POST['reason']);
    $staff_email = $_SESSION['email'];

    if ($name && $email && $phone && $dob && $appointment_date && $appointment_time && $reason) {

        // 1️⃣ Check if patient exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($patient_id);
            $stmt->fetch();
        } else {

            // Insert new patient
            $insertPatient = $conn->prepare(
                "INSERT INTO users (name, email, phone, dob, password, role) 
                 VALUES (?, ?, ?, ?, '', 'patient')"
            );

            $insertPatient->bind_param("ssss", $name, $email, $phone, $dob);

            if ($insertPatient->execute()) {
                $patient_id = $insertPatient->insert_id;
            } else {
                $error = "Failed to add new patient.";
            }

            $insertPatient->close();
        }

        $stmt->close();

        // 2️⃣ Get staff ID
        if (!$error) {

            $getStaff = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $getStaff->bind_param("s", $staff_email);
            $getStaff->execute();
            $getStaff->bind_result($staff_id);
            $getStaff->fetch();
            $getStaff->close();
        }

        // 3️⃣ Insert appointment
        if (!$error) {

            $insertApp = $conn->prepare(
                "INSERT INTO appointments 
                (patient_email, appointment_date, appointment_time, details, status, staff_ID, Patient_ID) 
                VALUES (?, ?, ?, ?, 'Scheduled', ?, ?)"
            );

            $insertApp->bind_param(
                "ssssii",
                $email,
                $appointment_date,
                $appointment_time,
                $reason,
                $staff_id,
                $patient_id
            );

            if ($insertApp->execute()) {
                $success = "Appointment booked successfully.";
            } else {
                $error = "Failed to book appointment.";
            }

            $insertApp->close();
        }

    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Book Appointment for Patient | NHS Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/images/nhs-logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <style>
        body {
            background-color: #f4fafd;
        }

        .form-container {
            background: #fff;
            padding: 2rem;
            margin-top: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-nhs {
            background-color: #005eb8;
            color: #fff;
        }

        .btn-nhs:hover {
            background-color: #004a95;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 1.2rem;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="text-center text-primary mb-4">Book Appointment for Patient</h3>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <!-- Patient Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" />
            </div>

            <!-- Patient Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Patient Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
            </div>

            <!-- Patient Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" />
            </div>

            <!-- Patient DOB -->
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required value="<?= htmlspecialchars($_POST['dob'] ?? '') ?>" />
            </div>

            <!-- Appointment Date -->
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required value="<?= htmlspecialchars($_POST['appointment_date'] ?? '') ?>" />
            </div>

            <!-- Appointment Time -->
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" required value="<?= htmlspecialchars($_POST['appointment_time'] ?? '') ?>" />
            </div>

            <!-- Reason -->
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for Appointment</label>
                <textarea class="form-control" id="reason" name="reason" rows="3" required><?= htmlspecialchars($_POST['reason'] ?? '') ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-nhs px-4">Book Appointment</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
