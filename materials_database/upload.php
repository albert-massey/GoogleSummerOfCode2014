<?php
/*                     U P L O A D . P H P
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
/** @file materials_database/upload.php
 *
 */

class Specialmaterials_database_upload extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_upload');
    }
    public function execute($sub)
    {
	if ($this->getUser()->isLoggedIn()) {
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Upload File');
	    $dbw = wfGetDB(DB_MASTER);
	    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
	    $target_path = $dir;
	    $target_path = $target_path . basename( $_FILES['file']['name']); 
	    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['file']['name'])." has been uploaded";
	    } 
	    else {
		echo "There was an error uploading the file, please try again!";
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
