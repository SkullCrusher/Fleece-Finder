<?php 
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */
?>

<?php 
	
	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
		header("Location: http://www.scriptencryption.com/index.php");
		die();
	}

	require_once('../global/nav-bar.php');	
	//Everything is inside pagewrapper

?>

<div class="container_12 backgroundwhite">

	<div class="login-container">
	<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Login</b></p>

	<form method="post" action="..\index.php" name="loginform">

		<label for="user_name" style="margin-left:38%"><b>Username</b></label>
		<input id="user_name" type="text" class="textbox" name="user_name" style="margin-left:6%" required />
		

		<label for="user_password" style="margin-left:38%"><b>Password</b></label>
		
		<input id="user_password" type="password" class="textbox" name="user_password" style="margin-left:6%" autocomplete="off" required />

		<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" style="margin-left:8%"/>
		<label for="user_rememberme" style="margin-top:10px;">Remember me</label>


		<input type="submit" name="login" class="buynow addtocart" value="Login" style="margin-left:50px;margin-bottom: 10px; margin-top:10px; border-style:none;width:200px;" />
		
	</form>


	<a href="register.php" style="margin-left:3%;color:#3A539B;"><b>Register a new account</b></a><br>
	<a href="password_reset.php" style="margin-left:3%;color:#3A539B;"><b>Forgot password?</b></a>


	</div>
</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
