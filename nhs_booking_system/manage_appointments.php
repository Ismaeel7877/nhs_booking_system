<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_appointments.php");
    exit();
}

// Fetch all appointments
$result = $conn->query("SELECT appointments.*, users.email AS staff_email FROM appointments JOIN users ON appointments.staff_id = users.id ORDER BY appointment_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Appointments - NHS Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="container">
        <h2>Manage Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient Email</th>
                    <th>Appointment Date</th>
                    <th>Department</th>
                    <th>Notes</th>
                    <th>Staff</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['patient_email']) ?></td>
                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                    <td><?= htmlspecialchars($row['department']) ?></td>
                    <td><?= htmlspecialchars($row['notes']) ?></td>
                    <td><?= htmlspecialchars($row['staff_email']) ?></td>
                    <td>
                        <a href="edit_appointment.php?id=<?= $row['id'] ?>">Edit</a> |
                        <a href="manage_appointments.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
