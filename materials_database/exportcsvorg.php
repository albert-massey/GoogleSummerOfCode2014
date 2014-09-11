<?php
class Specialmaterials_database_exportcsv extends SpecialPage{
public function __construct(){
parent::__construct('materials_database_exportcsv');
}
public function execute($sub){
global $wgUser;
global $wgDBprefix;
$name=$wgUser->getId();
if($wgUser->isLoggedIn()){
$dbr=wfGetDB(DB_SLAVE);
$this->getOutput()->setPageTitle( 'Export in CSV' );
$dbw = wfGetDB( DB_MASTER );

error_reporting(E_ALL ^ E_DEPRECATED);
/// Database Connection

 $host="localhost";
 $uname="root";
 $pass="batman";
 $database = "mikiwikidb";

 $connection=mysql_connect($host,$uname,$pass); 

 echo mysql_error();

 //or die("Database Connection Failed");
 $selectdb=mysql_select_db($database) or
 die("Database could not be selected");
 $result=mysql_select_db($database)
 or die("database cannot be selected <br>");

 // Fetch Record from Database

 $output = "";
 $table = "wiki_density"; // Enter Your Table Name
 $sql = mysql_query("select * from $table");
 $columns_total = mysql_num_fields($sql);

 // Get The Field Name

 for ($i = 0; $i < $columns_total; $i++) {
 $heading = mysql_field_name($sql, $i);
 $output .= '"'.$heading.'",';
 }
 $output .="\n";

 // Get Records from the table

 while ($row = mysql_fetch_array($sql)) {
 for ($i = 0; $i < $columns_total; $i++) {
 $output .='"'.$row["$i"].'",';
 }
 $output .="\n";
 }

// Download the file

$filename = "myFile.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;



    $this->getOutput()->addHTML("<nav>
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/add158.svg' title='Add Material' alt='Smiley' width='32' height='32'></a>|
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_one'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bookmark19.svg' title='Add Trait' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_delm'><img onmouseover=onmouseover='style.color='red''
    onmouseout='style.color='black'' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/delete48.svg' title='Delete Material' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_del'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/bin2.svg' title='Delete Trait' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/male226.svg' title='View all Materials' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searcht'><a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_viewall'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/browser8.svg' title='Search by Trait' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_searchm'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/search28.svg' title='Search Material' alt='Smiley' width='32' height='32'></a> |
    <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_export'><img onmouseover='bigImg(this)' onmouseout='normalImg(this)' border='0' src='http://localhost/mediawiki-1.22.7/extensions/materials_database/images/export(1).png' title='Export by Trait' alt='Smiley' width='32' height='32'></a> |
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
    array( 'material_name','value',"{$dbr->tableName( $array[$i] )}.mat_id","{$dbr->tableName( $array[$i] )}.timestamp","{$dbr->tableName($array[$i])}.status" ),
    array(
    'mat_id>0'
    ),
    __METHOD__,
    array(),
    array( $array[$i] => array( 'INNER JOIN', array(
    "{$dbr->tableName( 'material' )}.id=mat_id" ) ) )
    );
    $this->getOutput()->addHTML("<form action=http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."/Special:materials_database_links method='post'>

                <table border='1' width='600' height='30' cellspacing='1' cellpadding='3'><tr><th>Material Name</th><th>".ucwords(str_ireplace("_", " ", $array[$i]))."</th><th>Timestamp</th><th>Status</th><th>Check to Approve</th></tr><br>");
                foreach( $res as $row ) {
                $this->getOutput()->addHTML("<tr><td>".$row->material_name."</td><td>".$row->value."</td><td>".$row->timestamp."</td><td>".$row->status."<td><input type='checkbox' name='" .$array[$i].$row->mat_id."' value='".$row->mat_id."'></td></tr>");
                //   echo $array[$i].$row->mat_id;
                //
                //echo $_POST[$dbr->tableName( $array[$i] ).$row->mat_id];
                $dbr->tableName( $array[$i] ).$row->mat_id;
                if(isset($_POST[$array[$i].$row->mat_id])){

                $dbw->query(" UPDATE ".$wgDBprefix.$array[$i]." 
                SET status='1'
                WHERE mat_id='".$_POST[$array[$i].$row->mat_id]."'  ");
                $page = $_SERVER['PHP_SELF'];
                header( "refresh: 0; url=$page" );
                }}}

        if(isset($_POST['approve'])){       
        //  echo $_POST[$dbr->tableName( $array[$i] ).$row->mat_id];
        $dbr->tableName( $array[$i] ).$row->mat_id;
        $dbw->query(" UPDATE ".$wgDBprefix.$array[$i]."
        SET status='1'
        WHERE mat_id='".$_POST[$dbr->tableName( $array[$i] ).$row->mat_id]."'  ");
        }

        
                $this->getOutput()->addHTML("</table><br>");
                $this->getOutput()->addHTML("<input type=submit value=approve></form><br>");
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

        
        
        ");
        }


else
{
$this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to add new Data</h3>");
}

}}


