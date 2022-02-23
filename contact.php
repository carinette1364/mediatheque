<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2df565c170.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@500&family=Fredericka+the+Great&family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Bibliothèque_Wave</title>
</head>

<body>

    <?php
    $image = "img/img_header_contact.jpg";
    $sous_titre = "Contactez-nous";
    $backcolor_connexion = "#FF96A0";
    include('include/header.php');
    ?>
    <!-- <header> -->
    <!-- ----------------------------DIV CONTAINER HEADER------------------------------------------------------------------------------------------- -->
    <!-- <div class="container_header"> -->
    <!-- --------------------DIV BARRE LOGO  BARRE CONNECTION---------------------------------------------------------------------------- -->
    <!-- <div class="barre_logo_connection"> -->
    <!-- ---------------------LOGO NOM MEDIATHEQUE---------------------------------------------------------------------------------------- -->
    <!-- <div class="logo_mediatheque">
                    <i class="fas fa-book-open"></i>
                    <i class="fas fa-water"></i>
                    <span class="nom_mediatheque">Médiathèque Wave</span>
                </div> -->
    <!-- ---------------------BARRE CONNECTION MEDIATHEQUE---------------------------------------------------------------------------------- -->
    <!-- <div class="barre_connexion_mediatheque">
                    <i class="fas fa-wheelchair"></i>
                    <i class="fas fa-deaf"></i>
                    <i class="fas fa-braille"></i>
                    <span class='mon_compte'>Mon compte - Se Connecter</span>
                    <a href=""><i class="fas fa-user-check" id="user"></i></a>
                </div>
            </div> -->
    <!-- -----------------------------DIV IMAGE MEDIATHEQUE BARRE RECHERCHE TITRE SOUS-TITRE--------------------------------------------------------------------------------------- -->
    <!-- <div class="fond_header_img_contact">
                <div class="fond_header_recherche">
                    <div class="barre_loupe_recherche">
                        <div class="barre_recherche">
                            <input type="text" id='recherche' name='recherche' placeholder="votre recherche">
                        </div>
                        <div class="loupe">
                            <a href=""><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
                <div class="titre_mediatheque">
                    <h1 id="titre">Médiathèque Wave</h1>
                    <h2 id="sous_titre_contact">Contactez-nous</h2>
                </div>
            </div> -->
    <!-- --------------------------------------DIV BARRE NAVIGATION--------------------------------------------------------------------------- -->
    <!-- <div class="nav_barre">
                <div class="logo_ville">
                    <img src="img_bibliothèque/logo_ville.jpg" alt="logoVille" width="120" height="120">
                </div>
                <div class="boutons">
                    <a href="index.php"><input type="button" class="btn_nav" id="accueil" value="Accueil"></a> -->
    <!-- <a href=""><button class="btn_nav" id="accueil">Accueil</button></a>  mieux???-->
    <!-- <a href=""><input type="button" class="btn_nav" id="catalogue" value="Catalogue"></a>
                    <a href=""><input type="button" class="btn_nav" id="infos" value="Infos pratiques"></a>
                    <a href=""><input type="button" class="btn_nav" id="contact" value="Contact"></a>
                </div>
            </div>
        </div>
    </header> -->
    <!-- -----------------------------------------DIV CONTAINER BODY--------------------------------------------------------------------------------------- -->
    <div class="container_body_contact">
        <div class="form_titre_contact">
            <div class="form_titre" id="form">
                <h1 class="titre_form">Formulaire de contact</h1>
                <p class="infos_form"></p>
            </div>
            <div class="form_contact">
                <form class="form" action="">
                    <div class='champ'>
                        <label for="nom" class="form_label">Nom</label>
                        <input type="text" class="form_input" id="nom" name="nom" placeholder="Votre nom">
                    </div>
                    <div class='champ'>
                        <label for="prenom" class="form_label">Prénom</label>
                        <input type="text" class="form_input" id="prenom" name="prenom" placeholder="Votre prénom">
                    </div>
                    <div class='champ'>
                        <label for="email" class="form_label">Email</label>
                        <input type="text" class="form_input" id="email" name="email" placeholder="Votre adresse mail">
                    </div>
                    <div class='champ'>
                        <label for="telephone" class="form_label">Téléphone</label>
                        <input type="text" class="form_input" id="telephone" name="telephone" placeholder="Votre numéro de téléphone">
                    </div>
                    <div class='champ'>
                        <label for="demande" class="form_label">Votre demande</label>
                        <textarea name="demande" class="form_input" id="demande"></textarea>
                    </div>
                    <div class='champ'>
                        <input type="submit" class="btn_form" name="btn_form" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include('include/footer.php');
    ?>
    <!-- -------------------------------------------------------FOOTER---------------------------------------------------------------------------------------- -->
    <!-- <div class="container_footer">
        <div class="footer_infos">
            <div class="logo_mediatheque_footer">
                <div class="logo_footer">
                    <i class="fas fa-book-open"></i>
                    <i class="fas fa-water"></i>
                </div>
                <span class="nom_mediatheque_footer">Médiathèque Wave</span>
            </div>
        </div>
        <div class="footer_infos">
            <div class="infos_footer">
                <h3>Médiathèque Wave</h3>
                <p>13 avenue de la Grande Plage</p>
                <p>64600 Biarritz</p>
                <p>05.59.22.11.73</p>
                <p>mediatheque.wave@gmail.com</p>
            </div>
        </div>
        <div class="footer_infos">
            <div class="acces_footer">
                <h3>Plan d'acces</h3>
            </div>
            <div class="map_footer"> -->
    <!-- <img src="./img_bibliothèque/mapFooter.png" alt=""> -->
    <!-- <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11579.271087679197!2d-1.553740541246456!3d43.485273197557355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd516adb9d8132df%3A0xd609ef82551e3ad5!2sLa%20Grande%20Plage%2C%20Biarritz!5e0!3m2!1sfr!2sfr!4v1642271290684!5m2!1sfr!2sfr"
                    width="350" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="footer_infos">
            <div class="reseaux_footer">
                <h3>Nous suivre...</h3>
                <a href="" id="facebook"><i class="fab fa-facebook"></i></a>
                <a href="" id="instagram"><i class="fab fa-instagram-square"></i></a>
            </div>
        </div> -->

    <script src='form.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>