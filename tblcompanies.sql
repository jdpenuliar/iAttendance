-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2016 at 06:14 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcompanies`
--
ALTER TABLE `tblcompanies`
  ADD PRIMARY KEY (`companyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcompanies`
--
ALTER TABLE `tblcompanies`
  MODIFY `companyID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
