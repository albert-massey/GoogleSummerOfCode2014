<?php
/**
 * MediaWiki Student extension
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
 * This file loads everything needed for the Hi extension to function.
 *
 * @file
 * @ingroup Extensions
 * @author Ryan Kaldari
 */

// Alert the user that this is not a valid entry point to MediaWiki if they try to access the file directly.


// Extension credits that will show up on Special:Version
if (!defined('MEDIAWIKI')) { die(-1); } 
$wgExtensionCredits['specialpage'][]=array(
'path'=>__FILE__,
'name'=>'Material',
'author'=>'Albert Coder',
'version'=>'1.0',
'url'=>'coderalbert.wordpress.com',
'descriptionmsg'=>'mtdesc',
);

$dir=dirname(__FILE__).'/';
$wgExtensionMessagesFiles['Material']=$dir.'Material.i18n.php';
$wgExtensionMessagesFiles['MaterialAlias'] = $dir .'Material.alias.php';
$wgAutoloadClasses['SpecialMaterial']=$dir.'Material_body.php';
$wgSpecialPages['Material']='SpecialMaterial';
$wgSpecialPageGroups['Material']='other';
$wgHooks['LoadExtensionSchemaUpdates'][]='fnMyHook';
function fnMyHook(DatabaseUpdater $updater){
$updater->addExtensionTable('material',dirname( __FILE__ ) . '/material.sql', true);
return true;
}
?>

