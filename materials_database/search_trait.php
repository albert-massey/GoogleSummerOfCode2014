<?php
/*                 S E A R C H _ T R A I T . P H P
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
/** @file materials_database/search_trait.php
 *
 */
class Specialmaterials_database_searcht extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_searcht');
    }
    public function execute($sub)
    {
	global $wgStylePath;    
	$dbr = wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle('Search by Trait');
	$dbw = wfGetDB( DB_MASTER );

	/** This code makes the navigation bar at the top */
	include("navigation.php");
    	$this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht method='post'><table><tr><td>Search TRAIT by Name</td><td><select required name='searcht'>");
	$searcht = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	foreach ($searcht as $search1) {
	    $this->getOutput()->addHTML("<option value=".$search1->trait_name.">".$search1->trait_name."</option>");
	}
	$this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Search' name=searchtr> </td></tr></table></form>");
	if (isset($_POST['searcht'])) {
	    $res = $dbr->select(
		array('material',$_POST['searcht']),
		array('material_name','value',"{$dbr->tableName( $_POST['searcht'] )}.timestamp","{$dbr->tablename('material')}.status" ),
		array('mat_id>0'),__METHOD__,
		array(),
		array($_POST['searcht'] => array('INNER JOIN', array("{$dbr->tableName('material')}.id=mat_id"))));
	    $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $_POST['searcht']))."</th><th>Timestamp</th><th>Status</th></tr>");
	    foreach ($res as $row) {
		$this->getOutput()->addHTML("<tr><td>".ucwords(str_ireplace("_", " ", $row->material_name))."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");

	    }
	    $this->getOutput()->addHTML("</table><br>");
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
