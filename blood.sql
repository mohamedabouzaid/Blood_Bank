-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2018 at 02:42 PM
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
(123, 3333333334, 34, '14:59:00', 'B−', 'Slow bleed-Relative', 'Right', 'Yes', '00:02:84'),
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
(3, 3333333333, 67, 46, 54, 'AB−', 45, 88, 456),
(4, 3333333334, 1, 2, 3, 'B+', 4, 56, 6);

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
(3333333334, 'bn', 'b2', '14:59:00', '02:58:00', 'open system', 'bloody', 'lipemic', 'c', 'sd', 'sc', '', '', '', '', NULL, NULL, 'Tuesday', '0000-00-00', 'as', 'as', 'ma'),
(3333333333, 'no1', 'c1', '13:00:00', '11:01:00', 'hanging', 'no space', 'lipemic', 'abc', 'cda', 'pye', 'qw', 'bgd', 'gdr', 'bd', 0, 1, 'Sunday', '0000-00-00', 'mahmoud', 'mou', 'ali'),
(1234567890, 'no2', 'c2', '12:00:00', '15:59:00', 'hanging', 'lipemic', 'lipemic', 'ng', 'rt', 'rrt', 'pc', 'bag', 'hf', 'ew', 0, 1, 'Sunday', '0000-00-00', 'ahmed', 'med', 'hosam');

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
(3333333333, 'فاطمه', 'على', 'احمد', 'حسن', 0159999999, 42, 'طوعى', '1975-07-11', '', '', '', 'الشارقه', '', 'female', '', 'مدرسه', 0, 1, '03/25/2018', 'المدينه', 333),
(3333333334, 'adadsd', 'adadad', 'adasdd', 'sadasdsad', 3333333334, 22, 'طوعى', '1995-11-07', '', '', '', 'weqweqwqweqwe', '', 'male', '', 'dasdfsdfsdf', 0, 0, '03/27/2018', 'kkkkkkk', 345654321);

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
(2, 'c1 ', 'Positive', 'Seen'),
(3, 'c2 ', 'Negative', 'Seen');

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
(2, 'c1 ', 'Non Reactive', 'invalid', 'Non Reactive'),
(3, 'c2 ', 'Non Reactive', 'Non Reactive', 'Non Reactive');

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
(3, 3333333333, '3-1-1-0-0-1-3-0-1-3-0-1-0-3-0-3-1-0-1-0-0-1-0-0-1-0-1-0-1-0-1-3-0-1-3-0-3-1-0-3-1-0-3-1-0-1-0-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-موافق'),
(4, 3333333334, '3-0-1-0-1-0-1-3-0-1-3-0-0-1-3-0-3-1-0-0-0-0-1-1-1-0-0-0-0-0-1-1-3-0-0-3-1-3-1-0-3-0-1-3-0-0-0-0-1-0-1-0-1-0-1-0-1-0-1-0-1-0-1-موافق');

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
  `s` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serology`
--

INSERT INTO `serology` (`id`, `component_unitNo`, `HBsAg`, `neut`, `HCVab`, `lia`, `HIVag`, `lia2`, `HTLV`, `lia3`, `syphilis`, `tb`, `HBs`, `HBc`, `s`) VALUES
(3, 'c1 ', 'Non Reactive', 'Reactive-confirmed', 'Non Reactive', 'positive', 'Non Reactive', 'negative', 'Reactive', 'negative', 'Reactive', '1/640', '0>10', 'Non Reactive', 'a-b-c-d-e-f-n-m-o-w-e-r'),
(4, 'c2 ', 'Non Reactive', 'Non confirmed', 'Reactive', 'indeterminate', 'Non Reactive', 'positive', 'Reactive', 'positive', 'Reactive', '1/160', '10>100', 'Non Reactive', 'a-s-d-f-g-h-j-k-l-e-y-u');

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
(3, 3333333333, 0),
(4, 3333333334, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `malarialab`
--
ALTER TABLE `malarialab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `serology`
--
ALTER TABLE `serology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
