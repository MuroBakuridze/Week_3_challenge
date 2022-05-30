-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 07:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star_wars`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters_data`
--

CREATE TABLE `characters_data` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `height` int(11) DEFAULT NULL,
  `birth_year` varchar(512) NOT NULL,
  `gender` varchar(512) NOT NULL,
  `homeworld` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `characters_data`
--

INSERT INTO `characters_data` (`id`, `name`, `height`, `birth_year`, `gender`, `homeworld`) VALUES
(13, 'R2-D2', 96, '33BBY', 'n/a', 'https://swapi.dev/api/planets/8/'),
(14, 'Obi-Wan Kenobi', 182, '57BBY', 'male', 'https://swapi.dev/api/planets/20/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters_data`
--
ALTER TABLE `characters_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters_data`
--
ALTER TABLE `characters_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
