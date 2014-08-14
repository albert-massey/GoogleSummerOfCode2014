<?php
class Specialmat_ext extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext');
}
public function execute($sub){
global $wgOut;
global $array;
global $wgUser;
global $count;
$name=$wgUser->getId();
$dbr=wfGetDB(DB_SLAVE);
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
$this->getOutput()->setPageTitle( 'Add New Material' );
$this->getOutput()->addHTML("<form action='http://"
	.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext' method='post'>
<table><tr><td>Material Name</td><td><input required type='text' title='Example: Carbon'  name='t1'></tr>
 <tr><td>Material Privacy</td><td><input required type='radio' name='t3' value='1' checked>Public &nbsp;&nbsp;&nbsp;
<input required type='radio' name='t3' value='0'>Private</td></tr>
<tr><td>Material Description</td><td><input required type='text' name='t4'></td></tr>
<tr><td>Material Type</td><td><select name='t5'>
<option value='1'>Metal</option>
<option value='2'>Non-metal</option>
<option value='3'>Fluid</option>
<option value='4'>Plastic</option>
</select></td></tr>
</table>");
$this->getOutput()->addHTML("<h4>Enter the 
	values in <i>SI units</i></h4>");



/** This code used for insert the data in database */
$res1=$dbr->select('material',array('max(id)'),"",__METHOD__);
$id=0;
foreach($res1 as $f){
foreach($f as $t){
$id=$t; /** get maximum value of ID */
}
$new_id=$id+1;
}
$qry=$dbr->select('trait_table',array('count(id)'),"",__METHOD__);
$limit=0;
foreach($qry as $count)
{
 foreach($count as $g)
 {
  $limit = $g-1;
} 
}
$res2=$dbr->select('material',array('material_name'),"",__METHOD__);
$g=0;
foreach($res2 as $samedata){
$array[$g] = $samedata->material_name;
$g++;
} 
if(isset($_POST['add'])){
$r=array('id'=>0,
'material_name'=>ucwords($_POST['t1']),
'userID'=>$name,
'mat_private'=>$_POST['t3'],
'description'=>$_POST['t4'],
'mat_type'=>$_POST['t5']);
$ucwords = ucwords($_POST['t1']);
if(in_array($ucwords,$array))
{
$this->getOutput()->addHTML("<h4 style='color:#FF0000'>Material already exists</h4>");
}
else{
$res=$dbr->insert('material',$r,__METHOD__);
$this->getOutput()->addHTML("<h4 style='color:#00FF00'>Data is inserted</h4>");

$res1=$dbr->select('material',array('max(id)'),"",__METHOD__);
$id=0;
foreach($res1 as $f){
foreach($f as $t){
$id=$t; /** get maximum value of ID */
}
}

for($i=0;$i<=$limit;$i++){
if($_POST['d'.$i]!=NULL){
$data=array('value'=>$_POST['d'.$i],
'mat_id'=>$id,
);
$res3=$dbr->insert($_POST[$i],$data,__METHOD__);
}
}
}
}

/** End of insertion code */
/** This code makes dynamic traits for material */
$res=$dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
$v=0;
$this->getOutput()->addHTML("<table>");
foreach($res as $data){
$this->getOutput()->addHTML("<tr><input type='hidden' value='".$data->trait_name."' name='".$v."'><td>".ucwords(str_ireplace("_", " ", $data->trait_name))."</td><td><input type='text' name='d".$v."' pattern='^[0-9]*\.?[0-9]*?$' title='Example: Density of water=1.0887'  placeholder='Enter the value of ".$data->trait_name."'></td></tr>");
$v++;
}
$this->getOutput()->addHTML("<tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form>");
}
else
{
        //$this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Mat_ext method='post'>
        //<table>
 //<tr><td>Search by Material Name</td>
 //<td><input type='text' name='t1'></td></tr>
 //<tr><td><input type='submit' name='sb' value='Search'></td></tr>
// </table></form>");
 if(isset($_POST['t1'])){
 $res3=$dbr->select('material',array('mat_type,id'),"material_name='".$_POST['t1']."'",__METHOD__);
 foreach($res3 as $d){
 $r[0]=$d->mat_type;
 $r[1]=$d->id;
 }
 $res2=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
 $g=0;
 foreach($res2 as $samedata){
 $array[$g] = $samedata->trait_name;
 $g++;
 }

 for($i=0; $i<sizeof($array); $i++ ){
 $res = $dbr->select(
 array( 'material',$array[$i]),
 array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp" ),
 array(
 "mat_id='".$r[1]."'"
 ),
 __METHOD__,
 array(),
 array( $array[$i] => array( 'INNER JOIN', array(
 "{$dbr->tableName( 'material' )}.id='".$r[1]."'" ) ) )
   );
   $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th></tr>");

   foreach( $res as $row ) {
   $this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td></tr>");

   }
   $this->getOutput()->addHTML("</table><br>");}
   }
   else{

   $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
   //$this->getOutput()->addHTML("<h3 style='color:black'>Please ENTER Material Name</h3>");
   $res2=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
   $g=0;
   foreach($res2 as $samedata){
   $array[$g] = $samedata->trait_name;
   $count = $g+1;
   $g++;
   }
   for($i=0; $i<$count; $i++ ){
   $res = $dbr->select(
   array( 'material',$array[$i]),
   array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp" ),
   array(
   'mat_id>0'
   ),
   __METHOD__,
   array(),
   array( $array[$i] => array( 'INNER JOIN', array(
   "{$dbr->tableName( 'material' )}.id=mat_id" ) ) )
     );
     $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th></tr>");
     foreach( $res as $row ) {
     $this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td></tr>");

     }
     $this->getOutput()->addHTML("</table><br>");}
     }
     }
     }
     }
//$wgSpecialPages['TestForm'] = 'SpecialTestForm';









