<?php
include '../config/config.php';
include '../includes/bdd.php';

if (isset($_POST['btn_add_editeur'])) {
    // var_dump($_POST, $_FILES);
    // die;

    $denomination = htmlentities($_POST['denomination']);
    $siret = htmlentities($_POST['siret']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero_tel = htmlentities($_POST['numero_tel']);

    $sql = "INSERT INTO editeur VALUES (NULL, :denomination, :siret, :adresse, :ville, :code_postal, :mail, :numero_tel)";
    // var_dump($sql);

    $requete = $bdd->prepare($sql);
    // var_dump($requete);

    $data = [
        ':denomination' => $denomination,
        ':siret' => $siret,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':code_postal' => $code_postal,
        ':mail' => $mail,
        ':numero_tel' => $numero_tel
    ];

    // var_dump($data);

    if (!$requete->execute($data)) {
        $_SESSION['error_add_editeur'] = true;
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        header('location:add.php');
        die;
    } else {
        $_SESSION['error_add_editeur'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_POST['btn_update_editeur'])) {
    // var_dump($_POST);
    $id = intval($_POST['id']);
    $denomination = htmlentities($_POST['denomination']);
    $siret = htmlentities($_POST['siret']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero_tel = htmlentities($_POST['numero_tel']);


    $sql = 'UPDATE editeur SET denomination = :denomination, siret = :siret, adresse = :adresse, ville = :ville, code_postal = :code_postal, mail = :mail, numero_tel = :numero_tel WHERE id = :id LIMIT 1';
    // var_dump($sql);

    $requete = $bdd->prepare($sql);
    // var_dump($requete);

    $data = [
        ':denomination' => $denomination,
        ':siret' => $siret,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':code_postal' => $code_postal,
        ':mail' => $mail,
        ':numero_tel' => $numero_tel,
        ':id' => $id
    ]; // faire plutôt $data = [] pour le tableau au lieu de array()

    $requete = $bdd->prepare($sql);
    $requete->execute($data);

    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_update_editeur'] = true;
        header('location:update.php?id=' . $id);
        die;
    } else {
        $_SESSION['error_update_editeur'] = false;
        header('location:index.php');
        die;
    }
}

if (isset($_GET['id'])) {

    $id = intval(($_GET['id']));
    // var_dump($id);

    if ($id > 0) {
        $sql = 'DELETE FROM editeur WHERE id = ? LIMIT 1';
        $requete = $bdd->prepare($sql);
        if (!$requete->execute([$id])) {
            $_SESSION['error_delete_editeur'] = true;
            header('location:index.php');
            die;
        } else {
            $_SESSION['error_delete_editeur'] = false;
            header('location:index.php');
            die;
        }
    }
}
