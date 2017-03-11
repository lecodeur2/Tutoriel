-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 11 Mars 2017 à 23:31
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tuto`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Jessy Lelievre', 'sssssssssssssssssssssssssss'),
(2, 'Jessy Lelievre', 'sssssssssssssssssssssssssss'),
(3, 'CSS', 'Tutoriel CSS'),
(4, '\'SQL\'', '\'Tutoriel SQL\''),
(5, '\'jessylelievre@outlook.fr\'', '\'Tutoriel SQL\''),
(6, 'Hydr4x3', 'ssssssssssssssssssssssssss'),
(7, '\'dANT\'', '\'KLJFSLKJWLFL\''),
(8, '\'dANTqqqqqqqqq\'', '\'qqqqqqqqqqqqqqqqqqq\''),
(10, 'Jessy Lelievre', 'sssssssssssssssssssssssssss'),
(11, 'Jessy Lelievre', 'sssssssssssssssssssssssssss'),
(12, 'Jessy Lelievre', 'sssssssssssssssssssssssssss'),
(13, 'Jessy Lelievre', 'sssssssssssssssssssssssssss');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `category_id` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `name`, `content`, `email`, `category_id`) VALUES
(1, 'Titre de test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sodales ligula vel massa consectetur, id vehicula justo convallis. Pellentesque et nunc pretium, accumsan ipsum sit amet, interdum nibh. Sed gravida malesuada ligula egestas vehicula. Integer nec porta neque. Aenean nec elementum sapien. Fusce pharetra risus et lacus porta ultricies. Integer non nulla mi. Nam mollis, risus non viverra placerat, justo magna suscipit metus, at pretium lacus justo ultrices urna. Fusce facilisis dignissim justo, sed porttitor ipsum accumsan ac. Maecenas arcu mi, maximus vitae aliquet eget, interdum in diam. Cras ultrices, turpis quis hendrerit placerat, turpis diam porta tortor, vitae tincidunt enim mauris et orci. Quisque eget dui tempus diam gravida tempus quis vitae diam. Pellentesque sodales sit amet sapien nec hendrerit. Nullam semper, nibh quis sollicitudin hendrerit, lorem lorem maximus sapien, eget pretium lectus risus a risus. Mauris ullamcorper, tellus quis molestie finibus, mauris augue dictum neque, ut varius sapien turpis non risus. Cras malesuada ipsum libero, dictum semper mauris dapibus vitae.', '', 3),
(2, 'Deuxième titre de teste', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sodales ligula vel massa consectetur, id vehicula justo convallis. Pellentesque et nunc pretium, accumsan ipsum sit amet, interdum nibh. Sed gravida malesuada ligula egestas vehicula. Integer nec porta neque. Aenean nec elementum sapien. Fusce pharetra risus et lacus porta ultricies. Integer non nulla mi. Nam mollis, risus non viverra placerat, justo magna suscipit metus, at pretium lacus justo ultrices urna. Fusce facilisis dignissim justo, sed porttitor ipsum accumsan ac. Maecenas arcu mi, maximus vitae aliquet eget, interdum in diam. Cras ultrices, turpis quis hendrerit placerat, turpis diam porta tortor, vitae tincidunt enim mauris et orci. Quisque eget dui tempus diam gravida tempus quis vitae diam. Pellentesque sodales sit amet sapien nec hendrerit. Nullam semper, nibh quis sollicitudin hendrerit, lorem lorem maximus sapien, eget pretium lectus risus a risus. Mauris ullamcorper, tellus quis molestie finibus, mauris augue dictum neque, ut varius sapien turpis non risus. Cras malesuada ipsum libero, dictum semper mauris dapibus vitae.', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `category_id` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
