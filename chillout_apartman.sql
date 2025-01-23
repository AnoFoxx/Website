-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Jan 23. 12:23
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.3.31

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
  `id` int(11) NOT NULL,
  `tartalom` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `idApartman` int(11) NOT NULL,
  `idFoglalo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas`
--

CREATE TABLE `foglalas` (
  `id` int(11) NOT NULL,
  `mettol` date NOT NULL,
  `meddig` date NOT NULL,
  `uzenet` text COLLATE utf8_hungarian_ci NOT NULL,
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
  `szulIdo` date NOT NULL,
  `nemzetiseg` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `utca_hazSzam` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `irsz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varos`
--

CREATE TABLE `varos` (
  `irsz` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idApartman` (`idApartman`),
  ADD KEY `idFoglalo` (`idFoglalo`);

--
-- A tábla indexei `foglalas`
--
ALTER TABLE `foglalas`
  ADD KEY `idApartman` (`idApartman`),
  ADD KEY `idFoglalo` (`idFoglalo`);

--
-- A tábla indexei `foglalo`
--
ALTER TABLE `foglalo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `irsz` (`irsz`);

--
-- A tábla indexei `varos`
--
ALTER TABLE `varos`
  ADD PRIMARY KEY (`irsz`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `apartman`
--
ALTER TABLE `apartman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `ertekeles`
--
ALTER TABLE `ertekeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD CONSTRAINT `ertekeles_ibfk_1` FOREIGN KEY (`idApartman`) REFERENCES `apartman` (`id`),
  ADD CONSTRAINT `ertekeles_ibfk_2` FOREIGN KEY (`idFoglalo`) REFERENCES `foglalo` (`id`);

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
  ADD CONSTRAINT `foglalo_ibfk_1` FOREIGN KEY (`irsz`) REFERENCES `varos` (`irsz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
