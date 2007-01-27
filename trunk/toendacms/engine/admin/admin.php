<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Administration backend
|
| File:	admin.php
|
+
*/


if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }
if(isset($_GET['site'])){ $site = $_GET['site']; }
if(isset($_GET['todo'])){ $todo = $_GET['todo']; }
if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['maintag'])){ $maintag = $_GET['maintag']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['lang'])){ $lang = $_GET['lang']; }

if(isset($_POST['id_user'])){ $id_user = $_POST['id_user']; }
if(isset($_POST['site'])){ $site = $_POST['site']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['id'])){ $id = $_POST['id']; }
if(isset($_POST['maintag'])){ $maintag = $_POST['maintag']; }
if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['lang'])){ $lang = $_POST['lang']; }


/**
 * Administration backend
 *
 * This is used as global startpage for the
 * administraion backend.
 *
 * @version 1.1.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


/*
	init
	includes
	and languages
*/

define('_TCMS_VALID', 1);

include_once('../../site.php');
$tcms_administer_site = $tcms_site[0]['path'];
$tcms_administer_path = '../../'.$tcms_site[0]['path'];

include_once('../tcms_kernel/tcms_loader.lib.php');


/*
	show site
	if the global var file exist
*/
if(file_exists('../../'.$tcms_administer_site.'/tcms_global/var.xml')){
	$language_stage = 'admin';
	include_once('../language/lang_admin.php');
	
	
	if(!isset($site))
		$site = 'mod_start';
	
	include_once($tcms_administer_path.'/tcms_global/database.php');
	include_once($tcms_administer_path.'/tcms_global/mail.php');
	
	include_once('../tcms_kernel/tcms_time.lib.php');
	include_once('../tcms_kernel/tcms_xml.lib.php');
	include_once('../tcms_kernel/tcms.lib.php');
	using('toendacms.kernel.script', false, true);
	include_once('../tcms_kernel/tcms_html.lib.php');
	include_once('../tcms_kernel/pclzip/pclzip.lib.php');
	include_once('../tcms_kernel/tcms_gd.lib.php');
	include_once('../tcms_kernel/tcms_sql.lib.php');
	include_once('../tcms_kernel/tcms_file.lib.php');
	include_once('../tcms_kernel/tcms_components.lib.php');
	using('toendacms.kernel.datacontainer_provider', false, true);
	using('toendacms.kernel.account_provider', false, true);
	include_once('../tcms_kernel/tcms_authentication.lib.php');
	include_once('../tcms_kernel/tcms_configuration.lib.php');
	include_once('../tcms_kernel/tcms_version.lib.php');
	include_once('../tcms_kernel/tcms_import.lib.php');
	include_once('../tcms_kernel/tcms_globals.lib.php');
	
	include_once('../tcms_kernel/phpmailer/class.phpmailer.php');
	
	if(file_exists('../js/FCKeditor/fckeditor.php'))
		include_once('../js/FCKeditor/fckeditor.php');
	
	
	// version info object
	$tcms_version = new tcms_version('../../');
	
	
	// config
	$tcms_config = new tcms_configuration($tcms_administer_path);
	$c_charset       = $tcms_config->getCharset();
	$show_wysiwyg    = $tcms_config->getWYSIWYGEditor();
	$topmenu_active  = $tcms_config->getTopmenuEnabled();
	$sidemenu_active = $tcms_config->getSidemenuEnabled();
	$adminTopmenu    = $tcms_config->getAdminTopmenu();
	$seoEnabled      = $tcms_config->getSEOEnabled();
	$tcms_path       = $tcms_config->getSEOPath();
	$seoFolder       = $tcms_path;
	//$seoFormat       = $tcms_config->getSEOFormat();
	$tcms_lang       = $tcms_config->getLanguageBackend();
	$tcms_front_lang = $tcms_config->getLanguageFrontend();
	
	// mainclass
	$tcms_main = new tcms_main($tcms_administer_path);
	
	// authentication
	$tcms_auth = new tcms_authentication($tcms_administer_path, $c_charset, '');
	
	// account provider
	$tcms_ap = new tcms_account_provider($tcms_administer_path, $c_charset);
	
	// html
	$tcms_html = new tcms_html();
	
	// datacontainer
	$tcms_dcp = new tcms_datacontainer_provider($tcms_administer_path, $c_charset);
	
	// image class
	$tcms_gd = new tcms_gd();
	
	
	// database
	$choosenDB = $tcms_db_engine;
	$sqlUser   = $tcms_db_user;
	$sqlPass   = $tcms_db_password;
	$sqlHost   = $tcms_db_host;
	$sqlDB     = $tcms_db_database;
	$sqlPort   = $tcms_db_port;
	$sqlPrefix = $tcms_db_prefix;
	
	$tcms_main->setDatabaseInfo($choosenDB);
	
	
	// layout
	$c_xml      = new xmlparser($tcms_administer_path.'/tcms_global/layout.xml', 'r');
	$theme      = $c_xml->read_section('layout', 'select');
	$adminTheme = $c_xml->read_section('layout', 'admin');
	$c_xml->flush();
	$c_xml->_xmlparser();
	
	
	// mail
	$mail_with_smtp   = $tcms_mail_with_smtp;
	$mail_as_html     = $tcms_mail_as_html;
	$mail_server_pop3 = $tcms_mail_server_pop3;
	$mail_server_smtp = $tcms_mail_server_smtp;
	$mail_port        = $tcms_mail_port;
	$mail_pop3        = $tcms_mail_pop3;
	$mail_user        = $tcms_mail_user;
	$mail_password    = $tcms_mail_password;
	
	
	$param_save_mode = $tcms_main->getPHPSetting('safe_mode');
	if($param_save_mode)
		$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'off');
	
	
	
	/*
		VERSION
	*/
	$release      = $tcms_version->getVersion();
	$codename     = $tcms_version->getCodename();
	$status       = $tcms_version->getState();
	$build        = $tcms_version->getBuild();
	$cms_name     = $tcms_version->getName();
	$cms_tagline  = $tcms_version->getTagline();
	$release_date = $tcms_version->getReleaseDate();
	$toenda_copy  = $tcms_version->getToendaCopyright();
	
	$version = ''
	.$tcms_version->getName().' - '.$tcms_version->getTagline().'!'
	.' &bull; Version '.$tcms_version->getVersion()
	.' ['.$tcms_version->getCodename().']';
	
	$cms_version = $release;
	$cms_build = $build;
	
	
	
	/*
		COPYRIGHT
	*/
	$foot_xml = new xmlparser($tcms_administer_path.'/tcms_global/footer.xml','r');
	$websiteowner = $foot_xml->read_section('footer', 'websiteowner');
	$owner_url    = $foot_xml->read_section('footer', 'owner_url');
	$copyright    = $foot_xml->read_section('footer', 'copyright');
	$foot_xml->flush();
	$foot_xml->_xmlparser();
	
	$websiteowner = $tcms_main->decodeText($websiteowner, '2', $c_charset);
	$owner_url    = $tcms_main->decodeText($owner_url, '2', $c_charset);
	$copyright    = $tcms_main->decodeText($copyright, '2', $c_charset);
	
	
	$tcms_cs = new tcms_cs($tcms_administer_site, '../../', true);
	
	
	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<title>'.$websiteowner.' | '._TCMS_ADMIN_TITLE.'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
<!--
 This website is powered by '.$cms_name.' - '.$cms_tagline.'!
 Version '.$cms_version.' - '.$cms_build.'
 '.$cms_name.' is a free open source Content Management Framework created by Jonathan Naumann and licensed under the GNU/GPL license.
 '.$cms_name.' is copyright (c) '.$toenda_copy.' of Toenda Software Development.
 Components are copyright (c) of their respective owners.
 Information and contribution at http://toendacms.com
-->
<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" />
<link rel="shortcut icon" href="../images/favicon.png">
<script language="JavaScript" src="../js/dhtml.js"></script>
<script language="JavaScript" src="../js/menu.js"></script>
<script language="JavaScript" src="../js/edit.js"></script>
<script language="JavaScript" src="../js/ajax.js"></script>

<!-- overLib -->
<script language="JavaScript" src="../js/overlib/overlib_mini.js"></script>

<!-- JSCookMenu -->
<script language="JavaScript" src="../js/JSCookMenu/JSCookMenu.js"></script>
<style type="text/css">@import "theme/'.$adminTheme.'/JSCookMenu/theme.css";</style>
<script language="JavaScript" src="theme/'.$adminTheme.'/JSCookMenu/theme.js" type="text/javascript"></script>

<!-- dTree -->
<script type="text/javascript" src="../js/dtree/dtree.js"></script>
<style type="text/css">@import "../js/dtree/dtree.css";</style>

<!-- toendaCMS Styles -->
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_main.css";</style>
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_editor.css";</style>
<style> html { margin: 0px !important; padding: 0px !important; } </style>
'.( file_exists('theme/'.$adminTheme.'/tcms_main_ie.css') ?
'<!--[if lte IE 6]>
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_main_ie.css";</style>
<![endif]-->
<!--[if IE 7]>
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_main_ie.css";</style>
<![endif]-->'
: '' ).'

</head>
';
	
	include_once('theme/'.$adminTheme.'/tcms_color.php');
	
	tcms_time::tcms_load_start();
	tcms_time::tcms_query_count_start();
	
	
	echo '<body'.( $site == 'mod_upload_layout' ? ' onload="init();"' : '' ).'>'
	.'<a name="top"></a>';
	
	
	/*
		Login?
	*/
	if(isset($id_user)){
		if($choosenDB == 'xml'){
			if($_GET['setXMLSession'] == 1){
				if(file_exists($tcms_administer_path.'/tcms_session/'.$id_user)){
					$tcms_file = new tcms_file($tcms_administer_path.'/tcms_session/'.$id_user, 'r');
					$ws_id = $tcms_file->Read();
					
					$tcms_file->ChangeFile('session/'.$id_user, 'w');
					$tcms_file->Write($ws_id);
					$tcms_file->Close();
					
					$tcms_file->DeleteCustom($tcms_administer_path.'/tcms_session/'.$id_user);
				}
			}
		}
		
		
		
		/*
			Check session
		*/
		if($choosenDB == 'xml')
			$tcms_main->check_session($id_user, 'admin');
		else
			$tcms_main->check_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
		
		
		if($choosenDB == 'xml'){
			if(isset($id_user) && $id_user != '' && file_exists('session/'.$id_user) && filesize('session/'.$id_user) != 0)
				$check_session = true;
			else
				$check_session = false;
		}
		else{
			$check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
		}
		
		if($check_session){
			if($choosenDB == 'xml'){
				$m_tag = $tcms_main->create_admin($id_user);
			}
			else{
				$arr_ws = $tcms_main->create_sql_username($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
				$m_tag = $arr_ws['id'];
			}
		}
		
		
		if($check_session){
			if($choosenDB == 'xml'){
				$xml = new xmlparser($tcms_administer_path.'/tcms_user/'.$m_tag.'.xml','r');
				$id_name     = $xml->read_section('user', 'name');
				$id_username = $xml->read_section('user', 'username');
				$id_group    = $xml->read_section('user', 'group');
				$id_uid      = $m_tag;
				$xml->flush();
				$xml->_xmlparser();
				
				$id_name     = $tcms_main->decodeText($id_name, '2', $c_charset);
				$id_username = $tcms_main->decodeText($id_username, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'user', $m_tag);
				$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
				
				$id_name     = $sqlObj->name;
				$id_username = $sqlObj->username;
				$id_group    = $sqlObj->group;
				$id_uid      = $sqlObj->uid;
				
				$id_name     = $tcms_main->decodeText($id_name, '2', $c_charset);
				$id_username = $tcms_main->decodeText($id_username, '2', $c_charset);
				
				if($id_name     == NULL){ $id_name     = ''; }
				if($id_username == NULL){ $id_username = ''; }
				if($id_group    == NULL){ $id_group    = ''; }
			}
			
			if($id_group == 'Administrator'
			|| $id_group == 'Developer'
			|| $id_group == 'Editor'
			|| $id_group == 'Writer'){
				$canEdit = true;
			}
			else{
				$canEdit = false;
			}
			
			
			
			/*
				Load Layout
			*/
			if($canEdit){
			 	include_once ('../tcms_kernel/tcms_array.lib.php');
				include_once ('../tcms_kernel/tcms_freemenu.lib.php');
				
				
				echo '<table cellpadding="0" cellspacing="0" border="0" '
				.'width="100%" height="100%" class="noborder tcms_pagebody">';
				
				
				// header
				echo '<tr height="40"><td align="left" colspan="2" height="40" valign="top" class="tcms_header">'
				.'<div class="tcms_header_left">&nbsp;</div>'
				.'<div class="tcms_header_right">&nbsp;</div>'
				.'</td></tr>';
				
				// menu
				echo '<tr height="63"><td colspan="2" valign="top" height="63">';
				
				include('admin_top_menu.php');
				
				echo '</td></tr>';
				
				
				// sidebar + content
				echo '<tr><td valign="top" width="200" height="100%" class="tcms_main_box_fm">';
				
				include('modules/mod_project.php');
				
				echo '</td>'
				.'<td valign="top" height="100%" width="100%">'
				.'<div class="tcms_main_body_padding">';
				
				include('modules/'.$site.'.php');
						
				echo '</div>'
				.'</td></tr>';
				
				
				// footer
				echo '<tr><td colspan="2" height="45" class="tcms_footer" valign="bottom">'
				.'<div class="tcms_footer_img">&nbsp;</div>'
				.'<div class="legal tcms_footer_color">';
				
				$page_load_time = tcms_time::tcms_load_end();
				
				echo '<strong>'.$version.' &bull;</strong> '.$page_load_time;
				
				if($choosenDB != 'xml'){
					$page_query_count = tcms_time::tcms_query_count_end_out();
					echo '.&nbsp;'.$page_query_count;
				}
				
				echo '<br />'._TCMS_ADMIN_DEV
				.'&nbsp;<a class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a> &copy; '
				.$toenda_copy.' '._TCMS_ADMIN_RIGHT;
				
				echo '</div>'
				.'</td></tr>'
				.'</table>';
				
			}
			else{
				echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
			}
		}
		else{
			echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
			.'<h1>'._MSG_SESSION_EXPIRED.'</h2>'
			.'</div>';
		}
	}
	else{
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<h1>'._DIE_LOGIN.'</h2>'
		.'</div>';
	}
	
	
	echo '
	</body>
	</html>
	';
	
	
	// clean up
	unset($tcms_version);
	unset($tcms_config);
	unset($tcms_main);
}
else{
	echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
	.'<img src="../images/tcms_top.jpg" border="0" />'
	.'<h1>toendaCMS Error 500: Internal Error!</h1>'
	.'<h2>var.xml File is missing</h2>'
	.'</div>';
}



/*
	Logout
*/
if($todo == 'logout'){
	$tcms_auth->doLogout($id_user, true);
	
	echo '<script>document.location.href=\'index.php\';</script>';
}
	

?>
