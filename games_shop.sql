-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 05:12 AM
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
-- Database: `games_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `GameID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  `Platform` varchar(100) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StockQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`GameID`, `Title`, `Genre`, `Platform`, `Price`, `StockQuantity`) VALUES
(1, 'Elden Ring', 'Action RPG', 'PC', 59.99, 15),
(2, 'The Legend of Zelda: TOTK', 'Adventure', 'Nintendo Switch', 69.99, 12),
(3, 'God of War Ragnarök', 'Action', 'PlayStation 5', 69.99, 10),
(4, 'Minecraft', 'Sandbox', 'Multi-platform', 29.99, 30),
(5, 'Grand Theft Auto V', 'Action', 'PC', 29.99, 20),
(6, 'FIFA 24', 'Sports', 'PlayStation 5', 69.99, 18),
(7, 'Cyberpunk 2077: Phantom Liberty', 'RPG', 'PC', 34.99, 14),
(8, 'Mario Kart 8 Deluxe', 'Racing', 'Nintendo Switch', 59.99, 25),
(9, 'Baldur’s Gate 3', 'RPG', 'PC', 59.99, 9),
(10, 'Call of Duty: Modern Warfare II', 'FPS', 'PC', 69.99, 16),
(11, 'Dragon Quest XI S', 'RPG', 'Nintendo Switch', 49.99, 14),
(12, 'Monster Hunter: World', 'Action RPG', 'PC', 39.99, 19),
(13, 'Splatoon 3', 'Shooter', 'Nintendo Switch', 59.99, 21),
(14, 'Bloodborne', 'Action RPG', 'PlayStation 4', 19.99, 16),
(15, 'Sekiro: Shadows Die Twice', 'Action', 'PC', 39.99, 12),
(16, 'Persona 5 Royal', 'JRPG', 'PlayStation 5', 59.99, 11),
(17, 'Diablo IV', 'RPG', 'PC', 69.99, 18),
(18, 'Metroid Dread', 'Adventure', 'Nintendo Switch', 59.99, 13),
(19, 'Halo Infinite', 'FPS', 'Xbox Series X', 59.99, 20),
(20, 'Forza Horizon 5', 'Racing', 'Xbox Series X', 59.99, 17),
(21, 'Cuphead', 'Platformer', 'Multi-platform', 19.99, 25),
(22, 'Hollow Knight', 'Metroidvania', 'PC', 14.99, 30),
(23, 'Hades', 'Roguelike', 'Multi-platform', 24.99, 22),
(24, 'Ghost of Tsushima', 'Action', 'PlayStation 5', 49.99, 15),
(25, 'Death Stranding', 'Action', 'PC', 39.99, 10),
(26, 'Nioh 2', 'Action RPG', 'PlayStation 4', 29.99, 14),
(27, 'Dark Souls III', 'Action RPG', 'PC', 29.99, 12),
(28, 'Fire Emblem: Three Houses', 'Strategy RPG', 'Nintendo Switch', 59.99, 9),
(29, 'Octopath Traveler II', 'JRPG', 'Nintendo Switch', 59.99, 13),
(30, 'The Witcher 3: Wild Hunt', 'RPG', 'PC', 39.99, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`GameID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `GameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
