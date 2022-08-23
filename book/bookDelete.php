<?php
session_start();
require_once "../DBconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = (int)$_POST["id_d"];
    try {
        $stmt = $pdo->query("Select IsBought from shopping_cart_book WHERE ISBN_shoppingCart LIKE '$isbn' && IsBought = 1");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result != null) {
            echo json_encode(["Return" => true, "Message" => "Libri me $isbn nuk mund te fshihet dot pasi eshte blere nga disa user"]);
            exit;
        }
        $stmt = $pdo->query("Select ISBN,book_cover,book_file from book WHERE ISBN LIKE '$isbn'");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result != null) {
            if (file_exists('../book_cover/' . $result[0]['book_cover'])) {
                chmod('../book_cover/' . $result[0]['book_cover'], 0755);
                unlink('../book_cover/' . $result[0]['book_cover']);
            }
            if (file_exists('../book_file/' .  $result[0]['book_file'])) {
                chmod('../book_file/' .  $result[0]['book_file'], 0755);
                unlink('../book_file/' .  $result[0]['book_file']);
            }

            $sql = "DELETE FROM book WHERE `ISBN` = $isbn";
            // use exec() because no results are returned
            $pdo->exec($sql);
            echo json_encode(["Return" => true, "Message" => "Libri me" +  $isbn + "u fshi nga databaza"]);
            exit;
        } else {
            echo json_encode(["Return" => false, "Message" => 'Ky liber nuk ekziston me ekte isbn']);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
}
