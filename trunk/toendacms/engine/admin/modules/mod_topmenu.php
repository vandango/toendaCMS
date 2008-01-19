<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Top Menu Manager
|
| File:	mod_topmenu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Top Menu Manager
 *
 * This module is used for the topmenu items.
 *
 * @version 0.6.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['re'])){ $re = $_GET['re']; }
if(isset($_GET['newType'])){ $newType = $_GET['newType']; }
if(isset($_GET['odot'])){ $odot = $_GET['odot']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }

if(isset($_POST['new_tm_name'])){ $new_tm_name = $_POST['new_tm_name']; }
if(isset($_POST['new_tm_id'])){ $new_tm_id = $_POST['new_tm_id']; }
if(isset($_POST['new_tm_link'])){ $new_tm_link = $_POST['new_tm_link']; }
if(isset($_POST['new_tm_type'])){ $new_tm_type = $_POST['new_tm_type']; }
if(isset($_POST['new_tm_pub'])){ $new_tm_pub = $_POST['new_tm_pub']; }
if(isset($_POST['new_tm_access'])){ $new_tm_access = $_POST['new_tm_access']; }
if(isset($_POST['new_tm_target'])){ $new_tm_target = $_POST['new_tm_target']; }
if(isset($_POST['language'])){ $language = $_POST['language']; }




//=====================================================
// INIT
//=====================================================

if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
	if(!isset($todo))
		$todo = 'show';
	
	
	
	//=====================================================
	// SHOW OLD VALUES
	//=====================================================
	
	if($todo == 'show'){
		echo tcms_html::bold(_TOPMENU_TITLE);
		echo tcms_html::text(_TOPMENU_TEXT.'<br /><br />', 'left');
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_topmenu/');
			
			if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
				foreach($arr_filename as $key => $value){
					$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$value,'r');
					$arr_top_menu['tag'][$key]    = substr($value, 0, 5);
					$arr_top_menu['name'][$key]   = $menu_xml->read_section('top', 'name');
					$arr_top_menu['id'][$key]     = $menu_xml->read_section('top', 'id');
					$arr_top_menu['access'][$key] = $menu_xml->read_section('top', 'access');
					$arr_top_menu['type'][$key]   = $menu_xml->read_section('top', 'type');
					$arr_top_menu['link'][$key]   = $menu_xml->read_section('top', 'link');
					$arr_top_menu['pub'][$key]    = $menu_xml->read_section('top', 'published');
					$arr_top_menu['lang'][$key]   = $menu_xml->read_section('top', 'language');
					
					if(!$arr_top_menu['name'][$key])  { $arr_top_menu['name'][$key]   = ''; }
					//if(!$arr_top_menu['id'][$key])    { $arr_top_menu['id'][$key]     = ''; }
					if(!$arr_top_menu['access'][$key]){ $arr_top_menu['access'][$key] = ''; }
					if(!$arr_top_menu['link'][$key])  { $arr_top_menu['link'][$key]   = ''; }
					if(!$arr_top_menu['type'][$key])  { $arr_top_menu['type'][$key]   = ''; }
					if(!$arr_top_menu['pub'][$key])   { $arr_top_menu['pub'][$key]    = ''; }
					
					// CHARSETS
					$arr_top_menu['name'][$key] = $tcms_main->decodeText($arr_top_menu['name'][$key], '2', $c_charset);
					
					$checkReorder = $key;
				}
			}
			
			if(is_array($arr_top_menu)){
				array_multisort(
					$arr_top_menu['id'], SORT_ASC, 
					$arr_top_menu['name'], SORT_ASC, 
					$arr_top_menu['link'], SORT_ASC, 
					$arr_top_menu['access'], SORT_ASC, 
					$arr_top_menu['pub'], SORT_ASC, 
					$arr_top_menu['type'], SORT_ASC, 
					$arr_top_menu['tag'], SORT_ASC, 
					$arr_top_menu['lang'], SORT_ASC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
				$strAdd = "";
			}
			else{
				$strAdd = "AND ( autor = '".$id_username."' OR autor = '".$id_name."' ) ";
			}
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."topmenu "
			."WHERE NOT (uid IS NULL) "
			.$strAdd
			."ORDER BY id ASC, name ASC, link ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$arr_top_menu['tag'][$count]    = trim($sqlObj->uid);
				$arr_top_menu['name'][$count]   = trim($sqlObj->name);
				$arr_top_menu['id'][$count]     = trim($sqlObj->id);
				$arr_top_menu['access'][$count] = trim($sqlObj->access);
				$arr_top_menu['link'][$count]   = trim($sqlObj->link);
				$arr_top_menu['type'][$count]   = trim($sqlObj->type);
				$arr_top_menu['pub'][$count]    = trim($sqlObj->published);
				$arr_top_menu['lang'][$count]   = trim($sqlObj->language);
				
				if($arr_top_menu['name'][$count]   == NULL){ $arr_top_menu['name'][$count]   = ''; }
				if($arr_top_menu['id'][$count]     == NULL){ $arr_top_menu['id'][$count]     = ''; }
				if($arr_top_menu['access'][$count] == NULL){ $arr_top_menu['access'][$count] = ''; }
				if($arr_top_menu['link'][$count]   == NULL){ $arr_top_menu['link'][$count]   = ''; }
				if($arr_top_menu['type'][$count]   == NULL){ $arr_top_menu['type'][$count]   = ''; }
				if($arr_top_menu['pub'][$count]    == NULL){ $arr_top_menu['pub'][$count]    = ''; }
				
				// CHARSETS
				$arr_top_menu['name'][$count] = $tcms_main->decodeText($arr_top_menu['name'][$count], '2', $c_charset);
				
				$checkReorder = $count;
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="50%" align="left">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_REORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_ORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TCMS_LANGUAGE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_TYPE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_LINK.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_ENABLED.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_MACCESS.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th></tr>';
		
		if(isset($arr_top_menu['id']) && !empty($arr_top_menu['id']) && $arr_top_menu['id'] != ''){
			foreach ($arr_top_menu['id'] as $key => $value){
				if(is_integer($key/2)){ $wsc = 0; }
				else{ $wsc = 1; }
				
				$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=edit&amp;maintag='.$arr_top_menu['tag'][$key].'\';"';
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$arr_color[$wsc].'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
				
				echo '<td class="tcms_db_2"'.$strJS.'>'
				.'<img border="0" src="../images/menu.png" style="padding-right: 3px;" />'
				.$arr_top_menu['name'][$key]
				.'</td>';
				
				
				$check_mover = 0;
				
				echo '<td class="tcms_db_2" align="center">';
				
				if($checkReorder > 0){
					if($key > $check_mover){ echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=reorder&amp;action=up&amp;id='.$arr_top_menu['tag'][$key].'&amp;re='.$arr_top_menu['tag'][$key - 1].'"><img src="../images/up.gif" border="0" title="'._EXPLORE_UP.'" alt="'._EXPLORE_UP.'" /></a>'; }
					else{ echo '<img src="../images/px.png" width="15" height="15" border="0" />'; }
					
					if($key > ($check_mover - 1) && ($checkReorder - 1 >= $key)){ echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=reorder&amp;action=down&amp;id='.$arr_top_menu['tag'][$key].'&amp;re='.$arr_top_menu['tag'][$key + 1].'"><img src="../images/down.gif" border="0" title="'._EXPLORE_DOWN.'" alt="'._EXPLORE_DOWN.'" /></a>'; }
					else{ echo '<img src="../images/px.png" width="15" height="15" border="0" />'; }
				}
				else{ echo '&nbsp;'; }
				
				echo '</td>';
				
				
				echo '<td class="tcms_db_2" align="center"'.$strJS.'>'
				.$arr_top_menu['id'][$key]
				.'</td>';
				
				echo '<td class="tcms_db_2"'.$strJS.'>'
				.$tcms_main->getLanguageNameByTCMSLanguageCode($languages, $arr_top_menu['lang'][$key])
				.'</td>';
				
				echo '<td class="tcms_db_2" align="center"'.$strJS.'>';
					switch(trim($arr_top_menu['type'][$key])){
						case 'title': echo _TABLE_MENUTITLE; break;
						case 'link': echo _TABLE_MENULINK; break;
						case 'web': echo _TABLE_MENUWEB; break;
						default: echo '-'; break;
					}
				echo '</td>';
				
				echo '<td class="tcms_db_2" align="left"'.$strJS.'>'
				.$tcms_main->cutStringToLength($arr_top_menu['link'][$key], 15, '...')
				.'</td>';
				
				echo '<td class="tcms_db_2" align="center">'
				.'<a href="admin.php?id_user='.$id_user.'&site=mod_topmenu&todo=publishItem&action='.( $arr_top_menu['pub'][$key] == 1 ? 'off' : 'on' ).'&maintag='.$arr_top_menu['tag'][$key].'">'
				.( $arr_top_menu['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</td></a>';
				
				echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_top_menu['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';"'.$strJS.'>'
				.$arr_top_menu['access'][$key]
				.'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=edit&amp;maintag='.$arr_top_menu['tag'][$key].'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'"'
				.' href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=delete&amp;maintag='.$arr_top_menu['tag'][$key].'"'
				.' onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	//=====================================================
	// EDIT
	//=====================================================
	if($todo == 'edit'){
		if(isset($maintag) && !empty($maintag) && $maintag != ''){
			if($choosenDB == 'xml'){
				if(!isset($newType)){
					$user_xml = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml','r');
					$tm_name   = $user_xml->read_value('name');
					$tm_id     = $user_xml->read_value('id');
					$tm_link   = $user_xml->read_value('link');
					$tm_pub    = $user_xml->read_value('published');
					$tm_type   = $user_xml->read_value('type');
					$tm_access = $user_xml->read_value('access');
					$tm_target = $user_xml->read_value('target');
					$tm_lang   = $user_xml->read_value('language');
				}
				
				if($tm_name == false)   { $tm_name   = ''; }
				if($tm_link == false)   { $tm_link   = ''; }
				if($tm_pub == false)    { $tm_pub    = ''; }
				if($tm_type == false)   { $tm_type   = ''; }
				if($tm_access == false) { $tm_access = ''; }
				if($tm_target == false) { $tm_target = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'topmenu', $maintag);
				$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
				
				$tm_name   = trim($sqlObj->name);
				$tm_id     = trim($sqlObj->id);
				$tm_link   = trim($sqlObj->link);
				$tm_type   = trim($sqlObj->type);
				$tm_pub    = trim($sqlObj->published);
				$tm_access = trim($sqlObj->access);
				$tm_target = trim($sqlObj->target);
				$tm_lang   = trim($sqlObj->language);
				
				if($tm_name   == NULL){ $tm_name   = ''; }
				if($tm_id     == NULL){ $tm_id     = ''; }
				if($tm_link   == NULL){ $tm_link   = ''; }
				if($tm_pub    == NULL){ $tm_pub    = ''; }
				if($tm_access == NULL){ $tm_access = ''; }
				if($tm_type   == NULL){ $tm_type   = ''; }
				if($tm_target == NULL){ $tm_target = ''; }
			}
			
			$tm_name = $tcms_main->decodeText($tm_name, '2', $c_charset);
			
			if(!isset($newType)){ $newType = $tm_type; }
			if(!isset($odot)){ $odot = 'save'; }
				
			echo tcms_html::bold(_TABLE_EDIT);
			$show_dropdown = false;
		}
		else{
			$tm_name   = '';
			$tm_id     = '';
			$tm_link   = '';
			$tm_pub    = '';
			$tm_type   = 'link';
			$tm_access = '';
			$tm_target = '';
			$tm_lang   = $tcms_config->getLanguageFrontend();
			
			$maintag = $tcms_main->getNewUID(5, 'topmenu');
			
			echo tcms_html::bold(_TABLE_NEW);
			
			if(!isset($odot)){ $odot = 'next'; }
			
			$newType = 'link';
			$show_dropdown = true;
		}
		
		$tm_name = htmlspecialchars($tm_name);
		
		
		$width = '200';
		
		echo tcms_html::text(_TOPMENU_TEXT.'<br /><br />', 'left');
		
		
		// form begin
		echo '<form action="admin.php?id_user='.$id_user.'&site=mod_topmenu" method="post">'
		.'<input name="todo" type="hidden" value="'.$odot.'" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
		
		if(!$tcms_config->useContentLanguage()) {
			echo '<input name="language" type="hidden" value="'.$tm_lang.'" />';
		}
		
		
		// table title
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
		echo '</tr></table>';
		
		
		// table head
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// row
		if($tcms_config->useContentLanguage()) {
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="language" name="language">';
			
			foreach($languages['code'] as $key => $value) {
				if($value != $tcms_config->getLanguageCode(true)) {
					if($tm_lang == $value) {
						$dl = ' selected="selected"';
					}
					else {
						$dl = '';
					}
					
					echo '<option value="'.$value.'"'.$dl.'>'
					.$languages['name'][$key]
					.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
		}
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TYPE.'</strong>'
		.'</td><td valign="top">'
		.'<select name="new_tm_type" class="tcms_select" onchange="ajaxChangeTopmenuType(this.value);">'
			.'<option'.( $newType == 'link' ? ' selected' : '' ).' value="link">'._TABLE_MENULINK.'</option>'
			.'<option'.( $newType == 'web' ? ' selected' : '' ).' value="web">'._TABLE_MENUWEB.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_tm_name" type="text" value="'.$tm_name.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ENABLED.'</strong></td>'
		.'<td valign="top"><input name="new_tm_pub" type="checkbox"'.( $tm_pub == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ORDER.'</strong></td>'
		.'<td valign="top"><input class="tcms_id_box" name="new_tm_id" type="text" value="'.$tm_id.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong id="sm_type_title" class="tcms_bold">'._TABLE_LINKTO.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_tm_link" id="tm_type_intern" class="tcms_select" style="display:'.( $tm_type == 'link' ? 'block' : 'none' ).';">'
			.'<option selected value="new_page"> &bull; '._TABLE_NEW.' &bull; </option>';
			if(isset($tm_link) && !empty($tm_link) && $tm_link != ''){
				echo '<option selected value="'.$tm_link.'">'.$tm_link.'</option>';
			}
			foreach($arr_linkcom['link'] as $key => $value){
				echo '<option value="'.$value.'">'.$arr_linkcom['name'][$key].'</option>';
			}
		echo '</select>'
		.'<input class="tcms_input_small" id="tm_type_extern" name="nothing" style="display:'.( $tm_type == 'web' ? 'block' : 'none' ).';" type="text" value="'.$tm_link.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_tm_access" class="tcms_select">'
			.'<option value="Public"'.( $tm_access == 'Public' ? ' selected' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $tm_access == 'Protected' ? ' selected' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $tm_access == 'Private' ? ' selected' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TARGET.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_tm_target" class="tcms_select">'
			.'<option value="_blank"'.( $tm_target == '_blank' ? ' selected="selected"' : '' ).'>_blank</option>'
			.'<option value="_self"'.( $tm_target == '_self' ? ' selected="selected"' : '' ).'>_self</option>'
			.'<option value=""'.( $tm_target == '' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.'</option>'
		.'</select></td></tr>';
		
		
		// table end
		echo '</table>';
		
		echo '</form>';
	}
	
	
	
	
	
	//=====================================================
	// SAVE
	//=====================================================
	
	if($todo == 'save'){
		if($new_tm_pub == '' || !isset($new_tm_pub)){ $new_tm_pub = '0'; }
		
		// CHARSETS
		$new_tm_name    = $tcms_main->encodeText($new_tm_name, '2', $c_charset);
		
		
		if(trim($new_tm_link) == 'new_page'){
			if($choosenDB == 'xml'){
				while(($new_tm_link=substr(md5(time()),0,5)) && file_exists(_TCMS_PATH.'/tcms_content/'.$new_tm_link.'.xml')){};
				
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_content/'.$new_tm_link.'.xml', 'w');
				$xmluser->xml_c_declaration($c_charset);
				$xmluser->xml_section('main');
				
				$xmluser->write_value('title', $new_tm_name);
				$xmluser->write_value('key', '');
				$xmluser->write_value('content00', '');
				$xmluser->write_value('content01', '');
				$xmluser->write_value('foot', '');
				$xmluser->write_value('id', $new_tm_link);
				$xmluser->write_value('db_layout', '');
				$xmluser->write_value('access', $new_tm_access);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('main');
			}
			else{
				$new_tm_link = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'content', 5);
				
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`title`, `access`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'title, "access"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[titl]e, [access]';
						break;
				}
				
				$newSQLData = "'".$new_tm_name."', 'Public'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'content', $newSQLColumns, $newSQLData, $new_tm_link);
			}
		}
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('top');
			
			$xmluser->write_value('name', $new_tm_name);
			$xmluser->write_value('id', $new_tm_id);
			$xmluser->write_value('type', $new_tm_type);
			$xmluser->write_value('link', $new_tm_link);
			$xmluser->write_value('published', $new_tm_pub);
			$xmluser->write_value('access', $new_tm_access);
			$xmluser->write_value('target', $new_tm_target);
			$xmluser->write_value('language', $language);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('top');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'topmenu.name="'.$new_tm_name.'", '
			.$tcms_db_prefix.'topmenu.id='.$new_tm_id.', '
			.$tcms_db_prefix.'topmenu.type="'.$new_tm_type.'", '
			.$tcms_db_prefix.'topmenu.link="'.$new_tm_link.'", '
			.$tcms_db_prefix.'topmenu.published='.$new_tm_pub.', '
			.$tcms_db_prefix.'topmenu.access="'.$new_tm_access.'", '
			.$tcms_db_prefix.'topmenu.language="'.$language.'", '
			.$tcms_db_prefix.'topmenu.target="'.$new_tm_target.'"';
			
			$sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $maintag);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\'</script>';
	}
	
	
	
	
	
	//=====================================================
	// NEW
	//=====================================================
	
	if($todo == 'next'){
		if($new_tm_pub == '' || !isset($new_tm_pub)){ $new_tm_pub = '0'; }
		
		if($new_tm_id == '' || !isset($new_tm_id) || empty($new_tm_id)){
			if($choosenDB == 'xml'){
				$max_files = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_topmenu/');
				$new_tm_id = count($max_files) + 1;
			}
			else{
				$new_tm_id = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'topmenu', 'id');
			}
		}
		
		// CHARSETS
		$new_tm_name = $tcms_main->encodeText($new_tm_name, '2', $c_charset);
		
		if(trim($new_tm_link) == 'new_page'){
			$new_tm_link = $tcms_main->getNewUID(5, 'content');
			
			if($choosenDB == 'xml'){
				if($language != $tcms_config->getLanguageFrontend()) {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_content_languages/'.$new_tm_link.'.xml', 
						'w'
					);
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_tm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_tm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_tm_access);
					$xmluser->write_value('language', $language);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
				else {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_content/'.$new_tm_link.'.xml', 
						'w'
					);
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_tm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_tm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_tm_access);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`title`, `access`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'title, "access"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[title], [access]';
						break;
				}
				
				$newSQLData = "'".$new_tm_name."', '".$new_tm_access."'";
				
				if($language != $tcms_config->getLanguageFrontend()) {
					switch($choosenDB){
						case 'mysql':
							$newSQLColumns .= ', `language`';
							break;
						
						case 'pgsql':
							$newSQLColumns .= ', "language"';
							break;
						
						case 'mssql':
							$newSQLColumns .= ', [language]';
							break;
					}
					
					$newSQLData .= ", '".$language."'";
					
					$sqlQR = $sqlAL->sqlCreateOne(
						$tcms_db_prefix.'content_languages', 
						$newSQLColumns, 
						$newSQLData, 
						$new_tm_link
					);
				}
				else {
					$sqlQR = $sqlAL->sqlCreateOne(
						$tcms_db_prefix.'content', 
						$newSQLColumns, 
						$newSQLData, 
						$new_tm_link
					);
				}
			}
		}
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('top');
			
			$xmluser->write_value('name', $new_tm_name);
			$xmluser->write_value('id', $new_tm_id);
			$xmluser->write_value('type', $new_tm_type);
			$xmluser->write_value('link', $new_tm_link);
			$xmluser->write_value('published', $new_tm_pub);
			$xmluser->write_value('access', $new_tm_access);
			$xmluser->write_value('target', $new_tm_target);
			$xmluser->write_value('language', $language);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('top');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`name`, `id`, `type`, `link`, `published`, `access`, `target`, `language`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, id, "type", link, published, "access", "target", "language"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [id], [type], [link], [published], [access], [target], [language]';
					break;
			}
			
			$newSQLData = "'".$new_tm_name."', ".$new_tm_id.", '".$new_tm_type."', '"
			.$new_tm_link."', ".$new_tm_pub.", '".$new_tm_access."', '".$new_tm_target."', '".$language."'";
			
			$sqlAL->sqlCreateOne($tcms_db_prefix.'topmenu', $newSQLColumns, $newSQLData, $maintag);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\'</script>';
	}
	
	
	
	
	
	//===================================================================================
	// PUBLISH / UNPUBLISH
	//===================================================================================
	
	if($todo == 'publishItem'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml', 'published', '1', '0'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'topmenu.published=0';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\';</script>';
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml', 'published', '0', '1'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'topmenu.published=1';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\';</script>';
				break;
		}
	}
	
	
	
	
	
	//===================================================================================
	// REORDER
	//===================================================================================
	
	if($todo == 'reorder'){
		switch($action){
			// MOVE ENTRY + 1
			case 'up':
				if($choosenDB == 'xml'){
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$id.'.xml','r');
					$mainorderID = $reorderXML->read_section('top', 'id');
					
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$re.'.xml','r');
					$reorderID = $reorderXML->read_section('top', 'id');
					
					xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$id.'.xml', 'id', $mainorderID, $reorderID);
					xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$re.'.xml', 'id', $reorderID, $mainorderID);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'topmenu', $id);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$mainorderID = $sqlARR['id'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'topmenu', $re);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$reorderID = $sqlARR['id'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'topmenu.id='.$reorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $id);
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'topmenu.id='.$mainorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $re);
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\';</script>';
				
				break;
			
			// MOVE ENTRY - 1
			case 'down':
				if($choosenDB == 'xml'){
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$id.'.xml','r');
					$mainorderID = $reorderXML->read_section('top', 'id');
					
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$re.'.xml','r');
					$reorderID = $reorderXML->read_section('top', 'id');
					
					xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$id.'.xml', 'id', $mainorderID, $reorderID);
					xmlparser::edit_value(_TCMS_PATH.'/tcms_topmenu/'.$re.'.xml', 'id', $reorderID, $mainorderID);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'topmenu', $id);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$mainorderID = $sqlARR['id'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'topmenu', $re);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$reorderID = $sqlARR['id'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'topmenu.id='.$reorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $id);
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'topmenu.id='.$mainorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'topmenu', $newSQLData, $re);
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\';</script>';
				
				break;
		}
	}
	
	
	
	
	
	//===================================================================================
	// DELETE
	//===================================================================================
	
	if($todo == 'delete'){
		if($choosenDB == 'xml'){ unlink(_TCMS_PATH.'/tcms_topmenu/'.$maintag.'.xml'); }
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'topmenu', $maintag);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_topmenu\''
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
