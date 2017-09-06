<?php
ob_start();
include "head.php";
include "db.php";

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantityr =  $_POST['quantity'];
$sqlt = "UPDATE cart SET quantity='$quantityr' WHERE product_id = '$product_id' and user_id= '$user_id' ";
$result4 = $con->query($sqlt);

error_reporting(E_ALL);
ini_set('display_errors', 'On');
while (ob_get_status()) {
    ob_end_clean();
}
header('location: cart.php');
?>
