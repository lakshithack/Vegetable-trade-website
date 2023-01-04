<?php 
session_start();

?>
<?php 
	include('connection.php');

	if (isset($_SESSION['username'])){

      } else {
        header("Location: index.php?error=You are not logged in");
        }
?>