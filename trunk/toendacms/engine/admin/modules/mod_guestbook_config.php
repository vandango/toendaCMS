<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Guestbook Configuration
|
| File:	mod_guestbook_config.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Guestbook Configuration
 *
 * This module is used for the guestbook configuration.
 *
 * @version 0.4.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['_RELOCATE'])){ $_RELOCATE = $_POST['_RELOCATE']; }

if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['email'])){ $email = $_POST['email']; }
if(isset($_POST['use_show_cisb'])){ $use_show_cisb = $_POST['use_show_cisb']; }
if(isset($_POST['new_send_id'])){ $new_send_id = $_POST['new_send_id']; }
if(isset($_POST['tmp_contact_title'])){ $tmp_contact_title = $_POST['tmp_contact_title']; }
if(isset($_POST['contact_stamp'])){ $contact_stamp = $_POST['contact_stamp']; }
if(isset($_POST['cform_access'])){ $cform_access = $_POST['cform_access']; }
if(isset($_POST['new_guest_id'])){ $new_guest_id = $_POST['new_guest_id']; }
if(isset($_POST['booktitle'])){ $booktitle = $_POST['booktitle']; }
if(isset($_POST['bookstamp'])){ $bookstamp = $_POST['bookstamp']; }
if(isset($_POST['filename'])){ $filename = $_POST['filename']; }
if(isset($_POST['timetowarp'])){ $timetowarp = $_POST['timetowarp']; }
if(isset($_POST['accolor'])){ $accolor = $_POST['accolor']; }
if(isset($_POST['su_displayname'])){ $su_displayname = $_POST['su_displayname']; }
if(isset($_POST['su_displaycolor'])){ $su_displaycolor = $_POST['su_displaycolor']; }
if(isset($_POST['guestbook_access'])){ $guestbook_access = $_POST['guestbook_access']; }
if(isset($_POST['new_enabled'])){ $new_enabled = $_POST['new_enabled']; }
if(isset($_POST['new_clean_link'])){ $new_clean_link = $_POST['new_clean_link']; }
if(isset($_POST['new_clean_script'])){ $new_clean_script = $_POST['new_clean_script']; }
if(isset($_POST['new_convert_at'])){ $new_convert_at = $_POST['new_convert_at']; }
if(isset($_POST['new_show_email'])){ $new_show_email = $_POST['new_show_email']; }
if(isset($_POST['new_name_width'])){ $new_name_width = $_POST['new_name_width']; }
if(isset($_POST['new_text_width'])){ $new_text_width = $_POST['new_text_width']; }
if(isset($_POST['new_arr_color0'])){ $new_arr_color0 = $_POST['new_arr_color0']; }
if(isset($_POST['new_arr_color1'])){ $new_arr_color1 = $_POST['new_arr_color1']; }
if(isset($_POST['new_use_adressbook'])){ $new_use_adressbook = $_POST['new_use_adressbook']; }
if(isset($_POST['new_use_contact'])){ $new_use_contact = $_POST['new_use_contact']; }
if(isset($_POST['new_show_ce'])){ $new_show_ce = $_POST['new_show_ce']; }




echo '<script language="JavaScript" src="../js/dhtml.js"></script>
<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';


if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	if($todo != 'save_book'){
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook_config" method="post">';
		
		
		if($choosenDB == 'xml') {
			// Main Guestbook Config
			$guestbook_xml = new xmlparser(_TCMS_PATH.'/tcms_global/guestbook.xml','r');
			$old_guest_id         = $guestbook_xml->read_section('config', 'guest_id');
			$old_booktitle        = $guestbook_xml->read_section('config', 'booktitle');
			$old_bookstamp        = $guestbook_xml->read_section('config', 'bookstamp');
			$old_guestbook_access = $guestbook_xml->read_section('config', 'access');
			$old_enabled          = $guestbook_xml->read_section('config', 'enabled');
			
			$old_clean_link   = $guestbook_xml->read_section('config', 'clean_link');
			$old_clean_script = $guestbook_xml->read_section('config', 'clean_script');
			$old_convert_at   = $guestbook_xml->read_section('config', 'convert_at');
			$old_show_email   = $guestbook_xml->read_section('config', 'show_email');
			$old_name_width   = $guestbook_xml->read_section('config', 'name_width');
			$old_text_width   = $guestbook_xml->read_section('config', 'text_width');
			$arr_color[0]     = $guestbook_xml->read_section('config', 'color_row_1');
			$arr_color[1]     = $guestbook_xml->read_section('config', 'color_row_2');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getOne($tcms_db_prefix.'guestbook', 'guestbook');
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$old_guest_id         = $sqlObj->guest_id;
			$old_booktitle        = $sqlObj->booktitle;
			$old_bookstamp        = $sqlObj->bookstamp;
			$old_guestbook_access = $sqlObj->access;
			$old_enabled          = $sqlObj->enabled;
			
			$old_clean_link       = $sqlObj->clean_link;
			$old_clean_script     = $sqlObj->clean_script;
			$old_convert_at       = $sqlObj->convert_at;
			$old_show_email       = $sqlObj->show_email;
			$old_name_width       = $sqlObj->name_width;
			$old_text_width       = $sqlObj->text_width;
			$arr_color[0]         = $sqlObj->color_row_1;
			$arr_color[1]         = $sqlObj->color_row_2;
			
			if($old_clean_link   == NULL){ $old_clean_link   = ''; }
			if($old_clean_script == NULL){ $old_clean_script = ''; }
			if($old_convert_at   == NULL){ $old_convert_at   = ''; }
			if($old_show_email   == NULL){ $old_show_email   = ''; }
			if($old_name_width   == NULL){ $old_name_width   = ''; }
			if($old_text_width   == NULL){ $old_text_width   = ''; }
			if($arr_color[0]     == NULL){ $arr_color[0]     = ''; }
			if($arr_color[1]     == NULL){ $arr_color[1]     = ''; }
		}
		
		
		// CHARSETS
		$old_booktitle      = $tcms_main->decodeText($old_booktitle, '2', $c_charset);
		$old_bookstamp      = $tcms_main->decodeText($old_bookstamp, '2', $c_charset);
		
		
		$old_booktitle = htmlspecialchars($old_booktitle);
		$old_bookstamp = htmlspecialchars($old_bookstamp);
		
		
		
		
		
		//table
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		// hidden
		echo '<input name="todo" type="hidden" value="save_book" />';
		
		
		// table head
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini"><strong>'._EXT_BOOK.'</strong></td></tr>';
		
		
		// table row
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._TABLE_ENABLED.'</td>'
		.'<td>'
		.'<input onchange="CHANGED = true;" type="radio" name="new_enabled" id="config_offline0" value="0"'.($old_enabled == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input onchange="CHANGED = true;" type="radio" name="new_enabled" id="config_offline1" value="1"'.($old_enabled == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._EXT_BOOK_ID.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="new_guest_id" readonly class="tcms_input_small" value="'.$old_guest_id.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_BOOK_TITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="booktitle" class="tcms_input_normal" value="'.$old_booktitle.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_BOOK_SUBTITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="bookstamp" class="tcms_input_normal" value="'.$old_bookstamp.'" /></td></tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td colspan="2">'
		.'<select onchange="CHANGED = true;" name="guestbook_access" class="tcms_select">'
			.'<option value="Public"'.( $old_guestbook_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_guestbook_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_guestbook_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini">'._BOOK_WIDTH_NAME.'</td>'
		.'<td colspan="2">'
		.'<select onchange="CHANGED = true;" name="new_name_width" class="tcms_select">';
		for($i = 0; $i <= 500; ){
			echo '<option value="'.$i.'"'.( $old_name_width == $i ? ' selected="selected"' : '' ).'>'.$i.' Pixel</option>';
			$i += 10;
		}
		echo '</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini">'._BOOK_WIDTH_TEXT.'</td>'
		.'<td colspan="2">'
		.'<select onchange="CHANGED = true;" name="new_text_width" class="tcms_select">';
		for($i = 0; $i <= 500; ){
			echo '<option value="'.$i.'"'.( $old_text_width == $i ? ' selected="selected"' : '' ).'>'.$i.' Pixel</option>';
			$i += 10;
		}
		echo '</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_1.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="new_arr_color0" id="color1" class="tcms_id_box" value="'.$arr_color[0].'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color1\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_2.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="new_arr_color1" id="color2" class="tcms_id_box" value="'.$arr_color[1].'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color2\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">&nbsp;</td>'
		.'<td valign="top" colspan="2">&nbsp;</td></tr>';
		
		
		// table rows
		echo '<tr><td></td><td valign="top" colspan="2">'
		.'<fieldset style="width: 400px;"><legend><strong class="tcms_bold">'._TCMS_LANGUAGES.'</strong></legend>'
		.'<br />'
		.'<div style="margin: 0; padding: 0 0 4px 0;">'
		.'<input onchange="CHANGED = true;" type="checkbox" style="margin: 0 0 -1px 0 !important;" name="new_clean_link" value="1"'.( $old_clean_link == true ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._BOOK_FILTER_LINKS
		.'</div>'
		.'<div style="margin: 0; padding: 0 0 4px 0;">'
		.'<input onchange="CHANGED = true;" type="checkbox" style="margin: 0 0 -1px 0 !important;" name="new_clean_script" value="1"'.( $old_clean_script == true ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._BOOK_FILTER_SCRIPT
		.'</div>'
		.'<div style="margin: 0; padding: 0 0 4px 0;">'
		.'<input onchange="CHANGED = true;" type="checkbox" style="margin: 0 0 -1px 0 !important;" name="new_show_email" value="1"'.( $old_show_email == true ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._BOOK_FILTER_MAIL
		.'</div>'
		.'<div style="margin: 0; padding: 0 0 4px 0;">'
		.'<input onchange="CHANGED = true;" type="checkbox" style="margin: 0 0 -1px 0 !important;" name="new_convert_at" value="1"'.( $old_convert_at == true ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._BOOK_FILTER_SPAM
		.'</div>'
		.'</fieldset>'
		.'</td></tr>';
		
		
		// table title
		echo '<tr><td colspan="3"><br /></td></tr>';
		
		// Table end
		echo '</table>';
		
		// Table end
		echo '</form><br />';
	}
	
	
	
	
	// --------------------------------------------------
	// SAVE, EDIT AND DELETE
	// --------------------------------------------------
	
	if($todo == 'save_book'){
		// CHARSETS
		$booktitle = $tcms_main->encodeText($booktitle, '2', $c_charset);
		$bookstamp = $tcms_main->encodeText($bookstamp, '2', $c_charset);
		
		
		if(empty($booktitle)){ $booktitle = ''; }
		if(empty($bookstamp)){ $bookstamp = ''; }
		
		
		if(empty($new_enabled)      || $new_enabled      == '' || !isset($new_enabled))     { $new_enabled      = 0; }
		if(empty($new_clean_link)   || $new_clean_link   == '' || !isset($new_clean_link))  { $new_clean_link   = 0; }
		if(empty($new_clean_script) || $new_clean_script == '' || !isset($new_clean_script)){ $new_clean_script = 0; }
		if(empty($new_convert_at)   || $new_convert_at   == '' || !isset($new_convert_at))  { $new_convert_at   = 0; }
		if(empty($new_show_email)   || $new_show_email   == '' || !isset($new_show_email))  { $new_show_email   = 0; }
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/guestbook.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('config');
			
			$xmluser->write_value('guest_id', $new_guest_id);
			$xmluser->write_value('booktitle', $booktitle);
			$xmluser->write_value('bookstamp', $bookstamp);
			$xmluser->write_value('access', $guestbook_access);
			$xmluser->write_value('enabled', $new_enabled);
			$xmluser->write_value('clean_link', $new_clean_link);
			$xmluser->write_value('clean_script', $new_clean_script);
			$xmluser->write_value('convert_at', $new_convert_at);
			$xmluser->write_value('show_email', $new_show_email);
			$xmluser->write_value('name_width', $new_name_width);
			$xmluser->write_value('text_width', $new_text_width);
			$xmluser->write_value('color_row_1', $new_arr_color0);
			$xmluser->write_value('color_row_2', $new_arr_color1);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('config');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'guestbook.guest_id="'.$new_guest_id.'", '
			.$tcms_db_prefix.'guestbook.booktitle="'.$booktitle.'", '
			.$tcms_db_prefix.'guestbook.bookstamp="'.$bookstamp.'", '
			.$tcms_db_prefix.'guestbook.access="'.$guestbook_access.'", '
			.$tcms_db_prefix.'guestbook.enabled='.$new_enabled.', '
			.$tcms_db_prefix.'guestbook.clean_link='.$new_clean_link.', '
			.$tcms_db_prefix.'guestbook.clean_script='.$new_clean_script.', '
			.$tcms_db_prefix.'guestbook.convert_at='.$new_convert_at.', '
			.$tcms_db_prefix.'guestbook.show_email='.$new_show_email.', '
			.$tcms_db_prefix.'guestbook.name_width="'.$new_name_width.'", '
			.$tcms_db_prefix.'guestbook.text_width="'.$new_text_width.'", '
			.$tcms_db_prefix.'guestbook.color_row_1="'.$new_arr_color0.'", '
			.$tcms_db_prefix.'guestbook.color_row_2="'.$new_arr_color1.'"';
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'guestbook', $newSQLData, 'guestbook');
		}
		
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook_config&action=book\';'
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
