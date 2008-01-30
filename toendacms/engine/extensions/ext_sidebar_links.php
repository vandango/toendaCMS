<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Links for the Sidebar
|
| File:	ext_sidebar_links.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Links for the Sidebar
 *
 * This module provides a linklist for the sidebar.
 *
 * @version 0.2.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_side_links == 1) {
	$lDC = new tcms_dc_links();
	$lDC = $tcms_dcp->getLinksDC($language);
	
	
	if($lDC->getUseSideTitle()) {
		echo $tcms_html->subTitle($lDC->getSideTitle())
		.'<div style="height: 5px;"></div>';
	}
	
	
	if($choosenDB == 'xml') {
		$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
		$count = 0;
		
		if($tcms_main->isArray($arr_filename)) {
			foreach($arr_filename as $key => $value) {
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$value,'r');
				$is_published = $menu_xml->readSection('link', 'published');
				$is_category  = $menu_xml->readSection('link', 'type');
				$is_sidebar   = $menu_xml->readSection('link', 'module');
				
				if($is_sidebar == false || !isset($is_sidebar) || $is_sidebar == '' || empty($is_sidebar)) {
					$is_sidebar = 3;
				}
				
				if($is_published == 1 && $is_category == 'c' && ($is_sidebar == 1 || $is_sidebar == 3)) {
					$arrLink['tag'][$count]  = substr($value, 0, 32);
					$arrLink['name'][$count] = $menu_xml->readSection('link', 'name');
					$arrLink['sort'][$count] = $menu_xml->readSection('link', 'sort');
					
					if(!$arrLink['name'][$count]) { $arrLink['name'][$count] = ''; }
					
					// CHARSETS
					$arrLink['name'][$count] = $tcms_main->decodeText($arrLink['name'][$count], '2', $c_charset);
					
					$count++;
				}
			}
			
			
			if($arrLink && is_array($arrLink)) {
				array_multisort(
					$arrLink['sort'], SORT_ASC, 
					$arrLink['name'], SORT_ASC, 
					$arrLink['tag'], SORT_ASC
				);
				
				
				foreach($arrLink['name'] as $lKey => $lVal) {
					echo '<span class="text_normal" style="padding-left: 3px;">'
					.'<strong>'.$lVal.'</strong>'
					.'</span>'
					.'<br />';
					
					unset($arrLinkItem);
					unset($arr_filename);
					
					$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
					$count = 0;
					
					if($tcms_main->isArray($arr_filename)) {
						foreach($arr_filename as $key => $value) {
							$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$value,'r');
							$is_published = $menu_xml->readSection('link', 'published');
							$is_type      = $menu_xml->readSection('link', 'type');
							$is_category  = $menu_xml->readSection('link', 'category');
							$is_sidebar   = $menu_xml->readSection('link', 'module');
							
							if($is_sidebar == false || !isset($is_sidebar) || $is_sidebar == '' || empty($is_sidebar)) {
								$is_sidebar = 3;
							}
							
							if($is_published == 1 && $is_type == 'l' && $is_category == $arrLink['tag'][$lKey] && ($is_sidebar == 1 || $is_sidebar == 3)) {
								$arrLinkItem['name'][$count] = $menu_xml->readSection('link', 'name');
								$arrLinkItem['sort'][$count] = $menu_xml->readSection('link', 'sort');
								$arrLinkItem['desc'][$count] = $menu_xml->readSection('link', 'desc');
								$arrLinkItem['link'][$count] = $menu_xml->readSection('link', 'link_to');
								$arrLinkItem['trgt'][$count] = $menu_xml->readSection('link', 'target');
								
								if(!$arrLinkItem['name'][$count]) { $arrLinkItem['name'][$count] = ''; }
								if(!$arrLinkItem['desc'][$count]) { $arrLinkItem['desc'][$count] = ''; }
								if(!$arrLinkItem['link'][$count]) { $arrLinkItem['link'][$count] = ''; }
								if(!$arrLinkItem['trgt'][$count]) { $arrLinkItem['trgt'][$count] = ''; }
								
								// CHARSETS
								$arrLinkItem['name'][$count] = $tcms_main->decodeText($arrLinkItem['name'][$count], '2', $c_charset);
								$arrLinkItem['desc'][$count] = $tcms_main->decodeText($arrLinkItem['desc'][$count], '2', $c_charset);
								
								$count++;
							}
						}
						
						
						if($arrLinkItem && is_array($arrLinkItem)) {
							array_multisort(
								$arrLinkItem['sort'], SORT_ASC, 
								$arrLinkItem['name'], SORT_ASC, 
								$arrLinkItem['desc'], SORT_ASC, 
								$arrLinkItem['link'], SORT_ASC, 
								$arrLinkItem['trgt'], SORT_ASC
							);
							
							
							foreach($arrLinkItem['name'] as $lKey2 => $lVal2) {
								echo '<span class="newsCategories">';
								
								echo '<span style="padding-left: 6px;">&raquo; ';
								echo '<a'.( $arrLinkItem['trgt'][$lKey2] != '' ? ' target="'.$arrLinkItem['trgt'][$lKey2].'"' : '' ).' href="'.$arrLinkItem['link'][$lKey2].'">'.$arrLinkItem['name'][$lKey2].'</a>';
								
								if($lDC->getUseSideDescription()) {
									if(trim($arrLinkItem['desc'][$lKey2]) != '') {
										echo '<br />';
										echo '<span class="text_small" style="padding-left: 3px;">';
										echo trim($arrLinkItem['desc'][$lKey2]);
										echo '</span>';
									}
								}
								
								echo '</span><br />';
								
								echo '</span>';
							}
						}
					}
				}
			}
		}
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll(
			$tcms_db_prefix."links "
			."WHERE type='c' "
			."AND published=1 "
			."AND (module=3 OR module=1 OR module IS NULL) "
			."ORDER BY sort"
		);
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$arrLink['name'] = $sqlObj->name;
			$arrLink['tag']  = $sqlObj->uid;
			
			if($arrLink['name'] == NULL) { $arrLink['name'] = ''; }
			if($arrLink['tag']  == NULL) { $arrLink['tag']  = ''; }
			
			// CHARSETS
			$arrLink['name'] = $tcms_main->decodeText($arrLink['name'], '2', $c_charset);
			
			echo '<span class="text_normal" style="padding-left: 3px;"><strong>'.$arrLink['name'].'</strong></span><br />';
			
			$sqlQR2 = $sqlAL->getAll(
				$tcms_db_prefix."links "
				."WHERE category='".$arrLink['tag']."' "
				."AND type='l' "
				."AND published=1 "
				."AND (module=3 OR module=1 OR module IS NULL) "
				."ORDER BY sort"
			);
			
			while($sqlObj2 = $sqlAL->fetchObject($sqlQR2)) {
				$arrLinkItem['name'] = $sqlObj2->name;
				$arrLinkItem['desc'] = $sqlObj2->desc;
				$arrLinkItem['link'] = $sqlObj2->link;
				$arrLinkItem['targ'] = $sqlObj2->target;
				
				if($arrLinkItem['name'] == NULL) { $arrLinkItem['name'] = ''; }
				if($arrLinkItem['desc'] == NULL) { $arrLinkItem['desc'] = ''; }
				if($arrLinkItem['link'] == NULL) { $arrLinkItem['link'] = ''; }
				if($arrLinkItem['targ'] == NULL) { $arrLinkItem['targ'] = ''; }
				
				// CHARSETS
				$arrLinkItem['name'] = $tcms_main->decodeText($arrLinkItem['name'], '2', $c_charset);
				$arrLinkItem['desc'] = $tcms_main->decodeText($arrLinkItem['desc'], '2', $c_charset);
				
				echo '<span class="newsCategories">';
				
				echo '<span style="padding-left: 6px;">&raquo; ';
				echo '<a href="'.$arrLinkItem['link'].'"'.( $arrLinkItem['targ'] == '' ? '' : ' target="'.$arrLinkItem['targ'] ).'">'.$arrLinkItem['name'].'</a>';
				
				if($lDC->getUseSideDescription()) {
					if(trim($arrLinkItem['desc']) != '') {
						echo '<br />';
						echo '<span class="text_small" style="padding-left: 3px;">';
						echo trim($arrLinkItem['desc']);
						echo '</span>';
					}
				}
				
				echo '</span><br />';
				
				echo '</span>';
			}
			
			echo '<br />';
			
			$sqlAL->freeResult($sqlQR2);
		}
		
		$sqlAL->freeResult($sqlQR);
		unset($sqlAL);
	}
	
	
	echo '<br />';
	
	
	// cleanup
	unset($lDC);
}


?>
