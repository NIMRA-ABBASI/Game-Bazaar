<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_bazaar";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the user is not logged in, redirect to login page
if (empty($_SESSION["user"])) {
    header('location: login.php');
    exit(); // Stop the script execution
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <!---bootstrap-->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!---footer icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!---stylesheets-->
    <link href="thank_u.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="text-center">GAME BAZAAR</h1>
        </div>
    </div>

    <div class="container" id="quoteBox">
        <h2>THANK YOU !</h2>
        <i class="fa fa-check" aria-hidden="true" style="font-size:2rem margin-top:20px;"></i>
    </div>


    <div class="container">
        <div class="row">
            <div class="text-center">

            <button type="button" class="btn btn-outline read"><a href="games.php">Go to Home</a></button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <a href="games.php"> <img src="images/Remove.png" style="width:200px"></a>
                </div>
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="about.php">About us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Services </h4>
                    <ul>
                        <li><a href="games.php">Games</a></li>
                        <li><a href="#">Publishing</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>