<?php 

error_reporting(0);

require_once('LoadRegularPage.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');
require_once('MailCredits.php');
getPageInfo("page_title='Feedback'", $title, $header, $content, $aside);

if(isset($_POST['phone']) && isset($_POST['mail']) && 
    isset($_POST['subject']) && isset($_POST['messageText']) && isset($_POST['name'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $userMail = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['messageText'];

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();   
    $mail->Host   = 'ssl://smtp.mail.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = $adminMail;
    $mail->Password   = $adminPassword;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
 
    $mail->addAddress($adminMail);
    $mail->From = $userMail;
    $mail->FromName = $name;
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();

    $mail->clearAddresses();
    $mail->addAddress($userMail);
    $mail->From = $adminMail;
    $mail->Subject = 'Not reply';
    $mail->FromName = 'Администрация сайта "Документация PHP"';
    $mail->Body = 'с благодарностью за отправленное сообщение и скором ответе';
    $mail->send();
}

include('../Template.php');

