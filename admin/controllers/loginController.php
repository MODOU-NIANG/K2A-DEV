<?php
require_once('../config/app.php');


if (isset($_POST['login'])) {
  $login = $_POST['email'];

  $pass = stripslashes($_POST['pwd']);

  $pass = mysqli_real_escape_string($con, $pass);

  $pwdH = hash('sha256', $pass);

  $query1 = "SELECT users.*, roles.role FROM users  INNER JOIN roles ON roles.id = users.role_id WHERE users.email ='" . $login . "' and users.password='" . $pwdH . "' and users.statut=1";
  $result1 = mysqli_query($con, $query1);
  while ($row = mysqli_fetch_array($result1)) {
    $emailUser = $row['email'];
    $passUser = $row['password'];
    $prenomUser = $row['prenom'];
    $nomUser = $row['nom'];
    $roleUser = $row['role'];
    $id = $row['id'];
  }


  if (empty($_POST['email']) || empty($_POST['pwd'])) {
    header('Location:../login.php?Empty= ');
    $_SESSION['errorMsg'] = true;
    $_SESSION['successMsg'] = false;
    $_SESSION['message'] = "Veuillez remplir tous les champs ! ";
    header('Location: ../');
  } else {
    $query = "SELECT users.*, roles.role FROM users  INNER JOIN roles ON roles.id = users.role_id WHERE users.email ='" . $login . "' and users.password='" . $pwdH . "' and users.statut=1";
    $result = mysqli_query($con, $query);



    if (mysqli_fetch_assoc($result)) {
      $_SESSION['User'] = $login;
      $_SESSION['id'] = $id;
      $_SESSION['UserPass'] = $passUser;
      $_SESSION['prenom'] = $prenomUser;
      $_SESSION['nom'] = $nomUser;
      $_SESSION['email'] = $emailUser;
      $_SESSION['role'] = $roleUser;

      date_default_timezone_set('Africa/Dakar');
      $dateConnexion = date("Y-m-d H:i:s");



      function getIp()
      {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
      }



      $ipAdress = getIp();


      // try {

      mysqli_query($con, "INSERT INTO journal_connexion (login, dateConnexion, ip) 
                VALUES ('$login', '$dateConnexion', '$ipAdress')");

      $_SESSION["AUTHENTICATED"] = true;
      $_SESSION['errorMsg'] = false;
      $_SESSION['successMsg'] = true;
      $_SESSION['message'] = "Bienvenue !";
      header('Location: ../categories');
    } else {
      $_SESSION['errorMsg'] = true;
      $_SESSION['successMsg'] = false;
      $_SESSION['message'] = "Email ou mot de passe incorrecte ! ";
      header('Location: ../');
    }
  }
} else {
  echo 'Not workinggg !!!';
}
