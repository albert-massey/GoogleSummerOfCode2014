<?php	
	    /** Creating table boiling_point if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS `boiling_point` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned  NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKboiling_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

	    /** Creating table material if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS `material` (
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
");


	    /** Creating table density if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS `density` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKdensity` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
    

	    /** Creating table melting_point if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS `melting_point` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKmelting_point` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");


	    /** Creating table specific_heat if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS  `specific_heat` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKspecific_heat` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");


	    /** Creating table tensile-strength if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS  `tensile_strength` (
`id` int(20) unsigned NOT NULL auto_increment,
`value` decimal(20,8) default NULL,
`mat_id` int(20) unsigned NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `FKtensile_strength` (`mat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");



	    /** Creating table trait_table if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS `trait_table` (
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
");


	    /** Creating table trait_type if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS  `trait_type` (
`id` int(20) unsigned NOT NULL auto_increment,
`type` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
    

	    /** Creating table material_type if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS  `material_type` (
`id` int(20) unsigned NOT NULL auto_increment,
`mtype` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
`status` int(1) NOT NULL default '0',
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");


	    /** Creating table trait_units if does not already exist */
	    $dbw->query("CREATE TABLE IF NOT EXISTS  `trait_units` (
`id` int(20) unsigned NOT NULL auto_increment,
`units` varchar(50) default NULL,
`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
	    $dbw->query("ALTER TABLE `tensile_strength`
ADD CONSTRAINT `FKtensile_strength` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
");
	    $dbw->query("ALTER TABLE `density`
ADD CONSTRAINT `FKdensity` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
");    

	    $dbw->query("ALTER TABLE `melting_point`
ADD CONSTRAINT `FKmelting_point` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
");    
	    $dbw->query("ALTER TABLE `specific_heat`
ADD CONSTRAINT `FKspecific_heat` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
");    
	    $dbw->query("ALTER TABLE `boiling_point`
ADD CONSTRAINT `FKboiling_point` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
");    
	    $dbw->query("ALTER TABLE `material`
ADD CONSTRAINT `FKmaterial` FOREIGN KEY (`mat_type`) REFERENCES `material_type` (`id`) ON DELETE CASCADE;
");    
	    $dbw->query("ALTER TABLE `trait_table`
ADD CONSTRAINT `FKtrait_table_u` FOREIGN KEY (`u_type`) REFERENCES `trait_units` (`id`) ON DELETE CASCADE;
");    

