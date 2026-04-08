<?php include('config/app.php'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<?php include('layouts/head.php'); ?>

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
        </div>
        <!--The content here !!! -->
        <?php include('contents/content-users.php') ?>
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