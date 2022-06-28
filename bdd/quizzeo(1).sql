-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 juin 2022 à 08:28
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizzeo`
--

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

DROP TABLE IF EXISTS `choix`;
CREATE TABLE IF NOT EXISTS `choix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `reponse` varchar(1000) NOT NULL,
  `bonnereponse` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `choix`
--

INSERT INTO `choix` (`id`, `id_question`, `reponse`, `bonnereponse`) VALUES
(1, 1, '145', 0),
(2, 1, '150', 0),
(3, 1, '151', 1),
(4, 1, '162', 0),
(5, 2, 'Feu/Vol', 1),
(6, 2, 'Feu/Dragon', 0),
(7, 2, 'Feu/Ténèbres', 0),
(8, 2, 'Feu', 0),
(9, 3, 'Staros', 0),
(10, 3, 'Tortank', 1),
(11, 3, 'Carapagos', 0),
(12, 3, 'Mégapagos', 0),
(13, 4, 'Rattata', 0),
(14, 4, 'Mew', 1),
(15, 4, 'Tadmorv', 0),
(16, 4, 'Rattatac', 0),
(17, 5, 'A capturer des pokemons légendaires', 0),
(18, 5, 'A capturer un pokemon special ', 0),
(19, 5, 'A capturer à coup sûr', 1),
(20, 5, 'Elle existe pas s\'est un mythe ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quizz` int(11) NOT NULL,
  `intitule` varchar(1000) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_quizz`, `intitule`, `date_creation`) VALUES
(1, 7, 'Combien de pokemon il y a dans la première génération ?', '2022-06-28'),
(2, 7, 'Quelle est le type de Dracaufeu', '2022-06-28'),
(3, 7, 'Quelle est l\'évolution final de Carapuce ?', '2022-06-28'),
(4, 7, 'Quelle Pokemon on trouve sous le camion de Carmin-sur-mer selon la légende?', '2022-06-28'),
(5, 7, 'A quoi sert la Masterball', '2022-06-28');

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `difficulte` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`id`, `titre`, `difficulte`, `date_creation`) VALUES
(7, 'Pokemon 1ere génération ', 'Facile', '2022-06-28');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `role`) VALUES
(1, 'Herador', 'd.w@gmail.com', 'azerty', 2),
(2, 'Maxikazy', 'm.m@gmail.com', 'azerty', 1),
(3, 'admin', 'admin@gmail.com', 'azerty', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_quizz`
--

DROP TABLE IF EXISTS `user_quizz`;
CREATE TABLE IF NOT EXISTS `user_quizz` (
  `id_user` int(11) NOT NULL,
  `id_quizz` int(11) NOT NULL,
  `score` int(100) DEFAULT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_quizz`
--

INSERT INTO `user_quizz` (`id_user`, `id_quizz`, `score`) VALUES
(1, 1, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `choix_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
