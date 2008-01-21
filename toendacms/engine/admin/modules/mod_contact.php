<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Contacts Manager
|
| File:	mod_contact.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Contacts Manager
 *
 * This module is used as a contacts manager.
 *
 * @version 0.4.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['new_defcon'])){ $new_defcon = $_POST['new_defcon']; }
if(isset($_POST['new_pub'])){ $new_pub = $_POST['new_pub']; }
if(isset($_POST['full_name'])){ $full_name = $_POST['full_name']; }
if(isset($_POST['new_position'])){ $new_position = $_POST['new_position']; }
if(isset($_POST['new_email'])){ $new_email = $_POST['new_email']; }
if(isset($_POST['new_street'])){ $new_street = $_POST['new_street']; }
if(isset($_POST['new_country'])){ $new_country = $_POST['new_country']; }
if(isset($_POST['new_state'])){ $new_state = $_POST['new_state']; }
if(isset($_POST['new_town'])){ $new_town = $_POST['new_town']; }
if(isset($_POST['new_postal'])){ $new_postal = $_POST['new_postal']; }
if(isset($_POST['new_phone'])){ $new_phone = $_POST['new_phone']; }
if(isset($_POST['new_fax'])){ $new_fax = $_POST['new_fax']; }
if(isset($_POST['zlib_upload'])){ $zlib_upload = $_POST['zlib_upload']; }





if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	//=====================================================
	// INIT
	//=====================================================
	
	echo '<script language="JavaScript" src="../js/dhtml.js"></script>';
	
	if(!isset($todo)) $todo = 'show';
	
	include_once('../tcms_kernel/datacontainer/tcms_dc_contact.lib.php');
	
	$bgkey = 0;
	
	
	
	
	
	//=====================================================
	// OLD VALUES
	//=====================================================
	
	if($todo == 'import'){
		echo tcms_html::text(_CONTACT_VCARD_IMPORT_TEXT.'<br /><br />', 'left');
		
		
		// form
		echo '<!--BEGIN-FORM-->'
		.'<form name="vcard" id="vcard" action="admin.php?id_user='.$id_user.'&site=mod_contact" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="vcard_save" />'
		.'<!--BEGIN-TABLE-->';
		
		
		// table
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table title
		echo '<tr class="tcms_bg_blue_01">'
		.'<td colspan="2" class="tcms_db_title tcms_padding_mini">'
		.'<strong>'._TCMS_ADMIN_IMPORT.' '._CONTACT_VCARD.'</strong></td>'
		.'</tr><tr>'
		.'<td colspan="2" class="tcms_padding_mini">&nbsp;</td>'
		.'</tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="150">'._CONTACT_VCARD_VCF.'</td><td>'
		.'<input name="zlib_upload" type="file" class="tcms_upload" />'
		.'</td></tr>';
		
		
		echo '<tr><td colspan="2" class="tcms_padding_mini">&nbsp;</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		
		// end form
		echo '</form>';
	}
	
	
	
	
	
	//=====================================================
	// OLD VALUES
	//=====================================================
	
	if($todo == 'show'){
		echo tcms_html::bold(_CONTACT_TITLE);
		echo tcms_html::text(_CONTACT_TEXT.'<br /><br />', 'left');
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_contacts/');
			
			if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
				foreach($arr_filename as $key => $value){
					$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$value,'r');
					$arr_contacts['tag'][$key]    = substr($value, 0, 10);
					$arr_contacts['defcon'][$key] = $menu_xml->read_section('contact', 'default_con');
					$arr_contacts['pub'][$key]    = $menu_xml->read_section('contact', 'published');
					$arr_contacts['name'][$key]   = $menu_xml->read_section('contact', 'name');
					
					if(!$arr_contacts['defcon'][$key]){ $arr_contacts['defcon'][$key] = ''; }
					if(!$arr_contacts['pub'][$key])   { $arr_contacts['pub'][$key]    = ''; }
					if(!$arr_contacts['name'][$key])  { $arr_contacts['name'][$key]   = ''; }
					
					// CHARSETS
					$arr_contacts['name'][$key] = $tcms_main->decodeText($arr_contacts['name'][$key], '2', $c_charset);
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getAll($tcms_db_prefix.'contacts');
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)){
				$arr_contacts['tag'][$count]    = $sqlObj->uid;
				$arr_contacts['defcon'][$count] = $sqlObj->default_con;
				$arr_contacts['pub'][$count]    = $sqlObj->published;
				$arr_contacts['name'][$count]   = $sqlObj->name;
				
				if($arr_contacts['defcon'][$count] == NULL){ $arr_contacts['defcon'][$count] = ''; }
				if($arr_contacts['pub'][$count]    == NULL){ $arr_contacts['pub'][$count]    = ''; }
				if($arr_contacts['name'][$count]   == NULL){ $arr_contacts['name'][$count]   = ''; }
				
				// CHARSETS
				$arr_contacts['name'][$count] = $tcms_main->decodeText($arr_contacts['name'][$count], '2', $c_charset);
				
				$count++;
				$checkUserAmount = $count;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
	
		if(is_array($arr_contacts)){
			array_multisort(
				$arr_contacts['name'], SORT_ASC, 
				$arr_contacts['tag'], SORT_ASC, 
				$arr_contacts['defcon'], SORT_ASC, 
				$arr_contacts['pub'], SORT_ASC
			);
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="5%" colspan="2">'._TABLE_ORDER.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="65%" align="left">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_PUBLISHED.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_DEFAULT.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if(isset($arr_contacts['tag']) && !empty($arr_contacts['tag']) && $arr_contacts['tag'] != ''){
			foreach ($arr_contacts['tag'] as $key => $value){
				$bgkey++;
				
				if(is_integer($bgkey/2)) $wsc = $arr_color[0];
				else $wsc = $arr_color[1];
				
				$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_contact&amp;todo=edit&amp;maintag='.$value.'\';"';
				
				echo '<tr heigth="25" id="row'.$key.'" '
				.'bgcolor="'.$wsc.'" onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$wsc.'\')">';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'><img src="../images/people.png" border="0" /></td>';
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'.$value.'</td>';
				
				echo '<td class="tcms_db_2"'.$strJS.'>'.( empty($arr_contacts['name'][$key]) ? '<em>-empty-</em>' : $arr_contacts['name'][$key] ).'</td>';
				
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
				.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_contact&amp;todo=publishItem&amp;action='.( $arr_contacts['pub'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$value.'">'
				.( $arr_contacts['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</a>'
				.'</td>';
				
				
				echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
				.( $arr_contacts['defcon'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
				.'</td>';
				
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_contact&amp;todo=edit&amp;maintag='.$value.'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_contact&amp;todo=delete&amp;maintag='.$value.'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
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
		if(isset($maintag) && trim($maintag) != ''){
			$dcCon = new tcms_dc_contact();
			$dcCon = $tcms_ap->getContact($maintag);
			
			$tc_defcon   = $dcCon->getDefaultContact();
			$tc_pub      = $dcCon->getPublished();
			$tc_name     = $dcCon->getName();
			$tc_position = $dcCon->getPosition();
			$tc_email    = $dcCon->getEmail();
			$tc_street   = $dcCon->getStreet();
			$tc_country  = $dcCon->getCountry();
			$tc_state    = $dcCon->getState();
			$tc_town     = $dcCon->getCity();
			$tc_postal   = $dcCon->getZipcode();
			$tc_phone    = $dcCon->getPhone();
			$tc_fax      = $dcCon->getFax();
			
			echo tcms_html::bold(_TABLE_EDIT);
			$odot = 'save';
		}
		else{
			$tc_defcon   = 0;
			$tc_pub      = 0;
			$tc_name     = '';
			$tc_position = '';
			$tc_email    = '';
			$tc_street   = '';
			$tc_country  = '';
			$tc_state    = '';
			$tc_town     = '';
			$tc_postal   = '';
			$tc_phone    = '';
			$tc_fax      = '';
			
			echo tcms_html::bold(_TABLE_NEW);
			
			$maintag = $tcms_main->getNewUID(10, 'contacts');
			
			$odot = 'next';
		}
		
		
		$width = '200';
		echo tcms_html::text(_LU_DES_TEXT.'<br /><br />', 'left');
		
		
		// form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_contact" method="post">'
		.'<input name="todo" type="hidden" value="'.$odot.'" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
		
		
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._CONTACT_DETAIL.'</th>';
		echo '</tr></table>';
		
		
		// table head
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		if($tc_defcon == 0){
			if($choosenDB == 'xml'){
				$bCon = $tcms_main->chkDefaultContact();
				
				if($bCon){ $sqlNR = 1; }
				else{ $sqlNR = 0; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				
				$strSQL = "SELECT * "
				."FROM ".$tcms_db_prefix."contacts "
				."WHERE default_con = 1";
				
				$sqlQR = $sqlAL->sqlQuery($strSQL);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			}
		}
		else{
			$sqlNR = 0;
		}
		
		
		if($sqlNR == 0){
			// row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DEFAULT.'</strong></td>'
			.'<td>&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<input name="new_defcon" value="1" type="checkbox"'.( $tc_defcon == 1 ? ' checked="checked"' : '' ).' />'
			.'</td></tr>';
		}
		else{
			echo '<input name="new_defcon" type="hidden" value="0" />';
		}
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ENABLED.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
		.'<input name="new_pub" value="1" type="checkbox"'.( $tc_pub == 1 ? ' checked="checked"' : '' ).' />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_NAME.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="full_name" type="text" value="'.$tc_name.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_POSITION.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_position" type="text" value="'.$tc_position.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_EMAIL.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_email" type="text" value="'.$tc_email.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '</table>';
		
		
		// table
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_STREET.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_street" type="text" value="'.$tc_street.'" />'
		.'</td></tr>';
		
		
		// row
		require_once('../tcms_kernel/tcms_countrylist.lib.php');
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_COUNTRY.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		//.'<select class="tcms_select" name="new_country">';
		.'<input class="tcms_input_normal" name="new_country" type="text" value="'.$tc_country.'" />'
		//foreach($arrCountryList as $key => $value){
		//	echo '<option value="'.$arrCountryList[$key]['xs'].'"'.( $arrCountryList[$key]['xs'] == $tc_country ? ' selected="selected"' : '' ).'>'.$value['xl'].'</option>';
		//}
		
		//echo '</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_STATE.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_state" type="text" value="'.$tc_state.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_TOWN.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_town" type="text" value="'.$tc_town.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_POSTAL.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_postal" type="text" value="'.$tc_postal.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_PHONE.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_phone" type="text" value="'.$tc_phone.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_FAX.'</strong></td>'
		.'<td>&nbsp;<img src="../images/dot_3.gif" border="0" />&nbsp;'
		.'<input class="tcms_input_normal" name="new_fax" type="text" value="'.$tc_fax.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '</table>';
		
		echo '</form>';
	}
	
	
	
	
	
	//=====================================================
	// SAVE EDITED
	//=====================================================
	
	if($todo == 'save'){
		if($new_defcon == ''){ $new_defcon = 0; }
		if($new_pub    == ''){ $new_pub    = 0; }
		
		// CHARSETS
		$full_name    = $tcms_main->encodeText($full_name, '2', $c_charset);
		$new_position = $tcms_main->encodeText($new_position, '2', $c_charset);
		$new_email    = $tcms_main->encodeText($new_email, '2', $c_charset);
		$new_street   = $tcms_main->encodeText($new_street, '2', $c_charset);
		$new_country  = $tcms_main->encodeText($new_country, '2', $c_charset);
		$new_state    = $tcms_main->encodeText($new_state, '2', $c_charset);
		$new_town     = $tcms_main->encodeText($new_town, '2', $c_charset);
		$new_postal   = $tcms_main->encodeText($new_postal, '2', $c_charset);
		$new_phone    = $tcms_main->encodeText($new_phone, '2', $c_charset);
		$new_fax      = $tcms_main->encodeText($new_fax, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('contact');
			
			$xmluser->write_value('default_con', $new_defcon);
			$xmluser->write_value('published', $new_pub);
			$xmluser->write_value('name', $full_name);
			$xmluser->write_value('position', $new_position);
			$xmluser->write_value('email', $new_email);
			$xmluser->write_value('street', $new_street);
			$xmluser->write_value('country', $new_country);
			$xmluser->write_value('state', $new_state);
			$xmluser->write_value('town', $new_town);
			$xmluser->write_value('postal', $new_postal);
			$xmluser->write_value('phone', $new_phone);
			$xmluser->write_value('fax', $new_fax);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('contact');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'contacts.default_con='.$new_defcon.', '
			.$tcms_db_prefix.'contacts.published='.$new_pub.', '
			.$tcms_db_prefix.'contacts.name="'.$full_name.'", '
			.$tcms_db_prefix.'contacts.position="'.$new_position.'", '
			.$tcms_db_prefix.'contacts.email="'.$new_email.'", '
			.$tcms_db_prefix.'contacts.street="'.$new_street.'", '
			.$tcms_db_prefix.'contacts.country="'.$new_country.'", '
			.$tcms_db_prefix.'contacts.state="'.$new_state.'", '
			.$tcms_db_prefix.'contacts.town="'.$new_town.'", '
			.$tcms_db_prefix.'contacts.postal="'.$new_postal.'", '
			.$tcms_db_prefix.'contacts.phone="'.$new_phone.'", '
			.$tcms_db_prefix.'contacts.fax="'.$new_fax.'"';
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'contacts', $newSQLData, $maintag);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\''
		.'</script>';
	}
	
	
	
	
	
	//===================================================================================
	// NEW
	//===================================================================================
	
	if($todo == 'next'){
		if($new_defcon == '' || empty($new_defcon)){ $new_defcon = 0; }
		if($new_pub    == '' || empty($new_pub))   { $new_pub    = 0; }
		
		// CHARSETS
		$full_name    = $tcms_main->encodeText($full_name, '2', $c_charset);
		$new_position = $tcms_main->encodeText($new_position, '2', $c_charset);
		$new_email    = $tcms_main->encodeText($new_email, '2', $c_charset);
		$new_street   = $tcms_main->encodeText($new_street, '2', $c_charset);
		$new_country  = $tcms_main->encodeText($new_country, '2', $c_charset);
		$new_state    = $tcms_main->encodeText($new_state, '2', $c_charset);
		$new_town     = $tcms_main->encodeText($new_town, '2', $c_charset);
		$new_phone    = $tcms_main->encodeText($new_phone, '2', $c_charset);
		$new_postal   = $tcms_main->encodeText($new_postal, '2', $c_charset);
		$new_fax      = $tcms_main->encodeText($new_fax, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('contact');
			
			$xmluser->write_value('default_con', $new_defcon);
			$xmluser->write_value('published', $new_pub);
			$xmluser->write_value('name', $full_name);
			$xmluser->write_value('position', $new_position);
			$xmluser->write_value('email', $new_email);
			$xmluser->write_value('street', $new_street);
			$xmluser->write_value('country', $new_country);
			$xmluser->write_value('state', $new_state);
			$xmluser->write_value('town', $new_town);
			$xmluser->write_value('postal', $new_postal);
			$xmluser->write_value('phone', $new_phone);
			$xmluser->write_value('fax', $new_fax);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('contact');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`default_con`, `published`, `name`, `position`, `email`, `street`, `country`, `state`, `town`, `postal`, `phone`, `fax`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'default_con, published, name, "position", email, street, country, state, town, postal, phone, fax';
					break;
				
				case 'mssql':
					$newSQLColumns = '[default_con], [published], [name], [position], [email], [street], [country], [state], [town], [postal], [phone], [fax]';
					break;
			}
			
			$newSQLData = $new_defcon.", ".$new_pub.", '".$full_name."', '".$new_position."', '".$new_email."', '".$new_street."', '".$new_country."', '".$new_state."', '".$new_town."', '".$new_postal."', '".$new_phone."', '".$new_fax."'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'contacts', $newSQLColumns, $newSQLData, $maintag);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\''
		.'</script>';
	}
	
	
	
	
	
	//===================================================================================
	// IMPORT VCARD
	//===================================================================================
	
	if($todo == 'vcard_save'){
		if($_FILES['zlib_upload']['size'] > 0 
		&& strrpos($_FILES['zlib_upload']['name'], '.vcf')){
			$fileName = '__vcard.vcf';
			$fileDir = '../../cache/';
			
			copy($_FILES['zlib_upload']['tmp_name'], $fileDir.$fileName);
			
			$tcms_import = new tcms_import(_TCMS_PATH, $c_charset);
			
			$tcms_import->importVCard();
			
			unlink($fileDir.$fileName);
			
			echo '<script type="text/javascript">'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\';'
			.'</script>';
		}
	}
	
	
	
	
	
	//===================================================================================
	// ENABLE / DISABLE COMMENTS
	//===================================================================================
	
	if($todo == 'publishItem'){
		switch($action){
			// Take it off
			case 'off':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_contacts/'.$maintag.'.xml', 'published', '1', '0'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'contacts.published=0';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'contacts', $newSQLData, $maintag);
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\';'
				.'</script>';
				break;
			
			// Take it on
			case 'on':
				if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_contacts/'.$maintag.'.xml', 'published', '0', '1'); }
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'contacts.published=1';
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'contacts', $newSQLData, $maintag);
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\';'
				.'</script>';
				break;
		}
	}
	
	
	
	
	
	//===================================================================================
	// DELETE
	//===================================================================================
	
	if($todo == 'delete'){
		if($choosenDB == 'xml'){ unlink(_TCMS_PATH.'/tcms_contacts/'.$maintag.'.xml'); }
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'contacts', $maintag);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_contact\'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
