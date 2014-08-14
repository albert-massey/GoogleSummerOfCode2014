<?php
class Specialmat_ext_viewall extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_viewall');
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


	$res2=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
	//echo $count = count($);
	$g=0;
	foreach($res2 as $samedata){
	$array[$g] = $samedata->trait_name;
	$count = $g+1;
	$g++;
	} 
	for($i=0; $i<$count; $i++ ){
	$res = $dbr->select(
		array( 'material',$array[$i]),
		array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tableName( $array[$i]) }.status" ),
		array(
			'mat_id>0'
		),
		__METHOD__,
		array(),
		array( $array[$i] => array( 'INNER JOIN', array(
			"{$dbr->tableName( 'material' )}.id=mat_id" ) ) )
 	);
	$this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th></tr>");
	foreach( $res as $row ) {
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");

	}
	$this->getOutput()->addHTML("</table><br>");}


}}


