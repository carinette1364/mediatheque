<?php
include '../config/config.php';
include '../includes/bdd.php';
?>

<?php

$sql = 'SELECT * FROM usager';
$requete = $bdd->query($sql);
$usagers = $requete->fetchAll(PDO::FETCH_ASSOC);

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
            <?php
            // var_dump($_SESSION);
            if (isset($_SESSION['error_add_usager']) && ($_SESSION['error_add_usager'] == true)) {
                alert('danger', "l'usager n'est pas ajouté");
                unset($_SESSION['error_add_usager']);
            };

            ?>

            <div class="container">
                <h1 class="text-center">Ajouter un usager</h1>
                <form action="action.php" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" id="adresse">
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville :</label>
                        <input type="text" name="ville" class="form-control" id="ville">
                    </div>
                    <div class="mb-3">
                        <label for="code_postal" class="form-label">Code postal :</label>
                        <input type="text" name="code_postal" class="form-control" id="code_postal">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Email :</label>
                        <input type="email" name="mail" class="form-control" id="mail">
                    </div>
                    <div class="btn d-flex mx-auto" style="width: 200px">
                        <div class="mb-3 text-center">
                            <input type="submit" name="btn_add_usager" class="btn btn-primary mx-3" value="Ajouter">
                        </div>
                        <div class="mb-3 text-center">
                            <a href="<?= URL_ADMIN ?>usager/index.php" class="btn btn-warning">Annuler</a>
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