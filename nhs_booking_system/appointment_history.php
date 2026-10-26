<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'];

if ($role === 'staff') {
    $stmt = $conn->prepare("SELECT * FROM appointments ORDER BY appointment_date DESC, appointment_time DESC");
} else {
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_email = ? ORDER BY appointment_date DESC, appointment_time DESC");
    $stmt->bind_param("s", $email);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment History - NHS Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Responsive Navbar -->
<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <h3 class="mb-4 text-primary">Appointment History</h3>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <?php if ($role === 'staff'): ?>
                            <th scope="col">Patient Email</th>
                        <?php endif; ?>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <?php if ($role === 'staff'): ?>
                                <td><?= htmlspecialchars($row['patient_email']) ?></td>
                            <?php endif; ?>
                            <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                            <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['details'])) ?></td>
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

<!-- Bootstrap JS (required for navbar toggle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
