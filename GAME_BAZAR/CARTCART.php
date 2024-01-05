<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_bazaar";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);

if (empty($_SESSION["user"])) {
    header('location: login.php');
    unset($_SESSION['user']);
    $_SESSION["items"] = array();
}

// Ensure that $_SESSION["items"] is set
if (!isset($_SESSION["items"])) {
    $_SESSION["items"] = array(); // You can initialize it as an empty array
}

// Function to calculate total price
function calculateTotalPrice()
{
    $total_price = 0;
    foreach ($_SESSION["items"] as $itemId) {
        $query = "SELECT price FROM games WHERE id='$itemId'";
        $result = mysqli_query($GLOBALS['conn'], $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_price += $row["price"];
    }
    return $total_price;
}

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "remove":
            if (!empty($_SESSION["items"])) {
                foreach ($_SESSION["items"] as $k => $v) {
                    if ($_GET["id"] == $v) {
                        unset($_SESSION["items"][$k]);
                        break; // Break out of the loop after removing the item
                    }
                }
            }
            break;

        case "update":
            // Check if the cart is empty
            if (empty($_SESSION["items"])) {
                $_SESSION["errorMessage"] = "Your cart is empty. Add items to your cart before proceeding.";
            } else {
                // Step 1: Create order in the database
                $total_price = calculateTotalPrice();
                $userId = $_SESSION['user'];

                $orderQuery = "INSERT INTO user_order (total_price, user_Id) VALUES ('$total_price', '$userId')";
                mysqli_query($conn, $orderQuery);
                $orderId = mysqli_insert_id($conn);

                // Step 2: Insert (order id, game id) into order_items
                foreach ($_SESSION["items"] as $itemId) {
                    $insertOrderItemQuery = "INSERT INTO item_order (order_id, game_id) VALUES ('$orderId', '$itemId')";
                    mysqli_query($conn, $insertOrderItemQuery);
                }

                // Step 3: Remove all cart items from session
                unset($_SESSION["items"]);

                // Step 4: Navigate to thank you page
                header('location: thank_you.php');
                exit();
            }
            break;

        case "empty":
            unset($_SESSION["items"]);
            break;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
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
    <link href="./CARTCART.css" rel="stylesheet">
    <link href="./header.css" rel="stylesheet">
    <link href="./footer.css" rel="stylesheet">

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
                    <li><a href="purchase.php">Purchases</a></li>
                    <li class="resume-link"><a href="logout.php" class="btn-resume">Log Out</a></li>
                    <li><a href="CARTCART.php">
                            <i class="fas fa-shopping-cart fa-flip-horizontal fa-lg"
                                style="color: #ffffff;cursor:pointer;">
                                <?php if (isset($_SESSION['items'])) {
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
    <!-- Cart content -->
    <div id="shopping-cart">
        <div class="txt-heading"><strong>Shopping Cart</strong></div>

        <a id="btnEmpty" href="CARTCART.php?action=empty">Empty Cart</a>
        <?php
        if (isset($_SESSION["items"])) {
            $total_quantity = 0;
            $total_price = 0;
            ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align:left;" class="table-heading">Name</th>
                        <th style="text-align:right;" width="5%" class="table-heading">Quantity</th>
                        <th style="text-align:center;" width="10%" class="table-heading">Price</th>
                        <th style="text-align:center;" width="5%" class="table-heading">Remove</th>
                    </tr>
                    <?php
                    foreach ($_SESSION["items"] as $itemId) {
                        $query = "SELECT * FROM games WHERE id='$itemId'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $item_price = $row["price"];
                        ?>
                        <tr>
                            <td>
                                <img src="<?php echo $row["image"]; ?>" class="cart-item-image" />
                                <?php echo $row["name"]; ?>
                            </td>
                            <td style="text-align:center;">1</td>
                            <td style="text-align:center;">
                                <?php echo "$ " . number_format($item_price, 2); ?>
                            </td>
                            <td style="text-align:center;">
                                <a href="CARTCART.php?action=remove&id=<?php echo $itemId; ?>" class="btnRemoveAction">
                                    <img src="./images/icon-delete.png" alt="Remove Item" />
                                </a>
                            </td>
                        </tr>
                        <?php
                        $total_price += $item_price;
                        $total_quantity += 1;
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="right" class="table-heading">Total :</td>
                        <td align="center">
                            <strong>
                                <?php echo "$ " . number_format($total_price, 2); ?>
                            </strong>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php
        }
        ?>
    </div>

    <!-- Display Error if Cart is Empty -->
    <div class="no-records">
        <?php echo isset($_SESSION["errorMessage"]) ? $_SESSION["errorMessage"] : ''; ?>
    </div>
    <?php unset($_SESSION["errorMessage"]); ?>

    <!-- Buy Now button -->
    <section>
        <div class="submit-buy">
            <a id="l-button" href="CARTCART.php?action=update">Buy Now</a>
        </div>
    </section>

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









