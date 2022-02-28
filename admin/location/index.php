<?php 
include '../config/config.php';
include '../includes/bdd.php';
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

    <!-- Content Wrapper -->
    <!-- <div id="content-wrapper" class="d-flex flex-column"> -->

    <!-- Main Content -->
    <!-- <div id="content"> -->

    <?php
    include PATH_ADMIN . 'includes/topbar.php';
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Liste des locations</h1>
        </div>
        <a href="add.php" class="btn btn-success my-3">Ajouter une location</a>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Livre</th>
                    <th scope="col">Usager</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr>
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




</body>

</html>