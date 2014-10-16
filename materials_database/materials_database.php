<?php
/*         M A T E R I A L S _ D A T A B A S E . P H P
 * BRL-CAD
 *
 * Copyright (c) 1995-2013 United States Government as represented by
 * the U.S. Army Research Laboratory.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * version 2.1 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this file; see the file named COPYING for more
 * information.
 */
/** @file materials_database/materials_database.php
 *
 */
/**
 * This file loads everything needed for the materials_database extension to function.
 * 
 * @file
 * @ingroup Extensions
 * @author Albert Coder
 */

/** Alert the user that this is not a valid entry point to MediaWiki if they try to access the file directly. */


/** Extension credits that will show up on Special:Version */

$wgExtensionCredits['specialpage'][] = array(
    'path'=>__FILE__,
    'name'=>'materials_database',
    'author'=>'Albert Coder',
    'version'=>'1.0',
    'url'=>'Coderalbert\'s',
    'descriptionmsg'=>'This extension is all about making a web application where users can easily store / retrieve the properties or traits of materials in a methodical manner such that those can be retrieved / reused  effortlessly.',
);
$dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
$wgAutoloadClasses['Specialmaterials_database'] = $dir.'Specialmaterials_database.php';
$wgAutoloadClasses['Specialmaterials_database_one'] = $dir.'add_trait.php';
$wgAutoloadClasses['Specialmaterials_database_del'] = $dir.'delete_trait.php';
$wgAutoloadClasses['Specialmaterials_database_links'] = $dir.'admin_approve.php';
$wgAutoloadClasses['Specialmaterials_database_delm'] = $dir.'delete_material.php';
$wgAutoloadClasses['Specialmaterials_database_viewall'] = $dir.'view_all.php';
$wgAutoloadClasses['Specialmaterials_database_searcht'] = $dir.'search_trait.php';
$wgAutoloadClasses['Specialmaterials_database_searchm'] = $dir.'search_material.php';
$wgAutoloadClasses['Specialmaterials_database_update'] = $dir.'update.php';
$wgAutoloadClasses['Specialmaterials_database_export_json'] = $dir.'export_json.php';
$wgAutoloadClasses['Specialmaterials_database_exportcsv'] = $dir.'exportcsv.php';
$wgAutoloadClasses['Specialmaterials_database_exportxml'] = $dir.'exportxml.php';
$wgAutoloadClasses['Specialmaterials_database_import'] = $dir.'import.php';
$wgAutoloadClasses['Specialmaterials_database_upload'] = $dir.'upload.php';
$wgAutoloadClasses['Specialmaterials_database_admin'] = $dir.'admin.php';
$wgExtensionMessagesFiles['materials_database'] = $dir .'materials_database.i18n.php';
$wgExtensionMessagesFiles['materials_databaseAlias'] = $dir .'v.alias.php';
$wgSpecialPages['materials_database'] = 'Specialmaterials_database';
$wgSpecialPages['materials_database_one'] = 'Specialmaterials_database_one';
$wgSpecialPages['materials_database_del'] = 'Specialmaterials_database_del';
$wgSpecialPages['materials_database_links'] = 'Specialmaterials_database_links';
$wgSpecialPages['materials_database_delm'] = 'Specialmaterials_database_delm';
$wgSpecialPages['materials_database_viewall'] = 'Specialmaterials_database_viewall';
$wgSpecialPages['materials_database_searcht'] = 'Specialmaterials_database_searcht';
$wgSpecialPages['materials_database_searchm'] = 'Specialmaterials_database_searchm';
$wgSpecialPages['materials_database_update'] = 'Specialmaterials_database_update';
$wgSpecialPages['materials_database_export_json'] = 'Specialmaterials_database_export_json';
$wgSpecialPages['materials_database_exportcsv'] = 'Specialmaterials_database_exportcsv';
$wgSpecialPages['materials_database_exportxml'] = 'Specialmaterials_database_exportxml';
$wgSpecialPages['materials_database_admin'] = 'Specialmaterials_database_admin';
$wgSpecialPages['materials_database_import'] = 'Specialmaterials_database_import';
$wgSpecialPages['materials_database_upload'] = 'Specialmaterials_database_upload';
$wgSpecialPageGroups['materials_database'] = 'other';

/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
