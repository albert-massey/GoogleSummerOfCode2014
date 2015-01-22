<?php
/*                   E X P O R T C S V . P H P
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
/** @file materials_database/exportcsv.php
 *
 */
class Specialmaterials_database_exportcsv extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_exportcsv');
    }
    public function execute($sub)
    {
	global $wgDBprefix;
	$name = $this->getUser()->getId();
	if ($this->getUser()->isLoggedIn()) {
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Export in CSV');
	    $dbw = wfGetDB(DB_MASTER);

	    /** Database Connection */
	    $host = "localhost";
	    $uname = "root";
	    $pass = "batman";
	    $database = "mikiwikidb";
	    $connection = mysqli_connect($host, $uname, $pass, $database); 
	    echo mysql_error();

	    /** Fetch Record from Database */
	    $output = "";
	    $table = "density"; // Enter Your Table Name
	    $sql = mysqli_query($connection,"select * from $table");
	    $columns_total = mysqli_num_fields($sql);

	    /** Get The Field Name */
	    for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysqli_fetch_field($sql, $i);
		$output .= '"'.$heading.'",';
	    }
	    $output .= "\n";

	    /** Get Records from the table */
	    while ($row = mysqli_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
		    $output .= '"'.$row["$i"].'",';
		}
		$output .= "\n";
	    }

	    /** Download the file */
	    $filename = "myFile.csv";
	    header('Content-type: application/csv');
	    header('Content-Disposition: attachment; filename='.$filename);
	    echo $output;
	    exit;

	    /** This code makes the navigation bar at the top */
	    include("navigation.php");
	    $res2 = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	    $g = 0;
	    foreach ($res2 as $samedata) {
		$array[$g] = $samedata->trait_name;
		$count = $g + 1;
		$g++;
	    }
	    for ($i = 0; $i < $count; $i++ ) {
		$res = $dbr->select(
		array('material',$array[$i]),
		array('material_name','value',"{$dbr->tableName( $array[$i] )}.mat_id","{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tableName($array[$i])}.status" ),
		array('mat_id>0'),__METHOD__,array(),
		array($array[$i] => array('INNER JOIN', array("{$dbr->tableName( 'material' )}.id=mat_id"))));
		$this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links method='post'><table border='1' width='600' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th><th>Check to Approve</th></tr><br>");
                foreach ($res as $row) {
		    $this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."<td><input type='checkbox' name='" .$array[$i].$row->mat_id."' value='".$row->mat_id."'></td></tr>");
		    $dbr->tableName( $array[$i] ).$row->mat_id;
		    if (isset($_POST[$array[$i].$row->mat_id])) {
			$dbw->query(" UPDATE ".$wgDBprefix.$array[$i]." 
			SET status='1'
			WHERE mat_id='".$_POST[$array[$i].$row->mat_id]."'  ");
			$page = $_SERVER['PHP_SELF'];
			header("refresh: 0; url=$page");
		    }
		}
	    }
	    if (isset($_POST['approve'])) {       
		$dbr->tableName( $array[$i] ).$row->mat_id;
		$dbw->query(" UPDATE ".$wgDBprefix.$array[$i]."
		SET status='1'
		WHERE mat_id='".$_POST[$dbr->tableName( $array[$i] ).$row->mat_id]."'  ");
	    }
	    $this->getOutput()->addHTML("</table><br>");
	    $this->getOutput()->addHTML("<input type=submit value=approve></form><br>");
	    $this->getOutput()->addHTML("<head>");
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
