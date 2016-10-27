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
		//include("../index.php");
	//	die();
	}
	
	function FN_Logging_Receipt($id, $product_id, $json_receipt){
				//Load the products
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
		$statement = null; //The statement
		
		//var_dump($Product_abbreviated);
					
		try {
			$statement = $db->prepare('INSERT INTO logging_receipt (id, product_id, json_receipt) VALUES (:id, :product_id, :json_receipt)');			
		} catch (PDOException $e) {										
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}					
		try {
			$statement->execute(array(':id' => $id, ':product_id' => $product_id, ':json_receipt' => $json_receipt));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
	}
	
	
	function FN_Load_Product_Information($Id, &$JSON){
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_condensed FROM product_abbreviated WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		if($result == null){
			return "error";
		}
		
		$result = $result['json_condensed'];
		$result = json_decode($result, true);
				
		$JSON = $result;
				
				
		return $result['owner'];
	}
	
			
	
	//FN_Logging_Receipt(hash('md5',3), 143, "ghj");
	$Hash = null;
	$JSON = null;
	
	if($_SESSION['user_name'] == FN_Load_Product_Information($_GET['id'], $JSON)){		
		$Hash = hash('md5', $_GET['id'] + $_SESSION['user_name']);	

		FN_Logging_Receipt(hash('md5', $_GET['id']), $_GET['id'], json_encode($JSON));
	}else{
		//header("Location: http://www.scriptencryption.com/"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		//die();
	}
	

	
	/*	
	//NOTE THIS SHOULD BE THE RECEIPT ID NOT THE INDEX ID
	if(strlen($_GET['id']) < 1){
		echo "NOPE";
	}	
	*/


?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite" style="margin-bottom: 10px;">

Your product has been posted. Your receipt ID is <?php echo $Hash; ?>.

The to view your product <a href="../products/product_profile.php?p=<?php echo $_GET['id']; ?>&u=<?php echo $_SESSION['user_name'];?>">click here</a>


</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
