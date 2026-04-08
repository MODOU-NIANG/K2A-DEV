<?php
$req = "SELECT categories.categorie, COUNT(produits.id) AS nombre_produits
FROM `produits`
JOIN `categories` ON produits.code_categorie = categories.code_categorie
GROUP BY categories.categorie";

// Exécution de la requête et récupération des résultats
$result = mysqli_query($conn, $req);
?>
<div class="widget-content">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

								<ul class="blog-cat">
									<li><a href="#"><?php echo $row['categorie']; ?> <span><?php echo $row['nombre_produits']; ?></span></a></li>
								</ul>						
              <?php } ?>
              </div>