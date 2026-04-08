<?php 
include('config/app.php'); 
session_start(); 

if (!isset($_GET['id'])) {
    die("ID produit manquant.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM produits WHERE id = $id";
$result = mysqli_query($con, $query);
$produit = mysqli_fetch_assoc($result);

if (!$produit) {
    die("Produit non trouvé.");
}

// Récupération des catégories et types
$categoriesList = [];
$categories = mysqli_query($con, "SELECT * FROM categories");
while ($row = mysqli_fetch_assoc($categories)) {
    $categoriesList[] = $row;
}

$typesList = [];
$types = mysqli_query($con, "SELECT * FROM type_produits");
while ($row = mysqli_fetch_assoc($types)) {
    $typesList[] = $row;
}

include('layouts/head.php'); 
?>
<body class="app sidebar-mini ltr light-mode">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- app-Header -->
            <?php include('layouts/header.php'); ?>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <?php include('layouts/sidebar.php'); ?>
            <!--/APP-SIDEBAR-->

            <!-- CONTENU PRINCIPAL -->
            <div class="app-content main-content mt-5 pt-3">
                <div class="side-app">
                    <div class="container-fluid">
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Modifier le produit</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="contents/update_produit.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $produit['id']; ?>">

                                            <div class="row">
                                                <!-- Partie gauche -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nom</label>
                                                        <input type="text" name="nom_produit" class="form-control" value="<?= htmlspecialchars($produit['nom_produit']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Code produit</label>
                                                        <input type="text" name="code_produit" class="form-control" value="<?= $produit['code_produit']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Référence</label>
                                                        <input type="text" name="reference" class="form-control" value="<?= htmlspecialchars($produit['reference']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Prix</label>
                                                        <input type="number" name="prix" class="form-control" value="<?= $produit['prix']; ?>" step="0.01" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Stock</label>
                                                        <input type="number" name="stock" class="form-control" value="<?= $produit['stock']; ?>" required>
                                                    </div>
                                                </div>

                                                <!-- Partie droite -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($produit['description']); ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Caractéristique</label>
                                                        <textarea name="caracteristique" class="form-control" rows="3"><?= htmlspecialchars($produit['caracteristique']); ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Catégorie</label>
                                                        <select name="code_categorie" class="form-select" required>
                                                            <?php foreach ($categoriesList as $cat) : ?>
                                                                <option value="<?= $cat['code_cat']; ?>" <?= ($cat['code_cat'] == $produit['code_categorie']) ? 'selected' : '' ?>>
                                                                    <?= $cat['type']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select name="code_type" class="form-select" required>
                                                            <?php foreach ($typesList as $type) : ?>
                                                                <option value="<?= $type['code_type']; ?>" <?= ($type['code_type'] == $produit['code_type']) ? 'selected' : '' ?>>
                                                                    <?= $type['type']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label><br>
                                                        <?php if ($produit['image']) : ?>
                                                            <img src="uploads/<?= $produit['image']; ?>" width="100" class="mb-2"><br>
                                                        <?php endif; ?>
                                                        <input type="file" name="image" class="form-control">
                                                        <small class="text-muted">Laisser vide pour conserver l'actuelle</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-success">💾 Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /CONTENU PRINCIPAL -->
        </div>
        <!-- /page-main -->

        <!-- Sidebar-right -->
        <?php include('layouts/rightbar.php'); ?>
        <!--/Sidebar-right-->

        <!-- FOOTER -->
        <?php include('layouts/footer.php'); ?>
        <!-- FOOTER END -->
    </div>
    <!-- /page -->
    <?php include('libs/js-dashboard.php'); ?>
</body>
</html>
