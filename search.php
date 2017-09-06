<?php
include "head.php";
include "db.php";

if(isset($_POST['search'])) {

    $search = $_POST['search'];
}
elseif(isset($_GET['search']) ){
 $search = $_GET['search'];
}
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
if(isset($_GET['cat'])){
    $cat = $_GET['cat'];
}
else{
    $cat = "";
}

    $limit = 6;
    $sql = "SELECT count(PRODUCT_ID) as TOTAL
            FROM PRODUCT
            WHERE category like   '%" . $cat. "%' and  company like '%" . $filter_c . "%'   and flag = 1 and ((name LIKE '%" . $search . "%' OR company LIKE '%" . $search . "%' ) AND os like '%" . $filter . "%')";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $rows = $result->fetch_assoc();
        $total_records = $rows['TOTAL'];
        $total_pages = ceil($total_records / $limit);
    } else {
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
                            </span>CATEGORIES</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <a <?php echo "href='search.php?search=".$search."&cat=Mobiles'"; ?>>Mobiles</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a <?php echo "href='search.php?search=".$search."&cat=Accessories'"; ?>><span class="glyphicon glyphicon-headphones">
                            </span>Mobile Accessories</a>
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
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>

                                    <a  <?php echo "href='search.php?search=".$search."&filter=Android'"; ?> >Android</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a <?php echo "href='search.php?search=".$search."&filter=iOS'"; ?> >iOS</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a <?php echo "href='search.php?search=".$search."&filter=Windows'"; ?>>Windows</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-briefcase">
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
                                    <a   href=\"search.php?search=".$search."&filter_c=".$company."\">" . $company . "</a>
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

            if($admin == TRUE){
                echo "<div class=\"panel panel-default\">
                                    <div class=\"panel-heading\">
                                        <h4 class=\"panel-title\">
                                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFour\"><span class=\"glyphicon glyphicon-file\">
                                        </span>Reports</a>
                                        </h4>
                                    </div>
                                    <div id=\"collapseFour\" class=\"panel-collapse collapse\">
                                        <div class=\"panel-body\">
                                            <table class=\"table\">
                                                <tr>
                                                    <td>
                                                        <span class=\"glyphicon glyphicon-usd\"></span><a href=\"#\">My Products</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class=\"glyphicon glyphicon-user\"></span><a href=\"#\">Add New Item</a>
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
        <?php



        echo " <div><h3> Showing ".$total_records." results for \"" . $search . "\"<br>";
                if(isset($_GET['filter'])){
                    echo "Filtered By : ".$filter."";
                }
                elseif(isset($_GET['filter_c'])){
                     echo "Filtered By : ".$filter_c."" ;
                }
                elseif(isset($_GET['cat'])){
                    echo "Category : ".$cat."" ;
                }

            echo "</h3></div>"; ?>
        <div class="row" id="target-content"></div>
        <div  align="center">
            <?php
            for($i=1;$i<=$total_pages;$i++)
            {
                ?>
                <input type='button' value= "<?php echo $i; ?>" onclick='get_data("<?php echo $i; ?>","<?php echo $search; ?>","<?php echo $filter; ?>","<?php echo $filter_c; ?>","<?php echo $cat; ?>")'>
            <?php
            }
            ?>
        </div>
    </div>

</div>

</div>
<!-- /.container -->
<script type="text/javascript">

    function get_data(no,sch,fil,fil2,cat1)
    {


        $.ajax
        ({
            type:'post',
            url:'pagination.php',
            data:{
                page:no,
                search:sch,
                filter:fil,
                filter_c:fil2,
                cat:cat1
            },
            success:function(response) {
                document.getElementById("target-content").innerHTML=response;
            }
        });
    }
    window.onload = get_data(1,"<?php echo $search; ?>","<?php echo $filter; ?>","<?php echo $filter_c; ?>","<?php echo $cat; ?>");
</script>

<?php
include "footer.php";
?>