<?php
include '../config/config.php';
include '../includes/bdd.php';
// var_dump($_SESSION);

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
    //    var_dump($id);
    //    die;-> pour vérifier si ça fonctionne
    //2e vérification, un id est toujours supérieur à 0
    if ($id > 0) {
        //REQUETE SQL POUR RECUPERER L' AUTEUR EN BDD
        // $sql = "SELECT * FROM contact WHERE id = " . $_GET['id'];
        $sql = "SELECT * FROM auteur WHERE id = ?"; //? parce qu'on a qu'une valeur, si plusieurs mettre les flags ex :id, :nom etc
        //le $_GET['id'] c'est celui du html et pas de la base de données, c'est celui qu'on a passé après le ? dans l'adresse du bouton modifier du html
        // var_dump($sql);
        //EXECUTER LA REQUETE
        $requete = $bdd->prepare($sql);
        $requete->execute(array($id));
        //RECUPERATION DES INFOS
        $auteur = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($auteur);
    } else {
        header('location:index.php');
        die;
    }
}

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
                <h1 class="text-center">Modifier un auteur</h1>

                <?php if (isset($_SESSION['error_update_auteur']) && ($_SESSION['error_update_auteur'] == true)) {
                    alert('danger', "l'auteur n'est pas modifié");
                    unset($_SESSION['error_update_auteur']);
                };

                ?>


                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $auteur['id'] ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="<?= $auteur['nom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" value="<?= $auteur['prenom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nom_de_plume" class="form-label">Nom_de_plume :</label>
                        <input type="text" name="nom_de_plume" class="form-control" id="nom_de_plume" value="<?= $auteur['nom_de_plume'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" id="adresse" value="<?= $auteur['adresse'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville :</label>
                        <input type="text" name="ville" class="form-control" id="ville" value="<?= $auteur['ville'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="code_postal" class="form-label">Code_postal :</label>
                        <input type="text" name="code_postal" class="form-control" id="code_postal" value="<?= $auteur['code_postal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Email :</label>
                        <input type="email" name="mail" class="form-control" id="mail" value="<?= $auteur['mail'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Numéro :</label>
                        <input type="text" name="numero" class="form-control" id="numero" value="<?= $auteur['numero'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo :</label>
                        <input type="file" name="photo" class="form-control" id="photo" value="<?= $auteur['photo'] ?>">
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" name="btn_update_auteur" class="btn btn-warning">
                        <a href="<?= URL_ADMIN ?>auteur/index.php" class="btn btn-primary">Annuler</a>
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>