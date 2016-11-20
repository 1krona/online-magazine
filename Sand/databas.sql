-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 01 februari 2009 kl 01:22
-- Serverversion: 5.1.30
-- PHP-version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `news`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `bans`
--

CREATE TABLE IF NOT EXISTS `bans` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Data i tabell `bans`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `kom`
--

CREATE TABLE IF NOT EXISTS `kom` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ny_id` tinyint(4) NOT NULL,
  `text` text NOT NULL,
  `namn` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  `ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data i tabell `kom`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `namn` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Data i tabell `members`
--

INSERT INTO `members` (`id`, `user`, `namn`, `pass`) VALUES
(1, 'admin', 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur för tabell `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `forfattare` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Data i tabell `news`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `antal_ny` tinyint(2) NOT NULL,
  `antal_kom` tinyint(2) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data i tabell `settings`
--

INSERT INTO `settings` (`antal_ny`, `antal_kom`, `title`) VALUES
(5, 5, 'Exnews 1.1');
