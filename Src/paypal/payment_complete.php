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
		//just for the nav bar and if they click add to cart it forces login.
		header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}
 

?>



<?php
	require_once('../global/nav-bar.php');

	//Everything is inside pagewrapper
?>


<?php 

	//Delete the cart information.
	

?>


<div class="container_12 backgroundwhite">
	
	
	
	<?php if($_GET['result'] == 'success'){?>
	
		<div class="grid_12">
		<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Order Complete</b></p>
		</div>
	
		<div style="text-align:center; margin-bottom: 10px;">		
			Your order has been placed and your receipt ID is <b><?php echo $_GET['id']; ?></b>.
			The to review your order <a href="../account/profile.php">click here</a>
		</div>
	
	<?php } ?>
	
	<?php if($_GET['result'] == 'pending'){?>
	
		<div class="grid_12">
		<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Order Pending</b></p>
		</div>
	
		<div style="text-align:center; margin-bottom: 10px;">
			Your order has been put on hold and your receipt ID is <b><?php echo $_GET['id']; ?></b>.
			please go to paypal and allow the payment.
		</div>
	
	<?php } ?>
	
	<?php if($_GET['result'] == 'error'){?>
	
		<div class="grid_12">
		<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Order Error</b></p>
		</div>
	
		<div style="text-align:center; margin-bottom: 10px;">
			There has been some kind of error with the payment, please contact support or try again.
		</div>
	
	<?php } ?>
	
	

</div>

<?php
	//End of page wrap.
	require_once('../global/footer-bar.php');
?>
