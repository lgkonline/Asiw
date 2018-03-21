-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Mrz 2018 um 13:49
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `asiw`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `translation`
--

CREATE TABLE `translation` (
  `Id` int(11) NOT NULL,
  `Keyword` varchar(200) NOT NULL,
  `English` text NOT NULL,
  `German` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `translation`
--

INSERT INTO `translation` (`Id`, `Keyword`, `English`, `German`) VALUES
(1, 'GREETING', 'Welcome', 'Willkommen'),
(3, 'ACCOUNTS', 'Accounts', 'Konten'),
(4, 'TRANSLATIONS', 'Translations', 'Ãœbersetzungen'),
(5, 'BE_SORT_BY_KEYWORD', 'Sort by keyword', 'Nach SchlÃ¼sselwort sortieren'),
(6, 'BE_NEW_TRANSLATION', 'Add a new translation', 'Eine neue Ãœbersetzung hinzufÃ¼gen'),
(7, 'VARIABLES', 'Variables', 'Variablen'),
(8, 'BE_VARIABLES_INTRO', 'You can use this variables in translation contents.', 'Sie kÃ¶nnen diese Variablen in Ãœbersetzungs-Inhalten verwenden.'),
(9, 'DESCRIPTION', 'Description', 'Beschreibung'),
(10, 'VALUE', 'Value', 'Wert'),
(11, 'KEYWORD', 'Keyword', 'SchlÃ¼sselwort'),
(12, 'ENGLISH', 'English', 'Englisch'),
(13, 'GERMAN', 'German', 'Deutsch'),
(14, 'DELETE', 'Delete', 'LÃ¶schen'),
(15, 'BE_CHANGES_SUCCESSFUL', 'Changes were successful.', 'Ã„nderungen waren erfolgreich.'),
(16, 'YOU_ARENT_SIGNED_IN', 'You aren''t signed in', 'Sie sind nicht angemeldet'),
(17, 'YOU_ARE_SIGNED_IN_AS', 'You are signed in as', 'Sie sind angemeldet als'),
(18, 'SIGN_OUT', 'Sign out', 'Abmelden');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` text NOT NULL,
  `Role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`Id`, `Email`, `Password`, `Role`) VALUES
(1, 'admin@localhost', '$2y$10$fQHd9P1DgB4S8JoxDJh6ruw26PGC9KnuR/APRzzqExM8ZKAis9f3u', 'Admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `translation`
--
ALTER TABLE `translation`
  ADD PRIMARY KEY (`Id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `translation`
--
ALTER TABLE `translation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
