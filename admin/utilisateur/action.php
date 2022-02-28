<?php

// include '../config/config.php';
// include '../includes/bdd.php';

include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
//accessible si seulement administrateur
if (!isAdmin()) {
    header('location:' . URL_ADMIN .'index.php');
    die;
}

include '../includes/bdd.php';
// include PATH_ADMIN . 'includes/bdd.php';

if (isset($_POST['btn_add_utilisateur'])) {
    // var_dump($_POST, $_FILES);
    // die;
    // var_dump(password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT));
    // die;
    // echo password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    //hashage du mot de passe
    // $hash = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    //password_verify renvoie un booleen et nous dit que ce qu'on reçoit en mot de passe correspond à la chaîne de caractères (hashage)
    // var_dump(password_verify($_POST['mot_de_passe'], $hash));
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $pseudo = htmlentities($_POST['pseudo']);
    $mail = htmlentities($_POST['mail']);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $num_telephone = htmlentities($_POST['num_telephone']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $avatar = $_FILES['avatar']['name'];
    $roles = $_POST['role'];

    $dossier_temporaire = $_FILES['avatar']['tmp_name'];
    $dossier_destination = PATH_ADMIN . 'img/avatar/' . $avatar;
    // if ($_FILES['avatar']['size'] > 20000) {
    //     # code...
    // }

    if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');

    //gestion bdd

    $sql = "INSERT INTO utilisateur VALUES (NULL, :nom, :prenom, :pseudo, :mail, :mot_de_passe, :num_telephone, :avatar, :adresse, :ville, :code_postal)";
    $requete = $bdd->prepare($sql);
    $data = [
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":pseudo" => $pseudo,
        ":mail" => $mail,
        ":mot_de_passe" => $mot_de_passe,
        ":num_telephone" => $num_telephone,
        ":avatar" => $avatar,
        ":adresse" => $adresse,
        ":ville" => $ville,
        ":code_postal" => $code_postal
    ];

    if (!$requete->execute($data)) {
        //si renvoie faux erreur ajout bdd
        // var_dump($requete->errorInfo());
        // die;
        $_SESSION['error_add_utilisateur'] = true;
        header('location:add.php');
        die;
    }

    //gestion roles
    //recupérer role utilisateur + id utilisateur
    $id_utilisateur = $bdd->lastInsertId();
    // var_dump($id_utilisateur);
    foreach ($_POST['role'] as $id_role) {
        $sql ='INSERT INTO role_utilisateur VALUES (:id_role, :id_utilisateur)';
        $requete = $bdd->prepare($sql);
        $data = [
            ':id_role' => $id_role,
            ':id_utilisateur' => $id_utilisateur
        ];
        if (!$requete->execute($data)) {
            //erreur
             header('location:add.php');
            die;
        }
    }
        $_SESSION['error_add_utilisateur'] = false;
        header('location:index.php');
        die;
     
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    if($id <= 0){
        //erreur
        header('location:index.php');
        die;
    }

    $sql = "DELETE FROM role_utilisateur WHERE id_utilisateur = ?";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur
            $_SESSION['error_delete_utilisateur'] = true;
            header('location:index.php');
            die;
        }

    $sql = "SELECT avatar FROM utilisateur WHERE id = ?";
    $requete = $bdd->prepare($sql);
    $requete->execute([$id]);
    $nom_avatar = $requete->fetch(PDO::FETCH_ASSOC);
    $nom_avatar = $nom_avatar['avatar'];
    $dossier_avatar = PATH_ADMIN . 'img/avatar/' . $nom_avatar;
    if (!is_file($dossier_avatar)){
        //erreur l'avatar n'existe pas ou plus dans le dossier
        header('location:index.php');
        die;
    }
    // die('ok bien un fichier');
    if (!unlink($dossier_avatar)){
        //erreur l'avatar est impossible à supprimer
        header('location:index.php');
        die;
    }
    $sql = "DELETE FROM utilisateur WHERE id = ?";
    $requete = $bdd->prepare($sql);
    if (!$requete->execute([$id])) {
        //erreur dans la suppression en bdd
        header('location:index.php');
        die;
    }
    $_SESSION['error_delete_utilisateur'] = false;
    // le livre est bien supprimée
    header('location:index.php');
    die;
    
}

if (isset($_POST['btn_update_utilisateur'])) {
    // var_dump($_POST);
    // die;
    $id = intval($_POST['id']);
    if ($id <= 0) {
        header('location:index.php');
        die;
    }
    // $id = intval($_POST['id']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $pseudo = htmlentities($_POST['pseudo']);
    $mail = htmlentities($_POST['mail']);
    // $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $num_telephone = htmlentities($_POST['num_telephone']);
    // $avatar = $_FILES['avatar']['name'];
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $roles = $_POST['role'];
    // var_dump($roles);
    // die;

    if(!empty($_FILES['avatar']['name'])){
        //si l'utilisateur souhaite changer l'illustration
        //on enregistre le nom de l'illustration
        $avatar = $_FILES['avatar']['name'];
        $sql = 'SELECT avatar FROM utilisateur WHERE id = ?';
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        $dossier_avatar = $requete->fetch(PDO::FETCH_ASSOC);
        $dossier_avatar = $dossier_avatar['avatar'];
        $chemin_dossier_avatar = PATH_ADMIN . 'img/avatar/' . $dossier_avatar;
        
        //gestion de l'ancienne avatar
        if (!is_file($chemin_dossier_avatar)){
            //erreur le fichier n'existe pas dans le dossier
            header('location:update.php?id=' . $id);
            die;
        }else{
        // si il existe alors on supprime l'ancienne avatar
            if (!unlink($chemin_dossier_avatar)){
                // erreur dans la suppresion de l'avatar
                //si il existe alors on supprime l'ancienne avatar
                header('location:update.php?id=' . $id);
                die;
            }
        }

    $dossier_temporaire = $_FILES['avatar']['tmp_name'];
    $dossier_destination = PATH_ADMIN . 'img/avatar/' . $avatar;
    // if ($_FILES['avatar']['size'] > 20000) {
    //     # code...
    // }

    if (!move_uploaded_file($dossier_temporaire, $dossier_destination)) {
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');


    $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, avatar = :avatar, adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id = :id';
    

    $data = [
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":pseudo" => $pseudo,
        ":mail" => $mail,
        // ":mot_de_passe" => $mot_de_passe,
        ":num_telephone" => $num_telephone,
        ":avatar" => $avatar,
        ":adresse" => $adresse,
        ":ville" => $ville,
        ":code_postal" => $code_postal,
        ":id" => $id
    ];
}else{
    $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id = :id';

    $data = [
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":pseudo" => $pseudo,
        ":mail" => $mail,
        // ":mot_de_passe" => $mot_de_passe,
        ":num_telephone" => $num_telephone,
        // ":avatar" => $avatar,
        ":adresse" => $adresse,
        ":ville" => $ville,
        ":code_postal" => $code_postal,
        ":id" => $id
    ];

}

    $requete = $bdd->prepare($sql);
    
    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_update_utilisateur'] = true;
        $_SESSION['error_form'] = $_POST;
        header('location:update.php?id=' . $id);
        die;
    }

    //Traitement des roles
    $sql = "DELETE FROM role_utilisateur WHERE id_utilisateur = ? ";
    $requete = $bdd->prepare($sql);
    if(!$requete->execute([$id])){
        //erreur  suppresssion en bdd
        header('location:update.php?=id'. $id);
        die;
    }
    foreach ($roles as $id_role) {
        $sql = "INSERT INTO role_utilisateur VALUES (:id_role, :id_utilisateur)";
        $data = [
            ':id_role' => $id_role,
            ':id_utilisateur' => $id
        ];
        $requete = $bdd->prepare($sql);
        if(!$requete->execute($data)) {
            // erreur
            header('location:update.php?id=' . $id);
            die;
        }
    }




        // die('ok');
        $_SESSION['error_update_utilisateur'] = false;
        header('location:index.php');
        die;
    
}



