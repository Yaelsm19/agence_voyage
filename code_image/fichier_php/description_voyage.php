<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Pastport</title>
    <link rel="stylesheet" href="description_voyage_V2.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">


</head>
<body>
    <header class="container1">
        <img src="image_icône/Passport_logo.jpg" alt="Logo de l'agence" class="logo">
        
        <nav class="nav_lien">
            <a href="accueil.html" class="lien_accueil">Accueil</a>
            <a href="destinations.html" class="lien_destinations">Destinations</a>
        </nav>
    
        <div class="icon_container">
            <a href="profil.html" class="lien_profil">
                <img src="image_icône/people.png" alt="Profil">
            </a>
            <a href="panier.html" class="lien_panier">
                <img src="image_icône/shopping-cart.png" alt="Panier">
            </a>
            <a href="presentation.html" class="lien_presentation">
                <img src="image_icône/info.png" alt="Présentation">
            </a>
        </div>
    
        <a href="se_connecter.html" class="lien_se_connecter">Se connecter</a>
    </header>
    <h1>Réservation - Voyage à Versailles en 1789</h1>
    <div class="main-content">
        <div class="gallery">
            <img id="mainImage" class="main-image" src="journey_to_versailles_1789.jpg" alt="Image principale">
            <div class="thumbnail-container">
                <span class="arrow" onclick="prevImage()">&#9664;</span>
                <img class="thumbnail active" src="journey_to_versailles_1789.jpg" onclick="changeImage(0)">
                <img class="thumbnail" src="jeu de paume.jpeg" onclick="changeImage(1)">
                <img class="thumbnail" src="ouverture des états généraux.jpeg" onclick="changeImage(2)">
                <span class="arrow" onclick="nextImage()">&#9654;</span>
            </div>
        </div>
        <div class="info-box">
            <h2>A partir de 348$/P</h2>
            <p>Plongez au cœur de la Révolution française et vivez des événements historiques inoubliables. 
            Ce voyage vous transportera à une époque charnière où les idées de liberté et d'égalité ont bouleversé l'ordre établi.
            Vous aurez l'opportunité d'assister à des moments clés de l'Histoire et de découvrir la vie quotidienne de cette époque fascinante.</p>
            <h2>Date de départ</h2>
            <input type="date" id="date" name="date" required>

            <h2>Choisissez la durée de votre voyage :</h2>
            <input type="number" id="days" name="days" min="1" max="7" value="1">

            <h2>Avec combien de personnes</h2>
            <input type="number" id="personnes" name="personnes" min="1" max="5" value="1">



        </div>
    </div>

    <script src="defilement_image.js"></script>
    <br>
    <br>
    <div class = "second-content">
        <div class = "option">
            <label>
                <div>
                    <h2>Etape 1 : Serment du jeu de Paume</h2>
                    <div class="counter-text">
                        <input type="number" id="Day1_1_ver" name="nb_participant" min="0" max="5" value="0">
                        <p>Place en première loge pour le serment du jeu de Paume : +100$</p>
                    </div>
                    <div class="counter-text">
                        <input type="number" id="Day1_2_ver" name="nb_participant" min="0" max="5" value="0">
                        <p>Repas par personne : +20$</p>
                    </div>
                    <div class="counter-text">
                        <input type="number" id="Day1_3_ver" name="nb_participant" min="0" max="5" value="0">
                        <p>Hebergement par personne : +200$</p>
                    </div>
                </div>
            </label>
        </div>


        <div class = "info-box">
            <h2>Quel moyen de voyage dans le temps désirez-vous :</h2>
            <div class="transport">
                <label>
                    <input type="radio" name="choix" value="option1">
                    <b>Montre temporelle : </b>+1000$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option2">
                    <b>Le portail temporel : </b>+100$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option3">
                    <b>La cabine temporel : </b>+0$
                </label><br>
            </div>
            <h2>Désirez-vous un guide temporel ?</h2>
            <div class="guide">
                <label>
                    <input type="radio" name="choix" value="option1">
                    <b>Guide de luxe : </b>+600$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option2">
                    <b>Guide un peu mid : </b>+30$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option3">
                    <b>Pas de guide : </b>+0$
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option3">
                    <b>Guide déboussolant : </b>-150$
                </label><br>
            </div>
        </div>
    </div>
    <button type="submit">Réserver</button>


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
                    <li><a href="Mentions_légales.html" target="_blank">Mentions légales</a></li>
                    <li><a href="Politique_confidentialité.html" target="_blank">Politique de confidentialité</a></li>
                    <li><a href="contact.html" target="_blank">Contact</a></li>
                    <li><a href="FAQ.html" target="_blank">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="réseaux-sociaux">
                    <a href="#" ><img src="image_icône/facebook_logo.jpg" alt="Facebook"></a>
                    <a href="#" ><img src="image_icône/twitter_logo.jpg" alt="Twitter"></a>
                    <a href="#" ><img src="image_icône/logo_instagram.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p>&copy; 2025 Pastport - Tous droits réservés.</p>
    </footer>
    
</body>
</html>