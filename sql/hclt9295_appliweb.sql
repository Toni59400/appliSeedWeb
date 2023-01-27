-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 jan. 2023 à 15:56
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

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
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `role` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastConnection` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `role`, `nom`, `prenom`, `adresse`, `societe`, `mail`, `pwd`, `lastConnection`) VALUES
(1, 'admin', 'Admin', 'Admin', '1205 rue des Artilleurs Canadiens 62580 Thèlus', 'SeedWeb | StrangeEngine', 'tonipira.tp@gmail.com', '$2y$10$T51tkij/5EWcyxLx1.KAE.z4IOiSZM/AhLr/gLucMc1v9/UBsIX1.', '2023-01-27'),
(2, 'client', 'ClientTest', 'ClientTest', 'Test 62000 Arras', 'NoDefined', 'fallon59400@gmail.com', '$2y$10$gcWWzKi3P9dAcAcf./ACNeBbscVlWvJoZO6abTvqpskmkJQbj1wpe', '2023-01-27');

-- --------------------------------------------------------

--
-- Structure de la table `formulaire`
--

CREATE TABLE `formulaire` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `progression` int(11) DEFAULT NULL,
  `id_site` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateLastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formulaire`
--

INSERT INTO `formulaire` (`id`, `id_client`, `progression`, `id_site`, `dateCreation`, `dateLastUpdate`) VALUES
(7, 2, 20, 13, '2023-01-24 11:26:05', '2023-01-27 14:35:21');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `section_id`, `page_id`, `nom`, `path`, `description`, `facultatif`) VALUES
(41, 1, 34, 'Image-de-fond', '../dossier_client/ClientTest_ClientTest_NoDefined/Accueil/images/Image-de-fond.jpg', 'Image derrière le texte.', 1),
(42, 2, 34, 'Image-service-1', '', 'Image du 1er service', 0),
(43, 2, 34, 'Image-service-2', '', 'Image du deuxième service', 0),
(44, 2, 34, 'Image-service-3', '', 'Image du 3ème service', 0),
(45, 2, 34, 'Image-service-4', '', 'Image du 4eme service', 1),
(46, 2, 34, 'Image-service-5', '', 'Image du 5eme service', 1),
(47, 2, 34, 'Image-service-6', '', 'Image du 6eme service', 1),
(48, 6, 34, 'Image-de-fond', '', 'Image de fond ', 0),
(49, 2, 35, 'Image-service-1', '', 'Image du 1er service', 0),
(50, 2, 35, 'Image-service-2', '', 'Image du deuxième service', 0),
(51, 2, 35, 'Image-service-3', '', 'Image du 3ème service', 0),
(52, 2, 35, 'Image-service-4', '', 'Image du 4eme service', 1),
(53, 2, 35, 'Image-service-5', '', 'Image du 5eme service', 1),
(54, 1, 36, 'image-1-hero', '../dossier_client/ClientTest_ClientTest_NoDefined/Qui sommes-nous/images/image-1-hero.png', 'Image de l\'entreprise', 1),
(55, 5, 36, 'image-valeur-1', '../dossier_client/ClientTest_ClientTest_NoDefined/Qui sommes-nous/images/image-valeur-1.png', 'Image de la valeur 1', 1),
(56, 5, 36, 'image-valeur2', '../dossier_client/ClientTest_ClientTest_NoDefined/Qui sommes-nous/images/image-valeur2.png', 'Image de la valeur 2', 1),
(57, 5, 36, 'image-valeur3', '../dossier_client/ClientTest_ClientTest_NoDefined/Qui sommes-nous/images/image-valeur3.png', 'Image de la valeur 3', 1),
(58, 5, 36, 'Image-valeur4', '', 'Image de la valeur 4', 1),
(59, 5, 36, 'Image-valeur5', '', 'Image de la valeur 5 ', 1),
(60, 8, 37, 'image-de-contact', '../dossier_client/ClientTest_ClientTest_NoDefined/Contact/images/image-de-contact.png', 'Image de contact', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image_modele`
--

INSERT INTO `image_modele` (`id_imageM`, `nom`, `description`, `id_section`, `id_pageM`, `facultatif`) VALUES
(10, 'Image-de-fond', 'Image derrière le texte.', 1, 37, 0),
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
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `nom`, `prix`) VALUES
(1, 'Photographe', '799'),
(2, 'Agence', '799');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `site_id`, `nom`) VALUES
(34, 13, 'Accueil'),
(35, 13, 'Services'),
(36, 13, 'Qui sommes-nous'),
(37, 13, 'Contact');

-- --------------------------------------------------------

--
-- Structure de la table `page_modele`
--

CREATE TABLE `page_modele` (
  `id_pageM` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `id_modele` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `client_id`, `modele_id`, `nom`, `url`) VALUES
(13, 2, 2, 'Agence', 'https://agence.com');

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` int(4) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `texte`
--

INSERT INTO `texte` (`id`, `section_id`, `page_id`, `nom`, `contenu`, `taille`, `facultatif`) VALUES
(36, 1, 34, 'Texte Call-To-Action', 'test', 35, 1),
(37, 6, 34, 'Nom Qualite 1', 'Test', 30, 1),
(38, 6, 34, 'Nom Qualite 2', '', 30, 0),
(39, 6, 34, 'Nom Qualite 3', '', 30, 0),
(40, 6, 34, 'Description qualite 1', 'Test', 200, 1),
(41, 6, 34, 'Description qualite 2', 'Test', 200, 1),
(42, 6, 34, 'Description qualite 3', 'Test', 200, 1),
(43, 3, 34, 'Nom de la première compétence', 'Test', 20, 1),
(44, 3, 34, 'Nom de la deuxième compétence', 'Test', 25, 1),
(45, 3, 34, 'Nom de la troisième compétence', 'Test', 25, 1),
(46, 3, 34, 'Description de la 3ème compétence', 'Test', 200, 1),
(47, 3, 34, 'Description de la 2ème compétence', 'Test', 200, 1),
(48, 3, 34, 'Description de la 1ère compétence', 'Test', 200, 1),
(49, 2, 34, 'Nom du 1er service', 'Test', 25, 1),
(50, 2, 34, 'Nom du 2ème service', 'Test', 25, 1),
(51, 2, 34, 'Nom du 3ème service', 'Test', 25, 1),
(52, 2, 34, 'Nom du 4ème service', '', 25, 1),
(53, 2, 34, 'Nom du 5ème service', '', 25, 1),
(54, 2, 34, 'Nom du 6ème service', '', 25, 1),
(55, 2, 35, 'Titre premier service', '', 25, 0),
(56, 2, 35, 'Description du premier service', '', 600, 0),
(57, 2, 35, 'Titre deuxième service', '', 25, 0),
(58, 2, 35, 'Description deuxième service', '', 600, 0),
(59, 2, 35, 'Titre troisième service', '', 25, 0),
(60, 2, 35, 'Description troisième service', '', 600, 0),
(61, 10, 35, 'Titre + prix de la prestation 1', '', 60, 1),
(62, 10, 35, 'Contenu de la prestation 1', '', 200, 1),
(63, 10, 35, 'Titre + prix de la prestation 2', '', 60, 1),
(64, 10, 35, 'Contenu de la prestation 2', '', 200, 1),
(65, 10, 35, 'Titre + prix de la prestation 3', '', 60, 1),
(66, 10, 35, 'Contenu de la prestation 3', '', 200, 1),
(67, 1, 36, 'Présentation de l\'entreprise', 'Entreprise de rénovation dans le bâtiment. ', 390, 1),
(68, 2, 36, 'Présentation des services', '', 300, 0),
(69, 2, 36, '1er service', 'test', 50, 1),
(70, 2, 36, '2ème service', '', 50, 0),
(71, 2, 36, '3ème service', '', 50, 0),
(72, 9, 36, 'Titre de présentation des chiffres', '', 100, 1),
(73, 9, 36, '1er chiffre avec sa description', '', 30, 1),
(74, 9, 36, '2ème chiffre avec sa description', '', 30, 1),
(75, 9, 36, '3ème chiffre avec sa description', '', 30, 1),
(76, 9, 36, '4ème chiffre avec sa description', '', 30, 1),
(77, 5, 36, 'Nom de la 1ère valeur', '', 25, 0),
(78, 5, 36, 'Description de la 1ere valeur', '', 350, 0),
(79, 5, 36, 'Nom de la deuxième valeur ', '', 25, 0),
(80, 5, 36, 'Description de la deuxième valeur', '', 350, 0),
(81, 5, 36, 'Nom de la troisième valeur', '', 25, 0),
(82, 5, 36, 'Description de la 3ème valeur', '', 350, 0),
(83, 8, 37, 'Texte de contact', '', 80, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fkformsite` (`id_site`),
  ADD KEY `fkformcli` (`id_client`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formulaire`
--
ALTER TABLE `formulaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `texte`
--
ALTER TABLE `texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT pour la table `texte_modele`
--
ALTER TABLE `texte_modele`
  MODIFY `id_texteM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD CONSTRAINT `fkformcli` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkformsite` FOREIGN KEY (`id_site`) REFERENCES `site` (`id`) ON DELETE CASCADE;

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
