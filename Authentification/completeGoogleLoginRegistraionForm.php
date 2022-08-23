<?php
session_start();
include "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_SESSION['email'];
    $user_name = $_SESSION['name'];
    $user_surname = $_SESSION['surname'];
    // $user_code = $_POST['Code'];
    $user_password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $user_confirmPassword = $_POST['ConfirmPassword'];
    $user_birthday = date('Y-m-d', strtotime($_POST['Birthday']));
    $user_city = $_POST['City'];
    $user_street = $_POST['Street'];
    $user_postalCode = $_POST['PostalCode'];
    $user = 'user';
    if (!filter_var($user_email, FILTER_SANITIZE_EMAIL)) {
        echo json_encode(["Return" => false, "Message" => "Passwordi jo i sakte"]);
        exit();
    }
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->query("Select person_id from person WHERE email LIKE '$user_email'");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result == null) {
            $stmt = $pdo->query("Select city_id from city WHERE name LIKE '$user_city'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                $id = $result[0]['city_id'];
                $stmt = $pdo->query("Select city,street_name,postal_code,address_id from address where city = '$id'");
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($arr) {
                    $check = true;
                    foreach ($arr as $item) {
                        if (
                            strtolower($item['city']) == strtolower($id) &&
                            strtolower($item['street_name']) ==  strtolower($user_street) &&
                            strtolower($item['postal_code']) == strtolower($user_postalCode)
                        ) {
                            //adresa ekziston nuk eshte nevoja qe ta shtojme
                            $check = false;
                            $address_id = $item['address_id'];
                            break;
                        }
                    }
                    if ($check) {
                        $sql = $pdo->prepare("INSERT INTO `address` (`city`, `street_name`, `postal_code`) VALUES (?,?,?);");
                        $sql->execute(array($id, $user_street, $user_postalCode));
                        $address_id = $pdo->lastInsertId();
                    }
                }
            } else {
                $sql = $pdo->prepare("INSERT INTO `city` (`name`) VALUES (?);");
                $sql->execute(array($user_city));
                $city_id = $pdo->lastInsertId();
                $sql = $pdo->prepare("INSERT INTO `address` (`city`, `street_name`, `postal_code`) VALUES (?,?,?);");
                $sql->execute(array($city_id, $user_street, $user_postalCode));
                $address_id = $pdo->lastInsertId();
            }
            $sql = $pdo->prepare("INSERT INTO person (name, surname, email, password,birthday,role,address_id) 
		VALUES (?,?,?,?,?,?,?)");
            $sql->execute(array($user_name, $user_surname, $user_email, $user_password, $user_birthday, $user, $address_id));
            $pdo->commit();
            echo json_encode(["Return" => true, "Message" => "Me sukses"]);
        } else {
            echo json_encode(["Return" => false, "Message" => "Useri me kete email eshte regjistruar"]);
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    }
}
