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

	if(strlen($_GET['i']) > 0 || strlen($_GET['i']) < 150){
		
		//For the nav bar and cart.
		if ($login->isUserLoggedIn() == true) {
		
			//Make the folder for it if it is missing.
			if ( !file_exists("..\\images\\upload_images\\" . $_SESSION['user_name']) ) {
				mkdir ("..\\images\\upload_images\\" . $_SESSION['user_name'], 0744);
			}
		   
			$_GET['i'] = preg_replace("/[^A-Za-z0-9]/", '',  $_GET['i']);			
			$myFile = "..\\images\\upload_images\\" . $_SESSION['user_name'] . '\\' . $_GET['i'];		
			
			$result = glob ($myFile . ".*");
			
			$myFile = current($result);
			
			unlink($myFile);		 
		}else{
			die();
		}
	}
	die(); 
?>