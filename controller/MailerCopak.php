<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class MailerCopak {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        // SMTP configuration
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.copak.sn';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'contact@copak.sn';
        $this->mail->Password = 'Copak@2022';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
    }

    public function sendEmail($to, $subject, $body) {
        try {
            // Recipients
            $this->mail->setFrom('contact@copak.sn', 'COPAK');
            $this->mail->addAddress($to);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
?>