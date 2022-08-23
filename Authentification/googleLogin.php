<?php
session_start();
include "../DBconnect.php";
if (isset($_SESSION['permisson'])) {
	unset($_SESSION['permisson']);
}
require_once "config.php";
if (isset($_SESSION['access_token']))
	$gClient->setAccessToken($_SESSION['access_token']);
else if (isset($_GET['code'])) {
	$tmp = $_GET['code'];
	$token = $gClient->fetchAccessTokenWithAuthCode($tmp);
	$_SESSION['access_token'] = $token;
} else {
	header('Location: login.php');
	exit();
}

$oAuth = new Google\Service\Oauth2($gClient);
// $optParams = array(
// 	'personFields' => 'birthdays',
//   );
// //$results = $oAuth->people->get('people/me', $optParams);
// $prove = $oAuth->people->get();
$userData = $oAuth->userinfo_v2_me->get();
$userId =  $userData['id'];
$tmp = $token['access_token'];
$str = "https://people.googleapis.com/v1/people/$userId?personFields=birthdays&access_token=$tmp";
$rez = file_get_contents($str);
$json = json_decode($rez, true);

$email = $userData['email'];
$stmt = $pdo->query("Select person_id,email,password,role,IsDeleted from person WHERE email = '$email'");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($result) {
	 // useri ekziston
	 if ($result[0]['IsDeleted'] == 1) {
		header('Location: ../Authentification/login.php');	
		exit;
	 }
	$_SESSION['role'] = $result[0]['role'];
	$_SESSION['user_email'] = $email;
	$_SESSION['user_id'] = $result[0]['person_id'];
	if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "worker" ) {
		header('Location: ../Admin/home.php');
		exit;	
	}
	else{

		header('Location: ../User/home.php');
		exit;
	}

} else {
	$_SESSION['id'] = $userData['id'];
	$_SESSION['user_email'] = $email;
	// $_SESSION['gender'] = $userData['gender'];
	// $_SESSION['picture'] = $userData['picture'];
	$_SESSION['name'] = $userData['familyName'];
	$_SESSION['surname'] = $userData['givenName'];
	$_SESSION['permisson'] = "googleLogin";
	header('Location: googleLoginFormContinue.php');
	exit();
}
// $date_birtday = $json['birthdays'][1]['date']['day'] ;
// $month_birthday = $json['birthdays'][1]['date']['month'];
// $birthday_year = $json['birthdays'][1]['date']['year'];
//https://people.googleapis.com/v1/people/(user_id)?personFields=(fields you want)&key=(valid api key)&access_token=(accessToken in credetials in the result of the authentification)
