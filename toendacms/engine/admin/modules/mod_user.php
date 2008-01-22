<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| User Manager
|
| File:	mod_user.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * User Manager
 *
 * This module is used for user administration
 *
 * @version 0.5.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['full_name'])){ $full_name = $_POST['full_name']; }
if(isset($_POST['new_username'])){ $new_username = $_POST['new_username']; }
if(isset($_POST['check_pw'])){ $check_pw = $_POST['check_pw']; }
if(isset($_POST['new_pw'])){ $new_pw = $_POST['new_pw']; }
if(isset($_POST['new_email'])){ $new_email = $_POST['new_email']; }
if(isset($_POST['new_group'])){ $new_group = $_POST['new_group']; }
if(isset($_POST['new_join'])){ $new_join = $_POST['new_join']; }
if(isset($_POST['new_day'])){ $new_day = $_POST['new_day']; }
if(isset($_POST['new_month'])){ $new_month = $_POST['new_month']; }
if(isset($_POST['new_year'])){ $new_year = $_POST['new_year']; }
if(isset($_POST['new_sex'])){ $new_sex = $_POST['new_sex']; }
if(isset($_POST['new_occ'])){ $new_occ = $_POST['new_occ']; }
if(isset($_POST['new_www'])){ $new_www = $_POST['new_www']; }
if(isset($_POST['new_icq'])){ $new_icq = $_POST['new_icq']; }
if(isset($_POST['new_aim'])){ $new_aim = $_POST['new_aim']; }
if(isset($_POST['new_yim'])){ $new_yim = $_POST['new_yim']; }
if(isset($_POST['new_msn'])){ $new_msn = $_POST['new_msn']; }
if(isset($_POST['new_skype'])){ $new_skype = $_POST['new_skype']; }
if(isset($_POST['new_enabled'])){ $new_enabled = $_POST['new_enabled']; }
if(isset($_POST['new_tcms'])){ $new_tcms = $_POST['new_tcms']; }
if(isset($_POST['new_signature'])){ $new_signature = $_POST['new_signature']; }
if(isset($_POST['new_location'])){ $new_location = $_POST['new_location']; }
if(isset($_POST['new_hobby'])){ $new_hobby = $_POST['new_hobby']; }
if(isset($_POST['new_static'])){ $new_static = $_POST['new_static']; }
if(isset($_POST['new_last_login'])){ $new_last_login = $_POST['new_last_login']; }





//=====================================================
// INIT
//=====================================================

echo '<script language="JavaScript" src="../js/dhtml.js"></script>';

if(!isset($todo)){ $todo = 'show'; }

$bgkey = 0;

include_once('../tcms_kernel/datacontainer/tcms_dc_account.lib.php');





//=====================================================
//	OLD VALUES
//=====================================================

if($todo == 'show') {
	echo $tcms_html->bold(_USER_TITLE);
	echo $tcms_html->text(_USER_TEXT.'<br /><br />', 'left');
	
	if($choosenDB == 'xml') {
		$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_user/');
		
		if($tcms_main->isArray($arr_filename)) {
			foreach($arr_filename as $key => $value) {
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_user/'.$value,'r');
				$arr_user['tag'][$key]    = substr($value, 0, 32);
				$arr_user['name'][$key]   = $menu_xml->read_section('user', 'name');
				$arr_user['user'][$key]   = $menu_xml->read_section('user', 'username');
				$arr_user['group'][$key]  = $menu_xml->read_section('user', 'group');
				$arr_user['email'][$key]  = $menu_xml->read_section('user', 'email');
				$arr_user['enable'][$key] = $menu_xml->read_section('user', 'enabled');
				$arr_user['static'][$key] = $menu_xml->read_section('user', 'static_value');
				
				if(!$arr_user['name'][$key])  { $arr_user['name'][$key]   = ''; }
				if(!$arr_user['user'][$key])  { $arr_user['user'][$key]   = ''; }
				if(!$arr_user['group'][$key]) { $arr_user['group'][$key]  = ''; }
				if(!$arr_user['email'][$key]) { $arr_user['email'][$key]  = ''; }
				if(!$arr_user['enable'][$key]){ $arr_user['enable'][$key] = ''; }
				if(!$arr_user['static'][$key]){ $arr_user['static'][$key] = ''; }
				
				if(trim($arr_user['static'][$key]) == ''
				&& $arr_user['user'][$key] == 'root') {
					$arr_user['static'][$key] = '1';
				}
				
				// CHARSETS
				$arr_user['name'][$key] = $tcms_main->decodeText($arr_user['name'][$key], '2', $c_charset);
				$arr_user['user'][$key] = $tcms_main->decodeText($arr_user['user'][$key], '2', $c_charset);
			}
		}
		
		if(is_array($arr_user)){
			array_multisort(
				$arr_user['group'], SORT_ASC, 
				$arr_user['user'], SORT_ASC, 
				$arr_user['name'], SORT_ASC, 
				$arr_user['email'], SORT_ASC, 
				$arr_user['enable'], SORT_ASC, 
				$arr_user['tag'], SORT_ASC, 
				$arr_user['static'], SORT_ASC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($choosenDB == 'mssql'){
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."user "
			."ORDER BY ".$tcms_db_prefix."user.[group] ASC, ".$tcms_db_prefix."user.[username] ASC, ".$tcms_db_prefix."user.[name] ASC";
		}
		else{
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."user "
			."ORDER BY ".$tcms_db_prefix."user.group ASC, ".$tcms_db_prefix."user.username ASC, ".$tcms_db_prefix."user.name ASC";
		}
		
		$sqlQR = $sqlAL->sqlQuery($sqlSTR);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_user['tag'][$count]    = $sqlARR['uid'];
			$arr_user['name'][$count]   = $sqlARR['name'];
			$arr_user['user'][$count]   = $sqlARR['username'];
			$arr_user['group'][$count]  = $sqlARR['group'];
			$arr_user['email'][$count]  = $sqlARR['email'];
			$arr_user['enable'][$count] = $sqlARR['enabled'];
			$arr_user['static'][$count] = $sqlARR['static_value'];
			
			if($arr_user['name'][$count]   == NULL){ $arr_user['name'][$count]   = ''; }
			if($arr_user['user'][$count]   == NULL){ $arr_user['user'][$count]   = ''; }
			if($arr_user['group'][$count]  == NULL){ $arr_user['group'][$count]  = ''; }
			if($arr_user['email'][$count]  == NULL){ $arr_user['email'][$count]  = ''; }
			if($arr_user['enable'][$count] == NULL){ $arr_user['enable'][$count] = ''; }
			if($arr_user['static'][$count] == NULL){ $arr_user['static'][$count] = ''; }
			
			// CHARSETS
			$arr_user['name'][$count] = $tcms_main->decodeText($arr_user['name'][$count], '2', $c_charset);
			$arr_user['user'][$count] = $tcms_main->decodeText($arr_user['user'][$count], '2', $c_charset);
			
			$count++;
			$checkUserAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="1%">&nbsp;</th>'
		.'<th valign="middle" class="tcms_db_title" width="40%" align="left">'._TABLE_USERNAME.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="30%" align="left">'._TABLE_EMAIL.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_ENABLED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_GROUP.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
	
	if(isset($arr_user['tag']) && !empty($arr_user['tag']) && $arr_user['tag'] != ''){
		foreach ($arr_user['tag'] as $key => $value){
			if($id_group == 'Developer' || $id_group == 'Administrator'){
				/*
				 *
				 * ONLY ADMIN CAN CHANGE USERSETTINGS
				 *
				 */
				$bgkey++;
				if(is_integer($bgkey/2)) $wsc = $arr_color[0];
				else $wsc = $arr_color[1];
				
				$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=edit&amp;maintag='.$value.'\';"';
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$wsc.'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$wsc.'\')">';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'><img src="../images/user.png" border="0" /></td>';
				echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['user'][$key].'</td>';
				echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['email'][$key].'</td>';
				
				echo '<td class="tcms_db_2" align="center"'.$strJS.'>'
				.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=publishItem&amp;action='.( $arr_user['enable'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$value.'">'
				.( $arr_user['enable'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a></td>';
				
				echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['group'][$key].'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=edit&amp;maintag='.$value.'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>'
				.( $arr_user['static'][$key] != 1
					? '&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=delete&amp;maintag='.$value.'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>'
					: ''
				).'</td>';
				
				echo '</tr>';
			}
			else{
				/*
				 *
				 * ONLY ADMIN CAN CHANGE USERSETTINGS
				 *
				 */
				if($id_username == $arr_user['user'][$key]){
					$bgkey++;
					if(is_integer($bgkey/2)) $wsc = $arr_color[0];
					else $wsc = $arr_color[1];
					
					$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=edit&amp;maintag='.$value.'\';"';
					
					echo '<tr height="25" id="row'.$key.'" '
					.'bgcolor="'.$wsc.'" '
					.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$wsc.'\')">';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'><img src="../images/user.png" border="0" /></td>';
					echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['user'][$key].'</td>';
					echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['email'][$key].'</td>';
					
					echo '<td class="tcms_db_2" align="center"'.$strJS.'>'
					.( $arr_user['enable'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</td>';
					
					echo '<td class="tcms_db_2"'.$strJS.'>'.$arr_user['group'][$key].'</td>';
					
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=edit&amp;maintag='.$value.'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>'
					.( $arr_user['static'][$key] == 1 || $id_username == $arr_user['user'][$key]
						? '&nbsp;'
						: '&nbsp;'
						.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=delete&amp;maintag='.$value.'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
						.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
						.'</a>'
					).'</td>';
					
					echo '</tr>';
				}
			}
		}
	}
	
	echo '</table><br />';
}





//=====================================================
// EDIT USER
//=====================================================

if($todo == 'edit'){
	$canEdit = true;
	
	if($id_group != 'Developer' && $id_group != 'Administrator'){
		if($maintag != $id_uid){
			$canEdit = false;
		}
		else{
			$canEdit = true;
		}
	}
	
	$show_edit_fields = false;
	
	if($canEdit){
		if(isset($maintag)){
			if($tcms_ap->checkUserExists($maintag)) {
				$show_edit_fields = true;
			}
			
			$dcUser = new tcms_dc_account();
			$dcUser = $tcms_ap->getAccount($maintag);
			
			$tu_name      = $dcUser->GetName();
			$tu_username  = $dcUser->GetUsername();
			$tu_password  = $dcUser->GetPassword();
			$tu_email     = $dcUser->GetEmail();
			$tu_group     = $dcUser->GetGroup();
			$tu_lastlogin = $dcUser->GetLastLogin();
			$tu_join      = $dcUser->GetJoinDate();
			$tu_www       = $dcUser->GetHomepage();
			$tu_icq       = $dcUser->GetICQ();
			$tu_aim       = $dcUser->GetAIM();
			$tu_yim       = $dcUser->GetYIM();
			$tu_msn       = $dcUser->GetMSN();
			$tu_skype     = $dcUser->GetSkype();
			$tu_birthday  = $dcUser->GetBirthday();
			$tu_sex       = $dcUser->GetGender();
			$tu_occ       = $dcUser->GetOccupation();
			$tu_enabled   = $dcUser->GetEnabled();
			$tu_tcms      = $dcUser->GetTCMSScriptEnabled();
			$tu_static    = $dcUser->GetStaticValue();
			$tu_signature = $dcUser->GetSignature();
			$tu_location  = $dcUser->GetLocation();
			$tu_hobby     = $dcUser->GetHobby();
			
			$tu_name      = htmlspecialchars($tu_name);
			$tu_signature = htmlspecialchars($tu_signature);
			
			
			echo $tcms_html->bold(_TABLE_EDIT);
			$odot = 'save';
		}
		else{
			if($id_group == 'Developer' || $id_group == 'Administrator'){
				$show_edit_fields = true;
			}
			else{
				$show_edit_fields = false;
			}
			
			$tu_name      = '';
			$tu_username  = '';
			$tu_password  = '';
			$tu_email     = '';
			$tu_group     = '';
			$tu_join      = date('Y.m.d-H:i:s');
			$tu_www       = '';
			$tu_icq       = '';
			$tu_aim       = '';
			$tu_yim       = '';
			$tu_msn       = '';
			$tu_skype     = '';
			$tu_birthday  = '';
			$tu_sex       = '';
			$tu_occ       = '';
			$tu_enabled   = 0;
			$tu_tcms      = 1;
			$tu_static    = 0;
			$tu_signature = '';
			$tu_location  = '';
			$tu_hobby     = '';
			
			$maintag = $tcms_main->getNewUID(32, 'user');
			
			echo $tcms_html->bold(_TABLE_NEW);
			$odot = 'next';
		}
		
		
		if($show_edit_fields){
			$width = '200';
			
			echo $tcms_html->text(_LU_DES_TEXT.'<br /><br />', 'left');
			
			
			// form
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_user" method="post">'
			.'<input name="todo" type="hidden" value="'.$odot.'" />'
			.'<input name="check_pw" type="hidden" value="'.$tu_password.'" />'
			.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
			.'<input name="new_static" type="hidden" value="'.$tu_static.'" />'
			.'<input name="new_last_login" type="hidden" value="'.$tu_lastlogin.'" />';
			
			
			// table head
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
			.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_GENERAL.'</th>'
			.'</tr></table>';
			
			
			// table head
			echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._TABLE_ORDER.'</strong>'
			.'</td><td><input class="tcms_input_normal" readonly name="maintag" type="text" value="'.$maintag.'" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_NAME.'</strong>'
			.'</td><td><input class="tcms_input_normal" name="full_name" type="text" value="'.$tu_name.'" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_USERNAME.'</strong>'
			.'</td><td><input class="tcms_input_small" name="new_username" type="text" value="'.$tu_username.'" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_PASSWORD.'</strong>'// (<em>'._PERSON_AS_MD5.'</em>)
			.'</td><td><input class="tcms_input_normal" name="new_pw" type="text" value="'.$tu_password.'" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_EMAIL.'</strong>'
			.'</td><td><input class="tcms_input_normal" name="new_email" type="text" value="'.$tu_email.'" />'
			.'</td></tr>';
			
			
			// table row
			if($id_group == 'Developer' || $id_group == 'Administrator'){
				echo '<tr><td valign="top" width="'.$width.'">'
				.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
				.'<strong class="tcms_bold">'._PERSON_GROUP.'</strong> (<em>'._PERSON_RIGHTS.'</em>)'
				.'</td><td><select name="new_group" class="tcms_select">';
				foreach($arr_group as $gkey => $gvalue){
					echo '<option'.
					(
						$tu_group == $gvalue
						?
						' selected="selected"'
						:
						(
							$odot == 'next'
							?
							' selected="selected"'
							:
							''
						)
					)
					.' value="'.$gvalue.'">'.$gvalue.' - ['.$arr_group_txt[$gkey].']</option>';
				}
				echo '</select></td></tr>';
			}
			else{
				echo '<tr><td valign="top" width="'.$width.'">'
				.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
				.'<strong class="tcms_bold">'._PERSON_GROUP.'</strong> (<em>'._PERSON_RIGHTS.'</em>)'
				.'</td><td><input class="tcms_input_normal" readonly name="new_group" type="text" value="'.$tu_group.'" />'
				.'</td></tr>';
			}
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_JOINDATE.'</strong>'
			.'</td><td>'
			.'<input class="tcms_input_normal" readonly name="new_join" type="text" value="'.$tu_join.'" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// table head
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
			.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_FURTHER.'</th>'
			.'</tr></table>';
			
			
			// table head
			echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_SIGNATURE.'</strong>
			</td><td valign="top">
				<textarea class="tcms_textarea_big" name="new_signature" type="text">'.$tu_signature.'</textarea>
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_HOBBY.'</strong>
			</td><td valign="top">
				<input class="tcms_input_normal" name="new_hobby" type="text" value="'.$tu_hobby.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_LOCATION.'</strong>
			</td><td valign="top">
				<input class="tcms_input_normal" name="new_location" type="text" value="'.$tu_location.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_OCCUPATION.'</strong>
			</td><td>
				<input class="tcms_input_normal" name="new_occ" type="text" value="'.$tu_occ.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_BIRTHDAY.'</strong>
			</td><td valign="baseline">
				<select name="new_day" class="tcms_select_day">';
				foreach($arr_day as $key => $value){
					echo '<option value="'.$value.'"'.( substr($tu_birthday, 0, 2) == $value ? ' selected' : '' ).'>'.$value.'</option>';
				}echo '</select>
				
				<select name="new_month" class="tcms_select_month">';
				foreach($arr_month12 as $key => $value){
					echo '<option value="'.$value.'"'.( substr($tu_birthday, 3, 2) == $value ? ' selected' : '' ).'>'.$monthName[$value].'</option>';
				}echo '</select>
				
				<input class="tcms_input_mini" name="new_year" type="text" value="'.( substr($tu_birthday, 6, 4) ).'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_SEX.'</strong>
			</td><td valign="top">
				<select class="tcms_select" name="new_sex">
				<option value="-"'.( $tu_sex == '-' ? ' selected' : '').'>'._PERSON_SEX_KA.'</option>
				<option value="man"'.( $tu_sex == 'man' ? ' selected' : '').'>'._PERSON_SEX_MAN.'</option>
				<option value="woman"'.( $tu_sex == 'woman' ? ' selected' : '').'>'._PERSON_SEX_WOMAN.'</option>
				</select>
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_WWW.'</strong>
			</td><td>
				<input class="tcms_input_normal" name="new_www" type="text" value="'.$tu_www.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_ICQ.'</strong>
			</td><td>
				<input class="tcms_input_small" name="new_icq" type="text" value="'.$tu_icq.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_AIM.'</strong>
			</td><td>
				<input class="tcms_input_small" name="new_aim" type="text" value="'.$tu_aim.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_YIM.'</strong>
			</td><td>
				<input class="tcms_input_small" name="new_yim" type="text" value="'.$tu_yim.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_MSN.'</strong>
			</td><td>
				<input class="tcms_input_small" name="new_msn" type="text" value="'.$tu_msn.'" />
			</td></tr>';
			
			
			// table row
			echo '
			<tr><td valign="top" width="'.$width.'">
				&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;
				<strong class="tcms_bold">'._PERSON_SKYPE.'</strong>
			</td><td>
				<input class="tcms_input_small" name="new_skype" type="text" value="'.$tu_skype.'" />
			</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// table head
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
			.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_SETTINGS.'</th>'
			.'</tr></table>';
			
			
			// table head
			echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._TABLE_ENABLED.'</strong>'
			.'</td><td>';
			
			
			// table row
			if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Tester'){
				echo '<input name="new_enabled" value="1" type="checkbox"'.( $tu_enabled == 1 ? ' checked="checked"' : '' ).' />';
			}
			else{
				echo '<input name="new_enabled" value="1" type="hidden" />'
				.'<img src="../images/px.png" border="0" />'
				.'<img src="../images/yes.png" border="0" />';
			}
			echo '</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
			.'<strong class="tcms_bold">'._PERSON_TCMS_ENABLED.'</strong>'
			.'</td><td><input name="new_tcms" value="1" type="checkbox"'.( trim($tu_tcms) == 1 ? ' checked="checked"' : '' ).' />'
			.'</td></tr>';
			
			
			// table row
			echo '</table>'
			.'</form>';
		}
		else{
			echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
		}
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





//=====================================================
// SAVE EDITING
//=====================================================

if($todo == 'save'){
	if(empty($new_enabled)) $new_enabled = 0;
	if(empty($new_tcms))    $new_tcms    = 0;
	if(empty($new_static))  $new_static  = 0;
	if(!isset($new_join))   $new_join = date('Y.m.d-H:i:s');
	
	if($new_pw == $check_pw) {
		$save_me_as_password =  $check_pw;
	}
	else {
		$save_me_as_password = ( $new_pw != '' ? md5($new_pw) : $new_pw);
	}
	
	$dcUser = new tcms_dc_account();
	
	$dcUser->SetID($maintag);
	$dcUser->SetName($full_name);
	$dcUser->SetUsername($new_username);
	$dcUser->SetPassword($save_me_as_password);
	$dcUser->SetEmail($new_email);
	$dcUser->SetGroup($new_group);
	$dcUser->SetJoinDate($new_join);
	$dcUser->SetLocation($new_last_login);
	$dcUser->SetHomepage($new_www);
	$dcUser->SetICQ($new_icq);
	$dcUser->SetAIM($new_aim);
	$dcUser->SetYIM($new_yim);
	$dcUser->SetMSN($new_msn);
	$dcUser->SetSkype($new_skype);
	$dcUser->SetBirthday($new_day.'.'.$new_month.'.'.$new_year);
	$dcUser->SetGender($new_sex);
	$dcUser->SetOccupation($new_occ);
	$dcUser->SetEnabled($new_enabled);
	$dcUser->SetTCMSScriptEnabled($new_tcms);
	$dcUser->SetStaticValue($new_static);
	$dcUser->SetSignature($new_signature);
	$dcUser->SetLocation($new_location);
	$dcUser->SetHobby($new_hobby);
	
	$tcms_ap->saveAccount($dcUser);
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_user\''
	.'</script>';
}





//===================================================================================
// NEW
//===================================================================================

if($todo == 'next'){
	if($new_enabled == '' || empty($new_enabled) || !isset($new_enabled)){ $new_enabled = 0; }
	if($new_tcms    == '' || empty($new_tcms)    || !isset($new_tcms))   { $new_tcms    = 0; }
	if(!isset($new_join)){ $new_join = date('Y.m.d-H:i:s'); }
	
	$new_pw = md5($new_pw);
	
	$dcUser = new tcms_dc_account();
	
	$dcUser->SetID($maintag);
	$dcUser->SetName($full_name);
	$dcUser->SetUsername($new_username);
	$dcUser->SetPassword($new_pw);
	$dcUser->SetEmail($new_email);
	$dcUser->SetGroup($new_group);
	$dcUser->SetJoinDate($new_join);
	$dcUser->SetLocation('');
	$dcUser->SetHomepage($new_www);
	$dcUser->SetICQ($new_icq);
	$dcUser->SetAIM($new_aim);
	$dcUser->SetYIM($new_yim);
	$dcUser->SetMSN($new_msn);
	$dcUser->SetSkype($new_skype);
	$dcUser->SetBirthday($new_day.'.'.$new_month.'.'.$new_year);
	$dcUser->SetGender($new_sex);
	$dcUser->SetOccupation($new_occ);
	$dcUser->SetEnabled($new_enabled);
	$dcUser->SetTCMSScriptEnabled($new_tcms);
	$dcUser->SetStaticValue($new_static);
	$dcUser->SetSignature($new_signature);
	$dcUser->SetLocation($new_location);
	$dcUser->SetHobby($new_hobby);
	
	$tcms_ap->createNewUser($dcUser);
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_user\''
	.'</script>';
}





//=====================================================
// PUBLISH / UNPUBLISH
//=====================================================

if($id_group == 'Developer' || $id_group == 'Administrator'){
	if($todo == 'publishItem'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_user/'.$maintag.'.xml', 'enabled', '1', '0'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'user.enabled=0';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'user', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_user\';</script>';
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_user/'.$maintag.'.xml', 'enabled', '0', '1'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'user.enabled=1';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'user', $newSQLData, $maintag);
				}
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_user\';</script>';
				break;
		}
	}
}





//=====================================================
// DELETE
//=====================================================

if($id_group == 'Developer' || $id_group == 'Administrator'){
	if($todo == 'delete'){
		if($choosenDB == 'xml'){
			unlink(_TCMS_PATH.'/tcms_user/'.$maintag.'.xml');
			unlink(_TCMS_PATH.'/tcms_notepad/'.$maintag.'.xml');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'user', $maintag);
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'notepad', $maintag);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_user\'</script>';
	}
}

?>
