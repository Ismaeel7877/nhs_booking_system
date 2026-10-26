<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email']) || !str_ends_with($_SESSION['email'], '@nhs.co.uk')) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];

    $stmt = $conn->prepare("INSERT INTO available_slots (slot_date, slot_time) VALUES (?, ?)");
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $stmt->close();
}

$slots = $conn->query("SELECT * FROM available_slots ORDER BY slot_date, slot_time");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Slots - NHS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <h3 class="mb-4">Manage Appointment Slots</h3>

    <form method="post" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="time" class="form-label">Time</label>
            <input type="time" name="time" id="time" class="form-control" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-success">Add Slot</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th><th>Time</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $slots->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['slot_date'] ?></td>
                    <td><?= $row['slot_time'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
