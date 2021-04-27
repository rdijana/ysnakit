-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 10:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `babic`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `idAutor` int(10) NOT NULL,
  `ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `brIndeksa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`idAutor`, `ime`, `prezime`, `brIndeksa`, `tekst`) VALUES
(1, 'Dijana ', 'Radovanović', '10/18', 'Zdravo,zovem se Dijana Radovanović\r\n                              imam 21 godinu i živim u Beogradu.Trenutno pohađam Visoku ICT školu, smer Internet tehnologije.');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `idEmail` int(80) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `poruka` text COLLATE utf8_unicode_ci NOT NULL,
  `svrha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL,
  `procitan` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`idEmail`, `email`, `poruka`, `svrha`, `datum`, `procitan`) VALUES
(1, 'dijana@gmail.com', 'Poruka od Dijane', 'Poruka', '2020-06-08 23:05:46', 1),
(3, 'dijana@gmail.com', 'Poruka od Dijane', 'Poruka', '2020-06-08 23:10:20', 1),
(5, 'dijana@gmail.com', 'Poruka od', 'Poruka', '2020-06-08 23:11:16', 0),
(6, 'laralazic@gmail.com', 'Ponuda vasa', 'Poruka', '2020-06-10 12:25:31', 0),
(7, 'daki@gmail.com', 'Blalala', 'Dakii', '2020-06-10 14:18:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `futer`
--

CREATE TABLE `futer` (
  `idFuter` int(15) NOT NULL,
  `putanja` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `futer`
--

INSERT INTO `futer` (`idFuter`, `putanja`, `tekst`) VALUES
(1, 'instagram.com', '<i class=\"fab fa-instagram\"></i>'),
(2, 'facebook.com', '<i class=\"fab fa-facebook-square\"></i>'),
(3, 'gmail.com', '<i class=\"fas fa-envelope-open-text\"></i>'),
(4, 'dokumentacija.pdf', '<i class=\"fas fa-book\"></i>'),
(6, 'sitemap.xml', '<i class=\"fa fa-sitemap\" aria-hidden=\"true\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `idKategorija` int(25) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`idKategorija`, `naziv`) VALUES
(1, 'Ogrlica'),
(2, 'Prsten'),
(3, 'Minđuše');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(70) NOT NULL,
  `ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `korisnicko_ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `datum_registracije` datetime NOT NULL,
  `aktivan` int(15) DEFAULT NULL,
  `idUloga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime`, `prezime`, `email`, `korisnicko_ime`, `lozinka`, `pol`, `datum_registracije`, `aktivan`, `idUloga`) VALUES
(3, 'Pera', 'Peric', 'pera@gmail.com', 'peraaa', 'fcea920f7412b5da7be0cf42b8c93759', 'M', '0000-00-00 00:00:00', 1, 1),
(6, 'Dijana', 'Radovanovic', 'dijana@gmail.com', 'dijanaaa', 'fcea920f7412b5da7be0cf42b8c93759', 'Z', '2020-06-09 00:00:00', 1, 1),
(7, 'Danijela', 'Radovanovic', 'danijela@gmail.com', 'dakii', 'fcea920f7412b5da7be0cf42b8c93759', 'Z', '0000-00-00 00:00:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(20) NOT NULL,
  `putanja` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `raspored` int(20) DEFAULT NULL,
  `idRoditelja` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `putanja`, `naziv`, `raspored`, `idRoditelja`) VALUES
(1, 'index.php?page=pocetna', 'Početna', 1, NULL),
(2, 'index.php?page=proizvodi', 'Proizvodi', 2, NULL),
(3, 'index.php?page=kontakt', 'Kontakt', 3, NULL),
(4, 'index.php?page=registracija', 'Registracija', 4, NULL),
(5, 'index.php?page=login', 'Login', 5, NULL),
(9, '#', 'Admin', 7, NULL),
(11, 'index.php?page=admin-proizvodi', 'Proizvodi', 3, 9),
(12, 'index.php?page=unos-proizvoda', 'Unos proizvoda', 4, 9),
(13, 'index.php?page=korisnici', 'Korisnici', 5, 9),
(14, 'index.php?page=unos-korisnika', 'Unos korisnika', 6, 9),
(16, 'index.php?page=email', 'Email', 8, 9),
(17, 'index.php?page=pristup-stranicama', 'Pristup stranicama', 9, 9),
(20, 'index.php?page=autor', 'Autor', NULL, NULL),
(21, 'modules/logout.php', 'Logout', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `idProizvod` int(60) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sastav` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(20,0) NOT NULL,
  `slikaOrg` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `slikaNap` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `idKategorija` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`idProizvod`, `naziv`, `sastav`, `cena`, `slikaOrg`, `slikaNap`, `datum`, `idKategorija`) VALUES
(55, 'MINĐUŠE SA DRAGIM KAMENJEM - MK3', 'Dijamanti 2x0.02ct', '15700', 'assets/images/1591863763-slika5.jpg', 'assets/images/1591863763-slika5.jpg-nova', '2020-06-11 10:22:43', 3),
(56, 'MINĐUŠE SA DRAGIM KAMENJEM - MK13', 'Plavi topaz 0.60ct', '19800', 'assets/images/1591863812-slika6.jpg', 'assets/images/1591863812-slika6.jpg-nova', '2020-06-11 10:23:32', 3),
(57, 'MINĐUŠE SA DRAGIM KAMENJEM - MK1', 'Brilijant 0.06ct si/g-h', '23700', 'assets/images/1591863850-slika7.jpg', 'assets/images/1591863850-slika7.jpg-nova', '2020-06-11 10:24:10', 3),
(58, 'MINĐUŠE SA DRAGIM KAMENJEM - DM2', 'Brilijant 0.10ct VS/H', '59000', 'assets/images/1591863905-slika8.jpg', 'assets/images/1591863905-slika8.jpg-nova', '2020-06-11 10:25:05', 3),
(59, 'PRSTEN SA DIJAMANTOM  - VPK6', 'Dijamant 0.30ct VS2/H - GIA', '103000', 'assets/images/1591863960-slika9.jpg', 'assets/images/1591863960-slika9.jpg-nova', '2020-06-11 10:26:00', 2),
(60, 'PRSTEN SA DRAGIM KAMENJEM - PK8', 'Brilijanti 0,007ct vs/g', '139000', 'assets/images/1591864009-slika10.jpg', 'assets/images/1591864009-slika10.jpg-nova', '2020-06-11 10:26:49', 2),
(61, 'PRSTEN SA DRAGIM KAMENJEM - HJG9', 'Brilijanti 0,067ct vs/g', '50000', 'assets/images/1591864056-slika11.jpg', 'assets/images/1591864056-slika11.jpg-nova', '2020-06-11 10:27:36', 2),
(62, 'PRSTEN SA DRAGIM KAMENJEM - HJH', 'Smaragd 0.19ict', '10000', 'assets/images/1591864099-slika12.jpg', 'assets/images/1591864099-slika12.jpg-nova', '2020-06-11 10:28:20', 2),
(63, 'OGRLICA SA DRAGIM KAMENJEM - OGK1', 'Brilijant 0.04ct vs/g', '21900', 'assets/images/1591864160-slika1.jpg', 'assets/images/1591864160-slika1.jpg-nova', '2020-06-11 10:29:20', 1),
(64, 'OGRLICA SA DRAGIM KAMENJEM - OGK4', 'Smaragd 0.18ct', '17800', 'assets/images/1591864205-slika2.jpg', 'assets/images/1591864205-slika2.jpg-nova', '2020-06-11 10:30:05', 1),
(65, 'OGRLICA SA DRAGIM KAMENJEM - OGK7', 'Turmalin 0.45ct', '30200', 'assets/images/1591864259-slika3.jpg', 'assets/images/1591864259-slika3.jpg-nova', '2020-06-11 10:30:59', 1),
(66, 'OGRLICA SA DRAGIM KAMENJEM - OGP3', 'Smaragd 0.18ct', '79000', 'assets/images/1591864296-slika4.jpg', 'assets/images/1591864296-slika4.jpg-nova', '2020-06-11 10:31:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(10) NOT NULL,
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`idEmail`);

--
-- Indexes for table `futer`
--
ALTER TABLE `futer`
  ADD PRIMARY KEY (`idFuter`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`idKategorija`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD KEY `idUloga` (`idUloga`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`),
  ADD KEY `idRoditelja` (`idRoditelja`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idKategorija` (`idKategorija`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `idEmail` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `futer`
--
ALTER TABLE `futer`
  MODIFY `idFuter` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `idKategorija` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(70) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `idProizvod` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`idUloga`) REFERENCES `uloga` (`idUloga`);

--
-- Constraints for table `meni`
--
ALTER TABLE `meni`
  ADD CONSTRAINT `meni_ibfk_1` FOREIGN KEY (`idRoditelja`) REFERENCES `meni` (`idMeni`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_ibfk_1` FOREIGN KEY (`idKategorija`) REFERENCES `kategorija` (`idKategorija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
