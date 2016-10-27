<?php






/*

$array_1 = array( 'Array1' => 'ray1', 'Array1_1' => 'ray1_2');

$array_2 = array('Array2' => 'ray2', 'Array2_2' => 'ray2_2');


$array_objects = array('Faggots' => $array_1, 'ButtPirates' => $array_2);

print_r(json_encode($array_objects));
echo "ss";

*/

//How server settings are packed.
/*

$array_1 = array( 'Wool (unfinished)', 'Wool (finished)', 'Hand knit', 'Spinning Equipment');

$array_2 = array('Categories' => $array_1);


//$array_objects = array('Faggots' => $array_1);

print_r(json_encode($array_2));
*/

//echo htmlspecialchars($string, ENT_COMPAT,'ISO-8859-1', true);


require_once('../config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('../translations/en.php');

// include the PHPMailer library
require_once('../libraries/PHPMailer.php');

// load the login class
require_once('../classes/Login.php');

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
				
				//print_r($Json_User_Product);
				
				//Subtract the user's credit.			
				$db_update = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
							
				$db_update->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db_update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
						
				$db_update->beginTransaction(); 
						
				$statement_update = null; //The statement
							
				try {
					$statement_update = $db_update->prepare('UPDATE users_products SET json_productids = :json_productids WHERE id = :id');			
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
				
				$statement_update->commit();
				
				echo $statement_update->lastInsertId(); 
			}

	//echo FN_User_Add_Product(6, 2);

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
		echo $db->lastInsertId(); 
	}
	echo "ss";
	echo FN_Product_Abbreviated_Insert("Trash");
	echo "ss";

//echo json_encode(array(4 => "four", 8 => "eight", 'index' => "eight", 'sdd' => "eight"));

?>
