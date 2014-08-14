<?php
class Specialmat_ext_searchm extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_searchm');
}
public function execute($sub){
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Links under Materials Database extension' );
	$dbw = wfGetDB( DB_MASTER );	
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




$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm' method='post'>
<table>");
$this->getOutput()->addHTML("
<tr><td>Select Trait to delete</td><td><select required name='materialdel'>");
$matdel=$dbr->select('material',array('material_name'),"",__METHOD__);
foreach($matdel as $utype){
$this->getOutput()->addHTML("<option  value=".$utype->material_name.">".$utype->material_name."</option>");
}
$this->getOutput()->addHTML("</select></td></tr>
<tr><td><input type='submit' value='Search' name='searchm' ></td></tr></table></form>");
 if(isset($_POST['searchm'])){
 $res3=$dbr->select('material',array('mat_type,id'),"material_name='".$_POST['materialdel']."'",__METHOD__);
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
 array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tablename($array[$i])}.status" ),
 array(
 "mat_id='".$r[1]."'"
 ),
 __METHOD__,
 array(),
 array( $array[$i] => array( 'INNER JOIN', array(
 "{$dbr->tableName( 'material' )}.id='".$r[1]."'" ) ) )
   );
   $this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th></tr>");

   foreach( $res as $row ) {
   $this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");

   }
   $this->getOutput()->addHTML("</table><br>");}
   }
   else{


}
}
}


