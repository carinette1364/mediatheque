<?php
// include '../config/config.php';
// include '../includes/bdd.php';
include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}

//accessible si seulement administrateur
if(!isAdmin()) {
    header('location:' . URL_ADMIN .'index.php');
    die;
}
include '../includes/bdd.php';
// include PATH_ADMIN . 'includes/bdd.php';

$sql = "SELECT * FROM role";
$requete = $bdd->query($sql);
$roles = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($roles);
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
            <?php
            // var_dump($_SESSION);
            if (isset($_SESSION['error_add_utilisateur']) && ($_SESSION['error_add_utilisateur'] == true)) {
                alert('danger', 'utilisateur non ajouté');
                unset($_SESSION['error_add_utilisateur']);
            };

            ?>

            <div class="container">
                <h1 class="text-center">Ajouter un utilisateur</h1>
                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom">
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo :</label>
                        <input type="text" name="pseudo" class="form-control" id="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                        <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail :</label>
                        <input type="email" name="mail" class="form-control" id="mail">
                    </div>
                    <div class="mb-3">
                        <label for="num_telephone" class="form-label">Téléphone :</label>
                        <input type="text" name="num_telephone" class="form-control" id="num_telephone">
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
                        <label for="avatar" class="form-label">Avatar :</label>
                        <input type="file" name="avatar" class="form-control" id="avatar">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="role" class="form-label mt-5">Roles :</label>
                                <select class="select-role w-25" name="role[]" multiple id='role'>
                                    <?php foreach($roles as $role) : ?>
                                        <option value="<?= $role['id']?>"><?= $role['libelle'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                        </div>
                    </div>
                    </div>
                    <div class="btn d-flex mx-auto" style="width: 200px">
                        <div class="mb-3 text-center">
                            <input type="submit" name="btn_add_utilisateur" class="btn btn-primary mx-3" value="Ajouter">
                        </div>
                        <div class="mb-3 text-center">
                            <a href="<?= URL_ADMIN ?>utilisateur/index.php" class="btn btn-warning">Annuler</a>
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
        $('.select-role').select2();
       
    </script>