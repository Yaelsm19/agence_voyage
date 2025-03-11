<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Pastport</title>
    <link rel="stylesheet" href="..\fichier_css\reservation_révolution.css">
    <link rel="icon" href="../Image/image_icône/Passport_logo.jpg">
</head>
<body>
    <header>
        <h1>Réservation - Voyage à Versailles en 1789</h1>
    </header>
    <section class="presentation">
        <p>Plongez au cœur de la Révolution française et vivez des événements historiques inoubliables. 
            Ce voyage vous transportera à une époque charnière où les idées de liberté et d'égalité ont bouleversé l'ordre établi.
            Vous aurez l'opportunité d'assister à des moments clés de l'Histoire et de découvrir la vie quotidienne de cette époque fascinante.</p>
    </section>
    <section class="reservation">
        <h2>Personnalisez votre voyage</h2>
        <form id="reservation-form">
            <h3>Date de départ</h3>
            <input type="date" id="date" name="date" required>

            <h3>Choisissez la durée de votre voyage :</h3>
            <input type="number" id="days" name="days" min="1" max="7" value="1">

            <h3>Choisissez vos événements :</h3>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Serment du jeu de Paume</h4>
                        <p>Le Serment du Jeu de Paume du 20 juin 1789 marque un acte fondateur de la Révolution française. Les députés du Tiers-État, exclus de l'Assemblée, jurent de ne pas se séparer avant d'avoir rédigé une nouvelle constitution, défiant ainsi l'autorité royale.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\jeu de paume.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Ouverture des États généraux</h4>
                        <p>Louis XVI convoque les États généraux à Versailles pour tenter de résoudre la crise financière qui frappe la France. Les représentants des trois ordres (noblesse, clergé, tiers état) se réunissent, mais rapidement, des tensions éclatent, car le tiers état réclame une réforme du système de vote, refusant que la noblesse et le clergé aient plus de poids malgré leur faible nombre.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\ouverture des états généraux.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Création de l'Assemblée nationale</h4>
                        <p>Face au refus du roi et des privilégiés de réformer le système politique, les députés du tiers état prennent l’initiative et se proclament "Assemblée nationale", affirmant représenter la souveraineté du peuple français. Cette action marque le début de la fin de la monarchie absolue et du basculement vers un régime constitutionnel.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\création de l'assemblé national.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Réunion des trois ordres sous pression du roi</h4>
                        <p>Sous la pression des événements et après plusieurs jours de tensions, Louis XVI cède et ordonne au clergé et à la noblesse de rejoindre l'Assemblée nationale. Cette décision officialise la fin de la séparation des ordres et consacre l’Assemblée comme seul corps législatif légitime, affaiblissant considérablement l’autorité royale.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\réunion des trois ordres.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Révolte des Gardes Françaises à Versailles </h4>
                        <p>Chargés de maintenir l'ordre à Versailles et Paris, plusieurs soldats des Gardes Françaises se mutinent et rejoignent les révolutionnaires, refusant de réprimer le peuple. Leur soutien facilite la prise de la Bastille le 14 juillet, car ils apportent une expertise militaire et des armes aux insurgés parisiens.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\révolte des gardes francaise.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Déclaration des droits de l'homme et du citoyen</h4>
                        <p>Adoptée par l’Assemblée nationale, cette déclaration proclame les principes fondamentaux de la Révolution : égalité des citoyens, liberté individuelle, souveraineté nationale et fin des privilèges de l'Ancien Régime. Inspirée des Lumières et de la Révolution américaine, elle devient un texte fondateur des valeurs républicaines françaises.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\déclaration des droits de l'homme.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <div class="jour">

                <label>
                    <input type="checkbox" name="events" value="Serment du Jeu de Paume">
                    <div>
                        <h4>Journées d’Octobre : la marche sur Versailles</h4>
                        <p>Affamées par la pénurie de pain, des milliers de femmes de Paris marchent sur Versailles pour réclamer du roi des mesures concrètes. Après une nuit de tensions et une intrusion dans le château, elles forcent Louis XVI et sa famille à quitter Versailles pour s’installer aux Tuileries à Paris, mettant ainsi fin à Versailles comme centre du pouvoir royal.</p>
                    </div>
                </label><br>
                <img src="..\Image\image_voyage_description\journée d'octobre.jpeg" alt="Serment du Jeu de Paume">         
            </div>
            <h3>Quel moyen de voyage dans le temps désirez-vous :</h3>
            <div class="transport">
                <label>
                    <input type="radio" name="choix" value="option1">
                    <b>Montre temporelle :</b>elle vous permet de vous téléporter n'importe ou dans le passé puis de revenir ici au moment souhaité, c'est de loin le moyen le plus sécuritaire, pour seulement 1000 € de plus.
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option2">
                    <b>Le portail temporel :</b>il permet de se téléporter n'importe ou dans le passé mais nécessite de repartir depuis le portail qui se sera formé dans le passé pour seulement 100€ de plus vous pouvez le prendre
                </label><br>
                <label>
                    <input type="radio" name="choix" value="option3">
                    <b>La cabine temporel :</b>elle permet d'aller de cabine temporelle en cabine temporelle on peut donc uniquement aller aux cabines déjà construite dans le passé de même pour le retour
                </label><br>
            </div>
            <button type="submit">Réserver</button>
        </form>
        <a href="accueil.html">
            <button class="retour">
                <img src="..\Image\image_icône\en-arriere.png" alt="modifier">
            </button>
        </a>
    </section>
</body>
</html>