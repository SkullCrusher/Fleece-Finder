<?php

// include the config
require_once('../config/config.php');

/*
// load the login class
require_once('classes/Login.php');

$login = new Login();

if ($login->isUserLoggedIn() == true) {
    include("views/edit.php");
} else {
    include("views/not_logged_in.php");
}
*/


/*
	Create a new product.
		-Check account
			:is banned from posting?
			:does have required funds to post?
		-Sanitize input
			:Does it have javascript or html or links?
			:special characters?
		-Post
			:Add to Product_abbreviated.
			:Add to Product_rating (leave blank).
			:Add to Product_extended.
		-Subtract funds.
			:Check to insure funds were removed
				-Failure to remove
					.Remove product and show error.
				-Successful remove of funds.
					.transfer to admin account
		-Thank you for posting new product
			:Link to the product page.
			:Receipt (Print/email?)
*/


//Check account - (Skipped)

//Sanitize Input - (Skipped)

//Post.

/*

Product_abbreviated
	- title (80 characters)
	- short_description (140 characters)
	- tags
	- compressed rating
	- price :lowest
	- picture url code
	- username	
*/

	$tags = array('breakfast', 'Lunch', 'Dinner');
	$Product_abbreviated = array( 'title' => 'Lucky Charms', 'short_description' => 'A magically delicious breakfast cereal made by General Mills, a 100% American company', 'tags' => $tags, 'price' => '10.21', 'picture' => 'www.scriptencryption.com/pic/11213123.png');

	
	$Product_abbreviated_json = json_encode($Product_abbreviated);
		
	//The insert into the abbreviated functions.
	function FN_Product_Abbreviated_Insert($ID, $JSON){
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	
		$statement = null; //The statement
		
		try {
			$statement = $db->prepare('INSERT INTO product_abbreviated (id, json_condensed) VALUES (:id, :json_condensed)');			
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getMessage(); //Debug
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
		
		try {
			$statement->execute(array('id' => $ID,':json_condensed' => $JSON));
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getCode(); //Debug
			
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
	}
	
	
	//Insert into the abbreviated
	$Abbreviated_result = FN_Product_Abbreviated_Insert(93, $Product_abbreviated_json);
	if($Abbreviated_result == 'Internal_Server_Error' || $Abbreviated_result == 'Error_Try_Again'){
		echo 'Error, problem: ' . $Abbreviated_result;
	}else{
		echo 'No error: :D';
	}
	
/*-----------------------------------------------------------------------
		Product_Extended
			- long_description
			- terms of sale
			- compressed rating
			- pricing
			- quantity of sale	
	*/

	$tags = array('breakfast', 'Lunch', 'Dinner');
	
	$Long_Description = 'Lucky Charms is a cereal brand produced by the General Mills food company of Golden Valley, Minnesota, United States. It first appeared in stores in 1964. The cereal consists of two main components: toasted oat pieces and multi-colored marshmallow shapes, the latter making up over 25 percent of the cereals volume. The label features a leprechaun mascot, Lucky, animated in commercials.';
	$Terms_Of_Sale = 'You have to open a can of whoop ass on everyone you see until you get the shipment.';
	$Compressed_Rating = 3.4;
	$Quantity_For_Sale = 102;
	
	$Product_extended = array( 'long_description' => $Long_Description, 'terms_of_sale' => $Terms_Of_Sale, 'compressed_rating' => $Compressed_Rating, 'quantity' => $Quantity_For_Sale);

	
	$Product_extended_json = json_encode($Product_extended);
		
	//The insert into the extended functions.
	function FN_Product_Extended_Insert($ID, $JSON){
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	
		$statement = null; //The statement
		
		try {
			$statement = $db->prepare('INSERT INTO product_extended (id, json_extended) VALUES (:id, :json_extended)');			
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getMessage(); //Debug
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
		
		try {
			$statement->execute(array('id' => $ID,':json_extended' => $JSON));
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getCode(); //Debug
			
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
	}
	
	
	//Insert into the abbreviated
	$Extended_result = FN_Product_Extended_Insert(93, $Product_extended_json);
	if($Extended_result == 'Internal_Server_Error' || $Extended_result == 'Error_Try_Again'){
		echo 'Error, problem: ' . $Extended_result;
	}else{
		echo 'No error: :D';
	}
	
	
	
	
	

	


/*$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);

		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $db->prepare("SELECT rank FROM userinfomation WHERE username = :name");
		$statement->execute(array(':name' => $_SESSION['user_name']));
		$result = $statement->fetch();
*/

//subtract funds - (Skipped)

//echo json_encode(array(4 => "four", 8 => "eight", 'index' => "eight", 'sdd' => "eight"));

?>
