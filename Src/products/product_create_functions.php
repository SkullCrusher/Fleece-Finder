<?php

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
	
?>
