-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 04 avr. 2019 à 08:39
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `libelle`, `version`) VALUES
(1, 'Notepad++', '7.6.2'),
(2, 'Photoshop', '20.0'),
(3, 'PHP', '5.0'),
(4, 'PHP', '7.0'),
(5, 'Visual Studio', '2017');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `idContrat` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `dateSignature` date NOT NULL,
  `cout` float NOT NULL,
  `code` int(11) NOT NULL,
  `idEntreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `developpeur`
--

CREATE TABLE `developpeur` (
  `email` varchar(255) NOT NULL,
  `idRem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `developpeur`
--

INSERT INTO `developpeur` (`email`, `idRem`) VALUES
('philippe.soin@epsi.fr', 1),
('romain.lorente@epsi.fr', 1),
('florian.brassart@epsi.fr', 2);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `nomContact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `nom`, `adresse`, `cp`, `ville`, `nomContact`) VALUES
(1, 'Ã‰duc Ã  Sion', '58 Boulevard des Oeillets', '62000', 'Arras', 'M. Soin');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `idResponsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id`, `libelle`, `idResponsable`) VALUES
(2, 'Ã‰quipe PPE', 'florian.brassart@epsi.fr');

-- --------------------------------------------------------

--
-- Structure de la table `maitrise`
--

CREATE TABLE `maitrise` (
  `idComp` int(11) NOT NULL,
  `idDev` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maitrise`
--

INSERT INTO `maitrise` (`idComp`, `idDev`, `niveau`) VALUES
(1, 'florian.brassart@epsi.fr', 'TrÃ¨s bon'),
(3, 'florian.brassart@epsi.fr', 'Correct'),
(4, 'florian.brassart@epsi.fr', 'Bon'),
(5, 'florian.brassart@epsi.fr', 'Bon');

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `idDev` varchar(255) NOT NULL,
  `idEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `code` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `idEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`code`, `libelle`, `idEquipe`) VALUES
(1, 'CrÃ©er le site', 2);

-- --------------------------------------------------------

--
-- Structure de la table `remuneration`
--

CREATE TABLE `remuneration` (
  `idRem` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `coutHoraire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `remuneration`
--

INSERT INTO `remuneration` (`idRem`, `libelle`, `coutHoraire`) VALUES
(1, 'DÃ©veloppeur', 20),
(2, 'Chef de projet', 35);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `code` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `cout` float NOT NULL,
  `horaire` int(11) NOT NULL,
  `idDev` varchar(255) NOT NULL,
  `code_Projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`code`, `libelle`, `cout`, `horaire`, `idDev`, `code_Projet`) VALUES
(1, 'Finir la table TÃ¢che', 0, 2, 'romain.lorente@epsi.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `mdp`, `nom`, `prenom`, `idRole`) VALUES
('brendan.legendre@epsi.fr', '$2y$10$iLYlNDJ4cKnELn2EA.eEDuMLC1fZRFJGDKIlKg6Nk0yiqnYSQnSJ6', 'Legendre', 'Brendan', 2),
('florian.brassart@epsi.fr', '$2y$10$Gi.0sD57puyETLkvkWUHaOqZllH03Gk0zBQbKFeqM/ZuEc2WWjf3G', 'Brassart', 'Florian', 2),
('jean.dupont@epsi.fr', '$2y$10$t06c1j/ZesvdIO.EkbeuQOmiPPuZ/vVt98uLOdXbQB6kLlw9HFJpG', 'Dupont', 'Jean', 2),
('philippe.soin@epsi.fr', '$2y$10$Sb9FtZiMNkrbPvqvnhEz..XtyUEm9Wo6WiINHHHfB4NHgtTXjHdcm', 'Soin', 'Philippe', 2),
('quentin.legrand@epsi.fr', '$2y$10$i.MwtF18alpZuh4WeOEArOQ9aBiBso2znPgw0FottdfZqNg2m0req', 'Legrand', 'Quentin', 2),
('romain.lorente@epsi.fr', '$2y$10$fMFFZ7qyUTF1sB4.5oiGZeTG0jKZnfTvQJ2WArxL3fHFN4ZodbtKW', 'Lorente', 'Romain', 1),
('valentin.fiquet@epsi.fr', '$2y$10$g2DcW58CwRRAAY0f2qRgZ.Wh1q5Bx5QPgDCb.OHv5SIsw78VW3LaW', 'Fiquet', 'Valentin', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `Contrat_Projet_FK` (`code`),
  ADD KEY `Contrat_Entreprise_FK` (`idEntreprise`);

--
-- Index pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `Developpeur_Remuneration_FK` (`idRem`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntreprise`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Equipe_Responsable_FK` (`idResponsable`);

--
-- Index pour la table `maitrise`
--
ALTER TABLE `maitrise`
  ADD PRIMARY KEY (`idComp`,`idDev`),
  ADD KEY `Maitrise_Developpeur_FK` (`idDev`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`idDev`,`idEquipe`),
  ADD KEY `Participation_Equipe_FK` (`idEquipe`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`code`),
  ADD KEY `Projet_Equipe_FK` (`idEquipe`);

--
-- Index pour la table `remuneration`
--
ALTER TABLE `remuneration`
  ADD PRIMARY KEY (`idRem`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`code`),
  ADD KEY `Tache_Developpeur_FK` (`idDev`),
  ADD KEY `Tache_Projet_FK` (`code_Projet`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `Utilisateur_Role_FK` (`idRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `remuneration`
--
ALTER TABLE `remuneration`
  MODIFY `idRem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `Contrat_Entreprise_FK` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`),
  ADD CONSTRAINT `Contrat_Projet_FK` FOREIGN KEY (`code`) REFERENCES `projet` (`code`);

--
-- Contraintes pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD CONSTRAINT `Developpeur_Remuneration_FK` FOREIGN KEY (`idRem`) REFERENCES `remuneration` (`idRem`),
  ADD CONSTRAINT `Developpeur_Utilisateur_FK` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`email`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `Equipe_Responsable_FK` FOREIGN KEY (`idResponsable`) REFERENCES `utilisateur` (`email`);

--
-- Contraintes pour la table `maitrise`
--
ALTER TABLE `maitrise`
  ADD CONSTRAINT `Maitrise_Competence_FK` FOREIGN KEY (`idComp`) REFERENCES `competence` (`id`),
  ADD CONSTRAINT `Maitrise_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `Participation_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`),
  ADD CONSTRAINT `Participation_Equipe_FK` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `Projet_Equipe_FK` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `Tache_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`),
  ADD CONSTRAINT `Tache_Projet_FK` FOREIGN KEY (`code_Projet`) REFERENCES `projet` (`code`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `Utilisateur_Role_FK` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
