<?php   
require_once('core/controller.Class.php');
require_once('glogin.php');
if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $google_client->setAccessToken($token["access_token"]);
 
      
}
else{
    header('Location: glogin.php');
    exit();
}
$oAuth = new($google_client);

?>