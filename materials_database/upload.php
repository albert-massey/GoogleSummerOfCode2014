<?php
class Specialmaterials_database_upload extends SpecialPage {
    public function __construct()
    {
	parent::__construct('materials_database_upload');
    }
    public function execute($sub)
    {
	if ($this->getUser()->isLoggedIn()) {
	    $dbr = wfGetDB(DB_SLAVE);
	    $this->getOutput()->setPageTitle('Upload File');
	    $dbw = wfGetDB(DB_MASTER);
	    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
	    $target_path = $dir;
	    $target_path = $target_path . basename( $_FILES['file']['name']); 
	    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['file']['name'])." has been uploaded";
	    } 
	    else {
		echo "There was an error uploading the file, please try again!";
	    }       
	}
	else {
	    $this->getOutput()->addHTML("<h3 style='color:black'>Please <a href='http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?title=Special:UserLogin&returnto=Special%3AMat+ext'>Login</a> to DELETE data</h3>");
	}
    }
}

