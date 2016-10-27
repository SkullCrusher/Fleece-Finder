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
// Placeholder
?>


 <head>

  <link rel="stylesheet" type="text/css" href="../Assets/theme.css"> 
  
 </head>


  <div class="scontainer" id="welcome">
   <section>
    <h2><b style="color: #333;"><a href="" id="about">The number one place to buy and sell fleece</a></b></h2>
   </section>
   <div class="arrow-down"></div>
  </div>
  <div class="scontainer">
   <div class="container_12">
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f;text-align:center;" class=""></i> Sheep</b></h2>
     <p>There are over 200 breeds of sheep, with a wide variety of softness and color</p>
    </div>
    <div class="grid_4" style="padding-left:20px">
     <h2><b><a href="#about" style="text-decoration:none;color:#06ba8f"><i style="color:#06ba8f" class="fa fa-code"></i></a> Alpaca</b></h2>
     <p>Suri is silky with straight locks while Huacayas have a crimpy dense fleece</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class=""></i> Angora Goat </b></h2>
     <p>Angora fleece is called Mohair and comes in white, black, red and brown</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class=""></i> Raw Fleece</b></h2>
     <p>This is as it comes off of the animal.  It may be skirted.</p>
    </div>
    <div class="grid_4" style="padding-left:20px">
     <h2><b><i style="color:#06ba8f" class=""></i> Finished projects</b></h2>
     <p>from socks, to hats, to shawls and anything made with homespun natural fibers or natural fiber yarns..</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class=""></i> Who are we?</b></h2>
     <p>What is fleece finder? Fleecefinder is a place to connect farmers and small mill owners with hand spinners and knitters with hand spinners.</p>
    </div>
   </div>
  </div>



<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
