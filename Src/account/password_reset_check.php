<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */


	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');
	
	// include the PHPMailer library
	require_once('../libraries/PHPMailer.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true){
	   	header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}

	//echo "DEBUG ONLY";
	//die();
	
?>

<?php 

	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite" style="margin-bottom: 10px;">

<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Success, email has been sent </b></p>

	
	<form method="post" action="password_reset.php" style="padding-bottom: 20px;" name="password_reset_form">
	
		<label for="user_name" style="margin-left:33%">Please check your email for the password reset link.</label>
		
		
		
	</form>	


</div>

<?php 
	//End of page wrap.
	require_once('global/footer-bar.php');

?>
