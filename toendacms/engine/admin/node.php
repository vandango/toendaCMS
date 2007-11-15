<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Linkbrowser for internal links
|
| File:	node.php
|
+
*/


/**
 * Linkbrowser for internal links
 *
 * This is used as a linkbrowser
 *
 * @version 0.4.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['v'])){ $v = $_GET['v']; }
if(isset($_GET['n'])){ $n = $_GET['n']; }
if(isset($_GET['faq'])){ $faq = $_GET['faq']; }
if(isset($_GET['url'])){ $url = $_GET['url']; }
if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }

if(isset($_POST['faq'])){ $faq = $_POST['faq']; }
if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['id_user'])){ $id_user = $_POST['id_user']; }




// ---------------------------------------------
// INIT
// ---------------------------------------------

define('_TCMS_VALID', 1);

include_once('../tcms_kernel/tcms_loader.lib.php');

$language_stage = 'admin';
include_once('../language/lang_admin.php');

$tcms_administer_site = '../../data';

using('toendacms.kernel.file', false, true);
using('toendacms.kernel.time', false, true);
using('toendacms.kernel.xml', false, true);
using('toendacms.kernel.main', false, true);
using('toendacms.kernel.html', false, true);
using('toendacms.kernel.gd', false, true);
using('toendacms.kernel.sql', false, true);
using('toendacms.kernel.authentication', false, true);
using('toendacms.kernel.configuration', false, true);
using('toendacms.kernel.account_provider', false, true);
using('toendacms.kernel.datacontainer_provider', false, true);
using('toendacms.kernel.version', false, true);

include($tcms_administer_site.'/tcms_global/database.php');


$tcms_file = new tcms_file();
$tcms_html = new tcms_html();
$tcms_main = new tcms_main($tcms_administer_site, $choosenDB);
$tcms_time = new tcms_time();
$tcms_config = new tcms_configuration($tcms_administer_site);
$tcms_version = new tcms_version('../../');

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

// imagepath
if($seoEnabled == 1){
	if($seoFolder != ''){
		if($noSEOFolder){
			$templatePath = '../../theme/'.$s.'/';
			$imagePath = '../../';
		}
		else{
			$templatePath = '../../'.$seoFolder.'/theme/'.$s.'/';
			$imagePath = '../../'.$seoFolder.'/';
		}
	}
	else{
		$templatePath = '../../theme/'.$s.'/';
		$imagePath = '../../';
	}
}
else{
	$templatePath = '../../theme/'.$s.'/';
	$imagePath = '../../';
}

$tcms_dcp = new tcms_datacontainer_provider($tcms_administer_site, $tcms_config->getCharset(), $tcms_time);
$tcms_ap = new tcms_account_provider($tcms_administer_site, $tcms_config->getCharset(), $tcms_time);
$tcms_auth = new tcms_authentication($tcms_administer_site, $tcms_config->getCharset(), $imagePath);

if(isset($faq) && $faq != '') {
	$arr_dir = $tcms_file->getPathContent($tcms_administer_site.'/images/knowledgebase/');
}
else {
	$arr_dir = $tcms_file->getPathContent($tcms_administer_site.'/images/Image/');
}

$cms_name     = $tcms_version->getName();
$cms_tagline  = $tcms_version->getTagline();
$toenda_copyr = $tcms_version->getToendaCopyright();

$show_wysiwyg = $tcms_config->getWYSIWYGEditor();
$seoEnabled   = $tcms_config->getSEOEnabled();
$seoFolder    = $tcms_config->getSEOPath();
$seoFormat    = $tcms_config->getSEOFormat();
$adminTheme   = $tcms_config->getAdminTheme();
$webURL       = $tcms_config->getWebpageOwnerUrl();

$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);

if($seoFormat == 0) {
	$tcms_main->setURLSEO('colon');
}
else if($seoFormat == 1) {
	$tcms_main->setURLSEO('slash');
}
else if($seoFormat == 2) {
	$tcms_main->setURLSEO('html');
}




// ---------------------------------------------
// HTML
// ---------------------------------------------

if(isset($id_user)) {
	$check_session = $tcms_auth->checkSessionExist($id_user);
	
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
		|| $id_group == 'Writer'){
			$canEdit = true;
		}
		else{
			$canEdit = false;
		}
		
		
		
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>toendaCMS Imagebrowser | '.$sitetitle.'</title>
		<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
		<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development.  All rights reserved." />
		<script language="javascript" type="text/javascript" src="../js/tinymce/tiny_mce.js"></script>
		<script language="JavaScript" type="text/javascript" src="../js/dhtml.js"></script>
		<link href="theme/'.$adminTheme.'/tcms_main.css" rel="stylesheet" type="text/css" />
		</style>
		</head>
		<body>';
		
		
		echo '<div class="tcms_help_window_top">'
		.'<strong class="tcms_help_window_top_font">&nbsp;'._TABLE_LINKBROWSER.'</strong>'
		.'</div>';
		
		echo '<div style="margin: 7px; padding: 0px;">'
		._TABLE_LINKBROWSER_TEXT
		.'</div>';
		
		echo '<hr />';
		
		
		$lb_layout = $tcms_config->getFrontendTheme();
		
		$iKey = 0;
		
		
		echo '<div style="margin: 5px !important;">';
		
		echo $tcms_html->tableHead('5', '0', '0', '100%');
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" colspan="3">'
		.'<h3>'._SIDEEXT_MODUL.'</h3>'
		.'</td>';
		
		echo '</tr>';
		
		
		//*********************************************************************************
		
		
		/*
			search
			module
		*/
		$dvalue = '?id=search'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1) {
			//$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = $tcms_main->urlConvertToSEO($dvalue);
			$dvalue = '/'.$dvalue;
		}
		else {
			//$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_SEARCH.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_SEARCH.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			poll
			module
		*/
		$dvalue = '?id=polls'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_POLL.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_POLL.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			impressum
			module
		*/
		$dvalue = '?id=impressum'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_IMP.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_IMP.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			contactform
			module
		*/
		$dvalue = '?id=contactform'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_CFORM.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_CFORM.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			frontpage
			module
		*/
		$dvalue = '?id=frontpage'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_FRONT.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_FRONT.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			guestbook
			module
		*/
		$dvalue = '?id=guestbook'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_QBOOK.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_QBOOK.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			links
			module
		*/
		$dvalue = '?id=links'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_LINK.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_LINK.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			newsmanager
			module
		*/
		$dvalue = '?id=newsmanager'; //&amp;s='.$lb_layout;
		
		if($seoEnabled == 1){
			$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
			$dvalue = '/'.$dvalue;
		}
		
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<strong>'._TCMS_MENU_NEWS.'</strong>'
		.'</td>'
		.'<td class="tcms_browser_bottom" width="200">'
		.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'._TCMS_MENU_NEWS.'" />'
		.'</td>';
		
		$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
		
		echo '<td class="tcms_browser_bottom" width="100">'
		.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
		.'</td>';
		
		echo '</tr>';
		
		$iKey++;
		
		
		//*********************************************************************************
		
		
		/*
			documents
			module
		*/
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			echo '<tr>';
			
			echo '<td class="tcms_browser_bottom" colspan="3">'
			.'<h3>'._TCMS_MENU_CONTENT.'</h3>'
			.'</td>';
			
			echo '</tr>';
			
			if($choosenDB == 'xml'){
				$arrDocuments = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_content/');
				
				if(is_array($arrDocuments)){
					foreach($arrDocuments as $key => $val){
						if($val != 'index.html'){
							$xml = new xmlparser($tcms_administer_site.'/tcms_content/'.$val,'r');
							$xmlID = $xml->readSection('main', 'id');
							$xmlAccess = $xml->readSection('main', 'access');
							
							$xmlTitle = $xml->readSection('main', 'title');
							$xmlTitle = $tcms_main->decodeText($xmlTitle, '2', $c_charset);
							
							
							$dvalue = '?id='.$xmlID.''; //&amp;s='.$lb_layout;
							
							if($seoEnabled == 1){
								$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
								$dvalue = '/'.$dvalue;
							}
							
							echo '<tr>'
							.'<td class="tcms_browser_bottom" width="100">'
							.'<strong>'._TCMS_MENU_CONTENT.': '
							.( $xmlAccess == 'Public' ? '' : '*' )
							.' </strong>'.$xmlTitle
							.'</td>'
							.'<td class="tcms_browser_bottom" width="200">'
							.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlTitle.'" />'
							.'</td>';
							
							$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
							
							echo '<td class="tcms_browser_bottom" width="100">'
							.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
							.'</td>';
							
							echo '</tr>';
							
							$iKey++;
						}
					}
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'content');
				
				$count = 0;
				
				while($sqlARR = $sqlAL->fetchArray($sqlQR)){
					$xmlID = $sqlARR['uid'];
					$xmlAccess = $sqlARR['access'];
					
					if($xmlID == NULL){ $xmlID = ''; }
					if($xmlAccess == NULL){ $xmlAccess = ''; }
					
					$xmlTitle = $sqlARR['title'];
					$xmlTitle = $tcms_main->decodeText($xmlTitle, '2', $c_charset);
					
					
					$dvalue = '?id='.$xmlID.''; //&amp;s='.$lb_layout;
					
					if($seoEnabled == 1){
						$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
						$dvalue = '/'.$dvalue;
					}
					
					echo '<tr>'
					.'<td class="tcms_browser_bottom" width="100">'
					.'<strong>'._TCMS_MENU_CONTENT.':'
					.( $xmlAccess == 'Public' ? '' : '*' )
					.' </strong>'.$xmlTitle
					.'</td>'
					.'<td class="tcms_browser_bottom" width="200">'
					.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlTitle.'" />'
					.'</td>';
					
					$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
					
					echo '<td class="tcms_browser_bottom" width="100">'
					.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
					.'</td>';
					
					echo '</tr>';
					
					$iKey++;
				}
				
				$sqlAL->sqlFreeResult($sqlQR);
			}
		}
		
		
		//*********************************************************************************
		
		
		/*
			documents
			module
		*/
		echo '<tr>';
		
		echo '<td class="tcms_browser_bottom" colspan="3">'
		.'<h3>'._TCMS_MENU_GALLERY.'</h3>'
		.'</td>';
		
		echo '</tr>';
		
		if($choosenDB == 'xml'){
			$arrAlbums = $tcms_file->getPathContent($tcms_administer_site.'/tcms_imagegallery/');
			
			if(is_array($arrAlbums)){
				foreach($arrAlbums as $key => $val){
					if($val != 'index.html'){
						$arrImages = $tcms_file->getPathContent($tcms_administer_site.'/tcms_imagegallery/'.$val.'/');
						
						$xml = new xmlparser($tcms_administer_site.'/tcms_albums/album_'.$val.'.xml','r');
						$xmlAlbum = $xml->readSection('album', 'title');
						$xmlPath = $xml->readSection('album', 'path');
						
						$xmlAlbum = $tcms_main->decodeText($xmlAlbum, '2', $c_charset);
						
						$dvalue = '?id=imagegallery&amp;s='.$lb_layout.'&amp;album='.$xmlPath;
						
						if($seoEnabled == 1){
							$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
							$dvalue = '/'.$dvalue;
						}
						
						echo '<tr>'
						.'<td class="tcms_browser_bottom" width="100">'
						.'<strong>'._TABLE_ALBUM.': </strong>'.$xmlAlbum
						.'</td>'
						.'<td class="tcms_browser_bottom" width="200">'
						.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlAlbum.'" />'
						.'</td>';
						
						$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
						
						echo '<td class="tcms_browser_bottom" width="100">'
						.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
						.'</td>';
						
						echo '</tr>';
						
						$iKey++;
						
						if(is_array($arrImages)){
							foreach($arrImages as $key2 => $val2){
								if($val2 != 'index.html'){
									$xml = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$val.'/'.$val2,'r');
									$xmlTitle = $xml->readSection('image', 'text');
									
									$xmlTitle = $tcms_main->decodeText($xmlTitle, '2', $c_charset);
									
									$val2 = substr($val2, 0, strrpos($val2, '.xml'));
									
									$dvalue = 'media.php?album='.$val.'&amp;key='.$val2;
									
									if($seoEnabled == 1) $dvalue = '/'.$seoFolder.'/'.$dvalue;
									
									echo '<tr>'
									.'<td class="tcms_browser_bottom" width="100">'
									.'<strong>'._TCMS_MENU_CONTENT.': </strong>'.$xmlTitle
									.'</td>'
									.'<td class="tcms_browser_bottom" width="200">'
									.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlTitle.'" />'
									.'</td>';
									
									$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, $val2, $tcms_administer_site, $val, $url);
									
									echo '<td class="tcms_browser_bottom" width="100">'
									.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
									.'</td>';
									
									echo '</tr>';
									
									$iKey++;
								}
							}
						}
					}
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'imagegallery ORDER BY album, date');
			
			$count = 0;
			$xmlAlbum2 = '';
			
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
				$xmlID    = $sqlARR['image'];
				$xmlAlbum = $sqlARR['album'];
				
				$xmlTitle = $sqlARR['text'];
				$xmlTitle = $tcms_main->decodeText($xmlTitle, '2', $c_charset);
				
				
				if($xmlAlbum != $xmlAlbum2){
					$dvalue = '?id=imagegallery&amp;s='.$lb_layout.'&amp;album='.$xmlAlbum;
					
					if($seoEnabled == 1){
						$dvalue = $tcms_main->urlConvertToSEO($dvalue, $seoFormat);
						$dvalue = '/'.$dvalue;
					}
					
					echo '<tr>'
					.'<td class="tcms_browser_bottom" width="100">'
					.'<strong>'._TABLE_ALBUM.': </strong>'.$xmlAlbum
					.'</td>'
					.'<td class="tcms_browser_bottom" width="200">'
					.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlAlbum.'" />'
					.'</td>';
					
					$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, 1, '', '', $url);
					
					echo '<td class="tcms_browser_bottom" width="100">'
					.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
					.'</td>';
					
					echo '</tr>';
					
					$iKey++;
				}
				
				$dvalue = 'media.php?album='.$xmlAlbum.'&amp;key='.$xmlID;
				
				if($seoEnabled == 1) $dvalue = '/'.$seoFolder.'/'.$dvalue;
				
				echo '<tr>'
				.'<td class="tcms_browser_bottom" width="100">'
				.'<strong>'._TCMS_MENU_CONTENT.': </strong>'.$xmlTitle
				.'</td>'
				.'<td class="tcms_browser_bottom" width="200">'
				.'<input type="text" name="lb_title" id="lb_title_'.$iKey.'" class="tcms_input_small" value="'.$xmlTitle.'" />'
				.'</td>';
				
				$cmdImage = $tcms_main->returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $iKey, $xmlID, $tcms_administer_site, $xmlAlbum, $url);
				
				echo '<td class="tcms_browser_bottom" width="100">'
				.'<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>'
				.'</td>';
				
				echo '</tr>';
				
				
				$xmlAlbum2 = $xmlAlbum;
				
				$iKey++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		if(!in_array('knowledgebase', $arrXMLID)){
			$arr_linkcom['name'][$i] = _TCMS_MENU_FAQ;
			$arr_linkcom['link'][$i] = 'knowledgebase';
			$i++;
		}
		
		if(!in_array('download', $arrXMLID)){
			$arr_linkcom['name'][$i] = _TCMS_MENU_DOWN;
			$arr_linkcom['link'][$i] = 'download';
			$i++;
		}
		
		
		if(!in_array('products', $arrXMLID)){
			$arr_linkcom['name'][$i] = _TCMS_MENU_PRODUCTS;
			$arr_linkcom['link'][$i] = 'products';
			$i++;
		}
		*/
		
		
		echo $tcms_html->tableEnd();
		
		echo '</div>';
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


echo '</body></html>';

?>
