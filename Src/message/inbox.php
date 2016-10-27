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
	
	//Get farm information by id
	function FN_Farm_Information_by_Id($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_farminformation FROM users_farminformation WHERE id = :id');			
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

		return json_decode($result['json_farminformation'], true);
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
	
		//Get the user settings by users account id.
	function FN_User_Load_Message_Body($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT packed_json FROM message_body WHERE id = :id');			
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
	
	//Delete message body by id.
	function FN_User_Delete_Message_Body($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('DELETE FROM message_body WHERE id = :id');			
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

		//$result = $statement->fetch();
		
		//return json_decode($result['packed_json'], true);
	}
	
	
	//debug
		
	/*
	$Title = "SE";
	$From = "support";
	$To = "becca";
	
	$JSON_Message1 = array('id' => 1, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title . '1', 'from' => $From, 'to' => $To);
	$JSON_Message2 = array('id' => 2, 'date' => "July 15, 2013", 'read' => 'false', 'title' => $Title . '2', 'from' => $From, 'to' => $To);
	$JSON_Message3 = array('id' => 3, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title . '3', 'from' => $From, 'to' => $To);
	$JSON_Message4 = array('id' => 4, 'date' => "July 15, 2013", 'read' => 'true', 'title' => $Title . '4', 'from' => $From, 'to' => $To);
	
	$JSON_Header = array($JSON_Message1, $JSON_Message2, $JSON_Message3, $JSON_Message4);
	
	$Json_Packed = json_encode($JSON_Header);
	
	echo FN_User_Insert_Message_Headers(FN_User_Get_Id($_SESSION['user_name']), $Json_Packed);
	*/
	
	//end of debug
		
				
//End of functions.
	
	//Load the user information
	$User_ID = FN_User_Get_Id($_SESSION['user_name']);
	
	$Message_Headers = FN_User_Load_Message_Headers(FN_User_Get_Id($_SESSION['user_name']));
	
	//The user settings.
	$Settings = FN_User_Check_Settings($User_ID);
	
	//If they are blocked redirect
	if($Settings['Banned_From_Messaging'] == 'true'){
		header("Location: http://www.scriptencryption.com/error/404.php?error=5"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}
	
	if(strlen($_POST['Send_Message_Sir']) > 0 ){
			
		if(strlen($_POST['reply_message']) > 0 && strlen($_POST['reply_message']) < 5000){
		
			$User_Ids = FN_User_Get_Id(preg_replace("/[^A-Za-z0-9]/", '', $_POST['reply_to']));
			
			if($User_Ids == "Internal_Server_Error" || $User_Ids == "Error_Try_Again" || $User_Ids == null){
				echo '<script> alert("We are unable to complete this request. Please verify user exists and try again, if the error continues please contact support.");</script>';
			}else{
				//Send the message
				
				//The message body.
				$Message_Body = json_encode(array('body' => $_POST['reply_message'], 'from' => $_SESSION['user_name'], 'to' => preg_replace("/[^A-Za-z0-9]/", '', $_POST['reply_to']), 'send_date' =>  date('M d, Y g:i a')));
				
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
	
	if($Error == true){ echo "Error: " . $Error_Details; }
	
	
	//Delete the message if requested.
	if(strlen($_GET['hc']) > 0){
		$counter = 1;
		
		
		if(base64_encode(sha1((string)json_encode($Message_Headers))) == $_GET['hc']){	
			foreach ($Message_Headers as &$value) {			
					if($_GET['id'] == $counter){
						//var_dump($Message_Headers);
						
						$LOCAL = $Message_Headers;
												
						if(count($LOCAL) == 1){
							$LOCAL = null;
						}else{								
							//echo $counter - 1;
							//unset($LOCAL[$counter - 1]);
							
							$local_count = 0;
							$remake = array();
							foreach ($LOCAL as $value) {							
								if($local_count != $counter - 1){
									array_push($remake, $value);
								}
								$local_count++;
							}
							$LOCAL = $remake;
							//var_dump($remake);
						}
																		
						FN_User_Insert_Message_Headers(FN_User_Get_Id($_SESSION['user_name']), json_encode($LOCAL));			
						
						FN_User_Delete_Message_Body($value['id']);	
						
						echo '<script> window.location = "inbox.php"; </script>';
					}
				$counter++;
			}
		}
	}
	
	
	//echo json_encode(array('body' => 'body', 'from' => 'username', 'to' => 'becca', 'send_date' => 'July 15, 2013 6:00pm'));
?>

<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
* {
  box-sizing: border-box;
}


.clr {
  clear: both;
}

a {
  text-decoration: none;
}

.btn {
  border-radius: 4px;
  padding: 6px 10px;
  text-align: center;
  text-shadow: none;
  color: #fff;
  background: #fff;
}
.btn.btn-primary {
  background: #44c4e7;
}

.container {
  display: flex;
  width: 100%;
  height: 100%;
}

.sidebar {
  width: 250px;
  background: #34393d;
  order: 1;
  flex-flow: column;
  color: #fff;
}
.sidebar a {
  color: #fff;
}
.sidebar h1 {
  font-weight: 400;
  background: #19a0c5;
  line-height: 80px;
  margin: 0;
  padding: 0 30px;
}
.sidebar .main-nav {
  margin: 30px 0;
}
.sidebar .main-nav > ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.sidebar .main-nav > ul > li {
  transition: background-color .3s ease;
}
.sidebar .main-nav > ul > li.active, .sidebar .main-nav > ul > li:hover {
  background: #40464b;
}
.sidebar .main-nav > ul > li > a {
  padding: 20px 30px;
  display: block;
  color: #999;
  font-weight: 700;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}
.sidebar .main-nav > ul > li > .btn {
  display: block;
  color: #fff;
  text-shadow: none;
  margin: 10px 30px;
  padding: 10px;
  font-weight: 400;
}
.sidebar .main-nav > ul > li > ul {
  list-style: none;
  margin: 0;
  padding: 10px 0;
}
.sidebar .main-nav > ul > li > ul.labels {
  border-top: 1px solid #555;
  margin-top: 20px;
}
.sidebar .main-nav > ul > li > ul > li {
  transition: background-color .3s ease;
  padding: 10px 30px;
}
.sidebar .main-nav > ul > li > ul > li.active, .sidebar .main-nav > ul > li > ul > li:hover {
  background: #4b5359;
}
.sidebar .main-nav > ul > li > ul > li .btn {
  font-size: .875rem;
  padding: 5px;
  float: right;
  position: relative;
  top: -4px;
}
.sidebar .main-nav > ul > li > ul > li .label {
  width: 20px;
  height: 20px;
  display: inline-block;
  top: 0;
}
.sidebar .main-nav > ul > li > ul > li a {
  color: #999;
}

.main {
  -webkit-flex: 1;
  order: 2;
  background: #f5f5f5;
}
.main .header {
  background: #44c4e7;
  min-height: 80px;
}
.main .header form {
  padding: 20px;
  display: inline-block;
}
.main .header form input[type="search"] {
  background: #19a0c5;
  border: none;
  border-radius: 3px;
  line-height: 40px;
  width: 500px;
  padding: 0 10px;
  outline: none;
}
.main .header form input[type="search"]::-webkit-input-placeholder {
  color: #fff;
}
.main .header ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.main .header .nav-settings {
  float: right;
  line-height: 80px;
  border-left: 1px solid #1cb3dc;
}
.main .header .nav-settings li {
  display: inline-block;
}
.main .header .nav-settings li:hover {
  background: #2dbde4;
}
.main .header .nav-settings li a {
  padding: 0 20px;
  color: #fff;
  display: inline-block;
}

.messages {
  order: 1;
  width: 400px;
  background: #fff;
  /*border-right: 1px solid #DDD;*/
}
.messages h1 {
  margin: 0;
  padding: 20px;
  font-weight: 400;
  color: #777;
  border-bottom: 1px solid #DDD;
}
.messages form {
  padding: 20px;
  background: #FCFCFC;
}
.messages form input[type="search"] {
  width: 100%;
  border-radius: 4px;
  border: 1px solid #ddd;
  padding: 10px;
  box-sizing: border-box;
  outline: none;
}
.messages .message-list {
  padding: 0;
  margin: 0;
  list-style: none;
  border-bottom: 1px solid #ddd;
}
.messages .message-list li {
  background: #F8F6F4;
  transition: background-color .3s ease;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  border-right: 3px solid #1cb3dc;
  padding: 10px 20px;
  display: flex;
  cursor: pointer;
}
.messages .message-list li input[type="checkbox"] {
  appearance: none;
  cursor: pointer;
  margin: 5px 10px 0 0;
  order: 1;
  width: 15px;
  height: 15px;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 3px;
}
.messages .message-list li input[type="checkbox"]:checked {
  background: #EFEFEF;
}
.messages .message-list li .preview {
  flex: 1;
  order: 2;
}
.messages .message-list li .preview h3 {
  margin: 0;
  font-weight: 400;
  color: #333;
}
.messages .message-list li .preview h3 small {
  float: right;
  color: #AAA;
  font-size: .8125rem;
}
.messages .message-list li .preview p {
  color: #888;
  margin: 5px 0;
}
.messages .message-list li:hover {
  background: #fff;
}
.messages .message-list li.active {
  background: #2ECC71;
  border-right: 3px solid rgba(0, 0, 0, 0.1);
}
.messages .message-list li.active .preview h3, .messages .message-list li.active .preview h3 small, .messages .message-list li.active .preview p {
  color: #fff;
}
.messages .message-list li.new {
  background: #fff;
  border-right: 3px solid #44c4e7;
}

.message {
  -webkit-flex: 1;
  order: 2;
  background: #fff;
}
.message h2 {
  margin: 0;
  padding: 20px 30px;
  font-weight: 400;
}
.message .meta-data {
  margin: 10px 30px;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  line-height: 50px;
  color: #888;
}
.message .meta-data .user {
  color: #3A539B;
}
.message .meta-data img {
  display: inline;
  vertical-align: middle;
  margin-right: 20px;
  border-radius: 3px;
}
.message .meta-data .date {
  float: right;
  color: #aaa;
}
.message .body {
  padding: 20px 30px;
}
.message .action {
  background: #fcfcfc;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  padding: 20px 30px;
}
.message .action .options {
  list-style: none;
  margin: 0;
  padding: 0;
}
.message .action .options li {
  float: left;
}
.message .action .options li:first-child {
  border-right: 1px solid #ddd;
}
.message .action .options li:first-child a {
  padding-left: 0;
}
.message .action .options li a {
  color: #888;
  padding: 0 10px;
}
.message .action .options li a.active {
  color: #333;
}
.message .action .textarea {
  background: #fff;
  padding: 10px;
  border: 1px solid #ddd;
  position: relative;
  margin: 20px 0;
}
.message .action .textarea:before {
  content: '';
  display: block;
  border: 10px solid transparent;
  border-bottom: 10px solid #FFF;
  position: absolute;
  top: -19px;
  left: 25px;
  -webkit-filter: drop-shadow(0 -1px 0 #ddd);
}
.message .action .textarea textarea {
  width: 100%;
  min-height: 300px;
  appearance: none;
  border: none;
  resize: none;
  outline: none;
  margin-bottom: 50px;
}
.message .action .textarea .fileupload {
  background: #FCFCFC;
  border: 1px solid #ddd;
  padding: 10px;
  color: #888;
  justify-content: space-between;
}
.message .action .textarea .fileupload .fileinfo {
  flex: 1;
}
.message .action .textarea .fileupload .progress {
  width: 80%;
  border: 1px solid #ddd;
  background: #fff;
  padding: 2px;
}
.message .action .textarea .fileupload .progress .bar {
  background: #44c4e7;
  width: 65%;
  text-align: right;
  color: #fff;
  padding: 3px;
  font-size: .75rem;
}

</style>

<script>
	//Force the duplication of the data with JavaScript	
	function duplicate() {document.getElementsByName("reply_message")[0].value = document.getElementById("message_to_send").value;}
</script>

<div class="container_12 backgroundwhite" style="padding-top: 0px;">

	<div class="container app">

  <div class="main">   
    <div class="container">
      <div class="messages">
        <h1 style="background-color: #333;color: #FFF;">Inbox <span class="icon icon-arrow-down"></span></h1>
        <form action="" style="background-color: #333"></form>
		<div style="height: 635px; overflow-y: scroll;">
        <ul class="message-list" >
		  
		  	<script>
				function callme(arg){
					window.location.replace("http://www.scriptencryption.com/message/inbox.php?id=" + arg);					
				}
			</script>

         <?php //<?php echo base64_encode (sha1((string)json_encode($value)));
	
			$counter = 1;
			foreach ($Message_Headers as &$value) {
					
				if(strlen($_GET['id']) > 0 && $_GET['id'] == $counter){
					echo '<li class="active">';
				}else{
					if($value['read'] == "false"){
						echo '<li class="new">';
					}else{				
						echo '<li class="">';
					}
				}					
				?>
				
				<a href="inbox.php?id=<?php echo $counter;?>&hc=<?php echo base64_encode (sha1((string)json_encode($Message_Headers)));?>"><img src="http://www.scriptencryption.com/Assets/img/cancel_icon2.png" height="15" width="15" style="border-width: 0px;margin-right: 10px;"></a>
									
					<div class="preview" onclick="callme(<?php echo $counter; ?>)">
						<h3><?php echo ucfirst (substr($value['from'], 0, 30));?> <small><?php echo $value['date'];?></small></h3>
						<p><strong><?php echo substr($value['title'], 0, 30); if(strlen($value['title']) > 30){ echo "...";}?></strong></p>
					</div>
				</li>				
				<?php
				$counter++;
			}			
			?>
        </ul>
		</div>
      </div>
      <section class="message">
	  
		<?php 
			$Value2 = "";
		if(strlen($_GET['id']) >= 1){
			$Value2 = $Message_Headers[$_GET['id'] - 1];

			$Message = FN_User_Load_Message_Body($Value2['id']);
			
			//Load the user information
			$Sender_ID = FN_User_Get_Id($Value2['from']);			
			
			$Farm_Information = FN_Farm_Information_by_Id($Sender_ID);			
			$Farm_Information = $Farm_Information[0];	
			}
		?>
	  
		<div style="height: 800px; overflow-y: scroll;width: 560px;">
        <h2 style="background-color: #333;color: #FFF;border-left: 0px;"><span class="icon icon-star-large"></span> <?php echo ucfirst (substr($Value2['title'], 0, 40));?> <span class="icon icon-reply-large"></span><span class="icon icon-delete-large"></span></h2>
        <div class="meta-data">
          <p>
            <img src="http://www.scriptencryption.com<?php echo $Farm_Information['profile_picture']; ?>" class="avatar" style="height: 40px; width: 40px;" alt="" />
            <span class="user"><?php echo ucfirst($Message['from']);?></span> to <span class="user">me</span>
            <span class="date"><?php echo $Message['send_date'];?></span>
          </p>
        </div>
        <div class="body" style="word-wrap: break-word;">
			<?php echo $Message['body'];?>
        </div>
        <div class="action">
          <ul class="options">
            <li><a class="active">Reply</a></li>    
            <div class="clr"></div>
          </ul>
          <div class="textarea">
            <textarea name="message_to_send" id="message_to_send" onkeyup="duplicate()"></textarea>
          </div>
		  
        </div>
		<div class="send"style="float:right;">
		<form action="inbox.php?id=<?php echo $_GET['id']; ?>" method="post">
		
			<input type="hidden" name="Send_Message_Sir" id="Send_Message_Sir" value="Thanks :)">

			<input type="hidden" name="reply_message" id="reply_message" value="">
			<input type="hidden" name="reply_to" id="reply_to" value="<?php echo $Value2['from']; ?>">
						
			<input type="submit" value="Reply" style="width: 200px;height: 50px; background-color: #3A539B; color: #FFF; border-style: none; margin-right: 10px; margin-top: 10px;">
		</form> 
		
		
		</div>
      </section>
	  </div>
    </div>
  </div>
</div>

	
</div>
<div class="splitter" style="margin-bottom:20px"></div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
