<?php
include 'config/config.php';
include 'includes/bdd.php';


if (isset($_POST['btn_connect'])) {
    // include 'config/config.php';
    // include 'includes/bdd.php';

    //TRAITEMENT DES DONNEES
    $mail = htmlentities($_POST['mail']);
    $mot_de_passe = htmlentities($_POST['mot_de_passe']);


    //SELECTION  UTILISATEUR BDD
    // $sql = "SELECT * FROM utilisateur WHERE mail = :mail OR pseudo = :pseudo";
    // $sql = "SELECT * FROM utilisateur WHERE mail = :mail";
    $sql = "SELECT * FROM utilisateur WHERE mail = ?";
    $requete = $bdd->prepare($sql);
    $requete->execute([$mail]);
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);


    if (!$utilisateur) {
        //erreur utilisateur inconnu
        $_SESSION['connect'] = false;
        header('location:login.php');
        die;
    }

    if (!password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        //erreur utilisateur existe mais mauvais mot_de_passe
        $_SESSION['connect'] = false;
        header('location:login.php');
        die;
    }



    unset($utilisateur['mot_de_passe']);
    $_SESSION['utilisateur'] = $utilisateur;
    $_SESSION['date_connect'] = new DateTime();
    // $_SESSION['utilisateur']['roles'] = checkRoles($utilisateur['id'], $bdd);
    checkRoles($utilisateur['id'], $bdd);
    $_SESSION['connect'] = true;
    header('location:index.php');
    die;
}

if (isset($_GET['connect']) && ($_GET['connect']) == "false") {
    $_SESSION = [];
    header('location:../index.php');
    // header('location:' . PATH_ADMIN . 'index.php');
    die;
}
