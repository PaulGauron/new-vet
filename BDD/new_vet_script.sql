-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 sep. 2024 à 13:01
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `new_vet`
--
CREATE DATABASE IF NOT EXISTS `new_vet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `new_vet`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `acces` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `acces`) VALUES
(23, 0);

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `libelle_voie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_adresse` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preference` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_client`
--

CREATE TABLE `adresse_client` (
  `id_utilisateur_id` int(11) NOT NULL,
  `id_adresse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom_cat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_cat`, `description`) VALUES
(1, 'robe', 'Découvrez nos robes pour une élégance sans égale'),
(2, 'top', 'Des T-Shirts et des Tops qui vous iront à ravir !'),
(3, 'pantalon', 'Faites tomber le style avec nos pantalons tendance !'),
(4, 'veste', 'Affrontez le froid avec élégance grâce à nos vestes !'),
(5, 'chaussure', 'Marchez avec confiance avec nos chaussures raffinées !'),
(6, 'accessoire', 'Élevez votre look avec nos accessoires incontournables !');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `methode_paiement` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_carte` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_carte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_expiration_carte` datetime DEFAULT NULL,
  `cvv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_util_id` int(11) NOT NULL,
  `adresse_id` int(11) NOT NULL,
  `recapitulatif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `id_util_id` int(11) NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_contact` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

CREATE TABLE `detail_commande` (
  `id` int(11) NOT NULL,
  `id_com_id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `prix_tot` double NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240924153400', '2024-09-24 15:34:31', 120);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `nom_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `nom_image`) VALUES
(1, 'robe1'),
(2, 'robe2'),
(3, 'robe3'),
(4, 'robe4'),
(5, 'robe5'),
(6, 'robe6'),
(7, 'robe7'),
(8, 'robe8'),
(9, 'robe9'),
(10, 'robe10'),
(11, 'top1'),
(12, 'top2'),
(13, 'top3'),
(14, 'top4'),
(15, 'top5'),
(16, 'top6'),
(17, 'top7'),
(18, 'top8'),
(19, 'top9'),
(20, 'top10'),
(21, 'pantalon1'),
(22, 'pantalon2'),
(23, 'pantalon3'),
(24, 'pantalon4'),
(25, 'pantalon5'),
(26, 'pantalon6'),
(27, 'pantalon7'),
(28, 'pantalon8'),
(29, 'pantalon9'),
(30, 'pantalon10'),
(31, 'veste1'),
(32, 'veste2'),
(33, 'veste3'),
(34, 'veste4'),
(35, 'veste5'),
(36, 'veste6'),
(37, 'veste7'),
(38, 'veste8'),
(39, 'veste9'),
(40, 'veste10'),
(41, 'chaussure1'),
(42, 'chaussure2'),
(43, 'chaussure3'),
(44, 'chaussure4'),
(45, 'chaussure5'),
(46, 'chaussure6'),
(47, 'chaussure7'),
(48, 'chaussure8'),
(49, 'chaussure9'),
(50, 'chaussure10'),
(51, 'accessoire1'),
(52, 'accessoire2'),
(53, 'accessoire3'),
(54, 'accessoire4'),
(55, 'accessoire5'),
(56, 'accessoire6'),
(57, 'accessoire7'),
(58, 'accessoire8'),
(59, 'accessoire9'),
(60, 'accessoire10'),
(70, 'acessoire-66c8a7d28e0c8'),
(71, 'reste-66c8e3f27fb3d'),
(73, 'robe-66d0356e3ceab'),
(75, 'pantalon-66ec5d8190a23'),
(78, 'pantalon-66eed7abc7211'),
(79, 'veste-66f3cc0f10422');

-- --------------------------------------------------------

--
-- Structure de la table `images_produit`
--

CREATE TABLE `images_produit` (
  `produit_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images_produit`
--

INSERT INTO `images_produit` (`produit_id`, `image_id`) VALUES
(1, 1),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(40, 40),
(41, 41),
(42, 42),
(43, 43),
(44, 44),
(45, 45),
(46, 46),
(47, 47),
(48, 48),
(49, 49),
(51, 51),
(52, 52),
(53, 53),
(54, 54),
(55, 55),
(56, 56),
(57, 57),
(58, 58),
(59, 59),
(60, 60),
(65, 71),
(71, 78),
(72, 79);

-- --------------------------------------------------------

--
-- Structure de la table `materiaux`
--

CREATE TABLE `materiaux` (
  `id` int(11) NOT NULL,
  `nom__mat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiaux`
--

INSERT INTO `materiaux` (`id`, `nom__mat`) VALUES
(1, 'Chiffon'),
(2, 'Satin'),
(3, 'Polyester'),
(4, 'Coton'),
(5, 'Soie'),
(6, 'Jersey'),
(7, 'Velour'),
(8, 'Laine'),
(9, 'Cuir'),
(10, 'Denim'),
(11, 'Suède'),
(12, 'Textiles');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom_prod` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_prod` float NOT NULL,
  `stock` int(11) NOT NULL,
  `disponibilite` tinyint(1) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `highlander` tinyint(1) NOT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom_prod`, `description_prod`, `prix_prod`, `stock`, `disponibilite`, `categorie_id`, `highlander`, `ordre`) VALUES
(1, 'Robe noire à fleurs rouges', 'Belle robe d\'été', 25.99, 17, 1, 1, 0, 0),
(3, 'Robe blanche à fleurs', 'Robe blance à points noirs', 36.99, 9, 1, 1, 1, 0),
(4, 'Robe noire à fleurs multicolores', 'Robe colorée parfait pour des soirées', 24.5, 5, 1, 1, 0, 0),
(5, 'Robe à traits blanc/bleu', 'Robe blanche et bleue', 19.99, 22, 1, 1, 1, 0),
(6, 'Robe turquoise', 'Robe parfaite pour garder la tête froide !', 49.99, 47, 1, 1, 0, 0),
(7, 'Robe noire à fleurs', 'Une robe avec élégance sans égale', 29.99, 8, 1, 1, 0, 0),
(8, 'Robe blanche à fleurs', 'Robe noire élégante ornée de motifs floraux délicats', 23.49, 23, 1, 1, 0, 0),
(9, 'Robe orangée', 'Robe orangée vibrante, idéale pour ajouter une touche de couleur à votre garde-robe', 35.99, 16, 1, 1, 0, 0),
(10, 'Robe blanche à fleurs', 'Robe ornée de fleurs magnifiques qui vous correspondront parfaitement', 25.99, 3, 1, 1, 0, 0),
(11, 'Top bleu clair', 'Top bleu clair avec texte blanc', 9.99, 23, 1, 2, 0, 0),
(12, 'Top blanc à fleurs bleues', 'Élégant top blanc orné de fleurs bleues délicates pour une touche printanière', 29, 3, 1, 2, 0, 0),
(13, 'T-shirt noir à fleurs', 'T-shirt noir moderne avec un motif floral vibrant pour un look chic et décontracté.', 24, 10, 1, 2, 0, 0),
(14, 'Top semi-transparent', 'Top semi-transparent pour une allure légère et séduisante, parfait pour les soirées d\'été', 32, 5, 1, 2, 0, 0),
(15, ' T-shirt marin', 'T-shirt à rayures marines classiques, un essentiel pour un look nautique intemporel', 27, 25, 1, 2, 0, 0),
(16, 'T-shirt blanc avec écriture bleue', 'T-shirt blanc épuré avec un message en bleu, parfait pour un style simple et graphique', 22, 22, 1, 2, 0, 0),
(17, 'T-shirt blanc à rayures bleues', 'T-shirt blanc avec des rayures bleues fraîches pour une allure estivale et dynamique', 26, 24, 1, 2, 0, 0),
(18, 'T-shirt bleu foncé avec écriture blanche', 'T-shirt bleu foncé avec un texte blanc élégant, idéal pour un look contrasté et moderne', 25, 24, 1, 2, 0, 0),
(19, 'Top blanc', 'Top blanc classique, simple et polyvalent pour toutes les occasions', 19, 30, 1, 2, 0, 0),
(20, 'T-shirt blanc à fleurs', 'T-shirt blanc avec un motif floral doux, parfait pour apporter une touche de fraîcheur à votre tenue', 23, 18, 1, 2, 0, 0),
(21, 'Legging noir', 'Legging noir polyvalent, parfait pour le confort quotidien et les séances de sport', 19, 8, 1, 3, 0, 0),
(22, 'Legging thermique doublé en polaire', 'Legging thermique doublé en polaire pour une chaleur maximale lors des journées froides', 34, 3, 1, 3, 0, 0),
(23, 'Pantalon gris', 'Pantalon gris élégant et sobre, idéal pour une allure professionnelle ou casual', 39.99, 12, 1, 3, 0, 0),
(24, 'Pantalon blanc', 'Pantalon blanc chic, parfait pour un style estival ou une touche de fraîcheur à votre garde-robe', 42, 14, 1, 3, 0, 0),
(25, 'Pantalon bleu foncé élastique', 'Pantalon bleu foncé avec une taille élastique pour un confort et une flexibilité optimaux', 36, 17, 1, 3, 0, 0),
(26, 'Jean rougeâtre', 'Jean rougeâtre audacieux, ajoutant une touche de couleur vibrante à votre look quotidien', 44, 17, 1, 3, 0, 0),
(27, 'Pantalon large bleu ciel', 'Pantalon large bleu ciel pour un style fluide et aérien, parfait pour les journées d\'été', 47, 1, 1, 3, 1, 0),
(28, 'Pantalon slim avec motifs', 'Pantalon slim avec motifs uniques pour un look tendance et original', 39, 20, 1, 3, 0, 0),
(29, 'Jean bleu clair', 'Jean bleu clair classique, un incontournable pour un look casual décontracté', 42, 21, 1, 3, 0, 0),
(30, 'Jean vert kaki', 'Jean vert kaki robuste, parfait pour un style militaire chic et un confort quotidien', 45, 32, 1, 3, 0, 0),
(31, 'Veste marron en cuir', 'Veste marron en cuir intemporelle, ajoutant une touche d\'élégance et de robustesse à votre tenue', 149.99, 20, 1, 4, 0, 0),
(32, 'Veste Femme Novara', 'Veste Femme Novara, un choix élégant et moderne pour affronter les journées fraîches avec style', 129.99, 14, 1, 4, 0, 0),
(33, 'Manteau rouge foncé', 'Manteau rouge foncé audacieux pour une allure sophistiquée et une visibilité accrue lors des journées grises', 159.99, 17, 1, 4, 0, 0),
(34, 'Veste vert kaki', 'Veste vert kaki pratique et chic, parfaite pour un look décontracté et aventureux', 119.99, 17, 1, 4, 0, 0),
(35, 'Veste bleue clair', 'Veste bleue clair légère et fraîche, idéale pour les journées printanières et les soirées d\'été', 109.99, 18, 1, 4, 0, 0),
(36, 'Manteau noir en fourrure', 'Manteau noir en fourrure luxueux, offrant chaleur et élégance pour les occasions spéciales', 199.99, 35, 1, 4, 0, 0),
(37, 'Manteau beige en fourrure', 'Manteau beige en fourrure, alliant confort et sophistication pour un hiver chic et douillet', 189.99, 5, 1, 4, 0, 0),
(38, 'Manteau en laine gris avec des boutons', 'Manteau en laine gris avec boutons classiques, un essentiel pour un style raffiné et une chaleur optimale', 159.99, 3, 1, 4, 0, 0),
(39, 'Manteau rose clair', 'Manteau rose clair doux et féminin, parfait pour ajouter une touche de couleur et de douceur à vos journées d\'hiver', 169.99, 20, 1, 4, 0, 0),
(40, 'Manteau gris foncé', 'Manteau gris foncé élégant, un classique polyvalent qui se marie facilement avec toutes vos tenues', 149.99, 9, 1, 4, 0, 0),
(41, 'Mocassins beiges', 'Mocassins beiges élégants et confortables, parfaits pour un style chic et décontracté', 79.99, 5, 1, 5, 0, 0),
(42, 'Chaussures bleues', 'Chaussures bleues modernes et polyvalentes, idéales pour ajouter une touche de couleur à vos tenues quotidiennes', 89.99, 10, 1, 5, 0, 0),
(43, 'Baskets blanches', 'Baskets blanches classiques, essentielles pour un look décontracté et un confort maximal', 69.99, 15, 1, 5, 0, 0),
(44, 'Sandales bleues', 'Sandales bleues fraîches et légères, parfaites pour les journées d\'été ensoleillées', 59.99, 20, 1, 5, 0, 0),
(45, 'Bottes noires', 'Bottes noires élégantes et robustes, conçues pour affronter l\'hiver avec style et confort', 129.99, 25, 1, 5, 0, 0),
(46, 'Bottines noires à talon plat', 'Bottines noires à talon plat, alliant confort et sophistication pour un look chic au quotidien', 99.99, 30, 1, 5, 0, 0),
(47, 'Baskets rouges', 'Baskets rouges audacieuses, parfaites pour un style sportif et dynamique qui ne passe pas inaperçu', 89.99, 23, 1, 5, 0, 0),
(48, 'Chaussures à talon plat', 'Chaussures à talon plat élégantes, offrant une allure raffinée tout en garantissant un confort optimal', 79.99, 3, 1, 5, 0, 0),
(49, 'Sneakers imprimées léopard', 'Sneakers imprimées léopard, pour une touche sauvage et tendance dans vos looks décontractés', 109.99, 4, 1, 5, 0, 0),
(51, 'Sac marron en cuir', 'Sac marron en cuir de haute qualité, idéal pour une allure classique et intemporelle', 159.99, 21, 1, 6, 0, 0),
(52, 'Sac noir de luxe', 'Sac noir de luxe, symbole d\'élégance et de sophistication pour toutes vos sorties', 249.99, 20, 1, 6, 0, 0),
(53, 'Sac marron', 'Sac marron polyvalent, parfait pour un usage quotidien avec une touche de style', 139.99, 8, 1, 6, 0, 0),
(54, 'Sac noire, gris et rouge', 'Sac tricolore noir, gris et rouge, pour un look audacieux et moderne', 129.99, 5, 1, 6, 0, 0),
(55, 'Sac blanc ALDO', 'Sac blanc ALDO, élégant et chic, conçu pour compléter vos tenues estivales', 99.99, 3, 1, 6, 0, 0),
(56, 'Ceinture en cuir', 'Ceinture en cuir véritable, un accessoire indispensable pour un look raffiné', 49.99, 10, 1, 6, 0, 0),
(57, 'Ceinture dorée', 'Ceinture dorée, parfaite pour ajouter une touche glamour à votre tenue', 39.99, 9, 1, 6, 0, 0),
(58, 'Ceinture noire', 'Ceinture noire classique, essentielle pour un style sobre et élégant', 34.99, 8, 1, 6, 0, 0),
(59, 'Ceinture noire \"in horse\"', 'Ceinture noire \'in horse\', avec un design unique pour un look distinctif', 59.99, 23, 1, 6, 0, 0),
(60, 'Ceinture marron en cuir avec boucle dorée', 'Ceinture marron en cuir avec boucle dorée, un accessoire chic et intemporel', 69.99, 44, 1, 6, 1, 0),
(65, 'robe japonaise', 'une robe kimono traditionnelle', 78.22, 20, 1, 1, 1, 10),
(71, 'test', 'test', 115.5, 21, 1, 3, 0, 1000),
(72, 'test', 'test', 155, 55, 1, 4, 0, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `produit_commandes`
--

CREATE TABLE `produit_commandes` (
  `commande_id` int(11) NOT NULL,
  `id_produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_materiaux`
--

CREATE TABLE `produit_materiaux` (
  `id_materiaux_id` int(11) NOT NULL,
  `id_produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit_materiaux`
--

INSERT INTO `produit_materiaux` (`id_materiaux_id`, `id_produit_id`) VALUES
(1, 1),
(1, 3),
(1, 7),
(1, 15),
(1, 24),
(1, 32),
(1, 40),
(1, 48),
(1, 56),
(2, 1),
(2, 5),
(2, 13),
(2, 21),
(2, 29),
(2, 37),
(2, 45),
(2, 53),
(3, 1),
(3, 10),
(3, 17),
(3, 25),
(3, 33),
(3, 41),
(3, 49),
(3, 57),
(3, 72),
(4, 3),
(4, 11),
(4, 19),
(4, 27),
(4, 35),
(4, 43),
(4, 51),
(4, 59),
(4, 72),
(5, 8),
(5, 15),
(5, 23),
(5, 31),
(5, 39),
(5, 47),
(5, 55),
(6, 4),
(6, 11),
(6, 19),
(6, 27),
(6, 35),
(6, 43),
(6, 51),
(6, 59),
(7, 1),
(7, 9),
(7, 18),
(7, 26),
(7, 34),
(7, 42),
(7, 58),
(8, 16),
(8, 23),
(8, 31),
(8, 39),
(8, 47),
(8, 55),
(8, 71),
(9, 5),
(9, 12),
(9, 22),
(9, 30),
(9, 38),
(9, 46),
(9, 54),
(9, 71),
(10, 6),
(10, 13),
(10, 20),
(10, 28),
(10, 36),
(10, 44),
(10, 52),
(10, 60),
(11, 7),
(11, 14),
(11, 21),
(11, 29),
(11, 37),
(11, 45),
(11, 53),
(12, 3),
(12, 9),
(12, 17),
(12, 25),
(12, 33),
(12, 41),
(12, 49),
(12, 57);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `dtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `telephone`, `dtype`) VALUES
(14, 'lol', 'lol', 'lol@l.d', '$2y$10$0bsv6ae.WVLWs4iNS1Ga6.ecGiDWP/9CHKg/6AGmnG3bv7WYRti/2', NULL, 'client'),
(17, 'gog', 'gog', 'gog@f.b', '$2y$10$.rhcOuOUOKVTgmFum2YPU.yzZAPOhBY56G2IuI63zW6EujXHYu91u', 63487947, 'client'),
(23, 'admin', 'admin', 'admin@nv.fr', '$2y$10$g62Q5wARbLOPss6PqCmDvepsOHaDOwZFWITx1Y8phPXR3Wc.Et2J2', NULL, 'admin'),
(24, 'client', 'client', 'client@nv.fr', '$2y$10$crapX1WjrXnXHiPnxWpHe.Aqnn6FGMnFaVdpCyLcA58O6PvFZUMVq', 61454361, 'client'),
(25, 'client', 'client', 'client2@nv.fr', '$2y$10$Ib5MJNk.v8RK.UIt5ovfi.YOU3RrrjJuEka4iLriG9jkGabP4DNwW', NULL, 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `adresse_client`
--
ALTER TABLE `adresse_client`
  ADD PRIMARY KEY (`id_utilisateur_id`,`id_adresse_id`),
  ADD KEY `IDX_891D1BDC6EE5C49` (`id_utilisateur_id`),
  ADD KEY `IDX_891D1BDE86D5C8B` (`id_adresse_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35D4282C11C087F0` (`id_util_id`),
  ADD KEY `IDX_35D4282C4DE7DC5C` (`adresse_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C62E63811C087F0` (`id_util_id`);

--
-- Index pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_98344FA652BBBADA` (`id_com_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images_produit`
--
ALTER TABLE `images_produit`
  ADD PRIMARY KEY (`produit_id`,`image_id`),
  ADD KEY `IDX_B6D8F245F347EFB` (`produit_id`),
  ADD KEY `IDX_B6D8F2453DA5256D` (`image_id`);

--
-- Index pour la table `materiaux`
--
ALTER TABLE `materiaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`);

--
-- Index pour la table `produit_commandes`
--
ALTER TABLE `produit_commandes`
  ADD PRIMARY KEY (`commande_id`,`id_produit_id`),
  ADD KEY `IDX_B14376C0AABEFE2C` (`id_produit_id`),
  ADD KEY `IDX_B14376C082EA2E54` (`commande_id`);

--
-- Index pour la table `produit_materiaux`
--
ALTER TABLE `produit_materiaux`
  ADD PRIMARY KEY (`id_materiaux_id`,`id_produit_id`),
  ADD KEY `IDX_135238C9A3AFCEC0` (`id_materiaux_id`),
  ADD KEY `IDX_135238C9AABEFE2C` (`id_produit_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `materiaux`
--
ALTER TABLE `materiaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_880E0D76BF396750` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `adresse_client`
--
ALTER TABLE `adresse_client`
  ADD CONSTRAINT `FK_891D1BDC6EE5C49` FOREIGN KEY (`id_utilisateur_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_891D1BDE86D5C8B` FOREIGN KEY (`id_adresse_id`) REFERENCES `adresse` (`id`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C7440455BF396750` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282C11C087F0` FOREIGN KEY (`id_util_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_35D4282C4DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E63811C087F0` FOREIGN KEY (`id_util_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `FK_98344FA652BBBADA` FOREIGN KEY (`id_com_id`) REFERENCES `commandes` (`id`);

--
-- Contraintes pour la table `images_produit`
--
ALTER TABLE `images_produit`
  ADD CONSTRAINT `FK_B6D8F2453DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_B6D8F245F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `produit_commandes`
--
ALTER TABLE `produit_commandes`
  ADD CONSTRAINT `FK_B14376C082EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `FK_B14376C0AABEFE2C` FOREIGN KEY (`id_produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit_materiaux`
--
ALTER TABLE `produit_materiaux`
  ADD CONSTRAINT `FK_135238C9A3AFCEC0` FOREIGN KEY (`id_materiaux_id`) REFERENCES `materiaux` (`id`),
  ADD CONSTRAINT `FK_135238C9AABEFE2C` FOREIGN KEY (`id_produit_id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
