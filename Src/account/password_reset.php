<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */


	// include the configure file
	require_once('../config/config.php');	
	
	// check for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
		exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
		
		require_once('../libraries/password_compatibility_library.php');
	}

	// load the login class
	require_once('../classes/Login.php');
	
	// include the PHPMailer library
	require_once('../libraries/PHPMailer.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true){
	   	header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}

?>

<?php 

	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite" style="margin-bottom: 10px;">

<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Password Reset</b></p>

<?php if ($login->passwordResetLinkIsValid() == true) { ?>
	<form method="post" action="password_reset.php" name="new_password_form">
		<input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
		<input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

		
		<label for="user_name" style="margin-left:33%">New password</label>
		<input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" class="textbox" name="user_name" style="margin-left: 18px;margin-bottom: 20px"/>


		<label for="user_name" style="margin-left:33%">Repeat password</label>
		<input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" class="textbox" name="user_name" style="margin-bottom: 20px"/>
		
		<input type="submit" name="submit_new_password" value="SUBMIT" class="buynow addtocart" style="margin-top:15px;margin-left:39%;width: 200px;margin-bottom: 15px; margin-top:10px; border-style:none;"/>
	</form>
	<!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
	<?php } else { ?>
	
	<form method="post" action="password_reset.php" style="padding-bottom: 20px;" name="password_reset_form">
	
		<label for="user_name" style="margin-left:33%">Username</label>
		<input id="user_name" type="text"  class="textbox" pattern="[_a-zA-Z0-9]{2,64}" name="user_name" style="margin-bottom: 20px"  required />
		
				
		<div class="g-recaptcha" data-sitekey="6LfWOv8SAAAAAL1_Lk4AMeEL4V7YYDZRNEITuCap" style="margin-left:34.5%"></div>		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		
		<input type="submit" name="request_password_reset" value="Reset Password"  class="buynow addtocart" style="margin-top:15px;margin-left:39%;width: 200px;margin-bottom: 15px; margin-top:10px; border-style:none;"/>
         
		
		
	</form>
	
<?php } ?>

	


</div>

<?php 
	//End of page wrap.
	require_once('global/footer-bar.php');

?>
