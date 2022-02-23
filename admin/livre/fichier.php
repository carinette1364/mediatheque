

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
    <link href="<?=URL_ADMIN?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="<?=URL_ADMIN?>/css/sb-admin-2.min.css" rel="stylesheet">
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

                    
    
  
    <div class="container">
    <h1 class="text-center">Ajouter un livre</h1>
    <form action="action.php" method="POST">
        <div class="mb-3">
            <label for="num_ISBN" class="form-label">Num_ISBN :</label>
            <input type="text" name= "num_ISBN" class="form-control" id="num_ISBN">
        </div>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre :</label>
            <input type="text" name= "titre" class="form-control" id="titre">
        </div>
        <div class="mb-3">
            <label for="illustration" class="form-label">Illustration :</label>
            <input type="text" name= "illustration" class="form-control" id="illustration">
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Résumé :</label>
            <textarea class="form-control" name="resume" id="resume" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix :</label>
            <input type="text" name= "prix" class="form-control" id="prix">
        </div>
        <div class="mb-3">
            <label for="nb_pages" class="form-label">NB_pages :</label>
            <input type="text" name= "nb_pages" class="form-control" id="NB_pages">
        </div>
        <div class="mb-3">
            <label for="date_achat" class="form-label">Date_achat :</label>
            <input type="text" name= "date_achat" class="form-control" id="Date_achat">
        </div>
        <div class="mb-3 text-center">
            <input type="submit" name= "btn_add_livre" class="btn btn-primary">
            <a href="http://localhost/livre/index.php" class="btn btn-warning">Annuler</a>
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
