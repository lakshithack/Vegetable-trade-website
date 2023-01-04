
<?php 
	session_start();
	$path='index.php';
	$id = $_GET['id'];

	include('connection.php');
	include('function.php');

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$telephone = $_POST['telephone'];

		//Create Order_id
		$sql = "SELECT `order_id` FROM `tbl_order` ORDER BY `order_id` DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $o_id = $row['order_id']; 
          $order_id = $o_id + 1;
        }
    }elseif (empty($reg_no)) {
      $order_id='100';
    }    

		//Select details from tbl_cart
		$sql = "SELECT * from tbl_cart where username = $id";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$p_id = $row['p_id'];
				$price = $row['price'];
				$quantity = $row['quantity'];
				$subtotal = $row['subtotal'];

				//Insert in to 'tbl_order'
 				$sql = "INSERT INTO tbl_order VALUES ($order_id,'$id',$p_id,'$price','$quantity','$subtotal')";
				if ($conn->query($sql) === TRUE){
				   		//echo "success";
					} else {
					   ////echo 'fail';
					   ////echo $conn->error;
					}
			}
		}

		//Insert User details to tbl_order_user
		$sql = "INSERT INTO tbl_order_user VALUES ($order_id,'$name','$address','$telephone')";
			if ($conn->query($sql) === TRUE){

			} else {
				//echo 'fail';
				//echo $conn->error;
			}

		//Delete checkout products from the cart
		$sql = "DELETE from tbl_cart WHERE username = '$id'";
			if ($conn->query($sql) === TRUE){
				$action = 'success';	
				header("Location: alert.php?action=success&path=$path");
			} else {
				$action = 'fail';
				header("Location: alert.php?action=fail&path=$path");
			}  
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Homepage</title>
		<!-- Required meta tags -->
    	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
  <link rel="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
  <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
	    <!--Customer-link-->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
    	<link rel="stylesheet" type="text/css" href="css/main.css">

		<style type="text/css">
			.container.form{
				background: white;
			}

			/* ---------------------------------------------------
        TAB
    ----------------------------------------------------- */
    /* Style the tab */
    .nav-tabs {
      overflow: hidden;
      /*box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);*/
      border: 0px solid #ccc;
      background-color: white;
    }
    /* Style the buttons inside the tab */
    .nav-tabs button {
      width: 100%;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 16px;
      transition: 0.3s;
      font-size: 17px;
    }
    .nav-tabs .unactive{
      width: 100%;
      background-color: white;
      border-bottom: 3px solid #6ebe80;
    }
    .col-6{
      padding: 0px;
    }
    .nav-tabs span{
        font-size: 17px;
        color: grey;
        margin-right: 5px;
    }
    /* Create an active/current tablink class */
    .nav-tabs .active {
      width: 100%;
      background-color: #a6dfa6;
      color: white;
      border-top: 3px solid #6ebe80;
      border-left: 3px solid #6ebe80;
      border-right: 3px solid #6ebe80;
    }
    #booking .row{
	    margin-right: -21px;
	    margin-left: 19px;
	}


   
		</style>
	</head>
	<body>
			<?php include('heading.php'); ?>
			<!--TABS-->
  		<div class="container mb-3" style="box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);margin-top: 100px;">
      		<div class="d-none d-lg-block">
       			<div class="nav nav-tabs col-12">
          			<div class="col-6">
		            	<button id="1" class="active" data-toggle="tab" href="#order_conform" disabled><span>&#9312;</span>Order Conform</button>
		          	</div>
		          	<div class="col-6">
		            	<button id="2" class="unactive" data-toggle="tab" href="#personal_details" disabled><span>&#9313;</span>Booking</button>
		          	</div>
		        </div>
		    </div>

    
    		<div class="tab-content" style="">
		      		<!--TAB-1 Order Conform-->
		      		<div id="order_conform" class="tab-pane container active" style="background: white; padding-top: 20px; padding-bottom: 10px;">
			<?php  
		    //create total
		    $sql = "SELECT SUM(subtotal) AS total from tbl_cart where username = $id";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
		      while($row = $result->fetch_assoc()) { 
		        $total = $row['total'];
		      }
		    } 

		    $sql = "SELECT * from tbl_cart where username = $id";
		    $result = $conn->query($sql);

		  ?>
      <center>
          <div class="dataTables_wrapper" style="width: 95%; margin-top:2rem; font-size: 1rem">
          <?php if ($result->num_rows > 0) { ?>

            <table id="table" class="display" style="width:100%;">
                  <thead>
                        <tr id="header" style="background: var(--orange); color: white;">
                          
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Subtotal</th>

                        </tr>
                  </thead>
                  <?php while($row = $result->fetch_assoc()) { ?>
                    <tbody>
                      <tr>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['price']; ?></td>
                          <td><?php echo $row['quantity']; ?></td>
                          <td><?php echo $row['subtotal']; ?></td>
                      </tr>
                  <?php } ?>
                       <tr>
                        <td colspan="2"></td>
                        <td><b>Total</b></td>
                        <td><b><?php echo $total; ?></b></td>
                      </tr>
                </tbody>  
          <?php } else {
            echo 'empty!';
          } ?> 
              </table>
            </div>
          </center>
							  <center><input type="submit" name="Submit" class="login100-form-btn mt-1" value="Conform" data-toggle="tab" href="#personal_details" onclick="func1()" style="background:  var(--orange);"></center>
		       			</div>

		       			<!--TAB-2 Booking-->
	      				<div id="personal_details" class="tab-pane container mt-3">
		          		<div class="row">
		             		<div class="container form">
											<form class="login100-form validate-form" method="post" action="checkout.php">
					                <div class="wrap-input100 validate-input m-b-26">
					                    <span class="label-input100">Name</span>
					                    <input class="input100" type="text" name="name" placeholder="Enter name" required>
					                    <span class="focus-input100"></span>
					                </div>
					                <input type="hidden" name="id" value="<?php echo $id; ?>">
					                <div class="wrap-input100 validate-input m-b-26">
					                    <span class="label-input100">Address</span>
					                    <input class="input100" type="text" name="address" placeholder="Enter address" required>
					                    <span class="focus-input100"></span>
					                </div>

					                <div class="wrap-input100 validate-input m-b-26">
					                    <span class="label-input100">Telephone</span>
					                    <input class="input100" type="text" name="telephone" placeholder="Enter telephone" required>
					                    <span class="focus-input100"></span>
					                </div>
					                <div class="container-login100-form-btn">
					                    <input type="submit" name="submit" class="login100-form-btn" value="Checkout" style="background: var(--orange);">
					                </div>
					            </form>
					          </div>
		          		</div>
		      			</div>
	  			</div>
	  		</div>
			

		


<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();
} );
</script>

<!--table row click function--->
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

		<script>
		    function func1()
		    {
		    let order_conform = document.querySelector('#order_conform');
		    let personal_details = document.querySelector('#personal_details');
		    personal_details.classList.toggle('active');
		    order_conform.classList.remove('active');
		    document.getElementById('1').className = "unactive";
		    document.getElementById('2').className = "active";
		    }

		    function func2()
		    {
		    document.getElementById('2').className = "unactive";
		    document.getElementById('3').className = "active";
		    }
	 	</script>
	</body>

</html>