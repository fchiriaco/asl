-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2016 at 06:15 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pasl`
--

-- --------------------------------------------------------

--
-- Table structure for table `alunni`
--

CREATE TABLE `alunni` (
  `Id` int(11) NOT NULL,
  `Cognome` varchar(100) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Luogo_nascita` varchar(100) NOT NULL,
  `Codice_fiscale` varchar(16) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Cap` varchar(5) NOT NULL,
  `Città` varchar(100) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idutente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classi`
--

CREATE TABLE `classi` (
  `Id_classe` int(11) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `Idsede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docenti`
--

CREATE TABLE `docenti` (
  `Id` int(11) NOT NULL,
  `Cognome` varchar(100) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Luogo_nascita` varchar(100) NOT NULL,
  `Codice_fiscale` varchar(16) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Cap` varchar(5) NOT NULL,
  `Città` varchar(100) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Idutente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `frequenta`
--

CREATE TABLE `frequenta` (
  `Idclasse` int(11) NOT NULL,
  `idalunno` int(11) NOT NULL,
  `Anno_scolastico` year(4) NOT NULL,
  `Anno_corso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insegna`
--

CREATE TABLE `insegna` (
  `Id_classe` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `Materia` varchar(100) NOT NULL,
  `coordinatore` tinyint(1) NOT NULL,
  `Anno_scolastico` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `istituti`
--

CREATE TABLE `istituti` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sedi`
--

CREATE TABLE `sedi` (
  `id` int(11) NOT NULL,
  `Nome_sede` varchar(100) NOT NULL,
  `Indirizzo` varchar(255) NOT NULL,
  `Telefono` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Responsabile` varchar(100) NOT NULL,
  `Idistituto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `Id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunni`
--
ALTER TABLE `alunni`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idutente` (`idutente`);

--
-- Indexes for table `classi`
--
ALTER TABLE `classi`
  ADD PRIMARY KEY (`Id_classe`),
  ADD KEY `Idsede` (`Idsede`);

--
-- Indexes for table `docenti`
--
ALTER TABLE `docenti`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Idutente` (`Idutente`);

--
-- Indexes for table `frequenta`
--
ALTER TABLE `frequenta`
  ADD KEY `Idclasse` (`Idclasse`),
  ADD KEY `idalunno` (`idalunno`);

--
-- Indexes for table `insegna`
--
ALTER TABLE `insegna`
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `Id_classe` (`Id_classe`);

--
-- Indexes for table `istituti`
--
ALTER TABLE `istituti`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sedi`
--
ALTER TABLE `sedi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Idistituto` (`Idistituto`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunni`
--
ALTER TABLE `alunni`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classi`
--
ALTER TABLE `classi`
  MODIFY `Id_classe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `docenti`
--
ALTER TABLE `docenti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `istituti`
--
ALTER TABLE `istituti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sedi`
--
ALTER TABLE `sedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alunni`
--
ALTER TABLE `alunni`
  ADD CONSTRAINT `alunni_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`Id`);

--
-- Constraints for table `classi`
--
ALTER TABLE `classi`
  ADD CONSTRAINT `classi_ibfk_1` FOREIGN KEY (`Idsede`) REFERENCES `sedi` (`id`);

--
-- Constraints for table `docenti`
--
ALTER TABLE `docenti`
  ADD CONSTRAINT `docenti_ibfk_1` FOREIGN KEY (`Idutente`) REFERENCES `utenti` (`Id`);

--
-- Constraints for table `frequenta`
--
ALTER TABLE `frequenta`
  ADD CONSTRAINT `frequenta_ibfk_1` FOREIGN KEY (`Idclasse`) REFERENCES `classi` (`Id_classe`),
  ADD CONSTRAINT `frequenta_ibfk_2` FOREIGN KEY (`idalunno`) REFERENCES `alunni` (`Id`);

--
-- Constraints for table `insegna`
--
ALTER TABLE `insegna`
  ADD CONSTRAINT `insegna_ibfk_1` FOREIGN KEY (`Id_classe`) REFERENCES `classi` (`Id_classe`),
  ADD CONSTRAINT `insegna_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docenti` (`Id`);

--
-- Constraints for table `sedi`
--
ALTER TABLE `sedi`
  ADD CONSTRAINT `sedi_ibfk_1` FOREIGN KEY (`Idistituto`) REFERENCES `istituti` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
