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

$sql = 'SELECT * FROM livre';
$requete = $bdd->query($sql);
$livres = $requete->fetchAll(PDO::FETCH_ASSOC);

// var_dump(getCategories(2, $bdd));
// var_dump(getAuteurs(2, $bdd ));
// var_dump(getEtats(2, $bdd ));
// var_dump(getEditeurs(2, $bdd ));




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
        <h1 class="h3 mb-0 text-gray-800">Liste des livres</h1>
        <a href="add.php" class='btn btn-success my-3'>Ajouter un livre</a>
        <?php
        // var_dump($_SESSION);


        if (isset($_SESSION['error_update_livre']) && ($_SESSION['error_update_livre'] == false)) {
            alert('success', 'le livre est bien modifié');
            unset($_SESSION['error_update_livre']);
        }

        if (isset($_SESSION['error_add_livre']) && ($_SESSION['error_add_livre'] == false)) {
            alert('success', 'le livre est bien ajouté');
            unset($_SESSION['error_add_livre']);
        }

        if (isset($_SESSION['error_delete_livre']) && ($_SESSION['error_delete_livre'] == false)) {
            alert('success', 'le livre est bien supprimé');
            unset($_SESSION['error_delete_livre']);
        }

        if (isset($_SESSION['error_delete_livre']) && $_SESSION['error_delete_livre'] == true){
            alert('danger', 'Le livre n\'est pas supprimé');
            unset($_SESSION['error_delete_livre']);
        }
        if (isset($_SESSION['error_delete_illustration']) && $_SESSION['error_delete_illustration'] == true){
            alert('danger', 'L\'illustration ne peut être supprimée');
            unset($_SESSION['error_delete_illustration']);
        }
        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">



            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Num_ISBN</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Editeur</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Illustration</th>
                        <th scope="col">Résumé</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Nb_pages</th>
                        <th scope="col">Date_achat</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Disponibilté</th>
                        <th scope="col">Voir</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre) : ?>
                        <tr>
                            <!-- AFFICHAGE DES CHAMPS -->
                            <th scope="row"><?= $livre['id'] ?></th>
                            <td><?= $livre['num_ISBN'] ?></td>
                            <td><?= getCategories($livre['id'], $bdd); ?></td>
                            <td><?= getAuteurs($livre['id'], $bdd); ?></td>
                            <td><?= getEditeurs($livre['id'], $bdd); ?></td>
                            <td><?= $livre['titre'] ?></td>
                            <td><img width="75px" height="auto" src="<?= URL_ADMIN ?>img/illustration/<?= $livre['illustration'] ?>" alt=""></td>
                            <td><?= substr(htmlentities($livre['resume']), 0, 110) ?> [...]</td>
                            <td><?= $livre['prix'] ?>€</td>
                            <td><?= $livre['nb_pages'] ?></td>
                            <td><?= $livre['date_achat'] ?></td>
                            <td><?= getEtats($livre['id'], $bdd); ?></td>
                            <!-- <td><a href="http://localhost/CRUD_EX/update.php?id=1" class= "btn btn-warning">Modifier</a></td> -->
                            <!-- ce qui suit après le ?, après php dans l'adresse de la page ce qui va suivre ce sont des données après get donc visibles -->
                            <!-- après on vérifie sur la page update avec var_dump $_GET -->
                            <!-- pour que l'id soit dynamique et pas que l'id 1 après le ? : -->
                            <td><a href="<?= URL_ADMIN ?>livre/single.php?id=<?= $livre['id'] ?>" class='btn btn-primary'>Voir</a></td>
                            <td><a href="<?= URL_ADMIN ?>livre/update.php?id=<?= $livre['id'] ?>" class="btn btn-warning">Modifier</a></td>
                            <td><a href="<?= URL_ADMIN ?>livre/action.php?id=<?= $livre['id'] ?>" class="btn btn-danger">Supprimer</a></td>
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