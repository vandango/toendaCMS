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
| File:		ext_links_mainpage.php
| Version:	0.1.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');






$toendaScript = new toendaScript($link_text);
$link_text = $toendaScript->toendaScript_trigger();
$link_text = $toendaScript->checkSEO($link_text, $imagePath);


if(trim($link_title)    != ''){ echo tcms_html::contentheading($link_title); }
if(trim($link_subtitle) != ''){ echo tcms_html::contentstamp($link_subtitle).'<br />'; }
if(trim($link_text)     != ''){ echo tcms_html::contentmain($link_text).'<br /><br />'; }




if($choosenDB == 'xml'){
	$arr_filename = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_links/');
	$count = 0;
	
	if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
		foreach($arr_filename as $key => $value){
			$menu_xml = new xmlparser($tcms_administer_site.'/tcms_links/'.$value,'r');
			$is_published = $menu_xml->read_section('link', 'published');
			$is_category  = $menu_xml->read_section('link', 'type');
			$is_main      = $menu_xml->read_section('link', 'module');
			
			if($is_main == false || !isset($is_main) || $is_main == '' || empty($is_main)){
				$is_main = 3;
			}
			
			if($is_published == 1 && $is_category == 'c' && ($is_main == 2 || $is_main == 3)){
				$arrLink['tag'][$count]  = substr($value, 0, 32);
				$arrLink['name'][$count] = $menu_xml->read_section('link', 'name');
				$arrLink['sort'][$count] = $menu_xml->read_section('link', 'sort');
				
				if(!$arrLink['name'][$count]){ $arrLink['name'][$count] = ''; }
				
				// CHARSETS
				$arrLink['name'][$count] = $tcms_main->decodeText($arrLink['name'][$count], '2', $c_charset);
				
				$count++;
			}
		}
		
		
		if($arrLink && is_array($arrLink)){
			array_multisort(
				$arrLink['sort'], SORT_ASC, 
				$arrLink['name'], SORT_ASC, 
				$arrLink['tag'], SORT_ASC
			);
			
			
			foreach($arrLink['name'] as $lKey => $lVal){
				echo '<span class="text_big" style="padding-left: 3px;"><strong>'.$lVal.'</strong></span><br />';
				
				unset($arrLinkItem);
				unset($arr_filename);
				
				
				$arr_filename = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_links/');
				$count = 0;
				
				if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
					foreach($arr_filename as $key => $value){
						$menu_xml = new xmlparser($tcms_administer_site.'/tcms_links/'.$value,'r');
						$is_published = $menu_xml->read_section('link', 'published');
						$is_type      = $menu_xml->read_section('link', 'type');
						$is_category  = $menu_xml->read_section('link', 'category');
						$is_main      = $menu_xml->read_section('link', 'module');
						
						if($is_main == false || !isset($is_main) || $is_main == '' || empty($is_main)){
							$is_main = 3;
						}
						
						if($is_published == 1 && $is_type == 'l' && $is_category == $arrLink['tag'][$lKey] && ($is_main == 2 || $is_main == 3)){
							$arrLinkItem['name'][$count] = $menu_xml->read_section('link', 'name');
							$arrLinkItem['sort'][$count] = $menu_xml->read_section('link', 'sort');
							$arrLinkItem['desc'][$count] = $menu_xml->read_section('link', 'desc');
							$arrLinkItem['link'][$count] = $menu_xml->read_section('link', 'link_to');
							$arrLinkItem['trgt'][$count] = $menu_xml->read_section('link', 'target');
							
							if(!$arrLinkItem['name'][$count]){ $arrLinkItem['name'][$count] = ''; }
							if(!$arrLinkItem['desc'][$count]){ $arrLinkItem['desc'][$count] = ''; }
							if(!$arrLinkItem['link'][$count]){ $arrLinkItem['link'][$count] = ''; }
							if(!$arrLinkItem['trgt'][$count]){ $arrLinkItem['trgt'][$count] = ''; }
							
							// CHARSETS
							$arrLinkItem['name'][$count] = $tcms_main->decodeText($arrLinkItem['name'][$count], '2', $c_charset);
							$arrLinkItem['desc'][$count] = $tcms_main->decodeText($arrLinkItem['desc'][$count], '2', $c_charset);
							
							$count++;
						}
					}
					
					
					if($arrLinkItem && is_array($arrLinkItem)){
						array_multisort(
							$arrLinkItem['sort'], SORT_ASC, 
							$arrLinkItem['name'], SORT_ASC, 
							$arrLinkItem['desc'], SORT_ASC, 
							$arrLinkItem['link'], SORT_ASC, 
							$arrLinkItem['trgt'], SORT_ASC
						);
						
						
						foreach($arrLinkItem['name'] as $lKey2 => $lVal2){
							echo '<span class="text_normal">';
							
							echo '<span style="padding-left: 6px;">&raquo; ';
							echo '<a'.( $arrLinkItem['trgt'][$lKey2] != '' ? ' target="'.$arrLinkItem['trgt'][$lKey2].'"' : '' ).' href="'.$arrLinkItem['link'][$lKey2].'">'.$arrLinkItem['name'][$lKey2].'</a>';
							if($link_use_desc == 1){
								if(trim($arrLinkItem['desc'][$lKey2]) != ''){
									echo '<br />';
									echo '<span class="text_normal" style="padding-left: 3px;">';
									echo trim($arrLinkItem['desc'][$lKey2]);
									echo '</span>';
								}
							}
							echo '</span><br />';
							
							echo '</span>';
						}
					}
				}
				
				echo '<br />';
			}
		}
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB);
	$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."links WHERE type='c' AND published=1 AND (module=3 OR module=2 OR module IS NULL) ORDER BY sort");
	
	$count = 0;
	
	while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
		$arrLink['name'] = $sqlARR['name'];
		$arrLink['tag']  = $sqlARR['uid'];
		
		if($arrLink['name'] == NULL){ $arrLink['name'] = ''; }
		if($arrLink['tag']  == NULL){ $arrLink['tag']  = ''; }
		
		// CHARSETS
		$arrLink['name'] = $tcms_main->decodeText($arrLink['name'], '2', $c_charset);
		
		echo '<span class="text_big" style="padding-left: 3px;"><strong>'.$arrLink['name'].'</strong></span><br />';
		
		
		
		$sqlQR2 = $sqlAL->sqlGetAll($tcms_db_prefix."links WHERE category='".$arrLink['tag']."' AND type='l' AND published=1 AND (module=3 OR module=2 OR module IS NULL) ORDER BY sort");
		
		while($sqlARR2 = $sqlAL->sqlFetchArray($sqlQR2)){
			$arrLinkItem['name'] = $sqlARR2['name'];
			$arrLinkItem['desc'] = $sqlARR2['desc'];
			$arrLinkItem['link'] = $sqlARR2['link'];
			$arrLinkItem['targ'] = $sqlARR2['target'];
			
			if($arrLinkItem['name'] == NULL){ $arrLinkItem['name'] = ''; }
			if($arrLinkItem['desc'] == NULL){ $arrLinkItem['desc'] = ''; }
			if($arrLinkItem['link'] == NULL){ $arrLinkItem['link'] = ''; }
			if($arrLinkItem['targ'] == NULL){ $arrLinkItem['targ'] = ''; }
			
			// CHARSETS
			$arrLinkItem['name'] = $tcms_main->decodeText($arrLinkItem['name'], '2', $c_charset);
			$arrLinkItem['desc'] = $tcms_main->decodeText($arrLinkItem['desc'], '2', $c_charset);
			
			echo '<span class="text_normal">';
			
			echo '<span style="padding-left: 6px;">&raquo; ';
			echo '<a href="'.$arrLinkItem['link'].'"'.( $arrLinkItem['targ'] == '' ? '' : ' target="'.$arrLinkItem['targ'] ).'">'.$arrLinkItem['name'].'</a>';
			if($link_use_desc == 1){
				if(trim($arrLinkItem['desc']) != ''){
					echo '<br />';
					echo '<span class="text_normal" style="padding-left: 3px;">';
					echo trim($arrLinkItem['desc']);
					echo '</span>';
				}
			}
			echo '</span><br />';
			
			echo '</span>';
		}
		
		echo '<br />';
		
		$sqlAL->sqlFreeResult($sqlQR2);
	}
	
	$sqlAL->sqlFreeResult($sqlQR);
}

?>
