<?php
/*                   E X P O R T X M L . P H P
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
/** @file materials_database/exportxml.php
 *
 */
class Specialmaterials_database_exportxml extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_exportxml');
    }
    public function execute($sub)
    {
	global $wgDBprefix;
	$name = $this->getUser()->getId();
	if ($this->getUser()->isLoggedIn()) {
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Export in XML');
	    $dbw = wfGetDB(DB_MASTER);

	    /** database constants */
	    $host = "localhost";
	    $uname = "root";
	    $pass = "batman";
	    $database = "mikiwikidb";

	    $connection = mysqli_connect($host,$uname,$pass,$database); 

	    echo mysqli_error($connection);

	    /** return all available tables */
	    $result_tbl = mysqli_query($connection, "SHOW TABLES FROM ".$database." WHERE Tables_in_mikiwikidb = 'wiki_density'");
	    $tables = array();
	    while ($row = mysqli_fetch_row($result_tbl)) {
		$tables[] = $row[0];
	    }
	    $sql1 = mysqli_query($connection,"SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'mikiwikidb'
	    AND TABLE_NAME = 'wiki_density'");
	    $columns = array();
	    while ($row1 = mysqli_fetch_row($sql1)) {
		$columns[] = $row1[0];
	    }
	    $output = "<?xml version=\"1.0\" ?>\n";
	    $output .= "<schema>";

	    /** iterate over each table and return the fields for each table */
	    foreach ( $tables as $table ) {
		$output .= "<table name=\"$table\">";
		$result_data = mysqli_query($connection,"SELECT * FROM ".$table);
		while ($row2 = mysqli_fetch_row($result_data)) {
		    $output .= "<table name=\"$table\">";
		    $output .= "<column name=\"$columns[0]\">\"$row2[0]\"</column>";
		    $output .= "<column name=\"$columns[1]\">\"$row2[1]\"</column>";
		    $output .= "<column name=\"$columns[2]\">\"$row2[2]\"</column>";
		    $output .= "<column name=\"$columns[3]\">\"$row2[3]\"</column>";
		    $output .= "<column name=\"$columns[4]\">\"$row2[0]\"</column>";
		    $output .= "</table>";
		}
	    }
	    $output .= "</table>";
	    $output .= "</schema>";
	    $myFile = "my.xml";
	    $fh = fopen($myFile, 'w') or die("can't open file");
	    fwrite($fh, $output);
	    fclose($fh);
	    /** tell the browser what kind of file is come in */
	    header("Content-type: text/xml");
	    /** print out XML that describes the schema */
	    echo $output;
	    $this->getOutput()->addHTML("<head>
	    <script>
		function bigImg(x)
		{
		    x.style.height='64px';
		    x.style.width='64px';
		}

		function normalImg(x)
		{
		    x.style.height='32px';
		    x.style.width='32px';
		}
	    </script>");
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
