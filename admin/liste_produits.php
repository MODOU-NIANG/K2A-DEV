<?php
session_start();
include('config/app.php'); // contient $con

include('layouts/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include('layouts/head.php'); ?>
    <title>Liste des Produits</title>
</head>
<body class="app sidebar-mini ltr light-mode">
<div class="page">
    <div class="page-main">
        <?php include('layouts/header.php'); ?>
        <?php include('layouts/sidebar.php'); ?>

        <div class="main-content app-content mt-0">
            <div class="side-app">
                <div class="main-container container-fluid">
                    <div class="page-header">
                        <h2 class="text-center mb-1">Liste des Produits</h2>
                    </div>

                    <!-- Formulaire de recherche -->
                    <form method="GET" class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, code ou référence" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                        </div>
                    </form>

                    <!-- Message de session -->
                    <?php if (isset($_SESSION['message_sup'])): ?>
                        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message_sup']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['message_sup'], $_SESSION['message_type']); ?>
                    <?php endif; ?>

                    <?php
                    $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
                    $query = "SELECT * FROM produits";
                    if (!empty($search)) {
                        $query .= " WHERE nom_produit LIKE '%$search%' 
                                    OR code_produit LIKE '%$search%' 
                                    OR reference LIKE '%$search%'";
                    }
                    $result = mysqli_query($con, $query);
                    ?>

                    <table class="table table-bordered table-hover">
                        <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Code</th>
                            <th>Référence</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= htmlspecialchars($row['nom_produit']); ?></td>
                                    <td><?= $row['code_produit']; ?></td>
                                    <td><?= htmlspecialchars($row['reference']); ?></td>
                                    <td><?= $row['prix']; ?> F CFA</td>
                                    <td><?= $row['stock']; ?></td>
                                    <td>
                                        <?php if (!empty($row['image'])): ?>
                                            <img src="admin/uploads/<?= $row['image']; ?>" alt="Image du produit" width="80">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="modifier_produit.php?id=<?= $row['id']; ?>" class="text-warning me-2" title="Modifier">
                                            <span class="bi bi-pencil-square"></span>
                                        </a>
                                        <a href="contents/delete_produit.php?id=<?= $row['id']; ?>" class="text-danger" title="🗑️ Supprimer">
                                            <span class="bi bi-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Aucun produit trouvé.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <?php include('layouts/rightbar.php'); ?>
    <?php include('layouts/footer.php'); ?>
</div>

<?php include('libs/js-dashboard.php'); ?>
</body>
</html>
