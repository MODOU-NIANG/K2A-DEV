<?php

include '../config/req.php';

// Couleurs - Top bar
if (isset($_POST['postCouleursTopBar'])) {
    $item='Top bar';
    $couleurTopBar= $_POST['topBar'];

    
    $reqVerif = mysqli_query($con, "SELECT * FROM couleurs where item='$item'");
   
    if (mysqli_num_rows($reqVerif) > 0) {

        mysqli_query($con, "UPDATE couleurs SET couleur='$couleurTopBar' where item='$item'");

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de la barre superieure modifiée avec success ! <a href="/" target="_blank">voir la page</a>'; 
        header ("location: ../couleurs.php");
    
    }
    else
    {

        mysqli_query($con, "INSERT INTO  couleurs (item, couleur) 
        VALUES ('$item', '$couleurTopBar')"); 

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de la barre superieure modifiée avec success ! <a href="/" target="_blank>voir la page</a> '; 
        header ("location: ../couleurs.php");
    }
}

// Couleurs - Fond Menu
if (isset($_POST['postCouleursFondMenu'])) {
    $item='Fond menu';
    $couleurFondMenu= $_POST['fondMenu'];

    
    $reqVerif = mysqli_query($con, "SELECT * FROM couleurs where item='$item'");
   
    if (mysqli_num_rows($reqVerif) > 0) {

        mysqli_query($con, "UPDATE couleurs SET couleur='$couleurFondMenu' where item='$item'");

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de fond du menu est modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    
    }
    else
    {

        mysqli_query($con, "INSERT INTO  couleurs (item, couleur) 
        VALUES ('$item', '$couleurFondMenu')"); 

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de fond du menu est modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    }
}

// Couleurs - Boutton En savoir plus
if (isset($_POST['postBtnEsp'])) {
    $item='Btn e.s.p';
    $couleurBtnEsp= $_POST['btnEsp'];

    
    $reqVerif = mysqli_query($con, "SELECT * FROM couleurs where item='$item'");
   
    if (mysqli_num_rows($reqVerif) > 0) {

        mysqli_query($con, "UPDATE couleurs SET couleur='$couleurBtnEsp' where item='$item'");

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur des bouttons "En savoir plus" est modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    
    }
    else
    {

        mysqli_query($con, "INSERT INTO  couleurs (item, couleur) 
        VALUES ('$item', '$couleurBtnEsp')"); 

        $_SESSION['successMsg'] = true;       
        $_SESSION['message'] = 'La couleur des bouttons "En savoir plus" modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    }
}


// Couleurs - Fond Principal
if (isset($_POST['postCouleursFondPrincipal'])) {
    $item='Fond principal';
    $couleurFondPrincipal= $_POST['fondPrincipal'];

    
    $reqVerif = mysqli_query($con, "SELECT * FROM couleurs where item='$item'");
   
    if (mysqli_num_rows($reqVerif) > 0) {

        mysqli_query($con, "UPDATE couleurs SET couleur='$couleurFondPrincipal' where item='$item'");

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de fond principal est modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    
    }
    else
    {

        mysqli_query($con, "INSERT INTO  couleurs (item, couleur) 
        VALUES ('$item', '$couleurFondPrincipal')"); 

        $_SESSION['successMsg'] = true;        
        $_SESSION['message'] = 'La couleur de fond principal est modifiée avec success ! <a href="/">voir la page</a>'; 
        header ("location: ../couleurs.php");
    }
}
?>