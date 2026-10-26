<?php
session_start();
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact & Help - NHS Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nhs-blue {
            color: #005eb8;
        }
        .bg-nhs {
            background-color: #f0f4f5;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="nhs-blue fw-bold">Help & Contact</h2>
    <p class="lead">If you need support with booking, cancelling, or managing your appointment, we're here to help.</p>

    <div class="row g-4">
        <!-- Contact Details -->
        <div class="col-md-6">
            <h4 class="nhs-blue">Contact Information</h4>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> <a href="mailto:support@nhs-booking.org.uk">support@nhs-booking.org.uk</a></li>
                <li><strong>Phone:</strong> <a href="tel:08001234567">0800 123 4567</a> (Monday to Friday, 8am to 6pm)</li>
                <li><strong>Postal Address:</strong><br>NHS Digital Booking Support<br>1 Health Street<br>London<br>WC1N 1EH</li>
            </ul>

            <h5 class="mt-4 nhs-blue">Accessibility Support</h5>
            <p>
                If you use assistive technology (e.g. screen readers or voice recognition software) and need help using this website, contact us via:
            </p>
            <ul>
                <li><strong>Accessibility Email:</strong> <a href="mailto:accessibility@nhs-booking.org.uk">accessibility@nhs-booking.org.uk</a></li>
                <li><strong>Text Relay:</strong> Dial 18001 followed by <strong>0800 123 4567</strong></li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="col-md-6">
            <h4 class="nhs-blue">Send Us a Message</h4>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" placeholder="e.g. Appointment issue, Registration help" required>
                </div>
                <div class="mb-3">
                    <label for="msg" class="form-label">Message</label>
                    <textarea class="form-control" id="msg" rows="5" placeholder="Describe your issue or enquiry in detail..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>

    <!-- FAQs -->
    <div class="mt-5">
        <h3 class="nhs-blue fw-bold">Frequently Asked Questions (FAQs)</h3>

        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse1">
                        How do I book an appointment?
                    </button>
                </h2>
                <div id="faq-collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To book an appointment, log in to your patient account and go to the "Book Appointment" page. Select an available date and time slot and confirm your booking.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse2">
                        Can I reschedule or cancel my appointment?
                    </button>
                </h2>
                <div id="faq-collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, you can log in to your dashboard and view upcoming appointments. Select the one you want to change and follow the on-screen options to reschedule or cancel.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse3">
                        I can't log in — what should I do?
                    </button>
                </h2>
                <div id="faq-collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ensure you’re entering the correct email and password. If you’ve forgotten your password, use the "Forgot Password" link on the login page. For further help, contact support.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer and Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
