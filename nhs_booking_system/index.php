<?php
session_start();
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Welcome to NHS Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .nhs-blue {
            color: #005eb8;
        }
        body {
            background-color: #f8f9fa;
        }
        .jumbotron {
            background-color: #e9f5ff;
        }
        ul, ol {
            padding-left: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="jumbotron p-5 rounded-3 shadow-sm">
        <h1 class="display-5 nhs-blue fw-bold">Welcome to the NHS Booking System</h1>
        <p class="lead mt-3">
            The National Health Service (NHS) is committed to providing safe, effective, and compassionate care to patients across the United Kingdom. Our digital appointment system allows patients to book and manage their appointments easily, while supporting staff in efficient healthcare delivery.
        </p>
        <hr class="my-4" />
        <p>
            This platform improves communication, reduces waiting times, and enhances overall access to NHS services. It supports both patients and staff in maintaining an organised and responsive care process.
        </p>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h3 class="nhs-blue fw-bold">About the NHS</h3>
            <p>
                Founded in 1948, the NHS is one of the world’s largest publicly funded health services. It provides healthcare that is:
            </p>
            <ul>
                <li>Free at the point of delivery for all UK residents</li>
                <li>Available to everyone based on clinical need, not ability to pay</li>
                <li>Funded through taxation to ensure equal access for all</li>
            </ul>
            <p>
                Services include general practice, hospital care, mental health, dental care, and more. Over 1.3 million professionals work within the NHS to deliver high-quality, safe care every day.
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="nhs-blue fw-bold">About This Booking System</h3>
            <p>
                The NHS Booking System is a secure, user-friendly online portal. It empowers patients and assists NHS staff with managing appointments effectively.
            </p>
            <ul>
                <li>Register and manage your patient profile</li>
                <li>Book and review appointments</li>
                <li>Cancel or reschedule if needed</li>
                <li>Track past and upcoming appointments</li>
                <li>Staff can create, edit, and mark appointments as completed</li>
            </ul>
            <p>
                <strong>Note:</strong> You cannot directly browse available hospitals or staff. Patients book from available appointment slots configured by NHS staff.
            </p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="nhs-blue fw-bold">Why Use the NHS Booking System?</h3>
            <p>
                Our appointment system is designed to make NHS care more accessible and manageable:
            </p>
            <ul>
                <li>Improves booking accuracy and reduces missed appointments</li>
                <li>Supports timely patient care and reduces administrative burden</li>
                <li>Provides transparency and patient autonomy over healthcare planning</li>
                <li>Helps NHS staff better manage daily workflow and patient interactions</li>
            </ul>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-12">
            <h3 class="nhs-blue fw-bold">How to Book an Appointment</h3>
            <p>Booking an appointment through this platform is quick and simple:</p>
            <ol>
                <li><strong>Register</strong> by creating an account with your email and personal details.</li>
                <li><strong>Log in</strong> securely using your registered credentials.</li>
                <li>Navigate to the <strong>Book Appointment</strong> page from your dashboard.</li>
                <li>Select a suitable <strong>date and time slot</strong> from those available.</li>
                <li>Click confirm. Your appointment will be saved and visible in your dashboard.</li>
                <li>You can also cancel or reschedule if necessary.</li>
            </ol>
            <p class="text-muted">
                Appointment availability depends on schedules set by NHS staff. If no times are available, please check back later.
            </p>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-12">
            <h3 class="nhs-blue fw-bold">Information and Advice</h3>
            <p>
                The NHS provides trusted guidance and medical advice to help you manage your health effectively. Before booking an appointment, you may consider the following:
            </p>
            <ul>
                <li><strong>Use NHS 111</strong>: For urgent but non-life-threatening issues, you can contact NHS 111 online or by phone to get quick medical help and advice.</li>
                <li><strong>Pharmacy Support</strong>: Many minor illnesses such as colds, sore throats, or skin rashes can be treated by speaking to your local pharmacist.</li>
                <li><strong>Mental Health Support</strong>: If you're feeling anxious, depressed, or overwhelmed, the NHS offers mental health services and helplines to support you.</li>
                <li><strong>Long-Term Conditions</strong>: For ongoing management of conditions like asthma, diabetes, or heart disease, regular appointments help ensure continuity of care.</li>
                <li><strong>Vaccinations & Screenings</strong>: The NHS promotes regular health screenings and vaccinations to prevent illness and catch issues early.</li>
            </ul>
            <p>
                Visit the official <a href="https://www.nhs.uk/" target="_blank" class="text-decoration-none">NHS website</a> for comprehensive health advice, symptom checkers, and self-help resources.
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
