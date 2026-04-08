<?php 

if(isset($_POST['forgot'])) {

require_once ('../config/app.config.php');

$email = $_POST['email'];

// Verifier l'existance de l'email

$chekEmail = mysqli_query($con, "SELECT * FROM users WHERE email ='$email'");

if (mysqli_num_rows($chekEmail)>0) {

    // Mettre a jour le mot de passe
    $n=6;
    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }
    $newPass= getRandomString($n);

    $newPass= mt_rand(100000, 999999);
    $passH = hash('sha256', $newPass);

    mysqli_query($con, "UPDATE users set password='$passH' WHERE email='$email'");

    // Envoyer l'email
   
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
    // More headers
    $from='leborofaye@gmail.com';
    $headers .= 'From: <'.$from.'>' . "\r\n";

    // $headers .= 'Cc: info@ontimeinfotech.com' . "\r\n";
    $to=$email;
    $subject='[Support AMS]: Recuperation mot de passe administrateur';
    $contenu='Votre nouveau mot de passe est : <strong>'.$newPass.'</strong><br> Veuillez changer ce mot de passe lors de votre connexion';
    // $msg = wordwrap($contenu, 70);
    mail($to, $subject, $contenu, $headers);

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] = "Votre nouveau mot de passe est envoyé a votre adresse email. ";
    header ('Location: ../index.php');

}
else
{
    $_SESSION['errorMsg']=true;
    $_SESSION['successMsg']=false;
    $_SESSION['message'] = "L'adresse email saisi n'existe pas dans la base. ";
    header ('Location: ../reset_password.php');
}

}
?>