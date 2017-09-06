<?php
ob_start();
include "head.php";
include "db.php";
error_reporting(0);
?>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/validate.js"></script>
<!--  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <!-- Top content -->
        <div class="top-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top"
                                style=" height: 75px;">
                        		<div class="form-top-left">
                        			<h3>New User Registration</h3>
                            		                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" id="frm" name="frm" onsubmit="return subForm()" class="signup">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="username">Username</label>
			                        	<input  type="text" name="username" placeholder="Username..." class="form-username form-control" id="username">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="email">Email</label>
                                        <input required = "required" type="email" name="email" placeholder="Email..." class="form-username form-control" id="email">
                                    </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Password</label>
			                        	<input  type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="password">Confirm Password</label>
                                        <input  type="password" name="password2" placeholder="Confirm Password" class="form-password form-control" id="password2">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="fname">First Name</label>
                                        <input  type="text" name="fname" placeholder="first name" class="form-password form-control" id="fname">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="lname">Last Name</label>
                                        <input  type="text" name="lname" placeholder="last name" class="form-password form-control" id="lname">
                                    </div>
			                        <button type="submit" class="btn btn-success" id = "add">Sign in</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
 
                </div>
        </div>


        <!-- Javascript -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

<?php
$username=$_POST['username'];
$password=$_POST['password'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
require 'PasswordHash.php';

if($username!=NULL &&$password!=NULL){


    $hash_cost_log2 = 8;
    $hash_portable = FALSE;
    $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
    $hash = $hasher->HashPassword($password);
    if (strlen($hash) < 20)
    {
        die("failed to hash new password");
    }
    unset($hasher);

    $password = $hash;

    $res=mysqli_query($con,"SELECT count(*)+1 as count FROM userdetails");
    $r = $res->fetch_assoc();
    $c=$r["count"];
    echo "$c";
    $sql = "insert into userdetails (username,password,fname,lname,email,type) VALUES ('$username','$password','$fname','$lname','$email',0)";
    if (!mysqli_query($con,$sql)){
        echo"not inserted";
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        while (ob_get_status()) {
            ob_end_clean();
        }
        header('Location: signup.php?error=1');
    }

    else{
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        while (ob_get_status()) {
            ob_end_clean();
        }
        header('Location: login.php');

    }
}
include "footer.php";
?>



