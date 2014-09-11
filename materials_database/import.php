<?php
class Specialmaterials_database_import extends SpecialPage{
public function __construct(){
parent::__construct('materials_database_import');
}
public function execute($sub){
if($this->getUser()->isLoggedIn()){
$dbr=wfGetDB(DB_SLAVE);
$this->getOutput()->setPageTitle( 'Delete Trait' );
$dbw = wfGetDB( DB_MASTER );
	    $this->getOutput()->addHTML("<nav>
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/add158.svg' title='Add Material' alt='Smiley' width='40' height='40'></a>|
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='29' height='29'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm'><img onmouseover=onmouseover='style.color='red''onmouseout='style.color='black'' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bin2.svg' title='Delete Trait' alt='Smiley' width='33' height='33'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'></a> |
	    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export_json'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'></a> | ");
	    $admins=array('bureaucrat','sysop');
	    //   echo $this->getUser()->getId();
	    $user_group = $dbw->query("SELECT ug_group FROM `wiki_user_groups` WHERE ug_user=".$this->getUser()->getId()."");
	    $i=0;
	    foreach($user_group as $ug_group) {
		$array_ug[$i]=$ug_group->ug_group;
		$i++;
	    }
	    //echo $user_group->numRows();
	    if($user_group->numRows()==!0) {
		$this->getOutput()->addHTML("<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/moderator1.svg' title='I am ADMIN' alt='Smiley' width='43' height='43'></a>");
	    }   
	    $this->getOutput()->addHTML("</nav><br> ");	        
echo $dir=dirname(__FILE__).DIRECTORY_SEPARATOR;
$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_upload' method='post'>
<table>");
$this->getOutput()->addHTML("
<tr><td>Select Trait to delete</td><td><select required name='traitsdel'>");
$resdel=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
foreach($resdel as $utype){
$this->getOutput()->addHTML("<option value=".$utype->trait_name.">".$utype->trait_name."</option>");
}

$this->getOutput()->addHTML("enctype='multipart/form-data'>
<label for='file'>Filename:</label>
<input type='file' name='file' id='file'><br>
<input type='submit' name='submit' value='Submit'>
</select></td></tr>
<tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");
/*if (isset($_POST['submit'])){
$target_path = $dir;

$target_path = $target_path . basename( $_FILES['file']['name']); 

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
echo "The file ".  basename( $_FILES['file']['name']).
" has been uploaded";
} else{
echo "There was an error uploading the file, please try again!";
}*/

       
$filename="/home/albertcoder/Downloads/density.json";
$a=fopen("/home/albertcoder/Downloads/density.json","r");
$b=fread($a,filesize($filename));
$d=str_replace ('[','',$b);
$e=str_replace (']','',$d);
$g=str_replace ('{','',$e);
$h=str_replace ('}','',$g);
$i=str_replace ('"','',$h);
$j=explode(",",$i);
$k=count($j);
$m=0;$n=0;
for($l=0;$l<$k;$l++){
if($l%2==0){
$o=explode(":",$j[$l]);
$matrial[$m]=$o[1];
$m++;
}else
{
$o=explode(":",$j[$l]);
$property[$n]=$o[1];
$n++;
}
}
$new= count($matrial);
for($q=0; $q<$new;$q++){
$dbw->query("INSERT INTO `mikiwikidb`.`wiki_material` (`id`, `material_name`, `userID`, `mat_private`, `description`, `mat_type`, `timestamp`, `status`) VALUES (NULL,'".$matrial[$q]."' , '5', '0', 'IMPORTED', '1', CURRENT_TIMESTAMP, '0')");

      $dbw->query("INSERT INTO `mikiwikidb`.`wiki_density` (`id`, `value`, `mat_id`, `timestamp`, `status`) VALUES (NULL, '".$property[$q]."', NULL, CURRENT_TIMESTAMP, '0')");

      $dbw->query("UPDATE `wiki_density` SET mat_id=id;");
      }
      }
      else
      {
      $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to DELETE data</h3>");
      }
      }
      }

