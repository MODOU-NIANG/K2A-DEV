<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'guediawa_k2a';
    private $username = 'guediawa_k2a';
    private $password = 'k2a2025@';
    private $port = 3306;
    private $con;

    public function getConnection() {
        // Activer le mode debug
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        echo "<div style='background:#eef; padding:8px; border-left:5px solid #00f;'>
            🔍 <b>Mode debug activé :</b> toutes les erreurs seront visibles ici.
        </div>";

        $this->con = null;

        try {
            // Connexion MySQLi
            $this->con = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->db_name,
                $this->port
            );

            // Vérifie la connexion
            if ($this->con->connect_error) {
                throw new Exception("Erreur de connexion : " . $this->con->connect_error);
            }

            echo "<div style='color:green; background:#e8ffe8; padding:8px; border-left:5px solid #0a0;'>
                ✅ Connexion réussie à la base de données : <b>{$this->db_name}</b>
            </div>";

        } catch (Exception $e) {
            echo "<div style='color:red; background:#ffe8e8; padding:10px; border:1px solid #cc0000;'>
                ❌ <b>Erreur :</b> impossible d'établir une connexion à la base de données.<br>
                Détail : {$e->getMessage()}<br>
                Vérifie ton fichier <b>database.php</b> (identifiants, mot de passe, ou nom de base).
            </div>";
        }

        return $this->con;
    }
}
?>
