<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config/app.php'); // doit définir $con (connexion MySQLi)

// Vérifier que l'ID est bien transmis
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("⚠️ ID du produit invalide !");
}

$id = intval($_GET['id']);

// Préparer la requête pour récupérer le produit
$query = "SELECT id, nom_produit, code_produit, code_categorie, image FROM produits WHERE id = ?";
$stmt = $con->prepare($query);

if (!$stmt) {
    die("❌ Erreur préparation requête : " . $con->error);
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("❌ Erreur exécution requête : " . $stmt->error);
}

// On récupère le résultat avec bind_result (compatible partout)
$stmt->bind_result($pid, $nom_produit, $code_produit, $categorie, $image);

if ($stmt->fetch()) {
    $produit = [
        'id' => $pid,
        'nom' => $nom_produit,
        'code_produit' => $code_produit,
        'categorie' => $categorie,
        'image' => $image
    ];
} else {
    die("❌ Aucun produit trouvé pour l’ID $id");
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation suppression produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-danger text-white text-center">
            <h3>🗑️ Supprimer le produit</h3>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-3">Voulez-vous vraiment supprimer ce produit ?</h4>

            <div class="mb-3">
                <?php if (!empty($produit['image'])): ?>
                    <img src="<?php echo htmlspecialchars($produit['image']); ?>" 
                         alt="Image du produit" width="200" class="img-thumbnail mb-3">
                <?php else: ?>
                    <p><em>Aucune image disponible</em></p>
                <?php endif; ?>
            </div>

            <h5><?php echo htmlspecialchars($produit['nom']); ?></h5>
            <p>Référence : <strong><?php echo htmlspecialchars($produit['code_produit']); ?></strong></p>
            <p>Catégorie : <strong><?php echo htmlspecialchars($produit['categorie']); ?></strong></p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <!-- Bouton confirmer -->
                <a href="../supprimer_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-danger px-4">
                    Oui, supprimer
                </a>

                <!-- Bouton annuler -->
                <a href="../supprimer_produit.php?id=<?php echo $produit['id']; ?> " class="btn btn-secondary px-4">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
