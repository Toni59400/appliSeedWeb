-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 jan. 2023 à 12:03
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
(1, 'admin', 'Admin', 'Admin', '1205 rue des Artilleurs Canadiens 62580 Thèlus', 'SeedWeb | StrangeEngine', 'test@gmail.com', '$2y$10$T51tkij/5EWcyxLx1.KAE.z4IOiSZM/AhLr/gLucMc1v9/UBsIX1.', '2023-01-17'),
(2, 'client', 'ClientTest', 'ClientTest', 'Test 62000 Arras', 'NoDefined', 'mail@test.fr', '$2y$10$JVJPFsVI/3Fml7AizXg4.ueqKDo8jT/8DxzOp/iuTtig..sQZIY8K', '2023-01-16');

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
  `description` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `section_id`, `page_id`, `nom`, `path`, `description`, `facultatif`) VALUES
(1, 1, 10, 'Image de fond', '', 'Image derrière le texte', 0),
(2, 2, 10, 'Image Service 1', '', 'Image du service 1', 0),
(3, 2, 10, 'Image Service 2', '', 'Image du service 2', 0);

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
(3, 'Image de fond', 'Image derrière le texte', 1, 37, 0),
(4, 'Image Service 1', 'Image du service 1', 2, 37, 0),
(5, 'Image Service 2', 'Image du service 2', 2, 37, 0),
(7, 'Image 1 caroussel', '', 1, 1, 0),
(8, 'Image 3 caroussel', '', 1, 1, 1),
(9, 'Image 2 caroussel', '', 1, 1, 0);

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
(1, 2, 'Services'),
(2, 2, 'Portfolio'),
(3, 2, 'Accueil'),
(4, 2, 'Qui sommes-nous'),
(6, 2, 'Contact'),
(10, 5, 'Accueil'),
(11, 5, 'Services'),
(12, 5, 'Qui sommes-nous'),
(13, 5, 'Contact');

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
(5, 'Nos Valeurs');

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
(2, 2, 1, 'Test', 'https://urlTest.com'),
(5, 2, 2, 'Test2', 'https://urlTest.com');

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` int(4) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `texte`
--

INSERT INTO `texte` (`id`, `section_id`, `page_id`, `nom`, `contenu`, `taille`, `facultatif`) VALUES
(1, 1, 10, 'Texte Call-To-Action', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `texte_modele`
--

CREATE TABLE `texte_modele` (
  `id_texteM` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_pageM` int(11) NOT NULL,
  `taille` int(4) NOT NULL,
  `facultatif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `texte_modele`
--

INSERT INTO `texte_modele` (`id_texteM`, `nom`, `id_section`, `id_pageM`, `taille`, `facultatif`) VALUES
(6, 'Texte Call-To-Action', 1, 37, 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `image_modele`
--
ALTER TABLE `image_modele`
  MODIFY `id_imageM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `modele`
--
ALTER TABLE `modele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `page_modele`
--
ALTER TABLE `page_modele`
  MODIFY `id_pageM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `texte`
--
ALTER TABLE `texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `texte_modele`
--
ALTER TABLE `texte_modele`
  MODIFY `id_texteM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

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
