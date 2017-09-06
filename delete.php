<?php
include "head.php";
include "db.php";
$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];
$flag = $_GET['flag'];
echo $flag;
if($flag == 1){
    $sql = "UPDATE product SET  flag = 0 WHERE product_id = '$product_id'";
    $sql_cart = "delete from cart where product_id = '$product_id'";
    $result = $con->query($sql_cart);
    if ($con->query($sql) === TRUE) {
        echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");

    } else {
        echo "Error deleting record: " . $con->error;
        echo '<script language="javascript">';
        echo 'alert("Product Removed from Store")';
        echo '</script>';
        echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");
    }
}
else {
    $sql = "UPDATE product SET  flag = 1 WHERE product_id = '$product_id'";
    if ($con->query($sql) === TRUE) {
        echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");

    } else {
        echo "Error deleting record: " . $con->error;
        echo '<script language="javascript">';
        echo 'alert("Product Added to Store ")';
        echo '</script>';
        echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");
    }
}


?>