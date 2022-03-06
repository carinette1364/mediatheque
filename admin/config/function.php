<?php

    //Syntaxe INNER JOIN
    //SELECT *
    //FROM table1
    //INNER JOIN table2
    //ON table1.id = table2.id

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
        "SELECT libelle 
        FROM role_utilisateur 
        INNER JOIN role 
        ON role.id = role_utilisateur.id_role
        WHERE role_utilisateur.id_utilisateur = ?";

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

//getCategories
//fonction qui permet de récupérer la ou les catégories qui sont liées à un livre
function getCategories($_id_livre, $_bdd){
    //générer la requete SQL qui permet de récupérer les catégories par rapport à un id de livre ($_id_livre)
    $sql = "SELECT categorie.libelle
            FROM categorie_livre 
            INNER JOIN categorie 
            ON categorie_livre.id_categorie = categorie.id 
            WHERE categorie_livre.id_livre = ?";
            //SELECT je selectionne dans la table categorie, je pointe sur le champ libelle
            //FROM puis la table categorie_livre va faire une jointure avec la table categorie
            //INNER JOIN je rajoute une jointure
            //ON dans ON on met le champ en commun entre les deux tables (categorie_livre et categorie)
            //dans la table categorie_livre, je demande à accéder à l'id de catégorie (nom bdd categorie_livre.id_categorie)
            //= je dis qu'il correspond à la table catégorie, au champ identifiant (categorie.id)
    //on prepare la requete
    $requete = $_bdd->prepare($sql); 
    //$_bdd pour indiquer que c'est le paramètre qu'on utilise (voir dans les parenthèses) et pas la variable qui existe à l'extérieur hors de la fonction
    //on execute la requete avec en paramètre l'id du livre
    $requete->execute([$_id_livre]); 
    //$_id_livre c'est le paramètre passé entre les parenthèses de la fonction
    //on récupère les data sous forme de tableau associatif
    $categories = $requete->fetchAll(PDO::FETCH_ASSOC);
    //on crée une variable sous forme de tableau [] qui va permettre de stocker les catégories
    $categorie_livre = [];
    //on boucle sur la liste des catégories reçues
    foreach($categories as $categorie){
        //à cause du fetchAll on renvoit un tableau de tableau
        // var_dump($categorie);
        //on fait implode pour récupérer l'élmt du tableau qui est sous forme de chaîne de carcatères en string (libelle)
        // var_dump(implode($categorie));
        // on stocke la valeur que contient le sous-tableau grace à la fonction implode qui permet de transformer un array en string
        $categorie_livre[] = implode($categorie);
    }
    // return $categorie_livre;//ceci renvoie un tableau et pour recevoir que la chaîne de caractères:
    //on retourne le tableau des catégories sous forme de chaîne de carcatères
    return implode(' , ', $categorie_livre);
    

    //traitement sur le tableau de retour pour générer une chaîne de caractères

}

//getCategories
//fonction qui permet de récupérer le ou les auteurs qui sont liées à un livre
function getAuteurs($_id_auteur, $_bdd){
    //generer la requete qui permet de récupere les auteurspar rapport à un id du livre
    $sql = "SELECT auteur.nom
            FROM auteur_livre
            INNER JOIN auteur
            ON auteur_livre.id_auteur = auteur.id
            WHERE auteur_livre.id_livre = ?";
    //dans la table auteur j'accède au champ nom
    //à partir de la table auteur_livre
    //je fais une jointure avec la table auteur
    //sur la table auteur_livre j'accède à l'id de l'auteur (bdd id_auteur)
    //que je compare à l'id de la table auteur, auteur.id, j'accède à l'id de la table auteur (bdd id) 
    
    //je prépare la requete sql depuis la bdd
    $requete = $_bdd->prepare($sql);
    //j'execute la requete avec le paramètre passé en parenthese de la fonction qui correspond à l'id du livre
    $requete->execute([$_id_auteur]);
    //je crée une variable auteurs qui va récupérer les data de auteurs sous forme de tableau associatif
    $auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    //le fetchAll renvoit un tableau de tableau
    //on crée une variable qui va stocker ces auteurs sous forme de tableau
    $auteur_livre = [];
    //on fait un foreach pour boucler sur la liste des auteurs qu'on a reçu
    foreach ($auteurs as $auteur){
        // var_dump($auteur);
        // die;
        //on fait un implode sur notre tableau stockant les auteurs pour le transformer en chaine de caractères
        //on peut stocker les valeurs de ce sous-tableau grâce à implode qui ne va récupérer que le nom de ce tableau car il est en string
        $auteur_livre[] = implode($auteur);
    }
    return implode(' ', $auteur_livre);
}


function getRoles($_id_role, $_bdd){

    $sql = "SELECT role.libelle 
            FROM role_utilisateur
            INNER JOIN role
            ON role_utilisateur.id_role = role.id
            WHERE role_utilisateur.id_utilisateur = ?";
    $requete = $_bdd->prepare($sql);
    $requete->execute([$_id_role]);
    $roles = $requete->fetchAll(PDO::FETCH_ASSOC);
    $role_utilisateur = [];
    foreach($roles as $role){
        $role_utilisateur[] = implode($role);
    }
    return implode(' ', $role_utilisateur);

}

function getEtats($_id_etat, $_bdd){

    $sql = "SELECT etat.libelle
            FROM etat_livre
            INNER JOIN etat
            ON etat_livre.id_etat = etat.id
            WHERE etat_livre.id_livre = ?";
    $requete = $_bdd->prepare($sql);
    $requete->execute([$_id_etat]);
    $etats = $requete->fetchAll(PDO::FETCH_ASSOC);
    $etat_livre = [];
    foreach($etats as $etat){
        $etat_livre[] = implode($etat);
    }
    return implode(' ', $etat_livre);
}

function getEditeurs($_id_editeur, $_bdd){

    $sql = "SELECT editeur.denomination
            FROM editeur_livre
            INNER JOIN editeur
            ON editeur_livre.id_editeur = editeur.id
            WHERE editeur_livre.id_livre = ?";
    $requete = $_bdd->prepare($sql);
    $requete->execute([$_id_editeur]);
    $editeurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    $editeur_livre = [];
    foreach($editeurs as $editeur){
        $editeur_livre[] = implode($editeur);
    }
    return implode('', $editeur_livre);
}




        



            

                        



    


