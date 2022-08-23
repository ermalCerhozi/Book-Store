<?php
session_start();
include "../DBconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["Email"];
    try {
        $stmt = $pdo->prepare("Select person_id from person WHERE email LIKE :user_id");
		$stmt->bindParam(':user_id', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result == null) {
            echo json_encode(["Return" => false, "Message" => "Useri me kete id ekziston ne database"]);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
    $id = $result[0]["person_id"];
    $person_name = $_POST["Name"];
    $lastName = $_POST["Surname"];
    $postal_code = $_POST["PostalCode"];
    $city_name = $_POST["City"];
    $street = $_POST["Street"];
    $birthday = date('Y-m-d', strtotime($_POST["Birthday"]));
    $pdo->beginTransaction();

    $stmt = $pdo->query("Select city_id from city where city_name = '$city_name'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $city_id = $result[0]['city_id'];
        $stmt = $pdo->prepare("Select city,street_name,postal_code,address_id from address where city = :city");
        $stmt->bindParam(':city', $city_id);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($arr) {
            $check = true;
            foreach ($arr as $item) {
                if (
                    $item['city'] == $city_id &&
                    strtolower($item['street_name']) == strtolower($street) &&
                    $item['postal_code'] == $postal_code
                ) {
                    //adresa ekziston nuk eshte nevoja qe ta shtojme
                    $check = false;
                    $address_id = $item['address_id'];
                    break;
                }
            }
            if ($check) {
                $sql = $pdo->prepare("INSERT INTO `address` (`city`, `street_name`, `postal_code`) VALUES (?,?,?);");
                $sql->execute(array($city_id, $street, $postal_code));
                $address_id = $pdo->lastInsertId();
            }
        }
    } else {
        echo json_encode(["Return" => false, "Message" => 'qyteti nuk ekziston ka gabim']);
        exit;
    }

    try {

        $sql = $pdo->prepare("Update `person` SET `name` = ?, `surname` = ? ,`address_id` = ?, `birthday` = ?
                 where `person`.`person_id` = ? ");
        $sql->execute(array($person_name, $lastName, $address_id, $birthday, $id));
        $pdo->commit();
        echo json_encode(["Return" => true, "Message" => "Update u krye me suskes"]);

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
}


?>