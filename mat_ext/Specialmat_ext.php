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

	$this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
      <li><a href='http://".$_SERVER['SERVER_NAME'].
      $_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
      &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].
      $_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a>
 &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>
                    </ul>
                    </div>


                    </body>
                    ");


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
			   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>                  </ul>
                    </div>


                    </body>
                    ");

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
class Specialmat_ext_del extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_del');
}
public function execute($sub){
	global $wgUser;
$name=$wgUser->getId();
if($wgUser->isLoggedIn()){
	global $wgOut;
	global $array;
	global $wgDBprefix;
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Delete Trait' );
	$dbw = wfGetDB( DB_MASTER );
		   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");

$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del' method='post'>
<table>");
$this->getOutput()->addHTML("
<tr><td>Select Trait to delete</td><td><select required name='traitsdel'>");
$resdel=$dbr->select('trait_table',array('trait_name'),"userID=$name",__METHOD__);
foreach($resdel as $utype){
$this->getOutput()->addHTML("<option value=".$utype->trait_name.">".$utype->trait_name."</option>");
}
$this->getOutput()->addHTML("</select></td></tr>
<tr><td><input type='submit' value='Delete' name='del' ></td></tr></table></form>");
if($resdel->numRows()!=0){

if(isset($_POST['del'])){
$dbw->query("DROP TABLE $wgDBprefix".$_POST['traitsdel']."");
$dbw->query("DELETE FROM `wiki_trait_table` WHERE `trait_name` ='".$_POST['traitsdel']."'");
$page = $_SERVER['PHP_SELF'];
header( "refresh: 0; url=$page" );
}}
else{
$this->getOutput()->addHTML("<h4 style='color:#FF0000'>Sorry You don't have any trait in your trait-list to delete</h4>");
}
}

else
{
        $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to DELETE data</h3>");
}

}}

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
		   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");

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

class Specialmat_ext_links extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_links');
}
public function execute($sub){
	global $wgUser;
	global $wgDBprefix;
$name=$wgUser->getId();
if($wgUser->isLoggedIn()){
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Links under Materials Database extension' );
	$dbw = wfGetDB( DB_MASTER );	
        $this->getOutput()->addHTML("
                
                
                
                <style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/rsz_brl-cad_logo.png' alt='Smiley' width='32' height='32'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/rsz_brl-cad_logo.png' alt='Smiley' width='32' height='32'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");
    $this->getOutput()->addHTML("<nav>
              <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'>Add Material</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'>Add Trait</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'>Delete Material</a> |
                    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'>Delete Trait</a>
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'>View All Materials</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'>Search by Trait</a> |
                <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'>Search by Material</a> |
                  <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'>Export</a> |
                    </nav> ");
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
		array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.mat_id","{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tablename('material')}.status" ),
		array(
			'mat_id>0'
		),
		__METHOD__,
		array(),
		array( $array[$i] => array( 'INNER JOIN', array(
			"{$dbr->tableName( 'material' )}.id=mat_id" ) ) )
 	);
        $this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Mat_ext_links method='post'>
                
                <table border='1' width='600' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th><th>Check to Approve</th></tr>");
	foreach( $res as $row ) {
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."<td><input type='checkbox' name='" .$array[$i].$row->mat_id."' value='".$row->mat_id."'></td></tr>");
              echo $array[$i].$row->mat_id;
                //
                //echo $_POST[$dbr->tableName( $array[$i] ).$row->mat_id]; 
                $dbr->tableName( $array[$i] ).$row->mat_id;
                if(isset($_POST[$array[$i].$row->mat_id])){

                $dbw->query(" UPDATE ".$wgDBprefix.$array[$i]." 
                        SET status='1'
                        WHERE mat_id='".$_POST[$array[$i].$row->mat_id]."'  ");
	}}}
        
        if(isset($_POST['approve'])){       
                       echo $_POST[$dbr->tableName( $array[$i] ).$row->mat_id]; 
         $dbr->tableName( $array[$i] ).$row->mat_id;
                $dbw->query(" UPDATE ".$wgDBprefix.$array[$i]." 
                        SET status='1'
	        WHERE mat_id='".$_POST[$dbr->tableName( $array[$i] ).$row->mat_id]."'  ");
        }

        
                $this->getOutput()->addHTML("<input type=submit value=approve></table></form><br>");
	$this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'>Click</a> to add new material</h3>");
        $this->getOutput()->addHTML("<head>
                <script>
function bigImg(x)
{
        x.style.height='64px';
        x.style.width='64px';
}

function normalImg(x)
{
        x.style.height='32px';
        x.style.width='32px';
}
</script>
        </head>
        <body>
        
        <img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/mat_ext/rsz_brl-cad_logo.png' alt='Smiley' width='32' height='32'>
        
        <p>The function bigImg() is triggered when the user moves the mouse pointer over the image.</p>
        <p>The function normalImg() is triggered when the mouse pointer is moved out of the image.</p>
        
        </body>");
}


else
{
        $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
}

}}

class Specialmat_ext_viewall extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_viewall');
}
public function execute($sub){
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Links under Materials Database extension' );
	$dbw = wfGetDB( DB_MASTER );	
	   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    <br>");

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
		array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tablename('material')}.status" ),
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
		$this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."</tr>");

	}
	$this->getOutput()->addHTML("</table><br>");}


}}


class Specialmat_ext_searcht extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_searcht');
}
public function execute($sub){
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Links under Materials Database extension' );
	$dbw = wfGetDB( DB_MASTER );	
	   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");

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


class Specialmat_ext_searchm extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_searchm');
}
public function execute($sub){
	$dbr=wfGetDB(DB_SLAVE);
	$this->getOutput()->setPageTitle( 'Links under Materials Database extension' );
	$dbw = wfGetDB( DB_MASTER );	
	   $this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");


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



class Specialmat_ext_update extends SpecialPage{
public function __construct(){
parent::__construct('mat_ext_update');
}
public function execute($sub){
global $wgOut;
global $array;
global $wgUser;
global $count;
	global $wgDBprefix;
$name=$wgUser->getId();
$dbr=wfGetDB(DB_SLAVE);
	$dbw = wfGetDB( DB_MASTER );	
$this->getOutput()->setPageTitle( 'Materials Database Extension' );
if($wgUser->isLoggedIn()){
	/**This code makes the menu bar at the top of each page */

	$this->getOutput()->addHTML("<style>
#menu ul{
  list-style: none;
  }

  #menu li{
    display: inline;
    }
    </style>
    <div id='menu'>



    <body>
      <ul>
          <li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext'><img style='border:0;' src='smiley.gif' alt='Add new material' width='42' height='42' title='add new material'></a></li>
	  &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_one'><img style='border:0;' src='smiley.gif' alt='Add new trait' width='42' height='42' title='add new trait'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_delm'><img style='border:0;' src='smiley.gif' alt='Delete material' width='42' height='42' title='delete material'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_del'><img style='border:0;' src='smiley.gif' alt='Delete trait' width='42' height='42' title='delete trait'></a></li>
        &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_viewall'><img style='border:0;' src='smiley.gif' alt='View all materials' width='42' height='42' title='view all materials'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searcht'><img style='border:0;' src='smiley.gif' alt='Search by TRAIT' width='42' height='42' title='search by TRAIT'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_searchm'><img style='border:0;' src='smiley.gif' alt='Search by MATERIAL' width='42' height='42' title='search by MATERIAL'></a></li>
         &nbsp;<li><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_export'><img style='border:0;' src='smiley.gif' alt='Export' width='42' height='42' title='Export by trait'></a></li>           </ul>
                    </div>


                    </body>
                    ");


/** This code used for create  data entering form */
$this->getOutput()->setPageTitle( 'Add New Material' );
$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:mat_ext_update' method='post'>
<table><tr><td>Material Name</td><td><input required type='text' title='Example: Carbon'  name='t1'></td></tr>
<tr><td>Trait Name</td><td><input required type='text' name='t2'></td></tr>
<tr><td>Value</td><td><input required type='text' name='t3'></td>
</table>");


if(isset($_POST['t2'])){
	//echo $_POST['t3'];
/*$mat_id=$dbw->query("Select id from ".$wgDBprefix."material where material_name='".$_POST['t1']."'");
//echo $mat_id->current();
$mat_ids=(string)$mat_id;
$dbw->query(" UPDATE ".$wgDBprefix.$_POST['t2']." 
	SET value=".$_POST['t3']."
	WHERE mat_id=$mat_ids;");
*/
//$mat_id=$dbr->select('material','id',"material_name=$_POST['t1']",__METHOD__);
$mat_id=$dbw->query("Select id from ".$wgDBprefix."material where material_name='".$_POST['t1']."'");
$id=0;
foreach($mat_id as $f){
foreach($f as $t){
$id=$t; /** get maximum value of ID */
}
}
$dbw->query(" UPDATE ".$wgDBprefix.$_POST['t2']." 
	SET value=".$_POST['t3']."
	WHERE mat_id=$id;");


}


}



/** End of insertion code */
/** This code makes dynamic traits for material */
$res=$dbr->select('trait_table',array('trait_name','id'),"",__METHOD__);
$v=0;
$this->getOutput()->addHTML("<table>");
$this->getOutput()->addHTML("<tr><td><input type='submit' value='Add' name='add' ></td></tr></table></form>");


     }
     }






