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
| File:		ext_sidecontent.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar
 *
 * This module provides the sidebar functionality.
 *
 * @version 0.4.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_sidebar == 1){
	if($choosenDB == 'xml'){
		$use_side_xml  = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$sidebar_title = $use_side_xml->read_section('side', 'sidebar_title');
		$show_sbt      = $use_side_xml->read_section('side', 'show_sidebar_title');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$sidebar_title = $sqlARR['sidebar_title'];
		$show_sbt      = $sqlARR['show_sidebar_title'];
	}
	
	
	$sidebar_title = $tcms_main->decodeText($sidebar_title, '2', $c_charset);
}





if($cform_enabled == 1){
	if($show_cisb == 1 && $id == 'contactform'){
		echo tcms_html::subtitle(_SIDE_CONTACTS).'<br />';
		
		if($choosenDB == 'xml'){
			$arr_sbc = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_contacts/');
			foreach ($arr_sbc as $key => $value){
				$contacts_xml = new xmlparser($tcms_administer_site.'/tcms_contacts/'.$value,'r');
				$tc_pub = $contacts_xml->read_section('contact', 'published');
				
				if($tc_pub == 1){
					$csb_name  = $contacts_xml->read_section('contact', 'name');
					$csb_job   = $contacts_xml->read_section('contact', 'position');
					$csb_email = $contacts_xml->read_section('contact', 'email');
					$csb_phone = $contacts_xml->read_section('contact', 'phone');
					
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
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetALL($tcms_db_prefix.'contacts WHERE published=1');
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
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






if($id != 'register' && $id != 'profile' && $id != 'polls'){
	/**************************************
	* load data from XML to sidebar
	*/
	if($id == $products_id){
		//===================================
		// PRODUCTS
		//===================================
		
		if($choosenDB == 'xml'){
			$arr_products = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_products/');
			
			$count = 0;
			
			if(isset($arr_products) && !empty($arr_products) && $arr_products != ''){
				foreach($arr_products as $key => $value){
					$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
					$chkAcc   = $menu_xml->read_section('folderinfo', 'access');
					
					if($is_admin == 'Developer' || $is_admin == 'Administrator'){ $showAll = true; }
					else{
						if($chkAcc == 'Public' || $chkAcc == 'Protected'){ $showAll = true; }
						else{ $showAll = false; }
					}
					
					if($showAll == true){
						$arr_art['name'][$count] = $menu_xml->read_section('folderinfo', 'name');
						$arr_art['date'][$count] = $menu_xml->read_section('folderinfo', 'date');
						$arr_art['desc'][$count] = $menu_xml->read_section('folderinfo', 'desc');
						$arr_art['sort'][$count] = $menu_xml->read_section('folderinfo', 'sort');
						$arr_art['dir'][$count]  = $menu_xml->read_section('folderinfo', 'folder');
						$arr_art['pub'][$count]  = $menu_xml->read_section('folderinfo', 'pub');
						$arr_art['ac'][$count]   = $menu_xml->read_section('folderinfo', 'access');
						
						$arr_art['name'][$count] = $tcms_main->decodeText($arr_art['name'][$count], '2', $c_charset);
						$arr_art['desc'][$count] = $tcms_main->decodeText($arr_art['desc'][$count], '2', $c_charset);
						
						$check_products_amount = $count;
						$count++;
					}
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
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
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."products "
			."WHERE sql_type='d' "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort DESC, date DESC, name DESC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_art['name'][$count]  = $sqlARR['name'];
				$arr_art['date'][$count]  = $sqlARR['date'];
				$arr_art['desc'][$count]  = $sqlARR['desc'];
				$arr_art['sort'][$count]  = $sqlARR['sort'];
				$arr_art['dir'][$count]   = $sqlARR['category'];
				$arr_art['pub'][$count]   = $sqlARR['status'];
				$arr_art['ac'][$count]    = $sqlARR['access'];
				
				if($arr_art['name'][$count] == NULL){ $arr_art['name'][$count] = ''; }
				if($arr_art['date'][$count] == NULL){ $arr_art['date'][$count] = ''; }
				if($arr_art['desc'][$count] == NULL){ $arr_art['desc'][$count] = ''; }
				if($arr_art['sort'][$count] == NULL){ $arr_art['sort'][$count] = ''; }
				if($arr_art['dir'][$count]  == NULL){ $arr_art['dir'][$count]  = ''; }
				if($arr_art['pub'][$count]  == NULL){ $arr_art['pub'][$count]  = ''; }
				if($arr_art['ac'][$count]   == NULL){ $arr_art['ac'][$count]   = ''; }
				
				$arr_art['name'][$count] = $tcms_main->decodeText($arr_art['name'][$count], '2', $c_charset);
				$arr_art['desc'][$count] = $tcms_main->decodeText($arr_art['desc'][$count], '2', $c_charset);
				
				$count++;
				$check_products_amount = $count;
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
		
		if($show_pro_ct == 1){
			$category_title = $tcms_main->decodeText($category_title, '2', $c_charset);
			echo tcms_html::subtitle($category_title);
		}
		
		echo '<div class="sidemain">';
		
		if($check_products_amount > 0){
			foreach($arr_art['sort'] as $key => $value){
				if($arr_art['pub'][$key] == 1){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=products&amp;s='.$s.'&amp;category='.$arr_art['dir'][$key]
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<strong class="text_normal"><a href="'.$link.'">'.$arr_art['name'][$key].'</a></strong><br />';
					echo ( trim($arr_art['desc'][$key]) == '' ? '' : '<span class="text_small">'.$arr_art['desc'][$key].'</span><br />' );
				}
			}
		}
		
		echo '</div>';
		
		echo '<br /><br />';
	}
	
	
	
	
	if($use_sidebar == 1){
		if($show_sbt == 1){
			if($id != 'contactform' && $id != 'products'){
				if($choosenDB == 'xml'){
					if(file_exists($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml')){ $show_sbt_ever = true; }
					else{ $show_sbt_ever = false; }
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."sidebar WHERE uid='".$id."'");
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					if($sqlNR != 0){ $show_sbt_ever = true; }
					else{ $show_sbt_ever = false; }
				}
				
				if($show_sbt_ever == true){
					echo tcms_html::subtitle($sidebar_title);
				}
			}
		}
		
		
		//===================================
		// CONTENTS
		//===================================
		
		if($choosenDB == 'xml'){
			if(file_exists($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml')){
				$sidexml = new xmlparser($tcms_administer_site.'/tcms_sidebar/'.$id.'.xml','r');
				$sb_title   = $sidexml->read_section('side', 'title');
				$sb_key     = $sidexml->read_section('side', 'key');
				$sb_content = $sidexml->read_section('side', 'content');
				$sb_foot    = $sidexml->read_section('side', 'foot');
				
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
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar', $id);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$sb_title   = $sqlARR['title'];
			$sb_key     = $sqlARR['key'];
			$sb_content = $sqlARR['content'];
			$sb_foot    = $sqlARR['foot'];
			
			if($sb_title   == NULL){ $sb_title   = ''; }
			if($sb_key     == NULL){ $sb_key     = ''; }
			if($sb_content == NULL){ $sb_content = ''; }
			if($sb_foot    == NULL){ $sb_foot    = ''; }
			
			if($sqlNR > 0){
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
	}
}

?>
