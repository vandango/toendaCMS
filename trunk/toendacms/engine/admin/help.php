<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Help
|
| File:		help.php
| Version:	0.0.6
|
+
*/


define('_TCMS_VALID', 1);


if(isset($_GET['helpText'])){ $helpText = $_GET['helpText']; }


include_once('../tcms_kernel/tcms_xml.lib.php');

$tcms_administer_site = 'data';

$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/layout.xml','r');
$adminTheme = $xml->read_section('layout', 'admin');


$language_stage = 'admin';
include_once('../language/lang_admin.php');


$ver_xml = new xmlparser('../../engine/tcms_kernel/tcms_version.xml','r');

$toenda_copy  = $ver_xml->read_section('version', 'toenda_copyright');




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
