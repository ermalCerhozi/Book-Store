<?php
session_start();
include "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["id_d"];

    try {
        if ($_POST["type_d"] == "Delete") {
            $stmt = $pdo->prepare("UPDATE `person` SET `IsDeleted` = ? WHERE `person`.`person_id` = $user ");
            $stmt->execute(array(1));
            echo json_encode(["Return" => true, "Message" => "useri u fshi me sukses"]);
        } else {
            $stmt = $pdo->prepare("UPDATE `person` SET `IsDeleted` = ? WHERE `person`.`person_id` = $user ");
            $stmt->execute(array(0));
            echo json_encode(["Return" => true, "Message" => "useri u aktivizua me sukses"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(["Return" => false, "Message" => "Pati nje problem te vogel"]);
    exit;
}
