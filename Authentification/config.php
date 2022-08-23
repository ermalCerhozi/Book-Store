<?php
	// session_start();
	require_once "../vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("53680666586-hgjm0q7pooorcqqqtoi951lv25rndej5.apps.googleusercontent.com");
	$gClient->setClientSecret("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");
	$gClient->setRedirectUri("http://localhost/book%20store/Authentification/googleLogin.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/user.addresses.read https://www.googleapis.com/auth/user.birthday.read");
?>
