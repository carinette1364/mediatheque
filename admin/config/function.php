<?php
    function alert ($couleur,$message) {?>
        <div class="alert alert-<?=$couleur ?>" role="alert">
        <?= $message; ?>
        </div>
    <?php }

    function isConnect(){
        if(isset ($_SESSION['connect']) && ($_SESSION['connect']) == true){
            return true;
        }
        return false;
        
    }

    function checkRoles($id, $bdd){
        if(intval($id) <= 0) {
            //erreur
            return false;
        }
        $sql = 
        'SELECT libelle 
        FROM role_utilisateur 
        INNER JOIN role 
        ON role.id = role_utilisateur.id_role
        WHERE role_utilisateur.id_utilisateur = ?';

        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);
        // FETCH_NUM pour le merge
        $roles = $requete->fetchAll(PDO::FETCH_NUM);
        // var_dump($roles);
        // verifier si il ya un ou plusieurs roles, on recup la taille du tableau fonction COUNT
        //si + de 1 role alors on merge le tableau (fusion)
        // var_dump(count($roles))
        //verif si 1 rôle ou +;
        if(count($roles) > 1){
            //si + de 1 rôle alors on merge 
            $roles = array_merge($roles[0], $roles[1]);
        }else{
            //sinon on récupère le role de l'utilisateur(qui a forcément 0 pour index)
            $roles = $roles[0];
        }
        //on retourne le tableau
        //normalement on devrait stocker directement le tableau en session
        //cela permet d'avoir une actualisation à chaque appel de la fonction
        $_SESSION['utilisateur']['roles'] = $roles;
        // return $roles;
        return true;

    }

// isAdmin() 
// Fonction qui retourne un booléan 
// en fonction de si l'utilisateur a le rôle d'administrateur ou non
// @return boolean
 

function isAdmin(){
    // Doit vérifier si le tableau ['roles'] en session contient le nom du role recherché
    //  * Si oui alors l'utilisateur a le role recherché
    //  * Sinon l'utilisateur n'a pas le role recherché
    return in_array('Admin', $_SESSION['utilisateur']['roles']);
}

// isSalarie() 
// Fonction qui retourne un booléan 
// en fonction de si l'utilisateur a le rôle de salarié ou non
// @return boolean

function isSalarie(){
    // Doit vérifier si le tableau ['roles'] en session contient le nom du role recherché
    //  * Si oui alors l'utilisateur a le role recherché
    //  * Sinon l'utilisateur n'a pas le role recherché
    return in_array('Salarié', $_SESSION['utilisateur']['roles']);
}


    


