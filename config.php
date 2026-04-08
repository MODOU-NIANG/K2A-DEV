<?php
$servername = "localhost";
$username = "guediawa_k2a";
$password = "k2a2025@";
$dbname = "guediawa_k2a";
$port = 3306;

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérification de la connexion
if ($conn->connect_error) {
    die("❌ Erreur de connexion MySQL : " . $conn->connect_error);
} else {
    // echo "✅ Connexion MySQL OK<br>";
}
?>
