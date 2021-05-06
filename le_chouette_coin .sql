-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 06 mai 2021 à 09:56
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `le_chouette_coin`
--
CREATE DATABASE IF NOT EXISTS `le_chouette_coin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `le_chouette_coin`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(1, 'Personale'),
(2, 'Nature'),
(3, 'Branding'),
(4, 'UX Design'),
(5, 'UI Design');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `products_description` text COLLATE utf8_unicode_ci NOT NULL,
  `products_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `author` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`products_id`),
  KEY `author_user` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_description`, `products_price`, `created_at`, `author`, `category`) VALUES
(2, 'Moin NEW', 'Moin NEW', 5, '2021-05-04 09:46:38', 3, 2),
(6, 'Photo Personale new', 'Photo Personale new', 15, '2021-05-05 13:46:09', 3, 1),
(7, 'Photo Personale', 'Photo Personale', 1, '2021-05-05 14:13:22', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(16383) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(3, 'Moin', 'Maljedaili@moin.com', '$2y$10$ubsxffB7eG2lLSFy17xGuONrZ5BuWTEj6cdcvW0IJWwniZCuA0i4O', 'ROLE_ADMIN'),
(5, 'Talis', 'Lais@talis.com', 'root', 'ROLE_USER'),
(6, 'MILI', 'Mili@talis.com', '$2y$10$U3NUztcsTPpeoz9lfL0AqeU8u67baRhn5USOf0sEITMhIFtddoNQW', 'ROLE_USER'),
(7, 'Luc', 'Luc@talis.com', '$2y$10$.1tjvvmHcGz.HTdM2PEyfOluaw.3miz2zUpZcVGDnRWpsslB9pF2.', 'ROLE_USER'),
(8, 'HAmza', 'Hamza@talis.com', '$2y$10$UN9d4XKOS/HSn6HIpTUt.efMRUiKg92kje4dFf5W2vjReCSQVtDpy', 'ROLE_USER'),
(9, 'Lura', 'Lura@talis.com', '$2y$10$LiTrGEizH1PSQaOt9.IqKOKOdZTSjv6dhvXcTsdyteM6juuGrl9Zi', 'ROLE_USER'),
(10, 'Kamal', 'Kamal@talis.com', '$2y$10$LiCt33pGUu9pvZ7FCm1zP.yUHEdm.BFpOcKNiY7rDF3eUwXCg7UEK', 'ROLE_USER'),
(11, 'Jirmi', 'Jirmi@Talid.com', '$2y$10$As.rWzklCXxPf6xjc7DO3.HCzL5IZkloZ3KTd9zCuIM2459Aq775.', 'ROLE_USER'),
(12, 'Alex', 'Alex@talis.com', '$2y$10$Ee6IbA15melFzJtxQi0ibuw6EvsAgaPN0zRoBNLBxYI3.IG/DeXEi', 'ROLE_USER'),
(13, 'Jerom', 'Jerom@talis.com', '$2y$10$u8uFYJdx7WXIT2is0YYJYeKTLQgdX0QCBAkGGePcO9MYI4nB/U6du', 'ROLE_USER');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `author_user` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
