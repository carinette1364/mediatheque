<?php

include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
include '../includes/bdd.php';



//recupération id en get de l'url
if (isset($_GET['id'])) {
    //secu info dans une variable qui transfrome en intval
    $id = intval($_GET['id']);
    if ($id > 0) {
        //SELECTION DU LIVRE
        //secu verifier si id supérieur à 0 alors intval transforme en 0 car c'est en string si >0
        // $sql_liv = "SELECT * FROM livre WHERE id = ?";
        $sql = "SELECT * FROM livre WHERE id = :id";
        // $req_liv = $bdd->prepare($sql_liv);
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        // $req_liv->execute(array($id)); //ou ([$id]);
        $requete->execute($data);
        // $livre = $req_liv->fetch(PDO::FETCH_ASSOC);
        $livre = $requete->fetch(PDO::FETCH_ASSOC);
        //fetch->ce livre là, 1 seul
        // var_dump($livre);
        // die;
        // SELECTION DE LA OU LES CATEGORIES DU LIVRE
        // $sql_cat = 
        // "SELECT  livre.id AS id_livre, categorie.id AS id_categorie, categorie.libelle
        // FROM categorie_livre
        // INNER JOIN livre
        // ON livre.id = categorie_livre.id_livre
        // INNER JOIN categorie
        // ON categorie.id = categorie_livre.id_categorie
        // WHERE livre.id = ?";
    
        //EXECUTER LA REQUETE
        // $req_cat = $bdd->prepare($sql_cat);
        // $req_cat->execute(array($id));
        //RECUPERATION DES INFOS
        // $livre_categorie = $req_cat->fetchAll(PDO::FETCH_NUM);
        // $livre_categorie = array_merge([],...$livre_categorie);
        // var_dump($livre_categorie);
        // die;
        
    }else{
        header('location:index.php');
        die;
    }
}
//préselection de toutes les catégories
$sql = "SELECT * FROM categorie";
$requete = $bdd->query($sql);
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($categories);

//préselection de l'id de la catégorie de la table categorie_livre où l'id est celui qu'on a choisi du get
$sql = "SELECT id_categorie FROM categorie_livre WHERE id_livre = ?";
$requete = $bdd->prepare($sql);
$requete->execute([$id]);
$categorie_livre = $requete->fetchAll(PDO::FETCH_NUM);
// var_dump($categorie_livre);
// die;
$categorie_id = [];

if (count($categorie_livre) >= 1) {
    //stocke les valeurs dans un seul tableau
    foreach ($categorie_livre as $id_categorie) {
        // var_dump($categorie_livre);
       
        $categorie_id[] = implode('', $id_categorie);
        //implode pour transformer un tableau en string
        // var_dump($categorie_livre);
        // die;
    }
}else{
    $categorie_id = $categorie_livre[0];
}
    // var_dump($categorie_id);
    // die;


$sql = "SELECT * FROM auteur";
$requete = $bdd->query($sql);
$auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($categories);
//préselection de l'id de l'auteur de la table auteur_livre où l'id est celui qu'on a choisi du get
$sql = "SELECT id_auteur FROM auteur_livre WHERE id_livre = ?";
$requete = $bdd->prepare($sql);
$requete->execute([$id]);
$auteur_livre = $requete->fetchAll(PDO::FETCH_NUM);
// var_dump($auteur_livre);
// die;
$auteur_id = [];

if (count($auteur_livre) >= 1) {
    //stocke les valeurs dans un seul tableau
    foreach ($auteur_livre as $id_auteur) {

        $auteur_id[] = implode('', $id_auteur);
        //implode pour transformer un tableau en string
        // var_dump($auteur_livre);
    }
}else{
    $auteur_id = $auteur_livre[0];
}
    // var_dump($auteur_id);
    // die;




?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?= URL_ADMIN ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="<?= URL_ADMIN ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <!-- <div id="wrapper"> -->
    <?php
    include PATH_ADMIN . 'includes/sidebar.php';
    ?>


    <?php
    include PATH_ADMIN . 'includes/topbar.php';
    ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">




            <div class="container">
                <h1 class="text-center">Modifier un livre</h1>

                <?php if (isset($_SESSION['error_update_livre']) && ($_SESSION['error_update_livre'] == true)) {
                    alert('danger', "le livre n'est pas modifié");
                    unset($_SESSION['error_update_livre']);
                };

                ?>


                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $livre['id'] ?>">
                    <div class="mb-3">
                        <label for="num_ISBN" class="form-label">Num_ISBN :</label>
                        <input type="text" name="num_ISBN" class="form-control" id="num_ISBN" value="<?= $livre['num_ISBN'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" name="titre" class="form-control" id="titre" value="<?= $livre['titre'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="illustration" class="form-label">illustration :</label>
                        <input type="file" name="illustration" class="form-control" id="illustration" value="<?= $livre['illustration'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé :</label>
                        <textarea class="form-control" name="resume" id="resume" rows="3"><?= $livre['resume'] ?></textarea>
                        <!-- dans le textarea pas de value c'est directement entre les balises -->
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="cat" class="form-label">Catégories :</label>
                                <select class="select-categorie" name="categorie[]"  id='cat' multiple>
                                    <?php foreach($categories as $categorie) : ?>
                                        <?php
                                        // var_dump(in_array($categorie['libelle'], $livre_categorie));
                                            if (in_array($categorie['id'], $categorie_id)){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            ?>
                                        <option value="<?= $categorie['id']?>" <?=$selected?>><?= $categorie['libelle'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                        </div>
                        <div class="mb-3 col">
                            <label for="aut" class="form-label">Auteurs :</label>
                                <select class="select-auteur" name="auteur[]"  id='aut' multiple>
                                    <?php foreach($auteurs as $auteur) : ?>
                                        <?php
                                            if (in_array($auteur['id'], $auteur_id)){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            ?>
                                        <option value="<?= $auteur['id']?>" <?=$selected?>><?= $auteur['nom'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php auteurs id" -->
                        </div>
                        <div class="mb-3 col">
                            <p>Illustration actuelle :</p>
                            <img width = "250px" height = "auto" src="<?= URL_ADMIN ?>img/illustration/<?= $livre['illustration'] ?>" alt="illustration"<?= $livre['titre'] ?>>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="prix" class="form-label">prix :</label>
                        <input type="text" name="prix" class="form-control" id="prix" value="<?= $livre['prix'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nb_pages" class="form-label">nb_pages :</label>
                        <input type="text" name="nb_pages" class="form-control" id="nb_pages" value="<?= $livre['nb_pages'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="date_achat" class="form-label">date_achat :</label>
                        <input type="date" name="date_achat" class="form-control" id="date_achat" value="<?= $livre['date_achat'] ?>">
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" name="btn_update_livre" class="btn btn-warning">
                        <a href="<?= URL_ADMIN ?>livre/index.php" class="btn btn-primary">Annuler</a>
                    </div>
                </form>
            </div>


        </div>


    </div>
    <!-- /.container-fluid -->

    <!-- </div> -->
    <!-- End of Main Content -->

    <?php
    include PATH_ADMIN . 'includes/footer.php';
    ?>



    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <script>
        $('.select-categorie').select2();
        $('.select-auteur').select2();
        CKEDITOR.replace('resume');
    </script>