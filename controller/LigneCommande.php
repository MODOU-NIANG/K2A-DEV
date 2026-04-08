<?php
require_once 'database.php';

class Commande {
    private $conn;
    private $table = 'commandes'; // Nom de la table des commandes

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); // Connexion MySQLi
    }

    // Créer une commande
    public function createCommande($user_id, $total_price)
    {
        // Préparation de la requête MySQLi
        $sql = "INSERT INTO " . $this->table . " (utilisateur_id, prix_total) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erreur préparation requête : " . $this->conn->error);
        }

        // Liaison des paramètres (i = entier, d = double/float, s = string)
        $stmt->bind_param("id", $user_id, $total_price);

        if ($stmt->execute()) {
            return $this->conn->insert_id; // ID de la commande insérée
        } else {
            echo "Erreur lors de la création de la commande : " . $stmt->error;
            return false;
        }
    }
}
?>
