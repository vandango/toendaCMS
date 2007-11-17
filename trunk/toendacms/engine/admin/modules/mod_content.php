<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Static Content Manager
|
| File:	mod_content.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Static Content Manager
 *
 * This module is used as a documents manager.
 *
 * @version 1.1.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['db_layout'])){ $db_layout = $_GET['db_layout']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['val'])){ $val = $_GET['val']; }
if(isset($_GET['sender'])){ $sender = $_GET['sender']; }

if(isset($_POST['titel'])){ $titel = $_POST['titel']; }
if(isset($_POST['key'])){ $key = $_POST['key']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['tmp_content01'])){ $tmp_content01 = $_POST['tmp_content01']; }
if(isset($_POST['content01'])){ $content01 = $_POST['content01']; }
if(isset($_POST['foot'])){ $foot = $_POST['foot']; }
if(isset($_POST['new_id'])){ $new_id = $_POST['new_id']; }
if(isset($_POST['db_layout'])){ $db_layout = $_POST['db_layout']; }
if(isset($_POST['access'])){ $access = $_POST['access']; }
if(isset($_POST['new_in_work'])){ $new_in_work = $_POST['new_in_work']; }
if(isset($_POST['new_published'])){ $new_published = $_POST['new_published']; }
if(isset($_POST['new_autor'])){ $new_autor = $_POST['new_autor']; }
if(isset($_POST['sender'])){ $sender = $_POST['sender']; }
if(isset($_POST['original'])){ $original = $_POST['original']; }
if(isset($_POST['language'])){ $language = $_POST['language']; }




// -----------------------------------------------------
// INIT
// -----------------------------------------------------

if($id_group == 'Developer' 
|| $id_group == 'Administrator' 
|| $id_group == 'Writer'){
	echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>'
	.'<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />'
	.'<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';
	
	
	if($show_wysiwyg == 'tinymce') {
		echo '<script language="JavaScript" src="../js/dhtml.js"></script>';
		echo '<style>.tableRowLight{ background-color: #ececec; }.tableRowDark{ background-color: #333333; }</style>';
		
		include('../tcms_kernel/tcms_tinyMCE.lib.php');
		
		$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
		$tcms_tinyMCE->initTinyMCE();
	}
	
	
	
	/*
		init
	*/
	
	if(!isset($todo)){ $todo = 'show'; }
	if(!isset($check)){ $check = ''; }
	
	$arr_farbe[0] = $arr_color[0];
	$arr_farbe[1] = $arr_color[1];
	$bgkey = 0;
	
	
	
	/*
		load data
	*/
	
	if($choosenDB == 'xml') {
		$arr_filename  = $tcms_main->getPathContent(
			'../../'.$tcms_administer_site.'/tcms_content/'
		);
	}
	
	if(isset($arr_all) && !empty($arr_all) && $arr_all != '') {
		sort($arr_all);
	}
	
	
	
	/*
		display
	*/
	
	if($todo == 'show') {
		echo $tcms_html->bold(_CONTENT_TITLE);
		echo $tcms_html->text(_CONTENT_TEXT.'<br /><br />', 'left');
		
		$count = 0;
		
		if($choosenDB == 'xml'){
			if($tcms_main->isArray($arr_filename)) {
				foreach($arr_filename as $key => $value) {
					$main_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$value, 'r');
					$arr_content['tag'][$key]    = substr($value, 0, 5);
					$arr_content['title'][$key]  = $main_xml->readSection('main', 'title');
					$arr_content['id'][$key]     = $main_xml->readSection('main', 'id');
					$arr_content['access'][$key] = $main_xml->readSection('main', 'access');
					$arr_content['pub'][$key]    = $main_xml->readSection('main', 'published');
					$arr_content['autor'][$key]  = $main_xml->readSection('main', 'autor');
					$arr_content['inw'][$key]    = $main_xml->readSection('main', 'in_work');
					
					if(!$arr_content['title'][$key]) { $arr_content['title'][$key]  = ''; }
					if(!$arr_content['id'][$key])    { $arr_content['id'][$key]     = ''; }
					if(!$arr_content['access'][$key]){ $arr_content['access'][$key] = ''; }
					if(!$arr_content['pub'][$key])   { $arr_content['pub'][$key]    = ''; }
					if(!$arr_content['autor'][$key]) { $arr_content['autor'][$key]  = ''; }
					if(!$arr_content['inw'][$key])   { $arr_content['inw'][$key]    = ''; }
					
					$arr_content['title'][$key] = $tcms_main->decodeText($arr_content['title'][$key], '2', $c_charset);
					
					$count++;
				}
			}
			
			$arr_filename  = $tcms_main->getPathContent(
				'../../'.$tcms_administer_site.'/tcms_content_languages/'
			);
			
			if($tcms_main->isArray($arr_filename)) {
				foreach($arr_filename as $key => $value) {
					$main_xml = new xmlparser(
						'../../'.$tcms_administer_site.'/tcms_content_languages/'.$value, 'r'
					);
					
					$arr_content['title'][$count]  = $main_xml->readSection('main', 'title');
					$arr_content['id'][$count]     = $main_xml->readSection('main', 'id');
					$arr_content['access'][$count] = $main_xml->readSection('main', 'access');
					$arr_content['pub'][$count]    = $main_xml->readSection('main', 'published');
					$arr_content['autor'][$count]  = $main_xml->readSection('main', 'autor');
					$arr_content['inw'][$count]    = $main_xml->readSection('main', 'in_work');
					
					$obj_lang = $main_xml->readSection('main', 'language');
					$obj_uid  = $main_xml->readSection('main', 'content_uid');
					
					$arr_content['tag'][$count] = substr($value, 0, 5).$obj_lang;
					
					if(!$arr_content['title'][$count]) { $arr_content['title'][$count]  = ''; }
					if(!$arr_content['id'][$count])    { $arr_content['id'][$count]     = ''; }
					if(!$arr_content['access'][$count]){ $arr_content['access'][$count] = ''; }
					if(!$arr_content['pub'][$count])   { $arr_content['pub'][$count]    = ''; }
					if(!$arr_content['autor'][$count]) { $arr_content['autor'][$count]  = ''; }
					if(!$arr_content['inw'][$count])   { $arr_content['inw'][$count]    = ''; }
					
					$arr_content['title'][$count] = $tcms_main->decodeText($arr_content['title'][$count], '2', $c_charset);
					
					$arr_content['title'][$count] .= ' ('.$obj_lang.' / '.$obj_uid.')';
					
					$count++;
				}
			}
			
			if(is_array($arr_content)){
				array_multisort(
					$arr_content['title'], SORT_DESC, 
					$arr_content['id'], SORT_DESC, 
					$arr_content['tag'], SORT_DESC, 
					$arr_content['pub'], SORT_DESC, 
					$arr_content['autor'], SORT_DESC, 
					$arr_content['inw'], SORT_DESC, 
					$arr_content['access'], SORT_DESC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			// get docs
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."content "
			."WHERE NOT (uid IS NULL) "
			."ORDER BY title ASC, uid ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$arr_content['tag'][$count]    = $sqlObj->uid;
				$arr_content['title'][$count]  = $sqlObj->title;
				$arr_content['id'][$count]     = $sqlObj->uid;
				$arr_content['access'][$count] = $sqlObj->access;
				$arr_content['pub'][$count]    = $sqlObj->published;
				$arr_content['autor'][$count]  = $sqlObj->autor;
				$arr_content['inw'][$count]    = $sqlObj->in_work;
				
				if($arr_content['tag'][$count]    == NULL){ $arr_content['tag'][$count]    = ''; }
				if($arr_content['title'][$count]  == NULL){ $arr_content['title'][$count]  = ''; }
				if($arr_content['id'][$count]     == NULL){ $arr_content['id'][$count]     = ''; }
				if($arr_content['access'][$count] == NULL){ $arr_content['access'][$count] = ''; }
				if($arr_content['pub'][$count]    == NULL){ $arr_content['pub'][$count]    = ''; }
				if($arr_content['autor'][$count]  == NULL){ $arr_content['autor'][$count]  = ''; }
				if($arr_content['inw'][$count]    == NULL){ $arr_content['inw'][$count]    = ''; }
				
				// CHARSETS
				$arr_content['title'][$count] = $tcms_main->decodeText($arr_content['title'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
			
			// get languages
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."content_languages "
			."WHERE NOT (uid IS NULL) "
			."ORDER BY title ASC, uid ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)) {
				$arr_content['tag'][$count]    = $sqlObj->uid.$sqlObj->language;
				
				$arr_content['title'][$count]  = $sqlObj->title
				.' ('.$sqlObj->language.' / '.$sqlObj->content_uid.')';
				
				$arr_content['id'][$count]     = $sqlObj->uid;
				$arr_content['access'][$count] = $sqlObj->access;
				$arr_content['pub'][$count]    = $sqlObj->published;
				$arr_content['autor'][$count]  = $sqlObj->autor;
				$arr_content['inw'][$count]    = $sqlObj->in_work;
				
				if($arr_content['tag'][$count]    == NULL){ $arr_content['tag'][$count]    = ''; }
				if($arr_content['title'][$count]  == NULL){ $arr_content['title'][$count]  = ''; }
				if($arr_content['id'][$count]     == NULL){ $arr_content['id'][$count]     = ''; }
				if($arr_content['access'][$count] == NULL){ $arr_content['access'][$count] = ''; }
				if($arr_content['pub'][$count]    == NULL){ $arr_content['pub'][$count]    = ''; }
				if($arr_content['autor'][$count]  == NULL){ $arr_content['autor'][$count]  = ''; }
				if($arr_content['inw'][$count]    == NULL){ $arr_content['inw'][$count]    = ''; }
				
				// CHARSETS
				$arr_content['title'][$count] = $tcms_main->decodeText($arr_content['title'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
			
			if(is_array($arr_content)){
				array_multisort(
					$arr_content['title'], SORT_ASC, 
					$arr_content['id'], SORT_ASC, 
					$arr_content['tag'], SORT_ASC, 
					$arr_content['pub'], SORT_ASC, 
					$arr_content['autor'], SORT_ASC, 
					$arr_content['inw'], SORT_ASC, 
					$arr_content['access'], SORT_ASC
				);
			}
			
			/*
			// get docs
			$sqlSTR = "CREATE TABLE tmp_c SELECT * FROM ".$tcms_db_prefix."content AS c; "
			."INSERT INTO tmp_c (uid, title, access, published, autor, in_work) "
			."SELECT cl.uid, "
			."CONCAT(cl.title, ' (', cl.language, ' / ', cl.content_uid, ')'), "
			."cl.access, cl.published, cl.autor, cl.in_work "
			."FROM ".$tcms_db_prefix."content_languages AS cl; "
			."SELECT * FROM tmp_c ORDER by title ASC;";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$arr_content['tag'][$count]    = $sqlObj->uid;
				$arr_content['title'][$count]  = $sqlObj->title;
				$arr_content['id'][$count]     = $sqlObj->uid;
				$arr_content['access'][$count] = $sqlObj->access;
				$arr_content['pub'][$count]    = $sqlObj->published;
				$arr_content['autor'][$count]  = $sqlObj->autor;
				$arr_content['inw'][$count]    = $sqlObj->in_work;
				
				if($arr_content['tag'][$count]    == NULL){ $arr_content['tag'][$count]    = ''; }
				if($arr_content['title'][$count]  == NULL){ $arr_content['title'][$count]  = ''; }
				if($arr_content['id'][$count]     == NULL){ $arr_content['id'][$count]     = ''; }
				if($arr_content['access'][$count] == NULL){ $arr_content['access'][$count] = ''; }
				if($arr_content['pub'][$count]    == NULL){ $arr_content['pub'][$count]    = ''; }
				if($arr_content['autor'][$count]  == NULL){ $arr_content['autor'][$count]  = ''; }
				if($arr_content['inw'][$count]    == NULL){ $arr_content['inw'][$count]    = ''; }
				
				// CHARSETS
				$arr_content['title'][$count] = $tcms_main->decodeText($arr_content['title'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlDeleteTable('tmp_c');
			$sqlAL->sqlFreeResult($sqlQR);
			*/
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="2%" colspan="2">&nbsp;</th>'
			.'<th valign="middle" class="tcms_db_title" width="58%" align="left">'._TABLE_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_ORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_PUBLISHED.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_IN_WORK.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="center">'._TABLE_ACCESS.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th>'
			.'</tr>';
		
		if(isset($arr_content['id']) && !empty($arr_content['id']) && $arr_content['id'] != ''){
			foreach($arr_content['id'] as $key => $value){
				$bgkey++;
				if(is_integer($bgkey/2)) {
					$ws_farbe = $arr_farbe[0];
				}
				else {
					$ws_farbe = $arr_farbe[1];
				}
				
				if(strlen($arr_content['tag'][$key]) > 5) {
					$wsLang = substr($arr_content['tag'][$key], 5);
					$arr_content['tag'][$key] = substr($arr_content['tag'][$key], 0, 5);
					
					$wsLang = '&amp;lang='.$tcms_config->getLanguageCodeByTCMSCode($wsLang);
				}
				else {
					$wsLang = '';
				}
				
				$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_content'
				.'&amp;todo=edit&amp;maintag='.$arr_content['tag'][$key].$wsLang.'\';"';
				
				$ws_link='&amp;val='.$key;
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$ws_farbe.'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')">';
				
				echo '<td colspan="2" class="tcms_db_2" width="20"'.$strJS.'>'
				.'<img border="0" src="../images/page.png" />'
				.'</td>';
				
				echo '<td class="tcms_db_2" '.$strJS.'>'
				.$arr_content['title'][$key]
				.'</td>';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
				.( trim($arr_content['tag'][$key]) == '' ? '&nbsp;' : $arr_content['tag'][$key] )
				.'</td>';
				
				echo '<td align="left" class="tcms_db_2"'.$strJS.'>'
				.( trim($arr_content['autor'][$key]) == '' ? '&nbsp;' : $arr_content['autor'][$key] )
				.'</td>';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
				.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=publishItem&amp;action='.( $arr_content['pub'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_content['tag'][$key].$wsLang.'">'
				.( $arr_content['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a>'
				.'</td>';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
				.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=finalize&amp;action='.( $arr_content['inw'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_content['tag'][$key].$wsLang.'">'
				.( $arr_content['inw'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a>'
				.'</td>';
				
				echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_content['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';"'.$strJS.'>'
				.$arr_content['access'][$key]
				.'</td>';
				
				echo '<td class="tcms_db_2" align="right">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content'
				.'&amp;todo=edit&amp;maintag='.$arr_content['tag'][$key].$wsLang.'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" '
				.'border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content'
				.'&amp;todo=delete&amp;maintag='.$arr_content['tag'][$key].'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" '
				.'border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	//=====================================================
	// FORM
	//=====================================================
	
	if($todo == 'edit'){
		$bFileless = false;
		
		if(isset($maintag)) {
			if($choosenDB == 'xml'){
				$val = 0;
				
				if($tcms_main->isReal($lang)) {
					$main_xml = new xmlparser(
						'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml','r'
					);
				}
				else {
					$main_xml = new xmlparser(
						'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml','r'
					);
				}
				
				$arr_content['title'][$val]     = $main_xml->readSection('main', 'title');
				$arr_content['key'][$val]       = $main_xml->readSection('main', 'key');
				$arr_content['text0'][$val]     = $main_xml->readSection('main', 'content00');
				$arr_content['text1'][$val]     = $main_xml->readSection('main', 'content01');
				$arr_content['foot'][$val]      = $main_xml->readSection('main', 'foot');
				$arr_content['id'][$val]        = $main_xml->readSection('main', 'id');
				//$arr_content['db_layout'][$val] = $main_xml->readSection('main', 'db_layout');
				$arr_content['access'][$val]    = $main_xml->readSection('main', 'access');
				$arr_content['autor'][$val]     = $main_xml->readSection('main', 'autor');
				$arr_content['pub'][$val]       = $main_xml->readSection('main', 'published');
				$arr_content['inw'][$val]       = $main_xml->readSection('main', 'in_work');
				
				if($tcms_main->isReal($lang)) {
					$arr_content['lang'][$val]      = $main_xml->readSection('main', 'language');
					$arr_content['orgiginal'][$val] = $main_xml->readSection('main', 'content_uid');
					
					if($arr_content['lang'][$val] == null) {
						$arr_content['lang'][$val] = $tcms_config->getLanguageCode(true);
					}
					
					if($arr_content['orgiginal'][$val] == null) {
						$arr_content['orgiginal'][$val] = '';
					}
				}
				
				if(!$arr_content['title'][$val])     { $arr_content['title'][$val]     = ''; }
				if(!$arr_content['key'][$val])       { $arr_content['key'][$val]       = ''; }
				if(!$arr_content['text0'][$val])     { $arr_content['text0'][$val]     = ''; }
				if(!$arr_content['text1'][$val])     { $arr_content['text1'][$val]     = ''; }
				if(!$arr_content['foot'][$val])      { $arr_content['foot'][$val]      = ''; }
				if(!$arr_content['id'][$val])        { $arr_content['id'][$val]        = ''; }
				//if(!$arr_content['db_layout'][$val]) { $arr_content['db_layout'][$val] = ''; }
				if(!$arr_content['access'][$val])    { $arr_content['access'][$val]    = ''; }
				if(!$arr_content['autor'][$val])     { $arr_content['autor'][$val]     = ''; }
				if(!$arr_content['pub'][$val])       { $arr_content['pub'][$val]       = ''; }
				if(!$arr_content['inw'][$val])       { $arr_content['inw'][$val]       = ''; }
				
				if(!isset($db_layout)){ $db_layout = $arr_content['db_layout'][$val]; }
			}
			else {
				$val = 0;
				
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				if($tcms_main->isReal($lang)) {
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content_languages', $maintag);
				}
				else {
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $maintag);
				}
				
				$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
				
				$arr_content['title'][$val]     = $sqlObj->title;
				$arr_content['key'][$val]       = $sqlObj->key;
				$arr_content['text0'][$val]     = $sqlObj->content00;
				$arr_content['text1'][$val]     = $sqlObj->content01;
				$arr_content['foot'][$val]      = $sqlObj->foot;
				$arr_content['id'][$val]        = $sqlObj->uid;
				//$arr_content['db_layout'][$val] = $sqlObj->db_layout;
				$arr_content['access'][$val]    = $sqlObj->access;
				$arr_content['autor'][$val]     = $sqlObj->autor;
				$arr_content['pub'][$val]       = $sqlObj->published;
				$arr_content['inw'][$val]       = $sqlObj->in_work;
				
				if($tcms_main->isReal($lang)) {
					$arr_content['lang'][$val]      = $sqlObj->language;
					$arr_content['orgiginal'][$val] = $sqlObj->content_uid;
					
					if($arr_content['lang'][$val] == null) {
						$arr_content['lang'][$val] = $tcms_config->getLanguageCode(true);
					}
					
					if($arr_content['orgiginal'][$val] == null) {
						$arr_content['orgiginal'][$val] = '';
					}
				}
				
				if($arr_content['title'][$val]     == NULL){ $arr_content['title'][$val]     = ''; }
				if($arr_content['key'][$val]       == NULL){ $arr_content['key'][$val]       = ''; }
				if($arr_content['text0'][$val]     == NULL){ $arr_content['text0'][$val]     = ''; }
				if($arr_content['text1'][$val]     == NULL){ $arr_content['text1'][$val]     = ''; }
				if($arr_content['foot'][$val]      == NULL){ $arr_content['foot'][$val]      = ''; }
				if($arr_content['id'][$val]        == NULL){ $arr_content['id'][$val]        = ''; }
				//if($arr_content['db_layout'][$val] == NULL){ $arr_content['db_layout'][$val] = ''; }
				if($arr_content['access'][$val]    == NULL){ $arr_content['access'][$val]    = ''; }
				if($arr_content['autor'][$val]     == NULL){ $arr_content['autor'][$val]     = ''; }
				if($arr_content['pub'][$val]       == NULL){ $arr_content['pub'][$val]       = ''; }
				if($arr_content['inw'][$val]       == NULL){ $arr_content['inw'][$val]       = ''; }
				
				if(!isset($db_layout)) {
					$db_layout = $arr_content['db_layout'][$val];
				}
			}
		}
		else {
			$val = 0;
			
			$arr_content['title'][$val] = '';
			$arr_content['key'][$val] = '';
			$arr_content['text0'][$val] = '';
			$arr_content['text1'][$val] = '';
			$arr_content['foot'][$val] = '';
			$arr_content['id'][$val] = '';
			//$arr_content['db_layout'][$val] = '';
			$arr_content['access'][$val] = '';
			$arr_content['autor'][$val] = '';
			$arr_content['pub'][$val] = 0;
			$arr_content['inw'][$val] = 0;
			
			if($tcms_main->isReal($lang)) {
				$arr_content['lang'][$val] = $tcms_config->getLanguageCode(true);
				$arr_content['orgiginal'][$val] = '';
			}
			
			if(!isset($db_layout)) {
				$db_layout = $arr_content['db_layout'][$val];
			}
			
			$bFileless = true;
		}
		
		// CHARSETS
		$arr_content['title'][$val] = $tcms_main->decodeText($arr_content['title'][$val], '2', $c_charset);
		$arr_content['key'][$val]   = $tcms_main->decodeText($arr_content['key'][$val], '2', $c_charset);
		$arr_content['text0'][$val] = $tcms_main->decodeText($arr_content['text0'][$val], '2', $c_charset);
		$arr_content['text1'][$val] = $tcms_main->decodeText($arr_content['text1'][$val], '2', $c_charset);
		$arr_content['foot'][$val]  = $tcms_main->decodeText($arr_content['foot'][$val], '2', $c_charset);
		
		$arr_content['title'][$val] = htmlspecialchars($arr_content['title'][$val]);
		$arr_content['key'][$val]   = htmlspecialchars($arr_content['key'][$val]);
		$arr_content['foot'][$val]  = htmlspecialchars($arr_content['foot'][$val]);
		
		
		if($show_wysiwyg == 'tinymce'){
			$arr_content['text0'][$val] = stripslashes($arr_content['text0'][$val]);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$arr_content['text0'][$val] = str_replace('src="', 'src="../../../../', $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = str_replace('src="../../../../http:', 'src="http:', $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = str_replace('src="../../../../https:', 'src="https:', $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = str_replace('src="../../../../ftp:', 'src="ftp:', $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = str_replace('src="../../../..//', 'src="/', $arr_content['text0'][$val]);
		}
		else{
			$arr_content['text0'][$val] = ereg_replace('<br />'.chr(10), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br />'.chr(13), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br />', chr(13), $arr_content['text0'][$val]);
			
			$arr_content['text0'][$val] = ereg_replace('<br/>'.chr(10), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br/>'.chr(13), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br/>', chr(13), $arr_content['text0'][$val]);
			
			$arr_content['text0'][$val] = ereg_replace('<br>'.chr(10), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br>'.chr(13), chr(13), $arr_content['text0'][$val]);
			$arr_content['text0'][$val] = ereg_replace('<br>', chr(13), $arr_content['text0'][$val]);
		}
		
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$arr_content['text0'][$val] = str_replace('src="', 'src="../../', $arr_content['text0'][$val]);
		}
		
		
		
		if($arr_content['title'][$val] == '') {
			echo $tcms_html->bold(_TABLE_NEW);
		}
		else {
			echo $tcms_html->bold(_TABLE_EDIT);
		}
		
		echo $tcms_html->text(_CONTENT_TEXT_PAGE.'<br /><br />', 'left');
		
		
		
		/*if($db_layout != 'db_content_default.php') {
			echo '<script>'
			.'relocateTo(\'admin.php?id_user='.$id_user.'&site=mod_content&todo=edit'
			.( $tcms_main->isReal($lang) ? '&lang='.$lang : '' )
			.( $tcms_main->isReal($maintag) ? '&maintag='.$maintag : '' )
			.'&db_layout=db_content_default.php\', \'\');'
			.'</script>';
		}*/
		
		
		
		$width = '150';
		if($arr_content['title'][$val] == '') {
			$make = 'next';
		}
		else {
			$make = 'save';
		}
		
		if($bFileless == true) {
			$maintag = $tcms_main->getNewUID(5, 'content');
			$arr_content['id'][$val] = $maintag;//$tcms_main->getNewUID(5, 'content');
		}
		
		
		
		// form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_content" method="post" enctype="multipart/form-data" id="contentPage">'
		.'<input name="todo" type="hidden" value="'.$make.'" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
		.'<input name="new_id" type="hidden" value="'.$arr_content['id'][$val].'" />';
		
		if($tcms_main->isReal($lang)) {
			echo '<input name="lang" type="hidden" value="'.$lang.'" />';
		}
		
		
		/*
			EDIT CONTENT
		*/
		
		/*
			tabpane start
		*/
		
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			text tab
		*/
		
		echo '<div class="tab-page" id="tab-page-text">'
		.'<h2 class="tab">'._TABLE_EDIT.'</h2>'
		.'<table cellpadding="1" cellspacing="5" width="100%" border="0" class="noborder">';
		
		
		if($tcms_main->isReal($lang)) {
			$arr_docs = $tcms_main->getAllDocuments();
			unset($value);
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._CONTENT_ORG_DOCUMENT.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="original" name="original">';
			
			foreach($arr_docs['id'] as $key => $value) {
				if($arr_content['orgiginal'][$val] == $value) {
					$dl = ' selected="selected"';
				}
				else {
					$dl = '';
				}
				
				echo '<option value="'.$value.'"'.$dl.'>'.$arr_docs['name'][$key].'</option>';
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="language" name="language">';
			
			foreach($languages['code'] as $key => $value) {
				if($value != $tcms_config->getLanguageCode(true)) {
					if($arr_content['lang'][$val] == $value)
						$dl = ' selected="selected"';
					else
						$dl = '';
					
					echo '<option value="'.$value.'"'.$dl.'>'
					.$languages['name'][$key]
					.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
		}
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="titel" type="text" value="'.$arr_content['title'][$val].'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_SUBTITLE.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="key" type="text" value="'.$arr_content['key'][$val].'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" colspan="2"><strong class="tcms_bold">'._TABLE_TEXT.' ('._TABLE_ORDER.': '.$arr_content['id'][$val].')</strong>'
		.'<br /><br />'
		.'<script>createToendaToolbar(\'contentPage\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>';
		
		if($show_wysiwyg == 'tinymce'){ }
		elseif($show_wysiwyg == 'fckeditor'){ echo ''._TCMSSCRIPT_MORE.': {tcms_more}'; }
		else{
			if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'contentPage\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else{ echo '<script>createToolbar(\'contentPage\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		echo '</td></tr>'
		.'<tr><td valign="top" colspan="2">';
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'.$arr_content['text0'][$val].'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content');
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $arr_content['text0'][$val];
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'.$arr_content['text0'][$val].'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// table row
		if($db_layout == 'db_content_default.php'){
			// table row
			$content01 = '';
		}
		elseif($db_layout == 'db_content_image.php'){
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._CONTENT_OLDIMAGE.'</strong></td>'
			.'<td valign="top">'
			.'<textarea class="tcms_textarea_normal" name="tmp_content01" type="text">'.$arr_content['text1'][$val].'</textarea>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._CONTENT_IMAGEUNDER.'</strong></td>'
			.'<td><input class="tcms_upload" name="content01" type="file" accept="image/*" />'
			.'</td></tr>';
		}
		elseif($db_layout == 'db_content_image_right.php'){
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._CONTENT_OLDIMAGE.'</strong></td>'
			.'<td valign="top">'
			.'<textarea class="tcms_textarea_normal" name="tmp_content01" type="text">'.$arr_content['text1'][$val].'</textarea>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._CONTENT_IMAGERIGHT.'</strong></td>'
			.'<td valign="top"><input class="tcms_upload" name="content01" type="file" accept="image/*" />'
			.'</td></tr>';
		}
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			settings tab
		*/
		
		echo '<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'
		.'<table cellpadding="1" cellspacing="5" width="100%" border="0" class="noborder">';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
		.'<td valign="top"><input name="new_published" value="1" type="checkbox"'.( $arr_content['pub'][$val] == 1 ? ' checked="checked"' : '' ).' />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_IN_WORK.'</strong></td>'
		.'<td valign="top"><input name="new_in_work" value="1" type="checkbox"'.( $arr_content['inw'][$val] == 1 ? ' checked="checked"' : '' ).' />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_AUTOR.'</strong></td><td valign="top">';
			echo '<select class="tcms_select" name="new_autor">';
			
			if($id_group == 'Developer' || $id_group == 'Administrator'){
				echo '<optgroup label="'._USER_SELF.'">'
				.'<option value="'.$id_username.'"'.( $arr_content['autor'][$val] == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $arr_content['autor'][$val] == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>'
				.'</optgroup>'
				.'<optgroup label="'._USER_ALL.'">';
				
				foreach($arrActiveUser['user'] as $key => $value){
					echo '<option value="'.$value.'"'.( $arr_content['autor'][$val] == $value ? ' selected="selected"' : '').'>'.$value.'</option>';
				}
				
				echo '</optgroup>';
			}
			else{
				echo '<option value="'.$id_username.'"'.( $arr_content['autor'][$val] == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $arr_content['autor'][$val] == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>';
				
				if(isset($arr_content['autor'][$val]) && $arr_content['autor'][$val] != '' && ($arr_content['autor'][$val] != $id_username && $arr_content['autor'][$val] != $id_name)){
					echo '<option value="'.$arr_content['autor'][$val].'" selected="selected">'.$arr_content['autor'][$val].'</option>';
				}
			}
			
			if(isset($arr_content['autor'][$val]) && $arr_content['autor'][$val] != '' && ($arr_content['autor'][$val] != $id_username && $arr_content['autor'][$val] != $id_name)){
				echo '<option value="'.$arr_content['autor'][$val].'" selected="selected">'.$arr_content['autor'][$val].'</option>';
			}
			
			echo '</select>';
		echo '</td></tr>';
		
		
		// table row
		/*
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._CONTENT_TEMPLATE.'</strong>'
		.'</td><td>'
		.'<select name="db_layout" class="tcms_select">';
		// onchange="document.location=\'admin.php?id_user='.$id_user.'&site=mod_content&todo=edit&maintag='.$maintag.'&db_layout=\'+this.value;">';
		
		foreach($arr_db['filename'] as $db_key => $db_value) {
			if($db_value == 'db_content_default.php') {
				echo '<option'.( $db_layout == $db_value ? ' selected' : '' ).' value="'.$db_value.'">'
				.$arr_db['templatename'][$db_key]
				.'</option>';
			}
		}
		
		echo '</select>'
		.'</td></tr>';*/
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td><td>';
			echo '<select name="access" class="tcms_select">';
				echo '<option value="Public"'.( $arr_content['access'][$val] == 'Public' ? ' selected' : '' ).'>'._TABLE_PUBLIC.'</option>';
				echo '<option value="Protected"'.( $arr_content['access'][$val] == 'Protected' ? ' selected' : '' ).'>'._TABLE_PROTECTED.'</option>';
				echo '<option value="Private"'.( $arr_content['access'][$val] == 'Private' ? ' selected' : '' ).'>'._TABLE_PRIVATE.'</option>';
			echo '</select>';
		echo '</td></tr>';
		
		
		// table head
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._CONTENT_FOOT.'</strong>'
		.'</td><td>'
		.'<textarea class="tcms_textarea_big" name="foot" type="text">'.$arr_content['foot'][$val].'</textarea>'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			tabpane end
		*/
		
		echo '</div>'
		.'<script type="text/javascript">'
		.'var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-text"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-set"));'
		.'setupAllTabs();'
		.'</script>'
		.'<br />';
		
		
		/*
			end
		*/
		
		
		echo '</form>';
	}
	
	
	
	
	
	//=====================================================
	// SAVEING
	//=====================================================
	
	if($todo == 'save') {
		if($show_wysiwyg == 'tinymce') {
			$content = stripslashes($content);
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$content = str_replace('../../../../../../../../../', '', $content);
			$content = str_replace('../../../../', '', $content);
		}
		else {
			$content = $tcms_main->nl2br($content);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce') {
			//$content = str_replace('src="../../', 'src="', $content);
		}
		
		
		if($new_published == '' || empty($new_published) || !isset($new_published)){ $new_published = 0; }
		if($new_in_work   == '' || empty($new_in_work)   || !isset($new_in_work))  { $new_in_work   = 0; }
		if($new_autor     == ''){ $new_autor = ''; }
		
		
		if(isset($_FILES['content01']) || isset($content01)){
			if($_FILES['content01']['size'] > 0 && (
			$_FILES['content01']['type'] == 'image/gif' || 
			$_FILES['content01']['type'] == 'image/png' || 
			$_FILES['content01']['type'] == 'image/jpg' || 
			$_FILES['content01']['type'] == 'image/jpeg' || 
			$_FILES['content01']['type'] == 'image/bmp')){
				$fileName = $_FILES['content01']['name'];
				$imgDir = '../../'.$tcms_administer_site.'/images/Image/';
				
				$content01 = $_FILES['content01']['name'];
				
				if(!file_exists('../../'.$tcms_administer_site.'/images/Image/'.$_FILES['content01']['name'])){
					copy($_FILES['content01']['tmp_name'], $imgDir.$fileName);
				}
				
				$msg = _MSG_IMAGE.' "../../'.$tcms_administer_site.'/images/Image/'.$_FILES['content01']['name'].'".';
			}
			else{
				$content01 = $tmp_content01;
				$msg = _MSG_NOIMAGE;
			}
		}
		else{
			$msg = '';
		}
		
		
		// CHARSETS
		$titel     = $tcms_main->encodeText($titel, '2', $c_charset);
		$key       = $tcms_main->encodeText($key, '2', $c_charset);
		$content   = $tcms_main->encodeText($content, '2', $c_charset);
		$content01 = $tcms_main->encodeText($content01, '2', $c_charset);
		$foot      = $tcms_main->encodeText($foot, '2', $c_charset);
		
		
		if($db_layout == ''){ $db_layout = 'db_content_default.php'; }
		if($access == '')   { $access    = 'Public'; }
		
		
		if($choosenDB == 'xml'){
			if($tcms_main->isReal($lang)) {
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 'w');
			}
			else {
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 'w');
			}
			
			$xmluser->xml_c_declaration($c_charset);
			$xmluser->xml_section('main');
			
			$xmluser->write_value('title', $titel);
			$xmluser->write_value('key', $key);
			$xmluser->write_value('content00', $content);
			$xmluser->write_value('content01', $content01);
			$xmluser->write_value('foot', $foot);
			$xmluser->write_value('id', $new_id);
			//$xmluser->write_value('db_layout', $db_layout);
			$xmluser->write_value('access', $access);
			$xmluser->write_value('published', $new_published);
			$xmluser->write_value('autor', $new_autor);
			$xmluser->write_value('in_work', $new_in_work);
			
			if($tcms_main->isReal($lang)) {
				$xmluser->write_value('language', $language);
				$xmluser->write_value('content_uid', $original);
			}
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('main');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($tcms_main->isReal($lang)) {
				$tmp = 'content_languages';
			}
			else {
				$tmp = 'content';
			}
			
			$newSQLData = ''
			.$tcms_db_prefix.$tmp.'.title="'.$titel.'", '
			.$tcms_db_prefix.$tmp.'.key="'.$key.'", '
			.$tcms_db_prefix.$tmp.'.content00="'.$content.'", '
			.$tcms_db_prefix.$tmp.'.content01="'.$content01.'", '
			.$tcms_db_prefix.$tmp.'.foot="'.$foot.'", '
			//.$tcms_db_prefix.$tmp.'.db_layout="'.$db_layout.'", '
			.$tcms_db_prefix.$tmp.'.access="'.$access.'", '
			.$tcms_db_prefix.$tmp.'.autor="'.$new_autor.'", '
			.$tcms_db_prefix.$tmp.'.published='.$new_published.', '
			.$tcms_db_prefix.$tmp.'.in_work='.$new_in_work;
			
			if($tcms_main->isReal($lang)) {
				$newSQLData .= ', '.$tcms_db_prefix.$tmp.'.language="'.$language.'", ';
				$newSQLData .= $tcms_db_prefix.$tmp.'.content_uid="'.$original.'"';
			}
			else {
				$getLang = $tcms_config->getLanguageFrontend();
				$newSQLData .= ', '.$tcms_db_prefix.$tmp.'.language="'.$getLang.'"';
			}
			
			$sqlQR = $sqlAL->sqlUpdateOne(
				$tcms_db_prefix.$tmp, 
				$newSQLData, 
				$maintag
			);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\''
		.'</script>';
	}
	
	
	
	
	
	//===================================================================================
	// CREATE NEW
	//===================================================================================
	
	if($todo == 'next') {
		if($show_wysiwyg == 'tinymce'){
			$content = stripslashes($content);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$content = str_replace('../../../../../../../../../', '', $content);
			$content = str_replace('../../../../', '', $content);
		}
		else{
			$content = $tcms_main->nl2br($content);
		}
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$content = str_replace('src="../../', 'src="', $content);
		}
		
		// CHARSETS
		$titel      = $tcms_main->decode_text($titel, '2', $c_charset);
		$key        = $tcms_main->decode_text($key, '2', $c_charset);
		$content    = $tcms_main->decode_text($content, '2', $c_charset);
		$content01  = $tcms_main->decode_text($content01, '2', $c_charset);
		$foot       = $tcms_main->decode_text($foot, '2', $c_charset);
		
		
		if($new_published == '' || empty($new_published) || !isset($new_published)){ $new_published = 0; }
		if($new_in_work   == '' || empty($new_in_work)   || !isset($new_in_work))  { $new_in_work   = 0; }
		if($new_autor     == ''){ $new_autor = ''; }
		
		
		if($_FILES['content01']['size'] > 0){
			$fileName = $_FILES['content01']['name'];
			$imgDir = '../../'.$tcms_administer_site.'/images/Image/';
			
			$content01 = $_FILES['content01']['name'];
			
			if(!file_exists('../../'.$tcms_administer_site.'/images/Image/'.$_FILES['content01']['name'])){
				copy($_FILES['content01']['tmp_name'], $imgDir.$fileName);
			}
			
			$msg = _MSG_IMAGE.' "../Image/'.$_FILES['content01']['name'].'".';
		}else{
			$content01 = $tmp_content01;
			$msg = _MSG_NOIMAGE;
		}
		
		
		if($choosenDB == 'xml'){
			if($tcms_main->isReal($lang)) {
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 'w');
			}
			else {
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 'w');
			}
			
			$xmluser->xml_c_declaration($c_charset);
			$xmluser->xml_section('main');
			
			$xmluser->write_value('title', $titel);
			$xmluser->write_value('key', $key);
			$xmluser->write_value('content00', $content);
			$xmluser->write_value('content01', $content01);
			$xmluser->write_value('foot', $foot);
			$xmluser->write_value('id', $new_id);
			//$xmluser->write_value('db_layout', $db_layout);
			$xmluser->write_value('access', $access);
			$xmluser->write_value('published', $new_published);
			$xmluser->write_value('autor', $new_autor);
			$xmluser->write_value('in_work', $new_in_work);
			
			if($tcms_main->isReal($lang)) {
				$xmluser->write_value('language', $language);
				$xmluser->write_value('content_uid', $original);
			}
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('main');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`title`, `key`, `content00`, `content01`, `foot`, '
					.'`access`, `autor`, `published`, `in_work`';
					
					if($tcms_main->isReal($lang)) {
						$newSQLColumns .= ', `language`, `content_uid`';
					}
					else {
						$newSQLColumns .= ', `language`';
					}
					break;
				
				case 'pgsql':
					$newSQLColumns = 'title, "key", content00, content01, foot, '
					.'"access", autor, published, in_work';
					
					if($tcms_main->isReal($lang)) {
						$newSQLColumns .= ', "language", content_uid';
					}
					else {
						$newSQLColumns .= ', "language"';
					}
					break;
				
				case 'mssql':
					$newSQLColumns = '[title], [key], [content00], [content01], [foot], '
					.'[access], [autor], [published], [in_work]';
					
					if($tcms_main->isReal($lang)) {
						$newSQLColumns .= ', [language], [content_uid]';
					}
					else {
						$newSQLColumns .= ', [language]';
					}
					break;
			}
			
			$newSQLData = "'".$titel."', '".$key."', '".$content."', '".$content01."', '".$foot."', "
			."'".$access."', '".$new_autor."', ".$new_published.", ".$new_in_work;
			
			if($tcms_main->isReal($lang)) {
				$newSQLData .= ", '".$language."', '".$original."'";
			}
			else {
				$getLang = $tcms_config->getLanguageFrontend();
				$newSQLData .= ", '".$getLang."'";
			}
			
			$sqlQR = $sqlAL->sqlCreateOne(
				( $tcms_main->isReal($lang) ? $tcms_db_prefix.'content_languages' : $tcms_db_prefix.'content'), 
				$newSQLColumns, 
				$newSQLData, 
				$maintag
			);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\''
		.'</script>';
	}
	
	
	
	
	
	//===================================================================================
	// FINALIZE
	//===================================================================================
	
	if($todo == 'finalize'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml') {
					if($tcms_main->isReal($lang)) {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 
							'in_work', 
							'1', 
							'0'
						);
					}
					else {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 
							'in_work', 
							'1', 
							'0'
						);
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if($tcms_main->isReal($lang)) {
						$newSQLData = $tcms_db_prefix.'content_languages.in_work=0';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content_languages', $newSQLData, $maintag);
					}
					else {
						$newSQLData = $tcms_db_prefix.'content.in_work=0';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content', $newSQLData, $maintag);
					}
				}
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';</script>';
				}
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml') {
					if($tcms_main->isReal($lang)) {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 
							'in_work', 
							'0', 
							'1'
						);
					}
					else {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 
							'in_work', 
							'0', 
							'1'
						);
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if($tcms_main->isReal($lang)) {
						$newSQLData = $tcms_db_prefix.'content_languages.in_work=1';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content_languages', $newSQLData, $maintag);
					}
					else {
						$newSQLData = $tcms_db_prefix.'content.in_work=1';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content', $newSQLData, $maintag);
					}
				}
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
					.'</script>';
				}
				else{
					echo '<script type="text/javascript">'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';'
					.'</script>';
				}
				break;
		}
	}
	
	
	
	
	
	//===================================================================================
	// PUBLISH / UNPUBLISH
	//===================================================================================
	
	if($todo == 'publishItem'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml') {
					if($tcms_main->isReal($lang)) {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 
							'published', 
							'1', 
							'0'
						);
					}
					else {
						xmlparser::edit_value(
							'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 
							'published', 
							'1', 
							'0'
						);
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if($tcms_main->isReal($lang)) {
						$newSQLData = $tcms_db_prefix.'content_languages.published=0';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content_languages', $newSQLData, $maintag);
					}
					else {
						$newSQLData = $tcms_db_prefix.'content.published=0';
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content', $newSQLData, $maintag);
					}
				}
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';</script>';
				}
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml'){
					if($check != 'yes'){ $check = 'no'; }
					
					if($check == 'no'){
						if($tcms_main->isReal($lang)) {
							$news_xml = new xmlparser(
								'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml',
								'r'
							);
						}
						else {
							$news_xml = new xmlparser(
								'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml',
								'r'
							);
						}
						
						$checkFinalize = $news_xml->readSection('main', 'in_work');
						
						if($checkFinalize == 0){
							if($sender == 'desktop'){
								$strADD = '&sender=desktop';
							}
							else{
								$strADD = '';
							}
							
							echo '<script type="text/javascript">
							delCheck = confirm("'._MSG_NOT_FINALIZED.'");
							if(delCheck == false){
								document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';
							}
							else{
								document.location=\'admin.php?id_user='.$id_user.'&site=mod_content&todo=publishItem&action=on&maintag='.$maintag.'&check=yes'.$strADD.'\';
							}
							</script>';
						}
						else{ $check = 'yes'; }
					}
					
					if($check == 'yes'){
						if($tcms_main->isReal($lang)) {
							xmlparser::edit_value(
								'../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml', 
								'published', 
								'0', 
								'1'
							);
						}
						else {
							xmlparser::edit_value(
								'../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml', 
								'published', 
								'0', 
								'1'
							);
						}
					}
				}
				else{
					if($check != 'yes'){ $check = 'no'; }
					
					if($check == 'no'){
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						if($tcms_main->isReal($lang)) {
							$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content_languages', $maintag);
						}
						else {
							$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $maintag);
						}
						
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						$checkFinalize = $sqlARR['in_work'];
						
						if($checkFinalize == 0){
							if($sender == 'desktop'){
								$strADD = '&sender=desktop';
							}
							else{
								$strADD = '';
							}
							
							echo '<script type="text/javascript">
							delCheck = confirm("'._MSG_NOT_FINALIZED.'");
							if(delCheck == false){
								document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';
							}
							else{
								document.location=\'admin.php?id_user='.$id_user.'&site=mod_content&todo=publishItem&action=on&maintag='.$maintag.'&check=yes'.$strADD.'\';
							}
							</script>';
						}
						else{ $check = 'yes'; }
					}
					
					if($check == 'yes'){
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						if($tcms_main->isReal($lang)) {
							$newSQLData = $tcms_db_prefix.'content_languages.published=1';
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content_languages', $newSQLData, $maintag);
						}
						else {
							$newSQLData = $tcms_db_prefix.'content.published=1';
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'content', $newSQLData, $maintag);
						}
					}
				}
				
				if($sender == 'desktop') {
					echo '<script type="text/javascript">'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
					.'</script>';
				}
				else {
					echo '<script type="text/javascript">'
					.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';'
					.'</script>';
				}
				break;
		}
	}
	
	
	
	
	
	//===================================================================================
	// DELETE
	//===================================================================================
	
	if($todo == 'delete'){
		if($choosenDB == 'xml'){
			if($tcms_file->checkFileExist('../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml')) {
				$tcms_file->deleteFile('../../'.$tcms_administer_site.'/tcms_content/'.$maintag.'.xml');
			}
			else if($tcms_file->checkFileExist('../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml')) {
				$tcms_file->deleteFile('../../'.$tcms_administer_site.'/tcms_content_languages/'.$maintag.'.xml');
			}
			
			
			$del_menuitem = $tcms_main->xml_readdir_content($maintag, '../../'.$tcms_administer_site.'/tcms_menu/', 'link', 'menu', 5);
			
			if($del_menuitem == '' || empty($del_menuitem) || !isset($del_menuitem)){
				$del_menuitem = $tcms_main->xml_readdir_content($maintag, '../../'.$tcms_administer_site.'/tcms_topmenu/', 'link', 'top', 5);
				unlink('../../'.$tcms_administer_site.'/tcms_topmenu/'.$del_menuitem.'.xml');
			}
			else{
				unlink('../../'.$tcms_administer_site.'/tcms_menu/'.$del_menuitem.'.xml');
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'content', $maintag);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."sidemenu WHERE link='".$maintag."'");
			$del_menuitem = $sqlAL->sqlGetNumber($sqlQR);
			
			if($del_menuitem != 0){
				$sqlAL->sqlDeleteIdv($tcms_db_prefix.'sidemenu', 'link', $maintag);
			}
			else{
				$sqlAL->sqlDeleteIdv($tcms_db_prefix.'topmenu', 'link', $maintag);
			}
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_content\';'
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
