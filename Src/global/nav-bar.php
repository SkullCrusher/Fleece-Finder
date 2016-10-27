<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */

 
 	// include the configure file
	require_once( $_SERVER['DOCUMENT_ROOT'] . '/config/config.php');

	// load the login class
	require_once( $_SERVER['DOCUMENT_ROOT'] . '/classes/Login.php');

	$login = new Login();
	
 
 ?>


<!DOCTYPE html>
<!-- Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved -->
<html>
 <head>
  <title>Debuging</title>
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/normalize.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/960.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/font-awesome.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/theme.css?<?php echo time(); ?>">
  <script type="text/javascript" src="../Assets/Javascript/html5shiv.js?<?php echo time(); ?>"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 </head>
 <body>
  <header class="clearfix">
   <div class="container_12">
    <div class="logo">
     <a href="../index.php"><img src="../Assets/Images/logo.png"></a>
     <div class="search">
      <form action="/search.html" class="search-wrapper cf">
       <input type="text" placeholder="Search here..." required="">
       <button type="submit">Search</button>
      </form>
     </div>
    </div>
   </div>
  </header>
  <div class="bottom-nav">
   <div class="container_12">
    <ul>
   	 <li><a href="../index.php"><i class="fa fa-home"></i></a></li>
   	 <li><a href="#">Browse</a></li>
   	 <li><a href="../products/product_categories.php">Categories</a></li>
   	 <li><a href="#">Most Popular</a></li>
  
	 <?php 	 
	 	if ($login->isUserLoggedIn() == true) {
			echo '<li><a href="../message/inbox.php">Inbox (0)</a></li>';
			echo '<li><a href="../account/profile.php">My account</a></li>';
			echo '<li><a href="../index.php?logout">Logout</a></li>';
		} else {	
			echo '<li><a href="../account/login.php">Login</a></li>';
			echo '<li><a href="../account/register.php">Create an Account</a></li>';
		}	 
	 ?>
	 
	 <li><a href="<?php echo '../cart/cart_checkout.php'; ?>">Cart (<?php 
		$Count = 0;
		foreach ($_SESSION['cart'] as &$value) {	
			$Count++;
		}		
		echo $Count;
	 ?>)
	 
	 </a></li>	 
   	 
    </ul>
   </div>
  </div>
  
   <div class="page-wrap">	
 
 
 