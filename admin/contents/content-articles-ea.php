<?php
require_once(__DIR__ . '/../config/app.php');

// Connexion à la base de données

// Vérifie la connexion à la base
if (!isset($pdo)) {
    die("Erreur : connexion à la base de données non établie.");
}

// Ajout d'un article
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_article'])) {
    $titre = $_POST['titre'];
    $id_categorie = $_POST['id_categorie'];
    $contenu = $_POST['contenu'];
    $statut = 0; // 0 = en attente

    // Gestion de l'image
    if (!empty($_FILES['image']['name'])) {
        $image_name = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_name);
    } else {
        $image_name = "default.jpg";
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO articles (titre, id_categorie, contenu, image, statut) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $id_categorie, $contenu, $image_name, $statut]);
        $_SESSION['message'] = "Article ajouté avec succès !";
        $_SESSION['successMsg'] = true;
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
        $_SESSION['successMsg'] = false;
    }
}

// Récupération des publications en attente
try {
    $stmtPublications = $pdo->query("
        SELECT a.*, c.categorie, u.prenom, u.nom
        FROM articles a
        LEFT JOIN categories c ON c.id_categorie = a.id_categorie
        LEFT JOIN users u ON u.id = a.id_auteur
        WHERE a.statut = '0'
        ORDER BY a.id_article DESC
    ");
    $publications = $stmtPublications->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Ajouter un article</h1>
            </div>

            <!-- Formulaire d'ajout d'article -->
            <div class="row">
                <div class="container-fluid">
                    <?php if (!empty($_SESSION['message'])) { ?>
                        <div class="alert alert-<?php echo $_SESSION['successMsg'] ? 'success' : 'danger'; ?>">
                            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                        </div>
                    <?php } ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_categorie" class="form-label">Catégorie</label>
                            <select class="form-control" name="id_categorie" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php
                                $categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $cat) {
                                    echo "<option value='{$cat['id_categorie']}'>{$cat['categorie']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Contenu</label>
                            <textarea class="form-control" name="contenu" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <button type="submit" name="ajouter_article" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>

            <!-- Liste des articles en attente -->
            <div class="row mt-5">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des publications en attente</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Titre</th>
                                            <th>Contenu</th>
                                            <th>Auteur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($publications) > 0) {
                                            foreach ($publications as $row) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?php echo htmlspecialchars($row['image']); ?>" style="width:100px;" class="img-fluid">
                                                    </td>
                                                    <td><?php echo htmlspecialchars(substr($row['titre'], 0, 25)) . '...'; ?></td>
                                                    <td><?php echo htmlspecialchars(substr($row['contenu'], 0, 60)) . '...'; ?></td>
                                                    <td><?php echo htmlspecialchars($row['prenom'] . ' ' . $row['nom']); ?></td>
                                                </tr>
                                        <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune publication en attente.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- FIN CONTAINER -->
                </div>
            </div>
        </div>
    </div>
</div>
