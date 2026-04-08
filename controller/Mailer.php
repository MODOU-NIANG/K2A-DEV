<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        // ✅ Nouvelle configuration SMTP (mirahtec)
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.k2afiltration.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'contact@k2afiltration.com';
        $this->mail->Password = 'k2@filtration2025';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
        $this->mail->Port = 465;

        // Optionnel : utile si le certificat SSL n’est pas valide
        $this->mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        // Pour éviter les problèmes d’encodage
        $this->mail->CharSet = 'UTF-8';
    }

    public function sendEmail($to, $subject, $body) {
        try {
            // Expéditeur (identique à DEFAULT_FROM_EMAIL)
            $this->mail->setFrom('contact@k2afiltration.com', 'K2A Filtration');
            $this->mail->addAddress($to);

            // Contenu du message
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            echo "<p style='color:green;'>✅ Message envoyé avec succès !</p>";

        } catch (Exception $e) {
            echo "<p style='color:red;'>❌ Erreur d’envoi : {$this->mail->ErrorInfo}</p>";
        }
    }
}
?>
