<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Website statistics
|
| File:	mod_stats.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Website statistics
 *
 * This module is used as a statistics provider.
 *
 * @version 0.3.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['old_engine'])){ $old_engine = $_GET['old_engine']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['reset'])){ $reset = $_GET['reset']; }

if(isset($_POST['old_engine'])){ $old_engine = $_POST['old_engine']; }
if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['reset'])){ $reset = $_POST['reset']; }



echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />-->
<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />';



if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	/*
		init
	*/
	$c_xml      = new xmlparser(_TCMS_PATH.'/tcms_global/var.xml', 'r');
	$statistics = $c_xml->read_section('global', 'statistics');
	
	
	
	if($choosenDB == 'xml'){
		echo '<strong>'._DB_XML.'</strong>: XML database is online<br />';
		echo '<strong>'._DB_XML.' '._GALLERY_IMGSIZE.'</strong>: '
		.$tcms_file->getDirectorySizeString(_TCMS_PATH).'<br /><br />';
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
		/*
			database
		*/
		switch($choosenDB){
			case 'mysql':
				//$sqlQR = $sqlAL->sqlQuery('show status');
				echo '<strong>'._DB_MYSQL.'</strong>: '.$sqlAL->getStats().'<br />';
				break;
			
			case 'pgsql':
				$sqlQR = $sqlAL->query('SHOW SERVER_VERSION');
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				echo '<strong>'._DB_PGSQL.'</strong>: Server version '.$sqlARR[0].' ( More state information not yet implemented )<br />';
				break;
			
			case 'mssql':
				echo '<strong>'._DB_PGSQL.'</strong>: ( State information not yet implemented )<br />';
				break;
		}
		
		
		echo '<strong>'._DB_XML.' '._GALLERY_IMGSIZE.'</strong>: '
		.$tcms_file->getDirectorySizeString(_TCMS_PATH).'<br /><br />';
	}
	
	
	
	if($statistics == 0) {
		echo '<h3>';
		echo 'The statistics module is disabled.';
		echo '</h3>';
	}
	else {
		if($choosenDB == 'xml'){
			//echo '<strong>'._DB_XML.'</strong>: XML database is online<br />';
			//echo '<strong>'._DB_XML.' '._GALLERY_IMGSIZE.'</strong>: '
			//.$tcms_file->getDirectorySizeString(_TCMS_PATH).'<br /><br />';
			
			$statsum = 0;
			
			$arr_statfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_statistics/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(_TCMS_PATH.'/tcms_statistics/'.$value, 'r');
					$stat_value = $statXML->read_value('value');
					$statsum += $stat_value;
				}
			}
			
			echo '<strong>'._STATS_SUM_CLICKS.'</strong>: '.( $statsum == '' ? 0 : $statsum ).'<br />';
			
			
			//$uniqueVal = $tcms_main->l-o-a-d-_-x-m-l-_-f-i-l-e-s(
			//_TCMS_PATH.'/tcms_statistics_ip/', 'number');
			
			$files = $tcms_file->getPathContent(
				_TCMS_PATH.'/tcms_statistics_ip/', 
				false, 
				'.xml'
			);
			$uniqueVal = $tcms_main->countArrayValues($files);
			
			echo '<strong>'._STATS_SUM_UNIQUE.'</strong>: '.( $uniqueVal == '' ? 0 : $uniqueVal ).'<br />';
			
			
			//echo '<strong>'._STATS_SUM_IP.'</strong>: '.$uniqueVal.'<br /><br />';
			echo '<br />';
			
			
			
			/*
				tabpane start
			*/
			
			echo '<div class="tab-pane" id="tab-pane-1">';
			
			
			/*
				hits tab
			*/
			
			echo '<div class="tab-page" id="tab-page-hits">'
			.'<h2 class="tab">'._STATS_HITS.'</h2>';
			
			
			$arr_statfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_statistics/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(_TCMS_PATH.'/tcms_statistics/'.$value, 'r');
					
					$arr_stat['host'][$key]      = $statXML->read_value('host');
					$arr_stat['url'][$key]       = $statXML->read_value('site_url');
					$arr_stat['value'][$key]     = $statXML->read_value('value');
					$arr_stat['referrer'][$key]  = $statXML->read_value('referrer');
					$arr_stat['timestamp'][$key] = $statXML->read_value('timestamp');
					
					if($arr_stat['host'][$key]      == false){ $arr_stat['host'][$key]      = ''; }
					if($arr_stat['site_url'][$key]  == false){ $arr_stat['site_url'][$key]  = ''; }
					if($arr_stat['value'][$key]     == false){ $arr_stat['value'][$key]     = ''; }
					if($arr_stat['referrer'][$key]  == false){ $arr_stat['referrer'][$key]  = ''; }
					if($arr_stat['timestamp'][$key] == false){ $arr_stat['timestamp'][$key] = ''; }
				}
			}
			
			/*
			if(is_array($arr_stat)){
				array_multisort(
					$arr_stat['value'], SORT_DESC, SORT_NUMERIC, 
					$arr_stat['timestamp'], SORT_DESC, SORT_NUMERIC, 
					$arr_stat['referrer'], SORT_DESC, SORT_STRING, 
					$arr_stat['host'], SORT_DESC, SORT_STRING, 
					$arr_stat['site_url'], SORT_DESC, SORT_STRING
				);
			}
			*/
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TIME.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._STATS_COUNT.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._STATS_HOST.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="50%" align="left">'._STATS_PAGE.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="40%" align="left">'._STATS_REF.'</th></tr>';
			
			if(is_array($arr_stat) && !empty($arr_stat)){
				foreach($arr_stat['host'] as $key => $val){
					if($key < 20){
						if(is_integer($key/2)){ $wsc = 0; }
						else{ $wsc = 1; }
						
						echo '<tr height="25" id="row'.$key.'" '
						.'bgcolor="'.$arr_color[$wsc].'" '
						.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
						.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
						
						echo '<td class="tcms_db_2">'.$arr_stat['timestamp'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['value'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['host'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['url'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2" title="'.$arr_stat['referrer'][$key].'">'.( strlen($arr_stat['referrer'][$key]) > 50 ? substr($arr_stat['referrer'][$key], 0, 50).'...' : $arr_stat['referrer'][$key] ).'&nbsp;</td>';
						
						echo '</tr>';
					}
				}
			}
			
			echo '</table><br />';
			
			
			echo '</div>';
			
			
			/*
				hits tab
			*/
			
			echo '<div class="tab-page" id="tab-page-software">'
			.'<h2 class="tab">'._STATS_BROWSER_OS.'</h2>';
			
			
			$arr_statfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_statistics_os/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(_TCMS_PATH.'/tcms_statistics_os/'.$value, 'r');
					
					$arr_stat['browser'][$key] = $statXML->read_value('browser');
					$arr_stat['os'][$key]      = $statXML->read_value('os');
					$arr_stat['value'][$key]   = $statXML->read_value('value');
					
					if($arr_stat['browser'][$key] == false){ $arr_stat['browser'][$key] = ''; }
					if($arr_stat['os'][$key]      == false){ $arr_stat['os'][$key]      = ''; }
					if($arr_stat['value'][$key]   == false){ $arr_stat['value'][$key]   = ''; }
				}
			}
			
			/*
			if(is_array($arr_stat)){
				array_multisort(
					$arr_stat['value'], SORT_DESC, SORT_NUMERIC, 
					$arr_stat['browser'], SORT_DESC, SORT_NUMERIC, 
					$arr_stat['os'], SORT_DESC, SORT_STRING
				);
			}
			*/
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._STATS_COUNT.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="40%" align="left">'._STATS_BROWSER.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="60%" align="left">'._STATS_OS.'</th></tr>';
			
			if(is_array($arr_stat) && !empty($arr_stat)){
				foreach($arr_stat['value'] as $key => $val){
					//if($key < 20){
						if(is_integer($key/2)){ $wsc = 0; }
						else{ $wsc = 1; }
						
						echo '<tr height="25" id="row'.$key.'" '
						.'bgcolor="'.$arr_color[$wsc].'" '
						.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
						.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
						
						echo '<td class="tcms_db_2">'.$arr_stat['value'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['browser'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['os'][$key].'&nbsp;</td>';
						
						echo '</tr>';
					//}
				}
			}
			
			echo '</table><br />';
			
			
			echo '</div>';
			
			
			/*
				hits tab
			*/
			
			echo '<div class="tab-page" id="tab-page-reset">'
			.'<h2 class="tab">'._STATS_RESET.'</h2>';
			
			
			echo _STATS_RESET_TEXT.'<br /><br />';
			
			echo '<input type="button" name="reset" value="'._STATS_RESET.'" '
			.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats&action=reset&reset=1\';" />';
			
			if($reset == 1){
				// delete hit stats
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_statistics/');
				mkdir(_TCMS_PATH.'/tcms_statistics/', 0777);
				chmod(_TCMS_PATH.'/tcms_statistics/', 0777);
				$hitStats = 0;
				
				
				
				// delete ip stats
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_statistics_ip/');
				mkdir(_TCMS_PATH.'/tcms_statistics_ip/', 0777);
				chmod(_TCMS_PATH.'/tcms_statistics_ip/', 0777);
				$ipStats = 0;
				
				
				
				// delete software stats
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_statistics_os/');
				mkdir(_TCMS_PATH.'/tcms_statistics_os/', 0777);
				chmod(_TCMS_PATH.'/tcms_statistics_os/', 0777);
				$osStats = 0;
				
				
				
				if($hitStats == 0 && $ipStats == 0 && $osStats == 0){
					echo '<script>'
					.'alert(\''._STATS_RESET_SUCCESS.'\');'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats\';'
					.'</script>';
				}
				else{
					echo '<script>'
					.'alert(\''._STATS_RESET_FAILED.'\');'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats\';'
					.'</script>';
				}
			}
			
			
			echo '</div>';
			
			
			/*
				tabpane end
			*/
			
			echo '</div>'
			.'<script type="text/javascript">
			var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
			tabPane1.addTabPage(document.getElementById("tab-page-hits"));
			tabPane1.addTabPage(document.getElementById("tab-page-software"));
			tabPane1.addTabPage(document.getElementById("tab-page-reset"));
			setupAllTabs();
			</script>'
			.'<br />';
		}
		else {
			/*
				site statistics
				1. hits
				2. unique hits
				3. different ip's
			*/
			$sqlSTR = "SELECT SUM(value) AS statsum "
			."FROM ".$tcms_db_prefix."statistics "
			."WHERE NOT (ip_uid IS NULL)";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			echo '<strong>'._STATS_SUM_CLICKS.'</strong>: '.( $sqlARR['statsum'] == '' ? 0 : $sqlARR['statsum'] ).'<br />';
			
			
			
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."statistics_ip "
			."WHERE NOT (ip IS NULL)";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$uniqueVal = $sqlAL->sqlGetNumber($sqlQR);
			
			echo '<strong>'._STATS_SUM_UNIQUE.'</strong>: '.$uniqueVal.'<br />';
			
			
			
			
			$sqlSTR = "SELECT DISTINCT ip "
			."FROM ".$tcms_db_prefix."statistics_ip "
			."WHERE NOT (ip IS NULL)";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$uniqueVal = $sqlAL->sqlGetNumber($sqlQR);
			
			echo '<strong>'._STATS_SUM_IP.'</strong>: '.$uniqueVal.'<br /><br />';
			
			
			
			/*
				tabpane start
			*/
			
			echo '<div class="tab-pane" id="tab-pane-1">';
			
			
			/*
				hits tab
			*/
			
			echo '<div class="tab-page" id="tab-page-hits">'
			.'<h2 class="tab">'._STATS_HITS.'</h2>';
			
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."statistics "
			."WHERE NOT (ip_uid IS NULL) "
			."ORDER BY value DESC, timestamp DESC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$oldValue = $sqlAL->sqlGetNumber($sqlQR);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_stat['host'][$count]       = $sqlARR['host'];
				$arr_stat['url'][$count]        = $sqlARR['site_url'];
				$arr_stat['value'][$count]      = $sqlARR['value'];
				$arr_stat['referrer'][$count]   = $sqlARR['referrer'];
				$arr_stat['timestamp'][$count]  = $sqlARR['timestamp'];
				
				if($arr_stat['host'][$count]       == NULL){ $arr_stat['host'][$count]       = ''; }
				if($arr_stat['url'][$count]        == NULL){ $arr_stat['url'][$count]        = ''; }
				if($arr_stat['value'][$count]      == NULL){ $arr_stat['value'][$count]      = ''; }
				if($arr_stat['referrer'][$count]   == NULL){ $arr_stat['referrer'][$count]   = ''; }
				if($arr_stat['timestamp'][$count]  == NULL){ $arr_stat['timestamp'][$count]  = ''; }
				
				$count++;
			}
			
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TIME.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._STATS_COUNT.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._STATS_HOST.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="50%" align="left">'._STATS_PAGE.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="40%" align="left">'._STATS_REF.'</th></tr>';
			
			if(is_array($arr_stat) && !empty($arr_stat)){
				foreach($arr_stat['host'] as $key => $val){
					//if($key < 20){
						if(is_integer($key/2)){ $wsc = 0; }
						else{ $wsc = 1; }
						
						echo '<tr height="25" id="row'.$key.'" '
						.'bgcolor="'.$arr_color[$wsc].'" '
						.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
						.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
						
						echo '<td class="tcms_db_2">'.$arr_stat['timestamp'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['value'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['host'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['url'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2" title="'.$arr_stat['referrer'][$key].'">'.( strlen($arr_stat['referrer'][$key]) > 50 ? substr($arr_stat['referrer'][$key], 0, 50).'...' : $arr_stat['referrer'][$key] ).'&nbsp;</td>';
						
						echo '</tr>';
					//}
				}
			}
			
			echo '</table><br />';
			
			
			echo '</div>';
			
			
			/*
				os tab
			*/
			
			echo '<div class="tab-page" id="tab-page-os">'
			.'<h2 class="tab">'._STATS_OS.'</h2>';
			
			unset($arr_stat);
			unset($sqlARR);
			unset($sqlQR);
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."statistics_os "
			//."WHERE NOT (uid IS NULL) "
			."ORDER BY value DESC, os DESC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$oldValue = $sqlAL->sqlGetNumber($sqlQR);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				//$arr_stat['browser'][$count] = $sqlARR['browser'];
				$arr_stat['os'][$count]      = $sqlARR['os'];
				$arr_stat['value'][$count]   = $sqlARR['value'];
				
				//if($arr_stat['browser'][$count] == NULL){ $arr_stat['browser'][$count] = ''; }
				if($arr_stat['os'][$count]      == NULL){ $arr_stat['os'][$count]      = ''; }
				if($arr_stat['value'][$count]   == NULL){ $arr_stat['value'][$count]   = ''; }
				
				$count++;
			}
			
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._STATS_COUNT.'</th>'
				//.'<th valign="middle" class="tcms_db_title" width="40%" align="left">'._STATS_BROWSER.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="90%" align="left">'._STATS_OS.'</th>'
				.'</tr>';
			
			if(is_array($arr_stat) && !empty($arr_stat)){
				foreach($arr_stat['value'] as $key => $val){
					//if($key < 20){
						if(is_integer($key/2)){ $wsc = 0; }
						else{ $wsc = 1; }
						
						echo '<tr height="25" id="row'.$key.'" '
						.'bgcolor="'.$arr_color[$wsc].'" '
						.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
						.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
						
						echo '<td class="tcms_db_2">'.$arr_stat['value'][$key].'&nbsp;</td>';
						//echo '<td class="tcms_db_2">'.$arr_stat['browser'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['os'][$key].'&nbsp;</td>';
						
						echo '</tr>';
					//}
				}
			}
			
			echo '</table><br />';
			
			
			echo '</div>';
			
			
			/*
				os tab
			*/
			
			echo '<div class="tab-page" id="tab-page-browser">'
			.'<h2 class="tab">'._STATS_BROWSER.'</h2>';
			
			unset($arr_stat);
			unset($sqlARR);
			unset($sqlQR);
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."statistics_os "
			//."WHERE NOT (uid IS NULL) "
			."ORDER BY value DESC, browser DESC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$oldValue = $sqlAL->sqlGetNumber($sqlQR);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_stat['browser'][$count] = $sqlARR['browser'];
				//$arr_stat['os'][$count]      = $sqlARR['os'];
				$arr_stat['value'][$count]   = $sqlARR['value'];
				
				if($arr_stat['browser'][$count] == NULL){ $arr_stat['browser'][$count] = ''; }
				//if($arr_stat['os'][$count]      == NULL){ $arr_stat['os'][$count]      = ''; }
				if($arr_stat['value'][$count]   == NULL){ $arr_stat['value'][$count]   = ''; }
				
				$count++;
			}
			
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._STATS_COUNT.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="90%" align="left">'._STATS_BROWSER.'</th>'
				//.'<th valign="middle" class="tcms_db_title" width="60%" align="left">'._STATS_OS.'</th>'
				.'</tr>';
			
			if(is_array($arr_stat) && !empty($arr_stat)){
				foreach($arr_stat['value'] as $key => $val){
					//if($key < 20){
						if(is_integer($key/2)){ $wsc = 0; }
						else{ $wsc = 1; }
						
						echo '<tr height="25" id="row'.$key.'" '
						.'bgcolor="'.$arr_color[$wsc].'" '
						.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
						.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
						
						echo '<td class="tcms_db_2">'.$arr_stat['value'][$key].'&nbsp;</td>';
						echo '<td class="tcms_db_2">'.$arr_stat['browser'][$key].'&nbsp;</td>';
						//echo '<td class="tcms_db_2">'.$arr_stat['os'][$key].'&nbsp;</td>';
						
						echo '</tr>';
					//}
				}
			}
			
			echo '</table><br />';
			
			
			echo '</div>';
			
			
			/*
				os tab
			*/
			
			echo '<div class="tab-page" id="tab-page-reset">'
			.'<h2 class="tab">'._STATS_RESET.'</h2>';
			
			
			echo _STATS_RESET_TEXT.'<br /><br />';
			
			echo '<input type="button" name="reset" value="'._STATS_RESET.'" '
			.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats&action=reset&reset=1\';" />';
			
			if($reset == 1){
				// delete hit stats
				$sqlSTR = "DELETE FROM ".$tcms_db_prefix."statistics WHERE NOT (ip_uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				unset($sqlQR);
				$sqlSTR = "SELECT * FROM ".$tcms_db_prefix."statistics WHERE NOT (ip_uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				$hitStats = $sqlAL->sqlGetNumber($sqlQR);
				unset($sqlQR);
				
				
				
				// delete ip stats
				$sqlSTR = "DELETE FROM ".$tcms_db_prefix."statistics_ip WHERE NOT (uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				unset($sqlQR);
				$sqlSTR = "SELECT * FROM ".$tcms_db_prefix."statistics_ip WHERE NOT (uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				$ipStats = $sqlAL->sqlGetNumber($sqlQR);
				unset($sqlQR);
				
				
				
				// delete software stats
				$sqlSTR = "DELETE FROM ".$tcms_db_prefix."statistics_os WHERE NOT (uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				unset($sqlQR);
				$sqlSTR = "SELECT * FROM ".$tcms_db_prefix."statistics_os WHERE NOT (uid IS NULL)";
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				$osStats = $sqlAL->sqlGetNumber($sqlQR);
				
				
				
				if($hitStats == 0 && $ipStats == 0 && $osStats == 0){
					echo '<script>'
					.'alert(\''._STATS_RESET_SUCCESS.'\');'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats\';'
					.'</script>';
				}
				else{
					echo '<script>'
					.'alert(\''._STATS_RESET_FAILED.'\');'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_stats\';'
					.'</script>';
				}
			}
			
			
			echo '</div>';
			
			
			/*
				tabpane end
			*/
			
			echo '</div>'
			.'<script type="text/javascript">
			var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
			tabPane1.addTabPage(document.getElementById("tab-page-hits"));
			tabPane1.addTabPage(document.getElementById("tab-page-os"));
			tabPane1.addTabPage(document.getElementById("tab-page-browser"));
			tabPane1.addTabPage(document.getElementById("tab-page-reset"));
			setupAllTabs();
			</script>'
			.'<br />';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
