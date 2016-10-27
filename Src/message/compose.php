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
	} else {	
		//just for the nav bar and if they click add to cart it forces login.
		header("Location: http://www.scriptencryption.com/account/login.php"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
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
	
		//var_dump($Json);

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
//End of functions.	

	
	
	//debug
		
	/*
	$Title = "SE";
	$From = "support";
	$To = "becca";
	
	$JSON_Message1 = array('id' => 1, 'date' => "July 15, 2013", 'read' => 'false', 'title' => $Title . '1', 'from' => $From, 'to' => $To);
	$JSON_Message2 = array('id' => 2, 'date' => "July 15, 2013", 'read' => 'false', 'title' => $Title . '2', 'from' => $From, 'to' => $To);
	$JSON_Message3 = array('id' => 3, 'date' => "July 15, 2013", 'read' => 'false', 'title' => $Title . '3', 'from' => $From, 'to' => $To);
	$JSON_Message4 = array('id' => 4, 'date' => "July 15, 2013", 'read' => 'false', 'title' => $Title . '4', 'from' => $From, 'to' => $To);
	
	$JSON_Header = array($JSON_Message1, $JSON_Message2, $JSON_Message3, $JSON_Message4);
	
	$Json_Packed = json_encode($JSON_Header);
	
	echo FN_User_Insert_Message_Headers(FN_User_Get_Id($_SESSION['user_name']), $Json_Packed);
	*/
	
	//end of debug
		

	//Load the user information
	$User_ID = FN_User_Get_Id($_SESSION['user_name']);
	
	//The user settings.
	$Settings = FN_User_Check_Settings($User_ID);
	
	//If they are blocked redirect
	if($Settings['Banned_From_Messaging'] == 'true'){
		header("Location: http://www.scriptencryption.com/error/404.php?error=5");
		die();
	}
	
	//$Message_Headers = FN_User_Load_Message_Headers(FN_User_Get_Id($_SESSION['user_name']));
	
	//Message_Title
	if(strlen($_POST['Message_To']) > 0 && strlen($_POST['message_body']) > 0 && strlen($_POST['Message_Title']) > 0){
		
		$Message_Body = preg_replace("/[^A-Za-z0-9 ,.\'\";:~!@#$%^&*()-_]/", '', $_POST['message_body']); //preg_replace("/[^A-Za-z0-9 ,.\'\";:~!@#$%^&*()-_`]/", $_POST['Message_Title'])
		$Message_Title = preg_replace("/[^A-Za-z0-9 ,.\'\";:~!@#$%^&*()-_]/", '', $_POST['Message_Title']);
		$Message_To = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['Message_To']);
		
		$User_Ids = FN_User_Get_Id($Message_To);
				
		if($User_Ids == null){ echo '<script> alert("Unable to find user."); window.location = "compose.php";</script>'; die(); }
		
		if($$User_Ids == 'Internal_Server_Error' || $User_Ids == 'Error_Try_Again'){ echo '<script> alert("Internal error, please try again."); window.location = "compose.php";</script>'; die(); }
		
		if(strlen($Message_Body) < 1){echo '<script> alert("No message after invalid character removal."); window.location = "compose.php";</script>'; die();}
		
		if(strlen($Message_Title) < 1){ echo '<script> alert("No title after invalid character removal."); window.location = "compose.php";</script>'; die(); }
		
	
		if(strlen($Message_Body) > 0 && strlen($Message_Body) < 5000){
				
			//The message body.
			$Message_Body = json_encode(array('body' => $Message_Body, 'from' => $_SESSION['user_name'], 'to' => $Message_To, 'send_date' =>  date('M d, Y g:i a')));
				
			$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
			$statement = null; //The statement
					
			try {
				$statement = $db->prepare('INSERT INTO message_body SET packed_json = :packed_json');			
			} catch (PDOException $e) {
										
				//Error code 1146 - unable to find database.
				return 'Internal_Server_Error'; //Error.
			}
					
			try {
				$statement->execute(array(':packed_json' => $Message_Body));
			} catch (PDOException $e) {				
				//Error code 23000 - unable to to create because of duplicate id.
				return 'Error_Try_Again'; //Error.
			}		
						
			$JSON_Header = array('id' => $db->lastInsertId(), 'date' => date('M d, Y g:i a'), 'read' => 'false', 'title' => $Message_Title, 'from' => $_SESSION['user_name'], 'to' => $Message_To);
				
			$Message_Headers = FN_User_Load_Message_Headers($User_Ids);
				
			if(strlen((string)$Message_Headers) > 0){				
				array_unshift($Message_Headers, $JSON_Header);
			}else{
				$Message_Headers = array($JSON_Header);
			}
				
			$Json_Packed = json_encode($Message_Headers);
				
			FN_User_Insert_Message_Headers($User_Ids, $Json_Packed);
							
			
			echo '<script> alert("Message sent"); window.location = "inbox.php";</script>';
					
		}else{
			echo '<script> alert("Error: Message is too long. Please edit the message to be 1-5000");</script>';
		}
	
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//echo $To_ID;
		
		
		
	}
	 
	
	/*
	
	if(strlen($_POST['Send_Message_Sir']) > 0 ){
			
		if(strlen($_POST['reply_message']) > 0 && strlen($_POST['reply_message']) < 5000){
		
			$User_Ids = FN_User_Get_Id(preg_replace("/[^A-Za-z0-9]/", '', $_POST['reply_to']));
			
			if($User_Ids == "Internal_Server_Error" || $User_Ids == "Error_Try_Again" || $User_Ids == null){
				echo '<script> alert("We are unable to complete this request. Please verify user exists and try again, if the error continues please contact support.");</script>';
			}else{
				//Send the message
				
				//The message body.
				$Message_Body = json_encode(array('body' => preg_replace("/[^A-Za-z0-9 ,.\'\";:~!@#$%^&*()-_`]/", '', $_POST['reply_message']), 'from' => $_SESSION['user_name'], 'to' => preg_replace("/[^A-Za-z0-9]/", '', $_POST['reply_to']), 'send_date' =>  date('M d, Y g:i a')));
				
				$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
				$statement = null; //The statement
					
				try {
					$statement = $db->prepare('INSERT INTO message_body SET packed_json = :packed_json');			
				} catch (PDOException $e) {
										
					//Error code 1146 - unable to find database.
					return 'Internal_Server_Error'; //Error.
				}
					
				try {
					$statement->execute(array(':packed_json' => $Message_Body));
				} catch (PDOException $e) {				
					//Error code 23000 - unable to to create because of duplicate id.
					return 'Error_Try_Again'; //Error.
				}		
						
				$JSON_Header = array('id' => $db->lastInsertId(), 'date' => date('M d, Y g:i a'), 'read' => 'false', 'title' => 'Reply to your message', 'from' => $_SESSION['user_name'], 'to' => $_POST['reply_to']);
				
				$Message_Headers = FN_User_Load_Message_Headers($User_Ids);
				
				if(strlen((string)$Message_Headers) > 0){				
					array_unshift($Message_Headers, $JSON_Header);
				}else{
					$Message_Headers = array($JSON_Header);
				}
				
				$Json_Packed = json_encode($Message_Headers);
				
				FN_User_Insert_Message_Headers($User_Ids, $Json_Packed);
							
			
				echo '<script> alert("Message sent"); window.location = "inbox.php";</script>';
			}			
		}else{
			echo '<script> alert("Error: Message is too long. Please edit the message to be 1-5000");</script>';
		}
	
	}
	*/
	
	
	
	
	//echo json_encode(array('body' => 'body', 'from' => 'username', 'to' => 'becca', 'send_date' => 'July 15, 2013 6:00pm'));
?>


<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

<style>
.reply_button{
	float:right;
	width: 200px;
	height: 50px; 
	background-color: #3A539B; 
	color: #FFF; 
	border-style: none; 
	margin-right: 10px; 
	margin-top: 10px;
	margin-bottom: 10px;
}

.reply_button:hover {	
	background-color: #e54040; 
}
</style>


<div class="container_12 backgroundwhite">

	<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Compose email</b></p>
	<form action="compose.php" method="post">	
		<div class="grid_4">
			<label for="shipping_cost"><b>To (username)</b></label><br>
			<input id="Message_To" class="textbox" type="text" style="width:200px;" name="Message_To" placeholder="support" value="<?php echo $_POST['Message_To']; ?>"  required /></input>
		</div>	
		
		<div class="grid_12">
			<label for="shipping_cost"><b>Title</b></label><br>
			<input id="Message_To" class="textbox" type="text" style="width:600px;"  name="Message_Title" placeholder="Sheep" value="<?php echo $_POST['Message_Title']; ?>"  required /></input>
		</div>	
			
		<div class="grid_12">
			<label for="long_description"><b>Message body</b></label>
			<textarea rows="0" cols="50" id="message_body" name="message_body" value="<?php echo $_POST['message_body']; ?>" class="textbox" style="resize: none;width:938px;height:400px;" placeholder="Ex: I would like to contact you about your sheep."><?php echo $_POST['message_body']; ?></textarea> 
		</div><br>
		
		<input type="submit" value="Send" class="reply_button" >
		
	</form>
	
	<div class="splitter" style="margin-bottom:20px"></div>	
</div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
