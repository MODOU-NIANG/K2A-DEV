    <?php
    if (isset($_GET['id_article'])) {
        $id_article = $_GET['id_article'];

        // Requête pour l'article spécifique
        $reqPublication = $con->query("SELECT * FROM `articles`
            INNER JOIN categories ON categories.id_categorie = articles.id_categorie
            INNER JOIN users ON users.id= articles.id_auteur
            WHERE articles.id_article = '$id_article' AND articles.statut = 1");

        if (!$reqPublication) {
            die("Erreur SQL : " . $con->error);
        }

        // Initialisation des variables par défaut
        $titre = $contenu = $date_creation = $auteur = $image = 'Données non disponibles';

        if ($reqPublication->num_rows > 0) {
            while ($row = $reqPublication->fetch_array()) {
                $titre = $row['titre'];
                $categorie = $row['categorie'];
                $id_categorie = $row['id_categorie'];
                $contenu = $row['contenu'];
                $image = $row['image'];
                $email_auteur = $row['email'];
                $auteur = $row['prenom'] . ' ' . $row['nom'];
                $date_creation = $row['date_creation'];
            }
        } else {
            echo "Aucun article trouvé.";
        }

        // Requête pour les autres publications
        $reqListePublications = $con->query("SELECT * FROM `articles`
                                                INNER JOIN categories ON categories.id_categorie = articles.id_categorie
                                                INNER JOIN users ON users.id= articles.id_auteur
                                                WHERE articles.statut = '1' AND articles.id_article != $id_article
                                                ORDER BY articles.id_article DESC LIMIT 5");

        if (!$reqListePublications) {
            die("Erreur SQL : " . $con->error);
        }
    }
    ?>

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <h1 class="page-title">Articles en Ligne</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                            <li class="breadcrumb-item active" aria-current="page">En ligne</li>
                        </ol>
                    </div>
                </div>

                <?php if (isset($_GET['id_article'])) { ?>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <img class="card-img-top" src="<?php echo $image; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="d-md-flex">
                                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                                            <i class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                                            <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                                <?php echo date('d/m/Y', strtotime($date_creation)); ?>
                                            </div>
                                        </a>
                                        <a href="profile.html" class="d-flex mb-2">
                                            <i class="fe fe-user fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                                            <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                                <?php echo $auteur; ?>
                                            </div>
                                        </a>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0);" class="d-flex mb-2">
                                                <i class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                                <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                                    0 commentaire(s)
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3><a href="javascript:void(0)"><?php echo $titre; ?></a></h3>
                                    <p class="card-text"><?php echo $contenu; ?></p>
                                </div>
                                <div class="card-footer mt-5 ">
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-danger-light mb-1 " href="controllers/publicationController?retirer=<?php echo $id_article; ?>"><strong style="font-size:18px; color:black"><i class="fe fe-trash "></i> Retirer l'article</strong></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Publications en ligne</div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <?php while ($row = mysqli_fetch_array($reqListePublications)) { ?>
                                            <div class="d-flex overflow-visible">
                                                <a href="publication_el?id_article=<?php echo $row['id_article']; ?>"
                                                    class="card-aside-column br-5 cover-image"
                                                    data-bs-image-src="<?php echo $row['image']; ?>"
                                                    style="background: url('<?php echo $row['image']; ?>') center top;"></a>
                                                <div class="ps-3 flex-column">
                                                    <h4>
                                                        <a href="publication_el?id_article=<?php echo $row['id_article']; ?>">
                                                            <?php echo $row["titre"]; ?>
                                                        </a>
                                                    </h4>
                                                    <div class="text-muted">
                                                        <?php echo substr($row["contenu"], 0, 40) . '...'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            </br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!--app-content closed-->
    </div>
    <?php } ?>