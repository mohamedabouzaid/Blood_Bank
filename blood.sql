-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 01:53 PM
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
(456, 2222222222, 567, 9, 'AB+', 'Slow bleed- Aspirin-Other'),
(12345, 1111111111, 59, 345, 'A−', 'Slow bleed- Aspirin-Relative-Other');

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
(3, 1111111111, 3, 4, 5, 'O−', 6, 7, 8),
(4, 2222222222, 1, 2, 3, 'AB−', 4, 5, 6);

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
  `bagType` varchar(255) NOT NULL,
  `approval` tinyint(1) DEFAULT NULL,
  `final` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`donar_NID`, `centerNo`, `unitNo`, `timeCollected`, `timeSeparated`, `prbc`, `pc`, `ffp`, `cryo`, `Fwb`, `Fprbc`, `Fpc`, `bagType`, `approval`, `final`) VALUES
(2222222222, '', 'c1', 0, 0, '', '', '', '', '', '', '', '', 0, 0),
(1111111111, '', 'c2', 0, 0, '', '', '', '', '', '', '', '', 0, 1);

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
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donars`
--

INSERT INTO `donars` (`NID`, `firstName`, `secondName`, `thirdName`, `familyName`, `phone`, `age`, `typeDonar`, `birthday`, `patient`, `sponsor`, `district`, `city`, `street`, `sex`, `healthCenter`, `profession`, `nationality`, `fiend`, `signDate`, `place`) VALUES
(1111111111, 'محمد', 'احمد', 'حسين', 'على', 0120000000, 23, 'طوعى', '1995-01-01', '', '', '', 'الاسماعيليه', '', 'male', '', 'مهندس', 0, 1, '02/19/2018', 'القاهره'),
(2222222222, 'mona', 'ahmed', 'hosam', 'helmy', 0110000000, 33, 'تعويضى', '1985-01-01', 'سعاد', 'احلام', 'السلام', 'cairo', 'الجامعه', 'female', 'العالمى', 'مدرسه', 1, 1, '02/19/2018', 'portsaid');

-- --------------------------------------------------------

--
-- Table structure for table `empolyees`
--

CREATE TABLE `empolyees` (
  `NID` double NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empolyees`
--

INSERT INTO `empolyees` (`NID`, `userName`, `password`, `job`) VALUES
(333333, 'samir', '123', 'Receptionist'),
(1111111111, 'ali', '123', 'admin'),
(3333333333, 'ahmed', '123', 'lab_Technician');

-- --------------------------------------------------------

--
-- Table structure for table `immuno`
--

CREATE TABLE `immuno` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) NOT NULL,
  `RH` varchar(255) NOT NULL,
  `ABO` varchar(255) NOT NULL,
  `anti` varchar(255) NOT NULL,
  `phenotype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(19, 2222222222, '1-1-1-1-موافق'),
(20, 1111111111, '0-1-0-1-موافق');

-- --------------------------------------------------------

--
-- Table structure for table `serology`
--

CREATE TABLE `serology` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HIV` varchar(255) NOT NULL,
  `HBsAg` varchar(255) NOT NULL,
  `antiHCV` varchar(255) NOT NULL,
  `syphilis` varchar(255) NOT NULL,
  `antiHBc` varchar(255) NOT NULL,
  `HTLV` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1111111111, 1),
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
-- Indexes for table `empolyees`
--
ALTER TABLE `empolyees`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `immuno`
--
ALTER TABLE `immuno`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `serology`
--
ALTER TABLE `serology`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serology` (`component_unitNo`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `immuno`
--
ALTER TABLE `immuno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `malarialab`
--
ALTER TABLE `malarialab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natlab`
--
ALTER TABLE `natlab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `serology`
--
ALTER TABLE `serology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `serology`
--
ALTER TABLE `serology`
  ADD CONSTRAINT `serology` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
