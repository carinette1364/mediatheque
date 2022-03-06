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

$sql = 'SELECT * FROM livre WHERE disponibilite = 0';
$requete = $bdd->query($sql);
$livres = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($livres);
// die;


$sql = 'SELECT * FROM usager';
$requete = $bdd->query($sql);
$usagers = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($usagers);



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
            if (isset($_SESSION['error_add_location']) && ($_SESSION['error_add_location'] == true)) {
                alert('danger', "la location n'est pas ajoutée");
                unset($_SESSION['error_add_location']);
            };

            ?>
           

            <div class="container">
                <h1 class="text-center">Ajouter une location</h1>
                <form action="action.php" method="POST">
                   <div class="row mt-5">
                   <div class="mb-3 col">
                            <label for="livre" class="form-label">Livre :</label>
                                <select class="select-livre w-75" name="livre"  id='livre'>
                                    <?php foreach($livres as $livre) : ?>
                                        <option value="<?= $livre['id']?>"><?= $livre['titre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                    </div>
                    <div class="mb-3 col">
                            <label for="usager" class="form-label">usager :</label>
                                <select class="select-usager w-75" name="usager"   id='usager'>
                                    <?php foreach($usagers as $usager) : ?>
                                        <option value="<?= $usager['id']?>"><?= $usager['nom'] . '  ' . $usager['prenom']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                    </div>
                   </div>
                   <div class="row">
                   <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début de location :</label>
                        <input type="date" name="date_debut" class="form-control" id="date_debut">
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin de location :</label>
                        <input type="date" name="date_fin" class="form-control" id="date_fin">
                    </div>
                   </div>
                    <div class="btn d-flex mx-auto" style="width: 200px">
                        <div class="mb-3 text-center">
                            <input type="submit" name="btn_add_location" class="btn btn-primary mx-3" value="Ajouter">
                        </div>
                        <div class="mb-3 text-center">
                            <a href="<?= URL_ADMIN ?>location/index.php" class="btn btn-warning">Annuler</a>
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
    <script>
        $('.select-livre').select2();
        $('.select-usager').select2();
       
    </script>