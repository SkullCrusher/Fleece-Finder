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

	if ($login->isUserLoggedIn() == true) {//echo $_SESSION['user_name'];
	} else {	
		//just for the nav bar and if they click add to cart it forces login.
		header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}

//Functions.		
	
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
	
	//Get the user settings by users account id.
	function FN_User_Check_Settings($ID){

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
			$statement->execute(array(':id' => $ID));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		$result = $statement->fetch();
		
		return json_decode($result['json_settings'], true);
	}
	
	//Get the user settings by users account id.
	function FN_User_Load_Message_Headers($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT packed_json FROM message_header WHERE id = :id');			
		} catch (PDOException $e) {
								
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $ID));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		$result = $statement->fetch();
		
		return json_decode($result['packed_json'], true);
	}
	
	//Set into the user settings by users account id.
	function FN_User_Insert_Message_Headers($ID, $Json){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('UPDATE message_header SET packed_json = :packed_json WHERE id = :id');			
		} catch (PDOException $e) {
								
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':packed_json' => $Json, ':id' => $ID));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		//$result = $statement->fetch();
		
		//return json_decode($result['packed_json'], true);
	}
	
	$Title = "Some Message";
	$From = "support";
	$To = "becca";
	
	$JSON_Message1 = array('id' => 1, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title, 'from' => $From, 'to' => $To);
	$JSON_Message2 = array('id' => 2, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title, 'from' => $From, 'to' => $To);
	$JSON_Message3 = array('id' => 3, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title, 'from' => $From, 'to' => $To);
	$JSON_Message4 = array('id' => 4, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title, 'from' => $From, 'to' => $To);
	
	$JSON_Header = array($JSON_Message1, $JSON_Message2, $JSON_Message3, $JSON_Message4);
	
	$Json_Packed = json_encode($JSON_Header);
	
	echo FN_User_Insert_Message_Headers(FN_User_Get_Id($_SESSION['user_name']), $Json_Packed);
	
	
	function FN_Message_Pack_Headers($ID){
	}
//End of functions.
/*
	$Categorise = null;
	
	$Server_Settings_Results = null;
	
	$Server_Settings_Results = FN_Server_Load_Settings();
	if($Server_Settings_Results == 'Internal_Server_Error' || $Server_Settings_Results == 'Error_Try_Again' || $Server_Settings_Results == null){
		$Error_Details = 'An error has occurred, if the error continues please contact support and provide them with ERR:P1:480.';
		$Error = true;		
	}else{
		//Set the $Categorise.
		$Categorise = $Server_Settings_Results['Categories'];
	}
	
		
	//Global Variables.
	$Error = false;
	$Error_Details = "No Error";
	
	$Sanitize_Problem = false;
	$Sanitize_Problem_Details = "No Problem";
	
	//preg_replace("/[^A-Za-z0-9 ]/", '', $string)	

	//Title (6-300) letters
	if(strlen($_POST['title']) > 80 ||  strlen($_POST['title']) < 6){
		//The title can be no longer then 80 characters long and has to be at least 6.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The title must be between 6 to 80 characters long.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Title = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['title']);		
	}*/
	
	//Load the user information
	$User_ID = FN_User_Get_Id($_SESSION['user_name']);
	
	$Message_Headers = FN_User_Load_Message_Headers($_SESSION['user_name']);
	
	//The user settings.
	$Settings = FN_User_Check_Settings($User_ID);
	
	//If they are blocked redirect
	if($Settings['Banned_From_Messaging'] == 'true'){
		header("Location: http://www.scriptencryption.com/error/404.php?error=5"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}
	
	
	
	if($Error == true){ echo "Error: " . $Error_Details; }
	
	
	
?>

<?php 



	echo $Settings['Banned_From_Messaging'];
	print_r($Json_Packed);
	echo "end";
?>