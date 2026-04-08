<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/autoload.php';

$mail = new PHPMailer(true);

echo "<h2>🔍 Test de connexion SMTP...</h2>";

try {
    // Activer le mode SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.k2a.sn';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@k2a.sn';
    $mail->Password = 'k2a2025@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Essaie aussi ENCRYPTION_STARTTLS si besoin
    $mail->Port = 465; // Ou 587 si STARTTLS

    // Débogage complet (2 = affichage complet des échanges avec le serveur)
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    // Sécurité SSL (utile si certificat non valide)
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];

    // Configuration de base du message
    $mail->setFrom('contact@k2a.sn', 'K2A Filtration');
    $mail->addAddress('contact@k2a.sn'); // envoie de test vers toi-même
    $mail->Subject = '✅ Test SMTP K2A';
    $mail->Body = '<p>Le test SMTP de K2A fonctionne correctement 🚀</p>';
    $mail->isHTML(true);

    // Envoi
    if ($mail->send()) {
        echo "<p style='color:green;'>✅ Message envoyé avec succès !</p>";
    } else {
        echo "<p style='color:red;'>❌ Échec de l’envoi du message.</p>";
    }

} catch (Exception $e) {
    echo "<p style='color:red;'>⚠️ Erreur SMTP : " . htmlspecialchars($mail->ErrorInfo) . "</p>";
}
?>
