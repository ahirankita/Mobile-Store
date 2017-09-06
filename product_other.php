<?php
include "head.php";
include "db.php";
    $limit = 3;
    //echo "asfas";

if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
}
else{
    $filter = "";
}
if(isset($_GET['filter_c'])){
    $filter_c = $_GET['filter_c'];
}
else{
    $filter_c = "";
}
   if($admin == FALSE){
       $sql = "SELECT count(PRODUCT_ID) as TOTAL FROM PRODUCT where company like '%" . $filter_c . "%'  and flag = 1  AND os like '%" . $filter . "%'";
   }else {
       $user_id = $_SESSION['user_id'];
       $sql = "SELECT count(PRODUCT_ID) as TOTAL FROM PRODUCT where company like '%" . $filter_c . "%'  and user_id = '$user_id'  AND os like '%" . $filter . "%' ";
   }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        $total_records = $rows['TOTAL'];
        $total_pages = ceil($total_records / $limit);
    }
    else {
        $total_pages = 0;
    }
?>
    <!-- Page Content -->
<style>
    .thumbnail img {
        height:200px;
        width:100%;
    }
</style>
    <link href="css/product.css" rel="stylesheet">
    <div class="container">

            <div class="col-sm-3 col-md-3">
                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
                            </span>Categories</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <a href="http://www.jquery2dotnet.com">Mobiles</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="http://www.jquery2dotnet.com">Mobile Accessories</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-phone">
                            </span>Operating Systems</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <a  <?php echo "href='product.php?filter=Android'"; ?>>Android</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a <?php echo "href='product.php?filter=iOS'"; ?>>iOS</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a <?php echo "href='product.php?filter=Windows'"; ?>>Windows</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
                            </span>Company</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table">
                                    <?php
                                    $sql_company = "select company,count(*) as count from product group by company order by count DESC";
                                    $result_company = $con->query($sql_company);
                                    if ($result_company->num_rows > 0) {

                                        while ($rows_company = $result_company->fetch_assoc()) {
                                            $company = $rows_company['company'];
                                            echo "                            <tr>
                                <td>
                                    <a   href=\"product.php?filter_c=".$company."\">" . $company . "</a>
                                </td>
                            </tr>";

                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>


                    <?php
                    if($loggedin == TRUE && $admin == FALSE) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><span class="glyphicon glyphicon-phone">
                            </span>Account</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <a href="cart.php">Cart <span class="label label-info"><?php echo $number; ?></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="history.php">Orders</a>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>


                        <?php
                            }
                        if($admin == TRUE){
                        echo "<div class=\"panel panel-default\">
                                    <div class=\"panel-heading\">
                                        <h4 class=\"panel-title\">
                                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFour\"><span class=\"glyphicon glyphicon-file\">
                                        </span>Account</a>
                                        </h4>
                                    </div>
                                    <div id=\"collapseFour\" class=\"panel-collapse collapse\">
                                        <div class=\"panel-body\">
                                            <table class=\"table\">
                                                <tr>
                                                    <td>
                                                        <span class=\"glyphicon glyphicon-usd\"></span><a href=\"product.php\">Products</a>
                                                    </td>
                                                </tr>
        
                                                <tr>
                                                    <td>
                                                        <span class=\"glyphicon glyphicon-tasks\"></span><a href=\"addItem.php\">Add New Item</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        ";}?>
                </div>
            </div>



            <div class="col-md-9" >
            <div><h3>
                <?php
                if(isset($_GET['filter'])){
                    echo "Filtered By : ".$filter."";
                }
                elseif(isset($_GET['filter_c'])){
                    echo "Filtered By : ".$filter_c."" ;
                }
                echo "</h3></div>"; ?>
                <div class="row" id="target-content"></div>
                <div  align="center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination ">

                                <?php
                                for($i=1;$i<=$total_pages;$i++)
                                {
                                    ?>

                                    <input type='button' value= "<?php echo $i; ?>" onclick='get_data("<?php echo $i; ?>","<?php echo $filter; ?>","<?php echo $filter_c; ?>")'>
                                    <?php
                                }
                                ?>

                        </ul>
                    </nav>





                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->
<script type="text/javascript">
    function get_data(no,fil,com)
    {

        $.ajax
        ({
            type:'post',
            url:'pagination.php',
            data:{
                page:no,
                filter:fil,
                filter_c:com
            },
            success:function(response) {
                document.getElementById("target-content").innerHTML=response;
            }
        });
    }
    window.onload = get_data(1,"<?php echo $filter; ?>","<?php echo $filter_c; ?>");
</script>

<?php
include "footer.php";
?>

