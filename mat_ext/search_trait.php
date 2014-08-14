<?php
class Specialmat_ext_searcht extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_searcht');
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



/*$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm' method='post'>
<table>");
$this->getOutput()->addHTML("
<tr><td>Select Trait to delete</td><td><select required name='materialdel'>");
$matdel=$dbr->select('material',array('material_name'),"userID=$name",__METHOD__);
foreach($matdel as $utype){
$this->getOutput()->addHTML("<option value=".$utype->material_name.">".$utype->material_name."</option>");
}
$this->getOutput()->addHTML("</select></td></tr>
<tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");

if(isset($_POST['del'])){
$dbw->query("DELETE FROM `wiki_material` WHERE `material_name` ='".$_POST['materialdel']."'");
$page = $_SERVER['PHP_SELF'];
header( "refresh: 0; url=$page" );
}
else{
$this->getOutput()->addHTML("<h4 style='color:#FF0000'>Sorry You don't have any material in your material-list to delete</h4>");
}
 */

    $this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Mat_ext_searcht method='post'>
        <table>
 <tr><td>Search TRAIT by Name</td><td><select required name='searcht'>");
 $searcht=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
 foreach($searcht as $search1){
 $this->getOutput()->addHTML("<option value=".$search1->trait_name.">".$search1->trait_name."</option>");
 }
 $this->getOutput()->addHTML("</select></td></tr>
         <tr><td><input type='submit' value='Search' name=searchtr> </td></tr>
         </table>
         </form>");
 if(isset($_POST['searcht'])){


	$res = $dbr->select(
		array( 'material',$_POST['searcht']),
		array( 'material_name','value',"{$dbr->tableName( $_POST['searcht'] )}.timestamp","{$dbr->tablename('material')}.status" ),
		array(
			'mat_id>0'
		),
		__METHOD__,
		array(),
		array( $_POST['searcht'] => array( 'INNER JOIN', array(
			"{$dbr->tableName( 'material' )}.id=mat_id" ) ) )
 	);
	$this->getOutput()->addHTML("<table border='1' width='550' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $_POST['searcht']))."</th><th>Timestamp</th><th>Status</th></tr>");

	foreach( $res as $row ) {
		$this->getOutput()->addHTML("<tr><td>".ucwords(str_ireplace("_", " ", $row->material_name))."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</td></tr>");

	}
	$this->getOutput()->addHTML("</table><br>");
}
}
}


