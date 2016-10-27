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
		//header('Location: http://www.scriptencryption.com/error/404.php?error=100');
		//die();
	}
	
	
	
	//Do a search request.
	function FN_User_Search($CATEGORIE, $TITLE, $DESCRIPTION){
		//SELECT * FROM dwarvencthulhu.search_test WHERE title LIKE '%light%';
	
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
		
		$SQL_search_request = "SELECT id FROM search_test WHERE";
		
		$Mod = false;
		
		if(strlen($CATEGORIE) > 0){
			
			if($Mod == true){
				$SQL_search_request .= ' AND';
				$Mod = false;
			}
			
			$SQL_search_request .= ' categorie LIKE \'%' . $CATEGORIE . '%\'';			
			$Mod = true;
		}
		
		if(strlen($TITLE) > 0){
			
			if($Mod == true){
				$SQL_search_request .= ' AND';
				$Mod = false;
			}
			
			$SQL_search_request .= ' title LIKE \'%' . $TITLE . '%\'';			
			$Mod = true;
		}
		
		if(strlen($DESCRIPTION) > 0){
			
			if($Mod == true){
				$SQL_search_request .= ' AND';
				$Mod = false;
			}
			
			$SQL_search_request .= ' description LIKE \'%' . $DESCRIPTION . '%\'';			
			$Mod = true;
		}
		
		//echo $SQL_search_request; //'SELECT id FROM search_test WHERE title LIKE \'%light%\'
			
		try {
			$statement = $db->prepare($SQL_search_request . ' LIMIT 1000');			
		} catch (PDOException $e) {
								
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}
			
		try {
			//$statement->execute(array(':id' => $ID));
			$statement->execute();
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		

		
		$result = $statement->fetchAll();
		
		//var_dump($result);
		
		return $result;
	}
	
		//FUNCTIONS
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
	
	function FN_Farm_Get_Rating($Id){

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
	
	function FN_Farm_Load_Name($Id){
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT json_farminformation FROM users_farminformation WHERE id = :id');			
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

		$result = $result['json_farminformation'];
		
		$result = json_decode($result, true);
		
		//var_dump($result);
		
		return $result[0]['profile_name'];
	}
	
	function FN_Farm_Load_Rating_Count($Id){
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement = null; //The statement
			
		try {
			$statement = $db->prepare('SELECT totalsales FROM users_farm_rating WHERE id = :id');			
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
			return 0;
		}

		$result = $result['totalsales'];
			
		//var_dump($result);
		
		return $result;
	}
	
	
	
	
	
	
	
	
	
?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite">

 <head>
  
	<style>  	
	.spacer{
		padding-top: 5px;
		padding-bottom: 5px;
		
		margin-bottom: 5px;
		
		border-bottom:1px solid #BDC3C7;
		text-align:center;
		color:#06ba8f;
	}
	
	.product {

	  
	}
	
	.product p{
		color: #333;
		margin: 2px;
		
	}
	
	.product img {
		width: 225px;
		height: 225px;
	}	
	.product_title{
		color: #000000;	
	}	
	.product_title:hover{
		color: #2ECC71;	
	}
	
	
	</style>
 </head>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

	<?php
		$Search_Title = base64_decode($_GET['s'], true);
		$Search_Description = base64_decode($_GET['d'], true);
		$Search_Categorie = base64_decode($_GET['type'], true);
		
		if($Search_Title === false){$Search_Title = "";}	
		if($Search_Description == false){$Search_Description = "";}	
		if($Search_Categorie == false){$Search_Categorie = "";}
				
		$Result_List = FN_User_Search($Search_Categorie, $Search_Title, $Search_Title);
		
		if($Result_List == 'Internal_Server_Error' || $Result_List == 'Error_Try_Again'){
			
		}else{		
			foreach ($Result_List as &$value) {
				//var_dump($value);
			?>
			
			
			<div class="product">
			
		<div class="spacer" style="padding-bottom: 0px;"></div>
		<div class="container_12">
		
		<div class="grid_3">
		 <a href="projects/tic/index.php"><img class="work" src="../Assets/Images/section1.png"></a>
		</div>
		
		<div class="grid_6" style="padding-left: 10px;">
		 <h2><b class="product_title">Your a bitch, bitch!</b></h2>
		 <p style="font-size: 18px;"><b><a style="color: #000;">$84,723</a> / Unit</b></p>
		 <p>Shipping <b><a style="color: #000;">$4.32</a></b></p>
		 
		 <p>This product is <b><a style="color: #000;">Out of stock</a></b></p>
		 </div>
		 
		 <div class="grid_3" style="padding-left: 10px;">
		 
				<form method="post" class="sellerinformation" style="float:right;margin-top:10px;padding-right:10px" action="index.php" id="buynow" name="buynow">
					<b style="text-align: center;">Seller information</b><br>
					<?php 
					$User_Name = FN_User_Get_Id($Product_Owner);
					$Farm_Name = FN_Farm_Load_Name($User_Name);
					
					$User_Name = "buttholetown";
					$Farm_Name = "buttholetown";
					?>
					<a href="http://www.scriptencryption.com/account/profile.php?u=<?php echo $Product_Owner; ?>" style="color: #3A539B;text-decoration: none;" ><?php echo $Farm_Name; ?></a>
					<br><br>
					
					 Feedback for <?php echo FN_Farm_Load_Rating_Count($User_Name); ?> sales: <?php 
						$Product_Compressed_Rating = 3;
						
						if($Product_Compressed_Rating == -1){
							echo "N/A";
						}else{
							/*
							$How_many_Left = 5;
							while($Product_Compressed_Rating > 1){							
								echo '<i class="fa fa-star" style="color:#F9BF3B;float:right;"></i>';
							
								$Product_Compressed_Rating--;
								$How_many_Left--;
							}
														
							if($Product_Compressed_Rating == 0.5){
								echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;float:right;"></i>';
								$How_many_Left--;
							}
							
							while($How_many_Left > 0){
								echo '<i class="fa fa-star" style="color:#E5E5E5;float:right;"></i>';
								$How_many_Left--;
							}	*/

							$How_many_Left = 5;
							
							
							$Product_Compressed_Rating = 6 - $Product_Compressed_Rating;
							
							while($Product_Compressed_Rating > 1){							
								
							echo '<i class="fa fa-star" style="color:#E5E5E5;float:right;"></i>';
								$Product_Compressed_Rating--;
								$How_many_Left--;
							}
														
							if($Product_Compressed_Rating == 0.5){
								echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;float:right;"></i>';
								$How_many_Left--;
							}
							
							while($How_many_Left > 0){
								echo '<i class="fa fa-star" style="color:#F9BF3B;float:right;"></i>';
								$How_many_Left--;
							}							
						


							
						}
					?>
					
					
					
					Product rating: 
					<?php 
						//$Product_Compressed_Rating 	
						if($Product_Compressed_Rating == -1){
							echo "N/A";
						}else{
							$How_many_Left = 5;
							
							
							$Product_Compressed_Rating = 6 - $Product_Compressed_Rating;
							
							while($Product_Compressed_Rating > 1){							
								
							echo '<i class="fa fa-star" style="color:#E5E5E5;float:right;"></i>';
								$Product_Compressed_Rating--;
								$How_many_Left--;
							}
														
							if($Product_Compressed_Rating == 0.5){
								echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;float:right;"></i>';
								$How_many_Left--;
							}
							
							while($How_many_Left > 0){
								echo '<i class="fa fa-star" style="color:#F9BF3B;float:right;"></i>';
								$How_many_Left--;
							}								
						}
					?>
					
				<br><br>					
					
				</form>
			
 
 
		 
		 
		 
		 
		 
		 
		 <form method="post" style="float:right; padding-right: 10px;" action=" http://www.scriptencryption.com/cart/cart_add.php">	
						
			<input name="return_url" value="<?php echo base64_encode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" type="hidden">

			<input name="product_code" value="142" type="hidden">
			<input name="product_owner" value="user" type="hidden">
			<input name="product_quantity" value="1" type="hidden">		

			<input name="I amma unicorn." value="I AM TEH UNICORN AND I LIKE TO MAGIC RANDBOS ADN NO IS SCARE OF NO ONE!" type="hidden">	
						
			<input name="login" class="buynow addtocart" style="margin-top: 8px;border-style:none;" value="Add to cart" type="submit">
			</form>
		 		 
		
		</div>
	   </div>  
	</div>   
			
			
			
			
		
			<?php				
			}
		}
		
	?>

	
	
	

</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
