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
 * @version 0.6.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
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



echo '<script language="JavaScript" src="../js/dhtml.js"></script>
<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';


if(!isset($todo)) {
	$todo = '';
}


if($id_group == 'Developer' 
|| $id_group == 'Administrator') {
	if($todo != 'save_book') {
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
			
			unset($tcms_tinyMCE);
		}
		
		
		if($tcms_main->isReal($lang)) {
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		}
		else {
			$getLang = $tcms_front_lang;
		}
		
		
		if($choosenDB == 'xml') {
			if(file_exists(_TCMS_PATH.'/tcms_global/guestbook.'.$getLang.'.xml')) {
				$guestbook_xml = new xmlparser(_TCMS_PATH.'/tcms_global/guestbook.'.$getLang.'.xml','r');
				$old_guest_id         = $guestbook_xml->readSection('config', 'guest_id');
				$old_booktitle        = $guestbook_xml->readSection('config', 'booktitle');
				$old_bookstamp        = $guestbook_xml->readSection('config', 'bookstamp');
				$old_text             = $guestbook_xml->readSection('config', 'text');
				$old_guestbook_access = $guestbook_xml->readSection('config', 'access');
				$old_enabled          = $guestbook_xml->readSection('config', 'enabled');
				$old_clean_link       = $guestbook_xml->readSection('config', 'clean_link');
				$old_clean_script     = $guestbook_xml->readSection('config', 'clean_script');
				$old_convert_at       = $guestbook_xml->readSection('config', 'convert_at');
				$old_show_email       = $guestbook_xml->readSection('config', 'show_email');
				$old_name_width       = $guestbook_xml->readSection('config', 'name_width');
				$old_text_width       = $guestbook_xml->readSection('config', 'text_width');
				$arr_color[0]         = $guestbook_xml->readSection('config', 'color_row_1');
				$arr_color[1]         = $guestbook_xml->readSection('config', 'color_row_2');
				$old_lang           = $getLang;
				
				$guestbook_xml->flush();
				unset($guestbook_xml);
				
				$langExist = 1;
			}
			else {
				$langExist = 0;
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT * "
			."FROM ".$tcms_db_prefix."guestbook "
			."WHERE language = '".$getLang."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$langExist = $sqlAL->getNumber($sqlQR);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$old_guest_id         = $sqlObj->guest_id;
			$old_booktitle        = $sqlObj->booktitle;
			$old_bookstamp        = $sqlObj->bookstamp;
			$old_text             = $sqlObj->text;
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
			$old_lang           = $sqlObj->language;
			
			if($old_clean_link   == NULL){ $old_clean_link   = ''; }
			if($old_clean_script == NULL){ $old_clean_script = ''; }
			if($old_convert_at   == NULL){ $old_convert_at   = ''; }
			if($old_show_email   == NULL){ $old_show_email   = ''; }
			if($old_name_width   == NULL){ $old_name_width   = ''; }
			if($old_text_width   == NULL){ $old_text_width   = ''; }
			if($arr_color[0]     == NULL){ $arr_color[0]     = ''; }
			if($arr_color[1]     == NULL){ $arr_color[1]     = ''; }
		}
		
		
		if($langExist == 0) {
			$old_send_id = 'contactform';
			$old_lang = $getLang;
		}
		
		
		// CHARSETS
		$old_booktitle = $tcms_main->decodeText($old_booktitle, '2', $c_charset);
		$old_bookstamp = $tcms_main->decodeText($old_bookstamp, '2', $c_charset);
		$old_text      = $tcms_main->decodeText($old_text, '2', $c_charset);
		
		
		$old_booktitle = htmlspecialchars($old_booktitle);
		$old_bookstamp = htmlspecialchars($old_bookstamp);
		$old_text      = htmlspecialchars($old_text);
		
		
		switch(trim($show_wysiwyg)){
			case 'tinymce':
				//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
				$old_text = stripslashes($old_text);
				break;
			
			case 'fckeditor':
				$old_text = str_replace('src="', 'src="../../../../', $old_text);
				$old_text = str_replace('src="../../../../http:', 'src="http:', $old_text);
				$old_text = str_replace('src="../../../../https:', 'src="https:', $old_text);
				$old_text = str_replace('src="../../../../ftp:', 'src="ftp:', $old_text);
				$old_text = str_replace('src="../../../..//', 'src="/', $old_text);
				break;
			
			default:
				$old_text = ereg_replace('<br />'.chr(10), chr(13), $old_text);
				$old_text = ereg_replace('<br />'.chr(13), chr(13), $old_text);
				$old_text = ereg_replace('<br />', chr(13), $old_text);
				
				$old_text = ereg_replace('<br/>'.chr(10), chr(13), $old_text);
				$old_text = ereg_replace('<br/>'.chr(13), chr(13), $old_text);
				$old_text = ereg_replace('<br/>', chr(13), $old_text);
				
				$old_text = ereg_replace('<br>'.chr(10), chr(13), $old_text);
				$old_text = ereg_replace('<br>'.chr(13), chr(13), $old_text);
				$old_text = ereg_replace('<br>', chr(13), $old_text);
				break;
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$old_text = str_replace('src="', 'src="../../', $old_text);
		}
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook_config" method="post">'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="extra" type="hidden" value="1" />'
		.'<input name="todo" type="hidden" value="save_book" />';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo $tcms_html->tableHeadNoBorder('1', '5', '0', '100%');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_guestbook_config'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_lang" name="new_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_lang == $languages['code'][$key]) {
				$dl = ' selected="selected"';
			}
			else {
				$dl = '';
			}
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr>'
		.$tcms_html->tableEnd();
		
		
		
		/*
			tabpane start
		*/
		
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			text tab
		*/
		
		echo '<div class="tab-page" id="tab-page-text">'
		.'<h2 class="tab">'._TABLE_DESCRIPTION.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'
		._EXT_BOOK_ID
		.'</td><td valign="top">'
		.'<input onchange="CHANGED = true;" name="new_guest_id" readonly class="tcms_input_small" value="'.$old_guest_id.'" />'
		.'</td>'
		.'</tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'
		._EXT_BOOK_TITLE
		.'</td><td valign="top">'
		.'<input onchange="CHANGED = true;" name="booktitle" class="tcms_input_normal" value="'.$old_booktitle.'" />'
		.'</td>'
		.'</tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'
		._EXT_BOOK_SUBTITLE
		.'</td><td valign="top">'
		.'<input onchange="CHANGED = true;" name="bookstamp" class="tcms_input_normal" value="'.$old_bookstamp.'" />'
		.'</td>'
		.'</tr>';
		
		
		echo '<tr><td class="tcms_padding_mini" colspan="2" valign="top">'
		.'<br /></td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td valign="top" colspan="2">'
		.'<br />'._TABLE_TEXT
		.( $show_wysiwyg != 'fckeditor' 
			? '<br /><br />'
			.'<script>'
			.'createToendaToolbar(\'imp\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');'
			.'</script>' 
			: '' 
		);
		
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor') {
			if($show_wysiwyg == 'toendaScript') {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			}
			else if($show_wysiwyg == 'Wiki') {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'Wiki\');</script>';
			}
			else {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'HTML\');</script>';
			}
		}
		
		echo '<br /><br />';
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content"'
			//.' mce_editable="true"'
			.'>'
			.$old_text
			.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'
			.$old_text
			.'</textarea>';
		}
		
		echo '<br /></td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			mod tab
		*/
		
		echo '<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table row
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'
		._TABLE_ENABLED
		.'</td><td>'
		.'<input onchange="CHANGED = true;" type="radio" name="new_enabled" id="config_offline0" value="0"'.($old_enabled == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input onchange="CHANGED = true;" type="radio" name="new_enabled" id="config_offline1" value="1"'.($old_enabled == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td>'
		.'</tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td>'
		.'<select onchange="CHANGED = true;" name="guestbook_access" class="tcms_select">'
			.'<option value="Public"'.( $old_guestbook_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_guestbook_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_guestbook_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini">'._BOOK_WIDTH_NAME.'</td>'
		.'<td>'
		.'<select onchange="CHANGED = true;" name="new_name_width" class="tcms_select">';
		for($i = 0; $i <= 500; ){
			echo '<option value="'.$i.'"'.( $old_name_width == $i ? ' selected="selected"' : '' ).'>'.$i.' Pixel</option>';
			$i += 10;
		}
		echo '</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini">'._BOOK_WIDTH_TEXT.'</td>'
		.'<td>'
		.'<select onchange="CHANGED = true;" name="new_text_width" class="tcms_select">';
		for($i = 0; $i <= 500; ){
			echo '<option value="'.$i.'"'.( $old_text_width == $i ? ' selected="selected"' : '' ).'>'.$i.' Pixel</option>';
			$i += 10;
		}
		echo '</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_1.'</td>'
		.'<td valign="top">'
		.'<input onchange="CHANGED = true;" name="new_arr_color0" id="color1" class="tcms_id_box" value="'.$arr_color[0].'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color1\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_2.'</td>'
		.'<td valign="top">'
		.'<input onchange="CHANGED = true;" name="new_arr_color1" id="color2" class="tcms_id_box" value="'.$arr_color[1].'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color2\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">&nbsp;</td>'
		.'<td valign="top" colspan="2">&nbsp;</td></tr>';
		
		
		// table rows
		echo '<tr><td></td><td valign="top">'
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
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			tabpane end
		*/
		
		echo '</div>'
		.'<script type="text/javascript">
		var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
		tabPane1.addTabPage(document.getElementById("tab-page-text"));
		tabPane1.addTabPage(document.getElementById("tab-page-set"));
		setupAllTabs();
		</script>'
		.'<br />';
		
		
		// Table end
		echo '</form><br />';
	}
	
	
	
	
	// --------------------------------------------------
	// SAVE, EDIT AND DELETE
	// --------------------------------------------------
	
	if($todo == 'save_book'){
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
			$content = $tcms_main->convertNewlineToHTML($content);
		}
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$content = str_replace('src="../../', 'src="', $content);
		}
		
		$content   = $tcms_main->encodeText($content, '2', $c_charset);
		$booktitle = $tcms_main->encodeText($booktitle, '2', $c_charset);
		$bookstamp = $tcms_main->encodeText($bookstamp, '2', $c_charset);
		
		
		if(empty($booktitle)){ $booktitle = ''; }
		if(empty($bookstamp)){ $bookstamp = ''; }
		
		
		if(empty($new_enabled)      || $new_enabled      == '' || !isset($new_enabled))     { $new_enabled      = 0; }
		if(empty($new_clean_link)   || $new_clean_link   == '' || !isset($new_clean_link))  { $new_clean_link   = 0; }
		if(empty($new_clean_script) || $new_clean_script == '' || !isset($new_clean_script)){ $new_clean_script = 0; }
		if(empty($new_convert_at)   || $new_convert_at   == '' || !isset($new_convert_at))  { $new_convert_at   = 0; }
		if(empty($new_show_email)   || $new_show_email   == '' || !isset($new_show_email))  { $new_show_email   = 0; }
		
		
		if($tcms_main->isReal($new_lang)) {
			$setLang = $tcms_config->getLanguageCodeForTCMS($new_lang);
		}
		else {
			$setLang = '';
		}
		
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/guestbook.'.$setLang.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('config');
			
			$xmluser->write_value('guest_id', $new_guest_id);
			$xmluser->write_value('booktitle', $booktitle);
			$xmluser->write_value('bookstamp', $bookstamp);
			$xmluser->write_value('text', $content);
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
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($lang_exist > 0) {
				$newSQLData = ''
				.$tcms_db_prefix.'guestbook.guest_id="'.$new_guest_id.'", '
				.$tcms_db_prefix.'guestbook.booktitle="'.$booktitle.'", '
				.$tcms_db_prefix.'guestbook.bookstamp="'.$bookstamp.'", '
				.$tcms_db_prefix.'guestbook.text="'.$content.'", '
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
				
				switch($choosenDB) {
					case 'mysql':
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'guestbook', 
							$newSQLData, 
							'guest_id', 
							'guestbook" AND language = "'.$setLang
						);
						break;
					
					default:
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'guestbook', 
							$newSQLData, 
							'guest_id', 
							"guestbook' AND language = '".$setLang
						);
						break;
				}
			}
			else {
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`guest_id`, `booktitle`, '
						.'`bookstamp`, `text`, `access`, `enabled`, '
						.'`clean_link`, `clean_script`, `convert_at`, `show_email`, '
						.'`name_width`, `text_width`, `color_row_1`, `color_row_2`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'guest_id, booktitle, '
						.'bookstamp, text, "access", enabled, '
						.'clean_link, clean_script, convert_at, show_email, '
						.'name_width, "text_width", color_row_1, color_row_2';
						break;
					
					case 'mssql':
						$newSQLColumns = '[guest_id], [booktitle], '
						.'[bookstamp], [text], [access], [enabled], '
						.'[clean_link], [clean_script], [convert_at], [show_email], '
						.'[name_width], [text_width], [color_row_1], [color_row_2]';
						break;
				}
				
				$newSQLData = "'guestbook', '".$booktitle."', "
				."'".$bookstamp."', '".$content."', "
				."'".$guestbook_access."', ".$new_enabled.", "
				.$new_clean_link.", ".$new_clean_script.", "
				.$new_convert_at.", ".$new_show_email.", "
				."'".$new_name_width."', '".$new_text_width."', "
				."'".$new_arr_color0."', '".$new_arr_color1."'";
				
				$maintag = $tcms_main->getNewUID(9, 'guestbook');
				
				$sqlQR = $sqlAL->createOne(
					$tcms_db_prefix.'guestbook', 
					$newSQLColumns, 
					$newSQLData, 
					$maintag, true
				);
			}
		}
		
		
		if($setLang != '') {
			$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook_config'
			.'&lang='.$setLang.'\''
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook_config'
			.'</script>';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
