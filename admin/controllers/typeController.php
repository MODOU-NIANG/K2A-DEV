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

if (isset($_POST['addType'])) {
  $titre = mysqli_real_escape_string($con, $_POST['titre']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $sous_titre = mysqli_real_escape_string($con, $_POST['sous_titre']);

  // Génération du code type unique
  $getLastCodeType = mysqli_query($con, "SELECT MAX(code_type) AS lastCode FROM `types`");
  $rowCode = mysqli_fetch_array($getLastCodeType);
  $lastCode = $rowCode['lastCode'];
  $code_type = $lastCode ? $lastCode + 1 : 200;

  if ($_FILES['image']['error'] == 4) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "L'image est obligatoire !";
    header("location: ../types");
    exit();
  }

  if ($_FILES['image']['error'] == 1) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "L'image est trop grande !";
    header("location: ../types");
    exit();
  }

  $directoryPath = "../documentheques/" . $code_type;
  createDirectory($directoryPath);
  $nom_image = $_FILES['image']['name'];
  $m = $directoryPath . "/" . $nom_image;
  $uploadFileStatus = move_uploaded_file($_FILES['image']['tmp_name'], $m);

  if (!$uploadFileStatus) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Fichier non téléchargé !";
    header("location: ../types");
    exit();
  }

  $url_image = "documentheques/" . $code_type . "/" . $nom_image;

  // Gérer l'image pour la carte
  if (!empty($_FILES['image_card']['name'])) {
    $fileExtensionImageCard = pathinfo($_FILES['image_card']['name'], PATHINFO_EXTENSION);
    $nom_image_card = $code_type . '_' . round(microtime(true) * 1000) . '.' . $fileExtensionImageCard;
    $imageCardPath = $directoryPath . "/" . $nom_image_card;
    $uploadImageCardStatus = move_uploaded_file($_FILES['image_card']['tmp_name'], $imageCardPath);

    if (!$uploadImageCardStatus) {
      $_SESSION['errorMsg'] = true;
      $_SESSION['message'] = "Image pour la carte non téléchargée !";
      header("location: ../types");
      exit();
    }

    $url_image_card = "documentheques/" . $code_type . "/" . $nom_image_card;
  } else {
    $url_image_card = '';
  }

  $insertType = mysqli_query($con, "INSERT INTO `types` (`code_type`, `titre`, `description`, `image`, `sous_titre`, `image_card`) VALUES ('$code_type', '$titre', '$description', '$url_image', '$sous_titre', '$url_image_card')");

  if ($insertType) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Type créé avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de l'insertion du type : " . mysqli_error($con);
  }

  header("location: ../types");
  exit();
}

if (isset($_POST['editType'])) {
  $id_type = $_POST['id_type'];
  $titre = mysqli_real_escape_string($con, $_POST['titre']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $sous_titre = mysqli_real_escape_string($con, $_POST['sous_titre']);
  $code_type = $_POST['code_type'];

  $existingType = mysqli_query($con, "SELECT `image`, `image_card` FROM `types` WHERE `id`='$id_type'");
  $row = mysqli_fetch_array($existingType);
  $existingFilePath = "../" . $row['image'];
  $existingImageCardPath = "../" . $row['image_card'];

  $directoryPath = "../documentheques/" . $code_type;
  if (!empty($_FILES['image']['name'])) {
    if ($_FILES['image']['error'] == 1) {
      $_SESSION['errorMsg'] = true;
      $_SESSION['message'] = "L'image est trop grande !";
      header("location: ../types");
      exit();
    }

    createDirectory($directoryPath);
    $nom_image = $_FILES['image']['name'];
    $m = $directoryPath . "/" . $nom_image;
    $uploadFileStatus = move_uploaded_file($_FILES['image']['tmp_name'], $m);

    if (!$uploadFileStatus) {
      $_SESSION['errorMsg'] = true;
      $_SESSION['message'] = "Fichier non téléchargé !";
      header("location: ../types");
      exit();
    }

    $url_image = "documentheques/" . $code_type . "/" . $nom_image;
    $query = "UPDATE `types` SET `titre`='$titre', `description`='$description', `image`='$url_image', `sous_titre`='$sous_titre' ";

    // Supprimer l'ancienne image
    deleteFile($existingFilePath);
  } else {
    $query = "UPDATE `types` SET `titre`='$titre', `description`='$description', `sous_titre`='$sous_titre' ";
  }

  // Gérer l'image pour la carte
  if (!empty($_FILES['image_card']['name'])) {
    createDirectory($directoryPath);
    $fileExtensionImageCard = pathinfo($_FILES['image_card']['name'], PATHINFO_EXTENSION);
    $nom_image_card = $code_type . '_' . round(microtime(true) * 1000) . '.' . $fileExtensionImageCard;
    $imageCardPath = $directoryPath . "/" . $nom_image_card;
    $uploadImageCardStatus = move_uploaded_file($_FILES['image_card']['tmp_name'], $imageCardPath);
    if (!$uploadImageCardStatus) {
      $_SESSION['errorMsg'] = true;
      $_SESSION['message'] = "Image pour la carte non téléchargée !";
      header("location: ../types");
      exit();
    }

    $url_image_card = "documentheques/" . $code_type . "/" . $nom_image_card;
    $query .= ", `image_card`='$url_image_card'";

    // Supprimer l'ancienne image pour la carte
    deleteFile($existingImageCardPath);
  }

  $query .= " WHERE `id`='$id_type'";

  $result = mysqli_query($con, $query);

  if ($result) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Type modifié avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la mise à jour du type : " . mysqli_error($con);
  }

  header("location: ../types");
  exit();
}

if (isset($_POST['deleteType'])) {
  $id_type = $_POST['id_type'];
  $existingType = mysqli_query($con, "SELECT `image`, `image_card` FROM `types` WHERE `id`='$id_type'");
  $row = mysqli_fetch_array($existingType);
  $existingFilePath = "../" . $row['image'];
  $existingImageCardPath = "../" . $row['image_card'];

  $query = "DELETE FROM `types` WHERE `id`='$id_type'";
  $result = mysqli_query($con, $query);

  if ($result) {
    // Supprimer l'image correspondante
    deleteFile($existingFilePath);
    deleteFile($existingImageCardPath);

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Type supprimé avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la suppression du type : " . mysqli_error($con);
  }

  header("location: ../types");
  exit();
}
