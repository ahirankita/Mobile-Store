<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="icon" href="banners/logo.png" type="image/gif" sizes="16x16">
  <title>SmartCell</title>
  <style type="text/css">
    .body{
      background : url('/wallpaper.jpg');
      background-repeat: repeat;   
    }
    
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <style type="text/css">
    .navbarP{
          margin-bottom: 0px;
    }
  </style>
    <script>
        $(function() {
            $( "#search" ).autocomplete({
                source: 'search_suggesion.php'
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top"  style="margin-bottom: 10px;">
  <div class="container-fluid">
    <div class="navbar-header" style=" height: 40px;>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Smart Cell</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="product.php">Home</a></li>
        <li><a href="product.php?cat=Mobiles" >Mobiles</a></li>
          <li><a href="product.php?cat=Accessories" >Accessories</a></li>


      </ul>
        <?php
        include "db.php";
        $admin = FALSE;
        $loggedin = FALSE;
        session_start();
        $set = FALSE;
        if(isset($_SESSION['username'])){
            $loggedin = TRUE;
            if($_SESSION['type'] == 1){
                $admin = TRUE;
            }
            else{
                $admin = FALSE;
            }
        $set = TRUE; ?>
            <?php
            echo "<ul class=\"nav navbar-nav navbar-right\">
        <li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>
      </ul>";
            if($admin == TRUE){
                echo "<ul class=\"nav navbar-nav navbar-right\">
        <li><a href=\"addItem.php\"><span class=\"glyphicon glyphicon-plus-sign\"></span> Add Items</a></li>
      </ul>";
            }
            else{
                echo "<ul class=\"nav navbar-nav navbar-right\">
        <li><a href=\"history.php\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> History</a></li>
      </ul>";
                 echo "<ul class=\"nav navbar-nav navbar-right\">
         <li>";
                $user_id=  $_SESSION['user_id'];
        $sql_cart_count = "select count(product_id) as count from cart where user_id = '$user_id'";
        $result = $con->query($sql_cart_count);
        if ($result->num_rows > 0) {
            $rows = $result->fetch_assoc();
            $number = $rows['count'];
        }
        else{
            $number = 0;
        }

        echo "<a href=\"cart.php\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Cart <span class=\"badge\">".$number."</span></a>
        
        </li>
      </ul>";
            }

        }
        else{
            echo "<ul class=\"nav navbar-nav navbar-right\">
        <li><a href=\"signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Register</a></li>
      </ul>
      <ul class=\"nav navbar-nav navbar-right\">
        <li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>
      </ul>";
        }
        ?>
      <ul class="nav navbar-nav navbar-left ">
        <li>
            <form action="search.php" method = "POST" class="navbar-form navbar-right">

              <div class="input-group">

                <input type="text" placeholder="Search..." class="form-control" name = "search" id ="search" style="
    width: 251px;
" />
                <div class="input-group-btn">
                  <button class="btn btn-success">
                  <span class="glyphicon glyphicon-search"></span>
                  </button>
                </div>
              </div>
            </form>
          <li><a href="#"><strong> <?php if($loggedin == TRUE) {echo "Hello ",$_SESSION['fname'],' ',$_SESSION['lname'];} ?> </strong></a> </li>
        </li>
      </ul>
    </div> 
  </div>
</nav>

