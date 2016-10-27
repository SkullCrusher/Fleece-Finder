<?php 
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */
?>
<?php

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

// load the login class
require_once('../classes/Login.php');

$login = new Login();

if ($login->isUserLoggedIn() == false) {
	//header('Location: http://www.scriptencryption.com/account/login.php');
	//die();
}

//home page?

?>

<?php 
	
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');	
	//Everything is inside pagewrapper
?>

<?php 

	$db_Ratings = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_Ratings->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_Ratings->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
	$statement_Ratings = null; //The statement	
			
	try {
		$statement_Ratings = $db_Ratings->prepare('SELECT termsandconditions FROM server_termsandconditions');			
	} catch (PDOException $e) {	
		header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}
			
	try {
		$statement_Ratings->execute();
	} catch (PDOException $e) {				
		header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
		die();
	}		

	$result_Ratings = $statement_Ratings->fetch();
				
?>



<div class="container_12 backgroundwhite">
	<div class="grid_12" style="padding-top:0px;">
		<label for="long_description"><b>The terms and conditions:</b></label>	
			
			<textarea readonly rows="0" cols="50" id="long_description" name="long_description" type="text" class="textbox" style="resize: none;width:938px;height:500px;"><?php echo $result_Ratings['termsandconditions']; ?></textarea> 
		</div><br>

</div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
