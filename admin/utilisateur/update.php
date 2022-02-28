<?php
// include '../config/config.php';
// include '../includes/bdd.php';
// var_dump($_GET['id']);
// die;

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

// var_dump($_GET['id']);

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
    // var_dump($id);
    //    die;-> pour vérifier si ça fonctionne
    //2e vérification, un id est toujours supérieur à 0
    if ($id > 0) {
        //REQUETE SQL POUR RECUPERER L'utilisateur EN BDD
        // $sql = "SELECT * FROM contact WHERE id = " . $_GET['id'];
        // ou $sql = "SELECT * FROM contact WHERE id = :id;
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        // var_dump($sql);
        // die; 
        //? parce qu'on a qu'une valeur, si plusieurs mettre les flags ex :id, :nom etc
        //le $_GET['id'] c'est celui du html et pas de la base de données, c'est celui qu'on a passé après le ? dans l'adresse du bouton modifier du html
        // var_dump($sql);
        //EXECUTER LA REQUETE
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        $requete->execute($data);
        //RECUPERATION DES INFOS
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($utilisateur);
        // die;
    }else{
        header('location:index.php');
        die;
    }
    
}



//préselection de toutes les roles
$sql = "SELECT * FROM role";
$requete = $bdd->query($sql);
$roles = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($roles);
// die;

//préselection de l'id du role de la table role_utilisateur où l'id est celui qu'on a choisi du get
$sql = "SELECT id_role FROM role_utilisateur WHERE id_utilisateur = ?";
$requete = $bdd->prepare($sql);
$requete->execute([$id]);
$role_utilisateur = $requete->fetchAll(PDO::FETCH_NUM);
// var_dump($role_utilisateur);
// die;
$role_id = [];

if (count($role_utilisateur) >= 1) {
    //stocke les valeurs reçues dans un seul tableau
    foreach ($role_utilisateur as $id_role) {
        // var_dump($role_utilisateur);
        // die;
        $role_id[]= implode('', $id_role);
        //implode pour transformer un tableau en string
        // var_dump($role_utilisateur);
        // die;
    }
}else{
    $role_id = $role_utilisateur[0];
}
    // var_dump($role_id);
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
                <h1 class="text-center">Modifier un utilisateur</h1>

                <?php
                // var_dump($_SESSION);
                if (isset($_SESSION['error_update_utilisateur']) && ($_SESSION['error_update_utilisateur'] == true)) {
                    alert('danger', 'utilisateur non modifié');
                    unset($_SESSION['error_update_utilisateur']);
                };

                ?>




                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $utilisateur['id'] ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="<?= $utilisateur['nom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" value="<?= $utilisateur['prenom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo :</label>
                        <input type="text" name="pseudo" class="form-control" id="pseudo" value="<?= $utilisateur['pseudo'] ?>">
                    </div>
                    <!-- <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                            <input type="password" name= "mot_de_passe" class="form-control" id="mot_de_passe" value="">
                        </div> -->
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail :</label>
                        <input type="email" name="mail" class="form-control" id="mail" value="<?= $utilisateur['mail'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="num_telephone" class="form-label">Téléphone :</label>
                        <input type="text" name="num_telephone" class="form-control" id="num_telephone" value="<?= $utilisateur['num_telephone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" id="adresse" value="<?= $utilisateur['adresse'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville :</label>
                        <input type="text" name="ville" class="form-control" id="ville" value="<?= $utilisateur['ville'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="code_postal" class="form-label">Code postal :</label>
                        <input type="text" name="code_postal" class="form-control" id="code_postal" value="<?= $utilisateur['code_postal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar :</label>
                        <input type="file" name="avatar" class="form-control" id="avatar" value="<?= $utilisateur['avatar'] ?>">
                    </div>
                    <div class="row">
                        <div class="mb-3 col ">
                            <label for="role" class="form-label">Role :</label>
                                <select class="select-role w-25" name="role[]"  id='role' multiple>
                                    <?php foreach($roles as $role) : ?>
                                        <?php if (in_array($role['id'], $role_id)){
                                                //si in-array trouve l'id du role dans le tableau role de mon utilisateur ($role-id)
                                                //ça veut dire que mon utilisateur a bien ce role
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                                //$selected = "" à l'intérieur car la variable n'a de portée qu'à l'intérieur de la fonction
                                            } ?>
                                        <option value="<?= $role['id']?>" <?= $selected ?>><?= $role['libelle'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- //selected après "php categories id" -->
                        </div>
                        <div class="mb-3 col">
                            <p>Avatar actuel :</p>
                            <img width = "250px" height = "auto" src="<?= URL_ADMIN ?>img/avatar/<?= $utilisateur['avatar'] ?>" alt="avatar">
                        </div>
                    </div>
                    <div class="btn d-flex">
                        <div class="mb-3 text-center">
                            <input type="submit" name="btn_update_utilisateur" class="btn btn-primary mx-3" value="Modifier">
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