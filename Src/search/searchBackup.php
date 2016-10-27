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
	
	//var_dump($_POST['nav-search']);
	
	if(strlen($_POST['nav-search']) > 0){
				
		header('Location: http://www.scriptencryption.com/search/search.php?s=' . base64_encode($_POST['nav-search']));
		die();
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
	
	function FN_Product_Load_By_Id($ID, &$Owner, &$Unit, &$Quantity, &$Title, &$Shipping_Cost_Multiple, &$Price){
		
		$ID = 141;
		
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
			$statement->execute(array(':id' => $ID));
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
		
		//var_dump($Product_Json_Decoded_Abbreviated);
				
		//(Abbreviated)
		$Title	= $Product_Json_Decoded_Abbreviated['title'];
		$Owner	= $Product_Json_Decoded_Abbreviated['owner'];

		$Price	= $Product_Json_Decoded_Abbreviated['price'];
		
		//echo $Price;
		
		
		$Product_Pictures = $Product_Json_Decoded_Abbreviated['picture'];		
		
	
		
		//The pictures
		$myFile_1 = "..\\images\\upload_images\\" . $Owner . '\\' . $Product_Pictures;				
		$result_1 = glob ($myFile_1 . ".*");			
		$Picture_1 = current($result_1);
		
			
		//The amount
		//$Product_Amount				= $Product_Json_Decoded_Abbreviated['amount'];
		//The unit
		$Unit				= $Product_Json_Decoded_Abbreviated['unit'];
		
		$Bug_Fix = array('price' => $Price, 'title' => $Title, 'picture' => $Picture_1, 'shipping_cost_multiple' => $Product_Json_Decoded_Abbreviated['shipping_cost_multiple'], 'shipping_cost' => $Product_Json_Decoded_Abbreviated['shipping_cost']);
		
		
		return $Bug_Fix;
	}
	

?>

<?php 
	require_once('../global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

  
<div class="container_12 backgroundwhite" style="margin-bottom: 10px;">

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
		padding-right: 10px;
	}	
	.product_title:hover{
		color: #2ECC71;	
	}
	


	
	</style>
 </head>
 
 
 <style>
 
.finder {
  padding: 1em;
  line-height: 1;
}
.finder form {
  position: relative;
}
.finder form input {
  display: block;
}
.finder form input[type="search"] {
  width: 96.5%;
  padding: 1em;
  position: relative;
  top: 0;
  height: inherit;
}

.finder form .cate-btn-group {
  position: absolute;
  right: 6em;
  top: 0em;
  bottom: 0.5em;
  z-index: 1;
  width: 8.0em;
  margin-bottom: 20px;
  cursor: pointer;
}

.finder form .cate-btn-group .dropdown-toggle {    
  height: 34px; 
  background: #f5f5f5;
  border:1px solid #E5E5E5;
}
      
.finder form .cate-btn-group .dropdown-menu {    
  left: auto;  
  right: 0;
}  

.finder form .sort-btn-group {
  position: absolute;
  right: 13.5em;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  margin-bottom: 20px;
  cursor: pointer;
}

.finder form .sort-btn-group .fa-usd {
  height: 34px;
  color: #F5F5F5;
  background: #2ecc71;
  transition: all 0.25s ease;
}

.finder form .sort-btn-group .fa-usd:hover {
  background: #29b765;
  transition: all 0.25s ease;
}

.finder form .rating-btn-group {
  position: absolute;
  right: 10.5em;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  margin-bottom: 20px;
  cursor: pointer;
}
.finder form .rating-btn-group .fa-star {
  height: 34px;
  color: #F5F5F5;
  background: #d12a2a;
  transition: all 0.25s ease;
}
.finder form .rating-btn-group .fa-star:hover {
  background: #a72222;
  transition: all 0.25s ease;
}
.finder form .search-btn-group {
  position: absolute;
  right: 0;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  padding: 0;
  cursor: pointer;
}
.finder form .search-btn-group .fa-search {
  margin-left: 4px;
  height: 34px;
  color: #F5F5F5;
  background: #3a539b;
  transition: all 0.25s ease;
}
.finder form .search-btn-group .fa-search:hover {
  background: #334988;
  transition: all 0.25s ease;
}

 

 .btn {
  display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.btn:focus,
.btn:active:focus,
.btn.active:focus,
.btn.focus,
.btn:active.focus,
.btn.active.focus {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn:hover,
.btn:focus,
.btn.focus {
  color: #333333;
  text-decoration: none;
}
.btn:active,
.btn.active {
  outline: 0;
  background-image: none;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn.disabled,
.btn[disabled],
fieldset[disabled] .btn {
  cursor: not-allowed;
  pointer-events: none;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  box-shadow: none;
}

.finder {
  padding: 1em;
  line-height: 1;
}
.finder form {
  position: relative;
}
.finder form input {
  display: block;
}
.finder form input[type="search"] {
  width: 100%;
  padding: 1em;
  position: relative;
  top: 0;
  height: inherit;
}

.finder form .cate-btn-group {
  position: absolute;
  right: 6em;
  top: 0em;
  bottom: 0.5em;
  z-index: 1;
  width: 8.0em;
  margin-bottom: 20px;
  cursor: pointer;
}

.finder form .cate-btn-group .dropdown-toggle {    
  height: 34px; 
  background: #f5f5f5;
  border:1px solid #E5E5E5;
}
      
.finder form .cate-btn-group .dropdown-menu {    
  left: auto;  
  right: 0;
}  

.finder form .sort-btn-group {
  position: absolute;
  right: 13.5em;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  margin-bottom: 20px;
  cursor: pointer;
}

.finder form .sort-btn-group .fa-usd {
  height: 34px;
  color: #F5F5F5;
  background: #2ecc71;
  transition: all 0.25s ease;
}

.finder form .sort-btn-group .fa-usd:hover {
  background: #29b765;
  transition: all 0.25s ease;
}

.finder form .rating-btn-group {
  position: absolute;
  right: 10.5em;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  margin-bottom: 20px;
  cursor: pointer;
}
.finder form .rating-btn-group .fa-star {
  height: 34px;
  color: #F5F5F5;
  background: #d12a2a;
  transition: all 0.25s ease;
}
.finder form .rating-btn-group .fa-star:hover {
  background: #a72222;
  transition: all 0.25s ease;
}
.finder form .search-btn-group {
  position: absolute;
  right: 0;
  top: 0.3em;
  bottom: 0.5em;
  z-index: 1;
  width: 7.0em;
  padding: 0;
  cursor: pointer;
}
.finder form .search-btn-group .fa-search {
  margin-left: 4px;
  height: 34px;
  color: #F5F5F5;
  background: #3a539b;
  transition: all 0.25s ease;
}
.finder form .search-btn-group .fa-search:hover {
  background: #334988;
  transition: all 0.25s ease;
}

 .form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.form-control::-moz-placeholder {
  color: #999999;
  opacity: 1;
}
.form-control:-ms-input-placeholder {
  color: #999999;
}
.form-control::-webkit-input-placeholder {
  color: #999999;
}
.form-control[disabled],
.form-control[readonly],
fieldset[disabled] .form-control {
  cursor: not-allowed;
  background-color: #eeeeee;
  opacity: 1;
}
textarea.form-control {
  height: auto;
}

.input-group .form-control:first-child,
.input-group-addon:first-child,
.input-group-btn:first-child > .btn,
.input-group-btn:first-child > .btn-group > .btn,
.input-group-btn:first-child > .dropdown-toggle,
.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle),
.input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}
.input-group-addon:first-child {
  border-right: 0;
}
.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group > .btn,
.input-group-btn:last-child > .dropdown-toggle,
.input-group-btn:first-child > .btn:not(:first-child),
.input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}
.input-group-addon:last-child {
  border-left: 0;
}
.input-group-btn {
  position: relative;
  font-size: 0;
  white-space: nowrap;
}
.input-group-btn > .btn {
  position: relative;
}
.input-group-btn > .btn + .btn {
  margin-left: -1px;
}
.input-group-btn > .btn:hover,
.input-group-btn > .btn:focus,
.input-group-btn > .btn:active {
  z-index: 2;
}
.input-group-btn:first-child > .btn,
.input-group-btn:first-child > .btn-group {
  margin-right: -1px;
}
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group {
  margin-left: -1px;
}

.input-group-lg > .form-control,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .btn {
  height: 46px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
  border-radius: 6px;
}
select.input-group-lg > .form-control,
select.input-group-lg > .input-group-addon,
select.input-group-lg > .input-group-btn > .btn {
  height: 46px;
  line-height: 46px;
}
textarea.input-group-lg > .form-control,
textarea.input-group-lg > .input-group-addon,
textarea.input-group-lg > .input-group-btn > .btn,
select[multiple].input-group-lg > .form-control,
select[multiple].input-group-lg > .input-group-addon,
select[multiple].input-group-lg > .input-group-btn > .btn {
  height: auto;
}
.input-group-sm > .form-control,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .btn {
  height: 30px;
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
}
select.input-group-sm > .form-control,
select.input-group-sm > .input-group-addon,
select.input-group-sm > .input-group-btn > .btn {
  height: 30px;
  line-height: 30px;
}
textarea.input-group-sm > .form-control,
textarea.input-group-sm > .input-group-addon,
textarea.input-group-sm > .input-group-btn > .btn,
select[multiple].input-group-sm > .form-control,
select[multiple].input-group-sm > .input-group-addon,
select[multiple].input-group-sm > .input-group-btn > .btn {
  height: auto;
}
.input-group-addon,
.input-group-btn,
.input-group .form-control {
  display: table-cell;
}
.input-group-addon:not(:first-child):not(:last-child),
.input-group-btn:not(:first-child):not(:last-child),
.input-group .form-control:not(:first-child):not(:last-child) {
  border-radius: 0;
}
.input-group-addon,
.input-group-btn {
  width: 1%;
  white-space: nowrap;
  vertical-align: middle;
}

.input-group {
  position: relative;
  display: table;
  border-collapse: separate;
}
.input-group[class*="col-"] {
  float: none;
  padding-left: 0;
  padding-right: 0;
}
.input-group .form-control {
  position: relative;
  z-index: 2;
  float: left;
  width: 100%;
  margin-bottom: 0;
}
.input-group-lg > .form-control,
.input-group-lg > .input-group-addon,
.input-group-lg > .input-group-btn > .btn {
  height: 46px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
  border-radius: 6px;
}
select.input-group-lg > .form-control,
select.input-group-lg > .input-group-addon,
select.input-group-lg > .input-group-btn > .btn {
  height: 46px;
  line-height: 46px;
}
textarea.input-group-lg > .form-control,
textarea.input-group-lg > .input-group-addon,
textarea.input-group-lg > .input-group-btn > .btn,
select[multiple].input-group-lg > .form-control,
select[multiple].input-group-lg > .input-group-addon,
select[multiple].input-group-lg > .input-group-btn > .btn {
  height: auto;
}
.input-group-sm > .form-control,
.input-group-sm > .input-group-addon,
.input-group-sm > .input-group-btn > .btn {
  height: 30px;
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
}
select.input-group-sm > .form-control,
select.input-group-sm > .input-group-addon,
select.input-group-sm > .input-group-btn > .btn {
  height: 30px;
  line-height: 30px;
}
textarea.input-group-sm > .form-control,
textarea.input-group-sm > .input-group-addon,
textarea.input-group-sm > .input-group-btn > .btn,
select[multiple].input-group-sm > .form-control,
select[multiple].input-group-sm > .input-group-addon,
select[multiple].input-group-sm > .input-group-btn > .btn {
  height: auto;
}
.input-group-addon,
.input-group-btn,
.input-group .form-control {
  display: table-cell;
}
.input-group-addon:not(:first-child):not(:last-child),
.input-group-btn:not(:first-child):not(:last-child),
.input-group .form-control:not(:first-child):not(:last-child) {
  border-radius: 0;
}
.input-group-addon,
.input-group-btn {
  width: 1%;
  white-space: nowrap;
  vertical-align: middle;
}
.input-group-addon {
  padding: 6px 12px;
  font-size: 14px;
  font-weight: normal;
  line-height: 1;
  color: #555555;
  text-align: center;
  background-color: #eeeeee;
  border: 1px solid #cccccc;
  border-radius: 4px;
}
.input-group-addon.input-sm {
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 3px;
}
.input-group-addon.input-lg {
  padding: 10px 16px;
  font-size: 18px;
  border-radius: 6px;
}
.input-group-addon input[type="radio"],
.input-group-addon input[type="checkbox"] {
  margin-top: 0;
}
.input-group .form-control:first-child,
.input-group-addon:first-child,
.input-group-btn:first-child > .btn,
.input-group-btn:first-child > .btn-group > .btn,
.input-group-btn:first-child > .dropdown-toggle,
.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle),
.input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}
.input-group-addon:first-child {
  border-right: 0;
}
.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group > .btn,
.input-group-btn:last-child > .dropdown-toggle,
.input-group-btn:first-child > .btn:not(:first-child),
.input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}
.input-group-addon:last-child {
  border-left: 0;
}
.input-group-btn {
  position: relative;
  font-size: 0;
  white-space: nowrap;
}
.input-group-btn > .btn {
  position: relative;
}
.input-group-btn > .btn + .btn {
  margin-left: -1px;
}
.input-group-btn > .btn:hover,
.input-group-btn > .btn:focus,
.input-group-btn > .btn:active {
  z-index: 2;
}
.input-group-btn:first-child > .btn,
.input-group-btn:first-child > .btn-group {
  margin-right: -1px;
}
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group {
  margin-left: -1px;
}

 </style> 
 <script type="text/javascript" src="../Assets/Javascript/bootstrap.js?<?php echo time(); ?>"></script>
	<div class="finder">
	  <form action="#" method="post" >        
		<input type="search" class="form-control"  placeholder="Search" />             
		<div class="input-group search-btn-group">
		  <div class="sort-btn-group">
		   <button type="submit" class="btn fa fa-usd"><span></span></button>
		  </div>
		  <div class="rating-btn-group">
			<button type="submit" class="btn fa fa-star"><span></span></button>
		  </div>
		   <div class="input-group search-btn-group">
		  <div class="cate-btn-group">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Category<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Category 1</a></li>
			  <li><a href="#">Category 2</a></li>          
			</ul>
		  </div>
		  <button type="submit" class="btn fa fa-search"><span></span></button>
		</div>
	  </form>
	</div>
	</div>









 
 
	<?php
		$Search_Title = base64_decode($_GET['s'], true);
		$Search_Description = base64_decode($_GET['d'], true);
		$Search_Categorie = base64_decode($_GET['type'], true);
		
		if($Search_Title === false){$Search_Title = "";}	
		if($Search_Description == false){$Search_Description = "";}	
		if($Search_Categorie == false){$Search_Categorie = "";}
				
		$Result_List = FN_User_Search($Search_Categorie, $Search_Title, $Search_Description);
		
		if($Result_List == 'Internal_Server_Error' || $Result_List == 'Error_Try_Again' || $Result_List == null){
			?>		
			
			<img style="border-style: none;margin-left: 175px;padding-bottom: 50px;" src="http://www.scriptencryption.com/Assets/Images/search_no_results.png"></img>			
			<?php			
		}else{		
			foreach ($Result_List as &$value) {
				//var_dump($value);
									
				$Owner = null;
				$Unit = null;
				$Title = null;
				$Shipping_Cost_Multiple = null;
				$Price = null;
				
				$Product_ID = $value[0];
				
									
				$Bug_Fix = FN_Product_Load_By_Id($value[0], $Owner, $Unit, $Title, $Shipping_Cost_Multiple, $Price);
				
				$Price = $Bug_Fix['price'];
				$Title = $Bug_Fix['title'];
				$Picture_url = $Bug_Fix['picture'];
				$Shipping_Cost_Multiple = $Bug_Fix['shipping_cost_multiple'];
				$Shipping_cost = $Bug_Fix['shipping_cost'];
				
				if($Picture_url == null){
					$Picture_url = "http://www.scriptencryption.com/Assets/img/blank_photo.png";
				}
				
			?>
			
			
			<div class="product">
			
		<div class="spacer" style="padding-bottom: 0px;"></div>
		<div class="container_12">
		
		<div class="grid_3">
		 <a href="http://www.scriptencryption.com/products/product_profile.php?p=<?php echo $value[0]; ?>&u=<?php echo $Owner; ?>"><img class="work" src="<?php echo $Picture_url; ?>"></a>
		</div>
		
		<div class="grid_6" style="padding-left: 10px;">
		 <h2><a href="http://www.scriptencryption.com/products/product_profile.php?p=<?php echo $value[0]; ?>&u=<?php echo $Owner; ?>" style="text-decoration:none;"><b class="product_title" style="margin-right: 10px"><?php echo $Title;?></b></a></h2>
		 <p style="font-size: 18px;"><b><a style="color: #000;">$<?php echo number_format($Price, 2, '.', ','); ?></a> / <?php echo $Unit; ?></b></p>
		 <p>Shipping <b><a style="color: #000;">$<?php echo number_format($Shipping_cost, 2, '.', ','); ?> <?php if($Shipping_Cost_Multiple == false){echo " per " . $Unit; }?></a></b></p>
		 
		 <p>This product is <b><a style="color: #000;">Out of stock</a></b></p>
		 </div>
		 
		 <div class="grid_3" style="padding-left: 10px;">
		 
				<form method="post" class="sellerinformation" style="float:right;margin-top:10px;padding-right:10px" action="index.php" id="buynow" name="buynow">
					<b style="text-align: center;">Seller information</b><br>
					<?php 
					$User_Name = FN_User_Get_Id($Owner);
					$Farm_Name = FN_Farm_Load_Name($User_Name);
					
					
					?>
					<a href="http://www.scriptencryption.com/account/profile.php?u=<?php echo $Owner; ?>" style="color: #3A539B;text-decoration: none;" ><?php echo $Farm_Name; ?></a>
					<br><br>
					
					 Feedback for <?php echo FN_Farm_Load_Rating_Count($User_Name); ?> sales: <?php 
						$Product_Compressed_Rating = 3;
						
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

			<input name="product_code" value="<?php echo $Product_ID; ?>" type="hidden">
			<input name="product_owner" value="<?php echo $Owner; ?>" type="hidden">
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
