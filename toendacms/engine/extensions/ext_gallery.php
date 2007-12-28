<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Imagegallery
|
| File:	ext_gallery.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Imagegallery
 *
 * This module is used as a imagegallery.
 *
 * @version 0.7.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['albums'])){ $albums = $_GET['albums']; }


$hr_line_1 = '<tr class="hr_line"><td colspan="2"></td></tr>';
$hr_line_2 = '<tr style="height: 5px;"><td colspan="2"><hr class="hrule" noshade="noshade" /></td></tr>';


/*
	Load Albums
*/

if($choosenDB == 'xml'){
	$arr_albums['count'] = $tcms_file->getPathContent($tcms_administer_site.'/tcms_albums/');
	
	$ca = 0;
	if($tcms_main->isReal($arr_albums['count'])){
		foreach($arr_albums['count'] as $key => $value){
			$albums_xml = new xmlparser($tcms_administer_site.'/tcms_albums/'.$arr_albums['count'][$ca], 'r');
			$use = $albums_xml->readSection('album', 'use');
			
			if($use == 1){
				$arr_albums['title'][$ca]       = $albums_xml->readSection('album', 'title');
				$arr_albums['path'][$ca]        = $albums_xml->readSection('album', 'path');
				$arr_albums['description'][$ca] = $albums_xml->readSection('album', 'description');
				$arr_albums['image'][$ca]       = $albums_xml->readSection('album', 'image');
				
				// CHARSETS
				$arr_albums['title'][$ca]       = $tcms_main->decodeText($arr_albums['title'][$ca], '2', $c_charset);
				$arr_albums['description'][$ca] = $tcms_main->decodeText($arr_albums['description'][$ca], '2', $c_charset);
				
				if(!$arr_albums['image'][$ca]){ $arr_albums['image'][$ca] = ''; }
				
				$ca++;
			}
		}
	}
	
	if(is_array($arr_albums['path']) && !empty($arr_albums['path'])){
		array_multisort(
			$arr_albums['title'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['path'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['description'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['image'], SORT_ASC, SORT_REGULAR
		);
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlSTR = "SELECT * "
	."FROM ".$tcms_db_prefix."albums "
	."WHERE published = 1 "
	."ORDER BY title ASC";
	
	$sqlQR = $sqlAL->query($sqlSTR);
	
	$count = 0;
	
	while($sqlObj = $sqlAL->fetchObject($sqlQR)){
		$arr_albums['count'][$count]       = $sqlObj->uid;
		$arr_albums['title'][$count]       = $sqlObj->title;
		$arr_albums['path'][$count]        = $sqlObj->album_id;
		$arr_albums['description'][$count] = $sqlObj->desc;
		$arr_albums['image'][$count]       = $sqlObj->image;
		
		if($arr_albums['title'][$count]       == NULL){ $arr_albums['title'][$count]       = ''; }
		if($arr_albums['path'][$count]        == NULL){ $arr_albums['path'][$count]        = ''; }
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





/*
	Start page
*/

if(!isset($albums)){ $albums = 'start'; }

if($albums == 'start') {
	echo $tcms_html->contentModuleHeader(
		$image_title, 
		$image_stamp, 
		''
	);
	
	
	// table rows
	echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">'
	.'<tr>'
	.'<th class="titleBG" align="left" width="20%"><strong>'._GALLERY_TITLE.'</strong></th>'
	.'<th class="titleBG" align="left" width="70%" style="padding-left: 5px;"><strong>'._GALLERY_DESCRIPTION.'</strong></th>'
	.'</tr>';
	
	echo '<tr><td valign="top" colspan="2" style="height: 7px;"></td></tr>';
	
	if(is_array($arr_albums['path'])){
		foreach($arr_albums['path'] as $key => $value){
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id='.$id.'&amp;s='.$s.'&amp;albums='.$arr_albums['path'][$key]
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			/*
			echo '<tr><td valign="top" colspan="2" class="text_big">'
			.'<a style="padding-left: 3px;" href="'.$link.'">'
			.'<strong>'.$arr_albums['title'][$key].'</strong></a>'
			.'</td></tr>';
			*/
			
			echo '<tr>'
			.'<td colspan="2" class="text_big">'
			.'<div class="headLineGallery">'
			.'<br />'
			.'<span class="text_big"><a style="padding-left: 3px;" href="'.$link.'">'
			.'<strong>'.$arr_albums['title'][$key].'</strong></a></span>'
			.'</div>'
			.'</td>'
			.'</tr>';
			
			echo '<tr><td valign="top" colspan="2" style="height: 3px;"></td></tr>';
			
			echo '<tr class="text_normal">';
			
			echo '<td width="20%" valign="top">'
			.'<a href="'.$link.'">';
			
			if($arr_albums['image'][$key] != ''){
				if(!is_dir($tcms_administer_site.'/thumbnails/'.$value.'/')) {
					mkdir($tcms_administer_site.'/thumbnails/'.$value.'/', 0777);
				}
				
				if(!file_exists($tcms_administer_site.'/thumbnails/'.$value.'/thumb_'.$arr_albums['image'][$key])) {
					$tcms_gd->createThumbnail(
						$tcms_administer_site.'/images/albums/'.$value.'/', 
						$tcms_administer_site.'/thumbnails/'.$value.'/', 
						$arr_albums['image'][$key], 
						'100'
					);
				}
				
				echo '<img style="border: 1px solid #333333;" '
				.'src="'.$imagePath.$tcms_administer_site.'/thumbnails/'.$value.'/thumb_'.$arr_albums['image'][$key].'" '
				.'border="0" align="left" />';
			}
			else{
				echo '<img style="border: 1px solid #333333;" '
				.'src="'.$imagePath.'engine/images/no_picture.gif" '
				.'border="0" align="left" />';
			}
			
			echo '</a></td>';
			
			echo '<td width="70%" valign="top" style="padding-left: 5px;">'.
				$arr_albums['description'][$key]
			.'</td></tr>';
			
			//echo '<tr><td valign="top" colspan="2"><hr class="hr_line" /></td></tr>';
			echo '<tr>'
			.'<td valign="top" colspan="2">'
			.'<div class="headLinePadding">'
			.'<img src="'.$imagePath.'engine/images/blank.gif" border="0" height="1" />'
			.'</div>'
			.'</td>'
			.'</tr>';
		}
	}
	
	echo '</table>';
}





/*
	Pictures
*/

if($albums != 'start'){
	if($tcms_main->isReal($arr_albums['path'])) {
		foreach($arr_albums['path'] as $a_key => $a_value){
			if($albums == $a_value){
				if($choosenDB == 'xml'){
					$album_xml   = new xmlparser($tcms_administer_site.'/tcms_albums/album_'.$a_value.'.xml', 'r');
					$album_title = $album_xml->readSection('album', 'title');
					$album_path  = $album_xml->readSection('album', 'path');
					$album_use   = $album_xml->readSection('album', 'use');
					$album_desc  = $album_xml->readSection('album', 'description');
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->getAll($tcms_db_prefix."albums WHERE album_id='".$a_value."'");
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$album_title = $sqlObj->title;
					$album_path  = $sqlObj->album_id;
					$album_use   = $sqlObj->published;
					$album_desc  = $sqlObj->desc;
					
					if($album_title == NULL){ $album_title = ''; }
					if($album_path  == NULL){ $album_path  = ''; }
					if($album_use   == NULL){ $album_use   = ''; }
					if($album_desc  == NULL){ $album_desc  = ''; }
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				// CHARSETS
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
				$album_desc  = $tcms_main->decodeText($album_desc, '2', $c_charset);
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=imagegallery&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<div class="contentheading">'._GALLERY_THISIS.' '.$album_title.' '._GALLERY_THISIS2.'</div>'
				.'(&nbsp;<a href="'.$link.'">'.$image_title.'</a>&nbsp;)'
				.'<br /><br />';
				
				echo '<span class="contentmain">'.$album_desc.'</span>'
				.'<br /><br />';
				
				
				echo $tcms_html->tableHeadClass('0', '2', '0', '100%', 'noborder news_content_bg');
				
				
				$arr_dir = $tcms_main->getPathContent($tcms_administer_site.'/images/albums/'.$a_value.'/');
				
				
				if($tcms_main->isArray($arr_dir)){
					if($choosenDB == 'xml'){
						$timecc = 0;
						foreach($arr_dir as $ikey => $val){
							$des_xml = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$a_value.'/'.$val.'.xml','r');
							$arr_tc['tc'][$timecc] = $des_xml->readSection('image', 'timecode');
							$arr_tc['fn'][$timecc] = $val;
							$timecc++;
						}
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->getAll($tcms_db_prefix."imagegallery WHERE album='".$a_value."'");
						
						$timecc = 0;
						
						while($sqlObj = $sqlAL->fetchObject($sqlQR)){
							$arr_tc['tc'][$timecc]  = $sqlObj->date;
							$arr_tc['fn'][$timecc]  = $sqlObj->image;
							
							if($arr_tc['tc'][$timecc] == NULL){ $arr_tc['tc'][$timecc] = ''; }
							if($arr_tc['fn'][$timecc] == NULL){ $arr_tc['fn'][$timecc] = ''; }
							
							$timecc++;
						}
					}
					
					if($tcms_main->isArray($arr_tc['fn'])){
						switch($gallery_image_sort){
							case 'desc':
								array_multisort(
									$arr_tc['tc'], SORT_DESC, 
									$arr_tc['fn'], SORT_DESC
								);
								break;
							
							case 'asc':
								array_multisort(
									$arr_tc['tc'], SORT_ASC, 
									$arr_tc['fn'], SORT_ASC
								);
								break;
							
							default:
								array_multisort(
									$arr_tc['tc'], SORT_DESC, 
									$arr_tc['fn'], SORT_DESC
								);
								break;
						}
					}
					
					
					$imagesPerRow = ( $tcms_main->isReal($list_option_amount) ? $list_option_amount : 4 );
					$currentColumn = 0;
					
					if($tcms_main->isArray($arr_tc['fn'])){
						foreach($arr_tc['fn'] as $dkey => $dvalue){
							if(trim($dvalue) != ''){
								if(!is_dir($tcms_administer_site.'/thumbnails/'.$a_value.'/')){
									mkdir($tcms_administer_site.'/thumbnails/'.$a_value.'/', 0777);
								}
								
								if(!file_exists($tcms_administer_site.'/thumbnails/'.$a_value.'/thumb_'.$dvalue)){
									$tcms_gd->createThumbnail(
										$tcms_administer_site.'/images/albums/'.$a_value.'/',
										$tcms_administer_site.'/thumbnails/'.$a_value.'/', $dvalue, 
										$arr_albums['image'][$key], 
										'100'
									);
								}
								
								$img_size = getimagesize($tcms_administer_site.'/images/albums/'.$a_value.'/'.$dvalue);
								$img_o_width  = $img_size[0];
								$img_o_height = $img_size[1];
								
								
								$des_file = $dvalue;
								
								if($choosenDB == 'xml') {
									$des_xml = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$a_value.'/'.$des_file.'.xml','r');
									$old_des = $des_xml->readSection('image', 'text');
								}
								else {
									$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
									$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
									
									$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."imagegallery WHERE album='".$a_value."' AND image='".$des_file."'");
									$sqlObj = $sqlAL->fetchObject($sqlQR);
									
									$old_des = $sqlObj->text;
									$old_uid = $sqlObj->uid;
									
									if($old_des == NULL){ $old_des = ''; }
								}
								
								if($old_des == '' || empty($old_des)){ $old_des == ''; }
								
								// CHARSETS
								$old_des = $tcms_main->decodeText($old_des, '2', $c_charset);
								
								
								if(!isset($list_option)) $list_option = 0;
								
								switch($list_option){
									case 0:
										echo '<tr><td width="110" valign="top">'
										.'<a href="'.$imagePath.'media.php?album='.$a_value.'&amp;key='.$dvalue.'" target="_blank">'
										.'<img style="border: 1px solid #333333;" src="'.$imagePath.$tcms_administer_site.'/thumbnails/'.$a_value.'/thumb_'.$dvalue.'" border="0" />'
										.'</a>';
										
										$size = filesize($tcms_administer_site.'/images/albums/'.$a_value.'/'.$dvalue) / 1024;
										$kpos = strpos($size, '.');
										$img_size = substr($size, 0, $kpos+3);
										
										echo '</td><td valign="top">';
										
										echo '<div class="text_normal gallery_text">'.$old_des.'</div>';
										
										if(trim($old_des) != '') {
											echo '<hr class="hr_line" />';
										}
										
										if($use_image_comments == 1){
											if($choosenDB == 'xml'){
												if(!is_dir($tcms_administer_site.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/')){
													mkdir($tcms_administer_site.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/', 0777);
												}
												$ic_amount = $tcms_main->readdir_count($tcms_administer_site.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/');
											}
											else{
												$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
												$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
												
												$sqlQR = $sqlAL->getOne($tcms_db_prefix.'comments', $old_uid);
												
												$ic_amount = $sqlAL->getNumber($sqlQR);
											}
											
											echo '<a class="text_normal" target="_blank" href="'.$imagePath.'media.php?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$a_value.'&amp;key='.$dvalue.'#comments">'.$ic_amount.' '.( $ic_amount == 1 ? _FRONT_COMMENT : _FRONT_COMMENTS ).'</a><br />';
										}
										
										echo '<span class="text_normal">'
										._GALLERY_POSTED.' <em>'
										.lang_date(substr($arr_tc['tc'][$dkey], 6, 2), substr($arr_tc['tc'][$dkey], 4, 2), substr($arr_tc['tc'][$dkey], 0, 4), substr($arr_tc['tc'][$dkey], 8, 2), substr($arr_tc['tc'][$dkey], 10, 2), substr($arr_tc['tc'][$dkey], 12, 2))
										.'</em>'
										.'</span>';
										
										if($image_details == 1){
											echo '<span class="text_normal">'
											.'<br />'._GALLERY_IMGTITLE.': <em>'.$dvalue.'</em><br />
											'._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />
											'._GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>'
											.'</span>';
										}
										
										echo '</td></tr>';
										
										echo '<tr style="height: 15px;"><td colspan="2"></td></tr>';
										break;
									
									case 1:
										if($currentColumn % $imagesPerRow == 0)
											echo '<tr>';
										
										// show thumbnail
										echo '<td width="100">'
										.'<a href="'.$imagePath.'media.php?album='.$a_value.'&amp;key='.$dvalue.'" target="_blank">'
										.'<img style="border: 1px solid #333333;" src="'.$imagePath.$tcms_administer_site.'/thumbnails/'.$a_value.'/thumb_'.$dvalue.'" border="0" />'
										.'</a>';
										
										$size = filesize($tcms_administer_site.'/images/albums/'.$a_value.'/'.$dvalue) / 1024;
										$kpos = strpos($size, '.');
										$img_size = substr($size, 0, $kpos+3);
										
										echo '</td>';
										
										if($currentColumn % $imagesPerRow == $imagesPerRow-1){
											echo '</td>'
											.'<tr style="height: 15px;"><td colspan="'.$imagesPerRow.'"></td></tr>';
										}
										
										$currentColumn++;
										break;
								}
							}
						}
					}
					
					if($list_option == 1){
						if($currentColumn % $imagesPerRow != 0) {
							$columsLeft = $imagesPerRow - ($currentColumn % $imagesPerRow);
							
							for(;$columsLeft > 0; $columsLeft--) echo '<td>&nbsp;</td>';
							
							echo '</tr>';
						}
					}
				}
				
				echo $tcms_html->tableEnd();
			}
		}
	}
	else {
		echo '<strong>'._MSG_NO_ALBUM_WITH_THIS_ID.'</strong>';
	}
}


?> 
