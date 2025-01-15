<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Read the user-pass JSON file
    $jsonData = file_get_contents('user-pass.json');
    $users = json_decode($jsonData, true)['users'];

    // Check if the username and password match
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            // If match found, set session and redirect to homepage
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: homepage.php');
            exit();
        }
    }

    // If credentials are incorrect, show an error
    $error = 'Invalid username or password';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="homepage_style.css">
</head>
<body>
    <header>
        <h1>Login to Patient Management System</h1>
    </header>

    <section>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        <?php
        // Display error message if login fails
        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2024 Michael Thaure. All rights reserved.</p>
    </footer>
</body>
</html>
