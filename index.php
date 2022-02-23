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
    $image = "img/img_header_accueil.jpg";
    $sous_titre = "Bienvenue";
    $backcolor_connexion = "#FAC300";
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
    <!-- <div class="fond_header_img_accueil">
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
                    <h2 id="sous_titre_accueil">Bienvenue</h2>
                </div>
            </div> -->
    <!-- --------------------------------------DIV BARRE NAVIGATION--------------------------------------------------------------------------- -->
    <!-- <div class="nav_barre">
                <div class="logo_ville">
                    <img src="img_bibliothèque/logo_ville.jpg" alt="logoVille" width="120" height="120">
                </div>
                <div class="boutons">
                    <a href=""><input type="button" class="btn_nav" id="accueil" value="Accueil"></a> -->
    <!-- <a href=""><button class="btn_nav" id="accueil">Accueil</button></a>  mieux???-->
    <!-- <a href=""><input type="button" class="btn_nav" id="catalogue" value="Catalogue"></a>
                    <a href=""><input type="button" class="btn_nav" id="infos" value="Infos pratiques"></a>
                    <a href=""><input type="button" class="btn_nav" id="contact" value="Contact"></a>
                </div>
            </div>
        </div>
    </header> -->
    <!-- -----------------------------------------DIV CONTAINER BODY--------------------------------------------------------------------------------------- -->
    <div class="container_body_accueil">
        <!-- -----------------------------DIV SLIDER COUPS DE COEURS AGENDA--------------------------------------------------------------------------------------- -->
        <div class="slider_coeur_agenda">
            <!-- --------------------------------SECTION SLIDER-------------------------------------------------------------------------------------------- -->
            <section class="slider">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slider/Goncourt 2021 (2).jpg" class="d-block w-100" height="600px" alt="...">
                            <!-- <div class="carousel-caption d-none d-md-block">
                          <h5>Prix Goncourt 2021</h5>
                          <p>Some representative placeholder content for the first slide.</p>
                        </div> -->
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/hadrien bels.jpg" class="d-block w-100" height="600px" alt="...">
                            <!-- <div class="carousel-caption d-none d-md-block">
                          <h5>Hadrien Bels "Cinq dans tes yeux"</h5> 
                          <p>Some representative placeholder content for the second slide.</p>
                        </div> -->
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/prix jeunesse.jpg" class="d-block w-100" height="600px" alt="...">
                            <!-- <div class="carousel-caption d-none d-md-block">
                          <h5>Nouveautés Jeunesse</h5>
                          <p>Some representative placeholder content for the third slide.</p>
                        </div> -->
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
            <!-- ----------------------------------DIV COUPS DE COEUR ET AGENDA----------------------------------------------------------------------------- -->
            <div class="coeurs_agenda">
                <!-- --------------------------------SECTION COUPS DE COEUR------------------------------------------------------------------------------ -->
                <section class="coeurs">
                    <div class="titre_coeurs">
                        <h1 class="titre_coeurs_agenda">Nos coups de coeurs</h1>
                        <div class="coeurs_livres">
                            <div class="coeurs_cartes_livres">
                                <!-- <div class="coeurs_carte_img" id="coeurs_carte_img1"> -->
                                <img src="./img/Coups de coeur/La vague(1).jpg" alt="La Vague">
                                <!-- </div> -->
                                <!-- <div class="coeurs_carte_texte"> -->
                                <h2 class="cartes_titre">La Vague</h2>
                                <!-- </div> -->
                                <p class="carte_p">
                                    Pour faire comprendre les mécanismes du nazisme à ses élèves, un professeur crée un
                                    mouvement expérimental...
                                </p>
                            </div>
                            <div class="coeurs_cartes_livres">
                                <!-- <div class="coeurs_carte_img"> -->
                                <img src="./img/Coups de coeur/Culture Confiture(1).jpg" alt="Culture Confiture">
                                <!-- </div>
                                <div class="coeurs_carte_texte"> -->
                                <h2 class="cartes_titre">Culture Confiture</h2>
                                <!-- </div> -->
                                <p class="carte_p">
                                    La culture c'est comme la confiture, moins on en a, plus on l'étale...
                                </p>
                            </div>
                            <div class="coeurs_cartes_livres">
                                <!-- <div class="coeurs_carte_img"> -->
                                <img src="./img/Coups de coeur/Goldorak(1).jpg" alt="Goldorak">
                                <!-- </div> -->
                                <!-- <div class="coeurs_carte_texte"> -->
                                <h2 class="cartes_titre">Goldorak</h2>
                                <!-- </div> -->
                                <p class="carte_p">
                                    L' Empire de Vega vient de détruire la planète d'Euphor. Actarus, son Prince,
                                    assiste impuissant à la mort des siens...
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ------------------------------SECION AGENDA------------------------------------------------------------------------------------ -->
                <section class="agenda">
                    <div class="titre_agenda">
                        <h1 class="titre_coeurs_agenda">Agenda et Évènements</h1>
                    </div>
                    <div class="evenements">
                        <h3 class="date">
                            Mercredi 12 janvier 2022 <br> 10:30
                        </h3>
                        <h4 class="event">
                            Mes premières histoires <br> Comptines et Histoires
                        </h4>
                        <h3 class="date">
                            Vendredi 20 janvier 2022 <br> 15:00
                        </h3>
                        <h4 class="event">
                            Atelier d'écriture <br>Liberté chérie
                        </h4>
                        <h3 class="date">
                            Jeudi 3 février 2022 <br> 17:30
                        </h3>
                        <h4 class="event">
                            Soirée jeu <br> Quizz Littéraire
                        </h4>
                        <h3 class="date">
                            Mardi 15 février 2022 <br> 10:00
                        </h3>
                        <h4 class="event">
                            Causerie <br> Atelier Blabla
                        </h4>
                    </div>
                </section>
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