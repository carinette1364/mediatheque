
 <?php

include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
include '../includes/bdd.php';




if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = "SELECT * FROM location WHERE id = :id";
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        
        $requete->execute($data);
      
        $location = $requete->fetch(PDO::FETCH_ASSOC);
        
    }else{
        header('location:index.php');
        die;
    }
}

$sql = 'SELECT * FROM location';
$requete = $bdd->query($sql);
$locations = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($locations);
// die;

$sql = 'SELECT usager.id AS id_usager, usager.nom AS nom_usager, usager.prenom AS prenom_usager, livre.id AS id_livre, livre.titre, 
        location.id AS id_location, etat.id AS id_etat, etat.libelle, etat_debut, date_debut, date_fin
        FROM location
        INNER JOIN usager ON usager.id = id_usager
        INNER JOIN livre ON livre.id = id_livre
        INNER JOIN etat ON etat.id = etat_debut
        WHERE location.id = ?';

$requete = $bdd->prepare($sql);
$requete->execute([$id]);
$location = $requete->fetch(PDO::FETCH_ASSOC);
// var_dump($location);
// die;

$sql = "SELECT * FROM etat";
$requete = $bdd->query($sql);
$etats = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($etats);
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




            <div class="container">
                <h1 class="text-center">Clôturer une location</h1>

                <?php if (isset($_SESSION['error_update_location']) && ($_SESSION['error_update_location'] == true)) {
                    alert('danger', "la location n'est pas modifiée");
                    unset($_SESSION['error_update_location']);
                };

                ?>


                <form action="action.php" method="POST">
                    <input type="hidden" name="id_location" value="<?= $location['id_location'] ?>">
                    
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" name="titre" class="form-control" id="titre" value="<?= $location['titre'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nom_usager" class="form-label">Usager :</label> .
                        <input type="text" name="nom_usager" class="form-control" id="nom_usager" value="<?= $location['nom_usager']?> ">
                    </div>
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date début :</label> .
                        <input type="text" name="date_debut" class="form-control" id="date_debut" value="<?= $location['date_debut'] ?> ">
                    </div>
                    <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de retour :</label>
                            <input type="date" name="date_fin" class="form-control" id="date_fin" value="<?= $location['date_fin'] ?>">
                        </div>
                    <div class="row">
                    <div class="mb-3">
                        <label for="etat_debut" class="form-label">Etat début :</label> .
                        <input type="text" name="etat_debut" class="form-control" id="etat_debut" value="<?= $location['libelle'] ?> ">
                    </div>
                        <div class="mb-3 col">
                            <label for="etat_retour" class="form-label">Etat retour :</label>
                                <select class="select-etat" name="etat_retour"  id='etat_retour'>
                                    <?php foreach($etats as $etat) : ?>
                                        <option value="<?= $etat['id']?>"><?= $etat['libelle'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                    
            
                    <div class="mb-3 text-center">
                        <input type="submit" name="btn_cloturer_location" class="btn btn-warning">
                        <a href="<?= URL_ADMIN ?>location/index.php" class="btn btn-primary">Annuler</a>
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
        $('.select-etat').select2();
    </script>