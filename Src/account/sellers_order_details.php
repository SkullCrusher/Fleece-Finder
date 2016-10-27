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
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
		die();
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
	
	function FN_Mark_As_Shipped($id){
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('UPDATE product_order SET status = :status WHERE id = :id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			$statement->execute(array(':id' => $id, ':status' => 'shipped'));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
	}
	
	function FN_Set_Tracking_Code($id, $trackingcode){
		
		strip_tags ($trackingcode);		
		$str = substr($trackingcode, 0, 50);
		
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('UPDATE product_order SET tracking_code = :tracking_code WHERE id = :id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
	
			
		try {
			$statement->execute(array(':id' => $id, ':tracking_code' => $str));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
	}
	
	function FN_Set_Company_Code($id, $companycode){
		
		strip_tags ($companycode);		
		$str = substr($companycode, 0, 45);
		
		
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('UPDATE product_order SET package_carrier = :package_carrier WHERE id = :id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
	
			
		try {
			$statement->execute(array(':id' => $id, ':package_carrier' => $str));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
	}
	
	function FN_Cancel_Shipping($id){	

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('UPDATE product_order SET canceled = :canceled WHERE id = :id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':id' => $id, ':canceled' => 'true'));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
	}
	
	//FN_Mark_As_Shipped(
	if(strlen($_GET['ship']) > 1){
		FN_Mark_As_Shipped($_GET['id']);		
	}
	
	if(strlen($_POST['trackingnumber']) > 0){
		FN_Set_Tracking_Code($_GET['id'], $_POST['trackingnumber']);
	}
	
	if(strlen($_POST['companycode']) > 0){
		FN_Set_Company_Code($_GET['id'], $_POST['companycode']);
	}
	
	if(strlen($_GET['canceled']) > 0){
		FN_Cancel_Shipping($_GET['id']);
	}
	
	
	
	$Product_Loaded = FN_Product_Order($_GET['id']);
	$Order_Information = FN_Order_Information($Product_Loaded['order_information_id']);	
	$Shipping_Information = FN_Ship_Information($Product_Loaded['shipping_id']);
	
	$Product_abbreviated = json_decode(FN_product_abbreviated($Product_Loaded['product_id']), true);
	
	$Shipping_Cost_Multiple = $Product_abbreviated['shipping_cost_multiple'];
	
	//var_dump($Product_Loaded['product_id']);
	
	//Defaults	
	$Buyer = htmlspecialchars(FN_User_Get_Username($Product_Loaded['customer_id']), ENT_QUOTES);		
	$Order_Date = htmlspecialchars($Order_Information['order_date'], ENT_QUOTES);		
	$Ship_By_Date = strtotime("+5 day", strtotime($Order_Date));	
	$Quantity = htmlspecialchars($Product_Loaded['quantity'], ENT_QUOTES);	
	
	$Unit_Price = htmlspecialchars($Product_Loaded['price'], ENT_QUOTES);	
	$Shipping_Multiple = htmlspecialchars($Shipping_Cost_Multiple, ENT_QUOTES);	
	$Shipping_Price = htmlspecialchars($Product_Loaded['price'], ENT_QUOTES);

	$Shipping_Price_unchanged = $Shipping_Price;
		
	if($Shipping_Multiple){$Shipping_Price = $Shipping_Price * $Quantity;}	
	$Total_price = ($Unit_Price * $Quantity) + $Shipping_Price;		
	
	$Address = htmlspecialchars($Shipping_Information['address'], ENT_QUOTES);	
	$City = htmlspecialchars($Shipping_Information['city'], ENT_QUOTES);	
	$State = htmlspecialchars($Shipping_Information['state'], ENT_QUOTES);	
	$Country = htmlspecialchars($Shipping_Information['country'], ENT_QUOTES);	
	$Phone_Number = htmlspecialchars($Shipping_Information['phone_number'], ENT_QUOTES);	
	$Special_Message = htmlspecialchars($Product_Loaded['comments'], ENT_QUOTES);	
	$Status = htmlspecialchars($Product_Loaded['status'], ENT_QUOTES);	
	$Tracking_Number = htmlspecialchars($Product_Loaded['tracking_code'], ENT_QUOTES);	
	$Tracking_Company = htmlspecialchars($Product_Loaded['package_carrier'], ENT_QUOTES);	
	$Canceled = htmlspecialchars($Product_Loaded['canceled'], ENT_QUOTES);	

	//$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
	//echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;	
	
	
	

	
?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">			
			<div class="grid_12 title" style="margin-bottom:20px; text-align:center;">		 
				<b>Extra information</b>	
			</div>
		</div>
	
		<div class="container_12 backgroundwhite" style="margin-bottom:10px;">

			<style> 

			#containerz{
			width:958px;
			height:750px;
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
			  height:35px;
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
			  padding: 20px;
			  font-size:12px;
			}

			#containerz tfoot tr{
			  background:none;
			}
			</style>
				
			<div id="containerz" style="margin-top: -20px;margin-bottom: 280px;">
			<table>
			 <thead>
			  <tr>
				<th scope="col"></th>
				<th scope="col"></th>				
			  </tr>
			  </thead>
			  <tbody>
			  <tr>
				<th>Buyer</th>				
				<th><a href="http://www.scriptencryption.com/account/profile.php?u=<?php echo $Buyer; ?>" style="text-decoration: none;color: #FFFFFF;"><?php echo $Buyer; ?></a></th>						
			  </tr>
			  <tr>
				<th>Sale date</th>
				<td><?php echo $Order_Date; ?></td>				
			  </tr>
			  <tr>
				<th>Ship by date</th>
				<td><?php echo date("Y/m/d", $Ship_By_Date); ?></td>				
			  </tr>
			  <tr>
			  	<th>Quantity</th>
				<td><?php echo $Quantity; ?></td>				
			  </tr>
			  <tr>
				<th>Unit Price</th>
				<td>$<?php echo number_format($Unit_Price, 2, '.', ','); ?></td>		
			  </tr>		

			  <tr>
				<th>Shipping cost <?php if($Shipping_Multiple){ echo "unit";} ?></th>
				<td>$<?php echo number_format($Shipping_Price_unchanged , 2, '.', ','); ?></td>		
			  </tr>	
			  <tr>
			  	<th>Shipping collected</th>
				<td>$<?php echo number_format($Shipping_Price, 2, '.', ','); ?></td>				
			  </tr>
			  <tr>
			  	<th>Total collected</th>
				<td>$<?php echo number_format($Total_price, 2, '.', ','); ?></td>			
			  </tr>
			  <tr>
			  	<th>Shipping address</th>
				<td><?php echo $Address . ', ' . $City; ?></td>				
			  </tr>
			   <tr>
			  	<th>Shipping state</th>
				<td><?php echo $State; ?></td>			
			  </tr>
			   <tr>
			  	<th>Shipping country</th>
				<td><?php echo $Country; ?></td>					
			  </tr>
			   <tr>
			  	<th>Customer phone number</th>
				<td><?php echo $Phone_Number; ?></td>					
			  </tr>
			  <tr>
			  	<th>Special message</th>
				<td><?php echo $Special_Message; ?></td>			
			  </tr>
			  <tr>
			  	<th>Shipped: <?php echo $Status; ?></th>
				<td><a href="sellers_order_details.php?id=<?php echo $_GET['id']; ?>&ship=true" class="btn">Mark as Shipped</a></td>				
			  </tr> 
			  
			  <tr>
			  	<th>Tracking Number: <?php echo $Tracking_Number; ?></th>
				<td>
				<form method="post" action="sellers_order_details.php?id=<?php echo $_GET['id']; ?>&trackingnumber=true" id="create_product_new" name="create_product_new">
					<input id="trackingnumber" class="textbox" style="width: 100px;margin-top: 0px;" type="text" name="trackingnumber" placeholder="Ex: 102937825401"/></input>					 
					<input type="submit" class="btn" style="margin-top: 0px;padding-top:3px" name="register" value="Set tracking number" />
				</form>
				</td>			
			  </tr>
			  
			  <tr>
			  	<th>Shipping company: <?php echo $Tracking_Company; ?></th>
				<td>
				<form method="post" action="sellers_order_details.php?id=<?php echo $_GET['id']; ?>&ship=true" id="create_product_new" name="create_product_new">
					<input id="companycode" class="textbox" style="width: 100px;margin-top: 0px;" type="text" name="companycode" placeholder="Ex: USPS"/></input>					 
					<input type="submit" class="btn" style="margin-top: 0px;padding-top:3px" name="register" value="Set shipping company" />
				</form>
				</td>
			  </tr>
			  
			  <tr>
			  	<th>Canceled: <?php echo $Canceled; ?></th>
				<td><a href="sellers_order_details.php?id=<?php echo $_GET['id']; ?>&canceled=true" class="btn">Cancel Order</a></td>
			  </tr>
			  
			  </tbody>
			</table>
			</div>

			
			
			
			
		
		
		
		
		</div>
			
  



<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


