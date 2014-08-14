<?php      
class Specialmat_ext_admin extends SpecialPage{                      
public function __construct(){                                        
parent::__construct('mat_ext_admin');                                
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
           
