<?php
//start session in all pages
if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

$PayPalMode 			= 'live'; // sandbox or live
$PayPalApiUsername 		= 'email@domain.com'; //PayPal API Username
$PayPalApiPassword 		= 'paypalapipassword'; //Paypal API password
$PayPalApiSignature 	= 'paypalsig'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://www.scriptencryption.com/paypal/process.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://www.scriptencryption.com/cart/cart_checkout.php'; //Cancel URL if user clicks cancel
?>