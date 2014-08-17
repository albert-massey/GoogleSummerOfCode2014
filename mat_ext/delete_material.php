<?php
class Specialmat_ext_delm extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_delm');
}
public function execute($sub){
	global $wgUser;
$name=$wgUser->getId();
if($wgUser->isLoggedIn()){
	global $wgOut;
	global $array;
	global $wgDBprefix;
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Delete Material' );
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
     <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'></a> | 
                    </nav><br> ");



$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm' method='post'>
<table>");
$this->getOutput()->addHTML("
<tr><td>Select Material to delete</td><td><select required name='materialdel'>");
$matdel=$dbr->select('material',array('material_name'),"userID=$name",__METHOD__);
foreach($matdel as $utype){
$this->getOutput()->addHTML("<option value=".$utype->material_name.">".$utype->material_name."</option>");
}
$this->getOutput()->addHTML("</select></td></tr>
<tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");
if($matdel->numRows()!=0){

if(isset($_POST['del'])){
$dbw->query("DELETE FROM `wiki_material` WHERE `material_name` ='".$_POST['materialdel']."'");
$page = $_SERVER['PHP_SELF'];
header( "refresh: 0; url=$page" );
}}
else{
$this->getOutput()->addHTML("<h4 style='color:#FF0000'>Sorry You don't have any material in your material-list to delete</h4>");
}
}
 //LogIn


else
{
        $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
}

}}


