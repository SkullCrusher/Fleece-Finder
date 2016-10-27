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
	float:left;
	margin-left: -315px;
	padding-top: 50px;	
}

.cart-item-seller a{
	 text-decoration: none;
	 
	 color: #fff;
}

.cart-item-price{
	float:right;
	padding-top: 14px;
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
	padding-left: 10px;
	
	
}

.cart-footer a{
	float:right;
	padding-right: 150px;
}




</style>


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
			
			
			<input id="QTY_" type="text" class="textbox" style="float:right;margin-right: 20px;margin-top:14px;" name="QTY_" maxlength="4" value="1" required /></input>
			<label for="QTY_" style="float:right;margin-right: 5px;margin-top:15px;"><b>QTY</b></label>
				
			<div class="cart-item-seller">Sold by <a href="#">Seller's name</a></div>
			
			<div class="cart-item-price"><b>$10.32</b> / unit</div>
		</div>
		
		<div class="splitter"></div>
		
		
		<div class="cart-footer">
			<input type="submit" name="login" class="buynow addtocart" style="border-style:none;float:right;margin-left: -120px;margin-top: -8px;" value="Purchase" />
			<div class="cart-footer-description"><a>Cart total: $10,000.32</a></div>
			

		</div>
		
	
	
	
	
	</div>
	
	<div class="spacer"></div>
	
</div>



<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
