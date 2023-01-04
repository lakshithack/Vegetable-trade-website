<?php 
session_start();

?>
<?php 
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

?>