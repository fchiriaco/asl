-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-9
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generato il: 16 Dic, 2008 at 10:16 AM
-- Versione MySQL: 5.0.32
-- Versione PHP: 5.2.0-8+etch13
-- 
-- Database: `piovene`
-- 

-- --------------------------------------------------------

-- 
-- Struttura della tabella `aree_aut`
-- 

CREATE TABLE `aree_aut` (
  `idarea` varchar(15) NOT NULL,
  `idutente` int(7) NOT NULL default '0',
  `amministratore` int(1) NOT NULL default '0',
  KEY `idutente` (`idutente`),
  KEY `idarea` (`idarea`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `sezioni_aut`
-- 

CREATE TABLE `sezioni_aut` (
  `idsezaut` varchar(15) NOT NULL,
  `descrizione` varchar(50) NOT NULL,
  PRIMARY KEY  (`idsezaut`),
  KEY `descrizione` (`descrizione`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `utenti`
-- 

CREATE TABLE `utenti` (
  `id` int(7) NOT NULL auto_increment,
  `cognome` varchar(30) NOT NULL default '',
  `nome` varchar(30) NOT NULL default '',
  `email` varchar(100) default NULL,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `cognome` (`cognome`,`nome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=275 ;
