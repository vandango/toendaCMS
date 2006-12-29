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
| File:		ext_gallery_sidebar.php
| Version:	0.1.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if($use_side_gallery == 1){
	if($choosenDB == 'xml'){
		$lastXML         = new xmlparser($tcms_administer_site.'/tcms_global/imagegallery.xml', 'r');
		$maxImg          = $lastXML->read_section('config', 'max_image');
		$needleImg       = $lastXML->read_section('config', 'needle_image');
		$showTitleImg    = $lastXML->read_section('config', 'show_lastimg_title');
		$alignImg        = $lastXML->read_section('config', 'align_image');
		$imgGalleryTitle = $lastXML->read_section('config', 'image_title');
		$sizeImg         = $lastXML->read_section('config', 'size_image');
		$lastXML->flush();
		$lastXML->_xmlparser();
		
		if($maxImg          == ''){ $maxImg          = 5; }
		if($needleImg       == ''){ $needleImg       = ''; }
		if($showImg         == ''){ $showImg         = 1; }
		if($showTitleImg    == ''){ $showTitleImg    = 1; }
		if($alignImg        == ''){ $alignImg        = 'center'; }
		if($imgGalleryTitle == ''){ $imgGalleryTitle = ''; }
		if($sizeImg         == ''){ $sizeImg         = '100'; }
		
		$needleImg       = $tcms_main->decodeText($needleImg, '2', $c_charset);
		$imgGalleryTitle = $tcms_main->decodeText($imgGalleryTitle, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'imagegallery_config', 'imagegallery');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$maxImg          = $sqlARR['max_image'];
		$needleImg       = $sqlARR['needle_image'];
		$showTitleImg    = $sqlARR['show_lastimg_title'];
		$alignImg        = $sqlARR['align_image'];
		$imgGalleryTitle = $sqlARR['image_title'];
		$sizeImg         = $sqlARR['size_image'];
		
		if($maxImg          == NULL){ $maxImg          = 5; }
		if($needleImg       == NULL){ $needleImg       = ''; }
		if($showImg         == NULL){ $showImg         = 1; }
		if($showTitleImg    == NULL){ $showTitleImg    = 1; }
		if($alignImg        == NULL){ $alignImg        = 'center'; }
		if($imgGalleryTitle == NULL){ $imgGalleryTitle = ''; }
		if($sizeImg         == NULL){ $sizeImg         = 100; }
		
		$needleImg       = $tcms_main->decodeText($needleImg, '2', $c_charset);
		$imgGalleryTitle = $tcms_main->decodeText($imgGalleryTitle, '2', $c_charset);
	}
	
	
	
	
	/*
		load last 5 images
	*/
	
	if($choosenDB == 'xml'){
		$arr_albums = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_albums/');
		
		$countImg = 0;
		
		if(isset($arr_albums) && !empty($arr_albums) && $arr_albums != ''){
			foreach($arr_albums as $key => $value){
				$dir = substr($value, 6, 6);
				
				$aXML = new xmlparser($tcms_administer_site.'/tcms_albums/'.$value, 'r');
				$use = $aXML->read_section('album', 'use');
				
				if($use == 1){
					$arr_files = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_imagegallery/'.$dir.'/');
					
					foreach($arr_files as $ikey => $ival){
						$imgXML = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$dir.'/'.$ival, 'r');
						
						$arr_images['image'][$countImg] = substr($ival, 0, $tcms_main->tcms_strrpos($ival, '.xml'));
						$arr_images['stamp'][$countImg] = $imgXML->read_section('image', 'timecode');
						$arr_images['album'][$countImg] = $dir;
						
						$countImg++;
					}
				}
			}
		}
		
		if(isset($arr_images) && !empty($arr_images) && $arr_images != ''){
			array_multisort(
				$arr_images['stamp'], SORT_DESC, 
				$arr_images['image'], SORT_DESC, 
				$arr_images['album'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_images['image'][$count] = $sqlARR['image'];
			$arr_images['stamp'][$count] = $sqlARR['date'];
			$arr_images['album'][$count] = $sqlARR['album'];
			
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
		if(trim($needleImg) != ''){ echo tcms_html::subtitle($needleImg); }
	}
	
	echo '<div style="margin: 4px 0 0 0; display: block;" align="'.$alignImg.'">';
	
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;s='.$s;
	$link = $tcms_main->urlAmpReplace($link);
	
	echo '<a href="'.$link.'">'.$imgGalleryTitle.'</a><br />';
	
	if(isset($arr_images) && !empty($arr_images) && $arr_images != ''){
		foreach($arr_images['stamp'] as $key => $val){
			if($key < $maxImg){
				if(!is_dir($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/')){
					mkdir($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/', 0777);
				}
				
				if(!file_exists($tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/thumb_'.$arr_images['image'][$key])){
					tcms_gd::gd_thumbnail($tcms_administer_site.'/images/albums/'.$arr_images['album'][$key].'/', $tcms_administer_site.'/thumbnails/'.$arr_images['album'][$key].'/', $arr_images['image'][$key], $sizeImg, 'create');
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
