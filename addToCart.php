<?php
    include "head.php";
    include "db.php";
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];
    $flag = $_GET['flag'];
    if($flag == 1){
            $sql = "INSERT INTO cart (user_id,product_id)
                VALUES ('$user_id','$product_id')";
            if ($con->query($sql) === TRUE) {

                echo("<script>location.href = \"item.php?id=" . $product_id . "&flag=1\" ;</script>");
            }
            else {

                echo("<script>location.href = \"item.php?id=" . $product_id . "&flag=2\" ;</script>");
            }
        }
    elseif($flag == 0){
        $sql = "DELETE FROM cart where user_id = '$user_id' AND product_id = '$product_id'";
        if ($con->query($sql) === TRUE) {
            echo("<script>location.href = \"item.php?id=".$product_id."&flag=3\" ;</script>");
        } else {
            echo "Error deleting record: " . $con->error;

            echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");
        }
    }
    elseif($flag==3){
        $sql = "DELETE FROM cart where user_id = '$user_id' AND product_id = '$product_id'";
        if ($con->query($sql) === TRUE) {

            echo("<script>location.href = \"cart.php\" ;</script>");
        } else {
            echo "Error deleting record: " . $con->error;

            echo("<script>location.href = \"item.php?id=".$product_id."\" ;</script>");
        }
    }

?>