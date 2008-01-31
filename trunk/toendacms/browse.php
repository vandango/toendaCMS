<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Mediabrowser for WYSIWYG Editor (for frontpage)
|
| File:	browse.php
|
+
*/


/**
 * Mediabrowser for WYSIWYG Editor (for frontpage)
 * 
 * This is the global startfile and the page loading
 * control for the mediabrowser
 * 
 * @version 0.2.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


if(isset($_GET['v'])){ $v = $_GET['v']; }
if(isset($_GET['n'])){ $n = $_GET['n']; }
if(isset($_GET['session'])){ $session = $_GET['session']; }

if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['session'])){ $session = $_POST['session']; }


/*
	INIT GLOBAL
*/

// define system
define('_TCMS_VALID', 1);

// include import loader
include_once('engine/tcms_kernel/tcms_loader.lib.php');

// load language loader
if(!defined('_TCMS_LANGUAGE_STARTPOINT')) {
	define('_TCMS_LANGUAGE_STARTPOINT', 'index');
}
include_once('engine/language/lang_admin.php');

// load current active page
include_once('site.php');
define('_TCMS_PATH', $tcms_site[0]['path']);

// import classes
using('toendacms.kernel.time');
using('toendacms.kernel.html');
using('toendacms.kernel.main');
using('toendacms.kernel.gd');
using('toendacms.kernel.sql');
using('toendacms.kernel.file');

// filehandler
$tcms_file = new tcms_file();

// tcms main
$tcms_main = new tcms_main(_TCMS_PATH, $choosenDB);
$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/Image/');

// database
include(_TCMS_PATH.'/tcms_global/database.php');

$choosenDB = $tcms_db_engine;
$sqlUser   = $tcms_db_user;
$sqlPass   = $tcms_db_password;
$sqlHost   = $tcms_db_host;
$sqlDB     = $tcms_db_database;
$sqlPort   = $tcms_db_port;
$sqlPrefix = $tcms_db_prefix;
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);

// global var
$xml = new xmlparser(_TCMS_PATH.'/tcms_global/var.xml','r');
$show_wysiwyg = $xml->readSection('global', 'wysiwyg');
$xml->flush();
unset($xml);


$xml  = new xmlparser('engine/tcms_kernel/tcms_version.xml','r');
$cms_name     = $xml->readSection('version', 'name');
$cms_tagline  = $xml->readSection('version', 'tagline');
$toenda_copyr = $xml->readSection('version', 'toenda_copyright');
$xml->flush();
unset($xml);


if(isset($session)) {
	$check_session = $tcms_auth->checkSessionExist($id_user, true);
	
	if($check_session){
		// layout
		$c_xml      = new xmlparser(_TCMS_PATH.'/tcms_global/layout.xml','r');
		$adminTheme = $c_xml->read_section('layout', 'admin');
		
		
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>toendaCMS Imagebrowser | '.$sitetitle.'</title>
		<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
		<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development.  All rights reserved." />
		<script language="javascript" type="text/javascript" src="engine/js/tinymce/tiny_mce.js"></script>
		<script language="JavaScript" type="text/javascript" src="engine/js/dhtml.js"></script>
		<link href="engine/admin/theme/'.$adminTheme.'/tcms_main.css" rel="stylesheet" type="text/css" />
		</style>
		</head>
		<body>';
		
		
		
		echo '<div class="tcms_help_window_top">'
		.'<strong class="tcms_help_window_top_font">&nbsp;'._TABLE_IMAGEBROWSER.'</strong>'
		.'</div>';
		
		echo '<div style="margin: 7px; padding: 0px;">'
		._TABLE_IMAGEBROWSER_TEXT.'</div>';
		
		echo '<hr />';
		
		
		echo '<div style="margin: 5px !important;">';
		
		
		
		//*********************************************************************************
		
		
		
		echo '<form name="upload" id="upload" action="browse.php" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="saveMedia" />'
		.'<input name="session" type="hidden" value="'.$session.'" />'
		.'<br />';
		
		
		echo tcms_html::table_head_nb('0', '0', '0', '100%');
		
		
		echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'"><span class="text_normal">'._TABLE_IMAGE.'</span></td>'
		.'<td valign="top"><input name="mediaImage" type="file" accept="image/*" />'
		.'<input type="submit" value="'._TCMS_ADMIN_SAVE.'" /></td></tr>';
		
		
		// table end
		echo '</table></form><hr />';
		
		
		
		//*********************************************************************************
		
		
		
		
		
		
		
		
		if($todo == 'saveMedia'){
			//*****************************************
			if($_FILES['mediaImage']['size'] > 0 && $tcms_main->isImage($_FILES['mediaImage']['type'])){
				$fileName = $_FILES['mediaImage']['name'];
				$imgDir = _TCMS_PATH.'/images/Image/';
				
				copy($_FILES['mediaImage']['tmp_name'], $imgDir.$fileName);
				
				$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['mediaImage']['name'];
				$relocate = 1;
			}
			else{
				$msg = _MSG_NOUPLOAD;
				$relocate = 0;
			}
				
			//*****************************************
			
			if($relocate == 1){
				echo '<script>document.location=\'browse.php?session='.$session.'\';</script>';
			}
			else{
				echo '<script>alert(\''.$msg.'.\');document.location=\'browse.php?session='.$session.'\';</script>';
			}
			
			//*****************************************
		}
		
		
		
		
		
		
		
		
		/*****************
		* PLACE FOR IMG
		*/
		echo tcms_html::table_head_cl('3', '0', '0', '100%', 'tcms_border_gray01');
		
		if(!empty($arr_dir)){
			foreach($arr_dir as $dkey => $dvalue){
				if(trim($dvalue) != 'Thumbs.db' 
				&& trim($dvalue) != 'thumbs.db' 
				&& trim($dvalue) != 'index.html' 
				&& substr(trim($dvalue), 0, 1) != '.'){
					if(!file_exists(_TCMS_PATH.'/images/upload_thumb/thumb_'.$dvalue)){
						tcms_gd::gd_thumbnail(_TCMS_PATH.'/images/Image/', _TCMS_PATH.'/images/upload_thumb/', $dvalue, '100', 'create');
					}
					
					$img_size = getimagesize(_TCMS_PATH.'/images/Image/'.$dvalue);
					$img_o_width  = $img_size[0];
					$img_o_height = $img_size[1];
					
					echo '<tr><td class="tcms_db_2" width="100" valign="top">
					<img style="border: 1px solid #333333;" src="'._TCMS_PATH.'/images/upload_thumb/thumb_'.$dvalue.'" border="0" />';
					
					$size = filesize(_TCMS_PATH.'/images/Image/'.$dvalue) / 1024;
					$kpos = strpos($size, '.');
					$img_size = substr($size, 0, $kpos+3);
					
					echo '<td class="tcms_db_2" valign="top">
					'._GALLERY_IMGTITLE.': '.$dvalue.'<br />
					'._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />
					'._GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>
					</td>';
					
					if(isset($v) && $v == 'news_config'){
						$cmdImage = 'setNewsImage(\''.$dvalue.'\', \'news_mm_image\', \'news_tt_image\')';
					}
					else{
						if($show_wysiwyg == 'tinymce' && (!isset($n) && $n != 'toendaScript')){
							//$cmdImage = 'opener.tinyMCE.insertImage(\''._TCMS_PATH.'/images/Image/'.$dvalue.'\', \'\', \'0\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\');self.close()';
							$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;img src=&quot;'._TCMS_PATH.'/images/Image/'.$dvalue.'&quot; border=&quot;0&quot; alt=&quot;'.$dvalue.'&quot; /&gt;\');self.close()';
						}
						else{
							if($show_wysiwyg == 'toendaScript' || (isset($n) && $n == 'toendaScript')){
								$cmdImage = 'setImage(\''.$dvalue.'\', \'content\', \'toendaScript\')';
							}
							else{
								$cmdImage = 'setImage(\''.$dvalue.'\', \'content\', \'HTML\')';
							}
						}
					}
					
					
					echo '<td class="tcms_db_2" align="right" valign="top">
					<a class="tcms_edit" href="#" onclick="'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>
					</td>';
					
					echo '</form></tr>';
				}
			}
		}
		
		echo tcms_html::table_end();
		
		
		echo '</div>';
		
		
		echo '</body></html>';
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

?>
