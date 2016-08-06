-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Gen 28, 2016 alle 20:03
-- Versione del server: 5.6.14
-- Versione PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iisdevivo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `aree_aut`
--

CREATE TABLE IF NOT EXISTS `aree_aut` (
  `idarea` varchar(15) NOT NULL,
  `idutente` int(7) NOT NULL DEFAULT '0',
  `amministratore` int(1) NOT NULL DEFAULT '0',
  KEY `idutente` (`idutente`),
  KEY `idarea` (`idarea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `aree_aut`
--

INSERT INTO `aree_aut` (`idarea`, `idutente`, `amministratore`) VALUES
('admin', 1, 1),
('news', 1, 1),
('circolari', 1, 1),
('sicurezza', 1, 1),
('albopretorio', 1, 1),
('albopretorio', 2, 1),
('admin', 2, 1),
('circolari', 2, 1),
('news', 2, 1),
('albopretorio', 3, 1),
('admin', 3, 1),
('circolari', 3, 1),
('news', 3, 1),
('circolari', 4, 0),
('circolari', 5, 0),
('circolari', 6, 0),
('circolari', 7, 0),
('circolari', 8, 0),
('circolari', 9, 0),
('circolari', 10, 0),
('circolari', 11, 0),
('circolari', 12, 0),
('circolari', 13, 0),
('circolari', 14, 0),
('circolari', 15, 0),
('circolari', 16, 0),
('circolari', 17, 0),
('circolari', 18, 0),
('circolari', 19, 0),
('circolari', 20, 0),
('circolari', 21, 0),
('circolari', 22, 0),
('circolari', 23, 0),
('circolari', 24, 0),
('circolari', 25, 0),
('circolari', 26, 0),
('circolari', 27, 0),
('circolari', 28, 0),
('circolari', 29, 0),
('circolari', 30, 0),
('circolari', 31, 0),
('circolari', 32, 0),
('circolari', 33, 0),
('circolari', 34, 0),
('circolari', 35, 0),
('circolari', 36, 0),
('circolari', 37, 0),
('circolari', 38, 0),
('circolari', 39, 0),
('circolari', 40, 0),
('circolari', 41, 0),
('circolari', 42, 0),
('circolari', 43, 0),
('circolari', 44, 0),
('circolari', 45, 0),
('circolari', 46, 0),
('circolari', 47, 0),
('circolari', 48, 0),
('circolari', 49, 0),
('circolari', 50, 0),
('circolari', 51, 0),
('circolari', 52, 0),
('circolari', 53, 0),
('circolari', 54, 0),
('circolari', 55, 0),
('circolari', 56, 0),
('circolari', 57, 0),
('circolari', 58, 0),
('circolari', 59, 0),
('circolari', 60, 0),
('circolari', 61, 0),
('docenti', 91, 1),
('circolari', 63, 0),
('circolari', 64, 0),
('circolari', 65, 0),
('circolari', 66, 0),
('circolari', 67, 0),
('circolari', 68, 0),
('circolari', 69, 0),
('circolari', 70, 0),
('circolari', 71, 0),
('circolari', 72, 0),
('circolari', 73, 0),
('circolari', 74, 0),
('circolari', 75, 0),
('circolari', 76, 0),
('circolari', 77, 0),
('circolari', 78, 0),
('circolari', 79, 0),
('circolari', 80, 0),
('circolari', 81, 0),
('circolari', 82, 0),
('circolari', 83, 0),
('circolari', 84, 0),
('circolari', 85, 0),
('circolari', 86, 0),
('circolari', 87, 0),
('circolari', 88, 0),
('circolari', 89, 0),
('circolari', 90, 0),
('circolari', 91, 0),
('documentazione', 91, 0),
('prenotazioni', 91, 1),
('cistituto', 91, 0),
('consclasse', 91, 1),
('collegio', 91, 1),
('dipartimenti', 91, 1),
('questionari', 91, 0),
('docenti', 92, 1),
('circolari', 92, 0),
('documentazione', 92, 0),
('prenotazioni', 92, 1),
('cistituto', 92, 0),
('consclasse', 92, 1),
('collegio', 92, 1),
('dipartimenti', 92, 1),
('questionari', 92, 0),
('collegio', 1, 1),
('cistituto', 1, 1),
('progetti', 1, 1),
('docenti', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `lab_attrezzature`
--

CREATE TABLE IF NOT EXISTS `lab_attrezzature` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_dispositivo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `mac_address` varchar(18) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idlaboratorio` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_dispositivo` (`tipo_dispositivo`,`idlaboratorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `lab_attrezzature`
--

INSERT INTO `lab_attrezzature` (`id`, `tipo_dispositivo`, `descrizione`, `ip_address`, `mac_address`, `username`, `password`, `idlaboratorio`) VALUES
(2, 'pcXXXX', 'Intel core i5', '192.168.1.2', 'aa:45:34:55:ff:dd', 'prova', 'chiriaco', 1),
(3, 'Computer Server dddd', 'Server Windows 12', '192.168.1.254', '12:23:22:55:dd:44', 'admin', 'dante', 1),
(4, 'NAS', 'Unit&agrave; NAS per dati d''archivio', '', '', '', '', 2),
(5, 'Access Point', 'TP LINK', '192.168.4.5', '12:11:AA:BB:CC', 'admin', 'admin', 1),
(7, 'PC Desktop', 'Intel I7 - Nome computer PC1', '192.168.1.1', '11:34:FF:AB:CD:EF', 'admin', 'admin', 3),
(8, 'Notebook', 'acer inspire', 'dhcp', '33:44:BB:FF:AA:CC', 'admin', 'admin', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `lab_laboratori`
--

CREATE TABLE IF NOT EXISTS `lab_laboratori` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `responsabile` varchar(100) NOT NULL,
  `tecnico` varchar(200) NOT NULL,
  `numero_posti` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`),
  KEY `tecnico` (`tecnico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `lab_laboratori`
--

INSERT INTO `lab_laboratori` (`id`, `nome`, `responsabile`, `tecnico`, `numero_posti`) VALUES
(1, 'Multimediale', 'Chiriaco Francesco', 'Voria Giuseppe', 20),
(2, 'Linguistico', 'Arcuri Flaminia', 'Nella Del Giudice', 25),
(3, 'Fisica', 'Di Paola Matteo', 'Paletta Salvatore', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `sezioni_aut`
--

CREATE TABLE IF NOT EXISTS `sezioni_aut` (
  `idsezaut` varchar(15) NOT NULL,
  `descrizione` varchar(50) NOT NULL,
  PRIMARY KEY (`idsezaut`),
  KEY `descrizione` (`descrizione`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sezioni_aut`
--

INSERT INTO `sezioni_aut` (`idsezaut`, `descrizione`) VALUES
('admin', 'Amministratore sistema'),
('news', 'NEWS'),
('circolari', 'Circolari/Comunicati'),
('sicurezza', 'Sicurezza'),
('albopretorio', 'Albo Pretorio'),
('collegio', 'Collegio docenti'),
('cistituto', 'Consiglio Istituto'),
('progetti', 'Sezione progetti'),
('docenti', 'Docenti');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `cognome` varchar(30) NOT NULL DEFAULT '',
  `nome` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `cognome` (`cognome`,`nome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `cognome`, `nome`, `email`, `username`, `password`) VALUES
(1, 'Chiriaco', 'Francesco', 'info@francescochiriaco.it', 'fchiriaco', '*94BF68B8E3D0CABDE9C074FF312EE24230579C5A'),
(2, 'Labadessa', 'Domenico', 'mlab53@alice.it', 'dlabadessa', '*F302F1AABD9E2E452A45168C2EFAD6DC87E2E8DE'),
(3, 'Pipicelli', 'Rinaldo Emilio', '', 'rpipicelli', '*305264DE898DB922A313952138AAB04494B13D05'),
(4, 'MITTIGA', 'FRANCESCA', '', 'mittiga', '*9257DD7911D474C6D31D3663DF746B01A4A25825'),
(5, 'Lozza', 'ANNA', '', 'lozza', '*2370903DBEFAD3D503EF28BC52F0ED21D82A00A6'),
(6, 'BATTAGLIA', 'ROSA', '', 'battaglia', '*D9F93DA5B407ED478FC104EB55D2AF7BDCC1257C'),
(7, 'Cilione', 'FORTUNATA', '', 'cilione', '*0A766F5794927F09AE2FEBDAAEA6B55C8EF224CD'),
(8, 'Colella', 'GRAZIA', '', 'colella', '*B48839100D7FF9A86776AF048D25724E562A8388'),
(9, 'CORDI''', 'Rosetta', '', 'cordi', '*8AB7DB017C5DCDD1D9A818668C7BF4200EBFD28F'),
(10, 'Donato', 'ANTONIETTA', '', 'donato', '*4195034858643DF9CDE0138E34A891BA4F4A4694'),
(11, 'Ruffo', 'ROSA', '', 'ruffo', '*8CBDC2627F7486712A5C1D5819B7AC883AD36BB7'),
(12, 'Vitale', 'MATILDE', '', 'vitale', '*C4F44FEEA959842DDD6E0FB7366385C4C67465CB'),
(13, 'Torre', 'CARMELA', '', 'torre', '*78C8872C318DCF78A0C549C3D272A63EF00D80A2'),
(14, 'Sollazzo', 'FRANCESCA', '', 'sollazzo', '*114058CC499527E266730F9D9074B106C8026804'),
(15, 'Stilo', 'MARIA', '', 'stilo', '*A541F11208922084707202198B9414B8B0279367'),
(16, 'Marzano', 'MARIA TERESA', '', 'marzano', '*3AAB1EC5BF47E56795473814107E620EC6EEBB9A'),
(17, 'Mirarchi', 'ANTONIO', '', 'mirarchi', '*CB4A77382D691045ABB4B6E5F1F1CFAB9DB4C063'),
(18, 'Saporito', '{nom}', '', 'saporito', '*70F1640DA3E5C214C169DA3DACCF6E8805630164'),
(19, 'SICILIANO', 'MARIA SAVERIA', '', 'siciliano', '*6299C5F70AC5A0EDA7CCAC65369485DAC88F8CBC'),
(20, 'D''Agostino', '{nom}', '', 'dagostino', '*58FCDE0870E1BA8AF6F4FD3D3873B79221119EA6'),
(21, 'ZAPPIA', 'MARIA ROSARIA', '', 'MZAPPIA', '*587D4C5CA1F1E804490E21FA18167B59FB68FC36'),
(22, 'Zappia', 'Maria', '', 'zappia', '*855D2043393A418C613382D200510A9F311B35A4'),
(23, 'Novella', '{nom}', '', 'novella', '*A699F93B756673149C6CA0A8C5F1DF2109E30C93'),
(24, 'Spagnolo', '{nom}', '', 'spagnolo', '*770146F74D3AE35919513705164EF2DD10328037'),
(25, 'Verzino', '{nom}', '', 'verzino', '*925BCC15E06AEFFB4D68AD7EC5585408A988CC75'),
(26, 'Stillitano', '{nom}', '', 'stillitano', '*78C8872C318DCF78A0C549C3D272A63EF00D80A2'),
(27, 'Tizian', 'MARIA TERESA', '', 'tizian', '*DFFD2DE4985A48BA6F80F1C0D6702E869864EBBE'),
(28, 'Gliozzi', '{nom}', '', 'gliozzi', '*A40EF5B89FF7FE4100BDF0C4738FFC6FB8C57F33'),
(29, 'Scambia', '{nom}', '', 'scambia', '*83BASELECT * FROM `utenti` WHERE 1E8CF22A26B56BB591D545B1AB905C3FA9F43'),
(30, 'Foti', 'ANGELA', '', 'foti', '*893032EFE077C6024CA52D7992C6A52C3170726C'),
(31, 'Multari', '{nom}', '', 'multari', '*22C2013DACDFDD92879766902B3C24505A4A79CB'),
(32, 'Fumagalli', '{nom}', '', 'fumagalli', '*C97A253ED387B6B97A34A95B0885781EA5FCADD5'),
(33, 'Valenti', '{nom}', '', 'valenti', '*2E23713A5C342A25059052F06A1D5A7E74217EE8'),
(34, 'Filippone', '{nom}', '', 'filippone', '*BB46E43575248CBFE38AE4EF16DCC44CE985AB38'),
(35, 'Sabatino', '{nom}', '', 'sabatino', '*2E1A88CD8185130ABDD2AA7D9294FDA984B724A8'),
(36, 'Calveri', 'Rosa', '', 'calveri', '*A6F91411266D954BB8225DE9D8AD11C82CBCDEBD'),
(37, 'SPANO''', '{nom}', '', 'spano', '*D871A769F57C47DA7F7276D6DD78C7D8446F5F24'),
(38, 'MASTROIANNI', '{nom}', '', 'mastroianni', '*7E926DFEB2D5C6B7F483629368079D06F5C48CD2'),
(39, 'PIACENTINI', 'MARGHERITA', '', 'piacentini', '*190E87CF6136EEC6411E2130A657B69FA9129F1F'),
(40, 'DEL CORE', 'PAOLO', '', 'delcore', '*E8C994EF2256AAEDC5B3428A142D0BFBD7CC94E5'),
(41, 'TEDESCO', '{nom}', '', 'tedesco', '*2122B1313DB40983DFE44D35BEADEB5FB8EC6B9D'),
(42, 'Pecchia', '{nom}', '', 'pecchia', '*46F647E8A1C857B96BBBA62B376EBF3DA91B7D74'),
(43, 'MARINO', 'CATERINA', '', 'MARINO', '*38DB4983E7A1C7A1363776FE11247D09D0886B7D'),
(44, 'MIGLIORESI', 'FAUSTO', '', 'MIGLIORESI', '*4EC6F8400D4A132B73ECE335866BAE7FCAB9D064'),
(45, 'ZINGHINI''', 'CONCETTA', '', 'ZINGHINI', '*2760F33962C0FFCDF80F91BC15F205ABE201FECF'),
(46, 'ESABOTINI', 'CONSOLATA', '', 'ESABOTINI', '*B25DF824A133E74829FB6BB812F25C9D048A5030'),
(47, 'ORLANDO', 'GIANLUCA', '', 'ORLANDO', '*7D32377198BDEF3035B9E20D77A4FA422D8ACA8B'),
(48, 'DE LUCA', 'MARCELLO', '', 'DELUCA', '*B70EFE1B5C87C5FFFC8DA9812AFC6B11B92915C7'),
(49, 'Guida', 'Francesca', '', 'fguida', '*7B8E475935B93E8C817D813FFC53A6FA3347FC96'),
(50, 'Pagano', 'Giuseppina', '', 'gpagano', '*7D2E7CDC24DFECE048A9748CAB4E5886E3391429'),
(51, 'Musolino', 'Maria Grazia', '', 'mmusolino', '*D17D13EC99AACBCA5EC38ADBA28178B4AE780914'),
(52, 'Strati', 'Maria Immacolata', '', 'mstrati', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(53, 'Angelone', 'Fortunata', '', 'fangelone', '*7F011B9B3BCCC080C9BE3488B1B9F7023854F65B'),
(54, 'Gaglioti', 'Matilde', '', 'mgaglioti', '*B618C9993394C0CF799E62D8DA1D6D916512F399'),
(55, 'Caminiti', 'Carmela', '', 'ccaminiti', '*173389525DC749D2360DE451BDDF73C4B5A40193'),
(56, 'Stilo', 'Maria', '', 'mstilo', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(57, 'Ruffo', 'Mariamarcella', '', 'mruffo', '*0C3A8FE9E00B77651C087ED13F28CE5F4954192C'),
(58, 'Tallarida', 'Teresa', '', 'ttallarida', '*C84158176B85B29F0F07CF07E7B38A6BE63AB901'),
(59, 'Chiricosta', 'Anna', '', 'achiricosta', '*173389525DC749D2360DE451BDDF73C4B5A40193'),
(60, 'Gligora', 'Vittoria', '', 'vgligora', '*427BF0F5ED30525B5A8B8E2BA68F69EFB6BDCA1A'),
(61, 'Scuruchi', 'Bruno', '', 'bscuruchi', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(91, 'Dani', 'Elia', '', 'rapid', '*68519C0B07C648A92290E31D86F28B506A3558F2'),
(63, 'Primerano', '{nom}', '', 'lprimerano', '*0121B229DF026129E7F629C382E7C98557EBE42F'),
(64, 'Caminiti', 'Francesca', '', 'fcaminiti', '*173389525DC749D2360DE451BDDF73C4B5A40193'),
(65, 'Moscatello', 'Vincenza', '', 'vmoscatello', '*D17D13EC99AACBCA5EC38ADBA28178B4AE780914'),
(66, 'Sicari', 'Irene', '', 'isicari', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(67, 'MacrÃ¬', 'Vincenzina Rosaria', '', 'vmacri', '*D17D13EC99AACBCA5EC38ADBA28178B4AE780914'),
(68, 'Caracciolo', 'Domenica', '', 'dcaracciolo', '*173389525DC749D2360DE451BDDF73C4B5A40193'),
(69, 'Stelitano', 'Anna', '', 'astelitano', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(70, 'Blefari', 'Maria', '', 'mblefari', '*AA427001657068B49C0A4096E4A8B01C4F5EB514'),
(71, 'ScarfÃ²', 'Luciana', '', 'lscarfo', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(72, 'Federico', 'Maria', '', 'mfederico', '*62EB6A4B8D4E395794B4F87C7143F11BD41B4740'),
(73, 'Nirta', 'Caterina', '', 'cnirta', '*75CC56CFDD49B7FA1506C16F2D1F2B21FD5ACFDE'),
(74, 'Gelonesi', 'Maria', '', 'mgelonesi', '*B618C9993394C0CF799E62D8DA1D6D916512F399'),
(75, 'Palermo', 'Rosaria', '', 'rpalermo', '*7D2E7CDC24DFECE048A9748CAB4E5886E3391429'),
(76, 'Talladira', 'Maria Concetta', '', 'mtalladira', '*C84158176B85B29F0F07CF07E7B38A6BE63AB901'),
(77, 'Blefari', 'Giuseppina', '', 'gblefari', '*5C2D08C1D9DD5BD27BA585DB6165813632F6AEAC'),
(78, 'Pisciuneri', 'Concetta', '', 'cpisciuneri', '*7D2E7CDC24DFECE048A9748CAB4E5886E3391429'),
(79, 'Zito', 'Pasquale', '', 'pzito', '*21121EE70B8BE11E3BD038C918E4A4892F639CCA'),
(80, 'Clemente', 'Renato', '', 'rclemente', '*A0696BE2718632671DE15E9FD1C789D221384010'),
(81, 'Garreffa', 'Maria Antonia', '', 'mgarreffa', '*B618C9993394C0CF799E62D8DA1D6D916512F399'),
(82, 'Giampaolo', 'Maria', '', 'mgiampaolo', '*927E3B3750F0CF759EF0FB13371D46BE8D7EB745'),
(83, 'Muscari', 'Maria Teresa', '', 'mmuscari', '*D17D13EC99AACBCA5EC38ADBA28178B4AE780914'),
(84, 'Cicciarello', 'Antonella', '', 'acicciarello', '*D03D815928515EE96ED817189EC413938EDD281D'),
(85, 'FerrÃ²', 'Maria Francesca', '', 'mferro', '*62EB6A4B8D4E395794B4F87C7143F11BD41B4740'),
(86, 'Pipicella', 'Maria Cristina', '', 'mpipicella', '*F11307E52E93191E066315285FB25CDE45D5E1DD'),
(87, 'Romeo', 'Maria', '', 'mromeo', '*0C3A8FE9E00B77651C087ED13F28CE5F4954192C'),
(88, 'Strangio', 'Angela', '', 'angela.strangio', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(89, 'Stilo', 'Marianna', '', 'marianna.stilo', '*73D50FDE6FCF3B52F1561CB58F7AA45EF4D8FE0A'),
(90, 'Versace', 'Gloria', '', 'Versace', '*7C52D8E6E3FB369FE31C822B71FEFDACB1DE14EA'),
(92, 'Larino', 'Ettore', '', 'etlat', '*C382FB8EE24688080EBDB9110D9EF29273D8829C');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
