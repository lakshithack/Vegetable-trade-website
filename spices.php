<?php
	session_start();

	if (isset($_POST['add_to_cart'])) {

		/*Login error*/
		if (isset($_SESSION['username'])){
			$user = $_SESSION['username'];
			$p_id = $_GET['id'];
			$price = $_POST['price'];
			$name = $_POST['name'];
			$img = $_POST['img'];
			$quantity = $_POST['quantity'];
			$subtotal = $price * $quantity;
			echo $price;
			echo $quantity;
			echo $subtotal;

			include('connection.php');

			$sql = "INSERT INTO `tbl_cart` VALUES ('$user',$p_id,'$img','$name',$price,$quantity,$subtotal)";

		    if ($conn->query($sql) === TRUE){
		    		echo 'Added Successful!';
		    		header( "refresh:0.01;url=index.php");
				
			  } else {
			    	echo 'fail';
			    	echo $conn->error;
			    	header( "refresh:2;url=index.php");
				}

		}else {
			header("Location: index.php?error=You are not logged in");
		}
	}

	include('connection.php');
	include('function.php');
	$username = check_login($conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Spices</title>
		<!-- Required meta tags -->
    	<meta charset="utf-8">
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
		 <style type="text/css">
		 	.cover{
		 		height: 350px;
		 		background: white;
		 	}
		 	.cover .content{
		 		font-size: 25px;
		 		color: var(--black);
		 	}
		 	.cover .carousel {
    			height: 350px;
    		}
		 </style>
	</head>
	<body>

		<!--Header section start-->

		<?php include('heading.php');?>

		<!--Header section End-->

		<!----Home section---->
		<section class="cover col-12 mt-1" id="home">
			<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">
              	<!--Item-->
                <div class="carousel-item active">
                	<img class="d-block w-100 " src="img/category-1.png" style="height: 350px" alt="First slide" >
                </div>
              </div>
      </div>
		</section>
		</div>
			<section class="categories">
				<h1 class="heading d-block d-lg-none">Product<span> Categories</span></h1>
				<div class="box-container m-3 mt-5">
					<?php
						$sql = "SELECT * FROM `tbl_product` WHERE `category` = 3";
			          	$result = $conn->query($sql);

			          	if ($result):
			            	if ($result->num_rows > 0):
				              // output data of each row
				              while($row = $result->fetch_assoc()):
	      			?>
					<div class="swiper-slide box">
      					<form method="post" action="category-1.php?id=<?=$row['id'] ?>">
							<img src="<?php echo "img/".$row['img']; ?>">
							<h4><?php echo $row['name']; ?></h4>
							<div class="price"><?php echo 'Rs.'.$row['price'].'.00'; ?></div>
							<div class="forms">
								<center><input type="text" name="quantity" class="form-control form-data col-6 mt-2 mb-2" placeholder="Quantity" required></center>
								<input class="form-control form-data" type="hidden" name="name" value="<?php echo $row['name']; ?>">
								<input class="form-control form-data" type="hidden" name="img" value="<?php echo $row['img']; ?>">
								<input class="form-control form-data" type="hidden" name="price" value="<?php echo $row['price']; ?>">
							</div>
							<input type="submit" name="add_to_cart" class="btn mb-3" value="Add to cart">
						</form>
					</div>
					<?php     
		            endwhile;
		          endif;
		        endif;
      			?>
				</div>

</section>