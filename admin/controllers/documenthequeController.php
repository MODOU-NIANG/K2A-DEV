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

if (isset($_POST['addDocument'])) {

  $titre = mysqli_real_escape_string($con, $_POST['titre']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $code_type = mysqli_real_escape_string($con, $_POST['code_type']);

  if (empty($_FILES['lien']['name'])) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Le lien est obligatoire !";
    header("location: ../documents");
    exit();
  }

  $directoryPath = "../documentheques/" . $code_type;
  createDirectory($directoryPath);
  $timestamp = round(microtime(true) * 1000);
  $fileExtension = pathinfo($_FILES['lien']['name'], PATHINFO_EXTENSION);
  $nom_document = $code_type . '_' . $timestamp . '.' . $fileExtension;
  $m = $directoryPath . "/" . $nom_document;
  $uploadFileStatus = move_uploaded_file($_FILES['lien']['tmp_name'], $m);

  if (!$uploadFileStatus) {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Fichier non téléchargé !";
    header("location: ../documents");
    exit();
  }

  $url_document = "documentheques/" . $code_type . "/" . $nom_document;
  $insertDocument = mysqli_query($con, "INSERT INTO `documentheques` (`code_type`, `titre`, `description`, `lien`) VALUES ('$code_type', '$titre', '$description', '$url_document')");

  if ($insertDocument) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Document créé avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de l'insertion du document : " . mysqli_error($con);
  }

  header("location: ../documents");
  exit();
}

if (isset($_POST['editDocument'])) {
  $id_document = $_POST['id_document'];
  $titre = mysqli_real_escape_string($con, $_POST['titre']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $code_type = mysqli_real_escape_string($con, $_POST['code_type']);

  $existingDocument = mysqli_query($con, "SELECT `lien` FROM `documentheques` WHERE `id`='$id_document'");
  $row = mysqli_fetch_array($existingDocument);
  $existingFilePath = "../" . $row['lien'];

  if (!empty($_FILES['lien']['name'])) {
    $directoryPath = "../documentheques/" . $code_type;
    createDirectory($directoryPath);
    $timestamp = round(microtime(true) * 1000);
    $fileExtension = pathinfo($_FILES['lien']['name'], PATHINFO_EXTENSION);
    $nom_document = $code_type . '_' . $timestamp . '.' . $fileExtension;
    $m = $directoryPath . "/" . $nom_document;
    $uploadFileStatus = move_uploaded_file($_FILES['lien']['tmp_name'], $m);

    if (!$uploadFileStatus) {
      $_SESSION['errorMsg'] = true;
      $_SESSION['message'] = "Fichier non téléchargé !";
      header("location: ../documents");
      exit();
    }

    $url_document = "documentheques/" . $code_type . "/" . $nom_document;
    $query = "UPDATE `documentheques` SET `titre`='$titre', `description`='$description', `lien`='$url_document', `code_type`='$code_type' WHERE `id`='$id_document'";

    // Supprimer l'ancien fichier
    deleteFile($existingFilePath);
  } else {
    $query = "UPDATE `documentheques` SET `titre`='$titre', `description`='$description', `code_type`='$code_type' WHERE `id`='$id_document'";
  }

  $result = mysqli_query($con, $query);

  if ($result) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Document modifié avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la mise à jour du document : " . mysqli_error($con);
  }

  header("location: ../documents");
  exit();
}

if (isset($_POST['deleteDocument'])) {
  $id_document = $_POST['id_document'];
  $existingDocument = mysqli_query($con, "SELECT `lien` FROM `documentheques` WHERE `id`='$id_document'");
  $row = mysqli_fetch_array($existingDocument);
  $existingFilePath = "../" . $row['lien'];

  $query = "DELETE FROM `documentheques` WHERE `id`='$id_document'";
  $result = mysqli_query($con, $query);

  if ($result) {
    // Supprimer le fichier correspondant
    deleteFile($existingFilePath);

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Document supprimé avec succès !';
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la suppression du document : " . mysqli_error($con);
  }

  header("location: ../documents");
  exit();
}
