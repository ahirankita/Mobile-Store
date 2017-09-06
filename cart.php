<?php
include "head.php";
include "db.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.product_id,name,image,price,product.quantity,company
        FROM product,cart
        WHERE cart.product_id = product.product_id and cart.user_id = '$user_id'";
$result = $con->query($sql);
$total = 0;
?>
<link href="css/product.css" rel="stylesheet">

<?php

$productlist = array();
if($result->num_rows > 0) {

    echo "<div class=\"container\">
        <div class=\"row\">
            <div>
                    <h1>Shopping Cart</h1>
                    <table class=\"table  table - condensed  \">
                        <thead class=\"thead - inverse\">
                        <tr class='info'>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity Available</th>
                            <th>Quantity Required</th>
                            <th>Remove Product</th>
                        </tr>
                        </thead>
                        <tbody>";
                            if ($result->num_rows > 0) {
                                while ($rows = $result->fetch_assoc()) {
                                    $PRODUCT_ID = $rows['product_id'];

                                    $NAME = $rows['name'];
                                    $IMAGE = $rows['image'];
                                    $COMPANY = $rows['company'];
                                    $PRICE = $rows['price'];
                                    $QUANTITY = $rows['quantity'];


                                    $sqlq = "SELECT quantity FROM cart WHERE product_id = '$PRODUCT_ID' and user_id= '$user_id' ";
                                    $result4 = $con->query($sqlq);
                                    $rows4 = $result4->fetch_assoc();
                                    $QUANTITYR = $rows4['quantity'];
                                    $total = $total + $PRICE * $QUANTITYR;
                                    $productlist[$PRODUCT_ID] = $QUANTITYR;
                                    //echo $productlist[$PRODUCT_ID];
                                    //echo $PRODUCT_ID;
                                    echo "
                                    <tr class ='success'>
                                        <td>
                                            <div class=\"col-sm-4 col-lg-4 col-md-4\">
                                                    <div class=\"thumbnail\">
                                                        <img  class=\"static\"  src=\"" . $IMAGE . "\" style=\"width:200px;width: 200px;\">
                                                        <div class=\"caption\" style=\"height: 50px;width: 198px;\">
                                                            <h5>
                                                                <a href=\"item.php?id=" . $PRODUCT_ID . " \">" . $NAME . "</a>
                                                            </h5>
                                                                                                            
                                                             
                                                         </div>
    
                                                       
                                                    </div>
                                                 </div>
                                        </td> 
                                    <td>
                                       
                                        <h4>$" . $PRICE . "</h4>
                                        
                                    </td>
                                    <td>
                                        <h4>" . $QUANTITY . "</h4>
                                       
                                    </td> "; ?>
                                    <td>


                                        <form action= "cart_update.php?id=<?php echo $PRODUCT_ID; ?>" method= "post">
                                            <div class="input-group" style="width: 70px;">
                                                <input style="width: 66px;" type="number" name="quantity" value="<?php echo $QUANTITYR; ?>" class="form-control input-number" value="1" min="1" max="<?php echo $QUANTITY; ?>">
                                                 <span class="input-group-btn">
                                              <button type= "submit" class="btn  btn-success" >
                                                   <span class="glyphicon glyphicon-repeat"></span> Update
                                              </button>
                                          </span>
                                                <input type="hidden" name="product_id" value="<?php echo $PRODUCT_ID; ?>">
                                            </div>
                                        </form>
                                    </td>
                       
                                   <?php echo " <td>
                                            <span class=\"glyphicon glyphicon-trash text-danger\"></span><a  href=\"addToCart.php?product_id=" . $PRODUCT_ID . "&flag=3 \" class=\"text-danger\">
                                                Delete Item</a>
                                    </td>
                                    </tr>";
                                }
                                //echo count($productlist);
                                echo "
                        <tr>
                            <td colspan=\"2\"></td>
                            <td>
                                <h4><strong>Total</strong></h4></td>
                            <td>
                                <h4><strong>$".$total."</strong></h4></td>
                            <td>
                                <h5 class=\"pull-left\">
                                    
                                    <a href=\"checkout.php\" class=\"list-group-item active\">Checkout</a>
                                    
                                </h5>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div> 
    </div>";}
}
else{
    echo"<div class=\"container\"><h1>Your Cart is Empty</h1></div>";
}

$_SESSION['productlist'] = $productlist;

include "footer.php";
?>
