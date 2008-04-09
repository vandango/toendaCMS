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
| File:	ext_sidemenu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Side Menu (with User Menu)
 *
 * This module is used as a side menu.
 *
 * @version 0.6.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */


$globLevel = 0;

$getLang = $tcms_config->getLanguageCodeForTCMS($lang);


if($tcms_config->getSidemenuEnabled()) {
	$dcSE = new tcms_dc_sidebarextensions();
	$dcSE = $tcms_dcp->getSidebarExtensionSettings();
	
	
	if($dcSE->getUseSidemenuTitle()) {
		echo $tcms_html->subTitle($dcSE->getSidemenuTitle());
	}
	
	
	if($choosenDB != 'xml') {
		// recursive funtion
		
		/**
		 * Display recursivly the items
		 *
		 * @param String $parentID
		 * @param String $level
		 */
		function displayMenuItems($parentID, $level) {
			global $tcms_menu;
			global $tcms_config;
			global $tcms_main;
			global $globLevel;
			global $getLang;
			global $id;
			global $item;
			
			$globLevel++;
			
			$arrSubMenuItem = $tcms_menu->getSubmenu(
				$getLang, 
				1, 
				$parentID, 
				$id, 
				$item
			);
			
			if($tcms_main->isArray($arrSubMenuItem)) {
				echo '<li>'
				.'<ul style="list-style-type: none !important;">';
				
				foreach($arrSubMenuItem as $sm_key => $sm_value) {
					$subMenuItem = new tcms_dc_sidemenuitem();
					$subMenuItem = $arrSubMenuItem[$sm_key];
					
					$target = ( $subMenuItem->GetTarget() == '' ? '' : ' target="'.$subMenuItem->GetTarget().'"' );
					
					if($subMenuItem->getPublished()) {
						echo '<li>';
						
						switch($subMenuItem->GetType()) {
							case 'web':
								echo '<a class="submenu" href="'.$subMenuItem->GetLink().'"'.$target.'>'.$subMenuItem->GetTitle().'</a>';
								break;
							
							case 'title':
								echo $tcms_html->subTitle($subMenuItem->GetTitle());
								break;
							
							case 'link':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id='.$subMenuItem->GetLink().'&amp;s='.$s
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlConvertToSEO($link);
								
								echo '<a class="submenu" href="'.$link.'"'.$target.'>'.$subMenuItem->GetTitle().'</a>';
								break;
						}
						
						echo '</li>';
					}
					
					displayMenuItems(
						$subMenuItem->getID(), 
						$level + 1
					);
				}
				
				echo '</ul>'
				.'</li>';
			}
		}
		
		
		
		// display
		
		using('toendacms.datacontainer.sidemenuitem');
		
		$arrMenuItem = new tcms_dc_sidemenuitem();
		$arrMenuItem = $tcms_menu->getBasemenu($getLang);
		
		if($tcms_main->isArray($arrMenuItem)) {
			echo '<ul style="list-style-type: none !important;">';
			
			foreach($arrMenuItem as $n_key => $n_value) {
				$menuItem = new tcms_dc_sidemenuitem();
				$menuItem = $arrMenuItem[$n_key];
				
				$target = ( $menuItem->GetTarget() == '' ? '' : ' target="'.$menuItem->GetTarget().'"' );
				
				if($menuItem->getPublished() == 1) {
					echo '<li>';
					
					switch($menuItem->GetType()) {
						case 'web':
							echo '<a class="mainlevel" href="'.$menuItem->GetLink().'"'.$target.'>'
							.$menuItem->GetTitle()
							.'</a>';
							break;
						
						case 'title':
							echo $tcms_html->subTitle($menuItem->GetTitle());
							break;
						
						case 'link':
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$menuItem->GetLink().'&amp;s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							echo '<a class="mainlevel" href="'.$link.'"'.$target.'>'.$menuItem->GetTitle().'</a>';
							break;
					}
					
					echo '</li>';
				}
				/*
				displayMenuItems(
					$menuItem->getID(), 
					0
				);
				*/
				//
				// submenu
				//
				
				$arrSubMenuItem = $tcms_menu->getSubmenu(
					$getLang, 
					1, 
					$menuItem->GetID(), 
					$id, 
					$item
				);
				
				if($tcms_main->isArray($arrSubMenuItem)) {
					echo '<li>'
					.'<ul style="list-style-type: none !important;">';
					
					foreach($arrSubMenuItem as $sm_key => $sm_value) {
						$subMenuItem = new tcms_dc_sidemenuitem();
						$subMenuItem = $arrSubMenuItem[$sm_key];
						
						$target = ( $subMenuItem->GetTarget() == '' ? '' : ' target="'.$subMenuItem->GetTarget().'"' );
						
						if($subMenuItem->getPublished()) {
							echo '<li>';
							
							switch($subMenuItem->GetType()) {
								case 'web':
									echo '<a class="submenu" href="'.$subMenuItem->GetLink().'"'.$target.'>'.$subMenuItem->GetTitle().'</a>';
									break;
								
								case 'title':
									echo $tcms_html->subTitle($subMenuItem->GetTitle());
									break;
								
								case 'link':
									$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
									.'id='.$subMenuItem->GetLink().'&amp;s='.$s
									.( isset($lang) ? '&amp;lang='.$lang : '' );
									$link = $tcms_main->urlConvertToSEO($link);
									
									echo '<a class="submenu" href="'.$link.'"'.$target.'>'.$subMenuItem->GetTitle().'</a>';
									break;
							}
							
							echo '</li>';
						}
						
						//
						// submenu, level 2
						//
						$arrSubMenu2Item = $tcms_menu->getSubmenu($getLang, 2, $subMenuItem->GetID(), $id, $item);
						
						if($tcms_main->isArray($arrSubMenu2Item)) {
							echo '<li>'
							.'<ul style="list-style-type: none !important;">';
							
							foreach($arrSubMenu2Item as $sm_key => $sm_value) {
								$subMenu2Item = new tcms_dc_sidemenuitem();
								$subMenu2Item = $arrSubMenu2Item[$sm_key];
								
								$target = ( $subMenu2Item->GetTarget() == '' ? '' : ' target="'.$subMenu2Item->GetTarget().'"' );
								
								if($subMenu2Item->getPublished()) {
									echo '<li>';
									
									switch($subMenu2Item->GetType()) {
										case 'web':
											echo '<a class="submenu sublevel2" href="'.$subMenu2Item->GetLink().'"'.$target.'>'.$subMenu2Item->GetTitle().'</a>';
											break;
										
										case 'title':
											echo $tcms_html->subTitle($subMenu2Item->GetTitle());
											break;
										
										case 'link':
											$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
											.'id='.$subMenu2Item->GetLink().'&amp;s='.$s
											.( isset($lang) ? '&amp;lang='.$lang : '' );
											$link = $tcms_main->urlConvertToSEO($link);
											
											echo '<a class="submenu sublevel2" href="'.$link.'"'.$target.'>'.$subMenu2Item->GetTitle().'</a>';
											break;
									}
									
									echo '</li>';
								}
								
								unset($subMenu2Item);
							}
							
							echo '</ul>'
							.'</li>';
						}
						
						unset($arrSubMenu2Item);
						//
						// end submenu
						//
						
						unset($subMenuItem);
					}
					
					echo '</ul>'
					.'</li>';
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
		$poll_xml      = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml','r');
		$show_sm_poll  = $poll_xml->readSection('poll', 'use_poll_sidemenu');
		$sm_poll_id    = $poll_xml->readSection('poll', 'poll_sidemenu_id');
		$sm_poll_title = $poll_xml->readSection('poll', 'poll_sm_title');
		
		$sm_poll_title = $tcms_main->decodeText($sm_poll_title, '2', $c_charset);
		
		
		$authorizeNav = 0;
		
		$arr_menuauth = $tcms_main->mainmenu($arr_files, $c_charset, ( isset($session) ? $session : NULL ), $s, 'auth');
		
		if($id != 'polls' && $id != 'register' && $id != 'profile' && $id != 'search') {
			if($id == 'components') { $tempID = ($id.'&item='.$item); }
			else { $tempID = $id; }
			
			$this_link = $tcms_main->xml_readdir_content($tempID, _TCMS_PATH.'/tcms_menu/', 'link', 'menu', 5);
			
			if(file_exists(_TCMS_PATH.'/tcms_menu/'.$this_link.'.xml')) {
				if($this_link != 'index.html') {
					$xml       = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$this_link.'.xml','r');
					$subParent = $xml->readSection('menu', 'id');
				}
			}
			else { $subParent =  ''; }
		}
		else { $subParent =  ''; }
		
		//$tcms_main->paf($arr_side_navi);
		
		echo '<ul style="list-style-type: none !important;">';
		$check_is_menu = 0;
		
		if(is_array($arr_side_navi['link']) && !empty($arr_side_navi['link'])) {
			foreach($arr_side_navi['link'] as $key => $value) {
				//***********************
				// MAINMENU ACCESS
				//
				if($arr_side_navi['auth'][$key] == 'Public') { $authorizeNav = 1; }
				if($arr_side_navi['auth'][$key] == 'Protected') {
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter') { $authorizeNav = 1; }
					else { $authorizeNav = 0; }
				}
				if($arr_side_navi['auth'][$key] == 'Private') {
					if($is_admin == 'Administrator' || $is_admin == 'Developer') { $authorizeNav = 1; }
					else { $authorizeNav = 0; }
				}
				
				
				
				if($authorizeNav == 1) {
					//echo '<li>'.$arr_side_navi['id'][$key].' '.$arr_side_navi['subid'][$key].' '.$arr_side_navi['name'][$key].'</li>';
					
					
					//***********************
					// MENU TITLE
					//
					if($arr_side_navi['pub'][$key] == 1) {
						if($arr_side_navi['type'][$key] == 'title') {
							echo '<li>'.$tcms_html->subTitle($arr_side_navi['name'][$key]).'</li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					//***********************
					// LINK FOR POLL
					//
					if($arr_side_navi['id'][$key] == $sm_poll_id && $arr_side_navi['subid'][$key] == '-') {
						if($show_sm_poll == 1) {
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=polls&amp;s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							echo '<li><a class="mainlevel" href="'.$link.'">'.$sm_poll_title.'</a></li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					
					//***********************
					// DEFAULT MENU LINKS
					//
					if($arr_side_navi['pub'][$key] == 1) {
						$arr_side_navi['subid'][$key] = trim($arr_side_navi['subid'][$key]);
						if($arr_side_navi['subid'][$key] == '-' && $arr_side_navi['type'][$key] != 'title') {
							echo '<li>'.$value.'</li>';
							$check_is_menu++;
						}
					}
					//
					//***********************
					
					
					
					
					//***********************
					// SUBMENU
					//
					if($arr_side_navi['pub'][$key] == 1) {
						if($arr_side_navi['subid'][$key] != '-' && $arr_side_navi['type'][$key] != 'title') {
							if($subParent == $arr_side_navi['parent'][$key]) {
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
	
	
	if($check_session) {
		if($check_is_menu != 0) {
			echo '<br />';
			//echo '<br />';
		}
		
		include(_USER_MENU);
		
		if($check_is_menu == 0) {
			echo '<br />';
			//echo '<br />';
		}
	}
	
	if($check_is_menu != 0) {
		echo '<br />';
		//echo '<br />';
	}
	
	
	// cleanup
	unset($dcSE);
}

?>
