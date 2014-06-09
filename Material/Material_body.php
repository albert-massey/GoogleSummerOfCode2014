<?php
# Here the necessary description of file, authors and license
# @FILLME!
# Always good to remind that important part
 
# Avoids illegal processing, doesn't cost much, but unnecessary on a correct installation
if (!defined('MEDIAWIKI')) { die(-1); } 
class SpecialMaterial extends SpecialPage{
public function __construct($request=null){
parent::__construct('Material');
}
public function execute($par){
global $wgUser;
global $wgOut;
$wgOut->setPageTitle(wfMessage('MATERIAL_EXTENSION'));

if($wgUser->isLoggedIn()){

$this->setHeaders();
$formDescriptor=array(
'field1'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Material Id'
),
'field2'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Material Name'
),
'field3'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Boiling Point'
),
'field4'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Density'
),
'field5'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Melting Point'
),
'field6'=>array(
'section'=>'section',
'class'=>'HTMLTextField',
'label'=>'Tensile Strength'
),
);
$htmlForm=new HTMLForm($formDescriptor,$this->getContext(),'material');
$htmlForm->setSubmitText('Submit');
$htmlForm->setSubmitCallback(array('SpecialMaterial','processInt'));
$htmlForm->show();
}else
{
	$this->getOutput()->addHTML("Please Login For adding new Data");

$this->getOutput()->addHTML("<form action='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Material' method='post'> <table><tr><td>Search Material by Name</form></td><td><input type='text' name='t1'><input type='submit' value='search'></td></tr></table></form>");

$dbr=wfGetDB(DB_SLAVE);
if(isset($_POST['t1'])){
$res=$dbr->select('material',array('matdb_id','matdb_name','matdb_bp','matdb_d','matdb_mp','matdb_ts'),"matdb_name='".$_POST['t1']."'",__METHOD__);
}elseif(isset($_GET['mode'])){
	$res=$dbr->select('material',array('matdb_id','matdb_name','matdb_bp','matdb_d','matdb_mp','matdb_ts'),"matdb_id='".$_GET['mode']."'",__METHOD__);
}
else{
		$res=$dbr->select('material',array('matdb_id','matdb_name','matdb_bp','matdb_d','matdb_mp','matdb_ts'),"",__METHOD__);
}
if(!isset($_GET['mode'])){
foreach($res as $data){
$this->getOutput()->addHTML("<br>");
$this->getOutput()->addHTML("<a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:Material?mode=".$data->matdb_id."'>".$data->matdb_name."</a>");
}
}
else
{
	foreach($res as $data){
	$this->getOutput()->addHTML("<table border='1'><tr><td>Matdb_id</td><td>matdb_name</td><td>matdb_bp</td><td>matdb_d</td><td>matdb_mp</td><td>matdb_ts</td></tr>");
		$this->getOutput()->addHTML("<tr><td>".$data->matdb_id."</td><td>".$data->matdb_name."</td><td>".$data->matdb_bp."</td><td>".$data->matdb_d."</td><td>".$data->matdb_mp."</td><td>".$data->matdb_ts."</td></tr></table>");
}
}
}
}
static function processInt($formData){
if($formData['field2']){
$db=wfGetDB(DB_MASTER);

$d=array(
'matdb_id'=>$formData['field1'],
'matdb_name'=>$formData['field2'],
'matdb_bp'=>$formData['field3'],
'matdb_d'=>$formData['field4'],
'matdb_mp'=>$formData['field5'],
'matdb_ts'=>$formData['field6'],
);
$db->insert('material',$d,__METHOD__);
$db->commit(__METHOD__);
return "Ok Data is Inserted";
}
else{
return 'Try Again';
}
}

}

