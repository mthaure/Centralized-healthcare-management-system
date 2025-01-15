<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_database_demo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $patient_name = $_POST['patient_name'];
    $patient_ssn = $_POST['patient_ssn'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $emergency_contact = $_POST['emergency_contact'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $allergies = $_POST['allergies'];
    $preferred_language = $_POST['preferred_language'];
    $notes = $_POST['notes'];

    // Get insurance information
    $company_id = $_POST['company_id'];
    $insurance_serial_number = $_POST['insurance_serial_number'];
    $insurance_expiry_date = $_POST['insurance_expiry_date'];

    // Insert the patient data into the patients table using a prepared statement
$stmt = $conn->prepare("INSERT INTO patient (Name, Patient_SSN, Gender, Date_of_Birth, Address, Emergency_Contact, Phone_Number, Email, Allergies, Preferred_Language, Notes, Is_Active, Date_Registered)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())");

// Bind the parameters (excluding Is_Active and Date_Registered, which are hardcoded)
$stmt->bind_param("sssssssssss", $patient_name, $patient_ssn, $gender, $date_of_birth, $address, $emergency_contact, $phone_number, $email, $allergies, $preferred_language, $notes);


    if ($stmt->execute()) {
        $patient_id = $stmt->insert_id; // Get the last inserted patient ID

        // Insert insurance information into patient_insurance table using a prepared statement
        $stmt2 = $conn->prepare("INSERT INTO patient_insurance (patient_id, company_id, insurance_serial_number, insurance_expiry_date)
        VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("iiss", $patient_id, $company_id, $insurance_serial_number, $insurance_expiry_date);

        if ($stmt2->execute()) {
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Error inserting insurance record: " . $conn->error . "<br>";
        }
    } else {
        echo "Error inserting patient record: " . $conn->error . "<br>";
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();
?>
