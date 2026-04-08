<?php
include('config/app.php');

$stmt = $pdo->query("SELECT * FROM produits ORDER BY created_at DESC");

echo "<h2>Liste des produits</h2>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='produit'>";
    echo "<h3>" . htmlspecialchars($row['nom']) . " (Ref: " . htmlspecialchars($row['code']) . ")</h3>";
    echo "<p><strong>Catégorie :</strong> " . htmlspecialchars($row['categorie']) . "</p>";
    echo "<p><strong>Description :</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
    echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' width='200' alt='Image du produit'>";
    echo "<p><strong>Prix :</strong> " . number_format($row['prix'], 2, ',', ' ') . " €</p>";
    echo "<p><strong>Stock :</strong> " . intval($row['stock']) . " unités disponibles</p>";
    echo "<p><small>Ajouté le " . $row['created_at'] . "</small></p>";
    echo "</div><hr>";
}
?>

<a href="supprimer_produit.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?');">
    Supprimer
</a>
