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
| File:		mod_credits.php
| Version:	0.1.4
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');






if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }








if(!isset($action)){ $action = 'system'; }

echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
.'<a'.( $action == 'system' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_credits&amp;action=system">'._CREDITS_SYSTEM.'</a>'
.'<a'.( $action == 'php' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_credits&amp;action=php">'._CREDITS_PHP_VERSION.'</a>'
.'</div>';

echo '<div class="tcms_tabPage"><br />';






if($action == 'system'){
	/*
		init
	*/
	
	$credits_xml = new xmlparser('../../engine/tcms_kernel/tcms_copyright.xml','r');
	
	$credits = $credits_xml->read_value('credits');
	
	
	
	
	
	
	/*
		credits output
	*/
	echo $credits;
	
	echo '<br /><br />';
}
else{
	/*
		init
	*/
	
	$ver_xml = new xmlparser('../../engine/tcms_kernel/tcms_version.xml','r');
	
	$release      = $ver_xml->read_section('version', 'release');
	$codename     = $ver_xml->read_section('version', 'codename');
	$status       = $ver_xml->read_section('version', 'status');
	$build        = $ver_xml->read_section('version', 'build');
	$cms_name     = $ver_xml->read_section('version', 'name');
	$release_date = $ver_xml->read_section('version', 'release_date');
	
	$cs_version = $cms_name.' &bull; Version '.$release.' '.$status.' &bull; ['.$codename.'] &bull; '.$build.' &bull; '.$release_date.'&nbsp;';
	
	
	
	
	// little func.
	function get_php_setting($val){
		$r =  (ini_get($val) == '1' ? 1 : 0);
		return $r ? 'ON' : 'OFF';
	}
	
	
	
	
	/*
		output system information
	*/
	
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
	.'<div class="tcms_placeholder"><em>'.ini_get('upload_max_filesize').'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>save_mode:</strong></div>'
	.'<div class="tcms_placeholder"><em>'.get_php_setting('save_mode').'</em></div>';
	
	
	
	echo '<hr noshade="noshade" align="left" style="width: 800px; height: 1px; background: #ccc; border: 0px dotted #ccc;" />';
	
	
	
	echo '<h3 class="tcms_ft_blue_01">'._CREDITS_PHP_MODULES.'</h3>';
	
	echo '<div class="tcms_placeholder_200"><strong>XML '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('xml') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>GD '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('gd') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>ZIP '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('zip') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>zLib '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('zlib') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>mySQL '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('mysql') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>postgreSQL '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('pgsql') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>IMAP '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('imap') ? 'Yes' : 'No' ).'</em></div>';
	
	echo '<div class="tcms_placeholder_200"><strong>MB String '._CREDITS_SET.':</strong></div>'
	.'<div class="tcms_placeholder"><em>'.( extension_loaded('mbstring') ? 'Yes' : 'No' ).'</em></div>';
	
	
	
	echo '<br /><br /><br /><br />';
	
	
	
	
	
	
	//$tcms_file = new tcms_file('../../cache/phpinfo.txt', 'w');
	//$tcms_file->fileWrite(phpinfo());
	//$tcms_file->fileClose();
}





echo '</div>';

?>
