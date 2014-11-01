-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2014 at 03:03 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dormapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `received_date` datetime NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `middlename` varchar(64) NOT NULL,
  `student_number` int(9) NOT NULL,
  `course` varchar(64) NOT NULL,
  `year_level` int(1) NOT NULL,
  `units_enrolled` int(2) NOT NULL,
  `perm_address` varchar(255) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `landline` int(15) NOT NULL,
  `mobile` int(11) NOT NULL,
  `mother_name` varchar(128) NOT NULL,
  `father_name` varchar(128) NOT NULL,
  `mother_job` varchar(32) NOT NULL,
  `father_job` varchar(32) NOT NULL,
  `mother_landline` int(15) NOT NULL,
  `mother_mobile` int(11) NOT NULL,
  `father_landline` int(15) NOT NULL,
  `father_mobile` int(11) NOT NULL,
  `guardian_name` varchar(128) NOT NULL,
  `guardian_address` varchar(255) NOT NULL,
  `guardian_relationship` varchar(64) NOT NULL,
  `guardian_landline` int(15) NOT NULL,
  `guardian_mobile` int(11) NOT NULL,
  `scholarship` varchar(128) NOT NULL,
  `scholarship_coverage` varchar(128) NOT NULL,
  `stfap_bracket` varchar(1) NOT NULL,
  `family_income_annual` int(7) NOT NULL,
  `dorm_previous` varchar(64) NOT NULL,
  `reference1_name` varchar(128) NOT NULL,
  `reference1_contact` int(15) NOT NULL,
  `reference2_name` varchar(128) NOT NULL,
  `reference2_contact` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dorm', 'Manager');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
