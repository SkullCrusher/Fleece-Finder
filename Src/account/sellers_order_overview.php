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
		//just for the nav bar and if they click add to cart it forces login.
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
		die();
	}
	
	
		//---------------------------------
	
	


	//Check to insure that the id is theirs.	
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
	
	
	$User_Id = FN_User_Get_Id($_SESSION['user_name']);		
	
	$Product_Loaded_temp = FN_Product_Order($_GET['id']);
	
	//check to see if they are the seller else go to the homepage
	if($Product_Loaded_temp['seller_id'] != $User_Id){
	//	header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
	//	die();
	}
	
	//Load all of the information.
	//FUNCTIONS
	function FN_Product_Order($Username){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM product_order WHERE id = :id');			
		} catch (PDOException $e) {				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Username));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();

		return $result;
	}	
	
	function FN_Order_Information($Username){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM order_information WHERE id = :id');			
		} catch (PDOException $e) {				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $Username));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();

		return $result;
	}	
	
	function FN_Ship_Information($id){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM shipping_information WHERE id = :id');			
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

		return $result;
	}	
	
	function FN_product_abbreviated($id){

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

		return $result['json_condensed'];
	}
	
	function FN_User_Get_Username($id){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT user_name FROM users WHERE user_id = :user_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':user_id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();

		return $result['user_name'];
	}	
	
	
	function FN_Products_attached($id){

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM product_order WHERE order_information_id = :order_information_id');			
		} catch (PDOException $e) {				
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':order_information_id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetchAll();

		return $result;
	}	

?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">			
			<div class="grid_12 title" style="margin-bottom:20px; text-align:center;">		 
				<b>Order Information</b>	
			</div>
		</div>
	
		<div class="container_12 backgroundwhite" style="margin-bottom:10px;">

			<style> 

			#containerz{
			width:958px;
		
			margin:0 auto;
			
			 color:#F7F7F7;
			  background:#E5E5E5;
			  font-family: 'Open Sans', sans-serif;
			}
			
		
			#containerz table {
			 width:958px;
			 margin:0 auto;
			 border-spacing: 0;
			}

			#containerz th{
			  height:25px;
			}

			#containerz thead th {
			  font-weight: 400;
			  font-size:1em;
			  background: #2ECC71;
			  color: #333;
			  font-weight: bold;
			  text-align:center;
			  height:35px;
			}

			#containerz a.btn{
			  display:inline-block;
			  transition: all .2s ease;
			  border-bottom-left-radius:3px;
			  border-top-left-radius:3px;
			  border-bottom-right-radius:3px;
			  border-top-right-radius:3px;
			  background:#2ECC71;
			  color: #000;
			  font-weight: bold;
			  padding-left:3px;padding-right:3px;text-decoration:none;transition: all .2s ease;padding:5px;
			}
			
			#containerz input.btn{
			  display:inline-block;
			  transition: all .2s ease;
			  border-bottom-left-radius:3px;
			  border-top-left-radius:3px;
			  border-bottom-right-radius:3px;
			  border-top-right-radius:3px;
			  background:#2ECC71;
			  color: #000;
			  font-weight: bold;
			  border-width: 0px;
			  padding-left:3px;padding-right:3px;text-decoration:none;transition: all .2s ease;padding:5px;
			}

			#containerz a.btn:hover{background:#2BBB68;transition: all .2s ease}

			#containerz tr {
			  background: #333;
			  margin-bottom: 5px;
			  font-size:12px
			}

			#containerz tr:nth-child(even) {
			  background: #444;
			}

			#containerz th, td {
			  text-align: center;
			  padding: 15px;
			  font-size:12px;
			}

			#containerz tfoot tr{
			  background:none;
			}
			</style>
				
			<div id="containerz" style="margin-top: -20px;margin-bottom: 280px;">
			
			<?php 			
							
				$Store = FN_Products_attached($_GET['id']);
				
				foreach ($Store as &$value) {					
					
					//find the product name					
					$Product_ID = $value['product_id']; //product code				
				
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
						$statement->execute(array(':id' => $Product_ID));
					} catch (PDOException $e) {				
						header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
						die();
					}		

					$result = $statement->fetch();
					
					$Json_Decode = json_decode($result['json_condensed'], true);

						
					//-------------------------------------------	
		
					$Product_Loaded = FN_Product_Order($value['id']);

					$Status = htmlspecialchars($Product_Loaded['status'], ENT_QUOTES);	
					$Tracking_Number = htmlspecialchars($Product_Loaded['tracking_code'], ENT_QUOTES);	
					$Tracking_Company = htmlspecialchars($Product_Loaded['package_carrier'], ENT_QUOTES);	
					$Canceled = htmlspecialchars($Product_Loaded['canceled'], ENT_QUOTES);	

			?>				
				<table>
				 <thead>
				  <tr>
					<th scope="col"></th>
					<th scope="col"></th>				
				  </tr>
				  </thead>
				  <tbody>
				  <tr>
					<th>Product</th>				
					<th><a href="http://www.scriptencryption.com/products/product_profile.php?p=<?php echo $value['product_id']; ?>&u=<?php echo FN_User_Get_Username($value['seller_id']); ?>" style="text-decoration: none;color: #FFFFFF;"><?php echo ucfirst($Json_Decode['title']); ?></a></th>
				  </tr>
				  <tr>
					<th>Seller</th>								
					<th><a href="http://www.scriptencryption.com/account/profile.php?u=<?php echo FN_User_Get_Username($value['seller_id']); ?>" style="text-decoration: none;color: #FFFFFF;"><?php echo FN_User_Get_Username($value['seller_id']); ?></a></th>						
				  </tr>
							 
				  <tr>
					<th>Quantity</th>
					<td><?php echo $value['quantity']; ?></td>				
				  </tr>
				  <tr>
					<th>Unit Price</th>
					<td>$<?php echo number_format($value['price'], 2, '.', ','); ?></td>		
				  </tr>	 
				  
				  <tr>
					<th>Status/Shipped</th>
					<td><?php echo ucfirst($Status); ?></td>				
				  </tr> 
				  
				  <tr>
					<th>Tracking Number: </th>
					<td><?php echo $Tracking_Number; ?></td>			
				  </tr>
				  
				  <tr>
					<th>Shipping company: </th>
					<td><?php echo $Tracking_Company; ?></td>
				  </tr>
				  
				  <tr>
					<th>Extra Information</th>
					<td><a href="../account/sellers_order_details.php?id=<?php echo $value['id']; ?>" class="btn">Details</a></td>
				  </tr>			
				  
				  </tbody>
				</table>
			<?php } ?>
			
			</div>

			
			
			
			
		
		
		
		
		</div>
			
  



<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


