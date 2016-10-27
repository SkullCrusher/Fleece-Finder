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

  <link rel="stylesheet" type="text/css" href="../Assets/theme.css"> 
  
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
	
		//var_dump($Result_List);
	
	
	?>
	
	<div class="container_12">   
    <div class="grid_4">
     <a href="projects/tic/index.php"><img class="work" src="../Assets/Images/section1.png"></a>
    </div>
    <div class="grid_8">
     <h2 style="border-bottom:3px solid #333333;text-align:center;color:#06ba8f;padding-bottom:1px;margin-top:-12px"><b>Tic Tac Toe</b></h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus nisi, ultrices at tristique sit amet, posuere ut ante. Nullam in enim in velit venenatis fringilla eget nec purus. Sed sodales viverra commodo. Vestibulum nec egestas est. In vestibulum orci vitae scelerisque dictum. Nam erat metus, consectetur nec luctus eu, dictum quis mauris. Vestibulum fermentum velit massa, at venenatis orci ultricies vel..</p>
     <a href="projects/tic/index.php"><div class="checkmeout">Look at this product</div></a>
    </div>
   </div>
	

</div>

<?php 
	//End of page wrap.
	require_once('../global/footer-bar.php');	
?> 
