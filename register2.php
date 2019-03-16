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

    $conn = new mysqli($servername, $username, $password, $dbname);
    $name=  $_POST['name'];
    $password= $_POST['passpass'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $contact = $_POST['contact'];
    $preference = $_POST['preference'];

var_dump($name,$password,$email,$address,$contact,$preference);
    $sql = " INSERT INTO athletics_user (username, password, email, address, contact, preference) VALUES ('".$name."','".$password."','".$email."','".$address."','".$contact."','".$preference."')";
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
                    <form method="POST" class="register-form" id="register-form">
                        <h2>student registration form</h2>
                        <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" required/>
                        </div>
                        <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="text" name="passpass" required/>
                        </div>
                        <div class="form-group">
                            <label for="email2">Email :</label>
                            <input type="text" name="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address: </label>
                            <input type="text" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact: </label>
                            <input type="text" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="preference">Preference:</label>
                            <div class="form-select">
                                <select name="preference" size = "2" multiple="multiple">
                                    <option value=""></option>
                                    <option value="foorball">foootball</option>
                                    <option value="pingpong">pingpong</option>
                                    <option value="basketball  ">basketball</option>
                                </select>
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                            <div class="form-select">
                                <input type="radiobox" name = "preference" value="football">
                                <input type="radiobox" name = "preference" value="football">
                            </div>
                        <div class="form-submit">
                            <input type="submit" value="Reset All" class="submit" name="reset" id="reset" />
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