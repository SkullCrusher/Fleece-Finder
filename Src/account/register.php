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
		//include("index.php");
		//die();
	}	
	
	// check for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
		exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
		// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
		// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
		require_once('../libraries/password_compatibility_library.php');
	}
	
	// include the config
	require_once('../config/config.php');

	// include the PHPMailer library
	require_once('../libraries/PHPMailer.php');

	// load the registration class
	require_once('../classes/Registration.php');

	// create the registration object. when this object is created, it will do all registration stuff automatically
	// so this single line handles the entire registration process.
	$registration = new Registration();

?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

   <style type="text/css">
     
        input[type=text],
        input[type=password],
        input[type=submit],
        input[type=email] {
            display: block;
            margin-bottom: 15px;
        }
        input[type=checkbox] {
            margin-bottom: 15px;
        }
    </style>
	
<div class="container_12 backgroundwhite">

	

	<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Register</b></p>
	
	<?php
	// show potential errors / feedback (from registration object)
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo '<div class="register-login-message">' . $error . '</div>';
			}
		}
		if ($registration->messages) {
			foreach ($registration->messages as $message) {
				echo '<div class="register-login-message">' . $message . '</div>';
							
				echo '<a href="../index.php" name="register" class="buynow addtocart" style="margin-top:15px;margin-left:39%;width: 235px;margin-bottom: 15px; margin-top:10px; border-style:none;" value="Return to homepage"/>Return to homepage</a>';
			}
		}
	}
	?>
	
<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
<form method="post" action="register.php" name="registerform">
    <label for="user_name" style="margin-left:38%">Username</label>
    <input id="user_name" type="text" class="textbox" pattern="[_a-zA-Z0-9]{2,64}" name="user_name" required />

    <label for="user_email" style="margin-left:38%">Email</label>
    <input id="user_email" type="email" class="textbox" name="user_email" required />

    <label for="user_password_new" style="margin-left:38%">Password</label>
    <input id="user_password_new" type="password" class="textbox" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat" style="margin-left:38%">Repeat Password</label>
    <input id="user_password_repeat" type="password" class="textbox" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
	
	<div class="g-recaptcha" data-sitekey="6LfWOv8SAAAAAL1_Lk4AMeEL4V7YYDZRNEITuCap" style="margin-left:34.5%"></div>
         
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
	<input type="checkbox" id="user_agree" name="user_agree" value="true" style="margin-left:36.5%"/>
	<label for="user_agree" style="margin-top:10px;text-decoration: none;">I agree to the <a href="../legal/termsandconditions.php" style="text-decoration: none;">terms and conditions</a></label>

    <input type="submit" name="register" value="Register" class="buynow addtocart" style="margin-top:15px;margin-left:39%;width: 200px;margin-bottom: 15px; margin-top:10px; border-style:none;"/>
</form>
<?php } ?>

</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 

