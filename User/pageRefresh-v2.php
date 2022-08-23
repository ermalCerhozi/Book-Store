<?php
include "../DBconnect.php";

if (isset($_GET["start"]) && isset($_GET["end"])) {


    $pdo->beginTransaction();
    try {
        $start = $_GET["start"];
        $end = $_GET["end"];
        $stmt = $pdo->prepare("SELECT * from chair_user where (reservation_time > ? and reservation_time < ? and termination_time > ? ) or (reservation_time < ? and reservation_time < ?  and termination_time > ? ) or (reservation_time = ? and reservation_time < ?)");
        // $stmt = $pdo->prepare("SELECT * from chair_user where (reservation_time >= ? and reservation_time >= ?) or (termination_time >= ? and termination_time >= ?)");
        // $stmt->execute(array($start, $end,$start, $end));
        $stmt->execute(array($start, $end, $start, $start, $end, $start, $start, $end));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $values = array();
        if (count($row) > 0) {
            for ($i = 1; $i <= 40; $i++) {

                for ($j = 0; $j < count($row); $j++) {
                    if ($row[$j]["chair_number"] == $i) {
                        array_push($values, $i);
                    }
                }
            }
        }
        $current_time = date("H",time());
        $stmt = $pdo->prepare("Delete from chair_user where termination_time <= ?");
        $stmt->execute(array($current_time));
        $pdo->commit();
        echo json_encode(["Data" => $values]);
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    }
}
