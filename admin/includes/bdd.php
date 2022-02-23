<?php 

$dsn = 'mysql:dbname=user2_mediatheque;host=localhost';
            $utilisateur = 'user_mediatheque';
            $mot_de_passe = 'PB5OOe41)RyXx841';

            // $bdd = new PDO ($dsn, $utilisateur, $mot_de_passe);
            // var_dump($bdd);


            try{
                $bdd = new PDO ($dsn, $utilisateur, $mot_de_passe, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            }catch(PDOException $erreur){
                // echo 'erreur : ' . $erreur->getMessage();
               
                die('problème de base de données');

                // header('location: index.php');
                // die();
            }



?>