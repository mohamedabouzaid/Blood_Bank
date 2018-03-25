-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 04:56 PM
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
(1231234, 1111111111, 343, '19:03:00', 'B+', 'Slow bleed-Relative', 'Right', 'Yes', '00:01:73');

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
(5, 1111111111, 70, 160, 37, 'B−', 23, 120, 34),
(7, 3333333333, 991, 162, 43, 'O−', 56, 21, 67),
(8, 2222222222, 78, 123, 23, 'O−', 23, 54, 65);

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
(2222222222, '123', 'c1', '01:58:00', '23:01:00', 'open system', 'no space', 'none', 'cr', 'web', 'pr', 'pc', 'bag', 'abo', 'dddd', NULL, NULL, 'Friday', '0000-00-00', 'hosam', 'hhhhsam', 'ali');

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
(1111111111, 'محمد', 'ابوزيد', 'ابراهيم', 'محمد', 0120000000, 22, 'طوعى', '1995-11-07', '', 'عبد الوهاب', '', 'الاسماعيليه', '', 'male', '', 'مبرمج', 1, 1, '03/03/2018', 'الاسماعيليه'),
(2222222222, 'منى', 'السيد', 'احمد', 'السعيد', 0110000000, 33, 'تعويضى', '1985-01-01', 'سمر', '', 'الاول', 'الشارقه', 'العمومى', 'female', 'الرئيسى', 'دكتور', 0, 0, '03/03/2018', 'بورسعيد'),
(3333333333, 'mostafa', 'ali', 'hassan', 'mahmoud', 0120300000, 13, 'تعويضى', '2005-02-10', 'hossam', '', '', 'alex', '', 'male', '', 'student', 0, 1, '03/03/2018', 'cairo');

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
(1231231232, 'abdo', '123456', 'Bacterial'),
(1233213212, 'akram', '123456', 'Immuno'),
(2222222222, 'mohamed', '123456', 'Receptionist'),
(2345678765, 'hisham', '123456', 'medical_director'),
(3333333333, 'ahmed', '123456', 'lab_Technician'),
(4444444444, 'mahmoud', '123456', 'Physician'),
(4545454545, 'said', '123456', 'NAT'),
(5555555555, 'samir', '123456', 'Nurse'),
(5656565656, 'said', '123456', 'serology'),
(6666666666, 'amal', '123456', 'Nurse_2'),
(7676787897, 'karim', '123456', 'medical_supervisor'),
(323232323232, 'shimaa', '123456', 'malaria');

-- --------------------------------------------------------

--
-- Table structure for table `immuno`
--

CREATE TABLE `immuno` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `RH` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ABO` varchar(255) CHARACTER SET utf8 NOT NULL,
  `anti` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phenotype` varchar(255) CHARACTER SET utf8 NOT NULL
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
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `donar_NID`, `questions`) VALUES
(54, 2222222222, '3-1-1-1-1-1-1-3-1-1-3-1-1-1-3-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-3-1-1-3-1-3-1-1-3-1-1-3-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-1-موافق'),
(56, 1111111111, '3-0-0-0-0-0-0-3-0-0-3-0-0-0-3-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-3-0-0-3-0-3-0-0-3-0-0-3-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-موافق'),
(59, 3333333333, '3-0-1-0-1-0-1-3-0-1-3-0-1-0-3-1-3-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-3-1-0-3-1-3-0-1-3-0-1-3-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-موافق');

-- --------------------------------------------------------

--
-- Table structure for table `serology`
--

CREATE TABLE `serology` (
  `id` int(11) NOT NULL,
  `component_unitNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HIV` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HBsAg` varchar(255) CHARACTER SET utf8 NOT NULL,
  `antiHCV` varchar(255) CHARACTER SET utf8 NOT NULL,
  `syphilis` varchar(255) CHARACTER SET utf8 NOT NULL,
  `antiHBc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `HTLV` varchar(255) CHARACTER SET utf8 NOT NULL
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
(1, 1111111111, 0),
(2, 2222222222, 0),
(3, 3333333333, 0);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `immokey` (`component_unitNo`);

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
-- AUTO_INCREMENT for table `bacteriallab`
--
ALTER TABLE `bacteriallab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
-- Constraints for table `immuno`
--
ALTER TABLE `immuno`
  ADD CONSTRAINT `immokey` FOREIGN KEY (`component_unitNo`) REFERENCES `component` (`unitNo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
