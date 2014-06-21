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
-- Table structure for table `boiling_point`
--

DROP TABLE IF EXISTS `wiki_boiling_point`;
CREATE TABLE `wiki_boiling_point` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` bigint(5) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_boiling_point`
--

LOCK TABLES `wiki_boiling_point` WRITE;
/*!40000 ALTER TABLE `wiki_boiling_point` DISABLE KEYS */;
INSERT INTO `wiki_boiling_point` VALUES (1,'2519 C',1,'2006-04-25 20:07:23'),(2,'2471 C',2,'2006-04-25 20:08:52'),(3,'2562 C',3,'2006-04-25 20:17:55'),(4,'2861 C',4,'2006-04-25 20:25:28'),(5,'2862 C',5,'2014-06-17 20:25:28');
/*!40000 ALTER TABLE `wiki_boiling_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_density`
--

DROP TABLE IF EXISTS `wiki_density`;
CREATE TABLE `wiki_density` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` varchar(5) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_density`
--

LOCK TABLES `wiki_density` WRITE;
/*!40000 ALTER TABLE `wiki_density` DISABLE KEYS */;
INSERT INTO `wiki_density` VALUES (1,'2.7 g/cm^3',1,'2006-04-25 20:07:37'),(2,'1.848 g/cm^3',2,'2006-04-25 20:09:08'),(3,'8.94 g/cm^3',3,'2006-04-25 20:17:55'),(4,'8.96 g/cm^3',4,'2006-04-25 20:25:28'),(5,'7.87 g/cm^3',5,'2014-06-16 20:25:28');
/*!40000 ALTER TABLE `wiki_density` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_melting_point`
--

DROP TABLE IF EXISTS `wiki_melting_point`;
CREATE TABLE `wiki_melting_point` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int default NULL, 
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_melting_point`
--

LOCK TABLES `wiki_melting_point` WRITE;
/*!40000 ALTER TABLE `wiki_melting_point` DISABLE KEYS */;
INSERT INTO `wiki_melting_point` VALUES (1,'660.4 C',1,'2006-04-25 20:07:13'),(2,'1287 C',2,'2006-04-25 20:08:41'),(3,'1083 C',3,'2006-04-25 20:17:55'),(4,'1085 C',4,'2006-04-25 20:25:28'),(5,'1538 C',5,'2006-04-25 20:25:28');
/*!40000 ALTER TABLE `wiki_melting_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_specific_heat`
--

DROP TABLE IF EXISTS `wiki_specific_heat`;
CREATE TABLE `wiki_specific_heat` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `temperature` varchar(64) default NULL,
  `mat_id` int default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_specific_heat`
--

LOCK TABLES `wiki_specific_heat` WRITE;
/*!40000 ALTER TABLE `wiki_specific_heat` DISABLE KEYS */;
INSERT INTO `wiki_specific_heat` VALUES (1,'0.215 cal/g C','25 C',1,'2006-04-25 20:08:00'),(2,'0.45 cal/g C','50 C',2,'2006-04-25 20:09:40'),(3,'0.0918 cal/g C','20 C',3,'2006-04-25 20:17:55'),(4,'0.12 cal/g C','100 C',4,'2006-04-25 20:25:28'),(5,'0.15 cal/g C','50 C',5,'2014-06-15 20:25:28');
/*!40000 ALTER TABLE `wiki_specific_heat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_tensile_strength`
--

DROP TABLE IF EXISTS `wiki_tensile_strength`;
CREATE TABLE `wiki_tensile_strength` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_tensile_strength`
--

LOCK TABLES `wiki_tensile_strength` WRITE;
/*!40000 ALTER TABLE `wiki_tensile_strength` DISABLE KEYS */;
INSERT INTO `wiki_tensile_strength` VALUES (1,'30000 psi',1,'2006-04-25 20:08:11'),(2,'35000 psi',2,'2006-04-25 20:25:28'),(3,'30000 psi',3,'2006-04-25 20:17:55'),(4,'25000 psi',4,'2014-06-15 20:25:28'),(5,'78300 psi',5,'2006-04-25 20:25:28');
/*!40000 ALTER TABLE `wiki_tensile_strength` ENABLE KEYS */;
UNLOCK TABLES;

/*--
-- Table structure for table `UTS`
--

DROP TABLE IF EXISTS `UTS`;
CREATE TABLE `UTS` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `strain rate` varchar(64) default NULL,
  `temp` varchar(64) default NULL,
  `mat_id` int default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UTS`
--

LOCK TABLES `UTS` WRITE;
/*!40000 ALTER TABLE `UTS` DISABLE KEYS */;
/*INSERT INTO `UTS` VALUES (1,'1234',NULL,'345 C',1,'2006-04-26 14:41:40');
/*!40000 ALTER TABLE `UTS` ENABLE KEYS */;
/*UNLOCK TABLES;*/

--
-- Table structure for table `trait_type`
--

DROP TABLE IF EXISTS `wiki_trait_type`;
CREATE TABLE `wiki_trait_type` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `type` varchar(64) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

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
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `mtype` varchar(64) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_material_type`
--

LOCK TABLES `wiki_material_type` WRITE;
/*!40000 ALTER TABLE `wiki_material_type` DISABLE KEYS */;
INSERT INTO `wiki_material_type` VALUES (1,'Metal','2014-06-14 14:41:40'),(2,'Non-metal','2014-06-14 14:21:33'),(3,'Fluid','2014-06-14 15:21:33'),(4,'Plastic','2014-06-14 16:21:33');
/*!40000 ALTER TABLE `wiki_material_type` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `wiki_material`
--

DROP TABLE IF EXISTS `wiki_material`;
CREATE TABLE `wiki_material` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `material_name` varchar(64) NOT NULL default '',
  `userID` bigint(20) unsigned NOT NULL default '0',
  `mat_private` tinyint(1) NOT NULL default '0',
  `description` text,
  `mat_type` tinyint(1) NOT NULL default '0',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_material`
--

LOCK TABLES `wiki_material` WRITE;
/*!40000 ALTER TABLE `wiki_material` DISABLE KEYS */;
INSERT INTO `wiki_material` VALUES (1,'Carbon',1,0,'Carbon is the chemical element with symbol C and atomic number 6. As a member of group 14 on the periodic table, it is nonmetallic and tetravalent—making four electrons available to form covalent chemical bonds',2,'2006-04-25 19:56:05'),(2,'Aluminum',2,0,'Pure aluminum is light, nontoxic, nonmagnetic and nonsparking. It can be easily formed, machined and cast. This silvery-white metal has a high thermal conductivity and has excellent corrosion resistance. Aluminum is the most abundant metal in the earth\'s crust. It ranks second among metals in the scale of malleability and sixth in ductility. [Alfa Aesar]',1,'2006-04-25 19:56:05'),(3,'Beryllium',2,0,'Beryllium,steel-gray in color, is the lightest structural metal and has one of the highest melting points of the light metals. At ordinary temperatures, beryllium resists oxidation in air. The element is resistant to concentrated nitric acid, is nonmagnetic, and offers excellent thermal conductivity. The beryllium fabrication process is usually by powder metallurgy, due to the metals poor ductility. [Alfa Aesar]',1,'2006-04-25 19:56:14'),(4,'Copper',2,0,'Copper is a reddish, lustrous, ductile, malleable metal. It is second only to silver in electrical conductivity and is also a good conductor of heat. Copper is one of the earliest known materials and is believed to have been mined for over 5000 years. Though it occasionally occurs native, copper id s found in other minerals including cuprite, malachite, and chalcopyrite.  [Alfa Aesar]',1,'2006-04-25 20:16:24'),(5,'Iron',2,0,'One of the most abundant metals in the earth\'s crust, it is believed that iron makes up all but a very small percentage of the earth\'s core. It is a silvery-white, malleable metal that is highly reactive chemically. Iron rapidly corrodes at high temperatures or in moist air. Rarely found in its pure form, iron is hard, brittle, fusible, and often used to produce alloys with carbon and other metals. It is the main component in steel.[Alfa Aesar]',1,'2006-04-25 20:24:04');
/*!40000 ALTER TABLE `wiki_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_trait_tables`
--

DROP TABLE IF EXISTS `wiki_trait_tables`;
CREATE TABLE `wiki_trait_tables` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `table_name` varchar(64) default NULL,
   `t_type` int default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki_trait_tables`
--

LOCK TABLES `wiki_trait_tables` WRITE;
/*!40000 ALTER TABLE `wiki_trait_tables` DISABLE KEYS */;
INSERT INTO `wiki_trait_tables` VALUES (1,'boiling_point',3),(2,'density',3),(3,'melting_point',3),(4,'specific_heat',3),(5,'tensile_strength',1);
/*!40000 ALTER TABLE `wiki_trait_tables` ENABLE KEYS */;
UNLOCK TABLES;

/*--
-- Table structure for table `traits`
--

DROP TABLE IF EXISTS `traits`;
CREATE TABLE `traits` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `materialID` bigint(20) unsigned NOT NULL default '0',
  `table_name` varchar(64) NOT NULL default '',
  `table_materialID` bigint(20) unsigned NOT NULL default '0',
  `userID` bigint(20) unsigned NOT NULL default '0',
  `trait_private` tinyint(1) NOT NULL default '0',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traits`
--

LOCK TABLES `traits` WRITE;
/*!40000 ALTER TABLE `traits` DISABLE KEYS */;
/*INSERT INTO `traits` VALUES (60,10,'Density',10,2,0,'2006-04-25 20:16:28'),(51,8,'Specific Heat',8,2,0,'2006-04-25 20:13:01'),(50,8,'Density',8,2,0,'2006-04-25 20:13:01'),(49,8,'Boiling Point',8,2,0,'2006-04-25 20:13:01'),(48,8,'Melting Point',8,2,0,'2006-04-25 20:13:01'),(47,7,'Tensile Strength',7,2,0,'2006-04-25 20:13:01'),(46,7,'Specific Heat',7,2,0,'2006-04-25 20:13:01'),(45,7,'Density',7,2,0,'2006-04-25 20:13:01'),(44,7,'Boiling Point',7,2,0,'2006-04-25 20:13:01'),(43,7,'Melting Point',7,2,0,'2006-04-25 20:13:01'),(61,10,'Boiling Point',10,2,0,'2006-04-25 20:17:28'),(59,10,'Specific Heat',10,2,0,'2006-04-25 20:16:44'),(58,10,'Tensile Strength',10,2,0,'2006-04-25 20:17:44'),(62,10,'Melting Point',10,2,0,'2006-04-25 20:17:40'),(63,11,'Density',11,2,0,'2006-04-25 20:24:08'),(64,11,'Boiling Point',11,2,0,'2006-04-25 20:24:12'),(65,11,'Specific Heat',11,2,0,'2006-04-25 20:24:10'),(66,11,'Tensile Strength',11,2,0,'2006-04-25 20:24:16'),(67,11,'Melting Point',11,2,0,'2006-04-25 20:24:14');
/*!40000 ALTER TABLE `traits` ENABLE KEYS */;
/*UNLOCK TABLES;

--
-- Table structure for table `user`
--

/*DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `unsuccessful` tinyint(4) NOT NULL default '0',
  `locked` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `id` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/
--
-- Dumping data for table `user`
--

/*LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*INSERT INTO `user` VALUES (1,'mike','6367c48dd193d56ea7b0baad25b19455e529f5ee',0,0),(2,'mrb','7c2833cbed7562a6479717a6541c593afe74b0d8',0,0),(3,'j','5c2dd944dde9e08881bef0894fe7b22a5c9c4b06',0,0),(4,'sean','5d165221d9ca32fd73cf9c29eaecc139fc44be3d',0,0),(5,'test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `uid` bigint(20) unsigned NOT NULL default '0',
  `salutation` varchar(64) NOT NULL default '',
  `first` varchar(64) NOT NULL default '',
  `last` varchar(64) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  `wphone` varchar(32) NOT NULL default '',
  `site` varchar(64) NOT NULL default '',
  `building` varchar(64) NOT NULL default '',
  `room_no` varchar(64) NOT NULL default '',
  `office_name` varchar(128) NOT NULL default '',
  `office_symbol` varchar(128) NOT NULL default '',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `id` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
/*INSERT INTO `userinfo` VALUES (1,'Mr.','Mike','Tegtmeyer','mtegtmeyer@arl.army.mil','36074','ARL','238','204','SEB','SEB','2006-04-04 16:11:52'),(2,'','Material','Board','mrb@mrb.arl.army.mil','123-456-7890','ARL','','','','','0000-00-00 00:00:00'),(3,'','j','j','j','j','j','','','','','0000-00-00 00:00:00'),(4,'','Sean','Morrison','morrison@arl.mil','6678','ARL','','','','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
/*UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

