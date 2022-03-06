<?php
// include '../config/config.php';
// include '../includes/bdd.php';
include '../config/config.php';
if (!isConnect()) {
    header('location:' . URL_ADMIN .'login.php');
    die;
}
include '../includes/bdd.php';

//condition ternaire
//$var = [IF] ? [THEN] : [ELSE];

if(isset($_POST['btn_add_location'])){
    // var_dump($_POST);
    // die;
    
    $livre = intval($_POST['livre']);
    $usager = intval($_POST['usager']);
    $date_debut = $_POST['date_debut'];
    $date_fin = (!empty($_POST['date_fin']) ? $_POST['date_fin'] : NULL);
    

    $sql = 'INSERT INTO location VALUES(NULL, :id_usager, :id_livre, :date_debut, :date_fin, :etat_debut, NULL, 1)';

    $sql_etat = 'SELECT id_etat FROM etat_livre WHERE id_livre = ?';
    $requete = $bdd->prepare($sql_etat);
    $requete->execute([$livre]);
    $etat = $requete->fetch(PDO::FETCH_ASSOC);
    // var_dump($etat);
    // die;
    
    $requete = $bdd->prepare($sql);

    $data = [
        ':id_usager' => $usager,
        ':id_livre' => $livre,
        ':date_debut' => $date_debut,
        ':date_fin' => $date_fin,
        ':etat_debut' => $etat['id_etat']
    ];

    if(!$requete->execute($data)){

        $_SESSION['error_add_location'] = true;
        header('location:add.php');
        die;

    }
    $sql = "UPDATE livre SET disponibilite = 1 WHERE id= ?";
    $_SESSION['error_add_location'] = false;
    header('location:index.php');
    die;


}

if(isset($_POST['btn_cloturer_location'])){
        // var_dump($_POST);
        // die;
        
        $id = intval($_POST['id_location']);
        if ($id <= 0) {
            // erreur
            header('location:index.php');
            die;
        }

        $date_fin = htmlentities($_POST['date_fin']);
        $etat_retour = htmlentities($_POST['etat_retour']);
        // var_dump($etat_retour);
        // die;
        // $sql = 'SELECT etat.libelle
        // FROM location
        // INNER JOIN etat ON location.etat_retour = etat.id';

        // $requete = $bdd->query($sql);
        // $etat_retour = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($etat_retour);
        // // die;
                                $sql = "SELECT libelle
                                        FROM etat
                                        INNER JOIN location
                                        ON etat.id = location.etat_retour
                                        WHERE location.id = ?";
                                $requete = $bdd->prepare($sql);
                                $requete->execute([$id]);
                                $etat = $requete->fetch(PDO::FETCH_ASSOC);



    
    $sql = 'UPDATE location SET date_fin = NOW(), etat_retour = :etat_retour, statut = 0 WHERE id = :id';
        // echo 'coucou 73';
    $data = [
        
        ':etat_retour' => $etat_retour,
        ':id' => $id
    ];

    $requete = $bdd->prepare($sql);
    // echo 'coucou 81';

    if (!$requete->execute($data)) {
        $_SESSION['error_cloturer_location'] = true;
        // echo 'coucou 85 requ pas exexcute';
        $_SESSION['error_form'] = $_POST;
        header('location:update.php?id=' . $id);
        die;
    }

    //traitement état livre

    // var_dump($requete, $data, $requete->errorInfo);
    // die;
    // echo 'coucou 95';
    

    $_SESSION['error_cloturer_location'] = false;
    header('location:index.php');
    die;    


}

