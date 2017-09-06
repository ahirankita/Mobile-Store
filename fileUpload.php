<?php

include "head.php";
include "db.php";


//$temp = explode(".", $_FILES["file"]["name"]);
//$newfilename = round(microtime(true)) . '.' . end($temp);
//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);

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

    }

  // echo "Status: {$status}<br/>\n";

}

if ($_POST['name'] != NULL && $_POST['company'] != NULL && $_POST['description'] && $_POST['price']!= NULL){
    $name = $_POST['name'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $target;
    $quantity = $_POST['quantity'];
    $rating = 0;
    $sql="INSERT into product (name, description,image, company, price, ratings, quantity) VALUES ('$name', '$description', '$image', '$company', '$price', '$rating' ,'$quantity')";

    if (!mysqli_query($con,$sql)){
        echo"not inserted";
    }else{
        echo "inserted";
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
        <link rel="stylesheet" href="assets/css/form-elements.css">
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
            <div class="inner-bg">
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
                            <div class="form-bottom">
                                <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Name</label>
                                        <input type="text" name="name" placeholder="Name" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Description</label>
                                        <input type="text" name="description" placeholder="Description" class="form-password form-control" id="form-password">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="form-password">Company</label>
                                        <input type="text" name="company" placeholder="Company" class="form-password form-control" id="form-password">
                                    </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="form-username">Price</label>
                                        <input type="text" name="price" placeholder="price" class="form-password form-control" id="form-password">
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Quantity</label>
                                        <input type="number" name="quantity" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="form-upload">Upload Image</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <!-- <input type="submit" value="Upload Image"> -->
                                    </div>
                                    <button type="submit" class="btn">Add Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
            
        </div>


       
</body>
</html>