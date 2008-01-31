<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Help Window
|
| File:	help.php
|
+
*/


/**
 * Help Window
 *
 * This is used as a help window.
 *
 * @version 0.0.9
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */



// ---------------------------------------------
// INIT
// ---------------------------------------------

define('_TCMS_VALID', 1);


if(isset($_GET['helpText'])){ $helpText = $_GET['helpText']; }


include_once('../tcms_kernel/tcms_xml.lib.php');
include_once('../tcms_kernel/tcms_configuration.lib.php');

// load current active page
include_once('../../site.php');
define('_TCMS_PATH', '../../'.$tcms_site[0]['path']);

$tcms_config = new tcms_configuration(_TCMS_PATH);
$tcms_version = new tcms_version('../../');

$adminTheme = $tcms_config->getAdminTheme();


if(!defined('_TCMS_LANGUAGE_STARTPOINT')) {
	define('_TCMS_LANGUAGE_STARTPOINT', 'admin');
}
include_once('../language/lang_admin.php');

$toenda_copy = $tcms_version->getToendaCopyright();



// ---------------------------------------------
// HTML
// ---------------------------------------------

echo '<html><head>'
.'<title>'._TABLE_HELPBROWSER.'</title>'
.'<meta name="generator" content="toendaCMS - Copyright '.$toenda_copy.' Toenda Software Development.  All rights reserved." />'
.'<style> body { margin: 0px !important; padding: 0px !important; } </style>'
.'<link href="theme/'.$adminTheme.'/tcms_main.css" rel="stylesheet" type="text/css" />'
.'</head><body>';

echo '<div class="tcms_help_window_top">'
.'<strong class="tcms_help_window_top_font">&nbsp;'._TABLE_HELPBROWSER.'</strong>'
.'</div>';

echo '<div style="margin: 7px; padding: 0px;">'
.$helpText.'</div>';

echo '<br /><hr noshade="noshade" style="border: 1px solid #333; height: 1px;" />'
.'<a style="color: #000; fopnt-weight: bold; margin-left: 10px; font-size: 11px;" href="javascript:self.close();" title="X">[X]</a>';

echo '</body></html>';

?>
