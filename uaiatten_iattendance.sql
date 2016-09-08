-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2016 at 11:34 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uaiatten_iattendance`
--
CREATE DATABASE IF NOT EXISTS `uaiatten_iattendance` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `uaiatten_iattendance`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcompanies`
--

DROP TABLE IF EXISTS `tblcompanies`;
CREATE TABLE IF NOT EXISTS `tblcompanies` (
  `companyID` int(255) NOT NULL,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyContact` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcompanies`
--

INSERT INTO `tblcompanies` (`companyID`, `companyName`, `companyAddress`, `companyContact`) VALUES
(1, 'University of the Assumption', 'Unisite Subd. Del Pilar, University Of The Assumption, Pampanga, Philippines, 2000', '9613697'),
(3, 'samplecompany001x', 'samplecompany001x', '123');

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
  `userMiddleName` varchar(255) NOT NULL,
  `userLastName` varchar(255) NOT NULL,
  `userLevel` int(11) NOT NULL,
  `userCompanyID` int(255) NOT NULL,
  `userPrimaryContact` int(255) NOT NULL,
  `userSecondaryContact` int(255) NOT NULL,
  `userEmailAddress` varchar(255) NOT NULL,
  `userAccountStatus` int(11) NOT NULL,
  `userRegistrationDate` date NOT NULL,
  `adminNotification` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `userName`, `userPassword`, `salt`, `userFirstName`, `userMiddleName`, `userLastName`, `userLevel`, `userCompanyID`, `userPrimaryContact`, `userSecondaryContact`, `userEmailAddress`, `userAccountStatus`, `userRegistrationDate`, `adminNotification`) VALUES
(1, 'admin', '449091a5cab5fee22d22c957bd95c1cd7bf24d6b982021abc207760f0af24c1a', '7ee146221389395177', 'admin', 'admin', 'admin', 0, 0, 123, 123, '', 1, '2016-04-25', 0),
(2, 'dean', 'b465827a9b0d40ecdb0c714996e6c6c8cd8ae487ab0e5b001d9c4c682cee8e9e', '6c3330f01731871887', 'dean', 'dean', 'dean', 1, 0, 123, 123, '', 1, '2016-04-25', 0),
(3, 'supervisor', '8b1035cebaecc9314951013c13683e7af5eeb2c4bc36990c1c5525e0c7b38cba', '37c2810c1111530649', 'supervisor', 'supervisor', 'supervisor', 2, 0, 123, 123, '', 1, '2016-04-25', 0),
(4, 'ojt', '5459ece36618e04212aac78629bc6c658171a27f9123258333e417ca9b9a34b5', '8dab3361578575547', 'ojt', 'ojt', 'ojt', 3, 1, 0, 0, '', 1, '2016-04-25', 0),
(5, '123', 'b072d7589982099c2cbecbea01a42bfda5f942e61f06f85041e8a36dfe3c1ec6', '30c97064985982376', 'charles', 'VITAL', 'VITAL', 3, 1, 2147483647, 2147483647, '', 1, '2016-04-26', 0),
(6, 'joner', '933597e9d4f6db3693b53bce42a91b6d5679dc1038ea2bb1d8c6d21b0fa59cd1', '654d59b2986543029', 'joner', 'ca', 'canilao', 3, 1, 2147483647, 291829384, '', 1, '2016-04-26', 0),
(7, '1234', '159432c7ccb3d556ae1d973fc644c0f5144cde9a3ff62a444b0cbc7a23a766ba', '4cc2280c635128661', 'allan paolo', 'sotto', 'sotto', 3, 1, 2147483647, 2147483647, '', 1, '2016-04-26', 0),
(8, 'karl', '33adaf8b561a8362fdeef1a5c82b85f8d67cb41af0aec3932491f37c3c3a4788', '4d2a79501607999091', 'karl', 'kennedy', 'velasquez', 3, 1, 2147483647, 2147483647, '', 1, '2016-04-26', 0),
(9, 'kevin', '2ae52d9a162fbb261850095ec9b5d75868e0bc899cc1dd4322e0bad57b1e6b5c', '7314edfa859821100', 'kevin', 'ok', 'velasquez', 3, 1, 2015458625, 2147483647, '', 1, '2016-04-26', 0),
(10, 'canilao', '0383ad5792faacce9bfcaf5747d009b4c4c3ec13782161eb9ee4ce2579ccda36', '1823088c912976705', 'jojojojo', 'a', 'canilao', 3, 1, 2147483647, 2147483647, '', 1, '2016-04-28', 0),
(11, 'maybel', 'a8ef442e8e7d5ec03d95cec9e60993ee3573d77064decf46f4fa79bc563d23a4', '6b748efe140083582', 'maybel', 'a', 'panlaqui', 3, 1, 2147483647, 2147483647, '', 1, '2016-04-28', 0),
(12, 'karlvelasquez', 'fee3be10b6100a85e957e99b4f81e9e71586cac3a7cc3f40a594d59d579f091e', '721802a79326967', 'karl', 'lee', 'velasquez', 3, 1, 2147483647, 2147483647, '', 1, '2016-05-03', 0),
(13, 'sample001', '2cb1e554526e3991510d0f65a8c843e52e355503c089ae8b120da8f9eed6b292', '5dd08a8566895068', 'sample001', 'sample001', 'sample001', 3, 1, 123, 123, '', 1, '2016-05-06', 0),
(14, 'sample002', '039ff6c49cf8b7a42313ca2a3f3996ab80264bc74ff82e596c7ea8ae127b8ac6', '4e40a65e1519838090', 'sample002', 'sample002', 'sample002', 3, 1, 123, 12, '', 1, '2016-05-07', 0),
(15, 'sample004', '52258735f10fa74c93bb97db23ed384914d0306d6775091307e9f6b9613202ff', '54fa12bd425395243', 'sample004', 'sample004', 'sample004', 3, 1, 123, 234, 'sample004@blah.c', 1, '2016-05-07', 0),
(16, '12345', 'a621bed37c2260cc726c599cbd87ecc9cf62c6b01fc040db9ce5ab1b483a8489', '55feacb11894293891', '123', '123', '123', 3, 1, 123, 123, 'a@a.com', 0, '2016-05-08', 0),
(17, '123456', '23061235f51bd0f5a8c58aa7e0f6a1348d7d380714f073d9414e106732f88fa2', '577436c91353183344', '123', '123', '123', 3, 1, 123, 123, '123@123.com', 1, '2016-05-08', 0),
(18, 'sample005', 'b8a2beca5e7e9a22c54b59c4ec965e6c57ccf81096e25b9a65414dbce8d3bea7', '76793f94128391225', 'sample005', 'sample005', 'sample005', 3, 1, 123, 123, '123@123.com', 1, '2016-05-09', 0),
(19, 'supervisor001x', '524e9d6bf9d6b47ce52f260c3a98b2ed833670237219ad3ed16c2f5110505bac', '2ebc92d91920254519', 'supervisor001x', 'supervisor001', 'supervisor001', 2, 1, 123, 123, '', 1, '2016-05-09', 0),
(20, 'sa', '6d71294d86955898603f0d703730f62de9ff0e8323af8e2a4722ca75909a3b9b', '3f88672e1593282219', 'sampledean001x', 'sampledean001', 'sampledean001', 1, 1, 123, 123, '123@123.com', 1, '2016-05-10', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`activityLogNumber`, `userID`, `userActivity`, `userRemarks`, `userDateTime`) VALUES
(324, 3, 'In Shift', 'remarks', '2016-05-09 08:37:41'),
(325, 18, 'In Shift', 'remarks', '2016-05-09 08:37:51'),
(326, 18, 'Out Shift', 'remarks', '2016-05-09 08:37:56'),
(327, 3, 'Out Shift', 'remarks', '2016-05-09 09:40:12'),
(328, 2, 'In Shift', 'remarks', '2016-05-09 09:40:18'),
(329, 2, 'Out Shift', 'remarks', '2016-05-09 10:13:11'),
(330, 3, 'In Shift', 'remarks', '2016-05-09 10:13:32'),
(331, 3, 'Out Shift', 'remarks', '2016-05-09 10:20:40'),
(332, 2, 'In Shift', 'remarks', '2016-05-09 10:20:43'),
(333, 2, 'Out Shift', 'remarks', '2016-05-09 15:18:34'),
(334, 3, 'In Shift', 'remarks', '2016-05-09 15:18:41'),
(335, 3, 'Out Shift', 'remarks', '2016-05-09 15:26:19'),
(336, 2, 'In Shift', 'remarks', '2016-05-09 15:26:26'),
(337, 2, 'Out Shift', 'remarks', '2016-05-09 16:18:20'),
(338, 2, 'In Shift', 'remarks', '2016-05-09 16:25:23'),
(339, 3, 'In Shift', 'remarks', '2016-05-09 16:25:30'),
(340, 3, 'Out Shift', 'remarks', '2016-05-09 16:26:52'),
(341, 2, 'Out Shift', 'remarks', '2016-05-09 16:26:56'),
(342, 2, 'In Shift', 'remarks', '2016-05-09 07:35:54'),
(343, 3, 'In Shift', 'remarks', '2016-05-09 07:36:02'),
(344, 3, 'Out Shift', 'remarks', '2016-05-09 07:36:17'),
(345, 3, 'In Shift', 'remarks', '2016-05-09 07:41:41'),
(346, 3, 'Out Shift', 'remarks', '2016-05-09 07:42:04'),
(347, 2, 'Out Shift', 'remarks', '2016-05-09 07:42:08'),
(348, 2, 'In Shift', 'remarks', '2016-05-09 15:24:33'),
(349, 2, 'Out Shift', 'remarks', '2016-05-09 15:24:38'),
(350, 2, 'In Shift', 'remarks', '2016-05-09 16:28:16'),
(351, 3, 'In Shift', 'remarks', '2016-05-09 16:28:25'),
(352, 18, 'In Shift', 'remarks', '2016-05-09 16:29:03'),
(353, 18, 'Out Shift', 'remarks', '2016-05-09 16:29:10'),
(354, 3, 'Out Shift', 'remarks', '2016-05-10 17:05:47'),
(355, 1, 'In Shift', 'remarks', '2016-05-10 17:05:51'),
(356, 1, 'Out Shift', 'remarks', '2016-05-10 06:03:23'),
(357, 20, 'In Shift', 'remarks', '2016-05-10 06:03:26'),
(358, 20, 'Out Shift', 'remarks', '2016-05-10 06:03:44'),
(359, 1, 'In Shift', 'remarks', '2016-05-10 06:03:53'),
(360, 1, 'Out Shift', 'remarks', '2016-05-10 06:29:19'),
(361, 3, 'In Shift', 'remarks', '2016-05-10 06:29:25'),
(362, 18, 'In Shift', 'remarks', '2016-05-10 06:31:04'),
(363, 18, 'Out Shift', 'remarks', '2016-05-10 06:31:10'),
(364, 3, 'Out Shift', 'remarks', '2016-05-10 11:40:11'),
(365, 3, 'In Shift', 'remarks', '2016-05-10 11:41:10'),
(366, 2, 'Out Shift', 'remarks', '2016-05-10 11:41:15'),
(367, 3, 'Out Shift', 'remarks', '2016-05-10 09:00:54'),
(368, 3, 'In Shift', 'remarks', '2016-05-10 09:06:48'),
(369, 2, 'In Shift', 'remarks', '2016-05-10 09:07:28'),
(370, 3, 'Out Shift', 'remarks', '2016-05-10 09:31:39'),
(371, 3, 'In Shift', 'remarks', '2016-05-10 09:33:56'),
(372, 2, 'Out Shift', 'remarks', '2016-05-10 09:34:59'),
(373, 3, 'Out Shift', 'remarks', '2016-05-10 11:07:46'),
(374, 2, 'In Shift', 'remarks', '2016-05-10 11:19:26'),
(375, 2, 'Out Shift', 'remarks', '2016-05-10 11:20:46'),
(376, 3, 'In Shift', 'remarks', '2016-05-10 11:51:42'),
(377, 2, 'In Shift', 'remarks', '2016-05-10 11:51:57'),
(378, 2, 'Out Shift', 'remarks', '2016-05-10 11:53:46'),
(379, 3, 'Out Shift', 'remarks', '2016-05-10 11:53:56'),
(380, 4, 'In Shift', 'remarks', '2016-05-10 11:56:29'),
(381, 4, 'Out Shift', 'remarks', '2016-05-10 11:56:52'),
(382, 3, 'In Shift', 'remarks', '2016-05-10 12:18:20'),
(383, 2, 'In Shift', 'remarks', '2016-05-10 12:18:32'),
(384, 2, 'Out Shift', 'remarks', '2016-05-10 12:25:27'),
(385, 3, 'Out Shift', 'remarks', '2016-05-10 12:25:43'),
(386, 3, 'In Shift', 'remarks', '2016-05-10 12:37:34'),
(387, 2, 'In Shift', 'remarks', '2016-05-10 12:37:42'),
(388, 2, 'Out Shift', 'remarks', '2016-05-10 12:44:31'),
(389, 3, 'Out Shift', 'remarks', '2016-05-10 13:33:44'),
(390, 4, 'In Shift', 'remarks', '2016-05-10 13:37:25'),
(391, 3, 'In Shift', 'remarks', '2016-05-10 13:37:44'),
(392, 2, 'In Shift', 'remarks', '2016-05-10 13:37:49'),
(393, 2, 'Out Shift', 'remarks', '2016-05-10 13:42:31'),
(394, 3, 'Out Shift', 'remarks', '2016-05-10 13:42:40'),
(395, 3, 'In Shift', 'remarks', '2016-05-10 13:44:47'),
(396, 2, 'In Shift', 'remarks', '2016-05-11 10:47:28'),
(397, 2, 'Out Shift', 'remarks', '2016-05-11 11:01:17'),
(398, 2, 'In Shift', 'remarks', '2016-05-11 11:01:34'),
(399, 3, 'Out Shift', 'remarks', '2016-05-11 11:01:40'),
(400, 3, 'In Shift', 'remarks', '2016-05-11 11:01:52'),
(401, 2, 'Out Shift', 'remarks', '2016-05-11 14:26:19'),
(402, 3, 'Out Shift', 'remarks', '2016-05-11 16:30:29'),
(403, 3, 'In Shift', 'remarks', '2016-05-11 16:32:40'),
(404, 2, 'In Shift', 'remarks', '2016-05-11 16:32:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcompanies`
--
ALTER TABLE `tblcompanies`
  ADD PRIMARY KEY (`companyID`);

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
-- AUTO_INCREMENT for table `tblcompanies`
--
ALTER TABLE `tblcompanies`
  MODIFY `companyID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `activityLogNumber` bigint(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=405;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
