<?php

require_once "class.phpmailer.php";
require_once "class.smtp.php";
require_once "language/phpmailer.lang-es.php";



$to_name = "saurabh baliyan";
$to = "saurabhbaliyan000@gmail.com";
$subject = "Mail Test at ".strftime("%T", time());
$message = "This is a test.";

$message = wordwrap($message);



$from_name = "shivam chauhan";
$from = "shivamchauhan3596@gmail.com";

$mail = new PHPMailer();

$mail->FromName = $from_name;
$mail->From = $from;
$mail->AddAddress($to , $to_name);
$mail->Subject = $subject;
$mail->Body = $message;

$result = $mail->Send();
echo $result ? 'sent' : 'error';

?>
