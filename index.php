<!DOCTYPE html>
<html>
<head>
    <?php include("layouts/head.php"); ?>
    <title>Accueil</title>
</head>

<body>
<div class="page-wrapper">
  
    <!-- WhatsApp Chat Integration -->
<div class="whatsapp-chat">
    <a href="https://wa.me/781470528?text=Bonjour!%20Je%20souhaite%20obtenir%20plus%20d'informations%20sur%20K2A%20Filtration." 
       target="_blank">
        <img src="images/logok2a.png" alt="WhatsApp" class="whatsapp-icon">
    </a>
</div>

<style>
    .whatsapp-chat {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1000;
    }
    .whatsapp-chat .whatsapp-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }
    .whatsapp-chat .whatsapp-icon:hover {
        transform: scale(1.1);
    }
</style>


    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
    <?php include('layouts/header.php'); ?>
    <!-- End Main Header -->

    <!--Main Slider-->
    <section class="main-slider">

        <div class="main-slider-carousel owl-carousel owl-theme">

            <div class="slide" style="background-image:url(images/main-slider/2.jpg)">
                <div class="auto-container">
					<div class="row clearfix">
						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="title">K2A filtration </div>
							<h2>la meilleur solution <br> pour vos filtration automobile</h2>
							<div class="text">"Chez K2A Filtration, nous offrons des solutions de filtration automobile fiables et performantes depuis 2013.
                                 Que ce soit pour des filtres à huile, à air ou à carburant, nous garantissons une qualité supérieure pour protéger vos moteurs et améliorer leur durée de vie."</div>
							<div class="link-box clearfix">
								<a href="index" class="theme-btn btn-style-three"><span class="txt">Accueil</span></a>
							</div>
						</div>
						<!-- Image Column -->
						<!-- <div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="image wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
								<img src="images/main-slider/content-image-1.png" alt="" />
							</div>
						</div> -->
					</div>
                </div>
            </div>

            

			<div class="slide" style="background-image:url(images/main-slider/3.jpg)">
                <div class="auto-container">
					<div class="row clearfix">
						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="title">K2A FILTRATION</div>
							<h2>Votre partenaire de confiance <br>
                            En filtres automobiles depuis 2013</h2>
							<div class="text">  K2A s'efforce d'assurer une protection optimale des moteurs et des systèmes mécaniques, 
                                en offrant des filtres capables de maintenir la propreté des fluides,<br> qu'il s'agisse d'huile, d'air ou de carburant.</div>
							<div class="link-box clearfix">
								<a href="accueil" class="theme-btn btn-style-three"><span class="txt">Accueil</span></a>
							</div>
						</div>
						<!-- Image Column -->
						<!-- <div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="image wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
								<img src="images/main-slider/content-image-1.png" alt="" />
							</div>
						</div> -->
					</div>
                </div>
            </div>

        </div>

		<!-- Scroll Down Btn -->
        <div class="mouse-btn-down scroll-to-target" data-target=".features-section"><span class="icon fa fa-anchor"></span></div>

    </section>
    <!--End Main Slider-->

   <!-- Services Section --> 
    <section class="services-section-five">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="title">LES FILTRES</span>
                <h2>Découvrez nos meilleures catégories de filtres.</h2>
                <!-- <div class="sec-title">
                            <span class="title">filtration K2A</span>
                            <h3>Avec K2A Filtration,<br> profitez de la meilleure solution en filtration automobile</h3>
                            <div class="seperater style-two"></div>
                        </div> -->
            
            </div>

            <!-- Services Carousel -->
            <div class="services-carousel owl-carousel owl-theme">
                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="airfilter"><img src="images/resource/1.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="airfilter">le filtre à air</a></h3>
                            <div class="text"> le filtre à air en bon état prolonge la durée de vie des moteurs et assure un fonctionnement optimal.</div>
                            <div class="link-box"><a href="airfilter">voir plus</a></div>
                            
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="fuelfilter"><img src="images/resource/2.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="fuelfilter">filtre à Gasoil</a></h3>
                            <div class="text">le filtre à gasoil assure une combustion plus efficace, améliore les performances du moteur et contribue à réduire la consommation de carburant.</div>
                            <div class="link-box"><a href="fuelfilter">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="filtreahuile"><img src="images/resource/2.2.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="filtreahuile">le filtre à huile</a></h3>
                            <div class="text">Le filtre à air est un composant essentiel du système de filtration d’un véhicule. 
                                Il a pour rôle principal de filtrer l’air qui entre dans le moteur, en retenant les impuretés comme la poussière, les particules et autres débris</div>
                            <div class="link-box"><a href="filtreahuile">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
               

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="filtrehydraulique"><img src="images/resource/2.3.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="filtrehydraulique">filtre  hydraulique</a></h3>
                            <div class="text">Le rôle du filtre hydraulique est essentiel pour assurer le bon fonctionnement des systèmes hydrauliques, 
                                car les particules présentes dans le fluide peuvent endommager les composants sensibles, tels que les pompes, 
                                les valves et les cylindres, ce qui peut entraîner une défaillance du système.</div>
                            <div class="link-box"><a href="filtrehydraulique">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="filtreseparateur"><img src="images/resource/2.4.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="filtreseparateur">filtre séparateur</a></h3>
                            <div class="text">Le filtre séparateur, également appelé séparateur d'eau ou séparateur huile-eau, est un dispositif utilisé dans diverses
                                 applications industrielles et mécaniques pour séparer les substances indésirables présentes dans un fluide, généralement de l'eau, de l'huile ou de l'air.</div>
                            <div class="link-box"><a href="filtreseparateur">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
               

                <!-- Service Block -->
                

                <!-- Service Block -->
               
            </div>
        </div>
    </section>
    <!--End Services Section -->

    <!-- Feautes Section -->
    <section class="features-section">
        <div class="auto-container">
            <div class="outer-box">
                <div class="row">

                    <!-- Feature Block -->
                    <div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="icon-box"><span class="icon flaticon-diesel"></span></div>
                            </div>
                            <div class="lower-content">
                                <!-- <h4><a href="#"> Qualité Premium -->
                                </a></h4>
                                <div class="text">Nos filtres sont conçus pour répondre aux normes les plus strictes,
                                     garantissant une protection maximale contre l'usure et les impuretés.</div>
                                <!-- <div class="link-box"><a href="accueil.php">Accueil</a></div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Feature Block -->
                    <div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="icon-box"><span class="icon flaticon-gallery"></span></div>
                            </div>
                            <div class="lower-content">
                                <h4><a href="#"> Durabilité et Performance</a></h4>
                                <div class="text">Les produits K2A prolongent la durée de vie de votre moteur,
                                     améliorant son efficacité et réduisant les coûts d’entretien.</div>
                                <!-- <div class="link-box"><a href="accueil.php">Accueil</a></div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Feature Block -->
                    <div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="icon-box"><span class="icon flaticon-diesel"></span></div>
                            </div>
                            <div class="lower-content">
                                <h4><a href="#"> Expertise Technique</a></h4>
                                <div class="text">Plus de 10 ans d'expérience dans le domaine de la filtration automobile,
                                     avec une équipe dédiée à l’innovation et à l’amélioration continue
</div>
                                <!-- <div class="link-box"><a href="accueil.php">Accueil</a></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Feautes Section -->

	<!-- About Section -->
    <section class="about-section-two style-two">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">filtration K2A</span>
                            <h2>Avec K2A Filtration,<br> profitez de la meilleure solution en filtration automobile</h2>
                            <div class="seperater style-two"></div>
                        </div>
                        <div class="text">Améliorez la performance de vos véhicules avec K2A Filtration !
                         "Depuis 2013, K2A Filtration est votre expert en solutions de filtration automobile. Nous vous offrons 
                          des filtres à l'huile, à l'air et à carburant de qualité supérieure, conçus pour améliorer la performance et la longévité de vos véhicules. Découvrez notre gamme de produits dès aujourd'hui et faites confiance à une entreprise qui place la qualité avant tout."</div>
                        <ul class="list-style-one">
                            <li>Filtre à Carburant K2A - 15% de réduction !.</li>
                            <li>Kit d'entretien complet pour moteur - 5L d'huile, filtre à huile, filtre à air.</li>
                            <li>Spray Nettoyant Injecteurs K2A – Boostez les performances du moteur !</li>
                        </ul>
                        <div class="btn-box">
							<a href="apropos" class="theme-btn btn-style-four"><span class="txt">apropos</span></a>
						</div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="text-layer">A</div>
                        <figure class="image-1 wow fadeInUp"><a href="#" class="lightbox-image" data-fancybox="images"><img src="images/resource/aproposfil.jpg" alt=""></a></figure>
                        <figure class="image-2 wow fadeInRight"><a href="#" class="lightbox-image" data-fancybox="images"><img src="images/resource/k2apropos.png" alt=""></a></figure>
                        <!-- <div class="video-link wow zoomIn"><a href="https://www.youtube.com/watch?v=e_WOEL6F1YE" class="link" data-fancybox="gallery" data-caption=""><span class="icon fa fa-play"></span></a></div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd About Section -->

	<!-- Funfacts And Clients -->
   
    </section> 
    <!--End Funfacts And Clients -->

    <!-- Services Section -->
    <section class="services-section-five">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="title">K2A filtration</span>
                <h2>LUBRIFIANTS & ACCESSOIRES </h2>
                <div class="seperater style-two"></div>
            </div>

            <!-- Services Carousel -->
            <div class="services-carousel owl-carousel owl-theme">
                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="huile"><img src="images/resource/4.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="huile">huile moteurs</a></h3>
                            <div class="text">L’huile moteur synthétique K2A garantit une protection optimale du moteur, même dans les conditions
                                 les plus extrêmes, pour des performances durables et une efficacité accrue.</div>
                            <div class="link-box"><a href="huile">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="graisse"><img src="images/resource/5.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="graisse">graisse</a></h3>
                            <div class="text">La graisse multi-usage K2A est conçue pour offrir une lubrification de haute qualité, garantissant la protection des pièces mécaniques sous forte pression, même dans les environnements les plus exigeants.</div>
                            <div class="link-box"><a href="graisse">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="courroie"><img src="images/resource/6.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="courroie">courroie</a></h3>
                            <div class="text">Assurez le bon fonctionnement de votre moteur avec la courroie de distribution K2A, 
                                conçue pour une transmission de puissance fluide et une durabilité optimale, même dans les conditions les plus exigeantes.</div>
                            <div class="link-box"><a href="courroie">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="protegedirection"><img src="images/resource/7.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="protegedirection">Protége direction</a></h3>
                            <div class="text">Le protège-direction K2A assure une défense robuste contre les éléments extérieurs, préservant ainsi la performance et la longévité de votre système de direction.</div>
                            <div class="link-box"><a href="protegedirection">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="liquide"><img src="images/resource/8.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="liquide">liquide de refroidissement</a></h3>
                            <div class="text">Le liquide de refroidissement K2A maintient votre moteur à la température idéale, prévenant la
                                 surchauffe en été et le gel en hiver, pour des performances moteur constantes tout au long de l’année.</div>
                            <div class="link-box"><a href="liquide">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="colier"><img src="images/resource/9.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="colier">collier</a></h3>
                            <div class="text">K2A est synonyme de qualité et d’élégance. Notre gamme de colliers associe matériaux premium et design raffiné,
                             garantissant un bijou à la fois durable et tendance, idéal pour sublimer vos moments les plus précieux.</div>
                            <div class="link-box"><a href="colier">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="col"><img src="images/resource/10.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="col">colle</a></h3>
                            <div class="text">La colle multi-usage K2A offre une adhérence puissante sur une large variété de matériaux.
                                 Que ce soit pour des réparations rapides ou des travaux plus complexes, elle garantit des résultats durables et résistants.</div>
                            <div class="link-box"><a href="col">voir plus</a></div>
                        </div>
                    </div>
                </div>

                <!-- Service Block -->
                <!-- <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="project-planning.html"><img src="images/resource/service-5.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="#">Chemical Research</a></h3>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adip isicing elit sed do.</div>
                            <div class="link-box"><a href="project-planning.html">Read More</a></div>
                        </div>
                    </div>
                </div> -->

                <!-- Service Block -->
                <!-- <div class="service-block-two">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="project-planning.html"><img src="images/resource/service-6.1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <h3><a href="#">Mechanical Engineering</a></h3>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adip isicing elit sed do.</div>
                            <div class="link-box"><a href="project-planning.html">Read More</a></div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!--End Services Section -->

    <!-- Project Section Two -->
    
    <!--End Project Section Two -->

    <!-- Team Section Four -->
	
	<!-- End Team Section Four -->

    <!-- Call To Action -->
    
    <!--End Call To Action -->

    <!-- News Section Two -->
    
    <!--End News Section -->

	<!-- Newsletter Section -->
	
	<!-- End Newsletter Section -->

	<!-- Main Footer -->
     <?php include("layouts/footer.php"); ?>
	<!-- End Main Footer -->

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

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>

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
