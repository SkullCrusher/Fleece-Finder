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

	//For the nav bar and cart.
	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	}
	
	$Error_Reason = "Unable to full fill the request, sorry!";
	
	//We need both the owner and the product id.
	if(strlen($_GET['error']) > 1){
		
		//product_profile.php (Bad get headers.)
		if($_GET['error'] == 1){
			$Error_Reason = "Sorry!, unable to find the requested product. If you are using bookmarks check to insure the product is still active.";
		}
		
		if($_GET['error'] == 17){
			$Error_Reason = "OH NO SQL ERR0RS HAVE 0CC0URED PLEAS7 ndon' Accue\$s Page - The Administration.";
		}
		
	}	
	
?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

error
<?php echo $Error_Reason; ?>

 
<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
