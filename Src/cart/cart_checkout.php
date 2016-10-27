<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>


<style>
.cart-container{
	width:938px;
		
	border: 1px solid #333;	
	border-bottom-style: none;
	margin-right: 10px;		
	margin-left: 10px;
	
}

.cart-nav{
	height: 50px;
	
	padding-bottom: 30px;	 
	background-color: #333;	
}

.cart-nav p{
  display:block;
  font-size:16px;
  text-align:center;
  width:35%;
  margin-top: 13px;
  float:left;
  margin-left:2%;
  color: #FFF;
}

.cart-item{
	background-color: #2ECC71;
	height: 100px;
}

.cart-item img{
	float:left;
	border: 1px solid #E5;	
}

.cart-item-description{
	float:left;
	padding-left: 10px;
	padding-top: 15px;
}

.cart-item-seller{
	
	margin-left: -315px;
	padding-top: 50px;	
}

.cart-item-seller a{
	 text-decoration: none;
	 
	 color: #fff;
}

.cart-item-price{
	float:right;
	
	padding-right: 10px;
}

.splitter{
height:1px;
background-color: #000;
}

.spacer{
padding-bottom:10px;
}


.cart-item input{
	width: 30px;
}


.cart-footer{
	background-color: #333;
	height: 50px;
	color: #fff;
	
	padding-top:12px;
	padding-left: 5px;	
}

.cart-footer a{
	float:right;
	padding-right: 150px;
}

.cart-footer-update{
	background-color: #D83C3C;
	float:left;
	color: #FFF;
}

.cart-footer-update:hover{
	color: #000;
}

</style>

<script language="JavaScript">
	function product_1(element) {
		document.getElementById("product_1").value = "";
	}			
</script>


		<?php 
			//output the items.
			
			print_r($_SESSION['cart']);		
		?>

<div class="container_12 backgroundwhite">

	<p style="text-align:center;font-size: 300%;margin-top:0px;margin-left:0px;"><b>Cart</b></p>
	
	<div class="cart-container">
		<div class="cart-nav">
			<p style="textinside"><b>Cart has 0 items</b></p>
		</div>
		<div class="splitter"></div>
		<div class="cart-item">
			<img src="http://www.scriptencryption.com/images/upload_images/user/1419625634.jpg" width="100" height="100">	

			<div class="cart-item-description">Title about the item that is a link to the product</div>
						
			<input id="QTY_" type="text" class="textbox" style="float:right;margin-right: 20px;margin-top:14px;" name="QTY_" maxlength="4" value="1" onchange="product_1('f')" required /></input>
			<label for="QTY_" style="float:right;margin-right: 5px;margin-top:15px;"><b>QTY</b></label>
				
			<div class="cart-item-seller">Sold by <a href="#">Seller's name</a></div>
			
			<div class="cart-item-price"><b>$10.32</b> / unit</div>
		</div>
		
		<div class="splitter"></div>
		
		<?php 
			//output the items.
						
			foreach($_SESSION['cart'] as &$value){
				//print_r($value);
				
				$value['product_code'] = 142;
				
				$Product_ID = filter_var($value['product_code'], FILTER_SANITIZE_NUMBER_INT); //product code
				
				
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
				
				//print_r($Json_Decode);
				
				
				echo '<div class="cart-item">';
				echo '<img src="http://www.scriptencryption.com/images/upload_images/user/1419625634.jpg" width="100" height="100">';

				echo '<div class="cart-item-description">' . $Json_Decode['title'] .'</div>';
									
				echo '<input id="QTY_" type="text" class="textbox" style="float:right;margin-right: 20px;margin-top:14px;" name="QTY_" maxlength="4" value="1" onchange="product_1("f")" required /></input>';
				echo '<label for="QTY_" style="float:right;margin-right: 5px;margin-top:15px;"><b>QTY</b></label>';
							
				echo '<div class="cart-item-seller">Sold by <a href="#">' . $Json_Decode['owner'] . '</a></div>';
						
				echo '<div class="cart-item-price"><b>$10.32</b> / unit</div>';
				echo '</div>';
				
				
				/*
					<div class="cart-item">
						<img src="http://www.scriptencryption.com/images/upload_images/user/1419625634.jpg" width="100" height="100">	

						<div class="cart-item-description">Title about the item that is a link to the product</div>
									
						<input id="QTY_" type="text" class="textbox" style="float:right;margin-right: 20px;margin-top:14px;" name="QTY_" maxlength="4" value="1" onchange="product_1('f')" required /></input>
						<label for="QTY_" style="float:right;margin-right: 5px;margin-top:15px;"><b>QTY</b></label>
							
						<div class="cart-item-seller">Sold by <a href="#">Seller's name</a></div>
						
						<div class="cart-item-price"><b>$10.32</b> / unit</div>
					</div>
				*/
				
				echo '<div class="splitter"></div>';
			}
		
		
		?>
		
		
		
	
		
		
		<div class="cart-footer">
			<input type="submit" name="login" class="buynow addtocart" style="border-style:none;float:right;margin-left: -120px;margin-top: -8px;margin-right: 5px;" value="Purchase" />
		
			<form method="post" action="cart_checkout.php">		
				<input type="hidden" name="product_1" id="product_1" value="001" />					
					
				<input type="submit" name="login" class="buynow addtocart cart-footer-update" style="border-style:none;margin-left: 0px;margin-top: -8px; background-color: #D83C3C;" value="Update QTY" />
			</form>
			
			
			<div class="cart-footer-description"><a>Cart total: $10,000.32</a></div>			
		</div>		
	</div>
	
	<div class="spacer"></div>
	
</div>


<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
