<?php
 
 #$connect=mysqli_connect('localhost','root','root','mobile_store');
$connect=mysqli_connect('localhost','root','root','mobile_store');
if(mysqli_connect_errno($connect)){
		echo 'Failed to connect';
}
  $username=$_POST["username"];
  $query="SELECT * from userdetails where username='$username' and type = 0";
  $result = mysqli_query($connect,$query);
  $find=mysqli_num_rows($result);
echo $find;
?>
	