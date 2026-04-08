<?php
session_start();
include('../config/app.php'); // Connexion MySQLi ($con)

// 🔧 Activer l’affichage des erreurs (utile uniquement en phase de test)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier que la requête est bien en POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* =========================================================
       🔹 1. RÉCUPÉRATION ET SÉCURISATION DES DONNÉES FORMULAIRES
    ========================================================= */
    $nom_produit     = trim($_POST['nom_produit']);
    $code_type       = trim($_POST['code_type']);
    $code_produit    = trim($_POST['code_produit']);
    $code_categorie  = trim($_POST['code_categorie']);
    $caracteristique = trim($_POST['caracteristique']);
    $reference       = trim($_POST['reference']);
    $description     = trim($_POST['description']);
    $prix            = floatval($_POST['prix']);
    $stock           = intval($_POST['stock']);


    /* =========================================================
       🔹 2. VÉRIFICATION DE L’EXISTENCE DU TYPE PRODUIT
    ========================================================= */
    $stmt = $con->prepare("SELECT type FROM type_produits WHERE code_type = ?");
    $stmt->bind_param("s", $code_type);
    $stmt->execute();
    $stmt->bind_result($nom_type);
    $stmt->fetch();
    $stmt->close();

    if (empty($nom_type)) {
        die("⚠️ Type de produit introuvable pour le code : $code_type");
    }


    /* =========================================================
       🔹 3. NORMALISATION DU NOM DU TYPE (pour créer le dossier image)
    ========================================================= */
    function normaliserNom($texte) {
        $texte = strtolower($texte);
        $texte = iconv('UTF-8', 'ASCII//TRANSLIT', $texte);
        $texte = preg_replace('/[^a-z0-9 ]/', '', $texte);
        return str_replace(' ', '', $texte);
    }

    $type = normaliserNom($nom_type);


    /* =========================================================
       🔹 4. GESTION DE L’IMAGE DU PRODUIT
    ========================================================= */
    $image_path = null;

    if (!empty($_FILES['image']['name'])) {
        $image_name  = basename($_FILES['image']['name']);
        $target_dir  = "../../images/$type/";
        $target_file = $target_dir . $image_name;
        $image_path  = "../../images/$type/$image_name";

        // Créer le dossier s’il n’existe pas
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Déplacement du fichier téléchargé
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            die("❌ Erreur lors du transfert de l'image. Vérifiez les permissions du dossier ($target_dir).");
        }

        // 🔹 Insertion du chemin de l’image dans la table images
        $stmt_img = $con->prepare("INSERT INTO images (nom, code_produit) VALUES (?, ?)");
        $stmt_img->bind_param("ss", $image_path, $code_produit);

        if (!$stmt_img->execute()) {
            die("Erreur lors de l'insertion dans la table images : " . $stmt_img->error);
        }

        $stmt_img->close();
    }


    /* =========================================================
       🔹 5. INSERTION DU PRODUIT DANS LA TABLE `produits`
    ========================================================= */
    $stmt_prod = $con->prepare("
        INSERT INTO produits 
        (nom_produit, code_produit, code_categorie, code_type, reference, description, caracteristique, image, prix, stock)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt_prod->bind_param(
        "ssssssssdi",
        $nom_produit,
        $code_produit,
        $code_categorie,
        $code_type,
        $reference,
        $description,
        $caracteristique,
        $image_path,
        $prix,
        $stock
    );


    /* =========================================================
       🔹 6. CONFIRMATION OU ERREUR
    ========================================================= */
    if ($stmt_prod->execute()) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Produit ajouté</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <div class="alert alert-success text-center">
                    <h4 class="alert-heading">✅ Le produit a été ajouté avec succès.</h4>
                    <hr>
                    <a href="../liste_produits.php" class="btn btn-primary mt-3">⬅️ Retour à la liste des produits</a>
                    <a href="../ajout_produit.php" class="btn btn-success mt-3">➕ Ajouter un autre produit</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ Erreur lors de l'insertion du produit : " . $stmt_prod->error;
    }

    $stmt_prod->close();


} else {
    // Si la méthode n’est pas POST
    echo "⚠️ Requête invalide (méthode non autorisée).";
}
?>
