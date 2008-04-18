<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Sitemap
|
| File:	ext_sitemap.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sitemap
 *
 * This module is used as a sitemap generator extension
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */



// recursive funtion

/**
 * Display recursivly the items
 *
 * @param String $parentID1
 * @param String $parentID2
 * @param String $parentID3
 * @param String $parentPosID
 * @param Integer $globLevel
 */
function displayItems($parentID1, $parentID2, $parentID3, $parentPosID, $globLevel) {
	global $tcms_dcp;
	global $tcms_config;
	global $tcms_main;
	global $getLang;
	global $lang;
	global $is_admin;
	global $session;
	global $s;
	
	$arrMap2 = $tcms_dcp->getSitemap(
		$is_admin, 
		$getLang, 
		$parentID1, 
		$parentID2, 
		$parentID3, 
		$parentPosID, 
		$tcms_config->getSidemenuEnabled(), 
		$tcms_config->getTopmenuEnabled(), 
		$globLevel
	);
	
	$return = '';
	
	//$tcms_main->paf($arrMap2);
	
	if($tcms_main->isArray($arrMap2)) {
		//$ul1 = '<ul>';
		
		foreach($arrMap2 as $key => $value) {
			$liContent = '';
			
			$target = ( $value['target'] == '' ? '' : ' target="'.$value['target'].'"' );
			
			//$li1 = '<li>';
			
			if($value['pub'] == 1) {
				switch($value['type']){
					case 'web':
						$liContent = '<a href="'.$value['link'].'"'.$target.'>'
						.$value['name']
						.'</a>';
						break;
					
					case 'title':
						$liContent = $value['name'];
						break;
					
					case 'link':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value['link'].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						$liContent = '<a href="'.$link.'"'.$target.'>'.$value['name'].'</a>';
						break;
				}
			}
			
			if($globLevel < 4) {
				$wsHtml = displayItems(
					( ( $globLevel + 1 ) == 1 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 2 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 3 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 0 ? $value['id'] : '' ), 
					$globLevel + 1
				);
			}
			
			//$li2 = '</li>';
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				$return .= '<li>';
			}
			
			if(trim($liContent) != '') {
				$return .= $liContent;
			}
			
			if(trim($wsHtml) != '') {
				$return .= $wsHtml;
			}
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				$return .= '</li>';
			}
		}
		
		//$ul2 = '</ul>';
		
		if(trim($return) != '') {
			$return = '<ul>'.$return.'</ul>';
		}
	}
	
	return $return;
}



// init

echo $tcms_html->contentModuleHeader(
	_SITEMAP_TITLE.' - BETA!', 
	_SITEMAP_SUBTITLE, 
	_SITEMAP_TEXT
);


$getLang = $tcms_config->getLanguageCodeForTCMS($lang);


/*
	TOPMENU
*/
if($tcms_config->getTopmenuEnabled()) {
	$arrMapTop = $tcms_dcp->getSitemap(
		$is_admin, 
		$getLang, 
		'', 
		'', 
		'', 
		'', 
		false, 
		$tcms_config->getTopmenuEnabled(), 
		0
	);
	
	if($tcms_main->isArray($arrMapTop)) {
		echo '<h3>'._SITEMAP_TOPMENU.'</h3>'
		.'<ul>';
		
		foreach($arrMapTop as $key => $value) {
			$liContent = '';
			
			$target = ( $value['target'] == '' ? '' : ' target="'.$value['target'].'"' );
			
			if($value['pub'] == 1) {
				switch($value['type']){
					case 'web':
						$liContent = '<a href="'.$value['link'].'"'.$target.'>'
						.$value['name']
						.'</a>';
						break;
					
					case 'title':
						$liContent = $value['name'];
						break;
					
					case 'link':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value['link'].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						$liContent = '<a href="'.$link.'"'.$target.'>'.$value['name'].'</a>';
						break;
				}
			}
			else {
				//$liContent = '[Unver&ouml;ffentlicht]';
				$liContent = '';
			}
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				echo '<li>';
			}
			
			if(trim($liContent) != '') {
				echo '<strong>'.$liContent.'</strong>';
			}
			
			if(trim($wsHtml) != '') {
				echo $wsHtml;
			}
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				echo '</li>';
			}
		}
		
		echo '</ul>'
		.'<br />';
	}
}


/*
	SIDEMENU
*/
if($tcms_config->getSidemenuEnabled()) {
	$arrMap = $tcms_dcp->getSitemap(
		$is_admin, 
		$getLang, 
		'', 
		'', 
		'', 
		'', 
		$tcms_config->getSidemenuEnabled(), 
		false, 
		0
	);
	
	if($tcms_main->isArray($arrMap)) {
		echo '<h3>'._SITEMAP_SIDEMENU.'</h3>'
		.'<ul>';
		
		foreach($arrMap as $key => $value) {
			$liContent = '';
			
			$target = ( $value['target'] == '' ? '' : ' target="'.$value['target'].'"' );
			
			if($value['pub'] == 1) {
				switch($value['type']){
					case 'web':
						$liContent = '<a href="'.$value['link'].'"'.$target.'>'
						.$value['name']
						.'</a>';
						break;
					
					case 'title':
						$liContent = $value['name'];
						break;
					
					case 'link':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value['link'].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						$liContent = '<a href="'.$link.'"'.$target.'>'.$value['name'].'</a>';
						break;
				}
			}
			else {
				//$liContent = '[Unver&ouml;ffentlicht]';
				$liContent = '';
			}
			
			$wsHtml = displayItems(
				$value['uid'], 
				'', 
				'', 
				$value['id'], 
				1
			);
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				echo '<li>';
			}
			
			if(trim($liContent) != '') {
				echo '<strong>'.$liContent.'</strong>';
			}
			
			if(trim($wsHtml) != '') {
				echo $wsHtml;
			}
			
			if(trim($liContent) != ''
			|| trim($wsHtml) != '') {
				echo '</li>';
			}
		}
		
		echo '</ul>'
		.'<br />';
	}
}

?>
