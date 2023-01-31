-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 31 jan. 2023 à 10:05
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appliseed`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoiroption`
--

CREATE TABLE `avoiroption` (
  `page` int(11) NOT NULL,
  `idOption` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avoiroption`
--

INSERT INTO `avoiroption` (`page`, `idOption`) VALUES
(50, 1),
(51, 1),
(52, 1),
(53, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `societe` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `lastConnection` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `role`, `nom`, `prenom`, `adresse`, `societe`, `mail`, `pwd`, `lastConnection`) VALUES
(1, 'admin', 'Admin', 'Admin', '1205 rue des Artilleurs Canadiens 62580 Thèlus', 'SeedWeb | StrangeEngine', 'tonipira.tp@gmail.com', '$2y$10$T51tkij/5EWcyxLx1.KAE.z4IOiSZM/AhLr/gLucMc1v9/UBsIX1.', '2023-01-30'),
(2, 'client', 'ClientTest', 'ClientTest', 'Test 62000 Arras', 'NoDefined', 'fallon59400@gmail.com', '$2y$10$gcWWzKi3P9dAcAcf./ACNeBbscVlWvJoZO6abTvqpskmkJQbj1wpe', '2023-01-30'),
(6, 'client', 'Vacavant', 'Cyril', '1205 rue des Artilleurs Canadiens', 'SeedWeb', 'hihomej450@bymercy.com', '$2y$10$4tojesj2zjrNncBQntHeIu7VDx2ytWhP90Fk1MjagSQ71a0y2ECeS', '2023-01-30');

-- --------------------------------------------------------

--
-- Structure de la table `formulaire`
--

CREATE TABLE `formulaire` (
  `id_client` int(11) NOT NULL,
  `progression` int(11) DEFAULT NULL,
  `id_site` int(11) NOT NULL,
  `dateCreation` date DEFAULT NULL,
  `dateLastUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formulaire`
--

INSERT INTO `formulaire` (`id_client`, `progression`, `id_site`, `dateCreation`, `dateLastUpdate`) VALUES
(6, 7, 16, '2023-01-30', '2023-01-31'),
(2, 0, 17, '2023-01-31', '2023-01-31');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `description` varchar(35) DEFAULT NULL,
  `facultatif` tinyint(1) NOT NULL,
  `alt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `section_id`, `page_id`, `nom`, `path`, `description`, `facultatif`, `alt`) VALUES
(101, 1, 46, 'Image-de-fond1', '../dossier_client/Vacavant_Cyril/Accueil/images/Image-de-fond1.jpg', 'Image derrière le texte.', 1, 'sszszssasas'),
(102, 2, 46, 'Image-service-1', '../dossier_client/Vacavant_Cyril/Accueil/images/Image-service-1.jpg', 'Image du 1er service', 1, ''),
(103, 2, 46, 'Image-service-2', '../dossier_client/Vacavant_Cyril/Accueil/images/Image-service-2.jpg', 'Image du deuxième service', 1, ''),
(104, 2, 46, 'Image-service-3', '', 'Image du 3ème service', 0, ''),
(105, 2, 46, 'Image-service-4', '', 'Image du 4eme service', 1, ''),
(106, 2, 46, 'Image-service-5', '', 'Image du 5eme service', 1, ''),
(107, 2, 46, 'Image-service-6', '', 'Image du 6eme service', 1, ''),
(108, 6, 46, 'Image-de-fond', '', 'Image de fond ', 0, ''),
(109, 2, 47, 'Image-service-1', '', 'Image du 1er service', 0, ''),
(110, 2, 47, 'Image-service-2', '', 'Image du deuxième service', 0, ''),
(111, 2, 47, 'Image-service-3', '', 'Image du 3ème service', 0, ''),
(112, 2, 47, 'Image-service-4', '', 'Image du 4eme service', 1, ''),
(113, 2, 47, 'Image-service-5', '', 'Image du 5eme service', 1, ''),
(114, 1, 48, 'image-1-hero', '', 'Image de l\'entreprise', 0, ''),
(115, 5, 48, 'image-valeur-1', '', 'Image de la valeur 1', 0, ''),
(116, 5, 48, 'image-valeur2', '', 'Image de la valeur 2', 0, ''),
(117, 5, 48, 'image-valeur3', '', 'Image de la valeur 3', 0, ''),
(118, 5, 48, 'Image-valeur4', '', 'Image de la valeur 4', 1, ''),
(119, 5, 48, 'Image-valeur5', '', 'Image de la valeur 5 ', 1, ''),
(120, 8, 49, 'image-de-contact', '../dossier_client/Vacavant_Cyril/Contact/images/image-de-contact.jpg', 'Image de contact', 1, 'test'),
(121, 1, 50, 'Image-de-fond1', '', 'Image derrière le texte.', 0, ''),
(122, 2, 50, 'Image-service-1', '', 'Image du 1er service', 0, ''),
(123, 2, 50, 'Image-service-2', '', 'Image du deuxième service', 0, ''),
(124, 2, 50, 'Image-service-3', '', 'Image du 3ème service', 0, ''),
(125, 2, 50, 'Image-service-4', '', 'Image du 4eme service', 1, ''),
(126, 2, 50, 'Image-service-5', '', 'Image du 5eme service', 1, ''),
(127, 2, 50, 'Image-service-6', '', 'Image du 6eme service', 1, ''),
(128, 6, 50, 'Image-de-fond', '', 'Image de fond ', 0, ''),
(129, 2, 51, 'Image-service-1', '', 'Image du 1er service', 0, ''),
(130, 2, 51, 'Image-service-2', '', 'Image du deuxième service', 0, ''),
(131, 2, 51, 'Image-service-3', '', 'Image du 3ème service', 0, ''),
(132, 2, 51, 'Image-service-4', '', 'Image du 4eme service', 1, ''),
(133, 2, 51, 'Image-service-5', '', 'Image du 5eme service', 1, ''),
(134, 1, 52, 'image-1-hero', '', 'Image de l\'entreprise', 0, ''),
(135, 5, 52, 'image-valeur-1', '', 'Image de la valeur 1', 0, ''),
(136, 5, 52, 'image-valeur2', '', 'Image de la valeur 2', 0, ''),
(137, 5, 52, 'image-valeur3', '', 'Image de la valeur 3', 0, ''),
(138, 5, 52, 'Image-valeur4', '', 'Image de la valeur 4', 1, ''),
(139, 5, 52, 'Image-valeur5', '', 'Image de la valeur 5 ', 1, ''),
(140, 8, 53, 'image-de-contact', '', 'Image de contact', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `image_modele`
--

CREATE TABLE `image_modele` (
  `id_imageM` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `id_section` int(11) NOT NULL,
  `id_pageM` int(11) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image_modele`
--

INSERT INTO `image_modele` (`id_imageM`, `nom`, `description`, `id_section`, `id_pageM`, `facultatif`) VALUES
(10, 'Image-de-fond1', 'Image derrière le texte.', 1, 37, 0),
(11, 'Image-service-1', 'Image du 1er service', 2, 37, 0),
(12, 'Image-service-2', 'Image du deuxième service', 2, 37, 0),
(13, 'Image-service-3', 'Image du 3ème service', 2, 37, 0),
(15, 'Image-service-4', 'Image du 4eme service', 2, 37, 1),
(16, 'Image-service-5', 'Image du 5eme service', 2, 37, 1),
(17, 'Image-service-6', 'Image du 6eme service', 2, 37, 1),
(18, 'Image-de-fond', 'Image de fond ', 6, 37, 0),
(19, 'Image-service-1', 'Image du 1er service', 2, 38, 0),
(20, 'Image-service-2', 'Image du deuxième service', 2, 38, 0),
(21, 'Image-service-3', 'Image du 3ème service', 2, 38, 0),
(22, 'Image-service-4', 'Image du 4eme service', 2, 38, 1),
(23, 'Image-service-5', 'Image du 5eme service', 2, 38, 1),
(24, 'image-1-hero', 'Image de l\'entreprise', 1, 39, 0),
(25, 'image-valeur-1', 'Image de la valeur 1', 5, 39, 0),
(26, 'image-valeur2', 'Image de la valeur 2', 5, 39, 0),
(27, 'image-valeur3', 'Image de la valeur 3', 5, 39, 0),
(28, 'Image-valeur4', 'Image de la valeur 4', 5, 39, 1),
(29, 'Image-valeur5', 'Image de la valeur 5 ', 5, 39, 1),
(30, 'image-de-contact', 'Image de contact', 8, 40, 0);

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `nom`, `prix`) VALUES
(1, 'Photographe', '799'),
(2, 'Agence', '799');

-- --------------------------------------------------------

--
-- Structure de la table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `page` tinyint(1) DEFAULT NULL,
  `form` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notif`
--

INSERT INTO `notif` (`id`, `admin`, `page`, `form`) VALUES
(1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `optionpage`
--

CREATE TABLE `optionpage` (
  `id` int(11) NOT NULL,
  `nom` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `optionpage`
--

INSERT INTO `optionpage` (`id`, `nom`) VALUES
(1, 'Redaction');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `site_id`, `nom`) VALUES
(46, 16, 'Accueil'),
(47, 16, 'Services'),
(48, 16, 'Qui sommes-nous'),
(49, 16, 'Contact'),
(50, 17, 'Accueil'),
(51, 17, 'Services'),
(52, 17, 'Qui sommes-nous'),
(53, 17, 'Contact');

-- --------------------------------------------------------

--
-- Structure de la table `page_modele`
--

CREATE TABLE `page_modele` (
  `id_pageM` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `id_modele` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `page_modele`
--

INSERT INTO `page_modele` (`id_pageM`, `nom`, `id_modele`) VALUES
(1, 'Accueil', 1),
(32, 'Portfolio', 1),
(36, 'Services', 1),
(37, 'Accueil', 2),
(38, 'Services', 2),
(39, 'Qui sommes-nous', 2),
(40, 'Contact', 2);

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `nom`) VALUES
(1, 'Hero'),
(2, 'Services'),
(3, 'Compétences'),
(4, 'Avis Clients'),
(5, 'Nos Valeurs'),
(6, 'Qualites'),
(7, 'Footer'),
(8, 'Contact'),
(9, 'Nos chiffres'),
(10, 'Tarifs');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `modele_id` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `client_id`, `modele_id`, `nom`, `url`) VALUES
(16, 6, 2, 'SeedWeb', 'https://urlTest.com'),
(17, 2, 2, 'Salon De Coiffure', 'https://urlTest.com');

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `taille` int(4) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `texte`
--

INSERT INTO `texte` (`id`, `section_id`, `page_id`, `nom`, `contenu`, `taille`, `facultatif`) VALUES
(180, 1, 46, 'Texte Call-To-Action', 'dddd', 35, 1),
(181, 6, 46, 'Nom Qualite 1', '', 30, 0),
(182, 6, 46, 'Nom Qualite 2', '', 30, 0),
(183, 6, 46, 'Nom Qualite 3', '', 30, 0),
(184, 6, 46, 'Description qualite 1', '', 200, 0),
(185, 6, 46, 'Description qualite 2', '', 200, 0),
(186, 6, 46, 'Description qualite 3', '', 200, 0),
(187, 3, 46, 'Nom de la première compétence', '', 20, 0),
(188, 3, 46, 'Nom de la deuxième compétence', '', 25, 0),
(189, 3, 46, 'Nom de la troisième compétence', '', 25, 0),
(190, 3, 46, 'Description de la 3ème compétence', '', 200, 0),
(191, 3, 46, 'Description de la 2ème compétence', '', 200, 0),
(192, 3, 46, 'Description de la 1ère compétence', '', 200, 0),
(193, 2, 46, 'Nom du 1er service', '', 25, 0),
(194, 2, 46, 'Nom du 2ème service', '', 25, 0),
(195, 2, 46, 'Nom du 3ème service', '', 25, 0),
(196, 2, 46, 'Nom du 4ème service', '', 25, 1),
(197, 2, 46, 'Nom du 5ème service', '', 25, 1),
(198, 2, 46, 'Nom du 6ème service', '', 25, 1),
(199, 2, 47, 'Titre premier service', '', 25, 0),
(200, 2, 47, 'Description du premier service', '', 600, 0),
(201, 2, 47, 'Titre deuxième service', '', 25, 0),
(202, 2, 47, 'Description deuxième service', '', 600, 0),
(203, 2, 47, 'Titre troisième service', '', 25, 0),
(204, 2, 47, 'Description troisième service', '', 600, 0),
(205, 10, 47, 'Titre + prix de la prestation 1', '', 60, 1),
(206, 10, 47, 'Contenu de la prestation 1', '', 200, 1),
(207, 10, 47, 'Titre + prix de la prestation 2', '', 60, 1),
(208, 10, 47, 'Contenu de la prestation 2', '', 200, 1),
(209, 10, 47, 'Titre + prix de la prestation 3', '', 60, 1),
(210, 10, 47, 'Contenu de la prestation 3', '', 200, 1),
(211, 1, 48, 'Présentation de l\'entreprise', '', 390, 0),
(212, 2, 48, 'Présentation des services', '', 300, 0),
(213, 2, 48, '1er service', '', 50, 0),
(214, 2, 48, '2ème service', '', 50, 0),
(215, 2, 48, '3ème service', '', 50, 0),
(216, 9, 48, 'Titre de présentation des chiffres', '', 100, 1),
(217, 9, 48, '1er chiffre avec sa description', '', 30, 1),
(218, 9, 48, '2ème chiffre avec sa description', '', 30, 1),
(219, 9, 48, '3ème chiffre avec sa description', '', 30, 1),
(220, 9, 48, '4ème chiffre avec sa description', '', 30, 1),
(221, 5, 48, 'Nom de la 1ère valeur', '', 25, 0),
(222, 5, 48, 'Description de la 1ere valeur', '', 350, 0),
(223, 5, 48, 'Nom de la deuxième valeur ', '', 25, 0),
(224, 5, 48, 'Description de la deuxième valeur', '', 350, 0),
(225, 5, 48, 'Nom de la troisième valeur', '', 25, 0),
(226, 5, 48, 'Description de la 3ème valeur', '', 350, 0),
(227, 8, 49, 'Texte de contact', '', 80, 1),
(228, 1, 50, 'Texte Call-To-Action', '', 35, 0),
(229, 6, 50, 'Nom Qualite 1', '', 30, 0),
(230, 6, 50, 'Nom Qualite 2', '', 30, 0),
(231, 6, 50, 'Nom Qualite 3', '', 30, 0),
(232, 6, 50, 'Description qualite 1', '', 200, 0),
(233, 6, 50, 'Description qualite 2', '', 200, 0),
(234, 6, 50, 'Description qualite 3', '', 200, 0),
(235, 3, 50, 'Nom de la première compétence', '', 20, 0),
(236, 3, 50, 'Nom de la deuxième compétence', '', 25, 0),
(237, 3, 50, 'Nom de la troisième compétence', '', 25, 0),
(238, 3, 50, 'Description de la 3ème compétence', '', 200, 0),
(239, 3, 50, 'Description de la 2ème compétence', '', 200, 0),
(240, 3, 50, 'Description de la 1ère compétence', '', 200, 0),
(241, 2, 50, 'Nom du 1er service', '', 25, 0),
(242, 2, 50, 'Nom du 2ème service', '', 25, 0),
(243, 2, 50, 'Nom du 3ème service', '', 25, 0),
(244, 2, 50, 'Nom du 4ème service', '', 25, 1),
(245, 2, 50, 'Nom du 5ème service', '', 25, 1),
(246, 2, 50, 'Nom du 6ème service', '', 25, 1),
(247, 2, 51, 'Titre premier service', '', 25, 0),
(248, 2, 51, 'Description du premier service', '', 600, 0),
(249, 2, 51, 'Titre deuxième service', '', 25, 0),
(250, 2, 51, 'Description deuxième service', '', 600, 0),
(251, 2, 51, 'Titre troisième service', '', 25, 0),
(252, 2, 51, 'Description troisième service', '', 600, 0),
(253, 10, 51, 'Titre + prix de la prestation 1', '', 60, 1),
(254, 10, 51, 'Contenu de la prestation 1', '', 200, 1),
(255, 10, 51, 'Titre + prix de la prestation 2', '', 60, 1),
(256, 10, 51, 'Contenu de la prestation 2', '', 200, 1),
(257, 10, 51, 'Titre + prix de la prestation 3', '', 60, 1),
(258, 10, 51, 'Contenu de la prestation 3', '', 200, 1),
(259, 1, 52, 'Présentation de l\'entreprise', '', 390, 0),
(260, 2, 52, 'Présentation des services', '', 300, 0),
(261, 2, 52, '1er service', '', 50, 0),
(262, 2, 52, '2ème service', '', 50, 0),
(263, 2, 52, '3ème service', '', 50, 0),
(264, 9, 52, 'Titre de présentation des chiffres', '', 100, 1),
(265, 9, 52, '1er chiffre avec sa description', '', 30, 1),
(266, 9, 52, '2ème chiffre avec sa description', '', 30, 1),
(267, 9, 52, '3ème chiffre avec sa description', '', 30, 1),
(268, 9, 52, '4ème chiffre avec sa description', '', 30, 1),
(269, 5, 52, 'Nom de la 1ère valeur', '', 25, 0),
(270, 5, 52, 'Description de la 1ere valeur', '', 350, 0),
(271, 5, 52, 'Nom de la deuxième valeur ', '', 25, 0),
(272, 5, 52, 'Description de la deuxième valeur', '', 350, 0),
(273, 5, 52, 'Nom de la troisième valeur', '', 25, 0),
(274, 5, 52, 'Description de la 3ème valeur', '', 350, 0),
(275, 8, 53, 'Texte de contact', '', 80, 1);

-- --------------------------------------------------------

--
-- Structure de la table `texte_modele`
--

CREATE TABLE `texte_modele` (
  `id_texteM` int(11) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_pageM` int(11) NOT NULL,
  `taille` int(4) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `texte_modele`
--

INSERT INTO `texte_modele` (`id_texteM`, `nom`, `id_section`, `id_pageM`, `taille`, `facultatif`) VALUES
(6, 'Texte Call-To-Action', 1, 37, 35, 0),
(13, 'Nom Qualite 1', 6, 37, 30, 0),
(14, 'Nom Qualite 2', 6, 37, 30, 0),
(15, 'Nom Qualite 3', 6, 37, 30, 0),
(16, 'Description qualite 1', 6, 37, 200, 0),
(17, 'Description qualite 2', 6, 37, 200, 0),
(18, 'Description qualite 3', 6, 37, 200, 0),
(19, 'Nom de la première compétence', 3, 37, 20, 0),
(20, 'Nom de la deuxième compétence', 3, 37, 25, 0),
(21, 'Nom de la troisième compétence', 3, 37, 25, 0),
(22, 'Description de la 3ème compétence', 3, 37, 200, 0),
(23, 'Description de la 2ème compétence', 3, 37, 200, 0),
(24, 'Description de la 1ère compétence', 3, 37, 200, 0),
(25, 'Nom du 1er service', 2, 37, 25, 0),
(26, 'Nom du 2ème service', 2, 37, 25, 0),
(27, 'Nom du 3ème service', 2, 37, 25, 0),
(28, 'Nom du 4ème service', 2, 37, 25, 1),
(29, 'Nom du 5ème service', 2, 37, 25, 1),
(30, 'Nom du 6ème service', 2, 37, 25, 1),
(32, 'Présentation de l\'entreprise', 1, 39, 390, 0),
(33, 'Présentation des services', 2, 39, 300, 0),
(34, '1er service', 2, 39, 50, 0),
(35, '2ème service', 2, 39, 50, 0),
(36, '3ème service', 2, 39, 50, 0),
(37, 'Titre de présentation des chiffres', 9, 39, 100, 1),
(38, '1er chiffre avec sa description', 9, 39, 30, 1),
(39, '2ème chiffre avec sa description', 9, 39, 30, 1),
(40, '3ème chiffre avec sa description', 9, 39, 30, 1),
(41, '4ème chiffre avec sa description', 9, 39, 30, 1),
(42, 'Nom de la 1ère valeur', 5, 39, 25, 0),
(43, 'Description de la 1ere valeur', 5, 39, 350, 0),
(44, 'Nom de la deuxième valeur ', 5, 39, 25, 0),
(45, 'Description de la deuxième valeur', 5, 39, 350, 0),
(46, 'Nom de la troisième valeur', 5, 39, 25, 0),
(47, 'Description de la 3ème valeur', 5, 39, 350, 0),
(48, 'Titre premier service', 2, 38, 25, 0),
(49, 'Description du premier service', 2, 38, 600, 0),
(50, 'Titre deuxième service', 2, 38, 25, 0),
(51, 'Description deuxième service', 2, 38, 600, 0),
(52, 'Titre troisième service', 2, 38, 25, 0),
(53, 'Description troisième service', 2, 38, 600, 0),
(54, 'Titre + prix de la prestation 1', 10, 38, 60, 1),
(55, 'Contenu de la prestation 1', 10, 38, 200, 1),
(56, 'Titre + prix de la prestation 2', 10, 38, 60, 1),
(57, 'Contenu de la prestation 2', 10, 38, 200, 1),
(58, 'Titre + prix de la prestation 3', 10, 38, 60, 1),
(59, 'Contenu de la prestation 3', 10, 38, 200, 1),
(60, 'Texte de contact', 8, 40, 80, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avoiroption`
--
ALTER TABLE `avoiroption`
  ADD PRIMARY KEY (`page`,`idOption`),
  ADD KEY `fk1111` (`idOption`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD KEY `ggg` (`id_client`),
  ADD KEY `id_site` (`id_site`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FD823E37A` (`section_id`),
  ADD KEY `IDX_C53D045FC4663E4` (`page_id`);

--
-- Index pour la table `image_modele`
--
ALTER TABLE `image_modele`
  ADD PRIMARY KEY (`id_imageM`),
  ADD KEY `fk_2` (`id_section`),
  ADD KEY `fk_3` (`id_pageM`);

--
-- Index pour la table `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk56` (`admin`);

--
-- Index pour la table `optionpage`
--
ALTER TABLE `optionpage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_140AB620F6BD1646` (`site_id`);

--
-- Index pour la table `page_modele`
--
ALTER TABLE `page_modele`
  ADD PRIMARY KEY (`id_pageM`),
  ADD KEY `fk_1` (`id_modele`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_694309E419EB6921` (`client_id`),
  ADD KEY `IDX_694309E4AC14B70A` (`modele_id`);

--
-- Index pour la table `texte`
--
ALTER TABLE `texte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EAE1A6EED823E37A` (`section_id`),
  ADD KEY `IDX_EAE1A6EEC4663E4` (`page_id`);

--
-- Index pour la table `texte_modele`
--
ALTER TABLE `texte_modele`
  ADD PRIMARY KEY (`id_texteM`),
  ADD KEY `fk_33` (`id_section`),
  ADD KEY `fk_44` (`id_pageM`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT pour la table `image_modele`
--
ALTER TABLE `image_modele`
  MODIFY `id_imageM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `modele`
--
ALTER TABLE `modele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `optionpage`
--
ALTER TABLE `optionpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `page_modele`
--
ALTER TABLE `page_modele`
  MODIFY `id_pageM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `texte`
--
ALTER TABLE `texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT pour la table `texte_modele`
--
ALTER TABLE `texte_modele`
  MODIFY `id_texteM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoiroption`
--
ALTER TABLE `avoiroption`
  ADD CONSTRAINT `fk111` FOREIGN KEY (`page`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk1111` FOREIGN KEY (`idOption`) REFERENCES `optionpage` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD CONSTRAINT `formulaire_ibfk_1` FOREIGN KEY (`id_site`) REFERENCES `site` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ggg` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C53D045FD823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image_modele`
--
ALTER TABLE `image_modele`
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`id_section`) REFERENCES `section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`id_pageM`) REFERENCES `page_modele` (`id_pageM`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `fk56` FOREIGN KEY (`admin`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB620F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `page_modele`
--
ALTER TABLE `page_modele`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`id_modele`) REFERENCES `modele` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `FK_694309E419EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_694309E4AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `texte`
--
ALTER TABLE `texte`
  ADD CONSTRAINT `FK_EAE1A6EEC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EAE1A6EED823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `texte_modele`
--
ALTER TABLE `texte_modele`
  ADD CONSTRAINT `fk_33` FOREIGN KEY (`id_section`) REFERENCES `section` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_44` FOREIGN KEY (`id_pageM`) REFERENCES `page_modele` (`id_pageM`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
