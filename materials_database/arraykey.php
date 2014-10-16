<?php
/*                    A R R A Y K E Y . P H P
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
/** @file materials_database/arraykey.php
 *
 */
class Specialmaterials_database_export_json extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_export_json');
    }
    public function execute($sub)
    {
	$name=$this->getUser()->getId();
	$dbr=wfGetDB(DB_SLAVE);
	$dbw = wfGetDB( DB_MASTER );
	if ($this->getUser()->isLoggedIn()) {
	    /**This code makes the menu bar at the top of each page */
	    $this->getOutput()->addHTML(" <nav>
		<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/add158.svg' title='Add Material' alt='Smiley' width='32' height='32'>
		</a>|
		<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='32' height='32'>
		</a> |
		<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm'><img onmouseover=onmouseover='style.color='red'' onmouseout='style.color='black'' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'></a> |
        <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bin2.svg' title='Delete Trait' alt='Smiley' width='32' height='32'></a> |
        <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'></a> |
        <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'></a> |
        <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'></a> |
        <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'></a> |
        </nav><br>                   ");
        /** This code used for create  data entering form */
        $this->getOutput()->setPageTitle( 'Export' );
        $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export' method='post'>
        
               <table>                                                       
               <tr><td>Select the trait to be exported</td><td><select required name='exportselect'>");
               $searcht=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
               foreach($searcht as $search1){
               $this->getOutput()->addHTML("<option value=".$search1->trait_name.">".$search1->trait_name."</option>");
               }
               $this->getOutput()->addHTML("</select></td></tr>
               <tr><td><input type='submit' value='Export' name=export> </td></tr>
               </table></form>");


if(isset($_POST['export'])){
// $res3=$dbr->select('material',array('mat_type,id'),"",__METHOD__);

$this->getOutput()->disable();
//$f=0;
// foreach($res3 as $samedata){
// $array1[$f] = $samedata->mat_type;
// $f++;
// }
//echo json_encode($array1);

$matdel=$dbr->select('material',array('material_name'),"",__METHOD__);
$f=0;
foreach($matdel as $samedata){
$arraymaterial[$f] = $samedata->material_name;
$f++;
}

$valuebp=$dbr->select($_POST['exportselect'],array('value'),"",__METHOD__);
$h=0;
foreach($valuebp as $samedata){
$arrayexport[$h] = $samedata->value;
$h++;
}
//print_r($array1);
//print_r($arraybp);
$combine=array_combine($arraymaterial,$arrayexport);
//print_r($combine);
//echo json_encode($combine);


$export = array();

for($i=0;  $i<5;$i++) {
$export[] = array('Material' => $arraymaterial[$i],
ucwords(str_ireplace("_", " ", $_POST['exportselect'])) => $arrayexport[$i]);
}


$json_material= json_encode($export);
$myFile = "bp.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = str_ireplace("Carbon","Peter",$json_material);
fwrite($fh, $json_material);
fclose($fh);
/*
// We'll be outputting a PDF
header('Content-type: application/json');

 // It will be called downloaded.pdf
 header('Content-Disposition: attachment; filename="downloaded.json"');
 
 // The PDF source is in original.pdf
 readfile('bp.json');*/

$filename=$_POST['exportselect'].".json";
$file="/var/www/mediawiki-1.22.7/$myFile";
$len = filesize($file); // Calculate File Size
ob_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
header('Content-Type: application/octet-stream'); 
//header("Content-Type:application/json"); // Send type of file
$header="Content-Disposition: attachment; filename=$filename"; // Send File Name
header($header );
header("Content-Transfer-Encoding: json");
header("Content-Length: ".$len); // Send File Size
@readfile($file);

}
/** End of insertion code */
/** This code makes dynamic traits for material */
$res=$dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
$v=0;
}
}
}






/*<?php

// We'll be outputting a PDF
header('Content-type: application/json');
//
// // It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.json"');
//
// // The PDF source is in original.pdf
readfile('testFw.json');
// ?>
*/
