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
    require_once('libraries/password_compatibility_library.php');
}

// include the config
require_once('config/config.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

$login = new Login();

if ($login->isUserLoggedIn() == false) {
	header('Location: http://www.scriptencryption.com/account/login.php');
	die();
}

//home page?

?>

<?php 
	
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');	
	//Everything is inside pagewrapper

?>


<div class="container_12 backgroundwhite">


Homepage maybe?

</div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
