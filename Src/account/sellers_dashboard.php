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
	
	
?>
	
<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
	
		<div class="container_12 backgroundwhite">			
			<div class="grid_12 title" style="margin-bottom:20px; text-align:center;">		 
				<b>Account Information</b>				
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
			  color: #F7F7F7;
			  text-align:center;
			  height:35px;
			}

			#containerz a.btn{
			  display:inline-block;transition: all .2s ease;border-bottom-left-radius:3px;border-top-left-radius:3px;border-bottom-right-radius:3px;border-top-right-radius:3px;background:#2ECC71;color:#F7F7F7;padding-left:3px;padding-right:3px;text-decoration:none;transition: all .2s ease;padding:5px;
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
				<th scope="col">Buyer</th>
				<th scope="col">Product</th>
				<th scope="col">Quantity</th>
				<th scope="col">Shipping Address</th>
				<th scope="col">Unit Price</th>
				<th scope="col">Shipping Price</th>
				<th scope="col">Purchase Date</th>
				<th scope="col">Total</th>
				<th scope="col">Remove</th>
			  </tr>
			  </thead>
			  <tbody>
			  <tr>
				<th>ONE IS SMALL</th>
				<td>TWO THEY SCALE</td>
				<td>THREE</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td><a href="#" class="btn">Button</a></td>
			  </tr>
			  <tr>
				<th>ONE IS SMALL</th>
				<td>TWO THEY SCALE</td>
				<td>THREE</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td><a href="#" class="btn">Button</a></td>
			  </tr>
				  <tr>
				<th>ONE IS SMALL</th>
				<td>TWO THEY SCALE</td>
				<td>THREE</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td>FOUR</td>
				<td><a href="#" class="btn">Button</a></td>
			  </tr>
			  </tbody>
			</table>
			</div>

			
			
			
			
		
		
		
		
		</div>
			
  



<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 


