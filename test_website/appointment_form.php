<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Appointment Registration</h1>
        <form action="appointment_php.php" method="POST">
            <!-- Patient ID -->
            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select name="patient_id" id="patient_id" required>
                    <option value="" disabled selected>Select a patient</option>
                    <!-- Populate with patient options -->
                    <?php
                    // Fetch patients from the database
                    $conn = new mysqli('localhost', 'root', '', 'capstone_database_demo');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT Patient_ID, Name FROM patient WHERE Is_Active = 1";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Patient_ID'] . "'>" . $row['Name'] . "</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Doctor ID -->
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id" required>
                    <option value="" disabled selected>Select a doctor</option>
                    <!-- Populate with doctor options -->
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'capstone_database_demo');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT Doctor_ID, Name FROM doctor WHERE Is_Active = 1";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Doctor_ID'] . "'>" . $row['Name'] . "</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Appointment Date -->
            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
            </div>

            <!-- Appointment Time -->
            <div class="form-group">
                <label for="appointment_time">Appointment Time</label>
                <input type="time" id="appointment_time" name="appointment_time" required>
            </div>

            <!-- Reason -->
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" rows="4" placeholder="Enter reason for the appointment (optional)"></textarea>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Submit Appointment</button>
            </div>
        </form>
    </div>
</body>
</html>
