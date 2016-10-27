<?php
	// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
	// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
	// Set this to 0 once you go live or don't require logging.
	
	//I changed this it might have caused an error?
		
	define("DB_HOST", "127.0.0.1");
	define("DB_NAME", "dwarvencthulhu");
	define("DB_USER", "IPN");
	define("DB_PASS", "NvndSAdA8nnK2VLUVQzgGkr2");
	
	
	
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
	
	
	
	function FN_Get_Product_Owner($id){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM product_abbreviated WHERE id = :id');			
		} catch (PDOException $e) {
				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Decompiled = json_decode($result['json_condensed'], true);

		return $Decompiled['owner'];
	}
	
	

		
	$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_update->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
	$statement_update = null; //The statement
		
	try {
		$statement_update = $db_update->prepare('SELECT id, shipping_id, buyer_id, order_date, product_order_ids_json, buyer_id FROM order_information WHERE shipping_id = :shipping_id');			
	} catch (PDOException $e){
		//Error code 1146 - unable to find database.
	}
		
	try {
		$statement_update->execute(array(':shipping_id' => '51'));
	} catch (PDOException $e) {				
		//Error code 23000 - unable to to create because of duplicate id.
	}		
		
	$values = $statement_update->fetch();
		
	var_dump($values);
		
	//split the order into chunks and put into product_order		
	$db_insert = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_insert->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_insert->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
	$statement_insert = null; //The statement
		
	try {
		$statement_insert = $db_insert->prepare('INSERT INTO product_order (customer_id, seller_id, order_information_id, shipping_id, product_id, quantity, price) VALUES (:customer_id, :seller_id, :order_information_id, :shipping_id, :product_id, :quantity, :price)');			
	} catch (PDOException $e){
		//Error code 1146 - unable to find database.
	}
	
	
	$json_depacked = json_decode($values['product_order_ids_json'], true);
		
	foreach ($json_depacked as &$row) {			
			
		try {			
			var_dump($row);
			
			$Vas = FN_User_Get_Id(FN_Get_Product_Owner($row['item_id']));
			
			echo "--" . $values['buyer_id'] . '-- ' . $Vas . "--";
			
			$statement_insert->execute(array(':shipping_id' => $values['shipping_id'], ':order_information_id' => $values['id'], ':customer_id' => $values['buyer_id'], ':seller_id' => $Vas, ':product_id' => $row['item_id'], ':quantity' => $row['qty'], ':price' => $row['price']));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
		}				
	}
		
	
?>