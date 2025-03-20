-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 20. 13:01
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

--
-- A tábla adatainak kiíratása `foglalas`
--

INSERT INTO `foglalas` (`id`, `mettol`, `meddig`, `uzenet`, `verified`, `gyerekSzam`, `felnottSzam`, `idApartman`, `idFoglalo`) VALUES
(1, '2025-03-22', '2025-03-25', 'asdasd', 0, 0, 1, 1, 1),
(234234, '2025-03-10', '2025-03-15', 'asdasd', 0, 0, 1, 1, 1),
(345345, '2025-03-29', '2025-04-02', 'asdasd', 0, 0, 1, 1, 1);

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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `irsz`
--

CREATE TABLE `irsz` (
  `id` int(11) NOT NULL,
  `irsz` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `message` text COLLATE utf8_hungarian_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varos_irsz`
--

CREATE TABLE `varos_irsz` (
  `idIrsz` int(11) NOT NULL,
  `idVaros` int(11) NOT NULL
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
