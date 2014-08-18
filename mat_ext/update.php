<?php
class Specialmat_ext_update extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_update');
}
public function execute($sub){
global $wgOut;
global $array;
global $wgUser;
global $count;
	global $wgDBprefix;
$name=$wgUser->getId();
$dbr=wfGetDB(DB_SLAVE);
	$dbw = wfGetDB( DB_MASTER );	
$this->getOutput()->setPageTitle( 'Materials Database Extension' );
if($wgUser->isLoggedIn()){
	/**This code makes the menu bar at the top of each page */
    $this->getOutput()->addHTML("<nav>
              <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'>Add Material</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'>Add Trait</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'>Delete Material</a> |
                    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'>Delete Trait</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'>View All Materials</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'>Search by Trait</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'>Search by Material</a> |
                  <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'>Export</a> |
                    </nav><br> ");


/** This code used for create  data entering form */
$this->getOutput()->setPageTitle( 'Update Material' );

/** This code is useat that time when any user have insert these values means to which user have userID in material table */
//$mat_update = $dbr->select('material',array('material_name','id'),"userID='".$name."'",__METHOD__);

/** This code is for all users. Any user can edit. */
$mat_update = $dbr->select('material',array('material_name','id'),"",__METHOD__);

$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Mat_ext_update' method='post'>
	<table><tr><td>Material Name</td><td><select required title='Example: Carbon' name='mat_id'><option selected value=''></option>");

foreach($mat_update as $mat_name)
{
$this->getOutput()->addHTML("<option value='".$mat_name->id."'>".$mat_name->material_name."</option>");
}

$this->getOutput()->addHTML("</select></td></tr>
<!--<tr><td>Trait Name</td><td><input required type='text' name='t2'></td></tr>
<tr><td>Value</td><td><input required type='text' name='t3'></td></tr>-->
<tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form><br/>");

if(isset($_POST['mat_update']))
{
	echo $wgDBprefix.'material';
	$dbw->query("UPDATE ".$wgDBprefix.'material'." SET material_name='".$_POST['up_material']."',mat_private='".$_POST['t3']."',description='".$_POST['t4']."',mat_type='".$_POST['t5']."' WHERE id='".$_POST['mat_id']."'  ");
	for($v=0 ; $v<=$_POST['up_counter'] ; $v++)
	{
		$dbw->query("UPDATE ".$wgDBprefix.$_POST['trait'.$v]." SET value='".$_POST['values'.$v]."' WHERE mat_id='".$_POST['mat_id']."'  ");
		$this->getOutput()->addHTML("UPDATED");
	}
}
else
{
if(isset($_POST['add'])){
	$mat_update = $dbr->select('material',array('material_name','id'),"",__METHOD__);
	$up_mat = $dbr->select('material',array('id','material_name','mat_private','description','mat_type'),"id='".$_POST['mat_id']."'",__METHOD__);
	$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Mat_ext_update' method='post'>");
	$this->getOutput()->addHTML("<input type='hidden' name='mat_id' value='".$_POST['mat_id']."' >");
	foreach($up_mat as $material)
	{

	$this->getOutput()->addHTML("<table><tr><td>Material Name</td><td><input required type='text' title='Example: Carbon' name='up_material' value='".$material->material_name."' /></tr>
		<tr><td>Material Privacy</td><td>");
	if($material->mat_private == 1)
	{
		$this->getOutput()->addHTML("<input checked required type='radio' name='t3' value='1' checked>Public &nbsp;&nbsp;&nbsp;
	<input required type='radio' name='t3' value='0'>Private");
	}
	else
	{
		if($material->mat_private == 0)
		{
			$this->getOutput()->addHTML("<input required type='radio' name='t3' value='1' checked>Public &nbsp;&nbsp;&nbsp;
		<input checked required type='radio' name='t3' value='0'>Private");
		}
	}
	$this->getOutput()->addHTML("</td></tr><tr><td>Material Description</td><td><textarea rows='6' cols='30' name='t4'>$material->description</textarea></td></tr>

		<tr><td>Material Type</td><td><select name='t5'>");
	$mat_type = $dbr->select('material_type',array('id','mtype'),"",__METHOD__);
	foreach($mat_type as $mtype)
	{
		if($mtype->id == $material->mat_type)
		{	
			$this->getOutput()->addHTML("<option selected value='".$mtype->id."'>".$mtype->mtype."</option>");
		}
		else
		{
			$this->getOutput()->addHTML("<option value='".$mtype->id."'>".$mtype->mtype."</option>");
		}
	}
		$this->getOutput()->addHTML("</select></td></tr></table>");
$this->getOutput()->addHTML("<h4>Enter the values in <i>SI units</i></h4>");


/** ############################################ This code is for update trait tables ############################################# */
$trait_table = $dbr->select('trait_table',array('id','trait_name'),"","__METHOD__",array('ORDER BY' => 'trait_name'));
$this->getOutput()->addHTML("<table>");
$v=0;
foreach($trait_table as $traits)
{
	echo $trait = $traits->trait_name;
	$this->getOutput()->addHTML("<input type='hidden' name='trait".$v."' value='".$trait."'  >");
	//$trait_arr[$v] = $trait;
	$trait_count = $dbr->select($trait,array('count(id)'),"mat_id='".$_POST['mat_id']."'",__METHOD__ );
	$trait_value = $dbr->select($trait,array('value'),"mat_id='".$_POST['mat_id']."'",__METHOD__ );
	foreach($trait_count as $count)
	{
		foreach($count as $counter)
		{
			echo $counter."<br />";
		}
	}
	foreach($trait_value as $g)
	{
		foreach($g as $t_value)
		{
			$t_value."<br>";
		}
	}
	$trait_name = ucwords(str_ireplace("_", " ", $traits->trait_name));
	if($counter == 0)
	{
		echo $this->getOutput()->addHTML("<tr><td>".$trait_name."</td><td><input type='text' name='values".$v."' value='' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887' placeholder='Enter the value of ".$trait_name."' ></td></tr>");
	}
	else
	{
		echo $this->getOutput()->addHTML("<tr><td>".$trait_name."</td><td><input type='text' name='values".$v."' value='".$t_value."' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887' placeholder='Enter the value of ".$trait_name."' ></td></tr>");
	}
	$this->getOutput()->addHTML("<input type='hidden' name='up_counter' value='".$v."'> ");
	echo $v++;
	
}
$this->getOutput()->addHTML("<tr><td><input type='submit' name='mat_update' value='UPDATE'></td></tr></table></form>");

	}


/*	//$mat_id=$dbr->select('material','id',"material_name=$_POST['t1']",__METHOD__);
$mat_id=$dbw->query("Select id from ".$wgDBprefix."material where material_name='".$_POST['t1']."'");
$id=0;
foreach($mat_id as $f){
foreach($f as $t){
$id=$t; /** get maximum value of ID 
}
}
$dbw->query(" UPDATE ".$wgDBprefix.$_POST['t2']." 
	SET value=".$_POST['t3']."
	WHERE mat_id=$id;");
*/
}



}
}

     }
     }












































































































































































































































