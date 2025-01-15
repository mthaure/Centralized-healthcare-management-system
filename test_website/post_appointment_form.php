<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Appointment Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch appointment IDs based on patient and doctor selection
        function fetchAppointments() {
            var patient_id = $('#patient_name').val();
            var doctor_id = $('#doctor_name').val();

            if (patient_id && doctor_id) {
                $.ajax({
                    url: 'fetch_appointments.php', // PHP file to handle the request
                    method: 'GET',
                    data: { patient_id: patient_id, doctor_id: doctor_id },
                    success: function(data) {
                        // Reset and add the placeholder option first
                        $('#appointment_id').html('<option value="" disabled selected>Select an Appointment</option>');
                        // Populate the appointment dropdown with the result
                        $('#appointment_id').append(data);
                    }
                });
            } else {
                $('#appointment_id').html('<option value="" disabled selected>Select a Patient and Doctor first</option>');
            }
        }

        // Show the status change section when an appointment is selected
        function showStatusBar() {
            var appointmentId = $('#appointment_id').val();
            if (appointmentId) {
                $('#status_section').show();
            } else {
                $('#status_section').hide();
            }
        }
    </script>
</head>
<body>
    <h2 style="text-align: center;">Post Appointment Form</h2>
    <form action="post_appointment_php.php" method="POST">
        <div>
            <label for="patient_name">Patient Name:</label>
            <select id="patient_name" name="patient_name" required onchange="fetchAppointments()">
                <option value="" disabled selected>Select a Patient</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "capstone_database_demo";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT Patient_ID, Name FROM patient";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Patient_ID'] . "'>" . $row['Name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No Patients Available</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>

        <div>
            <label for="doctor_name">Doctor Name:</label>
            <select id="doctor_name" name="doctor_name" required onchange="fetchAppointments()">
                <option value="" disabled selected>Select a Doctor</option>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT Doctor_ID, Name FROM doctor";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Doctor_ID'] . "'>" . $row['Name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No Doctors Available</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>

        <div>
            <label for="appointment_id">Appointment ID:</label>
            <select id="appointment_id" name="appointment_id" required onchange="showStatusBar()">
                <option value="" disabled selected>Select an Appointment</option>
            </select>
        </div>

        <!-- Status Change Section -->
        <div id="status_section" style="display:none;">
            <label for="status">Change Status:</label>
            <select id="status" name="status">
                <option value="">Select</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div>
            <label for="cpt_code">CPT Code:</label>
            <select id="cpt_code" name="cpt_code" required>
                <option value="" disabled selected>Select a CPT Code</option>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT cpt_code, description FROM cpt_codes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['cpt_code'] . "'>" . $row['cpt_code'] . " - " . $row['description'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No CPT codes available</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>

        <div>
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="" disabled selected>Select</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Cash">Cash</option>
            </select>
        </div>

        <div>
            <label for="payment_date">Invoice Date:</label>
            <input type="date" id="payment_date" name="payment_date">
        </div>

        <div>
            <label for="prescription_date">Prescription Date:</label>
            <input type="date" id="prescription_date" name="prescription_date" required>
        </div>

        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>
