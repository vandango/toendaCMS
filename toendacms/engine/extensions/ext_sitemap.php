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
 * @version 0.1.5
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
				switch($value['type']) {
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
			
			if($globLevel < 4
			&& $value['pub'] == 1) {
				$wsHtml = displayItems(
					( ( $globLevel + 1 ) == 1 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 2 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 3 ? $value['uid'] : '' ), 
					( ( $globLevel + 1 ) == 0 ? $value['id'] : '' ), 
					$globLevel + 1
				);
			}
			else {
				$wsHtml = '';
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
	_SITEMAP_TITLE, 
	_SITEMAP_SUBTITLE, 
	_SITEMAP_TEXT
);


$getLang = $tcms_config->getLanguageCodeForTCMS($lang);


/*
	TOPMENU
*/
if($tcms_config->getTopmenuEnabled()) {
	if($choosenDB == 'xml') {
		if($tcms_main->isArray($arr_top_navi['link'])) {
			foreach($arr_top_navi['link'] as $key => $value) {
				$arrMapTop[$key]['uid'] = '';
				$arrMapTop[$key]['id'] = $arr_top_navi['id'][$key];
				$arrMapTop[$key]['name'] = $arr_top_navi['name'][$key];
				$arrMapTop[$key]['link'] = $arr_top_navi['id'][$key];
				$arrMapTop[$key]['target'] = $arr_top_navi['tar'][$key];
				$arrMapTop[$key]['type'] = $arr_top_navi['type'][$key];
				$arrMapTop[$key]['pub'] = intval($arr_top_navi['pub'][$key]);
			}
		}
	}
	else {
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
	}
	
	if($tcms_main->isArray($arrMapTop)) {
		echo '<h3>'._SITEMAP_TOPMENU.'</h3>'
		.'<ul>';
		
		foreach($arrMapTop as $key => $value) {
			$liContent = '';
			
			$target = ( $value['target'] == '' ? '' : ' target="'.$value['target'].'"' );
			
			if($value['pub'] == 1) {
				switch($value['type']) {
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
	if($choosenDB == 'xml') {
		if($tcms_main->isArray($arr_side_navi['link'])) {
			//$tcms_main->paf($arr_side_navi);
			
			foreach($arr_side_navi['link'] as $key => $value) {
				$arrMap[$key]['uid'] = '';
				$arrMap[$key]['id'] = $arr_side_navi['id'][$key];
				$arrMap[$key]['name'] = $arr_side_navi['name'][$key];
				$arrMap[$key]['link'] = $arr_side_navi['url'][$key];
				$arrMap[$key]['target'] = $arr_side_navi['tar'][$key];
				$arrMap[$key]['type'] = $arr_side_navi['type'][$key];
				$arrMap[$key]['pub'] = intval($arr_side_navi['pub'][$key]);
				$arrMap[$key]['sub'] = $arr_side_navi['subid'][$key];
			}
			
			//$tcms_main->paf($arrMap);
		}
	}
	else {
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
	}
	
	if($tcms_main->isArray($arrMap)) {
		echo '<h3>'._SITEMAP_SIDEMENU.'</h3>'
		.'<ul>';
		
		$allHtml = '';
		
		$wasSub = false;
		$isSub = false;
		$subItem = 0;
		
		foreach($arrMap as $key => $value) {
			$liContent = '';
			
			$target = ( $value['target'] == '' ? '' : ' target="'.$value['target'].'"' );
			
			if($choosenDB != 'xml') {
				// sql db
				
				if($value['pub'] == 1) {
					switch($value['type']) {
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
				
				// if link is in topmennu
				if($tcms_config->getTopmenuEnabled()
				&& $tcms_main->isElementInArray($value['link'], $arrMapTop, 'link')) {
					$wsHtml = displayItems(
						$value['uid'], 
						'', 
						'', 
						$value['id'], 
						1
					);
					
					$liContent = $value['name'];
				}
				else if($value['pub'] == 1) {
					$wsHtml = displayItems(
						$value['uid'], 
						'', 
						'', 
						$value['id'], 
						1
					);
				}
				else {
					$wsHtml = '';
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
			else {
				// xml db
				
				$wsHtml = '###xml###';
				
				if($value['pub'] == 1) {
					if(trim($value['sub']) == '-') {
						// parent
						
						if($subItem != 0) {
							$wasSub = true;
							
							$subItem = 0;
							$liContent = '</ul>';
							$liContent .= '</li>';
							$liContent .= '<li>';
						}
						else {
							$liContent = '';
						}
						
						$isSub = false;
						
						switch($value['type']) {
							case 'web':
								$liContent .= '<a href="'.$value['link'].'"'.$target.'>'
								.$value['name']
								.'</a>';
								break;
							
							case 'title':
								$liContent .= $value['name'];
								break;
							
							case 'link':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id='.$value['link'].'&amp;s='.$s
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlConvertToSEO($link);
								
								$liContent .= '<a href="'.$link.'"'.$target.'>'.$value['name'].'</a>';
								break;
						}
					}
					else {
						// sub
						
						$isSub = true;
						$wasSub = false;
						
						if($subItem == 0) {
							$allHtml = trim($allHtml);
							$allHtml = substr($allHtml, 0, strlen($allHtml) - 5);
							
							//$liContent = '<li>';
							$liContent .= '<ul>';
						}
						else {
							$liContent = '';
						}
						
						$subItem++;
						
						$liContent .= '<li>';
						
						$liContent .= '<strong>';
						
						switch($value['type']) {
							case 'web':
								$liContent .= '<a href="'.$value['link'].'"'.$target.'>'
								.$value['name']
								.'</a>';
								break;
							
							case 'title':
								$liContent .= $value['name'];
								break;
							
							case 'link':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id='.$value['link'].'&amp;s='.$s
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlConvertToSEO($link);
								
								$liContent .= '<a href="'.$link.'"'.$target.'>'.$value['name'].'</a>';
								break;
						}
						
						$liContent .= '</strong>';
						
						$liContent .= '</li>';
					}
				}
				else {
					//$liContent = '[Unver&ouml;ffentlicht]';
					$liContent = '';
				}
				
				if((trim($liContent) != ''
				|| trim($wsHtml) != '')
				&& !$isSub
				&& !$wasSub) {
					$allHtml .= '<li>';
				}
				
				if(trim($liContent) != '') {
					if(!$isSub) {
						$allHtml .= '<strong>';
					}
					
					$allHtml .= $liContent;
					
					if(!$isSub) {
						$allHtml .= '</strong>';
					}
				}
				
				if(trim($wsHtml) != ''
				&& $choosenDB != 'xml') {
					$wsHtmlTemp = str_replace('###xml###', '', $wsHtml);
					
					$allHtml .= $wsHtmlTemp;
				}
				
				if((trim($liContent) != ''
				|| trim($wsHtml) != '')
				&& !$isSub) {
					$allHtml .= '</li>';
				}
				
				$wasSub = false;
			}
		}
		
		echo $allHtml;
		
		echo '</ul>'
		.'<br />';
	}
}

?>
