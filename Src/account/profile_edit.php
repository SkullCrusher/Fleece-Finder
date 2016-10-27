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
		include("../index.php");
		die();
	}
	
	
	$Profile_Picture = "/Assets/Images/profile_picture.png";
	//limit 80
	$Profile_Name = "Neat cool test farm!";
	//limit 500
	$Profile_Short_Description = "Our farm is a farm who makes Our farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsfarming farmsOur farm is a farm who makes farming f4ffarmsOur farm is a farm who makes 5555ff";
	//limit 5,000
	$Profile_Short_Biography = "ssssss";
	//limit 5,000
	$General_terms_of_sale = "ssss";
	//limit 15 (0-9 -()
	$Phone_number = "000-000-0000";
	//limit 255
	$Email = "email@domain.com";
	//limit 255
	$Website = "www.domain.com";
	//limit 15 (0-9 -()
	$Mobile_Phone = "000-000-0000";
	//limit 1,000
	$Extra_contact_information = "Call between 9pm and  am";

	
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
		
		var_dump($Json_Resultss);
				
		
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
	
	if(strlen($_POST['profile_name']) > 0){
		//It must be a post back so COMPRESS THAT ... JSON!
		
		$Json_packed_collection = array(array('profile_picture' => $Profile_Picture, 'profile_name' => $Profile_Name, 'profile_short_description' => $Profile_Short_Description, 'short_biography' => $Profile_Short_Biography, 'terms_of_sale' => $General_terms_of_sale, 'phone_number' => $Phone_number, 'email' => $Email, 'website' => $Website, 'mobile_phone' => $Mobile_Phone, 'extra' => $Extra_contact_information));
		
		//Packed into Json_packed_collection
		
		echo FN_Profile_Update_information(36, $Json_packed_collection);
		
		//var_dump($Json_packed_collection);
	}
	
	
	
?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">
			
			<form method="post" action="profile_edit.php" id="create_rating_new" name="create_rating_new">

			<div class="grid_6">
				<label for="profile_name"><b>profile picture</b></label>			
			</div>
			
			<div class="grid_6">
			<label for="profile_name"><b>Profile name</b></label>	
			<input id="profile_name" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="profile_name" value="<?php echo $_POST['profile_name']; ?>" style="width:350px;" placeholder="Jimmy's farm" required /></input>
			</div>
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="short_description"><b>Short Description</b></label>	
				
				<textarea rows="0" cols="50" id="short_description" name="short_description" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I own a small sheep farm and I produce handmade clothing from my sheep's wool"><?php echo $_POST['short_description']; ?></textarea> 
			</div><br>			
					
			<div class="grid_12" style="padding-top:15px;">
				<label for="short_description"><b>Short Biography</b></label>	
				
				<textarea rows="0" cols="50" id="short_biography" name="short_biography" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I own a small sheep farm and I produce handmade clothing from my sheep's wool"><?php echo $_POST['short_biography']; ?></textarea> 
			</div><br>			
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="general_terms_of_sale"><b>General terms of sale</b></label>					
				<textarea rows="0" cols="50" id="general_terms_of_sale" name="general_terms_of_sale" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: You have to send me a message to tell me what you think of my products."><?php echo $_POST['general_terms_of_sale']; ?></textarea> 
			</div><br>		
			
			<div class="grid_6" style="padding-top: 5px;padding-bottom: 5px;">
			<label for="phonenumber"><b>Phone Number</b></label>	
			<input id="phonenumber" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="phonenumber" value="<?php echo $_POST['phonenumber']; ?>" style="width:350px;" placeholder="500-500-5000"/></input>
			</div>
			<div class="grid_6" style="padding-top: 5px;padding-bottom: 5px;">
			<label for="email"><b>Email</b></label>	
			<input id="email" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="email" value="<?php echo $_POST['email']; ?>" style="width:350px;" placeholder="email@domain.com"/></input>
			</div>
			<div class="grid_6" style="padding-top: 5px;padding-bottom: 5px;">
			<label for="website"><b>Website</b></label>	
			<input id="website" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="website" value="<?php echo $_POST['website']; ?>" style="width:350px;" placeholder="www.example.com/user/homepage.html"/></input>
			</div>
			<div class="grid_6" style="padding-top: 5px;padding-bottom: 5px;">
			<label for="mobile_phone"><b>Mobile Phone</b></label>	
			<input id="mobile_phone" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="mobile_phone" value="<?php echo $_POST['mobile_phone']; ?>" style="width:350px;" placeholder="500-500-5000"/></input>
			</div>			
			
			<div class="grid_12" style="padding-top:15px;">
				<label for="long_description"><b>Extra contact information</b></label>					
				<textarea rows="0" cols="50" id="extra_contact_information" name="extra_contact_information" type="text" pattern="[ ()a-zA-Z0-9-]{6,1000}"  class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: Please call between 9am - 5 pm"><?php echo $_POST['general_terms_of_sale']; ?></textarea> 
			</div><br>		
			
			<div class="grid_12" style="padding-top: 15px;padding-bottom: 15px;"><input type="submit"  class="buynow addtocart" style="border: 0;margin-left:400px;" name="register" value="Submit" /></div>
		</form>
			
  
		</div>


<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


