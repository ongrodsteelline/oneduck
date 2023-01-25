<?php
 
require 'PHPMailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
//Дебаг
//0 = off (for production use)
//1 = клиентские сообщения
//2 = серверные и клиентские сообщения
$mail->SMTPDebug = 2;

$mail->isSMTP();
$mail->Host = 'smtp.sparkpostmail.com'; //gmail: smtp.gmail.com
$mail->SMTPAuth = true;
$mail->Username = 'SMTP_Injection';
$mail->Password = '04c94635fa3586da89a64525a2a5a7d9027273de';
$mail->SMTPSecure = '';
$mail->Port = 587;
$mail->CharSet = "utf-8";
$mail->setLanguage('ru');
$mail->setFrom('info@oneduck.learn-mail.com', 'TEST oneduck.learn-mail.com');


$mail->addBCC('o.holevinsky@gmail.com');

$mail->isHTML(true);
 
$mail->Subject = 'TEST oneduck.learn-mail.com';
$mail->Body    = 'TEST oneduck.learn-mail.com';

 
//Отправка сообщения
if(!$mail->send()) {
    echo 'Ошибка при отправке. Ошибка: ' . $mail->ErrorInfo;
} else {
    echo 'Сообщение успешно отправлено';
}