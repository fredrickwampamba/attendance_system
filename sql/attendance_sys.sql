-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 11:52 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(18) NOT NULL,
  `date_time` varchar(20) NOT NULL,
  `gps` varchar(15) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `mac` varchar(20) NOT NULL,
  `lectureID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `reg_no`, `date_time`, `gps`, `ip`, `mac`, `lectureID`) VALUES
(84, '18/u/etd/183/gv', '2022-02-16 00:18:03', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:eFF', '14814'),
(85, '18/U/ETD/183/GV', '2022-02-16 00:22:38', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:EFF', '14814'),
(86, '18/U/ETD/183/GV', '2022-02-16 17:48:09', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:EFF', '88973'),
(87, '18/U/ETD/183/GV', '2022-02-16 17:48:11', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:EFF', '88973'),
(88, '18/U/ETD/183/GV', '2022-02-16 17:48:13', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:EFF', '88973'),
(89, '18/U/ETD/183/GV', '2022-02-16 17:48:14', '0.1223, 34.2321', '12.233.455.34', 'AW:WDE:EDF:EFF', '88973');

-- --------------------------------------------------------

--
-- Table structure for table `course_units`
--

CREATE TABLE `course_units` (
  `id` int(11) NOT NULL,
  `course_unitID` varchar(10) NOT NULL,
  `course_unit` varchar(30) NOT NULL,
  `semester` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_units`
--

INSERT INTO `course_units` (`id`, `course_unitID`, `course_unit`, `semester`) VALUES
(1, 'TETE:3303', 'Applied Electronics', '2'),
(2, 'TETE 1101', 'Engineering Mathematics 1', '2'),
(3, 'TETE 1102', 'Computer Technology and ICT ', '2'),
(4, 'TETE 1103', 'Circuit Theory', '2'),
(5, 'TETE 1104', 'Applied Mechanics', '2');

-- --------------------------------------------------------

--
-- Table structure for table `last_login`
--

CREATE TABLE `last_login` (
  `id` int(11) NOT NULL,
  `lecturerID` varchar(30) NOT NULL,
  `remote_ip` varchar(20) DEFAULT NULL,
  `date_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_login`
--

INSERT INTO `last_login` (`id`, `lecturerID`, `remote_ip`, `date_time`) VALUES
(20, '93111', '', '2022-02-16 18:51:53'),
(21, '93111', '127.0.0.1', '2022-02-16 18:53:09'),
(22, '93111', '::1', '2022-02-16 21:06:27'),
(23, '93111', '::1', '2022-02-16 21:07:34'),
(24, '93111', '::1', '2022-02-16 21:08:37'),
(25, '93111', '127.0.0.1', '2022-02-17 09:19:31'),
(26, '93111', '192.168.1.100', '2022-02-20 22:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `lecturerID` varchar(10) NOT NULL,
  `lecturer_name` varchar(20) NOT NULL,
  `lecturer_phone` varchar(15) NOT NULL,
  `lecturer_email` varchar(40) NOT NULL,
  `lecturer_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `lecturerID`, `lecturer_name`, `lecturer_phone`, `lecturer_email`, `lecturer_password`) VALUES
(1, '93111', 'Fredrick Wampamba', '0702718025', 'fredowampz@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_course_units`
--

CREATE TABLE `lecturer_course_units` (
  `id` int(11) NOT NULL,
  `lecturerID` varchar(20) NOT NULL,
  `course_unit_id` int(11) NOT NULL,
  `yearID` varchar(10) NOT NULL,
  `del` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_course_units`
--

INSERT INTO `lecturer_course_units` (`id`, `lecturerID`, `course_unit_id`, `yearID`, `del`) VALUES
(11, '93111', 1, '61f257d9ed', 1),
(12, '93111', 4, '61f257d9ed', 1),
(13, '93111', 3, '61f257d9ed', 1),
(14, '93111', 2, '61f257d9ed', 1),
(15, '93111', 5, '61f257d9ed', 1),
(16, '93111', 2, '61f257d9ed', 1),
(17, '93111', 2, '61f257d9ed', 1),
(18, '93111', 3, '61f257d9ed', 1),
(19, '93111', 2, '61f257d9ed', 1),
(20, '93111', 1, '61f257d9ed', 0),
(21, '93111', 4, '61f257d9ed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `lecture_id` varchar(11) NOT NULL,
  `course_unit_id` int(11) NOT NULL,
  `lecture_date` varchar(11) NOT NULL,
  `lecture_time` varchar(11) NOT NULL COMMENT 'time the lecture is to start',
  `time_bound` int(11) NOT NULL COMMENT 'in minutes/// this is the time diff after the lecture time for which a student should register',
  `lecture_gps` text,
  `lecture` varchar(30) NOT NULL,
  `lecturerID` varchar(20) NOT NULL,
  `del` int(1) NOT NULL DEFAULT '0',
  `yearID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `lecture_id`, `course_unit_id`, `lecture_date`, `lecture_time`, `time_bound`, `lecture_gps`, `lecture`, `lecturerID`, `del`, `yearID`) VALUES
(331, '88973', 1, '2022-02-16', '00:02', 60, '0.3457318333056', '2022-02-16/88973/00:02', '93111', 1, '61f257d9ed'),
(332, '14814', 4, '2022-02-16', '00:05', 26, '0.3457318333056', '2022-02-16/14814/00:05', '93111', 1, '61f257d9ed'),
(333, '66045', 1, '2022-02-16', '17:23', 60, '0.3466656666666', '2022-02-16/66045/17:23', '93111', 1, '61f257d9ed'),
(334, '83381', 1, '2022-02-16', '17:45', 23, '0.3458386883178', '2022-02-16/83381/17:45', '93111', 1, '61f257d9ed'),
(335, '4876', 1, '2022-02-16', '17:45', 23, '0.3458386883178', '2022-02-16/4876/17:45', '93111', 1, '61f257d9ed'),
(336, '72320', 1, '2022-02-16', '17:48', 7, '0.34663866666666665,32.62968299999999', '2022-02-16/72320/17:48', '93111', 1, '61f257d9ed'),
(337, '35242', 3, '2022-02-16', '21:14', 19, '0.3342336,32.587776', '2022-02-16/35242/21:14', '93111', 1, '61f257d9ed'),
(338, '10057', 1, '2022-02-16', '23:04', 68, '0.34616449597874943,32.63083256793539', '2022-02-16/10057/23:04', '93111', 0, '61f257d9ed'),
(339, '55778', 1, '2022-02-20', '22:15', 56, '0.07991113327032272,32.51579718449526', '2022-02-20/55778/22:15', '93111', 0, '61f257d9ed'),
(340, '4879', 1, '2022-02-20', '22:15', 55, '0.07991113327032272,32.51579718449526', '2022-02-20/4879/22:15', '93111', 0, '61f257d9ed');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(18) NOT NULL,
  `dev_imei` varchar(16) NOT NULL,
  `yearID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `yearID` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(14) NOT NULL,
  `sem` int(1) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `yearID`, `year`, `semester`, `sem`, `active`) VALUES
(2, '61f257d9ed', '2021/2022', 'Semester II', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_units`
--
ALTER TABLE `course_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_login`
--
ALTER TABLE `last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturerID` (`lecturerID`),
  ADD UNIQUE KEY `lecturer_email` (`lecturer_email`);

--
-- Indexes for table `lecturer_course_units`
--
ALTER TABLE `lecturer_course_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `course_units`
--
ALTER TABLE `course_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `last_login`
--
ALTER TABLE `last_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lecturer_course_units`
--
ALTER TABLE `lecturer_course_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
