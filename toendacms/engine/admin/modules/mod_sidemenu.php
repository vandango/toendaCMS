<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Side Menu Manager
|
| File:	mod_sidemenu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Side Menu Manager
 *
 * This module is used for the sidemenu items.
 *
 * @version 0.7.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['re'])){ $re = $_GET['re']; }
if(isset($_GET['subItem'])){ $subItem = $_GET['subItem']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['newType'])){ $newType = $_GET['newType']; }

if(isset($_POST['site'])){ $site = $_POST['site']; }
if(isset($_POST['new_sm_name'])){ $new_sm_name = $_POST['new_sm_name']; }
if(isset($_POST['new_sm_id'])){ $new_sm_id = $_POST['new_sm_id']; }
if(isset($_POST['new_sm_subid'])){ $new_sm_subid = $_POST['new_sm_subid']; }
if(isset($_POST['new_sm_parent'])){ $new_sm_parent = $_POST['new_sm_parent']; }
if(isset($_POST['new_sm_type'])){ $new_sm_type = $_POST['new_sm_type']; }
if(isset($_POST['new_sm_link'])){ $new_sm_link = $_POST['new_sm_link']; }
if(isset($_POST['new_sm_pub'])){ $new_sm_pub = $_POST['new_sm_pub']; }
if(isset($_POST['new_sm_access'])){ $new_sm_access = $_POST['new_sm_access']; }
if(isset($_POST['new_sm_target'])){ $new_sm_target = $_POST['new_sm_target']; }
if(isset($_POST['maxID'])){ $maxID = $_POST['maxID']; }
if(isset($_POST['language'])){ $language = $_POST['language']; }





// -----------------------------------------------------
// INIT
// -----------------------------------------------------

if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
	if(!isset($todo)){ $todo = 'show'; }
	if(!isset($rNR)){ $rNR = 0; }
	
	$bgkey = 0;
	
	
	
	
	
	// -----------------------------------------------------
	// SHOW OLD VALUES
	// -----------------------------------------------------
	
	if($todo == 'show'){
		echo $tcms_html->bold(_SIDEMENU_TITLE);
		echo $tcms_html->text(_SIDEMENU_TEXT.'<br /><br />', 'left');
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
			
			if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
				foreach($arr_filename as $key => $value){
					$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
					$arr_top_menu['tag'][$key]   = substr($value, 0, 5);
					$arr_top_menu['name'][$key]  = $menu_xml->readSection('menu', 'name');
					$arr_top_menu['id'][$key]    = $menu_xml->readSection('menu', 'id');
					$arr_top_menu['subid'][$key] = $menu_xml->readSection('menu', 'subid');
					$arr_top_menu['type'][$key]  = $menu_xml->readSection('menu', 'type');
					$arr_top_menu['link'][$key]  = $menu_xml->readSection('menu', 'link');
					$arr_top_menu['pub'][$key]   = $menu_xml->readSection('menu', 'published');
					$arr_top_menu['access'][$key]= $menu_xml->readSection('menu', 'access');
					$arr_top_menu['lang'][$key]  = $menu_xml->readSection('menu', 'language');
					
					if(!$arr_top_menu['name'][$key])   { $arr_top_menu['name'][$key]  = ''; }
					//if(!$arr_top_menu['id'][$key])     { $arr_top_menu['id'][$key]    = 0; }
					//if(!$arr_top_menu['subid'][$key])  { $arr_top_menu['subid'][$key] = ''; }
					if(!$arr_top_menu['type'][$key])   { $arr_top_menu['type'][$key]  = ''; }
					if(!$arr_top_menu['link'][$key])   { $arr_top_menu['link'][$key]  = ''; }
					if(!$arr_top_menu['pub'][$key])    { $arr_top_menu['pub'][$key]   = ''; }
					if(!$arr_top_menu['access'][$key]) { $arr_top_menu['access'][$key]= ''; }
					
					// CHARSETS
					$arr_top_menu['name'][$key] = $tcms_main->decodeText($arr_top_menu['name'][$key], '2', $c_charset);
					
					if($arr_top_menu['subid'][$key] != '-'){ $checkSubReorder++; }
					$checkReorder = $key;
				}
			}
			
			if(is_array($arr_top_menu)){
				array_multisort(
					$arr_top_menu['id'], SORT_ASC, 
					$arr_top_menu['subid'], SORT_ASC, 
					$arr_top_menu['name'], SORT_ASC, 
					$arr_top_menu['type'], SORT_ASC, 
					$arr_top_menu['link'], SORT_ASC, 
					$arr_top_menu['pub'], SORT_ASC, 
					$arr_top_menu['access'], SORT_ASC, 
					$arr_top_menu['tag'], SORT_ASC, 
					$arr_top_menu['lang'], SORT_ASC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
				$strAdd = "";
			}
			else{
				$strAdd = "AND ( autor = '".$id_username."' OR autor = '".$id_name."' ) ";
			}
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."sidemenu "
			."WHERE NOT (uid IS NULL) "
			.$strAdd
			."ORDER BY id ASC, subid ASC, name ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$arr_top_menu['tag'][$count]    = trim($sqlObj->uid);
				$arr_top_menu['name'][$count]   = trim($sqlObj->name);
				$arr_top_menu['id'][$count]     = trim($sqlObj->id);
				$arr_top_menu['subid'][$count]  = trim($sqlObj->subid);
				$arr_top_menu['type'][$count]   = trim($sqlObj->type);
				$arr_top_menu['link'][$count]   = trim($sqlObj->link);
				$arr_top_menu['pub'][$count]    = trim($sqlObj->published);
				$arr_top_menu['access'][$count] = trim($sqlObj->access);
				$arr_top_menu['lang'][$count]   = trim($sqlObj->language);
				
				if($arr_top_menu['name'][$count]   == NULL){ $arr_top_menu['name'][$count]   = ''; }
				if($arr_top_menu['id'][$count]     == NULL){ $arr_top_menu['id'][$count]     = ''; }
				if($arr_top_menu['subid'][$count]  == NULL){ $arr_top_menu['subid'][$count]  = ''; }
				if($arr_top_menu['type'][$count]   == NULL){ $arr_top_menu['type'][$count]   = ''; }
				if($arr_top_menu['link'][$count]   == NULL){ $arr_top_menu['link'][$count]   = ''; }
				if($arr_top_menu['pub'][$count]    == NULL){ $arr_top_menu['pub'][$count]    = ''; }
				if($arr_top_menu['access'][$count] == NULL){ $arr_top_menu['access'][$count] = ''; }
				
				// CHARSETS
				$arr_top_menu['name'][$count] = $tcms_main->decodeText($arr_top_menu['name'][$count], '2', $c_charset);
				
				$checkReorder = $count;
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="41%" align="left">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left" colspan="2">'._TABLE_REORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_ORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="7%">'._TABLE_SUBID.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TCMS_LANGUAGE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_TYPE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_LINK.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="7%">'._TABLE_PUBLISHED.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%">'._TABLE_ACCESS.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if(isset($arr_top_menu['id']) && !empty($arr_top_menu['id']) && $arr_top_menu['id'] != ''){
			foreach ($arr_top_menu['id'] as $key => $value){
				$bgkey++;
				if(is_integer($bgkey/2)){ $wsc = 0; }
				else{ $wsc = 1; }
				
				$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=edit&amp;maintag='.$arr_top_menu['tag'][$key].'\';"';
					
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$arr_color[$wsc].'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
				
				echo '<td class="tcms_db_2"'.$strJS.'>'
				.'<img border="0" src="../images/menu.png" style="padding-right: 3px;" />'
				.( trim($arr_top_menu['type'][$key]) == 'title' ? '<strong>' : '' )
				.( trim($arr_top_menu['subid'][$key]) != '-' ? ' &raquo; ' : '' )
				.trim($arr_top_menu['name'][$key])
				.( trim($arr_top_menu['type'][$key]) == 'title' ? '</strong>' : '' ).'</td>';
				
				
				//if($arr_top_menu['id'][0] == 'frontpage'){ $check_mover = 1; }
				//else{ $check_mover = 0; }
				$check_mover = 0;
				
				
				/*$this_link = $tcms_main->count_submenu_xml($arr_top_menu['id'][$key], '-', _TCMS_PATH.'/tcms_menu/', 'id', 'subid', 'menu', 5);
				$this_link = ( $this_link == 0 ? 1 : $this_link + $this_link );
				echo $this_link;
				*/
				
				echo '<td class="tcms_db_2" align="center">';
				
				if(trim($arr_top_menu['subid'][$key]) == '-'){
					//if($arr_top_menu['link'][$key] != 'frontpage'){
						if($key > $check_mover){
							echo '<a href="admin.php?id_user='.$id_user.'&site=mod_sidemenu&todo=reorder&action=up&id='.$arr_top_menu['id'][$key].'"><img src="../images/up.gif" border="0" title="'._EXPLORE_UP.'" alt="'._EXPLORE_UP.'" /></a>';
						}
						else{
							echo '<img src="../images/px.png" width="15" height="15" border="0" />';
						}
						
						if(($key > ($check_mover - 1)) && (($checkReorder - 1) >= $key)){
							echo '<a href="admin.php?id_user='.$id_user.'&site=mod_sidemenu&todo=reorder&action=down&id='.$arr_top_menu['id'][$key].'"><img src="../images/down.gif" border="0" title="'._EXPLORE_DOWN.'" alt="'._EXPLORE_DOWN.'" /></a>';
						}
						else{
							echo '<img src="../images/px.png" width="15" height="15" border="0" />';
						}
					//}
					//else{ echo '<img src="../images/px.png" width="1" height="1" border="0" />'; }
				}
				else{ echo '<img src="../images/px.png" width="1" height="1" border="0" />'; }
				
				echo '</td>';
				
				
				
				
				echo '<td class="tcms_db_2" align="center">';
				
				if($arr_top_menu['subid'][$key] != '-'){
					if($arr_top_menu['subid'][$key - 1] != '-'){ echo '<a href="admin.php?id_user='.$id_user.'&site=mod_sidemenu&todo=reorderSide&action=up&id='.$arr_top_menu['tag'][$key].'&re='.$arr_top_menu['tag'][$key - 1].'"><img src="../images/up.gif" border="0" title="'._EXPLORE_UP.'" alt="'._EXPLORE_UP.'" /></a>'; }
					else{ echo '<img src="../images/px.png" width="15" height="15" border="0" />'; }
					
					if($arr_top_menu['subid'][$key + 1] != '-'){ echo '<a href="admin.php?id_user='.$id_user.'&site=mod_sidemenu&todo=reorderSide&action=down&id='.$arr_top_menu['tag'][$key].'&re='.$arr_top_menu['tag'][$key + 1].'"><img src="../images/down.gif" border="0" title="'._EXPLORE_DOWN.'" alt="'._EXPLORE_DOWN.'" /></a>'; }
					else{ echo '<img src="../images/px.png" width="15" height="15" border="0" />'; }
				}
				else{ echo '<img src="../images/px.png" width="1" height="1" border="0" />'; }
				
				echo '</td>';
				
				
				
				echo '<td class="tcms_db_2" align="center"'.$strJS.'>'
				.$arr_top_menu['id'][$key]
				.'</td>';
				
				echo '<td class="tcms_db_2" align="center"'.$strJS.'>'
				.( $arr_top_menu['subid'][$key] == '' ? '-' : $arr_top_menu['subid'][$key] )
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
				.'<a href="admin.php?id_user='.$id_user.'&site=mod_sidemenu&todo=publishItem&action='.( $arr_top_menu['pub'][$key] == 1 ? 'off' : 'on' ).'&maintag='.$arr_top_menu['tag'][$key].'">'
				.( $arr_top_menu['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a></td>';
				
				echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_top_menu['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';"'.$strJS.'>'
				.$arr_top_menu['access'][$key]
				.'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=edit&amp;maintag='.$arr_top_menu['tag'][$key].'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=delete&amp;maintag='.$arr_top_menu['id'][$key]
				.( $arr_top_menu['subid'][$key] != '-' ? '&amp;subItem='.$arr_top_menu['tag'][$key] : '' ).'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	// -----------------------------------------------------
	// FORM
	// -----------------------------------------------------
	
	if($todo == 'edit'){
		//***************************
		//
		$newLink = false;
		
		if(isset($maintag) && !empty($maintag) && $maintag != ''){
			if($choosenDB == 'xml'){
				$user_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$maintag.'.xml','r');
				$sm_name     = $user_xml->readSection('menu', 'name');
				$sm_id       = $user_xml->readSection('menu', 'id');
				$sm_subid    = $user_xml->readSection('menu', 'subid');
				$sm_type     = $user_xml->readSection('menu', 'type');
				$sm_parent   = $user_xml->readSection('menu', 'parent');
				$sm_link     = $user_xml->readSection('menu', 'link');
				$sm_pub      = $user_xml->readSection('menu', 'published');
				$sm_access   = $user_xml->readSection('menu', 'access');
				$sm_target   = $user_xml->readSection('menu', 'target');
				$sm_lang     = $user_xml->readSection('menu', 'language');
				
				if(!$sm_name)     { $sm_name     = ''; }
				//if(!$sm_id)       { $sm_id       = ''; }
				//if(!$sm_subid)    { $sm_subid    = '-'; }
				if(!$sm_type)     { $sm_type     = 'link'; }
				if(!$sm_parent)   { $sm_parent   = '0'; }
				if(!$sm_link)     { $sm_link     = '0'; }
				if(!$sm_pub)      { $sm_pub      = '0'; }
				if(!$sm_access)   { $sm_access   = 'Public'; }
				if(!$sm_target)   { $sm_target   = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $maintag);
				$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
				
				$sm_name   = trim($sqlObj->name);
				$sm_id     = trim($sqlObj->id);
				$sm_subid  = trim($sqlObj->subid);
				$sm_type   = trim($sqlObj->type);
				$sm_parent = trim($sqlObj->parent);
				$sm_link   = trim($sqlObj->link);
				$sm_pub    = trim($sqlObj->published);
				$sm_access = trim($sqlObj->access);
				$sm_target = trim($sqlObj->target);
				$sm_lang   = trim($sqlObj->language);
				
				if($sm_name   == NULL){ $sm_name   = ''; }
				if($sm_id     == NULL){ $sm_id     = ''; }
				if($sm_subid  == NULL){ $sm_subid  = '-'; }
				if($sm_type   == NULL){ $sm_type   = 'link'; }
				if($sm_parent == NULL){ $sm_parent = '0'; }
				if($sm_link   == NULL){ $sm_link   = '0'; }
				if($sm_pub    == NULL){ $sm_pub    = '0'; }
				if($sm_access == NULL){ $sm_access = 'Public'; }
				if($sm_target == NULL){ $sm_target = ''; }
			}
			
			$sm_name = $tcms_main->decodeText($sm_name, '2', $c_charset);
			
			echo '<strong>'._TABLE_EDIT.'</strong><br>';
			$odot = 'save';
			
			if(isset($newType)){ $sm_type = $newType; }
			
			$newLink = false;
		}
		else{
			$sm_name   = '';
			$sm_id     = '';
			$sm_subid  = '';
			$sm_type   = 'link';
			$sm_parent = '';
			$sm_link   = '';
			$sm_pub    = '0';
			$sm_access = '';
			$sm_target = '';
			$sm_lang   = $tcms_config->getLanguageFrontend();
			
			if($choosenDB == 'xml'){
				$arr_fn = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
				$x = 0;
				foreach($arr_fn as $key => $value){
					$all_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
					$arr_i[$key] = $all_xml->read_value('id');
				}
				$sm_id = max($arr_i) + 1;
				$maxID = $sm_id;
			}
			else{
				$maxID = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'sidemenu', 'id');
				$sm_id = $maxID;
			}
			
			
			echo '<strong>'._TABLE_NEW.'</strong><br>';
			$odot    = 'next';
			
			if(isset($newType)){ $sm_type = $newType; }
			
			$newLink = true;
			
			//***************************************************************
			if($choosenDB == 'xml'){
				$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
				$i = $z = 0;
				while(!empty($arr_filename[$i])){
					$arr_maintag[$i] = substr($arr_filename[$i],0,5);
					$all_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$arr_filename[$i],'r');
					
					$ltype  = $all_xml->readSection('menu', 'type');
					$lsubid = $all_xml->readSection('menu', 'subid');
					
					if($ltype == 'link' && $lsubid == '-'){
						$arr_parent['id'][$z]     = $all_xml->read_value('id');
						$arr_parent['subid'][$z]  = ( !$all_xml->read_value('subid') ? $all_xml->read_value('subid') : '-' );
						$arr_parent['parent'][$z] = ( !$all_xml->read_value('parent') ? $all_xml->read_value('parent') : '0' );
						$arr_parent['name'][$z]   = $all_xml->read_value('name');
						
						$arr_parent['name'][$z] = $tcms_main->decodeText($arr_parent['name'][$z], '2', $c_charset);
						$z++;
					}
					$i++;
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."sidemenu WHERE type='link' AND subid='-'");
				
				$count = 0;
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$arr_parent['id'][$count]     = $sqlARR['id'];
					$arr_parent['subid'][$count]  = ( !$sqlARR['subid'] ? $sqlARR['subid'] : '-' );
					$arr_parent['parent'][$count] = ( !$sqlARR['parent'] ? $sqlARR['parent'] : '0' );
					$arr_parent['name'][$count]   = $sqlARR['name'];
					
					if($arr_parent['name'][$count]   == NULL){ $arr_parent['name'][$count]   = ''; }
					if($arr_parent['id'][$count]     == NULL){ $arr_parent['id'][$count]     = ''; }
					if($arr_parent['parent'][$count] == NULL){ $arr_parent['parent'][$count] = ''; }
					if($arr_parent['subid'][$count]  == NULL){ $arr_parent['subid'][$count]  = ''; }
					
					// CHARSETS
					$arr_parent['name'][$count] = $tcms_main->decodeText($arr_parent['name'][$count], '2', $c_charset);
					
					$checkReorder = $count;
					$count++;
				}
				
				$sqlAL->sqlFreeResult($sqlQR);
			}
			
			if(is_array($arr_parent)){
				array_multisort(
					$arr_parent['id'], SORT_ASC, 
					$arr_parent['subid'], SORT_ASC, 
					$arr_parent['parent'], SORT_ASC, 
					$arr_parent['name'], SORT_ASC
				);
			}
			//***************************************************************
		}
		//
		//***************************
		
		
		$sm_name = htmlspecialchars($sm_name);
		
		
		$width = '200';
		
		echo $tcms_html->text(_SIDEMENU_TEXT.'<br /><br />', 'left');
		
		
		// form begin
		echo '<form id="saveMenuItem" action="admin.php?id_user='.$id_user.'&site=mod_sidemenu" method="post">'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
		.'<input name="todo" type="hidden" value="'.$odot.'" />'
		.'<input name="maxID" type="hidden" value="'.$maxID.'" />';
		
		if(!$tcms_config->useContentLanguage()) {
			echo '<input name="language" type="hidden" value="'.$sm_lang.'" />';
		}
		
		
		// table title
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
		echo '</tr></table>';
		
		
		// table content
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// row
		if($tcms_config->useContentLanguage()) {
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="language" name="language">';
			
			foreach($languages['code'] as $key => $value) {
				if($value != $tcms_config->getLanguageCode(true)) {
					if($sm_lang == $value)
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
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TYPE.'</strong>'
		.'</td><td valign="top">'
		.'<select name="new_sm_type" class="tcms_select" onchange="ajaxChangeSidemenuType(this.value);">'
			.'<option'.( $sm_type == 'link' ? ' selected' : '' ).' value="link">'._TABLE_MENULINK.'</option>'
			.'<option'.( $sm_type == 'title' ? ' selected' : '' ).' value="title">'._TABLE_MENUTITLE.'</option>'
			.'<option'.( $sm_type == 'web' ? ' selected' : '' ).' value="web">'._TABLE_MENUWEB.'</option>'
		.'</select></td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
		.'<td><input class="tcms_textarea_normal" name="new_sm_name" type="text" value="'.$sm_name.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ENABLED.'</strong></td>'
		.'<td valign="top"><input name="new_sm_pub" type="checkbox"'.( $sm_pub == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_POS.'</strong></td>'
		.'<td valign="top"><input class="tcms_id_box" name="new_sm_id" id="new_sm_id" type="text" value="'.$sm_id.'" />'
		.'</td></tr>';
		
		
		// row
		if($newLink == true){
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PARENT.'</strong></td>'
			.'<td valign="top">'
			.'<select name="new_sm_parent" class="tcms_select" onchange="document.getElementById(\'new_sm_id\').value=this.value;">'
				.'<option selected value="'.$sm_id.'"> &bull; '._TABLE_PARENTN.' &bull; </option>';
				foreach($arr_parent['id'] as $key => $value){
					if($arr_parent['subid'][$key] == '-'){ echo '<option value="'.( $arr_parent['subid'][$key] == '-' ? $value : '-' ).'">'.( $arr_parent['subid'][$key] == '-' ? $arr_parent['name'][$key] : '&nbsp;-&nbsp;'.$arr_parent['name'][$key] ).'</option>'; }
				}
			echo '</select>'
			.'</td></tr>';
		}
		else{
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PARENTITEM.'</strong></td>'
			.'<td valign="top"><input class="tcms_id_box" name="new_sm_parent" type="text" value="'.$sm_parent.'" />'
			.'</td></tr>';
		}
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_SUBID.'</strong></td>'
		.'<td valign="top"><input class="tcms_id_box" name="new_sm_subid" type="text" value="'.$sm_subid.'" />'
		.'</td></tr>';
		
		
		// row
		switch ($sm_type) {
			case 'link':
				$loadType = 'ajaxChangeSidemenuType(\'link\');';
				break;
			
			case 'title':
				$loadType = 'ajaxChangeSidemenuType(\'title\');';
				break;
			
			case 'web':
				$loadType = 'ajaxChangeSidemenuType(\'web\');';
				break;
		}
		
		$jsStr = '<script>'
		.$loadType
		.'</script>';
		
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong id="sm_type_title" style="display:'.( $sm_type == 'link' || $sm_type == 'web' ? 'block' : 'none' ).';" class="tcms_bold">'._TABLE_LINKTO.'</strong></td>'
		.'<td valign="top">'
		.'<select name="'.( $sm_type == 'link' || $sm_type == 'title' || $sm_type == '' ? 'new_sm_link' : 'nothing' ).'"'
		.' id="sm_type_intern" class="tcms_select" style="display:'.( $sm_type == 'link' ? 'block' : 'none' ).';">'
			.'<option selected value="new_page"> &bull; '._TABLE_NEW.' &bull; </option>';
			if(isset($maintag) && !empty($maintag) && $maintag != ''){
				echo '<option selected value="'.$sm_link.'">'.$sm_link.'</option>';
			}
			foreach($arr_linkcom['link'] as $key => $value){
				echo '<option value="'.$value.'">'.$arr_linkcom['name'][$key].'</option>';
			}
		echo '</select>'
		.'<input class="tcms_input_small" id="sm_type_extern" '
		.'name="'.( $sm_type == 'web' ? 'new_sm_link' : 'nothing' ).'" '
		.'style="display:'.( $sm_type == 'web' ? 'block' : 'none' ).';" type="text" value="'.$sm_link.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_sm_access" class="tcms_select">'
			.'<option value="Public"'.( $sm_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $sm_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $sm_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TARGET.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_sm_target" class="tcms_select">'
			.'<option value="_blank"'.( $sm_target == '_blank' ? ' selected="selected"' : '' ).'>_blank</option>'
			.'<option value="_self"'.( $sm_target == '_self' ? ' selected="selected"' : '' ).'>_self</option>'
			.'<option value=""'.( $sm_target == '' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.'</option>'
		.'</select></td></tr>';
		
		
		// table end
		echo '</table>';
		
		echo '</form>';
	}
	
	
	
	
	
	// -----------------------------------------------------
	// SAVE VALUES
	// -----------------------------------------------------
	
	if($todo == 'save') {
		if($new_sm_pub    == '' || !isset($new_sm_pub))   { $new_sm_pub = '0'; }
		if($new_sm_subid  == '' || !isset($new_sm_subid)) { $new_sm_subid = '-'; }
		if($new_sm_parent == '' || !isset($new_sm_parent)){ $new_sm_parent = '-'; }
		
		$new_sm_name = $tcms_main->encodeText($new_sm_name, '2', $c_charset);
		
		
		if(trim($new_sm_link) == 'new_page') {
			$new_sm_link = $tcms_main->getNewUID(5, 'content');
			
			if($choosenDB == 'xml') {
				if($language != $tcms_config->getLanguageFrontend()) {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_content_languages/'.$new_sm_link.'.xml', 
						'w'
					);
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_sm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_sm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_sm_access);
					$xmluser->write_value('language', $language);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
				else {
					$xmluser = new xmlparser(_TCMS_PATH.'/tcms_content/'.$new_sm_link.'.xml', 'w');
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_sm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_sm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_tm_access);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
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
				
				$newSQLData = "'".$new_sm_name."', '".$new_sm_access."'";
				
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
						$new_sm_link
					);
				}
				else {
					$sqlAL->sqlCreateOne(
						$tcms_db_prefix.'content', 
						$newSQLColumns, 
						$newSQLData, 
						$new_sm_link
					);
				}
				
				//$sqlAL->sqlCreateOne($tcms_db_prefix.'content', $newSQLColumns, $newSQLData, $new_sm_link);
			}
		}
		
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$maintag.'.xml','w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('menu');
			
			$xmluser->write_value('name', $new_sm_name);
			$xmluser->write_value('id', $new_sm_id);
			$xmluser->write_value('subid', $new_sm_subid);
			$xmluser->write_value('type', $new_sm_type);
			$xmluser->write_value('parent', $new_sm_parent);
			$xmluser->write_value('link', $new_sm_link);
			$xmluser->write_value('published', $new_sm_pub);
			$xmluser->write_value('access', $new_sm_access);
			$xmluser->write_value('target', $new_sm_target);
			$xmluser->write_value('language', $language);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('menu');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'sidemenu.name="'.$new_sm_name.'", '
			.$tcms_db_prefix.'sidemenu.id='.$new_sm_id.', '
			.$tcms_db_prefix.'sidemenu.subid="'.$new_sm_subid.'", '
			.$tcms_db_prefix.'sidemenu.type="'.$new_sm_type.'", '
			.$tcms_db_prefix.'sidemenu.parent="'.$new_sm_parent.'", '
			.$tcms_db_prefix.'sidemenu.link="'.$new_sm_link.'", '
			.$tcms_db_prefix.'sidemenu.published='.$new_sm_pub.', '
			.$tcms_db_prefix.'sidemenu.access="'.$new_sm_access.'", '
			.$tcms_db_prefix.'sidemenu.language="'.$language.'", '
			.$tcms_db_prefix.'sidemenu.target="'.$new_sm_target.'"';
			
			$sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $maintag);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\'</script>';
	}
	
	
	
	
	
	// -----------------------------------------------------==============================
	// SAVE NEW
	// -----------------------------------------------------==============================
	
	if($todo == 'next') {
		if($new_sm_parent == $maxID){ $new_sm_parent = '-'; }
		
		if($new_sm_subid == '' || !isset($new_sm_subid)){
			if($new_sm_parent == '-' || $new_sm_parent == $maxID){ $new_sm_subid = '-'; }
			else{
				if($choosenDB == 'xml'){
					$arr_fn = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
					$x = 0;
					foreach($arr_fn as $key => $value){
						$all_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$arr_i[$key] = $all_xml->read_value('id');
						$arr_s[$key] = ( !$all_xml->read_value('subid') ? $all_xml->read_value('subid') : '-' );
						
						if($arr_i[$key] == $new_sm_subid){
							$arr_sub['id'][$x]  = $arr_i[$key];
							$arr_sub['sub'][$x] = $arr_s[$key];
							$x++;
						}
						else{ $arr_sub['sub'][0] = 0; }
					}
					
					$new_sm_subid = ( max($arr_sub['sub']) == '-' ? '0' : max($arr_sub['sub']) + 1 );
				}
				else{
					$new_sm_subid = $tcms_main->create_sort_id_sub(
						$choosenDB, 
						$sqlUser, 
						$sqlPass, 
						$sqlHost, 
						$sqlDB, 
						$sqlPort, 
						$tcms_db_prefix.'sidemenu', 
						'subid', 
						'parent', 
						$new_sm_parent
					);
					
					if($new_sm_subid != null) {
						//$new_sm_subid = $new_sm_subid + 1;
					}
					else {
						$new_sm_subid = '-';
					}
				}
			}
		}
		
		if($new_sm_parent == '' || !isset($new_sm_parent)){
			$new_sm_parent = '-';
			$new_sm_subid  = '-';
		}
		
		
		$maintag = $tcms_main->getNewUID(5, 'sidemenu');
		
		
		if($new_sm_type == 'title'){
			$new_sm_link = '-';
			$new_sm_parent = '-';
			$new_sm_subid = '-';
		}
		
		
		if($new_sm_pub == '' || !isset($new_sm_pub)){ $new_sm_pub = '0'; }
		
		// CHARSETS
		$new_sm_name = $tcms_main->encodeText($new_sm_name, '2', $c_charset);
		
		
		if(trim($new_sm_link) == 'new_page'){
			unset($new_sm_link);
			
			$new_sm_link = $tcms_main->getNewUID(5, 'tcms_content');
			
			if($choosenDB == 'xml') {
				if($language != $tcms_config->getLanguageFrontend()) {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_content_languages/'.$new_sm_link.'.xml', 
						'w'
					);
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_sm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_sm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_sm_access);
					$xmluser->write_value('language', $language);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
				else {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_content/'.$new_sm_link.'.xml', 
						'w'
					);
					$xmluser->xml_c_declaration($c_charset);
					$xmluser->xml_section('main');
					
					$xmluser->write_value('title', $new_sm_name);
					$xmluser->write_value('key', '');
					$xmluser->write_value('content00', '');
					$xmluser->write_value('content01', '');
					$xmluser->write_value('foot', '');
					$xmluser->write_value('id', $new_sm_link);
					//$xmluser->write_value('db_layout', '');
					$xmluser->write_value('access', $new_tm_access);
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('main');
				}
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
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
				
				$newSQLData = "'".$new_sm_name."', '".$new_tm_access."'";
				
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
						$new_sm_link
					);
				}
				else {
					$sqlAL->sqlCreateOne(
						$tcms_db_prefix.'content', 
						$newSQLColumns, 
						$newSQLData, 
						$new_sm_link
					);
				}
			}
		}
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('menu');
			
			$xmluser->write_value('name', $new_sm_name);
			$xmluser->write_value('id', $new_sm_id);
			$xmluser->write_value('subid', $new_sm_subid);
			$xmluser->write_value('type', $new_sm_type);
			$xmluser->write_value('parent', $new_sm_parent);
			$xmluser->write_value('link', $new_sm_link);
			$xmluser->write_value('published', $new_sm_pub);
			$xmluser->write_value('access', $new_sm_access);
			$xmluser->write_value('target', $new_sm_target);
			$xmluser->write_value('language', $language);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('menu');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`name`, `id`, `subid`, `type`, `parent`, `link`, '
					.'`published`, `access`, `target`, `language`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, id, subid, "type", parent, link, '
					.'published, "access", "target", "language"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [id], [subid], [type], [parent], [link], '
					.'[published], [access], [target], [language]';
					break;
			}
			
			$newSQLData = "'".$new_sm_name."', ".$new_sm_id.", '".$new_sm_subid."', '"
			.$new_sm_type."', '".$new_sm_parent."', '".$new_sm_link."', ".$new_sm_pub.", '"
			.$new_sm_access."', '".$new_sm_target."', '".$language."'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'sidemenu', $newSQLColumns, $newSQLData, $maintag);
		}
		
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\''
		.'</script>';
	}
	
	
	
	
	
	// -----------------------------------------------------==============================
	// PUBLISH / UNPUBLISH
	// -----------------------------------------------------==============================
	
	if($todo == 'publishItem'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$maintag.'.xml', 'published', '1', '0'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'sidemenu.published=0';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';</script>';
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$maintag.'.xml', 'published', '0', '1'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'sidemenu.published=1';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';</script>';
				break;
		}
	}
	
	
	
	
	
	// -----------------------------------------------------==============================
	// REORDER
	// -----------------------------------------------------==============================
	
	if($todo == 'reorder'){
		switch($action){
			// MOVE ENTRY + 1
			case 'up':
				if($choosenDB == 'xml'){
					$arr_reorderfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
					$i = 0;
					
					foreach($arr_reorderfiles as $key => $value){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderID = $reorderXML->readSection('menu', 'id');
						if($reorderID == $id){ $arr_reorderMe['minus'][$i] = $value; $i++; }
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlQUERY('SELECT * FROM '.$tcms_db_prefix.'sidemenu WHERE id='.$id);
					
					$count = 0;
					
					while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
						$arr_reorderMe['minus'][$count] = $sqlARR['uid'];
						
						if($arr_reorderMe['minus'][$count] == NULL){ $arr_reorderMe['minus'][$count] = ''; }
						
						$checkReorder = $count;
						$count++;
					}
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				if($choosenDB == 'xml'){
					$i = 0;
				
					foreach($arr_reorderfiles as $key => $value){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderID = $reorderXML->readSection('menu', 'id');
						if($reorderID == ($id - 1)){ $arr_reorderMe['plus'][$i] = $value; $i++; }
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlQUERY('SELECT * FROM '.$tcms_db_prefix.'sidemenu WHERE id='.( $id - 1));
					
					$count = 0;
					
					while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
						$arr_reorderMe['plus'][$count] = $sqlARR['uid'];
						
						if($arr_reorderMe['plus'][$count] == NULL){ $arr_reorderMe['plus'][$count] = ''; }
						
						$checkReorder = $count;
						$count++;
					}
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				foreach($arr_reorderMe['minus'] as $key => $value){
					if($choosenDB == 'xml'){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderParent = $reorderXML->readSection('menu', 'parent');
						if($reorderParent != '-'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'parent', $id, ($id - 1)); }
						xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'id', $id, ($id - 1));
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $value);
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						$reorderParent = $sqlARR['parent'];
						$sqlAL->sqlFreeResult($sqlQR);
						
						if($reorderParent != '-'){
							$newSQLData = $tcms_db_prefix.'sidemenu.parent='.($id - 1);
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
							$sqlAL->sqlFreeResult($sqlQR);
						}
						
						$newSQLData = $tcms_db_prefix.'sidemenu.id='.($id - 1);
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
						$sqlAL->sqlFreeResult($sqlQR);
					}
				}
				
				foreach($arr_reorderMe['plus'] as $key => $value){
					if($choosenDB == 'xml'){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderParent = $reorderXML->readSection('menu', 'parent');
						if($reorderParent != '-'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'parent', ($id - 1), $id); }
						xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'id', ($id - 1), $id);
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $value);
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						$reorderParent = $sqlARR['parent'];
						$sqlAL->sqlFreeResult($sqlQR);
						
						if($reorderParent != '-'){
							$newSQLData = $tcms_db_prefix.'sidemenu.parent='.$id;
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
							$sqlAL->sqlFreeResult($sqlQR);
						}
						
						$newSQLData = $tcms_db_prefix.'sidemenu.id='.$id;
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
						$sqlAL->sqlFreeResult($sqlQR);
					}
				}
				
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';</script>';
				
				break;
			
			// MOVE ENTRY - 1
			case 'down':
				if($choosenDB == 'xml') {
					$arr_reorderfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
					$i = 0;
					
					foreach($arr_reorderfiles as $key => $value){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderID = $reorderXML->readSection('menu', 'id');
						if($reorderID == $id){ $arr_reorderMe['minus'][$i] = $value; $i++; }
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlQuery('SELECT * FROM '.$tcms_db_prefix.'sidemenu WHERE id='.$id);
					
					$count = 0;
					
					while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
						$arr_reorderMe['minus'][$count] = $sqlARR['uid'];
						
						if($arr_reorderMe['minus'][$count] == NULL){ $arr_reorderMe['minus'][$count] = ''; }
						
						$checkReorder = $count;
						$count++;
					}
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				if($choosenDB == 'xml'){
					$i = 0;
					
					foreach($arr_reorderfiles as $key => $value){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderID = $reorderXML->readSection('menu', 'id');
						if($reorderID == ($id + 1)){ $arr_reorderMe['plus'][$i] = $value; $i++; }
					}
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlQUERY('SELECT * FROM '.$tcms_db_prefix.'sidemenu WHERE id='.( $id + 1));
					
					$count = 0;
					
					while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
						$arr_reorderMe['plus'][$count] = $sqlARR['uid'];
						
						if($arr_reorderMe['plus'][$count] == NULL){ $arr_reorderMe['plus'][$count] = ''; }
						
						$checkReorder = $count;
						$count++;
					}
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				foreach($arr_reorderMe['minus'] as $key => $value){
					if($choosenDB == 'xml'){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderParent = $reorderXML->readSection('menu', 'parent');
						if($reorderParent != '-'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'parent', $id, ($id + 1)); }
						xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'id', $id, ($id + 1));
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $value);
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						$reorderParent = $sqlARR['parent'];
						$sqlAL->sqlFreeResult($sqlQR);
						
						if($reorderParent != '-'){
							$newSQLData = $tcms_db_prefix.'sidemenu.parent='.($id + 1);
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
							$sqlAL->sqlFreeResult($sqlQR);
						}
						
						$newSQLData = $tcms_db_prefix.'sidemenu.id='.($id + 1);
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
						$sqlAL->sqlFreeResult($sqlQR);
					}
				}
				
				foreach($arr_reorderMe['plus'] as $key => $value){
					if($choosenDB == 'xml'){
						$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
						$reorderParent = $reorderXML->readSection('menu', 'parent');
						if($reorderParent != '-'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'parent', ($id + 1), $id); }
						xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$value, 'id', ($id + 1), $id);
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $value);
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						$reorderParent = $sqlARR['parent'];
						$sqlAL->sqlFreeResult($sqlQR);
						
						if($reorderParent != '-'){
							$newSQLData = $tcms_db_prefix.'sidemenu.parent='.$id;
							$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
							$sqlAL->sqlFreeResult($sqlQR);
						}
						
						$newSQLData = $tcms_db_prefix.'sidemenu.id='.$id;
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $value);
						$sqlAL->sqlFreeResult($sqlQR);
					}
				}
				
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';</script>';
				
				break;
		}
	}
	
	
	
	
	
	// -----------------------------------------------------==============================
	// REORDER SIDE
	// -----------------------------------------------------==============================
	
	if($todo == 'reorderSide'){
		switch($action){
			// MOVE ENTRY + 1
			case 'up':
				if($choosenDB == 'xml'){
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$id.'.xml','r');
					$mainorderID = $reorderXML->readSection('menu', 'subid');
					
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$re.'.xml','r');
					$reorderID = $reorderXML->readSection('menu', 'subid');
					
					xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$id.'.xml', 'subid', $mainorderID, $reorderID);
					xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$re.'.xml', 'subid', $reorderID, $mainorderID);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $id);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$mainorderID = $sqlARR['subid'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $re);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$reorderID = $sqlARR['subid'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'sidemenu.subid='.$reorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $id);
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'sidemenu.subid='.$mainorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $re);
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';</script>';
				
				break;
			
			// MOVE ENTRY - 1
			case 'down':
				if($choosenDB == 'xml'){
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$id.'.xml','r');
					$mainorderID = $reorderXML->readSection('menu', 'subid');
					
					$reorderXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$re.'.xml','r');
					$reorderID = $reorderXML->readSection('menu', 'subid');
					
					xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$id.'.xml', 'subid', $mainorderID, $reorderID);
					xmlparser::edit_value(_TCMS_PATH.'/tcms_menu/'.$re.'.xml', 'subid', $reorderID, $mainorderID);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $id);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$mainorderID = $sqlARR['subid'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidemenu', $re);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$reorderID = $sqlARR['subid'];
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'sidemenu.subid='.$reorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $id);
					$sqlAL->sqlFreeResult($sqlQR);
					
					$newSQLData = $tcms_db_prefix.'sidemenu.subid='.$mainorderID;
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidemenu', $newSQLData, $re);
					$sqlAL->sqlFreeResult($sqlQR);
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';'
				.'</script>';
				
				break;
		}
	}
	
	
	
	
	
	// -----------------------------------------------------==============================
	// DELETE
	// -----------------------------------------------------==============================
	
	if($todo == 'delete'){
		if(isset($subItem)){
			if($choosenDB == 'xml') {
				unlink(_TCMS_PATH.'/tcms_menu/'.$subItem.'.xml');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->sqlDeleteOne($tcms_db_prefix.'sidemenu', $subItem);
			}
		}
		else{
			if($choosenDB == 'xml') {
				$arr_delFiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
				
				foreach($arr_delFiles as $key => $value){
					$delXML = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value, 'r');
					$delID = $delXML->readSection('menu', 'id');
					if($delID == $maintag){ unlink(_TCMS_PATH.'/tcms_menu/'.$value); }
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."sidemenu WHERE id = ".$maintag);
			}
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_sidemenu\';'
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
