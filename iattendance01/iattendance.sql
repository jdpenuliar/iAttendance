-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2016 at 09:38 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iattendance`
--
CREATE DATABASE IF NOT EXISTS `iattendance` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iattendance`;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `userFirstName` varchar(255) NOT NULL,
  `userLastName` varchar(255) NOT NULL,
  `userLevel` int(11) NOT NULL,
  `userAccountStatus` int(11) NOT NULL,
  `userRegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `userName`, `userPassword`, `salt`, `userFirstName`, `userLastName`, `userLevel`, `userAccountStatus`, `userRegistrationDate`) VALUES
(0, 'admin', 'aedd1b91f994a16ca082a4496cd2ac631999b4dff399a185b1f9ac153619488f', '6f9ad95f811453622', 'admin', 'admin', 0, 1, '2016-04-09'),
(1, 'supervisor', '1f6550ba0ac2af7b1f5875f161bcc3d8ade35a882dd2c0c3f62b52a6d145b15e', '1db897ef2070222728', 'supervisor', 'supervisor', 1, 1, '2016-04-15'),
(2, 'dean', 'e41f3272d7c0a2e48ee1fa1ce9d86147bbe4c1990d8db96ca69e20ca5a79fd81', '6dc1bb492076024113', 'dean', 'dean', 2, 1, '2016-04-15'),
(3, 'ojt', '108f0c0bc9854f894186e0fb5399b62b6179f3796944441fdb46566e12b30a7e', '17920f061293291408', 'ojt', 'ojt', 3, 1, '2016-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `activityLogNumber` bigint(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `userActivity` varchar(255) NOT NULL,
  `userRemarks` varchar(255) NOT NULL,
  `userDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`activityLogNumber`, `userID`, `userActivity`, `userRemarks`, `userDateTime`) VALUES
(97, 3, 'In Shift', 'remarks', '2016-04-17 07:04:10'),
(98, 3, 'Out Shift', 'remarks', '2016-04-17 07:04:17'),
(99, 3, 'In Shift', 'remarks', '2016-04-17 07:08:28'),
(100, 3, 'Out Shift', 'remarks', '2016-04-17 07:08:57'),
(101, 3, 'In Shift', 'remarks', '2016-04-17 07:09:47'),
(102, 3, 'Out Shift', 'remarks', '2016-04-17 07:11:57'),
(103, 3, 'In Shift', 'remarks', '2016-04-17 16:17:24'),
(104, 3, 'Out Shift', 'remarks', '2016-04-17 16:22:52'),
(105, 3, 'In Shift', 'remarks', '2016-04-17 16:24:40'),
(106, 3, 'Out Shift', 'remarks', '2016-04-17 16:24:53'),
(107, 3, 'In Shift', 'remarks', '2016-04-17 14:27:05'),
(108, 3, 'Out Shift', 'remarks', '2016-04-17 16:28:27'),
(109, 3, 'In Shift', 'remarks', '2016-04-17 16:35:33'),
(110, 3, 'Out Shift', 'remarks', '2016-04-17 16:36:31'),
(111, 3, 'In Shift', 'remarks', '2016-04-17 09:37:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`activityLogNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `activityLogNumber` bigint(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
