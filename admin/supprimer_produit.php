<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config/app.php'); // connexion MySQLi ($con)

// Vérifier que l'ID est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("⚠️ ID du produit invalide !");
}

$id = intval($_GET['id']);

// 🔹 Étape 1 : Récupérer le produit (pour supprimer l’image si nécessaire)
$query = "SELECT image FROM produits WHERE id = ?";
$stmt = $con->prepare($query);

if (!$stmt) {
    die("❌ Erreur préparation : " . $con->error);
}

$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("❌ Erreur exécution : " . $stmt->error);
}

$stmt->bind_result($image);
if (!$stmt->fetch()) {
    $stmt->close();
    die("❌ Aucun produit trouvé avec l’ID $id");
}
$stmt->close();

// 🔹 Étape 2 : Supprimer le fichier image (si existe)
if (!empty($image) && file_exists($image)) {
    unlink($image);
}

// 🔹 Étape 3 : Supprimer le produit dans la table `produits`
$deleteQuery = "DELETE FROM produits WHERE id = ?";
$stmt = $con->prepare($deleteQuery);

if (!$stmt) {
    die("❌ Erreur préparation suppression : " . $con->error);
}

$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("❌ Erreur lors de la suppression du produit : " . $stmt->error);
}
$stmt->close();

// 🔹 Étape 4 : Supprimer aussi dans la table `images` si liené au code_produit
// (facultatif si tu veux synchroniser la table images)
$imgDelete = $con->prepare("DELETE FROM images WHERE nom = ?");
if ($imgDelete) {
    $imgDelete->bind_param("s", $image);
    $imgDelete->execute();
    $imgDelete->close();
}

// 🔹 Étape 5 : Message de succès
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression réussie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="alert alert-success text-center shadow-sm p-4">
        <h4 class="alert-heading">✅ Produit supprimé avec succès</h4>
        <p class="mt-3">Le produit ainsi que son image ont bien été supprimés.</p>
        <hr>
        <a href="liste_produits.php" class="btn btn-primary mt-2">⬅️ Retour à la liste des produits</a>
    </div>
</div>

</body>
</html>
