-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Jún 03. 12:27
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `todos`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `short` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `short`, `user_id`) VALUES
(4, 'test', 'test', '4'),
(5, 'Programozás', 'Prog', '4'),
(6, 'Digitális technika', 'Digit', '4'),
(7, 'Programozás', 'Prog', '6'),
(8, 'Matek', 'Mat', '4');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `deadline` datetime NOT NULL,
  `name` varchar(45) NOT NULL,
  `done` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `tasks`
--

INSERT INTO `tasks` (`id`, `priority`, `user_id`, `subject_id`, `type`, `deadline`, `name`, `done`) VALUES
(10, 1, 4, 4, 'Report', '2020-06-03 02:13:00', 'ZH', 0),
(11, 4, 4, 4, 'Exam', '2023-03-21 12:31:00', 'Vizsga', 0),
(12, 2, 4, 4, 'Assignment', '1232-01-23 13:12:00', 'Teszt', 1),
(13, 4, 4, 5, 'Assignment', '2019-12-23 14:33:00', 'Beadandó', 1),
(14, 5, 4, 5, 'Report', '2021-12-31 12:11:00', 'ZH', 0),
(15, 5, 4, 6, 'Exam', '2020-01-31 02:12:00', 'Teszt', 1),
(16, 4, 6, 7, 'Report', '2020-06-05 00:30:00', 'ZH', 0),
(17, 4, 4, 8, 'Test', '2021-12-31 03:02:00', 'Vizsga', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`) VALUES
(4, 'test', '47da14b4fc12391cfe205052807df17108284fb9', '-vu&PZwXa;iA,$Vws?07', 'test@test.com'),
(5, 'asd', '9e11247e559d1cb0b02a61854814bffbfa3508cb', 'w2cE^\"p|aj[P!USiYp..', 'asd@asd.com'),
(6, 'ert', '5a88a9db5fe681ca692606ac5df803e5f6cd2dfb', 'bYK\\ePNr]VgN}/_7JRO\"', 'ert@ert.com'),
(7, 'qwe', '220892c1d1483a85644da58182f37d4bd4f5413f', '&in8WKHkW[l}0$l~zjr!', 'qwe@qwe.com');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
