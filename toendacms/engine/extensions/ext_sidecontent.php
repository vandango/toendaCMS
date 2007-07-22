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
| File:	ext_sidecontent.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar
 *
 * This module provides the sidebar functionality.
 *
 * @version 0.5.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */





// ----------------------------------------
// INIT
// ----------------------------------------

if($use_sidebar == 1){
	if($choosenDB == 'xml'){
		$use_side_xml  = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$sidebar_title = $use_side_xml->readSection('side', 'sidebar_title');
		$show_sbt      = $use_side_xml->readSection('side', 'show_sidebar_title');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$sidebar_title = $sqlObj->sidebar_title;
		$show_sbt      = $sqlObj->show_sidebar_title;
	}
	
	
	$sidebar_title = $tcms_main->decodeText($sidebar_title, '2', $c_charset);
}





// ----------------------------------------
// SIDEBAR CONTACTS
// ----------------------------------------

if($cform_enabled == 1) {
	if($show_cisb == 1 && $id == 'contactform') {
		echo $tcms_html->subTitle(_SIDE_CONTACTS).'<br />';
		
		if($choosenDB == 'xml'){
			$arr_sbc = $tcms_main->getPathContent($tcms_administer_site.'/tcms_contacts/');
			
			foreach ($arr_sbc as $key => $value){
				$contacts_xml = new xmlparser($tcms_administer_site.'/tcms_contacts/'.$value,'r');
				$tc_pub = $contacts_xml->readSection('contact', 'published');
				
				if($tc_pub == 1){
					$csb_name  = $contacts_xml->readSection('contact', 'name');
					$csb_job   = $contacts_xml->readSection('contact', 'position');
					$csb_email = $contacts_xml->readSection('contact', 'email');
					$csb_phone = $contacts_xml->readSection('contact', 'phone');
					
					if($csb_name  == false){ $csb_name  = ''; }
					if($csb_job   == false){ $csb_job   = ''; }
					if($csb_email == false){ $csb_email = ''; }
					if($csb_phone == false){ $csb_phone = ''; }
					
					$csb_name  = $tcms_main->decodeText($csb_name, '2', $c_charset);
					$csb_job   = $tcms_main->decodeText($csb_job, '2', $c_charset);
					$csb_email = $tcms_main->decodeText($csb_email, '2', $c_charset);
					$csb_phone = $tcms_main->decodeText($csb_phone, '2', $c_charset);
					
					echo ( !empty($csb_name)  ? '<strong class="text_normal">'.$csb_name.'</strong><br />' : '' );
					echo ( !empty($csb_job)   ? '<span class="text_small">'.$csb_job.'</span><br />' : '' );
					
					if($cipher_email == 1){
						echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script><br />' : '' );
					}
					else{
						echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
					}
					
					echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$csb_email.'\', \''.$csb_name.'\');</script><br />' : '' );
					echo ( !empty($csb_phone) ? '<span class="text_normal">'.$csb_phone.'</span><br />' : '' );
					echo '<br />';
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getAll($tcms_db_prefix.'contacts WHERE published=1');
			
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
				$csb_name  = $sqlARR['name'];
				$csb_job   = $sqlARR['position'];
				$csb_email = $sqlARR['email'];
				$csb_phone = $sqlARR['phone'];
				
				if($csb_name  == NULL){ $csb_name  = ''; }
				if($csb_job   == NULL){ $csb_job   = ''; }
				if($csb_email == NULL){ $csb_email = ''; }
				if($csb_phone == NULL){ $csb_phone = ''; }
				
				$csb_name  = $tcms_main->decodeText($csb_name, '2', $c_charset);
				$csb_job   = $tcms_main->decodeText($csb_job, '2', $c_charset);
				$csb_email = $tcms_main->decodeText($csb_email, '2', $c_charset);
				$csb_phone = $tcms_main->decodeText($csb_phone, '2', $c_charset);
				
				echo ( !empty($csb_name)  ? '<strong class="text_normal">'.$csb_name.'</strong><br />' : '' );
				echo ( !empty($csb_job)   ? '<span class="text_small">'.$csb_job.'</span><br />' : '' );
				
				if($cipher_email == 1){
					echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script><br />' : '' );
				}
				else{
					echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
				}
				
				echo ( !empty($csb_phone) ? '<span class="text_normal">'.$csb_phone.'</span><br />' : '' );
				echo '<br />';
			}
		}
		
		echo '<br /><br />';
	}
}





// ----------------------------------------
// SIDEBAR CONTENT
// ----------------------------------------

if($id != 'register' 
&& $id != 'profile' 
&& $id != 'polls'){
	/*
		PRODUCTS
	*/
	if($id == $products_id) {
		if($use_sidebar_categories == 1) {
			if($choosenDB == 'xml') {
				$arr_products = $tcms_main->getPathContent($tcms_administer_site.'/tcms_products/');
				
				$count = 0;
				
				/*if($tcms_main->isArray($arr_products)){
					foreach($arr_products as $key => $value){
						$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
						$chkAcc   = $menu_xml->readSection('folderinfo', 'access');
						
						if($is_admin == 'Developer' || $is_admin == 'Administrator'){ $showAll = true; }
						else{
							if($chkAcc == 'Public' || $chkAcc == 'Protected'){ $showAll = true; }
							else{ $showAll = false; }
						}
						
						if($showAll == true){
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
					
					if(is_array($arr_art)){
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
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($is_admin){
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
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)){
					$arr_art['uid'][$count]  = $sqlObj->uid;
					$arr_art['name'][$count] = $sqlObj->name;
					$arr_art['cat'][$count]  = $sqlObj->category;
					
					if($arr_art['uid'][$count]  == NULL){ $arr_art['uid'][$count]  = ''; }
					if($arr_art['name'][$count] == NULL){ $arr_art['name'][$count] = ''; }
					if($arr_art['cat'][$count]  == NULL){ $arr_art['cat'][$count]  = ''; }
					
					$arr_art['name'][$count] = $tcms_main->decodeText($arr_art['name'][$count], '2', $c_charset);
					
					$count++;
					$check_products_amount = $count;
				}
			}
			
			if($show_pro_ct == 1){
				$category_title = $tcms_main->decodeText($category_title, '2', $c_charset);
				echo $tcms_html->subTitle($category_title);
			}
			
			echo '<div class="sidemain">';
			
			if($check_products_amount > 0) {
				foreach($arr_art['uid'] as $key => $value) {
					//if($arr_art['cat'][$key] == '') {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=products&amp;s='.$s
						.'&ampaction=showall&amp;cmd=browse'
						.'&amp;category='.$arr_art['uid'][$key]
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<strong class="text_normal">'
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
	if($use_sidebar == 1) {
		if($show_sbt == 1) {
			if($id != 'contactform') {// && $id != 'products'){
				if($choosenDB == 'xml') {
					if(file_exists($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml')) {
						$show_sbt_ever = true;
					}
					else {
						$show_sbt_ever = false;
					}
				}
				else{
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
					echo $tcms_html->subTitle($sidebar_title);
				}
			}
		}
		
		
		if($choosenDB == 'xml') {
			if(file_exists($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml')){
				$sidexml = new xmlparser($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml','r');
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
				$sb_key = $toendaScript->toendaScript_trigger();
				
				$toendaScript = new toendaScript($sb_content);
				$sb_content = $toendaScript->toendaScript_trigger();
				$sb_content = $toendaScript->checkSEO($sb_content, $imagePath);
				
				$toendaScript = new toendaScript($sb_foot);
				$sb_foot = $toendaScript->toendaScript_trigger();
				
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
			
			if($sb_title   == NULL){ $sb_title   = ''; }
			if($sb_key     == NULL){ $sb_key     = ''; }
			if($sb_content == NULL){ $sb_content = ''; }
			if($sb_foot    == NULL){ $sb_foot    = ''; }
			
			if($sqlNR > 0) {
				// CHARSETS
				$sb_title   = $tcms_main->decodeText($sb_title, '2', $c_charset);
				$sb_key     = $tcms_main->decodeText($sb_key, '2', $c_charset);
				$sb_content = $tcms_main->decodeText($sb_content, '2', $c_charset);
				$sb_foot    = $tcms_main->decodeText($sb_foot, '2', $c_charset);
				
				// TCMS SCRIPT
				$toendaScript = new toendaScript($sb_key);
				$sb_key = $toendaScript->toendaScript_trigger();
				
				$toendaScript = new toendaScript($sb_content);
				$sb_content = $toendaScript->toendaScript_trigger();
				$sb_content = $toendaScript->checkSEO($sb_content, $imagePath);
				
				$toendaScript = new toendaScript($sb_foot);
				$sb_foot = $toendaScript->toendaScript_trigger();
				
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
}

?>
