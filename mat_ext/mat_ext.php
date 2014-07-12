<?php
/**
 * MediaWiki mat_ext extension
 * http://www.mediawiki.org/wiki/Extension:HelloWorld
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * This program is distributed WITHOUT ANY WARRANTY.
 */

/**
 * This file loads everything needed for the mat_ext extension to function.
 *
 * @file
 * @ingroup Extensions
 * @author Albert Coder
 */

// Alert the user that this is not a valid entry point to MediaWiki if they try to access the file directly.


// Extension credits that will show up on Special:Version

$wgExtensionCredits['specialpage'][]=array(
'path'=>__FILE__,
'name'=>'mat_ext',
'author'=>'Albert Coder',
'version'=>'1.0',
'url'=>'Coderalbert.wordpress.com',
'descriptionmsg'=>'Displays the desired text on wikipage',
);

$dir=dirname(__FILE__).DIRECTORY_SEPARATOR;

$wgAutoloadClasses['Specialmat_ext']=$dir.'Specialmat_ext.php';
$wgAutoloadClasses['Specialmat_ext_one']=$dir.'Specialmat_ext.php';
$wgAutoloadClasses['Specialmat_ext_del']=$dir.'Specialmat_ext.php';
$wgAutoloadClasses['Specialmat_ext_delm']=$dir.'Specialmat_ext.php';
$wgExtensionMessagesFiles['mat_ext'] = $dir .'mat_ext.i18n.php';
$wgExtensionMessagesFiles['mat_extAlias'] = $dir .'v.alias.php';
$wgSpecialPages['mat_ext']='Specialmat_ext';
$wgSpecialPages['mat_ext_one']='Specialmat_ext_one';
$wgSpecialPages['mat_ext_del']='Specialmat_ext_del';
$wgSpecialPages['mat_ext_delm']='Specialmat_ext_delm';
$wgSpecialPageGroups['mat_ext']='other';
?>

