<?php
include('../config/app.php');

if (isset($_POST['addCompte'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $role_id = $_POST['role_id'];
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    $mdp1 = stripslashes($pwd1);
    $mdp1 = mysqli_real_escape_string($con, $mdp1);
    $mdp2 = stripslashes($pwd2);
    $mdp2 = mysqli_real_escape_string($con, $mdp2);
    $pwdH = hash('sha256', $mdp1);

    if ($mdp1 != $mdp2) {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Les mots de passe doivent être identiques ! ";
        header('Location: ../utilisateurs.php');
    } else {
        mysqli_query($con, "INSERT INTO users (prenom, nom, email, password, role_id, date_c) VALUES ('$prenom', '$nom', '$email', '$pwdH', '$role_id', '$dateDuJour')");

        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Utilisateur créé avec succès !";
        header('Location: ../utilisateurs.php');
    }
}

if (isset($_POST['editCompte'])) {
    $prenom = $_POST['prenom'];
    $id_users = $_POST['id_users'];
    $nom = $_POST['nom'];
    $role_id = $_POST['role_id'];
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    if (!empty($pwd1) && !empty($pwd2)) {
        $mdp1 = stripslashes($pwd1);
        $mdp1 = mysqli_real_escape_string($con, $mdp1);
        $mdp2 = stripslashes($pwd2);
        $mdp2 = mysqli_real_escape_string($con, $mdp2);

        if ($mdp1 != $mdp2) {
            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Les mots de passe doivent être identiques !";
            header('Location: ../utilisateurs.php');
            exit();
        } else {
            $pwdH = hash('sha256', $mdp1);
            mysqli_query($con, "UPDATE users SET prenom='$prenom', nom='$nom', email='$email', password='$pwdH', role_id='$role_id' WHERE id='$id_users'");
        }
    } else {
        mysqli_query($con, "UPDATE users SET prenom='$prenom', nom='$nom', email='$email', role_id='$role_id' WHERE id='$id_users'");
    }

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Utilisateur modifié avec succès !";
    header('Location: ../utilisateurs.php');
}


if (isset($_POST['deleteCompte'])) {
    $id_users = $_POST['id_users'];

    mysqli_query($con, "DELETE FROM users WHERE id='$id_users'");

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Utilisateur supprimé avec succès !";
    header('Location: ../utilisateurs.php');
}
