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
| File:	media.php
|
+
*/


/**
 * Mediabrowser for WYSIWYG Editor
 *
 * This is used as global startpage for the
 * administraion backend.
 *
 * @version 0.7.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['v'])) { $v = $_GET['v']; }
if(isset($_GET['n'])) { $n = $_GET['n']; }
if(isset($_GET['faq'])) { $faq = $_GET['faq']; }
if(isset($_GET['url'])) { $url = $_GET['url']; }
if(isset($_GET['id_user'])) { $id_user = $_GET['id_user']; }
if(isset($_GET['folder'])) { $folder = $_GET['folder']; }

if(isset($_POST['n'])) { $n = $_POST['n']; }
if(isset($_POST['faq'])) { $faq = $_POST['faq']; }
if(isset($_POST['mediaImage'])) { $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])) { $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])) { $todo = $_POST['todo']; }
if(isset($_POST['id_user'])) { $id_user = $_POST['id_user']; }
if(isset($_POST['folder'])) { $folder = $_POST['folder']; }


// ---------------------------------------------
// INIT
// ---------------------------------------------

define('_TCMS_VALID', 1);

include_once('../tcms_kernel/tcms_loader.lib.php');

if(!defined('_TCMS_LANGUAGE_STARTPOINT')) {
	define('_TCMS_LANGUAGE_STARTPOINT', 'admin');
}
include_once('../language/lang_admin.php');

// load current active page
include_once('../../site.php');
define('_TCMS_PATH', '../../'.$tcms_site[0]['path']);

using('toendacms.kernel.file', false, true);
using('toendacms.kernel.time', false, true);
using('toendacms.kernel.xml', false, true);
using('toendacms.kernel.main', false, true);
using('toendacms.kernel.html', false, true);
using('toendacms.kernel.gd', false, true);
using('toendacms.kernel.sql', false, true);
using('toendacms.kernel.authentication', false, true);
using('toendacms.kernel.configuration', false, true);
using('toendacms.kernel.version', false, true);

include(_TCMS_PATH.'/tcms_global/database.php');

$tcms_file = new tcms_file();
$tcms_main = new tcms_main(_TCMS_PATH, $choosenDB);
$tcms_html = new tcms_html();
$tcms_config = new tcms_configuration(_TCMS_PATH);
$tcms_version = new tcms_version('../../');

// database
$choosenDB = $tcms_db_engine;
$sqlUser   = $tcms_db_user;
$sqlPass   = $tcms_db_password;
$sqlHost   = $tcms_db_host;
$sqlDB     = $tcms_db_database;
$sqlPort   = $tcms_db_port;
$sqlPrefix = $tcms_db_prefix;
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);
$tcms_config->decodeConfiguration($tcms_main);

$seoEnabled   = $tcms_config->getSEOEnabled();
$seoFolder    = $tcms_config->getSEOPath();

// imagepath
if($noSEOFolder) {
	$imagePath = '../../';
}
else {
	$imagePath = '../../'.$seoFolder.'/';
}

$tcms_auth = new tcms_authentication(_TCMS_PATH, $c_charset, $imagePath);

if(isset($faq) && $faq != ''
|| isset($v) && $v == 'faq') {
	$mainPath = 'knowledgebase';
}
else {
	$mainPath = 'Image';
}

$arr_dir = $tcms_file->getPathContent(
	_TCMS_PATH.'/images/'.$mainPath.'/'
	.( isset($folder) ? $folder.'/' : '' )
);

$show_wysiwyg = $tcms_config->getWYSIWYGEditor();
$c_charset    = $tcms_config->getCharset();
$webURL       = $tcms_config->getWebpageOwnerUrl();



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
$toenda_copyr = $tcms_version->getToendaCopyright();

$upload_max_filesize = $tcms_main->getUploadMaxSizeInBytes();
$post_max_size = $tcms_main->getPostMaxSizeInBytes();







//===================================================================================
// LIST
//===================================================================================

if(isset($id_user)) {
	// check session
	$check_session = $tcms_auth->checkSessionExist($id_user, true);
	
	if($check_session) {
		// layout
		$adminTheme = $tcms_config->getAdminTheme();
		
		
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
		
		
		echo '<div style="margin: 5px 0 5px 0 !important;">';
		
		
		echo $tcms_html->bold(_GALLERY_UPLOAD);
		
		
		echo '<form name="upload" id="upload" action="media.php" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="saveMedia" />'
		.( isset($faq) ? '<input name="faq" type="hidden" value="'.$faq.'" />' : '' )
		.'<input name="id_user" type="hidden" value="'.$id_user.'" />'
		.'<br />';
		
		
		echo $tcms_html->tableHeadNoBorder('0', '0', '0', '100%');
		
		
		echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
		.'<span class="text_normal">'._TABLE_IMAGE.'</span>'
		.'</td><td valign="top">'
		.'<input name="mediaImage" type="file" accept="image/*" />'
		.'<input type="submit" value="'._TCMS_ADMIN_SAVE.'" />'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd()
		.'</form>'
		.'<hr />';
		
		
		
		/*
			upload images
		*/
		
		if($todo == 'saveMedia') {
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
			$_FILES['mediaImage']['type'] == 'video/wmv')) {
				if($_FILES['mediaImage']['size'] <= $upload_max_filesize
				&& $_FILES['mediaImage']['size'] <= $post_max_size) {
					$fileName = $_FILES['mediaImage']['name'];
					
					$fileName = $tcms_main->cleanFilename($fileName);
					
					$imgDir = _TCMS_PATH.'/images/'.$mainPath.'/'
					.( isset($folder) ? $folder.'/' : '' );
					
					copy($_FILES['mediaImage']['tmp_name'], $imgDir.$fileName);
					
					$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['mediaImage']['name'];
					$relocate = 1;
				}
				else {
					$msg = _MSG_NOUPLOAD_PHP;
					$relocate = 0;
				}
			}
			else {
				$msg = _MSG_NOUPLOAD;
				$relocate = 0;
			}
			
			
			if($relocate == 1) {
				if(isset($faq) && $faq != '') {
					echo '<script>'
					.'document.location=\'media.php?id_user='.$id_user.'&faq='.$faq.'\';'
					.'</script>';
				}
				else {
					echo '<script>'
					.'document.location=\'media.php?id_user='.$id_user.'\';'
					.'</script>';
				}
			}
			else {
				if(isset($faq) && $faq != '') {
					echo '<script>'
					.'alert(\''.$msg.'.\');'
					.'document.location=\'media.php?id_user='.$id_user.'&faq='.$faq.'\';'
					.'</script>';
				}
				else {
					echo '<script>'
					.'alert(\''.$msg.'.\');'
					.'document.location=\'media.php?id_user='.$id_user.'\';'
					.'</script>';
				}
			}
		}
		
		
		
		/*
			list images
		*/
		echo $tcms_html->tableHeadClass('3', '0', '0', '100%', 'tcms_border_gray01');
		
		if($tcms_main->isArray($arr_dir)) {
			foreach($arr_dir as $dkey => $dvalue) {
				$dvalue2 = ( isset($folder) ? $folder.'/' : '' ).$dvalue;
				$dvalue3 = $dvalue;
				
				$relPath = ( $folder == '' ? '' : $folder.'/' );
				
				if(is_dir(trim(_TCMS_PATH.'/images/'.$mainPath.'/'.$dvalue2))) {
					$addurl = '';
					
					if(isset($v)) {
						$addurl .= '&amp;v='.$v;
					}
					
					if(isset($faq)) {
						$addurl .= '&amp;faq='.$faq;
					}
					
					if(isset($n)) {
						$addurl .= '&amp;n='.$n;
					}
					
					if(isset($url)) {
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
				&& substr(trim($dvalue), 0, 1) != '.') {
					if(isset($faq)) {
						$thumbPath = 'faq_thumb';
					}
					else if(isset($v)) {
						if(trim($v) == 'faq') {
							$thumbPath = 'faq_thumb';
						}
						else {
							$thumbPath = 'upload_thumb';
						}
					}
					else {
						$thumbPath = 'upload_thumb';
					}
					
					if(!preg_match('/.mp3/i', strtolower($dvalue))) {
						$tcms_gd = new tcms_gd();
						
						if(!$tcms_file->checkFileExist(_TCMS_PATH.'/images/'.$thumbPath.'/'.$relPath.'thumb_'.$dvalue)) {
							$tcms_gd->createThumbnail(
								_TCMS_PATH.'/images/'.$mainPath.'/'.$relPath, 
								_TCMS_PATH.'/images/'.$thumbPath.'/'.$relPath, 
								$dvalue, 
								100
							);
						}
						
						$tcms_gd->readImageInformation(
							_TCMS_PATH.'/images/'.$mainPath.'/'.$dvalue2
						);
						
						$img_o_width  = $tcms_gd->getImageWidth();
						$img_o_height = $tcms_gd->getImageHeight();
					}
					
					
					echo '<tr><td class="tcms_db_2" width="100" valign="top">';
					
					$checkType = true;
					
					if($tcms_file->getMimeType(strtolower($dvalue)) == 'mp3' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mp3.png" border="0" />';
						$checkType = false;
					}
					if($tcms_file->getMimeType(strtolower($dvalue)) == 'wma' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wma.png" border="0" />';
						$checkType = false;
					}
					if($tcms_file->getMimeType(strtolower($dvalue)) == 'wav' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wav.png" border="0" />';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'avi' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/avi.png" border="0" />';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'mpeg' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'mpg' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'wmv' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 6px auto auto 6px;" src="../images/mimetypes/wmv.png" border="0" />';
						$checkType = false;
					}
					elseif($checkType) {
						echo '<img style="border: 1px solid #333333;" src="'._TCMS_PATH.'/images/'.$thumbPath.'/'.$relPath.'thumb_'.$dvalue.'" border="0" />';
					}
					
					
					$size = filesize(_TCMS_PATH.'/images/'.$mainPath.'/'.$dvalue2) / 1024;
					
					$kpos = strpos($size, '.');
					$img_size = substr($size, 0, $kpos+3);
					
					
					echo '</td><td class="tcms_db_2" valign="top">'
					._GALLERY_IMGTITLE.': '.$dvalue.'<br />'
					._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />';
					
					if(!preg_match('/.mp3/i', strtolower($dvalue))) {
						echo _GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>';
					}
					
					echo '</td>';
					
					
					if($seoEnabled) {
						$seo_path = str_replace('../../', '', _TCMS_PATH);
						$seo_path = '/'.$seoFolder.'/'.$seo_path;
						
						$img_path = $seo_path;//str_replace('../../', '', _TCMS_PATH);
					}
					else {
						//$seo_path = _TCMS_PATH;
						//$img_path = _TCMS_PATH;
						
						
						$seo_path = str_replace('../../', '', _TCMS_PATH);
						$seo_path = '/'.$seoFolder.'/'.$seo_path;
						
						$img_path = $seo_path;//str_replace('../../', '', _TCMS_PATH);
					}
					
					
					// images
					if(!preg_match('/.mp3/i', strtolower($dvalue))) {
						$rTemp = $url;
						
						// generate taglist
						$fileExt = $tcms_file->getFileExtension($dvalue2);
						$tagList = $rTemp.$dvalue2;
						
						$tagList = str_replace($fileExt, ' ', $tagList);
						$tagList = str_replace('http://', '', $tagList);
						$tagList = str_replace('/', ' ', $tagList);
						$tagList = str_replace('_', ' ', $tagList);
						$tagList = str_replace('.', ' ', $tagList);
						$tagList = trim($tagList);
						
						// news configuration
						if(isset($v) && $v == 'news_config') {
							$cmdImage = 'setNewsImage(\''.$dvalue.'\', \'news_mm_image\', \'news_tt_image\')';
						}
						// klnowledgebase
						elseif(isset($faq) && $faq == 'faq') {
							$cmdImage = 'setFAQImage(\''.$dvalue2.'\', \'faq_img\', \'new_faq_img\')';
						}
						// all other
						elseif(isset($n) && $n == 'without') {
							if(isset($url) && $url != '') {
								if($show_wysiwyg == 'toendaScript') {
									$cmdImage = 'setImageNLTaglist(\''.$dvalue2.'\', \'content\', \'toendaScript\', \''.$rTemp.'\', \''.$tagList.'\')';
								}
								else if($show_wysiwyg == 'Wiki') {
									$cmdImage = 'setImageNLTaglist(\''.$dvalue2.'\', \'content\', \'Wiki\', \''.$rTemp.'\', \''.$tagList.'\')';
								}
								else {
									$cmdImage = 'setImageNLTaglist(\''.$dvalue2.'\', \'content\', \'HTML\', \''.$rTemp.'\', \''.$tagList.'\')';
								}
							}
							else {
								if($show_wysiwyg == 'toendaScript') {
									$cmdImage = 'setImageTaglist(\''.$rTemp.$dvalue2.'\', \'content\', \'toendaScript\', \''.$tagList.'\')';
								}
								else if($show_wysiwyg == 'Wiki') {
									$cmdImage = 'setImageTaglist(\''.$rTemp.$dvalue2.'\', \'content\', \'Wiki\', \''.$tagList.'\')';
								}
								else {
									$cmdImage = 'setImageTaglist(\''.$rTemp.$dvalue2.'\', \'content\', \'HTML\', \''.$tagList.'\')';
								}
							}
						}
						else {
							if($show_wysiwyg == 'tinymce' && $v != 'links') {
								$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, '
								.'\'&lt;a href=&quot;'.$seo_path.'/images/'.$mainPath.'/'.$dvalue2.'&quot; '
								.'rel=&quot;lightbox&quot;&gt;'
								.'&lt;img '
								.'src=&quot;'.$img_path.'/images/'.$mainPath.'/'.$dvalue2.'&quot; '
								.'alt=&quot;'.$tagList.'&quot;'
								.'title=&quot;'.$tagList.'&quot; /&gt;'
								.'&lt;\/a&gt;\');'
								.'self.close()';
								
								$cmdThumb = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, '
								//.'\'&lt;a href=&quot;javascript:imageWindow(\&#39;'.$dvalue2.'\&#39;, \&#39;media\&#39;);&quot;&gt;'
								.'\'&lt;a href=&quot;'.$seo_path.'/images/'.$mainPath.'/'.$dvalue2.'&quot; '
								.'rel=&quot;lightbox&quot;&gt;'
								.'&lt;img '
								.'src=&quot;'.$img_path.'/images/'.$thumbPath.'/'.$relPath.'thumb_'.$dvalue3.'&quot; '
								.'alt=&quot;'.$tagList.'&quot;'
								.'title=&quot;'.$tagList.'&quot; /&gt;'
								.'&lt;\/a&gt;\');'
								.'self.close()';
							}
							else {
								if($show_wysiwyg == 'toendaScript') {
									$cmdImage = 'setImageTaglist(\''.$dvalue2.'\', \'content\', \'toendaScript\', \''.$tagList.'\')';
								}
								else if($show_wysiwyg == 'Wiki') {
									$cmdImage = 'setImageTaglist(\''.$dvalue2.'\', \'content\', \'Wiki\', \''.$tagList.'\')';
								}
								else {
									$cmdImage = 'setImageTaglist(\''.$dvalue2.'\', \'content\', \'HTML\', \''.$tagList.'\')';
								}
							}
						}
					}
					// audio and other
					else {
						// news configuration
						if(isset($v) && $v == 'news_config') {
							$cmdImage = '';
						}
						// knowledgebase
						elseif(isset($faq) && $faq == 'faq') {
							$cmdImage = '';
						}
						// all other
						elseif(isset($n) && $n == 'without') {
							if(isset($url) && $url != '') {
								$rTemp = $url;
							}
							
							if($show_wysiwyg == 'toendaScript') {
								$cmdImage = 'setLink(\''.$rTemp.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'toendaScript\')';
							}
							else if($show_wysiwyg == 'Wiki') {
								$cmdImage = 'setLink(\''.$rTemp.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'Wiki\')';
							}
							else {
								$cmdImage = 'setLink(\''.$rTemp.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'HTML\')';
							}
						}
						else {
							if($show_wysiwyg == 'tinymce' && $v != 'links') {
								$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$seo_path.'/images/Image/'.$dvalue2.'&quot; target=&quot;_blank&quot;&gt;'.$dvalue.'&lt;/a&gt;\');self.close()';
							}
							else {
								if($show_wysiwyg == 'toendaScript') {
									$cmdImage = 'setLink(\''.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'toendaScript\')';
								}
								else if($show_wysiwyg == 'Wiki') {
									$cmdImage = 'setLink(\''.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'Wiki\')';
								}
								else {
									$cmdImage = 'setLink(\''.$dvalue2.'\', \''.$dvalue.'\', \'content\', \'HTML\')';
								}
							}
						}
					}
					
					
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.( $cmdImage != '' 
						? '<a class="tcms_edit" href="javascript:'.$cmdImage.';">'._TABLE_ACCEPTBUTTON.'</a>' 
						: '' 
					)
					.( $cmdThumb != '' 
						? '
						
						<a class="tcms_edit" href="javascript:'.$cmdThumb.';">
						
						'._TABLE_THUMBNAIL.'</a>' 
						: '' 
					)
					.'</td>';
					
					echo '</tr>'
					.'</form>';
				}
			}
		}
		
		echo $tcms_html->tableEnd();
		
		
		
		echo '</div>';
	}
	else {
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<h1>'._MSG_SESSION_EXPIRED.'</h2>'
		.'</div>';
	}
}
else {
	echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
	.'<h1>'._DIE_LOGIN.'</h2>'
	.'</div>';
}


echo '</body></html>';

?>
