<?php
// Establishing connection to the database
$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password
$dbname = "capstone_database_demo";  // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $doctor_name = $_POST['doctor_name'];
    $doctor_ssn = $_POST['doctor_ssn'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $work_hours = $_POST['work_hours'];
    $department_id = $_POST['department_id'];
    $is_active = $_POST['is_active'];
    $specialization_id = $_POST['specialization'];  // New variable for specialization

    // Prepare the SQL query to insert into the doctor table
    $stmt = $conn->prepare("INSERT INTO doctor (Doctor_SSN, Name, Phone_Number, Email, Work_Hours, Is_Active, Department_ID) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sssssis", $doctor_ssn, $doctor_name, $phone_number, $email, $work_hours, $is_active, $department_id);

    // Execute the statement for doctor table
    if ($stmt->execute()) {
        // Get the last inserted Doctor_ID
        $doctor_id = $stmt->insert_id;

        // Insert into doctor_specialization table
        $stmt_specialization = $conn->prepare("INSERT INTO doctor_specialization (Doctor_ID, Specialization_ID) VALUES (?, ?)");
        $stmt_specialization->bind_param("ii", $doctor_id, $specialization_id);
        
        // Execute the statement for doctor_specialization table
        if ($stmt_specialization->execute()) {
            // Redirect to the confirmation page after successful registration
            header("Location: confirmation.php");
            exit;  // Make sure to exit after the redirect to avoid further execution
        } else {
            echo "Error in specialization entry: " . $stmt_specialization->error;
        }
        // Close the specialization statement
        $stmt_specialization->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the main statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!-- Link to go back to the form -->
<p style="text-align:center;">
    <a href="doctor_form.html">Register Another Doctor</a> | <a href="homepage.html">Back to Homepage</a>
</p>
