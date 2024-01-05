<?php
if (isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
} else {
    header('location: games.php');
    exit();
}
?>