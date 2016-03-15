-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Mars 2016 à 05:29
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ifitness_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `db_friend_req`
--

CREATE TABLE IF NOT EXISTS `db_friend_req` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_1` int(255) NOT NULL,
  `user_2` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `db_friend_req`
--

INSERT INTO `db_friend_req` (`id`, `user_1`, `user_2`) VALUES
(1, 11, 12);

-- --------------------------------------------------------

--
-- Structure de la table `sc_profile`
--

CREATE TABLE IF NOT EXISTS `sc_profile` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `age` int(255) NOT NULL DEFAULT '18',
  `gender` varchar(255) NOT NULL DEFAULT '1',
  `workout_exp` int(255) NOT NULL DEFAULT '0',
  `goal` int(255) NOT NULL DEFAULT '0',
  `weight` int(255) NOT NULL,
  `height` int(255) NOT NULL,
  `latitude` decimal(36,20) NOT NULL DEFAULT '0.00000000000000000000',
  `longitude` decimal(37,20) NOT NULL DEFAULT '0.00000000000000000000',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sc_profile`
--

INSERT INTO `sc_profile` (`id`, `name`, `surname`, `age`, `gender`, `workout_exp`, `goal`, `weight`, `height`, `latitude`, `longitude`) VALUES
(19, 'William', 'Bosemont', 18, '1', 1, 4, 180, 5, '5.23464322323432500000', '0.00000000000000000000'),
(20, 'George', 'Clooney', 18, '1', 3, 3, 0, 0, '45.48027279999999500000', '-73.55874000000000000000'),
(21, 'Amanda', 'Cerny', 18, '1', 2, 2, 0, 0, '45.48027279999999500000', '-73.55874000000000000000'),
(25, 'Elsa', 'Todo', 18, '1', 2, 4, 170, 5, '0.00000000000000000000', '0.00000000000000000000'),
(26, 'Anita', 'Boswell', 18, '1', 1, 3, 200, 6, '0.00000000000000000000', '0.00000000000000000000'),
(38, 'Rick', 'Astley', 18, '1', 3, 1, 150, 5, '0.00000000000000000000', '0.00000000000000000000'),
(44, 'Bobby', 'Joe', 18, '1', 4, 5, 180, 5, '0.00000000000000000000', '0.00000000000000000000');

-- --------------------------------------------------------

--
-- Structure de la table `sc_rel`
--

CREATE TABLE IF NOT EXISTS `sc_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_1` int(255) NOT NULL,
  `user_2` int(255) NOT NULL,
  `rel_status` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `sc_rel`
--

INSERT INTO `sc_rel` (`id`, `user_1`, `user_2`, `rel_status`) VALUES
(1, 11, 12, 2),
(2, 12, 11, 1),
(5, 13, 11, 1),
(7, 13, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sc_user`
--

CREATE TABLE IF NOT EXISTS `sc_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `username` varchar(255) NOT NULL COMMENT 'User username',
  `password` varchar(255) NOT NULL COMMENT 'User password',
  `email` varchar(255) NOT NULL COMMENT 'User email',
  `name` varchar(255) NOT NULL COMMENT 'User first name',
  `surname` varchar(255) NOT NULL COMMENT 'User surname',
  `gender` int(11) NOT NULL COMMENT 'User gender',
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `sc_user`
--

INSERT INTO `sc_user` (`id`, `username`, `password`, `email`, `name`, `surname`, `gender`, `register_date`) VALUES
(19, 'willby', 'f6a0f3655b26fe4e058a59b4757f6019', 'willbose@ifitness.com', 'William', 'Bosemont', 1, '2016-03-08'),
(20, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'admin', 'admin', 1, '2016-03-13'),
(21, 'amanda', '20ee80e63596799a1543bc9fd88d8878', 'amanda@bunny.com', 'Amanda', 'Blunny', 2, '2016-03-15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
