-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 04:22 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(6) NOT NULL,
  `mentor_id` int(4) DEFAULT NULL,
  `intern_id` int(4) DEFAULT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `mentor_id`, `intern_id`, `comment`, `date`) VALUES
(2, 108, 113, 'ODLICNO BRT', '2021-09-22'),
(3, 109, 96, 'NAKO', '2021-09-22'),
(5, 109, 96, 'NAKO', '2021-09-22'),
(6, 113, 108, 'ODLICNO BRTss', '2021-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `group_n`
--

CREATE TABLE `group_n` (
  `ID` int(1) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_n`
--

INSERT INTO `group_n` (`ID`, `title`) VALUES
(1, 'FE group 3'),
(2, 'BackEnd group 2'),
(3, 'FE group 2');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(1) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `title`) VALUES
(1, 'Intern'),
(2, 'Mentor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `lastname`, `role_id`, `group_id`) VALUES
(96, 'LJUBOMIR', 'Dubic', 1, 2),
(107, 'Jovan', 'Traynor', 1, 2),
(108, 'Kason', 'Riddle', 1, 2),
(109, 'Lilly-Grace', 'Mckay', 2, 3),
(110, 'Lizzie', 'Strong', 1, 2),
(111, 'Lilly-Grace', 'Mckay', 1, 1),
(112, 'LJUBOMIR', 'Dubic', 1, NULL),
(113, 'Macey', 'Paul', 2, 2),
(114, 'Brent', 'Boone', 1, 1),
(115, 'Rosina', 'Nairn', 1, 1),
(116, 'Macey', 'Paul', 1, NULL),
(117, 'Kason', 'Riddle', 2, NULL),
(118, 'Macey', 'Paul', 1, NULL),
(119, 'Crystal', 'Stubbs', 1, NULL),
(120, 'Macey', 'Paul', 2, NULL),
(121, 'Sherri', 'Luna', 1, NULL),
(122, 'Lilly-Grace', 'Mckay', 2, NULL),
(123, 'Marius', 'Weber', 1, NULL),
(124, 'Macey', 'Paul', 1, NULL),
(125, 'Jovan', 'Traynor', 2, 1),
(126, 'Sherri', 'Luna', 1, NULL),
(127, 'Sherri', 'Luna', 2, 1),
(128, 'Marius', 'Weber', 1, 1),
(129, 'Macey', 'Paul', 1, NULL),
(130, 'Brent', 'Boone', 2, 1),
(131, 'Crystal', 'Stubbs', 1, NULL),
(132, 'Lilly-Grace', 'Mckay', 2, NULL),
(133, 'Crystal', 'Stubbs', 2, NULL),
(134, 'Jovan', 'Traynor', 1, NULL),
(135, 'Rosina', 'Nairn', 1, NULL),
(136, 'Rosina', 'Nairn', 1, 1),
(137, 'Rosina', 'Nairn', 2, NULL),
(138, 'Jovan', 'Traynor', 1, 1),
(139, 'Marius', 'Weber', 2, NULL),
(140, 'Marius', 'Weber', 2, 1),
(141, 'Lilly-Grace', 'Mckay', 1, NULL),
(142, 'Rosina', 'Nairn', 2, NULL),
(143, 'Brent', 'Boone', 1, 1),
(144, 'Kason', 'Riddle', 1, 1),
(145, 'Rosina', 'Nairn', 1, 1),
(146, 'Kason', 'Riddle', 2, 1),
(147, 'Kason', 'Riddle', 2, NULL),
(148, 'Crystal', 'Stubbs', 1, 1),
(149, 'Crystal', 'Stubbs', 1, 1),
(150, 'Lilly-Grace', 'Mckay', 1, 1),
(151, 'Brent', 'Boone', 1, 1),
(152, 'Marius', 'Weber', 2, 1),
(153, 'Lizzie', 'Strong', 2, 1),
(154, 'Kason', 'Riddle', 1, NULL),
(155, 'Jovan', 'Traynor', 1, NULL),
(156, 'Mitar', 'Dubic', 1, NULL),
(157, 'LJUBOMIR', 'Mata', 1, NULL),
(158, 'LJUBOMIR', 'Mata', 1, NULL),
(159, 'Gru', 'ratata', 1, NULL),
(162, 'Lucas', 'Honi', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `group_n`
--
ALTER TABLE `group_n`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `role_id_2` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_n`
--
ALTER TABLE `group_n`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `user` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`intern_id`) REFERENCES `user` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group_n` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
