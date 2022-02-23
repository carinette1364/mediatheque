<?php
include '../config/config.php';
include '../includes/bdd.php';
?>

<?php

$sql = 'SELECT * FROM auteur';
$requete = $bdd->query($sql);
$auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);

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
        <h1 class="h3 mb-0 text-gray-800">Liste des auteurs</h1>
        <a href="add.php" class='btn btn-success my-3'>Ajouter un auteur</a>
        <?php
        // var_dump($_SESSION);


        if (isset($_SESSION['error_update_auteur']) && ($_SESSION['error_update_auteur'] == false)) {
            alert('success', "l'auteur est bien modifié");
            unset($_SESSION['error_update_auteur']);
        }

        if (isset($_SESSION['error_add_auteur']) && ($_SESSION['error_add_auteur'] == false)) {
            alert('success', "l'auteur est bien ajouté");
            unset($_SESSION['error_add_auteur']);
        }

        if (isset($_SESSION['error_delete_auteur']) && ($_SESSION['error_delete_auteur'] == false)) {
            alert('success', "l'auteur est bien supprimé");
            unset($_SESSION['error_delete_auteur']);
        }

        if (isset($_SESSION['error_delete_auteur']) && ($_SESSION['error_delete_auteur'] == false)) {
            alert('success', "l'auteur est bien supprimé");
            unset($_SESSION['error_delete_auteur']);
        }
        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">



            <table class="table">
                <thead class='thead-dark'>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom de plume</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Ville</th>
                        <th scope="col">Code postal</th>
                        <th scope="col">Email</th>
                        <th scope="col">Numéro</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Voir</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($auteurs as $auteur) : ?>
                        <tr>
                            <!-- AFFICHAGE DES CHAMPS -->
                            <th scope="row"><?= $auteur['id'] ?></th>
                            <td><?= $auteur['nom'] ?></td>
                            <td><?= $auteur['prenom'] ?></td>
                            <td><?= $auteur['nom_de_plume'] ?></td>
                            <td><?= $auteur['adresse'] ?></td>
                            <td><?= $auteur['ville'] ?></td>
                            <td><?= $auteur['code_postal'] ?></td>
                            <td><?= $auteur['mail'] ?></td>
                            <td><?= $auteur['numero'] ?></td>
                            <td><img width="75px" height="auto" src="<?= URL_ADMIN ?>img/photo/<?= $auteur['photo'] ?>" alt=""></td>
                            <!-- <td><a href="http://localhost/CRUD_EX/update.php?id=1" class= "btn btn-warning">Modifier</a></td> -->
                            <!-- ce qui suit après le ?, après php dans l'adresse de la page ce qui va suivre ce sont des données après get donc visibles -->
                            <!-- après on vérifie sur la page update avec var_dump $_GET -->
                            <!-- pour que l'id soit dynamique et pas que l'id 1 après le ? : -->
                            <td><a href="<?= URL_ADMIN ?>auteur/single.php?id=<?= $auteur['id'] ?>" class='btn btn-primary'>Voir</a></td>
                            <td><a href="<?= URL_ADMIN ?>auteur/update.php?id=<?= $auteur['id'] ?>" class="btn btn-warning">Modifier</a></td>
                            <td><a href="<?= URL_ADMIN ?>auteur/action.php?id=<?= $auteur['id'] ?>" class="btn btn-danger">Supprimer</a></td>
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