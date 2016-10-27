<?php
       //Change these with your information
    $paypalmode = 'sandbox'; //Sandbox for testing or empty ''
    $dbusername = 'IPN'; //db username
    $dbpassword = 'NvndSAdA8nnK2VLUVQzgGkr2'; //db password
    $dbhost     = 'localhost'; //db host
    $dbname     = 'dwarvencthulhu'; //db name

		
if($_POST)
{
	$file = 'f.txt';			
			$current = "John Smith\n";		
			file_put_contents($file, $current);

        if($paypalmode=='sandbox'){
            $paypalmode     =   '.sandbox';
        }
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);
		
			$file = 't.txt';			
			$current = "John Smith\n";		
			file_put_contents($file, curl_error ($ch));

        if (strcmp ($res, "VERIFIED") == 0)
        {
		
            $transaction_id = $_POST['txn_id'];
            $payerid = $_POST['payer_id'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $payeremail = $_POST['payer_email'];
            $paymentdate = $_POST['payment_date'];
            $paymentstatus = $_POST['payment_status'];
            $mdate= date('Y-m-d h:i:s',strtotime($paymentdate));
            $otherstuff = json_encode($_POST);

            $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
            if (!$conn)
            {
             die('Could not connect: ' . mysql_error());
			 
			 $file = 'could not connect.txt';			
			$current = "John Smith\n";		
			file_put_contents($file, $current);
            }

            mysql_select_db($dbname, $conn);

            // insert in our IPN record table
            $query = "INSERT INTO ibn_table
            (itransaction_id,ipayerid,iname,iemail,itransaction_date, ipaymentstatus,ieverything_else)
            VALUES
            ('$transaction_id','$payerid','$firstname $lastname','$payeremail','$mdate', '$paymentstatus','$otherstuff')";

            if(!mysql_query($query))
            {
				$file = 'csel.txt';			
				$current = "John Smith\n";		
				file_put_contents($file, $current);
                //mysql error..!
            }
            mysql_close($conn);
			
			$file = 'f.txt';			
			$current = "John Smith\n";		
			file_put_contents($file, $current);

        }
}
?>