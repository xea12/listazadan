-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 14 Paź 2022, 15:09
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `taskList`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `ID` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved` datetime DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`ID`, `code`, `created`, `resolved`, `title`, `content`, `priority`) VALUES
(1, 'DYH-OOA-NMN', '2022-02-20 10:05:00', '2022-02-20 00:00:00', 'zadanie testowe1', 'Treść zadania testowego1', 2),
(2, 'HVE-NOS-MNZ', '2022-02-20 10:05:00', '2022-02-20 00:00:00', 'zadanie testowe2', 'Treść zadania testowego2', 2),
(3, 'GRP-NCO-CDZ', '2022-02-20 10:05:00', '2022-02-20 00:00:00', 'zadanie testowe3', 'Treść zadania testowego3', 2),
(4, 'XWL-FVH-VNC', '2022-02-20 10:33:35', '2022-02-20 00:00:00', 'zgłoszenie 4', 'treść zgłoszenia 4', 2),
(5, 'NIG-OCP-DYM', '2022-02-20 10:34:29', '2022-10-14 00:00:00', 'zgłoszenie 5', 'treść zgłoszenia 5', 2),
(6, 'JKX-HDO-JBF', '2022-02-20 10:34:47', '1970-01-01 01:00:00', 'zgłoszenie 6', 'treść zgłoszenia 6', 2),
(7, 'ZNO-OQM-QQR', '2022-02-20 11:42:05', '1970-01-01 01:00:00', 'dfssdf', 'fsdfsdf', 2),
(8, 'KSG-QJR-ILQ', '2022-10-14 08:16:03', '1970-01-01 01:00:00', 'nowe zadanie ', 'jak sie masz', 2),
(9, 'PHK-CHY-HNV', '2022-10-14 08:16:58', '1970-01-01 01:00:00', 'dsadas', 'sadasd', 2),
(10, 'EUS-OWX-JUE', '2022-10-14 08:17:20', '2022-10-14 00:00:00', 'nowe zadanie 12', 'nowe zadanie tresc', 2),
(11, 'ORX-KSL-FYZ', '2022-10-14 08:33:41', '1970-01-01 01:00:00', 'nowe zadanie 15', 'tresc nowegho zadania 15', 2),
(12, 'RVH-EFX-NTG', '2022-10-14 09:48:04', '1970-01-01 01:00:00', 'nowe zgłoszenie Łukasz', 'Łukasz czego szukasz', 3),
(13, 'NGA-GMF-RUS', '2022-10-14 10:02:19', '2022-10-14 14:14:44', 'marlena', 'tres nowaq ja', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
