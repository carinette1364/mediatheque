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

$sql = 'SELECT usager.id AS id_usager, usager.nom AS nom_usager, usager.prenom AS prenom_usager, livre.id AS id_livre, livre.titre, 
location.id AS id_location, etat.id AS id_etat, etat.libelle, etat_debut, etat_retour, date_debut, date_fin, statut
FROM location
INNER JOIN usager ON location.id_usager = usager.id
INNER JOIN livre ON location.id_livre = livre.id
INNER JOIN etat ON location.etat_debut= etat.id';
$requete = $bdd->query($sql);
// var_dump($requete);
$locations = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($locations);
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
        
            <h1 class="h3 mb-0 text-gray-800">Liste des locations</h1>
            <a href="add.php" class="btn btn-success my-3">Ajouter une location</a>

            <?php

                    if (isset($_SESSION['error_add_location']) && ($_SESSION['error_add_location'] == false)) {
                        alert('success', 'la location est bien ajoutée');
                        unset($_SESSION['error_add_location']);
                    }

                        if (isset($_SESSION['error_cloturer_location']) && ($_SESSION['error_cloturer_location'] == false)) {
                            alert('success', 'la location est bien cloturée');
                            unset($_SESSION['error_cloturer_location']);
                        }

            ?>
        
    
    <!-- /.container-fluid -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table">
                    <thead class='thead-dark'>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Livre</th>
                            <th scope="col">État début</th>
                            <th scope="col">État retour</th>
                            <th scope="col">Usager</th>
                            <th scope="col">Date Emprunt</th>
                            <th scope="col">Date Retour</th>
                            <th scope="col">Voir</th>
                            <th scope="col">Clôturer</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($locations as $location) : ?>
                            <?php if($location['statut'] == 0) :?>

                                <?php
                            // $sql = 'SELECT etat.libelle, etat_retour, etat.id
                            // FROM location
                            // INNER JOIN etat ON location.etat_retour = etat.id';
                                $sql = "SELECT libelle
                                        FROM etat
                                        INNER JOIN location
                                        ON etat.id = location.etat_retour
                                        WHERE location.id = ?";
                                $requete = $bdd->prepare($sql);
                                $requete->execute([$location['id_location']]);
                                $etat = $requete->fetch(PDO::FETCH_ASSOC);
                                // var_dump($etat);
                                // die;

                            ?>
                            
                            

                                <tr>
                                    <th scope="row"><a href="<?= URL_ADMIN ?>location/single.php"><?= $location['id_location'] ?></a></th>
                                    <td><a href="<?= URL_ADMIN . 'livre/single.php?id='. $location['id_livre'] ?>"><?= $location['titre'] ?></a></td>
                                    <td><?= $location['libelle'] ?></td>
                                    <td><?= $etat['libelle'] ?></td>
                                    <td><a href="<?= URL_ADMIN . 'usager/single.php?id=' . $location['id_usager'] ?>"><?= $location['nom_usager'] . ' ' . $location['prenom_usager'] ?></a></td>
                                    <td><?= $location['date_debut'] ?></td>
                                    <td><?= $location['date_fin'] ?></td>
                                    <td><a href="<?= URL_ADMIN ?>location/single.php?id=<?= $location['id_location'] ?>" class='btn btn-primary'>Voir</a></td>
                                    <td><a href="<?= URL_ADMIN ?>location/update.php?id=<?= $location['id_location'] ?>" class="btn btn-warning">Clôturer</a></td>
                                    <td><a href="<?= URL_ADMIN ?>location/action.php?id=<?= $location['id_location'] ?>" class="btn btn-danger">Supprimer</a></td>
                                </tr>
                                <?php endif; ?>     
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- </div> -->
    <!-- End of Main Content -->
   

    <?php
    include PATH_ADMIN . 'includes/footer.php';
    ?>



</body>


</html>