<?php
session_start();
require_once "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    if (isset($_SESSION['email'])) {
        try {
            $value = $_SESSION['email'];
            $pdo->beginTransaction();
            $sql = "UPDATE person SET password='$password' WHERE email='$value'";

            // Prepare statement
            $stmt = $pdo->prepare($sql);

            // execute the query
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                echo json_encode(["Return" => true, "Message" => "Me sukses"]);
            }
            else{
                echo json_encode(["Return" => false, "Message" => "Me gabim ndryshimi"]);
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo json_encode(["Return" => false, "Message" => "ka gabim"]);
        }
    } else {
        echo json_encode(["Return" => false, "Message" => "Emaili nuk eshte ne sesion"]);
    }
}
