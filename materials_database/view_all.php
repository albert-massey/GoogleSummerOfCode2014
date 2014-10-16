<?php
/*                     V I E W _ A L L . P H P
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
/** @file materials_database/view_all.php
 *
 */

class Specialmaterials_database_viewall extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_viewall');
    }
    public function execute($sub)
    {
	global $wgStylePath;    
	$dbr = wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle('View all Materials');
	$dbw = wfGetDB(DB_MASTER);
	/** This code makes the navigation bar at the top */
	include("navigation.php");
	$res2 = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
        $g = 0;
        foreach ($res2 as $samedata) {
            $array[$g] = $samedata->trait_name;
            $count = $g + 1;
            $g++;
        }
        for ($i = 0; $i < $count; $i++) {
            $res = $dbr->select(
		array('material',$array[$i]),
		array('material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tableName( $array[$i]) }.status" ),
		array('mat_id>0'),__METHOD__,
		array(),
		array($array[$i] => array('INNER JOIN', array("{$dbr->tableName('material')}.id=mat_id"))));
	    $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th></tr>");
	    foreach ($res as $row) {
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");
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
