-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 03 juin 2024 à 00:45
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aquasterion_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_utilisateur`
--

DROP TABLE IF EXISTS `action_utilisateur`;
CREATE TABLE IF NOT EXISTS `action_utilisateur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `user_ID` int NOT NULL,
  `limite_ID` int DEFAULT NULL,
  `valeur` float NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('modification','creation','suppression','') NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `user_ID` (`user_ID`,`limite_ID`),
  KEY `limite_ID` (`limite_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `alertes`
--

DROP TABLE IF EXISTS `alertes`;
CREATE TABLE IF NOT EXISTS `alertes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `limite_ID` int NOT NULL,
  `message_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `limite_ID` (`limite_ID`,`message_ID`),
  KEY `message_ID` (`message_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `limites`
--

DROP TABLE IF EXISTS `limites`;
CREATE TABLE IF NOT EXISTS `limites` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `type` enum('min','max') NOT NULL,
  `Valeur` float NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `param_id` (`param_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `limites_activation_pompes`
--

DROP TABLE IF EXISTS `limites_activation_pompes`;
CREATE TABLE IF NOT EXISTS `limites_activation_pompes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `pompe_ID` int NOT NULL,
  `limite_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `pompe_ID` (`pompe_ID`,`limite_ID`),
  KEY `limite_ID` (`limite_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages_alertes`
--

DROP TABLE IF EXISTS `messages_alertes`;
CREATE TABLE IF NOT EXISTS `messages_alertes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

DROP TABLE IF EXISTS `mesures`;
CREATE TABLE IF NOT EXISTS `mesures` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `param_ID` int NOT NULL,
  `valeur` float NOT NULL,
  `date_mesure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `param_ID` (`param_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pompes`
--

DROP TABLE IF EXISTS `pompes`;
CREATE TABLE IF NOT EXISTS `pompes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `mode` enum('automatique','manuel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(12, 'admin', 'admin@aquasterion.local', '$argon2i$v=19$m=65536,t=4,p=1$bm0zR3N5Wk9SYjhuMDllcA$10e1cNlUWu5XjjplUHMV0PnePALncJOuhx60sdpjtIc'),
(13, 'Thibault', 'cthibault.chassagne@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$SG5OREFyb1NLcS5MZnBiUg$StBK6qO0Gna/V49YbZvQ6tFXKz0b8sZVph2qLBUfiBI');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action_utilisateur`
--
ALTER TABLE `action_utilisateur`
  ADD CONSTRAINT `action_utilisateur_ibfk_1` FOREIGN KEY (`limite_ID`) REFERENCES `limites` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `action_utilisateur_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD CONSTRAINT `alertes_ibfk_1` FOREIGN KEY (`message_ID`) REFERENCES `messages_alertes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alertes_ibfk_2` FOREIGN KEY (`limite_ID`) REFERENCES `limites` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `limites`
--
ALTER TABLE `limites`
  ADD CONSTRAINT `limites_ibfk_1` FOREIGN KEY (`param_id`) REFERENCES `parametres` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `limites_activation_pompes`
--
ALTER TABLE `limites_activation_pompes`
  ADD CONSTRAINT `limites_activation_pompes_ibfk_1` FOREIGN KEY (`pompe_ID`) REFERENCES `pompes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `limites_activation_pompes_ibfk_2` FOREIGN KEY (`limite_ID`) REFERENCES `limites` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD CONSTRAINT `mesures_ibfk_1` FOREIGN KEY (`param_ID`) REFERENCES `parametres` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
