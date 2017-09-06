<?php
ob_start();
include "db.php";
include "head.php";
$comment =  $_POST['comment'];
$product_id =  $_GET['product_id'];
if(isset($_POST['rating']) and $_POST['rating'] !=NULL){
    $rating = $_POST['rating'];
}
else{
    $rating = 0;
}
$user_id =  $_POST['user_id'];
$sql = "insert into reviews (product_id,user_id,review,rating) VALUES ( '$product_id','$user_id','$comment','$rating')";
if ($con->query($sql) === TRUE) {

    $count_sql = "select count(*) as total_reviews,avg(rating) as avg_ratings
    from reviews where product_id = '$product_id' group by product_id";
    $result = $con->query($count_sql);
    $rows = $result->fetch_assoc();
    $total_reviews = $rows['total_reviews'];
    $avg_reviews = $rows['avg_ratings'];
    $product_update = "UPDATE product SET ratings = '$total_reviews',avg_ratings = '$avg_reviews'  WHERE product_id = '$product_id'";
    if ($con->query($product_update) === TRUE) {
        echo '<script language="javascript">';
        echo 'alert("Review added Sucessfully")';
        echo '</script>';
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        while (ob_get_status()) {
            ob_end_clean();
        }
        header('location: item.php?id=' . $product_id . '');
    }
}
else {
    echo "Error updating record: " . $con->error;
}
?>