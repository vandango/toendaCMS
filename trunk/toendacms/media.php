<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| JavaScript Window for ImageGallery
|
| File:	media.php
|
+
*/


/**
 * JavaScript Window for ImageGallery
 *
 * This module is used as a image viewer.
 *
 * @version 0.8.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


if(isset($_GET['album'])) { $album = $_GET['album']; }
if(isset($_GET['key'])) { $key = $_GET['key']; }
if(isset($_GET['cmd'])) { $cmd = $_GET['cmd']; }
if(isset($_GET['uid'])) { $uid = $_GET['uid']; }
if(isset($_GET['defaultSizeX'])) { $defaultSizeX = $_GET['defaultSizeX']; }
if(isset($_GET['defaultSizeY'])) { $defaultSizeY = $_GET['defaultSizeY']; }
if(isset($_GET['session'])) { $session = $_GET['session']; }
if(isset($_GET['XMLplace'])) { $XMLplace = $_GET['XMLplace']; }
if(isset($_GET['XMLfile'])) { $XMLfile = $_GET['XMLfile']; }

if(isset($_POST['session'])) { $session = $_POST['session']; }
if(isset($_POST['album'])) { $album = $_POST['album']; }
if(isset($_POST['key'])) { $key = $_POST['key']; }
if(isset($_POST['cmd'])) { $cmd = $_POST['cmd']; }
if(isset($_POST['uid'])) { $uid = $_POST['uid']; }
if(isset($_POST['comment_name'])) { $comment_name = $_POST['comment_name']; }
if(isset($_POST['comment_email'])) { $comment_email = $_POST['comment_email']; }
if(isset($_POST['comment_web'])) { $comment_web = $_POST['comment_web']; }
if(isset($_POST['comment_text'])) { $comment_text = $_POST['comment_text']; }
if(isset($_POST['comment_captcha'])) { $comment_captcha = $_POST['comment_captcha']; }
if(isset($_POST['check_captcha'])) { $check_captcha = $_POST['check_captcha']; }


/*
	INIT GLOBAL
*/

// define system
define('_TCMS_VALID', 1);

// default values
if(!isset($defaultSizeX)) {
	$defaultSizeX = '640';
}

if(!isset($defaultSizeY)) {
	$defaultSizeY = '480';
}

$sidebarWidth = 250;

if(!isset($dvalue)) {
	$dvalue = '';
}

// include import loader
include_once('engine/tcms_kernel/tcms_loader.lib.php');

// load current active page
include_once('site.php');
define('_TCMS_PATH', $tcms_site[0]['path']);

// load database info
if(file_exists(_TCMS_PATH.'/tcms_global/database.php')) {
	require(_TCMS_PATH.'/tcms_global/database.php');
	
	$choosenDB = $tcms_db_engine;
	$sqlUser   = $tcms_db_user;
	$sqlPass   = $tcms_db_password;
	$sqlHost   = $tcms_db_host;
	$sqlDB     = $tcms_db_database;
	$sqlPort   = $tcms_db_port;
	$sqlPrefix = $tcms_db_prefix;
}

// import classes
using('toendacms.kernel.time');
using('toendacms.kernel.xml');
using('toendacms.kernel.parameter');
using('toendacms.kernel.configuration');
using('toendacms.kernel.version');
using('toendacms.kernel.html');
using('toendacms.kernel.main');
using('toendacms.kernel.sql');
using('toendacms.kernel.file');
using('toendacms.kernel.datacontainer_provider');
using('toendacms.kernel.authentication');
using('toendacms.kernel.account_provider');
using('toendacms.kernel.gd');

// time class
$tcms_time = new tcms_time();

$tcms_time->startTimer();
if(isset($choosenDB) && $choosenDB != 'xml') {
	$tcms_time->startSqlQueryCounter();
}

// params
$tcms_param = new tcms_parameter();

// html class
$tcms_html = new tcms_html();

// filehandler
$tcms_file = new tcms_file();

// load config
if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/var.xml')) {
	$tcms_version = new tcms_version();
	$tcms_config  = new tcms_configuration(_TCMS_PATH);
	
	$c_charset   = $tcms_config->getCharset();
	$seoFolder   = $tcms_config->getSEOPath();
	$seoEnabled  = $tcms_config->getSEOEnabled();
	$seoFormat   = $tcms_config->getSEOFormat();
	$use_captcha = $tcms_config->getCaptchaEnabled();
	$tcmsinst    = $tcms_config->getToendaCMSInSitetitle();
	
	if(!isset($s)) {
		$s = $tcms_config->getFrontendTheme();
	}
	
	// main obj
	$tcms_main = new tcms_main(_TCMS_PATH, $tcms_time, $tcms_config);
	$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	$tcms_main->setDatabaseInfo($choosenDB);
	
	$tcms_config->decodeConfiguration($tcms_main);
	
	
	/*
		language
	*/
	if(!defined('_TCMS_LANGUAGE_STARTPOINT')) {
		define('_TCMS_LANGUAGE_STARTPOINT', 'index');
	}
	include_once('engine/language/lang_admin.php');
	
	
	/*
		load page now
	*/
	if($choosenDB == 'xml') {
		$xml = new xmlparser(
			_TCMS_PATH.'/tcms_albums/album_'.$album.'.xml', 
			'r'
		);
		
		$album_title = $xml->readSection('album', 'title');
		
		$xml->flush();
		unset($xml);
		
		$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
	}
	else {
		$sqlAL = new sqlAbstractionLayer(
			$choosenDB, 
			$tcms_time
		);
		
		$sqlCN = $sqlAL->connect(
			$sqlUser, 
			$sqlPass, 
			$sqlHost, 
			$sqlDB, 
			$sqlPort
		);
		
		$sqlQR = $sqlAL->query("SELECT * FROM ".$sqlPrefix."albums WHERE album_id = '".$album."'");
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$album_title = $sqlObj->title;
		
		$sqlAL->freeResult($sqlQR);
		unset($sqlAL);
		
		$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
	}
	
	// imagepath
	if($seoEnabled == 1) {
		if($seoFolder != '') {
			$imagePath = '/'.$seoFolder.'/';
		}
		else {
			$imagePath = '/';
		}
	}
	else {
		$imagePath = '';
	}
	
	// authentication
	$tcms_auth = new tcms_authentication(_TCMS_PATH, $c_charset, $imagePath);
	
	// account provider
	$tcms_ap = new tcms_account_provider(_TCMS_PATH, $c_charset);
	
	// datacontainer provider
	$tcms_dcp = new tcms_datacontainer_provider(_TCMS_PATH, $c_charset);
	
	// gd
	$tcms_gd = new tcms_gd();
	
	// load images
	using('toendacms.datacontainer.imagegallery');
	
	$dcIG = new tcms_dc_imagegallery();
	$dcIG = $tcms_dcp->getImagegalleryDC();
	
	
	/*
		generate html header
	*/
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>'.( $tcmsinst == 1 ? 'toendaCMS ' : '' ).'Imagebrowser | '.$tcms_config->getSiteTitle().'</title>
	<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
	<meta name="generator" content="'.$tcms_version->getName().' - '.$tcms_version->getTagline().'! - Version '.$tcms_version->getVersion().' '.$tcms_version->getBuild().' | Copyright '.$tcms_version->getToendaCopyright().' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" />
	
	<!-- CSS files from current theme -->';
	
	$arrCSS = $tcms_file->getPathContentCSSFilesRecursivly('theme/'.$s);
	
	if($tcms_main->isArray($arrCSS)) {
		foreach($arrCSS['files'] as $cssKey => $cssVal) {
			echo '
	<link href="theme/'.$s.'/'.$arrCSS['dir'][0].'/'.$arrCSS['files'][$cssKey].'" rel="stylesheet" type="text/css" />
			';
		}
	}
	
	echo '
	<!--
	 This website is powered by '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!
	 Version '.$tcms_version->getVersion().' - '.$tcms_version->getBuild().'
	 '.$tcms_version->getName().' is a free open source Content Management Framework created by Jonathan Naumann and licensed under the GNU/GPL license.
	 '.$tcms_version->getName().' is copyright (c) '.$tcms_version->getToendaCopyright().' of Toenda Software Development.
	 Components are copyright (c) of their respective owners.
	 Information and contribution at http://www.toendacms.org
	-->
	
	<style>
	
	body {
		margin: 0;
		padding: 0;
		background: #fff !important;
		font-size: 12px;
		font-family: Verdana, Arial, Helvetica, Sans;
	}
	
	#media {
		margin: 0 auto 0 auto;
		width: 100%;
		padding: 0;
		background: #fff !important;
	}
	
	a.media { text-decoration: none; }
	a.media:hover { text-decoration: underline; }
	
	.text {
		color: #555;
		font-size: 12px;
	}
	
	.topcorner {
		 margin: 0 auto 0 auto;
		 padding: 4px 0 4px 0;
		 background: #efefef;
		 border: 1px solid #ccc;
		 border-top: 0px;
	}
	
	.t1 {
		font-family: "Century Gothic", "Lucida Grande", Verdana, Arial, Sans-Serif;
		font-size: 15px;
	}
	
	.t2 {
		font-family: "Century Gothic", "Lucida Grande", Verdana, Arial, Sans-Serif;
		font-size: 12px;
	}
	
	</style>
	</head>
	<body>
	<div id="media">
	';
	
	
	/*
		generate html content
	*/
	
	$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/albums/'.$album.'/');
	
	if($tcms_main->isArray($arr_dir)) {
		if($choosenDB == 'xml') {
			$timecc = 0;
			
			foreach($arr_dir as $akey => $aval) {
				$des_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$album.'/'.$aval.'.xml','r');
				
				$arr_tc['time'][$timecc] = $des_xml->readSection('image', 'timecode');
				$arr_tc['desc'][$timecc] = $des_xml->readSection('image', 'text');
				$arr_tc['file'][$timecc] = $aval;
				$arr_tc['uid'][$timecc]  = $aval;
				
				$des_xml->flush();
				unset($des_xml);
				
				$arr_tc['desc'][$timecc]  = $tcms_main->decodeText($arr_tc['desc'][$timecc], '2', $c_charset);
				
				$timecc++;
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getAll($sqlPrefix."imagegallery WHERE album='".$album."'");
			
			$timecc = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arr_tc['uid'][$timecc]  = $sqlObj->uid;
				$arr_tc['time'][$timecc] = $sqlObj->date;
				$arr_tc['desc'][$timecc] = $sqlObj->text;
				$arr_tc['file'][$timecc] = $sqlObj->image;
				
				if($arr_tc['time'][$timecc] == NULL) { $arr_tc['time'][$timecc] = ''; }
				if($arr_tc['desc'][$timecc] == NULL) { $arr_tc['desc'][$timecc] = ''; }
				if($arr_tc['file'][$timecc] == NULL) { $arr_tc['file'][$timecc] = ''; }
				
				$arr_tc['desc'][$timecc]  = $tcms_main->decodeText($arr_tc['desc'][$timecc], '2', $c_charset);
				
				$timecc++;
			}
		}
		
		if(is_array($arr_tc)) {
			array_multisort(
				$arr_tc['time'], SORT_DESC, 
				$arr_tc['desc'], SORT_DESC, 
				$arr_tc['file'], SORT_DESC, 
				$arr_tc['uid'], SORT_DESC
			);
		}
	}
	
	
	
	// ----------------------------------------------------
	// DISPLAY IMAGE
	// ----------------------------------------------------
	
	if($tcms_main->isArray($arr_tc['time'])) {
		foreach($arr_tc['time'] as $iKey => $iVal) {
			if($key == $arr_tc['file'][$iKey]) {
				echo '<div align="center">';
				
				$img_size = getimagesize(_TCMS_PATH.'/images/albums/'.$album.'/'.$arr_tc['file'][$iKey]);
				$img_o_width  = $img_size[0];
				$img_o_height = $img_size[1];
				
				
				echo '<div style="width: '.( $defaultSizeX + $sidebarWidth ).'px;" align="left" class="topcorner">';
				echo '<strong class="t1" style="padding: 0 0 0 10px; color: #333;">'.$tcms_config->getSiteName().'</strong><br />';
				echo '<strong class="t2" style="padding: 0 0 0 10px; color: #333;">'.$tcms_config->getSiteKey().'</strong>';
				echo '</div>';
				
				
				echo '<br /><div style="width: '.( $defaultSizeX + $sidebarWidth ).'px; margin: 0 auto 0 auto; background: #fff; padding: 7px;" align="left">';
				echo '<h1 style="color: #4477aa;">'
				._TABLE_IMAGE.' '.$tcms_main->cutLongStringToShortString($arr_tc['file'][$iKey], 40)
				.' <a style="color: #4477aa; font-size: 11px;" href="javascript:self.close();" title="'._TCMS_ADMIN_CLOSE.'">('._TCMS_ADMIN_CLOSE.')</a></h1>';	
				echo '<hr class="hr_line" noshade="noshade" />';
				echo '</div>';
				
				
				/**********************
				*
				* HTML Thumbnail list
				*/
				
				echo $tcms_html->tableHeadClass('0', '0', '0', ( $defaultSizeX + $sidebarWidth ), 'text_small');
				echo '<tr>';
				echo '<td align="center" width="'.( $defaultSizeX ).'">';
				
				if($img_o_width > $defaultSizeX) {
					if(!is_dir(_TCMS_PATH.'/thumbnails/'.$album.'/')) {
						mkdir(_TCMS_PATH.'/thumbnails/'.$album.'/', 0777);
					}
					
					if(!$tcms_file->checkFileExist(_TCMS_PATH.'/thumbnails/'.$album.'/medium_thumb_'.$arr_tc['file'][$iKey])) {
						tcms_gd::gd_thumbnail(_TCMS_PATH.'/images/albums/'.$album.'/', _TCMS_PATH.'/thumbnails/'.$album.'/medium_', $arr_tc['file'][$iKey], $defaultSizeX, 'create');
					}
					
					echo '<img alt="" style="border: 1px solid #333; background: #eee; margin: 0 0 10px 0;" src="'._TCMS_PATH.'/thumbnails/'.$album.'/medium_thumb_'.$arr_tc['file'][$iKey].'" border="0" /><br />'
					.'</span>';
				}
				else {
					echo '<img alt="" style="border: 1px solid #333; background: #eee; margin: 0 0 10px 0;" src="'._TCMS_PATH.'/images/albums/'.$album.'/'.$arr_tc['file'][$iKey].'" border="0" /><br />'
					.'</span>';
				}
				echo '</td>';
				
				
				
				echo '<td valign="top" width="20">';
				echo '</td>';
				
				
				
				echo '<td valign="top" align="center" width="'.$sidebarWidth.'" style="background: #efefef; border: 1px solid #ccc;"><br />';
				
				echo '<div style="display: block; height: 90px;">';
				
				if(!empty($arr_tc['file'][$iKey - 1])) {
					echo '<a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.($arr_tc['file'][$iKey - 1]).'">'
					.'<img style="border: 1px solid #ccc; margin-right: 3px; background: #eee;" src="'._TCMS_PATH.'/thumbnails/'.$album.'/thumb_'.$arr_tc['file'][$iKey - 1].'" border="0" />'
					.'</a>';
				}
				else {
					echo '<img style="border: 1px solid #ccc; margin-right: 3px; background: #eee; width: 100px; height: 75px;" src="engine/images/no_picture.gif" border="0" />';
				}
				
				if(!empty($arr_tc['file'][$iKey + 1])) {
					echo '<a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.($arr_tc['file'][$iKey + 1]).'">'
					.'<img style="border: 1px solid #ccc; background: #eee;" src="'._TCMS_PATH.'/thumbnails/'.$album.'/thumb_'.$arr_tc['file'][$iKey + 1].'" border="0" />'
					.'</a>';
				}
				else {
					echo '<img style="border: 1px solid #ccc; background: #eee; width: 100px; height: 75px;" src="engine/images/no_picture.gif" border="0" />';
				}
				
				echo '</div>';
				
				//echo '<br />';
				
				if(!empty($arr_tc['file'][$iKey - 1])) {
					echo '<a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.($arr_tc['file'][$iKey - 1]).'">'
					.'<img src="engine/images/left.png" border="0" alt="'._TCMS_ADMIN_BACK.'" title="'._TCMS_ADMIN_BACK.'" />'
					.'</a>';
				}
				else { echo '<img style="width: 16px; height: 16px;" alt="" src="engine/images/px.png" border="0" />'; }
				
				echo '&nbsp;&nbsp;';
				
				if(!empty($arr_tc['file'][$iKey + 1])) {
					echo '<a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.($arr_tc['file'][$iKey + 1]).'">'
					.'<img src="engine/images/right.png" border="0" alt="'._TCMS_ADMIN_FORWARD.'" title="'._TCMS_ADMIN_FORWARD.'" />'
					.'</a>';
				}
				else { echo '<img style="width: 16px; height: 16px;" alt="" src="engine/images/px.png" border="0" />'; }
				
				
				echo '<div align="left" style="margin: 40px 0 0 10px;">'
				.'<span class="text">'
				.( $dcIG->getUseImageDetails() ? '<strong>'._TABLE_ALBUM.':</strong> '.$album_title.'<br />' : '' )
				.( $dcIG->getUseImageDetails() ? '<strong>'._GALLERY_IMGTITLE.':</strong> '.$arr_tc['file'][$iKey].'<br />' : '' )
				.( $dcIG->getUseImageDetails() ? '<strong>'._GALLERY_AMOUNT.':</strong> '.( $iKey + 1 ).'/'.$timecc.'<br />' : '' )
				.'<strong>'._GALLERY_IMGRESOLUTION.':</strong> <a class="media" href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.$arr_tc['file'][$iKey].'&amp;defaultSizeX='.$img_o_width.'">'.$img_o_width.'x'.$img_o_height.'</a><br />'
				.( $dcIG->getUseImageDetails() ? '<strong>'._GALLERY_POSTED.':</strong> '.lang_date(substr($iVal, 6, 2), substr($iVal, 4, 2), substr($iVal, 0, 4), substr($iVal, 8, 2), substr($iVal, 10, 2), substr($iVal, 12, 2)) : '' )
				.( $dcIG->getUseImageDetails() ? '<br /><br />' : '' )
				.'<strong>'._GALLERY_DESCRIPTION.'</strong><br />'
				.$arr_tc['desc'][$iKey]
				.'</span></div>';
				
				echo '</td>';
				
				echo '</tr>';
				echo $tcms_html->tableEnd();
				
				/*
				* End list
				*
				*********************/
				
				echo '</div>';
				
				$takeME = $iKey;
			}
		}
	}
	
	
	
	// ----------------------------------------------------
	// DISPLAY COMMENT
	// ----------------------------------------------------
	
	if($choosenDB == 'xml') {
		$pro_xml = new xmlparser(_TCMS_PATH.'/tcms_global/imagegallery.xml','r');
		$show_comments = $pro_xml->readSection('config', 'image_comments');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($sqlPrefix.'imagegallery_config', 'imagegallery');
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$show_comments = $sqlObj->use_comments;
		
		if($show_comments == NULL) { $show_comments = ''; }
	}
	
	
	if($choosenDB == 'xml') {
		$xml = new xmlparser(_TCMS_PATH.'/tcms_global/newsmanager.'.$tcms_config->getLanguageFrontend().'.xml','r');
		
		$use_gravatar  = $xml->readSection('config', 'use_gravatar');
		$use_emoticons = $xml->readSection('config', 'use_emoticons');
		
		$xml->flush();
		unset($xml);
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($sqlPrefix.'newsmanager', 'newsmanager');
		$sqlARR = $sqlAL->fetchObject($sqlQR);
		
		$use_gravatar  = $sqlObj>use_gravatar;
		$use_emoticons = $sqlObj->use_emoticons;
		
		if($use_gravatar  == NULL) { $use_gravatar  = ''; }
		if($use_emoticons == NULL) { $use_emoticons = ''; }
	}
	
	if($show_comments == 1) {
		/* Create userrights */
		// authentication
		
		$check_session = false;
		$check_session = $tcms_auth->checkSessionExist($session);
		
		if($check_session) {
			$arr_ws = $tcms_ap->getUserInfo($session);
			
			$ws_name  = $arr_ws['name'];
			$ws_user  = $arr_ws['user'];
			$ws_id    = $arr_ws['id'];
			$is_admin = $arr_ws['group'];
			
			if($is_admin == 'Administrator'
			|| $is_admin == 'Developer'
			|| $is_admin == 'Writer'
			|| $is_admin == 'Editor') {
				$site_offline = 0;
				$isTestEnvironment = true;
				
				echo $tcms_html->messageIsTestEnvironment();
			}
		}
		
		
		echo '<br />'
		.'<div style="width: '.( $defaultSizeX + $sidebarWidth ).'px; margin: 0 auto 0 auto; background: #fff; padding: 7px; text-align: left;" align="left">'
		.'<h1 style="color: #4477aa;">'._FRONT_COMMENTS.'</h1>'
		.'<hr class="hr_line" noshade="noshade" />'
		.'<br />'
		.'<a name="comments"></a>';
		
		//
		// JavaScript for checking inputs
		//
		?><script language="JavaScript">
		function checkinputs(id) {
			sendOK = true;
			
			if(document.getElementById(id).comment_name.value == '') {
				alert('<? echo _MSG_NONAME; ?>');
				document.getElementById(id).comment_name.focus();
				sendOK = false;
				return false;
			}
			
			if(document.getElementById(id).comment_email.value == '') {
				alert('<? echo _MSG_NOEMAIL; ?>');
				document.getElementById(id).comment_email.focus();
				sendOK = false;
				return false;
			}
			
			strEmail = document.getElementById(id).comment_email.value;
			if(strEmail.indexOf('@') == -1) {
				alert('<? echo _MSG_EMAILVALID; ?>');
				document.getElementById(id).comment_email.focus();
				sendOK = false;
				return false;
			}
			
			if(document.getElementById(id).comment_text.value == '') {
				alert('<? echo _MSG_NOMSG; ?>');
				document.getElementById(id).comment_text.focus();
				sendOK = false;
				return false;
			}
			
			if(sendOK) { document.getElementById(id).submit(); }
		}
		</script><?
		
		
		
		if($choosenDB == 'xml') {
			//$comments_folder = str_replace($tcms_file->getMimeType($key), '', $key);
			//$comments_folder = substr($comments_folder, 0, strlen($comments_folder) - 1);
			$comments_folder = $key;
			$comments_folder = _TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$comments_folder.'/';
			
			if(!$tcms_file->checkDirExist($comments_folder)) {
				$tcms_file->createDir($comments_folder);
			}
			
			$arr_comments = $tcms_file->getPathContent($comments_folder);
			
			if($tcms_main->isArray($arr_comments)) {
				foreach($arr_comments as $ackey => $acvalue) {
					$c_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$key.'/'.$acvalue,'r');
					
					$arr_c['value'][$ackey] = $acvalue;
					$arr_c['name'][$ackey]  = $c_xml->readSection('comment', 'name');
					$arr_c['email'][$ackey] = $c_xml->readSection('comment', 'email');
					$arr_c['web'][$ackey]   = $c_xml->readSection('comment', 'web');
					$arr_c['msg'][$ackey]   = $c_xml->readSection('comment', 'msg');
					$arr_c['time'][$ackey]  = $c_xml->readSection('comment', 'time');
					
					$c_xml->flush();
					unset($c_xml);
					
					$arr_c['msg'][$ackey] = $tcms_main->decodeText($arr_c['msg'][$ackey], '2', $c_charset);
				}
				
				array_multisort(
					$arr_c['time'], SORT_ASC, 
					$arr_c['name'], SORT_ASC, 
					$arr_c['email'], SORT_ASC, 
					$arr_c['msg'], SORT_ASC, 
					$arr_c['web'], SORT_ASC, 
					$arr_c['value'], SORT_ASC
				);
				
				$count = 1;
				
				foreach($arr_c['time'] as $cKey => $cVal) {
					if($use_gravatar == 1) {
						$grav_url = 'http://www.gravatar.com/avatar.php?gravatar_id='.md5($arr_c['email'][$cKey]).'&amp;default='.urlencode('http://www.somewhere.com/homestar.jpg').'&amp;size=32';
						echo '<a href="http://www.gravatar.com" title="What is this?" target="_blank"><img align="right" border="1" src="'.$grav_url.'" alt="?" /></a><br />';
					}
					
					echo '<strong class="comment_title">'.$count.'. ';
					if($arr_c['web'][$cKey] != '') { echo '<a href="'.$arr_c['web'][$cKey].'">'.$arr_c['name'][$cKey].'</a>'; }
					else { echo $arr_c['name'][$cKey]; }
					echo '</strong>';
					
					$time = $arr_c['time'][$cKey];
					echo '<span class="text_small" style="padding: 3px 0 0 3px;">'.lang_date(substr($time, 6, 2), substr($time, 4, 2), substr($time, 0, 4), substr($time, 8, 2), substr($time, 10, 2), substr($time, 12, 2)).'</span>';
					
					echo '<hr class="hr_line" noshade="noshade" />';
					
					
					$msg = $arr_c['msg'][$cKey];
					if($use_emoticons == 1)
						$msg = $tcms_main->replaceSmilyTags($msg, $imagePath);
					
					echo '<div class="comment_text" style="color: #222 !important;">';
					echo $msg;
					echo '</div>';
					
					$check_session = false;
					$check_session = $tcms_auth->checkSessionExist($session);
					
					if($check_session) {
						if($is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Tester') {
							echo '<a class="main" href="?'.( isset($session) ? 'session='.$session.'&' : '' ).'id='.$id.'&s='.$s.'&cmd=delete&XMLplace='.$news.'&XMLfile='.$arr_c['value'][$cKey].'"><strong>'._TCMS_ADMIN_DELETE.'</strong></a>';
						}
					}
					
					echo '<br /><br />';
					
					$count++;
				}
			}
			else {
				echo '<span style="color: #222 !important;">'._FRONT_NOCOMMENT.'</span><br />';
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer(
				$choosenDB, 
				$tcms_time
			);
			
			$sqlCN = $sqlAL->connect(
				$sqlUser, 
				$sqlPass, 
				$sqlHost, 
				$sqlDB, 
				$sqlPort
			);
			
			$strSQL = "SELECT *"
			." FROM ".$sqlPrefix."comments"
			." INNER JOIN ".$sqlPrefix."imagegallery"
			." ON ".$sqlPrefix."imagegallery.uid = ".$sqlPrefix."comments.uid "
			."WHERE ".$sqlPrefix."imagegallery.image = '".$key."'"
			." ORDER BY time ASC";
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0) {
				$count = 1;
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
					if($use_gravatar == 1) {
						$grav_url = 'http://www.gravatar.com/avatar.php?gravatar_id='.md5($sqlObj->email).'&amp;default='.urlencode('http://www.somewhere.com/homestar.jpg').'&amp;size=32';
						
						echo '<a href="http://www.gravatar.com" title="What is this?" target="_blank">'
						.'<img align="right" border="0" src="'.$grav_url.'" alt="?" />'
						.'</a>'
						.'<br />';
					}
					
					echo '<strong class="comment_title">'.$count.'. ';
					
					if($sqlObj->web != '') {
						echo '<a href="'.$sqlObj->web.'">'.$sqlObj->name.'</a>';
					}
					else {
						echo $sqlObj->name;
					}
					
					echo '</strong>'
					.'<span class="text_small" style="padding: 3px 0 0 3px;">'
					.lang_date(
						substr($sqlObj->time, 6, 2), 
						substr($sqlObj->time, 4, 2), 
						substr($sqlObj->time, 0, 4), 
						substr($sqlObj->time, 8, 2), 
						substr($sqlObj->time, 10, 2), 
						substr($sqlObj->time, 12, 2)
					).'</span>'
					.'<hr class="hr_line" noshade="noshade" />';
					
					
					$msg = $tcms_main->decodeText($sqlObj->msg, '2', $c_charset);
					
					if($use_emoticons == 1) {
						$msg = $tcms_main->replaceSmilyTags($msg, $imagePath);
					}
					
					echo '<div class="comment_text" style="color: #222 !important;">'
					.$msg
					.'</div>';
					
					$check_session = false;
					$check_session = $tcms_auth->checkSessionExist($session);
					
					if($check_session) {
						if($is_admin == 'Administrator' 
						|| $is_admin == 'Developer' 
						|| $is_admin == 'Tester') {
							echo '<a class="main" href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;cmd=delete&amp;XMLplace='.$sqlObj->uid.'&amp;XMLfile='.$sqlObj->timestamp.'">'
							.'<strong>'._TCMS_ADMIN_DELETE.'</strong>'
							.'</a>';
						}
					}
					
					echo '<br />'
					.'<br />';
					
					$count++;
				}
			}
			else {
				echo '<span style="color: #222 !important;">'._FRONT_NOCOMMENT.'</span><br />';
			}
		}
		
		echo '<hr class="hr_line" noshade="noshade" />'
		.'<br />'
		.$tcms_html->contentTitle(_FRONT_COMMENT_TITLE)
		.'<br />';
		
		echo '<form name="comment" id="comment"'
		.' action="media.php?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$album.'&amp;key='.$key.'"'
		.' method="post">';
		
		//captcha
		if($use_captcha == 1) {
			$captchaImage = $tcms_gd->createCaptchaImage(
				'cache/captcha/', 
				$tcms_config->getCaptchaCleanSize()
			);
			
			echo '<div id="captcha">'
			.'<strong>'._FRONT_CAPTCHA.'</strong>'
			.'</div>'
			.'<br />';
			
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<img src="'.$imagePath.'cache/captcha/'.$captchaImage.'.png" />'
			.'</div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
			.'<input name="comment_captcha" id="comment_captcha" class="inputtext bookfield" type="text" />'
			.'<input name="check_captcha" id="check_captcha" value="'.$captchaImage.'" type="hidden" />'
			.'</div>';
			
			echo '<br />'
			.'<br />';
		}
		
		echo '<strong>'._FRONT_COMMENT_NAME.'</strong>'
		.'<br />'
		.'<input name="comment_name" id="comment_name" class="inputtext" type="text" value="" />'
		.'<br />';
		
		echo '<strong>'._FRONT_COMMENT_EMAIL.'</strong>'
		.'<br />'
		.'<input name="comment_email" id="comment_email" class="inputtext" type="text" />'
		.'<br />';
		
		echo '<strong>'._FRONT_COMMENT_WEB.'</strong>'
		.'<br />'
		.'<input name="comment_web" id="comment_web" class="inputtext" type="text" />'
		.'<br />';
		
		echo '<strong>'._FRONT_COMMENT_TEXT.'</strong>'
		.'<br />'
		.'<textarea name="comment_text" id="comment_text" class="inputtextarea"></textarea>'
		.'<br />';
		
		echo '<input type="hidden" name="cmd" value="comment_save" />'
		.'<input type="hidden" name="uid" value="'.$arr_tc['uid'][$takeME].'" />'
		.'<input type="hidden" name="album" value="'.$album.'" />'
		.'<input type="hidden" name="key" value="'.$key.'" />'
		.'<br />'
		.'<input class="inputbutton" type="button"'
		.' onclick="javascript:checkinputs(\'comment\');" value="'._FORM_SUBMIT.'" />';
		
		echo '</form>'
		.'</div>';
	}
	
	
	
	// ----------------------------------------------------
	// SAVE COMMENT
	// ----------------------------------------------------
	
	if($cmd == 'comment_save' 
	&& $show_comments == 1) {
		$save_now = true;
		$save_entry = true;
		
		if($use_captcha == 1) {
			if($comment_captcha == '') {
				$captcha_msg = _MSG_NOCAPTCHA;
				$save_entry = false;
			}
			
			/*
			if($save_entry) {
				if($comment_captcha != $check_captcha) {
					$captcha_msg = _MSG_CAPTCHA_NOT_VALID;
					$save_entry = false;
				}
			}
			*/
			
			$chk = $tcms_gd->getLastCaptchaImage(
				$tcms_main, 
				'cache/captcha/', 
				$check_captcha, 
				$comment_captcha
			);
			
			if($comment_captcha != $chk
			|| trim($chk) == '') {
				$captcha_msg = _MSG_CAPTCHA_NOT_VALID.$comment_captcha.'-'.$chk;
				$save_entry = false;
			}
			else {
				$save_entry = true;
			}
			
			if(!$save_entry) {
				$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=guestbook&s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				$error_msg = $captcha_msg;
				$save_now = false;
			}
		}
		
		if($save_now) {
			// Timestamp
			$cur_c_date = date('YmdHis');
			$save_comment = false;
			
			if($comment_name == '') {
				echo _MSG_NONAME.'<br />';
				$save_comment = false;
			}
			else {
				$save_comment = true;
			}
			
			if($comment_email == '') {
				echo _MSG_NOEMAIL.'<br />';
				$save_comment = false;
			}
			else {
				$save_comment = true;
			}
			
			if(strpos($comment_email, '@') == false) { echo _MSG_NOEMAIL.'<br />'; $save_comment = false;
			}
			else { $save_comment = true;
			}
			
			if($comment_text == '') {
				echo _MSG_NOMSG.'<br />';
				$save_comment = false;
			}
			else {
				$save_comment = true;
			}
			
			if($comment_web != '') {
				if(substr($comment_web, 0, 7) != 'http://') {
					$comment_web = 'http://'.$comment_web;
				}
			}
			
			if($save_comment == true) {
				// linebreak
				$comment_text = $tcms_main->convertNewlineToHTML($comment_text);
				
				
				$comment_name = strip_tags($comment_name);
				$comment_email = strip_tags($comment_email);
				$comment_text = strip_tags($comment_text);
				
				
				// CHARSETS
				$comment_text = $tcms_main->encodeText($comment_text, '2', $c_charset);
				
				
				$comment_ip = getenv('REMOTE_ADDR');
				if($comment_ip == '') {
					$comment_remote = 'localhost';
					$comment_ip = '127.0.0.1';
				}
				else {
					$comment_remote = getHostByAddr($comment_ip);
				}
				
				
				if($choosenDB == 'xml') {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$key.'/'.$cur_c_date.'.xml', 
						'w'
					);
					
					$xmluser->xmlDeclaration();
					$xmluser->xmlSection('comment');
					
					$xmluser->writeValue('name', $comment_name);
					$xmluser->writeValue('email', $comment_email);
					$xmluser->writeValue('web', $comment_web);
					$xmluser->writeValue('msg', $comment_text);
					$xmluser->writeValue('time', $cur_c_date);
					$xmluser->writeValue('ip', $comment_ip);
					$xmluser->writeValue('domain', $comment_remote);
					
					$xmluser->xmlSectionBuffer();
					$xmluser->xmlSectionEnd('comment');
					
					$xmluser->flush();
					unset($xmluser);
				}
				else {
					$sqlAL = new sqlAbstractionLayer(
						$choosenDB, 
						$tcms_time
					);
					
					$sqlCN = $sqlAL->connect(
						$sqlUser, 
						$sqlPass, 
						$sqlHost, 
						$sqlDB, 
						$sqlPort
					);
					
					switch($choosenDB) {
						case 'mysql':
							$newSQLColumns = '`module`, `timestamp`, `name`, `email`, `web`, `msg`, `time`, `ip`, `domain`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'module, timestamp, name, email, web, msg, "time", ip, "domain"';
							break;
						
						case 'mssql':
							$newSQLColumns = '[module], [timestamp], [name], [email], [web], [msg], [time], [ip], [domain]';
							break;
					}
					
					$newSQLData = "'image', '".$cur_c_date."', '".$comment_name."', '".$comment_email."', '".$comment_web."', '".$comment_text."', '".$cur_c_date."', '".$comment_ip."', '".$comment_remote."'";
					
					$sqlQR = $sqlAL->createOne($sqlPrefix.'comments', $newSQLColumns, $newSQLData, $uid);
				}
			}
		}
		else {
			echo '<script>'
			.'alert(\''.$error_msg.'\');'
			.'history.back();'
			.'</script>';
		}
		
		echo '<script>'
		.'document.location=\'media.php?album='.$album.'&key='.$key.'\';'
		.'</script>';
	}
	
	
	
	// ----------------------------------------------------
	// FOOTER
	// ----------------------------------------------------
	
	echo '<hr class="hr_line" noshade="noshade" />'
	.'<div class="legal" style="display: block; margin: 0 auto 0 auto; width: 890px; padding: 2px 10px 10px 10px;">';
	
	//FOOTER TOP
	echo '<a class="legal" href="'.$tcms_config->getWebpageOwnerUrl().'" target="_blank">'
	.$tcms_config->getWebpageOwner().'</a>&nbsp;'
	.'<span class="legal">&copy; '.$tcms_config->getWebpageCopyright().' '._TCMS_ADMIN_RIGHT.'</span><br />';
	
	
	if($tcms_config->showTCMSLogo()) {
		// SHOW LOGO IN FOOTER
		if($tcms_config->showDefaultFooterText()) {
			echo '<span class="legal">'
			.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" class="legal" href="http://www.toenda.com" target="_blank">'.$tcms_version->getName().'</a>'
			.'&nbsp;&copy; '.$tcms_version->getToendaCopyright().'&nbsp;'
			.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>. '
			._TCMS_ADMIN_RIGHT
			.'<br />'
			.'toendaCMS '._ABOUT_FREE_SOFTWARE.'</span>'
			.'<br />'
			.'<br />'
			.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" class="legal" href="http://www.toenda.com" target="_blank"><img align="center" alt="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" src="engine/images/logos/toendaCMS_button_02.png" border="0" /></a><br />';
		}
		
		echo '<span class="legal">'
		.$tcms_config->getFooterText()
		.'</span>';
	}
	else {
		//SHOW ONLY TEXT IN FOOTER
		if($tcms_config->showDefaultFooterText()) {
			echo '<span class="legal">'._ABOUT_POWERED_BY.'&nbsp;'
			.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" class="legal" href="http://www.toenda.com" target="_blank">'.$tcms_version->getName().'</a>&nbsp;&copy;&nbsp;'.$tcms_version->getToendaCopyright().'&nbsp;'
			.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().'" class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
			._TCMS_ADMIN_RIGHT
			.'<br />'
			.'toendaCMS '._ABOUT_FREE_SOFTWARE.'</span>'
			.'<br />';
		}
		
		echo '<span class="legal">'
		.$tcms_config->getFooterText()
		.'</span>';
	}
	
	
	/*
	* SHOW PAGE LOADING TIME
	*/
	if($tcms_config->showPageLoadingTime()) {
		echo '<div>'
		.'<span class="legal">'
		._MSG_PAGE_LOAD_1.'&nbsp;'.$tcms_time->getCurrentTimerValue().'&nbsp;'._MSG_PAGE_LOAD_2
		.'. '
		.$tcms_time->getSqlQueryCountValue()
		.'</span>';
	}
	
	echo '
	</div>';
	
	
	
	// ----------------------------------------------------
	// DELETE COMMENT
	// ----------------------------------------------------
	
	$check_session = $tcms_auth->checkSessionExist($session);
	
	if($check_session) {
		if($is_admin == 'Administrator' 
		|| $is_admin == 'Developer' 
		|| $is_admin == 'Presenter') {
			if($cmd == 'delete') {
				if($choosenDB == 'xml') {
					$tcms_file->deleteFile(
						_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$key.'/'.$XMLfile
					);
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$strSQL = "DELETE FROM ".$sqlPrefix."comments"
					." WHERE module='image'"
					." AND uid = '".$XMLplace."'"
					." AND timestamp = '".$XMLfile."'";
					
					$sqlAL->query($strSQL);
				}
				
				echo '<script>'
				.'document.location=\'media.php?'.( isset($session) ? 'session='.$session.'&' : '' ).'album='.$album.'&key='.$key.'\';'
				.'alert(\''._MSG_DELETE.'\');'
				.'</script>';
			}
		}
	}
	
	
	/*
		generate html footer
	*/
	
	echo '
	</div>
	</body>
	</html>';
}
else {
	if($tcms_param->checkInstallDir(_TCMS_PATH)) {
		echo '<html xmlns="http://www.w3.org/1999/xhtml">'
		.'<head>'
		.'<title>toendaCMS Error 500: Internal Server Error!</title>'
		.'</head>'
		.'<body>'
		.'<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<img src="engine/images/tcms_top.gif" border="0" />'
		.'<h1>toendaCMS Error 500: Internal Server Error!</h1>'
		.'<h2>This site is temporarily unavailable.<br />Please notify the System Administrator</h2>'
		.'</div>'
		.'</body>'
		.'</html>';
		
		$wsShowSite = false;
	}
	else {
		$site_offline = 0;
	}
}

?>
