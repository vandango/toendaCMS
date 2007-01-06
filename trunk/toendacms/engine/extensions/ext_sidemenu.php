<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Side Menu (with User Menu)
|
| File:		ext_sidemenu.php
| Version:	0.4.3
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if($navigation == 1){
	if($choosenDB == 'xml'){
		$layout_xml = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$menu_title = $layout_xml->read_section('side', 'sidemenu_title');
		$show_title = $layout_xml->read_section('side', 'sidemenu');
		
		$menu_title = $tcms_main->decodeText($menu_title, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$menu_title = $sqlARR['sidemenu_title'];
		$show_title = $sqlARR['sidemenu'];
		
		$menu_title = $tcms_main->decodeText($menu_title, '2', $c_charset);
	}
	
	
	
	if($show_title == 1){
		echo tcms_html::subtitle($menu_title);
	}
	
	
	
	if($choosenDB != 'xml') {
		include_once('engine/tcms_kernel/datacontainer/tcms_dc_sidemenuitem.lib.php');
		
		$arrMenuItem = new tcms_dc_sidemenuitem();
		$arrMenuItem = $tcms_menu->getBasemenu();
		
		if($tcms_main->isArray($arrMenuItem)){
			echo '<ul style="list-style-type: none !important;">';
			
			foreach($arrMenuItem as $n_key => $n_value){
				$menuItem = new tcms_dc_sidemenuitem();
				$menuItem = $arrMenuItem[$n_key];
				
				echo '<li>';
				
				switch($menuItem->GetType()){
					case 'web':
						echo '<a class="mainlevel" href="'.$menuItem->GetLink().'" target="_blank">'.$menuItem->GetTitle().'</a>';
						break;
					
					case 'title':
						echo tcms_html::subtitle($menuItem->GetTitle());
						break;
					
					case 'link':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$menuItem->GetLink().'&amp;s='.$s;
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a class="mainlevel" href="'.$link.'">'.$menuItem->GetTitle().'</a>';
						break;
				}
				
				echo '</li>';
				
				//
				// submenu
				//
				$arrSubMenuItem = $tcms_menu->getSubmenu(1, $menuItem->GetID(), $id, $item);
				
				if($tcms_main->isArray($arrSubMenuItem)){
					echo '<li><ul style="list-style-type: none !important;">';
					
					foreach($arrSubMenuItem as $sm_key => $sm_value){
						$subMenuItem = new tcms_dc_sidemenuitem();
						$subMenuItem = $arrSubMenuItem[$sm_key];
						
						echo '<li>';
						
						switch($subMenuItem->GetType()){
							case 'web':
								echo '<a class="submenu" href="'.$subMenuItem->GetLink().'" target="_blank">'.$subMenuItem->GetTitle().'</a>';
								break;
							
							case 'title':
								echo tcms_html::subtitle($subMenuItem->GetTitle());
								break;
							
							case 'link':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$subMenuItem->GetLink().'&amp;s='.$s;
								$link = $tcms_main->urlAmpReplace($link);
								
								echo '<a class="submenu" href="'.$link.'">'.$subMenuItem->GetTitle().'</a>';
								break;
						}
						
						echo '</li>';
						
						//
						// submenu, level 2
						//
						$arrSubMenu2Item = $tcms_menu->getSubmenu(2, $subMenuItem->GetID(), $id, $item);
						
						if($tcms_main->isArray($arrSubMenu2Item)){
							echo '<ul style="list-style-type: none !important;">';
							
							foreach($arrSubMenu2Item as $sm_key => $sm_value){
								$subMenu2Item = new tcms_dc_sidemenuitem();
								$subMenu2Item = $arrSubMenu2Item[$sm_key];
								
								echo '<li>';
								
								switch($subMenu2Item->GetType()){
									case 'web':
										echo '<a class="submenu sublevel2" href="'.$subMenu2Item->GetLink().'" target="_blank">'.$subMenu2Item->GetTitle().'</a>';
										break;
									
									case 'title':
										echo tcms_html::subtitle($subMenu2Item->GetTitle());
										break;
									
									case 'link':
										$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$subMenu2Item->GetLink().'&amp;s='.$s;
										$link = $tcms_main->urlAmpReplace($link);
										
										echo '<a class="submenu sublevel2" href="'.$link.'">'.$subMenu2Item->GetTitle().'</a>';
										break;
								}
								
								echo '</li>';
								
								unset($subMenu2Item);
							}
							
							echo '</ul>';
						}
						
						unset($arrSubMenu2Item);
						//
						// end submenu
						//
						
						unset($subMenuItem);
					}
					
					echo '</ul></li>';
				}
				
				unset($arrSubMenuItem);
				//
				// end submenu
				//
				
				unset($menuItem);
			}
			
			echo '</ul>'
			.'<br />';
		}
		
		unset($arrMenuItem);
	}
	else {
		if($choosenDB == 'xml'){
			$poll_xml      = new xmlparser($tcms_administer_site.'/tcms_global/poll.xml','r');
			$show_sm_poll  = $poll_xml->read_section('poll', 'use_poll_sidemenu');
			$sm_poll_id    = $poll_xml->read_section('poll', 'poll_sidemenu_id');
			$sm_poll_title = $poll_xml->read_section('poll', 'poll_sm_title');
			
			$sm_poll_title = $tcms_main->decodeText($sm_poll_title, '2', $c_charset);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'poll_config', 'poll');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$show_sm_poll  = $sqlARR['use_poll_sidemenu'];
			$sm_poll_id    = $sqlARR['poll_sidemenu_id'];
			$sm_poll_title = $sqlARR['poll_sm_title'];
			
			$sm_poll_title = $tcms_main->decodeText($sm_poll_title, '2', $c_charset);
		}
		
		
		$authorizeNav = 0;
		
		if($choosenDB == 'xml'){
			$arr_menuauth = $tcms_main->mainmenu($arr_files, $c_charset, ( isset($session) ? $session : NULL ), $s, 'auth');
			
			if($id != 'polls' && $id != 'register' && $id != 'profile' && $id != 'search'){
				if($id == 'components'){ $tempID = ($id.'&item='.$item); }
				else{ $tempID = $id; }
				
				$this_link = $tcms_main->xml_readdir_content($tempID, $tcms_administer_site.'/tcms_menu/', 'link', 'menu', 5);
				
				if(file_exists($tcms_administer_site.'/tcms_menu/'.$this_link.'.xml')){
					if($this_link != 'index.html'){
						$xml       = new xmlparser($tcms_administer_site.'/tcms_menu/'.$this_link.'.xml','r');
						$subParent = $xml->read_section('menu', 'id');
					}
				}
				else{ $subParent =  ''; }
			}
			else{ $subParent =  ''; }
		}
		else{
			$arr_menuauth = $tcms_main->mainmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s);
			
			if($id != 'polls' && $id != 'register' && $id != 'profile' && $id != 'search'){
				if($id == 'components'){ $tempID = ($id.'&item='.$item); }
				else{ $tempID = $id; }
				
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."sidemenu WHERE link='".$tempID."'");
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$subParent = $sqlARR['id'];
			}
			else{ $subParent =  ''; }
		}
		
		//$tcms_main->paf($arr_side_navi);
		
		echo '<ul style="list-style-type: none !important;">';
		$check_is_menu = 0;
		
		if(is_array($arr_side_navi['link']) && !empty($arr_side_navi['link'])){
			foreach($arr_side_navi['link'] as $key => $value){
				//***********************
				// MAINMENU ACCESS
				//
				if($arr_side_navi['auth'][$key] == 'Public'){ $authorizeNav = 1; }
				if($arr_side_navi['auth'][$key] == 'Protected'){
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $authorizeNav = 1; }
					else{ $authorizeNav = 0; }
				}
				if($arr_side_navi['auth'][$key] == 'Private'){
					if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $authorizeNav = 1; }
					else{ $authorizeNav = 0; }
				}
				
				
				
				if($authorizeNav == 1){
					//echo '<li>'.$arr_side_navi['id'][$key].' '.$arr_side_navi['subid'][$key].' '.$arr_side_navi['name'][$key].'</li>';
					
					
					//***********************
					// MENU TITLE
					//
					if($arr_side_navi['pub'][$key] == 1){
						if($arr_side_navi['type'][$key] == 'title'){
							echo '<li>'.tcms_html::subtitle($arr_side_navi['name'][$key]).'</li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					//***********************
					// LINK FOR POLL
					//
					if($arr_side_navi['id'][$key] == $sm_poll_id && $arr_side_navi['subid'][$key] == '-'){
						if($show_sm_poll == 1){
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=polls&amp;s='.$s;
							$link = $tcms_main->urlAmpReplace($link);
							
							echo '<li><a class="mainlevel" href="'.$link.'">'.$sm_poll_title.'</a></li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					
					//***********************
					// DEFAULT MENU LINKS
					//
					if($arr_side_navi['pub'][$key] == 1){
						$arr_side_navi['subid'][$key] = trim($arr_side_navi['subid'][$key]);
						if($arr_side_navi['subid'][$key] == '-' && $arr_side_navi['type'][$key] != 'title'){
							echo '<li>'.$value.'</li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					//***********************
					// SUBMENU
					//
					if($arr_side_navi['pub'][$key] == 1){
						if($arr_side_navi['subid'][$key] != '-' && $arr_side_navi['type'][$key] != 'title'){
							if($subParent == $arr_side_navi['parent'][$key]){
								echo '<li>'.$arr_side_navi['submenu'][$arr_side_navi['id'][$key]][$key].'</li>';
								$check_is_menu++;
							}
						}
					}
					//
					//***********************
				}
			}
		}
		
		
		echo '</ul>';
	}
	
	
	if($check_session){
		if($check_is_menu != 0){
			echo '<br />';
			//echo '<br />';
		}
		
		include(_USER_MENU);
		
		if($check_is_menu == 0){
			echo '<br />';
			//echo '<br />';
		}
	}
	
	if($check_is_menu != 0){
		echo '<br />';
		//echo '<br />';
	}
}

?>
