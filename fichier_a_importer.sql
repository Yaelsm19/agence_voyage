-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 mars 2025 à 14:53
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
