<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help - NHS Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Help & Support</h2>

    <div class="accordion" id="helpAccordion">
        <!-- Topic 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    How do I book an appointment?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    To book an appointment, please <a href="login.php">log in</a> to your account, then go to "Book Appointment". Select the service, date, and time that suits you.
                </div>
            </div>
        </div>

        <!-- Topic 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    How can I reschedule or cancel an appointment?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    Visit your dashboard and click on "Manage Appointments". You can then choose to reschedule or cancel existing bookings.
                </div>
            </div>
        </div>

        <!-- Topic 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    I forgot my password. What should I do?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    If you've forgotten your password, please contact support at <strong>support@nhsbooking.uk</strong>. We'll assist you with resetting it securely.
                </div>
            </div>
        </div>

        <!-- Topic 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    Who can register for this system?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    Anyone seeking NHS services can register. Staff must register using their official <code>@nhs.co.uk</code> email address to gain staff access.
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5>Still need help?</h5>
        <p>If your issue isn't listed here, please visit our <a href="contact.php">Contact page</a> to get in touch with our support team.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
