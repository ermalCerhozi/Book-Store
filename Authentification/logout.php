<?php
session_start();
require_once "../vendor/autoload.php";
if (isset($_SESSION['access_token'])) {
	$token = $_SESSION['access_token'];
	unset($_SESSION['access_token']);
	$gClient = new Google_Client();
	$gClient->revokeToken($token);
}
session_unset();
session_destroy();
header('Location: login.php');
exit();
