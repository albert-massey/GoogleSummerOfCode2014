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
-- Table structure for table `wiki_material`
--

DROP TABLE IF EXISTS `wiki_material`;
CREATE TABLE `wiki_material` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `material_name` varchar(64) NOT NULL default '',
  `userID` int(20) unsigned NOT NULL default '0',
  `mat_private` tinyint(1) NOT NULL default '0',
  `description` text,
  `mat_type` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKmaterial` (`mat_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `wiki_material`
--

LOCK TABLES `wiki_material` WRITE;
/*!40000 ALTER TABLE `wiki_material` DISABLE KEYS */;
INSERT INTO `wiki_material` VALUES (1,'Carbon',1,0,'Carbon is the chemical element with symbol C and atomic number 6. As a member of group 14 on the periodic table, it is nonmetallic and tetravalent—making four electrons available to form covalent chemical bonds',2,'2006-04-25 19:56:05'),(2,'Aluminum',2,0,'Pure aluminum is light, nontoxic, nonmagnetic and nonsparking. It can be easily formed, machined and cast. This silvery-white metal has a high thermal conductivity and has excellent corrosion resistance. Aluminum is the most abundant metal in the earth\'s crust. It ranks second among metals in the scale of malleability and sixth in ductility. [Alfa Aesar]',1,'2006-04-25 19:56:05'),(3,'Beryllium',2,0,'Beryllium,steel-gray in color, is the lightest structural metal and has one of the highest melting points of the light metals. At ordinary temperatures, beryllium resists oxidation in air. The element is resistant to concentrated nitric acid, is nonmagnetic, and offers excellent thermal conductivity. The beryllium fabrication process is usually by powder metallurgy, due to the metals poor ductility. [Alfa Aesar]',1,'2006-04-25 19:56:14'),(4,'Copper',2,0,'Copper is a reddish, lustrous, ductile, malleable metal. It is second only to silver in electrical conductivity and is also a good conductor of heat. Copper is one of the earliest known materials and is believed to have been mined for over 5000 years. Though it occasionally occurs native, copper id s found in other minerals including cuprite, malachite, and chalcopyrite.  [Alfa Aesar]',1,'2006-04-25 20:16:24'),(5,'Iron',2,0,'One of the most abundant metals in the earth\'s crust, it is believed that iron makes up all but a very small percentage of the earth\'s core. It is a silvery-white, malleable metal that is highly reactive chemically. Iron rapidly corrodes at high temperatures or in moist air. Rarely found in its pure form, iron is hard, brittle, fusible, and often used to produce alloys with carbon and other metals. It is the main component in steel.[Alfa Aesar]',1,'2006-04-25 20:24:04');
/*!40000 ALTER TABLE `wiki_material` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `boiling_point`
--

DROP TABLE IF EXISTS `wiki_boiling_point`;
CREATE TABLE `wiki_boiling_point` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64)  NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKboiling_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_boiling_point`
--

LOCK TABLES `wiki_boiling_point` WRITE;
/*!40000 ALTER TABLE `wiki_boiling_point` DISABLE KEYS */;
INSERT INTO `wiki_boiling_point` VALUES (1,'2519',1,'2006-04-25 20:07:23'),(2,'2471',2,'2006-04-25 20:08:52'),(3,'2562',3,'2006-04-25 20:17:55'),(4,'2861',4,'2006-04-25 20:25:28'),(5,'2862',5,'2014-06-17 20:25:28');
/*!40000 ALTER TABLE `wiki_boiling_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_density`
--

DROP TABLE IF EXISTS `wiki_density`;
CREATE TABLE `wiki_density` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKdensity` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `wiki_density`
--

LOCK TABLES `wiki_density` WRITE;
/*!40000 ALTER TABLE `wiki_density` DISABLE KEYS */;
INSERT INTO `wiki_density` VALUES (1,'2.7',1,'2006-04-25 20:07:37'),(2,'1.848',2,'2006-04-25 20:09:08'),(3,'8.94',3,'2006-04-25 20:17:55'),(4,'8.96',4,'2006-04-25 20:25:28'),(5,'7.87',5,'2014-06-16 20:25:28');
/*!40000 ALTER TABLE `wiki_density` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_melting_point`
--

DROP TABLE IF EXISTS `wiki_melting_point`;
CREATE TABLE `wiki_melting_point` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKmelting_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_melting_point`
--

LOCK TABLES `wiki_melting_point` WRITE;
/*!40000 ALTER TABLE `wiki_melting_point` DISABLE KEYS */;
INSERT INTO `wiki_melting_point` VALUES (1,'660.4',1,'2006-04-25 20:07:13'),(2,'1287',2,'2006-04-25 20:08:41'),(3,'1083',3,'2006-04-25 20:17:55'),(4,'1085',4,'2006-04-25 20:25:28'),(5,'1538',5,'2006-04-25 20:25:28');
/*!40000 ALTER TABLE `wiki_melting_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_specific_heat`
--

DROP TABLE IF EXISTS `wiki_specific_heat`;
CREATE TABLE `wiki_specific_heat` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKspecific_heat` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_specific_heat`
--

LOCK TABLES `wiki_specific_heat` WRITE;
/*!40000 ALTER TABLE `wiki_specific_heat` DISABLE KEYS */;
INSERT INTO `wiki_specific_heat` VALUES (1,'0.215',1,'2006-04-25 20:08:00'),(2,'0.45',2,'2006-04-25 20:09:40'),(3,'0.0918',3,'2006-04-25 20:17:55'),(4,'0.12',4,'2006-04-25 20:25:28'),(5,'0.15',5,'2014-06-15 20:25:28');
/*!40000 ALTER TABLE `wiki_specific_heat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_tensile_strength`
--

DROP TABLE IF EXISTS `wiki_tensile_strength`;
CREATE TABLE `wiki_tensile_strength` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKtensile_strength` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_tensile_strength`
--

LOCK TABLES `wiki_tensile_strength` WRITE;
/*!40000 ALTER TABLE `wiki_tensile_strength` DISABLE KEYS */;
INSERT INTO `wiki_tensile_strength` VALUES (1,'30000',1,'2006-04-25 20:08:11'),(2,'35000',2,'2006-04-25 20:25:28'),(3,'30000',3,'2006-04-25 20:17:55'),(4,'25000',4,'2014-06-15 20:25:28'),(5,'78300',5,'2006-04-25 20:25:28');
/*!40000 ALTER TABLE `wiki_tensile_strength` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_trait_type`
--

DROP TABLE IF EXISTS `wiki_trait_type`;
CREATE TABLE `wiki_trait_type` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `type` varchar(64) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_type`
--

LOCK TABLES `wiki_trait_type` WRITE;
/*!40000 ALTER TABLE `wiki_trait_type` DISABLE KEYS */;
INSERT INTO `wiki_trait_type` VALUES (0,'Miscellaneous','2014-06-12 14:41:40'),(1,'Mechanical','2014-06-12 14:41:40'),(2,'Optical','2006-04-26 14:21:33'),(3,'Physical','2006-04-26 15:21:33');
/*!40000 ALTER TABLE `wiki_trait_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_material_type`
--

DROP TABLE IF EXISTS `wiki_material_type`;
CREATE TABLE `wiki_material_type` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `mtype` varchar(64) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_material_type`
--

LOCK TABLES `wiki_material_type` WRITE;
/*!40000 ALTER TABLE `wiki_material_type` DISABLE KEYS */;
INSERT INTO `wiki_material_type` VALUES (1,'Metal','2014-06-14 14:41:40'),(2,'Non-metal','2014-06-14 14:21:33'),(3,'Fluid','2014-06-14 15:21:33'),(4,'Plastic','2014-06-14 16:21:33');
/*!40000 ALTER TABLE `wiki_material_type` ENABLE KEYS */;
UNLOCK TABLES;




--
-- Table structure for table `wiki_trait_table`
--

DROP TABLE IF EXISTS `wiki_trait_table`;
CREATE TABLE `wiki_trait_table` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `trait_name` varchar(64) default NULL,
  `t_type` int(20) unsigned default '0',
  `u_type` int(20) unsigned default '0',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FKtrait_table_t` (`t_type`),
  KEY `FKtrait_table_u` (`u_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_table`
--

LOCK TABLES `wiki_trait_table` WRITE;
/*!40000 ALTER TABLE `wiki_trait_table` DISABLE KEYS */;
INSERT INTO `wiki_trait_table` VALUES (1,'boiling_point',3,2,'2006-04-25 20:24:04'),(2,'density',3,1,'2006-04-25 20:24:04'),(3,'melting_point',3,2,'2006-04-25 20:24:04'),(4,'specific_heat',3,4,'2006-04-25 20:24:04'),(5,'tensile_strength',1,5,'2006-04-25 20:24:04');
/*!40000 ALTER TABLE `wiki_trait_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_trait_units`
--

DROP TABLE IF EXISTS `wiki_trait_units`;
CREATE TABLE `wiki_trait_units` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `units` varchar(64) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wiki_trait_units`
--

LOCK TABLES `wiki_trait_units` WRITE;
/*!40000 ALTER TABLE `wiki_trait_units` DISABLE KEYS */;
INSERT INTO `wiki_trait_units` VALUES (1,'g/cm^3','2014-06-12 14:41:40'),(2,'C','2014-06-12 14:41:40'),(3,'N','2006-04-26 14:21:33'),(4,'cal/g C','2006-04-26 15:21:33'),(5,'psi','2014-06-12 14:41:40');
/*!40000 ALTER TABLE `wiki_trait_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wiki_boiling_point`
--
/*ALTER TABLE `wiki_boiling_point`
  ADD CONSTRAINT `FK_wiki_material` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);*/
ALTER TABLE `wiki_density`
  ADD CONSTRAINT `FKdensity` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);
ALTER TABLE `wiki_melting_point`
  ADD CONSTRAINT `FKmelting_point` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);
ALTER TABLE `wiki_specific_heat`
  ADD CONSTRAINT `FKspecific_heat` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);
ALTER TABLE `wiki_tensile_strength`
  ADD CONSTRAINT `FKtensile_strength` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);
ALTER TABLE `wiki_boiling_point`
  ADD CONSTRAINT `FKboiling_point` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`);
ALTER TABLE `wiki_material`
  ADD CONSTRAINT `FKmaterial` FOREIGN KEY (`mat_type`) REFERENCES `wiki_material_type` (`id`);
ALTER TABLE `wiki_trait_table`
  ADD CONSTRAINT `FKtrait_table_t` FOREIGN KEY (`t_type`) REFERENCES `wiki_trait_type` (`id`);
ALTER TABLE `wiki_trait_table`
  ADD CONSTRAINT `FKtrait_table_u` FOREIGN KEY (`u_type`) REFERENCES `wiki_trait_units` (`id`);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

