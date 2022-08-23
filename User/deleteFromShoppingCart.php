<?php
session_start();
include "../DBconnect.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user = $_SESSION["user_id"];
    $stmt = $pdo->prepare("SELECT * FROM `shopping_cart_book` WHERE ShopingCartBookId = $id;");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($row) == 0) {
        echo json_encode(["Return" => false, "Message" => "Ky liber nuk ndodht ne shopping cart ose eshte blere nga ju"]);
        exit;
    }
    else {
        try {
            $stmt = $pdo->prepare("DELETE FROM `shopping_cart_book` where ShopingCartBookId = $id;");
            $stmt->execute();
            echo json_encode(["Return" => true, "Message" => "U hoq me sukses nga shopping cart"]);
        } catch (PDOException $e) {
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
            exit;
        }
    }
    
}
?>