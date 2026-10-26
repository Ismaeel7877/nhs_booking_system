<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM appointments ORDER BY appointment_date DESC, appointment_time DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Appointments - NHS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <h3 class="mb-4 text-primary">Manage Patient Appointments</h3>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Patient Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['patient_email']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['details'])) ?></td>
                        <td><?= htmlspecialchars($row['status'] ?? 'Scheduled') ?></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-center">
                                <a href="edit_appointment.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <a href="mark_completed.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success mb-1">Complete</a>
                                <a href="cancel_appointment.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger mb-1"
                                   onclick="return confirm('Are you sure you want to cancel this appointment?');">Cancel</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No appointments found.</div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
