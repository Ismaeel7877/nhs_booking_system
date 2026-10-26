<?php
session_start();
if (!isset($_SESSION['email']) || !str_ends_with($_SESSION['email'], '@nhs.co.uk')) {
    header("Location: login.php");
    exit();
}
include 'navbar.php'; 
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard | NHS Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/nhs-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            background-color: #f4fafd;
            font-family: Arial, sans-serif;
        }

        .dashboard-title {
            margin-top: 2rem;
            color: #005eb8;
            font-weight: bold;
        }

        .card {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .dashboard-stat {
            font-size: 2.2rem;
            font-weight: bold;
        }

        /* Buttons all outlined blue with consistent style */
        .btn-nhs, 
        .btn-outline-primary, 
        .btn-outline-secondary {
            color: #005eb8 !important;
            font-weight: 600;
            border: 2px solid #005eb8 !important;
            background-color: transparent !important;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-nhs:hover, 
        .btn-outline-primary:hover, 
        .btn-outline-secondary:hover {
            background-color: #005eb8 !important;
            color: white !important;
            border-color: #005eb8 !important;
        }

        @media (max-width: 768px) {
            .dashboard-stat {
                font-size: 1.8rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .btn {
                width: 100% !important;
                margin-bottom: 1rem !important;
            }
        }

        /* Flex container for buttons */
        .btn-group-responsive {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .btn-group-responsive a {
            flex: 1 1 200px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="dashboard-title mb-4">Welcome, NHS Staff</h2>

    <div class="row">
        <!-- Total Patients -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Patients</h5>
                    <p class="dashboard-stat text-primary">
                        <?php
                        $res = $conn->query("SELECT COUNT(*) AS count FROM users WHERE email NOT LIKE '%@nhs.co.uk'");
                        echo $res->fetch_assoc()['count'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title text-success">Total Appointments</h5>
                    <p class="dashboard-stat text-success">
                        <?php
                        $res = $conn->query("SELECT COUNT(*) AS count FROM appointments");
                        echo $res->fetch_assoc()['count'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Today's Appointments -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title text-warning">Today's Appointments</h5>
                    <p class="dashboard-stat text-warning">
                        <?php
                        $today = date('Y-m-d');
                        $res = $conn->query("SELECT COUNT(*) AS count FROM appointments WHERE appointment_date = '$today'");
                        echo $res->fetch_assoc()['count'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Actions -->
    <div class="btn-group-responsive">
        <a href="staff_appointments.php" class="btn btn-nhs px-4 py-2">Manage Appointments</a>
        <a href="manage_patients.php" class="btn btn-nhs px-4 py-2">Manage Patients</a>
        <a href="staff_book_appointment.php" class="btn btn-nhs px-4 py-2">Book Appointment for Patient</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
