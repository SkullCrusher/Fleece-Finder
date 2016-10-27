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
	if(strlen($_GET['error']) > 0){
		
		//product_profile.php (Bad get headers.)
		if($_GET['error'] == 1){
			$Error_Reason = "Sorry!, unable to find the requested product. If you are using bookmarks check to insure the product is still active.";
		}
		
		if($_GET['error'] == 2){
			$Error_Reason = "You are unable to edit a review something you have not reviewed.";
		}
		
		if($_GET['error'] == 3){
			$Error_Reason = "You are unable to edit a review something you have not reviewed.";
		}
		
		if($_GET['error'] == 4){
			$Error_Reason = "The administrator has suspended this account from rating/editing products please contact support if you believe this is a mistake.";
		}
	
		if($_GET['error'] == 17){
			$Error_Reason = "OH NO SQL ERR0RS HAVE 0CC0URED PLEAS7 ndon' Accue\$s Page - The Administration.";
		}
		//profile.php error
		if($_GET['error'] == 18){
		$Error_Reason = "A internal server error has occurred, please wait 30 seconds and try again. If this problem continues please contact support.";
		}
		
		if($_GET['error'] == 100){
			$Error_Reason = "You must be logged in to do that!";
		}
		
	}	
	
?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

	<style>

	p {
	  font-size: 2em;
	  text-align: center;
	  font-weight: 25;
	}

	h1 {
	  text-align: center;
	  font-size: 15em;
	  font-weight: 100;
	}
	</style>

	<div class="container_12 backgroundwhite">

		<h1>404</h1>
		<p><?php echo $Error_Reason; ?></p>

	</div>



 
<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
