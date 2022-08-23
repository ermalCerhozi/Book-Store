<?php
session_start();
include "../DBconnect.php";
$user = $_SESSION["user_id"];
$stmt = $pdo->prepare("select ShopingCartBookId,actual_price from shopping_cart_book where User_id = $user and IsBought = 0;");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($data) == 0) {
    echo json_encode(["Return" => false, "Message" => "Ky user nuk ka asnje liber ne shopping cart"]);
    exit;
} else {
    try {
        $pdo->beginTransaction();
        
        $date = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO `payment` (`User_Id`, `Total`, `Tax`, `date`) VALUES (?,?,?,?)");
        $stmt->execute(array($user,0,0,$date));
        $payment_id = $pdo->lastInsertId();
        $total = 0;
        foreach ($data as $row) {
            $element = $row['ShopingCartBookId'];
            $stmt = $pdo->prepare("UPDATE `shopping_cart_book` SET IsBought = 1, Payment_id = $payment_id WHERE ShopingCartBookId = $element");
            $total += $row['actual_price'];
            $stmt->execute();
        }
        $tax  = $total * 0.2;

        $stmt = $pdo->prepare("UPDATE `payment` SET Total = $total, Tax = $tax  WHERE payment_id = $payment_id");
        $stmt->execute();
        $pdo->commit();
        echo json_encode(["Return" => true, "Message" => "Blerja u krye me sukses"]);
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
}
