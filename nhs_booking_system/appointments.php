<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'] ?? 'patient'; // Default to patient if no role set

// Redirect staff away from this page (they have their own page)
if ($role === 'staff') {
    header("Location: staff_dashboard.php");
    exit();
}

// For patients, show only their appointments
$stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_email = ? ORDER BY appointment_date DESC, appointment_time DESC");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Appointments - NHS Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4fafd;
            font-family: Arial, sans-serif;
        }
        h3 {
            color: #005eb8;
            font-weight: bold;
        }
        /* Responsive table improvements */
        .table-responsive {
            overflow-x: auto;
        }
        /* Smaller devices tweaks */
        @media (max-width: 576px) {
            table thead {
                display: none;
            }
            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }
            table tr {
                margin-bottom: 1rem;
                border-bottom: 2px solid #dee2e6;
            }
            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                width: 45%;
                padding-left: 0.5rem;
                font-weight: 600;
                text-align: left;
                color: #005eb8;
            }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
    <h3 class="mb-4">Your Appointments</h3>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Date"><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td data-label="Time"><?= htmlspecialchars($row['appointment_time']) ?></td>
                        <td data-label="Details"><?= nl2br(htmlspecialchars($row['details'])) ?></td>
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
