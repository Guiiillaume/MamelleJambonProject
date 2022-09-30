-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 06 août 2022 à 00:43
-- Version du serveur : 5.7.19
-- Version de PHP : 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mamellejambonproject`
--
CREATE DATABASE IF NOT EXISTS `mamellejambonproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mamellejambonproject`;

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(15) NOT NULL,
  `note` varchar(50) NOT NULL,
  `montant` float NOT NULL,
  `dateDepense` date NOT NULL,
  `idDebiteur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDebiteur` (`idDebiteur`),
  KEY `idProjet` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

DROP TABLE IF EXISTS `devoir`;
CREATE TABLE IF NOT EXISTS `devoir` (
  `idDepense` int(11) NOT NULL,
  `idCrediteur` int(11) NOT NULL,
  `taux` float NOT NULL,
  `isRembourse` tinyint(1) NOT NULL,
  KEY `idDepense` (`idDepense`),
  KEY `idCrediteur` (`idCrediteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `idPersonne` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  KEY `idPersonne` (`idPersonne`),
  KEY `idProjet` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(38) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(15) NOT NULL,
  `note` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `depense_ibfk_1` FOREIGN KEY (`idDebiteur`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `depense_ibfk_2` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `devoir_ibfk_1` FOREIGN KEY (`idDepense`) REFERENCES `depense` (`id`),
  ADD CONSTRAINT `devoir_ibfk_2` FOREIGN KEY (`idCrediteur`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
