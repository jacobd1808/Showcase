-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 06 Avril 2016 à 06:07
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
-- Structure de la table `sc_inbox`
--

CREATE TABLE IF NOT EXISTS `sc_inbox` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'Lets chat!',
  `first_user` int(255) NOT NULL,
  `second_user` int(255) NOT NULL,
  `last_sender` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `sc_inbox`
--

INSERT INTO `sc_inbox` (`id`, `title`, `first_user`, `second_user`, `last_sender`) VALUES
(1, 'Lets chat!', 20, 28, 1),
(2, 'Lets chat!', 20, 32, 20),
(3, 'Lets chat!', 28, 35, 28);

-- --------------------------------------------------------

--
-- Structure de la table `sc_messages`
--

CREATE TABLE IF NOT EXISTS `sc_messages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_sent` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `dob` date NOT NULL,
  `workout_exp` int(255) NOT NULL DEFAULT '0',
  `goal` int(255) NOT NULL DEFAULT '0',
  `gym` varchar(255) NOT NULL DEFAULT 'No Gym',
  `weight` int(255) NOT NULL,
  `height` int(255) NOT NULL,
  `body_fat` int(255) NOT NULL,
  `latitude` decimal(36,20) NOT NULL DEFAULT '0.00000000000000000000',
  `longitude` decimal(37,20) NOT NULL DEFAULT '0.00000000000000000000',
  `bio` varchar(255) NOT NULL,
  `register_date` date NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sc_profile`
--

INSERT INTO `sc_profile` (`id`, `name`, `surname`, `age`, `gender`, `dob`, `workout_exp`, `goal`, `gym`, `weight`, `height`, `body_fat`, `latitude`, `longitude`, `bio`, `register_date`) VALUES
(20, 'Jacob', 'Dickinson', 18, '1', '1998-08-21', 4, 2, 'New Gym', 276, 0, 80, '53.64641400000000000000', '-1.78316100000000000000', 'I like hamburgers', '0000-00-00'),
(25, 'Amanda', 'Smith', 18, '2', '0000-00-00', 4, 3, 'No Gym', 0, 0, 0, '53.64508708029200000000', '-1.77880846970850000000', '', '2016-04-02'),
(26, 'George', 'Macfly', 18, '1', '0000-00-00', 1, 5, 'No Gym', 0, 0, 0, '53.64595618029100000000', '-1.77907381970850000000', '', '2016-04-02'),
(27, 'Elisabeth', 'Queens', 18, '2', '0000-00-00', 1, 1, 'No Gym', 0, 0, 0, '53.64599218029200000000', '-1.77750681970850000000', '', '2016-04-02'),
(28, 'James', 'Conway', 18, '1', '0000-00-00', 2, 5, 'No Gym', 0, 0, 0, '53.64880553029100000000', '-1.78154686970850000000', '', '2016-04-02'),
(29, 'Rob', 'Wright', 18, '1', '0000-00-00', 3, 2, 'No Gym', 0, 0, 0, '53.64853743029100000000', '-1.78105966970850000000', '', '2016-04-02'),
(30, 'Wilson', 'Fisk', 25, '1', '0000-00-00', 4, 3, 'No Gym', 0, 0, 0, '53.64731528029200000000', '-1.77945291970850000000', '', '2016-04-02');

-- --------------------------------------------------------

--
-- Structure de la table `sc_rel`
--

CREATE TABLE IF NOT EXISTS `sc_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `friend_id` int(255) NOT NULL,
  `friend_name` varchar(255) NOT NULL,
  `friend_lastname` varchar(255) NOT NULL,
  `rel_status` int(255) NOT NULL DEFAULT '0',
  `friend_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `sc_rel`
--

INSERT INTO `sc_rel` (`id`, `user_id`, `friend_id`, `friend_name`, `friend_lastname`, `rel_status`, `friend_date`) VALUES
(8, 20, 30, 'Wilson', 'Fisk', 2, '2016-04-05'),
(9, 20, 26, 'George', 'Macfly', 2, '2016-04-04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `sc_user`
--

INSERT INTO `sc_user` (`id`, `username`, `password`, `email`, `name`, `surname`, `gender`, `register_date`) VALUES
(20, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'admin', 'admin', 1, '2016-03-13'),
(25, 'amanda', '0db84272b962010d73f70c18d17f93fc', 'amanda@ifitness.com', '', '', 0, '2016-04-02'),
(26, 'george', '9b306ab04ef5e25f9fb89c998a6aedab', 'george@ifitness.com', '', '', 0, '2016-04-02'),
(27, 'elisabeth', 'f11d689dda4227953e50a0c4ee2ed3f2', 'elisabeth@ifitness.com', '', '', 0, '2016-04-02'),
(28, 'james', 'b4cc344d25a2efe540adbf2678e2304c', 'james@ifitness.com', '', '', 0, '2016-04-02'),
(29, 'rob', '760061f6bfde75c29af12f252d4d3345', 'rob@ifitness.com', '', '', 0, '2016-04-02'),
(30, 'wilson', 'abd7372bba55577590736ef6cb3533c6', 'wilson@ifitness.com', '', '', 0, '2016-04-02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
