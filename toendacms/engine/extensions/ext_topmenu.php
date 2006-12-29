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
| File:		ext_topmenu.php
| Version:	0.2.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if($second_navigation == 1){
	if($choosenDB == 'xml'){
		$poll_xml      = new xmlparser($tcms_administer_site.'/tcms_global/poll.xml','r');
		$show_tm_poll  = $poll_xml->read_section('poll', 'use_poll_topmenu');
		$tm_poll_id    = $poll_xml->read_section('poll', 'poll_topmenu_id');
		$tm_poll_title = $poll_xml->read_section('poll', 'poll_tm_title');
		
		$tm_poll_title = $tcms_main->decodeText($tm_poll_title, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'poll_config', 'poll');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$show_tm_poll  = $sqlARR['use_poll_topmenu'];
		$tm_poll_id    = $sqlARR['poll_topmenu_id'];
		$tm_poll_title = $sqlARR['poll_tm_title'];
		
		$tm_poll_title = $tcms_main->decodeText($tm_poll_title, '2', $c_charset);
	}
	
	$show_poll = true;
	$set_active_link = true;
	
	$femCount = 0;
	
	if(is_array($arr_top_navi['link']) && !empty($arr_top_navi['link'])){
		foreach($arr_top_navi['link'] as $key => $value){
			/********************
			* AUTH
			*/
			if($arr_top_navi['access'][$key] == 'Public'){ $authorizeNav = 1; }
			if($arr_top_navi['access'][$key] == 'Protected'){
				if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $authorizeNav = 1; }
				else{ $authorizeNav = 0; }
			}
			if($arr_top_navi['access'][$key] == 'Private'){
				if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $authorizeNav = 1; }
				else{ $authorizeNav = 0; }
			}
			
			
			
			
			/********************
			* TOP LINKS
			*/
			if($authorizeNav == 1){
				if($arr_top_navi['pub'][$key] == 1){ $femCount++;
					if($active_topmenu == 1){
						if($set_active_link == true){
							if($id == $arr_top_navi['id'][$key] && $id != 'components'){
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id != 'polls' && !in_array($id, $arr_top_navi['id']) && $id != 'components'){
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id == 'polls' && $show_tm_poll == 0 && $id != 'components'){
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif(($id.'&item='.$item) == $arr_top_navi['id'][$key]){
								$value = str_replace('class="toplevel"', 'class="toplevelActive"', $value);
								$set_active_link = false;
							}
							elseif($id == 'polls'){
								$set_active_link = true;
							}
						}
					}
					echo $value;
				}
			}
			
			
			/********************
			* POLL LINK
			*/
			if($tm_poll_id > $arr_top_navi['last'][$key])
				$tm_poll_id = $arr_top_navi['last'][$key];
			
			if($key == ($tm_poll_id - 2) && $show_tm_poll == 1){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=polls&amp;s='.$s;
				$link = $tcms_main->urlAmpReplace($link);
				
				if($active_topmenu == 1){
					if($set_active_link == true){
						if($id == 'polls'){
							echo '<a class="toplevelActive" href="'.$link.'">'.$tm_poll_title.'</a>';
						}
						else{
							echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
						}
					}
					else{
						echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
					}
				}
				else{
					echo '<a class="toplevel" href="'.$link.'">'.$tm_poll_title.'</a>';
				}
			}
		}
	}
}

?>
