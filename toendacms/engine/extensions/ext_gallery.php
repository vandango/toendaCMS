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
 * @version 1.0.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['albums'])) { $albums = $_GET['albums']; }


$dcIG = new tcms_dc_imagegallery();
$dcIG = $tcms_dcp->getImagegalleryDC();



/*
	Load Albums
*/

if($choosenDB == 'xml') {
	$arr_albums['count'] = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_albums/');
	
	$ca = 0;
	if($tcms_main->isReal($arr_albums['count'])) {
		foreach($arr_albums['count'] as $key => $value) {
			$albums_xml = new xmlparser(_TCMS_PATH.'/tcms_albums/'.$arr_albums['count'][$ca], 'r');
			$use = $albums_xml->readSection('album', 'use');
			
			if($use == 1) {
				$arr_albums['title'][$ca]       = $albums_xml->readSection('album', 'title');
				$arr_albums['path'][$ca]        = $albums_xml->readSection('album', 'path');
				$arr_albums['description'][$ca] = $albums_xml->readSection('album', 'description');
				$arr_albums['image'][$ca]       = $albums_xml->readSection('album', 'image');
				
				// CHARSETS
				$arr_albums['title'][$ca]       = $tcms_main->decodeText($arr_albums['title'][$ca], '2', $c_charset);
				$arr_albums['description'][$ca] = $tcms_main->decodeText($arr_albums['description'][$ca], '2', $c_charset);
				
				if(!$arr_albums['image'][$ca]) { $arr_albums['image'][$ca] = ''; }
				
				$ca++;
			}
		}
	}
	
	if(is_array($arr_albums['path']) && !empty($arr_albums['path'])) {
		array_multisort(
			$arr_albums['title'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['path'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['description'], SORT_ASC, SORT_REGULAR, 
			$arr_albums['image'], SORT_ASC, SORT_REGULAR
		);
	}
}
else {
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlSTR = "SELECT * "
	."FROM ".$tcms_db_prefix."albums "
	."WHERE published = 1 "
	."ORDER BY title ASC";
	
	$sqlQR = $sqlAL->query($sqlSTR);
	
	$count = 0;
	
	while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
		$arr_albums['count'][$count]       = $sqlObj->uid;
		$arr_albums['title'][$count]       = $sqlObj->title;
		$arr_albums['path'][$count]        = $sqlObj->album_id;
		$arr_albums['description'][$count] = $sqlObj->desc;
		$arr_albums['image'][$count]       = $sqlObj->image;
		
		if($arr_albums['title'][$count]       == NULL) { $arr_albums['title'][$count]       = ''; }
		if($arr_albums['path'][$count]        == NULL) { $arr_albums['path'][$count]        = ''; }
		if($arr_albums['description'][$count] == NULL) { $arr_albums['description'][$count] = ''; }
		if($arr_albums['image'][$count]       == NULL) { $arr_albums['image'][$count]       = ''; }
		
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

if(!isset($albums)) { $albums = 'start'; }

if($albums == 'start') {
	echo $tcms_html->contentModuleHeader(
		$dcIG->getTitle(), 
		$dcIG->getSubtitle(), 
		''
	);
	
	
	// table head
	echo $tcms_html->tableHead();
	
	
	/*
		toendaTemplate Engine
	*/
	
	$tcms_script = new toendaScript();
	$tcms_template = new toendaTemplate();
	
	
	if($tcms_template->checkTemplateExist(_LAYOUT_TEMPLATE_IMAGEGALLERY)) {
		$tcms_template->loadTemplate(_LAYOUT_TEMPLATE_IMAGEGALLERY);
		$tcms_template->parseImagegalleryTemplate();
		
		$entry = $tcms_template->getImagegalleryAlbumHeader(
			_GALLERY_TITLE, 
			_GALLERY_DESCRIPTION
		);
		
		$tcms_script->doParsePHP($entry);
	}
	else {
		// table rows
		echo '<tr>'
		.'<th class="titleBG" align="left" width="20%"><strong>'._GALLERY_TITLE.'</strong></th>'
		.'<th class="titleBG" align="left" width="70%" style="padding-left: 5px;"><strong>'._GALLERY_DESCRIPTION.'</strong></th>'
		.'</tr>'
		.'<tr><td valign="top" colspan="2" style="height: 7px;"></td></tr>';
	}
	
	
	
	if($tcms_main->isArray($arr_albums['path'])) {
		foreach($arr_albums['path'] as $key => $value) {
			// link
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id='.$id.'&amp;s='.$s.'&amp;albums='.$arr_albums['path'][$key]
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			// image
			if($arr_albums['image'][$key] != '') {
				if(!is_dir(_TCMS_PATH.'/thumbnails/'.$value.'/')) {
					mkdir(_TCMS_PATH.'/thumbnails/'.$value.'/', 0777);
				}
				
				if(!file_exists(_TCMS_PATH.'/thumbnails/'.$value.'/thumb_'.$arr_albums['image'][$key])) {
					$tcms_gd->createThumbnail(
						_TCMS_PATH.'/images/albums/'.$value.'/', 
						_TCMS_PATH.'/thumbnails/'.$value.'/', 
						$arr_albums['image'][$key], 
						'100'
					);
				}
				
				$entryImage = $imagePath._TCMS_PATH.'/thumbnails/'.$value.'/thumb_'.$arr_albums['image'][$key];
			}
			else {
				$entryImage = $imagePath.'engine/images/no_picture.gif';
			}
			
			
			
			/*
				toendaTemplate Engine
			*/
			
			if($tcms_template->checkTemplateExist(_LAYOUT_TEMPLATE_IMAGEGALLERY, 2)) {
				$entry = $tcms_template->getImagegalleryAlbumEntry(
					$link, 
					$arr_albums['title'][$key], 
					$entryImage, 
					$arr_albums['description'][$key],
					$imagePath.'engine/images/blank.gif'
				);
				
				$tcms_script->doParsePHP($entry);
			}
			else {
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
				.'<a href="'.$link.'">'
				.'<img style="border: 1px solid #333333;" '
				.'src="'.$entryImage.'" '
				.'border="0" align="left" />'
				.'</a></td>';
				
				echo '<td width="70%" valign="top" style="padding-left: 5px;">'
				.$arr_albums['description'][$key]
				.'</td></tr>';
				
				echo '<tr>'
				.'<td valign="top" colspan="2">'
				.'<div class="headLinePadding">'
				.'<img src="'.$imagePath.'engine/images/blank.gif" border="0" height="1" />'
				.'</div>'
				.'</td>'
				.'</tr>';
			}
		}
	}
	
	
	echo $tcms_html->tableEnd();
	
	
	// cleanup
	unset($tcms_template);
	unset($tcms_script);
}





/*
	Pictures
*/

if($albums != 'start') {
	if($tcms_main->isReal($arr_albums['path'])) {
		foreach($arr_albums['path'] as $a_key => $a_value) {
			if($albums == $a_value) {
				if($choosenDB == 'xml') {
					$album_xml   = new xmlparser(_TCMS_PATH.'/tcms_albums/album_'.$a_value.'.xml', 'r');
					$album_title = $album_xml->readSection('album', 'title');
					$album_path  = $album_xml->readSection('album', 'path');
					$album_use   = $album_xml->readSection('album', 'use');
					$album_desc  = $album_xml->readSection('album', 'description');
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->getAll($tcms_db_prefix."albums WHERE album_id='".$a_value."'");
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$album_title = $sqlObj->title;
					$album_path  = $sqlObj->album_id;
					$album_use   = $sqlObj->published;
					$album_desc  = $sqlObj->desc;
					
					if($album_title == NULL) { $album_title = ''; }
					if($album_path  == NULL) { $album_path  = ''; }
					if($album_use   == NULL) { $album_use   = ''; }
					if($album_desc  == NULL) { $album_desc  = ''; }
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				// CHARSETS
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
				$album_desc  = $tcms_main->decodeText($album_desc, '2', $c_charset);
				
				
				// link
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=imagegallery&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				
				// title
				//$album_title = _GALLERY_THISIS.' '.$album_title.' '._GALLERY_THISIS2.'</div>'
				//.'<div>(<a href="'.$link.'">'.$dcIG->getTitle().'</a>)<br /><br />';
				$album_title = _GALLERY_THISIS2.' '.$album_title.'</div>'
				.'<div>(<a href="'.$link.'">'.$dcIG->getTitle().'</a>)<br /><br />';
				
				
				$arr_dir = $tcms_file->getPathContent(_TCMS_PATH.'/images/albums/'.$a_value.'/');
				
				
				if($tcms_main->isArray($arr_dir)) {
					if($choosenDB == 'xml') {
						$timecc = 0;
						foreach($arr_dir as $ikey => $val) {
							$des_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$a_value.'/'.$val.'.xml','r');
							$arr_tc['tc'][$timecc] = $des_xml->readSection('image', 'timecode');
							$arr_tc['fn'][$timecc] = $val;
							$timecc++;
						}
					}
					else {
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->getAll($tcms_db_prefix."imagegallery WHERE album='".$a_value."'");
						
						$timecc = 0;
						
						while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
							$arr_tc['tc'][$timecc]  = $sqlObj->date;
							$arr_tc['fn'][$timecc]  = $sqlObj->image;
							
							if($arr_tc['tc'][$timecc] == NULL) { $arr_tc['tc'][$timecc] = ''; }
							if($arr_tc['fn'][$timecc] == NULL) { $arr_tc['fn'][$timecc] = ''; }
							
							$timecc++;
						}
					}
					
					if($tcms_main->isArray($arr_tc['fn'])) {
						switch($dcIG->getImageSort()) {
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
					
					
					$imagesPerRow = ( $tcms_main->isReal($dcIG->getListOptionAmount()) ? $dcIG->getListOptionAmount() : 4 );
					$currentColumn = 0;
					
					
					// title
					echo $tcms_html->contentModuleHeader(
						$album_title, 
						$album_desc, 
						''
					);
					
					echo $tcms_html->tableHeadClass('0', '2', '0', '100%', 'noborder news_content_bg');
					
					/*
						toendaTemplate Engine
					*/
					
					$tcms_script = new toendaScript();
					$tcms_template = new toendaTemplate();
					
					if($tcms_template->checkTemplateExist(_LAYOUT_TEMPLATE_IMAGEGALLERY)) {
						$tcms_template->loadTemplate(_LAYOUT_TEMPLATE_IMAGEGALLERY);
						$tcms_template->parseImagegalleryTemplate();
					}
					
					if($tcms_main->isArray($arr_tc['fn'])) {
						foreach($arr_tc['fn'] as $dkey => $dvalue) {
							if(trim($dvalue) != '') {
								if(!is_dir(_TCMS_PATH.'/thumbnails/'.$a_value.'/')) {
									mkdir(_TCMS_PATH.'/thumbnails/'.$a_value.'/', 0777);
								}
								
								if(!file_exists(_TCMS_PATH.'/thumbnails/'.$a_value.'/thumb_'.$dvalue)) {
									$tcms_gd->createThumbnail(
										_TCMS_PATH.'/images/albums/'.$a_value.'/',
										_TCMS_PATH.'/thumbnails/'.$a_value.'/', $dvalue, 
										$arr_albums['image'][$key], 
										'100'
									);
								}
								
								$img_size = getimagesize(_TCMS_PATH.'/images/albums/'.$a_value.'/'.$dvalue);
								$img_o_width  = $img_size[0];
								$img_o_height = $img_size[1];
								
								
								$des_file = $dvalue;
								
								if($choosenDB == 'xml') {
									$des_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$a_value.'/'.$des_file.'.xml','r');
									$old_des = $des_xml->readSection('image', 'text');
								}
								else {
									$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
									$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
									
									$sqlQR = $sqlAL->query(
										"SELECT *"
										." FROM ".$tcms_db_prefix."imagegallery"
										." WHERE album='".$a_value."'"
										." AND image='".$des_file."'"
									);
									$sqlObj = $sqlAL->fetchObject($sqlQR);
									
									$old_des = $sqlObj->text;
									$old_uid = $sqlObj->uid;
									
									if($old_des == NULL) { $old_des = ''; }
								}
								
								if($old_des == '' || empty($old_des)) { $old_des == ''; }
								
								// CHARSETS
								$old_des = $tcms_main->decodeText($old_des, '2', $c_charset);
								
								
								if(!$tcms_main->isReal($dcIG->getListOption())) {
									$dcIG->setListOption(0);
								}
								
								
								// image link
								$entryImageLink = $imagePath.'media.php?album='.$a_value.'&amp;key='.$dvalue;
								
								// image thumb
								$entryImageThumb = $imagePath._TCMS_PATH.'/thumbnails/'.$a_value.'/thumb_'.$dvalue;
								$entryImage = $imagePath._TCMS_PATH.'/images/albums/'.$a_value.'/'.$dvalue;
								
								// image comments link
								if($dcIG->getUseComments()) {
									if($choosenDB == 'xml') {
										if(!is_dir(_TCMS_PATH.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/')) {
											mkdir(_TCMS_PATH.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/', 0777);
										}
										
										$ic_amount = $tcms_file->getPathContentAmount(
											_TCMS_PATH.'/tcms_imagegallery/'.$a_value.'/comments_'.$dvalue.'/'
										);
									}
									else {
										$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
										$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
										
										$sqlQR = $sqlAL->getOne($tcms_db_prefix.'comments', $old_uid);
										
										$ic_amount = $sqlAL->getNumber($sqlQR);
									}
									
									$entryCommentsLink = '<a class="text_normal" target="_blank" href="'.$imagePath.'media.php?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$a_value.'&amp;key='.$dvalue.'#comments">'
									.$ic_amount.' '.( $ic_amount == 1 ? _FRONT_COMMENT : _FRONT_COMMENTS )
									.'</a>'
									.'<br />';
								}
								
								// image date
								$entryUploadDate = lang_date(
									substr($arr_tc['tc'][$dkey], 6, 2), 
									substr($arr_tc['tc'][$dkey], 4, 2), 
									substr($arr_tc['tc'][$dkey], 0, 4), 
									substr($arr_tc['tc'][$dkey], 8, 2), 
									substr($arr_tc['tc'][$dkey], 10, 2), 
									substr($arr_tc['tc'][$dkey], 12, 2)
								);
								
								// ...
								
								// image details
								if($dcIG->getUseImageDetails()) {
									$size = filesize(_TCMS_PATH.'/images/albums/'.$a_value.'/'.$dvalue) / 1024;
									$kpos = strpos($size, '.');
									$img_size = substr($size, 0, $kpos + 3);
									
									$entryImageDetails = '<span class="text_normal">'
									.'<br />'._GALLERY_IMGTITLE.': <em>'.$dvalue.'</em><br />
									'._GALLERY_IMGSIZE.': <em>'.$img_size.' KB</em><br />
									'._GALLERY_IMGRESOLUTION.': <em>'.$img_o_width.' x '.$img_o_height.'</em>'
									.'</span>';
								}
								
								// taglist
								
								// generate taglist
								$fileExt = $tcms_file->getFileExtension($dvalue);
								$tagList = $dvalue;
								
								$tagList = str_replace($fileExt, ' ', $tagList);
								$tagList = str_replace('http://', '', $tagList);
								$tagList = str_replace('/', ' ', $tagList);
								$tagList = str_replace('_', ' ', $tagList);
								$tagList = str_replace('.', ' ', $tagList);
								$tagList = trim($tagList);
								
								
								
								/*
									toendaTemplate Engine
								*/
								if($tcms_template->checkTemplateExist(_LAYOUT_TEMPLATE_IMAGEGALLERY)) {
									switch($dcIG->getListOption()) {
										case 0:
											$entry = $tcms_template->getImagegalleryAlbumListViewEntry(
												$entryImageLink, 
												$entryImageThumb, 
												$old_des, 
												$entryCommentsLink, 
												$entryUploadDate, 
												$entryImageDetails, 
												$tagList
											);
											
											$tcms_script->doParsePHP($entry);
											break;
										
										case 1:
											if($currentColumn % $imagesPerRow == 0) {
												echo '<tr>';
											}
											
											$entry = $tcms_template->getImagegalleryAlbumThumbViewEntry(
												$entryImageLink, 
												$tagList, 
												$entryImageThumb, 
												$entryImage, 
												$a_value, 
												$dvalue
											);
											
											$tcms_script->doParsePHP($entry);
											
											if($currentColumn % $imagesPerRow == $imagesPerRow-1) {
												echo '</td>'
												.'<tr style="height: 15px;"><td colspan="'.$imagesPerRow.'"></td></tr>';
											}
											
											$currentColumn++;
											break;
									}
								}
								else {
									switch($dcIG->getListOption()) {
										case 0:
											echo '<tr><td width="110" valign="top">'
											.'<a href="'.$entryImageLink.'" title="'.$tagList.'" target="_blank" rel="lightbox[lightbox]">'
											.'<img style="border: 1px solid #333333;" src="'.$entryImageThumb.'" border="0" />'
											.'</a>';
											
											echo '</td><td valign="top">';
											
											echo '<div class="text_normal gallery_text">'.$old_des.'</div>';
											
											if(trim($old_des) != '') {
												echo '<hr class="hr_line" />';
											}
											
											echo $entryCommentsLink;
											
											echo '<span class="text_normal">'
											._GALLERY_POSTED.' <em>'
											.$entryUploadDate
											.'</em>'
											.'</span>';
											
											echo $entryImageDetails;
											
											echo '</td></tr>';
											
											echo '<tr style="height: 15px;"><td colspan="2"></td></tr>';
											break;
										
										case 1:
											if($currentColumn % $imagesPerRow == 0) {
												echo '<tr>';
											}
											
											// show thumbnail
											echo '<td width="100">'
											.'<a href="'.$entryImageLink.'" title="'.$tagList.'" target="_blank">'// rel="lightbox[lightbox]">'
											.'<img style="border: 1px solid #333333;" src="'.$entryImageThumb.'" border="0" />'
											.'</a>'
											.'</td>';
											
											if($currentColumn % $imagesPerRow == $imagesPerRow-1) {
												echo '</td>'
												.'<tr style="height: 15px;"><td colspan="'.$imagesPerRow.'"></td></tr>';
											}
											
											$currentColumn++;
											break;
									}
								}
							}
						}
					}
					
					if($dcIG->getListOption() == 1) {
						if($currentColumn % $imagesPerRow != 0) {
							$columsLeft = $imagesPerRow - ($currentColumn % $imagesPerRow);
							
							for(;$columsLeft > 0; $columsLeft--) {
								echo '<td>&nbsp;</td>';
							}
							
							echo '</tr>';
						}
					}
					
					
					// table end
					echo $tcms_html->tableEnd();
					
					
					// cleanup
					unset($tcms_template);
					unset($tcms_script);
				}
			}
		}
	}
	else {
		echo '<strong>'._MSG_NO_ALBUM_WITH_THIS_ID.'</strong>';
	}
}


?> 
