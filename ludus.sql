-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 07 Mai 2014 à 10:08
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ludus`
--

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_0_options`
--

CREATE TABLE IF NOT EXISTS `beta_1_0_options` (
  `rootURL` varchar(255) NOT NULL,
  `pseudoProprietaire` varchar(255) NOT NULL,
  `urlProprietaire` varchar(255) NOT NULL,
  `siteName` varchar(255) NOT NULL,
  `nombreVideosParPage` int(11) NOT NULL,
  `inscriptionAuthorized` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `beta_1_0_options`
--

INSERT INTO `beta_1_0_options` (`rootURL`, `pseudoProprietaire`, `urlProprietaire`, `siteName`, `nombreVideosParPage`, `inscriptionAuthorized`) VALUES
('/_p/Ludus_Beta1_0', 'TTlegend2011', 'http://ttlegend2011.fr', 'Vidéos de TTlegend2011', 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_0_status`
--

CREATE TABLE IF NOT EXISTS `beta_1_0_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `canPostVideos` tinyint(4) NOT NULL,
  `canAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `beta_1_0_status`
--

INSERT INTO `beta_1_0_status` (`id`, `nom`, `canPostVideos`, `canAdmin`) VALUES
(1, 'Fan', 0, 0),
(2, 'Vidéomaker', 1, 0),
(3, 'Administrateur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_0_users`
--

CREATE TABLE IF NOT EXISTS `beta_1_0_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `hasAvatar` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `beta_1_0_users`
--

INSERT INTO `beta_1_0_users` (`id`, `pseudo`, `pass`, `statut`, `hasAvatar`, `bio`) VALUES
(1, 'TTlegend2011', '9c11e183902ab8eb3ed4ed9e22f1449912f5763b', 3, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_0_videos`
--

CREATE TABLE IF NOT EXISTS `beta_1_0_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(15) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `auteur` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `published` datetime NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `beta_1_0_videos`
--

INSERT INTO `beta_1_0_videos` (`id`, `identifiant`, `nom`, `auteur`, `url`, `img`, `published`, `description`) VALUES
(1, 'sjyl7x', 'Caca', 1, 'blabla.mp4', 'blabla.png', '2014-02-08 06:37:42', '<p>Cet humour de malade, ptn *.*</p>');

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_1_activity`
--

CREATE TABLE IF NOT EXISTS `beta_1_1_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `video` varchar(15) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `beta_1_1_activity`
--

INSERT INTO `beta_1_1_activity` (`id`, `user`, `type`, `date`, `video`, `content`) VALUES
(1, 1, 'post_video', '2014-01-16 21:12:28', 'RKDCrO', ''),
(16, 1, 'comment', '2014-01-19 15:17:40', 'RKDCrO', 'Salut !'),
(17, 2, 'like', '2014-01-19 21:06:51', 'RKDCrO', ''),
(19, 1, 'addvideo', '2014-01-19 21:20:32', 'DUr7Jg', ''),
(20, 1, 'addvideo', '2014-01-19 21:21:01', 'f9FCdo', ''),
(21, 1, 'like', '2014-01-19 21:24:31', 'c2uRyR', ''),
(22, 2, 'comment', '2014-01-20 16:09:58', 'RKDCrO', 'Bah yolo, hein.'),
(23, 1, 'comment', '2014-01-20 06:38:32', 'RKDCrO', 'Bjour !'),
(24, 1, 'comment', '2014-01-20 06:39:21', 'c2uRyR', 'C''est très bien, mais je t''emmerde.'),
(25, 1, 'comment', '2014-01-20 07:02:45', 'RKDCrO', 'Salut laul mdr alor en fait j''t''emmerde connar'),
(26, 1, 'comment', '2014-01-20 07:03:12', 'c2uRyR', 'mé lol tu fai 2 la merde vas te pendre conar'),
(27, 1, 'comment', '2014-01-20 17:59:53', 'c2uRyR', 'So, who''s it gonna be princess ?\r\n\r\nEn réalité, je pense qu''on peut faire de très grandes choses avec ton putain de truc à la con. Parce qu''en réalité, c''est vraiment très con, et tu es très con. CONNARD D''ENCULÉ DE MERDE, JE TE DÉTESTE OLOLOLOLOLOLOLO'),
(28, 1, 'comment', '2014-01-24 19:39:17', 'c2uRyR', 'Salut ceci est un test'),
(29, 1, 'comment', '2014-01-24 19:39:22', 'c2uRyR', 'Bjr conar'),
(30, 1, 'comment', '2014-01-24 19:39:27', 'c2uRyR', 'Salu lol xd'),
(31, 1, 'comment', '2014-01-24 19:39:32', 'c2uRyR', 'lol ptdr'),
(33, 1, 'comment', '2014-01-24 21:15:23', 'Ab1vk6', 'KK'),
(42, 1, 'like', '2014-01-25 07:11:39', 'RKDCrO', ''),
(43, 1, 'comment', '2014-02-10 14:21:30', 'Ab1vk6', 'lel'),
(44, 1, 'comment', '2014-02-10 14:21:36', 'Ab1vk6', 'lol mdr'),
(47, 1, 'like', '2014-02-10 14:23:26', 'a430A4', ''),
(48, 1, 'like', '2014-02-10 14:23:32', 'iZOxez', ''),
(50, 1, 'like', '2014-02-10 14:23:57', 'Ab1vk6', ''),
(51, 2, 'like', '2014-02-11 12:39:26', 'Ab1vk6', ''),
(53, 1, 'comment', '2014-02-11 12:41:57', 'Ab1vk6', 'Je suis trop drololole.'),
(54, 2, 'comment', '2014-02-11 12:42:15', 'Ab1vk6', 'T''as aucune preuve.'),
(55, 2, 'comment', '2014-02-11 12:45:57', 'Ab1vk6', 'C''est pas vrai d''abord.'),
(56, 2, 'comment', '2014-02-11 12:46:04', 'Ab1vk6', 'J''te crois pas.'),
(57, 3, 'comment', '2014-02-11 12:46:40', 'Ab1vk6', 'Crois-le, il détient la vérité absolue.'),
(58, 1, 'comment', '2014-02-11 12:47:07', 'Ab1vk6', 'Exactement. Je suis Dieu. Obéis-moi.'),
(59, 2, 'comment', '2014-02-11 12:47:28', 'Ab1vk6', 'Oui, maître.'),
(60, 2, 'comment', '2014-02-11 13:02:03', 'a430A4', 'Ptdr.'),
(61, 2, 'like', '2014-02-11 13:02:05', 'a430A4', ''),
(62, 1, 'comment', '2014-02-11 13:04:13', 'c2uRyR', 'Ceci est un commentaire à ralloooooooooooooooooooooooooooooooooooooooooooooooooooooonge parce que m''voyez, j''ai pas grand chose d''intéressant à écrire sur cette putain de plateforme. EN PLUS QUE C''EST UN TEST, C''EST INUTILE. D''abord. Héhéhé. Huhuhu.'),
(63, 1, 'comment', '2014-02-19 08:52:32', 'a430A4', 'Ok trololol mdr');

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_1_options`
--

CREATE TABLE IF NOT EXISTS `beta_1_1_options` (
  `rootURL` varchar(255) NOT NULL,
  `theme` varchar(25) NOT NULL DEFAULT 'ludus_one',
  `siteName` varchar(255) NOT NULL,
  `inscriptionAuthorized` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `beta_1_1_options`
--

INSERT INTO `beta_1_1_options` (`rootURL`, `theme`, `siteName`, `inscriptionAuthorized`) VALUES
('/ludus', 'ludus_basic', 'Vidéos de TTlegend2011', 1);

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_1_statuts`
--

CREATE TABLE IF NOT EXISTS `beta_1_1_statuts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `canPostVideos` tinyint(4) NOT NULL,
  `canAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `beta_1_1_statuts`
--

INSERT INTO `beta_1_1_statuts` (`id`, `nom`, `canPostVideos`, `canAdmin`) VALUES
(1, 'Fan', 0, 0),
(2, 'Vidéomaker', 1, 0),
(3, 'Administrateur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_1_users`
--

CREATE TABLE IF NOT EXISTS `beta_1_1_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `hasAvatar` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `beta_1_1_users`
--

INSERT INTO `beta_1_1_users` (`id`, `pseudo`, `pass`, `statut`, `hasAvatar`, `bio`) VALUES
(1, 'TTlegend2011', '9c11e183902ab8eb3ed4ed9e22f1449912f5763b', 3, 0, '<p>Je suis l''administrateur.</p>'),
(2, 'TTlegend2012', '9c11e183902ab8eb3ed4ed9e22f1449912f5763b', 2, 0, ''),
(3, 'TTlegend2013', '9c11e183902ab8eb3ed4ed9e22f1449912f5763b', 1, 0, ''),
(4, 'TTlegend2014', '9c11e183902ab8eb3ed4ed9e22f1449912f5763b', 2, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `beta_1_1_videos`
--

CREATE TABLE IF NOT EXISTS `beta_1_1_videos` (
  `id` varchar(15) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(255) NOT NULL,
  `auteur` int(11) NOT NULL,
  `published` datetime NOT NULL,
  `vues` int(11) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `beta_1_1_videos`
--

INSERT INTO `beta_1_1_videos` (`id`, `statut`, `nom`, `auteur`, `published`, `vues`, `description`) VALUES
('a430A4', 1, 'ptn j''ai plus d''idée de vidéo', 1, '2014-01-24 20:53:36', 18, '<p>cc t v v m b lol</p>'),
('Ab1vk6', 1, 'contnu orijinal dmon ku lol', 2, '2014-01-24 20:53:52', 39, '<p>kk</p>'),
('c2uRyR', 0, 'MDr', 1, '2014-01-19 21:23:24', 10, '<p>kk</p>'),
('iZOxez', 0, 'test', 1, '2014-01-24 20:53:21', 8, '<p>enfaite laul</p>'),
('jiNSHC', 0, 'skt', 1, '2014-01-22 06:38:14', 3, '<p>mdr</p>'),
('q4aRoF', 0, 'cc lol', 1, '2014-02-19 08:21:11', 1, '<p>ptdr</p>'),
('RKDCrO', 0, 'hihihihihi', 1, '2014-01-16 21:12:28', 1, '<p>laul</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
