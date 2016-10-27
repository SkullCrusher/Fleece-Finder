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

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	} else {	
		//just for the nav bar and if they click add to cart it forces login.
		header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}

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

			//FN_Search_Add_Product($User_Name_Id_result, $Abbreviated_result, $Product_abbreviated_json, $Product_extended_json);
			
	function FN_Search_Add_Product($User_Name_Id_result, $Abbreviated_result, $Product_abbreviated, $Product_extended){
				//Load the products
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
		$statement = null; //The statement
		
		var_dump($Product_abbreviated);
					
		try {
			$statement = $db->prepare('INSERT INTO product_search (id, title, description, categorie) VALUES (:id, :title, :description, :categorie)');			
		} catch (PDOException $e) {										
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}					
		try {
			$statement->execute(array(':id' => $Abbreviated_result, ':title' => $Product_abbreviated['title'], ':description' => $Product_abbreviated['short_description'], ':categorie' => $Product_abbreviated['category']));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
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
	
	$Sanitized_Amount = 1;
	$Sanitized_Units = "Unit";
	
//Pictures
	$Sanitized_Picture_1 = "none";
	$Sanitized_Picture_2 = "none";
	$Sanitized_Picture_3 = "none";
	$Sanitized_Picture_4 = "none";
	$Sanitized_Picture_5 = "none";
	$Sanitized_Picture_6 = "none";
	
	//preg_replace("/[^A-Za-z0-9 ]/", '', $string)
	
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

		//Validate the unit and amount 
		if($Error == false){
			if(strlen($_POST['amount']) > 0 && strlen($_POST['amount']) < 9999){
				$Sanitized_Amount = preg_replace("/[^0-9]/", "", $_POST['amount']);
			}else{
				$Error_Details = 'An error has occurred, the amount must be between 0 and 9999.';
				$Error = true;
			}
		}
		//Amount
		if($Error == false){
			if($_POST['unit'] == "LB" || $_POST['unit'] == "Square foot" || $_POST['unit'] == "Unit"){
				$Sanitized_Units = preg_replace("/[^A-Za-z ]/", "", $_POST['unit']);
			}else{
				$Error_Details = 'An error has occurred, an invalid unit.';
				$Error = true;
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
				
			//Units
			if(strlen($_POST['pic_1']) > 1){$Sanitized_Picture_1 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_1']);}
			if(strlen($_POST['pic_2']) > 1){$Sanitized_Picture_2 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_2']);}
			if(strlen($_POST['pic_3']) > 1){$Sanitized_Picture_3 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_3']);}
			if(strlen($_POST['pic_4']) > 1){$Sanitized_Picture_4 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_4']);}
			if(strlen($_POST['pic_5']) > 1){$Sanitized_Picture_5 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_5']);}
			if(strlen($_POST['pic_6']) > 1){$Sanitized_Picture_6 = preg_replace("/[^A-Za-z0-9_]/", '',$_POST['pic_6']);}
	
		
		
		
			$category = $Sanitized_Category;
			$Product_abbreviated = array( 'title' => $Sanitized_Title, 'owner' => $_SESSION['user_name'], 'short_description' => $Sanitized_Short_Description, 'amount' => $Sanitized_Amount, 'unit' => $Sanitized_Units, 'shipping_cost' => $Sanitized_Shipping, 'shipping_cost_multiple' => $Sanitized_Cost_Multiple,  'category' => $category, 'price' => $Sanitized_Price, 'picture' => $Sanitized_Picture_1);
			
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
			
			$Product_extended = array('long_description' => $Long_Description, 'terms_of_sale' => $Terms_Of_Sale, 'compressed_rating' => $Compressed_Rating, 'quantity' => $Quantity_For_Sale,'shipping_cost' => $Sanitized_Shipping, 'shipping_cost_multiple' => $Sanitized_Cost_Multiple, 'picture2' => $Sanitized_Picture_2, 'picture3' => $Sanitized_Picture_3, 'picture4' => $Sanitized_Picture_4, 'picture5' => $Sanitized_Picture_5, 'picture6' => $Sanitized_Picture_6);
			
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
			
			//We add the product to the search engine.			
			$Search_Add_Product_result = FN_Search_Add_Product($User_Name_Id_result, $Abbreviated_result, $Product_abbreviated, $Product_extended);
			if($Search_Add_Product_result == 'Internal_Server_Error' || $Search_Add_Product_result == 'Error_Try_Again'){
				echo 'Error, problem: ' . $Search_Add_Product_result;
			}else{
				//echo 'No error: :D';
			}			
			
			
			
			
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
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
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


 
 
 <div class="container_12 backgroundwhite">
	
			<div class="grid_12">
			<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Create new product</b></p>
			</div>
			
					
		<form method="post" action="product_create.php" id="create_product_new" name="create_product_new">
		
				<div class="grid_5">
				<label for="title"><b>Title - Maximum of 80 characters</b></label><br>
				<input id="title" class="textbox" type="text" pattern="[ ()a-zA-Z0-9-]{6,80}" name="title" placeholder="Ex: Naturally grown grain for sheep feed" value="<?php echo $_POST['title']; ?>" required /></input>			
			    </div>
			    <br>
				<div class="grid_5">			
				<label for="category"><b>Category</b></label><br>
				<div class="select-style">
				<select id="category" name="category">
				<?php 
					//Display the Categories.
					foreach ($Categorise as &$item) {
						echo '<option value="' . $item . '">' . $item .'</option>';
					}	
				?>	
				</select>
				</div></div>
				<div class="grid_2"><br></div>
				<div class="grid_5">
				<label for="short_description"><b>Short Description - Maximum of 140 characters </b></label>	<br>
				<input id="short_description" class="textbox" type="text" pattern="{12,300}" name="short_description" placeholder="Ex: The grain is a mixture of 25% soy beans and 75% wheat" value="<?php echo $_POST['short_description']; ?>"  required /></input>		
			</div><br>
		
				<div class="grid_2">
				<label for="quantity_for_sale"><b>Quantity for sale</b></label><br>
				<input id="quantity_for_sale" class="textbox" style="width:50px;" type="text" pattern="[0-9]{1,4}" name="quantity_for_sale" placeholder="1000" value="<?php echo $_POST['quantity_for_sale']; ?>"  required /></input>
			</div><br>
				<div class="grid_2">
				<label for="price"><b>Price</b></label><br>
				<input id="price" class="textbox" type="text" name="price" style="width:60px;" placeholder="19.99" pattern="[0-9.]{1,6}" value="<?php echo $_POST['price']; ?>"  required /></input>
				</div><br>
				<div class="grid_2">
				<label for="amount"><b>Amount in each</b></label><br>
				<input id="amount" class="textbox" type="text" name="amount" style="width:60px;" placeholder="50" pattern="[0-9.]{1,6}" value="<?php echo $_POST['amount']; ?>"  required /></input>
				</div><br>
				<div class="grid_5"><label for="unit"><b>Units</b></label><br>
				<div class="select-style">
				<select id="unit" name="unit">				
					<option value="LB">LB</option>	
					<option value="Square foot">Square foot</option>
					<option value="Unit">Unit</option>
				</select>
				</div></div><br>
				
				<div class="grid_4">
				<label for="shipping_cost"><b>Shipping Cost</b></label><br>
				<input id="shipping_cost" class="textbox" type="text" style="width:50px;" pattern="[0-9.]{1,4}" name="shipping_cost" placeholder="4.99" value="<?php echo $_POST['shipping_cost']; ?>"  required /></input><br>
				</div>			
				<div class="grid_2">	
				<label><b>Additional Shipping?</b></label>
				<input type="checkbox" class="textbox grid_3" name="shipping_cost_multiple" value="yes"></div><br>			
				<br>
				<div class="grid_12">
				<label for="long_description"><b>Long Description</b></label>
				<textarea rows="0" cols="50" id="long_description" name="long_description" value="<?php echo $_POST['long_description']; ?>" class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: The grain is produced on my small farm of 23 acres and processed in my barn during the winter. I grow it to feed my own sheep but I produce more then required so I decided to sell some. The grain is shipped in large feed sacks with a red rip tag to open them on the top."></textarea> 
			</div><br>
			
				<div class="grid_12">
				<label for="terms_of_sale"><b>Terms of sale</b></label><br>
				<textarea rows="0" cols="50" id="terms_of_sale" name="terms_of_sale" value="<?php echo $_POST['long_description']; ?>" class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: I do not accept returns because of the cost of shipping."></textarea> 
			</div><br>

			
				
				 <input type="hidden" name="pic_1" id="pic_1" value="">
				 <input type="hidden" name="pic_2" id="pic_2" value=""> 
				 <input type="hidden" name="pic_3" id="pic_3" value=""> 
				 <input type="hidden" name="pic_4" id="pic_4" value=""> 
				 <input type="hidden" name="pic_5" id="pic_5" value="">
				 <input type="hidden" name="pic_6" id="pic_6" value=""> 	
		
				
				<div class="grid_12"><input type="submit"  class="buynow addtocart" style="border: 0;margin-left:400px;" name="register" value="Submit" />	</div>
				</form>

			<script>
			function Delete_Image(index){
			
				var r = confirm("Are you sure you want to delete this photo?");
				if (r == true) {
					
					var x = document.getElementById("pic_" + index);			
					
					
					var xmlHttp = null;

					xmlHttp = new XMLHttpRequest();
					xmlHttp.open( "GET", "../images/delete.php?i=" + x.value, false );
					xmlHttp.send();
				
					x.value = "";
					
					x = document.getElementById("preview_" + index);	
					x.innerHTML = "";
				}
			}
			</script>
	
	
			<script type="text/javascript" src="../Assets/Javascript/jquery.min.js"></script>
			<script type="text/javascript" src="../Assets/Javascript/jquery.form.js"></script>
	
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

				 $(document).ready(function() { 						
				$('#photoimg2').live('change', function(){ 
			    $("#preview2").html('');
				$("#preview2").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform2").ajaxForm({
					target: '#preview_2'
				}).submit();
				});
				}); 
				
				 $(document).ready(function() { 						
				$('#photoimg3').live('change', function(){ 
			    $("#preview3").html('');
				$("#preview3").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform3").ajaxForm({
					target: '#preview_3'
				}).submit();
				});
				}); 
				
				 $(document).ready(function() { 						
				$('#photoimg4').live('change', function(){ 
			    $("#preview4").html('');
				$("#preview4").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform4").ajaxForm({
					target: '#preview_4'
				}).submit();
				});
				}); 
				
				 $(document).ready(function() { 						
				$('#photoimg5').live('change', function(){ 
			    $("#preview5").html('');
				$("#preview5").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform5").ajaxForm({
					target: '#preview_5'
				}).submit();
				});
				}); 
				
				 $(document).ready(function() { 						
				$('#photoimg6').live('change', function(){ 
			    $("#preview6").html('');
				$("#preview6").html('<img src="../Assets/Images/loader.gif" alt="Uploading...."/>');
				$("#imageform6").ajaxForm({
					target: '#preview_6'
				}).submit();
				});
				}); 
		</script>
			
			<div class="grid_12" style="padding-left: 10px; padding-top:10px;">
			<div style="width:300px">
				<form id="imageform1" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg1" id="photoimg1" />
				</form>
				<div id='preview_1' name="img_1" onclick="Delete_Image('1')">
				</div>
			</div>
			
			<div style="width:300px">
				<form id="imageform2" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg2" id="photoimg2" />
				</form>
				<div id='preview_2' name="img_2" onclick="Delete_Image('2')">
				</div>
			</div>
			
			<div style="width:300px">
				<form id="imageform3" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg3" id="photoimg3" />
				</form>
				<div id='preview_3' name="img_3" onclick="Delete_Image('3')">
				</div>
			</div>
			
			<div style="width:300px">
				<form id="imageform4" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg4" id="photoimg4" />
				</form>
				<div id='preview_4' name="img_4" onclick="Delete_Image('4')">
				</div>
			</div>
			
			<div style="width:300px">
				<form id="imageform5" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg5" id="photoimg5" />
				</form>
				<div id='preview_5' name="img_5" onclick="Delete_Image('5')">
				</div>
			</div>
			
			<div style="width:300px">
				<form id="imageform6" method="post" enctype="multipart/form-data" action='../images/ajaximage.php'>
				Upload your image <input type="file" name="photoimg6" id="photoimg6" />
				</form>
				<div id='preview_6' name="img_6" onclick="Delete_Image('6')">
				</div>
			</div>
			</div>
	
		</div>
			

<style>
div.img {
    margin: 2px;
    padding: 0px;
    border: 1px solid #BDC3C7;
    height: auto;
    width: auto;
    float: left;
    text-align: center;
}	

div.img img {
    display: inline;
    margin: 0px;
    border: 1px solid #ffffff;
}

div.img a:hover img {
    border: 1px solid #2ECC71;
}

div.desc {
  text-align: center;
  font-weight: normal;
  width: 120px;
  margin: 5px;
}
</style>

	

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 