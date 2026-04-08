<?php
require_once 'database.php';


class Product {
    private $con;
    private $table = 'produits'; // Nom de la table dans la base de données

    public function __construct() {
    $database = new Database();
    $this->con = $database->getConnection();
    // echo "✅ Connexion réussie !"; // tu peux le laisser pour test, puis l’enlever ensuite
}

    // 🔹 Ajouter un produit
    public function createProduct($nom_produit, $reference, $prix, $stock) {
        $sql = "INSERT INTO {$this->table} (nom_produit, reference, prix, stock) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssdi", $nom_produit, $reference, $prix, $stock);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // 🔹 Lire tous les produits
    public function readProduits() {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->con->query($sql);
        $produits = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produits[] = $row;
            }
        }

        return $produits;
    }

    // 🔹 Lire un seul produit par ID
    public function readSingleProduct($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produit = $result->fetch_assoc();
        $stmt->close();

        return $produit;
    }

    // 🔹 Mettre à jour un produit
    public function updateProduct($id, $nom_produit, $reference, $prix, $stock) {
        $sql = "UPDATE {$this->table} SET nom_produit = ?, reference = ?, prix = ?, stock = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssdii", $nom_produit, $reference, $prix, $stock, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // 🔹 Supprimer un produit
    public function deleteProduct($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // 🔹 Décrémenter le stock
    public function decrementStock($reference, $stock) {
        $sql = "UPDATE {$this->table} SET stock = stock - ? WHERE reference = ? AND stock >= ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("isi", $stock, $reference, $stock);
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();

        // Retourne vrai si une ligne a été modifiée
        return $affected > 0;
    }
}
?>
