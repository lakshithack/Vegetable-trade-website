<?php
session_start();
    
    include('connection.php');
    
        $sql = "SELECT * FROM `tbl_login` WHERE username = '$username'";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            header("Location: register.php?error=Username already in use!");
          } else {
                if($password == $cpassword) {
                    
                    $sql = "INSERT INTO tbl_login (username, name, email, password, address, telephone) VALUES ('$username','$name','$email','$password','$address','$telephone')";

                    if ($conn->query($sql) === TRUE){

                        header("Location: register.php?error=Welcome to Art Heart!");

                    } else {
                    
                        header("Location: register.php?error=Register fail!");
                  }

                } else{
                    header("Location: login.php?error=Password is not match!");
                }
            }
    
?>