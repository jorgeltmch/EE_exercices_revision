-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Août 2018 à 16:27
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `forumrevision`
--
CREATE DATABASE IF NOT EXISTS `forumrevision` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `forumrevision`;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `idNews` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idNews`),
  KEY `idUser` (`idUser`),
  KEY `idUser_2` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` int(40) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `surname`, `name`, `login`, `password`) VALUES
(11, '2', '3', '3', 2147483647),
(12, '2e', '3e', '3', 0),
(13, '2e', '3e', '3', 0),
(14, 'a', 'a', '0', 86),
(15, 's', 's', 'wdwdawdawdas', 0),
(16, 'wda', 'wdawdwad', 'aw', 0),
(17, 'jorge', 'machado', 'xel', 5898);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
