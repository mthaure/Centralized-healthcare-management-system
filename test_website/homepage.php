<?php
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <link rel="stylesheet" href="homepage_style.css"> 
</head>
<body>
    <header>
        <h1>Welcome to the Patient Management System</h1>
        <p>Manage patient records with ease and efficiency.</p>
    </header>

    <section class="links">
        <h2>Forms</h2>
        <div class="link-container">
            <a href="patient_form.html" class="link">Patient Registration Form</a>
            <a href="doctor_form.html" class="link">Doctor Registration Form</a>
            <a href="appointment_form.php" class="link">New Appointment Form</a>
            <a href="post_appointment_form.php" class="link">Post Appointment Form</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Michael Thaure. All rights reserved.</p>
    </footer>
</body>
</html>

