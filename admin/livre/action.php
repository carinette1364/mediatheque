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
    $categories = $_POST['categorie'];
    $auteurs = $_POST['auteur'];
    $etats = $_POST['etat'];
    $editeurs = $_POST['editeur'];
  

    //Gestion illustration (test githyb)
    $dossier_temporaire = $_FILES['illustration']['tmp_name'];
    $dossier_destination = PATH_ADMIN . 'img/illustration/' . $illustration;

    if(!move_uploaded_file($dossier_temporaire, $dossier_destination)){
        //!-> si cette fonction renvoie faux alors erreur dans le déplacement du fichier
        die('erreur dans le déplacement du fichier');
    }
    // die('ok, bien copier/coller');

    $sql = "INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resume, :prix, :nb_pages, :date_achat, :disponibilite)";
    

    $requete = $bdd->prepare($sql);
  

    $data = [
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resume' => $resume,
        ':prix' => $prix,
        ':nb_pages' => $nb_pages,
        ':date_achat' => $date_achat,
        ':disponibilite' => $disponibilite
    ];


        
    if (!$requete->execute($data)){
        //erreur dans l'ajout du livre
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
        $sql ='INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)';
        $requete = $bdd->prepare($sql);
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
        // $_SESSION['error_add_livre'] = false;
        // header('location:index.php');
        // die;

        
    // gestion auteurs
    // recupérer auteur livre + id livre
    // $id_livre = $bdd->lastInsertId();// ne pas remettre car déjà appelé plus haut
    // var_dump($id_livre);
    foreach ($_POST['auteur'] as $id_auteur) {
        $sql ='INSERT INTO auteur_livre VALUES (:id_auteur, :id_livre)';
        $requete = $bdd->prepare($sql);
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

    foreach ($_POST['editeur'] as $id_editeur) {
        $sql ="INSERT INTO editeur_livre VALUES (:id_editeur, :id_livre, NOW())";
        $requete = $bdd->prepare($sql);
        $data = [
            ':id_editeur' => $id_editeur,
            ':id_livre' => $id_livre
        ];
        if (!$requete->execute($data)) {
            // var_dump($requete->errorInfo());
            // die;
            header('location:add.php');
            die;
        }
        
    }
    
    foreach ($_POST['etat'] as $id_etat) {
        $sql ='INSERT INTO etat_livre VALUES (:id_livre, :id_etat)';
        $requete = $bdd->prepare($sql);
        $data = [
            
            ':id_livre' => $id_livre,
            ':id_etat' => $id_editeur
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

if (isset($_POST['btn_update_livre'])) {
    // var_dump($_POST);
    // die;
    
    $id = intval($_POST['id']);
    if ($id <= 0) {
        // erreur
        header('location:index.php');
        die;
    }
    
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    // $illustration = $_FILES['illustration']['name'];
    $resume = $_POST['resume']; 
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $date_achat =htmlentities($_POST['date_achat']);
    $categories = $_POST['categorie'];
    $auteurs = $_POST['auteur'];
    $etats = $_POST['etat'];
    $editeurs = $_POST['editeur'];
    
    
    
    $disponibilite = 0;
    // $disponibilite = boolval($_POST['disponibilte']); si il y a un input disponibilité
    //pour la modification on doit vérifier si l'utilisateur a ajouter une illustration, si il n'a pas changer l'image on doit chenger l'ancien nom
    if(!empty($_FILES['illustration']['name'])){
        //si l'utilisateur souhaite changer l'illustration
        //on enregistre le nom de l'illustration
        $illustration = $_FILES['illustration']['name'];
        $sql = 'SELECT illustration FROM livre WHERE id = ?';
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        $dossier_illustration = $requete->fetch(PDO::FETCH_ASSOC);
        $dossier_illustration = $dossier_illustration['illustration'];
        $chemin_dossier_illustration = PATH_ADMIN . 'img/illustration/' . $dossier_illustration;
        
        //gestion de l'ancienne illustration
        if (!is_file($chemin_dossier_illustration)){
            //erreur le fichier n'existe pas dans le dossier
            header('location:update.php?id=' . $id);
            die;
        }else{
        // si il existe alors on supprime l'ancienne illustration
            if (!unlink($chemin_dossier_illustration)){
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
        $sql = 'UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, resume = :resume, prix = :prix, nb_pages = :nb_pages, date_achat = :date_achat, disponibilite = :disponibilite WHERE id = :id';
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
    // var_dump($_POST, $_FILES, $data);
    // die;
    $requete = $bdd->prepare($sql);

    if (!$requete->execute($data)) {
        // $requete->errorInfo();
        // var_dump($requete->errorInfo());
        //ou var_dump(debugDumpParams);
        // die;
        // echo ("je suis là");
        //      die;
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
    
    // $_SESSION['error_update_livre'] = false;
    // header('location:index.php');
    // die;

     //Traitement des auteurs
     $sql = "DELETE FROM auteur_livre WHERE id_livre = ?";
     $requete = $bdd->prepare($sql);
     if(!$requete->execute([$id])){
         //erreur dans la suppression en bdd
         header('location:update.php?id=' . $id);
         die;
     }
     foreach ($auteurs as $id_auteur) {
         $sql = "INSERT INTO auteur_livre VALUES (:id_auteur, :id_livre)";
         $data = [
             ':id_auteur' => $id_auteur,
             ':id_livre' => $id
         ];
         $requete = $bdd->prepare($sql);
         if(!$requete->execute($data)) {
             // erreur
             
             header('location:update.php?id=' . $id);
             die;
         }
     }

    // $_SESSION['error_update_livre'] = false;
    // header('location:index.php');
    // die;

     //Traitement des editeurs
     $sql = "DELETE FROM editeur_livre WHERE id_livre = ?";
     $requete = $bdd->prepare($sql);
     if(!$requete->execute([$id])){
         //erreur dans la suppression en bdd
        //  echo ("je suis là");
        //  die;
         header('location:update.php?id=' . $id);
         die;
     }
     foreach ($editeurs as $id_editeur) {
         $sql = "INSERT INTO editeur_livre VALUES (:id_editeur, :id_livre, NOW())";
        //  var_dump($id_editeur, $id);
        //  die;
         $data = [
             ':id_editeur' => $id_editeur,
             ':id_livre' => $id
            
         ];
        //  var_dump($data);
        //  die;
         $requete = $bdd->prepare($sql);
         if(!$requete->execute($data)) {
             // erreur
             var_dump($requete->errorinfo());
             die;
             header('location:update.php?id=' . $id);
             die;
         }
     }

    //  $_SESSION['error_update_livre'] = false;
    // header('location:index.php');
    // die;

     //Traitement des états
     $sql = "DELETE FROM etat_livre WHERE id_livre = ?";
     $requete = $bdd->prepare($sql);
     if(!$requete->execute([$id])){
         //erreur dans la suppression en bdd
         header('location:update.php?id=' . $id);
         die;
     }
     foreach ($etats as $id_etat) {
         $sql = "INSERT INTO etat_livre VALUES (:id_livre, :id_etat)";
         $data = [
            
             ':id_livre' => $id,
             ':id_etat' => $id_etat
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
        $sql = "DELETE FROM categorie_livre WHERE id_livre = ?";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur
            // var_dump($requete->errorInfo());
            // die;
            header('location:index.php');
            die;
        }

        $sql = "DELETE FROM auteur_livre WHERE id_livre = ?";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur
            // var_dump($requete->errorInfo());
            // die;
            header('location:index.php');
            die;
        }
        
        $sql = "DELETE FROM editeur_livre WHERE id_livre = ?";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur
            // var_dump($requete->errorInfo());
            // die;
            header('location:index.php');
            die;
        }

        $sql = "DELETE FROM etat_livre WHERE id_livre = ?";
        $requete = $bdd->prepare($sql);
        if(!$requete->execute([$id])){
            //erreur
            // var_dump($requete->errorInfo());
            // die;
            header('location:index.php');
            die;
        }

        // pour supprimer un livre on doit gérer l'illustration
        // on récupère le nom de l'illustration à supprimer
        $sql = "SELECT illustration FROM livre WHERE id = ?";
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        $nom_illustration = $requete->fetch(PDO::FETCH_ASSOC);
        // on stock le nom de l'image apres avoir recuperer l'information en bdd
        $nom_illustration = $nom_illustration['illustration'];
        // on vérifie que l'image existe
        $dossier_illustration = PATH_ADMIN . 'img/illustration/' . $nom_illustration;
        if (!is_file($dossier_illustration)){
            // erreur l'illustration n'existe pas
            $_SESSION['error_delete_illustration'] = true;
            header('location:index.php'); 
            die;
       }
       if (!unlink($dossier_illustration)){
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

            
           
          