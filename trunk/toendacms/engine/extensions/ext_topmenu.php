<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Topmenu
|
| File:	ext_topmenu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Topmenu
 *
 * This module is used as a topmenu.
 *
 * @version 0.3.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if($tcms_config->getTopmenuEnabled()) {
	if($choosenDB == 'xml') {
		$poll_xml      = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml','r');
		$show_tm_poll  = $poll_xml->readSection('poll', 'use_poll_topmenu');
		$tm_poll_id    = $poll_xml->readSection('poll', 'poll_topmenu_id');
		$tm_poll_title = $poll_xml->readSection('poll', 'poll_tm_title');
		
		$tm_poll_title = $tcms_main->decodeText($tm_poll_title, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'poll_config', 'poll');
		$sqlARR = $sqlAL->fetchArray($sqlQR);
		
		$show_tm_poll  = $sqlARR['use_poll_topmenu'];
		$tm_poll_id    = $sqlARR['poll_topmenu_id'];
		$tm_poll_title = $sqlARR['poll_tm_title'];
		
		$tm_poll_title = $tcms_main->decodeText($tm_poll_title, '2', $c_charset);
	}
	
	$show_poll = true;
	$set_active_link = true;
	
	$femCount = 0;
	
	if($tcms_main->isArray($arr_top_navi['link'])) {
		foreach($arr_top_navi['link'] as $key => $value) {
			/*
				AUTH
			*/
			
			if($tcms_main->checkAccess($arr_top_navi['access'][$key], $is_admin)) {
				$authorizeNav = 1;
			}
			else {
				$authorizeNav = 0;
			}
			
			
			
			/*
				TOP LINKS
			*/
			
			if($authorizeNav == 1) {
				if($arr_top_navi['pub'][$key] == 1) {
					$femCount++;
					
					if($active_topmenu == 1) {
						if($set_active_link == true){
							if($id == $arr_top_navi['id'][$key] && $id != 'components') {
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id != 'polls' && !in_array($id, $arr_top_navi['id'])) {
								// && $id != 'components'){
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id == 'polls' && $show_tm_poll == 0 && $id != 'components') {
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif(($id.'&item='.$item) == $arr_top_navi['id'][$key]) {
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id == 'polls') {
								$set_active_link = true;
							}
						}
					}
					
					echo $value;
				}
			}
			
			
			
			/*
				POLL LINK
			*/
			if($tm_poll_id > $arr_top_navi['last'][$key]) {
				$tm_poll_id = $arr_top_navi['last'][$key];
			}
			
			if($key == ($tm_poll_id - 2) && $show_tm_poll == 1) {
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=polls&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				if($active_topmenu == 1) {
					if($set_active_link == true) {
						if($id == 'polls') {
							echo '<a class="toplevelActive" href="'.$link.'">'.$tm_poll_title.'</a>';
						}
						else {
							echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
						}
					}
					else {
						echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
					}
				}
				else {
					echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
				}
			}
		}
	}
}

?>
