<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */


	// include the configure file
	require_once('../config/config.php');


//End of functions.


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
	
	//Global variables. 
	
	//(Abbreviated)
	$Product_Title				= null;
	$Product_Owner 				= null;
	$Product_Short_Description 	= null;
	$Product_Category			= null;
	$Product_Pictures			= array();	
	
	//(extended)
	$Product_Long_Description 	= "No more information provided.";
	$Product_Terms_Of_Sale		= null;
	$Product_Compressed_Rating	= null;
	$Quantity					= null;
	$Shipping_Cost				= null;
	$Shipping_Cost_Multiple		= null;
	
	
	
	
	//We need both the owner and the product id.
	if(strlen($_GET['p']) < 1 || strlen($_GET['u']) < 1){
		//We don't have both, give 404 page.
		
		header("Location: http://www.scriptencryption.com/error/404.php?error=1");
		die();
	}else{ 
		//No problem with the $_GET's so we check the database for those.		
		//Remove all non number characters before do the request for (p)roduct.		
		$Input_Product_Id = preg_replace("/[^0-9]/", "", $_GET['p']);
		
		//Abbreviated ----------------------------------------
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement	
			
		try {
			$statement = $db->prepare('SELECT json_condensed FROM product_abbreviated WHERE id = :id');			
		} catch (PDOException $e) {	
			header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
			die();
		}
			
		try {
			$statement->execute(array(':id' => $Input_Product_Id));
		} catch (PDOException $e) {				
			header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
			die();
		}		

		$result = $statement->fetch();
		
		//Check to see if there was a product to match it.
		if($result == null){
			//We did not get anything back so it must not be valid.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Decode the json and check to see if the owner matches.		
		$Product_Json_Decoded_Abbreviated = json_decode($result['json_condensed'], true);
				
		if($Product_Json_Decoded_Abbreviated['owner'] != $_GET['u']){
			//It does not match.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Extended ------------------------------------------------------------
		$statement = null; //The statement	
			
		try {
			$statement = $db->prepare('SELECT json_extended FROM product_extended WHERE id = :id');			
		} catch (PDOException $e) {		
			header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
			die();
		}
			
		try {
			$statement->execute(array(':id' => $Input_Product_Id));
		} catch (PDOException $e) {					
			header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; 
			die();
		}		

		$result = $statement->fetch();
		
		//Check to see if there was a product to match it.
		if($result == null){
			//We did not get anything back so it must not be valid.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Decode the json and check to see if the owner matches.		
		$Product_Json_Decoded_Extended = json_decode($result['json_extended'], true);
	
		//Global variables. 
		
		//(Abbreviated)
		$Product_Title				= $Product_Json_Decoded_Abbreviated['title'];
		$Product_Owner 				= $Product_Json_Decoded_Abbreviated['owner'];
		$Product_Short_Description 	= $Product_Json_Decoded_Abbreviated['short_description'];
		$Product_Category			= $Product_Json_Decoded_Abbreviated['category'];
		
		$Product_Pictures = $Product_Json_Decoded_Abbreviated['picture'];		
			
		//(extended)
		if(strlen($Product_Json_Decoded_Extended['long_description']) > 2){
			$Product_Long_Description 	= $Product_Json_Decoded_Extended['long_description'];
		}
		
		$Product_Terms_Of_Sale		= $Product_Json_Decoded_Extended['terms_of_sale'];
		$Product_Compressed_Rating	= $Product_Json_Decoded_Extended['compressed_rating'];
		$Quantity					= $Product_Json_Decoded_Extended['quantity'];
		
		$Shipping_Cost = $Product_Json_Decoded_Extended['shipping_cost'];
		$Shipping_Cost_Multiple = $Product_Json_Decoded_Extended['shipping_cost_multiple'];
		
	}
	
	
	
	
	
	
	
	echo $Product_Title;
	echo '<br>';
	echo $Product_Owner;
	echo '<br>';
	echo $Product_Short_Description;
	echo '<br>';
	echo $Product_Category;
	echo '<br>';
	//print_r($Product_Pictures);	
	
	//(extended)
	echo $Product_Long_Description;
	echo '<br>';
	echo $Product_Terms_Of_Sale;
	echo '<br>';
	
	if($Product_Compressed_Rating == -1){
		echo "Unrated";
	}else{
		//echo $Product_Compressed_Rating;
	}
	
	/*
	$Shipping_Cost				= null;
	$Shipping_Cost_Multiple		= null;
	*/
	
	echo '<br>';
	echo $Quantity;
	
	echo '<br>';
	echo '<br>';
?>

Seller: <a href="../users/profile.php?u=<?php echo $Product_Owner; ?>"><?php echo $Product_Owner; ?></a>
<br>
Report: <a href="../users/report.php?u=<?php echo $Product_Owner; ?>&p=<?php echo $_GET['p']; ?>">Report this user for this product</a>
<br>
Shipping cost: <?php echo '$' . $Shipping_Cost; if($Shipping_Cost_Multiple == true){ echo ' Each unit has it\'s own shipping cost'; }; ?>

<form method="post" action="product_profile.php">  	
    <input type="submit" name="register" value="Add to cart" />
</form>


















