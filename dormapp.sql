-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2014 at 05:49 AM
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
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Susana', 'Triunfante');

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
  `home_distance` int(11) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `landline` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `mother_name` varchar(128) NOT NULL,
  `father_name` varchar(128) NOT NULL,
  `mother_job` varchar(32) NOT NULL,
  `father_job` varchar(32) NOT NULL,
  `mother_address` varchar(255) NOT NULL,
  `father_address` varchar(255) NOT NULL,
  `mother_landline` varchar(15) NOT NULL,
  `mother_mobile` varchar(15) NOT NULL,
  `father_landline` varchar(15) NOT NULL,
  `father_mobile` varchar(15) NOT NULL,
  `guardian_name` varchar(128) NOT NULL,
  `guardian_address` varchar(255) NOT NULL,
  `guardian_relationship` varchar(64) NOT NULL,
  `guardian_landline` varchar(15) NOT NULL,
  `guardian_mobile` varchar(15) NOT NULL,
  `scholarship` varchar(128) NOT NULL,
  `stfap_bracket` varchar(1) NOT NULL,
  `family_income_annual` int(7) NOT NULL,
  `points_total` int(3) NOT NULL,
  `accept_flag` enum('Accepted','Rejected','Pending','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `received_date`, `firstname`, `lastname`, `middlename`, `student_number`, `course`, `year_level`, `units_enrolled`, `perm_address`, `home_distance`, `mail_address`, `landline`, `mobile`, `mother_name`, `father_name`, `mother_job`, `father_job`, `mother_address`, `father_address`, `mother_landline`, `mother_mobile`, `father_landline`, `father_mobile`, `guardian_name`, `guardian_address`, `guardian_relationship`, `guardian_landline`, `guardian_mobile`, `scholarship`, `stfap_bracket`, `family_income_annual`, `points_total`, `accept_flag`) VALUES
(2, '2014-12-10 12:23:20', 'Thomas', 'Revesencio', 'Middle_name', 2011, 'Course', 0, 0, 'Kalibo,aklan', 118, 'Mail_address', 'landline', 'mobile', 'Mother_name', 'Father_name', 'Mother_address', 'Father_address', 'Mother_occupation', 'Father_occupation', 'mother_landline', 'mother_mobile', 'father_landline', 'father_mobile', 'Guardian_name', 'Guardian_address', 'Relationship', 'guardian_landli', 'guardian_mobile', 'Scholarship', 'E', 1000000, 15, 'Rejected'),
(3, '2014-12-10 12:25:10', 'Dan', 'Rebuelta', 'Middle_name', 2011, 'Course', 0, 0, 'Makati,', 454, 'Mail_address', 'landline', 'mobile', 'Mother_name', 'Father_name', 'Mother_occupation', 'Father_occupation', 'Mother_address', 'Father_address', 'mother_landline', 'mother_mobile', 'father_landline', 'father_mobile', 'Guardian_name', 'Guardian_address', 'Relationship', 'guardian_landli', 'guardian_mobile', 'Scholarship', 'E', 1000000, 20, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `deadline`
--

CREATE TABLE IF NOT EXISTS `deadline` (
  `date_closed` datetime NOT NULL,
  `user` varchar(100) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `flag`) VALUES
(2, '2010-49661', '827ccb0eea8a706c4c34a16891f84e7b', 'Jamie', 'Anacleto', 0),
(3, '2011-37682', '827ccb0eea8a706c4c34a16891f84e7b', 'Mel', 'Rebuelta', 1),
(4, '2011-37400', '827ccb0eea8a706c4c34a16891f84e7b', 'Francis', 'Revesencio', 1),
(5, '2011-09669', '827ccb0eea8a706c4c34a16891f84e7b', 'Kevin', 'Ip', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
