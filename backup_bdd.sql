-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2019 at 04:43 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppe`
--

-- --------------------------------------------------------

--
-- Table structure for table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competence`
--

INSERT INTO `competence` (`id`, `libelle`, `version`) VALUES
(1, 'Notepad++', '7.6.2'),
(2, 'Photoshop', '20.0'),
(3, 'PHP', '5.0'),
(4, 'PHP', '7.0'),
(5, 'Visual Studio', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `Contrat`
--

CREATE TABLE `Contrat` (
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
-- Table structure for table `developpeur`
--

CREATE TABLE `developpeur` (
  `email` varchar(255) NOT NULL,
  `idRem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `developpeur`
--

INSERT INTO `developpeur` (`email`, `idRem`) VALUES
('philippe.soin@epsi.fr', 1),
('romain.lorente@epsi.fr', 1),
('florian.brassart@epsi.fr', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Entreprise`
--

CREATE TABLE `Entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `nomContact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Entreprise`
--

INSERT INTO `Entreprise` (`idEntreprise`, `nom`, `adresse`, `cp`, `ville`, `nomContact`) VALUES
(1, 'Ã‰duc Ã  Sion', '58 Boulevard des Oeillets', '62000', 'Arras', 'M. Soin');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `idResponsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id`, `libelle`, `idResponsable`) VALUES
(2, 'Ã‰quipe PPE', 'florian.brassart@epsi.fr');

-- --------------------------------------------------------

--
-- Table structure for table `Maitrise`
--

CREATE TABLE `Maitrise` (
  `idComp` int(11) NOT NULL,
  `idDev` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Maitrise`
--

INSERT INTO `Maitrise` (`idComp`, `idDev`, `niveau`) VALUES
(1, 'florian.brassart@epsi.fr', 'TrÃ¨s bon'),
(3, 'florian.brassart@epsi.fr', 'Correct'),
(4, 'florian.brassart@epsi.fr', 'Bon'),
(5, 'florian.brassart@epsi.fr', 'Bon');

-- --------------------------------------------------------

--
-- Table structure for table `Participation`
--

CREATE TABLE `Participation` (
  `idDev` varchar(255) NOT NULL,
  `idEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Projet`
--

CREATE TABLE `Projet` (
  `code` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `idEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Remuneration`
--

CREATE TABLE `Remuneration` (
  `idRem` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `coutHoraire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Remuneration`
--

INSERT INTO `Remuneration` (`idRem`, `libelle`, `coutHoraire`) VALUES
(1, 'DÃ©veloppeur', 20),
(2, 'Chef de projet', 35);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `code` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `cout` float NOT NULL,
  `heures` int(11) NOT NULL,
  `idDev` varchar(255) NOT NULL,
  `code_Projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `Contrat_Projet_FK` (`code`),
  ADD KEY `Contrat_Entreprise_FK` (`idEntreprise`);

--
-- Indexes for table `developpeur`
--
ALTER TABLE `developpeur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `Developpeur_Remuneration_FK` (`idRem`);

--
-- Indexes for table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD PRIMARY KEY (`idEntreprise`);

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Equipe_Responsable_FK` (`idResponsable`);

--
-- Indexes for table `Maitrise`
--
ALTER TABLE `Maitrise`
  ADD PRIMARY KEY (`idComp`,`idDev`),
  ADD KEY `Maitrise_Developpeur_FK` (`idDev`);

--
-- Indexes for table `Participation`
--
ALTER TABLE `Participation`
  ADD PRIMARY KEY (`idDev`,`idEquipe`),
  ADD KEY `Participation_Equipe_FK` (`idEquipe`);

--
-- Indexes for table `Projet`
--
ALTER TABLE `Projet`
  ADD PRIMARY KEY (`code`),
  ADD KEY `Projet_Equipe_FK` (`idEquipe`);

--
-- Indexes for table `Remuneration`
--
ALTER TABLE `Remuneration`
  ADD PRIMARY KEY (`idRem`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`code`),
  ADD KEY `Tache_Developpeur_FK` (`idDev`),
  ADD KEY `Tache_Projet_FK` (`code_Projet`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `Utilisateur_Role_FK` (`idRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Contrat`
--
ALTER TABLE `Contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Entreprise`
--
ALTER TABLE `Entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Projet`
--
ALTER TABLE `Projet`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Remuneration`
--
ALTER TABLE `Remuneration`
  MODIFY `idRem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `Contrat_Entreprise_FK` FOREIGN KEY (`idEntreprise`) REFERENCES `Entreprise` (`idEntreprise`),
  ADD CONSTRAINT `Contrat_Projet_FK` FOREIGN KEY (`code`) REFERENCES `Projet` (`code`);

--
-- Constraints for table `developpeur`
--
ALTER TABLE `developpeur`
  ADD CONSTRAINT `Developpeur_Remuneration_FK` FOREIGN KEY (`idRem`) REFERENCES `Remuneration` (`idRem`),
  ADD CONSTRAINT `Developpeur_Utilisateur_FK` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`email`);

--
-- Constraints for table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `Equipe_Responsable_FK` FOREIGN KEY (`idResponsable`) REFERENCES `utilisateur` (`email`);

--
-- Constraints for table `Maitrise`
--
ALTER TABLE `Maitrise`
  ADD CONSTRAINT `Maitrise_Competence_FK` FOREIGN KEY (`idComp`) REFERENCES `competence` (`id`),
  ADD CONSTRAINT `Maitrise_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`);

--
-- Constraints for table `Participation`
--
ALTER TABLE `Participation`
  ADD CONSTRAINT `Participation_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`),
  ADD CONSTRAINT `Participation_Equipe_FK` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

--
-- Constraints for table `Projet`
--
ALTER TABLE `Projet`
  ADD CONSTRAINT `Projet_Equipe_FK` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

--
-- Constraints for table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `Tache_Developpeur_FK` FOREIGN KEY (`idDev`) REFERENCES `developpeur` (`email`),
  ADD CONSTRAINT `Tache_Projet_FK` FOREIGN KEY (`code_Projet`) REFERENCES `Projet` (`code`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `Utilisateur_Role_FK` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
