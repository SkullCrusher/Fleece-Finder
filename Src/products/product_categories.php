<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */

// include the configure file

	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	} else {	
		//just for the nav bar and if they click add to cart it forces login.
	//	include("index.php");
	//	die();
	}
	


?>

<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
	//<div class="splitter" style="padding: 0px;margin:0px;"></div> //base64_encode(
?>




<style>

.splitter{height:1px; background-color: #BDC3C7;}

.spacer{padding-bottom:10px;}
</style>




<div class="container_12 backgroundwhite">
	
	<a href="<?php echo '../search/search.php?type=cat&type=' . base64_encode('Finished Projects');?>"><img src="http://www.scriptencryption.com/Assets/Categories/CAT1.png" style="border-style: none;margin-bottom: -.7%;margin-top:-2.1%;" width="958"></a>
	<a href="<?php echo '../search/search.php?type=cat&type=' . base64_encode('Processed Fibers');?>"><img src="http://www.scriptencryption.com/Assets/Categories/CAT2.png" style="border-style: none;margin-bottom: -.7%;" width="958"></a>
	<a href="<?php echo '../products/product_categories_processed.php';?>"><img src="http://www.scriptencryption.com/Assets/Categories/CAT3.png" style="border-style: none;margin-bottom: -.7%;" width="958"></a>
	<a href="<?php echo '../products/product_categories_raw.php';?>"><img src="http://www.scriptencryption.com/Assets/Categories/CAT4.png" style="border-style: none;margin-bottom: -.7%;" width="958"></a>

		
	
	
</div>
<div class="spacer"></div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
