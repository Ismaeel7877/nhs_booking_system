<?php
session_start();
if (!isset($_SESSION['email']) || !str_ends_with($_SESSION['email'], '@nhs.co.uk')) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';
include 'includes/db.php';

$result = $conn->query("SELECT id, name, email FROM users WHERE email NOT LIKE '%@nhs.co.uk'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Patients - NHS Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4fafd;
        }

        h2 {
            color: #005eb8;
            font-weight: bold;
        }

        /* Responsive table tweaks */
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
                border: none;
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
<div class="container mt-5 mb-5">
    <h2 class="mb-4">Manage Patients</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td data-label="Patient ID"><?= htmlspecialchars($row['id']) ?></td>
                    <td data-label="Name"><?= htmlspecialchars($row['name']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
