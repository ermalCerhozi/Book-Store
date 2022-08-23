<?php
session_start();
include "../DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_name = $_POST['Name'];
	$user_surname = $_POST['Surname'];
	$user_email = $_POST['Email'];
	$user_password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
	$user_confirmPassword = $_POST['ConfirmPassword'];
	$user_birthday = date('Y-m-d', strtotime($_POST['Birthday']));
	$user_city = $_POST['City'];
	$user_street = $_POST['Street'];
	$user_postalCode = $_POST['PostalCode'];
	$user = $_POST['Role'];


	if (!filter_var($user_email, FILTER_SANITIZE_EMAIL)) {
		$data = ["Return" => false, "Message" => "Passwordi jo i sakte /n"];
		echo json_encode($data);
	}
	try {
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("Select person_id from person WHERE email LIKE :user_id");
		$stmt->bindParam(':user_id', $user_email);
		$stmt->execute();
		// $stmt = $pdo->query("Select person_id from person WHERE email LIKE '$user_email'");
		// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($result == null) {
			// $stmt = $pdo->query("Select city_id from city WHERE name LIKE '$user_city'");
			// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt = $pdo->prepare("Select city_id from city WHERE city_name LIKE :city");
			$stmt->bindParam(':city', $user_city);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($result) {
				$id = $result[0]['city_id'];
				// $stmt = $pdo->query("Select city,street_name,postal_code,address_id from address where city = '$id'");
				// $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt = $pdo->prepare("Select city,street_name,postal_code,address_id from address where city = :city");
				$stmt->bindParam(':city', $id);
				$stmt->execute();
				$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if ($arr) {
					$check = true;
					foreach ($arr as $item) {
						if (
							$item['city'] == $id &&
							strtolower($item['street_name'])== strtolower($user_street) &&
							$item['postal_code'] == $user_postalCode
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