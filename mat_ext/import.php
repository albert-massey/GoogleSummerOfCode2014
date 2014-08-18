<?php
class Specialmat_ext_import extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_import');
}
public function execute($sub){
if($this->getUser()->isLoggedIn()){
	global $array;
	global $wgDBprefix;
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Delete Trait' );
        $dbw = wfGetDB( DB_MASTER );
        
$resdel=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
$this->getOutput()->addHTML("<form action='upload.php' method='post'>
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

