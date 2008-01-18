<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| News Monthview for Sidebar
|
| File:	ext_sidebar_monthview.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * News Monthview for Sidebar
 *
 * This module provides news nonthview for
 * the sidebar.
 *
 * @version 0.3.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_side_archives == 1){
	echo $tcms_html->subTitle(_NEWS_ARCHIVES_TITLE);
	
	
	if($choosenDB == 'xml'){
		$authSQL1 = '';
		$authSQL2 = '';
		
		if($check_session){
			if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
				$authSQL1 = 'Protected';
				$authSQL2 = '';
			}
			if($is_admin == 'Administrator' || $is_admin == 'Developer'){
				$authSQL1 = 'Protected';
				$authSQL2 = 'Private';
			}
		}
		
		
		$arrCatFile = $tcms_main->getPathContent(
			$tcms_administer_site.'/tcms_news/'
		);
		
		if($tcms_main->isArray($arrCatFile)){
			foreach($arrCatFile as $cKey => $cVal){
				$xmlP = new xmlparser($tcms_administer_site.'/tcms_news/'.$cVal, 'r');
				$sideDates['stamp'][$cKey] = $xmlP->readValue('stamp');
				$sideDates['date'][$cKey]  = $xmlP->readValue('date');
				$xmlP->flush();
				unset($xmlP);
			}
			
			if($tcms_main->isArray($sideDates)){
				array_multisort(
					$sideDates['stamp'], SORT_DESC, SORT_NUMERIC, 
					$sideDates['date'], SORT_DESC, SORT_NUMERIC
				);
				
				foreach($sideDates['date'] as $cKey => $cVal){
					$sideMonth = substr($cVal, 3, 2);
					$sideYear  = substr($cVal, 6, 4);
					
					if($tmpMonth != $sideMonth){
						if(substr($sideMonth, 0, 1) == '0'){ $ccMonth = substr($sideMonth, 1, 1); }
						else{ $ccMonth = $sideMonth; }
						
						$sideDate = $monthName[$ccMonth].'&nbsp;'.$sideYear;
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=newsmanager&amp;s='.$s.'&amp;date='.$sideYear.$sideMonth
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<span class="newsCategories" style="padding-left: 6px;">&raquo;&nbsp;';
						echo '<a href="'.$link.'">'
						.$sideDate
						.'</a>';
						echo '</span><br />';
					}
					
					$tmpMonth = $sideMonth;
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->connect(
			$sqlUser, 
			$sqlPass, 
			$sqlHost, 
			$sqlDB, 
			$sqlPort
		);
		
		if($check_session){
			if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
				$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
			}
			if($is_admin == 'Administrator' || $is_admin == 'Developer'){
				$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
			}
		}
		
		
		$strSQL = "SELECT DISTINCT date, stamp "
		."FROM ".$tcms_db_prefix."news "
		."WHERE ".$tcms_db_prefix."news.access = 'Public' ".$authSQL
		."ORDER BY stamp DESC";
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$cMonth = substr($sqlObj->date, 3, 2);
			
			//echo $cMonth.'<br>';
			
			if($tmpMonth != $cMonth){
				if(substr($cMonth, 0, 1) == '0'){ $ccMonth = substr($cMonth, 1, 1); }
				else{ $ccMonth = $cMonth; }
				
				$cYear  = substr($sqlObj->date, 6, 4);
				
				$sideDate = $monthName[$ccMonth].'&nbsp;'.$cYear;
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=newsmanager&amp;s='.$s.'&amp;date='.$cYear.$cMonth
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<span class="newsCategories" style="padding-left: 6px;">&raquo; ';
				echo '<a href="'.$link.'">'
				.$sideDate
				.'</a>'
				.'</span><br />';
			}
			
			$tmpMonth = $cMonth;
		}
	}
	
	echo '<br />';
}

?>
