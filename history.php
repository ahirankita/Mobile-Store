<?php
include "head.php";
include "db.php";

$user_id = $_SESSION['user_id'];
$query1 = "SELECT date, count(product_id) as pcount from buyerhistory group by date order by date DESC";
$result1 = $con ->query($query1);


$total = 0;
?>

<link href="css/product.css" rel="stylesheet">

<?php

if($result1->num_rows >0){



    echo "<div class = \"container\">";
                echo "<div class=\"container\" style='align-content: center;'>
                    <div class=\"row\">
                        <div  align=\"center\">
                                <h1>Shopping Cart</h1>
                                <table class=\"table  center table - condensed  \" style='width: 700px;align-items:center ;'>
                                    <thead class=\"thead - inverse\">
                                    <tr class='info'>
                                        <th colspan='2'>Product</th>
                                        <th>Price</th>
                                        <th>Quantity Purchased</th>
                                    </tr>
                                    </thead>
                                    <tbody > <div>";
                                    while ($rowstime = $result1->fetch_assoc()) {
                                        $time = $rowstime['date'];


                                        $sql = "SELECT buyerhistory.product_id,name,image,price,buyerhistory.quantity,company
                                                FROM product,buyerhistory
                                                WHERE date = '$time' and buyerhistory.product_id = product.product_id and buyerhistory.user_id = '$user_id' ";
                                        $result = $con->query($sql);
                                        echo "<tr class='active'> <td colspan=\"4\"><h4>Order Placed on : ".$time."</h4></td> </tr>";
                                        if ($result->num_rows > 0) {
                                            echo "<div class=\"container\"> ";
                                            while ($rows = $result->fetch_assoc()) {
                                                $PRODUCT_ID = $rows['product_id'];
                                                $NAME = $rows['name'];
                                                $IMAGE = $rows['image'];
                                                $COMPANY = $rows['company'];
                                                $PRICE = $rows['price'];
                                                $QUANTITY = $rows['quantity'];
                                                $total = $total + $PRICE;
                                                $productlist[$PRODUCT_ID] = 1;
                                                //echo $productlist[$PRODUCT_ID];
                                                //echo $PRODUCT_ID;

                                                echo "
                                                <tr class ='success'>
                                            <td style='width: 116px;'>
                                                    <div style=\"border:None;width: 130px;\">
                                                        <img  class=\"static\"  src=\"" . $IMAGE . "\" style=\"width:100px;width: 100px;\">
                                                    </div>
                                            </td>
                                            <td style='width: 140px;'>
                                                <div  style=\"height: 48px;\">
                                                    <h5 style='text-align: center;'>
                                                        <a href=\"item.php?id=" . $PRODUCT_ID . " \" style='align-content: center;'>" . $NAME . "</a>
                                                     </h5>   
                                                </div>
                                            </td> 
                                    <td>
                                       
                                        <h4>$" . $PRICE . "</h4>
                                        
                                    </td>
                                    <td>
                                        <h4>" . $QUANTITY . "</h4>
                                       
                                    </td>
                                   
                                                
                                                </tr>";
                                            }

                                        echo "</div>";
                                        }

                                    }
                                    echo "
                                          </tbody>
                                    </table>
                                </div>
                    </div> 
                </div>";

        echo "</div>";
}






include "footer.php";
?>
