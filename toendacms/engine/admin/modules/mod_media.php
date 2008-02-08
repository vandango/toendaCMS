<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Asset Manager
|
| File:	mod_media.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Asset Mediamanager
 *
 * This module is used as a media manager.
 *
 * @version 0.7.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['action'])) { $action = $_GET['action']; }
if(isset($_GET['check'])) { $check = $_GET['check']; }
if(isset($_GET['path'])) { $path = $_GET['path']; }
if(isset($_GET['delimg'])) { $delimg = $_GET['delimg']; }
if(isset($_GET['directory'])) { $directory = $_GET['directory']; }

if(isset($_POST['action'])) { $action = $_POST['action']; }
if(isset($_POST['event'])) { $event = $_POST['event']; }
if(isset($_POST['delimg'])) { $delimg = $_POST['delimg']; }
if(isset($_POST['path'])) { $path = $_POST['path']; }
if(isset($_POST['directory'])) { $directory = $_POST['directory']; }




// --------------------------------------------------------------------
// TABS
// --------------------------------------------------------------------

if(!isset($action)) { $action = 'image'; }

echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
.'<a'.( trim($action) == 'image' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=image">'._TCMS_MENU_MEDIA.'</a>'
.'<a'.( trim($action) == 'faq' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=faq">'._TCMS_MENU_FAQ.'</a>'
.'</div>';

echo '<div class="tcms_tabPage"><br />';




// --------------------------------------------------------------------
// INIT
// --------------------------------------------------------------------

if(!isset($path)) $path = '';

if(trim($action) == 'image') {
	$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/Image/'.$path);
}
else {
	$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/knowledgebase/');
}

$maxVal = count($arr_dir);




// --------------------------------------------------------------------
// DISPLAY
// --------------------------------------------------------------------

if($todo != 'upload' && $todo != 'deleteImage') {
	echo '<form name="upload" id="upload" action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post" enctype="multipart/form-data">';
	
	
	/*
		TABLE FOR OUTPUT AND INPUT
	*/
	echo $tcms_html->tableHeadNoBorder('0', '0', '0', '100%');
	
	
	// table title
	echo '<tr class="tcms_bg_blue_01">'
	.'<td colspan="3" class="tcms_db_title tcms_padding_mini">'
	.'<strong>'._GALLERY_UPLOAD.'</strong>'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td colspan="2" style="height: 3px;"></td></tr>';
	
	
	// row
	if(!$tcms_main->isReal($path)) {
		echo '<tr><td class="tcms_padding_mini">'
		.'<input name="directory" id="directory" type="text" class="tcms_input_small" />'
		.'<input name="btn_action" class="tcms_button" type="button" value="'._TCMS_ADMIN_NEW_DIR_BUTTON.'"'
		.' onclick="'
		.'document.location=\''
		.'admin.php?site=mod_media&id_user='.$id_user.'&action='.trim($action).'&todo=createDir'
		.'&directory=\' + document.getElementById(\'directory\').value;'
		.'" />'
		.'</td></tr>';
	}
	
	
	// row
	echo '<tr><td class="tcms_padding_mini">'
	.'<select class="tcms_select" name="directory" id="directory">'
	.'<option value="'.( $path == '' ? '__DEFAULT__' : $path ).'">'.( $path == '' ? _TCMS_BASE_DIRECTORY : $path ).'</option>';
	
	$arr_path = $tcms_file->getPathContent(
		_TCMS_PATH.'/images/'.( trim($action) == 'image' ? 'Image' : 'knowledgebase' ).'/'.$path, 
		true
	);
	
	if($tcms_main->isArray($arr_path)) {
		foreach($arr_path as $fkey => $fvalue) {
			echo '<option value="'.$fvalue.'">'.$fvalue.'</option>';
		}
	}
	
	echo '</select>'
	.'<input name="event" type="file" class="tcms_upload" />'
	.'<input name="btnUpload" type="button" onclick="submitForm(\'upload\');" class="tcms_button" value="'._TCMS_ADMIN_UPLOAD.'" />'
	.'<input name="todo" type="hidden" value="upload" />'
	.'<input name="action" type="hidden" value="'.trim($action).'" />'
	.'</td></tr>';
	
	
	// row
	echo '</table>'
	.'</form>'
	.'<br /><br />';
	
	
	
	
	/*
		PLACE FOR IMG
	*/
	
	$count = 1;
	$bgkey = 0;
	
	echo $tcms_html->tableHead('0', '0', '0', '100%');
	
	if($tcms_config->getMediamanagerItemView() == 'list') {
		echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title tcms_padding_mini" width="55%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title tcms_padding_mini" width="15%" align="left">'._TABLE_DATE.'</th>'
		.'<th valign="middle" class="tcms_db_title tcms_padding_mini" width="15%" align="left">'._GALLERY_IMGSIZE.'</th>'
		.'<th valign="middle" class="tcms_db_title tcms_padding_mini" width="15%" align="right">'._TABLE_FUNCTIONS.'</th>'
		.'<tr>';
	}
	else {
		echo '<tr valign="top"><td valign="top">';
	}
	
	if(trim($path) != '') {
		echo '<tr height="30" id="row_root" '
		.'style="background: '.$arr_color[0].';" '
		.'onMouseOver="wxlBgCol(\'row_root\',\'#ececec\')" '
		.'onMouseOut="wxlBgCol(\'row_root\',\''.$arr_color[0].'\')">';
		
		// name
		echo '<td align="left" class="tcms_db_2">'
		.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action='.trim($action).'">'
		.'<img style="border: 1px solid #ccc; margin: 2px 2px 0 2px; float: left;"'
		.' src="../images/explore/faq_folder.png" border="0" />'
		.'<div style="padding: 8px 0 0 5px;">'
		.'..'
		.'</div>'
		.'</a>'
		.'</td>';
		
		// date
		echo '<td class="tcms_db_2">'
		//.$tcms_file->getFileCreateTime(
		//	_TCMS_PATH.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue
		//)
		.'</td>';
		
		// size
		echo '<td class="tcms_db_2">'
		//.$tcms_file->getDirectorySizeString(
		//	_TCMS_PATH.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue
		//)
		.'</td>';
		
		// function
		echo '<td class="tcms_db_2" style="text-align: middle;" align="right" valign="middle">'
		/*.$formStart
		.'<a title="'._TABLE_DELBUTTON.'" href="#" onclick="deleteMediafile(\''.$id_user.'\', \''.trim($action).'\', \''.$path.'/'.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
		.'<div style="float: right; padding: 2px 0 0 0;">'
		.'<strong>'._TCMS_ADMIN_DELETE.'</strong>'
		.'</div>'
		.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" border="0"'
		//.' style="margin: 2px 2px 0 2px; float: right;"'
		.' src="../images/a_delete.gif" />'
		.'</a>&nbsp;'
		.$formEnd*/
		.'</td>';
		
		echo '</tr>';
	}
	
	if($tcms_main->isArray($arr_dir)) {
		// folder
		foreach($arr_dir as $dkey => $dvalue) {
			$chkPath = _TCMS_PATH.'/images/'
			.( trim($action) == 'image' ? 'Image' : 'knowledgebase' )
			.'/'.( $path == '' ? '' : $path.'/' ).$dvalue;
			
			if(is_dir(trim(($chkPath)))) {
				$formStart = '<form id="'.$dvalue.'" name="'.$dvalue.'"'
				.' action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post">'
				.'<input name="todo" type="hidden" value="del_img" />'
				.'<input name="action" type="hidden" value="'.trim($action).'" />'
				.'<input name="delimg" type="hidden" value="'.$dvalue.'" />';
				
				$formEnd = '</form>';
				
				if($tcms_config->getMediamanagerItemView() == 'list') {
					$bgkey++;
					
					if(is_integer($bgkey / 2)) {
						$ws_color = $arr_color[0];
					}
					else {
						$ws_color = $arr_color[1];
					}
					
					$overlibText = '<strong>'._GALLERY_IMGTITLE.':</strong>'
					.'<br />'.$dvalue;
					
					echo '<tr height="30" id="row'.$count.'" '
					.'style="background: '.$ws_color.';" '
					.'onMouseOver="wxlBgCol(\'row'.$count.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$count.'\',\''.$ws_color.'\')">';
					
					// name
					echo '<td align="left" class="tcms_db_2">'
					.'<a onmouseover="return overlib(\''.$overlibText.'\', CAPTION, \''
					.( strlen($dvalue) > 25 ? substr($dvalue, 0, 20).' ...' : $dvalue )
					.'\', BELOW, RIGHT, WIDTH, 150);" onmouseout="return nd();"'
					.' href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action='.$action.'&amp;path='.$dvalue.'">'
					.'<img style="border: 1px solid #ccc; margin: 2px 2px 0 2px; float: left;"'
					.' src="../images/explore/faq_folder.png" border="0" />'
					.'<div style="padding: 8px 0 0 5px;">'
					.$dvalue
					.'</div>'
					.'</a>'
					.'</td>';
					
					// date
					echo '<td class="tcms_db_2">'
					.$tcms_file->getFileCreateTime(
						_TCMS_PATH.'/images/'.( trim($action) == 'image' ? 'Image' : 'knowledgebase' ).'/'.( $path == '' ? '' : $path.'/' ).$dvalue
					)
					.'</td>';
					
					// size
					echo '<td class="tcms_db_2">'
					.$tcms_file->getDirectorySizeString(
						_TCMS_PATH.'/images/'.( trim($action) == 'image' ? 'Image' : 'knowledgebase' ).'/'.( $path == '' ? '' : $path.'/' ).$dvalue
					)
					.'</td>';
					
					// function
					echo '<td class="tcms_db_2" style="text-align: middle;" align="right" valign="middle">'
					.$formStart
					.'<a title="'._TABLE_DELBUTTON.'" href="#" onclick="deleteFolder(\''.$id_user.'\', \''.trim($action).'\', \''.$path.'/'.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
					.'<div style="float: right; padding: 2px 0 0 0;">'
					.'<strong>'._TCMS_ADMIN_DELETE.'</strong>'
					.'</div>'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" border="0"'
					//.' style="margin: 2px 2px 0 2px; float: right;"'
					.' src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.$formEnd
					.'</td>';
					
					echo '</tr>';
					
					
					
					/*
					
					echo '<div style="width: 100%; height: 30px; display: block; '
					.'margin: 0 0 0 0 !important; padding: 0px !important; '
					.'text-align: left;"'
					.' onmouseover="return overlib(\''.$overlibText.'\', CAPTION, \''
					.( strlen($dvalue) > 25 ? substr($dvalue, 0, 20).' ...' : $dvalue )
					.'\', BELOW, RIGHT, WIDTH, 150);" onmouseout="return nd();">';
					
					$checkType = true;
					
					echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=image&amp;path='.$dvalue.'">'
					.'<img style="border: 1px solid #ccc; margin: 2px 2px 0 2px; float: left;"'
					.' src="../images/explore/faq_folder.png" border="0" />'
					.'<div style="padding: 8px 0 0 5px;">'
					.$dvalue
					.'</div>'
					.'</a>';
					
					echo '<span style="position: absolute; right: 50px; padding: 0 0 0 4px;">'
					.'<a style="text-decoration: none !important;" href="#" onclick="deleteMediafile(\''.$id_user.'\', \''.trim($action).'\', \''.$path.'/'.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
					.'<img title="'._TCMS_ADMIN_DELETE.'" alt="'._TCMS_ADMIN_DELETE.'" border="0"'
					.' src="../images/a_delete.gif" />'
					.'<strong>'._TCMS_ADMIN_DELETE.'</strong>'
					.'</span>';
					
					echo '</div>';
					
					if($count < $amount) {
						echo '<div style="border-bottom: 1px solid #ececec;"></div>';
					}*/
				}
				else {
					//if($tcms_config->getMediamanagerItemView() == 'icon') {
					echo '<form id="'.$dvalue.'" name="'.$dvalue.'" action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post">'
					.'<input name="todo" type="hidden" value="del_img" />'
					.'<input name="action" type="hidden" value="'.trim($action).'" />'
					.'<input name="delimg" type="hidden" value="'.$dvalue.'" />';
					
					$overlibText = '<strong>'._GALLERY_IMGTITLE.':</strong>'
					.'<br />'.$dvalue;
					
					echo '<div style="width: 100px; height: 155px; float: left; '
					.'margin: 0 10px 0 0 !important; padding: 0px !important; '
					.'border: 1px solid #ececec; text-align: left;">';
					
					echo '<div style="width: 100px; height: 100px; display: block; float: left; '
					.'margin: 0 0 5px 0 !important; padding: 0px !important; '
					.'border-bottom: 1px solid #ececec;" '
					.'onmouseover="return overlib(\''.$overlibText.'\', CAPTION, \''
					.( strlen($dvalue) > 25 ? substr($dvalue, 0, 20).' ...' : $dvalue )
					.'\', BELOW, RIGHT, WIDTH, 150);" onmouseout="return nd();">';
					
					$checkType = true;
					
					echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=image&amp;path='.$dvalue.'">'
					.'<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;"'
					.' src="../images/filesystem/folder.png" border="0" />'
					.'</a>';
					
					echo '</div>';
					
					echo '<div style="padding: 0 0 0 4px;">'.$dvalue.'<br />'
					.'<a style="text-decoration: none !important;" href="#" onclick="deleteFolder(\''.$id_user.'\', \''.trim($action).'\', \''.$path.'/'.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
					.'<img title="'._TCMS_ADMIN_DELETE.'" alt="'._TCMS_ADMIN_DELETE.'" border="0"'
					.' src="../images/a_delete.gif" />'
					.'&nbsp;<strong style="padding-top: 5px;">'._TCMS_ADMIN_DELETE.'</strong></a>'
					.'</div>';
					
					echo '</div>';
					
					echo '</form>';
				}
				
				$count++;
			}
		}
		
		$bgkey = 0;
		
		// files
		foreach($arr_dir as $fileKey => $fileVal) {
			$dkey = $fileKey;
			$dvalue = $fileVal;
			
			$relPath = ( $path == '' ? '' : $path.'/' );
			$relPref = ( $action == 'image' ? 'thumb_' : 'thumb_faq_' );
			
			//echo $fileKey.$fileVal.'<br />';
			
			if($tcms_main->isImage($dvalue, false)
			|| $tcms_main->isAudio($dvalue, false)
			|| $tcms_main->isVideo($dvalue, false)
			|| $tcms_main->isMultimedia($dvalue, false)) {
				if(!preg_match('/.mp3/i', strtolower($dvalue))) {
					if(trim($action) == 'image') {
						if(!file_exists(_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue)) {
							$tcms_gd->createThumbnailExt(
								$relPref, 
								_TCMS_PATH.'/images/Image/'.$relPath, 
								_TCMS_PATH.'/images/upload_thumb/'.$relPath, 
								$dvalue, 
								100
							);
						}
					}
					else {
						if(!file_exists(_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue)) {
							$tcms_gd->createThumbnailExt(
								$relPref, 
								_TCMS_PATH.'/images/knowledgebase/'.$relPath, 
								_TCMS_PATH.'/images/upload_thumb/'.$relPath, 
								$dvalue, 
								100
							);
						}
					}
				}
				
				$formStart = '<form id="'.$dvalue.'" name="'.$dvalue.'"'
				.' action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post">'
				.'<input name="todo" type="hidden" value="del_img" />'
				.'<input name="action" type="hidden" value="'.trim($action).'" />'
				.'<input name="delimg" type="hidden" value="'.$path.'/'.$dvalue.'" />';
				
				$formEnd = '</form>';
				
				
				// get thumbnail info
				$boxH = 0;
				$boxImgH = 0;
				
				if($tcms_main->isImage($dvalue, false)) {
					if($tcms_file->checkFileExist(_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue)) {
						$tcms_gd->readImageInformation(
							_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue
						);
						
						if($tcms_gd->getImageHeight() > 85) {
							$boxH = $tcms_gd->getImageHeight() + 70;
							$boxImgH = $tcms_gd->getImageHeight() + 15;
						}
						else {
							$boxH = 155;
							$boxImgH = 100;
						}
					}
					else {
						$boxH = 155;
						$boxImgH = 100;
					}
				}
				else {
					$boxH = 155;
					$boxImgH = 100;
				}
				
				// get image info
				if(!preg_match('/.mp3/i', strtolower($dvalue))) {
					if(trim($action) == 'image') {
						if(file_exists(_TCMS_PATH.'/images/Image/'.$relPath.$dvalue)) {
							$tcms_gd->readImageInformation(
								_TCMS_PATH.'/images/Image/'.$relPath.$dvalue
							);
						}
					}
					else {
						if(file_exists(_TCMS_PATH.'/images/knowledgebase/'.$dvalue)) {
							$tcms_gd->readImageInformation(
								_TCMS_PATH.'/images/knowledgebase/'.$dvalue
							);
						}
					}
				}
				
				if(trim($action) == 'image') {
					if($tcms_file->checkFileExist(_TCMS_PATH.'/images/Image/'.$relPath.$dvalue)) {
						//$size = filesize(_TCMS_PATH.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue) / 1024;
						$size = $tcms_file->getFilesize(
							_TCMS_PATH.'/images/Image/'.$relPath.$dvalue
						) / 1024;
					}
				}
				else {
					if($tcms_file->checkFileExist(_TCMS_PATH.'/images/knowledgebase/'.$dvalue)) {
						//$size = filesize(_TCMS_PATH.'/images/knowledgebase/'.$dvalue) / 1024;
						$size = $tcms_file->getFilesize(
							_TCMS_PATH.'/images/knowledgebase/'.$dvalue
						) / 1024;
					}
				}
				
				$kpos = strpos($size, '.');
				$img_size = substr($size, 0, $kpos+3);
				
				if(strlen($dvalue) > 15) {
					$dvalue1 = substr($dvalue, 0, 15);
					$dvalue2 = substr($dvalue, 15, ( strlen($dvalue) - 15 ));
					$dvalue3 = $dvalue1.' '.$dvalue2;
				}
				else {
					$dvalue3 = $dvalue;
				}
				
				// display now...
				if($tcms_config->getMediamanagerItemView() == 'list') {
					$bgkey++;
					
					if(is_integer($bgkey / 2)) {
						$ws_color = $arr_color[0];
					}
					else {
						$ws_color = $arr_color[1];
					}
					
					$checkType = true;
					
					if($tcms_file->getMimeType(strtolower($dvalue)) == 'mp3' && $checkType) {
						$imgAdd = '<img src=../images/mimetypes/mp3.png border=0 />';
						$fileType = 'music';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wma' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/wma.png border=0 />';
						$fileType = 'music';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wav' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/wav.png border=0 />';
						$fileType = 'music';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'ogg' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/ogg.png border=0 />';
						$fileType = 'music';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'avi' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/avi.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'mpeg' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/mpeg.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'mpg' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/mpeg.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wmv' && $checkType) {
						$imgAdd = '<img  src=../images/mimetypes/wmv.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'swf' && $checkType) {
						$imgAdd = '<img '
						.' src=../images/mimetypes/swf.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'cab' && $checkType) {
						$imgAdd = '<img '
						.' src=../images/mimetypes/cab.png border=0 />';
						$fileType = 'movie';
						$checkType = false;
					}
					else if($checkType) {
						if($tcms_file->checkFileExist(_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue)) {
							$imgAdd = '<img'.(
								$img_o_height > $img_o_width
								? ( $img_o_height > 100 ? ' height=100' : '' )
								: ( $img_o_width > 100 ? ' width=100' : '' )
							).' src='._TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue.''
							.' border=0 />';
							
							$fileType = 'image';
						}
						else {
							$imgAdd = '<img'
							.' height=100'
							.' width=100'
							//.' style=border: 1px solid #ccc;'
							//.' style="border: 1px solid #ccc; margin: 26px auto auto 26px;" '
							.' src=../images/blank.gif'
							.' border=0 />';
							
							$fileType = 'image';
						}
					}
					
					$overlibText = '<strong>'._GALLERY_IMGTITLE.':</strong>'
					.'<br />'
					.$dvalue3
					.'<br />'
					.'<strong>'._GALLERY_IMGSIZE.':</strong>'
					.'<br />'
					.'<em>'.$img_size.' KB</em>';
					
					if($tcms_main->isImage($dvalue, false)) {
						$overlibText .= '<br />'
						.'<strong>'._GALLERY_IMGRESOLUTION.':</strong>'
						.'<br />'
						.$imgAdd
						.'<br />'
						.'<em>W '.$tcms_gd->getImageWidth().' x H '.$tcms_gd->getImageHeight().'</em>';
						
						$overlibText .= '<br />'
						.'<strong>'._GALLERY_MIMETYPE.':</strong>'
						.'<br />'
						.'<em>'.$tcms_gd->getImageMimetyp().'</em>';
					}
					
					echo '<tr height="30" id="row'.$count.'" '
					.'style="background: '.$ws_color.';" '
					.'onMouseOver="wxlBgCol(\'row'.$count.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$count.'\',\''.$ws_color.'\')">';
					
					// name
					echo '<td align="left" class="tcms_db_2">'
					.'
					
					<a onmouseover="return overlib(\''.$overlibText.'\', CAPTION, \''
					.( strlen($dvalue) > 25 ? substr($dvalue, 0, 20).' ...' : $dvalue )
					.'\', BELOW, RIGHT, WIDTH, 150);" onmouseout="return nd();"'
					.' href="javascript:imageWindowExt(\''.$relPath.$dvalue.'\', \'media\', '.( trim($action) == 'image' ? 'false' : 'true' ).');">'
					.'<img style="border: 1px solid #ccc; margin: 2px 2px 0 2px; float: left;"'
					.' src="../images/explore/'.$fileType.'.png" border="0" />'
					.'<div style="padding: 8px 0 0 5px;">'
					.$dvalue
					.'</div>'
					.'</a>'
					.'</td>';
					
					// date
					echo '<td class="tcms_db_2">'
					.$tcms_file->getFileCreateTime(
						'../../data/images/'.( trim($action) == 'image' ? 'Image' : 'knowledgebase' ).'/'.$relPath.$dvalue
					)
					.'</td>';
					
					// size
					echo '<td class="tcms_db_2">'
					.$tcms_file->getDirectorySizeString(
						'../../data/images/'.( trim($action) == 'image' ? 'Image' : 'knowledgebase' ).'/'.$relPath.$dvalue
					)
					.'</td>';
					
					// function
					echo '<td class="tcms_db_2" style="text-align: middle;" align="right" valign="middle">'
					.$formStart
					.'<a title="'._TABLE_DELBUTTON.'" href="#"'
					.' onclick="'
					.'deleteMediafileExt(\''.$id_user.'\', \''.trim($action).'\', \''.$relPath.'\', \''.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');'
					.'">'
					.'<div style="float: right; padding: 2px 0 0 0;">'
					.'<strong>'._TCMS_ADMIN_DELETE.'</strong>'
					.'</div>'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" border="0"'
					//.' style="margin: 2px 2px 0 2px; float: right;"'
					.' src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.$formEnd
					.'</td>';
					
					echo '</tr>';
				}
				else {
					echo $formStart;
					
					echo '<a href="javascript:imageWindow(\''.$path.'/'.$dvalue.'\', \'media\');">'
					.'<div style="width: 100px; height: '.$boxH.'px; float: left; '
					.'margin: 0 10px 10px 0 !important; padding: 0px !important; '
					.'border: 1px solid #ececec; text-align: left;">';
					
					$overlibText = '<strong>'._GALLERY_IMGTITLE.':</strong><br />'.$dvalue3.'<br />'
					.'<strong>'._GALLERY_IMGSIZE.':</strong><br /><em>'.$img_size.' KB</em>';
					
					if($tcms_main->isImage($dvalue, false)) {
						$overlibText .= '<br />'
						.'<strong>'._GALLERY_IMGRESOLUTION.':</strong>'
						.'<br />'
						.'<em>W '.$tcms_gd->getImageWidth().' x H '.$tcms_gd->getImageHeight().'</em>';
						
						$overlibText .= '<br />'
						.'<strong>'._GALLERY_MIMETYPE.':</strong>'
						.'<br />'
						.'<em>'.$tcms_gd->getImageMimetyp().'</em>';
					}
					
					echo '<div style="width: 100px; height: '.$boxImgH.'px; display: block; float: left; '
					.'margin: 0 0 5px 0 !important; padding: 0px !important; '
					.'border-bottom: 1px solid #ececec;" '
					.'onmouseover="return overlib(\''.$overlibText.'\', CAPTION, \''
					.( strlen($dvalue) > 25 ? substr($dvalue, 0, 20).' ...' : $dvalue )
					.'\', BELOW, RIGHT, WIDTH, 150);" onmouseout="return nd();">';
					
					$checkType = true;
					
					if($tcms_file->getMimeType(strtolower($dvalue)) == 'mp3' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mp3.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wma' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wma.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wav' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wav.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'ogg' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/ogg.png" border="0" />';
						$checkType = false;
					}
					elseif($tcms_file->getMimeType(strtolower($dvalue)) == 'avi' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/avi.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'mpeg' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'mpg' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mpeg.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'wmv' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wmv.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'swf' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;"'
						.' src="../images/mimetypes/swf.png" border="0" />';
						$checkType = false;
					}
					else if($tcms_file->getMimeType(strtolower($dvalue)) == 'cab' && $checkType) {
						echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;"'
						.' src="../images/mimetypes/cab.png" border="0" />';
						$checkType = false;
					}
					else if($checkType) {
						if($tcms_file->checkFileExist(_TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue)) {
							echo '<img'.(
								$img_o_height > $img_o_width
								? ( $img_o_height > 100 ? ' height="100"' : '' )
								: ( $img_o_width > 100 ? ' width="100"' : '' )
							).' style="border: 1px solid #ccc;"'
							.' src="'._TCMS_PATH.'/images/upload_thumb/'.$relPath.$relPref.$dvalue.'"'
							.' border="0" />';
						}
						else {
							echo '<img'
							.' height="100"'
							.' width="100"'
							.' style="border: 1px solid #ccc;"'
							.' src="../images/blank.gif"'
							.' border="0" />';
						}
					}
					
					echo '</div>';
					
					
					echo '<div style="padding: 0 0 0 4px;">'.$dvalue3.'<br />'
					.'<a style="text-decoration: none !important;" href="#"'
					.' onclick="'
					.'deleteMediafileExt(\''.$id_user.'\', \''.trim($action).'\', \''.$relPath.'\', \''.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');'
					.'">'
					.'<img title="'._TCMS_ADMIN_DELETE.'" alt="'._TCMS_ADMIN_DELETE.'" border="0" src="../images/a_delete.gif" />'
					.'&nbsp;<strong style="padding-top: 5px;">'._TCMS_ADMIN_DELETE.'</strong></a>'
					.'</div>';
					
					
					echo '</div>'
					.'</a>';
					
					echo $formEnd;
				}
				
				$count++;
			}
		}
	}
	
	if($tcms_config->getMediamanagerItemView() == 'icon') {
		echo '</td></tr>';
	}
	
	echo $tcms_html->tableEnd();
}


echo '</div>';




// --------------------------------------------------------------------
// UPLOAD
// --------------------------------------------------------------------

if($todo == 'upload') {
	// image file upload
	if($_FILES['event']['size'] > 0 && (
	$tcms_main->isImage($_FILES['event']['type']) ||
	$tcms_main->isAudio($_FILES['event']['type']) ||
	$tcms_main->isVideo($_FILES['event']['type']) ||
	$tcms_main->isMultimedia($_FILES['event']['type']))) {
		if($_FILES['event']['size'] <= $upload_max_filesize
		&& $_FILES['event']['size'] <= $post_max_size) {
			$fileName = $_FILES['event']['name'];
			
			$fileName = $tcms_main->cleanFilename($fileName);
			
			if(trim($action) == 'image') {
				$imgDir = _TCMS_PATH.'/images/Image/';
			}
			else {
				$imgDir = _TCMS_PATH.'/images/knowledgebase/';
			}
			
			if($directory != '__DEFAULT__') {
				$imgDir .= $directory.'/';
			}
			
			copy($_FILES['event']['tmp_name'], $imgDir.$fileName);
			
			//$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['event']['name'];
			$msg = '';
		}
		else {
			$msg = _MSG_NOUPLOAD_PHP;
		}
	}
	else {
		$msg = _MSG_NOUPLOAD;
	}
	
	echo '<script>'
	.( trim($msg) == '' ? '' : 'alert(\''.$msg.'\');' )
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.trim($action)
	.( $directory == '__DEFAULT__' ? '' : '&path='.$directory ).'\';'
	.'</script>';
}




// --------------------------------------------------------------------
// DELETE IMAGE
// --------------------------------------------------------------------

if($todo == 'deleteImage') {
	if(trim($action) == 'image') {
		if(is_dir(_TCMS_PATH.'/images/Image/'.$path.$delimg) == 1) {
			//$tcms_file->deleteDir(_TCMS_PATH.'/images/Image/'.$delimg);
			unlink(_TCMS_PATH.'/images/Image/'.$path.$delimg);
		}
		else {
			unlink(_TCMS_PATH.'/images/Image/'.$path.$delimg);
		}
		
		$relPref = 'thumb_';
	}
	else {
		if(is_dir(_TCMS_PATH.'/images/knowledgebase/'.$path.$delimg) == 1) {
			//$tcms_file->deleteDir(_TCMS_PATH.'/images/knowledgebase/'.$delimg);
			unlink(_TCMS_PATH.'/images/knowledgebase/'.$path.$delimg);
		}
		else {
			unlink(_TCMS_PATH.'/images/knowledgebase/'.$path.$delimg);
		}
		
		$relPref = 'thumb_faq_';
	}
	
	unlink(_TCMS_PATH.'/images/upload_thumb/'.$path.$relPref.$delimg);
	
	if(trim($path) != '') {
		$path = str_replace('/', '', $path);
		$path = str_replace('//', '', $path);
		$relPath = '&path='.$path;
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.trim($action).$relPath.'\';'
	.'</script>';
}




// --------------------------------------------------------------------
// DELETE FOLDER
// --------------------------------------------------------------------

if($todo == 'deleteFolder') {
	if(trim($action) == 'image') {
		$tcms_file->deleteDir(_TCMS_PATH.'/images/Image/'.$delimg);
		$tcms_file->deleteDir(_TCMS_PATH.'/images/upload_thumb/'.$delimg);
	}
	else {
		$tcms_file->deleteDir(_TCMS_PATH.'/images/knowledgebase/'.$delimg);
		$tcms_file->deleteDir(_TCMS_PATH.'/images/upload_thumb/'.$delimg);
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.trim($action).'\';'
	.'</script>';
}




// --------------------------------------------------------------------
// CREATE DIR
// --------------------------------------------------------------------

if($todo == 'createDir') {
	if(trim($action) == 'image') {
		if(!is_dir(_TCMS_PATH.'/images/Image/'.$directory)) {
			@mkdir(_TCMS_PATH.'/images/Image/'.$directory, 0777);
			@chmod(_TCMS_PATH.'/images/Image/'.$directory, 0777);
			
			@mkdir(_TCMS_PATH.'/images/upload_thumb/'.$directory, 0777);
			@chmod(_TCMS_PATH.'/images/upload_thumb/'.$directory, 0777);
		}
	}
	else {
		if(!is_dir(_TCMS_PATH.'/images/knowledgebase/'.$directory)) {
			@mkdir(_TCMS_PATH.'/images/knowledgebase/'.$directory, 0777);
			@chmod(_TCMS_PATH.'/images/knowledgebase/'.$directory, 0777);
			
			@mkdir(_TCMS_PATH.'/images/upload_thumb/'.$directory, 0777);
			@chmod(_TCMS_PATH.'/images/upload_thumb/'.$directory, 0777);
		}
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.trim($action).'\';'
	.'</script>';
}

?>
