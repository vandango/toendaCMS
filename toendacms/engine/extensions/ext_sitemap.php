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
 * @version 0.0.2
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
 */
function displayItems($parentID1, $parentID2, $parentID3, $parentPosID) {
	global $tcms_dcp;
	global $tcms_config;
	global $tcms_main;
	global $globLevel;
	global $getLang;
	global $is_admin;
	global $session;
	
	$globLevel++;
	
	$arrMap2 = $tcms_dcp->getSitemap(
		$is_admin, 
		$getLang, 
		$parentID1, 
		$parentID2, 
		$parentID3, 
		$parentPosID, 
		$tcms_config->getSidemenuEnabled(), 
		$tcms_config->getTopmenuEnabled()
	);
	
	$return = '';
	
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
			
			$wsHtml = displayItems(
				( $globLevel == 1 ? $value['uid'] : '' ), 
				( $globLevel == 2 ? $value['uid'] : '' ), 
				( $globLevel == 3 ? $value['uid'] : '' ), 
				( $globLevel == 0 ? $value['id'] : '' )
			);
			
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

$globLevel = 0;

$getLang = $tcms_config->getLanguageCodeForTCMS($lang);

$arrMap = $tcms_dcp->getSitemap(
	$is_admin, 
	$getLang, 
	'', 
	'', 
	'', 
	'', 
	$tcms_config->getSidemenuEnabled(), 
	$tcms_config->getTopmenuEnabled()
);




// display

echo $tcms_html->contentModuleHeader(
	_TCMS_MENU_SITEMAP.' - BETA!', 
	'', 
	''
);

echo '<ul>';

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
		$liContent = '[Unver&ouml;ffentlicht]';
	}
	
	$wsHtml = displayItems(
		$value['uid'], 
		'', 
		'', 
		$value['id']
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

?>
