<?php
include('../config/app.php');
function createDirectory($dir)
{
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

function deleteFile($filePath)
{
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

if (isset($_GET['publier'])) {
    $id_article = $_GET['publier'];

    mysqli_query($con, "UPDATE `articles` SET `statut` = '1' WHERE id_article = '$id_article'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Article publié avec succès sur le site public !';
    header("location: ../publication_el?id_article=$id_article");
}

if (isset($_GET['retirer'])) {
    $id_article = $_GET['retirer'];

    mysqli_query($con, "UPDATE articles SET statut='0' where id_article='$id_article'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Article retiré avec succès pour retraitement !';
    header("location: ../publication_ea?id_article=$id_article");
}

//chateau.jpg

if (isset($_GET['supprimer'])) {
    $id_article = $_GET['supprimer'];

    // Récupérer le nom de l'image avant de supprimer l'article
    $result = mysqli_query($con, "SELECT image FROM articles WHERE id_article='$id_article'");
    if ($result && $row = mysqli_fetch_array($result)) {
        $image = $row['image'];
        $imagePath = "../" . $image;
        deleteFile($imagePath);
    }
    mysqli_query($con, "DELETE FROM articles WHERE  id_article='$id_article'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Article supprimé avec succès !';
    header("location: ../articles_ea");
}

if (isset($_POST['addLogo'])) {

    $nomLight = $_POST['nomLight'];
    $nomDark = $_POST['nomDark'];

    // logo dark
    if (isset($_FILES['image_logo_dark']) and $_FILES['image_logo_dark']['error'] == 0) {
        if (is_dir($nomRep)) {
            $m = "../img/logo/" . $_FILES['image_logo_dark']['name'];
            move_uploaded_file($_FILES['image_logo_dark']['tmp_name'], $m);
            $linkDark = $_FILES['image_logo_dark']['name'];
        } else {
            mkdir("../img/logo");
            $m = "../img/logo/" . $_FILES['image_logo_dark']['name'];
            move_uploaded_file($_FILES['image_logo_dark']['tmp_name'], $m);
            $linkDark = $_FILES['image_logo_dark']['name'];
        }
    }

    // logo light
    if (isset($_FILES['image_logo_light']) and $_FILES['image_logo_light']['error'] == 0) {
        if (is_dir($nomRep)) {
            $m = "../img/logo/" . $_FILES['image_logo_light']['name'];
            move_uploaded_file($_FILES['image_logo_light']['tmp_name'], $m);
            $linkLight = $_FILES['image_logo_light']['name'];
        } else {
            mkdir("../img/logo");
            $m = "../img/logo/" . $_FILES['image_logo_light']['name'];
            move_uploaded_file($_FILES['image_logo_light']['tmp_name'], $m);
            $linkLight = $_FILES['image_logo_light']['name'];
        }
    }

    $verifDoublon = mysqli_query($con, "SELECT * FROM logo");

    if (mysqli_num_rows($verifDoublon) > 0) {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Un logo existe déjà ! ";
        header("Location: ../logo.php");
    } else {

        $sql = mysqli_query($con, "INSERT INTO logo (nomDark,linkDark, nomLight, linkLight)
      VALUES ('$nomDark','$linkDark', '$nomLight','$linkLight')");

        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = 'Logo ajouté avec succès !';
        header("location: ../logo.php");
    }
}

if (isset($_POST['editLogo'])) {

    $nomLight = $_POST['nomLight'];
    $nomDark = $_POST['nomDark'];
    $idLogo = $_POST['idLogo'];

    // logo dark
    if (isset($_FILES['image_logo_dark']) and $_FILES['image_logo_dark']['error'] == 0) {
        if (is_dir($nomRep)) {
            $m = "../img/logo/" . $_FILES['image_logo_dark']['name'];
            move_uploaded_file($_FILES['image_logo_dark']['tmp_name'], $m);
            $linkDark = $_FILES['image_logo_dark']['name'];
        } else {
            mkdir("../img/logo");
            $m = "../img/logo/" . $_FILES['image_logo_dark']['name'];
            move_uploaded_file($_FILES['image_logo_dark']['tmp_name'], $m);
            $linkDark = $_FILES['image_logo_dark']['name'];
        }
    }

    // logo light
    if (isset($_FILES['image_logo_light']) and $_FILES['image_logo_light']['error'] == 0) {
        if (is_dir($nomRep)) {
            $m = "../img/logo/" . $_FILES['image_logo_light']['name'];
            move_uploaded_file($_FILES['image_logo_light']['tmp_name'], $m);
            $linkLight = $_FILES['image_logo_light']['name'];
        } else {
            if (!is_dir("../img/logo")) {
                mkdir("../img/logo", 0777, true);
            }
            $m = "../img/logo/" . $_FILES['image_logo_light']['name'];
            move_uploaded_file($_FILES['image_logo_light']['tmp_name'], $m);
            $linkLight = $_FILES['image_logo_light']['name'];
        }
    }

    $sql = mysqli_query($con, "UPDATE logo SET nomDark='$nomDark', linkDark='$linkDark', nomLight='$nomLight', linkLight='$linkLight' where id='$idLogo'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Logo modifié avec succès !';
    header("location: ../logo.php");
}

if (isset($_POST['addPublication'])) {

    try {
        $getLastIdArticle = mysqli_query($con, "SELECT MAX(id_article) AS lastId FROM `articles`");

        if ($getLastIdArticle) {
            while ($row = mysqli_fetch_array($getLastIdArticle)) {
                $lastId = $row['lastId'];
            }
        } else {
            throw new Exception("Erreur SQL : " . mysqli_error($con));
        }
        $id_article = $lastId + 1;
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $id_categorie = $_POST['categorie'];
        $id_auteur = $_SESSION['id'];

        $contenu = str_replace("'", "\'", $contenu);
        $contenu = str_replace("`", "\`", $contenu);
        $titre = str_replace("'", "\'", $titre);
        $titre = str_replace("`", "\`", $titre);

        $resume = substr($contenu, 0, 80);

        $getCat = mysqli_query($con, "SELECT * FROM `categories` WHERE id_categorie='$id_categorie'");

        if ($getCat && mysqli_num_rows($getCat) > 0) {
            $row = mysqli_fetch_array($getCat);
            $categorie = $row['categorie'];
        } else {
            throw new Exception("Erreur : La catégorie est introuvable dans la base de données.");
        }

        $nomRep = $categorie;

        if ($_FILES['image_publication']['error'] == 4)
            throw new Exception("L'image est obligatoire !");

        if ($_FILES['image_publication']['error'] == 1) {
            throw new Exception("L'image est trop grande !");
        }

        $directoryPath = "../images_articles/" . $nomRep;
        $extension = round(microtime(true) * 1000) . '.' . pathinfo($_FILES['image_publication']['name'], PATHINFO_EXTENSION);
        $nom_image = uniqid() . '_' . $extension;
        $directoryCreationStatus = createDirectory($directoryPath);
        $m = $directoryPath . "/" . $nom_image;
        $uploadFileStatus = move_uploaded_file($_FILES['image_publication']['tmp_name'], $m);
        if (!$uploadFileStatus) throw new Exception("Fichier non téléchargé + Rep !");

        $relativeImagePath = "images_articles/" . $nomRep . "/" . $nom_image;

        $insertArticle = mysqli_query($con, "INSERT INTO `articles` (`id_article`, `titre`, `resume`, `id_categorie`, `contenu`, `image`, `date_creation`, `date_publication`, `id_auteur`, `statut`) VALUES ('$id_article','$titre','$resume','$id_categorie','$contenu', '$relativeImagePath', '$dateDuJour' , '$dateDuJour' , '$id_auteur' , '0')");

        if (!$insertArticle) {
            throw new Exception("Erreur lors de l'insertion de l'article : " . mysqli_error($con));
        }

        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = 'Article créé avec succès !';
        header("location: ../articles_ea");
    } catch (Exception $e) {
        $_SESSION['successMsg'] = false;
        $_SESSION['errorMsg'] = true;
        $_SESSION['message'] = $e->getMessage();
        header("location: ../nouvelle_publication");
    }
}

if (isset($_POST['editPublication'])) {
    try {
        $id_article = $_POST['id_article'];
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $id_auteur = $_POST['id_auteur'];
        $categorie = $_POST['categorie'];
        $date_creation = $_POST['date_creation'];

        $contenu = str_replace("'", "\'", $contenu);
        $contenu = str_replace("`", "\`", $contenu);
        $titre = str_replace("'", "\'", $titre);
        $titre = str_replace("`", "\`", $titre);
        $id_categorie = $_POST['categorie'];

        $getCat = mysqli_query($con, "SELECT * FROM `categories` WHERE id_categorie='$id_categorie'");

        if ($getCat && mysqli_num_rows($getCat) > 0) {
            $row = mysqli_fetch_array($getCat);
            $categorie = $row['categorie'];
        } else {
            throw new Exception("Erreur : La catégorie est introuvable dans la base de données.");
        }

        // Récupérer le nom de l'ancienne image avant de la supprimer
        $result = mysqli_query($con, "SELECT image FROM articles WHERE id_article='$id_article'");
        if ($result && $row = mysqli_fetch_array($result)) {
            $oldImage = $row['image'];
            $oldImagePath = "../" . $oldImage;
            if (file_exists($oldImagePath)) {
                deleteFile($oldImagePath);
            }
        }

        if ($_FILES['image_publication']['error'] == 1)
            throw new Exception("L'image est trop grande !");

        if (isset($_FILES['image_publication']) && $_FILES['image_publication']['error'] == 0) {
            $nomRep = $categorie;
            $extension = round(microtime(true) * 1000) . '.' . pathinfo($_FILES['image_publication']['name'], PATHINFO_EXTENSION);
            $nom_image = uniqid() . '_' . $extension;
            $directoryPath = "../images_articles/" . $nomRep;
            $directoryCreationStatus = createDirectory($directoryPath);
            $m = $directoryPath . "/" . $nom_image;
            $uploadFileStatus = move_uploaded_file($_FILES['image_publication']['tmp_name'], $m);
            if (!$uploadFileStatus) throw new Exception("Fichier non téléchargé !");

            $relativeImagePath = "images_articles/" . $nomRep . "/" . $nom_image;
        }

        $query = "UPDATE articles SET titre='$titre', id_categorie='$id_categorie', date_creation='$date_creation', contenu='$contenu', id_auteur='$id_auteur'";
        if (isset($relativeImagePath)) {
            $query .= ", image='$relativeImagePath'";
        }
        $query .= " WHERE id_article='$id_article'";
        mysqli_query($con, $query);

        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = 'Publication modifiée avec succès !';
        header("location: ../publication_ea?id_article=" . $id_article);
    } catch (Exception $e) {
        $_SESSION['successMsg'] = false;
        $_SESSION['errorMsg'] = true;
        $_SESSION['message'] = $e->getMessage();
        header("location: ../publication_ea?id_article=" . $id_article);
    }
}

if (isset($_POST['deletePublication'])) {

    $id_article = $_POST['id_article'];

    // Récupérer le nom de l'image avant de supprimer l'article
    $result = mysqli_query($con, "SELECT image FROM articles WHERE id_article='$id_article'");
    if ($result && $row = mysqli_fetch_array($result)) {
        $image = $row['image'];
        $imagePath = "../" . $image;
        if (file_exists($imagePath)) {
            deleteFile($imagePath);
        }
    }

    mysqli_query($con, "DELETE FROM articles WHERE id_article='$id_article'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Publication supprimée avec succès !';
    header("location: ../nouvelle_publication");
}
if (isset($_POST['addCategorie'])) {

    $type =mysqli_real_escape_string($con, $_POST['type']);

    // $couleur = $_POST['couleur'];
    // $description = mysqli_real_escape_string($con, $_POST['description']);

    $id_categorie = 0;
    $lastIdCategorie = 0;
    $reqLastCategorie = $con->query("SELECT MAX(code_cat) as lastcode_cat FROM categories");

    while ($row = mysqli_fetch_array($reqLastCategorie)) {
        if ($row['lastcode_cat'] == 0) {
            $code_cat = 1001;
        } else {
            $code_cat = $row['lastcode_cat'] + 1;
        }
    }

    $verifDoublon = mysqli_query($con, "SELECT * FROM categories where type='$type'");

    if (mysqli_num_rows($verifDoublon) > 0) {
        $_SESSION['successMsg'] = false;
        $_SESSION['errorMsg'] = true;
        $_SESSION['message'] = 'Une catégorie porte déjà ce nom';
        header("location: ../categories");
    } else {
        mysqli_query($con, "INSERT INTO `categories` ( `code_cat`, `type`)
        VALUES ( '$code_cat','$type');");

        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = 'Catégorie ajoutée avec succès !';
        header("location: ../categories");
    }
}

if (isset($_POST['editCategorie'])) {
    $code_cat = $_POST['code_cat'];
    $type = $_POST['type'];
    // $type = $_POST['types']; 
    // $description = mysqli_real_escape_string($con, $_POST['description']);

    mysqli_query($con, "UPDATE `categories` SET type='$type'  WHERE code_cat='$code_cat'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Catégorie mise à jour avec succès !';
    header("location: ../categories");
}

if (isset($_POST['deleteCategorie'])) {

    $code_cat = $_POST['code_cat'];

    mysqli_query($con, "DELETE FROM categories WHERE code_cat='$code_cat'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Catégorie supprimée avec succès !';
    header("location: ../categories");
}

// Changer le statut de l'utilisateur
if (isset($_GET['toggleStatus'])) {
    $id = $_GET['toggleStatus'];
    $reqStatus = $con->query("SELECT statut FROM users WHERE id='$id'");
    if ($row = mysqli_fetch_array($reqStatus)) {

        $newStatus = $row['statut'] == 1 ? 0 : 1;
        $con->query("UPDATE users SET statut='$newStatus' WHERE id='$id'");
    }
    $etat = $newStatus == 1 ? 'activé' : 'désactivé';

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "L'utilisateur a été $etat avec succès";
    header('Location: ../utilisateurs');
}

if (isset($_POST['cancel'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
