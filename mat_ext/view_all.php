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
 <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/add158.svg' title='Add Material' alt='Smiley' width='32' height='32'></a>|
      <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='32' height='32'></a> |
      <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img onmouseover=onmouseover='style.color='red''
      onmouseout='style.color='black'' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'></a> |
      <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/bin2.svg' title='Delete Trait' alt='Smiley' width='32' height='32'></a> |
     <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'></a> |
     <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'></a> |
     <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'></a> |
     <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'></a> | </nav><br> ");


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


