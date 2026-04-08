<?php
include('../config/app.php');

if (isset($_POST['creerCompte'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    //  récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $mdp1 = stripslashes($pwd1);
    $mdp1 = mysqli_real_escape_string($con, $mdp1);

    $mdp2 = stripslashes($pwd2);
    $mdp2 = mysqli_real_escape_string($con, $mdp2);

    //  echo $mdp1.'</br>' ;
    //  echo $mdp2.'</br>';

    $pwdH = hash('sha256', $mdp1);


    if ($mdp1 != $mdp2) {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Les mots de passe doivent être identiques ! ";
        header('Location: ../utilisateurs.php');
    } else {

        mysqli_query($con, "INSERT INTO users (prenom,nom,email, password, role,  date_c) 
        VALUES ('$prenom', '$nom', '$email', '$pwdH', '$role', '$dateDuJour')");

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
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    //  récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $mdp1 = stripslashes($pwd1);
    $mdp1 = mysqli_real_escape_string($con, $mdp1);

    $mdp2 = stripslashes($pwd2);
    $mdp2 = mysqli_real_escape_string($con, $mdp2);

    //  echo $mdp1.'</br>' ;
    //  echo $mdp2.'</br>';

    $pwdH = hash('sha256', $mdp1);


    if ($mdp1 != $mdp2) {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Les mots de passe doivent être identiques ! ";
        header('Location: ../utilisateurs.php');
    } else {

        mysqli_query($con, "UPDATE users SET prenom='$prenom', nom='$nom', email='$email' , password='$pwdH', role='$role', date_c='$dateDuJour' WHERE id='$id_users'");

        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Utilisateur modifié avec succès !";
        header('Location: ../utilisateurs.php');
    }
}

if (isset($_POST['deleteCompte'])) {

    $id_users = $_POST['id_users'];

    mysqli_query($con, "DELETE FROM users where id='$id_users'");

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Utilisateur modifié avec succès !";
    header('Location: ../utilisateurs.php');
}

if (isset($_POST['addRole'])) {

    $role = $_POST['role'];

    $id_role = 0;
    $lastIdrole = 0;
    $reqLastrole = $con->query("SELECT MAX(id_role) as lastIdrole FROM roles");

    while ($row = mysqli_fetch_array($reqLastrole)) {
        if ($row['lastIdrole'] == 0) {
            $id_role = 101;
        } else {
            $id_role = $row['lastIdrole'] + 1;
        }
    }

    $verifDoublon = mysqli_query($con, "SELECT * FROM roles where role='$role'");

    if (mysqli_num_rows($verifDoublon) > 0) {
        $_SESSION['successMsg'] = false;
        $_SESSION['errorMsg'] = true;
        $_SESSION['message'] = 'Ce rôle existe deja !';
        header("location: ../roles.php");
    } else {
        mysqli_query($con, "INSERT INTO `roles` (`id_role`, `role`) 
        VALUES ('$id_role', '$role');");

        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = 'Rôle ajouté avec succès !';
        header("location: ../roles.php");
    }
}

if (isset($_POST['editRole'])) {

    $id = $_POST['id'];
    $role = $_POST['role'];

    mysqli_query($con, "UPDATE `roles` SET role='$role'WHERE id='$id'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Rôle mise à jour avec succès !';
    header("location: ../roles.php");
}

if (isset($_POST['deleteRole'])) {

    $id = $_POST['id'];

    mysqli_query($con, "DELETE FROM roles WHERE id='$id'");

    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = 'Rôle supprimé avec succès !';
    header("location: ../roles.php");
}
