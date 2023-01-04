<?php

//check login
function check_login($conn){

	if(isset($_SESSION['username'])){

		$user = $_SESSION['username'];
		$sql = "SELECT * FROM `tbl_login` WHERE username = '$user'";

		$result = $conn->query($sql);
          if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                  
                  $username = $row['username'];
               		return $username;
            }
          }
	} else {
          	$username = '0';
          	return $username;
          }
	//redirect to login
	//	header("Location: login.php");
}

?>