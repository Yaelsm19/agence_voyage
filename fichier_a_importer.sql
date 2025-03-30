-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 mars 2025 à 15:00
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pastport`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_transaction` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_reservation` int NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `vendeur` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_achat` date NOT NULL,
  `heure_achat` time NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `id_reservation` (`id_reservation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id_transaction`, `id_reservation`, `montant`, `vendeur`, `date_achat`, `heure_achat`) VALUES
('OcGi1PaSNAgd2TdZdpHk', 2, 5790.00, 'MEF-1_J', '2025-03-30', '16:44:58');

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_voyage` int NOT NULL,
  `chronologie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_voyage` (`id_voyage`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`id`, `titre`, `id_voyage`, `chronologie`) VALUES
(1, 'Atterrissage mouvementé dans un nid de ptérodactyles', 1, 1),
(2, 'Pique-nique interrompu par un T-Rex affamé rugissant', 1, 2),
(3, 'Cours de danse jurassique avec des vélociraptors sympas', 1, 3),
(4, 'Baignade volcanique avec les diplodocus du coin', 1, 4),
(5, 'Fuite héroïque d’une pluie de météorites surprises', 1, 5),
(6, 'Réveil surprise dans un sarcophage cinq étoiles doré', 2, 1),
(7, 'Chasse au trésor avec un chat sacré grincheux', 2, 2),
(8, 'Concours de danse sur la rampe d’une pyramide', 2, 3),
(9, 'Dîner royal avec Ramsès et ses jokes de pharaon', 2, 4),
(10, 'Réveil brutal par un philosophe en pleine dispute', 3, 1),
(11, 'Combat d’arène annulé à cause d’un bouclier oublié', 3, 2),
(12, 'Banquet olympien avec Zeus qui mange tout le fromage', 3, 3),
(13, 'Séance de yoga antique sur l’Acropole en sandales', 3, 4),
(14, 'Débat politique musclé avec un Socrate très bavard', 3, 5),
(15, 'Course de chars sabotée par un pigeon très vénère', 3, 6),
(16, 'Réveil musical par un troubadour trop enthousiaste', 4, 1),
(17, 'Tournoi de chevaliers saboté par un canard viking', 4, 2),
(18, 'Mission quête du Graal mais avec un GPS en latin', 4, 3),
(19, 'Adoubement officiel avec banquet et vin un peu trop fort', 5, 1),
(20, 'Départ pour Jérusalem en suivant une carte à l’envers', 5, 2),
(21, 'Marché médiéval : troc d’épée contre miche de pain', 5, 3),
(22, 'Retour glorieux, mais personne ne reconnaît le chevalier', 5, 4),
(23, 'Préparatifs chaotiques avant l’embarquement vers l’inconnu', 6, 1),
(24, 'Capitaine perdu dans les étoiles sans boussole fiable', 6, 2),
(25, 'Escale imprévue pour troquer des épices contre un perroquet', 6, 3),
(26, 'Découverte d’une île... déjà habitée et très animée', 6, 4),
(27, 'Retour au port, héros fêté malgré un détour de deux mois', 6, 5),
(28, 'Rencontre avec Léonard de Vinci dans son atelier secret', 7, 1),
(29, 'Défilé de mode renaissance avec fraise géante et velours', 7, 2),
(30, 'Concours de poésie saboté par un duel d’escrimeurs jaloux', 7, 3),
(31, 'Discours enflammé au club des Jacobins très agité', 8, 1),
(32, 'Évasion improvisée lors d’une prise de la Bastille touristique', 8, 2),
(33, 'Défilé révolutionnaire avec bonnet phrygien mal ajusté', 8, 3),
(34, 'Rencontre furtive avec Napoléon avant son départ triomphal', 8, 4),
(35, 'Visite d’une usine textile envahie par des bobines rebelles', 9, 1),
(36, 'Pause thé dans un train à vapeur en marche', 9, 2),
(37, 'Manifestation ouvrier interrompue par une pluie de suie', 9, 3),
(38, 'Rencontre inspirante avec un inventeur couvert de cambouis', 9, 4),
(39, 'Bal mécanique au son grinçant des premières machines', 9, 5),
(40, 'Entraînement express avec un sergent très... expressif', 10, 1),
(41, 'Correspondance secrète', 10, 2),
(42, 'Partie de football improvisée entre deux tranchées boueuses', 10, 3),
(43, 'Mission éclaireuse annulée à cause d’un pigeon distrait', 10, 4),
(44, 'Repas au front partagé avec un rat très sociable', 10, 5),
(45, 'Retour en gare sous les confettis d’un armistice émouvant', 10, 6),
(46, 'Soirée clandestine dans un speakeasy bondé de jazzmen', 11, 1),
(47, 'Charleston endiablé sur une table de bar renversée', 11, 2),
(48, 'Course-poursuite en voiture rétro avec des agents zélés', 11, 3),
(49, 'Briefing stratégique dans un bunker à l’éclairage douteux', 12, 1),
(50, 'Parachutage nocturne un peu trop proche d’une ferme', 12, 2),
(51, 'Mission radio camouflée sous une recette de soupe aux choux', 12, 3),
(52, 'Libération d’un village saluée par une pluie de fleurs', 12, 4),
(53, 'Devenir influenceur politique au Forum Romain', 13, 1),
(54, 'Participer à un combat de gladiateurs… en pyjama', 13, 2),
(55, 'Dîner avec Jules César et sa cuisine excentrique', 13, 3),
(56, 'Course de chars : la compétition la plus folle de Rome', 13, 4),
(57, 'Visite guidée de Rome', 13, 5),
(58, 'La conférence de Yalta', 14, 1),
(59, 'Le lancement de Spoutnik', 14, 2),
(60, 'L’alunissage d\'Apollo 11', 14, 3),
(61, 'La chute du mur de Berlin', 14, 4),
(62, 'Escalade de la guerre', 15, 1),
(63, 'L\'Offensive du Têt', 15, 2),
(64, 'La chute de Saïgon', 15, 3);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id_option` int NOT NULL AUTO_INCREMENT,
  `id_etape` int NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `prix_par_personne` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_option`),
  KEY `id_etape` (`id_etape`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id_option`, `id_etape`, `intitule`, `prix_par_personne`) VALUES
(1, 1, 'Hébergement : Hamac suspendu entre deux ptérodactyles', 300.00),
(2, 1, 'Équipement : Kit de survie pour atterrissage mouvementé', 150.00),
(3, 2, 'Restauration : Pique-nique d\'époque avec fruits et insectes géants', 200.00),
(4, 2, 'Activités : Cours express d\'esquive de dinosaures', 180.00),
(5, 3, 'Activités : Cours particulier de danse avec un vélociraptor', 250.00),
(6, 3, 'Équipement : Tunique en peau de mammouth pour danser en toute sécurité', 100.00),
(7, 4, 'Activités : Bain de boue volcanique relaxant', 200.00),
(8, 4, 'Restauration : Cocktail jurassique servi dans une noix de coco', 150.00),
(9, 5, 'Mode de transport vers la prochaine étape : Météorite express', 250.00),
(10, 5, 'Hébergement : Refuge souterrain anti-météorites avec service inclus', 300.00),
(11, 6, 'Hébergement : Nuit de luxe dans un sarcophage doré', 400.00),
(12, 6, 'Restauration : Dîner pharaonique avec pain et bière d\'époque', 180.00),
(13, 7, 'Activités : Visite nocturne des pyramides avec torches magiques', 250.00),
(14, 7, 'Activités : Chasse au trésor avec guide sacré', 200.00),
(15, 8, 'Mode de transport vers la prochaine étape : Voyage à dos de chameau', 250.00),
(16, 8, 'Activités : Cours express de descente de pyramide en toboggan', 180.00),
(17, 9, 'Restauration : Dîner royal avec Ramsès et 100 plats différents', 350.00),
(18, 9, 'Activités : Spectacle de danse orientale en bonus', 200.00),
(19, 10, 'Hébergement : Nuit spartiate dans une école philosophique', 150.00),
(20, 10, 'Restauration : Repas antique avec olives et fromage de chèvre', 180.00),
(21, 11, 'Mode de transport vers la prochaine étape : Char romain', 300.00),
(22, 11, 'Activités : Initiation au combat de gladiateurs (option sans blessures)', 250.00),
(23, 12, 'Restauration : Banquet divin avec nectar et ambroisie', 400.00),
(24, 12, 'Activités : Cours de lancer de foudre avec Zeus (non remboursable)', 350.00),
(25, 13, 'Activités : Séance de méditation au sommet de l\'Acropole', 200.00),
(26, 13, 'Équipement : Sandales anti-dérapantes pour yoga antique', 100.00),
(27, 14, 'Mode de transport vers la prochaine étape : Barque antique', 180.00),
(28, 14, 'Activités : Cours express “Débattre comme un vrai philosophe”', 180.00),
(29, 15, 'Activités : Course de chars privée avec pigeons enragés', 250.00),
(30, 15, 'Équipement : Tunique officielle de penseur grec', 120.00),
(31, 16, 'Hébergement : Auberge médiévale animée', 220.00),
(32, 16, 'Activités : Concert privé de troubadour avant le coucher', 180.00),
(33, 17, 'Mode de transport vers la prochaine étape : Diligence médiévale avec sièges en bois', 250.00),
(34, 17, 'Activités : Tournoi de chevaliers avec équipement inclus', 250.00),
(35, 18, 'Équipement : Carte du Graal en version latine et vieux français', 180.00),
(36, 18, 'Restauration : Ragoût de l\'époque servi dans une taverne', 200.00),
(37, 19, 'Hébergement : Nuit dans un château avec armure décorative', 300.00),
(38, 19, 'Restauration : Festin de chevalier avec viande rôtie et hydromel', 350.00),
(39, 20, 'Mode de transport vers la prochaine étape : Navigation erratique avec un capitaine distrait', 150.00),
(40, 20, 'Restauration : Dégustation de vin médiéval', 200.00),
(41, 21, 'Activités : Cours express de marchandage médiéval', 120.00),
(42, 21, 'Restauration : Dégustation de pain rustique et fromage vieilli', 180.00),
(43, 22, 'Hébergement : Auberge rustique pour chevaliers en détresse', 200.00),
(44, 22, 'Activités : Bal médiéval avec troubadours et danses d\'époque', 180.00),
(45, 23, 'Hébergement : Hamac sur le pont du navire', 180.00),
(46, 23, 'Restauration : Dîner de marin avec poisson séché et rhum', 200.00),
(47, 24, 'Mode de transport vers la prochaine étape : Radeau improvisé', 150.00),
(48, 24, 'Équipement : Carte marine griffonnée par un vieux loup de mer', 120.00),
(49, 25, 'Hébergement : Nuit dans une cabane perchée sur l\'île inconnue', 200.00),
(50, 25, 'Restauration : Banquet tropical avec fruits exotiques et jus de noix de coco', 250.00),
(51, 26, 'Mode de transport vers la prochaine étape : Retour en radeau de fortune', 250.00),
(52, 26, 'Activités : Excursion sur l\'île avec guide local (parle trois mots de français)', 180.00),
(53, 27, 'Hébergement : Auberge de retour d\'expédition', 200.00),
(54, 27, 'Restauration : Dîner de retrouvailles avec mets exotiques importés', 250.00),
(55, 28, 'Hébergement : Nuit dans l\'atelier secret de Léonard de Vinci', 300.00),
(56, 28, 'Activités : Leçon de peinture et croquis avec le maître', 250.00),
(57, 29, 'Mode de transport vers la prochaine étape : Carrosse Renaissance', 250.00),
(58, 29, 'Restauration : Dîner Renaissance avec service en argent massif', 400.00),
(59, 30, 'Équipement : Robe d\'époque et perruque offerte', 350.00),
(60, 30, 'Activités : Bal en salle avec duel d\'escrime en clôture', 250.00),
(61, 31, 'Hébergement : Nuit chez un révolutionnaire sympathique', 180.00),
(62, 31, 'Restauration : Dîner révolutionnaire avec pain noir et soupe chaude', 150.00),
(63, 32, 'Mode de transport vers la prochaine étape : Évasion nocturne en charrette bâchée', 200.00),
(64, 32, 'Restauration : Dégustation de vin clandestin en cachette', 200.00),
(65, 33, 'Restauration : Dîner d\'époque avec pain et fromage de contrebande', 180.00),
(66, 33, 'Activités : Atelier de fabrication de cocardes révolutionnaires', 150.00),
(67, 34, 'Mode de transport vers la prochaine étape : Bateau rapide', 250.00),
(68, 34, 'Activités : Souper secret avec Napoléon (option trahison incluse)', 300.00),
(69, 35, 'Mode de transport vers la prochaine étape : Tramway industriel', 250.00),
(70, 35, 'Hébergement : Nuit dans une usine textile envahie par des bobines rebelles', 180.00),
(71, 36, 'Mode de transport vers la prochaine étape : Voiture de luxe à vapeur', 250.00),
(72, 36, 'Restauration : Pause thé dans un wagon à vapeur', 200.00),
(73, 37, 'Mode de transport vers la prochaine étape : Bus ouvrier vintage', 250.00),
(74, 37, 'Activités : Participation à une manifestation créative', 200.00),
(75, 38, 'Mode de transport vers la prochaine étape : Chariot à huile de cambouis', 250.00),
(76, 38, 'Activités : Atelier cambouis avec un inventeur inspiré', 200.00),
(77, 39, 'Restauration : Buffet mécanique aux spécialités industrielles', 350.00),
(78, 39, 'Activités : Bal mécanique au son des premières machines', 300.00),
(79, 40, 'Mode de transport vers la prochaine étape : Véhicule militaire express', 250.00),
(80, 40, 'Activités : Séance d\'entraînement express avec exercices surprises', 250.00),
(81, 41, 'Mode de transport vers la prochaine étape : Chariot postal antique', 300.00),
(82, 41, 'Équipement : Plume d\'or pour correspondance secrète', 250.00),
(83, 42, 'Mode de transport vers la prochaine étape : Tram de campagne boueux', 250.00),
(84, 42, 'Activités : Football improvisé dans les tranchées', 150.00),
(85, 43, 'Mode de transport vers la prochaine étape : Montgolfière éclair', 250.00),
(86, 43, 'Activités : Briefing stratégique éclair', 200.00),
(87, 44, 'Mode de transport vers la prochaine étape : Chariot de ravitaillement', 250.00),
(88, 44, 'Restauration : Festin front de tranchées', 200.00),
(89, 45, 'Hébergement : Nuit festive en gare de l\'armistice', 150.00),
(90, 45, 'Restauration : Buffet de confettis armistice', 180.00),
(91, 46, 'Mode de transport vers la prochaine étape : Taxi jazz clandestin', 250.00),
(92, 46, 'Restauration : Cocktails clandestins et tapas jazz', 400.00),
(93, 47, 'Mode de transport vers la prochaine étape : Limousine swing des années folles', 250.00),
(94, 47, 'Activités : Atelier Charleston endiablé', 300.00),
(95, 48, 'Restauration : Dîner de course-poursuite rétro', 350.00),
(96, 48, 'Activités : Poursuite interactive avec agents zélés', 300.00),
(97, 49, 'Mode de transport vers la prochaine étape : Véhicule blindé stratégique', 250.00),
(98, 49, 'Activités : Briefing stratégique éclair', 200.00),
(99, 50, 'Mode de transport vers la prochaine étape : Parachute de relance', 250.00),
(100, 50, 'Activités : Saut nocturne d\'adrénaline', 250.00),
(101, 51, 'Mode de transport : Fourgon radio mobile', 250.00),
(102, 51, 'Équipement : Kit radio espion', 150.00),
(103, 52, 'Hébergement : Nuit champêtre en pleine libération', 300.00),
(104, 52, 'Restauration : Dîner festif avec pluie de fleurs comestibles', 200.00),
(105, 53, 'Moyen de transport : Voyage en calèche romaine vers le Forum Romain.', 300.00),
(106, 53, 'Équipement : Tunique romaine et sandales.', 150.00),
(107, 54, 'Activité : Rejoindre une équipe de gladiateurs amateurs.', 200.00),
(108, 54, 'Équipement : Tenue de gladiateur modifiée en pyjama confortable !', 100.00),
(109, 55, 'Restauration : Repas d\'honneur dans une villa romaine.', 550.00),
(110, 55, 'Hébergement : Nuit dans une domus romaine.', 500.00),
(111, 56, 'Moyen de transport : Cheval !!', 600.00),
(112, 56, 'Équipement : T-shirt blanc !!', 550.00),
(113, 57, 'Transport vers la visite : Trottinette romaine.', 700.00),
(114, 57, 'Hébergement : Séjour dans une auberge romaine !', 800.00),
(115, 58, 'Moyen de transport : Voyage en train à grande vitesse vers Moscou.', 1000.00),
(116, 58, 'Activité : Assiste à un dîner diplomatique.', 1200.00),
(117, 59, 'Moyen de transport : Navette spatiale soviétique !', 450.00),
(118, 59, 'Équipement : Uniforme de cosmonaute soviétique.', 550.00),
(119, 60, 'Moyen de transport - Vol commercial transatlantique pour te rendre à Berlin.', 350.00),
(120, 60, 'Activité : Participer à une retransmission en direct de l\'alunissage à la Maison Blanche.', 600.00),
(121, 61, 'Hébergement : Séjourner dans un hôtel de Berlin-Ouest, juste à côté du mur.', 250.00),
(122, 61, 'Restauration : Profiter d\'un repas à l\'auberge locale pour partager un repas avec les habitants.', 150.00),
(123, 62, 'Équipement : Uniforme militaire américain, avec un casque et des bottes.', 350.00),
(124, 62, 'Activité : Participer à une patrouille de reconnaissance dans la jungle vietnamienne.', 500.00),
(125, 63, 'Moyen de transport - Embarquer à bord d\'un hélicoptère de transport militaire.', 450.00),
(126, 63, 'Restauration : Ration de combat. ', 120.00),
(127, 64, 'Hébergement : Séjourner dans un hôtel à Saïgon.', 180.00),
(128, 64, 'Activité : Participer à une évasion précipitée de l\'ambassade américaine. ', 550.00);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_voyage` int NOT NULL,
  `date_reservation` date NOT NULL,
  `heure_reservation` time NOT NULL,
  `date_voyage` date NOT NULL,
  `nb_adultes` int NOT NULL,
  `nb_enfants` int NOT NULL,
  `moyen_transport` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `guide` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_voyage` (`id_voyage`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `id_utilisateur`, `id_voyage`, `date_reservation`, `heure_reservation`, `date_voyage`, `nb_adultes`, `nb_enfants`, `moyen_transport`, `guide`) VALUES
(2, 3, 2, '2025-03-30', '14:44:15', '1010-01-01', 2, 1, 'Montre temporelle', 'Guide un peu mid');

-- --------------------------------------------------------

--
-- Structure de la table `souscrire`
--

DROP TABLE IF EXISTS `souscrire`;
CREATE TABLE IF NOT EXISTS `souscrire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_reservation` int NOT NULL,
  `id_option` int NOT NULL,
  `nb_personnes` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_reservation` (`id_reservation`),
  KEY `id_option` (`id_option`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `souscrire`
--

INSERT INTO `souscrire` (`id`, `id_reservation`, `id_option`, `nb_personnes`) VALUES
(1, 22, 12, 1),
(2, 22, 17, 2),
(3, 23, 12, 1),
(4, 23, 17, 2),
(5, 24, 12, 1),
(6, 24, 17, 2),
(7, 25, 12, 1),
(8, 25, 17, 2),
(9, 26, 12, 1),
(10, 26, 17, 2),
(11, 27, 12, 1),
(12, 27, 17, 2),
(13, 28, 12, 1),
(14, 28, 17, 2),
(15, 29, 12, 1),
(16, 29, 17, 2),
(17, 30, 12, 1),
(18, 30, 17, 2),
(19, 31, 12, 1),
(20, 31, 17, 2),
(21, 32, 12, 1),
(22, 32, 17, 2),
(23, 33, 12, 1),
(24, 33, 17, 2),
(25, 34, 12, 1),
(26, 34, 17, 2),
(27, 35, 12, 2),
(28, 35, 14, 2),
(29, 35, 18, 1),
(30, 36, 12, 2),
(31, 36, 14, 2),
(32, 36, 17, 2),
(33, 36, 18, 1),
(34, 37, 12, 2),
(35, 37, 14, 2),
(36, 37, 17, 2),
(37, 37, 18, 1),
(38, 38, 45, 1),
(39, 38, 47, 1),
(40, 40, 29, 1),
(41, 42, 80, 6),
(42, 43, 79, 5),
(43, 43, 81, 8),
(44, 43, 85, 6),
(45, 43, 88, 6),
(46, 43, 90, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user_id`, `prenom`, `nom`, `email`, `numero`, `mot_de_passe`, `grade`) VALUES
(1, 'Yaël', 'Saoudi--Méar', 'yaelsm19@gmail.com', '0634472031', '$2y$10$lYoAROBMffj9NNQgFLQLs.EqbdyDK3agKnc5UpAp8UmBnGzs8N/eO', 'admin'),
(2, 'Adrien', 'Girard--Ravelonarisoa', 'adrienmamygirard@gmail.com', '0769478678', '$2y$10$te2suDz1VACWYrb/4V9EmeK2z459J00rlcCoA0szuAUgo9gtH3RKe', 'admin'),
(3, 'Océane', 'Morel', 'oce.momo@gmail.com', '0707070707', '$2y$10$J0BLUq038jR3vScmeZbWfuH7L4IebvYmD4XmknidEP4aqIJytqH7G', 'VIP'),
(4, 'Frank', 'ngakoli', 'frankfrank@gmail.com', '0606060606', '$2y$10$SeagUhnYor43WQka/k0GHu7kltWaOddjmSMlNIx3btzg9C2ZAv3jS', 'membre'),
(5, 'Maëlle', 'Smimi', 'Smimi@gmail.com', '0505050505', '$2y$10$m2TCVs4NCofz6jnCDNwC3OipPAFwjgrbvNadMvmhTpkxFTuMXtcQy', 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `duree` int NOT NULL,
  `image_reservation1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_reservation2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_reservation3` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `titre`, `image`, `description`, `prix`, `duree`, `image_reservation1`, `image_reservation2`, `image_reservation3`) VALUES
(1, 'Ère des dinosaures (Crétacé, -66Ma)', 'Cretaceous_Period.jpg', 'Partez à l\'aventure au temps des dinosaures et explorez un monde fascinant peuplé de créatures préhistoriques.', 1230.00, 5, 'Dinosaure1', 'Dinosaure2', 'Dinosaure3'),
(2, 'L’Égypte des pharaons (-3000 à -30 av. J.-C.)', 'Ancient_Egypt.jpg', 'Explorez l’Égypte des pharaons, ses pyramides et ses temples. Découvrez une civilisation mythique peuplée de dieux et de mystères.', 900.00, 4, 'pharaon1', 'pharaon2', 'pharaon3'),
(3, 'La Grèce antique (-1200 à -146 av. J.-C.)', 'Ancient_Greece.jpg', 'Vivez l’âge d’or de la Grèce antique, où les cités rivales brillent par leurs héros, leurs philosophies et leurs Jeux Olympiques.', 900.00, 6, 'grèce1', 'grèce2', 'grèce3'),
(4, 'Le Haut Moyen Âge (476 - 1000)', 'Early_Middle_Ages.jpg', 'Plongez dans le Haut Moyen Âge, une époque de royaumes en guerre, de châteaux fortifiés et de l’essor du christianisme en Europe.', 1320.00, 3, 'Moyen_age1', 'Moyen_age2', 'Moyen_age3'),
(5, 'L’Âge des chevaliers et des croisades (1000 - 1300)', 'Knights_and_Crusades.jpg', 'Voyagez avec les chevaliers du Moyen Âge, à la conquête des terres saintes lors des croisades, dans un monde de batailles et de foi.', 700.00, 4, 'croisade1', 'croisade2', 'croisade3'),
(6, 'L’Âge des grandes découvertes (1492 - 1600)', 'Age_of_Exploration.jpg', 'Embarquez pour de grandes découvertes, suivez les explorateurs vers de nouvelles terres et marchez sur les traces des pionniers de l’histoire.', 1200.00, 5, 'age_des_grandes1', 'age_des_grandes2', 'age_des_grandes3'),
(7, 'La Renaissance (1400 - 1600)', 'Renaissance.jpg', 'Vivez l’épanouissement de l’art et de la science, où des génies comme Léonard de Vinci transforment la culture européenne.', 950.00, 3, 'la_renaissance1', 'la_renaissance2', 'la_renaissance3'),
(8, 'La Révolution française et Napoléon (1789 - 1815)', 'French_Revolution_Napoleon.jpg', 'Revivez la Révolution française et l’ascension de Napoléon, une époque de bouleversements politiques et de combats pour la liberté.', 850.00, 4, 'révolution_fr1', 'révolution_fr2', 'révolution_fr3'),
(9, 'La Révolution industrielle (1750 - 1914)', 'Industrial_Revolution.jpg', 'Vivez l’avènement de l’industrie et des machines, une époque de transformations rapides dans le travail, la société et l’économie.', 1100.00, 5, 'révolution_indu1', 'révolution_indu2', 'révolution_indu3'),
(10, 'La Première Guerre mondiale (1914 - 1918)', 'ww1_image.jpeg', 'Explorez la Première Guerre mondiale, un conflit mondial dévastateur qui change le cours de l’histoire et redéfinit les nations.', 950.00, 6, 'WW1', 'WW2', 'WW3'),
(11, 'Les Années folles et la Prohibition (1920 - 1930)', 'Roaring_Twenties_Prohibition.jpg', 'Découvrez les Années folles, une époque de jazz, de fêtes et de rébellion pendant la Prohibition, où l’interdit devient un jeu.', 1300.00, 3, 'les_années_folles1', 'les_années_folles2', 'les_années_folles3'),
(12, 'La Seconde Guerre mondiale (1939 - 1945)', 'ww2_image.jpeg', 'Plongez dans la Seconde Guerre mondiale, un conflit majeur marqué par la résistance et les luttes pour la liberté.', 650.00, 4, 'WW21', 'WW22', 'WW23'),
(13, 'L\'Empire romain (27 av. J.-C. - 476 ap. J.-C.)', 'Empire_romain.png', 'Embarque pour un voyage épique à travers l\'Empire romain, où l\'histoire, la politique et les coutumes se mêlent à des moments fascinants et inoubliables', 1000.00, 5, 'Romain1.jpg', 'Romain2.jpg', 'Romain3.jpg'),
(14, 'La Guerre froide (1947 - 1991)', 'guerre_froide.png', 'Explore la Guerre froide, de la conférence de Yalta à la chute du mur de Berlin, avec des moments clés comme Spoutnik, Apollo 11 et la fin de cette époque fascinante.', 750.00, 4, 'Froide1.jpg', 'Froide2.jpg', 'Froide3.jpg'),
(15, 'La Guerre du Vietnam (1955 - 1975)', 'vietnam_image.png', 'Plonge dans la Guerre du Vietnam, avec des moments clés comme l’escalade de 1965, l’Offensive du Têt en 1968 et la chute de Saïgon en 1975.', 800.00, 3, 'Viet1.jpg', 'Viet2.jpg', 'Viet3.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
