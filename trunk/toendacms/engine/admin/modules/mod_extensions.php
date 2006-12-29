<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Global Extension Configuration
|
| File:		mod_extensions.php
| Version:	0.3.7
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




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




echo '<script language="JavaScript" src="../js/dhtml.js"></script>';


if($id_group == 'Developer' || $id_group == 'Administrator'){
	if(!isset($action)){ $action = 'cform'; }
	
	echo '<script>
	var CHANGED = false;
	var RELOCATE = false;
	
	function checkChanges(target){
		if(CHANGED){
			var confirmSave = confirm("'._MSG_CHANGES.'\n'._MSG_SAVE_NOW.'");
			
			if(confirmSave == false){
				RELOCATE = false;
				document.getElementById(\'_RELOCATE\').value = \'0\';
				document.location = \'admin.php?id_user='.$id_user.'&site=mod_extensions&action=\' + target;
			}
			else{
				RELOCATE = true;
				document.getElementById(\'_RELOCATE\').value = \'1\';
				save();
			}
		}
		else{
			RELOCATE = false;
			document.getElementById(\'_RELOCATE\').value = \'0\';
			document.location = \'admin.php?id_user='.$id_user.'&site=mod_extensions&action=\' + target;
		}
	}
	</script>';
	
	echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
	.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
	.'<a'.( $action == 'cform' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'cform\');" href="#">'._EXT_CFORM.'</a>'
	.'<a'.( $action == 'book' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'book\');" href="#">'._EXT_BOOK.'</a>'
	.'</div>';
	
	echo '<div class="tcms_tabPage"><br />';
	
	
	
	// BEGIN FORM
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_extensions" method="post">'
	.'<input name="action" type="hidden" value="'.$action.'" />';
	
	
	//table
	echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
	
	
	
	if($action == 'cform'){
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
			
			unset($tcms_tinyMCE);
		}
		
		
		if($choosenDB == 'xml'){
			$contactform_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/contactform.xml','r');
			$old_show_cisb      = $contactform_xml->read_section('email', 'show_contacts_in_sidebar');
			$old_email          = $contactform_xml->read_section('email', 'contact');
			$old_contact_title  = $contactform_xml->read_section('email', 'contacttitle');
			$old_contact_stamp  = $contactform_xml->read_section('email', 'contactstamp');
			$old_contact_text   = $contactform_xml->read_section('email', 'contacttext');
			$old_send_id        = $contactform_xml->read_section('email', 'send_id');
			$old_cform_access   = $contactform_xml->read_section('email', 'access');
			$old_enabled        = $contactform_xml->read_section('email', 'enabled');
			$old_use_adressbook = $contactform_xml->read_section('email', 'use_adressbook');
			$old_use_contact    = $contactform_xml->read_section('email', 'use_contact');
			$old_show_ce        = $contactform_xml->read_section('email', 'show_contactemail');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'contactform', 'contactform');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_show_cisb      = $sqlARR['show_contacts_in_sidebar'];
			$old_email          = $sqlARR['contact'];
			$old_contact_title  = $sqlARR['contacttitle'];
			$old_contact_stamp  = $sqlARR['contactstamp'];
			$old_contact_text   = $sqlARR['contacttext'];
			$old_send_id        = $sqlARR['send_id'];
			$old_cform_access   = $sqlARR['access'];
			$old_enabled        = $sqlARR['enabled'];
			$old_use_adressbook = $sqlARR['use_adressbook'];
			$old_use_contact    = $sqlARR['use_contact'];
			$old_show_ce        = $sqlARR['show_contactemail'];
		}
		
		
		// CHARSETS
		$old_email         = $tcms_main->decodeText($old_email, '2', $c_charset);
		$old_contact_title = $tcms_main->decodeText($old_contact_title, '2', $c_charset);
		$old_contact_stamp = $tcms_main->decodeText($old_contact_stamp, '2', $c_charset);
		$old_contact_text  = $tcms_main->decodeText($old_contact_text, '2', $c_charset);
		
		$old_contact_title = htmlspecialchars($old_contact_title);
		$old_contact_stamp = htmlspecialchars($old_contact_stamp);
		$old_contact_text  = htmlspecialchars($old_contact_text);
		
		
		switch(trim($show_wysiwyg)){
			case 'tinymce':
				//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
				$old_contact_text = stripslashes($old_contact_text);
				break;
			
			case 'fckeditor':
				$old_contact_text = str_replace('src="', 'src="../../../../', $old_contact_text);
				$old_contact_text = str_replace('src="../../../../http:', 'src="http:', $old_contact_text);
				$old_contact_text = str_replace('src="../../../../https:', 'src="https:', $old_contact_text);
				$old_contact_text = str_replace('src="../../../../ftp:', 'src="ftp:', $old_contact_text);
				$old_contact_text = str_replace('src="../../../..//', 'src="/', $old_contact_text);
				break;
			
			default:
				$old_contact_text = ereg_replace('<br />'.chr(10), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br />'.chr(13), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br />', chr(13), $old_contact_text);
				
				$old_contact_text = ereg_replace('<br/>'.chr(10), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br/>'.chr(13), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br/>', chr(13), $old_contact_text);
				
				$old_contact_text = ereg_replace('<br>'.chr(10), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br>'.chr(13), chr(13), $old_contact_text);
				$old_contact_text = ereg_replace('<br>', chr(13), $old_contact_text);
				break;
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$old_contact_text = str_replace('src="', 'src="../../', $old_contact_text);
		}
		
		
		
		
		
		// hidden
		echo '<input name="todo" type="hidden" value="save_cform" />';
		echo '<input name="_RELOCATE" id="_RELOCATE" type="hidden" value="0" />';
		
		
		//table head
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini"><strong>'._EXT_CFORM.'</strong></td></tr>';
		
		
		// table row
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._TABLE_ENABLED.'</td>'
		.'<td>'
		.'<input type="radio" onchange="CHANGED = true;" name="new_enabled" id="config_offline0" value="0"'.($old_enabled == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input type="radio" onchange="CHANGED = true;" name="new_enabled" id="config_offline1" value="1"'.($old_enabled == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" onchange="CHANGED = true;" name="use_show_cisb" '.( $old_show_cisb == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_USE_ADRESSBOOK.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" onchange="CHANGED = true;" name="new_use_adressbook" '.( $old_use_adressbook == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_USE_CONTACTPERSON.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" onchange="CHANGED = true;" name="new_use_contact" '.( $old_use_contact == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_SHOW_CONTACTEMAIL.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" onchange="CHANGED = true;" name="new_show_ce" '.( $old_show_ce == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_ID.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input name="new_send_id" onchange="CHANGED = true;" readonly class="tcms_input_small" value="'.$old_send_id.'" /></td></tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td colspan="2">'
		.'<select onchange="CHANGED = true;" name="cform_access" class="tcms_select">'
			.'<option value="Public"'.( $old_cform_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_cform_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_cform_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_EMAIL.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="email" class="tcms_input_normal" value="'.$old_email.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_TITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="tmp_contact_title" class="tcms_input_normal" value="'.$old_contact_title.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_SUBTITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input onchange="CHANGED = true;" name="contact_stamp" class="tcms_input_normal" value="'.$old_contact_stamp.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top" colspan="2"><br />'._TABLE_TEXT
		.( $show_wysiwyg != 'fckeditor' ? '<br /><br />'
		.'<script>createToendaToolbar(\'imp\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>'
		.'<br />' : '' );
		
		if($show_wysiwyg == 'tinymce'){ }
		elseif($show_wysiwyg == 'fckeditor'){ }
		else{
			if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else{ echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		echo '<br /><br />';
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'.$old_contact_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_contact_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'.$old_contact_text.'</textarea>';
		}
		
		echo '<br /></td></tr>';
		
		
		// table title
		echo '<tr><td colspan="3"><br /></td></tr>';
		
		
		
		
		//
		//
	}
	elseif($action == 'book'){
		//***************************
		// Main Contact Form Config
		if($choosenDB == 'xml'){
			// Main Guestbook Config
			$guestbook_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/guestbook.xml','r');
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
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'guestbook', 'guestbook');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_guest_id         = $sqlARR['guest_id'];
			$old_booktitle        = $sqlARR['booktitle'];
			$old_bookstamp        = $sqlARR['bookstamp'];
			$old_guestbook_access = $sqlARR['access'];
			$old_enabled          = $sqlARR['enabled'];
			
			$old_clean_link       = $sqlARR['clean_link'];
			$old_clean_script     = $sqlARR['clean_script'];
			$old_convert_at       = $sqlARR['convert_at'];
			$old_show_email       = $sqlARR['show_email'];
			$old_name_width       = $sqlARR['name_width'];
			$old_text_width       = $sqlARR['text_width'];
			$arr_color[0]         = $sqlARR['color_row_1'];
			$arr_color[1]         = $sqlARR['color_row_2'];
			
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
		
		
		
		
		
		
		// hidden
		echo '<input name="todo" type="hidden" value="save_book" />';
		echo '<input name="_RELOCATE" id="_RELOCATE" type="hidden" value="0" />';
		
		
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
		.'<fieldset style="width: 400px;"><legend><strong class="tcms_bold">'._TABLE_FILTER.'</strong></legend>'
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
		
		
	}
	
	
	
	// Table end
	echo '</table></form><br />';
	
	echo '</div>';
	
	
	
	
	
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	if($todo == 'save_book'){
		//***************************************
		
		
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
		
		
		//***************************************
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/guestbook.xml', 'w');
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
			$xmluser->_xmlparser();
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
		
		
		//---------------------------------------------------------------------
		
		if($_RELOCATE == 1){
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_extensions&action=cform\';</script>';
		}
		else{
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_extensions&action=book\';</script>';
		}
	}
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	
	if($todo == 'save_cform'){
		// CHARSETS
		$content = str_replace('src="../../../../http:', 'src="http:', $content);
		
		if($show_wysiwyg == 'tinymce'){
			//$content = str_replace('../../', '', $content);
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
		
		$content           = $tcms_main->encodeText($content, '2', $c_charset);
		$email             = $tcms_main->encodeText($email, '2', $c_charset);
		$tmp_contact_title = $tcms_main->encodeText($tmp_contact_title, '2', $c_charset);
		$contact_stamp     = $tcms_main->encodeText($contact_stamp, '2', $c_charset);
		
		
		if(empty($use_show_cisb))  { $use_show_cisb   = 0; }
		
		
		if($email == '')              { $email              = ''; }
		if(empty($use_show_cisb))     { $use_show_cisb      = 0; }
		if(empty($new_use_adressbook)){ $new_use_adressbook = 0; }
		if(empty($new_use_contact))   { $new_use_contact    = 0; }
		if(empty($new_show_ce))       { $new_show_ce        = 0; }
		if(empty($new_send_id))       { $new_send_id        = $old_send_id; }
		if(empty($tmp_contact_title)) { $tmp_contact_title  = ''; }
		if(empty($contact_stamp))     { $contact_stamp      = ''; }
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/contactform.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('email');
			
			$xmluser->write_value('contact', $email);
			$xmluser->write_value('show_contacts_in_sidebar', $use_show_cisb);
			$xmluser->write_value('send_id', $new_send_id);
			$xmluser->write_value('contacttitle', $tmp_contact_title);
			$xmluser->write_value('contactstamp', $contact_stamp);
			$xmluser->write_value('contacttext', $content);
			$xmluser->write_value('access', $cform_access);
			$xmluser->write_value('enabled', $new_enabled);
			$xmluser->write_value('use_adressbook', $new_use_adressbook);
			$xmluser->write_value('use_contact', $new_use_contact);
			$xmluser->write_value('show_contactemail', $new_show_ce);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('email');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'contactform.contact="'.$email.'", '
			.$tcms_db_prefix.'contactform.show_contacts_in_sidebar='.$use_show_cisb.', '
			.$tcms_db_prefix.'contactform.send_id="'.$new_send_id.'", '
			.$tcms_db_prefix.'contactform.contacttitle="'.$tmp_contact_title.'", '
			.$tcms_db_prefix.'contactform.contactstamp="'.$contact_stamp.'", '
			.$tcms_db_prefix.'contactform.contacttext="'.$content.'", '
			.$tcms_db_prefix.'contactform.access="'.$cform_access.'", '
			.$tcms_db_prefix.'contactform.enabled='.$new_enabled.', '
			.$tcms_db_prefix.'contactform.use_adressbook='.$new_use_adressbook.', '
			.$tcms_db_prefix.'contactform.use_contact='.$new_use_contact.', '
			.$tcms_db_prefix.'contactform.show_contactemail='.$new_show_ce;
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'contactform', $newSQLData, 'contactform');
		}
		
		
		//---------------------------------------------------------------------
		
		if($_RELOCATE == 1){
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_extensions&action=book\';</script>';
		}
		else{
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_extensions&action=cform\';</script>';
		}
		
		//***************************************
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
