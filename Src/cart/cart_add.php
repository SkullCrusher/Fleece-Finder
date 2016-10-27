<?php 
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */
?>
<?php 


	// include the configure file
	require_once('../config/config.php');

	function FN_Product_Stock($ID){		
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT stock_free FROM product_abbreviated WHERE id = :id');			
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

		return $result['stock_free'];
		
	}
	


	session_start();
	
	if(isset($_GET['emptycart']) && $_GET['emptycart'] == 'sure'){
		$_SESSION['cart'] = 'blank';	
		header('Location: ' . base64_decode($_POST['return_url']));
		die();
	}
	
		
	$_POST['product_code'] 		= filter_var($_POST["product_code"], FILTER_SANITIZE_NUMBER_INT); //product code
	$_POST['product_owner'] 	= filter_var($_POST["product_owner"], FILTER_SANITIZE_STRING); //product code
	$_POST['product_quantity'] 	= filter_var($_POST['product_quantity'], FILTER_SANITIZE_NUMBER_INT); //product code
	

	
	//stock check
	if(FN_Product_Stock($_POST['product_code']) < $_POST['product_quantity']){
		header('Location: ' . base64_decode($_POST['return_url']));
		die();
	}
	
	if(isset($_POST['product_code']) && strlen($_POST['product_code']) >= 1){
		if(isset($_POST['product_owner']) && strlen($_POST['product_owner']) >= 1){
			if(isset($_POST['product_quantity']) && strlen($_POST['product_quantity']) >= 1){				
				
				//check if it is empty
				if($_SESSION['cart'] == "blank" || $_SESSION['cart'] == null){					
					$arrays = array(array('product_code' => $_POST['product_code'], 'product_owner' => $_POST['product_owner'], 'product_quantity' => $_POST['product_quantity']));
					$_SESSION['cart'] = $arrays;
					
					header('Location: ' . base64_decode($_POST['return_url']));
					die();
				}else{			
					$found = false;
				
					foreach ($_SESSION['cart'] as &$value) {						
						if($value['product_code'] == $_POST['product_code']){
							$found = true;
							
							$value['product_quantity'] += $_POST['product_quantity'];
						}						
					}
					
					if($found == false){										
						$arrays = array('product_code' => $_POST['product_code'], 'product_owner' => $_POST['product_owner'], 'product_quantity' => $_POST['product_quantity']);
						array_push ($_SESSION['cart'], $arrays);
					}
					
					header('Location: ' . base64_decode($_POST['return_url']));
					die();
				}				
			}
		}	
	}

	
	header('Location: ' . base64_decode($_POST['return_url']));
	die();
	
	//print_r($_SESSION['cart']);
	//$_SESSION['cart'] = null;
	//header('Location: ');
	//die();	

/*
CART

<form method="post" action="cart_add.php">		
	<input type="hidden" name="return_url" value="<?php echo base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" />
		
	
	<input type="hidden" name="product_code" value="141" />
	<input type="hidden" name="product_owner" value="user" />
	<input type="hidden" name="product_quantity" value="1" />
	
	
	<input type="submit" name="login" class="buynow addtocart" value="Login" />
</form>
*/
?>
