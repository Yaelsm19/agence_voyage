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
        <source src="..\Image\image_background\effet_image.mp4" type="video/mp4">
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
        <form method="POST" action="destinations.php">
            <input type="search" name="rechercher" id="rechercher" placeholder="rechercher...">
                <button type="submit">
                    <img src="../Image/image_icône/loupe.png" alt="Rechercher">
                </button>
            </form>
    </div>
    <script src="../fichier_java/filtrer.js"></script>
    <?php include('recherche_voyage.php') ?>