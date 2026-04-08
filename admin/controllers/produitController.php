<?php
session_start();
require_once '../config/app.php'; // Assure-toi d'inclure le bon fichier de connexion

// Activer l'affichage des erreurs (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si la requête est un POST et si l'ID du produit est bien transmis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        $id = intval($_POST['id']); // Sécuriser l'ID
        $nom_produit = htmlspecialchars(trim($_POST['nom_produit']));
        $prix = htmlspecialchars(trim($_POST['prix']));
        $description = htmlspecialchars(trim($_POST['description']));
        $stock = htmlspecialchars(trim($_POST['stock']));
        $code_categorie = htmlspecialchars(trim($_POST['code_categorie']));
        $code_type = htmlspecialchars(trim($_POST['code_type']));

        // Mise à jour de l'image si une nouvelle est envoyée
        $image_name = $_POST['image_actuelle']; // Par défaut, garder l'image actuelle
        if (!empty($_FILES['image']['name'])) {
            $image_name = basename($_FILES['image']['name']);
            $target_dir = "../uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }

        // Requête de mise à jour
        $sql = "UPDATE produits SET nom_produit=?, prix=?, description=?, stock=?, code_categorie=?, code_type=?, image=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom_produit, $prix, $description, $stock, $code_categorie, $code_type, $image_name, $id]);

        // Message de confirmation et redirection
        $_SESSION['message'] = "Produit modifié avec succès !";
        $_SESSION['message_type'] = "success"; // Pour afficher une alerte de succès
        header("Location: ../modifier_produit.php?id=$id");
        exit();

    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour du produit : " . $e->getMessage());
    }
} else {
    $_SESSION['message'] = "Erreur : Données invalides.";
    $_SESSION['message_type'] = "danger";
    header("Location: ../liste_produits.php"); // Rediriger vers la liste des produits
    exit();
}
?>
