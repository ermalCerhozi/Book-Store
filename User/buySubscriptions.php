<?php
session_start();
include "../DBconnect.php";


if (isset($_GET["id"]) && isset($_GET["price"]) && isset($_GET["type"]) && isset($_GET["sale"])) {
    $id = $_GET["id"];
    $price = $_GET["price"];
    $user = $_SESSION["user_id"];
    $subscription_id = $_GET["id"];
    $current_time = date('Y-m-d', time());
    $type = $_GET["type"];
    $sale = $_GET["sale"];
    $stmt = $pdo->prepare("SELECT * FROM `user_subscription` WHERE person_id = $user and subscription_finish_date > '$current_time' ;");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($row) != 0) {
        echo json_encode(["Return" => false, "Message" => "Ju keni nje subscription aktiv.Prisni qe te mbaroje ia para se te blini nje te ri"]);
        exit;
    } else {
        try {
            switch ($type) {
                case 'monthly':
                    $termination_date = date('Y-m-d', strtotime($current_time . ' + 1 months'));
                    break;
                case 'quarter_annual':
                    $termination_date = date('Y-m-d', strtotime($current_time . ' + 3 months'));
                    break;
                case 'semi_annual':
                    $termination_date = date('Y-m-d', strtotime($current_time . ' + 6 months'));
                    break;
                case 'annual':
                    $termination_date = date('Y-m-d', strtotime($current_time . ' + 12 months'));
                    break;

                default:
                    echo json_encode(["Return" => false, "Message" => "Pati nje error me blerjen e subscription. Provoni perseri"]);
                    exit;
                    break;
            }
            $stmt = $pdo->prepare("INSERT INTO `user_subscription` (`person_id`, `subscription_id`, `subscription_start_date`, `subscription_finish_date`,`purchase_price`,`amount_of_sale_at_purchase`) VALUES (?,?,?,?,?,?)");
            $stmt->execute(array($user, $id, $current_time, $termination_date, $price,$sale));
            echo json_encode(["Return" => true, "Message" => "U abonuat me sukses"]);
        } catch (PDOException $e) {
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
            exit;
        }
    }
}
