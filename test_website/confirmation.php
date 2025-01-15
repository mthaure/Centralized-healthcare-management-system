<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        h2 { color: green; }
        button { margin-top: 20px; padding: 0.7em 1.5em; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background-color: #0056b3; }
        .back-button { background-color: #6c757d; } /* Style for back button */
        a { text-decoration: none; }
        .register-button {
            display: inline-block; /* Make the link look like a button */
            margin-top: 20px; /* Add some space above */
            padding: 0.7em 1.5em; /* Match padding to button */
            background-color: #007bff; /* Button background color */
            color: white; /* Button text color */
            border-radius: 5px; /* Rounded corners */
        }
        .register-button:hover { background-color: #0056b3; } /* Hover effect */
    </style>
</head>
<body>

<h2>Registration Successful!</h2>
<p>Thank you for registering. Your details have been saved.</p>


<!-- Back to Homepage Button, positioned below the register button -->
<div style="margin-top: 20px;">
    <button class="back-button" onclick="window.location.href='homepage.php'">Back to Homepage</button>
</div>

</body>
</html>
