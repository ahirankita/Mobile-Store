<?php

include('db.php');

$limit = 6;
$search= "";
$filter = "";
$filter_c = "";
$cat = "";
if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
if(isset($_POST['filter'])) {


    $filter = $_POST['filter'];
}
if(isset($_POST['filter_c'])) {
    $filter_c = $_POST['filter_c'];
}
if(isset($_POST['cat'])) {
    $cat = $_POST['cat'];
}

if (isset($_POST['page'])){$page = $_POST['page'];} else {$page=1;};
session_start();
$admin = FALSE;
$loggedin = FALSE;
$set = FALSE;
if(isset($_SESSION["username"])) {

    $loggedin = TRUE;
    if ($_SESSION['type'] == 1) {
        $admin = TRUE;
    } else {
        $admin = FALSE;
    }
}
$start = ($page - 1)* $limit ;
if($admin == FALSE){

    $sql = "SELECT DISTINCT PRODUCT_ID,NAME,DESCRIPTION,IMAGE,COMPANY,PRICE,RATINGS,avg_ratings
                              FROM PRODUCT
                              WHERE  category like   '%" . $cat. "%' and  company like '%" . $filter_c . "%'  and flag = 1 and ((name LIKE '%" . $search  . "%' OR company LIKE '%" . $search . "%' ) AND os like '%" . $filter . "%')  LIMIT $start, $limit";

}else {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT DISTINCT PRODUCT_ID,NAME,DESCRIPTION,IMAGE,COMPANY,PRICE,RATINGS,avg_ratings,user_id
                              FROM PRODUCT
                              WHERE category like   '%" . $cat. "%' and  company like '%" . $filter_c . "%'  and  user_id = '$user_id'  and ((name LIKE '%" . $search  . "%' OR company LIKE '%" . $search . "%' ) AND os like '%" . $filter . "%') LIMIT $start, $limit";

}
$result = $con->query($sql);
?>

    <?php
    if ($result->num_rows > 0) {
        while($rows = $result->fetch_assoc()) {

            $PRODUCT_ID = $rows['PRODUCT_ID'];
            $NAME = $rows['NAME'];
            $DESCRIPTION = $rows['DESCRIPTION'];
            $IMAGE = $rows['IMAGE'];
            $COMPANY = $rows['COMPANY'];
            $PRICE = $rows['PRICE'];
            $RATINGS = $rows['RATINGS'];
            $AVG_RATINGS = $rows['avg_ratings'];

            echo "<div class=\"col-sm-4 col-lg-4 col-md-4 well well-lg\">
                                        <link href=\"css/zoom.css\" rel=\"stylesheet\">
                                        <div class=\"thumbnail\" style=\" padding-left: 10px; padding-top: 10px;  padding-right: 10px;\">
                                            <img  class=\"zoom\"  src=\"".$IMAGE."\" alt=\"\" style=\"width:150px;width: 150px;\">
                                            <div >
                                                <h4 class=\"pull-right\"><span class=\"label label-default\">$" . $PRICE . "</span></h4>
                                                <h4>
                                                    <a href=\"item.php?id=".$PRODUCT_ID." \">" . $NAME . "</a>
                                                </h4>
                                               <!-- <p>" . $DESCRIPTION . "</p> -->
                                            </div>
                                            <div class=\"ratings\">
                                                <p class=\"pull-right\">" . $RATINGS . " reviews</p>
                                                <p> ";
                                            for ($i= 1 ; $i <= round($AVG_RATINGS); $i++){
                                                echo "<span class= 'glyphicon glyphicon-star'></span>";
                                                }
                                            for ($i = 1 ; $i <= (5 - round($AVG_RATINGS)) ; $i++){
                                                            echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                                        }
                                             echo"
                                                </p>
                                            </div>
                                        </div>
                                     </div>
                                        ";
        }
    }
    else{
        echo "<div class=\"col-sm-4 col-lg-4 col-md-4   well well-sm\"><h3> No Results Found</h3></div>";
    }
    ?>

