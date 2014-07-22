MaterialsDatabase
=================

This repository has all the files which facilitate to make a web interface for storing and retrieving the values of the materials. This is an extension made in CMS-MediaWiki which needs to be installed on your MediaWiki if you have it on your system. Following are the steps to make this extension work on your system.

1. You should have MediaWiki installed on your system.
2. Clone this repository into the path: mediawiki/extensions.
3. Edit the mediawiki/LocalSettings.php file and append this line at the end: require_once "$IP/extensions/mat_ext/mat_ext.php";
4. Now you are all set to use this extension. Go to the URl http://localhost/$MW/index.php/Special:mat_ext .Here $MW stands for the version of MediaWiki you have installed. For example http://localhost/mediawiki-1.22.7/index.php/Special:mat_ext .
5. Now you can sign up and login to use the extension(which is quite easy).

