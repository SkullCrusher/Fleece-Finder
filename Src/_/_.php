<?php

	// include the configure file
	require_once('../config/config.php');

	//The insert into the extended functions.
	function FN_Product($ID, $D){
	
		$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
		
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	
		$statement = null; //The statement
		
		try {
			$statement = $db->prepare('INSERT INTO search_test (title, description) VALUES (:title, :description)');			
		} catch (PDOException $e) {
		
			return 'Internal_Server_Error'; //Error.
		}
		
		try {
			$statement->execute(array(':title' => $ID,':description' => $D));
		} catch (PDOException $e) {
		
			return 'Error_Try_Again'; //Error.
		}		
	}
	
	$_A = "";
	$_B = "";
	
	for($i = 0; $i < rand (1, 5); $i++){
		$_A .= file_get_contents("http://randomword.setgetgo.com/get.php") . ' ';
	}
	
	for($i = 0; $i < rand (1, 25); $i++){
		$_B .= file_get_contents("http://randomword.setgetgo.com/get.php") . ' ';
	}
	
	
	FN_Product($_A, $_B);
?>
<html>
<body>

<script>
  
		window.onload = function () {
			var delay=0;//1 seconds
			setTimeout(function(){ 
				window.location.replace("http://www.scriptencryption.com/_/_.php?id=<?php echo $_GET['id'] + 1; ?>"); 
			 },delay); 			
			}
 
   
</script>

neat


</body>
</html> 