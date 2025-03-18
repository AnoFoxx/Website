-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 18. 17:47
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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orszag`
--

CREATE TABLE `orszag` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varos`
--

CREATE TABLE `varos` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `foglalo`
--
ALTER TABLE `foglalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `orszag`
--
ALTER TABLE `orszag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `varos`
--
ALTER TABLE `varos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
