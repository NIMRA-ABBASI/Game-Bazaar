<?php
session_start(); // Start the session

// Unset the specific session variable (items in this case)
unset($_SESSION['user']);
unset($_SESSION['items']);
// Redirect to the login page or any other desired page after logout
header('location: login.php');
exit();
?>