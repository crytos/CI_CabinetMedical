-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Juillet 2016 à 22:49
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cabinetmedical`
--
CREATE DATABASE `cabinetmedical`;

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

CREATE TABLE `consultations` (
  `id_consultation` int(11) NOT NULL,
  `consultation_date` datetime NOT NULL,
  `consultation_reason` varchar(100) NOT NULL,
  `observations` varchar(100) NOT NULL,
  `id_patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consultations`
--

INSERT INTO `consultations` (`id_consultation`, `consultation_date`, `consultation_reason`, `observations`, `id_patient`) VALUES
(1, '2016-07-19 12:39:12', 'Fièvre et maux de tête', 'Sous traitement', 1);

-- --------------------------------------------------------

--
-- Structure de la table `medical_folder`
--

CREATE TABLE `medical_folder` (
  `id_medical_folder` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `imc` int(11) NOT NULL,
  `blood_group` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') NOT NULL,
  `date_created` datetime NOT NULL,
  `id_patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `medical_folder`
--

INSERT INTO `medical_folder` (`id_medical_folder`, `height`, `weight`, `imc`, `blood_group`, `date_created`, `id_patient`) VALUES
(1, 175, 70, 23, 'O+', '2016-07-19 12:16:48', 1);

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `identification_number` varchar(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birth_date` date NOT NULL,
  `age` int(11) NOT NULL,
  `family_situation` int(11) NOT NULL,
  `professional_situation` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `patients`
--

INSERT INTO `patients` (`id`, `identification_number`, `name`, `maiden_name`, `first_name`, `gender`, `birth_date`, `age`, `family_situation`, `professional_situation`, `address`, `phone_number`) VALUES
(1, '28101995F', 'MAHI', 'MAHI', 'Fatima-Z', 'F', '1995-10-28', 20, 1, 3, 'Bt A2 Résidence les roses - Imama - Tlemcen', '043.21.26.93');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES
(1, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(2, 'secretaire', '2abd55e001c524cb2cf6300a89ca6366848a77d5', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id_consultation`),
  ADD KEY `id_patient` (`id_patient`);

--
-- Index pour la table `medical_folder`
--
ALTER TABLE `medical_folder`
  ADD PRIMARY KEY (`id_medical_folder`),
  ADD KEY `id_patient` (`id_patient`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id_consultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `medical_folder`
--
ALTER TABLE `medical_folder`
  MODIFY `id_medical_folder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `CONS_PATIENT_FK` FOREIGN KEY (`id_patient`) REFERENCES `patients` (`id`);

--
-- Contraintes pour la table `medical_folder`
--
ALTER TABLE `medical_folder`
  ADD CONSTRAINT `medical_folder_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `patients` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
