-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 sep. 2023 à 12:59
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
-- Base de données : `home`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C35F0816A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `user_id`, `name`, `firstname`, `lastname`, `company`, `adresse`, `postal`, `city`, `country`, `phone`) VALUES
(6, 7, 'Ma maison', 'wissam', 'Boufatah', 'essaie', '73 rue Gutenberg', '91120', 'Palaiseau', 'FR', '0753043465'),
(7, 7, 'Mon travail', 'wissam', 'Boufatah', 'essaie', 'Vélizy-Villacoublay', '78132', 'Vélizy', 'FR', '0753043465'),
(8, 13, 'Second adresse', 'wissam', 'Boufatah', 'essaie', '70 rue Gutenberg', '91120', 'Palaiseau', 'AF', '0753043465'),
(9, 7, 'Autre Adresse', 'wissam', 'Boufatah', 'essaie', '16 rue de paris', '91120', 'Palaiseau', 'FR', '0753043465');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `categorie_id`, `title`, `content`, `image`, `prix`) VALUES
(2, NULL, 'Fleuri', 'Enrichi à l’huile de Sésame et parfumé à l’huile essentielle d’Ylang Ylang. Régénérant et adoucissant, ce savon des amoureux vous promet un bain de sensualité ', 'image-8-626093abd84d1.jpg', '6.50'),
(3, NULL, 'Néflier', 'Enrichi au beurre de Karité et parfumé aux huiles essentielles de Sauge et de Clou de Girofle. Légèrement épicé, le savon Néflier diffuse un parfum enivrant.', 'image-9-626093f4d75d9.jpg', '6.50'),
(5, 1, 'PROVENCE', 'Enrichi au beurre de karité et parfumé à l’huile essentielle de Lavande et parsemé de ses fleurs,\r\nle savon Bleu Provence assouplit et hydrate votre peau', 'image-7-626876767c3ec.jpg', '6.50'),
(6, 1, 'Nectar', 'Ce savon est parsemé de pétales de Rose et saturé d’éléments nourrissants. La douceur du Nectar calme votre esprit et assouplit votre peau.\r\n', 'nectar-626876f97dad1.jpg', '6.50'),
(7, 1, 'Savon doux', 'le savon douceur est le savon parfait des bébés, peaux allergiques et femmes enceintes. Sans aucun parfum ni allergène il est particulièrement doux et hydratant. c\'est pour la peau mixte.', 'douceur-6268774b56076.jpg', '6.00'),
(8, 1, 'Fleur sables', 'Enrichi au beurre de Cacao et parfumé par un subtile mélange d’huiles essentielles de Cannelle, de clou de girofle et de Gingembre ainsi que de Vanille et de Rooibos. c\'est pour la peau séche.', 'sable-6268781d8c225.jpg', '6.50'),
(9, 1, 'Nuit d\'orient', 'Enrichi à l’huile de Ricin et parfumé à l’huile essentielle de Patchouli. Massant, adoucissant, le savon, il évoque un voyage sous un ciel étoilé grâce à son parfum dépaysant.', 'nuit-62687885c5605.jpg', '6.50'),
(10, 1, 'Rosée matinale', 'Avec le savon « Rosée Matinale », laissez-vous transporter par les algues bleues des Andes pour une sensation vivifiante, rafraîchissante et rajeunissante.\r\nc\'est pour la peau séche.', 'rose-62687ae20a6fc.jpg', '6.50');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
CREATE TABLE IF NOT EXISTS `carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `description`, `price`) VALUES
(1, 'Colissimo', 'Vous allez recevoir votre livraison dans 72 heurs.', 9.99);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'Savon de Normandie '),
(2, 'Collection Femme'),
(3, 'Collection Bébé'),
(4, 'Collection Homme'),
(5, 'Promotions');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220420171631', '2022-04-20 19:16:38', 296),
('DoctrineMigrations\\Version20230728124031', '2023-07-28 14:41:03', 194),
('DoctrineMigrations\\Version20230818143736', '2023-08-18 16:38:13', 296),
('DoctrineMigrations\\Version20230818150926', '2023-08-18 17:09:42', 330),
('DoctrineMigrations\\Version20230822172709', '2023-08-22 19:28:20', 999),
('DoctrineMigrations\\Version20230907112035', '2023-09-07 13:21:01', 327),
('DoctrineMigrations\\Version20230915235416', '2023-09-16 02:33:23', 146);

-- --------------------------------------------------------

--
-- Structure de la table `my_order`
--

DROP TABLE IF EXISTS `my_order`;
CREATE TABLE IF NOT EXISTS `my_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_price` double NOT NULL,
  `delivery` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `created_at`, `carrier_name`, `carrier_price`, `delivery`, `is_paid`) VALUES
(1, 13, '2023-09-11 23:25:32', 'Colissimo', 9.99, 'AF', 0);

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_order_id` int(11) NOT NULL,
  `article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C1BFCDF877` (`my_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `my_order_id`, `article`, `quantity`, `price`, `total`) VALUES
(1, 1, 'Fleuri', 1, 6.5, 6.5);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(1, 7, 'LZwTn7uRGx4Y7UQ2DY2o', 'TF7418qxvOZu0nWSukHoiPqdHekhPbl1QHiVPtq261Q=', '2023-09-16 02:38:47', '2023-09-16 03:38:47'),
(2, 13, 'hYwvBDdQAUNeLco1essa', 'Z4nCSyoL1je6CrxQLY/JGvWPDlpPrAsqRRo+3AHyBcg=', '2023-09-16 02:39:19', '2023-09-16 03:39:19'),
(3, 7, '5UqVKWuA07zHyxsSh3E3', 'Bg2W93cbsJJbFfwGqXV4ibsQQrLUqW4im132RbRPdR4=', '2023-09-16 13:23:26', '2023-09-16 14:23:26');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(2, 'wissamboufatah@gmail.com', '[]', '$2y$13$KFa0NQMzhhiqjfeTyf8RyOcf1hB8Jh4fvG1Hwa/Dig9f2dBycG1Ru', 'wissam', 'boufatah'),
(3, 'gayaterzi@gmail.com', '[]', '$2y$13$W9UcOnAsw4Zgf/iLJmFJeeOeG8ZbdyF6yai/XF1uQhw8idHli96U6', 'gaya', 'terzi'),
(4, 'frhessaidi@gmail.com', '[]', '$2y$13$xKao0lYGrfqiwJqt8928BOatFI4VeAkIzfGgwTG7ZINqqsIneG3/W', 'farah', 'essaiddi'),
(6, 'zaineb.eld2001@gmail.com', '[]', '$2y$13$MJ45W9xqgP2uc46jLaeKk.m.SCzy5jQWOcVDIXNWQlL0BLAJOcXL2', 'zaineb', 'eldgr'),
(7, 'wissamboufatah31@gmail.com', '[]', '$2y$13$T1DXCNnCqc5yl4zTql69Oe7H0mITxKyJhb94bv1SVMDJrI2AUi6W2', 'wissam', 'boufatah'),
(8, 'dalilaboufatah@gmail.com', '[]', '$2y$13$KOkRn2vRpXe2ImIRRq.sbecI.gSXbnFWIJ.4GoItfu.3TfoPLuzhe', 'dalila', 'boufatah'),
(9, 'y.alaouielmrani@estya.com', '[]', '$2y$13$0/TJbYN6Dt2ks5.R.5qjguQK6QUqsrytT3z0bDOJxidkJOjfpBZDK', 'youssef', 'allaoui'),
(10, 'w.boufatah@estya.com', '[]', '$2y$13$IOTar0opNYsWOxRpEKW.nO.gjVvToKebg4kKe9gM/NeyHsqpOOxC2', 'wiwi', 'bfth'),
(12, 'eloudghiri1059@gmail.com', '[]', '$2y$13$YfJMgW9xFvogYvyrEz30GO/HXCWp/TPOL8Iw.qHLRg9I5K4pGg7D.', 'zaineb', 'Eldgh'),
(13, 'wissamboufatah3105@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$P/5uqVJOgf8yFNiBilbwR.nGWUdsK5FrCtMhaTm3hsX1ZM7AitPWm', 'wissam', 'BFH');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F0816A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C1BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
