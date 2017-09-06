<?php
ob_start();
include "head.php";
include "db.php";
if(empty($_GET) === false) {
    $res = $_GET['error'];

    if ($res == 1) {
        echo '<script language="javascript">';
        echo 'alert("user does not exists")';
        echo '</script>';
    }
    if ($res == 2) {
        echo '<script language="javascript">';
        echo 'alert("User Exists but password is incorrect")';
        echo '</script>';
    }
    if ($res == 3) {
        echo '<script language="javascript">';
        echo 'alert("No user found with given user type")';
        echo '</script>';
    }
    if ($res == 4) {
        echo '<script language="javascript">';
        echo 'alert("Please login to Add/Buy products")';
        echo '</script>';
    }
}
else {
    if ((isset($_POST['username']) && $_POST['username'] != NULL) AND (isset($_POST['password']) && $_POST['password'] != NULL)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        //echo $username;
        //echo $password;
        require 'PasswordHash.php';

        $hash_cost_log2 = 8;
        $hash_portable = FALSE;
        $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
        $hash = '*';
        $sql_check = "SELECT password,username,fname,lname,email,type,user_id 
                                         FROM userdetails
                                         where username= '$username' AND type = '$type' ";
        $result = $con->query($sql_check);
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $hash = $rows['password'];
                echo $hash;
                if($hasher->CheckPassword($password, $hash))
                {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    $_SESSION["fname"] = $rows["fname"];
                    $_SESSION["lname"] = $rows["lname"];
                    $_SESSION["email"] = $rows["email"];
                    $_SESSION["type"] = $rows["type"];
                    $_SESSION['user_id'] = $rows['user_id'];
                    session_write_close();
                    error_reporting(E_ALL);
                    ini_set('display_errors', 'On');
                    while (ob_get_status()) {
                        ob_end_clean();
                    }
                    if($rows['type'] == 1){
                        header('location: product.php');
                    }
                    else{
                        header('location: index.php');
                    }


                }
                else{
                    echo '<script language="javascript">';
                    echo 'alert("Invalid Password")';
                    echo '</script>';
                }

            }
        }
        else {
            $sql = "SELECT username,fname,lname,email,type 
                                         FROM userdetails
                                         where username= '$username' AND type = '$type' ";
            $result = $con->query($sql);
            while (ob_get_status()) {
                ob_end_clean();
            }
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {

                    header('Location: login.php?error=2');
                }
            }
            else{

                header('Location: login.php?error=3');
            }
        }
    }
}
?>


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
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action= "<?php echo $_SERVER['PHP_SELF']; ?>" method= "post" class="login-form">

			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" required="'required" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" required="'required" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
                                    <div class="form-group">

                                        <select id = 'type' name="type">
                                            <option value=0>Buyer</option>
                                            <option value=1>Admin</option>
                                        </select>

                                    </div>
			                        <button type="submit" class="btn btn-success">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
<?php
include "footer.php";
?>