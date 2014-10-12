<?php
class Specialmaterials_database_update extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_update');
    }
    public function execute($sub)
    {
	global $wgDBprefix;
	$name = $this->getUser()->getId();
	$dbr = wfGetDB(DB_SLAVE);
	$dbw = wfGetDB(DB_MASTER);
	$this->getOutput()->setPageTitle('Materials Database Extension');
	if ($this->getUser()->isLoggedIn()) {
	    /** This code makes the menu bar at the top of each page */
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
	    $admins=array('bureaucrat','sysop');
	    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	    $i = 0;
	    foreach ($user_group as $ug_group) {
		$array_ug[$i] = $ug_group->ug_group;
		$i++;
	    }
	    if ($user_group->numRows() ==! 0) {
		$this->getOutput()->addHTML("
		    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/moderator1.svg' title='I am ADMIN' alt='Smiley' width='43' height='43'>
		    </a>");
	    }
	    $this->getOutput()->addHTML("</nav><br> ");	 

	    /** This code used for create  data entering form */
	    $this->getOutput()->setPageTitle('Update Material');
	    /** This code is useat that time when any user have insert these values means to which user have userID in material table */

	    /** This code is for all users. Any user can edit. */
	    $mat_update = $dbr->select('material',array('material_name','id'),"",__METHOD__);
	    $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_update' method='post'><table><tr><td>Material Name</td><td><select required title='Example: Carbon' name='mat_id'><option selected value=''></option>");
	    foreach ($mat_update as $mat_name) {
		$this->getOutput()->addHTML("<option value='".$mat_name->id."'>".$mat_name->material_name."</option>");
	    }
	    $this->getOutput()->addHTML("</select></td></tr><!--<tr><td>Trait Name</td><td><input required type='text' name='t2'></td></tr><tr><td>Value</td><td><input required type='text' name='t3'></td></tr>--><tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form><br/>");
	    if (isset($_POST['mat_update'])) {
		echo $wgDBprefix.'material';
		$dbw->query("UPDATE ".$wgDBprefix.'material'." SET material_name='".$_POST['up_material']."',mat_private='".$_POST['t3']."',description='".$_POST['t4']."',mat_type='".$_POST['t5']."' WHERE id='".$_POST['mat_id']."'  ");
		for ($v = 0 ; $v <= $_POST['up_counter'] ; $v++) {
		    $dbw->query("UPDATE ".$wgDBprefix.$_POST['trait'.$v]." SET value='".$_POST['values'.$v]."' WHERE mat_id='".$_POST['mat_id']."'  ");
		    $this->getOutput()->addHTML("UPDATED");
		}
	    }
	    else {
		if (isset($_POST['add'])) {
		    $mat_update = $dbr->select('material',array('material_name','id'),"",__METHOD__);
		    $up_mat = $dbr->select('material',array('id','material_name','mat_private','description','mat_type'),"id='".$_POST['mat_id']."'",__METHOD__);
		    $this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_update' method='post'>");
		    $this->getOutput()->addHTML("<input type='hidden' name='mat_id' value='".$_POST['mat_id']."' >");
		    foreach ($up_mat as $material) {
			$this->getOutput()->addHTML("<table><tr><td>Material Name</td><td><input required type='text' title='Example: Carbon' name='up_material' value='".$material>material_name."' /></tr><tr><td>Material Privacy</td><td>");
			if($material->mat_private == 1) {
			    $this->getOutput()->addHTML("<input checked required type='radio' name='t3' value='1' checked>Public &nbsp;&nbsp;&nbsp;<input required type='radio' name='t3' value='0'>Private");
			}
			else {
			    if ($material->mat_private == 0) {
				$this->getOutput()->addHTML("<input required type='radio' name='t3' value='1' checked>Public &nbsp;&nbsp;&nbsp;<input checked required type='radio' name='t3' value='0'>Private");
			    }
			}
			$this->getOutput()->addHTML("</td></tr><tr><td>Material Description</td><td><textarea rows='6' cols='30' name='t4'>$material->description</textarea></td></tr> <tr><td>Material Type</td><td><select name='t5'>");
			$mat_type = $dbr->select('material_type',array('id','mtype'),"",__METHOD__);
			foreach ($mat_type as $mtype) {
			    if ($mtype->id == $material->mat_type) {
				$this->getOutput()->addHTML("<option selected value='".$mtype->id."'>".$mtype->mtype."</option>");
			    }
			    else {
				$this->getOutput()->addHTML("<option value='".$mtype->id."'>".$mtype->mtype."</option>");
			    }
			}
			$this->getOutput()->addHTML("</select></td></tr></table>");
			$this->getOutput()->addHTML("<h4>Enter the values in <i>SI units</i></h4>");


			/** This code is for update trait tables */
			$trait_table = $dbr->select('trait_table',array('id','trait_name'),"","__METHOD__",array('ORDER BY' => 'trait_name'));
			$this->getOutput()->addHTML("<table>");
			$v = 0;
		    	foreach ($trait_table as $traits) {
			    echo $trait = $traits->trait_name;
			    $this->getOutput()->addHTML("<input type='hidden' name='trait".$v."' value='".$trait."'  >");
			    $trait_count = $dbr->select($trait,array('count(id)'),"mat_id='".$_POST['mat_id']."'",__METHOD__ );
			    $trait_value = $dbr->select($trait,array('value'),"mat_id='".$_POST['mat_id']."'",__METHOD__ );
			    foreach ($trait_count as $count) {
				foreach ($count as $counter) {
				    echo $counter."<br />";
				}	
			    }
			    foreach ($trait_value as $g) {
				foreach($g as $t_value) {
				    $t_value."<br>";
				}
			    }
			    $trait_name = ucwords(str_ireplace("_", " ", $traits->trait_name));
			    if ($counter == 0) {
				echo $this->getOutput()->addHTML("<tr><td>".$trait_name."</td><td><input type='text' name='values".$v."' value='' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887' placeholder='Enter the value of ".$trait_name."' ></td></tr>");
			    }
			    else {
				echo $this->getOutput()->addHTML("<tr><td>".$trait_name."</td><td><input type='text' name='values".$v."' value='".$t_value."' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887' placeholder='Enter the value of ".$trait_name."' ></td></tr>");
			    }
			    $this->getOutput()->addHTML("<input type='hidden' name='up_counter' value='".$v."'> ");
			    echo $v++;
			}
			$this->getOutput()->addHTML("<tr><td><input type='submit' name='mat_update' value='UPDATE'></td></tr></table></form>");
		    }
		}	    
	    }	
	}
    }
}

