<?php
// include '../config/config.php';
// include '../includes/bdd.php';
include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
include '../includes/bdd.php';

if(isset($_POST['btn_add_livre'])){
    // var_dump($_POST, $_FILES);
    // die;
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    // $illustration = htmlentities($_POST['illustration']);
    $illustration = $_FILES['illustration']['name'];
    $resume = $_POST['resume']; 
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $date_achat = htmlentities($_POST['date_achat']);
    $disponibilite = 0;

    //Gestion illustration
    $dossier_temporaire = $_FILES['illustration']['tmp_name'];
    $dossier_destination = PATH_ADMIN . 'img/illustration/' . $illustration;

    if(!move_uploaded_file($dossier_temporaire, $dossier_destination)){
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');

    $sql = "INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resume, :prix, :nb_pages, :date_achat, :disponibilite)";
    

    $requete = $bdd->prepare($sql);
  

    $data = array(
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':date_achat' => $date_achat,
        ':disponibilite' => $disponibilite
    );


        
    if (!$requete->execute($data)){
        
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_add_livre'] = true;
        header('location:add.php');
        die;

    }
    //gestion catégories
    //recupérer catégorie livre + id livre
    $id_livre = $bdd->lastInsertId();
    // var_dump($id_livre);
    foreach ($_POST['categorie'] as $id_categorie) {
        $sql_cat ='INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)';
        $requete = $bdd->prepare($sql_cat);
        $data = [
            ':id_categorie' => $id_categorie,
            ':id_livre' => $id_livre
        ];
        if (!$requete->execute($data)) {
            //erreur
             header('location:add.php');
            die;
        }
    }
        $_SESSION['error_add_livre'] = false;
        header('location:index.php');
        die;
    }   
        
    // gestion auteurs
    // recupérer auteur livre + id livre
    // $id_livre = $bdd->lastInsertId();
    // var_dump($id_livre);
    foreach ($_POST['auteur'] as $id_auteur) {
        $sql_aut ='INSERT INTO auteur_livre VALUES (:id_auteur, :id_livre)';
        $requete = $bdd->prepare($sql_aut);
        $data = [
            ':id_auteur' => $id_auteur,
            ':id_livre' => $id_livre
        ];
        if (!$requete->execute($data)) {
            // var_dump($requete->errorInfo());
            // die;
            header('location:add.php');
            die;
        }
    }
        
        $_SESSION['error_add_livre'] = false;
            header('location:index.php');
            die;
               
        }
    }


}

if (isset($_POST['btn_update_livre'])) {
    // var_dump($_POST);
    $id = intval($_POST['id']);
    if ($id <= 0) {
        // erreur
        header('location:index.php');
        die;
    }
    
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    // $illustration = $_FILES['illustration']['name'];
    $resume = htmlentities($_POST['resume']); 
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $date_achat =htmlentities($_POST['date_achat']);
    $categories = $_POST['categorie'];
    // var_dump($categorie);
    // die;
    $disponibilite = 0;
    // $disponibilite = boolval($_POST['disponibilte']); si il y a un input disponibilité

    if(!empty($_FILES['illustration']['name'])){
        //si l'utilisateur souhaite changer l'illustration
        //on enregistre le nom de l'illustration
        $illustration = $_FILES['illustration']['name'];
        $sql = 'SELECT illustration FROM livre WHERE id = ?';
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        $hold_illustration = $requete->fetch(PDO::FETCH_ASSOC);
        $hold_illustration = $hold_illustration['illustration'];
        $chemin_hold_illustration = PATH_ADMIN . 'img/illustration/' . $hold_illustration;
        
        //gestion de l'ancienne illustration
        if (!is_file($chemin_hold_illustration)){
            //erreur le fichier n'existe pas dans le dossier
            header('location:update.php?id=' . $id);
            die;
        }else{
        // si il existe alors on supprime l'ancienne illustration
            if (!unlink($chemin_hold_illustration)){
                // erreur dans la suppresion de l'illustration
                //si il existe alors on supprime l'ancienne illustration
                header('location:update.php?id=' . $id);
                die;
            }
        }

        //gestion de la nouvelle illustration
        //on enregistre l'endroit où le fichier est à récupérer
        $dossier_temporaire = $_FILES['illustration']['tmp_name'];
        //on enregistre l'endroit de destination
        $dossier_destination = PATH_ADMIN . 'img/illustration/' . $illustration;

        if(!move_uploaded_file($dossier_temporaire, $dossier_destination)){
            //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
            $_SESSION['error_update_illustration'] = true;
            header('location:add.php');
            die;
        }
        // die('ok, bien copier/coller');

        $sql = 'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, illustration = :illustration, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat, disponibilite = :disponibilite WHERE id = :id LIMIT 1';
        // var_dump($sql);
        //rajout de LIMIT 1 voir si ça fonctionne
        //num_ISBN (le nom bdd) = :num_ISBN
        $data = [
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':illustration' => $illustration,
            ':resume' => $resume,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':disponibilite' => $disponibilite,
            ':id' => $id
        ];
    }else{
        $sql = 'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat, disponibilite = :disponibilite WHERE id = :id LIMIT 1';
        $data = [
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':resume' => $resume,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':disponibilite' => $disponibilite,
            ':id' => $id
        ]; 
    }
    $requete = $bdd->prepare($sql);
    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        $_SESSION['error_update_livre'] = true;
        $_SESSION['error_form'] = $_POST;
        header('location:update.php?id=' . $id);
        die;
    }

    //Traitement des categories
    $sql = "DELETE FROM categorie_livre WHERE id_livre = ?";
    $requete = $bdd->prepare($sql);
    if(!$requete->execute([$id])){
        //erreur dans la suppression en bdd
        header('location:update.php?id=' . $id);
        die;
    }
    foreach ($categories as $id_categorie) {
        $sql = "INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)";
        $data = [
            ':id_categorie' => $id_categorie,
            ':id_livre' => $id
        ];
        $requete = $bdd->prepare($sql);
        if(!$requete->execute($data)) {
            // erreur
            header('location:update.php?id=' . $id);
            die;
        }
    }
    
        $_SESSION['error_update_livre'] = false;
        header('location:index.php');
        die;
}
    
    






if (isset($_GET['id'])) {

        $id = intval(($_GET['id']));
        
        if ($id <= 0) {
            // erreur id incorrect
            $_SESSION['error_delete_livre'] = true;
            header('location:index.php');
            die;
        }
        // pour supprimer un livre on doit gérer l'illustration
        // on récupère le nom de l'utilisateur à supprimer
        $sql = "SELECT illustration FROM livre WHERE id = ? LIMIT 1";
        $requete = $bdd->prepare($sql);
        $requete->execute[($id)];
        $nom_illustration = $requete->fetch(PDO::FETCH_ASSOC);
        // on stock le nom de l'image apres avoir recuperer l'information en bdd
        $nom_illustration = $nom_illustration['illustration'];
        // on vérifie que l'image existe
        $chemin_illustration = PATH_ADMIN . 'img/illustration/' . $nom_illustration;
        if (!is_file($chemin_illustration)){
            // erreur l'illustration n'existe pas
            $_SESSION['error_delete_illustration'] = true;
       header('location:index.php'); 
       die;
       }
       if (!unlink($chemin_illustration)){
        // erreur l'illustration n'est pas supprimée
        $_SESSION['error_delete_illustration'] = true;
        header('location:index.php');
        die;
        }
        // on supprime le livre en BDD
        $sql = "DELETE FROM livre WHERE id = ?";
        $req = $bdd->prepare($sql);
        if (!$req->execute([$id])){
        // erreur le livre n'est pas supprimée
        $_SESSION['error_delete_livre'] = true;
        header('location:index.php');
        die;
    }
    $_SESSION['error_delete_livre'] = false;
    // le livre est bien supprimée
    header('location:index.php');
    die;
}

            
           
          