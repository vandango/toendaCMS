<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Sidebar
|
| File:	ext_sidebar_content.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar
 *
 * This module provides the sidebar functionality.
 *
 * @version 0.6.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */





// ----------------------------------------
// INIT
// ----------------------------------------

if($use_sidebar == 1) {
	$seDC = new tcms_dc_sidebarextensions();
	$seDC = $tcms_dcp->getSidebarExtensionSettings();
	
	$dcP = new tcms_dc_products();
	$dcP = $tcms_dcp->getProductsDC($getLang);
	
	
	
	// ----------------------------------------
	// SIDEBAR CONTACTS
	// ----------------------------------------
	
	using('toendacms.datacontainer.contactform');
	
	$dcCF = new tcms_dc_contactform();
	$dcCF = $tcms_dcp->getContactformDC($getLang);
	
	if($dcCF->getEnabled()) {
		if($dcCF->getShowContactsInSidebar() 
		&& $id == 'contactform') {
			echo $tcms_html->subTitle(_SIDE_CONTACTS).'<br />';
			
			if($choosenDB == 'xml') {
				$arr_sbc = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_contacts/');
				
				foreach ($arr_sbc as $key => $value) {
					$contacts_xml = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$value,'r');
					$tc_pub = $contacts_xml->readSection('contact', 'published');
					
					if($tc_pub == 1) {
						$csb_name  = $contacts_xml->readSection('contact', 'name');
						$csb_job   = $contacts_xml->readSection('contact', 'position');
						$csb_email = $contacts_xml->readSection('contact', 'email');
						$csb_phone = $contacts_xml->readSection('contact', 'phone');
						
						if($csb_name  == false) { $csb_name  = ''; }
						if($csb_job   == false) { $csb_job   = ''; }
						if($csb_email == false) { $csb_email = ''; }
						if($csb_phone == false) { $csb_phone = ''; }
						
						$csb_name  = $tcms_main->decodeText($csb_name, '2', $c_charset);
						$csb_job   = $tcms_main->decodeText($csb_job, '2', $c_charset);
						$csb_email = $tcms_main->decodeText($csb_email, '2', $c_charset);
						$csb_phone = $tcms_main->decodeText($csb_phone, '2', $c_charset);
						
						echo ( !empty($csb_name)  ? '<strong class="text_normal">'.$csb_name.'</strong><br />' : '' );
						echo ( !empty($csb_job)   ? '<span class="text_small">'.$csb_job.'</span><br />' : '' );
						
						if($cipher_email == 1) {
							echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script><br />' : '' );
						}
						else {
							echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
						}
						
						echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$csb_email.'\', \''.$csb_name.'\');</script><br />' : '' );
						echo ( !empty($csb_phone) ? '<span class="text_normal">'.$csb_phone.'</span><br />' : '' );
						echo '<br />';
					}
				}
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getAll($tcms_db_prefix.'contacts WHERE published=1');
				
				while($sqlARR = $sqlAL->fetchArray($sqlQR)) {
					$csb_name  = $sqlARR['name'];
					$csb_job   = $sqlARR['position'];
					$csb_email = $sqlARR['email'];
					$csb_phone = $sqlARR['phone'];
					
					if($csb_name  == NULL) { $csb_name  = ''; }
					if($csb_job   == NULL) { $csb_job   = ''; }
					if($csb_email == NULL) { $csb_email = ''; }
					if($csb_phone == NULL) { $csb_phone = ''; }
					
					$csb_name  = $tcms_main->decodeText($csb_name, '2', $c_charset);
					$csb_job   = $tcms_main->decodeText($csb_job, '2', $c_charset);
					$csb_email = $tcms_main->decodeText($csb_email, '2', $c_charset);
					$csb_phone = $tcms_main->decodeText($csb_phone, '2', $c_charset);
					
					echo ( !empty($csb_name)  ? '<strong class="text_normal">'.$csb_name.'</strong><br />' : '' );
					echo ( !empty($csb_job)   ? '<span class="text_small">'.$csb_job.'</span><br />' : '' );
					
					if($cipher_email == 1) {
						echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script><br />' : '' );
					}
					else {
						echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
					}
					
					echo ( !empty($csb_phone) ? '<span class="text_normal">'.$csb_phone.'</span><br />' : '' );
					echo '<br />';
				}
			}
			
			echo '<br /><br />';
		}
	}
	
	unset($dcCF);
	
	
	
	
	
	// ----------------------------------------
	// SIDEBAR CONTENT
	// ----------------------------------------
	
	if($id != 'register' 
	&& $id != 'profile' 
	&& $id != 'polls') {
		/*
			PRODUCTS
		*/
		if($id == 'products') {
			if($dcP->getUseSideCategory()) {
				if($choosenDB == 'xml') {
					$arr_products = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_products/');
					
					$count = 0;
					
					/*if($tcms_main->isArray($arr_products)) {
						foreach($arr_products as $key => $value) {
							$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_products/'.$value.'/folderinfo.xml','r');
							$chkAcc   = $menu_xml->readSection('folderinfo', 'access');
							
							if($is_admin == 'Developer' || $is_admin == 'Administrator') { $showAll = true; }
							else {
								if($chkAcc == 'Public' || $chkAcc == 'Protected') { $showAll = true; }
								else { $showAll = false; }
							}
							
							if($showAll == true) {
								$arr_art['name'][$count] = $menu_xml->readSection('folderinfo', 'name');
								$arr_art['date'][$count] = $menu_xml->readSection('folderinfo', 'date');
								$arr_art['desc'][$count] = $menu_xml->readSection('folderinfo', 'desc');
								$arr_art['sort'][$count] = $menu_xml->readSection('folderinfo', 'sort');
								$arr_art['dir'][$count]  = $menu_xml->readSection('folderinfo', 'folder');
								$arr_art['pub'][$count]  = $menu_xml->readSection('folderinfo', 'pub');
								$arr_art['ac'][$count]   = $menu_xml->readSection('folderinfo', 'access');
								
								$arr_art['name'][$count] = $tcms_main->decodeText($arr_art['name'][$count], '2', $c_charset);
								$arr_art['desc'][$count] = $tcms_main->decodeText($arr_art['desc'][$count], '2', $c_charset);
								
								$check_products_amount = $count;
								$count++;
							}
						}
						
						if(is_array($arr_art)) {
							array_multisort(
								$arr_art['sort'], SORT_ASC, 
								$arr_art['name'], SORT_ASC, 
								$arr_art['date'], SORT_ASC, 
								$arr_art['desc'], SORT_ASC, 
								$arr_art['dir'], SORT_ASC, 
								$arr_art['pub'], SORT_ASC, 
								$arr_art['ac'], SORT_ASC
							);
						}
					}*/
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					switch($is_admin) {
						case 'Developer':
						case 'Administrator':
							$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
							break;
						
						case 'User':
						case 'Editor':
						case 'Presenter':
							$strAdd = " OR access = 'Protected' ) ";
							break;
						
						default:
							$strAdd = ' ) ';
							break;
					}
					
					$sqlSTR = "SELECT uid, name, category "
					."FROM ".$tcms_db_prefix."products "
					."WHERE sql_type='c' "
					."AND ( access = 'Public' "
					.$strAdd
					."ORDER BY name ASC, sort ASC";
					
					$sqlQR = $sqlAL->query($sqlSTR);
					
					$count = 0;
					
					while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
						$arr_art['uid'][$count]  = $sqlObj->uid;
						$arr_art['name'][$count] = $sqlObj->name;
						$arr_art['cat'][$count]  = $sqlObj->category;
						
						if($arr_art['uid'][$count]  == NULL) { $arr_art['uid'][$count]  = ''; }
						if($arr_art['name'][$count] == NULL) { $arr_art['name'][$count] = ''; }
						if($arr_art['cat'][$count]  == NULL) { $arr_art['cat'][$count]  = ''; }
						
						$arr_art['name'][$count] = $tcms_main->decodeText($arr_art['name'][$count], '2', $c_charset);
						
						$count++;
						$check_products_amount = $count;
					}
				}
				
				if($dcP->getUseSideCategory()) {
					echo $tcms_html->subTitle($dcP->getSidebarCategoryTitle());
				}
				
				echo '<div class="sidemain">';
				
				if($check_products_amount > 0) {
					foreach($arr_art['uid'] as $key => $value) {
						//if($arr_art['cat'][$key] == '') {
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=products&amp;s='.$s
							.'&amp;action=showall&amp;cmd=browse'
							.'&amp;category='.$arr_art['uid'][$key]
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							//echo '<span class="newsCategories">';
							
							echo '<span style="padding-left: 6px;" class="text_normal">&raquo; '
							.'<a href="'.$link.'">'.$arr_art['name'][$key].'</a>'
							.'</strong>'
							.'<br />';
							
							/*$subElement = $tcms_main->getArrayElement(
								$arr_art, 
								'category', 
								$arr_art['uid'][$key], 
								'name'
							);
							
							if($subElement != '') {
								echo '<span class="text_normal">'
								.'&nbsp;&nbsp;<a href="'.$link.'">'.$subElement.'</a>'
								.'</span>'
								.'<br />';
							}*/
						//}
					}
				}
				
				echo '</div>';
				
				echo '<br />';
				//.'<br />';
			}
		}
		
		
		
		/*
			STATIC CONTENT
		*/
		if($seDC->getShowSidebarTitle()) {
			if($id != 'contactform') {// && $id != 'products') {
				if($choosenDB == 'xml') {
					if(file_exists(_TCMS_PATH.'/tcms_sidebar/'.$id.'.xml')) {
						$show_sbt_ever = true;
					}
					else {
						$show_sbt_ever = false;
					}
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$sqlQR = $sqlAL->getAll($tcms_db_prefix."sidebar WHERE uid='".$id."'");
					$sqlNR = $sqlAL->getNumber($sqlQR);
					
					if($sqlNR != 0) {
						$show_sbt_ever = true;
					}
					else {
						$show_sbt_ever = false;
					}
				}
				
				if($show_sbt_ever == true) {
					echo $tcms_html->subTitle($seDC->getSidebarTitle());
				}
			}
		}
		
		
		if($choosenDB == 'xml') {
			if(file_exists(_TCMS_PATH.'/tcms_sidebar/'.$id.'.xml')) {
				$sidexml = new xmlparser(_TCMS_PATH.'/tcms_sidebar/'.$id.'.xml','r');
				$sb_title   = $sidexml->readSection('side', 'title');
				$sb_key     = $sidexml->readSection('side', 'key');
				$sb_content = $sidexml->readSection('side', 'content');
				$sb_foot    = $sidexml->readSection('side', 'foot');
				
				// CHARSETS
				$sb_title   = $tcms_main->decodeText($sb_title, '2', $c_charset);
				$sb_key     = $tcms_main->decodeText($sb_key, '2', $c_charset);
				$sb_content = $tcms_main->decodeText($sb_content, '2', $c_charset);
				$sb_foot    = $tcms_main->decodeText($sb_foot, '2', $c_charset);
				
				// TCMS SCRIPT
				
				$toendaScript = new toendaScript($sb_key);
				$sb_key = $toendaScript->doParse();
				$sb_key = $toendaScript->checkSEO($sb_key, $imagePath);
				unset($toendaScript);
				
				$toendaScript = new toendaScript($sb_content);
				$sb_content = $toendaScript->doParse();
				$sb_content = $toendaScript->checkSEO($sb_content, $imagePath);
				unset($toendaScript);
				
				$toendaScript = new toendaScript($sb_foot);
				$sb_foot = $toendaScript->doParse();
				$sb_foot = $toendaScript->checkSEO($sb_foot, $imagePath);
				unset($toendaScript);
				
				echo ( $sb_title != '' ? '<strong class="sideheading">'.$sb_title.'</strong><br />' : '' );
				echo '<div class="sidemain">';
				echo ( $sb_key != '' ? $sb_key.'<br />' : '' );
				echo ( $sb_content != '' ? $sb_content.'<br />' : '' );
				echo ( $sb_foot != '' ? $sb_foot : '' );
				echo '</div>';
				
				echo '<br /><br />';
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getOne($tcms_db_prefix.'sidebar', $id);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$sb_title   = $sqlObj->title;
			$sb_key     = $sqlObj->key;
			$sb_content = $sqlObj->content;
			$sb_foot    = $sqlObj->foot;
			
			if($sb_title   == NULL) { $sb_title   = ''; }
			if($sb_key     == NULL) { $sb_key     = ''; }
			if($sb_content == NULL) { $sb_content = ''; }
			if($sb_foot    == NULL) { $sb_foot    = ''; }
			
			if($sqlNR > 0) {
				// CHARSETS
				$sb_title   = $tcms_main->decodeText($sb_title, '2', $c_charset);
				$sb_key     = $tcms_main->decodeText($sb_key, '2', $c_charset);
				$sb_content = $tcms_main->decodeText($sb_content, '2', $c_charset);
				$sb_foot    = $tcms_main->decodeText($sb_foot, '2', $c_charset);
				
				// TCMS SCRIPT
				$toendaScript = new toendaScript($sb_key);
				$sb_key = $toendaScript->doParse();
				$sb_key = $toendaScript->checkSEO($sb_key, $imagePath);
				unset($toendaScript);
				
				$toendaScript = new toendaScript($sb_content);
				$sb_content = $toendaScript->doParse();
				$sb_content = $toendaScript->checkSEO($sb_content, $imagePath);
				unset($toendaScript);
				
				$toendaScript = new toendaScript($sb_foot);
				$sb_foot = $toendaScript->doParse();
				$sb_foot = $toendaScript->checkSEO($sb_foot, $imagePath);
				unset($toendaScript);
				
				echo ( $sb_title != '' ? '<strong class="sideheading">'.$sb_title.'</strong><br />' : '' );
				echo '<div class="sidemain">';
				echo ( $sb_key != '' ? $sb_key.'<br />' : '' );
				echo ( $sb_content != '' ? $sb_content.'<br />' : '' );
				echo ( $sb_foot != '' ? $sb_foot : '' );
				echo '</div>';
				
				echo '<br />';
			}
		}
	}
	
	// cleanup
	unset($seDC);
	unset($dcP);
}

?>
