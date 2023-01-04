<?php
session_start();
error_reporting(0);

if (isset($_POST['Submit'])) {
    include('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `tbl_login` WHERE username = '$username'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
       
            // output data of each row
            while($row = $result->fetch_assoc()) {
                  
                  if ($username == $row['username'] and $password == $row['password']) {
                    header("Location: login.php?error=Login Successful!");
                    $_SESSION['username'] = $username;
                  } else {
                    header("Location: login.php?error=Username or password is incorrect!");
                  }
               
            }
            
      } else {
          header("Location: login.php?error=Username or password is incorrect!");
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
        .navbar{
            background: var(--orange);
        }
        .logo{
          color: white;
        }
    </style>
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Sign In
                    </span>
                </div>

                <?php 
                    if ($_GET['error'] == 'Username or password is incorrect!') { ?>
                        <div class="alert alert-danger mt-2 mb-2 ml-5 mr-5" role="alert">
                           <?=$_GET['error']?>
                        </div>
                <?php } ?>
                <?php 
                    if ($_GET['error'] == 'Login Successful!') { ?>
                        <div class="alert alert-success mt-2 mb-2 ml-5 mr-5" role="alert">
                           <?php echo $_GET['error'];?>
                           <?php header( 'refresh:2;url=index.php'); ?>
                        </div>
                <?php } ?>
                <form class="login100-form validate-form" style="padding-top: 10px;" method="post" action="login.php">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Enter username" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">

                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <input type="submit" name="Submit" class="login100-form-btn" value="Login">
                    </div>
                </form>
                
                <div class="signup-login" style="padding-bottom: 15px;">
                     <center><p>Don't have an account?<a href="register.php"> Sign up</a></p></center>
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