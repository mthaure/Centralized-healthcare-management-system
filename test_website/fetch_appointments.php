<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_database_demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['patient_id']) && isset($_GET['doctor_id'])) {
    $patient_id = $_GET['patient_id'];
    $doctor_id = $_GET['doctor_id'];

    // Query appointments that match both the patient_id and doctor_id
    $sql = "SELECT Appointment_ID, Appointment_Date, Appointment_Time, Reason, status 
            FROM appointments 
            WHERE Patient_ID = ? AND Doctor_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $patient_id, $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any appointments are found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Format the appointment details
            $appointment_details = "Appointment ID: " . $row['Appointment_ID'] . " | " .
                                   "Date: " . $row['Appointment_Date'] . " | " .
                                   "Time: " . $row['Appointment_Time'] . " | " .
                                   "Reason: " . $row['Reason'] . " | " .
                                   "Status: " . $row['status'];

            // Display each appointment in the dropdown
            echo "<option value='" . $row['Appointment_ID'] . "'>" . $appointment_details . "</option>";
        }
    } else {
        // Show a message if no appointments are found
        echo "<option value=''>No Appointments Found</option>";
    }

    $stmt->close();
}

$conn->close();
?>
