<?php
session_start();
include "../DBconnect.php";
if (isset($_POST["start"]) && isset($_POST["end"])) {

    try {
        $start = $_POST["start"];
        $end = $_POST["end"];
        $seat = $_POST["id"];
        $stmt = $pdo->prepare("SELECT * from chair_user where chair_number = ? and reservation_time >= ? and  termination_time <= ?");
        $stmt->execute(array($seat,$start,$end));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($row) > 0) {
            echo json_encode(["Return" => false, "Message" => "Ka rezervime gjate kerij orari.Tendto nje orar tjeter"]);
        }
        else{
            $user = $_SESSION["user_id"];
            $stmt = $pdo->prepare("INSERT INTO `chair_user` (`chair_number`, `user_id`, `reservation_time`, `termination_time`) VALUES (?,?,?,?)");
            $stmt->execute(array($seat,$user,$start,$end));
            echo json_encode(["Return" => true, "Message" => "Rezervimi u krye me sukses"]);
        }
    }
    catch (PDOException $e) {
        echo json_encode(["Return" => false, "Message" => "Ka nje error"]);
        exit;
    }
}



?>