<!DOCTYPE html>
<html>

<!--start head-->
<?php include('layouts/head.php'); ?>
<title>Contact</title>

<style>
        /* Réduction de l’espace avant le footer */
        .contact-section {
            padding: 10px 0px 0 !important;
        }

        #googleMap {
            width: 100%;
            height: 350px; /* tu peux réduire encore si tu veux */
            border-radius: 8px;
        }
    </style>

<!-- Leaflet (OpenStreetMap) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!--end head-->

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
    <?php include('layouts/header.php'); ?>
    <!-- End Main Header -->

    <!--Page Title-->
    <!-- <section class="page-title" style="background-image:url(images/background/contact2.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix"></div>
        </div>
    </section> -->

    <section class="page-title" style="background-image:url(images/background/contact2.jpg)">
        <div class="auto-container">
			<div class="inner-container clearfix">
				<div class="pull-left">
					<!-- <h1>Contact</h1> - ->
												
					
				</div> -->
		
	        <style>
             .contact-info-section {
               margin-bottom: 0 !important;
              padding-bottom: 50px !important; /* tu peux ajuster */
               }

             .clients-section-three {
               margin-bottom: 0 !important;
             padding-bottom: 0 !important;
              }
            </style>
            
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Page Section -->
    <section class="contact-page-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Form Column -->
                <div class="form-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">

                        <div class="sec-title">
                            <div class="title">Contactez-nous</div>
                            <div class="seperater"></div>
                        </div>

                        <div class="contact-form">
                            <form method="post" action="controller/sendemail.php">

                                <div class="form-group">
                                    <input type="text" name="username" placeholder="NOM" required="">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="tel" name="telephone" placeholder="Téléphone" required="">
                                </div>

                                <div class="form-group">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="theme-btn" type="submit" name="submit-form">Envoyez</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

                <!-- Map Column -->
                <div class="map-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- OpenStreetMap -->
                        <div id="map" style="width: 100%; height: 400px; border-radius: 8px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Contact Page Section -->

    <!-- Contact Info Section -->
    <section class="contact-info-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <div class="info-box col-lg-4 col-md-6 col-sm-12">
                        <div class="box-inner">
                            <div class="icon fa fa-map-marker"></div>
                            <h3>Adresse</h3>
                            <div class="text">Dalifort cité Assurance</div>
                        </div>
                    </div>

                    <div class="info-box col-lg-4 col-md-6 col-sm-12">
                        <div class="box-inner">
                            <div class="icon fa fa-phone"></div>
                            <h3>Téléphone</h3>
                            <ul>
                                <li>Fixe: 33 832 51 51</li>
                                <li>Mobile: 77 676 63 63</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-box col-lg-4 col-md-6 col-sm-12">
                        <div class="box-inner">
                            <div class="icon fa fa-envelope"></div>
                            <h3>E-Mail</h3>
                            <ul>
                                <li>contact@k2afiltration.com</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="clients-section-three style-two">
        <div class="auto-container">
            <div class="sponsors-outer"></div>
        </div>
    </section>

    <!-- Main Footer -->
    <?php include('layouts/footer.php'); ?>
    <!-- End Main Footer -->

</div>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>

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
<script src="js/validate.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<script src="js/color-settings.js"></script>

<!-- Script OpenStreetMap -->
<script>
    // Coordonnées exactes envoyées via WhatsApp
    var latitude = 14.7394304275513;
    var longitude = -17.4182529449463;

    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
        .bindPopup("<b>K2A Filtration</b><br>Adresse envoyée via WhatsApp<br><a href='mailto:contact@k2afiltration.com'>contact@k2afiltration.com</a>")
        .openPopup();
</script>


</body>
</html>
