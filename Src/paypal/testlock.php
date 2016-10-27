
<?php

define("DB_HOST", "127.0.0.1");
	define("DB_NAME", "dwarvencthulhu");
	define("DB_USER", "IPN");
	define("DB_PASS", "NvndSAdA8nnK2VLUVQzgGkr2");
			
	$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
	$statement = null; //The statement
				
	try {
		$statement = $db->prepare('INSERT INTO ipn_valid (transaction_id, payment_amount, packed_json, date, ip) VALUES (:transaction_id, :payment_amount, :packed_json, :date, :ip)');			
	} catch (PDOException $e) {										
		//Error code 1146 - unable to find database.		
	}
		
	try {				
		$statement->execute(array(':transaction_id' => $_POST['txn_id'], ':payment_amount' => $_POST['mc_gross'], ':ip' => $_SERVER['REMOTE_ADDR'], ':date' => date('Y-m-d h:i:s'), ':packed_json' => json_encode($_POST)));
	} catch (PDOException $e) {				
		//Error code 23000 - unable to to create because of duplicate id.
	}			


	
	
?>

done
