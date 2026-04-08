<!DOCTYPE html>
<html>
<head>
<?php include('layouts/head.php'); ?>
<title>Graisses</title>
<style>
	#photo_prod
	{
		height: 200px;
		weight:210px;
	} 
	/* 🔥 Réduction du padding pour rapprocher la section du footer */
	.sidebar-page-container {
		padding-top: 4px !important;
		padding-bottom: 4px !important;
	}
	</style>

</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->

	<?php include('layouts/header.php'); ?>
    <!-- End Main Header -->

	<!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/graisse.jpg)">
        <div class="auto-container">
			<div class="inner-container clearfix">
				<div class="pull-left">
					<!-- <h1>Shop</h1> -->
				</div>
                <div class="pull-right">
					<ul class="bread-crumb clearfix">
						<li><a>Graisses</a></li>
						<!-- <li>Shop</li> -->
					</ul>
				</div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">

            
				<!--Content Side-->
                <div class="content-side col-lg-8 col-md-8 col-sm-12">

				<?php
include 'config.php';

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour sélectionner les références, noms des produits, prix et noms d'images associées
$sql = "SELECT p.*, i.nom AS nom_image
        FROM produits p
        JOIN images i ON p.code_produit = i.code_produit
        WHERE p.code_categorie = 202 AND p.code_type = 308 
        ";
$result = $conn->query($sql);


// Vérification s'il y a des résultats
if ($result->num_rows > 0) {
    // Boucle sur chaque ligne de résultat
    echo '<div class="row clearfix">';
    while ($row = $result->fetch_assoc()) {
        $reference = $row['reference'];
        $nom_produit = $row['nom_produit'];
		$prix = $row['prix'];
        $nom_image = $row['nom_image']; 
		$nom_image=$row["nom_image"];
		$id=$row["id"];
		// Nom de l'image récupérée depuis la table images
        ?>
        <!-- Code HTML pour chaque produit -->
        <div class="shop-item col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
                <div class="image">
                    <img id='photo_prod'  src="images/graisse/<?php echo $nom_image; ?>" alt="<?php echo $nom_produit; ?>"  />
                    <div class="overlay-box">
                        <ul class="cart-option">
                            <li><a href="produit?id=<?php echo $id?>"><span class="fa fa-shopping-cart"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="lower-content">
				<?php echo $nom_produit; ?> <h3><a href="produit?id=<?php echo $id?>"> <?php echo $reference; ?></a></h3>
                <div class="clearfix">
                        <div class="pull-left">
                            <div class="price"><?php echo $prix; ?>F cfa</div> <!-- Remplacez par le prix dynamique si disponible -->
                        </div>
                        <div class="pull-right">
                            <!--Rating-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>'; // Fermeture de la div row clearfix
} else {
    echo "Aucun produit trouvé.";
}
?>

				
				</div>

				<!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                	<aside class="sidebar">

						<!-- Search -->
						<!-- <div class="sidebar-widget search-box">
							<form method="post" action="contact.html">
								<div class="form-group">
									<input type="search" name="search-field" value="" placeholder="Search....." required>
									<button type="submit"><span class="icon fa fa-search"></span></button>
								</div>
							</form>
						</div> -->

						<!-- Categories Widget -->
						<?php include"categorie.php" ?>

						<!-- Popular Posts -->
						<!-- <div class="sidebar-widget popular-posts">
							<div class="sidebar-title">
								<h2>Les plus vendus</h2>
								<div class="seperater"></div>
							</div>
							<div class="widget-content">
								<article class="post">
									<figure class="post-thumb"><img src="images/resource/1.jpg" alt=""><a href="filtreahuil" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
									<div class="text"><a href="blog-detail.html">filter à huile</a></div>
									<div class="post-info"></div>
								</article>

								<article class="post">
									<figure class="post-thumb"><img src="images/resource/2" alt=""><a href="huile" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
									<div class="text"><a href="huile">huile moteur</a></div>
									<div class="post-info">Views 52</div>
								</article>

								<article class="post">
									<figure class="post-thumb"><img src="images/resource/3.jpg" alt=""><a href="airfilter" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
									<div class="text"><a href="airfilter">filtre à air</a></div>
									<div class="post-info">Views 150</div>
								</article>
							</div>

						</div> -->

					</aside>
				</div>

			</div>
		</div>
	</div>

	<!-- Newsletter Section -->
	
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
					<form method="post" action="contact.html">
						<div class="form-group">
							<input type="text" name="name" value="" placeholder="Name" required="">
						</div>
						<div class="form-group">
							<input type="email" name="email" value="" placeholder="Email" required="">
						</div>
						<div class="form-group">
							<input type="text" name="phone" value="" placeholder="Phone" required="">
						</div>
						<div class="form-group">
							<input type="text" name="name" value="" placeholder="Subject" required="">
						</div>
						<div class="form-group">
							<button type="submit" class="theme-btn btn-style-two"><span class="txt">Subscribe</span></button>
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

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
 <script src="js/nav-tool.js"></script>
 <script src="js/mixitup.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<script src="js/color-settings.js"></script>

<script src="js/main.js"></script>
</body>
</html>
