<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_date = $_POST['appointment_date'];
    $new_time = $_POST['appointment_time'];
    $details = $_POST['details'];

    $stmt = $conn->prepare("UPDATE appointments SET appointment_date = ?, appointment_time = ?, details = ? WHERE id = ?");
    $stmt->bind_param("sssi", $new_date, $new_time, $details, $id);
    $stmt->execute();

    header("Location: staff_appointments.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment - NHS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h3>Edit Appointment</h3>
    <form method="post">
        <div class="mb-3">
            <label>Date:</label>
            <input type="date" name="appointment_date" class="form-control" value="<?= $appointment['appointment_date'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Time:</label>
            <input type="time" name="appointment_time" class="form-control" value="<?= $appointment['appointment_time'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Details:</label>
            <textarea name="details" class="form-control"><?= htmlspecialchars($appointment['details']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Appointment</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
