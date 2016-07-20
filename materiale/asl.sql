-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2016 at 11:35 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asl`
--

-- --------------------------------------------------------

--
-- Table structure for table `aree_aut`
--

CREATE TABLE `aree_aut` (
  `idarea` varchar(200) NOT NULL,
  `idutente` int(10) NOT NULL,
  `amministratore` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aree_aut`
--

INSERT INTO `aree_aut` (`idarea`, `idutente`, `amministratore`) VALUES
('admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aziende`
--

CREATE TABLE `aziende` (
  `id` int(10) UNSIGNED NOT NULL,
  `denominazione` varchar(200) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `attecateco` varchar(255) NOT NULL,
  `rapprlegale` varchar(200) NOT NULL,
  `codfisc` varchar(16) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aziende`
--

INSERT INTO `aziende` (`id`, `denominazione`, `indirizzo`, `attecateco`, `rapprlegale`, `codfisc`, `telefono`, `email`, `web`) VALUES
(2, 'prova 2', '', '', '', '', '', '', ''),
(3, 'prova 3', '', '', '', '', '', '', ''),
(4, 'prova 4', '', '', '', '', '', '', ''),
(8, 'prova 6', '', '', '', 'aaaaa', '', '', ''),
(9, 'prova 5', '', '', '', '', '', '', ''),
(11, 'prova 7', '', '', '', '', '', '', ''),
(12, 'prova 8', '', '', '', '', '', '', ''),
(14, 'aaa2', '', '', 'xxxxxxxx', '', '', '', ''),
(15, 'prova 1', '', '', '', '', '', '', ''),
(16, 'aaa1', 'Via Risorgimento, 4 - 84043 - Agropoli', '', '', '', '', '', ''),
(17, 'aaa3', '', '', '', '', '', '', ''),
(18, 'Prova 9', '', '', '', '', '', '', ''),
(23, 'prova 10', '', '', '', '', '', '', ''),
(24, 'AAA4', 'Via Pio X, 84043, Agropoli ', '', '', '', '', '', ''),
(25, 'BBB1', 'Via Madonna del Carmine, 63 - 84043 - Agropoli (SA)', '', '', '', '', 'fchiriaco@libero.it', ''),
(28, 'aa34', 'Via Risorgimento, 3 - 84043 - Agropoli', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sezioni_aut`
--

CREATE TABLE `sezioni_aut` (
  `idsezaut` varchar(200) NOT NULL,
  `Descrizione` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sezioni_aut`
--

INSERT INTO `sezioni_aut` (`idsezaut`, `Descrizione`) VALUES
('admin', 'Amministrazione sistema');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `id` int(7) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`) VALUES
(1, 'fchiriaco', '*94BF68B8E3D0CABDE9C074FF312EE24230579C5A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `denominazione` (`denominazione`);

--
-- Indexes for table `sezioni_aut`
--
ALTER TABLE `sezioni_aut`
  ADD PRIMARY KEY (`idsezaut`),
  ADD KEY `Descrizione` (`Descrizione`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aziende`
--
ALTER TABLE `aziende`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
