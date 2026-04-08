<?php
use PHPUnit\Framework\TestCase;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once 'controller/Mailer.php';

class MailerTest extends TestCase {
    public function testSendEmail() {
        $mailer = new Mailer();
        $result = $mailer->sendEmail('kodjo.pro221@gmail.com', 'Test Subject', 'Test Body');
        $content = "Commande effectuer par USER USER" ;
        $this->assertTrue($result, $content);
    }
}
?>