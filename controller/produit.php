<?php
require_once 'config/app.php';

class Produit {
    private $con;
    private $table = 'produits'; // Nom de la table des produits
    public function __construct() {
        $database = new Database();
        $this->con = $database->getConnection();
    }
    
    public function updateProduit($id, $stock) {
        $sql = "UPDATE " . $this->table . " SET stock = :stock WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_Param(':stock', $stock);
        $stmt->bind_Param(':id', $id);
        
        return $stmt->execute(); // Retourne true si la mise à jour a réussi, sinon false
    }
}
?>


