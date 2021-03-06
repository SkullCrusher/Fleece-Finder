<?php
	// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
	// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
	// Set this to 0 once you go live or don't require logging.
	
	echo "asd";
	
	define("DEBUG", 1);
	// Set to 0 once you're ready to go live
	define("USE_SANDBOX", 0);
	define("LOG_FILE", "./ipn.log");
	// Read POST data
	// reading posted data directly from $_POST causes serialization
	// issues with array data in POST. Reading raw POST data from input stream instead.
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
		$keyval = explode ('=', $keyval);
		if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
		$get_magic_quotes_exists = true;
	}
	
	foreach ($myPost as $key => $value) {
		if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
			$value = urlencode(stripslashes($value));
		} else {
			$value = urlencode($value);
		}
		$req .= "&$key=$value";
	}
	// Post IPN data back to PayPal to validate the IPN data is genuine
	// Without this step anyone can fake IPN data
	if(USE_SANDBOX == true) {
		$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	} else {
		$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
	}
	
	$ch = curl_init($paypal_url);
	
	if ($ch == FALSE) {
		return FALSE;
	}
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
	}
	// CONFIG: Optional proxy configuration
	//curl_setopt($ch, CURLOPT_PROXY, $proxy);
	//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	// Set TCP timeout to 30 seconds
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
	// of the certificate as shown below. Ensure the file is readable by the webserver.
	// This is mandatory for some environments.
	//$cert = __DIR__ . "./cacert.pem";
	//curl_setopt($ch, CURLOPT_CAINFO, $cert);
	$res = curl_exec($ch);
	if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {
	error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;
	} else {
	// Log the entire HTTP response if debug is switched on.
	if(DEBUG == true) {
	error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
	error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	}
	// Inspect IPN validation result and act accordingly
	// Split response headers and payload, a better way for strcmp
	$tokens = explode("\r\n\r\n", trim($res));
	$res = trim(end($tokens));
	if (strcmp ($res, "VERIFIED") == 0) {
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.
	// assign posted variables to local variables

	$txn_id = $_POST['txn_id'];
	$payment_amount = $_POST['mc_gross'];
	$payer_id = $_POST['payer_id'];
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$transaction_date = 
	$payment_status = $_POST['payment_status'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	$payer_status = $_POST['payer_status'];
	$address_street = preg_replace("/[^0-9,.]/", "", $_POST['address_street']);
	$payment_currency = $_POST['mc_currency'];

	$packed_json = json_encode($_POST);
	
	
	//preg_replace("/[^0-9,.]/", "", $testString);
		
	
	
	//pull the price from the order
	
	//I changed this it might have caused an error?
		
	define("DB_HOST", "127.0.0.1");
	define("DB_NAME", "dwarvencthulhu");
	define("DB_USER", "IPN");
	define("DB_PASS", "NvndSAdA8nnK2VLUVQzgGkr2");
	
	
	$db_check = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_check->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_check->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
	$statement_check = null; //The statement
				
	try {
		$statement_check = $db_check->prepare('SELECT * FROM order_information WHERE id = :id');			
	} catch (PDOException $e) {										
		//Error code 1146 - unable to find database.		
	}
		
	try {				
		$statement_check->execute(array(':id' => $address_street));
	} catch (PDOException $e) {				
		//Error code 23000 - unable to to create because of duplicate id.
	}
	
	
	$FetchResult = $statement_check->fetch();	
	//check if the payment is valid.
	
	if($FetchResult['price'] == $payment_amount){
		$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db_update->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db_update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
		$statement_update = null; //The statement
					
		try {
			$statement_update = $db_update->prepare('UPDATE order_information SET ipn_paid_date = :ipn_paid_date WHERE id = :id');			
		} catch (PDOException $e) {										
			//Error code 1146 - unable to find database.		
		}
			
		try {				
			$statement_update->execute(array(':ipn_paid_date' => date('Y-m-d h:i:s'), ':id' => $address_street));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
		}
		
	}
	
	
	
	/*
	$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_update->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
	$statement_update = null; //The statement
				
	try {
		$statement_update = $db_update->prepare('INSERT INTO ipn_valid (transaction_id, payment_amount, packed_json, date, ip) VALUES (:transaction_id, :payment_amount, :packed_json, :date, :ip)');			
	} catch (PDOException $e) {										
		//Error code 1146 - unable to find database.		
	}
		
	try {				
		$statement_update->execute(array(':transaction_id' => $_POST['txn_id'], ':payment_amount' => $_POST['mc_gross'], ':ip' => $_SERVER['REMOTE_ADDR'], ':date' => date('Y-m-d h:i:s'), ':packed_json' => json_encode($_POST)));
	} catch (PDOException $e) {				
		//Error code 23000 - unable to to create because of duplicate id.
	}*/


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	error_log($_POST);
		
	$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
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



	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
	}
	
	} else if (strcmp ($res, "INVALID") == 0) {
	
		define("DB_HOST", "127.0.0.1");
		define("DB_NAME", "dwarvencthulhu");
		define("DB_USER", "IPN");
		define("DB_PASS", "NvndSAdA8nnK2VLUVQzgGkr2");
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
				
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
		$statement = null; //The statement
				
		try {
			$statement = $db->prepare('INSERT INTO ipn_invalid (ip, date, packed_json) VALUES (:ip, :date, :packed_json)');			
		} catch (PDOException $e) {										
			//Error code 1146 - unable to find database.		
		}
		
		try {
			$statement->execute(array(':ip' => $_SERVER['REMOTE_ADDR'], ':date' => date('Y-m-d h:i:s'), ':packed_json' => json_encode($_POST)));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
		}			
	
		// log for manual investigation
		// Add business logic here which deals with invalid IPN messages
		if(DEBUG == true) {error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);}
	}
?>