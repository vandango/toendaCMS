<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| News Categories for Sidebar
|
| File:		ext_sidebar_category.php
| Version:	0.3.4
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if($use_side_category == 1){
	if($choosenDB == 'xml'){
		$side_ext_xml  = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$show_nacat = $side_ext_xml->read_section('side', 'show_news_cat_amount');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$show_nacat = $sqlARR['show_news_cat_amount'];
		
		if($show_nacat == NULL){ $show_nacat = 1; }
	}
	
	
	

	echo tcms_html::subtitle(_NEWS_CATEGORIES_TITLE);
	
	
	
	if($choosenDB == 'xml'){
		$arrCatFile = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_news_categories/');
		
		if($arrCatFile){
			sort($arrCatFile);
			
			foreach($arrCatFile as $cKey => $cVal){
				$xmlP = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$cVal, 'r');
				
				$catSideName = $xmlP->read_section('cat', 'name');
				
				if($catSideName == false){ $catSideName = ''; }
				
				$catSideName = $tcms_main->decodeText($catSideName, '2', $c_charset);
				
				if($show_nacat == 1){
					$catSideNO = $tcms_main->getNewsCatAmount(substr($cVal, 0, 5), $authSQL1, $authSQL2);
				}
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;cat='.substr($cVal, 0, 5);
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '<span class="newsCategories" style="padding-left: 6px;">&raquo;&nbsp;';
				echo '<a href="'.$link.'">'
				.$catSideName
				.( $show_nacat == 1 ? ' ('.$catSideNO.')' : '' )
				.'</a>';
				echo '</span><br />';
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($check_session){
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'user', $ws_id);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			$is_admin     = $sqlARR['group'];
			if($is_admin == NULL){ $is_admin = ''; }
			
			if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
				$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
			}
			if($is_admin == 'Administrator' || $is_admin == 'Developer'){
				$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
			}
		}
		
		
		if($choosenDB == 'mssql'){
			$strSQL = "SELECT COUNT(".$tcms_db_prefix."news_to_categories.[news_uid]) AS countNC"
			.", ".$tcms_db_prefix."news_categories.[name] AS tncName"
			.", ".$tcms_db_prefix."news_categories.[uid] AS tncUID "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news ON (".$tcms_db_prefix."news_to_categories.[news_uid] = ".$tcms_db_prefix."news.[uid]) "
			."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.[cat_uid] = ".$tcms_db_prefix."news_categories.[uid]) "
			."WHERE ".$tcms_db_prefix."news.[access] = 'Public' ".$authSQL
			."GROUP BY ".$tcms_db_prefix."news_categories.[name], ".$tcms_db_prefix."news_categories.[uid] "
			."ORDER BY tncName";
		}
		else{
			$strSQL = "SELECT COUNT(".$tcms_db_prefix."news_to_categories.news_uid) AS countNC"
			.", ".$tcms_db_prefix."news_categories.name AS tncName"
			.", ".$tcms_db_prefix."news_categories.uid AS tncUID "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news ON (".$tcms_db_prefix."news_to_categories.news_uid = ".$tcms_db_prefix."news.uid) "
			."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.cat_uid = ".$tcms_db_prefix."news_categories.uid) "
			."WHERE ".$tcms_db_prefix."news.access = 'Public' ".$authSQL
			."GROUP BY ".$tcms_db_prefix."news_categories.name, ".$tcms_db_prefix."news_categories.uid "
			."ORDER BY tncName";
		}
		
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			switch($choosenDB){
				case 'mysql':
					$catSideName = $tcms_main->decodeText($sqlARR['tncName'], '2', $c_charset);
					$catSideUID  = $sqlARR['tncUID'];
					$catSideNO   = $sqlARR['countNC'];
					break;
				
				case 'pgsql':
					$catSideName = $tcms_main->decodeText($sqlARR['tncname'], '2', $c_charset);
					$catSideUID  = $sqlARR['tncuid'];
					$catSideNO   = $sqlARR['countnc'];
					break;
				
				case 'mssql':
					$catSideName = $tcms_main->decodeText($sqlARR['tncName'], '2', $c_charset);
					$catSideUID  = $sqlARR['tncUID'];
					$catSideNO   = $sqlARR['countNC'];
					break;
			}
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;cat='.$catSideUID;
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<span class="newsCategories" style="padding-left: 6px;">&raquo; ';
			echo '<a href="'.$link.'">'
			.$catSideName
			.'</a>';
			echo ( $show_nacat == 1 ? ' ('.$catSideNO.')' : '' );
			echo '</span><br />';
		}
	}
	
	echo '<br />';
}

?>
