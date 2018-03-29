-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 03:44 PM
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
(123, 7777777777, 32, '02:58:00', 'A−', 'Slow bleed', 'Left', 'Yes', ''),
(3456, 3333333333, 34, '00:00:00', 'O−', 'other', 'Right', 'No', ''),
(123456, 2222222222, 0, '13:58:00', 'AB−', 'Slow bleed- Aspirin-Relative', 'Right', 'Yes', '');

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
  `hp` float NOT NULL,
  `pluse` float NOT NULL,
  `bp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`id`, `donar_NID`, `weight`, `height`, `temp`, `bloodGroup`, `hp`, `pluse`, `bp`) VALUES
(5, 1111111111, 80, 180, 45, 'A+', 4.5, 2.56, 34.1),
(6, 2222222222, 70, 170, 38, 'AB+', 23.3, 15.4, 22.5),
(7, 3333333333, 100, 190, 40, 'O−', 23.78, 14.56, 56.7),
(8, 7777777777, 40, 190, 231, 'B+', 1.2, 31, 11.7);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `donar_NID` double NOT NULL,
  `centerNo` varchar(255) NOT NULL,
  `unitNo` varchar(255) NOT NULL,
  `timeCollected` time NOT NULL,
  `timeSeparated` time NOT NULL,
  `prbc` varchar(255) NOT NULL,
  `pc` varchar(255) NOT NULL,
  `ffp` varchar(255) NOT NULL,
  `cryo` varchar(255) NOT NULL,
  `Fwb` varchar(255) NOT NULL,
  `Fprbc` varchar(255) NOT NULL,
  `Fpc` varchar(255) NOT NULL,
  `bagType` varchar(255) NOT NULL,
  `ABO` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `approval` tinyint(1) DEFAULT NULL,
  `final` tinyint(1) DEFAULT NULL,
  `daySelect` varchar(255) NOT NULL,
  `dateSelect` date NOT NULL,
  `approved` varchar(255) NOT NULL,
  `sign` varchar(255) NOT NULL,
  `performed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`donar_NID`, `centerNo`, `unitNo`, `timeCollected`, `timeSeparated`, `prbc`, `pc`, `ffp`, `cryo`, `Fwb`, `Fprbc`, `Fpc`, `bagType`, `ABO`, `note`, `approval`, `final`, `daySelect`, `dateSelect`, `approved`, `sign`, `performed`) VALUES
(3333333333, 'sd', 'c1', '00:00:00', '02:01:00', 'hanging', 'bloody', 'bloody', 'a', 'c', 'd', 'e', 'f', 'g', 'h', NULL, NULL, 'Thursday', '0000-00-00', 'ali', 'aaa', 'mohamed'),
(2222222222, 'fg', 'c2', '13:58:00', '14:58:00', 'open system', 'bloody', 'no space', 's', 'd', 'g', 'r', 'y', 'u', 'o', 0, NULL, 'Thursday', '0000-00-00', 'hosam', 'hhhh', 'mona'),
(7777777777, '12', 'cr', '02:58:00', '10:02:00', 'open system', 'bloody', 'open system', 'a', 'c', 'd', 'e', 'f', 'g', 'h', NULL, NULL, 'Thursday', '0000-00-00', 'ali', 'mohamed', 'hosam');

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
(1111111111, 'محمد', 'ابوزيد', 'ابراهيم', 'على', 0120000000, 22, 'طوعى', '1995-11-07', '', '', '', 'الاسماعيليه', '', 'male', '', 'مبرمج', 0, 1, '03/29/2018', 'الاسماعيليه', 123123),
(2222222222, 'mohamed', 'ali', 'hassan', 'mahmoud', 0110000000, 22, 'تعويضى', '1995-07-11', 'hala', 'abdo', '', 'portsaid', '', 'female', '', 'lteacher', 1, 0, '03/29/2018', 'cairo', 321),
(3333333333, 'hana', 'mohamed', 'ali', 'omar', 0150000000, 22, 'طوعى', '1995-07-11', '', '', '', 'suez', '', 'female', '', 'مدرسه', 0, 1, '03/29/2018', 'alex', 6785),
(7777777777, 'mohamed', 'ali', 'said', 'helmy', 0193333333, 22, 'طوعى', '1995-11-07', '', '', '', 'gada', '', 'male', '', 'ddoc', 0, 0, '03/29/2018', 'alex', 123);

-- --------------------------------------------------------

--
-- Table structure for table `empolyees`
--

CREATE TABLE `empolyees` (
  `NID` double NOT NULL,
  `userName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `job` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empolyees`
--

INSERT INTO `empolyees` (`NID`, `userName`, `password`, `job`) VALUES
(1111111111, 'ali', '123456', 'admin'),
(2222222222, 'mohamed', '123456', 'Receptionist'),
(2345678765, 'hisham', '123456', 'medical_director'),
(3333333333, 'ahmed', '123456', 'lab_Technician'),
(3545635467, 'adel', '123456', 'lab'),
(4444444444, 'mahmoud', '123456', 'Physician'),
(5555555555, 'samir', '123456', 'Nurse'),
(6666666666, 'amal', '123456', 'Nurse_2'),
(7676787897, 'karim', '123456', 'medical_supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `malarialab`
--

CREATE TABLE `malarialab` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL,
  `confirmation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `malarialab`
--

INSERT INTO `malarialab` (`id`, `component_unitNo`, `test`, `confirmation`) VALUES
(7, 'c2 ', 'Positive', 'Not seen');

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

--
-- Dumping data for table `natlab`
--

INSERT INTO `natlab` (`id`, `component_unitNo`, `HBV`, `HCV`, `HIV`) VALUES
(7, 'c2 ', 'Non Reactive', 'Non Reactive', 'invalid');

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
(5, 1111111111, '3-0-0-0-0-0-0-3-0-0-3-0-0-0-3-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-3-0-0-3-0-3-0-0-3-0-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-1-موافق'),
(6, 2222222222, '3-1-1-1-1-1-1-3-1-1-3-1-1-1-3-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-3-1-1-3-1-3-1-1-3-1-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-موافق'),
(7, 3333333333, '3-0-1-0-1-0-1-3-0-1-3-0-1-0-3-1-3-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-3-1-0-3-1-3-0-1-3-0-1-3-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-1-0-1-1-موافق'),
(8, 7777777777, '3-0-0-0-0-0-0-3-0-0-3-0-0-0-3-1-3-1-1-1-1-1-0-0-0-0-0-0-1-1-1-1-3-1-0-3-0-3-0-0-3-0-0-3-0-0-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-موافق');

-- --------------------------------------------------------

--
-- Table structure for table `serology`
--

CREATE TABLE `serology` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HBsAg` varchar(255) CHARACTER SET utf8 NOT NULL,
  `neut` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HCVab` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lia` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HIVag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lia2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HTLV` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lia3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `syphilis` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tb` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HBs` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HBc` varchar(255) NOT NULL,
  `s` longtext NOT NULL,
  `HBsText` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serology`
--

INSERT INTO `serology` (`id`, `component_unitNo`, `HBsAg`, `neut`, `HCVab`, `lia`, `HIVag`, `lia2`, `HTLV`, `lia3`, `syphilis`, `tb`, `HBs`, `HBc`, `s`, `HBsText`) VALUES
(6, 'c2 ', 'Reactive', 'Reactive-confirmed', 'Reactive', 'positive', 'Non Reactive', 'negative', 'Reactive', 'positive', 'Reactive', '1/320', '10>100', 'Reactive', 'As-be-xe--fy--asd-nhyui-nfbhud-fri-mon-tud', '25');

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
(5, 1111111111, 0),
(6, 2222222222, 0),
(7, 3333333333, 0),
(8, 7777777777, 0);

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
  ADD KEY `serologykey` (`component_unitNo`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `malarialab`
--
ALTER TABLE `malarialab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `natlab`
--
ALTER TABLE `natlab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `serology`
--
ALTER TABLE `serology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `serologykey` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`donar_NID`) REFERENCES `donars` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
