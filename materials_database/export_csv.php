<?php
/*                  E X P O R T _ J S O N . P H P
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
/** @file materials_database/export_csv.php
 *
 */
class Specialmaterials_database_export_csv extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_export_csv');
    }
    public function execute($sub)
    {
	global $wgStylePath;    
	$name = $this->getUser()->getId();
	$dbr = wfGetDB(DB_SLAVE);
	$dbw = wfGetDB(DB_MASTER);
	if ($this->getUser()->isLoggedIn()) {
    
	    /** This code makes the navigation bar at the top */
	    include("navigation.php");

	    /** This code used for create  data entering form */
	    $this->getOutput()->setPageTitle('Export');
	    $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export_csv' method='post'><table><tr><td>Select the trait to be exported</td><td><select required name='exportselect'>");
	    $searcht = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	    foreach ($searcht as $search1) {
		$this->getOutput()->addHTML("<option value=".$search1->trait_name.">".$search1->trait_name."</option>");
	    }
	    $this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Export' name=export> </td></tr></table></form>");
	    if (isset($_POST['export'])) {
		$this->getOutput()->disable();
		$matdel = $dbr->select('material',array('material_name'),"",__METHOD__);
		$f = 0;
		foreach ($matdel as $samedata) {
		    $arraymaterial[$f] = $samedata->material_name;
		    $f++;
		}
		$valuebp = $dbr->select($_POST['exportselect'],array('value'),"",__METHOD__);
		$h = 0;
		foreach ($valuebp as $samedata) {
		    $arrayexport[$h] = $samedata->value;
		    $h++;
		}
		$combine = array_combine($arraymaterial, $arrayexport);
		$export = array();
		for ($i = 0; $i < 5; $i++) {
		    $export[] = array('Material' => $arraymaterial[$i],
		    ucwords(str_ireplace("_", " ", $_POST['exportselect'])) => $arrayexport[$i]);
		}


		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// fetch the data
		mysql_connect('localhost', 'root', 'batman');
		mysql_select_db('my_wiki');
		$rows = mysql_query('SELECT id, value, mat_id, timestamp, status FROM boiling_point');

		// loop over the rows, outputting them
		while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
	    }
	    /** End of insertion code */
	    /** This code makes dynamic traits for material */
	    $res = $dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
	    $v = 0;
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
