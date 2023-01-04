<?php
session_start();

error_reporting(0);
    
    include('connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $sql = "SELECT * FROM `tbl_login` WHERE username = '$username'";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            header("Location: register.php?error=Username already in use!");
          } else {
                if($password == $cpassword) {
                    
                    $sql = "INSERT INTO tbl_login (username, name, email, password, address, telephone) VALUES ('$username','$name','$email','$password','$address','$telephone')";

                    if ($conn->query($sql) === TRUE){

                        header("Location: register.php?error=Register successful!");

                    } else {
                    
                        header("Location: register.php?error=Register fail!");
                  }

                } else{
                    header("Location: register.php?error=Password is not match!");
                }
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V15</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
        <!--Customer-link-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <style type="text/css">
        .error{
            font-size: 14px;
            padding-top: 20px;
            font-weight: 200;
        }

        .signup-login a{
            color: var(--orange);
        }
        .top-nav{
          background: var(--orange);
        }
        .logo{
          color: white;
        }
    </style>
</head>
<body>
    
    <!--NAVIGATION BAR_1--->
    <nav class="navbar top-nav col-12"> 
      <div class="col-3">
        <h1 class="logo" style="font-family: 'Dancing Script', cursive;">Art Heart</h1>
      </div>  
      <div class="col-4">
        <form action="" class="search-form justify-content-center col-md-12 col-lg-12">
          <input type="search" id="search-box" placeholder="Search ">
          <label for="search-box" class="fas fa-search"></label>
        </form>
      </div>
      <div class="icon col-3">
        <div class="row justify-content-center">
          <div class="fas fa-bars d-block d-lg-none " id="menu-btn"></div>
          <div class="fas fa-search " id="search-btn"></div>
          <?php { ?>
            <button class="btn header-btn" id="login-btn" onclick="window.location.href='login.php'">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <button class="btn header-btn" id="signup-btn" onclick="window.location.href='register.php'">
              <i class="fas fa-sign-in-alt"></i> Sign up
            </button>
          <?php } ?>
        </div>
      </div>
    </nav> 
<!--NAVBAR_1_End--->

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Register
                    </span>
                </div>

                
                <?php 
                    if ($_GET['error'] == 'Register successful!') { ?>
                        <div class="alert alert-success mt-2 mb-2 ml-5 mr-5">
                           <?php echo $_GET['error'];?>
                           <?php header( 'refresh:2;url=login.php'); ?>
                        </div>
                <?php } ?>
                <?php 
                    if ($_GET['error'] == 'Password is not match!') { ?>
                    <div class="alert alert-danger mt-2 mb-2 ml-5 mr-5">
                        <?php echo $_GET['error'];?>
                    </div>
                <?php } ?>

                <form class="login100-form validate-form" style="padding-top: 10px;" method="post" action="">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Enter username" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">name</span>
                        <input class="input100" type="text" name="name" placeholder="Enter name" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Enter email" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Address</span>
                        <input class="input100" type="text" name="address" placeholder="Enter address" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Telephone</span>
                        <input class="input100" type="text" name="telephone" placeholder="Enter telephone" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Confirm password</span>
                        <input class="input100" type="password" name="cpassword" placeholder="Confirm password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input type="submit" name="Submit" class="login100-form-btn" value="Sign up">
                    </div>
                </form>
                <div class="signup-login" style="padding-bottom: 15px;">
                     <center><p>have an account?<a href="login.php"> Login</a></p></center>
                </div>
            </div>
        </div>
    </div>

    <?php

?>

    
<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>