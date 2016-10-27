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

	if ($login->isUserLoggedIn() == false) {
		header("Location: http://www.scriptencryption.com/");
		die();
	}

//Functions.
	
	function Clean($Input){
		
		$Input = filter_var($Input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$Input = filter_var($Input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		
		$Input = htmlspecialchars($Input, ENT_QUOTES);
		
		
		return $Input;
	}

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
			
	function FN_Shipping_Add_Address(&$LAST_ID,$User_ID, $Address, $City, $State, $Postal_Code, $Country,$PhoneNumber, $Notes){
		
		//fill in nulls incase they are empty.
		
		if(strlen($Address) < 1){return -1;}
		if(strlen($City) < 1){return -1;}
		if(strlen($State) < 1){return -1;}
		if(strlen($Postal_Code) < 1){$Postal_Code == "N/A";}
		if(strlen($Postal_Code) < 1){$Postal_Code == "US";}
		
		
		
		//Load the products
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
		$statement = null; //The statement
					
		try {
			$statement = $db->prepare('INSERT INTO shipping_information (customer_id, address, city, state, postal_code, country, tied_to_order, creation_date, notes, phone_number) VALUES (:customer_id, :address, :city, :state, :postal_code, :country, :tied_to_order, :creation_date, :notes, :phone_number)');			
		} catch (PDOException $e) {										
			//Error code 1146 - unable to find database.
			return 'Internal_Server_Error'; //Error.
		}					
		try {
			$statement->execute(array(':customer_id' => $User_ID,':address' => $Address, ':city' => $City, ':state' => $State, ':postal_code' => $Postal_Code, ':country' => $Country, ':tied_to_order' => 0, ':creation_date' => date("Y-m-d H:i:s"), ':notes' => $Notes, ':phone_number' => $PhoneNumber));
		} catch (PDOException $e) {				
			//Error code 23000 - unable to to create because of duplicate id.
			return 'Error_Try_Again'; //Error.
		}		
		
		$LAST_ID = $db->lastInsertId();
		
		return true;
	}
	
// End of functions.

	$Error = false;	
	
	
	if(strlen($_POST['address']) > 1 && strlen($_POST['city']) && strlen($_POST['state']) > 1 && strlen($_POST['postal_code'])){
		
		$_SESSION['shipping_id'] = -1;		
		$LAST_ID = -1;
		
		if(FN_Shipping_Add_Address($LAST_ID,Clean(FN_User_Get_Id($_SESSION['user_name'])), Clean($_POST['address']), Clean($_POST['city']), Clean($_POST['state']), Clean($_POST['postal_code']), Clean($_POST['country']), Clean($_POST['phone_number']), Clean($_POST['notes'])) == true){
			$_SESSION['shipping_id'] = $LAST_ID;
			
			header("Location: http://www.scriptencryption.com/paypal/process.php?b=t");
		}else{
			$Error = true;
		}
	}

?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>
 
 
 
 <div class="container_12 backgroundwhite">
	
			<div class="grid_12">
			<p style="text-align:center;font-size: 200%;margin-top:-10px;"><b>Enter a shipping address</b></p>
			</div>
			<?php  if($Error){?>
				<div class="grid_12">
				<p style="text-align:center;font-size: 100%;margin-top:-10px;"><b>An error has occurred, please review shipping information and please try again.</b></p>
				</div>
			<?php }?>
			
			
					
		<form method="post" action="cart_shipping.php" id="create_product_new" name="create_product_new">
		
				<div class="grid_5">
				<label for="address"><b>Address</b></label><br>
				<input id="address" class="textbox" type="text" pattern="[ ()a-zA-Z0-9-]{1,1000}" name="address" placeholder="Ex: 283 street ln" value="<?php echo $_POST['address']; ?>" required /></input>			
			    </div>
			    <br>
				
				<div class="grid_5">
				<label for="city"><b>City</b></label><br>
				<input id="city" class="textbox" type="text" pattern="[ ()a-zA-Z0-9-]{1,1000}" name="city" placeholder="Ex: 283 street ln" value="<?php echo $_POST['city']; ?>" required /></input>			
			    </div>
			    <br>
				
				<div class="grid_5"><label for="state"><b>State</b></label><br>
				<div class="select-style">
				<select id="state" name="state">	
					<option value="None-Selected">None-Selected</option>
					<option value="Alabama">Alabama</option>
					<option value="Alaska">Alaska</option>
					<option value="Arizona">Arizona</option>
					<option value="Arkansas">Arkansas</option>
					<option value="California">California</option>
					<option value="Colorado">Colorado</option>
					<option value="Connecticut">Connecticut</option>
					<option value="Delaware">Delaware</option>
					<option value="Florida">Florida</option>
					<option value="Georgia">Georgia</option>
					<option value="Hawaii">Hawaii</option>
					<option value="Idaho">Idaho</option>
					<option value="Illinois">Illinois</option>
					<option value="Indiana">Indiana</option>
					<option value="Iowa">Iowa</option>
					<option value="Kansas">Kansas</option>
					<option value="Kentucky">Kentucky</option>
					<option value="Louisiana">Louisiana</option>
					<option value="Maine">Maine</option>
					<option value="Maryland">Maryland</option>
					<option value="Massachusetts">Massachusetts</option>
					<option value="Michigan">Michigan</option>
					<option value="Minnesota">Minnesota</option>
					<option value="Mississippi">Mississippi</option>
					<option value="Missouri">Missouri</option>
					<option value="Montana">Montana</option>
					<option value="Nebraska">Nebraska</option>
					<option value="Nevada">Nevada</option>
					<option value="New Hampshire">New Hampshire</option>
					<option value="New Jersey">New Jersey</option>
					<option value="New Mexico">New Mexico</option>
					<option value="New York">New York</option>
					<option value="North Carolina">North Carolina</option>
					<option value="North Dakota">North Dakota</option>
					<option value="Ohio">Ohio</option>
					<option value="Oklahoma">Oklahoma</option>
					<option value="Oregon">Oregon</option>
					<option value="Pennsylvania">Pennsylvania</option>
					<option value="Rhode Island">Rhode Island</option>
					<option value="South Carolina">South Carolina</option>
					<option value="South Dakota">South Dakota</option>
					<option value="Tennessee">Tennessee</option>
					<option value="Texas">Texas</option>
					<option value="Utah">Utah</option>
					<option value="Vermont">Vermont</option>
					<option value="Virginia">Virginia</option>
					<option value="Washington">Washington</option>
					<option value="West Virginia">West Virginia</option>
					<option value="Wisconsin">Wisconsin</option>
					<option value="Wyoming">Wyoming</option>

				</select>
				</div></div><br>

				<div class="grid_5">
				<label for="country"><b>Country</b></label><br>
				<input id="country" class="textbox" type="text" pattern="[ ()a-zA-Z0-9-]{1,1000}" name="country" placeholder="Ex: US" value="<?php echo $_POST['country']; ?>" required /></input>			
			    </div>
			    <br>
				
				<div class="grid_4">
				<label for="postal_code"><b>Postal Code</b></label><br>
				<input id="postal_code" class="textbox" type="text" style="width:50px;" pattern="[0-9.]{1,8}" name="postal_code" placeholder="9999" value="<?php echo $_POST['postal_code']; ?>"  required /></input><br>
				</div>		

				<div class="grid_4">
				<label for="phone_number"><b>Phone Number</b></label><br>
				<input id="phone_number" class="textbox" type="text" style="width:50px;" pattern="[()0-9.]{1,16}" name="phone_number" placeholder="(000)65456675" value="<?php echo $_POST['phone_number']; ?>" /></input><br>
				</div>		
				
				<div class="grid_12">
				<label for="notes"><b>Notes to seller about shipping</b></label>
				<textarea rows="0" cols="50" id="notes" name="notes" value="<?php echo $_POST['notes']; ?>" class="textbox" style="resize: none;width:938px;height:100px;" placeholder="Ex: The ge top."></textarea> 
				</div><br>
			
				
					<div class="grid_12"><input type="submit"  class="buynow addtocart" style="border: 0;margin-left:400px;" name="register" value="Continue" />	</div>
				</form>

					
		</div>
			


	

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 