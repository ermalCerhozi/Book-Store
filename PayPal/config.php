<?php
define('PAYPAL_ID', 'erdion.hoxha@fshnstudent.info'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'http://localhost/book%20store/PayPal/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/book%20store/PayPal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/book%20store/PayPal/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', 'MySQL_Database_Host'); 
define('DB_USERNAME', 'MySQL_Database_Username'); 
define('DB_PASSWORD', 'MySQL_Database_Password'); 
define('DB_NAME', 'MySQL_Database_Name'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>