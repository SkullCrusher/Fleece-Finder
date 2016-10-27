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
	
	//Load the purchase history
	function FN_Purchase_History($id){	

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM product_order WHERE customer_id = :customer_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':customer_id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetchAll();

		return $result;
	}
	
	//Load the extra information
	function FN_Order_Information($id){	

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM order_information WHERE buyer_id = :buyer_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':buyer_id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetchAll();

		return $result;
	}
	
		//Load the extra information
	function FN_Order_Information_Sold($id){	

		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM order_information WHERE buyer_id = :seller_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':seller_id' => $id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetchAll();

		return $result;
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
	
	
	function FN_Archive_Id($Id, $user_id){
				
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT * FROM archive_table WHERE user_id = :user_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':user_id' => $user_id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		

		//check if it's null or we should +=
		if($result == false){
		
			$FF = array($Id);			
					
			$statement = $db->prepare('INSERT INTO archive_table (user_id, blocked_numbers) VALUES (:user_id, :blocked_numbers)');
			$statement->execute(array(':user_id' => $user_id, ':blocked_numbers' => json_encode($FF)));
	
		}
		else{
			
			$JSONNO = json_decode($result['blocked_numbers'], true);
			
			array_push ($JSONNO, $Id);			
			
			$SS = json_encode($JSONNO);
			
			$statement = $db->prepare('UPDATE archive_table SET blocked_numbers = :blocked_numbers WHERE user_id = :user_id');
			$statement->execute(array(':user_id' => $user_id, ':blocked_numbers' => $SS));
		}
		
		
		
	}
	
	if(strlen($_GET['archive']) > 0){

		FN_Archive_Id(preg_replace("/[^0-9,.]/", "", $_GET['archive']), FN_User_Get_Id($_SESSION['user_name']));
	}
	
	
	function FN_Archive_Block_List($user_id){
				
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT blocked_numbers FROM archive_table WHERE user_id = :user_id');			
		} catch (PDOException $e) {
			
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
				
		try {
			$statement->execute(array(':user_id' => $user_id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();

var_dump($result);		
		
		$result = json_decode($result, true);
		
		
		echo "SADASD";
		
		var_dump($result);
				
		
		
		return $result['blocked_numbers'];
	}
	
?>

	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">			
			<div class="grid_12 title" style="margin-bottom:20px; text-align:center;">		 
				<b>Purchase History</b>				
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
			
			
			
			<div id="containerz" style="margin-top: -20px;">
			<table>
			 <thead>
			  <tr>
				<th scope="col">Order Id</th>
				<th scope="col">Order Date</th>
				
				<th scope="col">Total Cost</th>						
				
				<th scope="col">Purchase Date</th>
				<th scope="col">Details</th>
				<th scope="col">Archive</th>
			  </tr>
			  </thead>
			  <tbody>
			  <?php

				//$Purchase_History = FN_Purchase_History(FN_User_Get_Id($_SESSION['user_name']));
				$Purchase_History = FN_Order_Information(FN_User_Get_Id($_SESSION['user_name']));
				
				$blocked_numbers = FN_Archive_Block_List(FN_User_Get_Id($_SESSION['user_name']));
						
				foreach ($Purchase_History as &$value) {
					
					//$Load_Extra = FN_Order_Information($value['order_information_id']);
					
					var_dump($blocked_numbers);
					
					if(in_array($value['id'], $blocked_numbers)){
						//Blocked
						echo "blocked";
					}
					
					
					echo '<tr>';
					echo '<th><a href="#" style="text-decoration: none;color: #FFFFFF;">' . $value['id'] . '</a></th>';	
					echo '<td><a href="#" style="text-decoration: none;color: #FFFFFF;">' . $value['order_date'] . '</a></td>';
					
					echo '<td>$' . $value['price'] . '</td>';
					
					//Handle the case where it says Ipn_pending  
					if($value['status'] == 'ipn_pending'){
						echo '<td>' . 'Payment Pending' . '</td>';
					}else{
						echo '<td>' . ucfirst($value['status']) . '</td>';
					}
				
					echo '<td><a href="../account/sellers_order_overview.php?id=' . $value['id'] . '" class="btn">Details</a></td>';
					echo '<td><a href="../account/sellers_dashboard.php?archive=' . $value['id'] . '" class="btn">Archive</a></td>';
					echo '</tr>';
				}
			  ?>			
			  </tbody>
			</table>
			</div>

			
			
			
			
		
		
		
		
		</div>
		

		
		<div class="container_12 backgroundwhite">			
			<div class="grid_12 title" style="margin-bottom:20px; text-align:center;">		 
				<b>Sales Information</b>				
			</div>
		</div>
	
		<div class="container_12 backgroundwhite" style="margin-bottom:10px;">

			<div id="containerz" style="margin-top: -20px;">
			<table>
			 <thead>
			  <tr>
				<th scope="col">Order Id</th>
				<th scope="col">Order Date</th>
				
				<th scope="col">Total Cost</th>						
				
				<th scope="col">Purchase Date</th>
				<th scope="col">Details</th>
				<th scope="col">Archive</th>
			  </tr>
			  </thead>
			  <tbody>
			  <?php

				//$Purchase_History = FN_Purchase_History(FN_User_Get_Id($_SESSION['user_name']));
				$Purchase_History = FN_Order_Information_Sold(FN_User_Get_Id($_SESSION['user_name']));
				
						
				foreach ($Purchase_History as &$value) {
					
					echo '<tr>';
					echo '<th><a href="#" style="text-decoration: none;color: #FFFFFF;">' . $value['id'] . '</a></th>';	
					echo '<td><a href="#" style="text-decoration: none;color: #FFFFFF;">' . $value['order_date'] . '</a></td>';
					
					echo '<td>$' . $value['price'] . '</td>';
					
					//Handle the case where it says Ipn_pending  
					if($value['status'] == 'ipn_pending'){
						echo '<td>' . 'Payment Pending' . '</td>';
					}else{
						echo '<td>' . ucfirst($value['status']) . '</td>';
					}
				
					echo '<td><a href="../account/sellers_order_overview.php?id=' . $value['id'] . '" class="btn">Details</a></td>';
					echo '<td><a href="../account/sellers_dashboard.php?archive=' . $value['id'] . '" class="btn">Archive</a></td>';
					echo '</tr>';
				}
			  ?>			
			  </tbody>
			</table>
			</div>

			
			
			
			
		
		
		
		
		</div>
			
  


<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


