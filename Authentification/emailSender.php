<?php
// session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use Google\Service\AIPlatformNotebooks\Location;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    if (
        isset($_SESSION['name']) &&
        isset($_SESSION['surname']) &&
        isset($_SESSION['email'])
    ) {
        $random_number = random_int(100000, 999999);
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();
        //Enable verbose debug output
        //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'no.reply.1library@gmail.com';                     //SMTP username
        $mail->Password   = '1Bookstore';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no.replay.1library@gmail.com', '4E SOLUTIONS');
        $mail->addAddress($_SESSION['email'], $_SESSION['name'] . " " . $_SESSION['surname']);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Kodi random eshte :    <b>' . $random_number . '</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION['code'] = $random_number;
        $_SESSION['permisson'] = "code";
        // echo json_encode(["Return" => true, "Message" => "Kodi u dergua me sukses"]);
        // exit();
    } else {
        //header("Location:resetPassword.php");
        header("Location:emailForReset");
        exit();
    }
    //Server settings
} catch (Exception $e) {
    return json_encode(["Return" => false, "Message" => "Ka gabime"]);
    exit();
}
