<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Sidebar News
|
| File:	ext_sidebar_news.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar News
 *
 * This module provides the sidebar news functionality.
 *
 * @version 0.2.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */

$getLang = $tcms_config->getLanguageCodeForTCMS($lang);


//$id == 'frontpage'
if($blah = 1){
	if($sb_news_enabled == 1){
		echo $tcms_html->subTitle($front_s_title);
		//echo '<br />';
		
		$arrNewsDC = new tcms_dc_news();
		$arrNewsDC = $tcms_dcp->getNewsDCList($getLang, $is_admin, $sb_how_many);
		
		
		if(!empty($arrNewsDC) && $arrNewsDC != '' && isset($arrNewsDC)){
			foreach($arrNewsDC as $n_key => $n_value){
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				
				if($sb_news_display == 4){
					echo lang_date(
						substr($dcNews->getDate(), 0, 2), 
						substr($dcNews->getDate(), 3, 2), 
						substr($dcNews->getDate(), 6, 4), 
						substr($dcNews->getTime(), 0, 2), 
						substr($dcNews->getTime(), 3, 2), 
						''
					);
				}
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID()
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				if($sb_news_display == 1 
				|| $sb_news_display == 2 
				|| $sb_news_display == 3 
				|| $sb_news_display == 4){
					echo ( $sb_news_display == 3 ? '<span class="newsCategories" style="padding-left: 6px;">&raquo;</span>' : '' )
					.'<strong class="newsCategories" style="padding-left: 6px;">'
					.'<a href="'.$link.'">'
					.$dcNews->getTitle()
					.'</a>'
					.'</strong>'
					.'<br />';
				}
				
				
				if($sb_news_display == 1 || $sb_news_display == 2){
					echo '<div class="text_small" style="padding-left: 6px;">'
					.lang_date(
						substr($dcNews->getDate(), 0, 2), 
						substr($dcNews->getDate(), 3, 2), 
						substr($dcNews->getDate(), 6, 4), 
						substr($dcNews->getTime(), 0, 2), 
						substr($dcNews->getTime(), 3, 2), 
						''
					)
					.'</div>';
				}
				
				
				//if($sb_news_display != 3)
					//echo '<br />';
				//echo '<br />';
				
				
				/*
					display the news
				*/
				if($sb_news_display == 1){
					echo '<div class="sidemain" style="padding-left: 6px;">';
					
					$sb_news_content = $tcms_main->cleanAllImagesFromString($dcNews->getText());
					
					$toendaScript = new toendaScript($sb_news_content);
					$sb_news_content = $toendaScript->doParse();
					$sb_news_content = $toendaScript->checkSEO($sb_news_content, $imagePath);
					unset($toendaScript);
					
					$sb_news_content = str_replace('{tcms_more}', '', $sb_news_content);
					
					if(strlen($sb_news_content) > $sb_cut_news){
						$str_off = strpos($sb_news_content, ' ', $sb_cut_news);
						$sb_news = substr($sb_news_content, 0, $str_off);
						$sb_news = trim($sb_news);
						echo $news.' ...';
					}
					elseif(strlen($sb_news_content) < $sb_cut_news){
						$sb_news_content = trim($sb_news_content);
						echo $sb_news_content;
					}
					
					echo '</div>'
					.'<br />';
				}
			}
		}
		
		echo '<br />';
	}
}

?>
