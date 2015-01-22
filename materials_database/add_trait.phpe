<?php
/*                  A D D _ T R A I T . P H P
 * BRL-CAD
 *
 * Copyright (c) 1995-2013 United States Government as represented by
 * the U.S. Army Research Laboratory.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * version 2.1 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this file; see the file named COPYING for more
 * information.
 */
/** @file materials_database/add_trait.php
 *
 */

class Specialmaterials_database_one extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_one');
    }
    public function execute($sub)
    {
	$name = $this->getUser()->getId();
	if ($this->getUser()->isLoggedIn()) {
	    global $array;
	    global $wgDBprefix;
	    global $wgStylePath;
	    $dbr = wfGetDB(DB_SLAVE);
	    $message = 'J3';
	    $this->getOutput()->setPageTitle('Materials Database Extension');
	    $this->getOutput()->setPageTitle('Add New Trait');
	    $dbw = wfGetDB(DB_MASTER);
	    /** This code makes the navigation bar at the top */
	    include("navigation.php");
	    $this->getOutput()->addWikiMsg('add_trait');
	    $res2 = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	    $g = 0;
	    foreach ($res2 as $samedata) {
		$array[$g] = $samedata->trait_name;
		$g++;
	    }
	    if (isset($_POST['addtrait'])) {
		$r = array('id'=>0,
		'trait_name'=>str_ireplace(" ", "_", strtolower($_POST['trait_name'])),
		'userID'=>$name,
		't_type'=>$_POST['trait_type'],
		'u_type'=>$_POST['units']);
		$strtolower = str_ireplace(" ", "_", strtolower($_POST['trait_name']));
		if (in_array($strtolower,$array)) {
		    $this->getOutput()->addHTML("<h4 style='color:#FF0000'>Trait already exists</h4>");
		}
		else {
		    $dbw->query("CREATE TABLE `".$wgDBprefix.$strtolower."` (
		    `id` int(20) unsigned NOT NULL auto_increment,
		    `value` varchar(64) default NULL,
		    `mat_id` int(20) unsigned NULL,
		    `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
		    `status` int(1) NOT NULL default '0',
		    PRIMARY KEY  (`id`),
		    KEY `FK".$wgDBprefix.$strtolower."` (`mat_id`)
		    ) ENGINE=innoDB DEFAULT CHARSET=latin1;
		    ");
		    $dbw->query("ALTER TABLE `".$wgDBprefix.$strtolower."`
		    ADD CONSTRAINT `FK".$wgDBprefix.$strtolower."` FOREIGN KEY (`mat_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
		    ");
		    $res = $dbr->insert('trait_table',$r,__METHOD__);
		    $this->getOutput()->addHTML("<h4 style='color:#00FF00'>Data is inserted</h4>");
		}
	    }
	    $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one' method='post'><table><tr><td>Trait Name</td><td><input required type='text' name='trait_name'></tr><tr><td>Trait Type</td><td><select required  name='trait_type'>");
	    $tarray = $dbr->select('trait_type',array('id','type'),"",__METHOD__);
	    foreach ($tarray as $ttype) {
		$this->getOutput()->addHTML("<option value= ".$ttype->id.">".$ttype->type."</option>");
	    }
	    $this->getOutput()->addHTML("</select></td></tr><tr><td>Trait Units(SI)</td><td><select required name='units'>");
	    $uarray = $dbr->select('trait_units',array('id','units'),"",__METHOD__);
	    foreach ($uarray as $utype) {
		$this->getOutput()->addHTML("<option value=".$utype->id.">".$utype->units."</option>");
	    }
	    $this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Add' name='addtrait' ></td></tr></table></form>");

	}

	else {
	    $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMaterials+database'>Login</a> to add new Data</h3>");
	}
    }
}

/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
