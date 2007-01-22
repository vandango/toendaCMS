<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Frontpage Manager
|
| File:	mod_frontpage.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Frontpage Manager
 *
 * This module is used for the frontpage.
 *
 * @version 0.7.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_POST['extra'])){ $extra = $_POST['extra']; }
if(isset($_POST['front_id'])){ $front_id = $_POST['front_id']; }
if(isset($_POST['front_title'])){ $front_title = $_POST['front_title']; }
if(isset($_POST['front_stamp'])){ $front_stamp = $_POST['front_stamp']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_news_title'])){ $new_news_title = $_POST['new_news_title']; }
if(isset($_POST['news_cut'])){ $news_cut = $_POST['news_cut']; }
if(isset($_POST['module_use_0'])){ $module_use_0 = $_POST['module_use_0']; }
if(isset($_POST['new_sb_news_title'])){ $new_sb_news_title = $_POST['new_sb_news_title']; }
if(isset($_POST['sb_module_use_0'])){ $sb_module_use_0 = $_POST['sb_module_use_0']; }
if(isset($_POST['sb_news_cut'])){ $sb_news_cut = $_POST['sb_news_cut']; }
if(isset($_POST['new_sb_enabled'])){ $new_sb_enabled = $_POST['new_sb_enabled']; }
if(isset($_POST['new_sb_display'])){ $new_sb_display = $_POST['new_sb_display']; }
if(isset($_POST['new_front_lang'])){ $new_front_lang = $_POST['new_front_lang']; }
if(isset($_POST['lang_exist'])){ $lang_exist = $_POST['lang_exist']; }



if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	if($show_wysiwyg == 'tinymce'){
		if($todo == 'config'){
			echo '<style>.tableRowLight{ background-color: #ececec; }.tableRowDark{ background-color: #333333; }</style>';
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
		}
	}
	
	
	echo '<script language="JavaScript" src="../js/dhtml.js"></script>';
	
	$c_xml      = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
	$c_charset  = $c_xml->read_section('global', 'charset');
	
	
	
	
	// -----------------------------------------------------
	// INIT
	// -----------------------------------------------------
	
	if($tcms_main->isReal($lang))
		$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
	else
		$getLang = $tcms_front_lang;
	
	if($choosenDB == 'xml'){
		if(file_exists('../../'.$tcms_administer_site.'/tcms_global/frontpage.'.$getLang.'.xml')) {
			$front_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/frontpage.'.$getLang.'.xml', 'r');
			$old_front_id        = $front_xml->read_section('front', 'front_id');
			$old_front_title     = $front_xml->read_section('front', 'front_title');
			$old_front_stamp     = $front_xml->read_section('front', 'front_stamp');
			$old_front_text      = $front_xml->read_section('front', 'front_text');
			$old_news_title      = $front_xml->read_section('front', 'news_title');
			$old_news_cut        = $front_xml->read_section('front', 'news_cut');
			$old_module_use_0    = $front_xml->read_section('front', 'module_use_0');
			$old_sb_news_title   = $front_xml->read_section('front', 'sb_news_title');
			$old_sb_module_use_0 = $front_xml->read_section('front', 'sb_news_amount');
			$old_sb_news_cut     = $front_xml->read_section('front', 'sb_news_chars');
			$old_sb_enabled      = $front_xml->read_section('front', 'sb_news_enabled');
			$old_sb_display      = $front_xml->read_section('front', 'sb_news_display');
			
			if($old_front_id        == false){ $old_front_id        = ''; }
			if($old_front_title     == false){ $old_front_title     = ''; }
			if($old_front_stamp     == false){ $old_front_stamp     = ''; }
			if($old_front_text      == false){ $old_front_text      = ''; }
			if($old_news_title      == false){ $old_news_title      = ''; }
			if($old_news_cut        == false){ $old_news_cut        = ''; }
			if($old_module_use_0    == false){ $old_module_use_0    = ''; }
			if($old_sb_news_title   == false){ $old_sb_news_title   = ''; }
			if($old_sb_module_use_0 == false){ $old_sb_module_use_0 = ''; }
			if($old_sb_news_cut     == false){ $old_sb_news_cut     = ''; }
			if($old_sb_enabled      == false){ $old_sb_enabled      = ''; }
			if($old_sb_display      == false){ $old_sb_display      = ''; }
		}
		else {
			$langExist = 0;
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$strQuery = "SELECT * "
		."FROM ".$tcms_db_prefix."frontpage "
		."WHERE language = '".$getLang."'";
		
		$sqlQR = $sqlAL->sqlQuery($strQuery);
		$langExist = $sqlAL->sqlGetNumber($sqlQR);
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$old_front_id        = $sqlObj->front_id;
		$old_front_title     = $sqlObj->front_title;
		$old_front_stamp     = $sqlObj->front_stamp;
		$old_front_text      = $sqlObj->front_text;
		$old_news_title      = $sqlObj->news_title;
		$old_news_cut        = $sqlObj->news_cut;
		$old_module_use_0    = $sqlObj->module_use_0;
		$old_sb_news_title   = $sqlObj->sb_news_title;
		$old_sb_module_use_0 = $sqlObj->sb_news_amount;
		$old_sb_news_cut     = $sqlObj->sb_news_chars;
		$old_sb_enabled      = $sqlObj->sb_news_enabled;
		$old_sb_display      = $sqlObj->sb_news_display;
		$old_front_lang      = $sqlObj->language;
		
		if($old_front_id        == NULL){ $old_front_id        = ''; }
		if($old_front_title     == NULL){ $old_front_title     = ''; }
		if($old_front_stamp     == NULL){ $old_front_stamp     = ''; }
		if($old_front_text      == NULL){ $old_front_text      = ''; }
		if($old_news_title      == NULL){ $old_news_title      = ''; }
		if($old_news_cut        == NULL){ $old_news_cut        = ''; }
		if($old_module_use_0    == NULL){ $old_module_use_0    = ''; }
		if($old_sb_news_title   == NULL){ $old_sb_news_title   = ''; }
		if($old_sb_module_use_0 == NULL){ $old_sb_module_use_0 = ''; }
		if($old_sb_news_cut     == NULL){ $old_sb_news_cut     = ''; }
		if($old_sb_enabled      == NULL){ $old_sb_enabled      = ''; }
		if($old_sb_display      == NULL){ $old_sb_display      = ''; }
	}
	
	
	if($langExist == 0) {
		$old_front_lang = $getLang;
	}
	
	
	if($todo != 'config'){
		$old_front_title   = $tcms_main->decodeText($old_front_title, '2', $c_charset);
		$old_front_stamp   = $tcms_main->decodeText($old_front_stamp, '2', $c_charset);
		$old_front_text    = $tcms_main->decodeText($old_front_text, '2', $c_charset);
		
		$old_front_title   = htmlspecialchars($old_front_title);
		$old_front_stamp   = htmlspecialchars($old_front_stamp);
		$old_sb_news_title = htmlspecialchars($old_sb_news_title);
		
		
		
		switch(trim($show_wysiwyg)){
			case 'tinymce':
				//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
				$old_front_text = stripslashes($old_front_text);
				break;
			
			case 'fckeditor':
				$old_front_text = str_replace('src="', 'src="../../../../', $old_front_text);
				$old_front_text = str_replace('src="../../../../http:', 'src="http:', $old_front_text);
				$old_front_text = str_replace('src="../../../../https:', 'src="https:', $old_front_text);
				$old_front_text = str_replace('src="../../../../ftp:', 'src="ftp:', $old_front_text);
				$old_front_text = str_replace('src="../../../..//', 'src="/', $old_front_text);
				break;
			
			default:
				$old_front_text = ereg_replace('<br />'.chr(10), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br />'.chr(13), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br />', chr(13), $old_front_text);
				
				$old_front_text = ereg_replace('<br/>'.chr(10), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br/>'.chr(13), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br/>', chr(13), $old_front_text);
				
				$old_front_text = ereg_replace('<br>'.chr(10), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br>'.chr(13), chr(13), $old_front_text);
				$old_front_text = ereg_replace('<br>', chr(13), $old_front_text);
				break;
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
		}
	}
	else{
		$old_front_text = $tcms_main->encodeBase64($old_front_text);
	}
	
	
	$old_news_title    = $tcms_main->decodeText($old_news_title, '2', $c_charset);
	$old_sb_news_title = $tcms_main->decodeText($old_sb_news_title, '2', $c_charset);
	
	
	
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_frontpage" method="post" id="front">';
	
	
	if($todo == 'config'){
		// BEGIN FORM
		echo '<input name="todo" type="hidden" value="save" />'
		.'<input name="extra" type="hidden" value="1" />'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="front_title" type="hidden" value="'.$old_front_title.'" />'
		.'<input name="front_stamp" type="hidden" value="'.$old_front_stamp.'" />'
		.'<input name="content" type="hidden" value="'.$old_front_text.'" />';
		
		// table rows
		$front_id = $old_front_id;
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo $tcms_html->tableHeadClass('1', '5', '0', '100%', 'tcms_table');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_frontpage'
		.'&amp;todo=config'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select id="new_front_lang" name="new_front_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_front_lang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr>'
		.$tcms_html->tableEnd();
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._FRONTPAGE_NEWS.'</th>'
		.'</tr></table>';
		
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_NEWS_TITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_news_title" class="tcms_input_normal" value="'.$old_news_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_NEWS_MUCH.'</strong>'
		.'</td><td valign="top">'
		.'<input name="module_use_0" class="tcms_id_box" value="'.$old_module_use_0.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_NEWS_CHARS.'</strong>'
		.'</td><td valign="top">'
		.'<input name="news_cut" class="tcms_id_box" value="'.$old_news_cut.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr></table>';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._FRONTPAGE_SIDEBAR_NEWS.'</th>'
		.'</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_SIDEBAR_NEWS_USE.'</strong>'
		.'</td><td valign="top">'
		.'<input type="checkbox" name="new_sb_enabled" '.( $old_sb_enabled == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_SIDEBAR_NEWS_TITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_sb_news_title" class="tcms_input_normal" value="'.$old_sb_news_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_SIDEBAR_NEWS_MUCH.'</strong>'
		.'</td><td valign="top">'
		.'<input name="sb_module_use_0" class="tcms_id_box" value="'.$old_sb_module_use_0.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_NEWS_CHARS.'</strong>'
		.'</td><td valign="top">'
		.'<input name="sb_news_cut" class="tcms_id_box" value="'.$old_sb_news_cut.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'
		.'<strong class="tcms_bold">'._FRONTPAGE_NEWS_DISPLAY.'</strong>'
		.'</td><td>'
		.'<select name="new_sb_display" class="tcms_select">'
		.'<option value="1"'.( $old_sb_display == '1' ? ' selected="selected"' : '' ).'>'._FRONTPAGE_TDT.'</option>'
		.'<option value="2"'.( $old_sb_display == '2' ? ' selected="selected"' : '' ).'>'._FRONTPAGE_TD.'</option>'
		.'<option value="3"'.( $old_sb_display == '3' ? ' selected="selected"' : '' ).'>'._FRONTPAGE_T.'</option>'
		.'</select></td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr></table>';
	}
	else{
		// BEGIN FORM
		echo '<input name="todo" type="hidden" value="save" />'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="new_news_title" type="hidden" value="'.$old_news_title.'" />'
		.'<input name="module_use_0" type="hidden" value="'.$old_module_use_0.'" />'
		.'<input name="news_cut" type="hidden" value="'.$old_news_cut.'" />'
		.'<input name="new_sb_news_title" type="hidden" value="'.$old_sb_news_title.'" />'
		.'<input name="sb_module_use_0" type="hidden" value="'.$old_sb_module_use_0.'" />'
		.'<input name="new_sb_enabled" type="hidden" value="'.$old_sb_enabled.'" />'
		.'<input name="new_sb_display" type="hidden" value="'.$old_sb_display.'" />'
		.'<input name="sb_news_cut" type="hidden" value="'.$old_sb_news_cut.'" />';
		
		
		// TABLE FOR OUTPUT AND INPUT
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table rows
		$front_id = $old_front_id;
		
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_frontpage'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select id="new_front_lang" name="new_front_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_front_lang == $languages['code'][$key])
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
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr></table>';
		
		
		// TABLE FOR OUTPUT AND INPUT
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._FRONTPAGE_CONFIG.'</th>'
		.'</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_TITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input name="front_title" class="tcms_input_normal" value="'.$old_front_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._FRONTPAGE_SUBTITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input name="front_stamp" class="tcms_input_normal" value="'.$old_front_stamp.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr></table>';
		
		
		// table rows
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._FRONTPAGE_TEXT.'</th>'
		.'</tr></table>';
		
		
		// table
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table row
		echo '<tr><td valign="top" colspan="2">'
		.( $show_wysiwyg != 'fckeditor' ? ''
		.'<script>createToendaToolbar(\'front\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>'
		: '' );
		
		if($show_wysiwyg == 'tinymce'){ echo '<br />'; }
		elseif($show_wysiwyg == 'fckeditor'){ }
		else{
			if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'front\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else{ echo '<script>createToolbar(\'front\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		if($show_wysiwyg != 'fckeditor'){
			echo '<br />';
		}
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'.$old_front_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_front_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content">'.$old_front_text.'</textarea>';
		}
		
		echo '</td></tr>';
		
		echo '</table>';
	}
	
	
	echo '</form><br />';
	
	
	
	
	// -------------------------------------------------
	// SAVE, EDIT AND DELETE
	// -------------------------------------------------
	
	if($todo == 'save') {
		if($front_id          == ''){ $front_id            = 0; }
		if($front_title       == ''){ $front_title         = ''; }
		if($front_stamp       == ''){ $front_stamp         = ''; }
		if($content           == ''){ $content             = ''; }
		if($new_news_title    == ''){ $new_news_title      = ''; }
		if($news_cut          == ''){ $news_cut            = 0; }
		if($module_use_0      == ''){ $module_use_0        = 0; }
		if($new_sb_news_title == ''){ $new_sb_news_title   = ''; }
		if($sb_module_use_0   == ''){ $sb_module_use_0     = 0; }
		if($sb_news_cut       == ''){ $sb_news_cut         = 0; }
		if(empty($new_sb_enabled))  { $new_sb_enabled      = 0; }
		if(empty($new_sb_display))  { $new_sb_display      = 0; }
		
		
		if($extra != 1){
			$old_front_text = str_replace('src="../../../../http:', 'src="http:', $old_front_text);
			
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
			
			$front_title       = $tcms_main->decode_text($front_title, '2', $c_charset);
			$front_stamp       = $tcms_main->decode_text($front_stamp, '2', $c_charset);
			$content           = $tcms_main->decode_text($content, '2', $c_charset);
		}
		else{
			$content = $tcms_main->decodeBase64($content);
		}
		
		$new_news_title    = $tcms_main->decode_text($new_news_title, '2', $c_charset);
		$new_sb_news_title = $tcms_main->decode_text($new_sb_news_title, '2', $c_charset);
		
		
		if($tcms_main->isReal($new_front_lang)) {
			$setLang = $tcms_config->getLanguageCodeForTCMS($new_front_lang);
		}
		else {
			$setLang = '';
		}
		
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/frontpage.'.$setLang.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('front');
			
			$xmluser->write_value('language', $setLang);
			$xmluser->write_value('front_id', $front_id);
			$xmluser->write_value('front_title', $front_title);
			$xmluser->write_value('front_stamp', $front_stamp);
			$xmluser->write_value('front_text', $content);
			$xmluser->write_value('news_title', $new_news_title);
			$xmluser->write_value('news_cut', $news_cut);
			$xmluser->write_value('module_use_0', $module_use_0);
			$xmluser->write_value('sb_news_title', $new_sb_news_title);
			$xmluser->write_value('sb_news_amount', $sb_module_use_0);
			$xmluser->write_value('sb_news_chars', $sb_news_cut);
			$xmluser->write_value('sb_news_enabled', $new_sb_enabled);
			$xmluser->write_value('sb_news_display', $new_sb_display);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('front');
			$xmluser->_xmlparser();
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($lang_exist == '1') {
				$newSQLData = ''
				.$tcms_db_prefix.'frontpage.front_id="'.$front_id.'", '
				.$tcms_db_prefix.'frontpage.front_title="'.$front_title.'", '
				.$tcms_db_prefix.'frontpage.front_stamp="'.$front_stamp.'", '
				.$tcms_db_prefix.'frontpage.front_text="'.$content.'", '
				.$tcms_db_prefix.'frontpage.news_title="'.$new_news_title.'", '
				.$tcms_db_prefix.'frontpage.news_cut='.$news_cut.', '
				.$tcms_db_prefix.'frontpage.module_use_0='.$module_use_0.', '
				.$tcms_db_prefix.'frontpage.sb_news_title="'.$new_sb_news_title.'", '
				.$tcms_db_prefix.'frontpage.sb_news_amount='.$sb_module_use_0.', '
				.$tcms_db_prefix.'frontpage.sb_news_chars='.$sb_news_cut.', '
				.$tcms_db_prefix.'frontpage.sb_news_enabled='.$new_sb_enabled.', '
				.$tcms_db_prefix.'frontpage.sb_news_display='.$new_sb_display;
				
				switch($choosenDB) {
					case 'mysql':
						$sqlQR = $sqlAL->sqlUpdateField(
							$tcms_db_prefix.'frontpage', 
							$newSQLData, 
							'front_id', 
							'frontpage" AND language = "'.$setLang
						);
						break;
					
					default:
						$sqlQR = $sqlAL->sqlUpdateField(
							$tcms_db_prefix.'frontpage', 
							$newSQLData, 
							'front_id', 
							"frontpage' AND language = '".$setLang
						);
						break;
				}
			}
			else {
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`front_id`, `front_title`, `front_stamp`, `front_text`, '
						.'`news_title`, `news_cut`, `module_use_0`, `sb_news_title`, '
						.'`sb_news_amount`, `sb_news_chars`, `sb_news_enabled`, `sb_news_display`, '
						.'`language`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'front_id, front_title, front_stamp, front_text, '
						.'"news_title", news_cut, module_use_0, sb_news_title, '
						.'sb_news_amount, sb_news_chars, sb_news_enabled, "sb_news_display", '
						.'"language"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[front_id], [front_title], [front_stamp], [front_text], '
						.'[news_title], [news_cut], [module_use_0], [sb_news_title], '
						.'[sb_news_amount], [sb_news_chars], [sb_news_enabled], [sb_news_display], '
						.'[language]';
						break;
				}
				
				$newSQLData = "'".$front_id."', '".$front_title."', '".$front_stamp."', '".$content."', "
				."'".$new_news_title."', ".$news_cut.", ".$module_use_0.", '".$new_sb_news_title."', "
				.$sb_module_use_0.", ".$sb_news_cut.", ".$new_sb_enabled.", ".$new_sb_display.", "
				."'".$setLang."'";
				
				$maintag = $tcms_main->getNewUID(9, 'frontpage');
				
				$sqlQR = $sqlAL->sqlCreateOne(
					$tcms_db_prefix.'frontpage', 
					$newSQLColumns, 
					$newSQLData, 
					$maintag
				);
			}
		}
		
		if($extra == 1){
			if($setLang != '') {
				$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
				
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_frontpage&todo=config&lang='.$setLang.'\''
				.'</script>';
			}
			else {
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_frontpage&todo=config\''
				.'</script>';
			}
		}
		else{
			if($setLang != '') {
				$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
				
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_frontpage&lang='.$setLang.'\''
				.'</script>';
			}
			else {
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_frontpage\''
				.'</script>';
			}
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
