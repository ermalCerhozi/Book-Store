<?php
session_start();
include "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['Email'];

    if (!filter_var($user_email, FILTER_SANITIZE_EMAIL)) {
        $data = ["Return" => false, "Message" => "Emaili jo i sakte /n"];
        echo json_encode($data);
    }
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->query("Select email,name,surname from person WHERE email = '$user_email'");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) { // useri ekziston
            $name = $result[0]['name'];
            $surname = $result[0]['surname'];
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $user_email;
            include("emailSender.php");
            echo json_encode(["Return" => true, "Message" => "Kodi u dergua me sukses"]);
            // echo json_encode(["Return" => true, "Message" => "Kodi u dergua me sukses"]);
            // exit();
        } else {
            echo json_encode(["Return" => false, "Message" => "Useri nuk ekziston me kete email dhe password"]);
            exit();
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => "ka gabim"]);
    }
}
