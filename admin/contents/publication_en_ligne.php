<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "oda");

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Requête SQL : utilise la table correcte
$reqPublications_el = mysqli_query($conn, "SELECT * FROM publications"); // ou `publication ams ea`

if (!$reqPublications_el) {
    die("Erreur SQL : " . mysqli_error($conn)); // Affiche l'erreur SQL exacte
}

// Traitement et affichage des résultats
while ($row = mysqli_fetch_array($reqPublications_el)) {
    echo "<h2>" . $row['titre'] . "</h2>"; // Change 'titre' si le nom est différent
    echo "<p>" . $row['contenu'] . "</p>"; // Change 'contenu' si le nom est différent
    echo "<small>Publié le : " . $row['date_publication'] . "</small><hr>";
}
?>

<?php include('config/app.php'); ?>
<?php include('layouts/head.php'); ?>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->

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
        </div>
        <!--The content here !!! -->
        <?php include('contents/content-publication-enligne.php') ?>
        <!--app-content close-->
    </div>

    <!-- Sidebar-right -->
    <?php include('layouts/rightbar.php'); ?>
    <!--/Sidebar-right-->

    <!-- FOOTER -->
    <?php include('layouts/footer.php'); ?>

    <!-- FOOTER END -->

    </div>

    <?php include('libs/js-dashboard.php'); ?>

    <!-- FORMELEMENTS JS -->
    <script src="../assets/js/formelementadvnced.js"></script>
    <script src="../assets/js/form-elements.js"></script>
    <script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="../assets/plugins/fileuploads/js/file-upload.js"></script>


</body>

</html>