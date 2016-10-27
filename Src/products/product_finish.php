<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */


	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	} else {	   
		include("index.php");
		die();
	}
	
	//NOTE THIS SHOULD BE THE RECEIPT ID NOT THE INDEX ID
	if(strlen($_GET['id']) < 1){
		echo "NOPE";
	}
	



?>

Your product has been posted. Your receipt ID is <?php echo $_GET['id']; ?>.

The to view your product click here <a href="#">x-x</a>