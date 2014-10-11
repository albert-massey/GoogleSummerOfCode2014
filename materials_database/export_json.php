<?php
class Specialmaterials_database_export_json extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_export_json');
    }
    public function execute($sub)
    {
	$name = $this->getUser()->getId();
	$dbr = wfGetDB(DB_SLAVE);
	$dbw = wfGetDB(DB_MASTER);
	if ($this->getUser()->isLoggedIn()) {
	/**This code makes the menu bar at the top of each page */
	$this->getOutput()->addHTML("<nav>
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/add158.svg' title='Add Material' alt='Smiley' width='40' height='40'>
	    </a>|
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='29' height='29'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm'><img onmouseover=onmouseover='style.color='red''onmouseout='style.color='black'' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bin2.svg' title='Delete Trait' alt='Smiley' width='33' height='33'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'>
	    </a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export_json'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'>
	    </a> | ");
	    $admins = array('bureaucrat','sysop');
	    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	    $i = 0;
	    foreach ($user_group as $ug_group) {
		$array_ug[$i] = $ug_group->ug_group;
		$i++;
	    }
	    if ($user_group->numRows() ==! 0) {
		$this->getOutput()->addHTML("<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/moderator1.svg' title='I am ADMIN' alt='Smiley' width='43' height='43'></a>");
	    }
	    $this->getOutput()->addHTML("</nav><br> ");	         
	    /** This code used for create  data entering form */
	    $this->getOutput()->setPageTitle('Export');
	    $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export_json' method='post'><table><tr><td>Select the trait to be exported</td><td><select required name='exportselect'>");
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
		$combine = array_combine($arraymaterial,$arrayexport);
		$export = array();
		for ($i = 0; $i < 5; $i++) {
		    $export[] = array('Material' => $arraymaterial[$i],
		    ucwords(str_ireplace("_", " ", $_POST['exportselect'])) => $arrayexport[$i]);
		}
		$json_material = json_encode($export);
		$myFile = "bp.json";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = str_ireplace("Carbon","Peter",$json_material);
		fwrite($fh, $json_material);
		fclose($fh);
		$filename = $_POST['exportselect'].".json";
		$file = "/var/www/mediawiki-1.22.7/$myFile";
		$len = filesize($file); // Calculate File Size
		ob_clean();
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public"); 
		header("Content-Description: File Transfer");
		header('Content-Type: application/octet-stream');
		/** Send File Name */
		$header = "Content-Disposition: attachment; filename=$filename"; 
		header($header );
		header("Content-Transfer-Encoding: json");
		header("Content-Length: ".$len); // Send File Size
		@readfile($file);
	    }
	    /** End of insertion code */
	    /** This code makes dynamic traits for material */
	    $res = $dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
	    $v = 0;
	}
    }
}
