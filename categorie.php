 <?php
// categories.php

// include 'config.php'; // Connexion à la base de données

// include 'categories.php'; // Inclure le fichier des catégories
$categories = getCategoriesCount($conn);

function getCategoriesCount($conn) {
    $categories = [];
    
    // Récupérer toutes les catégories de la base de données
    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $code_cat = $row['code_cat'];
            $type = $row['type'];

            // Compter les produits pour chaque catégorie
            $queryCount = "SELECT COUNT(*) as count FROM produits WHERE code_categorie = $code_cat";
            $resultCount = $conn->query($queryCount);
            $count = $resultCount ? $resultCount->fetch_assoc()['count'] : 0;

            $categories[$type] = $count;
        }
    }

    return $categories;
}

?>
 
 <div class="sidebar-widget categories-widget">
    <div class="sidebar-title">
        <h2>Catégories</h2>
        <div class="seperater"></div>
    </div>
    <div class="widget-content">
        <ul class="blog-cat">
            <?php foreach ($categories as $nomCategorie => $nombreProduits) : ?>
                <li><a href="#"><?= $nomCategorie ?> <span><?= $nombreProduits ?></span></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

 
