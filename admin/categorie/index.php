<?php
include '../config/config.php';
include '../includes/bdd.php';
?>

<?php

$sql = 'SELECT * FROM categorie';
$requete = $bdd->query($sql);
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

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
        <h1 class="h3 mb-0 text-gray-800">Liste des catégories</h1>
        <a href="add.php" class='btn btn-success my-3'>Ajouter une catégorie</a>
        <?php
        // var_dump($_SESSION);


        if (isset($_SESSION['error_update_categorie']) && ($_SESSION['error_update_categorie'] == false)) {
            alert('success', "la catégorie est bien modifiée");
            unset($_SESSION['error_update_categorie']);
        }

        if (isset($_SESSION['error_add_categorie']) && ($_SESSION['error_add_categorie'] == false)) {
            alert('success', "la catégorie est bien ajoutée");
            unset($_SESSION['error_add_categorie']);
        }

        if (isset($_SESSION['error_delete_categorie']) && ($_SESSION['error_delete_categorie'] == false)) {
            alert('success', "la catégorie est bien supprimée");
            unset($_SESSION['error_delete_categorie']);
        }
        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <table class="table">
                <thead class='thead-dark'>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie) : ?>
                        <tr>
                            <!-- AFFICHAGE DES CHAMPS -->
                            <th scope="row"><?= $categorie['id'] ?></th>
                            <td><?= $categorie['libelle'] ?></td>
                            <td><a href="<?= URL_ADMIN ?>categorie/update.php?id=<?= $categorie['id'] ?>" class="btn btn-warning">Modifier</a></td>
                            <td><a href="<?= URL_ADMIN ?>categorie/action.php?id=<?= $categorie['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- </div> -->
    <!-- End of Main Content -->

    <?php
    include PATH_ADMIN . 'includes/footer.php';
    ?>