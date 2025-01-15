<?php
// Get data from the form
$patient_id = $_POST['patient_name'];
$doctor_id = $_POST['doctor_name'];
$appointment_id = $_POST['appointment_id'];
$status = $_POST['status'];
$cpt_code = $_POST['cpt_code'];
$payment_method = $_POST['payment_method'];
$payment_date = $_POST['payment_date'];
$prescription_date = $_POST['prescription_date'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_database_demo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update appointment status
if ($status) {
    $update_status_sql = "UPDATE appointments SET status = ? WHERE Appointment_ID = ?";
    $stmt = $conn->prepare($update_status_sql);
    $stmt->bind_param("si", $status, $appointment_id);
    $stmt->execute();
}

// Insert into doctor_prescription table
$insert_prescription_sql = "INSERT INTO doctor_prescription (Patient_ID, Prescription_Date, Doctor_ID) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_prescription_sql);
$stmt->bind_param("isi", $patient_id, $prescription_date, $doctor_id);
$stmt->execute();

// Insert into invoice table
$amount_sql = "SELECT amount FROM cpt_codes WHERE cpt_code = ?";
$stmt = $conn->prepare($amount_sql);
$stmt->bind_param("i", $cpt_code);
$stmt->execute();
$stmt->bind_result($amount);
$stmt->fetch();

$insert_invoice_sql = "INSERT INTO invoice (Patient_ID, cpt_code, Amount, Invoice_Date, Prescription_ID, Doctor_ID) 
                        VALUES (?, ?, ?, ?, LAST_INSERT_ID(), ?)";
$stmt = $conn->prepare($insert_invoice_sql);
$stmt->bind_param("iiisi", $patient_id, $cpt_code, $amount, $payment_date, $doctor_id);
$stmt->execute();

// Insert into payments table
$insert_payment_sql = "INSERT INTO payments (Patient_ID, Invoice_Number, Amount, Payment_Date, Payment_Method) 
                        VALUES (?, LAST_INSERT_ID(), ?, ?, ?)";
$stmt = $conn->prepare($insert_payment_sql);
$stmt->bind_param("iiis", $patient_id, $amount, $payment_date, $payment_method);
$stmt->execute();

// Close the connection
$conn->close();

echo "Appointment and payment recorded successfully.";
?>
