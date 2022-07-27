-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 12:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksysphp`
--
CREATE DATABASE IF NOT EXISTS `banksysphp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banksysphp`;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `sno` bigint(20) NOT NULL,
  `senderId` int(7) DEFAULT NULL,
  `receiverId` int(7) DEFAULT NULL,
  `balance` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `actionType` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`sno`, `senderId`, `receiverId`, `balance`, `datetime`, `notes`, `status`, `actionType`) VALUES
(1, 1, 2, 51000, '2021-05-14 14:29:15', '', 1, 3),
(2, 2, 3, 25000, '2021-05-14 18:40:51', '', 1, 3),
(3, 3, 4, 5000, '2021-05-14 19:16:56', '', 1, 3),
(4, 4, 5, 26950, '2021-05-14 19:31:07', '', 1, 3),
(8, 1, 2, 6000, '2022-07-24 06:57:37', 'tests', 1, 3),
(9, 1, 2, 100, '2022-07-24 08:01:24', 'test2', 1, 3),
(10, 1, 1, 10000, '2022-07-24 09:58:52', 'test deposit', 1, 1),
(11, 1, 1, 60000, '2022-07-24 10:06:23', 'test deposit 4---//// Operation: Check Number: 4324243', 1, 1),
(12, 1, 1, 10000, '2022-07-24 10:16:32', '12312313 ---//// Operation: WithdrawCheck Number: 123123', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(155) NOT NULL,
  `balance` int(8) NOT NULL,
  `nid` varchar(12) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `checksum` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `balance`, `nid`, `phone`, `address`, `notes`, `status`, `checksum`) VALUES
(1, 'Cassie Perkins', 'cassiep@gmail.com', 'Female', 71834, '', '', '', '', 1, 3),
(2, 'Keith McKay', 'keithmc@gmail.com', 'Male', 81316, '', '', '', '', 1, 0),
(3, 'Michelle Cruz', 'cruzmch@gmail.com', 'Female', 113750, '', '', '', '', 1, 0),
(4, 'Willbert Flyn', 'willbertfl@gmail.com', 'Male', 100005, '', '', '', '', 1, 0),
(5, 'Natalie Cloutier', 'natcloutier@gmail.com', 'Female', 127350, '', '', '', '', 1, 0),
(6, 'Evelyn Kent', 'evelynkent@gmail.com', 'Female', 81000, '', '', '', '', 1, 0),
(7, 'John Russel', 'russelj@gmail.com', 'Male', 69005, '', '', '', '', 1, 0),
(8, 'Virginia Hopkins', 'virginhop@gmail.com', 'Female', 210300, '', '', '', '', 1, 0),
(9, 'Christine Moore', 'christine@gmail.com', 'Female', 99000, '', '', '', '', 1, 0),
(10, 'Thomas Greenwood', 'thomasgr@gmail.com', 'Male', 40000, '', '', '', '', 1, 0),
(19, 'Matthew Ingalls', 'matthewlls@gmail.com', 'Male', 40000, '', '', '', '', 1, 0),
(20, 'Kelly Wilkins', 'wilkelly@gmail.com', 'Female', 29610, '', '', '', '', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `senderId` (`senderId`,`receiverId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `sno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
