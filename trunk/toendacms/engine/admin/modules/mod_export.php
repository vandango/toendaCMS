<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Export API
|
| File:	mod_export.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Export
 *
 * This is used for the import api.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }




// ----------------------------------------
// INIT
// ----------------------------------------

if(!isset($todo)){ $todo = 'show'; }

$impKey = 1;




// ----------------------------------------
// SHOW OLD VALUES
// ----------------------------------------

if($todo == 'show') {
	echo $tcms_html->bold(_TCMS_MENU_EXPORT);
	echo $tcms_html->text(
		'Export toendaCMS news, comments, categories and documents.<br /><br />',
		'left'
	);
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	
	
	echo '<tr class="tcms_bg_blue_01">'
	.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_EXPORT.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="100%" align="left">&nbsp;'._TABLE_DESCRIPTION.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="20%" align="left">'._TABLE_FUNCTIONS.'</th>'
	.'<tr>';
	
	echo '<tr height="25" id="row'.$impKey.'" '
	.'bgcolor="'.$arr_color[$impKey].'" '
	.'onMouseOver="wxlBgCol(\'row'.$impKey.'\',\'#ececec\')" '
	.'onMouseOut="wxlBgCol(\'row'.$impKey.'\',\''.$arr_color[$impKey].'\')" '
	.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_export&amp;todo=wordpressExport\';">';
	
	echo '<td class="tcms_db_2">'._EXPORT_WORDPRESS.'</td>';
	
	echo '<td class="tcms_db_2">'._EXPORT_WORDPRESS_DESC.'</td>';
	
	echo '<td class="tcms_db_2" align="right" valign="middle">'
	.'<a title="'._EXPORT_WORDPRESS.' '._TABLE_EXPORT.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_export&amp;todo=wordpressExport">'
	.'<img title="'._EXPORT_WORDPRESS.' '._TABLE_EXPORT.'" alt="'._EXPORT_WORDPRESS.' '._TABLE_EXPORT.'" style="padding-top: 3px;" border="0" src="../images/export.png" />'
	.'</a>&nbsp;'
	.'</td>';
	
	$impKey++;
	
	echo '</tr>';
	
	// table end
	echo '</table><br />';
}





// ----------------------------------------
// EXPORT TO WORDPRESS EXPORT FILE
// ----------------------------------------

if($todo == 'wordpressExport') {
	$xml = '<?xml version="1.0" encoding="UTF-8"?>'.chr(13);
	$xml .= '<!-- generator="toendaCMS '.$cms_version.' - '.$cms_build.'" created="'.date('Y-m-d H:i').'"-->'.chr(13);
	$xml .= '<rss version="2.0"'.chr(13);
    $xml .= $tcms_main->createCharString(4).'xmlns:content="http://purl.org/rss/1.0/modules/content/"'.chr(13);
    $xml .= $tcms_main->createCharString(4).'xmlns:wfw="http://wellformedweb.org/CommentAPI/"'.chr(13);
    $xml .= $tcms_main->createCharString(4).'xmlns:dc="http://purl.org/dc/elements/1.1/"'.chr(13);
    $xml .= $tcms_main->createCharString(4).'xmlns:wp="http://wordpress.org/export/1.0/"'.chr(13);
    $xml .= '>'.chr(13);
	$xml .= $tcms_main->createCharString(4).'<channel>'.chr(13);
	$xml .= $tcms_main->createCharString(4).'</channel>'.chr(13);
	$xml .= '</rss>'.chr(13);
	
	$tcms_file2 = new tcms_file();
	$tcms_file2->open('../../cache/wordpressExportFile.xml', 'w+');
	$tcms_file2->write($xml);
	$tcms_file2->close();
	unset($tcms_file2);
	
	echo $tcms_html->bold(_EXPORT_WORDPRESS).'<br />';
	echo $tcms_html->text(_EXPORT_WORDPRESS_DESC.'<br /><br />', 'left');
	
	echo '<div style="padding: 0 0 0 10px;">';
	
	
	// file
	echo '<input type="submit" name="reset" value="'._TCMS_ADMIN_BACK.'" '
	.'onclick="document.location=\'admin.php?id_user='.$id_user.'&site=mod_import\';" '
	.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" />';
	
	echo '<input type="submit" name="reset" value="'._TCMS_DOWNLOAD.'" '
	.'onclick="document.location=\'../../cache/wordpressExportFile.xml\';" '
	.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" />';
	
	
	echo '</div>';
}
