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
	//	include("index.php");
	//	die();
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
	function FN_Review_Check_Already_Rated($Product_Id, $Username){
		
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
	

	//die();
	//END OF FUNCTIONS --
	
	//Global variables. 
	$Sanitize_Problem = false;
	$Sanitize_Problem_Details = "No problem";
	
	//Sanitized values.
	$Sanitized_Rating_Title				= null;
	$Sanitized_Rating_Long_Description 	= null;
	$Sanitized_Rating_Star				= null;
	$Sanitized_Rating_Username 			= null;
	$Sanitized_Rating_Verified_Owner	= null;
	$Sanitized_Rating_Post_Date			= null;
	
	
	//They have to be logged in to rate.
	if ($login->isUserLoggedIn() == true) {
		$Sanitized_Rating_Username = $_SESSION['user_name'];
		
		//CHECK IF THE USER IS BANNED FROM POSTING REVIEWS.
		$Banned_From_Rating = FN_User_Check_Banned_Rating(FN_User_Get_Id($_SESSION['user_name']));
		
		$Already_Rated = FN_Review_Check_Already_Rated(114, $_SESSION['user_name']);
		
		if($Banned_From_Rating == 'true' || $Already_Rated == true){
			if($Banned_From_Rating == 'true'){
				//They are not logged in so they can't rate
				$Sanitize_Problem = true;
				$Sanitize_Problem_Details = "The administrator has suspended this account from rating products please contact support if you believe this is a mistake.";
			}else{
				//They already rated so block.
				$Sanitize_Problem = true;
				$Sanitize_Problem_Details = "You have already posted on this product, please edit your previous post or delete it to make a new one.";
			}
		}else{
			
			//Check to see if it just loaded or was posted to.
			if(strlen($_POST['title']) >= 6){
				
				//Title (6-80) letters
				if(strlen($_POST['title']) > 80 ||  strlen($_POST['title']) < 6){
					//The title can be no longer then 80 characters long and has to be at least 6.
					
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "The title must be between 6 to 80 characters long.";
				}else{
					//Replace all non-standard characters.
					$Sanitized_Rating_Title = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['title']);		
				}
				
				//Long Description(6-1000) letters
				if(strlen($_POST['long_description']) > 1000 ||  strlen($_POST['long_description']) < 6){
					//The title can be no longer then 80 characters long and has to be at least 6.
					
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "The title must be between 6 to 80 characters long.";
				}else{
					//Replace all non-standard characters.
					$Sanitized_Rating_Long_Description = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['long_description']);		
				}
				
				//Rating (0-5) stars
				//We need to check to make sure the stars are correct.
				//TO FURTURE SELF I AM SO SORRY ABOUT THIS LINE ;( BUT MY MATH WAS NOT WORKING SO </3
				if($_POST['rating'] == '0.0' || $_POST['rating'] == '0.5' || $_POST['rating'] == '1.0' || $_POST['rating'] == '1.5' || $_POST['rating'] == '2.0' || $_POST['rating'] == '2.5' || $_POST['rating'] == '3.0' || $_POST['rating'] == '3.5' || $_POST['rating'] == '4.0' || $_POST['rating'] == '4.5' || $_POST['rating'] == '5.0') {
					$Sanitized_Rating_Star = $_POST['rating'];		
				}else{
					$Sanitize_Problem = true;
					$Sanitize_Problem_Details = "The unknown error, please refresh the page.";
				}
						
				
				//Set the post date
				$Sanitized_Rating_Post_Date = date('m/d/Y - h:i:s A');
				
				//Check if the purchased the product before.
				$Sanitized_Rating_Verified_Owner = true; //Debugging
				
				if($Sanitize_Problem == false){
				
					//No problems so we add it to the reviews.			
					$New_Review = array('title' => $Sanitized_Rating_Title, 'long_description' => $Sanitized_Rating_Long_Description, 'rating' => $Sanitized_Rating_Star, 'username' => $Sanitized_Rating_Username, 'verified_owner' => $Sanitized_Rating_Verified_Owner, 'post_date' => $Sanitized_Rating_Post_Date);
					
					FN_Review_Add_New(114, $New_Review);

					//ADDED AND COMPLETE ALL THAT.
					echo "ADDED!"; //Debugging
				}else{
					//Display the error
					echo $Sanitize_Problem_Details;
				}
			}
		
		}
	
	} else {	
		//They are not logged in so they can't rate
		$Sanitize_Problem = true;
		$Sanitize_Details = "You have to be logged in to rate a product.";
	}
	
	
	if($Sanitize_Problem == true){
		echo $Sanitize_Problem_Details;
	}

	
?>


<br><br>
-----
create rating
-----
 

<form method="post" action="review_debug.php" id="create_rating_new" name="create_rating_new">

	
	<label for="rating">Rating</label>
	<select id="rating" name="rating">	
		<option value="0.0">0.0</option>
		<option value="0.5">0.5</option>
		<option value="1.0">1.0</option>
		<option value="1.5">1.5</option>
		<option value="2.0">2.0</option>
		<option value="2.5">2.5</option>
		<option value="3.0">3.0</option>
		<option value="3.5">3.5</option>
		<option value="4.0">4.0</option>
		<option value="4.5">4.5</option>
		<option value="5.0">5.0</option>	
	</select>
	<br>
	
	<label for="title">Title</label>	
		<input id="title" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="title" value="<?php echo $_POST['title']; ?>" required /></input>
	<br>
  	
		<label for="long_description">Long Description</label>	
		<input id="long_description" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="long_description" value="<?php echo $_POST['long_description']; ?>" required /></input>
	<br>

  	
    <input type="submit" name="register" value="Submit" />
</form>













