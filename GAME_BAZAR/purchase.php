<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_bazaar";

session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (empty($_SESSION["user"])) {
    header('location: login.php');
    unset($_SESSION['user']);
    $_SESSION["items"] = array();
}
if (!isset($_SESSION["items"])) {
    $_SESSION["items"] = array(); // Initialize as an empty array if not set
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Bazzar</title>
    <link rel="icon" href="/images/Remove.png" type="image/x-icon">

    <!--carasoule links-->
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'>
    </script>
    <script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <!---footer icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!---stylesheets-->
    <link href="./games.css" rel="stylesheet">
    <link href="./header.css" rel="stylesheet">
    <link href="./footer.css" rel="stylesheet">

</head>

<body>
    <!--header-->
    <section class="home">
        <header>
            <div class="logo">
                <a href="games.php"><img src="images/Remove.png" href="games.php" style="width:200px"></a>
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
    <!-- Games -->
    <section class="pt-5 pb-5 game-content">
        <?php
        $sql = "SELECT DISTINCT(order_id), user_name, total_price from order_detail where user_id = '{$_SESSION['user']}';";
        $result = $conn->query($sql);
        foreach ($result as $res => $order) {
            echo '<div class="container">
            <div class="row">
                <div class="col-6">
                    <h2 class="mb-3 game-category">Order ID: #' . $order['order_id'] . '</h3>
                    <h4 class="mb-3 game-category">Buyer: ' . $order['user_name'] . '</h3>
                    <h6 class="mb-3 game-category">Total Price: $' . $order['total_price'] . '</h3>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><div class="row">';
            $sql2 = "SELECT * FROM order_detail where order_id = '{$order['order_id']}';";
            $orderItems = $conn->query($sql2);
            if ($orderItems->num_rows > 0) {
                foreach ($orderItems as $orderItem => $item) {
                    if ($result->num_rows > 0) {
                        echo '
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img class="pro-image" alt="100%x280" src="' . $item['game_image'] . '">
                                <div class="card-body">
                                    <h4 class="card-title game-name">' . $item['game_name'] . '</h4>
                                    <p class="card-text game-name">Price <span>$' . $item['game_price'] . '</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    ';
                    }
                }
            }
            echo '</div></div> </div> </div> </div> </div> </div>';
        }
        ?>
    </section>
    <!--Footer-->
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

</html>