<!DOCTYPE html>
<html>
<head>
	<?php include ("layouts/head.php"); ?>
	<title> panier </title>
    
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
	<?php include('layouts/header.php'); ?>
    
    <!-- End Main Header -->

    <!-- Section Panier -->
    <section class="cart-section py-5">
        <div class="auto-container text-center">
            <!-- Message de succès -->
            <div class="alert alert-success" role="alert">
                <h2 class="text-success">Votre commande a été enregistrée avec succès !</h2>
                <p class="lead">Merci pour votre achat sur notre plateforme.</p>
            </div>

            <!-- Informations supplémentaires -->

            <!-- Bouton Retour à l'accueil -->
            <!-- <a href="index.php" class="btn btn-info text-white mt-4 px-5">Retour à l'accueil</a> -->

            <div class="btn-box">
							<a href="index.php" class="theme-btn btn-style-four"><span class="txt">Retour à l'accueil</span></a>
			</div>
        </div>
    </section>

	<!-- End Newsletter Section -->
	<!-- Main Footer -->
	<?php include('layouts/footer.php'); ?>
	<!-- End Main Footer -->
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>

<!-- Sidebar Cart Item -->
<div class="xs-sidebar-group cart-group login-group">
	<div class="xs-overlay xs-bg-black"></div>
	<div class="xs-sidebar-widget">
		<div class="sidebar-widget-container">
			<div class="widget-heading">
				<a href="#" class="close-side-widget">
					X
				</a>
			</div>
			<div class="sidebar-textwidget">
				<h3>Login Here</h3>
				<!-- Newsletter Form -->
				<div class="newsletter-form">
					<form method="post" action="controller/saveCart.php">
                        <div class="row clearfix">
                            <!--Column-->
                            <div class="column col-md-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h2>Détails de facturation</h2>
                                </div>
                                <div class="row clearfix">
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Prenom <sup class="text-danger">*</sup></div>
                                        <input type="text" name="prenom" value="" placeholder="Votre prénom" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Nom <sup class="text-danger">*</sup></div>
                                        <input type="text" name="nom" value="" placeholder="Votre nom" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Adresse <sup class="text-danger">*</sup></div>
                                        <input type="text" name="adresse" value="" placeholder="Votre adresse" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Email</div>
                                        <input type="email" name="email" value="" placeholder="Votre email">
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Téléphone <sup class="text-danger">*</sup></div>
                                        <input type="tel" name="telephone" value="" placeholder="Votre téléphone" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Paiement <sup class="text-danger">*</sup></div>
                                        <select name="paiement" required>
                                            <option value="livraison">À la livraison</option>
                                        </select>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-12 mt-">
                                        <input type="submit" class="form-control bg-success text-white" value="Commandez">
                                    </div>
                                </div>
                            </div>
                        </div>
</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END sidebar widget item -->

<!-- Sidebar Cart Item -->
<div class="xs-sidebar-group info-group">
	<div class="xs-overlay xs-bg-black"></div>
	<div class="xs-sidebar-widget">
		<div class="sidebar-widget-container">
			<!-- <div class="widget-heading">
				<a href="#" class="close-side-widget">
					X
				</a>
			</div> -->
			<div class="sidebar-textwidget">

				<!-- Sidebar Info Content -->
				<!-- : -->

			</div>
		</div>
	</div>
</div>
<!-- END sidebar widget item -->

<!-- Color Palate / Color Switcher -->
<div class="color-palate">
    <div class="color-trigger">
        <i class="fa fa-gear"></i>
    </div>
    <div class="color-palate-head">
        <h6>Choose Your Color</h6>
    </div>
    <div class="various-color clearfix">
        <div class="colors-list">
            <span class="palate default-color active" data-theme-file="css/color-themes/default-theme.css"></span>
            <span class="palate green-color" data-theme-file="css/color-themes/green-theme.css"></span>
            <span class="palate olive-color" data-theme-file="css/color-themes/olive-theme.css"></span>
            <span class="palate orange-color" data-theme-file="css/color-themes/orange-theme.css"></span>
            <span class="palate purple-color" data-theme-file="css/color-themes/purple-theme.css"></span>
            <span class="palate teal-color" data-theme-file="css/color-themes/teal-theme.css"></span>
            <span class="palate brown-color" data-theme-file="css/color-themes/brown-theme.css"></span>
            <span class="palate redd-color" data-theme-file="css/color-themes/redd-color.css"></span>
        </div>
    </div>

	<ul class="box-version option-box"> <li class="box">Boxed</li> <li>Full width</li></ul>
	<ul class="rtl-version option-box"> <li class="rtl">RTL Version</li> <li>LTR Version</li> </ul>

    <a href="#" class="purchase-btn">Purchase now $17</a>

    <div class="palate-foo">
        <span>You will find much more options for colors and styling in admin panel. This color picker is used only for demonstation purposes.</span>
    </div>

</div>
    <?php include('shared/scripts.php'); ?>
</body>
</html>
