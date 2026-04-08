<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title> Panier</title>

<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- Color Switcher Mockup -->
<link href="css/color-switcher-design.css" rel="stylesheet">

<!-- Color Themes -->
<link id="theme-color-file" href="css/color-themes/default-theme.css" rel="stylesheet">

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

</head>

<body>

<div class="page-wrapper"> 

    <!-- Preloader -->
     <!-- <div class="preloader"></div>  -->

    <!-- Main Header -->
    <?php
    $id=0;
    if ($_GET['id']) {
      $id=$_GET['id'];
    }
     include('layouts/header.php');
    include 'config.php';
    // Vérification de la connexion
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // var_dump($conn);
    // die(); 

    // Requête SQL pour sélectionner les références, noms des produits, prix et noms d'images associées
    $sql = "SELECT p.*, i.nom AS nom_image
            FROM produits p
            JOIN images i ON p.code_produit = i.code_produit
            WHERE p.id=$id     
    ";

    $result = $conn->query($sql);
    
//     if (!$result || $result->num_rows == 0) {
//     header("Location: 404.php"); // ou une autre page d'erreur
//     exit();
// }

    $row = $result->fetch_assoc();
    // var_dump($row);
    // die();
            $reference = $row['reference'];
            $nom_produit = $row['nom_produit'];
            $carateristique=$row['caracteristique'];
            $description=$row['description'];
            $prix = $row['prix'];
            $code_type=$row['code_type'];
            $nom_image = $row['nom_image']; 
            $id=$row['id'];
            // Nom de l'image récupérée depuis la table images
            

    ?>
    <!-- End Main Header -->

	<!--Page Title-->
    
    <!--End Page Title-->

	<!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">

				<!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
					<div class="shop-single">
                    	<div class="product-details">

                            <!--Basic Details-->
                            <div class="basic-details">
                                <div class="row clearfix">
                                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                        <?php
                                        
                                        $path=""; 
                                        switch ($code_type) {
                                            case '301':
                                               $path="images/filtreair/";
                                                break;
                                            case '302':
                                                $path="images/filtreagasoil/";
                                                break;
                                                case '303':
                                                    $path="images/filtrehydraulique/";
                                                    break; 
                                                    case '304':
                                                        $path="images/filtreahuile/";
                                                        break;  
                                                        case'305':
                                                            $path="images/filtreseparateur/";
                                                            break;
                                                            case '306':
                                                                $path="images/filtremagnetique/";
                                                                break; 
                                                                case '307':
                                                                    $path="images/huile/";
                                                                    break; 
                                                                    case '308':
                                                                        $path="images/graisse/";
                                                                        break; 
                                                                        case '309':
                                                                            $path="images/liquide/";
                                                                            break;
                                                                            case '310':
                                                                                $path="images/courroie/";
                                                                                break; 
                                                                                case '311':
                                                                                    $path="images/colle/";
                                                                                    break;  
                                                                                    case '312':
                                                                                        $path="images/colier/";
                                                                                        break; 
                                                                                        case '313':
                                                                                            $path="images/protegedirection/";
                                                                                            break;   
                                                                                              default:
                                                                                                $path="images/filtreair/";
                                                                                                   break;
                                                                                                     }
                                        // var_dump($path);
                                        // die();
                                        ?>
                                                                                 <figure class="image-box">
                                                                                         <a href="<?php echo $path . $nom_image; ?>" class="lightbox-image" title="Image Caption Here">
                                                                                         <img src="<?php echo $path . $nom_image; ?>" alt="<?php echo $nom_produit; ?>">
                                                                                            </a>
                                                                                        </figure>
                                    </div>
                                    <div class="info-column col-lg-6 col-md-12 col-sm-12">
                                        <div class="details-header">
                                            <!-- <h4>caracteristique</h4> -->
                                            <!-- <div class="rating">
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div> -->
                                            <span class="item-price-nom" style="color: black ;  font-size :20px ;font-weight: bold"><?php echo $nom_produit; ?></span>
                                            <div class="item-price"><?php echo $prix; ?>F cfa</div>
                                        </div>

                                        <div class="text"><?php echo $carateristique; ?></div>
                                        <div class="other-options clearfix">
                                            <div class="item-quantity">
                                                <input class="quantity-spinner" type="text" value="1" name="quantity" id="product-quantity">
                                            </div>
                                            <button onclick="addToCart({
                                                image : '<?php echo $path.$nom_image;  ?>',
                                                reference: '<?php echo $reference; ?>',
                                                name: '<?php echo $nom_produit; ?>',
                                                quantity: document.getElementById('product-quantity').value,
                                                price: <?php echo $prix; ?>
                                            })" id="add-to-cart" type="button" class="theme-btn btn-style-one add-to-cart">
                                                <span class="txt">Ajouter au panier</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Basic Details-->

                            <!--Product Info Tabs-->
                            <div class="product-info-tabs">
                                <!--Product Tabs-->
                                <div class="prod-tabs tabs-box">

                                    <!--Tab Btns-->
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li data-tab="#prod-details" class="tab-btn active-btn">Descripton</li>
                                        <!-- <li data-tab="#prod-reviews" class="tab-btn">Review (3)</li> -->
                                    </ul>

                                    <!--Tabs Container-->
                                    <div class="tabs-content">

                                        <!--Tab / Active Tab-->
                                        <div class="tab active-tab" id="prod-details">
                                            <div class="content">
                                                <p> <?php echo $description?> </p>
                                            </div>
                                        </div>

                                        <!--Tab-->
                                        <div class="tab" id="prod-reviews">
                                            <h2 class="title">3 Reviews For <span class="theme_color">Patient Ninja</span></h2>
                                            <!--Reviews Container-->
                                            <div class="comments-area style-two">
                                                <!--Comment Box-->
                                                <div class="comment-box">
                                                    <div class="comment">
                                                        <div class="author-thumb"><img src="images/resource/author-1.jpg" alt=""></div>
                                                        <div class="comment-inner">
                                                            <div class="comment-info clearfix">James Koster <span>June 7’2013:</span></div>
                                                            <div class="rating">
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star light"></span>
                                                            </div>
                                                            <div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Comment Box-->
                                                <div class="comment-box reply-comment">
                                                    <div class="comment">
                                                        <div class="author-thumb"><img src="images/resource/author-4.jpg" alt=""></div>
                                                        <div class="comment-inner">
                                                            <div class="comment-info clearfix">Cobus Besten <span>June 7’2013:</span></div>
                                                            <div class="rating">
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                            <div class="text">Lorem Ipsum is simply dummy text of the printing </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Comment Box-->
                                                <div class="comment-box">
                                                    <div class="comment">
                                                        <div class="author-thumb"><img src="images/resource/author-5.jpg" alt=""></div>
                                                        <div class="comment-inner">
                                                            <div class="comment-info clearfix">Magnus <span>June 7’2013:</span></div>
                                                            <div class="rating">
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                            <div class="text">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Comment Form -->
                                            <div class="shop-comment-form">
                                                <h2>ADD A REVIEW</h2>
                                                <div class="mail-text"><span class="theme_color">Your email address will not be published.</span> Required fields are marked*</div>
                                                <div class="rating-box">
                                                    <div class="text"> Your Rating:</div>
                                                    <div class="rating">
                                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                                    </div>
                                                </div>
                                                <form method="post" action="contact.html">
        											<div class="form-group">
                                                        <label>Your Review*</label>
                                                        <textarea name="message" placeholder=""></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="username" placeholder="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="number" placeholder="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">SUBMIT</span></button>
                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!--End Product Info Tabs-->

                            <!--Related Projects-->
                            <div class="related-projects">
                            	<!-- <div class="sec-title">
                                	<h2>Related Product</h2>
                                </div> -->
                                <div class="row clearfix">

                                    <!--Shop Item-->
                                    <!-- <div class="shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="image">
                                                <img src="images/resource/products/4.jpg" alt="" />
                                                <div class="overlay-box">
                                                    <ul class="cart-option">
                                                        <li><a href="shop-single.html"><span class="fa fa-shopping-cart"></span>Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h3><a href="shop-single.html">Ninja Silhouette</a></h3>
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="price">$20.00</div>
                                                    </div>
                                                    <div class="pull-right">
                                                        Rating
                                                        <div class="rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->

                                    <!--Shop Item-->
                                    <!-- <div class="shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="image">
                                                <img src="images/resource/products/5.jpg" alt="" />
                                                <div class="overlay-box">
                                                    <ul class="cart-option">
                                                        <li><a href="shop-single.html"><span class="fa fa-shopping-cart"></span>Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h3><a href="shop-single.html">Premium Quality</a></h3>
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="price">$35.00</div>
                                                    </div>
                                                    <div class="pull-right">
                                                        Rating
                                                        <div class="rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->

                                    <!--Shop Item-->
                                    <!-- <div class="shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="image">
                                                <img src="images/resource/products/6.jpg" alt="" />
                                                <div class="overlay-box">
                                                    <ul class="cart-option">
                                                        <li><a href="shop-single.html"><span class="fa fa-shopping-cart"></span>Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h3><a href="shop-single.html">Ship Your Idea</a></h3>
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="price"><span class="discount">$15.00</span>$12.00</div>
                                                    </div>
                                                    <div class="pull-right">
                                                        Rating
                                                        <div class="rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>

						</div>
                    </div>
				</div>

				<!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                	<aside class="sidebar">

						<!-- Search -->
						<div class="sidebar-widget search-box">
							<form method="post" action="contact.html">
								<div class="form-group">
									<input type="search" name="search-field" value="" placeholder="Search....." required>
									<button type="submit"><span class="icon fa fa-search"></span></button>
								</div>
							</form>
						</div>

						<!-- Categories Widget -->
						 <?php include "categorie.php"  ?>
						<!-- Popular Posts -->
						
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
<script src="js/jquery.bootstrap-touchspin.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<script src="js/main.js"></script>

<script src="js/color-settings.js"></script>

</body>
</html>
