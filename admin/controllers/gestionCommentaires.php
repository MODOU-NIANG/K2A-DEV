<?php
include ('../config/app.php'); 
// include '../config/req.php';

if (isset($_POST['envoyerCommentaire'])) {
    $id_article=$_POST['publier'];
    $pseudo=$_POST['pseudo'];
    $email=$_POST['email'];
    $commentaire=$_POST['commentaire'];

    echo $id_article.'</br>';
    echo $pseudo.'</br>';

    echo $email.'</br>';
    echo $commentaire.'</br>';


   
    // // Insertion dans la table publications
    // mysqli_query($con, "INSERT INTO publications (id_article, titre, id_categorie, contenu, image, date_creation, date_publication, id_auteur) 
    //     VALUES ('$id_article_el','$titre','$id_categorie','$contenu','$image', '$date_creation', '$dateDuJour', '$auteur')"); 

    // // Suppression de la table en attente 
    // mysqli_query($con, "DELETE FROM publications_ea where id_article='$id_article'");

    // $_SESSION['successMsg'] = true;        
    // $_SESSION['message'] ='Article publié avec succès sur le site public !'; 
    // header ("location: ../publication_en_ligne.php");

}
