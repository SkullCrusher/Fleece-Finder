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
		
		border-bottom:1px solid #333333;
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
			}
		}
		
	?>
	<div class="spacer" style=""></div>
	
	
	<div class="product">
		<div class="container_12">   
		
		<div class="grid_3">
		 <a href="projects/tic/index.php"><img class="work" src="../Assets/Images/section1.png"></a>
		</div>
		
		<div class="grid_9" style="padding-left: 10px;">
		 <h2><b class="product_title">Your a bitch, bitch!</b></h2>
		 <p style="font-size: 18px;"><b><a style="color: #000;">$84,723</a> / Unit</b></p>
		 <p>Shipping <b><a style="color: #000;">$4.32</a></b></p>
		 
		 <p>This product is <b><a style="color: #000;">Out of stock</a></b></p>
		 
		 
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
  

</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
