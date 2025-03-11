<header class="container1">
        <img src="..\Image\image_icône\Passport_logo.jpg" alt="logo_site" class="logo">
        
        <nav class="nav_lien">
            <a href="accueil.php" class="lien_accueil">Accueil</a>
            <a href="destinations.php" class="lien_destinations">Destinations</a>
        </nav>
    
        <div class="icon_container">
            <a href="profil.php" class="lien_profil">
                <img src="../Image/image_icône/people.png" alt="Profil">
            </a>
            <a href="panier.php" class="lien_panier">
                <img src="../Image/image_icône/shopping-cart.png" alt="panier">
            </a>
            <a href="presentation.php" class="lien_presentation">
                <img src="../Image/image_icône/info.png" alt="présentation">
            </a>
        </div>
    <?php
    if (isset($_SESSION['nom_utilisateur'])) {
        echo '<a href="profil.php">' . htmlspecialchars($_SESSION['nom_utilisateur']) . '</a>'; // Affiche le nom d'utilisateur
    } else {
        echo '<a href="se_connecter.php" class="lien_se_connecter">Se connecter</a>Se connecter</a>';
    }
    ?>
</header>