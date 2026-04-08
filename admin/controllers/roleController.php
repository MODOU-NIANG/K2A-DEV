<?php
include('../config/app.php');

if (isset($_POST['addRole'])) {
  $role = $_POST['role'];

  $query = "INSERT INTO roles (role) VALUES ('$role')";
  $result = $con->query($query);

  if ($result) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Rôle ajouté avec succès!";
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de l'ajout du rôle.";
  }

  header('Location: ../roles.php');
  exit();
}

if (isset($_POST['editRole'])) {
  $id_role = $_POST['id_role'];
  $role = $_POST['role'];

  $query = "UPDATE roles SET role='$role' WHERE id='$id_role'";
  $result = $con->query($query);

  if ($result) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Rôle modifié avec succès!";
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la modification du rôle.";
  }

  header('Location: ../roles.php');
  exit();
}

if (isset($_POST['deleteRole'])) {
  $id_role = $_POST['id_role'];

  $query = "DELETE FROM roles WHERE id='$id_role'";
  $result = $con->query($query);

  if ($result) {
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Rôle supprimé avec succès!";
  } else {
    $_SESSION['errorMsg'] = true;
    $_SESSION['message'] = "Erreur lors de la suppression du rôle.";
  }

  header('Location: ../roles.php');
  exit();
}
