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


/**
 * Administration backend
 *
 * This is used as global startpage for the
 * administraion backend.
 *
 * @version 1.3.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
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


/*
	init
	includes
	and languages
*/

// define system
define('_TCMS_VALID', 1);

// include import loader
include_once('../tcms_kernel/tcms_loader.lib.php');

// load current active page
include_once('../../site.php');
if(!defined('_TCMS_PATH')) {
	define('_TCMS_PATH', '../../'.$tcms_site[0]['path']);
}

// import filesystem
using('toendacms.kernel.file', false, true);

$tcms_file = new tcms_file();


/*
	show site
	if the global var file exist
*/
if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/var.xml')) {
	// load language loader
	if(!defined('_TCMS_LANGUAGE_STARTPOINT')) {
		define('_TCMS_LANGUAGE_STARTPOINT', 'admin');
	}
	include_once('../language/lang_admin.php');
	
	
	// start now
	$noSEOFolder = false;
	
	if(!isset($site)) {
		$site = 'mod_start';
		
		$noSEOFolder = true;
	}
	
	if(!defined('_TCMS_BACKEND_MODULE')) {
		define('_TCMS_BACKEND_MODULE', $site);
	}
	
	// import classes
	include_once(_TCMS_PATH.'/tcms_global/database.php');
	include_once(_TCMS_PATH.'/tcms_global/mail.php');
	
	using('toendacms.kernel.time', false, true);
	using('toendacms.kernel.xml', false, true);
	using('toendacms.kernel.main', false, true);
	using('toendacms.kernel.script', false, true);
	using('toendacms.kernel.html', false, true);
	using('toendacms.kernel.gd', false, true);
	using('toendacms.kernel.sql', false, true);
	using('toendacms.kernel.components', false, true);
	using('toendacms.kernel.datacontainer_provider', false, true);
	using('toendacms.kernel.account_provider', false, true);
	using('toendacms.kernel.authentication', false, true);
	using('toendacms.kernel.configuration', false, true);
	using('toendacms.kernel.version', false, true);
	using('toendacms.kernel.import', false, true);
	
	include_once('../tcms_kernel/tcms_globals.lib.php');
	include_once('../tcms_kernel/pclzip/pclzip.lib.php');
	include_once('../tcms_kernel/phpmailer/class.phpmailer.php');
	
	if($tcms_file->checkFileExist('../js/FCKeditor/fckeditor.php')) {
		include_once('../js/FCKeditor/fckeditor.php');
	}
	
	
	// timer
	$tcms_time = new tcms_time();
	
	$tcms_time->startTimer();
	$tcms_time->startSqlQueryCounter();
	
	
	// version info object
	$tcms_version = new tcms_version('../../');
	
	
	// config
	$tcms_config = new tcms_configuration(_TCMS_PATH);
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
	
	
	// imagepath
	if($noSEOFolder) {
		$imagePath = '../../';
	}
	else {
		$imagePath = '../../'.$seoFolder.'/';
	}
	
	// mainclass
	$tcms_main = new tcms_main(_TCMS_PATH, $tcms_time);
	
	// authentication
	$tcms_auth = new tcms_authentication(_TCMS_PATH, $c_charset, $imagePath);
	
	// account provider
	$tcms_ap = new tcms_account_provider(_TCMS_PATH, $c_charset, $tcms_time);
	
	// html
	$tcms_html = new tcms_html();
	
	// datacontainer
	$tcms_dcp = new tcms_datacontainer_provider(_TCMS_PATH, $c_charset, $tcms_time);
	
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
	$tcms_config->decodeConfiguration($tcms_main);
	$tcms_main->setTcmsConfigObj($tcms_config);
	
	
	// layout
	$theme      = $tcms_config->getFrontendTheme();
	$adminTheme = $tcms_config->getAdminTheme();
	
	
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
	if($param_save_mode) {
		$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'off');
	}
	
	$upload_max_filesize = $tcms_main->getUploadMaxSizeInBytes();
	$post_max_size = $tcms_main->getPostMaxSizeInBytes();
	
	
	
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
	$websiteowner = $tcms_config->getWebpageOwner();
	$owner_url    = $tcms_config->getWebpageOwnerUrl();
	$copyright    = $tcms_config->getWebpageCopyright();
	
	
	$tcms_cs = new tcms_cs(_TCMS_PATH, '../../', true);
	
	
	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<title>'.( trim($websiteowner) == '' ? '' : $websiteowner.' | ' )._TCMS_ADMIN_TITLE.'</title>
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

<script language="javascript" src="../js/browsercheck.js"></script>
<script language="JavaScript" src="../js/dhtml.js"></script>
<script language="JavaScript" src="../js/menu.js"></script>
<script language="JavaScript" src="../js/edit.js"></script>
<script language="JavaScript" src="../js/ajax.js"></script>
<script language="JavaScript" src="../js/jscrypt.js"></script>

<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../js/tinymce/tiny_mce.js"></script>

<!-- overLib -->
<script language="JavaScript" src="../js/overlib/overlib_mini.js"></script>

<!-- JSCookMenu -->
<script language="JavaScript" src="../js/JSCookMenu/JSCookMenu.js"></script>
<style type="text/css">@import "theme/'.$adminTheme.'/JSCookMenu/theme.css";</style>
<script language="JavaScript" src="theme/'.$adminTheme.'/JSCookMenu/theme.js" type="text/javascript"></script>

<!-- dTree -->
<script type="text/javascript" src="../js/dtree/dtree.js"></script>
<style type="text/css">@import "../js/dtree/dtree.css";</style>

<!-- tabPane -->
<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->

<!-- jsCalendar -->
<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>
<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />


<!-- toendaCMS Styles -->
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_main.css";</style>
<style type="text/css">@import "theme/'.$adminTheme.'/tcms_editor.css";</style>
<style> html { margin: 0px !important; padding: 0px !important; } </style>
'.( file_exists('theme/'.$adminTheme.'/tcms_main_ie.css') ?
'<!--[if lte IE 6]><style type="text/css">@import "theme/'.$adminTheme.'/tcms_main_ie.css";</style><![endif]-->
<!--[if IE 7]><style type="text/css">@import "theme/'.$adminTheme.'/tcms_main_ie.css";</style><![endif]-->'
: '' ).'

</head>
';
	
	include_once('theme/'.$adminTheme.'/tcms_color.php');
	
	
	echo '<body'.( _TCMS_BACKEND_MODULE == 'mod_upload_layout' ? ' onload="init();"' : '' ).'>'
	.'<a name="top"></a>';
	
	
	/*
		Login?
	*/
	if(isset($id_user)) {
		if($choosenDB == 'xml') {
			if($_GET['setXMLSession'] == 1) {
				if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_session/'.$id_user)){
					$file = new tcms_file(_TCMS_PATH.'/tcms_session/'.$id_user, 'r');
					$ws_id = $file->Read();
					
					$file->ChangeFile('session/'.$id_user, 'w');
					$file->Write($ws_id);
					$file->Close();
					
					$file->DeleteCustom(_TCMS_PATH.'/tcms_session/'.$id_user);
				}
			}
		}
		
		
		
		/*
			Check session
		*/
		$tcms_auth->cleanupOutdatedSessions($id_user, 1);
		$check_session = $tcms_auth->checkSessionExist($id_user, true);
		
		if($check_session) {
			$arr_ws = $tcms_ap->getUserInfo($id_user, true);
			
			$id_name     = $arr_ws['name'];
			$id_username = $arr_ws['user'];
			$id_uid      = $arr_ws['id'];
			$id_group    = $arr_ws['group'];
			
			$m_tag       = $id_uid;
			
			if($id_group == 'Administrator'
			|| $id_group == 'Developer'
			|| $id_group == 'Editor'
			|| $id_group == 'Writer') {
				$canEdit = true;
			}
			else {
				$canEdit = false;
			}
			
			
			
			/*
				Load Layout
			*/
			if($canEdit) {
				include_once('../tcms_kernel/tcms_array.lib.php');
				include_once('../tcms_kernel/tcms_freemenu.lib.php');
				
				
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
				
				include('modules/'._TCMS_BACKEND_MODULE.'.php');
						
				echo '</div>'
				.'</td></tr>';
				
				
				// footer
				echo '<tr><td colspan="2" height="45" class="tcms_footer" valign="bottom">'
				.'<div class="tcms_footer_img">&nbsp;</div>'
				.'<div class="legal tcms_footer_color">';
				
				echo '<strong>'.$version.' &bull;</strong>&nbsp;'
				._MSG_PAGE_LOAD_1.'&nbsp;'.$tcms_time->getCurrentTimerValue().'&nbsp;'._MSG_PAGE_LOAD_2;
				
				if($choosenDB != 'xml'){
					echo '.&nbsp;'.$tcms_time->getSqlQueryCountValue();
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
	unset($tcms_time);
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
if($todo == 'logout') {
	// authentication
	$tcms_auth = new tcms_authentication(_TCMS_PATH, $c_charset, '', $tcms_time);
	
	$tcms_auth->doLogout($id_user, true);
	
	echo '<script>document.location.href=\'index.php\';</script>';
}
	

?>
