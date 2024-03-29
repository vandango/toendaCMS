<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Imagegallery Manager
|
| File:	mod_gallery.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Imagegallery Manager
 *
 * This module is used to manage the galleries.
 *
 * @version 0.9.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['gg_albums'])){ $gg_albums = $_GET['gg_albums']; }
if(isset($_GET['value'])){ $value = $_GET['value']; }

if(isset($_POST['gg_albums'])){ $gg_albums = $_POST['gg_albums']; }
if(isset($_POST['use_image_details'])){ $use_image_details = $_POST['use_image_details']; }
if(isset($_POST['use_image_comments'])){ $use_image_comments = $_POST['use_image_comments']; }
if(isset($_POST['tmp_image_id'])){ $tmp_image_id = $_POST['tmp_image_id']; }
if(isset($_POST['image_title'])){ $image_title = $_POST['image_title']; }
if(isset($_POST['image_stamp'])){ $image_stamp = $_POST['image_stamp']; }
if(isset($_POST['new_image_access'])){ $new_image_access = $_POST['new_image_access']; }
if(isset($_POST['new_album'])){ $new_album = $_POST['new_album']; }
if(isset($_POST['description'])){ $description = $_POST['description']; }
if(isset($_POST['album_id'])){ $album_id = $_POST['album_id']; }
if(isset($_POST['dir'])){ $dir = $_POST['dir']; }
if(isset($_POST['file'])){ $file = $_POST['file']; }
if(isset($_POST['timecode'])){ $timecode = $_POST['timecode']; }
if(isset($_POST['event'])){ $event = $_POST['event']; }
if(isset($_POST['delimg'])){ $delimg = $_POST['delimg']; }
if(isset($_POST['title'])){ $title = $_POST['title']; }
if(isset($_POST['description'])){ $description = $_POST['description']; }
if(isset($_POST['path'])){ $path = $_POST['path']; }
if(isset($_POST['gImage'])){ $gImage = $_POST['gImage']; }
if(isset($_POST['use'])){ $use = $_POST['use']; }
if(isset($_POST['delete'])){ $delete = $_POST['delete']; }
if(isset($_POST['value'])){ $value = $_POST['value']; }
if(isset($_POST['ftp'])){ $ftp = $_POST['ftp']; }
if(isset($_POST['des'])){ $des = $_POST['des']; }
if(isset($_POST['folder'])){ $folder = $_POST['folder']; }
if(isset($_POST['zlib_upload'])){ $zlib_upload = $_POST['zlib_upload']; }
if(isset($_POST['new_list_option'])){ $new_list_option = $_POST['new_list_option']; }
if(isset($_POST['new_list_image_amount'])){ $new_list_image_amount = $_POST['new_list_image_amount']; }





// --------------------------------------------
// INIT
// --------------------------------------------

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;

if(!isset($gg_albums)) {
	$gg_albums = 'show';
}





// --------------------------------------------
// LIST
// --------------------------------------------

$param_save_mode = 'off';

if($param_save_mode == 'off') {
	/*
		Load Albums
	*/
	if($choosenDB == 'xml') {
		$arr_albums['count'] = $tcms_file->getPathContent(
			_TCMS_PATH.'/tcms_albums/'
		);
		
		// Load Use of albums
		$ii=0;
		
		while(!empty($arr_albums['count'][$ii])) {
			$albums_xml = new xmlparser(_TCMS_PATH.'/tcms_albums/'.$arr_albums['count'][$ii], 'r');
			
			$arr_albums['title'][$ii]       = $albums_xml->readSection('album', 'title');
			$arr_albums['path'][$ii]        = $albums_xml->readSection('album', 'path');
			$arr_albums['use'][$ii]         = $albums_xml->readSection('album', 'use');
			$arr_albums['description'][$ii] = $albums_xml->readSection('album', 'description');
			$arr_albums['image'][$ii]       = $albums_xml->readSection('album', 'image');
			
			// CHARSETS
			$arr_albums['title'][$ii]       = $tcms_main->decodeText($arr_albums['title'][$ii], '2', $c_charset);
			$arr_albums['description'][$ii] = $tcms_main->decodeText($arr_albums['description'][$ii], '2', $c_charset);
			
			if(!$arr_albums['image'][$ii]) { $arr_albums['image'][$ii] = ''; }
			
			$ii++;
		}
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll($tcms_db_prefix.'albums');
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$arr_albums['count'][$count]       = $sqlObj->uid;
			$arr_albums['title'][$count]       = $sqlObj->title;
			$arr_albums['path'][$count]        = $sqlObj->album_id;
			$arr_albums['use'][$count]         = $sqlObj->published;
			$arr_albums['description'][$count] = $sqlObj->desc;
			$arr_albums['image'][$count]       = $sqlObj->image;
			
			if($arr_albums['title'][$count]       == NULL){ $arr_albums['title'][$count]       = ''; }
			if($arr_albums['path'][$count]        == NULL){ $arr_albums['path'][$count]        = ''; }
			if($arr_albums['use'][$count]         == NULL){ $arr_albums['use'][$count]         = ''; }
			if($arr_albums['description'][$count] == NULL){ $arr_albums['description'][$count] = ''; }
			if($arr_albums['image'][$count]       == NULL){ $arr_albums['image'][$count]       = ''; }
			
			// CHARSETS
			$arr_albums['title'][$count]       = $tcms_main->decodeText($arr_albums['title'][$count], '2', $c_charset);
			$arr_albums['description'][$count] = $tcms_main->decodeText($arr_albums['description'][$count], '2', $c_charset);
			
			$count++;
			$checkCatAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	
	
	
	// --------------------------------------------------
	// CONFIG
	// --------------------------------------------------
	
	if($todo == 'config') {
		if($id_group == 'Developer' 
		|| $id_group == 'Administrator') {
			if($choosenDB == 'xml') {
				$image_xml             = new xmlparser(_TCMS_PATH.'/tcms_global/imagegallery.xml','r');
				$old_image_id          = $image_xml->readSection('config', 'image_id');
				$old_image_title       = $image_xml->readSection('config', 'image_title');
				$old_image_stamp       = $image_xml->readSection('config', 'image_stamp');
				$old_image_details     = $image_xml->readSection('config', 'image_details');
				$old_image_comments    = $image_xml->readSection('config', 'image_comments');
				$old_image_access      = $image_xml->readSection('config', 'access');
				$old_maxImg            = $image_xml->readSection('config', 'max_image');
				$old_needleImg         = $image_xml->readSection('config', 'needle_image');
				$old_showTitleImg      = $image_xml->readSection('config', 'show_lastimg_title');
				$old_alignImg          = $image_xml->readSection('config', 'align_image');
				$old_sizeImg           = $image_xml->readSection('config', 'size_image');
				$old_image_sort        = $image_xml->readSection('config', 'image_sort');
				$old_list_option       = $image_xml->readSection('config', 'list_option');
				$old_list_image_amount = $image_xml->readSection('config', 'list_option_amount');
				
				// CHARSETS
				$old_image_title = $tcms_main->decodeText($old_image_title, '2', $c_charset);
				$old_image_stamp = $tcms_main->decodeText($old_image_stamp, '2', $c_charset);
				$old_needleImg   = $tcms_main->decodeText($old_needleImg, '2', $c_charset);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'imagegallery_config', 'imagegallery');
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$old_image_id          = $sqlObj->image_id;
				$old_image_title       = $sqlObj->image_title;
				$old_image_stamp       = $sqlObj->image_stamp;
				$old_image_details     = $sqlObj->image_details;
				$old_image_comments    = $sqlObj->use_comments;
				$old_image_access      = $sqlObj->access;
				$old_maxImg            = $sqlObj->max_image;
				$old_needleImg         = $sqlObj->needle_image;
				$old_showTitleImg      = $sqlObj->show_lastimg_title;
				$old_alignImg          = $sqlObj->align_image;
				$old_sizeImg           = $sqlObj->size_image;
				$old_image_sort        = $sqlObj->image_sort;
				$old_list_option       = $sqlObj->list_option;
				$old_list_image_amount = $sqlObj->list_option_amount;
				
				if($old_image_id       == NULL){ $old_image_id       = ''; }
				if($old_image_title    == NULL){ $old_image_title    = ''; }
				if($old_image_stamp    == NULL){ $old_image_stamp    = ''; }
				if($old_image_details  == NULL){ $old_image_details  = ''; }
				if($old_image_comments == NULL){ $old_image_comments = ''; }
				if($old_image_access   == NULL){ $old_image_access   = ''; }
				if($old_maxImg         == NULL){ $old_maxImg         = ''; }
				if($old_needleImg      == NULL){ $old_needleImg      = ''; }
				if($old_showTitleImg   == NULL){ $old_showTitleImg   = ''; }
				if($old_alignImg       == NULL){ $old_alignImg       = 'center'; }
				if($old_sizeImg        == NULL){ $old_sizeImg        = ''; }
				if($old_image_sort     == NULL){ $old_image_sort     = ''; }
				if($old_list_image_amount == NULL){ $old_list_image_amount = 4; }
				
				$old_image_title = $tcms_main->decodeText($old_image_title, '2', $c_charset);
				$old_image_stamp = $tcms_main->decodeText($old_image_stamp, '2', $c_charset);
				$old_needleImg   = $tcms_main->decodeText($old_needleImg, '2', $c_charset);
			}
			
			
			$old_image_title = htmlspecialchars($old_image_title);
			$old_image_stamp = htmlspecialchars($old_image_stamp);
			$old_needleImg   = htmlspecialchars($old_needleImg);
			
			
			
			
			/*
				BEGIN FORM
			*/
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_gallery" method="post">'
			.'<input name="todo" type="hidden" value="save" />';
			
			
			/*
				TABLE FOR OUTPUT AND INPUT
			*/
			echo '<table cellpadding="2" cellspacing="0" width="100%" border="0" class="noborder">';
			
			
			// table title
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._GALLERY_CONFIG.'</strong></td></tr>';
			
			
			// table rows
			echo '<tr><td width="250">'._GALLERY_IMG_DETAILS.'</td>'
			.'<td><input type="checkbox" name="use_image_details" '.( $old_image_details == 1 ? 'checked' : '' ).' value="1" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_COMMENTS.'</td>'
			.'<td valign="top"><input type="checkbox" name="use_image_comments" '.( $old_image_comments == 1 ? 'checked' : '' ).' value="1" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_ID.'</td>'
			.'<td valign="top"><input name="tmp_image_id" readonly class="tcms_input_small" value="'.$old_image_id.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_FRONT_TITLE.'</td>'
			.'<td valign="top"><input name="image_title" class="tcms_input_normal" value="'.$old_image_title.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_FRONT_SUBTITLE.'</td>'
			.'<td valign="top"><input name="image_stamp" class="tcms_input_normal" value="'.$old_image_stamp.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._TABLE_SORT.'</td>'
			.'<td colspan="2">'
			.'<select name="new_image_sort" class="tcms_select">'
				.'<option value="desc"'.( $old_image_sort == 'desc' ? ' selected="selected"' : '' ).'>'._TABLE_SORT_DESC.'</option>'
				.'<option value="asc"'.( $old_image_sort == 'asc' ? ' selected="selected"' : '' ).'>'._TABLE_SORT_ASC.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._TABLE_VIEW.'</td>'
			.'<td colspan="2">'
			.'<select name="new_list_option" class="tcms_select">'
				.'<option value="0"'.( $old_list_option == '0' ? ' selected="selected"' : '' ).'>'._GALLERY_LIST_NORMAL.'</option>'
				.'<option value="1"'.( $old_list_option == '1' ? ' selected="selected"' : '' ).'>'._GALLERY_LIST_3_THUMB.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr>'
			.'<td valign="top">'
			._GALLERY_LAST_MAX_IMG.' ('._TABLE_VIEW.')'
			.'</td><td valign="top">'
			.'<input name="new_list_image_amount" class="tcms_id_box" value="'.$old_list_image_amount.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._TABLE_ACCESS.'</td>'
			.'<td colspan="2">'
			.'<select name="new_image_access" class="tcms_select">'
				.'<option value="Public"'.( $old_image_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected"'.( $old_image_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
				.'<option value="Private"'.( $old_image_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_LAST_SHOW_TITLE.'</td>'
			.'<td valign="top"><input type="checkbox" name="showTitleImg" '.( $old_showTitleImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_LAST_MAX_IMG.'</td>'
			.'<td valign="top"><input name="maxImg" class="tcms_id_box" value="'.$old_maxImg.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_LAST_SIZE.'</td>'
			.'<td valign="top"><input name="sizeImg" class="tcms_id_box" value="'.$old_sizeImg.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top">'._GALLERY_LAST_TEXT.'</td>'
			.'<td valign="top"><input name="needleImg" class="tcms_input_normal" value="'.$old_needleImg.'" />'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td valign="top" width="250">'._GALLERY_LAST_ALIGN.'</td>'
			.'<td>'
			.'<select name="alignImg" class="tcms_select">'
				.'<option value="left"'.( $old_alignImg == 'left' ? ' selected="selected"' : '' ).'>'._TABLE_LEFT.'</option>'
				.'<option value="right"'.( $old_alignImg == 'right' ? ' selected="selected"' : '' ).'>'._TABLE_RIGHT.'</option>'
				.'<option value="center"'.( $old_alignImg == 'center' ? ' selected="selected"' : '' ).'>'._TABLE_CENTER.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// table title
			echo '<tr><td colspan="2"><br />'._GALLERY_GRAVATAR.'</td></tr>';
			
			
			// Table end
			echo '</table><br />';
			
			echo '</form>';
		}
		else {
			echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
		}
	}
	
	
	
	
	
	// --------------------------------------------------
	// ACTIONS
	// --------------------------------------------------
	
	if($gg_albums == 'show' 
	&& $todo != 'config' 
	&& todo != 'save') {
		if($todo == 'createAlbum') {
			/*
				BEGIN FORM
			*/
			
			if($choosenDB == 'xml') {
				$album_id = $tcms_main->getNewUID(6, 'albums');
				$album_id = 'album_'.$album_id;
			}
			else {
				$album_id = $tcms_main->getNewUID(12, 'albums');
			}
			
			
			
			echo '<form name="new" id="new" action="admin.php?id_user='.$id_user.'&site=mod_gallery" method="post">'
			.'<input name="album_id" type="hidden" value="'.$album_id.'" />'
			.'<input name="todo" type="hidden" value="create" />';
			
			
			// table head
			echo '<table cellpadding="2" cellspacing="0" width="100%" border="0" class="noborder">';
			
			
			// row
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._GALLERY_CREATE.'</strong></td></tr>';
			
			
			// row
			echo '<tr><td width="250" style="padding-top: 4px;">'._GALLERY_NEW.'</td>'
			.'<td style="padding-top: 4px;"><input name="new_album" class="tcms_input_normal" value="" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td width="250" valign="top">'._GALLERY_DESCRIPTION.'</td>'
			.'<td><textarea name="description" class="tcms_textarea_big"></textarea>'
			.'</td></tr>';
			
			
			// Table end
			echo '</table>'
			.'<br />';
			
			
			echo '</form>';
		}
		else {
			/*
				BEGIN FORM
			*/
			echo '<form name="upload" id="upload" action="admin.php?id_user='.$id_user.'&amp;site=mod_gallery" method="post" enctype="multipart/form-data">'
			.'<input name="todo" type="hidden" value="upload" />';
			
			
			/*
				TABLE FOR OUTPUT AND INPUT
			*/
			
			// table title
			echo '<table cellpadding="2" cellspacing="0" width="100%" border="0" class="noborder">';
			
			
			// table title
			echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini"><strong>'._GALLERY_UPLOAD.'</strong></td></tr>';
			
			
			// row
			echo '<tr><td width="200">'._TABLE_ALBUM.'</td>'
			.'<td width="60">'._TABLE_DIR.'</td>'
			.'<td align="left">'._TABLE_IMAGE.'</td>';
			
			if($choosenDB != 'xml'){
				$new_image_id = $tcms_main->getNewUID(10, 'imagegallery');
				echo '<input type="hidden" name="id" value="'.$new_image_id.'" />';
			}
			
			echo '</tr>';
			
			
			// row
			echo '<tr><td width="200">'
			.'<select class="tcms_select" onchange="document.getElementById(\'dir\').value=this.value;">';
			
			if($tcms_main->isReal($arr_albums['count'])) {
				foreach($arr_albums['count'] as $skey => $svalue){
					echo '<option value="'.$arr_albums['path'][$skey].'">'.$arr_albums['title'][$skey].'</option>';
				}
			}
			else {
				echo '<option value="">'._MSG_CREATE_ALBUM_FIRST.'</option>';
			}
			
			echo '</select>'
			.'</td><td width="60"><input name="dir" id="dir" value="'.$arr_albums['path'][0].'" type="text" class="tcms_id_box" /></td>'
			.'<td><input name="event" type="file" class="tcms_upload" accept="image/*" /></td></tr>';
			
			
			// tabel end
			echo '</table>'
			.'</form>'
			.'<br /><br />';
			
			
			
			
			
			/*
				album
				list
			*/
			
			// tabel head
			echo '<table cellpadding="2" cellspacing="0" border="0" class="noborder" width="100%">'
			.'<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="196" align="left">'._TABLE_ALBUM.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="50" align="left">'._TABLE_IMAGE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="25" align="right">'._TABLE_USE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="25" align="left">'._TABLE_DELETE.'</th>'
			.'<th valign="middle" class="tcms_db_title" align="right">'._TABLE_FUNCTIONS.'</th>'
			.'</tr>';
			
			if(isset($arr_albums['count']) && !empty($arr_albums['count']) && $arr_albums['count'] != ''){
				foreach($arr_albums['count'] as $key => $value){
					$bgkey++;
					if(is_integer($bgkey/2)){ $ws_farbe=$arr_farbe[0]; } else{ $ws_farbe=$arr_farbe[1]; }
					
					echo '<form name="albums_'.$arr_albums['path'][$key].'" id="albums_'.$arr_albums['path'][$key].'" action="'
					.'admin.php?id_user='.$id_user.'&site=mod_gallery'
					.'" method="post">';
					
					echo '<tr bgcolor="'.$ws_farbe.'">';
					
					echo '<td class="tcms_db_2" style="color: #333333;" valign="top">'
					.'<input name="title" class="tcms_input_normal" value="'.$arr_albums['title'][$key].'" /><br />'
					.'<textarea name="description" class="tcms_textarea_big">'.$arr_albums['description'][$key].'</textarea>';
					
					if($choosenDB == 'xml') {
						$tvalue = substr($value, 6, 6);
					}
					else {
						$tvalue = $arr_albums['path'][$key];
						
						echo '<input type="hidden" name="tmp_image_id" value="'.$value.'" />';
					}
					
					echo '</td>';
					
					
					/**************************
					*/
					
					echo '<td class="tcms_db_2" valign="top">';
					
					if($choosenDB == 'xml') {
						$arrGImages = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_imagegallery/'.$tvalue);
					}
					else {
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->getAll($tcms_db_prefix."imagegallery WHERE album='".$tvalue."'");
						$sqlNR = $sqlAL->getNumber($sqlQR);
						
						unset($arrGImages);
						
						if($sqlNR != 0){
							$count = 0;
							
							while($sqlARR = $sqlAL->fetchArray($sqlQR)){
								$arrGImages[$count]  = $sqlARR['image'];
								if($arrGImages[$count] == NULL){ $arrGImages[$count] = ''; }
								$count++;
							}
						}
					}
					
					$arr_albums['image'][$key] = trim($arr_albums['image'][$key]);
					
					if($arr_albums['image'][$key] != ''){
						if(!is_dir(_TCMS_PATH.'/thumbnails/'.$tvalue.'/')){
							$tcms_file->createDir(_TCMS_PATH.'/thumbnails/'.$tvalue.'/', 0777);
						}
						
						if(!file_exists(_TCMS_PATH.'/thumbnails/'.$tvalue.'/thumb_'.$arr_albums['image'][$key])){
							$tcms_gd->createThumbnailExt(
								'thumb_',
								_TCMS_PATH.'/images/albums/'.$tvalue.'/',
								_TCMS_PATH.'/thumbnails/'.$tvalue.'/', 
								$arr_albums['image'][$key], 
								100
							);
						}
					}
					
					echo '<img id="show_thumbnail_'.$key.'" src="'._TCMS_PATH.'/thumbnails/'.$tvalue.'/thumb_'.$arr_albums['image'][$key].'" border="0" alt="Thumbnail" />';
					echo '<br />';
					echo '<select name="gImage" onchange="'
					.'document.getElementById(\'show_thumbnail_'.$key.'\').src=\''._TCMS_PATH.'/thumbnails/'.$tvalue.'/thumb_\'+this.value;">';
					
					if($arrGImages) {
						foreach($arrGImages as $keyz => $val) {
							if($choosenDB == 'xml') {
								$valImg = substr($val, 0, strpos($val, '.xml'));
							}
							else {
								$valImg = $val;
							}
							
							echo '<option'
							.( $valImg == $arr_albums['image'][$key] ? ' selected' : '' )
							.' value="'.$valImg.'">'
							.$tcms_main->cutLongStringToShortString($valImg, 35)
							.'</option>';
						}
					}
					else {
						echo '<option value="">empty</option>';
					}
					
					echo '</select>';
					
					echo '</td>';
					
					
					
					echo '<td class="tcms_db_2" valign="top"><input type="checkbox" name="use" '.( $arr_albums['use'][$key] == 1 ? 'checked' : '' ).' value="1" /></td>';
					echo '<td class="tcms_db_2" valign="top"><input type="checkbox" name="delete" value="yes" /></td>';
					
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.'<input type="hidden" name="todo" value="albums" />'
					.'<input type="hidden" name="path" value="'.$arr_albums['path'][$key].'" />'
					.'<a title="'._TABLE_SAVEBUTTON.'" href="javascript:accept(\'albums_'.$arr_albums['path'][$key].'\');">'
					.'<img title="'._TABLE_SAVEBUTTON.'" alt="'._TABLE_SAVEBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_save.gif" />'
					.'</a><br />'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&site=mod_gallery&gg_albums=edit&value='.$tvalue.'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>'
					.'</td>';
					
					echo '</tr></form>';
				}
			}
			
			echo $tcms_html->tableEnd()
			.'<br />';
		}
	}
	
	
	
	
	
	// --------------------------------------------------
	// LIST IMAGES
	// --------------------------------------------------
	
	if($gg_albums == 'edit') {
		/*
			BEGIN FORM
		*/
		echo '<form name="upload" id="upload" action="admin.php?id_user='.$id_user.'&amp;site=mod_gallery" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="upload" />';
		
		
		if($tcms_main->isReal($arr_albums['count'])) {
			foreach($arr_albums['count'] as $skey => $svalue){
				if($value == $arr_albums['path'][$skey]){
					echo '<strong>'._GALLERY_THISIS.' '.$arr_albums['title'][$skey].' '._GALLERY_THISIS2.'</strong><br />
					'._GALLERY_THISIS3.'<br /><br />';
					$cig_path = $value;
					$this_album = $arr_albums['title'][$skey];
				}
			}
		}
		
		
		// table head
		echo '<table cellpadding="2" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table title
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini"><strong>'._GALLERY_UPLOAD.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td width="200">'._TABLE_ALBUM.'</td>'
		.'<td width="60">'._TABLE_DIR.'</td>'
		.'<td align="left">'._TABLE_IMAGE.'</td>'
		.'</tr>';
		
		
		// row
		echo '<tr><td width="200"><strong>'.$this_album.'</strong></td>'
		.'<td width="60"><em>'.$cig_path.'/</em><input name="dir" id="dir" type="hidden" value="'.$cig_path.'" /></td>'
		.'<td><input name="event" type="file" class="tcms_upload" accept="image/*" /></td></tr>';
		
		
		echo $tcms_html->tableEnd()
		.'</form>'
		.'<br />'
		.'<br />';
		
		
		
		
		
		/*
			list of all images
			from a album
		*/
		
		echo '<table cellpadding="2" cellspacing="0" border="0" class="noborder" width="100%">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="196" align="left">'._TABLE_NAME.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="25" align="left">'._TABLE_DELETE.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">&nbsp;'._TABLE_INFO.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">&nbsp;'._TABLE_DESCRIPTION.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="right">&nbsp;'._TABLE_FUNCTIONS.'</th>'
		.'</tr>';
		
		
		$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/albums/'.$value.'/');
		
		if($tcms_main->isReal($arr_dir)){
			foreach($arr_dir as $dkey => $dvalue){
				if($dvalue != 'Thumbs.db' && $dvalue != 'thumbs.db'){
					$tcms_gd = new tcms_gd();
					
					if(!is_dir(_TCMS_PATH.'/thumbnails/'.$value.'/')){
						$tcms_file->createDir(_TCMS_PATH.'/thumbnails/'.$value.'/', 0777);
					}
					
					if(!file_exists(_TCMS_PATH.'/thumbnails/'.$value.'/thumb_'.$dvalue)){
						$tcms_gd->createThumbnail(
							_TCMS_PATH.'/images/albums/'.$value.'/', 
							_TCMS_PATH.'/thumbnails/'.$value.'/', 
							$dvalue, 
							'100'
						);
					}
					
					$tcms_gd->readImageInformation(_TCMS_PATH.'/images/albums/'.$value.'/'.$dvalue);
					
					$img_o_width  = $tcms_gd->getImageWidth();
					$img_o_height = $tcms_gd->getImageHeight();
					
					$des_file = $dvalue;
					
					if($choosenDB == 'xml'){
						$des_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$value.'/'.$des_file.'.xml','r');
						$old_des = $des_xml->readSection('image', 'text');
						$old_tc  = $des_xml->readSection('image', 'timecode');
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."imagegallery WHERE image='".$des_file."' AND album='".$value."'");
						$sqlARR = $sqlAL->fetchArray($sqlQR);
						
						$old_des = $sqlARR['text'];
						$old_tc  = $sqlARR['date'];
						$old_tag = $sqlARR['uid'];
						
						if($old_des == NULL){ $old_des = ''; }
						if($old_tc  == NULL){ $old_tc  = ''; }
					}
					
					if($old_des == '' || empty($old_des)) {
						$old_des == '';
					}
					
					// CHARSETS
					$old_des = $tcms_main->decodeText($old_des, '2', $c_charset);
					
					
					// row / 5 cells
					echo '<tr><td colspan="5" height="2"></td></tr>';
					
					
					// begin form
					echo '<form id="'.$dvalue.'" name="'.$dvalue.'" action="admin.php?id_user='.$id_user.'&site=mod_gallery" method="post">'
					.'<input name="file" type="hidden" value="'.$des_file.'" />'
					.'<input name="todo" type="hidden" value="del_img" />'
					.'<input name="dir" type="hidden" value="'.$value.'" />'
					.'<input name="timecode" type="hidden" value="'.$old_tc.'" />';
					
					if($choosenDB != 'xml'){ echo '<input name="id" type="hidden" value="'.$old_tag.'" />'; }
					
					
					// row
					echo '<tr>';
					
					
					// cell
					echo '<td class="tcms_db_2" width="100" valign="top">'
					.'<img style="border: 1px solid #333333;" src="'._TCMS_PATH.'/thumbnails/'.$value.'/thumb_'.$dvalue.'" border="0" />'
					.'</td>';
					
					
					// cell
					echo '<td class="tcms_db_2" valign="top"><input type="checkbox" name="delimg" value="'.$dvalue.'" /></td>';
					
					
					// cell
					$size = filesize(_TCMS_PATH.'/images/albums/'.$value.'/'.$dvalue) / 1024;
					$kpos = strpos($size, '.');
					$img_size = substr($size, 0, $kpos+3);
					
					echo '<td class="tcms_db_2" valign="top">'
					._GALLERY_IMGTITLE.': '.$dvalue.'<br />'
					._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />'
					._GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height
					.'</em></td>';
					
					
					// cell
					echo '<td class="tcms_db_2" valign="top">'
					.'<textarea name="des" class="tcms_textarea_big">'.$old_des.'</textarea>'
					.'</td>';
					
					
					// cell
					echo '<td class="tcms_db_2" align="right" valign="top">'
					.'<a href="javascript:accept(\''.$dvalue.'\');">'
					.'<img title="'._TABLE_SAVEBUTTON.'" alt="'._TABLE_SAVEBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_save.gif" />'
					.'</a>'
					.'</td>';
					
					echo '</tr>'
					.'</form>';
					
					unset($tcms_gd);
				}
			}
		}
		
		echo $tcms_html->tableEnd()
		.'<br />';
	}
	
	
	
	
	
	// --------------------------------------------
	// CREATE ALBZUM FROM FTP UPLOAD
	// --------------------------------------------
	
	if($gg_albums == 'createftp') {
		$arr_ftp_album = $tcms_file->getPathContent(
			_TCMS_PATH.'/images/albums/'
		);
		
		if($choosenDB == 'xml') {
			$arr_check_album = $tcms_file->getPathContent(
				_TCMS_PATH.'/tcms_albums/'
			);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getAll($tcms_db_prefix.'albums');
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arr_check_album[$count]  = $sqlObj->album_id;
				
				if($arr_check_album[$count] == NULL) {
					$arr_check_album[$count] = '';
				}
				
				$count++;
			}
		}
		
		
		echo $tcms_html->bold(_GALLERY_FTP_UPLOAD)
		._GALLERY_FTP_UPLOAD_TEXT
		.'<br /><br />'
		.$tcms_html->text(
			_GALLERY_TEXT.'<br /><br />', 
			'left'
		);
		
		
		if(count($arr_ftp_album) > 1){
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_gallery&amp;gg_albums=createftp" method="post">'
			.'<input type="hidden" name="ftp" value="create" />';
			
			foreach($arr_ftp_album as $key => $value) {
				if($choosenDB == 'xml') {
					if($tcms_main->isArray($arr_check_album)) {
						if(!in_array('album_'.$value.'.xml', $arr_check_album)) {
							echo '<input type="radio" name="folder" value="'.$value.'" /> '.$value.'<br />';
						}
					}
					else {
						echo '<input type="radio" name="folder" value="'.$value.'" /> '.$value.'<br />';
					}
				}
				else {
					if(is_array($arr_check_album)) {
						if(!in_array($value, $arr_check_album)) {
							echo '<input type="radio" name="folder" value="'.$value.'" /> '.$value.'<br />';
						}
					}
					else {
						echo '<input type="radio" name="folder" value="'.$value.'" /> '.$value.'<br />';
					}
				}
			}
			
			echo '</form>';
		}
		
		
		if($ftp == 'create') {
			/*
				NEW ALBUM
			*/
			$new_maintag = $tcms_main->getNewUID(12, 'albums');
			$fake_folder = substr($new_maintag, 0, 6);
			
			if($choosenDB == 'xml') {
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_albums/album_'.$fake_folder.'.xml', 'w');
				$xmluser->xmlDeclaration();
				$xmluser->xmlSection('album');
				
				$xmluser->writeValue('title', $folder);
				$xmluser->writeValue('path', $fake_folder);
				$xmluser->writeValue('use', 0);
				$xmluser->writeValue('description', '[TYPE DESCRIPTION]');
				$xmluser->writeValue('image', '');
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('album');
				
				$xmluser->flush();
				unset($xmluser);
				
				$tcms_file->createDir(_TCMS_PATH.'/tcms_imagegallery/'.$fake_folder, 0777);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`title`, `album_id`, `published`, `desc`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'title, album_id, published, "desc"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[title], [album_id], [published], [desc]';
						break;
				}
				
				$newSQLData = "'".$folder."', '".$fake_folder."', 0, '[TYPE DESCRIPTION]'";
				
				$sqlQR = $sqlAL->createOne($tcms_db_prefix.'albums', $newSQLColumns, $newSQLData, $new_maintag);
			}
			
			
			$tcms_file->createDir(_TCMS_PATH.'/thumbnails/'.$fake_folder, 0777);
			
			$start_path  = _TCMS_PATH.'/images/albums/'.$folder.'/';
			$target_path = _TCMS_PATH.'/tcms_imagegallery/'.$fake_folder.'/';
			//tcms_gd::createftp($start_path, $target_path);
			
			$tcms_gd->generateFTPImageData(
				$start_path, 
				$target_path, 
				$choosenDB
			);
			
			/*if($choosenDB == 'xml'){
				$target_path = _TCMS_PATH.'/tcms_imagegallery/'.$fake_folder.'/';
				//tcms_gd::createftp($start_path, $target_path);
				
				$tcms_gd->generateFTPImageData(
					$start_path, 
					$target_path, 
					$choosenDB
				);
			}
			else{
				tcms_gd::createftp_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $start_path, $fake_folder);
			}*/
			
			rename(_TCMS_PATH.'/images/albums/'.$folder, _TCMS_PATH.'/images/albums/'.$fake_folder);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery\';'
			.'</script>';
		}
		
		
		
		/*
			BEGIN FORM
		*/
		echo '<form name="zlib" id="zlib" action="admin.php?id_user='.$id_user.'&amp;site=mod_gallery" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="zlib_save" />';
		
		
		// table head
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// row
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini"><strong>'._GALLERY_ZTITLE.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="150">'._GALLERY_ZFILE.'</td>'
		.'<td><input name="zlib_upload" type="file" class="tcms_upload" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="150">&nbsp;</td>'
		.'<td><a class="tcms_navigation_button" href="javascript:accept(\'zlib\');">'._TCMS_ADMIN_INSTALL.'</a>'
		.'</td></tr>';
		
		
		// table end
		echo '</table><br />';
		
		echo '</form>';
	}
	
	
	
	
	
	// --------------------------------------------
	// UPLOAD ZIP-FOLDER
	// --------------------------------------------
	
	if($todo == 'zlib_save') {
		/*
			upload gz - zip
		*/
		if($_FILES['zlib_upload']['size'] > 0 
		&& $_FILES['zlib_upload']['type'] == 'application/zip') {
			if($_FILES['zlib_upload']['size'] <= $upload_max_filesize
			&& $_FILES['zlib_upload']['size'] <= $post_max_size) {
				// theme file name
				$gzFileName = $_FILES['zlib_upload']['name'];
				
				// theme dir name
				if(strpos($gzFileName, '.zip') == false) {
					$gzEnd = strpos($gzFileName, '.gz');
				}
				else {
					$gzEnd = strpos($gzFileName, '.zip');
				}
				
				$gzDirName = substr($gzFileName, 0, $gzEnd);
				
				// make theme dir and make theme var name
				$tcms_file->createDir(_TCMS_PATH.'/images/albums/'.$gzDirName, 0777);
				
				// theme paths
				$themeDir  = _TCMS_PATH.'/images/albums/'.$gzDirName.'/';
				$themePath = _TCMS_PATH.'/images/albums';
				
				// copy file to theme directory
				copy($_FILES['zlib_upload']['tmp_name'], $themeDir.$gzFileName);
				
				// ZLib coding
				$archive = new PclZip($themeDir.$gzFileName);
				if($archive->extract(PCLZIP_OPT_PATH, $themePath) == 0){
					die(_MSG_ERROR.' : '.$archive->errorInfo(true));
				}
				
				// remove zip file
				$tcms_file->deleteFile($themeDir.$gzFileName);
				
				// make path writeable
				$tcms_file->CHMOD($themeDir, 0777);
				
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery&gg_albums=createftp\';'
				.'</script>';
			}
			else {
				echo '<script>'
				.'alert(\''._MSG_NOUPLOAD_PHP.'\');'
				.'</script>';
			}
		}
		else {
			echo '<script>alert(\''
			._MSG_ERROR.': '._MSG_PHP_UPLOAD_SETTINGS.'\n'
			._MSG_FILE_UPLOADS.': '.$tcms_main->getPHPSetting('file_uploads').'\n'
			._MSG_MAX_FILESIZE.': '.ini_get('upload_max_filesize').'\n'
			.'\');</script>';
		}
	}
	
	
	
	
	
	// --------------------------------------------
	// SAVE CONFIG
	// --------------------------------------------
	
	if($todo == 'save') {
		if($use_image_details       == '' || !isset($use_image_details))     { $use_image_details       = 0; }
		if($use_image_comments      == '' || !isset($use_image_comments))    { $use_image_comments      = 0; }
		if($tmp_image_id            == '' || !isset($tmp_image_id))          { $tmp_image_id            = 'imagegallery'; }
		if($image_title             == '' || !isset($image_title))           { $image_title             = 'Imagegallery'; }
		if($image_stamp             == '' || !isset($image_stamp))           { $image_stamp             = ''; }
		if($_POST['maxImg']         == '' || empty($_POST['maxImg']))        { $_POST['maxImg']         = 0; }
		if($_POST['needleImg']      == '' || empty($_POST['needleImg']))     { $_POST['needleImg']      = ''; }
		if($_POST['showTitleImg']   == '' || empty($_POST['showTitleImg']))  { $_POST['showTitleImg']   = 0; }
		if($_POST['alignImg']       == '' || empty($_POST['alignImg']))      { $_POST['alignImg']       = 'center'; }
		if($_POST['sizeImg']        == '' || empty($_POST['sizeImg']))       { $_POST['sizeImg']        = 0; }
		if($_POST['new_image_sort'] == '' || empty($_POST['new_image_sort'])){ $_POST['new_image_sort'] = 'desc'; }
		if($new_list_option         == '' || !isset($new_list_option))       { $new_list_option         = '0'; }
		if($new_list_image_amount   == '' || !isset($new_list_image_amount)) { $new_list_image_amount   = 4; }
		
		$image_stamp        = $tcms_main->encodeText($image_stamp, '2', $c_charset);
		$image_title        = $tcms_main->encodeText($image_title, '2', $c_charset);
		$_POST['needleImg'] = $tcms_main->encodeText($_POST['needleImg'], '2', $c_charset);
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/imagegallery.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('config');
			
			$xmluser->writeValue('image_id', $tmp_image_id);
			$xmluser->writeValue('image_title', $image_title);
			$xmluser->writeValue('image_stamp', $image_stamp);
			$xmluser->writeValue('image_details', $use_image_details);
			$xmluser->writeValue('image_comments', $use_image_comments);
			$xmluser->writeValue('access', $new_image_access);
			$xmluser->writeValue('max_image', $_POST['maxImg']);
			$xmluser->writeValue('needle_image', $_POST['needleImg']);
			$xmluser->writeValue('show_lastimg_title', $_POST['showTitleImg']);
			$xmluser->writeValue('align_image', $_POST['alignImg']);
			$xmluser->writeValue('size_image', $_POST['sizeImg']);
			$xmluser->writeValue('image_sort', $_POST['new_image_sort']);
			$xmluser->writeValue('list_option', $new_list_option);
			$xmluser->writeValue('list_option_amount', $$new_list_image_amount);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('config');
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'imagegallery_config.image_id="'.$tmp_image_id.'", '
			.$tcms_db_prefix.'imagegallery_config.image_title="'.$image_title.'", '
			.$tcms_db_prefix.'imagegallery_config.image_stamp="'.$image_stamp.'", '
			.$tcms_db_prefix.'imagegallery_config.image_details='.$use_image_details.', '
			.$tcms_db_prefix.'imagegallery_config.use_comments='.$use_image_comments.', '
			.$tcms_db_prefix.'imagegallery_config.access="'.$new_image_access.'", '
			.$tcms_db_prefix.'imagegallery_config.max_image='.$_POST['maxImg'].', '
			.$tcms_db_prefix.'imagegallery_config.needle_image="'.$_POST['needleImg'].'", '
			.$tcms_db_prefix.'imagegallery_config.show_lastimg_title='.$_POST['showTitleImg'].', '
			.$tcms_db_prefix.'imagegallery_config.align_image="'.$_POST['alignImg'].'", '
			.$tcms_db_prefix.'imagegallery_config.size_image='.$_POST['sizeImg'].', '
			.$tcms_db_prefix.'imagegallery_config.image_sort="'.$_POST['new_image_sort'].'", '
			.$tcms_db_prefix.'imagegallery_config.list_option='.$new_list_option.', '
			.$tcms_db_prefix.'imagegallery_config.list_option_amount='.$new_list_image_amount;
			
			$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'imagegallery_config', $newSQLData, 'imagegallery');
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery&todo=config\';'
		.'</script>';
	}
	
	
	
	
	
	// --------------------------------------------
	// CREATE ALBUM
	// --------------------------------------------
	
	if($todo == 'create') {
		$album_path = substr($album_id, 6, 6);
			
		// CHARSETS
		$new_album   = $tcms_main->encodeText($new_album, '2', $c_charset);
		$description = $tcms_main->encodeText($description, '2', $c_charset);
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_albums/'.$album_id.'.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('album');
			
			$xmluser->writeValue('title', $new_album);
			$xmluser->writeValue('path', $album_path);
			$xmluser->writeValue('use', 0);
			$xmluser->writeValue('description', $description);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('album');
			
			$tcms_file->createDir(_TCMS_PATH.'/tcms_imagegallery/'.$album_path, 0777);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`title`, `album_id`, `published`, `desc`, `image`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'title, album_id, published, "desc", image';
					break;
				
				case 'mssql':
					$newSQLColumns = '[title], [album_id], [published], [desc], [image]';
					break;
			}
			
			$newSQLData = "'".$new_album."', '".$album_path."', 0, '".$description."', '".$gImage."'";
			
			$sqlQR = $sqlAL->createOne($tcms_db_prefix.'albums', $newSQLColumns, $newSQLData, $album_id);
		}
		
		$tcms_file->createDir(_TCMS_PATH.'/images/albums/'.$album_path, 0777);
		$tcms_file->createDir(_TCMS_PATH.'/thumbnails/'.$album_path, 0777);
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery\';'
		.'</script>';
	}
	
	
	
	
	
	// --------------------------------------------
	// DELETE AND EDIT ALBUMS
	// --------------------------------------------
	
	if($todo == 'albums') {
		if(isset($delete) 
		&& $delete == 'yes') {
			/*
				DELETE
			*/
			if($choosenDB == 'xml') {
				$tcms_file->CHMOD(_TCMS_PATH.'/images/albums/'.$path.'/', 0777);
				$tcms_file->CHMOD(_TCMS_PATH.'/thumbnails/'.$path.'/', 0777);
				
				$tcms_file->deleteFile(_TCMS_PATH.'/tcms_albums/album_'.$path.'.xml');
				
				$tcms_file->deleteDir(_TCMS_PATH.'/images/albums/'.$path.'/');
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_imagegallery/'.$path.'/');
				$tcms_file->deleteDir(_TCMS_PATH.'/thumbnails/'.$path.'/');
			}
			else {
				$tcms_file->CHMOD(_TCMS_PATH.'/images/albums/'.$path.'/', 0777);
				$tcms_file->CHMOD(_TCMS_PATH.'/thumbnails/'.$path.'/', 0777);
				
				$tcms_file->deleteDir(_TCMS_PATH.'/images/albums/'.$path.'/');
				$tcms_file->deleteDir(_TCMS_PATH.'/thumbnails/'.$path.'/');
				
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlAL->deleteOne($tcms_db_prefix.'albums', $tmp_image_id);
				$sqlAL->query("DELETE FROM ".$tcms_db_prefix."imagegallery WHERE album='".$path."'");
			}
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery\';'
			.'</script>';
		}
		else {
			/*
				EDIT
			*/
			if(empty($use)) {
				$use = 0;
			}
			
			// CHARSETS
			$title       = $tcms_main->encodeText($title, '2', $c_charset);
			$description = $tcms_main->encodeText($description, '2', $c_charset);
			
			if($choosenDB == 'xml') {
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_albums/album_'.$path.'.xml', 'w');
				$xmluser->xmlDeclaration();
				$xmluser->xmlSection('album');
				
				$xmluser->writeValue('title', $title);
				$xmluser->writeValue('path', $path);
				$xmluser->writeValue('use', $use);
				$xmluser->writeValue('description', $description);
				$xmluser->writeValue('image', $gImage);
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('album');
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$newSQLData = ''
				.$tcms_db_prefix.'albums.title="'.$title.'", '
				.$tcms_db_prefix.'albums.album_id="'.$path.'", '
				.$tcms_db_prefix.'albums.published='.$use.', '
				.$tcms_db_prefix.'albums.desc="'.$description.'", '
				.$tcms_db_prefix.'albums.image="'.$gImage.'"';
				
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'albums', $newSQLData, $tmp_image_id);
			}
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery\';'
			.'</script>';
		}
	}
	
	
	
	
	
	// --------------------------------------------
	// EDIT AND DELETE IMAGES
	// --------------------------------------------
	
	if($todo == 'del_img') {
		if(isset($delimg)) {
			/*
				DELETE
			*/
			if($choosenDB == 'xml') {
				$tcms_file->deleteFile(_TCMS_PATH.'/images/albums/'.$dir.'/'.$delimg);
				$tcms_file->deleteFile(_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/'.$delimg.'.xml');
				$tcms_file->deleteFile(_TCMS_PATH.'/thumbnails/'.$dir.'/thumb_'.$delimg);
				$tcms_file->deleteFile(_TCMS_PATH.'/thumbnails/'.$dir.'/medium_thumb_'.$delimg);
				
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/comments_'.$delimg);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->query(
					'DELETE FROM '.$tcms_db_prefix.'imagegallery WHERE album="'.$dir.'" AND image="'.$delimg.'"'
				);
				
				$tcms_file->deleteFile(_TCMS_PATH.'/images/albums/'.$dir.'/'.$delimg);
				$tcms_file->deleteFile(_TCMS_PATH.'/thumbnails/'.$dir.'/thumb_'.$delimg);
				$tcms_file->deleteFile(_TCMS_PATH.'/thumbnails/'.$dir.'/medium_thumb_'.$delimg);
			}
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery&gg_albums=edit&value='.$dir.'\';'
			.'</script>';
		}
		else {
			/*
				EDIT
			*/
			$des = $tcms_main->encodeText($des, '2', $c_charset);
			
			if($choosenDB == 'xml') {
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/'.$file.'.xml', 'w');
				$xmluser->xmlDeclaration();
				$xmluser->xmlSection('image');
				
				$xmluser->writeValue('text', $des);
				$xmluser->writeValue('timecode', $timecode);
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('image');
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$newSQLData = ''
				.$tcms_db_prefix.'imagegallery.album="'.$dir.'", '
				.$tcms_db_prefix.'imagegallery.image="'.$file.'", '
				.$tcms_db_prefix.'imagegallery.text="'.$des.'", '
				.$tcms_db_prefix.'imagegallery.date="'.$timecode.'"';
				
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'imagegallery', $newSQLData, $id);
			}
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery&gg_albums=edit&value='.$dir.'\';'
			.'</script>';
		}
	}
	
	
	
	
	
	// --------------------------------------------
	// UPLOAD IMAGES
	// --------------------------------------------
	
	if($todo == 'upload') {
		// image file upload
		if($_FILES['event']['size'] > 0 
		&& $tcms_main->isImage($_FILES['event']['type'])) {
			if($_FILES['event']['size'] <= $upload_max_filesize
			&& $_FILES['event']['size'] <= $post_max_size) {
				$fileName = $_FILES['event']['name'];
				$imgDir = _TCMS_PATH.'/images/albums/'.$dir.'/';
				
				copy($_FILES['event']['tmp_name'], $imgDir.$fileName);
				
				$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['event']['name'];
				
				$doUpload = true;
			}
			else {
				$msg = _MSG_NOUPLOAD_PHP;
				
				$doUpload = false;
			}
		}
		else {
			$msg = _MSG_NOUPLOAD;
			
			$doUpload = false;
		}
		
		if($doUpload) {
			$timecode = date('YmdHis');
			
			$fileName = $tcms_main->encodeText($fileName, '2', $c_charset, true);
			
			
			// write data
			if($choosenDB == 'xml') {
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/'.$fileName.'.xml', 'w');
				$xmluser->xmlDeclaration();
				$xmluser->xmlSection('image');
				
				$xmluser->writeValue('text', $fileName);
				$xmluser->writeValue('timecode', $timecode);
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('image');
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`album`, `image`, `text`, `date`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'album, image, text, date';
						break;
					
					case 'pgsql':
						$newSQLColumns = '[album], [image], [text], [date]';
						break;
				}
				
				$newSQLData = "'".$dir."', '".$fileName."', '".$fileName."', '".$timecode."'";
				
				$maintag = $tcms_main->getNewUID(10, 'imagegallery');
				
				$sqlQR = $sqlAL->createOne(
					$tcms_db_prefix.'imagegallery', 
					$newSQLColumns, 
					$newSQLData, 
					$maintag
				);
			}
			
			echo '<script>'
			//.'alert(\''.$msg.'.\');'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery&gg_albums=edit&value='.$dir.'\';'
			.'</script>';
		}
		else {
			echo '<script>'
			.'alert(\''.$msg.'.\');'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_gallery\';'
			.'</script>';
		}
	}
}
else {
	echo '<strong>'._MSG_PHP_SAFE_MODE_SETTINGS.'</strong>';
}

?>
