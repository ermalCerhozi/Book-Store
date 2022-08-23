<?php
session_start();
include "../DBconnect.php";
// echo json_encode(["Return" => false, "Message" => "Futemi ne back /n"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_email = $_POST['Email'];
	$user_password = $_POST['Password'];
	// $user_Captcha = $_POST['Captcha'];
	if (!filter_var($user_email, FILTER_SANITIZE_EMAIL)) {
		$data = ["Return" => false, "Message" => "Emaili jo i sakte /n"];
		echo json_encode($data);
		exit();
	}
	// if ($_SESSION['captcha'] != $user_Captcha) {
	// 	echo json_encode(["Return" => false, "Message" => "Kodi Captcha eshte gabim", "Captcha e sakte" => $_SESSION['captcha'], "Captcha e dhene" => $user_Captcha]);
	// 	exit();
	// } else {
	try {
		$pdo->beginTransaction();
		$stmt = $pdo->query("Select person_id,email,password,role from person WHERE email = '$user_email' and IsDeleted = 0");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($result) { // useri ekziston
			if (password_verify($user_password, $result[0]['password'])) {
				$_SESSION["user_email"] = $user_email;
				$_SESSION["role"] = $result[0]['role'];
				$_SESSION["user_id"] = $result[0]['person_id'];
				echo json_encode(["Return" => true, "Message" => "Me sukses", "Role" => $result[0]['role']]);
				exit();
			} else {
				echo json_encode(["Return" => false, "Message" => "Email ose passwordi gabim"]);
				exit();
			}
		} else {
			echo json_encode(["Return" => false, "Message" => "Ka gabim me email ose password"]);
		}
		// if (!empty($_SESSION["locked"])) {
		// 	$difference = (time() - $_SESSION["locked"]) / 60;
		// 	if ($difference > 2) {
		// 		unset($_SESSION["locked"]);
		// 		unset($_SESSION["login_attempts"]);
		// 		echo json_encode(["Return" => false, "Message" => "Koha mbaroi"]);
		// 	} else {
		// 		echo json_encode(["Return" => false, "Message" => "Prit"]);
		// 	}
		// } else {
		// 	if (!isset($_SESSION["login_attempts"])) {
		// 		$_SESSION["login_attempts"] = 0;
		// 	} else {
		// 		$_SESSION["login_attempts"] += 1;
		// 		if ($_SESSION["login_attempts"] > 2) {
		// 			$_SESSION["locked"] = time();
		// 			// echo "Please wait for 30 seconds";
		// 		}
		// 	}
		// 	echo json_encode(["Return" => false, "Message" => "Useri nuk ekziston me kete email dhe password"]);
		// }
	} catch (PDOException $e) {
		$pdo->rollBack();
		echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
	}
}
