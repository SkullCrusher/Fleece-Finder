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
	
	//for how many emails there are.
	
		//Get the id of a user by username
	function FN_User_Get_Id_nav($Username){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT user_id FROM users WHERE user_name = :user_name');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':user_name' => $Username));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();

		return $result['user_id'];
	}
	
		
	//Get the user settings by users account id.
	function FN_User_Load_Message_Headers_nav($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT packed_json FROM message_header WHERE id = :id');			
		} catch (PDOException $e) {
								
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $ID));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		$result = $statement->fetch();
		
		return json_decode($result['packed_json'], true);
	}
		
	$Message_Counting = FN_User_Load_Message_Headers_nav(FN_User_Get_Id_nav($_SESSION['user_name']));
 
	$Count = 0;
	foreach ($Message_Counting as &$value) {
		
		if($value['read'] == "false"){
			$Count++;
		}
		
	}
	
 
 
 
 
 ?>


<!DOCTYPE html>
<!-- Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved -->
<html>
 <head>
  <title>FleeceFinder | Your number one site for trading everything farm!</title>
  
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="The best place to sell your farm goods.">
  <meta name="author" content="Dwarven Knowledge LLC - All rights reserved.">
  
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/normalize.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/960.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/font-awesome.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/theme.css?<?php echo time(); ?>">
  
  <link rel="shortcut icon" href="Assets/Images/favicon(13).ico" type="image/x-icon">
  <link rel="icon" href="Assets/Images/favicon(13).ico" type="image/x-icon">
  
  <script type="text/javascript" src="../Assets/Javascript/html5shiv.js?<?php echo time(); ?>"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
  
 </head>
 <body>
  <header class="clearfix">
   <div class="container_12">
    <div class="logo">
     <a href="../index.php"><img src="../Assets/Images/logo.png"></a>
     <div class="search">
      <form action="../search/search.php" method="post" class="search-wrapper cf">
       <input type="text" name="nav-search" placeholder="Search here..." required="">
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
   	 <li><a href="../products/product_categories.php">Browse</a></li>
   	 <li><a href="../products/product_categories.php">Most Popular</a></li>
   
	 <?php 	 
	 	if ($login->isUserLoggedIn() == true) {
			echo '<li><a href="../message/inbox.php">Inbox (' . $Count . ')</a></li>';
			echo '<li><a href="../account/profile.php">My account</a></li>';
			echo '<li><a href="../products/product_create.php">Create Product</a></li>';
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
 
 
 