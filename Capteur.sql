-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 21 mars 2021 à 22:06
-- Version du serveur :  10.2.37-MariaDB
-- Version de PHP : 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maxipkaq_hothothot`
--

-- --------------------------------------------------------

--
-- Structure de la table `Capteur`
--

CREATE TABLE `Capteur` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `pos` varchar(255) DEFAULT NULL,
  `val` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Capteur`
--

INSERT INTO `Capteur` (`id`, `category`, `pos`, `val`, `created_at`) VALUES
(94, 'Thermique', 'exterieur', 7, '2021-03-21 22:01:02'),
(93, 'Thermique', 'interieur', 19.6, '2021-03-21 22:01:02'),
(92, 'Thermique', 'exterieur', 7.3, '2021-03-21 21:51:02'),
(91, 'Thermique', 'interieur', 19.7, '2021-03-21 21:51:02'),
(90, 'Thermique', 'exterieur', 8, '2021-03-21 21:01:03'),
(89, 'Thermique', 'interieur', 20.1, '2021-03-21 21:01:02'),
(88, 'Thermique', 'exterieur', 9.1, '2021-03-21 20:01:02'),
(87, 'Thermique', 'interieur', 20.6, '2021-03-21 20:01:02'),
(86, 'Thermique', 'exterieur', 10.3, '2021-03-21 19:01:02'),
(85, 'Thermique', 'interieur', 21.1, '2021-03-21 19:01:02'),
(84, 'Thermique', 'exterieur', 11.4, '2021-03-21 18:21:21'),
(83, 'Thermique', 'interieur', 21.6, '2021-03-21 18:21:21'),
(82, 'Thermique', 'exterieur', 12.4, '2021-03-21 18:01:03'),
(81, 'Thermique', 'interieur', 21.8, '2021-03-21 18:01:02'),
(80, 'Thermique', 'exterieur', 17, '2021-03-21 17:01:03'),
(79, 'Thermique', 'interieur', 22.1, '2021-03-21 17:01:03'),
(78, 'Thermique', 'exterieur', 21.5, '2021-03-21 16:01:04'),
(77, 'Thermique', 'interieur', 22.1, '2021-03-21 16:01:03'),
(76, 'Thermique', 'exterieur', 24.2, '2021-03-21 15:01:03'),
(75, 'Thermique', 'interieur', 21.8, '2021-03-21 15:01:03'),
(74, 'Thermique', 'exterieur', 28.1, '2021-03-21 14:01:02'),
(73, 'Thermique', 'interieur', 21.1, '2021-03-21 14:01:01'),
(72, 'Thermique', 'exterieur', 24.6, '2021-03-21 13:01:04'),
(71, 'Thermique', 'interieur', 20.2, '2021-03-21 13:01:04'),
(70, 'Thermique', 'exterieur', 23.6, '2021-03-21 12:01:02'),
(69, 'Thermique', 'interieur', 19.3, '2021-03-21 12:01:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Capteur`
--
ALTER TABLE `Capteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Capteur`
--
ALTER TABLE `Capteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
