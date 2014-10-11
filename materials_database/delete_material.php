<?php
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
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Delete Material');
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
	    $admins = array('bureaucrat','sysop');
        	//   echo $this->getUser()->getId();
	    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	    $i = 0;
	    foreach ($user_group as $ug_group) {
		$array_ug[$i] = $ug_group->ug_group;
		$i++;
	    }
        //echo $user_group->numRows();
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
	    $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
	}
    }
}


