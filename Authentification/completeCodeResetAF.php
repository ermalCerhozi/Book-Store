<?php
session_start();
include "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = $_POST['Code'];
    try {
        if ($user_code == $_SESSION['code']) {
            $_SESSION['permisson'] = "password";
            echo json_encode(["Return" => true, "Message" => "Kodi perputhet"]);
        }
        else{
            include_once("emailSender.php");
            echo json_encode(["Return" => false, "Message" => "Kodi u dergua perseri"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["Return" => false, "Message" => "ka gabim"]);
    }
}
