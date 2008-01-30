<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Links for the Content
|
| File:	ext_links.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Links for the Content
 *
 * This module is used for the links for the content.
 *
 * @version 0.2.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


$toendaScript = new toendaScript($link_text);
$link_text = $toendaScript->toendaScript_trigger();
$link_text = $toendaScript->checkSEO($link_text, $imagePath);


echo $tcms_html->contentModuleHeader(
	$link_title, 
	$link_subtitle, 
	$link_text
);




if($choosenDB == 'xml') {
	$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
	$count = 0;
	
	if($tcms_main->isArray($arr_filename)) {
		foreach($arr_filename as $key => $value) {
			$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$value,'r');
			$is_published = $menu_xml->read_section('link', 'published');
			$is_category  = $menu_xml->read_section('link', 'type');
			$is_main      = $menu_xml->read_section('link', 'module');
			
			if($is_main == false || !isset($is_main) || $is_main == '' || empty($is_main)) {
				$is_main = 3;
			}
			
			if($is_published == 1 && $is_category == 'c' && ($is_main == 2 || $is_main == 3)) {
				$arrLink['tag'][$count]  = substr($value, 0, 32);
				$arrLink['name'][$count] = $menu_xml->read_section('link', 'name');
				$arrLink['sort'][$count] = $menu_xml->read_section('link', 'sort');
				
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
				/*
					FOR COMPATIBILITY:
					OLD AND NEW TEMPLATE ENGINE
					
					First the old one:
				*/
				$tcms_template = new tcms_toendaTemplate();
				
				if($tcms_template->checkTemplateExist(_LAYOUT_LINK_ENTRY)) {
					$tcms_template->loadTemplate(_LAYOUT_LINK_ENTRY);
					
					echo $tcms_template->getLinksCategoryTitle($arrLink['name']);
				}
				else {
					echo '<div class="headLineLinksMainpage">'
					.'<br />'
					.'<span class="text_big" style="padding-left: 3px;">'
					.'<strong>'.$lVal.'</strong>'
					.'</span>'
					.'</div>'
					.'<br />';
				}
				
				unset($arrLinkItem);
				unset($arr_filename);
				
				
				$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
				$count = 0;
				
				if($tcms_main->isArray($arr_filename)) {
					foreach($arr_filename as $key => $value) {
						$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$value,'r');
						$is_published = $menu_xml->read_section('link', 'published');
						$is_type      = $menu_xml->read_section('link', 'type');
						$is_category  = $menu_xml->read_section('link', 'category');
						$is_main      = $menu_xml->read_section('link', 'module');
						
						if($is_main == false || !isset($is_main) || $is_main == '' || empty($is_main)) {
							$is_main = 3;
						}
						
						if($is_published == 1 && $is_type == 'l' && $is_category == $arrLink['tag'][$lKey] && ($is_main == 2 || $is_main == 3)) {
							$arrLinkItem['name'][$count] = $menu_xml->read_section('link', 'name');
							$arrLinkItem['sort'][$count] = $menu_xml->read_section('link', 'sort');
							$arrLinkItem['desc'][$count] = $menu_xml->read_section('link', 'desc');
							$arrLinkItem['link'][$count] = $menu_xml->read_section('link', 'link_to');
							$arrLinkItem['trgt'][$count] = $menu_xml->read_section('link', 'target');
							
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
							// target
							if(trim($arrLinkItem['trgt'][$lKey2]) == '') {
								$entryTarget = '_self';
							}
							else {
								$entryTarget = trim($arrLinkItem['trgt'][$lKey2]);
							}
							
							// link
							$entryLink = $arrLinkItem['link'][$lKey2];
							
							// text
							$entryText = $arrLinkItem['name'][$lKey2];
							
							// desc
							$entryDesc = trim($arrLinkItem['desc'][$lKey2]);
							
							
							/*
								FOR COMPATIBILITY:
								OLD AND NEW TEMPLATE ENGINE
								
								First the old one:
							*/
							if($tcms_template->checkTemplateExist(_LAYOUT_LINK_ENTRY)) {
								$layoutEntryText = $tcms_template->getLinksEntry(
									$entryTarget, 
									$entryLink, 
									$entryText, 
									$entryDesc
								);
								
								$tcms_script = new toendaScript();
								$tcms_script->doParsePHP($layoutEntryText);
							}
							else {
								echo '<span class="text_normal">';
								
								echo '<span style="padding-left: 6px;">&raquo; ';
								echo '<a target="'.$entryTarget.'" href="'.$entryLink.'">'.$entryText.'</a>';
								
								if($link_use_desc == 1) {
									if($entryDesc != '') {
										echo '<br />';
										echo '<span class="text_normal" style="padding-left: 3px;">';
										echo $entryDesc;
										echo '</span>';
									}
								}
								
								echo '</span><br />';
								
								echo '</span>';
							}
						}
					}
				}
				
				echo '<br />';
				
				$tcms_template->unloadTemplate();
				unset($tcms_template);
			}
		}
	}
}
else {
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->getAll(
		$tcms_db_prefix."links WHERE type='c' AND published=1 AND (module=3 OR module=2 OR module IS NULL) ORDER BY sort"
	);
	
	$count = 0;
	
	while($sqlARR = $sqlAL->fetchArray($sqlQR)) {
		$arrLink['name'] = $sqlARR['name'];
		$arrLink['tag']  = $sqlARR['uid'];
		
		if($arrLink['name'] == NULL) { $arrLink['name'] = ''; }
		if($arrLink['tag']  == NULL) { $arrLink['tag']  = ''; }
		
		// CHARSETS
		$arrLink['name'] = $tcms_main->decodeText($arrLink['name'], '2', $c_charset);
		
		
		/*
			FOR COMPATIBILITY:
			OLD AND NEW TEMPLATE ENGINE
			
			First the old one:
		*/
		$tcms_template = new tcms_toendaTemplate();
		
		if($tcms_template->checkTemplateExist(_LAYOUT_LINK_ENTRY)) {
			$tcms_template->loadTemplate(_LAYOUT_LINK_ENTRY);
			
			echo $tcms_template->getLinksCategoryTitle($arrLink['name']);
		}
		else {
			//echo '<span class="text_big" style="padding-left: 3px;"><strong>'.$arrLink['name'].'</strong></span><br />';
			echo '<div class="headLineLinksMainpage">'
			.'<br />'
			.'<span class="text_big" style="padding-left: 3px;">'
			.'<strong>'.$arrLink['name'].'</strong>'
			.'</span>'
			.'</div>'
			.'<br />';
		}
		
		
		$sqlQR2 = $sqlAL->sqlGetAll(
			$tcms_db_prefix."links WHERE category='".$arrLink['tag']."' AND type='l' AND published=1 AND (module=3 OR module=2 OR module IS NULL) ORDER BY sort"
		);
		
		while($sqlARR2 = $sqlAL->sqlFetchArray($sqlQR2)) {
			$arrLinkItem['name'] = $sqlARR2['name'];
			$arrLinkItem['desc'] = $sqlARR2['desc'];
			$arrLinkItem['link'] = $sqlARR2['link'];
			$arrLinkItem['targ'] = $sqlARR2['target'];
			
			if($arrLinkItem['name'] == NULL) { $arrLinkItem['name'] = ''; }
			if($arrLinkItem['desc'] == NULL) { $arrLinkItem['desc'] = ''; }
			if($arrLinkItem['link'] == NULL) { $arrLinkItem['link'] = ''; }
			if($arrLinkItem['targ'] == NULL) { $arrLinkItem['targ'] = ''; }
			
			// CHARSETS
			$arrLinkItem['name'] = $tcms_main->decodeText($arrLinkItem['name'], '2', $c_charset);
			$arrLinkItem['desc'] = $tcms_main->decodeText($arrLinkItem['desc'], '2', $c_charset);
			
			// target
			if(trim($arrLinkItem['targ']) == '') {
				$entryTarget = '_self';
			}
			else {
				$entryTarget = trim($arrLinkItem['targ']);
			}
			
			// link
			$entryLink = $arrLinkItem['link'];
			
			// text
			$entryText = $arrLinkItem['name'];
			
			// desc
			$entryDesc = trim($arrLinkItem['desc']);
			
			
			/*
				FOR COMPATIBILITY:
				OLD AND NEW TEMPLATE ENGINE
				
				First the old one:
			*/
			if($tcms_template->checkTemplateExist(_LAYOUT_LINK_ENTRY)) {
				$layoutEntryText = $tcms_template->getLinksEntry(
					$entryTarget, 
					$entryLink, 
					$entryText, 
					$entryDesc
				);
				
				$tcms_script = new toendaScript();
				$tcms_script->doParsePHP($layoutEntryText);
			}
			else {
				echo '<span class="text_normal">';
				
				echo '<span style="padding-left: 6px;">&raquo; ';
				echo '<a href="'.$entryLink.'" target="'.$entryTarget.'">'.$entryText.'</a>';
				if($link_use_desc == 1) {
					if($entryDesc != '') {
						echo '<br />';
						echo '<span class="text_normal" style="padding-left: 3px;">';
						echo $entryDesc;
						echo '</span>';
					}
				}
				echo '</span><br />';
				
				echo '</span>';
			}
		}
		
		echo '<br />';
		
		$sqlAL->sqlFreeResult($sqlQR2);
		
		$tcms_template->unloadTemplate();
		unset($tcms_template);
	}
	
	$sqlAL->sqlFreeResult($sqlQR);
	unset($sqlAL);
}

?>
