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

  <link rel="stylesheet" type="text/css" href="Assets/theme.css"> 
  
 </head>


  <div class="scontainer" id="welcome">
   <section>
    <h2><b>Let's create something <a href="#contact" id="about">new</a></b></h2>
   </section>
   <div class="arrow-down"></div>
  </div>
  <div class="scontainer">
   <div class="container_12">
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class="fa fa-mobile"></i> About #1</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel..</p>
    </div>
    <div class="grid_4" style="padding-left:20px">
     <h2><b><a href="#about" style="text-decoration:none;color:#06ba8f"><i style="color:#06ba8f" class="fa fa-code"></i></a> About #2</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel..</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class="fa fa-pencil"></i> About #3</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel...</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class="fa fa-graduation-cap"></i> About #4</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel...</p>
    </div>
    <div class="grid_4" style="padding-left:20px">
     <h2><b><i style="color:#06ba8f" class="fa fa-wordpress"></i> About #5</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel..</p>
    </div>
    <div class="grid_4">
     <h2><b><i style="color:#06ba8f" class="fa fa-steam-square"></i> About #6</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiuisat venenatis orci ultricies vel velit massa, at venenatis orci ultricies vel..</p>
    </div>
   </div>
  </div>
  <div class="wcontainer" id="portfolio">
  
  <?php 
	
		$arr = array(1, 2, 3, 4);
		foreach ($arr as &$value) {
			//echo "sdd";
			
			echo '  <div style="padding-top:20px;padding-bottom:50px" class="container_12">   
    <div class="grid_4">
     <a href="projects/tic/index.php"><img class="work" src="Assets/images/tictac.png"></a>
    </div>
    <div class="grid_8">
     <h2 style="border-bottom:3px solid #333333;text-align:center;color:#06ba8f;padding-bottom:1px;margin-top:-12px"><b>Tic Tac Toe</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus nisi, ultrices at tristique sit amet, posuere ut ante. Nullam in enim in velit venenatis fringilla eget nec purus. Sed sodales viverra commodo. Vestibulum nec egestas est. In vestibulum orci vitae scelerisque dictum. Nam erat metus, consectetur nec luctus eu, dictum quis mauris. Vestibulum fermentum velit massa, at venenatis orci ultricies vel..</p>
     <a href="projects/tic/index.php"><div class="checkmeout">Look at this product</div></a>
    </div>
   </div>
   ';
			
			
		}
	
	?>
  
   <div class="container_12">   
    <div class="grid_4">
     <a href="projects/tic/index.php"><img class="work" src="Assets/images/tictac.png"></a>
    </div>
    <div class="grid_8">
     <h2 style="border-bottom:3px solid #333333;text-align:center;color:#06ba8f;padding-bottom:1px;margin-top:-12px"><b>Tic Tac Toe</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus nisi, ultrices at tristique sit amet, posuere ut ante. Nullam in enim in velit venenatis fringilla eget nec purus. Sed sodales viverra commodo. Vestibulum nec egestas est. In vestibulum orci vitae scelerisque dictum. Nam erat metus, consectetur nec luctus eu, dictum quis mauris. Vestibulum fermentum velit massa, at venenatis orci ultricies vel..</p>
     <a href="projects/tic/index.php"><div class="checkmeout">Look at this product</div></a>
    </div>
   </div>
   
   <div style="padding-top:20px" class="container_12">
    <div class="grid_4">
     <a href="garrysmodcloud.com/index.php"><img class="cwork" src="Assets/images/cloud.png"></a>
    </div>
    <div class="grid_8">
     <h2 style="border-bottom:3px solid #333333;text-align:center;color:#06ba8f;padding-bottom:1px"><b>Garrysmod Cloud</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus nisi, ultrices at tristique sit amet, posuere ut ante. Nullam in enim in velit venenatis fringilla eget nec purus. Sed sodales viverra commodo. Vestibulum nec egestas est. In vestibulum orci vitae scelerisque dictum. Nam erat metus, consectetur nec luctus eu, dictum quis mauris. Vestibulum fermentum velit massa, at venenatis orci ultricies vel..</p>
     <a href="http://www.garrysmodcloud.com/index.php"><div class="checkmeout">Look at this product</div></a>
    </div>
   </div>
   <div style="padding-top:20px;padding-bottom:50px" class="container_12">
    <div class="grid_4">
     <a href="#"><img class="cwork" src="Assets/images/church.png"></a>
    </div>
    <div class="grid_8">
     <h2 style="border-bottom:3px solid #333333;text-align:center;color:#06ba8f;padding-bottom:1px"><b>Faith Plus One</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus nisi, ultrices at tristique sit amet, posuere ut ante. Nullam in enim in velit venenatis fringilla eget nec purus. Sed sodales viverra commodo. Vestibulum nec egestas est. In vestibulum orci vitae scelerisque dictum. Nam erat metus, consectetur nec luctus eu, dictum quis mauris. Vestibulum fermentum velit massa, at venenatis orci ultricies vel..</p>
     <a href="#"><div class="checkmeout">Look at this product</div></a>
    </div>
   </div>
	</div>



<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
