<?php
require_once 'database.php';

class LigneCommande {
    private $con;
    private $table = 'lignes_commandes'; // Nom de la table des lignes de commande

    public function __construct() {
        $database = new Database();
        $this->con = $database->getConnection();
    }

    public function createLigneCommande($commande_id, $produit_reference, $quantite) {
        $sql = "INSERT INTO " . $this->table . " (commande_id, produit_reference, quantite)
                VALUES (?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Erreur de préparation : " . $this->con->error);
        }

        // Liaison des paramètres (i = int, s = string)
        $stmt->bind_param("isi", $commande_id, $produit_reference, $quantite);

        if ($stmt->execute()) {
            $last_id = $this->con->insert_id;
            $stmt->close();
            return $last_id;
        } else {
            die("Erreur lors de l'insertion de la ligne commande : " . $stmt->error);
        }
    }
}
?>
