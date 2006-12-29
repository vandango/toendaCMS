<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Mediabrowser for WYSIWYG Editor
|
| File:		media.php
| Version:	0.4.8
|
+
*/





if(isset($_GET['v'])){ $v = $_GET['v']; }
if(isset($_GET['n'])){ $n = $_GET['n']; }
if(isset($_GET['faq'])){ $faq = $_GET['faq']; }
if(isset($_GET['url'])){ $url = $_GET['url']; }
if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }
if(isset($_GET['folder'])){ $folder = $_GET['folder']; }

if(isset($_POST['n'])){ $n = $_POST['n']; }
if(isset($_POST['faq'])){ $faq = $_POST['faq']; }
if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['id_user'])){ $id_user = $_POST['id_user']; }
if(isset($_POST['folder'])){ $folder = $_POST['folder']; }





//===================================================================================
// INIT
//===================================================================================

define('_TCMS_VALID', 1);

$language_stage = 'admin';
include_once('../language/lang_admin.php');

$tcms_administer_site = 'data';

include_once('../tcms_kernel/tcms_time.lib.php');
include_once('../tcms_kernel/tcms.lib.php');
include_once('../tcms_kernel/tcms_html.lib.php');
include_once('../tcms_kernel/tcms_gd.lib.php');
include_once('../tcms_kernel/tcms_sql.lib.php');
include('../../'.$tcms_administer_site.'/tcms_global/database.php');

$tcms_main = new tcms_main('../../'.$tcms_administer_site, $choosenDB);

// database
$choosenDB = $tcms_main->securePassword($tcms_db_engine);
$sqlUser   = $tcms_main->securePassword($tcms_db_user);
$sqlPass   = $tcms_main->securePassword($tcms_db_password);
$sqlHost   = $tcms_main->securePassword($tcms_db_host);
$sqlDB     = $tcms_main->securePassword($tcms_db_database);
$sqlPort   = $tcms_main->securePassword($tcms_db_port);
$sqlPrefix = $tcms_main->securePassword($tcms_db_prefix);
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);

if(isset($faq) && $faq != ''){
	$arr_dir = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/images/knowledgebase/');
}
else{
	$arr_dir = $tcms_main->readdir_ext(
		'../../'.$tcms_administer_site.'/images/Image/'
		.( isset($folder) ? $folder.'/' : '' )
	);
}

$c_xml        = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
$show_wysiwyg = $c_xml->read_section('global', 'wysiwyg');
$c_charset    = $c_xml->read_section('global', 'charset');
$seoEnabled   = $c_xml->read_section('global', 'seo_enabled');
$seoFolder    = $c_xml->read_section('global', 'server_folder');

$xmlURL = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml','r');
$webURL = $xmlURL->read_section('footer', 'owner_url');



$version_xml  = new xmlparser('../../engine/tcms_kernel/tcms_version.xml','r');
$cms_name     = $version_xml->read_section('version', 'name');
$cms_tagline  = $version_xml->read_section('version', 'tagline');
$toenda_copyr = $version_xml->read_section('version', 'toenda_copyright');
$version_xml->flush();
$version_xml->_xmlparser();
unset($version_xml);







//===================================================================================
// LIST
//===================================================================================

if(isset($id_user)){
	// check session
	if($choosenDB == 'xml')
		$tcms_main->check_session($id_user, 'admin');
	else
		$tcms_main->check_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
	
	
	if($choosenDB == 'xml'){
		if(isset($id_user) && $id_user != '' && file_exists('session/'.$id_user) && filesize('session/'.$id_user) != 0){ $check_session = true; }
		else{ $check_session = false; }
	}
	else{
		$check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
	}
	
	if($check_session){
		// layout
		$c_xml      = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/layout.xml','r');
		$adminTheme = $c_xml->read_section('layout', 'admin');
		
		
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>toendaCMS Imagebrowser | '.$sitetitle.'</title>
		<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
		<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development. All rights reserved." />
		<script language="javascript" type="text/javascript" src="../js/tinymce/tiny_mce.js"></script>
		<script language="JavaScript" type="text/javascript" src="../js/dhtml.js"></script>
		<link href="theme/'.$adminTheme.'/tcms_main.css" rel="stylesheet" type="text/css" />
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
		
		
		echo tcms_html::bold(_GALLERY_UPLOAD);
		
		
		echo '<form name="upload" id="upload" action="media.php" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="saveMedia" />'
		.( isset($faq) ? '<input name="faq" type="hidden" value="'.$faq.'" />' : '' )
		.'<input name="id_user" type="hidden" value="'.$id_user.'" />'
		.'<br />';
		
		
		echo tcms_html::table_head_nb('0', '0', '0', '100%');
		
		
		echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'"><span class="text_normal">'._TABLE_IMAGE.'</span></td>'
		.'<td valign="top"><input name="mediaImage" type="file" accept="image/*" />'
		.'<input type="submit" value="'._TCMS_ADMIN_SAVE.'" /></td></tr>';
		
		
		// table end
		echo '</table></form>'
		.'<hr />';
		
		
		
		//*********************************************************************************
		
		
		
		/*
			upload images
		*/
		
		if($todo == 'saveMedia'){
			//*****************************************
			if($_FILES['mediaImage']['size'] > 0 && (
			$_FILES['mediaImage']['type'] == 'image/png' || 
			$_FILES['mediaImage']['type'] == 'image/jpeg' || 
			$_FILES['mediaImage']['type'] == 'image/bmp' || 
			$_FILES['mediaImage']['type'] == 'image/gif' || 
			$_FILES['mediaImage']['type'] == 'image/tiff' || 
			$_FILES['mediaImage']['type'] == 'audio/x-wav' || 
			$_FILES['mediaImage']['type'] == 'audio/x-midi' || 
			$_FILES['mediaImage']['type'] == 'audio/x-mpeg' || 
			$_FILES['mediaImage']['type'] == 'audio/mpeg' || 
			$_FILES['mediaImage']['type'] == 'audio/wma' || 
			$_FILES['mediaImage']['type'] == 'video/quicktime' || 
			$_FILES['mediaImage']['type'] == 'video/x-msvideo' || 
			$_FILES['mediaImage']['type'] == 'video/mpeg' || 
			$_FILES['mediaImage']['type'] == 'video/avi' || 
			$_FILES['mediaImage']['type'] == 'video/wmv')){
				$fileName = $_FILES['mediaImage']['name'];
				
				$fileName = $tcms_main->cleanFilename($fileName);
				
				if(isset($faq) && $faq != '') $imgDir = '../../'.$tcms_administer_site.'/images/knowledgebase/';
				else $imgDir = '../../'.$tcms_administer_site.'/images/Image/';
				
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
				if(isset($faq) && $faq != '') echo '<script>document.location=\'media.php?id_user='.$id_user.'&faq='.$faq.'\';</script>';
				else echo '<script>document.location=\'media.php?id_user='.$id_user.'\';</script>';
			}
			else{
				if(isset($faq) && $faq != '') echo '<script>alert(\''.$msg.'.\');document.location=\'media.php?id_user='.$id_user.'&faq='.$faq.'\';</script>';
				else echo '<script>alert(\''.$msg.'.\');document.location=\'media.php?id_user='.$id_user.'\';</script>';
			}
			
			//*****************************************
		}
		
		
		
		/*
			list images
		*/
		echo tcms_html::table_head_cl('3', '0', '0', '100%', 'tcms_border_gray01');
		/*
		if(!empty($arr_dir)){
			foreach($arr_dir as $dkey => $dvalue){
				if(is_dir(trim('../../'.$tcms_administer_site.'/images/Image/'.$dvalue))){
					echo '<tr><td class="tcms_db_2" width="100" valign="top">';
					echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mp3.png" border="0" />';
					echo '<td class="tcms_db_2" valign="top">'
					._GALLERY_IMGTITLE.': '.$dvalue.'<br />'
					._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />';
					if(!preg_match('/.mp3/i', strtolower($dvalue)))
						echo _GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>';
					echo '</td>';
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.( $cmdImage != '' ? '<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>' : '' )
					.'</td>';
					
					echo '</form></tr>';
				}
			}
		}
		*/
		if(!empty($arr_dir)){
			foreach($arr_dir as $dkey => $dvalue){
				$dvalue2 = ( isset($folder) ? $folder.'/' : '' ).$dvalue;
				
				if(is_dir(trim('../../'.$tcms_administer_site.'/images/Image/'.$dvalue2))) {
					$addurl = '';
					
					if(isset($v)){
						$addurl .= '&amp;v='.$v;
					}
					
					if(isset($faq)){
						$addurl .= '&amp;faq='.$faq;
					}
					
					if(isset($n)){
						$addurl .= '&amp;n='.$n;
					}
					
					if(isset($url)){
						$addurl .= '&amp;url='.$url;
					}
					
					$link = 'media.php?id_user='.$id_user.'&folder='.$dvalue.$addurl;
					
					echo '<tr>';
					
					echo '<td class="tcms_db_2" width="100" valign="top">'
					.'<a href="'.$link.'">'
					.'<img style="border: 0px solid #ccc; margin: 2px auto auto 2px;" src="../images/filesystem/folder.png" border="0" />'
					.'</a>'
					.'</td>';
					
					echo '<td class="tcms_db_2" valign="top">'
					._GALLERY_IMGTITLE.': '.$dvalue.'<br />'
					.'</td>';
					
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.'<a class="tcms_edit" href="'.$link.'">'._TCMS_OPEN_DIRECTORY.'</a>'
					.'</td>';
					
					echo '</tr>';
				}
				else if(trim($dvalue) != 'Thumbs.db' 
				&& trim($dvalue) != 'thumbs.db' 
				&& trim($dvalue) != 'index.html' 
				&& substr(trim($dvalue), 0, 1) != '.'){
					if(!preg_match('/.mp3/i', strtolower($dvalue))){
						$tcms_gd = new tcms_gd();
						
						if(!file_exists('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue)){
							if(isset($faq) && $faq != '')
								tcms_gd::gd_thumbnail('../../'.$tcms_administer_site.'/images/knowledgebase/', '../../'.$tcms_administer_site.'/images/upload_thumb/', $dvalue, '100', 'create');
							else
								tcms_gd::gd_thumbnail('../../'.$tcms_administer_site.'/images/Image/', '../../'.$tcms_administer_site.'/images/upload_thumb/', $dvalue, '100', 'create');
						}
						
						//$img_size = getimagesize('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue);
						//$img_size = getimagesize('../../'.$tcms_administer_site.'/images/Image/'.$dvalue);
						
						if(isset($faq) && $faq != '')
							$tcms_gd->readImageInformation('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue2);
						else
							$tcms_gd->readImageInformation('../../'.$tcms_administer_site.'/images/Image/'.$dvalue2);
						
						$img_o_width  = $tcms_gd->getImageWidth();
						$img_o_height = $tcms_gd->getImageHeight();
					}
					
					
					echo '<tr><td class="tcms_db_2" width="100" valign="top">';
					
					$checkType = true;
					
					if(preg_match('/.mp3/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mp3.png" border="0" />';
						$checkType = false;
					}
					if(preg_match('/.wma/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wma.png" border="0" />';
						$checkType = false;
					}
					if(preg_match('/.wav/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wav.png" border="0" />';
						$checkType = false;
					}
					elseif(preg_match('/.avi/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/avi.png" border="0" />';
						$checkType = false;
					}
					elseif(preg_match('/.mpeg/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					elseif(preg_match('/.mpg/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					elseif(preg_match('/.wmv/i', strtolower($dvalue)) && $checkType){
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wmv.png" border="0" />';
						$checkType = false;
					}
					elseif($checkType){
						echo '<img style="border: 1px solid #333333;" src="../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue.'" border="0" />';
					}
					
					
					if(isset($faq) && $faq != '')
						$size = filesize('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue2) / 1024;
					else
						$size = filesize('../../'.$tcms_administer_site.'/images/Image/'.$dvalue2) / 1024;
					
					$kpos = strpos($size, '.');
					$img_size = substr($size, 0, $kpos+3);
					
					
					echo '</td><td class="tcms_db_2" valign="top">'
					._GALLERY_IMGTITLE.': '.$dvalue.'<br />'
					._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />';
					if(!preg_match('/.mp3/i', strtolower($dvalue)))
						echo _GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>';
					echo '</td>';
					
					
					if(!preg_match('/.mp3/i', strtolower($dvalue))){
						if(isset($v) && $v == 'news_config') $cmdImage = 'setNewsImage(\''.$dvalue.'\', \'news_mm_image\', \'news_tt_image\')';
						elseif(isset($faq) && $faq == 'faq') $cmdImage = 'setFAQImage(\''.$dvalue.'\', \'faq_img\', \'new_faq_img\')';
						elseif(isset($n) && $n == 'without'){
							if(isset($url) && $url != ''){
								$rTemp = $url;
								
								if($show_wysiwyg == 'toendaScript')
									$cmdImage = 'setImageNL(\''.$dvalue2.'\', \'content\', \'toendaScript\', \''.$rTemp.'\')';
								else
									$cmdImage = 'setImageNL(\''.$dvalue2.'\', \'content\', \'HTML\', \''.$rTemp.'\')';
							}
							else{
								if($show_wysiwyg == 'toendaScript')
									$cmdImage = 'setImage(\''.$rTemp.$dvalue2.'\', \'content\', \'toendaScript\')';
								else
									$cmdImage = 'setImage(\''.$rTemp.$dvalue2.'\', \'content\', \'HTML\')';
							}
						}
						else{
							if($show_wysiwyg == 'tinymce' && $v != 'links')
								$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;img src=&quot;'.( $seoEnabled == 1 ? '' : '' ).$tcms_administer_site.'/images/Image/'.$dvalue2.'&quot; alt=&quot;'.$dvalue.'&quot; /&gt;\');self.close()';
							else{
								if($show_wysiwyg == 'toendaScript') $cmdImage = 'setImage(\''.$dvalue2.'\', \'content\', \'toendaScript\')';
								else $cmdImage = 'setImage(\''.$dvalue2.'\', \'content\', \'HTML\')';
							}
						}
					}
					else{
						if(isset($v) && $v == 'news_config') $cmdImage = '';
						elseif(isset($faq) && $faq == 'faq') $cmdImage = '';
						elseif(isset($n) && $n == 'without'){
							if(isset($url) && $url != '')
								$rTemp = $url;
							
							if($show_wysiwyg == 'toendaScript')
								$cmdImage = 'setLink(\''.$rTemp.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'toendaScript\')';
							else
								$cmdImage = 'setLink(\''.$rTemp.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'HTML\')';
						}
						else{
							if($show_wysiwyg == 'tinymce' && $v != 'links')
								$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$tcms_administer_site.'/images/Image/'.$dvalue2.'&quot; target=&quot;_blank&quot;&gt;'.$dvalue.'&lt;/a&gt;\');self.close()';
							else{
								if($show_wysiwyg == 'toendaScript')
									$cmdImage = 'setLink(\''.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'toendaScript\')';
								else
									$cmdImage = 'setLink(\''.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'HTML\')';
							}
						}
					}
					
					
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.( $cmdImage != '' ? '<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>' : '' )
					.'</td>';
					
					echo '</form></tr>';
				}
			}
		}
		
		echo tcms_html::table_end();
		
		
		
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
