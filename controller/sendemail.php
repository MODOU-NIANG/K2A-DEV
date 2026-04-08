<?php
// var_dump($_POST);
// die;
include("../config.php");

include 'Mailer.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
// require 'vendor/autoload.php';
// use Controller\MailerContact;
//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

 

   if(isset($_POST["submit-form"]))
    {
      // if($_POST["username"] !="" && $_POST["email"] !="" && $_POST["telephone"] !="" && $_POST["message"]! ="" ) {
        // var_dump($_POST);
        // die;
        $nom=htmlspecialchars($_POST["username"]);
        $email=htmlspecialchars($_POST["email"]);
        // $adresse=htmlspecialchars($_POST['adresse']);
        $telephone=htmlspecialchars($_POST["telephone"]);
        $message=$_POST["message"];
        $date=date('Y-m-d H:i:s');{
           

          // $insertion=$conn->prepare ("INSERT INTO contact(username,email,telephone,message,Date_envoi)values(?,?,?,?,?) ");
          // $insertion->execute(array ($nom,$email,$telephone,$message,$date));

        
    }
    $mailer=new Mailer();
      
    $body="
    
    <p> Bonjour, </p>

     <P> vous avez reçu un nouveau message via le formulaire de contact de votre site<strong> K2A filtration. </strong> Voici les details: </p>
     <ul> 

     <li><strong> Nom: </strong>{$nom} </li>
     <li><strong> Email: </strong> {$email}</li>
     <li><strong> téléphone: </strong> {$telephone} </li>
     <li><strong> message: </strong> 
          <p> $message </p> </li>
     </ul>

    ";
    // Adresse de l'administrateur
    $adminEmail = "contact@k2afiltration.com";

    // Envoi de l'e-mail à l'administrateur
    $mailer = new Mailer();
    $mailer->sendEmail($adminEmail, "Notification Contact", $body);


  //  $mailer->sendEmail($email, "notification contact", $body);
  //Set Location After Successsfull Submission
  header('Location: ../confirmation_contact.php?message=Successfull');
}

else{
	//Set Location After Unsuccesssfull Submission
  	header('Location: ../index.php?message=Failed');	
}

// }

?>
