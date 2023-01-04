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

			include('connection.php');

			$sql = "SELECT * from tbl_cart where username = '$user' and p_id = $p_id";
			$result = $conn->query($sql);
			   if ($result->num_rows > 0) {
			      while($row = $result->fetch_assoc()) { 
			      	$pre_quantity =  $row['quantity'] + $quantity;
			      	$subtotal = $price * $pre_quantity;
			      }

			      $sql = "UPDATE tbl_cart SET `quantity`='$pre_quantity', `subtotal` = '$subtotal' WHERE `username`='$user' and p_id = $p_id";
					if ($conn->query($sql) === TRUE) {
				      header("refresh:0.01;url=index.php");           
				   } else {             
				        header("refresh:0.01;url=index.php");        
				        echo $conn->error;
				   } 
			   } else {
					$sql = "INSERT INTO `tbl_cart` VALUES ('$user',$p_id,'$img','$name',$price,$quantity,$subtotal)";
				   if ($conn->query($sql) === TRUE){
				    	echo 'Added Successful!';
				    	header( "refresh:0.01;url=index.php");	
					} else {
					   echo 'fail';
					   echo $conn->error;
					   header( "refresh:2;url=index.php");
						}
				}
		}else {
			header("Location: index.php?error=You are not logged in");
		}
	


		/* Shopping cart session*/
		/*if (isset($_SESSION['username'])){
			if (isset($_SESSION['cart'])) {
				
				$session_array_id = array_column($_SESSION['cart'], 'id');

				if (!in_array($_GET['id'] , $session_array_id)) {

					$session_array = array(
					'id' => $_GET['id'],
					'name' => $_POST['name'],
					'img' => $_POST['img'],
					'price' => $_POST['price'],
					'quantity' => $_POST['quantity'] 

					);

					$_SESSION['cart'][] = $session_array;
				} else{
					echo $_POST['quantity'];
				}
				
			} else{

			$session_array = array(
				'id' => $_GET['id'],
				'name' => $_POST['name'],
				'img' => $_POST['img'],
				'price' => $_POST['price'],
				'quantity' => $_POST['quantity']
			);

			$_SESSION['cart'][] = $session_array;

			}
		}*/
		/*Shopping cart session end*/
	}

	/*Delete product*/
	if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["cart"] as $keys => $value){
                if($value["id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    header("Location: index.php?error=Product deleted!");
                }
            }
        }
    }

	include('connection.php');
	include('function.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Homepage</title>
		<!-- Required meta tags -->
    	<meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
	   <link rel="stylesheet" href="https://fonts.googleapis.com/css">
	   <!--Customer-link-->
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
		 	
	 	<style type="text/css">
	 		.cart-alert{
               background: #ffdb9b;
               padding: 20px 40px;
               min-width: 300px;
               position: absolute;
               right: 0;
               overflow: hidden;
               top: 10px;
               border-radius: 5px;
               border-left: 8px solid #ffa503;
            }
            .show{
               animation: show_slide 1s ease forwards;
            }
            .hide{
               display: none;
            }
            .cart-alert .fa-exclamation-circle{
               position: absolute;
               left: 20px;
               top: 50%;
               transform: translateY(-50%);
               color: #ce8500;
               font-size: 30px;
            }
            .cart-alert .msg{
               padding: 0 20px;
               font-size: 16px;
               color: #ce8500;
            }
            .cart-alert .close-btn{
               position: absolute;
               right: 0px;
               top: 50%;
               transform: translateY(-50%);
               background: #ffd080;
               padding: 20px 18px;
               cursor: pointer;
            }
            .cart-alert .close-btn:hover{
               background: #ffc766;
            }
            .cart-alert .close-btn .fa-times{
               color: #ce8500;
               font-size: 22px;
               line-height: 40px;
            }

            @keyframes show_slide{
               0%{
                  transform: translateX(100%);
               }
               40%{
                  transform: translateX(10%);
               }
               80%{
                  transform: translateX(0%);
               }
               100%{
                  transform: translateX(-2%);
               }
            }

         .top-nav{
          background: var(--orange);
        }
        .logo{
          color: white;
        }

        .search-form{
            position: relative;
            right: -2rem;
            top: 4rem;
            opacity: 0;
            height: 2.5rem;
            background: #fff;
            border-radius: .5rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            box-shadow: var(--box-shadow);
         }
         .search-form.active{
            opacity: 1;
            right: 35rem;
            top: 4rem;
            transition: .4s linear;

         }
	 	</style>
	</head>
	<body>

		<!--Header section start-->

		<?php include('heading.php');?>

		<!--Header section End-->

		
		<!--Home section start-->

		<section class="home col-12" id="home">
			<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">
              	<!--Item-->
                <div class="carousel-item active">
                	<img class="d-block w-100 img-fluid" src="img/banner-bg.webp" alt="First slide" >
                	<div class="carousel-caption content">
						<h3>Fresh and <span>Organic</span> product for you!</h3>
						<a href="" class="btn mt-4">Shop now</a>
					</div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
			</section>

		<!--Home section end-->

		<!--Features section start-->

			<section class="features" id="features">
				<h1 class="heading">Our<span> Features</span></h1>

				<div class="box-container ">
					<div class="row justify-content-center">
						<div class="box col-lg-3 col-md-9 mt-3">
							<center>
								<img src="img/feature-img-1.png">
								<h3>Fresh & Organic</h3>
							</center>
						</div>
						<div class="box col-lg-3 col-md-9 mt-3">
							<center>
									<img src="img/feature-img-2.png">
									<h3>Free Delivery</h3>
								</center>
						</div>
						<div class="box col-lg-3 col-md-9 mt-3">
							<center>
									<img src="img/feature-img-3.png">
									<h3>Easy Payment</h3>
								</center>
						</div>
					</div>
			</section>

		<!--Features section end-->
		
		<!--Categories section start-->

			<section class="categories" id="categories">
				<h1 class="heading">Product<span> Categories</span></h1>
				<div class="box-container m-3">
					<?php
						$sql = "SELECT * FROM `tbl_category` ORDER BY id ASC";
		          	$result = $conn->query($sql);

		          	if ($result):
		            	if ($result->num_rows > 0):
			              // output data of each row
			              while($row = $result->fetch_assoc()):
      			?>
      			<div class="box p-2">
						<center>
							<img src="<?php echo "img/".$row['img']; ?>">
							<h3><?php echo $row['name']; ?></h3>
							<p>Upto <span>20%</span> off!</p>
							<a href="<?php echo $row['name'].'.php'; ?>" class="btn mb-2">Shop Now</a>
						</center>
					</div>
					<?php     
		            endwhile;
		          endif;
		        endif;
      			?>
				</div>
			</section>

		<!--Categories section end-->
					
		<!--Product section start-->

			<section class="products" id="products">
				<h1 class="heading">Our<span> Products</span></h1>
				<!--Fruits-->
				<div class="swiper product-slider ml-3 mr-3">
					<h4 >Fruits:</h4>
					<div class="swiper-wrapper">
						<?php 
							$sql = "SELECT * FROM `tbl_product` WHERE `category` = 1";
		               $result = $conn->query($sql);
		               if ($result->num_rows > 0) {
		               	while($row = $result->fetch_assoc()) {
	            	?>
	      			<div class="swiper-slide box">
	      				<form method="post" action="index.php?id=<?=$row['id'] ?>">
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
								} 
							}
						?>
					</div>
					<center><a href="fruit.php" class="btn mt-4 mb-5">View more</a></center>
				</div>

				<!--Vegetables-->
				<div class="swiper product-slider ml-3 mr-3">
					<h4>Vegetables:</h4>
					<div class="swiper-wrapper">
						<?php 
							$sql = "SELECT * FROM `tbl_product` WHERE `category` = 2";
		               $result = $conn->query($sql);
		               if ($result->num_rows > 0) {
		               	while($row = $result->fetch_assoc()) {
	            	?>
	      			<div class="swiper-slide box">
	      				<form method="post" action="index.php?id=<?=$row['id'] ?>">
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
								} 
							}
						?>
					</div>
					<center><a href="vegetable.php" class="btn mt-4 mb-5">View more</a></center>
				</div>

				<!--Spices-->
				<div class="swiper product-slider ml-3 mr-3">
					<h4>Spices:</h4>
					<div class="swiper-wrapper">
						<?php 
							$sql = "SELECT * FROM `tbl_product` WHERE `category` = 3";
		               $result = $conn->query($sql);
		               if ($result->num_rows > 0) {
		               	while($row = $result->fetch_assoc()) {
	            	?>
	      			<div class="swiper-slide box">
	      				<form method="post" action="index.php?id=<?=$row['id'] ?>">
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
								} 
							}
						?>
					</div>
					<center><a href="spice.php" class="btn mt-4 mb-5">View more</a></center>
				</div>

				<!--School Supplies-->
				<div class="swiper product-slider ml-3 mr-3">
					<h4>School Supplies:</h4>
					<div class="swiper-wrapper">
						<?php 
							$sql = "SELECT * FROM `tbl_product` WHERE `category` = 4";
		               $result = $conn->query($sql);
		               if ($result->num_rows > 0) {
		               	while($row = $result->fetch_assoc()) {
	            	?>
	      			<div class="swiper-slide box">
	      				<form method="post" action="index.php?id=<?=$row['id'] ?>">
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
								} 
							}
						?>
					</div>
					<center><a href="school_supplies.php" class="btn mt-4 mb-5">View more</a></center>
				</div>
			</section>

		<!--Product section end-->

		<!--Footer section start-->

		<?php include('footer.php'); ?>

		<!--Footer section end-->


		<script>
			var swiper = new Swiper(".product-slider", {
			    loop:true,
			    spaceBetween: 20,
			    autoplay: {
			        delay: 7500,
			        disableOnInteraction: false,
			    },
			    centeredSlides: true,
			    breakpoints: {
			      0: {
			        slidesPerView: 1,
			      },
			      768: {
			        slidesPerView: 2,
			      },
			      1020: {
			        slidesPerView: 3,
			      },
			    },
			});
		</script>
		<!--Custom-js-file-->
		<script src="js/script.js" type="text/javascript"></script>
	</body>
</html>

