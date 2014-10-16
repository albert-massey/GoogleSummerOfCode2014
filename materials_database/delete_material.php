<?php
/*            D E L E T E _ M A T E R I A L . P H P
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
/** @file materials_database/delete_material.php
 *
 */
class Specialmaterials_database_delm extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_delm');
    }
    public function execute($sub)
    {
	$name = $this->getUser()->getId();
	if ($this->getUser()->isLoggedIn()) {
	    global $array;
	    global $wgDBprefix;
	    global $wgStylePath;
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Delete Material');
	    $dbw = wfGetDB(DB_MASTER);
	    /** This code makes the navigation bar at the top */
	    include("navigation.php");
	    $admins = array('bureaucrat','sysop');
	    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	    $i = 0;
	    foreach ($user_group as $ug_group) {
		$array_ug[$i] = $ug_group->ug_group;
		$i++;
	    }
	    if ($user_group->numRows() == 0) {
		$this->getOutput()->addHTML("<h3> Sorry! You are not privileged to delete any of the materials.</h3>");
	    }
	    elseif (count($result=array_intersect($admins,$array_ug)) !== 0) {
		$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm' method='post'><table>");
		$this->getOutput()->addHTML("<tr><td>Select Material to delete</td><td><select required name='materialdel'>");
		$matdel = $dbr->select('material',array('material_name'),"userID=$name",__METHOD__);
		foreach ($matdel as $utype) {
		    $this->getOutput()->addHTML("<option value=".$utype->material_name.">".$utype->material_name."</option>");
		}
		$this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");
		if ($matdel->numRows() != 0) {
		    if (isset($_POST['del'])) {
			$dbw->query("DELETE FROM `wiki_material` WHERE `material_name` ='".$_POST['materialdel']."'");
			$page = $_SERVER['PHP_SELF'];
			header("refresh: 0; url=$page");
		    }
		}
		else {
		    $this->getOutput()->addHTML("<h4 style='color:#FF0000'>Sorry You don't have any material in your material-list to delete</h4>");
		}
	    }
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
