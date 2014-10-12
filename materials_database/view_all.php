<?php
class Specialmaterials_database_viewall extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_viewall');
    }
    public function execute($sub)
    {
	$dbr = wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle('View all Materials');
	$dbw = wfGetDB(DB_MASTER);
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
	//   echo $this->getUser()->getId();
	$user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	$i = 0;
	foreach ($user_group as $ug_group) {
	    $array_ug[$i] = $ug_group->ug_group;
	    $i++;
	}
    	//echo $user_group->numRows();
	if($user_group->numRows()==!0) {
	    $this->getOutput()->addHTML("
		<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/moderator1.svg' title='I am ADMIN' alt='Smiley' width='43' height='43'>
		</a>");
	}
	$this->getOutput()->addHTML("</nav><br> ");	 
	$res2 = $dbr->select('trait_table',array('trait_name'),"",__METHOD__);
        //echo $count = count($);
        $g = 0;
        foreach ($res2 as $samedata) {
            $array[$g] = $samedata->trait_name;
            $count = $g + 1;
            $g++;
        }
        for ($i = 0; $i < $count; $i++ ) {
            $res = $dbr->select(
		array( 'material',$array[$i]),
		array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tableName( $array[$i]) }.status" ),
		array('mat_id>0'),__METHOD__,
		array(),
		array( $array[$i] => array( 'INNER JOIN', array("{$dbr->tableName( 'material' )}.id=mat_id" ) ) ));
	    $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th></tr>");
	    foreach ($res as $row) {
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");
	    }
	    $this->getOutput()->addHTML("</table><br>");
	}
    }
}


