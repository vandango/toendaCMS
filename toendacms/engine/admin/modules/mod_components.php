<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Components System
|
| File:	mod_components.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Components System
 *
 * This module is used to manage the components.
 *
 * @version 0.3.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['component'])){ $component = $_GET['component']; }
if(isset($_GET['backend'])){ $backend = $_GET['backend']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['site'])){ $site = $_POST['site']; }
if(isset($_POST['new_csTitle'])){ $new_csTitle = $_POST['new_csTitle']; }
if(isset($_POST['new_csSubTitle'])){ $new_csSubTitle = $_POST['new_csSubTitle']; }
if(isset($_POST['new_csID'])){ $new_csID = $_POST['new_csID']; }
if(isset($_POST['new_csEnabled'])){ $new_csEnabled = $_POST['new_csEnabled']; }
if(isset($_POST['new_csDesc'])){ $new_csDesc = $_POST['new_csDesc']; }
if(isset($_POST['new_csAccess'])){ $new_csAccess = $_POST['new_csAccess']; }
if(isset($_POST['new_csFolder'])){ $new_csFolder = $_POST['new_csFolder']; }
if(isset($_POST['new_csBackend'])){ $new_csBackend = $_POST['new_csBackend']; }
if(isset($_POST['new_csFrontend'])){ $new_csFrontend = $_POST['new_csFrontend']; }
if(isset($_POST['new_csSidebar'])){ $new_csSidebar = $_POST['new_csSidebar']; }
if(isset($_POST['new_csSettings'])){ $new_csSettings = $_POST['new_csSettings']; }
if(isset($_POST['new_csMain'])){ $new_csMain = $_POST['new_csMain']; }
if(isset($_POST['new_csSide'])){ $new_csSide = $_POST['new_csSide']; }
if(isset($_POST['new_csSideSort'])){ $new_csSideSort = $_POST['new_csSideSort']; }





// -----------------------------------------------------
// DATA
// -----------------------------------------------------

if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	/*
		INIT
	*/
	if(!isset($todo)){ $todo = 'show'; }
	if(!isset($rNR)) { $rNR  = 0; }
	
	$bgkey = 0;
	
	$arr_filename = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/components/');
	
	
	
	// -----------------------------------------------------
	// VALUE LIST
	// -----------------------------------------------------
	
	if($todo == 'show') {
		echo $tcms_html->bold(_CS_TITLE);
		echo $tcms_html->text(_CS_TEXT.'<br /><br />', 'left');
		
		if($tcms_main->isArray($arr_filename)){
			foreach($arr_filename as $key => $value){
				$csXML = new xmlparser('../../'.$tcms_administer_site.'/components/'.$value.'/component.xml', 'r');
				$arrCS['title'][$key]   = $csXML->readValue('title');
				$arrCS['subtit'][$key]  = $csXML->readValue('subtitle');
				$arrCS['id'][$key]      = $csXML->readValue('id');
				$arrCS['enabled'][$key] = $csXML->readValue('enabled');
				$arrCS['folder'][$key]  = $csXML->readValue('folder');
				$arrCS['access'][$key]  = $csXML->readValue('access');
				$arrCS['mcmod'][$key]   = $csXML->readValue('mainCS');
				$arrCS['sbmod'][$key]   = $csXML->readValue('sideCS');
				$arrCS['sbsort'][$key]  = $csXML->readValue('sideSort');
				$arrCS['back'][$key]    = $csXML->readValue('backendfile');
				$arrCS['tag'][$key]     = $value;
				
				if(!$arrCS['title'][$key]) { $arrCS['title'][$key]  = ''; }
				if(!$arrCS['subtit'][$key]){ $arrCS['subtit'][$key] = ''; }
				if(!$arrCS['id'][$key])    { $arrCS['id'][$key]     = ''; }
				if(!$arrCS['access'])      { $arrCS['access'][$key] = ''; }
				if(!$arrCS['back'])        { $arrCS['back'][$key]   = ''; }
				if(!$arrCS['tag'])         { $arrCS['tag'][$key]    = ''; }
				if(!$arrCS['sbsort'])      { $arrCS['sbsort'][$key] = ''; }
				
				// CHARSETS
				$arrCS['title'][$key]  = $tcms_main->decodeText($arrCS['title'][$key], '2', $c_charset, true);
				$arrCS['subtit'][$key] = $tcms_main->decodeText($arrCS['subtit'][$key], '2', $c_charset, true);
				$arrCS['subtit'][$key] = $tcms_main->decodeText($arrCS['subtit'][$key], '2', $c_charset, true);
			}
			
			if(is_array($arrCS)){
				array_multisort(
					$arrCS['sbsort'], SORT_ASC, 
					$arrCS['title'], SORT_ASC, 
					$arrCS['subtit'], SORT_ASC, 
					$arrCS['folder'], SORT_ASC, 
					$arrCS['enabled'], SORT_ASC, 
					$arrCS['sbmod'], SORT_ASC, 
					$arrCS['mcmod'], SORT_ASC, 
					$arrCS['id'], SORT_ASC, 
					$arrCS['access'], SORT_ASC, 
					$arrCS['back'], SORT_ASC, 
					$arrCS['tag'], SORT_ASC
				);
			}
		}
		
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">';
		echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="left">'._TABLE_SUBTITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_ENABLED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_SIDEBAR.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_MAINCONTENT.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%">'._TABLE_SORT.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_LINK.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th>'
		.'<tr>';
		
		if(isset($arrCS)){
			foreach ($arrCS['sbsort'] as $key => $value){
				$bgkey++;
				if(is_integer($bgkey/2)){ $wsc = 0; } else{ $wsc = 1; }
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$arr_color[$wsc].'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')"'
				.( trim($arrCS['back'][$key]) != '' 
					? ''// onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$arrCS['tag'][$key].'&amp;backend='.$arrCS['back'][$key].'\';"'
					: '' )
				.'>';
				
				echo '<td class="tcms_db_2">'.$arrCS['title'][$key].'</td>';
				echo '<td class="tcms_db_2">'.$arrCS['subtit'][$key].'</td>';
				
				echo '<td align="center" class="tcms_db_2">'
				.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=enableCS&amp;action='.( $arrCS['enabled'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arrCS['folder'][$key].'">'
				.( $arrCS['enabled'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a>'
				.'</td>';
				
				echo '<td align="center" class="tcms_db_2">'
				.( trim($arrCS['sbmod'][$key]) == '-' ?
					'<img src="../images/a_delete.png" border="0" />'
					:
					'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=enableSidebar&amp;action='.( $arrCS['sbmod'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arrCS['folder'][$key].'">'
					.( $arrCS['sbmod'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a>'
				)
				.'</td>';
				
				echo '<td align="center" class="tcms_db_2">'
				.( trim($arrCS['mcmod'][$key]) == '-' ?
					'<img src="../images/a_delete.png" border="0" />'
					:
					'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=enableMaincontent&amp;action='.( $arrCS['mcmod'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arrCS['folder'][$key].'">'
					.( $arrCS['mcmod'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a>'
				)
				.'</td>';
				
				echo '<td class="tcms_db_2" align="center">'.$arrCS['sbsort'][$key].'</td>';
				
				echo '<td class="tcms_db_2" align="center">'.$arrCS['id'][$key].'</td>';
				echo '<td class="tcms_db_2" align="center" style="color: '.( $arrCS['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';">'.$arrCS['access'][$key].'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.( trim($arrCS['back'][$key]) != ''
				&& file_exists('../../'.$tcms_administer_site.'/components/'.$arrCS['tag'][$key].'/'.$arrCS['back'][$key])
					? '<a title="'._TABLE_ADMINBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$arrCS['tag'][$key].'&amp;backend='.$arrCS['back'][$key].'">'
					.'<img title="'._TABLE_ADMINBUTTON.'" alt="'._TABLE_ADMINBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_administer.gif" />'
					.'</a>&nbsp;'
					: ''
				)
				.'<a title="'._TABLE_SETTINGSBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=edit&amp;maintag='.$arrCS['tag'][$key].'">'
				.'<img title="'._TABLE_SETTINGSBUTTON.'" alt="'._TABLE_SETTINGSBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_settings.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=delete&amp;maintag='.$arrCS['tag'][$key].'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/******************************
	*
	* SETTINGS
	*
	*/
	if($todo == 'admin'){
		include('../../'.$tcms_administer_site.'/components/'.$component.'/'.$backend);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/******************************
	*
	* ENABLE / DISABLE MAINCONTENT
	*
	*/
	if($todo == 'enableCS'){
		switch($action){
			// Take it off
			case 'off':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'enabled', '1', '0');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
			
			// Take it on
			case 'on':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'enabled', '0', '1');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/******************************
	*
	* ENABLE / DISABLE SIDEBAR
	*
	*/
	if($todo == 'enableSidebar'){
		switch($action){
			// Take it off
			case 'off':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'sideCS', '1', '0');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
			
			// Take it on
			case 'on':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'sideCS', '0', '1');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/******************************
	*
	* ENABLE / DISABLE MAINCONTENT
	*
	*/
	if($todo == 'enableMaincontent'){
		switch($action){
			// Take it off
			case 'off':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'mainCS', '1', '0');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
			
			// Take it on
			case 'on':
				xmlparser::edit_value('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'mainCS', '0', '1');
				
				if($sender == 'desktop'){
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
				}
				else{
					echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';</script>';
				}
				break;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/******************************
	*
	* SETTINGS
	*
	*/
	if($todo == 'edit'){
		$csXML = new xmlparser('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml','r');
		
		$csTitle    = $csXML->readValue('title');
		$csSubTitle = $csXML->readValue('subtitle');
		$csDesc     = $csXML->readValue('desc');
		$csID       = $csXML->readValue('id');
		$csEnabled  = $csXML->readValue('enabled');
		$csMain     = $csXML->readValue('mainCS');
		$csSide     = $csXML->readValue('sideCS');
		$csSideSort = $csXML->readValue('sideSort');
		$csAccess   = $csXML->readValue('access');
		$csFolder   = $csXML->readValue('folder');
		$csBackend  = $csXML->readValue('backendfile');
		$csFrontend = $csXML->readValue('frontendfile');
		$csSidebar  = $csXML->readValue('sidebarfile');
		$csSettings = $csXML->readValue('settingsfile');
		
		if($csTitle    == false){ $csTitle    = ''; }
		if($csSubTitle == false){ $csSubTitle = ''; }
		if($csDesc     == false){ $csDesc     = ''; }
		if($csID       == false){ $csID       = ''; }
		if($csEnabled  == false){ $csEnabled  = ''; }
		if($csMain     == false){ $csMain     = ''; }
		if($csSide     == false){ $csSide     = ''; }
		if($csSideSort == false){ $csSideSort = 0; }
		if($csAccess   == false){ $csAccess   = ''; }
		if($csFolder   == false){ $csFolder   = ''; }
		if($csBackend  == false){ $csBackend  = ''; }
		if($csAccess   == false){ $csAccess   = ''; }
		if($csFrontend == false){ $csFrontend = ''; }
		if($csSidebar  == false){ $csSidebar  = ''; }
		if($csSettings == false){ $csSettings = ''; }
		
		// CHARSETS
		$csTitle    = $tcms_main->decodeText($csTitle, '2', $c_charset, true);
		$csSubTitle = $tcms_main->decodeText($csSubTitle, '2', $c_charset, true);
		$csDesc     = $tcms_main->decodeText($csDesc, '2', $c_charset, true);
		
		
		
		
		
		
		
		/*
			BEGIN FORM
		*/
		
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_components" method="post">'
		.'<input name="todo" type="hidden" value="saveConfig" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
		
		
		// table head
		echo '<table cellpadding="1" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// row
		echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._TABLE_SETTINGS.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_padding_mini"></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_ORDER.'</td>'
		.'<td valign="top"><input name="new_csID" class="tcms_input_small" value="'.$csID.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_ENABLED.'</td>'
		.'<td valign="top"><input name="new_csEnabled"'.( $csEnabled == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_MAIN_CS.'</td>'
		.'<td valign="top"><input name="new_csMain"'.( $csMain == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_SIDE_CS.'</td>'
		.'<td valign="top"><input name="new_csSide"'.( $csSide == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_SORT_SIDE.'</td>'
		.'<td valign="top"><input name="new_csSideSort" class="tcms_input_makro" value="'.$csSideSort.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_TITLE.'</td>'
		.'<td valign="top"><input name="new_csTitle" class="tcms_input_normal" value="'.$csTitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_SUBTITLE.'</td>'
		.'<td valign="top"><input name="new_csSubTitle" class="tcms_input_normal" value="'.$csSubTitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_DESCRIPTION.'</td>'
		.'<td valign="top"><textarea name="new_csDesc" class="tcms_textarea_big">'.$csDesc.'</textarea>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td><select name="new_csAccess" class="tcms_select">'
			.'<option value="Public"'.( $csAccess == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $csAccess == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $csAccess == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_DIR.'</td>'
		.'<td valign="top"><input name="new_csFolder" class="tcms_input_normal" value="'.$csFolder.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_BACKENDFILE.'</td>'
		.'<td valign="top"><input name="new_csBackend" class="tcms_input_normal" value="'.$csBackend.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_FRONTENDFILE.'</td>'
		.'<td valign="top"><input name="new_csFrontend" class="tcms_input_normal" value="'.$csFrontend.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_SIDEBARFILE.'</td>'
		.'<td valign="top"><input name="new_csSidebar" class="tcms_input_normal" value="'.$csSidebar.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_SETTINGSFILE.'</td>'
		.'<td valign="top"><input name="new_csSettings" class="tcms_input_normal" value="'.$csSettings.'" />'
		.'</td></tr>';
		
		
		// Table end
		echo '</table>'
		.'<br />'
		.'</form>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*******************************
	*
	* SAVE CONFIG
	*/
	if($todo == 'saveConfig'){
		if(empty($new_enabled)){ $new_enabled = 0; }
		
		if($new_csSideSort == ''){ $new_csSideSort = 0; }
		
		
		// CHARSETS
		$new_csTitle    = $tcms_main->decode_text_without_crypt($new_csTitle, '2', $c_charset);
		$new_csSubTitle = $tcms_main->decode_text_without_crypt($new_csSubTitle, '2', $c_charset);
		$new_csDesc     = $tcms_main->decode_text_without_crypt($new_csDesc, '2', $c_charset);
		
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/components/'.$maintag.'/component.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('cs');
		
		$xmluser->write_value('title', $new_csTitle);
		$xmluser->write_value('subtitle', $new_csSubTitle);
		$xmluser->write_value('desc', $new_csDesc);
		$xmluser->write_value('id', $new_csID);
		$xmluser->write_value('enabled', $new_csEnabled);
		$xmluser->write_value('mainCS', $new_csMain);
		$xmluser->write_value('sideCS', $new_csSide);
		$xmluser->write_value('sideSort', $new_csSideSort);
		$xmluser->write_value('access', $new_csAccess);
		$xmluser->write_value('folder', $new_csFolder);
		$xmluser->write_value('backendfile', $new_csBackend);
		$xmluser->write_value('frontendfile', $new_csFrontend);
		$xmluser->write_value('sidebarfile', $new_csSidebar);
		$xmluser->write_value('settingsfile', $new_csSettings);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('cs');
		
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\'</script>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*******************************
	*
	* DELETE CS
	*/
	if($todo == 'delete'){
		$tcms_main->deleteDir('../../'.$tcms_administer_site.'/components/'.$maintag.'/');
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
