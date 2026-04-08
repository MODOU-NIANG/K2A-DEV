<?php



$reqPublications_el = $con->query("SELECT * 
FROM `articles` 
INNER JOIN categories ON categories.id_categorie=articles.id_categorie 
INNER JOIN users ON users.id=articles.id_auteur
WHERE articles.statut='1'
ORDER BY articles.id_article DESC");

$update = 0;
if (isset($_GET['edit'])) {
    // include 'config/req.php';
    $update = 1;
    $id_article = $_GET['edit'];
    $reqEdit = $con->query("SELECT * FROM `publication_ea` INNER JOIN categories_article ON categories_article.id_categorie=publications_ea.id_categorie INNER JOIN auteurs_article on auteurs_article.email=publications_ea.id_auteur WHERE publications_ea.id_article='$id_article'");

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

if (isset($_GET['delete'])) {
    $update = 2;
    $id_article = $_GET['delete'];
    $reqEdit = $con->query("SELECT * FROM `publication_ea` INNER JOIN categories_article ON categories_article.id_categorie=publications_ea.id_categorie INNER JOIN auteurs_article on auteurs_article.email=publications_ea.id_auteur WHERE publications_ea.id_article='$id_article'");

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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">En ligne</li>
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


                    <div class="row">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des publications en ligne</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>Image</th>
                                                    <th>Titre</th>
                                                    <th>Contenu</th>
                                                    <th>Auteur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array(
                                                    $reqPublications_el
                                                )) { ?>

                                                    <tr>
                                                        <td>
                                                            <img src="<?php echo $row['image']; ?>" style="width:200px;" class="img-fluid" alt="Introuvable">
                                                        </td>
                                                        <td><?php echo substr($row['titre'], 0, 25) . '...'; ?></td>
                                                        <td><?php echo substr($row['contenu'], 0, 60) . '...'; ?></td>
                                                        <td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
                                                        <td>
                                                            <div class=" d-flex g-2">
                                                                <!-- <a class="btn text-secondary bg-secondary-transparent btn-icon py-1 me-2" href="nouvelle_publication.php?edit=<?php echo $row['id_article']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="bi bi-arrow-counterclockwise fs-16"></span></a>
                                            <a class="btn text-danger bg-danger-transparent btn-icon py-1 me-2" href="nouvelle_publication.php?delete=<?php echo $row['id_article']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></a> -->
                                                                <a class="btn text-success bg-success-transparent btn-icon py-1 me-2" href="publication_el?id_article=<?php echo $row['id_article']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Voir la publication"><span class="bi bi-eye fs-16"></span></a>

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