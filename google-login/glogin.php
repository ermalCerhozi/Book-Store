<?php
require_once 'google-api/vendor/autoload.php';


$clientID = '53680666586-hgjm0q7pooorcqqqtoi951lv25rndej5.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUrl = 'http://localhost/book%20store/LogIn.php';


$google_client = new Google_Client();
$google_client->setClientId($clientID);
$google_client->setClientSecret($clientSecret); 
$google_client->setRedirectUri("http://localhost/book%20store/google-login/glogin.php");
$client->setScopes(array(
    "https://www.googleapis.com/auth/plus.login",
    "https://www.googleapis.com/auth/userinfo.email",
    "https://www.googleapis.com/auth/userinfo.profile",
    "https://www.googleapis.com/auth/plus.me"
    ));

$login_url = $google_client->createAuthUrl();
session_start();
header("Location: $login_url");

// if (isset($_GET["code"])) {
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//     if (!isset($token["error"])) {
        
//         $google_client->setAccessToken($token["access_token"]);
//         $_SESSION['access_token'] = $token['access_token'];
//         //Create Object of Google Service OAuth 2 class
//         // $google_service = new Google_ser($client);
      
//         //Get user profile data from google
//         $data = $google_service->userinfo->get();
      
//         //Below you can find Get profile data and store into $_SESSION variable
//         if(!empty($data['given_name']))
//         {
//          $_SESSION['user_first_name'] = $data['given_name'];
//         }
      
//         if(!empty($data['family_name']))
//         {
//          $_SESSION['user_last_name'] = $data['family_name'];
//         }
      
//         if(!empty($data['email']))
//         {
//          $_SESSION['user_email_address'] = $data['email'];
//         }
      
//         if(!empty($data['gender']))
//         {
//          $_SESSION['user_gender'] = $data['gender'];
//         }
      
//         if(!empty($data['picture']))
//         {
//          $_SESSION['user_image'] = $data['picture'];
//         }
//        }
//       }
      
//       //This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
//       if(!isset($_SESSION['access_token']))
//       {
//        //Create a URL to obtain user authorization
//        $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png" /></a>';
//       }



?>