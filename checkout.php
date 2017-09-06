<?php
include "head.php";
include "db.php";

$arr = $_SESSION['productlist'];
$user_id = $_SESSION['user_id'];

echo "<h4>Thanks for shopping!</h4>";

while (list($key, $val) = each($arr)) {
    echo "$key => $val\n";

    $res =  mysqli_query($con,"SELECT quantity as count FROM PRODUCT WHERE product_id = $key");
    $r = $res->fetch_assoc();
    $c=$r["count"];
    $remaining = $c -$val;

    $sq3 = "update product set quantity = $remaining WHERE product_id = $key";
    if (!mysqli_query($con,$sq3)){
        echo"not updated";
    }else{
        echo "updated";
    }

	$sql = "INSERT into buyerhistory (user_id,product_id,quantity) VALUES ('$user_id','$key','$val')";

	if (!mysqli_query($con,$sql)){
        echo"not inserted";
    }else{
        echo "inserted";
    }

    $sq2 = "delete from cart where product_id=$key";
    if (!mysqli_query($con,$sq2)){
        echo"not deleted";
    }else{
        echo "deleted";
    }

    echo ("<script>location.href = \"history.php\";</script>");




};

?>