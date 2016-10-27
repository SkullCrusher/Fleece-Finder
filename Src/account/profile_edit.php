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
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
		die();
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
	
	$User_Id_Uncleaned = FN_User_Get_Id($_SESSION['user_name']);
			
	if($User_Id_Uncleaned == 'Internal_Server_Error' || $User_Id_Uncleaned == 'Error_Try_Again'){		
				
		header('Location: http://www.scriptencryption.com/error/404.php?error=18');
		die();
	}
	
	function FN_Profile_Load_Information($User_Id, &$Value){
	
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
			$statement->execute(array(':id' => $User_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Value = json_decode($result['json_farminformation'], true);
			
	}
	
	$User_Data = null;
	FN_Profile_Load_Information($User_Id_Uncleaned, $User_Data);
	
	$User_Data = $User_Data[0];
	
	$Profile_Picture = null;
	if(strlen($User_Data['profile_picture']) >= 1){
		$Profile_Picture = $User_Data['profile_picture'];
	}
	if(strlen($_POST['pic_1']) > 0){
	
		$Profile_Picture = substr(preg_replace("/[^a-z0-9._]+/i", "", $_POST['pic_1']), 0, 80);
		
		$myFile_1 = '..\\images\\upload_images\\' . $_SESSION['user_name'] . '\\' . $Profile_Picture;

			
		$result_1 = glob ($myFile_1 . ".*");	
		
		$Profile_Picture = str_replace('..', "", current($result_1));
		$Profile_Picture = str_replace('\\', "//", $Profile_Picture);
		
		//var_dump($myFile_1);
		
		//var_dump($Profile_Picture);
		//die();
	}
	//$Profile_Picture = substr(preg_replace("/[^a-z0-9.]+/i", "", $_POST['']), 0, 1000);
	//limit 80
	$Profile_Name = null;
	if(strlen($User_Data['profile_name']) >= 1){
		$Profile_Name = $User_Data['profile_name'];
	}
	if(strlen($_POST['post']) > 0){
		$Profile_Name = substr(preg_replace("/[^a-z0-9. ]+/i", "", $_POST['profile_name']), 0, 80);
	}
	//limit 500
	$Profile_Short_Description = null;
	if(strlen($User_Data['profile_short_description']) >= 1){
		$Profile_Short_Description = $User_Data['profile_short_description'];
	}
	if(strlen($_POST['post']) > 0){
		$Profile_Short_Description = substr(preg_replace("/[^a-z0-9. ]+/i", "", $_POST['short_description']), 0, 500);
	}
	//limit 5,000
	$Profile_Short_Biography = null;
	if(strlen($User_Data['short_biography']) >= 1){
	 $Profile_Short_Biography = $User_Data['short_biography'];
	}
	if(strlen($_POST['post']) > 0){
		$Profile_Short_Biography = substr(preg_replace("/[^a-z0-9. ]+/i", "", $_POST['short_biography']), 0, 5000);
	}
	//limit 5,000
	$General_terms_of_sale = null;
	if(strlen($User_Data['terms_of_sale']) >= 1){
		$General_terms_of_sale = $User_Data['terms_of_sale'];
	}
	if(strlen($_POST['post']) > 0){
		$General_terms_of_sale = substr(preg_replace("/[^a-z0-9. ]+/i", "", $_POST['general_terms_of_sale']), 0, 5000);
	}
	//limit 15 (0-9 -()
	$Phone_number = null;
	if(strlen($User_Data['phone_number']) >= 1){
		$Phone_number = $User_Data['phone_number'];
	}
	if(strlen($_POST['post']) > 0){
		$Phone_number = substr(preg_replace("/[^0-9- ]+/i", "", $_POST['phonenumber']), 0, 80);
	}
	//limit 255
	$Email = null;
	if(strlen($User_Data['email']) >= 1){
		$Email = $User_Data['email'];
	}
	if(strlen($_POST['post']) > 0){
		$Email = substr(preg_replace("/[^a-z0-9@.]+/i", "", $_POST['email']), 0, 255);
	}
	//limit 255
	$Website = null;
	if(strlen($User_Data['website']) >= 1){
		$Website = $User_Data['website'];
	}
	if(strlen($_POST['post']) > 0){
		$Website = substr(preg_replace("/[^a-z0-9.]+/i", "", $_POST['website']), 0, 255);
	}
	//limit 15 (0-9 -()
	$Mobile_Phone = null;
	if(strlen($User_Data['mobile_phone']) >= 1){
		$Mobile_Phone = $User_Data['mobile_phone'];
	}
	if(strlen($_POST['post']) > 0){
		$Mobile_Phone = substr(preg_replace("/[^0-9-.\(\) ]+/i", "", $_POST['mobile_phone']), 0, 15);
	}
	//limit 1,000
	$Extra_contact_information = null;
	
	if(strlen($User_Data['extra']) >= 1){
		$Extra_contact_information = $User_Data['extra'];
	}
	
	if(strlen($_POST['post']) > 0){
		$Extra_contact_information = substr(preg_replace("/[^a-z0-9.\(\) ]+/i", "", $_POST['extra_contact_information']), 0, 1000);
	}
	$Json_packed_collection = null;
	
		
	function FN_Profile_Update_information($User_Id, $Json){
	
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
			$statement->execute(array(':id' => $User_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Json_Resultss = json_decode($result['json_farminformation'], true);
		
				
		
		//Insert back into the sql
		try {
			if($result == null){
				$statement = $db->prepare('INSERT INTO users_farminformation (id, json_farminformation) VALUES (:id, :json_farminformation)');
				//$Json_Resultss = $Json;
			}else{
				$statement = $db->prepare('UPDATE users_farminformation SET json_farminformation = :json_farminformation WHERE id = :id');
				//array_push ($Json_Resultss, $Json);
			}
			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $User_Id, ':json_farminformation' => json_encode($Json)));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}	
		
		
		//return $Json_Resultss['Banned_From_Rating'];
	
	}
	
	if(strlen($_POST['post']) > 0){
		//It must be a post back so COMPRESS THAT ... JSON!
		
		$Json_packed_collection = array(array('profile_picture' => $Profile_Picture, 'profile_name' => $Profile_Name, 'profile_short_description' => $Profile_Short_Description, 'short_biography' => $Profile_Short_Biography, 'terms_of_sale' => $General_terms_of_sale, 'phone_number' => $Phone_number, 'email' => $Email, 'website' => $Website, 'mobile_phone' => $Mobile_Phone, 'extra' => $Extra_contact_information));
		
		//Packed into Json_packed_collection		
		FN_Profile_Update_information($User_Id_Uncleaned, $Json_packed_collection);
		
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/account/profile.php');
		die();
	}
	
	
	
?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">
		<div class="grid_12">
				<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Edit your profile</b></p>
			</div>
		
		
			<script type="text/javascript" >
			 $(document).ready(function() {		
				$('#photoimg1').live('change', function(){ 
			    $("#preview1").html('');
				$("#preview1").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform1").ajaxForm({
					target: '#preview_1'
				}).submit();
				});
				});

		</script>
			
		<div class="grid_12" style="padding-left: 10px; padding-top:10px;">
			<div style="width:300px">
				<form id="imageform1" method="post" enctype="multipart/form-data" action='../images/ajaximageprofile.php'>
				Upload a new profile image <input type="file" name="photoimg1" id="photoimg1" />
				</form>
				<div id='preview_1' name="img_1" onclick="Delete_Image('1')" style="margin-bottom:1px;" height="300" width="300">
				</div>
			</div>  
		</div>
			
			<form method="post" action="profile_edit.php" id="create_rating_new" name="create_rating_new">

			
						
			<div class="grid_5">
				<label for="profile_name"><b>Current profile picture</b></label>
				<img src="<?php echo 'http://'. $_SERVER["HTTP_HOST"] . $Profile_Picture; ?>" id='currentpicture_1' name="currentpicture_1"  style="margin-bottom:1px;" height="300" width="300"> 					
			</div>
			

			
		
			
			<input type="hidden" name="post" id="post" value="true">
			
			<div class="grid_6">
			<label for="profile_name"><b>Profile name</b></label>	
			<input id="profile_name" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="profile_name" value="<?php echo $Profile_Name; ?>" style="width:350px;" placeholder="Jimmy's farm" required /></input>
			</div>
			
			<div class="grid_6" style="padding-top: 15px;padding-bottom: 10px;">
			<label for="phonenumber"><b>Phone Number</b></label>	
			<input id="phonenumber" type="text" pattern="[ ()a-zA-Z0-9-\(\)]{6,80}" name="phonenumber" value="<?php echo $Phone_number; ?>" style="width:350px;" placeholder="500-500-5000"/></input>
			</div>
			<div class="grid_6" style="padding-top: 10px;padding-bottom: 10px;">
			<label for="email"><b>Email</b></label>	
			<input id="email" type="text" pattern="[ ()a-zA-Z0-9-@.]{6,80}" name="email" value="<?php echo $Email; ?>" style="width:350px;" placeholder="email@domain.com"/></input>
			</div>
			<div class="grid_6" style="padding-top: 10px;padding-bottom: 10px;">
			<label for="website"><b>Website</b></label>	
			<input id="website" type="text" pattern="[ ()a-zA-Z0-9-.]{6,80}" name="website" value="<?php echo $Website; ?>" style="width:350px;" placeholder="www.example.com/user/homepage.html"/></input>
			</div>
			<div class="grid_6" style="padding-top: 10px;padding-bottom: 10px;">
			<label for="mobile_phone"><b>Mobile Phone</b></label>	
			<input id="mobile_phone" type="text" pattern="[ ()a-zA-Z0-9-\(\)]{6,80}" name="mobile_phone" value="<?php echo $Mobile_Phone; ?>" style="width:350px;" placeholder="500-500-5000"/></input>
			</div>		
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="short_description"><b>Short Description</b></label>	
				
				<textarea rows="0" cols="50" id="short_description" name="short_description" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I own a small sheep farm and I produce handmade clothing from my sheep's wool"><?php echo $Profile_Short_Description; ?></textarea> 
			</div><br>			
					
			<div class="grid_12" style="padding-top:15px;">
				<label for="short_biography"><b>Short Biography</b></label>	
				
				<textarea rows="0" cols="50" id="short_biography" name="short_biography" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I own a small sheep farm and I produce handmade clothing from my sheep's wool"><?php echo $Profile_Short_Biography; ?></textarea> 
			</div><br>			
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="general_terms_of_sale"><b>General terms of sale</b></label>					
				<textarea rows="0" cols="50" id="general_terms_of_sale" name="general_terms_of_sale" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: You have to send me a message to tell me what you think of my products."><?php echo $General_terms_of_sale; ?></textarea> 
			</div><br>		
			
				
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="extra_contact_information"><b>Extra contact information</b></label>					
				<textarea rows="0" cols="50" id="extra_contact_information" name="extra_contact_information" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: Please call between 9am - 5 pm"><?php echo $Extra_contact_information; ?></textarea> 
			</div><br>	

			<input type="hidden" name="pic_1" id="pic_1" value="">
			
			<div class="grid_12" style="padding-top: 15px;padding-bottom: 15px;"><input type="submit"  class="buynow addtocart" style="border: 0;margin-left:400px;" name="register" value="UPDATE" /></div>
		</form>
			
				<script type="text/javascript" src="../Assets/Javascript/jquery.min.js"></script>
			<script type="text/javascript" src="../Assets/Javascript/jquery.form.js"></script>
	
		
	
			
		
		</div>	


<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


