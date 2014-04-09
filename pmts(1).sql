-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 31. Mrz 2014 um 19:35
-- Server Version: 5.5.35
-- PHP-Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `pmts`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_comments`
--

DROP TABLE IF EXISTS `tks_comments`;
CREATE TABLE IF NOT EXISTS `tks_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_bin NOT NULL,
  `creator_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `tks_comments`
--

INSERT INTO `tks_comments` (`id`, `comment`, `creator_id`, `ticket_id`, `date`) VALUES
(13, 'aaaaadasddasdasdafgdfgdfgdf', 6, 6, '2014-03-09 20:44:18'),
(15, 'sdfsdfsdf', 6, 4, '2014-03-09 19:26:42'),
(16, 'dfsdfsdf', 6, 8, '2014-03-09 20:26:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_departments`
--

DROP TABLE IF EXISTS `tks_departments`;
CREATE TABLE IF NOT EXISTS `tks_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `tks_departments`
--

INSERT INTO `tks_departments` (`id`, `department`) VALUES
(1, 'Geschäftsführung'),
(2, 'Büro'),
(3, 'Entwicklung / IT'),
(4, 'Buchhaltung'),
(5, 'Pearl Media');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_files`
--

DROP TABLE IF EXISTS `tks_files`;
CREATE TABLE IF NOT EXISTS `tks_files` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `file` varchar(256) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_prio`
--

DROP TABLE IF EXISTS `tks_prio`;
CREATE TABLE IF NOT EXISTS `tks_prio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prio` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tks_prio`
--

INSERT INTO `tks_prio` (`id`, `prio`, `color`) VALUES
(1, 'umgehend', '#FF0000'),
(2, 'schnellstens', '#FFC125'),
(3, 'wenn zeit', '#00CD00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_projects`
--

DROP TABLE IF EXISTS `tks_projects`;
CREATE TABLE IF NOT EXISTS `tks_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(45) COLLATE utf8_bin NOT NULL,
  `online` smallint(6) NOT NULL,
  `color` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tks_projects`
--

INSERT INTO `tks_projects` (`id`, `project`, `online`, `color`) VALUES
(1, 'JK-Büro', 1, '#8B5A2B'),
(2, 'Blueline', 1, '#0000CD'),
(3, 'Proactive', 1, '#FFA500'),
(4, 'Topjob', 1, '#528B8B');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_status`
--

DROP TABLE IF EXISTS `tks_status`;
CREATE TABLE IF NOT EXISTS `tks_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tks_status`
--

INSERT INTO `tks_status` (`id`, `status`, `color`) VALUES
(1, 'offen', '#FF0000'),
(2, 'in arbeit', '#FFC125'),
(3, 'erledigt', '#00CD00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tks_tickets`
--

DROP TABLE IF EXISTS `tks_tickets`;
CREATE TABLE IF NOT EXISTS `tks_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` tinyint(4) NOT NULL,
  `creator_id` tinyint(4) NOT NULL,
  `department_id` tinyint(4) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `ticket` text COLLATE utf8_bin NOT NULL,
  `assign_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'wenn 0 ticket noch offen und nicht zugewiesen',
  `assumed` int(11) NOT NULL DEFAULT '0' COMMENT '0=nicht angenommen, 1=angenommen, 2=abgelehnt',
  `deny_reason` text COLLATE utf8_bin,
  `status_id` tinyint(4) NOT NULL,
  `prio_id` tinyint(4) NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deadline` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `tks_tickets`
--

INSERT INTO `tks_tickets` (`id`, `project_id`, `creator_id`, `department_id`, `title`, `ticket`, `assign_id`, `assumed`, `deny_reason`, `status_id`, `prio_id`, `create`, `deadline`) VALUES
(4, 2, 6, 3, 'test4', 'sfdfsdfsdf\r\nsdfsdfs\r\ndfsdfsdf\r\nsdfsdfsdfsdfsdf', 6, 2, NULL, 1, 1, '2014-03-31 17:08:55', '0000-00-00'),
(6, 2, 6, 3, 'test', 'sdfsdfs\r\nfsdfsdfsdfsdfs', 0, 0, NULL, 2, 2, '2014-03-31 14:30:01', '0000-00-00'),
(8, 3, 6, 3, 'fdfgdfgd', 'dfgdfgdgfdg', 6, 1, NULL, 2, 1, '2014-03-31 16:54:56', '2014-03-16'),
(9, 2, 6, 2, 'sdfsdf', 'sdfsdfs\r\ndfsdfs\r\ndfsdfsdfsdfsdsfd', 6, 1, NULL, 2, 3, '2014-03-31 16:54:54', '0000-00-00'),
(11, 2, 6, 4, 'vccvcvcv', 'cvccvcvcvcvc', 6, 2, NULL, 1, 2, '2014-03-31 13:36:47', '0000-00-00'),
(12, 2, 6, 2, '  xfdcvcv', 'cvvcvcvcvccvc', 6, 1, NULL, 1, 2, '2014-03-31 16:43:32', '0000-00-00'),
(13, 1, 6, 3, 'dfsdfsd', 'fffffsdfdsfsdf', 6, 2, NULL, 2, 1, '2014-03-31 13:36:47', '0000-00-00'),
(14, 1, 6, 1, 'cvbcvb', 'cvbcvbcvb', 6, 1, NULL, 1, 2, '2014-03-30 21:42:56', '2014-04-17'),
(15, 1, 6, 1, 'test ticket', 'sdsdfsdfsdfsdfsdfs', 0, 0, NULL, 1, 2, '2014-03-31 17:07:01', '2014-04-23');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `role` varchar(8) COLLATE utf8_bin NOT NULL,
  `department_id` tinyint(4) NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(32) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(32) COLLATE utf8_bin NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `role`, `department_id`, `email`, `password`, `firstname`, `lastname`, `create`) VALUES
(6, 'admin', 3, 'a@a.de', '$2y$14$o7iWgNYTKLB3xLcSQogWd.hQsWCEuSXJ5fcvrsmsLmyF87Z6i4BbC', 'admin', 'admin', '2014-03-27 09:47:49'),
(7, 'office', 2, 'b@b.de', '$2y$14$CEgEVxoiLgKLHoH/SUFm2.4xAqab5dlTynb.9W6hs8NEHmdPe5hNW', 'office', 'office', '2014-03-27 09:47:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
