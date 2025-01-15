<?php
// Database connection
$servername = "127.0.0.1";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "capstone_database_demo"; // Use the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$reason = $_POST['reason'];
$status = $_POST['status'];

// SQL query to insert the appointment
$insert_appointment_sql = "INSERT INTO appointments (Patient_ID, Doctor_ID, Appointment_Date, Appointment_Time, Reason, status) 
                           VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_appointment_sql);
$stmt->bind_param("iissss", $patient_id, $doctor_id, $appointment_date, $appointment_time, $reason, $status);

// Execute the query
if ($stmt->execute()) {
    // Redirect to the confirmation page after success
    header("Location: confirmation.php");
    exit(); // Make sure the script stops executing after the redirect
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$conn->close();
?>
