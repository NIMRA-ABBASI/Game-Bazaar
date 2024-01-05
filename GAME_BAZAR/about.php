<?php
session_start();

// Initialize $_SESSION['items'] if not set
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = array();
}

if (empty($_SESSION["user"])) {
    header('location: login.php');
    unset($_SESSION['user']);
    $_SESSION["items"] = array();
}

// Check if $_SESSION['items'] is set
$cartItemCount = isset($_SESSION['items']) ? count($_SESSION['items']) : 0;
?>

<!-- Use $cartItemCount wherever you want to display the cart count 
<i class="fas fa-shopping-cart fa-flip-horizontal fa-lg" style="color: #ffffff; cursor: pointer;">
    <?php
    if ($cartItemCount > 0) {
        echo '<span class="cart-num">' . $cartItemCount . '</span>';
    }
    ?>
</i>-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <!---bootstrap-->
  <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!---footer icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!---stylesheets-->
  <link href="about.css" rel="stylesheet">
  <link href="header.css" rel="stylesheet">
  <link href="footer.css" rel="stylesheet">

</head>

<body>
  <!--header-->
  <section class="home">
        <header>
            <div class="logo">
            <a href="games.php"> <img src="images/Remove.png" style="width:200px"></a>
            </div>
            <div class="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="games.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li class="resume-link"><a href="logout.php" class="btn-resume">Log Out</a></li>
                     <li><a href="CARTCART.php">
                            <i class="fas fa-shopping-cart fa-flip-horizontal fa-lg"
                                style="color: #ffffff;cursor:pointer;">
                                <?php if ($_SESSION['items']) {
                                    echo '<span class="cart-num">';
                                    echo count($_SESSION["items"]);
                                    echo '</span>';
                                } ?>
                            </i></a>
                    </li>
                    
                </ul>
            </nav>
        </header>
    </section>

  <!-- About -->
  <section id="about" class="About">
    <div class="About-content">
      <div class="contentBox">

        <h4><strong>About Us </strong></h4>

        <p> </p>
        <p><i><b style="font-size:large;color: #008080;">Welcome to our online game purchase website!</b></i></p>
        <p>At Game Bazzar, we are passionate about gaming and dedicated to providing you with the ultimate gaming
          experience. Whether you're a casual player, an avid gamer, or a collector, we have something for
          everyone.</p>

        <p>Our mission is to make it convenient and easy for you to discover and purchase the latest and greatest
          games from the comfort of your own home. We carefully curate our selection to ensure that you have
          access to a wide range of titles across various genres, platforms, and formats.</p>

        <p>From action-packed
          adventures to immersive role-playing games, from indie gems
          ytto AAA blockbusters, we strive to cater to
          diverse gaming preferences.
        </p>

        <p> </p>

        <p> </p>
        <button type="button" class="btn btn-outline read">Read more</button>
      </div>
    </div>
    <div class="About-image">
        <div class="box-content">
          <img src="images/men1bg.png">
      </div>
    </div>
  </section>

  <!--Footer-->
  <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                <a href="games.php">  <img src="images/Remove.png" style="width:200px"></a>
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

</html>