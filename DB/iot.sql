-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2018 at 12:15 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrzareii_iot`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `systems_id` int(11) NOT NULL,
  `type` enum('temp','humidity','','') NOT NULL,
  `data` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `systems_id`, `type`, `data`, `date`) VALUES
(1, 4, 'temp', '23', '2018-02-16 17:46:16'),
(3, 4, 'humidity', '45', '2018-02-16 17:46:16'),
(4, 4, 'humidity', '23', '2018-02-16 17:46:16'),
(60, 4, 'temp', '27.70', '2018-02-27 00:17:19'),
(61, 4, 'humidity', '26.00', '2018-02-27 00:17:24'),
(62, 4, 'temp', '27.90', '2018-02-27 00:17:55'),
(63, 4, 'humidity', '26.30', '2018-02-27 00:17:55'),
(64, 4, 'temp', '27.90', '2018-02-27 00:18:05'),
(65, 4, 'humidity', '26.00', '2018-02-27 00:18:05'),
(66, 4, 'temp', '27.90', '2018-02-27 00:18:49'),
(67, 4, 'humidity', '26.10', '2018-02-27 00:18:50'),
(68, 4, 'temp', '27.80', '2018-02-27 01:36:40'),
(69, 4, 'humidity', '28.90', '2018-02-27 01:36:40'),
(70, 4, 'temp', '27.90', '2018-02-27 01:37:22'),
(71, 4, 'humidity', '30.00', '2018-02-27 01:37:23'),
(72, 4, 'temp', '28.10', '2018-02-27 01:53:31'),
(73, 4, 'humidity', '27.40', '2018-02-27 01:53:31'),
(74, 4, 'temp', '27.80', '2018-02-27 01:59:55'),
(75, 4, 'humidity', '29.50', '2018-02-27 01:59:56'),
(76, 4, 'temp', '27.90', '2018-02-27 02:03:23'),
(77, 4, 'humidity', '28.90', '2018-02-27 02:03:24'),
(79, 4, 'temp', '27.80', '2018-02-27 02:14:04'),
(80, 4, 'humidity', '28.40', '2018-02-27 02:14:05'),
(81, 4, 'temp', '27.80', '2018-02-27 02:19:55'),
(82, 4, 'humidity', '28.10', '2018-02-27 02:19:55'),
(83, 4, 'temp', '27.80', '2018-02-27 02:20:39'),
(84, 4, 'humidity', '28.40', '2018-02-27 02:20:40'),
(85, 4, 'temp', '27.80', '2018-02-27 02:22:42'),
(86, 4, 'humidity', '26.50', '2018-02-27 02:22:43'),
(87, 4, 'temp', '27.70', '2018-02-27 02:24:45'),
(88, 4, 'humidity', '26.20', '2018-02-27 02:24:46'),
(89, 4, 'temp', '27.70', '2018-02-27 02:26:47'),
(90, 4, 'humidity', '26.40', '2018-02-27 02:26:48'),
(91, 4, 'temp', '24.50', '2018-03-04 13:10:20'),
(92, 4, 'humidity', '20.90', '2018-03-04 13:10:21'),
(93, 4, 'temp', '26.10', '2018-03-05 14:21:50'),
(94, 4, 'humidity', '17.30', '2018-03-05 14:21:51'),
(95, 4, 'temp', '26.10', '2018-03-05 14:23:57'),
(96, 4, 'humidity', '17.20', '2018-03-05 14:23:58'),
(97, 4, 'temp', '26.30', '2018-03-05 14:24:25'),
(98, 4, 'humidity', '21.90', '2018-03-05 14:24:26'),
(99, 4, 'temp', '26.30', '2018-03-05 14:24:41'),
(100, 4, 'humidity', '21.40', '2018-03-05 14:24:41'),
(101, 4, 'temp', '26.20', '2018-03-05 14:26:33'),
(102, 4, 'humidity', '16.90', '2018-03-05 14:26:34'),
(103, 4, 'temp', '26.20', '2018-03-05 14:27:08'),
(104, 4, 'humidity', '17.60', '2018-03-05 14:27:08'),
(105, 4, 'temp', '26.20', '2018-03-05 14:29:09'),
(106, 4, 'humidity', '17.30', '2018-03-05 14:29:10'),
(107, 4, 'temp', '26.00', '2018-03-05 14:29:36'),
(108, 4, 'humidity', '17.30', '2018-03-05 14:29:37'),
(109, 4, 'temp', '26.20', '2018-03-05 14:30:23'),
(110, 4, 'humidity', '17.40', '2018-03-05 14:30:23'),
(111, 4, 'temp', '25.90', '2018-03-05 14:30:29'),
(112, 4, 'humidity', '17.20', '2018-03-05 14:30:30'),
(113, 4, 'temp', '25.90', '2018-03-05 14:30:41'),
(114, 4, 'humidity', '17.60', '2018-03-05 14:30:42'),
(115, 4, 'temp', '26.00', '2018-03-05 14:30:59'),
(116, 4, 'temp', '26.40', '2018-03-05 14:31:10'),
(117, 4, 'humidity', '56.10', '2018-03-05 14:31:11'),
(118, 4, 'temp', '26.50', '2018-03-05 14:31:17'),
(119, 4, 'humidity', '66.90', '2018-03-05 14:31:17'),
(120, 4, 'temp', '27.50', '2018-03-05 14:31:23'),
(121, 4, 'humidity', '55.10', '2018-03-05 14:31:23'),
(122, 4, 'temp', '27.30', '2018-03-05 14:31:29'),
(123, 4, 'humidity', '36.90', '2018-03-05 14:31:30'),
(124, 4, 'temp', '27.20', '2018-03-05 14:31:35'),
(125, 4, 'humidity', '28.60', '2018-03-05 14:31:36'),
(126, 4, 'temp', '27.10', '2018-03-05 14:31:41'),
(127, 4, 'humidity', '24.70', '2018-03-05 14:31:42'),
(128, 4, 'temp', '27.10', '2018-03-05 14:31:48'),
(129, 4, 'humidity', '22.40', '2018-03-05 14:31:48'),
(130, 4, 'temp', '27.10', '2018-03-05 14:31:54'),
(131, 4, 'humidity', '21.50', '2018-03-05 14:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `temp_min` int(11) DEFAULT NULL,
  `temp_max` int(11) DEFAULT NULL,
  `humidity_min` int(11) DEFAULT NULL,
  `humidity_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `username`, `password`, `email`, `location`, `name`, `temp_min`, `temp_max`, `humidity_min`, `humidity_max`) VALUES
(4, 'maktaf', 'UmRMZ2RWUlpzdnNjQjI3U3JGNnQ5Zz09', 'maktaf@gmail.com', NULL, NULL, 27, 45, 27, 31);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `systems_id` int(11) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `systems_id`, `mail`) VALUES
('maktaf', 'UlZsSVorN0ZiZDE2UWZ0UUE5aVdsUT09', 'Fatemh Rahimi', NULL, 'maktaf@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
