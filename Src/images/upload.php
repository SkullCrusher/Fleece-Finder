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

	//For the nav bar and cart.
	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	}

	$file_formats = array("jpg", "png", "gif", "bmp");

	$filepath = "upload_images/";

	if ($_POST['submitbtn']=="Submit") {

	 $name = $_FILES['imagefile']['name']; // filename to get file's extension
	 $size = $_FILES['imagefile']['size'];
	 
	 if (strlen($name)) {
		$extension = substr($name, strrpos($name, '.')+1);
		if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
			if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
				$imagename = md5(uniqid() . time()) . "." . $extension;
				$tmp = $_FILES['imagefile']['tmp_name'];
					if (move_uploaded_file($tmp, $filepath . $imagename)) {
						echo '<img class="preview" alt="" src="'.$filepath.'/'. $imagename .'" />';
						echo $_SESSION['user_name'];
					} else {
						echo "Could not move the file.";
					}
			} else {
				echo "Your image size is bigger than 2MB.";
			}
		} else {
				echo "Invalid file format.";
		}
	 } else {
		echo "Please select image..!";
	 }
	 exit();
	}
 
?>