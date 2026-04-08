<?php include ('config/app.php'); ?>
<?php include ('layouts/head.php'); ?>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->

    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
          <?php include ('layouts/header.php'); ?>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
           <?php include ('layouts/sidebar.php');?>
            <!--/APP-SIDEBAR-->
         </div>
            <!--The content here !!! -->
           <?php  include ('contents/content-publication_el2.php') ?>
            <!--app-content close-->
    </div>

        <!-- Sidebar-right -->
        <?php include ('layouts/rightbar.php'); ?>
        <!--/Sidebar-right-->

        <!-- FOOTER -->
        <?php include ('layouts/footer.php'); ?>

        <!-- FOOTER END -->

    </div>

<?php include ('libs/js-dashboard.php'); ?>

    <!-- FORMELEMENTS JS -->
    <script src="./assets/js/formelementadvnced.js"></script>
    <script src="./assets/js/form-elements.js"></script>
    <script src="./assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="./assets/plugins/fileuploads/js/file-upload.js"></script>


</body>

</html>