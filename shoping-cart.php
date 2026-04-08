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
	<?php include ('layouts/header.php'); ?>
    <!-- End Main Header -->
 

	<!--Cart Section-->
<!--    pqnier-->
    <section class="cart-section">
        <div class="auto-container">
            <!--Cart Outer-->
            <div class="cart-outer">
                <form method="post" action="controller/saveCart.php">
                    <div class="table-outer mb-4" id="custom-table-outer">
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th>aperçu</th>
                                    <th class="prod-column">produit</th>
                                    <th class="price">prix</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                                
                            </thead>

                            <tbody id="cart-table-item-list">
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-options clearfix">
                        <div class="pull-right">
                            <button type="button" class="theme-btn cart-btn btn-style-four"><span class="txt">MISE EN JOUR DU Cart</span></button>
                        </div>
                    </div>
                    <!--Checkout Details-->
                    <div class="checkout-form">
                 <!-- <form method="post" action="controller/saveCart.php">-->
                        <div class="row clearfix">
                            <!--Column-->
                            <div class="column col-md-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h2>informations de la livraison</h2>
                                </div>
                                <div class="row clearfix">
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Prenom <sup class="text-danger">*</sup></div>
                                        <input type="text" name="prenom" id="prenom" placeholder="" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Nom <sup class="text-danger">*</sup></div>
                                        <input type="text" name="nom" id="nom" value="" placeholder="" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Adresse <sup class="text-danger">*</sup></div>
                                        <input type="text" name="adresse" value="" placeholder="" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Email</div>
                                        <input type="text" name="email" value="" placeholder="" required>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">telephone <sup class="text-danger">*</sup></div>
                                        <input type="text" name="telephone" value="" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Paiement <sup class="text-danger">*</sup></div>
                                        <select name="paiement" required>
                                            <option value="LIVRAISON" selected>A la livraison</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 mt-">
                                        <input type="submit" name="submit" class="form-control bg-success text-white" value="Commandez" >
                                    </div>
                            </div>
                        </div>
                   </form>
                </div>

                </form>
            </div>
    </section>

    <!--End Cart Section-->

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
			<div class="widget-heading">
				<a href="#" class="close-side-widget">
					X
				</a>
			</div>
			<div class="sidebar-textwidget">

				<!-- Sidebar Info Content -->
				<div class="sidebar-info-contents">
					<div class="content-inner">
						<div class="logo">
							<a href="index.html"><img src="images/logo-3.png" alt="" /></a>
						</div>
						<div class="content-box">
							<h2>About Us</h2>
							<p class="text">Core values are the fundamental beliefs of a person or organization. The core values are the ples that dictate behavior and action suas labore saperet has there any quote for write lorem percit latineu.</p>
							<a href="#" class="theme-btn btn-style-two"><span class="txt">Consultation</span></a>
						</div>
						<div class="contact-info">
							<h2>Contact Info</h2>
							<ul class="list-style-one">
								<li><span class="icon fa fa-location-arrow"></span>Chicago 12, Melborne City, USA</li>
								<li><span class="icon fa fa-phone"></span>(111) 111-111-1111</li>
								<li><span class="icon fa fa-envelope"></span>factory@gmail.com</li>
								<li><span class="icon fa fa-clock-o"></span>Week Days: 09.00 to 18.00 Sunday: Closed</li>
							</ul>
						</div>
						<!-- Social Box -->
						<ul class="social-box">
							<li class="facebook"><a href="#" class="fa fa-facebook-f"></a></li>
							<li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
							<li class="linkedin"><a href="#" class="fa fa-linkedin"></a></li>
							<li class="instagram"><a href="#" class="fa fa-instagram"></a></li>
							<li class="youtube"><a href="#" class="fa fa-youtube"></a></li>
						</ul>
					</div>
				</div>

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
