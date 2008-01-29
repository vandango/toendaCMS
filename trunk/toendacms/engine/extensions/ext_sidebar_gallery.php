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
| File:	ext_sidebar_gallery.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar Imagegallery
 *
 * This module provides the sidebar imagegallery.
 *
 * @version 0.3.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_side_gallery == 1) {
	using('toendacms.datacontainer.imagegallery');
	
	$dcIG = new tcms_dc_imagegallery();
	$dcIG = $tcms_dcp->getImagegalleryDC();
	
	$maxImg = $dcIG->getMaxImages();
	
	/*
		load last 5 images
	*/
	
	if($choosenDB == 'xml') {
		$arr_albums = $tcms_file->getPathContent(
			_TCMS_PATH.'/tcms_albums/'
		);
		
		$countImg = 0;
		
		if($tcms_main->isArray($arr_albums)) {
			foreach($arr_albums as $key => $value) {
				$dir = substr($value, 6, 6);
				
				$aXML = new xmlparser(_TCMS_PATH.'/tcms_albums/'.$value, 'r');
				$use = $aXML->readSection('album', 'use');
				
				$aXML->flush();
				unset($aXML);
				
				if($use == 1){
					$arr_files = $tcms_file->getPathContent(
						_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/'
					);
					
					foreach($arr_files as $ikey => $ival){
						$imgXML = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$dir.'/'.$ival, 'r');
						
						$arr_images['image'][$countImg] = substr($ival, 0, $tcms_main->lastIndexOf($ival, '.xml'));
						$arr_images['stamp'][$countImg] = $imgXML->readSection('image', 'timecode');
						$arr_images['album'][$countImg] = $dir;
						
						$imgXML->flush();
						unset($imgXML);
						
						$countImg++;
					}
				}
			}
		}
		
		if($tcms_main->isArray($arr_images)){
			array_multisort(
				$arr_images['stamp'], SORT_DESC, 
				$arr_images['image'], SORT_DESC, 
				$arr_images['album'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$dbLimitMS = '';
		
		switch($choosenDB){
			case 'mysql': $dbLimit = "LIMIT 0, ".$maxImg; break;
			case 'pgsql': $dbLimit = "LIMIT ".$maxImg; break;
			case 'mssql': $dbLimitMS = "TOP ".$maxImg; break;
		}
		
		$strSQL = "SELECT ".$dbLimitMS." ".$tcms_db_prefix."imagegallery.* "
		."FROM ".$tcms_db_prefix."imagegallery "
		."INNER JOIN ".$tcms_db_prefix."albums "
		."ON ".$tcms_db_prefix."imagegallery.album = ".$tcms_db_prefix."albums.album_id "
		."WHERE NOT (".$tcms_db_prefix."imagegallery.uid IS NULL) "
		."AND ".$tcms_db_prefix."albums.published = 1 "
		."ORDER BY ".$tcms_db_prefix."imagegallery.date DESC ".$dbLimit;
		
		$sqlQR = $sqlAL->query($strSQL);
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$arr_images['image'][$count] = $sqlObj->image;
			$arr_images['stamp'][$count] = $sqlObj->date;
			$arr_images['album'][$count] = $sqlObj->album;
			
			if($arr_images['image'][$count] == NULL){ $arr_images['image'][$count] = ''; }
			if($arr_images['stamp'][$count] == NULL){ $arr_images['stamp'][$count] = ''; }
			if($arr_images['album'][$count] == NULL){ $arr_images['album'][$count] = ''; }
			
			$count++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	
	
	/*
		display the last n images
		n = "variable value"
	*/
	
	if($dcIG->getShowLastImageTitle()){
		if(trim($dcIG->getNeedleImage()) != '') {
			echo $tcms_html->subTitle($dcIG->getNeedleImage());
		}
	}
	
	echo '<div style="margin: 4px 0 0 0; display: block;" align="'.$alignImg.'">';
	
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;s='.$s
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '<a href="'.$link.'">'.$dcIG->getTitle().'</a><br />';
	
	$sizeImg = $dcIG->getImageSize();
	
	if($tcms_main->isArray($arr_images)){
		foreach($arr_images['stamp'] as $key => $val){
			if($key < $dcIG->getMaxImages()){
				if(!$tcms_file->checkIsDir(_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/')){
					$tcms_file->createDir(_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/', 0777);
				}
				
				if(!$tcms_file->checkFileExist(_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key])){
					$tcms_gd->createThumbnail(
						_TCMS_PATH.'/images/albums/'.$arr_images['album'][$key].'/', 
						_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/', 
						$arr_images['image'][$key], 
						$sizeImg
					);
				}
				else {
					$img_size = getimagesize(
						_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key]
					);
					
					$img_o_width  = $img_size[0];
					$img_o_height = $img_size[1];
					
					if($img_o_width != $sizeImg) {
						$tcms_file->deleteFile(_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key]);
						
						$tcms_gd->createThumbnail(
							_TCMS_PATH.'/images/albums/'.$arr_images['album'][$key].'/', 
							_TCMS_PATH.'/thumbnails/'.$arr_images['album'][$key].'/', 
							$arr_images['image'][$key], 
							$sizeImg
						);
					}
				}
				
				echo '<span style="margin: 4px 0 0 0; display: block;">'
				.'<a target="_blank" href="'.$imagePath.'media.php?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'album='.$arr_images['album'][$key].'&amp;key='.$arr_images['image'][$key].'">'
				.'<img '.( $sizeImg < 100 ? 'width="'.$sizeImg.'"' : '' ).'style="border: 1px solid #333;" src="'.$imagePath.'data/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key].'" border="0" />'
				.'</a>'
				.'</span>';
			}
		}
	}
	
	echo '</div>';
	echo '<br /><br />';
	
	// cleanup
	unset($dcIG);
}

?> 
