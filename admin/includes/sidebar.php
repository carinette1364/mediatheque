<!-- Page Wrapper -->
<div id="wrapper">
  
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=URL_ADMIN?>index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-solid fa-house-user"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=URL_ADMIN?>index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tableau de bord</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoLivre"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-book-open"></i>
        <span>Livres</span>
    </a>
    <div id="collapseTwoLivre" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des livres:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>livre/index.php">Liste des livres</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>livre/add.php">Ajouter un livre</a>
        </div>
    </div>
</li> -->

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesLivre"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-book-open"></i>
        <span>Livre</span>
    </a>
    <div id="collapsePagesLivre" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des locations:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>livre/index.php">Liste des livres</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>livre/add.php">Ajouter un livre</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesUsager"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-solid fa-users"></i>
        <span>Usager</span>
    </a>
    <div id="collapsePagesUsager" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des usagers:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>usager/index.php">Liste des usagers</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>usager/add.php">Ajouter un usager</a>
            <!-- <a class="collapse-item" href="<?=URL_ADMIN?>forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>404.html">404 Page</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>blank.html">Blank Page</a> -->
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesLocation"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-solid fa-check-double"></i>
        <span>Location</span>
    </a>
    <div id="collapsePagesLocation" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des locations:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>location/index.php">Liste des locations</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>location/add.php">Ajouter une location</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesCategorie"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-align-justify"></i>
        <span>Catégorie</span>
    </a>
    <div id="collapsePagesCategorie" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des éditeurs:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>categorie/index.php">Liste des catégories</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>categorie/add.php">Ajouter une catégorie</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEtat"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-solid fa-signal"></i>
        <span>Etats</span>
    </a>
    <div id="collapsePagesEtat" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des états:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>etat/index.php">Liste des états</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>etat/add.php">Ajouter un état</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEditeur"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-solid fa-user-tie"></i>
        <span>Editeur</span>
    </a>
    <div id="collapsePagesEditeur" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des éditeurs:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>editeur/index.php">Liste des éditeurs</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>editeur/add.php">Ajouter un éditeur</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAuteur"
        aria-expanded="true" aria-controls="collapsePages">
        <i class=" fas fa-solid fa-pen"></i>
        <span>Auteur</span>
    </a>
    <div id="collapsePagesAuteur" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des auteurs:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>auteur/index.php">Liste des auteurs</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>auteur/add.php">Ajouter un auteur</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>



<!-- Nav Item - Pages Collapse Menu -->


<?php if(isAdmin()) :?>
    <li class="nav-item">
    <a class="nav-link collapsed" href="<?= URL_ADMIN ?>utilisateur/" data-toggle="collapse" data-target="#collapsePagesUtilisateur"
        aria-expanded="true" aria-controls="collapsePages"> 
        <!-- //après utilisateur dans php pointe vers index.php -->
        <i class="fas fa-user"></i>
        <!-- <i class="fas fa-user-friends"></i> -->
        <span>Utilisateur</span>
    </a>
    <div id="collapsePagesUtilisateur" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des utilisateurs:</h6> 
            <a class="collapse-item" href="<?=URL_ADMIN?>utilisateur/index.php">Liste des utilisateurs</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>utilisateur/add.php">Ajouter un utilisateur</a>
        </div>
    </div>
</li>
<?php endif; ?>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesContact"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-solid fa-file-signature"></i>
        <span>Contact</span>
    </a>
    <div id="collapsePagesContact" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des contacts:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>contact/index.php">Liste des prises de contact</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>contact/add.php">Ajouter une prise de contact</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-user"></i>
        <span>Auteur</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>auteur/index.php">Liste des auteurs</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>auteur/add.php">Ajouter un auteur</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="<?=URL_ADMIN?>404.html">404 Page</a>
            <a class="collapse-item" href="<?=URL_ADMIN?>blank.html">Blank Page</a> -->
        <!-- </div>
    </div>
</li>  -->

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
    <a class="nav-link" href="<?=URL_ADMIN?>categorie/index.php">
        <i class="fas fa-align-justify"></i>
        <span>Catégories</span></a>
</li> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
    <a class="nav-link" href="<?=URL_ADMIN?>tables.html">
        <i class="fas fa-book-open"></i>
        <span>Livres</span></a>
</li> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
    <a class="nav-link" href="<?=URL_ADMIN?>utilisateur/index.php">
        <i class="fas fa-user-friends"></i>
        <span>Utilisateur</span></a>
</li> -->



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div> -->

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="<?=URL_ADMIN?>img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>
<!-- End of Sidebar -->