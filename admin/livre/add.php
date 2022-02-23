<?php
// include '../config/config.php';
// include '../includes/bdd.php';
include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
include '../includes/bdd.php';
?>

<?php

$sql_cat = "SELECT * FROM categorie";
$requete = $bdd->query($sql_cat);
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($categories);

$sql_aut = "SELECT * FROM auteur";
$requete = $bdd->query($sql_aut);
$auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($auteurs);

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
            <?php
            // var_dump($_SESSION);
            if (isset($_SESSION['error_add_livre']) && ($_SESSION['error_add_livre'] == true)) {
                alert('danger', "le livre n'est pas ajouté");
                unset($_SESSION['error_add_livre']);
            };

            ?>

            <div class="container">
                <h1 class="text-center">Ajouter un livre</h1>
                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="num_ISBN" class="form-label">Num_ISBN :</label>
                            <input type="text" name="num_ISBN" class="form-control" id="num_ISBN">
                        </div>
                        <div class="mb-3 col">
                            <label for="titre" class="form-label">Titre :</label>
                            <input type="text" name="titre" class="form-control" id="titre">
                        </div>
                        <div class="mb-3 col">
                            <label for="prix" class="form-label">Prix :</label>
                            <input type="text" name="prix" class="form-control" id="prix">
                        </div>
                        <div class="mb-3 col">
                            <label for="nb_pages" class="form-label">NB_pages :</label>
                            <input type="text" name="nb_pages" class="form-control" id="nb_pages">
                        </div>
                        <div class="mb-3 col">
                            <label for="date_achat" class="form-label">Date_achat :</label>
                            <input type="date" name="date_achat" class="form-control" id="date_achat">
                        </div>
                    </div>
                    
                    
                    <!-- <div class="mb-3">
                        <label for="illustration" class="form-label">Illustration :</label>
                        <input type="text" name="illustration" class="form-control" id="illustration">
                    </div> -->
                    
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé :</label>
                        <textarea class="form-control" name="resume" id="resume" cols="30" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="cat" class="form-label">Catégories :</label>
                                <select class="select-categorie" name="categorie[]" multiple id='cat'>
                                    <?php foreach($categories as $categorie) : ?>
                                        <option value="<?= $categorie['id']?>"><?= $categorie['libelle'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                        </div>
                        <div class="mb-3 col">
                            <label for="aut" class="form-label">Auteurs :</label>
                                <select class="select-aut" name="auteur[]" multiple id='aut'>
                                    <?php foreach($auteurs as $auteur) : ?>
                                        <option value="<?= $auteur['id']?>"><?= $auteur['nom'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="illustration" class="form-label">illustration :</label>
                        <input type="file" name="illustration" class="form-control" id="illustration">
                    </div>
                    <div class="btn d-flex mx-auto" style="width: 200px">
                        <div class="mb-3 text-center">
                            <input type="submit" name="btn_add_livre" class="btn btn-primary mx-3" value="Ajouter">
                        </div>
                        <div class="mb-3 text-center">
                            <a href="<?= URL_ADMIN ?>livre/index.php" class="btn btn-warning">Annuler</a>
                        </div>
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
        

        CKEDITOR.replace('resume');
    </script>