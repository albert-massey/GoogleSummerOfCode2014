<?php
    $this->getOutput()->addHTML("<nav>
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/add158.svg' title='Add Material' alt='Smiley' width='40' height='40'>
	</a>|
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='29' height='29'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm'><img onmouseover=onmouseover='style.color='red''onmouseout='style.color='black'' border='0' src='$wgStylePath/common/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/bin2.svg' title='Delete Trait' alt='Smiley' width='33' height='33'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'>
	</a> |
	<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export_json'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'>
	</a> | ");
    $admins=array('bureaucrat','sysop');
    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
    $i = 0;
    foreach ($user_group as $ug_group) {
	$array_ug[$i] = $ug_group->ug_group;
	$i++;
    }
    if ($user_group->numRows() ==! 0) {
	$this->getOutput()->addHTML("
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='$wgStylePath/common/images/moderator1.svg' title='I am ADMIN' alt='Smiley' width='43' height='43'>
	    </a>");
    }   
    $this->getOutput()->addHTML("</nav><br>");

/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
