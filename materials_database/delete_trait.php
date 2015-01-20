<?php
/*                D E L E T E  _ T R A I T . P H P
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
/** @file materials_database/delete_trait.php
 *
 */
class Specialmaterials_database_del extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_del');
    }
    public function execute($sub)
    {
	$name = $this->getUser()->getId();
	if ($this->getUser()->isLoggedIn()) {
	    global $array;
	    global $wgDBprefix;
	    global $wgStylePath;
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Delete Trait');
	    $dbw = wfGetDB(DB_MASTER);
	    /** This code makes the navigation bar at the top */
	    include("navigation.php");
	    if ($user_group->numRows() == 0) {
		$this->getOutput()->addHTML("<h3> Sorry! You are not privileged to delete any of the traits.</h3>");
	    }
	    elseif (count($result = array_intersect($admins,$array_ug)) !== 0) {
		$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del' method='post'><table>");
		$this->getOutput()->addHTML("<tr><td>Select Trait to delete</td><td><select required name='traitsdel'>");
		$resdel = $dbr->select('trait_table',array('trait_name'),"userID=$name",__METHOD__);
		foreach ($resdel as $utype) {
		    $this->getOutput()->addHTML("<option value=".$utype->trait_name.">".$utype->trait_name."</option>");
		}
		$this->getOutput()->addHTML("</select></td></tr><tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");
		if ($resdel->numRows() != 0) {
		    if (isset($_POST['del'])) {
			$dbw->query("DROP TABLE $wgDBprefix".$_POST['traitsdel']."");
			$dbw->query("DELETE FROM `trait_table` WHERE `trait_name` ='".$_POST['traitsdel']."'");
			$page = $_SERVER['PHP_SELF'];
			header("refresh: 0; url=$page");
		    }
		}
		else {
		    $this->getOutput()->addHTML("<h4 style='color:#FF0000'>Sorry You don't have any trait in your trait-list to delete</h4>");
		}
	    }
	}
	else {
	    $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMaterials+database'>Login</a> to DELETE data</h3>");
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
