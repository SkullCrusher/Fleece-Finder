<?php

	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	//For the nav bar and cart.
	if ($login->isUserLoggedIn() == true) {

	$path = "../images/upload_images/" . $_SESSION['user_name'] . '/';

	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			if ( !file_exists("..\\images\\upload_images\\" . $_SESSION['user_name']) ) {
				mkdir ("..\\images\\upload_images\\" . $_SESSION['user_name'], 0744);
			}			
		
			//array_values($array)[0]
			//$name = $_FILES['photoimg2']['name'];
			//$size = $_FILES['photoimg2']['size'];
			
						
			$name = current($_FILES)['name'];
			$size = current ($_FILES)['size'];
			
			//Find the number
			$number = key($_FILES)[8];
			
			if(strlen($name)){
			
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats)){
					
				if($size<(2048*1024)){
				
						$vowels = array("-", " ");
				
						$actual_image_name = time().substr(str_replace($vowels, "_", $txt), 5).".".$ext;
						$tmp = current($_FILES)['tmp_name'];
						if(move_uploaded_file($tmp, $path.$actual_image_name)){
														
							echo "<img src='" . "http://www.scriptencryption.com/images/upload_images/" . $_SESSION['user_name'] . '/' . $actual_image_name."'  class='preview'>";
							//sets the hidden value.
							echo '<script>var x = document.getElementById("pic_' . $number .'");x.value = "' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $actual_image_name) .'";</script>';
		
						}else{
							echo "failed";
						}
					}
					else
					echo "Image file size max 1 MB";					
					}
					else
					echo "Invalid file format.";	
			}				
			else
				echo "Please select image..!";
				
			exit;
		}
		
	}
?>