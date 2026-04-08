<?php 
session_start();
include('config/app.php');

// Récupérer le dernier code produit existant
$query_last_code = "SELECT MAX(code_produit) AS last_code FROM produits";
$result_last_code = mysqli_query($con, $query_last_code);
$row_last_code = mysqli_fetch_assoc($result_last_code);

// Calculer le prochain code produit
$next_code_produit = $row_last_code['last_code'] ? $row_last_code['last_code'] + 1 : 409;


// Récupérer les catégories
$query_categories = "SELECT * FROM categories"; // Ajuste le nom de ta table des catégories
$result_categories = mysqli_query($con, $query_categories);

// Récupérer les types
$query_types = "SELECT * FROM type_produits"; // Ajuste le nom de ta table des types
$result_types = mysqli_query($con, $query_types);
?>

<head>
    <?php include('layouts/head.php'); ?>
    <title>Ajout de Produit</title>
    <style>
        .form-section {
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .form-control {
            height: 50px; /* Augmente la hauteur des champs */
            font-size: 16px;
        }

        textarea.form-control {
            height: 120px; /* Ajuste la hauteur du champ description */
        }

        .btn-success {
            width: 100%;
            font-size: 18px;
            padding: 12px; 
        }
    </style>
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
                            <h1 class="page-title text-center">Ajouter un Produit</h1>
                        </div>

               
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="contents/process_ajout_produit.php" method="POST" enctype="multipart/form-data">
                                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                                <?= $_SESSION['message']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php 
                                unset($_SESSION['message'], $_SESSION['message_type']); // Supprime le message après affichage
                            ?>
                        <?php endif; ?>
    
                                        <div class="row">
                                                <!-- SECTION 1 : Informations Générales -->
                                                <div class="col-md-6 form-section">
                                                    <div class="form-title">Informations Générales</div>

                                                    <div class="mb-3">
                                                        <label for="nom_produit" class="form-label">Nom du produit :</label>
                                                        <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="code_produit" class="form-label">Code produit :</label>
                                                        <input type="text" class="form-control" id="code_produit" name="code_produit" value="<?= $next_code_produit ; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="reference" class="form-label">Référence :</label>
                                                        <input type="text" class="form-control" id="reference" name="reference" required>
                                                    </div>
                                                </div>

                                                <!-- SECTION 2 : Catégorie & Type -->
                                                <div class="col-md-6 form-section">
                                                    <div class="form-title">Catégorie & Type</div>

                                                    <div class="mb-3">
                                                        <label for="code_categorie" class="form-label">Catégorie :</label>
                                                        <select class="form-control" id="code_categorie" name="code_categorie" required>
                                                            <option value="">Sélectionner une catégorie</option>
                                                            <?php while ($row = mysqli_fetch_assoc($result_categories)) { ?>
                                                                <option value="<?= $row['code_cat']; ?>"><?= $row['type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="code_type" class="form-label">Type de filtres :</label>
                                                        <select class="form-control" id="code_type" name="code_type" required>
                                                            <option value="">Sélectionner un type</option>
                                                            <?php while ($row = mysqli_fetch_assoc($result_types)) { ?>
                                                                <option value="<?= $row['code_type']; ?>"><?= $row['type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- SECTION 3 : Prix, Stock & Image -->
                                                <div class="col-md-6 form-section">
                                                    <div class="form-title">Prix, Stock & Image</div>

                                                    <div class="mb-3">
                                                        <label for="prix" class="form-label">Prix :</label>
                                                        <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="stock" class="form-label">Stock disponible :</label>
                                                        <input type="number" class="form-control" id="stock" name="stock" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Image :</label>
                                                        <input class="form-control" type="file" id="image" name="image">
                                                    </div>
                                                </div>

                                                <!-- SECTION 4 : Description -->
                                                <div class="col-md-6 form-section">
                                                    <div class="form-title">Description</div>

                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description détaillée :</label>
                                                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="caracteristique" class="form-label">Caractéristique :</label>
                                                        <textarea class="form-control" id="caracteristique" name="caracteristique" ></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- BOUTON DE VALIDATION -->
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-success">Ajouter le produit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include('layouts/rightbar.php'); ?>
        <?php include('layouts/footer.php'); ?>
    </div>

    <?php include('libs/js-dashboard.php'); ?>

    <script src="../assets/js/formelementadvnced.js"></script>
    <script src="../assets/js/form-elements.js"></script>
    <script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="../assets/plugins/fileuploads/js/file-upload.js"></script>

    
</body>
</html>
