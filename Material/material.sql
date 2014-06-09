-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2014 at 02:15 PM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mikiwikidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `wiki_material`
--

CREATE TABLE IF NOT EXISTS `wiki_material` (
  `matdb_id` int(5) unsigned NOT NULL auto_increment,
  `matdb_name` varchar(15) NOT NULL,
  `matdb_bp` float(5) NOT NULL,
  `matdb_d` float(5) NOT NULL,
  `matdb_mp` float(5) NOT NULL,
  `matdb_ts` float(5) NOT NULL,
   primary key(matdb_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wiki_material`
--

INSERT INTO `wiki_material` VALUES
('0', 'mercury', '99', '5', '88', '666');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
