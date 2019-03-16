<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts2/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css2/style2.css">
</head>

<?php
require_once("database_config.php");
if(isset($_POST['submit'])){
    
    $path = $_FILES['image_info']['name'];
    $target_dir = "uploads/";
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $filename_only = str_replace(".".$ext,"",basename($_FILES['image_info']['name'])); 
    $current_time =  date("Y-m-d-H-i-s");
    $target_file = $target_dir.$filename_only.$current_time.".".$ext;
    move_uploaded_file($_FILES["image_info"]["tmp_name"], $target_file);

    $conn = new mysqli($servername, $username, $password, $dbname);
    $name=  $_POST['name'];
    $brand= $_POST['brand'];
    $description= $_POST['description'];
    $category= $_POST['category'];
    $price = $_POST['price'];
    $image = $target_file;

    $sql = "INSERT into athletics_ownedproducts (name,brand,description,category,price,image) VALUES ('".$name."','".$brand."','".$description."','".$category."','".$price."','".$image."')";
    if ( !( $result = mysqli_query($conn, $sql) ) ) {
        echo "<p>Could not execute query!</p>" ;
        die(mysqli_error() . "</body></html>" );
    }     
    mysqli_close( $conn);
}
?>

<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images2/signup-img.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" method="POST" class="register-form" id="register-form">
                        <h2>student registration form</h2>
                        <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" id="name" required/>
                        </div>
                        <div class="form-group">
                                <label for="brand">Brand:</label>
                                <input type="text" name="brand" id="brand" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" required/>
                        </div>
                        <div class="form-group">
                                <label for="state">Category :</label>
                                <div class="form-select">
                                    <select name="category" id="category">
                                        <option value=""></option>
                                        <option value="us">America</option>
                                        <option value="uk">English</option>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="price">price:</label>
                                <input type="text" name="price" id="price" required/>
                        </div>
                        <div class="form-group">
                                <label for="name">Image:</label>
                                <input type="file" name="image_info" id="image_info"accept = ".jpg , .png"  required />
                        </div>
                        <div class="form-submit">
                            <!-- <input type="submit" value="Reset All" class="submit" name="reset" id="reset" /> -->
                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery2/jquery.min.js"></script>
    <script src="js/main3.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>