<?php
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

// $sql = 'SELECT * FROM utilisateur';
// $requete = $bdd->query($sql);
// $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);
// die;

// $sql = "SELECT utilisateur.id AS id_utilisateur, utilisateur.nom AS nom_utilisateur, utilisateur.pseudo AS pseudo_utilisateur, 
// utilisateur.mail AS mail_utilisateur, utilisateur.num_telephone AS num_telephone_utilisateur, utilisateur.avatar AS avatar_utilisateur,
// utilisateur.adresse AS adresse_utilisateur, utilisateur.ville AS ville_utilisateur, utilisateur.code_postal AS code_postal_utilisateur,
// role.libelle AS libelle_role
// FROM role_utilisateur
// INNER JOIN role ON role_utilisateur.id_role = role.id
// INNER JOIN utilisateur ON role_utilisateur.id_utilisateur = utilisateur.id";
//***si on met des AS mettre le même nom de AS dans le foreach***/

// $sql = "SELECT utilisateur.id, utilisateur.nom, utilisateur.prenom, utilisateur.pseudo, utilisateur.mail, utilisateur.num_telephone, utilisateur.avatar,
// utilisateur.adresse, utilisateur.ville, utilisateur.code_postal, role.libelle
// FROM role_utilisateur
// INNER JOIN role ON role_utilisateur.id_role = role.id
// INNER JOIN utilisateur ON role_utilisateur.id_utilisateur = utilisateur.id";
// WHERE role_utilisateur.id_utilisateur = 1

// $sql = 'SELECT * FROM utilisateur';
// $requete = $bdd->query($sql);
// $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);

// var_dump($utilisateurs);

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
            <h1 class="h3 mb-0 text-gray-800">Liste des utilisateurs</h1>
        </div>
        <a href="add.php" class="btn btn-success my-3">Ajouter un utilisateur</a>

        <?php
        // var_dump($_SESSION);


        if (isset($_SESSION['error_update_utilisateur']) && ($_SESSION['error_update_utilisateur'] == false)) {
            alert('success', 'utilisateur bien modifié');
            unset($_SESSION['error_update_utilisateur']);
        } 

        if (isset($_SESSION['error_add_utilisateur']) && ($_SESSION['error_add_utilisateur'] == false)) {
            alert('success', 'utilisateur bien ajouté');
            unset($_SESSION['error_add_utilisateur']);
        } 

        ?>
        



        <table class="table">
            <thead class='thead-dark'>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Role</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur) : ?>
                    <tr>
                        <td><?= $utilisateur['id'] ?></td>
                        <td><?= $utilisateur['nom'] ?></td>
                        <td><?= $utilisateur['prenom'] ?></td>
                        <td><?= $utilisateur['pseudo'] ?></td>
                        <td><?= $utilisateur['mail'] ?></td>
                        <td><?= $utilisateur['num_telephone'] ?></td>
                        <td><?= $utilisateur['adresse'] . ',' . $utilisateur['ville'] . ',' . $utilisateur['code_postal'] ?></td>
                        <td><img width="75px" height="75px" src="<?= URL_ADMIN ?>img/avatar/<?= $utilisateur['avatar'] ?>" alt=""></td>
                        <td><?= $utilisateur['libelle'] ?></td>
                        <td><a href="<?= URL_ADMIN ?>utilisateur/update.php?id=<?= $utilisateur['id'] ?>" class="btn btn-warning">Modifier</a></td>
                        <td><a href="<?= URL_ADMIN ?>utilisateur/action.php?id=<?= $utilisateur['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>








    </div>
    <!-- /.container-fluid -->

    <!-- </div> -->
    <!-- End of Main Content -->

    <?php
    include PATH_ADMIN . 'includes/footer.php';
    ?>




</body>

</html>