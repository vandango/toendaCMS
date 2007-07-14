<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Contactform Configuration
|
| File:	mod_contactform.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Contactform Configuration
 *
 * This module is used for the contactform configuration.
 *
 * @version 0.4.7
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
if(isset($_POST['new_lang'])){ $new_lang = $_POST['new_lang']; }
if(isset($_POST['lang_exist'])){ $lang_exist = $_POST['lang_exist']; }




echo '<script language="JavaScript" src="../js/dhtml.js"></script>';


if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	if($todo != 'save_cform'){
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
			
			unset($tcms_tinyMCE);
		}
		
		
		if($tcms_main->isReal($lang))
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		else
			$getLang = $tcms_front_lang;
		
		
		if($choosenDB == 'xml'){
			if(file_exists('../../'.$tcms_administer_site.'/tcms_global/contactform.'.$getLang.'.xml')) {
				$contactform_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/contactform.'.$getLang.'.xml','r');
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
				$old_lang           = $getLang;
				//$contactform_xml->read_section('email', 'language');
				
				$langExist = 1;
			}
			else {
				$langExist = 0;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT * "
			."FROM ".$tcms_db_prefix."contactform "
			."WHERE language = '".$getLang."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$langExist = $sqlAL->getNumber($sqlQR);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$old_show_cisb      = $sqlObj->show_contacts_in_sidebar;
			$old_email          = $sqlObj->contact;
			$old_contact_title  = $sqlObj->contacttitle;
			$old_contact_stamp  = $sqlObj->contactstamp;
			$old_contact_text   = $sqlObj->contacttext;
			$old_send_id        = $sqlObj->send_id;
			$old_cform_access   = $sqlObj->access;
			$old_enabled        = $sqlObj->enabled;
			$old_use_adressbook = $sqlObj->use_adressbook;
			$old_use_contact    = $sqlObj->use_contact;
			$old_show_ce        = $sqlObj->show_contactemail;
			$old_lang           = $sqlObj->language;
		}
		
		
		if($langExist == 0) {
			$old_send_id = 'contactform';
			$old_lang = $getLang;
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
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_contactform" method="post">'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="extra" type="hidden" value="1" />'
		.'<input name="todo" type="hidden" value="save_cform" />';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo $tcms_html->tableHeadNoBorder('1', '0', '0', '100%');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_contactform'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_lang" name="new_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_lang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr>'
		.$tcms_html->tableEnd();
		
		
		
		//table
		echo $tcms_html->tableHeadNoBorder('1', '0', '0', '100%');
		
		
		//table head
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini">'
		.'<strong>'._EXT_CFORM.'</strong></td></tr>';
		
		
		// table row
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._TABLE_ENABLED.'</td>'
		.'<td>'
		.'<input type="radio" name="new_enabled" id="config_offline0" value="0"'.($old_enabled == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input type="radio" name="new_enabled" id="config_offline1" value="1"'.($old_enabled == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" name="use_show_cisb" '.( $old_show_cisb == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_USE_ADRESSBOOK.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" name="new_use_adressbook" '.( $old_use_adressbook == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_USE_CONTACTPERSON.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" name="new_use_contact" '.( $old_use_contact == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._EXT_CFORM_SHOW_CONTACTEMAIL.'</td>'
		.'<td colspan="2">'
		.'<input type="checkbox" name="new_show_ce" '.( $old_show_ce == 1 ? 'checked="checked"' : '' ).' value="1" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_ID.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input name="new_send_id" readonly class="tcms_input_small" value="'.$old_send_id.'" /></td></tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td colspan="2">'
		.'<select name="cform_access" class="tcms_select">'
			.'<option value="Public"'.( $old_cform_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_cform_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_cform_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_EMAIL.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input name="email" class="tcms_input_normal" value="'.$old_email.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_TITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input name="tmp_contact_title" class="tcms_input_normal" value="'.$old_contact_title.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_CFORM_SUBTITLE.'</td>'
		.'<td valign="top" colspan="2">'
		.'<input name="contact_stamp" class="tcms_input_normal" value="'.$old_contact_stamp.'" /></td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top" colspan="2"><br />'._TABLE_TEXT
		.( $show_wysiwyg != 'fckeditor' ? '<br /><br />'
		.'<script>'
		.'createToendaToolbar(\'imp\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');'
		.'</script>' : '' );
		
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor') {
			if($show_wysiwyg == 'toendaScript') {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			}
			else {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'HTML\');</script>';
			}
		}
		
		echo '<br /><br />';
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'
			.$old_contact_text
			.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_contact_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'
			.$old_contact_text
			.'</textarea>';
		}
		
		echo '<br /></td></tr>';
		
		
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
		
		
		if($tcms_main->isReal($new_lang)) {
			$setLang = $tcms_config->getLanguageCodeForTCMS($new_lang);
		}
		else {
			$setLang = '';
		}
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/contactform.'.$setLang.'.xml', 'w');
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
			$xmluser->write_value('language', $new_lang);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('email');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($lang_exist > 0) {
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
				
				switch($choosenDB) {
					case 'mysql':
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'contactform', 
							$newSQLData, 
							'send_id', 
							'contactform" AND language = "'.$setLang
						);
						break;
					
					default:
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'contactform', 
							$newSQLData, 
							'send_id', 
							"contactform' AND language = '".$setLang
						);
						break;
				}
			}
			else {
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`contact`, `show_contacts_in_sidebar`, '
						.'`send_id`, `contacttitle`, `contactstamp`, `contacttext`, '
						.'`access`, `enabled`, `use_adressbook`, `use_contact`, '
						.'`show_contactemail`, `language`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'contact, show_contacts_in_sidebar, '
						.'send_id, contacttitle, "contactstamp", contacttext, '
						.'access, enabled, use_adressbook, use_contact, '
						.'show_contactemail, "language"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[contact], [show_contacts_in_sidebar], '
						.'[send_id], [contacttitle], [contactstamp], [contacttext], '
						.'[access], [enabled], [use_adressbook], [use_contact], '
						.'[show_contactemail], [language]';
						break;
				}
				
				$newSQLData = "'".$email."', ".$use_show_cisb.", "
				."'".$new_send_id."', '".$tmp_contact_title."', "
				."'".$contact_stamp."', '".$content."', "
				."'".$cform_access."', ".$new_enabled.", "
				.$new_use_adressbook.", ".$new_use_contact.", "
				.$new_show_ce.", '".$setLang."'";
				
				$maintag = $tcms_main->getNewUID(11, 'contactform');
				
				$sqlQR = $sqlAL->createOne(
					$tcms_db_prefix.'contactform', 
					$newSQLColumns, 
					$newSQLData, 
					$maintag
				);
			}
		}
		
		
		if($setLang != '') {
			$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contactform'
			.'&lang='.$setLang.'\''
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_contactform'
			.'</script>';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
