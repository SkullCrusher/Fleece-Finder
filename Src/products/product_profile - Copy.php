<?php
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */

// include the configure file

	// include the configure file
	require_once('../config/config.php');

	// load the login class
	require_once('../classes/Login.php');

	$login = new Login();

	if ($login->isUserLoggedIn() == true) {
	   //echo $_SESSION['user_name'];
	} else {	
		//just for the nav bar and if they click add to cart it forces login.
	//	include("index.php");
	//	die();
	}
	
	//Global variables. 
	
	//(Abbreviated)
	$Product_Title				= null;
	$Product_Owner 				= null;
	$Product_Short_Description 	= null;
	$Product_Category			= null;
	$Product_Pictures			= array();	
	$Product_Price				= null;
	
	//(extended)
	$Product_Long_Description 	= "No more information provided.";
	$Product_Terms_Of_Sale		= null;
	$Product_Compressed_Rating	= null;
	$Quantity					= null;
	$Shipping_Cost				= null;
	$Shipping_Cost_Multiple		= null;
	
	//The ratings
	$Product_Ratings			= array();
	
	
	
	
	//We need both the owner and the product id.
	if(strlen($_GET['p']) < 1 || strlen($_GET['u']) < 1){
		//We don't have both, give 404 page.
		
		header("Location: http://www.scriptencryption.com/error/404.php?error=1");
		die();
	}else{ 
		//No problem with the $_GET's so we check the database for those.		
		//Remove all non number characters before do the request for (p)roduct.		
		$Input_Product_Id = preg_replace("/[^0-9]/", "", $_GET['p']);
		
		//Abbreviated ----------------------------------------
	
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
			$statement->execute(array(':id' => $Input_Product_Id));
		} catch (PDOException $e) {				
			header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
			die();
		}		

		$result = $statement->fetch();
		
		//Check to see if there was a product to match it.
		if($result == null){
			//We did not get anything back so it must not be valid.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Decode the json and check to see if the owner matches.		
		$Product_Json_Decoded_Abbreviated = json_decode($result['json_condensed'], true);
				
		if($Product_Json_Decoded_Abbreviated['owner'] != $_GET['u']){
			//It does not match.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Extended ------------------------------------------------------------
		$statement = null; //The statement	
			
		try {
			$statement = $db->prepare('SELECT json_extended FROM product_extended WHERE id = :id');			
		} catch (PDOException $e) {		
			header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
			die();
		}
			
		try {
			$statement->execute(array(':id' => $Input_Product_Id));
		} catch (PDOException $e) {					
			header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; 
			die();
		}		

		$result = $statement->fetch();
		
		//Check to see if there was a product to match it.
		if($result == null){
			//We did not get anything back so it must not be valid.
			header("Location: http://www.scriptencryption.com/error/404.php?error=1"); //Handle error
			die();		
		}
		
		//Decode the json and check to see if the owner matches.		
		$Product_Json_Decoded_Extended = json_decode($result['json_extended'], true);
	
		//Global variables. 
		
		//(Abbreviated)
		$Product_Title				= $Product_Json_Decoded_Abbreviated['title'];
		$Product_Owner 				= $Product_Json_Decoded_Abbreviated['owner'];
		$Product_Short_Description 	= $Product_Json_Decoded_Abbreviated['short_description'];
		$Product_Category			= $Product_Json_Decoded_Abbreviated['category'];
		$Product_Price				= $Product_Json_Decoded_Abbreviated['price'];
		
		$Product_Pictures = $Product_Json_Decoded_Abbreviated['picture'];		
			
		//(extended)
		if(strlen($Product_Json_Decoded_Extended['long_description']) > 2){
			$Product_Long_Description 	= $Product_Json_Decoded_Extended['long_description'];
		}
		
		$Product_Terms_Of_Sale		= $Product_Json_Decoded_Extended['terms_of_sale'];
		$Product_Compressed_Rating	= $Product_Json_Decoded_Extended['compressed_rating'];
		$Quantity					= $Product_Json_Decoded_Extended['quantity'];
		
		$Shipping_Cost = $Product_Json_Decoded_Extended['shipping_cost'];
		$Shipping_Cost_Multiple = $Product_Json_Decoded_Extended['shipping_cost_multiple'];
		
		
		//Get the rating information.
		//$Product_Ratings			= array();
		
		
		$db_Ratings = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db_Ratings->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db_Ratings->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$statement_Ratings = null; //The statement	
			
		try {
			$statement_Ratings = $db_Ratings->prepare('SELECT json_rating FROM product_rating WHERE id = :id');			
		} catch (PDOException $e) {	
			header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
			die();
		}
			
		try {
			$statement_Ratings->execute(array(':id' => $Input_Product_Id));
		} catch (PDOException $e) {				
			header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
			die();
		}		

		$result_Ratings = $statement_Ratings->fetch();
				
		//Decode the json and check to see if the owner matches.		
		$Product_Ratings = json_decode($result_Ratings['json_rating'], true);
		
		if($Product_Ratings == null){
			$Product_Ratings = "No reviews.";
		}
		
	}
	

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Debuging</title>
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/normalize.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/960.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/font-awesome.css?<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../Assets/CSS/theme.css?<?php echo time(); ?>">
  <script type="text/javascript" src="../Assets/Javascript/html5shiv.js?<?php echo time(); ?>"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 </head>
 <body>
  <header class="clearfix">
   <div class="container_12">
    <div class="logo">
     <a href="index.php"><img src="../Assets/Images/logo.png"></a>
     <div class="search">
      <form action="/search.html" class="search-wrapper cf">
       <input type="text" placeholder="Search here..." required="">
       <button type="submit">Search</button>
      </form>
     </div>
    </div>
   </div>
  </header>
  <div class="bottom-nav">
   <div class="container_12">
    <ul>
   	 <li><a href="index.php"><i class="fa fa-home"></i></a></li>
   	 <li><a href="#">Browse</a></li>
   	 <li><a href="#">Categories</a></li>
   	 <li><a href="#">Most Popular</a></li>
   	 <li><a href="#">Create an Account</a></li>
   	 <li><a href="#">Login</a></li>
    </ul>
   </div>
  </div>
  
   <div class="page-wrap">	
	
		<div class="container_12 backgroundwhite">
		
			<div class="grid_4">
				<div class="grid_1" id="mainPhoto" style="float:left;">
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" id="img_large" style="margin-bottom:1px;" height="300" width="300"> 
				</div>
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_1()" class="thumbnail" height="30" width="30"> 
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_2()" class="thumbnail" height="30" width="30"> 
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_3()" class="thumbnail" height="30" width="30"> 
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_4()" class="thumbnail" height="30" width="30"> 
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_5()" class="thumbnail" height="30" width="30"> 
				 <img src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png" onclick="change_img_6()" class="thumbnail" height="30" width="30"> 
				
							
			</div>
			<div class="grid_7 title" style="margin-bottom:10px;">
			 <!--The product title goes here! What happens if it is really long?!!!!!!!-->
			 <?php echo $Product_Title; ?>
			</div>
			<div class="grid_5" style="margin-bottom:10px;">
			<?php echo $Product_Short_Description; ?>
			  <!--The short description about the product goes here which is limited to a max of 80 characters.-->
			</div>
			
			<div class="grid_4" >
				<form method="post" class="sellinginformation aligncenter" action="index.php" id="buynow" name="buynow">
				<b style="margin-left:10px;">Selling Price: </b>$<?php echo $Product_Price; ?>/Unit<br>
				<b style="margin-left:10px;">Shipping Costs: </b>$<?php echo $Shipping_Cost; ?><br>
				<b style="margin-left:10px;">Quantity: </b>
				 <select>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="20">20</option>
				  <option value="50">50</option>
				</select><br>
				
				<a href="index.php?feece" class="buynow addtocart" style="margin-top: 8px;"><span><i class="icon-github"></i></span>Add to cart</a>
				</form>
			</div>
			<div class="grid_3">
				<form method="post" class="sellerinformation" action="index.php" id="buynow" name="buynow">
					<b>Seller information</b><br>
					Awesome farm name!<br><br>
					
					100% feedback for 1,302 sales<br>
					
					Product rating: 
					<?php 
						//$Product_Compressed_Rating 	
						if($Product_Compressed_Rating == -1){
							echo "N/A";
						}else{
							$How_many_Left = 5;
							while($Product_Compressed_Rating > 1){							
								echo '<i class="fa fa-star" style="color:#F9BF3B;"></i>';
							
								$Product_Compressed_Rating--;
								$How_many_Left--;
							}
														
							if($Product_Compressed_Rating == 0.5){
								echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;"></i>';
								$How_many_Left--;
							}
							
							while($How_many_Left > 0){
								echo '<i class="fa fa-star" style="color:#E5E5E5"></i>';
								$How_many_Left--;
							}							
						}
					?>
					
					<!-- <i class="fa fa-star" style="color:#F9BF3B;"></i><i class="fa fa-star" style="color:#E5E5E5"></i><i class="fa fa-star" style="color:#E5E5E5"></i><i class="fa fa-star" style="color:#E5E5E5"></i><i class="fa fa-star" style="color:#E5E5E5"></i> -->
				<br><br>					
					
				</form>
			</div>
			</div>
			
			<div class="container_12 backgroundwhite">

			<style>
			
			h1 {
			  font-size: 20px;
			  font-weight: bold;
			  text-align: center;
			  text-transform: uppercase;
			}
			h1 + p {
			  text-align: center;
			  margin: 0px 0;
			  font-size: 16px;
			}
			.tabs li {
				list-style: none;
			  float: left;
			  width: 20%;
			}
			.tabs a {
				
			  display: block;
			  text-align: center;
			  text-decoration: none;
			  text-shadow:0px 1px 0px rgba(255,0,0,0.5);
			  color: #FFF;
			  padding: 10px 0;
			  border-bottom: 2px solid #888;
			  background: #333;
			}
			.tabs a:hover,
			.tabs a.active {
			  background: #2ECC71;
			}
			.tabgroup-div {
			  padding: 30px;
			  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
			}
			.clearfix:after {
			  content: "";
			  display: table;
			  clear: both;
			}
			
			</style>
			
			<ul class="tabs clearfix" data-tabgroup="first-tab-group">
			  <li><a href="#tab1" style="margin-left:-10px;">Additional details</a></li>
			  <li><a href="#tab2">Terms of sale</a></li>
			  <li><a href="#tab3">Reviews</a></li>
			
			</ul>
			<section id="first-tab-group" class="tabgroup-div">
			  <div id="tab1">
				<h2>Additional details about the product</h2>
				<p><?php echo $Product_Long_Description; ?></p>
			  </div>
			   <div id="tab2">
				<h2>Terms of sale</h2>
				<p><?php echo $Product_Terms_Of_Sale; ?></p>
			  </div>
			  <div id="tab3">
				<h2>Reviews</h2>
				
				<?php
				
					if($Product_Ratings == "No reviews."){
						echo "No reviews.";
					}else{
						$MultipleRatings = true;
					
						foreach ($Product_Ratings as &$value) {
							if(count($value) == 1){
								$MultipleRatings = false;
								break;
							}				
						}
						
						if($MultipleRatings == true){
							//there are multiple ratings.
						
							foreach ($Product_Ratings as &$value) {
								?>
								<div class="review-container" style="padding: 0px 0px 0px 0px;">					
									<div class="review-header" >
									<b>
									<?php echo $value['title']; ?> - <div class="review-header-name"><?php echo $value['username']; ?></div> 
									<div class="review-header-stars">								
									<?php 
										$StarsLeft = 5;
									
										for($i = 0; $i < $value['rating'];$i++){ 
											$Part = $value['rating'] - $i;
											if($Part == 0.5){
												echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;"></i>';
											}else{
												echo '<i class="fa fa-star" style="color:#F9BF3B;"></i>';
											}
											$StarsLeft--;
										}
										
										for($i = 0; $i < $StarsLeft; $i++){
											echo '<i class="fa fa-star" style="color:#E5E5E5;"></i>';
										}
										
										?>
										</b>
										</div>
									</div>
									
									<p><?php echo $value['long_description']; ?></p>
								</div>							
								<?php
						
							}
						}else{
							
							?>
							<div class="review-container" style="padding: 0px 0px 0px 0px;">					
								<div class="review-header" >
								<b>
								<?php echo $Product_Ratings['title']; ?> - <div class="review-header-name"><?php echo $Product_Ratings['username']; ?></div> 
								<div class="review-header-stars">								
								<?php 
									$StarsLeft = 5;
								
									for($i = 0; $i < $Product_Ratings['rating'];$i++){ 
										$Part = $Product_Ratings['rating'] - $i;
										if($Part == 0.5){
											echo '<i class="fa fa-star-half-empty" style="color:#F9BF3B;"></i>';
										}else{
											echo '<i class="fa fa-star" style="color:#F9BF3B;"></i>';
										}
										$StarsLeft--;
									}
									
									for($i = 0; $i < $StarsLeft; $i++){
										echo '<i class="fa fa-star" style="color:#E5E5E5;"></i>';
									}
									
									?>
									</b>
									</div>
								</div>
								
								<p><?php echo $Product_Ratings['long_description']; ?></p>
							</div>							
							<?php						
						}
						
					}


				?>
			
			</div>
			 
		
			</section>
		
			
			</div>
			
			<script>
			$('.tabgroup > div').hide();
			$('.tabgroup > div:first-of-type').show();
			$('.tabs a').click(function(e){
			  e.preventDefault();
				var $this = $(this),
					tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
					others = $this.closest('li').siblings().children('a'),
					target = $this.attr('href');
				others.removeClass('active');
				$this.addClass('active');
				$(tabgroup).children('div').hide();
				$(target).show();
			  
			})
    
			</script>
			
  </div>
  
  <script>
	function change_img_1(){document.getElementById("img_large").src="Assets/Images/300x300.gif";}
	function change_img_2(){document.getElementById("img_large").src="Assets/Images/300x300.gif";}
	function change_img_3(){document.getElementById("img_large").src="Assets/Images/300x300.gif";}
	
	function change_img_4(){document.getElementById("img_large").src="Assets/Images/300x300.gif";}
	function change_img_5(){document.getElementById("img_large").src="Assets/Images/300x300.gif";}
	function change_img_6(){document.getElementById("img_large").src="http://i.gyazo.com/091998f67a1e5115e7a5632d8a86f8ad.png";}
	
  
   
  </script>
  
  
 <footer class="site-footer">
	 <div class="container_12">
	 
	 <div class="options">
		<ul>
			<a href="#"><li>What is FleeceFinder.com?</li></a>
			<a href="#"><li>FAQ</li></a>
			<a href="#"><li>Support</li></a>
			<a href="#"><li>Report bug</li></a>
			<a href="#"><li>Terms of use</li></a>
		</ul>
	  </div>
	  
	  <div class="company">	
		 <ul>
		  <li><i>Copyright <?php echo date('Y'); ?> </i><b>Dwarven Knowledge, LLC</b></li>
		  <li><i>All rights reserved.</i></li>
		  
		  <a href="#"><li style="padding-top:10px;"><b>Contact us</b></li></a>
		  <li style="padding-top:5px;"><a href="http://www.twitter.com/DearRicky" target="_blank" title="Twitter"><img src="https://g.twimg.com/Twitter_logo_blue.png" width="25" height="25" /></a></li>
		</ul> 
	  </div>
	  
	    

	  </div>
</footer>
  
 </body>
</html>