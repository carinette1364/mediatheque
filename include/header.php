




<header>
        <!-- ----------------------------DIV CONTAINER HEADER------------------------------------------------------------------------------------------- -->
        <div class="container_header">
            <!-- --------------------DIV BARRE LOGO  BARRE CONNECTION---------------------------------------------------------------------------- -->
            <div class="barre_logo_connection">
                <!-- ---------------------LOGO NOM MEDIATHEQUE---------------------------------------------------------------------------------------- -->
                <div class="logo_mediatheque">
                    <i class="fas fa-book-open"></i>
                    <i class="fas fa-water"></i>
                    <span class="nom_mediatheque">Médiathèque Wave</span>
                </div>
                <!-- ---------------------BARRE CONNECTION MEDIATHEQUE---------------------------------------------------------------------------------- -->
                <div class="barre_connexion_mediatheque" style="background:<?=$backcolor_connexion;?>;">
                    <i class="fas fa-wheelchair"></i>
                    <i class="fas fa-deaf"></i>
                    <i class="fas fa-braille"></i>
                    <span class='mon_compte'>Mon compte - Se Connecter</span>
                    <a href="admin/login.php"><i class="fas fa-user-check" id="user"></i></a>
                </div>
            </div>
            <!-- -----------------------------DIV IMAGE MEDIATHEQUE BARRE RECHERCHE TITRE SOUS-TITRE--------------------------------------------------------------------------------------- -->
            <div class="fond_header_img" style = "background-image: url('<?php echo $image; ?>')">
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
                    <!-- <h2 id="sous_titre">Bienvenue</h2> -->
                    <h2 id= "sous_titre"><?php echo $sous_titre; ?></h2>
                </div>
            </div>
            <!-- --------------------------------------DIV BARRE NAVIGATION--------------------------------------------------------------------------- -->
            <div class="nav_barre">
                <div class="logo_ville">
                    <img src="img/logo_ville.jpg" alt="logoVille" width="120" height="120">
                </div>
                <div class="boutons">
                    <a href="index.php"><input type="button" class="btn_nav" id="accueil" value="Accueil"></a>
                    <!-- <a href=""><button class="btn_nav" id="accueil">Accueil</button></a>  mieux???-->
                    <a href="catalogue.php"><input type="button" class="btn_nav" id="catalogue" value="Catalogue"></a>
                    <a href="infos.php"><input type="button" class="btn_nav" id="infos" value="Infos pratiques"></a>
                    <a href="contact.php"><input type="button" class="btn_nav" id="contact" value="Contact"></a>
                </div>
            </div>
        </div>
    </header>