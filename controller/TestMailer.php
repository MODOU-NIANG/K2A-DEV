<?php
require_once 'Mailer.php';

$mailer = new Mailer();
$to = 'kodjo.pro221@gmail.com';
$subject = 'Test Email';
$body = 'This is a test email.';

$mailer->sendEmail($to, $subject, $body);
?>