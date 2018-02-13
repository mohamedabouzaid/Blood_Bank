-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 04:57 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `bacteriallab`
--

CREATE TABLE `bacteriallab` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bloodsample`
--

CREATE TABLE `bloodsample` (
  `ID` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `bagWeight` int(11) NOT NULL,
  `timeCollection` int(11) NOT NULL,
  `bloodGroup` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloodsample`
--

INSERT INTO `bloodsample` (`ID`, `donar_NID`, `bagWeight`, `timeCollection`, `bloodGroup`, `comment`) VALUES
(1, 1111111111, 22, 33, 'c+', 'Slow bleed- Aspirin');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `id` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `bloodGroup` varchar(255) NOT NULL,
  `hp` int(11) NOT NULL,
  `pluse` int(11) NOT NULL,
  `bp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`id`, `donar_NID`, `weight`, `height`, `temp`, `bloodGroup`, `hp`, `pluse`, `bp`) VALUES
(1, 1111111111, 86, 110, 35, 'A', 30, 33, 48),
(4, 3333333333, 100, 120, 35, 'C', 34, 56, 78),
(5, 2222222222, 99, 160, 40, 'b', 45, 55, 67);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `donar_NID` double NOT NULL,
  `centerNo` varchar(255) NOT NULL,
  `unitNo` varchar(255) NOT NULL,
  `timeCollected` int(11) NOT NULL,
  `timeSeparated` int(11) NOT NULL,
  `prbc` varchar(255) NOT NULL,
  `pc` varchar(255) NOT NULL,
  `ffp` varchar(255) NOT NULL,
  `cryo` varchar(255) NOT NULL,
  `Fwb` varchar(255) NOT NULL,
  `Fprbc` varchar(255) NOT NULL,
  `Fpc` varchar(255) NOT NULL,
  `bagType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donars`
--

CREATE TABLE `donars` (
  `NID` double NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `secondName` varchar(255) NOT NULL,
  `thirdName` varchar(255) NOT NULL,
  `familyName` varchar(255) NOT NULL,
  `phone` double NOT NULL,
  `age` int(11) NOT NULL,
  `typeDonar` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `patient` varchar(255) NOT NULL,
  `sponsor` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `healthCenter` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `nationality` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donars`
--

INSERT INTO `donars` (`NID`, `firstName`, `secondName`, `thirdName`, `familyName`, `phone`, `age`, `typeDonar`, `birthday`, `patient`, `sponsor`, `district`, `city`, `street`, `sex`, `healthCenter`, `profession`, `nationality`) VALUES
(1111111111, 'محمد', 'ابوزيد', 'ابراهيم', 'عارف', 1212121212, 22, 'طوعى', '1995-11-07', '', 'عبداللطيف', '', 'الاسماعيليه', '', 'male', '', 'مبرمج', 1),
(2222222222, 'mahmoud', 'samir', 'mosaad', 'mohamed', 2121222222, 22, 'طوعى', '1995-10-04', 'على', '', 'السلام', 'cairo', 'التلاتينى', 'male', 'الجامعه', 'مهندس', 0),
(3333333333, 'منى', 'السيد', 'احمد', 'على', 3344334434, 18, 'طوعى', '2000-01-01', '', 'بن وليد', 'شيخ زايد', 'دبى', 'ال مكتوم', 'female', 'العالمى', 'دكتور', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `userName`, `password`, `job`) VALUES
(1, 'mohamed', 111, 'receptionist'),
(2, 'ahmed', 222, 'labTechnician'),
(3, 'ali', 333, 'physician'),
(4, 'mahmoud', 444, 'nurse'),
(5, 'mona', 555, 'NAT'),
(6, 'alia', 666, 'bacterial'),
(7, 'salah', 22, 'malaria');

-- --------------------------------------------------------

--
-- Table structure for table `malarialab`
--

CREATE TABLE `malarialab` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `natlab`
--

CREATE TABLE `natlab` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) NOT NULL,
  `HBV` varchar(255) NOT NULL,
  `HCV` varchar(255) NOT NULL,
  `HIV` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `questions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `donar_NID`, `questions`) VALUES
(1, 1111111111, '0-0-1-0-موافق'),
(3, 3333333333, '0-1-1-1-موافق'),
(4, 2222222222, '0-0-1-1-موافق');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `donar_NID`, `status`) VALUES
(1, 1111111111, 0),
(2, 3333333333, 1),
(3, 2222222222, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bacteriallab`
--
ALTER TABLE `bacteriallab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab1` (`component_unitNo`);

--
-- Indexes for table `bloodsample`
--
ALTER TABLE `bloodsample`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fkey1` (`donar_NID`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donar_NID` (`donar_NID`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`unitNo`),
  ADD KEY `keyy` (`donar_NID`);

--
-- Indexes for table `donars`
--
ALTER TABLE `donars`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `malarialab`
--
ALTER TABLE `malarialab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab2` (`component_unitNo`);

--
-- Indexes for table `natlab`
--
ALTER TABLE `natlab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab3` (`component_unitNo`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donar_NID` (`donar_NID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donar_NID` (`donar_NID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bacteriallab`
--
ALTER TABLE `bacteriallab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `malarialab`
--
ALTER TABLE `malarialab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `natlab`
--
ALTER TABLE `natlab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bacteriallab`
--
ALTER TABLE `bacteriallab`
  ADD CONSTRAINT `lab1` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bloodsample`
--
ALTER TABLE `bloodsample`
  ADD CONSTRAINT `fkey1` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clinic`
--
ALTER TABLE `clinic`
  ADD CONSTRAINT `fkey2` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `component`
--
ALTER TABLE `component`
  ADD CONSTRAINT `keyy` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `malarialab`
--
ALTER TABLE `malarialab`
  ADD CONSTRAINT `lab2` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `natlab`
--
ALTER TABLE `natlab`
  ADD CONSTRAINT `lab3` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `fkey3` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
