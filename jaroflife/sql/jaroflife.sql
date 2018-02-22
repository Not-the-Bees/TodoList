-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 22 Février 2018 à 11:20
-- Version du serveur :  5.7.21-0ubuntu0.16.04.1
-- Version de PHP :  7.0.27-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jaroflife`
--

-- --------------------------------------------------------

--
-- Structure de la table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `priority_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `todos`
--

INSERT INTO `todos` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`, `userid`, `priority_level`) VALUES
(1, 'partager une bière avec quelqu\'un', 'peu importe à quel point ta vie semble remplie, tu as toujours le temps de partager une bière avec quelqu\'un', '2017-11-01 17:30:20', '2017-11-16 17:59:29', '2017-11-16 17:59:29', 1, NULL),
(2, 'page d\'enregistrement', 'Mise en place de la page d\'enregistrement pour les nouveaux utilisateurs', '2017-11-01 18:16:50', '2017-11-17 10:13:57', '2017-11-17 10:13:57', 1, NULL),
(3, 'ranger les cailloux', 'ramasser les cailloux devant l\'entrée, et les ranger dans mon bocal', '2017-11-01 18:18:14', '2017-11-14 15:04:25', '2017-11-13 14:08:57', 1, NULL),
(37, 'Nouveau costume', 'acheter un nouveau costume pour combattre le crime', '2017-11-14 15:00:25', '2017-11-15 07:23:11', NULL, 2, NULL),
(38, 'new car', 'buy a batmobile at ALDI or TATI', '2017-11-14 15:03:11', '2017-11-14 15:03:16', '2017-11-14 15:03:16', 2, NULL),
(39, 'resto', 'proposer un restaurant à Alfred et Robin', '2017-11-15 07:23:29', '2017-11-15 07:23:29', NULL, 2, NULL),
(40, 'faire css', 'faire le css de la todolist et trouver un beau template bootstrap', '2017-11-15 07:24:10', '2017-11-15 07:24:10', NULL, 1, NULL),
(43, 'addview.php', 'refaire html addview', '2017-11-16 18:07:17', '2017-11-17 10:11:41', '2017-11-17 10:11:41', 1, NULL),
(44, 'mdp protection', 'sur les formulaires register/login', '2017-11-16 18:07:57', '2017-11-16 18:07:57', NULL, 1, NULL),
(45, 'création mail confirmation', 'via formspree? ', '2017-11-16 18:08:24', '2017-11-16 18:08:24', NULL, 1, NULL),
(46, 'test', 'test', '2017-11-16 18:21:37', '2017-11-16 18:21:43', '2017-11-16 18:21:43', 1, NULL),
(47, 'TEST', 'zorro', '2017-11-16 18:30:23', '2017-12-03 09:46:25', '2017-12-03 09:46:25', 2, NULL),
(48, 'ajouter classes', 'ajouter les classes dans le modèle (public static : Classe::methode)', '2017-11-16 18:32:13', '2017-11-16 18:32:13', NULL, 1, NULL),
(49, 'test', 'test', '2017-11-16 18:36:07', '2017-12-03 09:46:53', '2017-12-03 09:46:53', 1, NULL),
(50, 'fdhiyŝpjoijh', '', '2018-02-22 09:39:24', '2018-02-22 09:39:28', '2018-02-22 09:39:28', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`userid`, `login`, `password`, `email`) VALUES
(1, 'kevin', 'azerty12', 'lsjdvhgpçqsg@sqfjghg.com'),
(2, 'batman', 'batman', 'batman@gotham.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertache` (`userid`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `usertache` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
