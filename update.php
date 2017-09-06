<?php
ob_start();
include "head.php";
include "db.php";
$USER_ID = $_SESSION['user_id'];
if(isset($_GET['product_id']) && $_GET['product_id'] != NULL){



$PRODUCT_ID = $_GET['product_id'];

$sql = "SELECT PRODUCT_ID,NAME,DESCRIPTION,IMAGE,COMPANY,PRICE,RATINGS,AVG_RATINGS,QUANTITY,CATEGORY,WARRANTY,OS,FEATURES
                              FROM PRODUCT
                              WHERE (PRODUCT_ID = '$PRODUCT_ID')";
$result = $con->query($sql);
//echo "yo";
//echo $PRODUCT_ID;
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {

            $NAME = $rows['NAME'];
            $DESCRIPTION = $rows['DESCRIPTION'];
            $IMAGE = $rows['IMAGE'];
            $COMPANY = $rows['COMPANY'];
            $PRICE = $rows['PRICE'];
            $RATINGS = $rows['RATINGS'];
            $AVG_RATINGS = $rows['AVG_RATINGS'];
            $QUANTITY = $rows['QUANTITY'];
            $WARRANTY = $rows['WARRANTY'];
            $CATEGORY = $rows['CATEGORY'];
            $OS = $rows['OS'];
            $FEATURES = $rows['FEATURES'];
            

        }

    }?>
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
                    <h3>Update Product</h3>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="sr-only" for="form-username">Name</label>
                        <input type="text" name="name" value="<?php echo $NAME; ?>" class="form-username form-control" id="form-username">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-password">Description</label>
                        <input type="text" name="description" value="<?php echo $DESCRIPTION; ?>" class="form-password form-control" id="form-password">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-password">Features</label>
                        <input type="text" name="features" value="<?php echo $FEATURES; ?>" class="form-password form-control" id="form-password">
                    </div>
                    <div class="form-group">
                                        <label class="sr-only" for="form-password">OS</label>
                                        
                                          <select id = 'os' name="os">
                                            <option value="Android">Android</option>
                                            <option value="iOS">iOS</option>
                                            <option value="Windows">Windows</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-password">Company</label>
                        <input type="text" name="company" value="<?php echo $COMPANY; ?>" class="form-password form-control" id="form-password">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-username">Price</label>
                        <input type="number" name="price" value="<?php echo $PRICE; ?>" class="form-password form-control" id="form-password">
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="form-username">Quantity</label>
                        <input type="number" min = "1" name="quantity" value="<?php echo $QUANTITY; ?>">
                    </div>
                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Warranty</label>
                                        <input type="number"  name="warranty" placeholder="<?php echo $WARRANTY; ?>" class="form-username form-control">
                        </div>

                        <div class="form-group">
                                        <label class="sr-only" for="form-username">Category</label>
                                        <select id = 'Category' name="Category">
                                            <option value="Mobiles">Mobiles</option>
                                            <option value="Accessories">Accessories</option>
                                        </select>
                                          
                                    </div>


                        <input type="hidden" name = "product_id" value ="<?php echo $PRODUCT_ID; ?>">
                    <div class="form-group">
                        <label class="sr-only" for="form-upload">Upload Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <!-- <input type="submit" value="Upload Image"> -->
                    </div>
                    <button type="submit" class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </div>

</div>
</div>

</div>




<?php
}


if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
    switch ($_FILES['fileToUpload']["error"]) {
        case UPLOAD_ERR_OK:
            $PRODUCT_ID = $_POST['product_id'];
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
            $PRODUCT_ID = $_POST['product_id'];

            $sql = "SELECT IMAGE
                              FROM PRODUCT
                              WHERE (PRODUCT_ID = '$PRODUCT_ID')";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()){
                    $IMAGE = $rows['IMAGE'];
                }
            }
            $target = $IMAGE;

    }

    // echo "Status: {$status}<br/>\n";

}
else{
    $PRODUCT_ID = $_POST['product_id'];
    $sql = "SELECT IMAGE
                              FROM PRODUCT
                              WHERE (PRODUCT_ID = '$PRODUCT_ID')";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()){
            $IMAGE = $rows['IMAGE'];
        }
    }

    $target = $IMAGE;
}
if ($_POST['name'] != NULL && $_POST['company'] != NULL && $_POST['description'] && $_POST['price']!= NULL){
    $name = $_POST['name'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $features = $_POST['features'];
    $price = $_POST['price'];
    $image = $target;
    $quantity = $_POST['quantity'];
    $warranty = $_POST['warranty'];
    $os = $_POST['os'];
    $sql="UPDATE product SET name='$name', description='$description',image='$image',company='$company',price='$price', quantity='$quantity',features='$features', os = '$os' , warranty = '$warranty' WHERE product_id = '$PRODUCT_ID'";

    if (!mysqli_query($con,$sql)){
        echo"not updated";
    }
    else{

        echo "updated";
        echo "hjh";
        echo $PRODUCT_ID;
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        while (ob_get_status()) {
            ob_end_clean();
        }
        header('location: item.php?id=' . $PRODUCT_ID . '');
    }


}
?>


</body>
</html>