<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class MailerK2A {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        // SMTP configuration
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.whc.ca';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'contact@k2afiltration.com';
        $this->mail->Password = 'K2@2024.';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mail->setFrom('contact@k2afiltration.com', 'K2A Filtration');
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
?>