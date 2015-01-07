-- MySQL dump 10.9
--
-- Host: localhost    Database: materialsDB
-- ------------------------------------------------------
-- Server version	4.1.18-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
`id` int(20) unsigned NOT NULL auto_increment,
`material_name` varchar(50) NOT NULL default '',
`userID` int(10) unsigned NOT NULL default '0',
`mat_private` int(1) NOT NULL default '0',
`description` text,
`mat_type` int(20) unsigned NOT NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKmaterial` (`mat_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Carbon',1,0,'Carbon is the chemical element with symbol C and atomic number 6. As a member of group 14 on the periodic table, it is nonmetallic and tetravalent—making four electrons available to form covalent chemical bonds',2,'2006-04-25 19:56:05',0),(2,'Aluminum',2,0,'Pure aluminum is light, nontoxic, nonmagnetic and nonsparking. It can be easily formed, machined and cast. This silvery-white metal has a high thermal conductivity and has excellent corrosion resistance. Aluminum is the most abundant metal in the earth\'s crust. It ranks second among metals in the scale of malleability and sixth in ductility. [Alfa Aesar]',1,'2006-04-25 19:56:05',0),(3,'Beryllium',2,0,'Beryllium,steel-gray in color, is the lightest structural metal and has one of the highest melting points of the light metals. At ordinary temperatures, beryllium resists oxidation in air. The element is resistant to concentrated nitric acid, is nonmagnetic, and offers excellent thermal conductivity. The beryllium fabrication process is usually by powder metallurgy, due to the metals poor ductility. [Alfa Aesar]',1,'2006-04-25 19:56:14',0),(4,'Copper',2,0,'Copper is a reddish, lustrous, ductile, malleable metal. It is second only to silver in electrical conductivity and is also a good conductor of heat. Copper is one of the earliest known materials and is believed to have been mined for over 5000 years. Though it occasionally occurs native, copper id s found in other minerals including cuprite, malachite, and chalcopyrite.  [Alfa Aesar]',1,'2006-04-25 20:16:24',0),(5,'Iron',2,0,'One of the most abundant metals in the earth\'s crust, it is believed that iron makes up all but a very small percentage of the earth\'s core. It is a silvery-white, malleable metal that is highly reactive chemically. Iron rapidly corrodes at high temperatures or in moist air. Rarely found in its pure form, iron is hard, brittle, fusible, and often used to produce alloys with carbon and other metals. It is the main component in steel.[Alfa Aesar]',1,'2006-04-25 20:24:04',0);
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `boiling_point`
--

DROP TABLE IF EXISTS `boiling_point`;
CREATE TABLE `boiling_point` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned  NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKboiling_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `boiling_point`
--

LOCK TABLES `boiling_point` WRITE;
/*!40000 ALTER TABLE `boiling_point` DISABLE KEYS */;
INSERT INTO `boiling_point` VALUES (1,'2519',1,'2006-04-25 20:07:23',0),(2,'2471',2,'2006-04-25 20:08:52',0),(3,'2562',3,'2006-04-25 20:17:55',0),(4,'2861',4,'2006-04-25 20:25:28',0),(5,'2862',5,'2014-06-17 20:25:28',0);
/*!40000 ALTER TABLE `boiling_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `density`
--

DROP TABLE IF EXISTS `density`;
CREATE TABLE `density` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKdensity` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `density`
--

LOCK TABLES `density` WRITE;
/*!40000 ALTER TABLE `density` DISABLE KEYS */;
INSERT INTO `density` VALUES (1,'2.7',1,'2006-04-25 20:07:37',0),(2,'1.848',2,'2006-04-25 20:09:08',0),(3,'8.94',3,'2006-04-25 20:17:55',0),(4,'8.96',4,'2006-04-25 20:25:28',0),(5,'7.87',5,'2014-06-16 20:25:28',0);
/*!40000 ALTER TABLE `density` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `melting_point`
--

DROP TABLE IF EXISTS `melting_point`;
CREATE TABLE `melting_point` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKmelting_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `melting_point`
--

LOCK TABLES `melting_point` WRITE;
/*!40000 ALTER TABLE `melting_point` DISABLE KEYS */;
INSERT INTO `melting_point` VALUES (1,'660.4',1,'2006-04-25 20:07:13',0),(2,'1287',2,'2006-04-25 20:08:41',0),(3,'1083',3,'2006-04-25 20:17:55',0),(4,'1085',4,'2006-04-25 20:25:28',0),(5,'1538',5,'2006-04-25 20:25:28',0);
/*!40000 ALTER TABLE `melting_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specific_heat`
--

DROP TABLE IF EXISTS `specific_heat`;
CREATE TABLE `specific_heat` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKspecific_heat` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `specific_heat`
--

LOCK TABLES `specific_heat` WRITE;
/*!40000 ALTER TABLE `specific_heat` DISABLE KEYS */;
INSERT INTO `specific_heat` VALUES (1,'0.215',1,'2006-04-25 20:08:00',0),(2,'0.45',2,'2006-04-25 20:09:40',0),(3,'0.0918',3,'2006-04-25 20:17:55',0),(4,'0.12',4,'2006-04-25 20:25:28',0),(5,'0.15',5,'2014-06-15 20:25:28',0);
/*!40000 ALTER TABLE `specific_heat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tensile_strength`
--

DROP TABLE IF EXISTS `tensile_strength`;
CREATE TABLE `tensile_strength` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKtensile_strength` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tensile_strength`
--

LOCK TABLES `tensile_strength` WRITE;
/*!40000 ALTER TABLE `tensile_strength` DISABLE KEYS */;
INSERT INTO `tensile_strength` VALUES (1,'30000',1,'2006-04-25 20:08:11',0),(2,'35000',2,'2006-04-25 20:25:28',0),(3,'30000',3,'2006-04-25 20:17:55',0),(4,'25000',4,'2014-06-15 20:25:28',0),(5,'78300',5,'2006-04-25 20:25:28',0);
/*!40000 ALTER TABLE `tensile_strength` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trait_type`
--

DROP TABLE IF EXISTS `trait_type`;
CREATE TABLE `trait_type` (
`id` int(20) unsigned NOT NULL auto_increment,
`type` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trait_type`
--

LOCK TABLES `trait_type` WRITE;
/*!40000 ALTER TABLE `trait_type` DISABLE KEYS */;
INSERT INTO `trait_type` VALUES (0,'Miscellaneous','2014-06-12 14:41:40',0),(1,'Mechanical','2014-06-12 14:41:40',0),(2,'Optical','2006-04-26 14:21:33',0),(3,'Physical','2006-04-26 15:21:33',0);
/*!40000 ALTER TABLE `trait_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_type`
--

DROP TABLE IF EXISTS `material_type`;
CREATE TABLE `material_type` (
`id` int(20) unsigned NOT NULL auto_increment,
`mtype` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `material_type`
--

LOCK TABLES `material_type` WRITE;
/*!40000 ALTER TABLE `material_type` DISABLE KEYS */;
INSERT INTO `material_type` VALUES (1,'Metal','2014-06-14 14:41:40',0),(2,'Non-metal','2014-06-14 14:21:33',0),(3,'Fluid','2014-06-14 15:21:33',0),(4,'Plastic','2014-06-14 16:21:33',0);
/*!40000 ALTER TABLE `material_type` ENABLE KEYS */;
UNLOCK TABLES;




--
-- Table structure for table `trait_table`
--

DROP TABLE IF EXISTS `trait_table`;
CREATE TABLE `trait_table` (
`id` int(20) unsigned NOT NULL auto_increment,
`trait_name` varchar(50) default NULL,
`userID` int NULL default '0',
`t_type` int(20) unsigned default '0',
`u_type` int(20) unsigned default '0',
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKtrait_table_t` (`t_type`),
KEY `FKtrait_table_u` (`u_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trait_table`
--

LOCK TABLES `trait_table` WRITE;
/*!40000 ALTER TABLE `trait_table` DISABLE KEYS */;
INSERT INTO `trait_table` VALUES (1,'boiling_point',1,3,2,'2006-04-25 20:24:04',0),(2,'density',2,3,1,'2006-04-25 20:24:04',0),(3,'melting_point',3,3,2,'2006-04-25 20:24:04',0),(4,'specific_heat',4,3,4,'2006-04-25 20:24:04',0),(5,'tensile_strength',5,1,5,'2006-04-25 20:24:04',0);
/*!40000 ALTER TABLE `trait_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trait_units`
--

DROP TABLE IF EXISTS `trait_units`;
CREATE TABLE `trait_units` (
`id` int(20) unsigned NOT NULL auto_increment,
`units` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trait_units`
--

LOCK TABLES `trait_units` WRITE;
/*!40000 ALTER TABLE `trait_units` DISABLE KEYS */;
INSERT INTO `trait_units` VALUES (1,'g/cm^3','2014-06-12 14:41:40'),(2,'C','2014-06-12 14:41:40'),(3,'N','2006-04-26 14:21:33'),(4,'cal/g C','2006-04-26 15:21:33'),(5,'psi','2014-06-12 14:41:40');
/*!40000 ALTER TABLE `trait_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boiling_point`
--
/*ALTER TABLE `boiling_point`
ADD CONSTRAINT `FK_material` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`);*/
ALTER TABLE `density`
ADD CONSTRAINT `FKdensity` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE `melting_point`
ADD CONSTRAINT `FKmelting_point` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE `specific_heat`
ADD CONSTRAINT `FKspecific_heat` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE `tensile_strength`
ADD CONSTRAINT `FKtensile_strength` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE `boiling_point`
ADD CONSTRAINT `FKboiling_point` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE `material`
ADD CONSTRAINT `FKmaterial` FOREIGN KEY (`mat_type`) REFERENCES `material_type` (`id`) ON DELETE CASCADE;
ALTER TABLE `trait_table`
ADD CONSTRAINT `FKtrait_table_t` FOREIGN KEY (`t_type`) REFERENCES `trait_type` (`id`) ON DELETE CASCADE;
ALTER TABLE `trait_table`
ADD CONSTRAINT `FKtrait_table_u` FOREIGN KEY (`u_type`) REFERENCES `trait_units` (`id`) ON DELETE CASCADE;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

