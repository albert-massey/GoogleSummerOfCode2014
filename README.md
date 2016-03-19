MaterialsDatabase
=================

This repository has all the files which facilitate to make a web interface for storing and retrieving the values of the materials. This is an extension made in CMS-MediaWiki which needs to be installed on your MediaWiki if you have it on your system. Following are the steps to make this extension work on your system.

REQUIREMENTS

<pre>
1. LAMP Stack
2. phpmyadmin
3. Mediawiki
4. MaterialsDatabase
</pre>

INSTALLATION OF REQUIREMENTS

1. LAMP Stack
Ubuntu Server Edition makes LAMP (Apache, PHP, and MySQL) available for installation during the install process. During the installation step, make sure you choose to install a LAMP server. Alternately, you can install all of these packages from a normal Ubuntu installation using these commands:

<pre>
sudo apt-get install apache2 mysql-server php5 php5-mysql libapache2-mod-php5</pre>

2. phpmyadmin
phpmyadmin is a MySQL administration tool. Run the following command in terminal to install this:

<pre>sudo apt-get install phpmyadmin</pre>

3. Mediawiki
To install mediawiki run the following commands:
<pre>
cd Downloads
wget https://releases.wikimedia.org/mediawiki/1.26/mediawiki-1.26.2.tar.gz
</pre>
Extract the tar file here:
<pre>
tar -xvzf mediawiki-1.26.2.tar.gz
sudo mv mediawiki-1.26.2/ /var/lib/
</pre>

Configure PHP:
Edit your PHP configuration file, php.ini. For Ubuntu 14.04, open file <code>/etc/php5/apache2/php.ini</code>. Depending on the Ubuntu version, it could be located on some other locations. You can simply use locate command to find the exact location of the file or for same version run the following command:

<pre>sudo vim /etc/php5/apache2/php.ini</pre>

Do the following changes:
<pre>upload_max_filesize = 20M
memory_limit = 128M
</pre> 

Configure Mediawiki
<pre>
cd /var/www/html
sudo ln -s /var/lib/mediawiki-1.26.2 mediawiki
</pre>

Now, navigate your browser to http://localhost/mediawiki and set up the mediawiki by folowing the installation procedure. 

Once the installation will be finished, it will automatically generate LocalSettings.php file. Save that file and move to the /var/lib/mediawiki-\*

<pre>cd Downloads
mv LoacalSettings.php /var/lib/mediawiki-1.26.2
</pre>

Mediawiki is installed and configured now. 

3. Add Materials Database
To add Materials Database, clone this repository into the extension folder in mediawiki-
<pre>
cd extension/
git clone "this repositories address"
cd MaterialsDatabase/materials_database
</pre>

Import database in your MySQL database-
<pre>
mysql -u username -p databasename < wikimaterial.sql
</pre>

Configuration:
<pre>
cd ../../..
sudo vim LocalSettings.php
</pre>

Add this line in your LocalSettings.php file at the end:                 

require_once ("$IP/extensions/MaterialsDatabase/materials_database/materials    _database.php");

Now you are all set to use this extension. Go to the URl http://localhost/$MW/index.php/Special:materials_database. 

Here $MW stands for the version of MediaWiki you have installed. For example http://localhost/mediawiki-1.26.2/index.php/Special:materials_database in our case.

Now run this command in your terminal from your MW base directory to copy the images in the skins directory: 

cp extensions/MaterialsDatabase/materials_database/images/* skins/common/images/

Now you can sign up and login to use the extension(which is quite easy).

