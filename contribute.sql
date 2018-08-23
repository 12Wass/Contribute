-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2018 at 01:59 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `contribute`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'Jeux-vidéos', 'Projet concernant les jeux-vidéos'),
(2, 'BD - Manga', 'Projet concernant l\'univers de la BD - Manga'),
(3, 'Nouvelles technologies', 'Projet sur la new-tech'),
(4, 'Ecologie', 'Projet écologique'),
(5, 'Social - Humanitaire', 'Projet sociologique et/ou humanitaire');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE `contribution` (
  `id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `funds` int(11) DEFAULT '0',
  `description` text,
  `deadLine` date DEFAULT NULL,
  `contribMin` int(11) DEFAULT NULL,
  `entryDate` date NOT NULL,
  `valid` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id`, `idCategorie`, `idUser`, `name`, `target`, `funds`, `description`, `deadLine`, `contribMin`, `entryDate`, `valid`) VALUES
(1, 1, 2, 'My Project ', 121212, 0, 'test', '2018-10-26', 12, '2018-07-27', 0),
(2, 1, 2, 'Test', NULL, 0, 'sttesare', '0000-00-00', NULL, '2018-07-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projetpictures`
--

CREATE TABLE `projetpictures` (
  `id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `photo1` blob NOT NULL,
  `photo2` blob NOT NULL,
  `photo3` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `firstName` varchar(70) NOT NULL,
  `picture` longblob,
  `username` varchar(19) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postalCode` char(5) NOT NULL,
  `description` text,
  `email` varchar(100) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastConnection` date NOT NULL,
  `birthday` date DEFAULT NULL,
  `code` varchar(15) NOT NULL,
  `valid` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `lastName`, `firstName`, `picture`, `username`, `address`, `city`, `postalCode`, `description`, `email`, `phone`, `password`, `dateReg`, `lastConnection`, `birthday`, `code`, `valid`) VALUES
(1, 'Boum', 'Kellogs', NULL, 'admin', 'adminville', 'adminville', '91110', 'Sisi deux temps', 'admin@admin.fr', '0618982091', '$2y$10$dfjBZFHOVCGOs/N9swtoleHJrZAzPdSXl9QcKBTDFnkMRIbdVcJZW', '2018-08-07 15:19:39', '2018-07-27', NULL, '', 1),
(2, 'DAHMANE', 'Wassim                   ', NULL, 'wassoxito          ', '19 rue du Galion', 'Puiseux-En-France                   ', '95380', NULL, 'wassimdah@gmail.com', NULL, '$2y$10$YkQILhTQh7CKbWQbSPtyjupvGlcUDkYdZWQ.MnQiQ4wOKX4Qo/nfK', '2018-08-22 03:45:52', '2018-08-22', NULL, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategorie` (`id`) USING BTREE;

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idProjet` (`idProjet`);

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjet_contribution` (`idProjet`),
  ADD KEY `idUser_contribution` (`idUser`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Indexes for table `projetpictures`
--
ALTER TABLE `projetpictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjet_projetpictures` (`idProjet`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projetpictures`
--
ALTER TABLE `projetpictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `idProjet_commentaire` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `idUser_commentaire` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Constraints for table `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `idProjet_contribution` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `idUser_contribution` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Constraints for table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `idCategorie_projet` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `idUser_projet` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Constraints for table `projetpictures`
--
ALTER TABLE `projetpictures`
  ADD CONSTRAINT `idProjet_projetpictures` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);
