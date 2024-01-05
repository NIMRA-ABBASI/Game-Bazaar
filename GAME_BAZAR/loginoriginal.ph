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
