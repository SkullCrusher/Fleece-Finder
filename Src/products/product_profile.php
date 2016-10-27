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
	
	//The amount
	$Product_Amount				= null;
	//The unit
	$Product_Unit				= "Unit";
	
	$Picture_1 = "../Assets/Images/300x300.gif";
	$Picture_2 = "../Assets/Images/300x300.gif";
	$Picture_3 = "../Assets/Images/300x300.gif";
	$Picture_4 = "../Assets/Images/300x300.gif";
	$Picture_5 = "../Assets/Images/300x300.gif";
	$Picture_6 = "../Assets/Images/300x300.gif";
	
	
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
		
		//The pictures
		$myFile_1 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Abbreviated['picture'];				
		$result_1 = glob ($myFile_1 . ".*");			
		$Picture_1 = current($result_1);
		
		$myFile_2 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Extended['picture2'];				
		$result_2 = glob ($myFile_2 . ".*");			
		$Picture_2 = current($result_2);
		
		$myFile_3 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Extended['picture3'];				
		$result_3 = glob ($myFile_3 . ".*");			
		$Picture_3 = current($result_3);
		
		$myFile_4 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Extended['picture4'];				
		$result_4 = glob ($myFile_4 . ".*");			
		$Picture_4 = current($result_4);
		
		
		$myFile_5 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Extended['picture5'];				
		$result_5 = glob ($myFile_5 . ".*");			
		$Picture_5 = current($result_5);
		
		$myFile_6 = "..\\images\\upload_images\\" . $Product_Json_Decoded_Abbreviated['owner'] . '\\' . $Product_Json_Decoded_Extended['picture6'];				
		$result_6 = glob ($myFile_6 . ".*");			
		$Picture_6 = current($result_6);
		
		//The amount
		$Product_Amount				= $Product_Json_Decoded_Abbreviated['amount'];
		//The unit
		$Product_Unit				= $Product_Json_Decoded_Abbreviated['unit'];
		
				
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

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">
		
			<div class="grid_4">
				<div class="grid_1" id="mainPhoto" style="float:left;">
				 <img src="<?php echo urlencode($Picture_1); ?>" id="img_large" style="margin-bottom:1px;" height="300" width="300"> 
				</div>
				 <img src="<?php echo urlencode($Picture_1); ?>" onclick="change_img_1()" class="thumbnail" height="30" width="30"> 
				 <img src="<?php echo urlencode($Picture_2); ?>" onclick="change_img_2()" class="thumbnail" height="30" width="30"> 
				 <img src="<?php echo urlencode($Picture_3); ?>" onclick="change_img_3()" class="thumbnail" height="30" width="30"> 
				 <img src="<?php echo urlencode($Picture_4); ?>" onclick="change_img_4()" class="thumbnail" height="30" width="30"> 
				 <img src="<?php echo urlencode($Picture_5); ?>" onclick="change_img_5()" class="thumbnail" height="30" width="30"> 
				 <img src="<?php echo urlencode($Picture_6); ?>" onclick="change_img_6()" class="thumbnail" height="30" width="30"> 
				
							
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
				<b style="margin-left:10px;">Selling Price: </b>$<?php echo $Product_Price; ?>/ <?php echo $Product_Amount . ' ' . $Product_Unit; ?><br>
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
				
				<a href="index.php?fleece" class="buynow addtocart" style="margin-top: 8px;"><span><i class="icon-github"></i></span>Add to cart</a>
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
								<?php echo ' - ' . $Product_Ratings['title']; ?> <div class="review-header-name" style="padding-right:5px;"><?php echo ucfirst ($Product_Ratings['username']) . '<br>'; ?></div> 
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
			
  
  
  <script>
	function change_img_1(){document.getElementById("img_large").src='<?php echo urlencode($Picture_1); ?>';}
	function change_img_2(){document.getElementById("img_large").src='<?php echo urlencode($Picture_2); ?>';}
	function change_img_3(){document.getElementById("img_large").src='<?php echo urlencode($Picture_3); ?>';}
	
	function change_img_4(){document.getElementById("img_large").src='<?php echo urlencode($Picture_4); ?>';}
	function change_img_5(){document.getElementById("img_large").src='<?php echo urlencode($Picture_5); ?>';}
	function change_img_6(){document.getElementById("img_large").src='<?php echo urlencode($Picture_6); ?>';}   
  </script>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 