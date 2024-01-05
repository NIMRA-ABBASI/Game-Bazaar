<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_bazaar";

// Initialize $errorMessage
$errorMessage = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    if (isset($_POST['register'])) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

        // Check if any of the required fields are empty
        if (empty($name) || empty($email) || empty($password) || empty($phone)) {
            $errorMessage = "All fields are Required.";
        } else {
            // Check if the email already exists
            $checkQuery = "SELECT * FROM users WHERE email='$email'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // Email already exists, set error message
                $errorMessage = "Registration failed. An ID With Same Email Already Exists.";
            } else {
                // Insert user data into the database
                $insertQuery = "INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";
                if (mysqli_query($conn, $insertQuery)) {
                    // Registration successful, redirect to login page
                    header('location: login.php');
                    exit();
                } else {
                    // Error in insertion
                    $errorMessage = "Registration failed. An ID With Same Email Already Exists.";
                }
            }
        }
    }
} catch (Exception $ex) {
    $errorMessage = "Registration failed. An ID With Same Email Already Exists." . $ex->getMessage();
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login&register.css">
</head>

<body>
    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span>

        <div class="signin" style="width: 500px;">
            <div class="content">
                <h2>Register</h2>
                <form class="form" method="post" action="register.php">
                    <div class="inputBox">
                        <input id="user" autocomplete="off" name="name" type="text" required> <i>Username</i>
                    </div>

                    <div class="inputBox">
                        <input id="email" autocomplete="off" name="email" type="email" required /> <i>Email</i>
                    </div>

                    <div class="inputBox">
                        <input id="pass" autocomplete="off" name="password" type="password" required>
                        <i>Password</i>
                    </div>

                    <div class="inputBox">
                        <input id="phone" autocomplete="off" name="phone" type="tel" required> <i>Phone Number</i>
                    </div>

                    <!-- Display Error if it Exists -->
                    <div id="error">
                        <?php echo $errorMessage; ?>
                    </div>

                    <div class="submit">
                        <button id="l-button" type="submit" name="register">Register</button>
                    </div>

                </form>
                <div class="switch">
                    <h5>Already have an account?</h5>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </section>
    <script src="login.js"></script>
</body>

</html>