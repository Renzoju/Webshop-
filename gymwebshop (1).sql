-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 09:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymwebshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE `producten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `beschrijving` text NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `afbeelding` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`id`, `naam`, `beschrijving`, `prijs`, `afbeelding`) VALUES
(1, 'Proteïneshake', 'Word de GROOTSTE versie van jezelf – scoor je shake nu!', 19.95, 'blijfwakkershake.png'),
(2, '50KG dumbbells', 'Perfect voor gevorderde deelnemers.', 29.95, 'dumbell.jpg'),
(3, 'Pre workout shot ', 'De ideale boost om die platen door het dak heen te laten gaan  ', 30.00, 'preworkoutshot.png'),
(4, 'Matthijs straps', 'Krachtige lifting straps met “Matthijs” erop — voor ultieme grip tijdens elke workout.', 15.50, 'matthijsstraps.png'),
(5, 'eiwitreep (12 stuks)', 'Heerlijke eiwitreep boordevol proteïne – perfect als snack voor spierherstel en energie.', 25.75, 'proteinbar.png'),
(6, '200 mg TEST ', 'Die extra boost om op ronnie coleman te lijken (gaat niet gebeuren!)', 325.90, 'trenzo.png');

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE `winkelmand` (
  `id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_naam` varchar(255) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `hoeveelheid` int(11) NOT NULL DEFAULT 1,
  `afbeeldingen` varchar(255) DEFAULT NULL,
  `toegevoegd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winkelmand`
--
ALTER TABLE `winkelmand`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `winkelmand`
--
ALTER TABLE `winkelmand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
