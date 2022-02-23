<?php
include '../config/config.php';
include '../includes/bdd.php';

if (isset($_POST['btn_add_auteur'])) {
    // var_dump($_POST, $_FILES);
    // die;

    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $nom_de_plume = htmlentities($_POST['nom_de_plume']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero = htmlentities($_POST['numero']);
    $photo = htmlentities($_FILES['photo']['name']);


    $dossier_temporaire = $_FILES['photo']['tmp_name'];
    $dossier_destination = PATH_ADMIN . 'img/photo/' . $photo;

    if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');

    $sql = "INSERT INTO auteur VALUES (NULL, :nom, :prenom, :nom_de_plume, :adresse, :ville, :code_postal, :mail, :numero, :photo)";
    

    $requete = $bdd->prepare($sql);
   

    $data = array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':nom_de_plume' => $nom_de_plume,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':code_postal' => $code_postal,
        ':mail' => $mail,
        ':numero' => $numero,
        ':photo' => $photo
    );


    if (!$requete->execute($data)) {
        
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_add_auteur'] = true;
        header('location:add.php');
        die;
    } else {
        $_SESSION['error_add_auteur'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_POST['btn_update_auteur'])) {
    $id = intval($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $nom_de_plume = htmlentities($_POST['nom_de_plume']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero = htmlentities($_POST['numero']);
    $photo = $_FILES['photo']['name'];
    // var_dump($POST);
    // die;


    $dossier_temporaire = $_FILES['photo']['tmp_name'];
    // var_dump($dossier_temporaire);
    $dossier_destination = PATH_ADMIN . 'img/photo/' . $photo;

    if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');

    $sql = 'UPDATE auteur SET nom = :nom, prenom = :prenom, nom_de_plume = :nom_de_plume, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero = :numero, photo = :photo  WHERE id = :id LIMIT 1';
    var_dump($sql); //rajout de LIMIT 1 voir si ça fonctionne


    $requete = $bdd->prepare($sql);
 
    $data = array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':nom_de_plume' => $nom_de_plume,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':code_postal' => $code_postal,
        ':mail' => $mail,
        ':numero' => $numero,
        ':photo' => $photo,
        ':id' => $id
    ); // faire plutôt $data = [] pour le tableau au lieu de array()

    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_update_auteur'] = true;
        header('location:update.php?id=' . $id);
        die;
    } else {
        $_SESSION['error_update_auteur'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_GET['id'])) {

    $id = intval(($_GET['id']));
    // var_dump($id);
    // die;

    if ($id > 0) {
        $sql = 'DELETE FROM auteur WHERE id = :id LIMIT 1';
        $requete = $bdd->prepare($sql);

        if (!$requete->execute(array(':id' => $id))) {
            
            $_SESSION['error_delete_auteur'] = true;
            header('location:index.php');
            die;
        } else {
            $_SESSION['error_delete_auteur'] = true;
            header('location:index.php');
            die;
        }
    }
}
