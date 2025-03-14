<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\header.css">
    <link rel="stylesheet" href="..\fichier_css\destinations.css">
    <link rel="stylesheet" href="..\fichier_css\footer.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.jpg">
</head>
<body>
<?php include('header.php') ?>
    <video autoplay loop muted id="background-video">
        <source src="..\Image\image_background\background_destination.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
    <div class="container2">
        <div class="fenetre-modale" id="fenetreFiltre">
            <div class="contenu-fenetre">
                <span class="fermer" id="fermerFiltre">&times;</span>
                <h2>Filtres de Voyage</h2>
                <form id="formulaireFiltres">
                    <div class="champ-filtres">
                        <label for="periode">Période :</label>
                        <select id="periode" name="periode">
                            <option value="0">Tous</option>
                            <option value="prehistoire">Préhistoire (avant 3000 av.JC.)</option>
                            <option value="antiquite">Antiquité (3000 av.JC. – 476 apr.JC.)</option>
                            <option value="moyen-age">Moyen Âge (476 – 1492)</option>
                            <option value="renaissance">Renaissance (14e – 17e siècle)</option>
                            <option value="période_moderne">Période Moderne(17e – 19e siècle)</option>
                            <option value="époque_contemporaine">Époque contemporaine (20e – 21e siècle)</option>
                        </select>
                    </div>
    
                    <div class="champ-filtres">
                        <label for="destination">Destination :</label>
                        <input type="text" id="destination" name="destination" placeholder="Ex. Paris, Egypte, Rome">
                    </div>
    
                    <div class="champ-filtres">
                        <label for="typeVoyage">Type de voyage :</label>
                        <select id="typeVoyage" name="typeVoyage">
                            <option value="0">Tous</option>
                            <option value="aventure">Aventure</option>
                            <option value="detente">Détente</option>
                            <option value="culturel">Culturel</option>
                            <option value="historique">Historique</option>
                        </select>
                    </div>

                    <div class="champ-filtres">
                        <label for="niveau_danger">Niveau de danger :</label>
                        <select id="niveau_danger" name="niveau_danger">
                            <option value="0">Tous</option>
                            <option value="1">En toute sérénité : 1</option>
                            <option value="2">Voyageur Prudent : 2</option>
                            <option value="3">Aventure Épicée : 3</option>
                            <option value="4">Tempête Chrono : 4</option>
                        </select>
                    </div>

                    <div class="champ-filtres">
                        <label for="niveau_confort">niveau_confort :</label>
                        <select id="niveau_confort" name="niveau_confort">
                            <option value="0">Tous</option>
                            <option value="1">Dodo à la belle étoile : 1</option>
                            <option value="2">Caverne et Cocooning</option>
                            <option value="3">Luxe de l'Antiquité</option>
                            <option value="4">Royal Time Traveler</option>
                        </select>
                    </div>
    
                    <div class="champ-filtres">
                        <label for="budget">Budget :</label>
                        <input type="number" id="budget" name="budget" placeholder="€" min="0">
                    </div>

                    <div class="Appliquer_filtre">
                        <button type="submit">Appliquer les filtres</button>
                    </div>
                </form>
            </div>
        </div>
        <input type="button" value="Filtrer" id="ouvrirFiltre">
        <form>
            <input type="search" name="rechercher" id="rechercher" placeholder="rechercher...">
            <button type="submit">
                <img src="../Image/image_icône/loupe.png" alt="Rechercher">
            </button>
        </form>
    </div>
    <script src="../fichier_java/filtrer.js"></script>    
    <div class="Voyages">
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Cretaceous_Period.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">Ère des dinosaures <br/>(Crétacé, -66Ma)</h3>
                <p class="description">
                    Partez à l'aventure au temps des dinosaures et explorez un monde fascinant peuplé de créatures préhistoriques.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 1230€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Ancient_Egypt.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">L’Égypte des pharaons <br/>(-3000 à -30 av. J.-C.)</h3>
                <p class="description">
                    Explorez l’Égypte des pharaons, ses pyramides et ses temples. Découvrez une civilisation mythique peuplée de dieux et de mystères.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 900€</span>
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
                    <span class="prix">Dès 900€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Early_Middle_Ages.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">Le Haut Moyen Âge <br/>(476 - 1000)</h3>
                <p class="description">
                    Plongez dans le Haut Moyen Âge, une époque de royaumes en guerre, de châteaux fortifiés et de l’essor du christianisme en Europe.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 1320€</span>
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
                    <span class="prix">Dès 700€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Age_of_Exploration.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">L’Âge des grandes découvertes <br/>(1492 - 1600)</h3>
                <p class="description">
                    Embarquez pour de grandes découvertes, suivez les explorateurs vers de nouvelles terres et marchez sur les traces des pionniers de l’histoire.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 1200€</span>
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
                    <span class="prix">Dès 950€</span>
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
                    <span class="prix">Dès 850€</span>
                    <a href="reservation_révolution.html" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Industrial_Revolution.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Révolution industrielle <br/>(1750 - 1914)</h3>
                <p class="description">
                    Vivez l’avènement de l’industrie et des machines, une époque de transformations rapides dans le travail, la société et l’économie.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 1100€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\ww1_image.jpeg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">La Première Guerre mondiale <br/>(1914 - 1918)</h3>
                <p class="description">
                    Explorez la Première Guerre mondiale, un conflit mondial dévastateur qui change le cours de l’histoire et redéfinit les nations.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 950€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
            </div>
        </div>
        <div>
            <img  class="image_destinations"   src="../Image/Image_voyage_page_destinations\Roaring_Twenties_Prohibition.jpg" alt="ww2_image">
            <div class="zone_texte">
                <h3 class="période">Les Années folles et la Prohibition <br/>(1920 - 1930)</h3>
                <p class="description">
                    Découvrez les Années folles, une époque de jazz, de fêtes et de rébellion pendant la Prohibition, où l’interdit devient un jeu.
                </p>
                <div class="prix_bouton">
                    <span class="prix">Dès 1300€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
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
                    <span class="prix">Dès 650€</span>
                    <a href="" class="en_savoir_plus">En savoir plus</a>
                </div>
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