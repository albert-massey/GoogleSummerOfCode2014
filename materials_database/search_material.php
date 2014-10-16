<?php
/*              S E A R C H _ M A T E R I A L . P H P
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
/** @file materials_database/search_material.php
 *
 */
class Specialmaterials_database_searchm extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_searchm');
    }
    public function execute($sub)
    {    
	global $wgStylePath;
	$dbr = wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle('Search by Material');
	$dbw = wfGetDB(DB_MASTER);

	/** This code makes the navigation bar at the top */
	include("navigation.php");
	$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm' method='post'><table>");
	$this->getOutput()->addHTML("<tr><td>Select Trait to delete</td><td><select required name='materialdel'>");
	$matdel = $dbr->select('material',array('material_name'),"",__METHOD__);
	foreach ($matdel as $utype) {
	    $this->getOutput()->addHTML("<option  value=".$utype->material_name.">".$utype->material_name."</option>");
	}
	$this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Search' name='searchm' ></td></tr></table></form>");
	if (isset($_POST['searchm'])) {
	    $res3 = $dbr->select('material',array('mat_type,id'),"material_name='".$_POST['materialdel']."'",__METHOD__);
	    foreach ($res3 as $d) {
		$r[0] = $d->mat_type;
		$r[1] = $d->id;
	    }
	    $res2 = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	    $g = 0;
	    foreach ($res2 as $samedata) {
		$array[$g] = $samedata->trait_name;
		$g++;
	    }
	    for ($i = 0; $i < sizeof($array); $i++ ) {
	    $res = $dbr->select(
		array('material',$array[$i]),
		array('material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tablename($array[$i])}.status" ),
		array("mat_id='".$r[1]."'"),__METHOD__,
		array(),
		array($array[$i] => array('INNER JOIN', array("{$dbr->tableName('material')}.id='".$r[1]."'")))
	    );
	    $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th></tr>");
	    foreach ($res as $row) {
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");
	    }
	    $this->getOutput()->addHTML("</table><br>");}
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
