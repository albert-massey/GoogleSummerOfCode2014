<?php
/*    S P E C I A L M A T E R I A L S _ D A T A B A S E . P H P
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
/** @file materials_database/Specialmaterials_database.php
 *
 */

class Specialmaterials_database extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database');
    }
    public function execute($sub)
    {
	global $array;
	global $count;
	global $wgStylePath;
	$name = $this->getUser()->getId();
	$dbr = wfGetDB(DB_SLAVE);
	$dbw = wfGetDB(DB_MASTER);
	$this->getOutput()->setPageTitle('Materials Database Extension');
	if ($this->getUser()->isLoggedIn()) {


	    /** This code makes the navigation bar at the top */
	    include("navigation.php");
	  
	    /** This code used for create  data entering form */
	    $this->getOutput()->setPageTitle('Add New Material');
	    $this->getOutput()->addHTML("
		<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database' method='post'>
		    <table>
			<tr>
			    <td>Material Name</td><td><input required type='text' title='Example: Carbon' name='t1'></td>
			</tr>
			<tr>
			    <td>Material Privacy</td><td><input required type='radio' name='t3' value='1' checked>Public &nbsp;<input required type='radio' name='t3' value='0'>Private</td>
			</tr>
			<tr>
			    <td>Material Description</td><td><textarea required rows='6' cols='30' name='t4'></textarea></td>
			</tr>
			<tr>
			    <td>Material Type</td>
			    <td>
			    <select name='t5'>
				<option value='1'>Metal</option>
				<option value='2'>Non-metal</option>
				<option value='3'>Fluid</option>
				<option value='4'>Plastic</option>
			    </select>
			    </td>
			</tr>
		    </table>");
	    $this->getOutput()->addHTML("<h4>Enter the values in <i>SI</i> units</h4>");

	    /** This code is used for inserting the data in database */
	    $res1 = $dbr->select('material',array('max(id)'),"",__METHOD__);
	    $id = 0;
	    foreach ($res1 as $f) {
		foreach ($f as $t) {
		    $id = $t; /** get maximum value of ID */
		}
		$new_id = $id + 1;
	    }
	    $qry = $dbr->select('trait_table',array('count(id)'),"",__METHOD__);
	    $limit = 0;
	    foreach ($qry as $count) {
		foreach ($count as $g) {
		    $limit = $g - 1;
		}
	    }
	    $res2 = $dbr->select('material',array('material_name'),"",__METHOD__);
	    $g = 0;
	    foreach ($res2 as $samedata) {
		$array[$g] = $samedata->material_name;
		$g++;
	    }
	    if (isset($_POST['add'])) {
		$r = array('id'=>0,
		'material_name'=>ucwords(strtolower($_POST['t1'])),
		'userID'=>$name,
		'mat_private'=>$_POST['t3'],
		'description'=>$_POST['t4'],
		'mat_type'=>$_POST['t5']);
		$ucwords = ucwords($_POST['t1']);
		if (in_array($ucwords,$array)) {
		    $this->getOutput()->addHTML("<h4 style='color:#FF0000'>Material already exists</h4>");
		}
		else {
		    /** inserting the values in database */    
		    $res = $dbr->insert('material',$r,__METHOD__);
		    $this->getOutput()->addHTML("<h4 style='color:#00FF00'>Data is inserted</h4>");
		    $res1 = $dbr->select('material',array('max(id)'),"",__METHOD__);
		    $id = 0;
		    foreach ($res1 as $f) {
			foreach ($f as $t) {
			    $id = $t; /** get maximum value of ID */
			}
		    }
		    /** 
		     * Iterating for loop for all traits which
		     * have corresponding values in their text-
		     * fields.
		     */  
		    for ($i = 0; $i <= $limit; $i++) {
			if ($_POST['d'.$i] != NULL) {
			    $data = array('value'=>$_POST['d'.$i],'mat_id'=>$id,);
			    $res3 = $dbr->insert($_POST[$i],$data,__METHOD__);
			}
		    }
		}
	    }

	    /** 
	     * The following code fetches traits from database
	     * and displays them for adding values for a new
	     * material. 
	     */
	    $res = $dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
	    $v = 0;
	    $this->getOutput()->addHTML("<table>");
	    foreach ($res as $data) {
		$this->getOutput()->addHTML("
		    <tr><input type='hidden' value='".$data->trait_name."' name='".$v."'><td>".ucwords(str_ireplace("_", " ", $data->trait_name))."</td><td><input type='text' name='d".$v."' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887'  placeholder='Enter the value of ".$data->trait_name."'></td>
		    </tr>");
		$v++;
	    }
	    /** Submit the values to insert into database. */
	    $this->getOutput()->addHTML("<tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form>");
	}
	else {
	    if (isset($_POST['t1'])) {
		$res3 = $dbr->select('material',array('mat_type,id'),"material_name='".$_POST['t1']."'",__METHOD__);
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

		for ($i = 0; $i < sizeof($array); $i++) {
		    $res = $dbr->select(
		    array('material',$array[$i]),
		    array('material_name','value',"{$dbr->tableName($array[$i])}.timestamp"),
		    array("mat_id='".$r[1]."'"),__METHOD__,array(),array($array[$i] => array('INNER JOIN', array("{$dbr->tableName('material')}.id='".$r[1]."'"))));
		    $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th></tr>");
		    foreach ($res as $row) {
			$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td></tr>");
		    }
		    $this->getOutput()->addHTML("</table><br>");
		}
	    }
	    else {
		$this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMaterials+database'>Login</a> to continue</h3>");
	    }
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
