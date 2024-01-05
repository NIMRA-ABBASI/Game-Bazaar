<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_bazaar";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn) {
    try {
        $error = "";
        if (isset($_GET["login"])) {
            $userEmail = $_GET["email"];
            $userPassword = $_GET["password"];
            if (!empty($userEmail) && !empty($userPassword)) {
                $query = "SELECT * FROM users WHERE email='$userEmail' AND password='$userPassword'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    header('location: games.php');
                    $_SESSION['user'] = $row['id'];
                    $_SESSION["items"] = array();
                    exit(); // Ensure that no more code is executed after the header redirection
                } else {
                    $error = "Invalid Email or Password!!";
                    unset($_SESSION["user"]);
                    $_SESSION["items"] = array();
                }
            }
        }
    } catch (Exception $ex) {
        $error = "Invalid email or password." . $ex->getMessage();
        unset($_SESSION["user"]);
        $_SESSION["items"] = array();
    }
    $conn->close(); // Close the database connection
} else {
    unset($_SESSION["user"]);
    $_SESSION["items"] = array();
    die("Connection failed: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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


        <div class="signin">
            <div class="content">
                <h2>Log In</h2>
                <form class="form" method="get">

                    <div class="inputBox">
                        <input id="email" autocomplete="off" name="email" type="email" required /> <i>Email</i>
                    </div>

                    <div class="inputBox">
                        <input id="pass" autocomplete="off" name="password" type="password" required> <i>Password</i>
                    </div>
                    <div id="error">
                        <?php echo $error; ?>
                    </div>
                    <div class="submit">
                        <button id="l-button" type="submit" name="login"> Login</button>
                    </div>

                    <div class="switch">
                        <h5>Don't have account?</h5>
                        <a href="register.php">Register</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</body>

</html>