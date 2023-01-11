-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 11 jan. 2023 à 13:53
-- Version du serveur :  10.6.11-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hclt9295_appliweb`
--

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
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `role`, `nom`, `prenom`, `adresse`, `societe`, `mail`, `pwd`) VALUES
(1, '', 'Test', 'test', 'test', 'test', 'test@gmail.com', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `nb_image` int(11) NOT NULL,
  `nb_texte` int(11) NOT NULL,
  `pages_comprises` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page_section`
--

CREATE TABLE `page_section` (
  `page_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Index pour la table `page_section`
--
ALTER TABLE `page_section`
  ADD PRIMARY KEY (`page_id`,`section_id`),
  ADD KEY `IDX_D713917AC4663E4` (`page_id`),
  ADD KEY `IDX_D713917AD823E37A` (`section_id`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modele`
--
ALTER TABLE `modele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `texte`
--
ALTER TABLE `texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_C53D045FD823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB620F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `page_section`
--
ALTER TABLE `page_section`
  ADD CONSTRAINT `FK_D713917AC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D713917AD823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `FK_694309E419EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_694309E4AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`);

--
-- Contraintes pour la table `texte`
--
ALTER TABLE `texte`
  ADD CONSTRAINT `FK_EAE1A6EEC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_EAE1A6EED823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
