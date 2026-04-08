
<?php
// $auteur=$_SESSION ['email'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/app.php';


$reqCategorie = $con->query("SELECT * FROM categories");


$reqPublications_ea = mysqli_query($con, "SELECT 
    articles.id_article,
    articles.titre,
    articles.resume,
    articles.date_publication,
    articles.date_creation,
    users.prenom,
    users.nom,
    articles.contenu,
    articles.image,
    users.email,
    categories.categorie,
    categories.couleur
    FROM `articles` 
    LEFT JOIN categories ON categories.id_categorie = articles.id_categorie
    LEFT JOIN users ON users.id= articles.id_auteur
    WHERE articles.statut = 0;
");

$update = 0;
if (isset($_GET['edit'])) {
    // include 'config/req.php';
    $update = 1;
    $id_article = $_GET['edit'];
    $reqEdit = $con->query("SELECT 
    articles.id_article,
    articles.id_categorie,
    articles.titre,
    articles.resume,
    articles.date_publication,
    articles.date_creation,
    users.id as id_auteur,
    users.prenom,
    users.nom,
    users.email,
    articles.contenu,
    articles.image,
    categories.categorie,
    categories.couleur
    FROM `articles` 
    LEFT JOIN categories ON categories.id_categorie = articles.id_categorie
    LEFT JOIN users ON users.id= articles.id_auteur
    WHERE articles.id_article='$id_article'");

    while ($row = mysqli_fetch_array($reqEdit)) {
        $titre = $row['titre'];
        $id_categorie = $row['id_categorie'];
        $categorie = $row['categorie'];
        $contenu = $row['contenu'];
        $image = $row['image'];
        $id_auteur = $row['id_auteur'];
        $auteur = $row['prenom'] . ' ' . $row['nom'];
        $date_creation = $row['date_creation'];
    }
}

if (isset($_GET['delete'])) {
    $update = 2;
    $id_article = $_GET['delete'];
    $reqEdit = $con->query("SELECT 
    articles.id_article,
    articles.id_categorie,
    articles.titre,
    articles.resume,
    articles.date_publication,
    articles.date_creation,
    users.prenom,
    users.nom,
    users.email,
    articles.contenu,
    articles.image,
    categories.categorie,
    categories.couleur
    FROM `articles` 
    LEFT JOIN categories ON categories.id_categorie = articles.id_categorie
    LEFT JOIN users ON users.id= articles.id_auteur
    WHERE articles.id_article='$id_article'");

    while ($row = mysqli_fetch_array($reqEdit)) {
        $titre = $row['titre'];
        $id_categorie = $row['id_categorie'];
        $categorie = $row['categorie'];
        $contenu = $row['contenu'];
        $image = $row['image'];
        $id_auteur = $row['email'];
        $auteur = $row['prenom'] . ' ' . $row['nom'];
        $date_creation = $row['date_creation'];
    }
}

?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Publications</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Publication</a></li>
                        
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Contenu principal -->
            <div class="row">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['message']) && $_SESSION['successMsg']) { ?>

                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>

                    <?php } ?>

                    <!-- Error Message -->
                    <?php if (isset($_SESSION['message']) && $_SESSION['errorMsg']) { ?>

                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>

                    <?php } ?>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nouvelle publication</h3>
                        </div>
                        <div class="card-body">
                            <form action="controllers/publicationController.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname">Categorie</label>
                                            <?php if ($update == 1) { ?>
                                                <select class="form-control select2 form-select" name="categorie" required>
                                                    <option value="<?php echo $id_categorie; ?>"><?php echo ($categorie); ?></option>
                                                    <?php while ($row = mysqli_fetch_array($reqCategorie)) {
                                                        if ($row['id_categorie'] != $id_categorie) { ?>
                                                            <option value="<?php echo $row['id_categorie']; ?>"><?php echo $row['categorie']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            <?php }
                                            if ($update == 0) { ?>
                                                <select class="form-control" name="categorie" required>
                                                    <option>Categorie</option>
                                                    <?php while ($row = mysqli_fetch_array($reqCategorie)) { ?>
                                                        <option value="<?php echo $row['id_categorie']; ?>"><?php echo $row['categorie']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($update == 2) { ?>
                                                    <input type="text" class="form-control" id="exampleInputname1" value="<?php echo 'Categorie ' . $categorie; ?>" disabled>
                                                    <input type="hidden" name="id_article" value="<?php echo $id_article; ?>">

                                                <?php } ?>

                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname1">Titre</label>
                                            <?php if ($update == 1) { ?>
                                                <input type="text" class="form-control" name="titre" id="exampleInputname1" value="<?php echo $titre; ?>" required>


                                            <?php }
                                            if ($update == 0) {  ?>
                                                <input type="text" class="form-control" name="titre" id="exampleInputname1" placeholder="Saisir le titre" required>

                                            <?php } ?>
                                            <?php if ($update == 2) {  ?>
                                                <input type="text" class="form-control" name="titre" id="exampleInputname1" value="<?php echo $titre; ?>" disabled>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Contenu</label>
                                    <?php if ($update == 1) { ?>
                                        <textarea class="form-control" rows="10" name="contenu" required><?php echo $contenu; ?></textarea>
                                    <?php }
                                    if ($update == 0) { ?>
                                        <textarea class="form-control" rows="10" name="contenu" required></textarea>
                                    <?php } ?>
                                    <?php if ($update == 2) { ?>
                                        <textarea class="form-control" rows="10" name="contenu" disabled><?php echo $contenu; ?></textarea>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <?php if ($update != 2) { ?><label class="form-label">Image</label> <?php } ?>
                                            <?php if ($update == 0) { ?>
                                                <input type="file" accept="image/*" name="image_publication" class="dropify" data-bs-default-file="../assets/images/media/1.jpg" data-bs-height="180" />
                                            <?php } ?>
                                            <?php if ($update == 1) { ?>
                                                <input type="file" accept="image/*" name="image_publication" id="dropify-file-update-image" value="<?php echo $image; ?>" class="dropify" data-bs-default-file="<?php echo $image; ?>" data-bs-height="180" />

                                                <script>
                                                    var imagenUrl = "../<?php echo $image; ?>";
                                                    var imageElement = document.getElementById('dropify-file-update-image');
                                                    // Add the 'dropify' class
                                                    imageElement.classList.add('dropify');
                                                    // Set data attributes
                                                    imageElement.setAttribute('data-height', '180');
                                                    imageElement.setAttribute('data-default-file', imagenUrl);

                                                    // Initialize Dropify (assuming the Dropify library is included and available)
                                                    if (typeof Dropify !== 'undefined') {
                                                        // Initialize Dropify on the element
                                                        var dropify = new Dropify(imageElement);

                                                    }
                                                </script>


                                                <input type="hidden" name="auteur" value="<?php echo $auteur; ?>">
                                                <input type="hidden" name="id_article" value="<?php echo $id_article; ?>">
                                                <input type="hidden" name="id_categorie" value="<?php echo $id_categorie; ?>">
                                                <input type="hidden" name="date_creation" value="<?php echo $date_creation; ?>">
                                                <input type="hidden" name="id_auteur" value="<?php echo $id_auteur; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="card-footer text-end">
                            <?php if ($update == 1) { ?>
                                <button type="submit" name="editPublication" class="btn btn-warning my-1"><strong>Modifier l'article</strong></button>
                            <?php }
                            if ($update == 0) { ?>
                                <button type="submit" name="addPublication" class="btn btn-success my-1"><strong>Ajouter l'article</strong></button>
                            <?php } ?>
                            <?php if ($update == 2) { ?>
                                <button type="submit" name="deletePublication" class="btn btn-danger my-1"><strong>Supprimer l'article</strong></button>
                            <?php } ?>
                            <button type="submit" name="cancel" class="btn btn-secondary my-1">Annuler</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des publications en attentes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                             <th>nom</th> 
                                            <th>Image</th>
                                            <th>Titre</th>
                                            <th>Auteur</th>
                                            <th>Redigé le</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($reqPublications_ea)) {
                                            $url_image = $row['image'];
                                            $id_article = $row['id_article'];
                                            $couleur = $row['couleur'];
                                            $resume = $row['resume'];
                                            $titre = $row['titre'];
                                            $auteur = $row['prenom'] . ' ' . $row['nom'];
                                            $date_crea = date('d-m-Y', strtotime($row['date_creation']));
                                        ?>
                                         
                                            <tr>
                                                <td style="vertical-align: middle">
                                                    <img src="<?php echo $url_image; ?>" style="width:200px;" class="img-fluid" alt="Introuvable">
                                                </td>
                                                <td style="vertical-align: middle"><?php echo $titre; ?></td>
                                                <!-- <td><?php //echo $resume.'...'; 
                                                            ?></td>  -->
                                                <td style="vertical-align: middle"><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
                                                <td style="vertical-align: middle"><?php echo $date_crea; ?></td>

                                                <td style="vertical-align: middle">
                                                    <div class=" d-flex g-2">
                                                        <a class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2" href="nouvelle_publication?edit=<?php echo $id_article; ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="bi bi-arrow-counterclockwise fs-16"></span></a>
                                                        <a class="btn text-danger bg-danger-transparent btn-icon py-1 me-2" href="nouvelle_publication?delete=<?php echo $id_article; ?>" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></a>
                                                        <a class="btn text-success bg-success-transparent btn-icon py-1 me-2" href="publication_ea?id_article=<?php echo $id_article; ?>" data-bs-toggle="tooltip" data-bs-original-title="Voir la publication"><span class="bi bi-eye fs-16"></span></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>

                <!-- End Row -->
            </div>
            <!-- Fin Contenu principal -->

        </div>
        <!-- CONTAINER END -->
    </div>
</div>