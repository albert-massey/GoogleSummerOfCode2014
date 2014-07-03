-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2014 at 01:06 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `materiasDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `wiki_boiling_point`
--

CREATE TABLE IF NOT EXISTS `wiki_boiling_point` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) DEFAULT NULL,
  `mat_id` int(20) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_wiki_material` (`mat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_boiling_point`
--

INSERT INTO `wiki_boiling_point` (`id`, `value`, `mat_id`, `timestamp`) VALUES
(1, '2519', 1, '2006-04-25 14:37:23'),
(2, '2471', 2, '2006-04-25 14:38:52'),
(3, '2562', 3, '2006-04-25 14:47:55'),
(4, '2861', 4, '2006-04-25 14:55:28'),
(5, '2862', 5, '2014-06-17 14:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_density`
--

CREATE TABLE IF NOT EXISTS `wiki_density` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) DEFAULT NULL,
  `mat_id` int(20) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_density` (`mat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_density`
--

INSERT INTO `wiki_density` (`id`, `value`, `mat_id`, `timestamp`) VALUES
(1, '2.7', 1, '2006-04-25 14:37:37'),
(2, '1.848', 2, '2006-04-25 14:39:08'),
(3, '8.94', 3, '2006-04-25 14:47:55'),
(4, '8.96', 4, '2006-04-25 14:55:28'),
(5, '7.87', 5, '2014-06-16 14:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_material`
--

CREATE TABLE IF NOT EXISTS `wiki_material` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `material_name` varchar(64) NOT NULL DEFAULT '',
  `userID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `mat_private` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `mat_type` tinyint(2) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_material`
--

INSERT INTO `wiki_material` (`id`, `material_name`, `userID`, `mat_private`, `description`, `mat_type`, `timestamp`) VALUES
(1, 'Carbon', 1, 0, 'Carbon is the chemical element with symbol C and atomic number 6. As a member of group 14 on the periodic table, it is nonmetallic and tetravalent—making four electrons available to form covalent chemical bonds', 2, '2006-04-25 14:26:05'),
(2, 'Aluminum', 2, 0, 'Pure aluminum is light, nontoxic, nonmagnetic and nonsparking. It can be easily formed, machined and cast. This silvery-white metal has a high thermal conductivity and has excellent corrosion resistance. Aluminum is the most abundant metal in the earth''s crust. It ranks second among metals in the scale of malleability and sixth in ductility. [Alfa Aesar]', 1, '2006-04-25 14:26:05'),
(3, 'Beryllium', 2, 0, 'Beryllium,steel-gray in color, is the lightest structural metal and has one of the highest melting points of the light metals. At ordinary temperatures, beryllium resists oxidation in air. The element is resistant to concentrated nitric acid, is nonmagnetic, and offers excellent thermal conductivity. The beryllium fabrication process is usually by powder metallurgy, due to the metals poor ductility. [Alfa Aesar]', 1, '2006-04-25 14:26:14'),
(4, 'Copper', 2, 0, 'Copper is a reddish, lustrous, ductile, malleable metal. It is second only to silver in electrical conductivity and is also a good conductor of heat. Copper is one of the earliest known materials and is believed to have been mined for over 5000 years. Though it occasionally occurs native, copper id s found in other minerals including cuprite, malachite, and chalcopyrite.  [Alfa Aesar]', 1, '2006-04-25 14:46:24'),
(5, 'Iron', 2, 0, 'One of the most abundant metals in the earth''s crust, it is believed that iron makes up all but a very small percentage of the earth''s core. It is a silvery-white, malleable metal that is highly reactive chemically. Iron rapidly corrodes at high temperatures or in moist air. Rarely found in its pure form, iron is hard, brittle, fusible, and often used to produce alloys with carbon and other metals. It is the main component in steel.[Alfa Aesar]', 1, '2006-04-25 14:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_material_type`
--

CREATE TABLE IF NOT EXISTS `wiki_material_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mtype` varchar(64) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_material_type`
--

INSERT INTO `wiki_material_type` (`id`, `mtype`, `timestamp`) VALUES
(1, 'Metal', '2014-06-14 09:11:40'),
(2, 'Non-metal', '2014-06-14 08:51:33'),
(3, 'Fluid', '2014-06-14 09:51:33'),
(4, 'Plastic', '2014-06-14 10:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_melting_point`
--

CREATE TABLE IF NOT EXISTS `wiki_melting_point` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) DEFAULT NULL,
  `mat_id` int(20) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_mp` (`mat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_melting_point`
--

INSERT INTO `wiki_melting_point` (`id`, `value`, `mat_id`, `timestamp`) VALUES
(1, '660.4', 1, '2006-04-25 14:37:13'),
(2, '1287', 2, '2006-04-25 14:38:41'),
(3, '1083', 3, '2006-04-25 14:47:55'),
(4, '1085', 4, '2006-04-25 14:55:28'),
(5, '1538', 5, '2006-04-25 14:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_specific_heat`
--

CREATE TABLE IF NOT EXISTS `wiki_specific_heat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) DEFAULT NULL,
  `temperature` varchar(64) DEFAULT NULL,
  `mat_id` int(20) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_sh` (`mat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_specific_heat`
--

INSERT INTO `wiki_specific_heat` (`id`, `value`, `temperature`, `mat_id`, `timestamp`) VALUES
(1, '0.215', '25', 1, '2006-04-25 14:38:00'),
(2, '0.45', '50', 2, '2006-04-25 14:39:40'),
(3, '0.0918', '20', 3, '2006-04-25 14:47:55'),
(4, '0.12', '100', 4, '2006-04-25 14:55:28'),
(5, '0.15', '50', 5, '2014-06-15 14:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_tensile_strength`
--

CREATE TABLE IF NOT EXISTS `wiki_tensile_strength` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) DEFAULT NULL,
  `mat_id` int(20) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_ts` (`mat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_tensile_strength`
--

INSERT INTO `wiki_tensile_strength` (`id`, `value`, `mat_id`, `timestamp`) VALUES
(1, '30000', 1, '2006-04-25 14:38:11'),
(2, '35000', 2, '2006-04-25 14:55:28'),
(3, '30000', 3, '2006-04-25 14:47:55'),
(4, '25000', 4, '2014-06-15 14:55:28'),
(5, '78300', 5, '2006-04-25 14:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_trait_table`
--

CREATE TABLE IF NOT EXISTS `wiki_trait_table` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `trait_name` varchar(64) DEFAULT NULL,
  `t_type` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_table`
--

INSERT INTO `wiki_trait_table` (`id`, `trait_name`, `t_type`, `timestamp`) VALUES
(1, 'boiling_point', 3, '2006-04-25 14:54:04'),
(2, 'density', 3, '2006-04-25 14:54:04'),
(3, 'melting_point', 3, '2006-04-25 14:54:04'),
(4, 'specific_heat', 3, '2006-04-25 14:54:04'),
(5, 'tensile_strength', 1, '2006-04-25 14:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_trait_type`
--

CREATE TABLE IF NOT EXISTS `wiki_trait_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_type`
--

INSERT INTO `wiki_trait_type` (`id`, `type`, `timestamp`) VALUES
(0, 'Miscellaneous', '2014-06-12 09:11:40'),
(1, 'Mechanical', '2014-06-12 09:11:40'),
(2, 'Optical', '2006-04-26 08:51:33'),
(3, 'Physical', '2006-04-26 09:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `wiki_trait_units`
--

CREATE TABLE IF NOT EXISTS `wiki_trait_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `units` varchar(64) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_units`
--

INSERT INTO `wiki_trait_units` (`id`, `units`, `timestamp`) VALUES
(1, 'g/cm^3', '2014-06-12 09:11:40'),
(2, 'C', '2014-06-12 09:11:40'),
(3, 'C', '2006-04-26 08:51:33'),
(4, 'cal/g C', '2006-04-26 09:51:33'),
(5, 'psi', '2014-06-12 09:11:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wiki_boiling_point`
--
ALTER TABLE `wiki_boiling_point`
  ADD CONSTRAINT `FK_wiki_material` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);

--
-- Constraints for table `wiki_density`
--
ALTER TABLE `wiki_density`
  ADD CONSTRAINT `FK_density` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);

--
-- Constraints for table `wiki_melting_point`
--
ALTER TABLE `wiki_melting_point`
  ADD CONSTRAINT `FK_mp` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);

--
-- Constraints for table `wiki_specific_heat`
--
ALTER TABLE `wiki_specific_heat`
  ADD CONSTRAINT `FK_sh` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);

--
-- Constraints for table `wiki_tensile_strength`
--
ALTER TABLE `wiki_tensile_strength`
  ADD CONSTRAINT `FK_ts` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
