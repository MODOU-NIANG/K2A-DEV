<?php

if (isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $reqListePublications = $con->query("SELECT *
                            FROM `articles`
                            LEFT JOIN categories ON categories.id_categorie = articles.id_categorie
                            LEFT JOIN users ON users.id= articles.id_auteur
                            WHERE articles.statut = '0'
                            AND articles.id_article != 123
                            ORDER BY articles.id_article DESC;
");
    $reqPublication = $con->query("SELECT *  FROM `articles` 
                                INNER JOIN categories ON categories.id_categorie=articles.id_categorie 
                                INNER JOIN users ON users.id=articles.id_auteur
                                 WHERE articles.id_article='$id_article' and articles.statut=0");



    $titre = "Titre non disponible";
    $categorie = "Catégorie non disponible";
    $id_categorie = "id_categorie non disponible";
    $contenu = "Contenu non disponible";
    $image = "default.jpg";
    $email_auteur = "Email non disponible";
    $auteur = "Auteur inconnu";
    $date_creation = "Date non disponible";

    if (!$reqPublication) {
        die("Erreur SQL : " . $con->error);
    }

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
        }  // Fermeture de la boucle while
    } else {
        echo "Aucun article trouvé.";
    }  // Fermeture de la condition if


}
?>



<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Article en attente de publication</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">En attente</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <?php if (isset($_GET['id_article'])) { ?>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <img class="card-img-top " src="<?php echo  $image; ?>" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                                        <i class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                            <?php
                                            // Vérifier si $date_creation est définie et non vide
                                            if (isset($date_creation) && !empty($date_creation)) {
                                                // Formater la date avec strtotime et date
                                                echo date('d/m/Y', strtotime($date_creation));
                                            } else {
                                                // Valeur par défaut si la date est vide ou non définie
                                                echo '01/01/1970';
                                            }
                                            ?>
                                        </div>
                                    </a>
                                </div>


                                </a>
                                <a href="profile.html" class="d-flex mb-2">
                                    <i class="fe fe-user fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                                    <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                        <?php echo isset($auteur) ? $auteur : 'Auteur inconnu'; ?>
                                    </div>
                                </a>

                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="d-flex mb-2"><i class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">0 commentaire(s)</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3><a href="javascript:void(0)"><?php echo $titre; ?></a></h3>
                            <p class="card-text"><?php echo $contenu; ?></p>
                        </div>
                        <div class="card-body">
                            <div class="text-wrap">
                                <div class="example">
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-warning-light mb-1" href="nouvelle_publication?edit=<?php echo $id_article; ?>"><strong style="font-size:18px; color:black"><i class="fe fe-edit fs-16"></i> Modifier l'article</strong></a>
                                        <a class="btn btn-danger-light mb-1" href="nouvelle_publication?delete=<?php echo $id_article; ?>"><strong style="font-size:18px; color:brown"><i class="fe fe-trash fs-18"></i> Supprimer l'article</strong></a>
                                        <a class="btn btn-success-light mb-1" href="controllers/publicationController?publier=<?php echo $id_article; ?>"><strong style="font-size:18px; color:black"><i class="fe fe-play fs-18"></i> Publier l'article</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Publications en attentes</div>
                        </div>

                        <div class="card-body">
                            <div class="">
                                <?php while ($row = mysqli_fetch_array($reqListePublications)) { ?>
                                    <div class="d-flex overflow-visible">
                                        <a href="publication_ea?id_article=<?php echo $row['id_article']; ?>" class="card-aside-column br-5 cover-image" data-bs-image-src="<?php echo $row['image']; ?>" style="background: url(&quot;<?php echo $row['image']; ?>&quot;) center top;"></a>
                                        <div class="ps-3 flex-column">
                                            <h4><a href="publication_ea?id_article=<?php echo $row['id_article']; ?>"><?php echo $row["titre"]; ?></a></h4>
                                            <div class="text-muted"><?php echo substr($row["contenu"], 0, 40) . '...'; ?></div>
                                        </div>
                                    </div>
                                    </br>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>


        </div>
    </div>
</div>
</div>
</div>
<?php } ?>
<!--/Sidebar-right-->


<div class="modal  fade" id="smallmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm"
        style="
        top:50%; left: 50% ; transform: translate(-50%, -50%); position: absolute;
"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center;">Attention</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer l'article ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-danger-light" onclick="deleteArticle()">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let currentArticleLink = ""
    document
        .querySelector("#delete-article-button")
        .addEventListener('click', (e) => {
            currentArticleLink = e.currentTarget.getAttribute("href");
            console.log(e.currentTarget.getAttribute("href"))
            $("#smallmodal").modal("show")
            e.preventDefault()
        })

    function deleteArticle() {
        window.location.href = currentArticleLink;
    }
</script>