<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */


/*
	Create a new product.
		-Sanitize input
			:Does it have javascript or html or links?
			:special characters?
		-Check account
			:is banned from posting?
			:does have required funds to post?
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

	// include the configure file
	require_once('../config/config.php');

//Functions.
	//The insert into the abbreviated functions.
	function FN_Product_Abbreviated_Insert($JSON){
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	
		$statement = null; //The statement
		
		try {
			$statement = $db->prepare('INSERT INTO product_abbreviated (json_condensed) VALUES (:json_condensed)');			
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getMessage(); //Debug
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
		
		try {
			$statement->execute(array(':json_condensed' => $JSON));
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getCode(); //Debug
			
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		return $db->lastInsertId(); 
	}

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
			$statement->execute(array(':id' => $ID,':json_extended' => $JSON));
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getCode(); //Debug
			
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
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
	
	//Get the funds in a users account by id.
	function FN_User_Check_Balance($ID){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT funds FROM users_funds WHERE id = :id');			
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

		return $result['funds'];
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
	function FN_Server_Load_Settings(){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_server_settings FROM server_settings');			
		} catch (PDOException $e) {
								
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute();
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		$result = $statement->fetch();
		
		return json_decode($result['json_server_settings'], true);
	}
	
	//Subtract the user's credit. (OUTDATED)
	function FN_User_Funds_Update($ID, $Funds){
			
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
					
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
		$statement = null; //The statement
					
		try {
			$statement = $db->prepare('UPDATE users_funds SET funds=:funds WHERE id = :id');			
		} catch (PDOException $e) {
										
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
					
		try {
			$statement->execute(array(':id' => $ID, ':funds' => $Funds));
		} catch (PDOException $e) {
				
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
	}
	
	//Transfers "money" from one party to another - Tested to insure transfer's correctly.	
	//echo FN_User_Transfer_Funds(FN_User_Get_Id('user'), FN_User_Get_Id('payments_fee'), '0.5');		
	function FN_User_Transfer_Funds($From_User_ID, $To_User_ID, $Amount){
				
			//Get the amount in the account of $From_User 				
			$db_from = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
						
			$db_from->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$db_from->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			
			
				
			$statement_from = null; //The statement
			
			$statement_from = $db_from->prepare('START TRANSACTION');
			
			
			$statement_from = $db_from->prepare('SELECT funds FROM users_funds WHERE id = :id');	
			$statement_from->execute(array(':id' => $From_User_ID));
			
			$result_from = $statement_from->fetch();
			
			
			$statement_from = $db_from->prepare('SELECT funds FROM users_funds WHERE id = :id');	
			$statement_from->execute(array(':id' => $To_User_ID));
			
			$result_to = $statement_from->fetch();
						
			$statement_from = $db_from->prepare('UPDATE users_funds SET funds=:funds WHERE id = :id');
			$statement_from->execute(array(':id' => $From_User_ID, ':funds' => $result_from['funds'] - $Amount));			
			
			$statement_from = $db_from->prepare('UPDATE users_funds SET funds=:funds WHERE id = :id');	
			$statement_from->execute(array(':id' => $To_User_ID, ':funds' => $result_to['funds'] + $Amount));		
			
			$statement_from = $db_from->prepare('COMMIT');
			}

	//Add to their products.
	function FN_User_Add_Product($ID, $ProductId){
				//Load the products
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
		$statement = null; //The statement
					
		try {
			$statement = $db->prepare('SELECT json_productids FROM users_products');			
		} catch (PDOException $e) {
										
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
					
		try {
			$statement->execute();
		} catch (PDOException $e) {
				
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		$result = $statement->fetch();
							
		//Each Product is array(product_id, post_date)
		$Product_ids = json_decode($result['json_productids'], true);	
			
		$NewProduct = array('product_id' => $ProductId, 'post_date' => date('m/d/Y'));
					
		if($Product_ids == null){
			$Product_ids = $NewProduct;			
		}else{
			array_push($Product_ids, $NewProduct);
		}
				
		$Json_User_Product = json_encode($Product_ids);
				
		//Subtract the user's credit.			
		$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
							
		$db_update->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db_update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
						
		$statement_update = null; //The statement
							
		try {		
			//if it is null then we have to insert instead of update.
			if($result == null){
				//Insert
				$statement_update = $db_update->prepare('INSERT INTO users_products (id, json_productids) VALUES (:id, :json_productids)');	
			}else{
				//Update
				$statement_update = $db_update->prepare('UPDATE users_products SET json_productids = :json_productids WHERE id = :id');	
			}
		
		} catch (PDOException $e) {
												
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
						
		try {
			$statement_update->execute(array(':id' => $ID, ':json_productids' => $Json_User_Product));
		} catch (PDOException $e) {						
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}					
	}
//End of functions.

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   // include("views/edit.php");
	  // echo $_SESSION['user_name'];
	} else {
	   // include("views/not_logged_in.php");
		include("index.php");
		die();
	}

//Preprocessing
	//Load categorise.
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
//End of Preprocessing
	
		
	//Global Variables.
	$Error = false;
	$Error_Details = "No Error";
	
	$Sanitize_Problem = false;
	$Sanitize_Problem_Details = "No Problem";
	
//Sanitize Input
	$Sanitized_Title = null;
	$Sanitized_Short_Description = null;
	$Sanitized_Quantity = 0;
	$Sanitized_Long_Description = null;
	$Sanitized_Terms_Of_Sale = null;
	$Sanitized_Price = 0.0;
	$Sanitized_Shipping = 0.0;
	$Sanitized_Cost_Multiple = false;
	
	$Sanitized_Category = null;
	
	//shipping_cost_multiple
	//Input

	//Title (6-300) letters
	if(strlen($_POST['title']) > 80 ||  strlen($_POST['title']) < 6){
		//The title can be no longer then 80 characters long and has to be at least 6.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The title must be between 6 to 80 characters long.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Title = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['title']);		
	}
			
	//Short Description (300 letters)
	if(strlen($_POST['short_description']) > 300 ||  strlen($_POST['short_description']) < 12){
		//The title can be no longer then 300 characters long and has to be at least 12.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The short description must be between 12 to 300 characters long.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Short_Description = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['short_description']);		
	}
		
	//Category (it has to match one from the sql database);	
	foreach ($Categorise as &$value) {
		if($value == $_POST['category']){
			$Sanitized_Category = $value;
			break;
		}
	}
	if($Sanitized_Category == null){
		//It was not in the sql database so tell them there was a problem.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "Unable to find category, please select again.";
	}
	
	//Quantity for sale (Max 9999, Min 1)
	if(intval($_POST['quantity_for_sale']) > 9999 ||  intval($_POST['quantity_for_sale']) < 1){
		//The title can be no longer then 300 characters long and has to be at least 12.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The quantity must be between 1 to 9999 units.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Quantity = intval($_POST['quantity_for_sale']);		
	}

	//Long description (0 - 2000);
	if(strlen($_POST['long_description']) > 2000 || strlen($_POST['long_description']) < 0){
		//The title can be no longer then 300 characters long and has to be at least 12.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The long description is a maximum of 2000 characters.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Long_Description = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['long_description']);		
	}
	
	//Terms of sale (0 - 2000)
	if(strlen($_POST['terms_of_sale']) > 2000 || strlen($_POST['terms_of_sale']) < 0){
		//The title can be no longer then 300 characters long and has to be at least 12.
		
		$Sanitize_Problem = true;
		$Sanitize_Details = "The long description is a maximum of 2000 characters.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Terms_Of_Sale = preg_replace("/[^A-Za-z0-9 \-\(\)]/", '', $_POST['terms_of_sale']);		
	}

	//Price ($1.00 to $4,999)
	if(floatval($_POST['price']) > 4999 || floatval($_POST['price']) < 1){
		//The price cannot be more then $4,999	
		$Sanitize_Problem = true;
		$Sanitize_Details = "The price has to between $1.00 and $4,999.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Price = floatval($_POST['price']);		
	}
	
	//Shipping cost per unit (0 - 1,000);
	if(floatval($_POST['shipping_cost']) > 4999 || floatval($_POST['shipping_cost']) < 0){
		//The price cannot be more then $4,999	
		$Sanitize_Problem = true;
		$Sanitize_Details = "The shipping cost has to between $0.00 and $4,999.";
	}else{
		//Replace all non-standard characters.
		$Sanitized_Shipping = floatval($_POST['shipping_cost']);		
	}
	
	//Shipping cost multiple 
	if($_POST['shipping_cost_multiple'] == "true"){
		$Sanitized_Cost_Multiple = true;
	}
	
	//Check for all the inputs.	
	if($Sanitized_Title != null && $Sanitized_Short_Description != null && $Sanitized_Quantity != 0 && $Sanitized_Price != 0){
	
		//We got all the requirements, try to post it.			
		if($Sanitize_Problem == true){
			$Error = true;
			$Error_Details = $Sanitize_Problem_Details;
		}else{
		
		
	//Check account
		
		//Local Global Variables.
		$User_Name_Id_result = null;
		$User_Name_Balance_result = null;
		
		$User_Fee_To_Post = null;
		
		
		//Get the user_id
		if($Error == false){		
			$User_Name_Id_result = FN_User_Get_Id($_SESSION['user_name']);
			if($User_Name_Id_result == 'Internal_Server_Error' || $User_Name_Id_result == 'Error_Try_Again' || $User_Name_Id_result == null){
				$Error_Details = 'An error has occurred, if the error continues please contact support and provide them with ERR:P1:150.';
				$Error = true;
			}
		}	
		
		//Check account settings to see if they are Banned from posting.
		if($Error == false){
			$User_Name_Settings_result = FN_User_Check_Settings($User_Name_Id_result);
			if($User_Name_Settings_result == 'Internal_Server_Error' || $User_Name_Settings_result == 'Error_Try_Again' || $User_Name_Settings_result == null){
				$Error_Details = 'An error has occurred, if the error continues please contact support and provide them with ERR:P1:255.';
				$Error = true;
			}
			
			if($User_Name_Settings_result['Banned_From_Posting'] == 'true'){
				$Error_Details = 'Your account has been disabled from posting new products onto the market place, if you believe this is an error please contact support.';
				$Error = true;
			}
			
			//Set the fee
			$User_Fee_To_Post = $User_Name_Settings_result['Post_Fee'];
			
			//Check to make sure it is set and also is not paying to post.
			if($User_Fee_To_Post == null || $User_Fee_To_Post < 0){
				$Error_Details = 'An error has occurred, if the error continues please contact support and provide them with ERR:P1:241.';
				$Error = true;
			}
		}	
			
		//Check the user funds
		if($Error == false){
			$User_Name_Balance_result = FN_User_Check_Balance($User_Name_Id_result);
			if($User_Name_Balance_result == 'Internal_Server_Error' || $User_Name_Balance_result == 'Error_Try_Again' || $User_Name_Balance_result == null){
				$Error_Details = 'An error has occurred, if the error continues please contact support and provide them with ERR:P1:189.';
				$Error = true;
			}
			
			if($User_Name_Balance_result < $User_Fee_To_Post){
				$Error_Details = 'An error has occurred, you have insufficient funds to post a new product on the market place.';
				$Error = true;
			}else{
				//They can afford it so we transfer it to the admin.
				FN_User_Transfer_Funds($User_Name_Id_result, FN_User_Get_Id('payments_fee'), $User_Fee_To_Post);			
			}
		}

	//Post.

	/*---------------------------------------------------------------------
	Product_abbreviated
		- title (80 characters)
		- short_description (140 characters)
		- category
		- compressed rating
		- price :lowest
		- picture url code
		- username	
	*/

		//No error so we can post it.
		if($Error == false){
		
			$category = $Sanitized_Category;
			$Product_abbreviated = array( 'title' => $Sanitized_Title, 'owner' => $_SESSION['user_name'], 'short_description' => $Sanitized_Short_Description, 'category' => $category, 'price' => $Sanitized_Price, 'picture' => 'www.scriptencryption.com/pic/11213123.png');
			
			$Product_abbreviated_json = json_encode($Product_abbreviated);
					
			//Insert into the abbreviated (If there was no problem it will return an id.
			$Abbreviated_result = FN_Product_Abbreviated_Insert($Product_abbreviated_json);
			if($Abbreviated_result == 'Internal_Server_Error' || $Abbreviated_result == 'Error_Try_Again'){
				echo 'Error, problem: ' . $Abbreviated_result;
			}else{
				//echo 'No error: :D'; //Debugging
			}
			
			
		/*-----------------------------------------------------------------------
			Product_Extended
				- long_description
				- terms of sale
				- compressed rating
				- pricing
				- quantity of sale	
			*/
			
		
			$Long_Description = $Sanitized_Long_Description;
			$Terms_Of_Sale = $Sanitized_Terms_Of_Sale;
			$Compressed_Rating = -1; //unrated
			$Quantity_For_Sale = $Sanitized_Quantity;
			
			$Product_extended = array('long_description' => $Long_Description, 'terms_of_sale' => $Terms_Of_Sale, 'compressed_rating' => $Compressed_Rating, 'quantity' => $Quantity_For_Sale, 'shipping_cost' => $Sanitized_Shipping, 'shipping_cost_multiple' => $Sanitized_Cost_Multiple);
			
			$Product_extended_json = json_encode($Product_extended);				

			//Insert into the abbreviated
			$Extended_result = FN_Product_Extended_Insert($Abbreviated_result, $Product_extended_json);
			if($Extended_result == 'Internal_Server_Error' || $Extended_result == 'Error_Try_Again'){
				echo 'Error, problem: ' . $Extended_result;
			}else{
				//echo 'No error: :D'; //Debugging
			}
			
			
			
			//Subtract the user's credit.			
			$User_Funds_Update_result = FN_User_Funds_Update($User_Name_Id_result, $User_Name_Balance_result - $User_Fee_To_Post);
			if($User_Funds_Update_result == 'Internal_Server_Error' || $User_Funds_Update_result == 'Error_Try_Again'){
				echo 'Error, problem: ' . $User_Funds_Update_result;
			}else{
				//echo 'No error: :D'; //Debugging
			}
			
						
			//Add to their products.			
			$User_Add_Product_result = FN_User_Add_Product($User_Name_Id_result, $Abbreviated_result);
			if($User_Add_Product_result == 'Internal_Server_Error' || $User_Add_Product_result == 'Error_Try_Again'){
				echo 'Error, problem: ' . $User_Add_Product_result;
			}else{
				//echo 'No error: :D';
			}			
			
	
			//It is complete so we add it receipt and redirect of finish.
			
			//Create Receipt
			$Receipt = hash('md5', $User_Name_Id_result); //Don't actually use this
			//rediect.
			header('Location: http://www.scriptencryption.com/products/product_finish.php?id=' . $Receipt);
			die();
			
		}

	}
	}
	
	
	
	//$Error = true;
	//$Error_Details = $Sanitize_Problem_Details;
	if($Error == true){
		echo "Error: " . $Error_Details;
	}
	
?>



<?php
/*---------------------------------------------------------------------
Product_abbreviated
	- title (80 characters)
	- short_description (140 characters)
	NP- compressed rating
	NP- price :lowest
	- picture url code
	NP- username	
*/
	
/*-----------------------------------------------------------------------
Product_Extended
	- long_description
	- terms of sale
	NP- compressed rating
	- pricing
	- quantity of sale	
*/
 ?>

<!DOCTYPE html>
<html>
<head>
<style>
div.img {
    margin: 5px;
    padding: 5px;
    border: 1px solid #0000ff;
    height: auto;
    width: auto;
    float: left;
    text-align: center;
}	

div.img img {
    display: inline;
    margin: 5px;
    border: 1px solid #ffffff;
}

div.img a:hover img {
    border: 1px solid #0000ff;
}

div.desc {
  text-align: center;
  font-weight: normal;
  width: 120px;
  margin: 5px;
}
</style>
</head>
<body>

<br>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<div class="img">
	<a target="_blank" href="/Assets/img/blank_photo.png"><img src="..\Assets\img\blank_photo.png" width="110" height="90"></a>
	<img id="myImage" src="..\Assets\img\cancel_icon.png" width="25" height="25" style="cursor:pointer">
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
end of debugging stuff
<br>

 

<form method="post" action="product_create.php" id="create_product_new" name="create_product_new">

	<label for="title">title</label>	
    <input id="title" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="title" value="<?php echo $_POST['title']; ?>" required /></input>
	<br>

    <label for="short_description">short description</label>	
    <input id="short_description" type="text" pattern="{12,300}" name="short_description" value="<?php echo $_POST['short_description']; ?>"  required /></input>
	<br>
	
	<label for="category">category</label>
	<select id="category" name="category">
	<?php 
		//Display the Categories.
		foreach ($Categorise as &$item) {
			echo '<option value="' . $item . '">' . $item .'</option>';
		}	
	?>	
	</select>
	<br>
  
	<label for="quantity_for_sale">Quantity for sale</label>
    <input id="quantity_for_sale" type="text" pattern="[0-9]{1,4}" name="quantity_for_sale" value="<?php echo $_POST['quantity_for_sale']; ?>"  required /></input>
	<br>
	
	<label for="shipping_cost">Shipping Cost</label>
    <input id="shipping_cost" type="text" pattern="[0-9.]{1,4}" name="shipping_cost" value="<?php echo $_POST['shipping_cost']; ?>"  required /></input>
	<br>
	
	<input type="checkbox" name="shipping_cost_multiple" value="yes">Should each unit charge an additional shipping?<br>
	
	<label for="long_description">Long description</label>
    <input id="long_description" type="text" name="long_description" value="<?php echo $_POST['long_description']; ?>"  required/></input>
	<br>
	
	<label for="terms_of_sale">Terms of sale</label>
    <input id="terms_of_sale" type="text" name="terms_of_sale" value="<?php echo $_POST['terms_of_sale']; ?>" /></input>
	<br>
	
	<label for="price">Price</label>
    <input id="price" type="text" name="price" pattern="[0-9.]{1,4}" value="<?php echo $_POST['price']; ?>"  required /></input>
	<br>
		
  	
    <input type="submit" name="register" value="Submit" />
</form>

</body>
</html>
