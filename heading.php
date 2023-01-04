
<?php
 error_reporting(0);
 session_start();
?>
<!--Header section start-->
	<head>
		<style type="text/css">
			/*------------------------------------------------------
            Header Section
         -------------------------------------------------------*/
         .top-nav{
          background: var(--orange);
         }
        .logo{
          color: white;
         }
         .header{
            position: relative;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .8rem 2%;
            background: #fff;
            box-shadow: var(--box-shadow);
         }

         .header .logo i{
            color: var(--orange);
         }

         .header .navbar a{
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--black);
         }

         .header .navbar a:hover{
            color: var(--orange);
         }

         .header .navbar-mobile{
            position: absolute;
            top: 110%; left: .2rem;
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
            background: #fff;
         }
         .header .navbar-mobile a{
            font-size: 16px;
            margin-top: 20px;
            display: block;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--black);
         }
         .header .navbar-mobile a:hover{
            color: var(--orange);
         }
          .icon .header-btn{
              width: 100px;
              height: 40px;
              padding: 0;
              margin-top: 3px;
               margin-left: 8px;
              border: none;
              border-radius: .5rem;
            background: #eee;
              transition: ease-out .2s;
              font-size: 14px;
          }
          .icon .header-btn:hover{
            background: var(--orange);
            color: #fff;
         }
          .icon .row div {
            width: 40px;
            height: 40px;
             padding: 12px;
             margin-top: 2px;
             border-radius: .5rem;
             background: #eee;
             margin-left: 8px;
             cursor: pointer;
             transition: ease-out .2s;
             color: var(--black);
             font-size: 16px;
             text-align: center;
         }
          .icon .row div:hover{
            color: white;
               background: var(--orange);
         }
         #menu-btn{
            display: none;
         }
         .btn{
            display: inline-block;
            padding: .5rem 2rem;
            font-size: 16px;
            font-weight: 600;
            border-radius: .5rem;
            border: .1rem solid var(--black);
            color: var(--black);
            cursor: pointer;
         }
         .btn:hover{
            color: #fff;
            background: var(--orange);
         }
         .search-container input{
            height: 2rem;
            border: none;
            border-radius: .5rem;
         }
         .search-container button{
            border-radius: .5rem;
            border: none;
            height: 2rem;
            width: 2rem;
         }
         .search-container button i{
            position: relative;
            right: 5px;
         }
         .search-form{
            position: relative;
            right: -2rem;
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
            right: 33%;
            top: 4rem;
            transition: .4s linear;

         }
          .search-form input{
            height: 100%;
            width: 100%;
            background: none;
            border: none;
            text-transform: none;
            font-size: 14px;
            color: var(--black);
            padding: 0 1.5rem;
         }
          .search-form label{
            font-size: 16px;
            padding-right: 10px;
            color: var(--black);
            margin: 0;
            cursor: pointer;
         }
          .search-form label:hover{
            color: var(--orange);
         }
         .header .shopping-cart{
            height: 600px;
            overflow-y: scroll;
            position: absolute;
            top: 110%; right: -110%;
            padding: 1rem;
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
            background: #fff;
         }
         .header .shopping-cart.active{
            right: 0rem;
            transform: .4s linear;
         }
         .header .shopping-cart .box{
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            margin: 1rem 0;
         }
         .header .shopping-cart .box img{
            width: 7rem;
            height: 7rem;
         }
         .header .shopping-cart .box .fa-trash{
            font-size: 18px;
            position: absolute;
            top: 50%; right: 2rem;
            cursor: pointer;
            color: var(--light-color);
            transform: translateY(-50%);
         }
         .header .shopping-cart .box .fa-trash:hover{
            color: var(--orange);
         }
         .header .shopping-cart .box .content h5{
            font-size: 17px;
            font-weight: 600;
            color: var(--black);
         }
         .header .shopping-cart .box .content .quantity{
            padding-left: 1rem;
         }
         .header .shopping-cart .total{
            font-size: 22px;
            padding: 1rem 0;
            align-content: center;
            color: var(--black);
         }
         .header .login-form{
            opacity: 0;
            position: absolute;
            top: 110%; right: -110%;
            box-shadow: var(--box-shadow);
            padding: 1rem;
            border-radius: .5rem;
            background: #fff;
            text-align: center;
         }
         .header .login-form.active{
            opacity: 1;
            right: .3rem;
         }
         .header .login-form .input{
            margin: .7rem 0;
            background: none;
            font-size: 16px;
            border-right: none;
             border-left: none;
             border-top: none;
             border-bottom-color: silver;
         }
         .header .login-form .input:hover{
            border-bottom-color: orange;
         }
         .header .login-form .input:focus{
            outline: none;
         }
         .header .login-form p{
            color: var(--light-color);
            font-size: 13px;
            font-weight: 400;
         }
         .header .login-form p a{
            text-decoration: none;
            color: var(--orange);
         }
         .header .navbar-mobile{
            opacity: 0;
            position: absolute;
            top: 110%; left: -110%;
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
            background: #fff;
         }
         .header .navbar-mobile.active{
            left: .3rem;
            opacity: 1;
         }
         .header .navbar-mobile a{
            font-size: 16px;
            margin-top: 20px;
            display: block;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--black);
         }
         .header .navbar-mobile a:hover{
            color: var(--orange);
         }
		</style>
	</head>
	<body>

		
		<!--NAVIGATION BAR_1--->
    <nav class="navbar top-nav col-12"> 
         <div class="col-lg-3 col-md-6">
            <h1 class="logo" style="font-family: 'Dancing Script', cursive;">Art Heart</h1>
         </div>  

         <div class="search-container col-lg-6 d-none d-lg-block">
             <form action="/action_page.php">
               <input class="col-lg-10" type="text" placeholder="Search.." name="search">
               <button class="col-lg-1 " type="submit"><i class="fa fa-search"></i></button>
             </form>
         </div>
      
         <div class="icon col-lg-3 col-md-6 col-sm-9">
            <div class="row justify-content-center">
               <div class="fas fa-bars d-block d-lg-none " id="menu-btn"></div>
               <div class="fas fa-search d-block d-lg-none" id="search-btn"></div>
               <?php if (isset($_SESSION['username'])) { $id = $_SESSION['username'];?>
                  <button class="btn header-btn" id="cart-btn" onclick="window.location.href='cart.php'" style="width: 44px;">
                     <i class="fas fa-shopping-cart"></i>
                  </button>
                  <button class="btn header-btn" id="profile-btn" onclick="window.location.href='profile.php'">
                     <i class="fas fa-user"></i> Profile
                  </button>
                  <button class="btn header-btn" id="logout-btn" onclick="window.location.href='logout.php'">
                     <i class="fas fa-power-off"></i> Logout
                  </button>
               <?php } else {?>
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
      <header class="header">
         <!--Navbar-->
         <div class="col-3"></div>
         <div class="col-6 d-none d-lg-block p-0">
            <nav class="navbar ml-2 p-0">
               <a class="col-2 p-0" href="index.php"><center>Home</center></a>
               <a class="col-2 p-0" href="index.php#features"><center>Features</center></a>
               <a class="col-2 p-0" href="index.php#categories"><center>Categories</center></a>
               <a class="col-2 p-0" href="index.php#products"><center>Products</center></a>
               <a class="col-2 p-0" href="index.php#About"><center>About</center></a>
            </nav>
         </div>
         <div class="col-3"></div>

         <div class="navbar-mobile col-12 d-block d-lg-none">
            <a class="col-2 mt-2" href="index.php"><center>Home</center></a>
            <a class="col-2" href="index.php#features"><center>Features</center></a>
            <a class="col-2" href="index.php#categories"><center>Categories</center></a>
            <a class="col-2" href="index.php#products"><center>Products</center></a>
            <a class="col-2 mb-2" href="index.php#About"><center>About</center></a>
         </div>

         <form action="" class="search-form justify-content-center col-12 d-block d-lg-none">
            <input type="search" id="search-box" placeholder="Search ">
            <label for="search-box" class="fas fa-search"></label>
         </form>   


          <!--Alert start-->
         <?php if ($_GET['error'] == 'You are not logged in') { ?>
                  <div class="alert cart-alert show">
                     <span class="fas fa-exclamation-circle"></span>
                     <span class="msg"><?=$_GET['error']?></span>
                     <span class="close-btn" id="close-btn">
                        <span class="fas fa-times"></span>
                     </span>
                  </div>          
         <?php } ?>

         <?php if ($_GET['error'] == 'Product deleted!') { ?>
                  <div class="alert cart-alert show">
                     <span class="fas fa-exclamation-circle"></span>
                     <span class="msg"><?=$_GET['error']?></span>
                     <span class="close-btn" id="close-btn">
                        <span class="fas fa-times"></span>
                     </span>
                  </div>          
         <?php } ?>
        <!--Alert End-->

      <!--Header section end-->  




      <script type="text/javascript">

         let searchForm = document.querySelector('.search-form');
            document.querySelector('#search-btn').onclick = () =>{
            searchForm.classList.toggle('active');
            shoppingCart.classList.remove('active');
            loginForm.classList.remove('active');
            navBar.classList.remove('active');
            }

         let navBar = document.querySelector('.navbar-mobile');
            document.querySelector('#menu-btn').onclick = () =>{
            navBar.classList.toggle('active');
            shoppingCart.classList.remove('active');
            searchForm.classList.remove('active');
            loginForm.classList.remove('active');
            }
      </script>

      <script type="text/javascript">
         let alert = document.querySelector('.alert');
            
            document.querySelector('#close-btn').onclick = () =>{
            alert.classList.toggle('hide');
            alert.classList.remove('show');
            }

      </script>
   </header>

