<?php
include '../config/config.php';
include '../includes/bdd.php';

if (isset($_POST['btn_add_categorie'])) {
    // var_dump($_POST, $_FILES);
    // die;
    $libelle = htmlentities($_POST['libelle']);

    $sql = "INSERT INTO categorie VALUES (NULL, :libelle)";
    $requete = $bdd->prepare($sql);
    $data = [
        ':libelle' => $libelle
    ];

    if (!$requete->execute($data)) {
        // $_SESSION['error_add_categorie'] = true;
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_add_categorie'] = true;
        header('location:add.php');
        die;
    } else {
        $_SESSION['error_add_categorie'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_POST['btn_update_categorie'])) {
    // var_dump($_POST);
    // die;
    $id = intval($_POST['id']);
    $libelle = htmlentities($_POST['libelle']);

    $sql = 'UPDATE categorie SET libelle = :libelle WHERE id = :id LIMIT 1';
    // var_dump($sql);
    //rajout de LIMIT 1 voir si ça fonctionne
    $requete = $bdd->prepare($sql);
    
    $data = [
        ':libelle' => $libelle,
        ':id' => $id
    ]; // faire plutôt $data = [] pour le tableau au lieu de array()

    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_update_categorie'] = true;
        header('location:update.php?id=' . $id);
        die;
    } else {
        $_SESSION['error_update_categorie'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_GET['id'])) {

    $id = intval(($_GET['id']));
    // var_dump($_GET);

    if ($id > 0) {
        $sql = 'DELETE FROM categorie WHERE id = :id LIMIT 1';
        $requete = $bdd->prepare($sql);
        if (!$requete->execute(array(':id' => $id))) {
            $_SESSION['error_delete_categorie'] = true;
            header('location:index.php');
            die;
        } else {
            $_SESSION['error_delete_categorie'] = false;
            header('location:index.php');
            die;
        }
    }
}
