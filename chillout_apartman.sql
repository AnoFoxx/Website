-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 22. 17:30
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `chillout_apartman`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `apartman`
--

CREATE TABLE `apartman` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `kapacitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `apartman`
--

INSERT INTO `apartman` (`id`, `nev`, `cim`, `kapacitas`) VALUES
(1, 'apartman1', 'Bartók Béla utca 14.', 6),
(2, 'apartman2', 'Bartók Béla utca 14.', 8),
(3, 'apartman3', 'Tinódi utca 9.', 6);

--
-- Eseményindítók `apartman`
--
DELIMITER $$
CREATE TRIGGER `log_apartman_delete` AFTER DELETE ON `apartman` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "apartman", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_apartman_insert` AFTER INSERT ON `apartman` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "apartman", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_apartman_update` AFTER UPDATE ON `apartman` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "apartman", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekeles`
--

CREATE TABLE `ertekeles` (
  `idFoglalas` int(11) NOT NULL,
  `tartalom` text COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ertekeles` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Eseményindítók `ertekeles`
--
DELIMITER $$
CREATE TRIGGER `log_ertekeles_delete` AFTER DELETE ON `ertekeles` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "ertekeles", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_ertekeles_insert` AFTER INSERT ON `ertekeles` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "ertekeles", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_ertekeles_update` AFTER UPDATE ON `ertekeles` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "ertekeles", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas`
--

CREATE TABLE `foglalas` (
  `id` int(11) NOT NULL,
  `mettol` date NOT NULL,
  `meddig` date NOT NULL,
  `uzenet` text COLLATE utf8_hungarian_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL,
  `gyerekSzam` int(11) NOT NULL,
  `felnottSzam` int(11) NOT NULL,
  `idApartman` int(11) NOT NULL,
  `idFoglalo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `foglalas`
--

INSERT INTO `foglalas` (`id`, `mettol`, `meddig`, `uzenet`, `verified`, `gyerekSzam`, `felnottSzam`, `idApartman`, `idFoglalo`) VALUES
(1, '2025-03-22', '2025-03-25', 'asdasd', 0, 0, 1, 1, 1),
(234234, '2025-03-10', '2025-03-15', 'asdasd', 0, 0, 1, 1, 1),
(345345, '2025-03-29', '2025-04-02', 'asdasd', 0, 0, 1, 1, 1);

--
-- Eseményindítók `foglalas`
--
DELIMITER $$
CREATE TRIGGER `log_foglalas_delete` AFTER DELETE ON `foglalas` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "foglalas", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_foglalas_insert` AFTER INSERT ON `foglalas` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "foglalas", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_foglalas_update` AFTER UPDATE ON `foglalas` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "foglalas", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalo`
--

CREATE TABLE `foglalo` (
  `id` int(11) NOT NULL,
  `vezetekNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `utoNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `telefonSzam` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `szuletesIdo` date NOT NULL,
  `utca_hazSzam` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `idOrszag` int(11) NOT NULL,
  `idVaros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `foglalo`
--

INSERT INTO `foglalo` (`id`, `vezetekNev`, `utoNev`, `email`, `telefonSzam`, `szuletesIdo`, `utca_hazSzam`, `idOrszag`, `idVaros`) VALUES
(1, 'asd', 'asd', 'asd', 'asd', '0000-00-00', 'asd', 1, 1);

--
-- Eseményindítók `foglalo`
--
DELIMITER $$
CREATE TRIGGER `log_foglalo_delete` AFTER DELETE ON `foglalo` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "foglalo", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_foglalo_insert` AFTER INSERT ON `foglalo` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "foglalo", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_foglalo_update` AFTER UPDATE ON `foglalo` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "foglalo", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `irsz`
--

CREATE TABLE `irsz` (
  `id` int(11) NOT NULL,
  `irsz` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `irsz`
--

INSERT INTO `irsz` (`id`, `irsz`) VALUES
(1, '4150');

--
-- Eseményindítók `irsz`
--
DELIMITER $$
CREATE TRIGGER `log_irsz_delete` AFTER DELETE ON `irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "irsz", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_irsz_insert` AFTER INSERT ON `irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "irsz", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_irsz_update` AFTER UPDATE ON `irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "irsz", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `action` text COLLATE utf8_hungarian_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `log`
--

INSERT INTO `log` (`id`, `action`, `timestamp`, `user`, `table_name`) VALUES
(1, 'INSERT', '2025-03-22 16:24:55', 'root@localhost', 'irsz');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orszag`
--

CREATE TABLE `orszag` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `orszag`
--

INSERT INTO `orszag` (`id`, `nev`) VALUES
(1, 'asd');

--
-- Eseményindítók `orszag`
--
DELIMITER $$
CREATE TRIGGER `log_orszag_delete` AFTER DELETE ON `orszag` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "orszag", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_orszag_insert` AFTER INSERT ON `orszag` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "orszag", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_orszag_update` AFTER UPDATE ON `orszag` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "orszag", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varos`
--

CREATE TABLE `varos` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `varos`
--

INSERT INTO `varos` (`id`, `nev`) VALUES
(1, 'asd');

--
-- Eseményindítók `varos`
--
DELIMITER $$
CREATE TRIGGER `log_varos_delete` AFTER DELETE ON `varos` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "varos", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_varos_insert` AFTER INSERT ON `varos` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "varos", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_varos_update` AFTER UPDATE ON `varos` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "varos", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varos_irsz`
--

CREATE TABLE `varos_irsz` (
  `idIrsz` int(11) NOT NULL,
  `idVaros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Eseményindítók `varos_irsz`
--
DELIMITER $$
CREATE TRIGGER `log_varos_irsz_delete` AFTER DELETE ON `varos_irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "DELETE", "varos_irsz", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_varos_irsz_insert` AFTER INSERT ON `varos_irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "INSERT", "varos_irsz", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_varos_irsz_update` AFTER UPDATE ON `varos_irsz` FOR EACH ROW INSERT INTO log (user, action, table_name, timestamp)
VALUES (USER(), "UPDATE", "varos_irsz", NOW())
$$
DELIMITER ;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `apartman`
--
ALTER TABLE `apartman`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD PRIMARY KEY (`idFoglalas`);

--
-- A tábla indexei `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idApartman` (`idApartman`),
  ADD KEY `idFoglalo` (`idFoglalo`);

--
-- A tábla indexei `foglalo`
--
ALTER TABLE `foglalo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrszag` (`idOrszag`),
  ADD KEY `idVaros` (`idVaros`);

--
-- A tábla indexei `irsz`
--
ALTER TABLE `irsz`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orszag`
--
ALTER TABLE `orszag`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `varos`
--
ALTER TABLE `varos`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `varos_irsz`
--
ALTER TABLE `varos_irsz`
  ADD KEY `idIrsz` (`idIrsz`),
  ADD KEY `idVaros` (`idVaros`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345346;

--
-- AUTO_INCREMENT a táblához `foglalo`
--
ALTER TABLE `foglalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `irsz`
--
ALTER TABLE `irsz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `orszag`
--
ALTER TABLE `orszag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `varos`
--
ALTER TABLE `varos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD CONSTRAINT `ertekeles_ibfk_1` FOREIGN KEY (`idFoglalas`) REFERENCES `foglalas` (`id`);

--
-- Megkötések a táblához `foglalas`
--
ALTER TABLE `foglalas`
  ADD CONSTRAINT `foglalas_ibfk_1` FOREIGN KEY (`idApartman`) REFERENCES `apartman` (`id`),
  ADD CONSTRAINT `foglalas_ibfk_2` FOREIGN KEY (`idFoglalo`) REFERENCES `foglalo` (`id`);

--
-- Megkötések a táblához `foglalo`
--
ALTER TABLE `foglalo`
  ADD CONSTRAINT `foglalo_ibfk_1` FOREIGN KEY (`idOrszag`) REFERENCES `orszag` (`id`),
  ADD CONSTRAINT `foglalo_ibfk_2` FOREIGN KEY (`idVaros`) REFERENCES `varos` (`id`);

--
-- Megkötések a táblához `varos_irsz`
--
ALTER TABLE `varos_irsz`
  ADD CONSTRAINT `varos_irsz_ibfk_1` FOREIGN KEY (`idIrsz`) REFERENCES `irsz` (`id`),
  ADD CONSTRAINT `varos_irsz_ibfk_2` FOREIGN KEY (`idVaros`) REFERENCES `varos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
