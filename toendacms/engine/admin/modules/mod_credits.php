<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Credits and systeminformation
|
| File:	mod_credits.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Credits and Systeminformation
 *
 * This module is used as a info provider.
 *
 * @version 0.2.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }



// --------------------------------------------------------------------
// INIT
// --------------------------------------------------------------------

$lxml = new xmlparser('../../engine/tcms_kernel/tcms_copyright.xml','r');
$credits = $lxml->read_value('credits');
$copy    = $lxml->read_value('copy');
$lxml->flush();
$lxml->_xmlparser();
unset($lxml);

$cs_version = ''
.$tcms_version->getName().' - '.$tcms_version->getTagline().'!'
.' &bull; Version '.$tcms_version->getVersion().' '
.$tcms_version->getBuild().' ['.$tcms_version->getCodename().'] '.$tcms_version->getState()
.' &bull; Release date: '.$tcms_version->getReleaseDate().'&nbsp;';


// little func.
function get_php_setting($val) {
	global $tcms_main;
	return ( $tcms_main->getPHPSetting($val) == 1 ? 'ON' : 'OFF' );
}



echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';


/*
	tabpane start
*/

echo '<div class="tab-pane" id="tab-pane-1">';


/*
	mod tab
*/

echo '<div class="tab-page" id="tab-page-info">'
.'<h2 class="tab">'._CREDITS_SYSTEM.'</h2>';


echo $credits;
echo '<br /><br />';


echo '</div>';


/*
	mod tab
*/

echo '<div class="tab-page" id="tab-page-php">'
.'<h2 class="tab">'._CREDITS_PHP_VERSION.'</h2>';


echo '<br />';
echo '<strong class="tcms_big"><u>'._CREDITS_SYSTEM.'</u> (<a href="javascript:pageWindow(\'info.php?id_user='.$id_user.'\');">PHP Info</a>)</strong>';
echo '<br />';
echo '<br />';
echo '<br />';


echo '<h3 class="tcms_ft_blue_01">'._CREDITS_RELEVANT.'</h3>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_VERSION.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.$cs_version.'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_PLATFORM.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.php_uname().'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_PHP_VERSION.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.phpversion().'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_SERVER.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.$_SERVER['SERVER_SOFTWARE'].'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_SERVER_FACE.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.php_sapi_name().'</em></div>';



echo '<hr noshade="noshade" align="left" style="width: 800px; height: 1px; background: #ccc; border: 0px dotted #ccc;" />';



echo '<h3 class="tcms_ft_blue_01">'._CREDITS_RELEVANT_SET.'</h3>';

echo '<div class="tcms_placeholder_200"><strong>'._CREDITS_SET_GLOBALS.':</strong></div>'
.'<div class="tcms_placeholder">'._CREDITS_SET_GLOBALS.': <em>'.get_php_setting('register_globals').'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._MSG_FILE_UPLOADS.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.get_php_setting('file_uploads').'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._MSG_MAX_FILE_SIZE.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.ini_get('upload_max_filesize').' / '.$upload_max_filesize.' Bytes</em></div>';

echo '<div class="tcms_placeholder_200"><strong>'._MSG_MAX_POST_SIZE.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.ini_get('post_max_size').' / '.$post_max_size.' Bytes</em></div>';

echo '<div class="tcms_placeholder_200"><strong>save_mode:</strong></div>'
.'<div class="tcms_placeholder"><em>'.get_php_setting('save_mode').'</em></div>';



echo '<hr noshade="noshade" align="left" style="width: 800px; height: 1px; background: #ccc; border: 0px dotted #ccc;" />';



echo '<h3 class="tcms_ft_blue_01">'._CREDITS_PHP_MODULES.'</h3>';

echo '<h4 class="tcms_ft_blue_01">'
.'XML Modules'
.'</h4>';

echo '<div class="tcms_placeholder_200"><strong>XML '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('xml') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>SimpleXML '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('simplexml') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>XML RPC '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('xmlrpc') ? 'Yes' : 'No' ).'</em></div>';

echo '<h4 class="tcms_ft_blue_01">'
.'Database Modules'
.'</h4>';

echo '<div class="tcms_placeholder_200"><strong>mySQL '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('mysql') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>postgreSQL '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('pgsql') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>SQlite '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('sqlite') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>Microsoft SQL '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('mssql') ? 'Yes' : 'No' ).'</em></div>';

echo '<h4 class="tcms_ft_blue_01">'
.'Unicode Modules'
.'</h4>';

echo '<div class="tcms_placeholder_200"><strong>MB String '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('mbstring') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>Iconv '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('iconv') ? 'Yes' : 'No' ).'</em></div>';

echo '<h4 class="tcms_ft_blue_01">'
.'Misc Modules'
.'</h4>';

echo '<div class="tcms_placeholder_200"><strong>GD '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('gd') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>ZIP '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('zip') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>zLib '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('zlib') ? 'Yes' : 'No' ).'</em></div>';

echo '<div class="tcms_placeholder_200"><strong>IMAP '._CREDITS_SET.':</strong></div>'
.'<div class="tcms_placeholder"><em>'.( extension_loaded('imap') ? 'Yes' : 'No' ).'</em></div>';


echo '<br /><br />';


echo '</div>';


/*
	licence tab
*/

echo '<div class="tab-page" id="tab-page-licence">'
.'<h2 class="tab">'._TCMS_MENU_COPY.'</h2>';


echo $copy;
echo '<br /><br />';


echo '</div>';


/*
	tabpane end
*/

echo '</div>'
.'<script type="text/javascript">
var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
tabPane1.addTabPage(document.getElementById("tab-page-info"));
tabPane1.addTabPage(document.getElementById("tab-page-php"));
tabPane1.addTabPage(document.getElementById("tab-page-licence"));
tabPanel.setSelectedIndex(0);
setupAllTabs();
</script>'
.'<br />';


?>
