<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="stylesheet" href="..\fichier_css\accueil.css">
    <link rel="icon"  href="../Image/image_icône/Passport_logo.jpg">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
</head>
<body>
    <?php include('header.php') ?>
    <video autoplay loop muted id="background-video">
        <source src="../Image/image_background\effet_image.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
    <div class="bannière">
        <h2>Bienvenue chez Pastport</h2>
        <h3>"Voyager dans le passé, c'est savourer les moments d'hier<br/>tout en découvrant les leçons qu'ils nous offrent pour aujourd'hui."</h3>
    </div>
    <div class="container2">
        <div class="info1">
            <h4>Voyages Sur-Mesure</h4>
            <p>Voyagez dans le passé selon vos envies : assistez à la construction des pyramides ou vivez la Révolution française avec des expériences sur-mesure.</p>
        </div>
        <div class="info2">
            <h4>Nos Garanties</h4>
            <p>Voyagez en toute sécurité grâce à nos technologies avancées de contrôle temporel. Nous garantissons une expérience 100% immersive sans interférer avec le cours de l’histoire</p>
        </div>
        <div class="info3">
            <h4>L'Histoire de l'Agence</h4>
            <p>Pastport, fondée par des passionnés d’histoire et de technologie, vous offre des voyages uniques dans le temps. Des milliers de voyageurs ont déjà exploré les âges.</p>
        </div>
    </div>
    <div class="offre-bannière">
        <h2>Nos offres du moment</h2>
    </div>
    <div class="Voyages">
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Ancient_Egypt.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">L’Égypte des pharaons <br/>(-3000 à -30 av. J.-C.)</h3>
                <p class="description">
                    Explorez l’Égypte des pharaons, ses pyramides et ses temples. Découvrez une civilisation mythique peuplée de dieux et de mystères.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">1300€</span> <span class="nouveau-prix">Dès 900€</span></p>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Ancient_Greece.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Grèce antique <br/>(-1200 à -146 av. J.-C.)</h3>
                <p class="description">
                    Vivez l’âge d’or de la Grèce antique, où les cités rivales brillent par leurs héros, leurs philosophies et leurs Jeux Olympiques.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">1200€</span> <span class="nouveau-prix">Dès 900€</span></p>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Knights_and_Crusades.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">L’Âge des chevaliers et des croisades <br/>(1000 - 1300)</h3>
                <p class="description">
                    Voyagez avec les chevaliers du Moyen Âge, à la conquête des terres saintes lors des croisades, dans un monde de batailles et de foi.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">900€</span> <span class="nouveau-prix">Dès 700€</span></p>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Renaissance.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Renaissance <br/>(1400 - 1600)</h3>
                <p class="description">
                    Vivez l’épanouissement de l’art et de la science, où des génies comme Léonard de Vinci transforment la culture européenne.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">1100€</span> <span class="nouveau-prix">Dès 950€</span></p>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\French_Revolution_Napoleon.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Révolution française et Napoléon <br/>(1789 - 1815)</h3>
                <p class="description">
                    Revivez la Révolution française et l’ascension de Napoléon, une époque de bouleversements politiques et de combats pour la liberté.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">1100€</span> <span class="nouveau-prix">Dès 850€</span></p>
                    <a href="reservation_révolution.html" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\ww2_image.jpeg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Seconde Guerre mondiale <br/>(1939 - 1945)</h3>
                <p class="description">
                    Plongez dans la Seconde Guerre mondiale, un conflit majeur marqué par la résistance et les luttes pour la liberté.
                </p>
                <div class="prix_bouton">
                    <p class="prix_container"><span class="ancien-prix">1000€</span> <span class="nouveau-prix">Dès 650€</span></p>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="voyage-box">
            <img src="../Image/Image_voyage_page_destinations/Tout_voyage.jpg" alt="Tous les voyages">
            <h3>Découvrez de nombreux autres voyages</h3>
            <a href="destinations.php" class="Découvrir">Découvrir</a>
        </div>
    </div>
    <div class="section-citations">
        <h2 class="titre-citations">Ce que nos clients disent</h2>
        <div class="citations">
            <div class="citation">
                <p class="texte-citation">"Voyager dans le passé avec Pastport a été une expérience incroyable. L’immersion était totale!"</p>
                <p class="auteur">Jean Dupont, Voyageur en Égypte</p>
            </div>
            <div class="citation">
                <p class="texte-citation">"Une aventure inoubliable ! J'ai vécu la Révolution française comme si j’y étais."</p>
                <p class="auteur">Marie Leblanc, Voyageuse en France</p>
            </div>
            <div class="citation">
                <p class="texte-citation">"L’expérience de la Grèce antique m’a permis de découvrir des événements historiques fascinants en personne."</p>
                <p class="auteur">Pierre Martin, Voyageur en Grèce</p>
            </div>
        </div>
    </div>
      
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>À propos de nous</h3>
                <p>
                    Voyagez dans le temps avec notre agence et explorez les périodes les plus fascinantes de l’histoire humaine !
                </p>
            </div>
    
            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul class="footer-liens">
                    <li><a href="Mentions_légales.php" target="_blank">Mentions légales</a></li>
                    <li><a href="Politique_confidentialité.php" target="_blank">Politique de confidentialité</a></li>
                    <li><a href="contact.php" target="_blank">Contact</a></li>
                    <li><a href="FAQ.php" target="_blank">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="réseaux-sociaux">
                    <a href="#" ><img src="../Image/image_icône/facebook_logo.jpg" alt="Facebook"></a>
                    <a href="#" ><img src="../Image/image_icône/twitter_logo.jpg" alt="Twitter"></a>
                    <a href="#" ><img src="../Image/image_icône/logo_instagram.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p>&copy; 2025 Pastport - Tous droits réservés.</p>
    </footer>
    
</body>
</html>