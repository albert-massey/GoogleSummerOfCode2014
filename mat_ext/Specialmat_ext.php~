<?php
class Specialmat_ext extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext');
}
public function execute($sub){
global $wgOut;
global $wgUser;
$name=$wgUser->getId();
$dbr=wfGetDB(DB_SLAVE);
$this->getOutput()->setPageTitle( 'Materials Database Extension' );
if($wgUser->isLoggedIn()){

/** This code used for insert the data in database */

$res1=$dbr->select('material',array('max(id)'),"",__METHOD__);
$id=0;
foreach($res1 as $f){
foreach($f as $t){
 $id=$t;  /** get maximum value of ID */
}
$new_id=$id+1;
}

$qry=$dbr->select('trait_tables',array('count(id)'),"",__METHOD__);
$limit=0;
foreach($qry as $count)
{
 foreach($count as $g)
 {
  $limit = $g-1;
} 
}

if(isset($_POST['add'])){
$r=array('id'=>0,
'material_name'=>$_POST['t1'],
'userID'=>$name,
'mat_private'=>$_POST['t3'],
'description'=>$_POST['t4'],
'mat_type'=>$_POST['t5']);
$res=$dbr->insert('material',$r,__METHOD__);
$this->getOutput()->addHTML("<h4 style='color:blue'>Data is inserted</h4>");

for($i=0;$i<=$limit;$i++){
if($_POST['d'.$i]!=NULL){
$data=array('value'=>$_POST['d'.$i],
'mat_id'=>$new_id,
);
$res3=$dbr->insert($_POST[$i],$data,__METHOD__);
}
}

}

/** End of insertion code */


/** This code used for create  data entering form */

$this->getOutput()->setPageTitle( 'Add New Material' );
$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext' method='post'>
<table><tr><td>Material Name</td><td><input required type='text' name='t1'></tr>
 <tr><td>Material Privacy</td><td><input required type='radio' name='t3' value='1'>Public &nbsp;&nbsp;&nbsp;
<input required type='radio' name='t3' value='0'>Private</td></tr>
<tr><td>Material Description</td><td><input required type='text' name='t4'></td></tr>
<tr><td>Material Type</td><td><select name='t5'>
<option value='1'>Metal</option>
<option value='2'>Non-metal</option>
<option value='3'>Fluid</option>
<option value='4'>Plastic</option>
</select></td></tr>
</table>");
$this->getOutput()->addHTML("<h4>Enter the values in <i>SI units</i></h4>");

/** This code makes dynamic traits for material */

$res=$dbr->select('trait_tables',array('table_name','id'),"",__METHOD__);
$v=0;
$this->getOutput()->addHTML("<table>");
foreach($res as $data){
$this->getOutput()->addHTML("<tr><input type='hidden' value='".$data->table_name."' name='".$v."'><td>".$data->table_name."</td><td><input type='text' name='d".$v."' placeholder='Enter the value of ".$data->table_name."'></td></tr>");
$v++;
}
$this->getOutput()->addHTML("<tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form>");

}
else
{
	$this->getOutput()->addHTML("<h3 style='color:red'>Please <a href='http://localhost/mediawiki-1.22.7/index.php?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
}


}


}

$wgSpecialPages['TestForm'] = 'SpecialTestForm';

