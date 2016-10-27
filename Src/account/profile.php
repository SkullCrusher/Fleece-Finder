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
	
	
	
	//Get the id of a user by username
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
	
	$User_Id_Uncleaned = FN_User_Get_Id($_SESSION['user_name']);
		
	$IsYours = false;
		
	if(strlen($_GET['u']) >= 1){
		$User_Id_Uncleaned = preg_replace("/[^0-9]/", "", $_GET['u']);
		$IsYours = true;
	}
	
	if($User_Id_Uncleaned == 'Internal_Server_Error' || $User_Id_Uncleaned == 'Error_Try_Again'){		
		$Sanitize_Problem = true;
		
		header('Location: http://www.scriptencryption.com/error/404.php?error=18');
		die();
	}
	
	function FN_Profile_Load_Information($User_Id, &$Value){
	
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
			$statement->execute(array(':id' => $User_Id));
		} catch (PDOException $e) {
		
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$result = $statement->fetch();
		
		$Value = json_decode($result['json_farminformation'], true);
			
	}
		
	$Value = null;
	FN_Profile_Load_Information($User_Id_Uncleaned, $Value);
	
	
	
	$Profile_Picture = "/Assets/Images/profile_picture.png";
	if(strlen($Value[0]['profile_picture']) > 1){
		$Profile_Picture = $Value[0]['profile_picture'];
	}
	//limit 80
	$Profile_Name = $Value[0]['profile_name'];
	//limit 500
	$Profile_Short_Description = "No description";
	if(strlen($Value[0]['profile_short_description']) > 1){
		$Profile_Short_Description = $Value[0]['profile_short_description'];
	}
	//limit 5,000
	$Profile_Short_Biography = "No biography";
	if(strlen($Value[0]['short_biography']) > 1){
		$Profile_Short_Biography = $Value[0]['short_biography'];
	}
	//limit 5,000
	$Profile_Terms_Of_Sale = "No terms of sale";
	if(strlen($Value[0]['terms_of_sale']) > 1){
		$Profile_Terms_Of_Sale = $Value[0]['terms_of_sale'];
	}
	
	$phonenumber = "None provided";
	if(strlen($Value[0]['phone_number']) > 1){$phonenumber = $Value[0]['phone_number'];}
	
	$email = "None provided";
	if(strlen($Value[0]['email']) > 1){$email = $Value[0]['email'];}
	
	$website = "None provided";
	if(strlen($Value[0]['website']) > 1){$website = $Value[0]['website'];}
	
	$mobile_phone = "None provided";
	if(strlen($Value[0]['mobile_phone']) > 1){$mobile_phone = $Value[0]['mobile_phone'];}
	
	$extra_contact_information = $Value[0]['extra'];
	
?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">
		
			<div class="grid_4">
				<div class="grid_1" id="mainPhoto" style="float:left;">
				 <img src="<?php echo 'http://'. $_SERVER["HTTP_HOST"] . $Profile_Picture; ?>" id="img_large" style="margin-bottom:1px;" height="300" width="300"> 
				</div>	
			</div>
			<div class="grid_7 title" style="margin-bottom:10px;">
			 <?php echo '<b>' . $Profile_Name; 
			 if($IsYours == false){
			 
				echo ' - <a href="profile_edit.php" style="text-decoration: none;s">Edit</a>';}
				echo '</b>';
			 ?>
			</div>
	
		
			<div class="grid_7">
				<div class="profileinformation">
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
					<b>Information:</b><br>
					<?php echo $Profile_Short_Description;?>					
				<br><br>					
					</div>
				</div>
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
			  width: 18%;
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
			  <li><a href="#tab2">Products</a></li>
			  <li><a href="#tab3">Terms of sale</a></li>
			  <li><a href="#tab4">Contact</a></li>
						
			</ul>
			<section id="first-tab-group" class="tabgroup-div">
			  <div id="tab1">
				<h2>Short biography</h2>
				<div class="profile_container">
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
						<p><?php echo $Profile_Short_Biography; ?></p>
					</div>
				</div>
			  </div>
			   <div id="tab2">
				<h2>Products</h2>
				<div class="profile_container">
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
						<p><?php echo 'No products' ?></p>
					</div>
				</div>
			  </div>
			  <div id="tab3">
				<h2>General terms of sale</h2>
				<div class="profile_container">	
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
						<p><?php echo $Profile_Terms_Of_Sale; ?></p>
					</div>
				</div>
			  </div>
			  <div id="tab4">
				<h2>Contact</h2>
				<div class="profile_container">
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
						<p><b>Phone number:</b> <?php echo $phonenumber; ?></p>
						<p><b>Mobile number:</b> <?php echo $mobile_phone; ?></p>
						<p><b>Email:</b> <?php echo $email; ?></p>
						<p><b>Website:</b> <?php echo $website; ?></p>
					</div>
				</div>
			  </div>
			  <?php if(strlen($extra_contact_information)){
				  echo '<div id="tab4">
					<h2>Extra</h2>
					<div class="profile_container">
						<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
							<p>' . $extra_contact_information . '</p>							
						</div>
					</div>
				  </div>';
				}
			 ?>
		
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
			
  



<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


