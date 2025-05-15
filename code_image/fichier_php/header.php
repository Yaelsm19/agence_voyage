<?php 
if (!defined('ACCES_AUTORISE')) {
    http_response_code(403);
    exit("Accès interdit.");
}
?>
<header class="container1">
        <img src="..\Image\image_icône\Passport_logo.png" alt="logo_site" class="logo" id="logo">
        <img src="..\Image\image_icône\mode_sombre.png" alt="logo_mode_sombre" class="logo" id="mode-toggle">
        <nav class="nav_lien">
            <a href="accueil.php" class="lien_accueil">Accueil</a>
            <a href="destinations.php" class="lien_destinations">Destinations</a>
            <?php
            if(isset($_SESSION['grade'])){
                if($_SESSION['grade']=="admin"){
                    echo "<a href='administrateur.php' class='lien_destinations'>Administrateur</a>";
                }
            }
            ?>
        </nav>
    
        <div class="icon_container">
        <?php
        if (isset($_SESSION['nom'])){
            echo '<a href="profil.php" class="lien_profil">
                <img src="../Image/image_icône/people.png" alt="Profil" id="people">
            </a>
            <a href="panier.php" class="lien_panier">
                <img src="../Image/image_icône/panier.png" alt="panier" id="favori">
            </a>';
        }
        ?>
        <a href="presentation.php" class="lien_presentation">
            <img src="../Image/image_icône/info.png" alt="présentation" id="info">
        </a>
        </div>
    <?php
    if (!isset($_SESSION['nom'])) {
        echo '<a href="se_connecter.php" class="lien_se_connecter">Se connecter</a>';
    }
    ?>
</header>