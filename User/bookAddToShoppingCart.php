<?php
session_start();
include "../DBconnect.php";
if (isset($_GET["isbn"]) && isset($_GET["price"])) {
    $isbn = $_GET["isbn"];
    $price = $_GET["price"];
    $user = $_SESSION["user_id"];
    $stmt = $pdo->prepare("SELECT * FROM `shopping_cart_book` WHERE User_id = $user and ISBN_shoppingCart = $isbn;");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($row) != 0) {
        echo json_encode(["Return" => false, "Message" => "Ky liber ndodht ne shopping cart ose eshte blere nga ju"]);
        exit;
    }
    else {
        try {
            $stmt = $pdo->prepare("INSERT INTO `shopping_cart_book` (`ISBN_shoppingCart`, `User_id`, `actual_price`, `IsBought`) VALUES (?,?,?,?);");
            $stmt->execute(array($isbn,$user,$price,false));
            echo json_encode(["Return" => true, "Message" => "Me sukses"]);
        } catch (PDOException $e) {
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
            exit;
        }
    }
    
}
?>
