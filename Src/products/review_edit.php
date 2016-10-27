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
		header('Location: http://www.scriptencryption.com/error/404.php?error=100');
		die();
	}
	
	//FUNCTIONS --
	function FN_Review_Add_New($Product_ID, $Arrays){
				
		//Get the amount in the account of $From_User 				
		$db_from = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
							
		$db_from->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db_from->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
							
					
		$statement_from = null; //The statement				
		$statement_from = $db_from->prepare('START TRANSACTION');				
				
		$statement_from = $db_from->prepare('SELECT json_rating FROM product_rating WHERE id = :id');	
		$statement_from->execute(array(':id' => $Product_ID));
				
		$result_from = $statement_from->fetch();
				
		//We check to see if it is empty or not.				
		$result_json = json_decode($result_from['json_rating']);
			
		$result_json_new = array();
				
		if($result_from == null){
			$result_json_new = $Arrays;					
			$statement_from = $db_from->prepare('INSERT INTO product_rating (id, json_rating) VALUES (:id, :json_rating)');						
		}else{
			$result_json_new = array($result_json, $Arrays);
			$statement_from = $db_from->prepare('UPDATE product_rating SET json_rating=:json_rating WHERE id = :id');
		}					
			
		$statement_from->execute(array(':id' => $Product_ID, ':json_rating' => json_encode($result_json_new)));			
							
		$statement_from = $db_from->prepare('COMMIT');
	}
		
	//Get the id of a user by username
	function FN_User_Get_Id($Username){

	$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	
	$statement = null; //The statement
		
	try {
		$statement = $db->prepare('SELECT user_id FROM users WHERE user_name = :user_name');			
	} catch (PDOException $e) {
			
		//Error code 1146 - unable to find database.
		return 'Internal_Server_Error'; //Error.
	}
		
	try {
		$statement->execute(array(':user_name' => $Username));
	} catch (PDOException $e) {
	
		//Error code 23000 - unable to to create because of duplicate id.
		return 'Error_Try_Again'; //Error.
	}		
	
	$result = $statement->fetch();

	return $result['user_id'];
	}
	
	//Get the settings to see if they are banned from rating.
	function FN_User_Check_Banned_Rating($User_Id){
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_settings FROM users_settings WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $User_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Json_Resultss = json_decode($result['json_settings'], true);
		
		return $Json_Resultss['Banned_From_Rating'];
	
	}
		
	//Get the settings to see if they are banned from rating.
	function FN_Review_Check_Already_Rated($Product_Id, $Username, &$Json){
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_rating FROM product_rating WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Product_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Json_Resultss = json_decode($result['json_rating'], true);		
		
		$Json = $Json_Resultss;
		
		if(array_key_exists('1',$Json_Resultss) == false){
			if($Json_Resultss['username'] == $Username){
				return true;
			}
		
		}else if(sizeof($Json_Resultss) < 1){
			//no information so it must be false
			return false;		
		}else{
			foreach ($Json_Resultss as &$value) {				
				if($value['username'] == $Username){
					return true;
				}
			}
		}
		
		return false;
	
	}
	
	
	function FN_Logging_Review_Edit($Json){
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('INSERT INTO logging_review (username, json_review, time) VALUES (:username, :json_review, :time)');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return false; //Error.
		}
			
		try {
			$statement->execute(array(':username' => $_SESSION['user_name'], ':json_review' => $Json, ':time' => date(DATE_RFC2822)));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return false; //Error.
		}
		return true;
	}
		
	
	
	function FN_Review_Update_Rating($Product_Id, $Username, $Json, $Title, $Description, $Rating){
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
		
		$statement = $db->prepare('START TRANSACTION');	
			
		try {
			$statement = $db->prepare('SELECT json_rating FROM product_rating WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Product_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}
		
		$result = $statement->fetch();
		
		$Json_Resultss = json_decode($result['json_rating'], true);		
				
		if(array_key_exists('1',$Json_Resultss) == false){
			if($Json_Resultss['username'] == $Username){
				//var_dump($Json_Resultss);
				
				$JSON_old = $Json_Resultss;
				
				//Log the old one.
				FN_Logging_Review_Edit(json_encode($JSON_old));
				
				//($Product_Id, $Username, $Json, $Title, $Description, $Rating){
				
				$Json_Resultss['title'] = $Title;
				$Json_Resultss['long_description'] = $Description;
				$Json_Resultss['rating'] = $Rating;
				
				//return true;
			}
		
		}else if(sizeof($Json_Resultss) < 1){
			//no information so it must be false
			//return false;		
		}else{
			foreach ($Json_Resultss as &$value) {				
				if($value['username'] == $Username){
					
					//Logging, we log the change into the database pack with time and json
					$JSON_old = $value;
					
					//Log the old one.
					FN_Logging_Review_Edit(json_encode($JSON_old));
					
					$value['title'] = $Title;
					$value['long_description'] = $Description;
					$value['rating'] = $Rating;		
				}
			}			
		}
		
		//var_dump($Json_Resultss);
		
		//Update it.
		try {
			$statement = $db->prepare('UPDATE product_rating SET json_rating = :json_rating WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Product_Id, ':json_rating' => json_encode($Json_Resultss)));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}
		
		
		
		
		$statement = $db->prepare('COMMIT');		
		
		return false;	
	}
	

	
	
	//END OF FUNCTIONS --
	
	//Global variables. 
	$Sanitize_Problem = false;
	$Sanitize_Problem_Details = "No problem";
	
	//Sanitized values.
	$Sanitized_Rating_Title				= $_POST['title'];
	$Sanitized_Rating_Long_Description 	= $_POST['long_description'];
	$Sanitized_Rating_Star				= $_POST['rating'];
	$Sanitized_Rating_Username 			= null;
	$Sanitized_Rating_Verified_Owner	= null;
	$Sanitized_Rating_Post_Date			= null;
	
	$Json 								= null;
	
	
	//They have to be logged in to rate.
	if ($login->isUserLoggedIn() == true) {
	
		$Sanitized_Rating_Username = $_SESSION['user_name'];
		
		//CHECK IF THE USER IS BANNED FROM POSTING REVIEWS.
		$Banned_From_Rating = FN_User_Check_Banned_Rating(FN_User_Get_Id($_SESSION['user_name']));
		
		$Already_Rated = FN_Review_Check_Already_Rated($_GET['p'], $_SESSION['user_name'], $Json);
		
		if($Banned_From_Rating == 'true' || $Already_Rated == false){
			if($Banned_From_Rating == 'true'){
				//They are not logged in so they can't rate
				$Sanitize_Problem = true;
				//$Sanitize_Problem_Details = "The administrator has suspended this account from rating products please contact support if you believe this is a mistake.";
				header('Location: http://www.scriptencryption.com/error/404.php?error=100');
				die();
			}else{
				//They already rated so block.
				$Sanitize_Problem = true;
				//$Sanitize_Problem_Details = "You have not rated this product so how could you edit it?";
				header('Location: http://www.scriptencryption.com/error/404.php?error=2');
				die();
			}
		}else{	

			//check if they are posting or just loading.
			
			if(strlen($_POST['title']) > 1){
			
				$_POST['title'] = preg_replace("/[^A-Za-z0-9.!? ]/", '', $_POST['title']);
				$_POST['rating'] = preg_replace("/[^0-9.]/", '', $_POST['rating']);
				$_POST['long_description'] = preg_replace("/[^A-Za-z0-9.!? ]/", '', $_POST['long_description']);
				
				$Sanitized_Rating_Title				= $_POST['title'];
				$Sanitized_Rating_Long_Description 	= $_POST['long_description'];
				$Sanitized_Rating_Star				= $_POST['rating'];
			
				if(strlen($_POST['title']) < 6 || strlen($_POST['title']) > 80){
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "The title must be between 6 to 80 characters long.";
				}
				
				if(strlen($_POST['long_description']) < 6 || strlen($_POST['long_description']) > 1000){
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "The description must be between 6 to 1000 characters long.";
				}
				
				if($_POST['rating'] == '0.0' || $_POST['rating'] == '0.5' || $_POST['rating'] == '1.0' || $_POST['rating'] == '1.5' || $_POST['rating'] == '2.0' || $_POST['rating'] == '2.5' || $_POST['rating'] == '3.0' || $_POST['rating'] == '3.5' || $_POST['rating'] == '4.0' || $_POST['rating'] == '4.5' || $_POST['rating'] == '5.0'){
				}else{				
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "Some unknown error has occurred.";
				}			
				
				if($Sanitize_Problem == false){
					FN_Review_Update_Rating($_GET['p'], $_SESSION['user_name'], "kkkk", $_POST['title'], $_POST['long_description'], $_POST['rating']);
					
					header('Location: http://www.scriptencryption.com/products/product_profile.php?p=' . $_GET['p'] . '&u=' . $_GET['u']);
					die();
				}			
			}else{			
				$Sanitized_Rating_Title 			= $Json['title'];
				$Sanitized_Rating_Long_Description 	= $Json['long_description'];
				$Sanitized_Rating_Star				= $Json['rating'];	
			}		
		}
	
	} else {	
		//They are not logged in so they can't rate
		$Sanitize_Problem = true;
		//$Sanitize_Details = "You have to be logged in to edit a rating.";
		header('Location: http://www.scriptencryption.com/error/404.php?error=100');
		die();
	}
		
?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite">

	<?php  if($Sanitize_Problem == true){?>
	<div class="grid_12">
		<p style="text-align:center;font-size: 100%;margin-top:-10px;background-color: #D91E18;"><b><?php echo $Sanitize_Problem_Details; ?></b></p>
	</div>
	<?php } ?>


	<div class="grid_12">
		<p style="text-align:center;font-size: 200%;margin-top:0px;padding-bottom:50px;"><b>Edit your review</b></p>
	</div>

	<form method="post" action="review_edit.php?p=<?php echo $_GET['p'] . '&u=' . $_GET['u']; ?>" id="create_rating_new" name="create_rating_new">
		
		

		<div class="grid_6">
		<label for="title"><b>Title</b></label>
		<input id="title" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" style="width:350px;" name="title" value="<?php echo $Sanitized_Rating_Title; ?>" required /></input>
		</div>
		
		<div class="grid_5">
		
		<select id="rating" name="rating" style="float:right">	
			<option value="0.0" <?php if($Sanitized_Rating_Star == "0.0"){ echo 'selected="selected"'; } ?>>0.0</option>
			<option value="0.5" <?php if($Sanitized_Rating_Star == "0.5"){ echo 'selected="selected"'; } ?>>0.5</option>
			<option value="1.0" <?php if($Sanitized_Rating_Star == "1.0"){ echo 'selected="selected"'; } ?>>1.0</option>
			<option value="1.5" <?php if($Sanitized_Rating_Star == "1.5"){ echo 'selected="selected"'; } ?>>1.5</option>
			<option value="2.0" <?php if($Sanitized_Rating_Star == "2.0"){ echo 'selected="selected"'; } ?>>2.0</option>
			<option value="2.5" <?php if($Sanitized_Rating_Star == "2.5"){ echo 'selected="selected"'; } ?>>2.5</option>
			<option value="3.0" <?php if($Sanitized_Rating_Star == "3.0"){ echo 'selected="selected"'; } ?>>3.0</option>
			<option value="3.5" <?php if($Sanitized_Rating_Star == "3.5"){ echo 'selected="selected"'; } ?>>3.5</option>
			<option value="4.0" <?php if($Sanitized_Rating_Star == "4.0"){ echo 'selected="selected"'; } ?>>4.0</option>
			<option value="4.5" <?php if($Sanitized_Rating_Star == "4.5"){ echo 'selected="selected"'; } ?>>4.5</option>
			<option value="5.0" <?php if($Sanitized_Rating_Star == "5.0"){ echo 'selected="selected"'; } ?>>5.0</option>	
		</select>
		<label for="rating" style="float:right;padding-right:5px;"><b>Rating</b></label>
		</div>
		<br><br>
		
		<div class="grid_12" style="padding-top:15px;">
			<label for="long_description"><b>Long Description</b></label>
			<textarea rows="0" cols="50" id="long_description" name="long_description" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I really liked the product but it seemed to be poorly packaged and got wet during the shipping."><?php echo $Sanitized_Rating_Long_Description; ?></textarea> 
		</div><br>
		

		<div class="grid_12" style="padding-top: 15px;padding-bottom: 15px;"><input type="submit"  class="buynow addtocart" style="border: 0;margin-left:400px;" name="register" value="Submit" />	</div>

	</form>

</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 









