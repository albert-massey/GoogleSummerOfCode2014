<?php
class Specialmat_ext_one extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_one');
}
public function execute($sub){
	global $wgUser;
$name=$wgUser->getId();
if($wgUser->isLoggedIn()){
	global $wgOut;
	global $array;
	global $wgDBprefix;
	$dbr=wfGetDB(DB_SLAVE);
	$wiki_message = 'J3';
	$this->getOutput()->setPageTitle( 'Materials Database Extension' );
	$this->getOutput()->setPageTitle( 'Add New Trait' );
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



	$wgOut->addWikiMsg('add_trait');
//$this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'>Click</a> to delete trait</h3>");
$res2=$dbr->select('trait_table',array('trait_name'),"",__METHOD__);
$g=0;
foreach($res2 as $samedata){
$array[$g] = $samedata->trait_name;
$g++;
}

if(isset($_POST['addtrait'])){
$r=array('id'=>0,
'trait_name'=>str_ireplace(" ", "_", strtolower($_POST['trait_name'])),
'userID'=>$name,
't_type'=>$_POST['trait_type'],
'u_type'=>$_POST['units']);
$strtolower = str_ireplace(" ", "_", strtolower($_POST['trait_name']));
if(in_array($strtolower,$array))
{
$this->getOutput()->addHTML("<h4 style='color:#FF0000'>Trait already exists</h4>");
}
else{
$dbw->query("CREATE TABLE `".$wgDBprefix.$strtolower."` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `mat_id` int(20) unsigned NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL default '0', 
  PRIMARY KEY  (`id`),
  KEY `FK".$wgDBprefix.$strtolower."` (`mat_id`)
) ENGINE=innoDB DEFAULT CHARSET=latin1;
");
$dbw->query("ALTER TABLE `".$wgDBprefix.$strtolower."`
  ADD CONSTRAINT `FK".$wgDBprefix.$strtolower."` FOREIGN KEY (`mat_id`) REFERENCES `wiki_material` (`id`) ON DELETE CASCADE;
");
$res=$dbr->insert('trait_table',$r,__METHOD__);
$this->getOutput()->addHTML("<h4 style='color:#00FF00'>Data is inserted</h4>");
}
}
$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one' method='post'>
<table><tr><td>Trait Name</td><td><input required type='text' name='trait_name'></tr>
<tr><td>Trait Type</td><td><select required  name='trait_type'>");
$tarray=$dbr->select('trait_type',array('id','type'),"",__METHOD__);
foreach($tarray as $ttype){
$this->getOutput()->addHTML("<option value= ".$ttype->id.">".$ttype->type."</option>");
} 
$this->getOutput()->addHTML("</select></td></tr>
<tr><td>Trait Units(SI)</td><td><select required name='units'>");
$uarray=$dbr->select('trait_units',array('id','units'),"",__METHOD__);
foreach($uarray as $utype){
$this->getOutput()->addHTML("<option value=".$utype->id.">".$utype->units."</option>");
}
$this->getOutput()->addHTML("</select></td></tr>
<tr><td><input type='submit' value='Add' name='addtrait' ></td></tr></table></form>");

} //LogIn

else
{
        $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
}
}
}
