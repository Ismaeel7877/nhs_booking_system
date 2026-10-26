<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_email = $_POST['patient_email'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $department = $_POST['department'] ?? '';
    $notes = $_POST['notes'] ?? '';
    $staff_id = $_SESSION['user_id'];

    // Validate required fields
    if (!$patient_email || !$appointment_date || !$department) {
        $message = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (patient_email, appointment_date, department, notes, staff_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $patient_email, $appointment_date, $department, $notes, $staff_id);

        if ($stmt->execute()) {
            $message = "Appointment added successfully.";
        } else {
            $message = "Failed to add appointment.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment - NHS Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="container">
        <h2>Add Appointment</h2>
        <?php if ($message): ?><p class="info"><?= htmlspecialchars($message) ?></p><?php endif; ?>
        <form method="POST" action="">
            <label>Patient Email:</label>
            <input type="email" name="patient_email" required>

            <label>Appointment Date & Time:</label>
            <input type="datetime-local" name="appointment_date" required>

            <label>Department:</label>
            <input type="text" name="department" required>

            <label>Notes:</label>
            <textarea name="notes"></textarea>

            <button type="submit" class="btn">Add Appointment</button>
        </form>
    </div>
</body>
</html>
