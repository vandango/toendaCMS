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
 * @version 0.4.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['path'])){ $path = $_GET['path']; }
if(isset($_GET['delimg'])){ $delimg = $_GET['delimg']; }
if(isset($_GET['directory'])){ $directory = $_GET['directory']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['event'])){ $event = $_POST['event']; }
if(isset($_POST['delimg'])){ $delimg = $_POST['delimg']; }
if(isset($_POST['path'])){ $path = $_POST['path']; }
if(isset($_POST['directory'])){ $directory = $_POST['directory']; }




// --------------------------------------------------------------------
// TABS
// --------------------------------------------------------------------

if(!isset($action)){ $action = 'image'; }

echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
.'<a'.( $action == 'image' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=image">'._TCMS_MENU_MEDIA.'</a>'
.'<a'.( $action == 'faq' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_media&amp;action=faq">'._TCMS_MENU_FAQ.'</a>'
.'</div>';

echo '<div class="tcms_tabPage"><br />';




// --------------------------------------------------------------------
// INIT
// --------------------------------------------------------------------

if(!isset($path)) $path = '';

if($action == 'image') {
	$arr_dir = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/images/Image/'.$path);
}
else {
	$arr_dir = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/images/knowledgebase/');
}

$maxVal = count($arr_dir);




// --------------------------------------------------------------------
// DISPLAY
// --------------------------------------------------------------------

if($todo != 'upload' && $todo != 'deleteImage'){
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
		.' onclick="document.location=\'admin.php?site=mod_media&id_user='.$id_user.'&todo=createDir&directory=\' + document.getElementById(\'directory\').value;" />'
		.'</td></tr>';
	}
	
	
	// row
	echo '<tr><td class="tcms_padding_mini">'
	.'<select class="tcms_select" name="directory" id="directory">'
	.'<option value="'.( $path == '' ? '__DEFAULT__' : $path ).'">'.( $path == '' ? _TCMS_BASE_DIRECTORY : $path ).'</option>';
	
	$arr_path = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/images/'.( $action == 'image' ? 'Image' : 'knowledgebase' ).'/'.$path, true);
	
	foreach($arr_path as $fkey => $fvalue){
		echo '<option value="'.$fvalue.'">'.$fvalue.'</option>';
	}
	
	echo '</select>'
	.'<input name="event" type="file" class="tcms_upload" />'
	.'<input name="event" type="button" onclick="accept(\'upload\');" class="tcms_button" value="'._TCMS_ADMIN_UPLOAD.'" />'
	.'<input name="todo" type="hidden" value="upload" />'
	.'<input name="action" type="hidden" value="'.$action.'" />'
	.'</td></tr>';
	
	
	// row
	echo '</table>'
	.'</form>'
	.'<br /><br />';
	
	
	
	
	/*
		PLACE FOR IMG
	*/
	
	echo $tcms_html->tableHead('0', '0', '0', '100%');
	echo '<tr valign="top"><td valign="top">';
	
	if($tcms_main->isArray($arr_dir)){
		// folder
		foreach($arr_dir as $dkey => $dvalue){
			if(is_dir(trim('../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue))){
				echo '<form id="'.$dvalue.'" name="'.$dvalue.'" action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post">'
				.'<input name="todo" type="hidden" value="del_img" />'
				.'<input name="action" type="hidden" value="'.$action.'" />'
				.'<input name="delimg" type="hidden" value="'.$dvalue.'" />';
				
				echo '<div style="width: 100px; height: 155px; float: left; '
				.'margin: 0 10px 0 0 !important; padding: 0px !important; '
				.'border: 1px solid #ececec; text-align: left;">';
				
				$overlibText = '<strong>'._GALLERY_IMGTITLE.':</strong><br />'.$dvalue;
				
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
				.'<a style="text-decoration: none !important;" href="#" onclick="deleteMediafile(\''.$id_user.'\', \''.$action.'\', \''.$path.'/'.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
				.'<img title="'._TCMS_ADMIN_DELETE.'" alt="'._TCMS_ADMIN_DELETE.'" border="0"'
				.' src="../images/a_delete.gif" />'
				.'&nbsp;<strong style="padding-top: 5px;">'._TCMS_ADMIN_DELETE.'</strong></a>'
				.'</div>';
				
				
				echo '</div>';
				
				echo '</form>';
			}
		}
		
		//$tcms_main->paf($arr_dir);
		
		// files
		foreach($arr_dir as $fileKey => $fileVal){
			$dkey = $fileKey;
			$dvalue = $fileVal;
			
			//echo $fileKey.$fileVal.'<br />';
			
			if($tcms_main->isImage($dvalue, false)
			|| $tcms_main->isAudio($dvalue, false)
			|| $tcms_main->isVideo($dvalue, false)
			|| $tcms_main->isMultimedia($dvalue, false)){
				if(!preg_match('/.mp3/i', strtolower($dvalue))){
					if($action == 'image'){
						if(!file_exists('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue)) {
							$tcms_gd->createThumbnail(
								'../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ), 
								'../../'.$tcms_administer_site.'/images/upload_thumb/', 
								$dvalue, 
								100
							);
						}
					}
					else{
						if(!file_exists('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue)) {
							$tcms_gd->createThumbnail(
								'../../'.$tcms_administer_site.'/images/knowledgebase/', 
								'../../'.$tcms_administer_site.'/images/upload_thumb/', 
								$dvalue, 
								100
							);
						}
					}
				}
				
				echo '<form id="'.$dvalue.'" name="'.$dvalue.'"'
				.' action="admin.php?id_user='.$id_user.'&amp;site=mod_media" method="post">'
				.'<input name="todo" type="hidden" value="del_img" />'
				.'<input name="action" type="hidden" value="'.$action.'" />'
				.'<input name="delimg" type="hidden" value="'.$path.'/'.$dvalue.'" />';
				
				
				// get thumbnail info
				$boxH = 0;
				$boxImgH = 0;
				
				if($tcms_main->isImage($dvalue, false)) {
					if(file_exists('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue)) {
						$tcms_gd->readImageInformation(
							'../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue
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
				
				echo '<a href="javascript:imageWindow(\''.$path.'/'.$dvalue.'\', \'media\');">'
				.'<div style="width: 100px; height: '.$boxH.'px; float: left; '
				.'margin: 0 10px 10px 0 !important; padding: 0px !important; '
				.'border: 1px solid #ececec; text-align: left;">';
				
				
				// get image info
				if(!preg_match('/.mp3/i', strtolower($dvalue))){
					if($action == 'image'){
						if(file_exists('../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue)) {
							$tcms_gd->readImageInformation(
								'../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue
							);
						}
					}
					else {
						if(file_exists('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue)) {
							$tcms_gd->readImageInformation(
								'../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue
							);
						}
					}
				}
				
				
				if($action == 'image') {
					if(file_exists('../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue)) {
						$size = filesize('../../'.$tcms_administer_site.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$dvalue) / 1024;
					}
				}
				else {
					if(file_exists('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue)) {
						$size = filesize('../../'.$tcms_administer_site.'/images/knowledgebase/'.$dvalue) / 1024;
					}
				}
				
				$kpos = strpos($size, '.');
				$img_size = substr($size, 0, $kpos+3);
				
				if(strlen($dvalue) > 15){
					$dvalue1 = substr($dvalue, 0, 15);
					$dvalue2 = substr($dvalue, 15, ( strlen($dvalue) - 15 ));
					$dvalue3 = $dvalue1.' '.$dvalue2;
				}
				else{
					$dvalue3 = $dvalue;
				}
				
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
				
				if(preg_match('/.mp3/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mp3.png" border="0" />';
					$checkType = false;
				}
				if(preg_match('/.wma/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wma.png" border="0" />';
					$checkType = false;
				}
				if(preg_match('/.wav/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wav.png" border="0" />';
					$checkType = false;
				}
				if(preg_match('/.ogg/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/ogg.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.avi/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/avi.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.mpeg/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mpeg.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.mpg/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/mpeg.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.wmv/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;" src="../images/mimetypes/wmv.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.swf/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;"'
					.' src="../images/mimetypes/swf.png" border="0" />';
					$checkType = false;
				}
				elseif(preg_match('/.cab/i', strtolower($dvalue)) && $checkType){
					echo '<img style="border: 1px solid #ccc; margin: 26px auto auto 26px;"'
					.' src="../images/mimetypes/cab.png" border="0" />';
					$checkType = false;
				}
				elseif($checkType){
					if(file_exists('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue)) {
						echo '<img'.(
							$img_o_height > $img_o_width
							? ( $img_o_height > 100 ? ' height="100"' : '' )
							: ( $img_o_width > 100 ? ' width="100"' : '' )
						).' style="border: 1px solid #ccc;"'
						.' src="../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$dvalue.'"'
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
				.'<a style="text-decoration: none !important;" href="#" onclick="deleteMediafile(\''.$id_user.'\', \''.$action.'\', \''.$dvalue.'\', \''._MSG_DELETE_SUBMIT.'\');">'
				.'<img title="'._TCMS_ADMIN_DELETE.'" alt="'._TCMS_ADMIN_DELETE.'" border="0" src="../images/a_delete.gif" />'
				.'&nbsp;<strong style="padding-top: 5px;">'._TCMS_ADMIN_DELETE.'</strong></a>'
				.'</div>';
				
				
				echo '</div>'
				.'</a>';
				
				echo '</form>';
			}
		}
	}
	
	echo '</td></tr>';
	echo tcms_html::table_end();
}


echo '</div>';




// --------------------------------------------------------------------
// UPLOAD
// --------------------------------------------------------------------

if($todo == 'upload'){
	// image file upload
	if($_FILES['event']['size'] > 0 && (
	$tcms_main->isImage($_FILES['event']['type']) ||
	$tcms_main->isAudio($_FILES['event']['type']) ||
	$tcms_main->isVideo($_FILES['event']['type']) ||
	$tcms_main->isMultimedia($_FILES['event']['type']))){
		$fileName = $_FILES['event']['name'];
		
		$fileName = $tcms_main->cleanFilename($fileName);
		
		if($action == 'image')
			$imgDir = '../../'.$tcms_administer_site.'/images/Image/';
		else
			$imgDir = '../../'.$tcms_administer_site.'/images/knowledgebase/';
		
		if($directory != '__DEFAULT__')
			$imgDir .= $directory.'/';
		
		copy($_FILES['event']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['event']['name'];
	}
	else{
		$msg = _MSG_NOUPLOAD;
	}
	
	echo '<script>'
	.'alert(\''.$msg.'\');'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.$action
	.( $directory == '__DEFAULT__' ? '' : '&path='.$directory ).'\';'
	.'</script>';
}




// --------------------------------------------------------------------
// DELETE
// --------------------------------------------------------------------

if($todo == 'deleteImage'){
	if($action == 'image'){
		if(is_dir('../../'.$tcms_administer_site.'/images/Image/'.$delimg) == 1){
			$tcms_main->deleteDir('../../'.$tcms_administer_site.'/images/Image/'.$delimg);
		}
		else{
			unlink('../../'.$tcms_administer_site.'/images/Image/'.$delimg);
		}
	}
	else{
		unlink('../../'.$tcms_administer_site.'/images/knowledgebase/'.$delimg);
	}
	
	unlink('../../'.$tcms_administer_site.'/images/upload_thumb/thumb_'.$delimg);
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_media&action='.$action.'\';'
	.'</script>';
}




// --------------------------------------------------------------------
// CREATE DIR
// --------------------------------------------------------------------

if($todo == 'createDir'){
	if(!is_dir('../../'.$tcms_administer_site.'/images/Image/'.$directory)){
		mkdir('../../'.$tcms_administer_site.'/images/Image/'.$directory, 0777);
		chmod('../../'.$tcms_administer_site.'/images/Image/'.$directory, 0777);
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_media\';</script>';
}

?>
