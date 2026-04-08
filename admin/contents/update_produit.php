<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../config/app.php'); // Connexion MySQLi ($con)

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nom = $_POST['nom_produit'];
    $code_produit = $_POST['code_produit'];
    $reference = $_POST['reference'];
    $prix = floatval($_POST['prix']);
    $stock = intval($_POST['stock']);
    $description = $_POST['description'];
    $caracteristique = $_POST['caracteristique'];
    $code_categorie = $_POST['code_categorie'];
    $code_type = $_POST['code_type'];

    // 🔹 Récupérer le nom du type
    $query = $con->prepare("SELECT type FROM type_produits WHERE code_type = ?");
    $query->bind_param("s", $code_type);
    $query->execute();
    $query->bind_result($nom_type);
    $query->fetch();
    $query->close();

    // 🔹 Fonction de normalisation
    function normaliserNom($texte) {
        $texte = strtolower($texte);
        $texte = iconv('UTF-8', 'ASCII//TRANSLIT', $texte);
        $texte = preg_replace('/[^a-z0-9]/', '', $texte);
        return $texte;
    }

    // Exemple : "Filtre à Huile" devient "filtreahuile"
    $type = normaliserNom($nom_type);
    $image = null;

    // 🔹 Gestion de l'image si nouvelle image uploadée
    if (!empty($_FILES['image']['name'])) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = "../../images/$type/";

        // Si tu veux garder ton système existant :
        // => le dossier sera "filtreahuile", "filtreair", etc.
        if (strpos($type, 'filtre') === false) {
            $type = 'filtre' . $type;
        }
        $target_dir = "../../images/$type/";

        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("❌ Erreur : impossible de créer le dossier $target_dir.");
            }
        }

        $target_file = $target_dir . $image_name;
        $image_path = "$image_name"; // chemin stocké en base (sans / au début)

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            die("❌ Erreur lors de l'upload de l'image (problème de droits ou quota).");
        }

        // 🔹 Vérifier si une image existe déjà pour ce produit
        $check = $con->prepare("SELECT id FROM images WHERE code_produit = ?");
        $check->bind_param("s", $code_produit);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            // 🔹 Si l’image existe, on met à jour
            $stmt_img = $con->prepare("UPDATE images SET nom = ? WHERE code_produit = ?");
            $stmt_img->bind_param("ss", $image_path, $code_produit);
        } else {
            // 🔹 Sinon, on insère une nouvelle image
            $stmt_img = $con->prepare("INSERT INTO images (nom, code_produit) VALUES (?, ?)");
            $stmt_img->bind_param("ss", $image_path, $code_produit);
        }

        if (!$stmt_img->execute()) {
            die("❌ Erreur sur la mise à jour de l'image : " . $stmt_img->error);
        }

        $stmt_img->close();
        $check->close();
        $image = $image_path;
    }

    // 🔹 Mise à jour du produit
    if ($image) {
        $query = "UPDATE produits 
                  SET nom_produit = ?, code_produit = ?, reference = ?, prix = ?, stock = ?, description = ?, 
                      caracteristique = ?, code_categorie = ?, code_type = ?, image = ? 
                  WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssdisssssi", $nom, $code_produit, $reference, $prix, $stock,
                          $description, $caracteristique, $code_categorie, $code_type, $image, $id);
    } else {
        $query = "UPDATE produits 
                  SET nom_produit = ?, code_produit = ?, reference = ?, prix = ?, stock = ?, description = ?, 
                      caracteristique = ?, code_categorie = ?, code_type = ? 
                  WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssdissssi", $nom, $code_produit, $reference, $prix, $stock,
                          $description, $caracteristique, $code_categorie, $code_type, $id);
    }

    if ($stmt->execute()) {
        echo '
        <div style="margin:50px auto;max-width:600px;text-align:center;font-family:sans-serif;">
            <h3 style="color:green;">✅ Le produit a été modifié avec succès.</h3>
            <a href="../liste_produits.php" style="display:inline-block;margin-top:20px;
            background:#007bff;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;">⬅️ Retour à la liste</a>
        </div>';
    } else {
        echo "❌ Erreur lors de la mise à jour : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "⚠️ Données manquantes.";
}
?>
