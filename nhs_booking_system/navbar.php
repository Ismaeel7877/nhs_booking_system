<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$role = '';
$email = '';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $role = (str_ends_with($email, '@nhs.co.uk')) ? 'staff' : 'patient';
}
?>

<!-- NHS-Themed Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #005eb8;">
    <div class="container-fluid px-4">
        <!-- Logo and Branding -->
        <a class="navbar-brand d-flex align-items-center text-white fw-bold" href="index.php">
            <img src="https://assets.nhs.uk/images/nhs-logo.png" alt="NHS Logo" height="40" class="me-2">
            NHS Booking System
        </a>

        <!-- Toggle for mobile view -->
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <!-- Public Links -->
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="help.php">Help</a></li>

                <!-- If not logged in -->
                <?php if (!isset($_SESSION['email'])): ?>
                    <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>

                <!-- If logged in -->
                <?php else: ?>
                    <?php if ($role === 'staff'): ?>
                        <li class="nav-item"><a class="nav-link text-white" href="staff_dashboard.php">Staff Dashboard</a></li>
                                        <li class="nav-item"><a class="nav-link text-white" href="staff_appointments.php">My Appointments</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="manage_patients.php">Manage Patients</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="my_account.php">My Account</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="book.php">Book Appointment</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="appointment_history.php">My Appointments</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="my_account.php">My Account</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
