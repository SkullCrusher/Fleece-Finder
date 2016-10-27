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
		include("../index.php");
		die();
	}
	
	
	$Profile_Picture = "/Assets/Images/profile_picture.png";
	//limit 80
	$Profile_Name = "Neat cool test farm!";
	//limit 500
	$Profile_Short_Description = "Our farm is a farm who makes Our farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsOOur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsur farm is a farm who makes farming farmsOur farm is a farm who makes farming farmsfarming farmsOur farm is a farm who makes farming f4ffarmsOur farm is a farm who makes 5555ff";
	//limit 5,000
	$Profile_Short_Biography = "ssssss";
	//limit 5,000
	$Profile_Terms_Of_Sale = "Money";
	
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
			 <?php echo '<b>' . $Profile_Name . '</b>'; ?>
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
			  <li><a href="#tab4">Reviews</a></li>
			  <li><a href="#tab5">Contact</a></li>
			
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
						<p><?php echo $Profile_Short_Biography; ?></p>
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
						<p><?php echo $Profile_Short_Biography; ?></p>
					</div>
				</div>
			  </div>
			  <div id="tab5">
				<h2>Reviews</h2>
				<div class="profile_container">	
					<div style="padding-left:10px;margin-left:10px;word-wrap: break-word;">
						<p><?php echo $Profile_Short_Biography; ?></p>
					</div>
				</div>
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
			
  



<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


