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
| File:	ext_gallery_sidebar.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar Imagegallery
 *
 * This module provides the sidebar imagegallery.
 *
 * @version 0.2.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_side_gallery == 1) {
	/*
		load last 5 images
	*/
	
	if($choosenDB == 'xml'){
		$arr_albums = $tcms_main->getPathContent($tcms_administer_site.'/tcms_albums/');
		
		$countImg = 0;
		
		if($tcms_main->isArray($arr_albums)){
			foreach($arr_albums as $key => $value){
				$dir = substr($value, 6, 6);
				
				$aXML = new xmlparser($tcms_administer_site.'/tcms_albums/'.$value, 'r');
				$use = $aXML->readSection('album', 'use');
				
				if($use == 1){
					$arr_files = $tcms_main->getPathContent($tcms_administer_site.'/tcms_imagegallery/'.$dir.'/');
					
					foreach($arr_files as $ikey => $ival){
						$imgXML = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$dir.'/'.$ival, 'r');
						
						$arr_images['image'][$countImg] = substr($ival, 0, $tcms_main->tcms_strrpos($ival, '.xml'));
						$arr_images['stamp'][$countImg] = $imgXML->readSection('image', 'timecode');
						$arr_images['album'][$countImg] = $dir;
						
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
		
		$strSQL = "SELECT ".$dbLimitMS." * "
		."FROM ".$tcms_db_prefix."imagegallery "
		."WHERE NOT (uid IS NULL) "
		."ORDER BY date DESC ".$dbLimit;
		
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
	
	if($showTitleImg == 1){
		if(trim($needleImg) != ''){ echo $tcms_html->subTitle($needleImg); }
	}
	
	echo '<div style="margin: 4px 0 0 0; display: block;" align="'.$alignImg.'">';
	
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;s='.$s
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '<a href="'.$link.'">'.$imgGalleryTitle.'</a><br />';
	
	if(isset($arr_images) && !empty($arr_images) && $arr_images != ''){
		foreach($arr_images['stamp'] as $key => $val){
			if($key < $maxImg){
				if(!is_dir($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/')){
					mkdir($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/', 0777);
				}
				
				if(!file_exists($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key])){
					$tcms_gd->createThumbnail(
						$tcms_administer_site.'/images/albums/'.$arr_images['album'][$key].'/', 
						$tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/', 
						$arr_images['image'][$key], 
						$sizeImg
					);
				}
				else {
					$img_size = getimagesize($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/');
					$img_o_width  = $img_size[0];
					$img_o_height = $img_size[1];
					
					if($img_o_width != $sizeImg) {
						unlink($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/');
						
						$tcms_gd->createThumbnail(
							$tcms_administer_site.'/images/albums/'.$arr_images['album'][$key].'/', 
							$tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/', 
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
}

?> 
