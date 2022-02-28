<?php
include '../config/config.php';
include '../includes/bdd.php';


if(isset($_POST['btn_add_usager'])) {
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);


$sql = "INSERT INTO usager VALUES (NULL, :nom, :prenom, :adresse, :ville, :code_postal, :mail)";

$requete = $bdd->prepare($sql);

$data = [

    ':nom' => $nom,
    ':prenom' => $prenom,
    ':adresse' => $adresse,
    ':ville' => $ville,
    ':code_postal' => $code_postal,
    ':mail' => $mail
];

if(!$requete->execute($data)){
    //erreur
    $_SESSION['error_add_usager'] = true;
    header('location:add.php');
}else{
    $_SESSION['error_add_usager'] = false;
    header('location:index.php');
}

}

i(isset($_POST['btn_update_usager'])) {
    $id = intval($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
}