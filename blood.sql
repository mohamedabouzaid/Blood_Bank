-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2018 at 08:34 PM
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
-- Table structure for table `bloodsample`
--

CREATE TABLE `bloodsample` (
  `ID` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `bagWeight` int(11) NOT NULL,
  `timeCollection` time NOT NULL,
  `bloodGroup` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `arm` varchar(255) NOT NULL,
  `visual` varchar(255) NOT NULL,
  `timeprocess` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloodsample`
--

INSERT INTO `bloodsample` (`ID`, `donar_NID`, `bagWeight`, `timeCollection`, `bloodGroup`, `comment`, `arm`, `visual`, `timeprocess`) VALUES
(234, 3333333333, 78, '13:00:00', 'O−', ' Aspirin-Relative', 'Right', 'No', '00:01:87'),
(1234, 1234567890, 45, '12:00:00', 'AB−', 'Slow bleed-Relative', 'Left', 'No', '00:02:13');

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
(1, 1234567890, 56, 175, 49, 'B+', 23, 24, 24),
(2, 2222222222, 89, 200, 67, 'O−', 56, 89, 34),
(3, 3333333333, 67, 46, 54, 'AB−', 45, 88, 456);

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
  `phone` int(10) UNSIGNED ZEROFILL NOT NULL,
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
  `nationality` int(11) NOT NULL,
  `fiend` int(11) NOT NULL DEFAULT '0',
  `signDate` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `bloodNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donars`
--

INSERT INTO `donars` (`NID`, `firstName`, `secondName`, `thirdName`, `familyName`, `phone`, `age`, `typeDonar`, `birthday`, `patient`, `sponsor`, `district`, `city`, `street`, `sex`, `healthCenter`, `profession`, `nationality`, `fiend`, `signDate`, `place`, `bloodNo`) VALUES
(1234567890, 'محمد', 'ابوزيد', 'ابراهيم', 'العارف', 0120000000, 22, 'طوعى', '1995-11-07', '', 'حسان بن وليد', '', 'الاسماعيليه', '', 'male', '', 'مبرمج', 1, 1, '03/25/2018', 'الاسماعيليه', 123),
(2222222222, 'mohmoud', 'samir', 'mosad', 'ali', 0111111111, 32, 'تعويضى', '1985-07-11', 'على محمد', '', '', 'madina', '', 'male', '', 'prof', 0, 0, '03/25/2018', 'maka', 3213),
(3333333333, 'فاطمه', 'على', 'احمد', 'حسن', 0159999999, 42, 'طوعى', '1975-07-11', '', '', '', 'الشارقه', '', 'female', '', 'مدرسه', 0, 1, '03/25/2018', 'المدينه', 333);

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `donar_NID` double NOT NULL,
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `donar_NID`, `questions`) VALUES
(1, 1234567890, '3-0-0-0-0-0-0-3-0-0-3-0-0-0-3-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-3-0-0-3-0-3-0-0-3-0-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-1-موافق'),
(2, 2222222222, '3-1-1-1-1-1-1-3-1-1-3-1-1-1-3-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-3-1-1-3-1-3-1-1-3-1-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-موافق'),
(3, 3333333333, '3-1-1-0-0-1-3-0-1-3-0-1-0-3-0-3-1-0-1-0-0-1-0-0-1-0-1-0-1-0-1-3-0-1-3-0-3-1-0-3-1-0-3-1-0-1-0-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-موافق');

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
(1, 1234567890, 0),
(2, 2222222222, 1),
(3, 3333333333, 0);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `donars`
--
ALTER TABLE `donars`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `phone` (`phone`);

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
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
