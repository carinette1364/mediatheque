<?php
include '../config/config.php';
if(!isConnect()){
    header('location:' . URL_ADMIN . 'login.php');
}
include '../includes/bdd.php';
?>



<?php
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM livre WHERE id = :id';
        $requete = $bdd->prepare($sql);
        $data = array(
            ':id' => $id
        );
        $requete->execute($data);
        $livre = $requete->fetch(PDO::FETCH_ASSOC);
    }else{
        header(('location:index.php'));
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
    <link href="style.css" rel="stylesheet">
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

            <table class="mx-auto h-100 table table-dark">

                <tr>
                    <th scope="row">Illustration :</th>
                    <td><img width="100px" height="auto" src="<?= URL_ADMIN ?>img/illustration/<?= $livre['illustration'] ?>"></td>
                </tr>
                <tr>
                    <th scope="row">ID :</th>
                    <td><?= $livre['id'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Numéro ISBN :</th>
                    <td><?= $livre['num_ISBN'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Titre :</th>
                    <td><?= $livre['titre'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Résumé :</th>
                    <td><?= $livre['resume'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Prix :</th>
                    <td><?= $livre['prix'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Nombre de pages :</th>
                    <td><?= $livre['nb_pages'] ?></td>
                </tr>
                <tr>
                    <th scope="row">date d'achat :</th>
                    <td><?= $livre['date_achat'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Disponibilité :</th>
                    <td><?= $livre['disponibilite'] ?></td>
                </tr>
                <tr>
                    <th scope="row">
                    <td><a href="<?= URL_ADMIN ?>livre/index.php" class="btn btn-success my-3">Retour à la liste des livres</a></td>
                    </th>
                </tr>

            </table>

        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- </div> -->
    <!-- End of Main Content -->

    <?php
    include PATH_ADMIN . 'includes/footer.php';
    ?>

