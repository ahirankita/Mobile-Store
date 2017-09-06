
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" id="font-awesome-style-css" href="http://phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<title>pagination</title>
</head>
<body>
<?php 
include('head.php');
?>

<div>
<div id="target-content" >loading...</div>


<?php
include('db.php');

$limit = 2;
//echo "asfas";
$sql = "SELECT count(PRODUCT_ID) as TOTAL FROM PRODUCT";  
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

<div>
 <?php
 for($i=1;$i<=$total_pages;$i++)
 {
  echo "<input type='button' value='".$i."' onclick='get_data(".$i.")'>";
 }
 ?>
</div>


<script type="text/javascript">
function get_data(no)
{
 $.ajax
 ({
  type:'post',
  url:'pagination.php',
  data:{
   page:no
  },
  success:function(response) {
   document.getElementById("target-content").innerHTML=response;
  }
 });
}

window.onload = get_data(1);
</script>

</html>

