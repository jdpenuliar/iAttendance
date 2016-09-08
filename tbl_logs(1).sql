-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2016 at 06:17 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=latin1;

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
(400, 3, 'In Shift', 'remarks', '2016-05-11 11:01:52');

--
-- Indexes for dumped tables
--

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
  MODIFY `activityLogNumber` bigint(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=401;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
