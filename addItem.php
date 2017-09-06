<?php
ob_start();
include "head.php";
include "db.php";

$user_id=$_SESSION['user_id'];
if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
    switch ($_FILES['fileToUpload']["error"]) {
        case UPLOAD_ERR_OK:
            $target = "banners/";
            $target = $target .round(microtime(true)) .'-'. basename($_FILES['fileToUpload']['name']);

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
                $status = "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded";
                $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                $check = getimagesize($target);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.<br>";
                    $uploadOk = 0;
                }

            } else {
                $status = "Sorry, there was a problem uploading your file.";
            }
            break;
        default :
            $target = "banners/no_image.jpg";

    }

  // echo "Status: {$status}<br/>\n";

}
else{
    $target = "banners/no_image.jpg";
}

if ($_POST['name'] != NULL && $_POST['company'] != NULL && $_POST['description'] && $_POST['price']!= NULL){
    $name = $_POST['name'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $target;
    $quantity = $_POST['quantity'];
    $warranty = $_POST['warranty'];
    $features = $_POST['features'];
    $category = $_POST['category'];
    $rating = 0;
    $os = $_POST['os'];
    //echo $name;
    //echo $description;
    //echo $price;
    //echo $image;
    $sql="INSERT into product (name, description,image, company, price, ratings, quantity, warranty, features, category, os,user_id) VALUES ('$name', '$description', '$image', '$company', '$price', '$rating' ,'$quantity','$warranty' , '$features', '$category','$os','$user_id')";



    if (!mysqli_query($con,$sql)){
        echo"not inserted";
    }
    else{
        $sql_get = "select product_id from product where image = '$image' and description = '$description' and name = '$name'";
        $result = $con->query($sql_get);
        $rows = $result->fetch_assoc();
        $product_id = $rows['product_id'];
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        while (ob_get_status()) {
            ob_end_clean();
        }
        header('location: item.php?id=' . $product_id . '');
    }
}
?>

<html>
<head>
     <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>


        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
        <!-- Top content -->
        <div class="top-content">  
            <div class="inner-bg" style="
    padding-top: 10px;>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Add New Product</h3>
                                                                    </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class  ="form-bottom">
                                <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Name</label>
                                        <input type="text" name="name" placeholder="Name" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Description</label>
                                        <input type="textarea" name="description" placeholder="Description" class="form-password form-control" id="form-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Features</label>
                                        <input type="textarea" name="features" placeholder="Features" class="form-password form-control" id="form-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">OS</label>
                                          <select id = 'os' name="os">
                                            <option value="Mobiles">Android</option>
                                            <option value="iOS">iOS</option>
                                            <option value="Windows">Windows</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                     <div class="form-group">
                                        <label class="sr-only" for="form-password">Company</label>
                                        <input type="text" name="company" placeholder="Company" class="form-password form-control" id="form-password">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="form-username">Price</label>
                                        <input type="number" name="price" placeholder="price" class="form-password form-control" id="form-password">
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Quantity</label>
                                        <input type="number" name="quantity" placeholder="Quantity" class="form-username form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Warranty</label>
                                        <input type="number"  name="warranty" placeholder="Warranty" class="form-username form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Category</label>
                                        <select id = 'category' name="category">
                                            <option value="Mobiles">Mobiles</option>
                                            <option value="Accessories">Accessories</option>
                                        </select>
                                          
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="form-upload">Upload Image</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <!-- <input type="submit" value="Upload Image"> -->
                                    </div>
                                    <button type="submit" class="btn btn-success">Add Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
            
        </div>


       
</body>
</html>