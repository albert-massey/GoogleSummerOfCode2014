MaterialsDatabase
=================

This repository has all the files which facilitate to make a web interface for storing and retrieving the values of the materials. This is an extension made in CMS-MediaWiki which needs to be installed on your MediaWiki if you have it on your system. Following are the steps to make this extension work on your system.

1. You should have MediaWiki installed on your system.
2. Clone this repository into the path: mediawiki/extensions.
3. Edit the mediawiki/LocalSettings.php file and append this line at the end: require_once "$IP/extensions/Material/Material.php";
4. Now you are all set to use this extension. Go to the URl http://localhost/$MW/index.php/Special:Material .Here $MW stands for the version of MediaWiki you have installed. For example http://localhost/mediawiki-1.22.7/index.php/Special:Material .
5. Now you can sign up and login in to insert the material of your choice and its properties.
6. To see the properties, you will have to logout of your MediaWiki account.
7. After logging out, click on return to Special:Material. Then either you can click on the materials below to see their properties or you can use search bar to search a particular material. 
