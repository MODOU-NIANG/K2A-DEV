<?php
$servername = "localhost";
$username = "guediawa_k2a";
$password = "k2a2025@";
$dbname = "guediawa_k2a";
$port = 3306;

// Création de la connexion
$con = new mysqli($servername, $username, $password, $dbname, $port);

// Vérification de la connexion
if ($con->connect_error) {
    die("❌ Erreur de connexion MySQL : " . $con->connect_error);
} else {
    // echo "✅ Connexion MySQL OK<br>";
}

$appName = "K2A";
date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$anneeEnCours = date('Y', strtotime($dateDuJour));

//date('d-m-Y',strtotime($dateN))


// Email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
// More headers
$from = 'leborofaye@gmail.com';
$headers .= 'From: <' . $from . '>' . "\r\n";

function see()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


function dd($value, $line = "note set")
{
    echo "LINE: " . $line;
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}

$is_looged = (isset($_SESSION["AUTHENTICATED"]) and $_SESSION["AUTHENTICATED"]);

$went_access =
    in_array("admin", explode("/", $_SERVER["REQUEST_URI"]))
    and
    in_array("admin.php", explode("/", $_SERVER["REQUEST_URI"]));

if (
    !$is_looged and $went_access
) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['successMsg'] = false;
    // $_SESSION['message'] = "Veuillez vous authentifier !";
    // header('Location: ../admin');
}
?>