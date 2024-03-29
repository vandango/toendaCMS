<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Imprint Designer
|
| File:	mod_imprint.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Imprint Designer
 *
 * This module is used for the publishing form.
 *
 * @version 0.7.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['vall'])) { $vall = $_GET['vall']; }

if(isset($_POST['imp_id'])) { $imp_id = $_POST['imp_id']; }
if(isset($_POST['imp_title'])) { $imp_title = $_POST['imp_title']; }
if(isset($_POST['imp_stamp'])) { $imp_stamp = $_POST['imp_stamp']; }
if(isset($_POST['imp_contact'])) { $imp_contact = $_POST['imp_contact']; }
if(isset($_POST['taxno'])) { $taxno = $_POST['taxno']; }
if(isset($_POST['ustid'])) { $ustid = $_POST['ustid']; }
if(isset($_POST['legal'])) { $legal = $_POST['legal']; }
if(isset($_POST['vall'])) { $vall = $_POST['vall']; }
if(isset($_POST['content'])) { $content = $_POST['content']; }
if(isset($_POST['lang_exist'])) { $lang_exist = $_POST['lang_exist']; }
if(isset($_POST['new_imp_lang'])) { $new_imp_lang = $_POST['new_imp_lang']; }



echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';



if($id_group == 'Developer' 
|| $id_group == 'Administrator') {
	if($todo != 'save') {
		if($show_wysiwyg == 'tinymce') {
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
		}
		
		
		// -----------------------------------------------------
		// INIT
		// -----------------------------------------------------
		
		if($tcms_main->isReal($lang)) {
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		}
		else {
			$getLang = $tcms_front_lang;
		}
		
		if($choosenDB == 'xml') {
			if(file_exists(_TCMS_PATH.'/tcms_global/imprint.'.$getLang.'.xml')) {
				$imp_xml = new xmlparser(_TCMS_PATH.'/tcms_global/imprint.'.$getLang.'.xml','r');
				$old_imp_id       = $imp_xml->read_section('imp', 'imp_id');
				$old_imp_title    = $imp_xml->read_section('imp', 'imp_title');
				$old_imp_stamp    = $imp_xml->read_section('imp', 'imp_stamp');
				$old_taxno        = $imp_xml->read_section('imp', 'taxno');
				$old_ustid        = $imp_xml->read_section('imp', 'ustid');
				$old_legal        = $imp_xml->read_section('imp', 'legal');
				$test_imp_contact = $imp_xml->read_section('imp', 'imp_contact');
				$old_imp_lang     = $getLang;
				//$imp_xml->read_section('imp', 'language');
				
				if(!$old_imp_id)       { $old_imp_id       = ''; }
				if(!$old_imp_title)    { $old_imp_title    = ''; }
				if(!$old_imp_stamp)    { $old_imp_stamp    = ''; }
				if(!$old_taxno)        { $old_taxno        = ''; }
				if(!$old_ustid)        { $old_ustid        = ''; }
				if(!$old_legal)        { $old_legal        = ''; }
				if(!$test_imp_contact) { $test_imp_contact = ''; }
				
				$langExist = 1;
			}
			else {
				$langExist = 0;
				$old_imp_id = 'imprint';
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT * "
			."FROM ".$tcms_db_prefix."imprint "
			."WHERE language = '".$getLang."'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$langExist = $sqlAL->sqlGetNumber($sqlQR);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$old_imp_id       = $sqlObj->imp_id;
			$old_imp_title    = $sqlObj->imp_title;
			$old_imp_stamp    = $sqlObj->imp_stamp;
			$old_taxno        = $sqlObj->taxno;
			$old_ustid        = $sqlObj->ustid;
			$old_legal        = $sqlObj->legal;
			$test_imp_contact = $sqlObj->imp_contact;
			$old_imp_lang     = $sqlObj->language;
			
			if($old_imp_id       == NULL) { $old_imp_id       = ''; }
			if($old_imp_title    == NULL) { $old_imp_title    = ''; }
			if($old_imp_stamp    == NULL) { $old_imp_stamp    = ''; }
			if($old_taxno        == NULL) { $old_taxno        = ''; }
			if($old_ustid        == NULL) { $old_ustid        = ''; }
			if($old_legal        == NULL) { $old_legal        = ''; }
			if($test_imp_contact == NULL) { $test_imp_contact = ''; }
		}
		
		
		if($langExist == 0) {
			$old_imp_lang = $getLang;
		}
		
		
		// CHARSETS
		$old_imp_title = $tcms_main->decodeText($old_imp_title, '2', $c_charset);
		$old_imp_stamp = $tcms_main->decodeText($old_imp_stamp, '2', $c_charset);
		$old_taxno     = $tcms_main->decodeText($old_taxno, '2', $c_charset);
		$old_ustid     = $tcms_main->decodeText($old_ustid, '2', $c_charset);
		$old_legal     = $tcms_main->decodeText($old_legal, '2', $c_charset);
		
		$old_imp_title = htmlspecialchars($old_imp_title);
		$old_imp_stamp = htmlspecialchars($old_imp_stamp);
		
		
		if($show_wysiwyg == 'tinymce') {
			$old_legal = stripslashes($old_legal);
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$old_legal = str_replace('src="', 'src="../../../../', $old_legal);
			$old_legal = str_replace('src="../../../../http:', 'src="http:', $old_legal);
			$old_legal = str_replace('src="../../../../https:', 'src="https:', $old_legal);
			$old_legal = str_replace('src="../../../../ftp:', 'src="ftp:', $old_legal);
			$old_legal = str_replace('src="../../../..//', 'src="/', $old_legal);
		}
		else {
			$old_legal = ereg_replace('<br />'.chr(10), chr(13), $old_legal);
			$old_legal = ereg_replace('<br />'.chr(13), chr(13), $old_legal);
			$old_legal = ereg_replace('<br />', chr(13), $old_legal);
			
			$old_legal = ereg_replace('<br/>'.chr(10), chr(13), $old_legal);
			$old_legal = ereg_replace('<br/>'.chr(13), chr(13), $old_legal);
			$old_legal = ereg_replace('<br/>', chr(13), $old_legal);
			
			$old_legal = ereg_replace('<br>'.chr(10), chr(13), $old_legal);
			$old_legal = ereg_replace('<br>'.chr(13), chr(13), $old_legal);
			$old_legal = ereg_replace('<br>', chr(13), $old_legal);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce') {
			//$old_legal = str_replace('src="', 'src="../../', $old_legal);
		}
		
		
		
		if($choosenDB == 'xml') {
			$arr_contacts['all'] = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_contacts/');
			
			if(is_array($arr_contacts['all']) && !empty($arr_contacts['all'])) {
				foreach($arr_contacts['all'] as $key => $val) {
					$contact_xml = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$val,'r');
					$cp = $contact_xml->readValue('published');
					if($cp == 1) {
						$arr_contacts['arr'][$key] = $contact_xml->readValue('name');
						$arr_contacts['all'][$key] = substr($val, 0, 10);
					}
				}
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'contacts WHERE published=1');
			
			$count = 0;
			
			while($sqlARR = $sqlAL->fetchArray($sqlQR)) {
				$arr_contacts['arr'][$count] = $sqlARR['name'];
				$arr_contacts['all'][$count] = $sqlARR['uid'];
				
				if($arr_contacts['arr'][$count] == NULL) { $arr_contacts['arr'][$count] = ''; }
				
				$arr_contacts['arr'][$count] = $tcms_main->decodeText($arr_contacts['arr'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_imprint" method="post" id="imp">'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="extra" type="hidden" value="1" />'
		.'<input name="todo" type="hidden" value="save" />';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo $tcms_html->tableHeadNoBorder('1', '5', '0', '100%');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_imprint'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_imp_lang" name="new_imp_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_imp_lang == $languages['code'][$key])
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
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_ID
		.'</td><td valign="top">'
		.'<input readonly name="imp_id" class="tcms_input_small" value="'.$old_imp_id.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_TITLE
		.'</td><td valign="top">'
		.'<input name="imp_title" class="tcms_input_normal" value="'.$old_imp_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_SUBTITLE
		.'</td><td valign="top">'
		.'<input name="imp_stamp" class="tcms_input_normal" value="'.$old_imp_stamp.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top" colspan="2"><br />'._IMPRESSUM_LEGAL
		.( $show_wysiwyg != 'fckeditor' ? '<br /><br />'
		.'<script>createToendaToolbar(\'imp\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>'
		.'<br />' : '' );
		
		if($show_wysiwyg == 'tinymce') {
		}
		elseif($show_wysiwyg == 'fckeditor') {
		}
		else {
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
		
		if($show_wysiwyg == 'tinymce') {
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content"'
			//.' mce_editable="true"'
			.'>'.$old_legal.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_legal;
			$oFCKeditor->Create();
		}
		else {
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'.$old_legal.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			mod tab
		*/
		
		echo '<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_CONTACT
		.'</td><td valign="top">'
		.'<select class="tcms_select" onchange="document.location=\'admin.php?id_user='.$id_user.'&site=mod_imprint&lang='.$tcms_config->getLanguageCodeByTCMSCode($old_imp_lang).'&vall=\'+this.value;">'
		.'<option value=""> &bull; '._IMPRESSUM_SELECT.' &bull; </option>'
		.'<option value="no_contact"'.( $vall == 'no_contact' || $test_imp_contact == 'no_contact' ? ' selected="selected"' : '' ).'> &bull; '._IMPRESSUM_NO_CONTACT.' &bull; </option>';
		
		arsort($arr_contacts['arr']);
		foreach($arr_contacts['arr'] as $c_key => $c_value) {
			$arr_contacts['arr'][$c_key] = $tcms_main->decodeText($arr_contacts['arr'][$c_key], '2', $c_charset);
			echo '<option name="vall" value="'.$arr_contacts['all'][$c_key].'">'.$arr_contacts['arr'][$c_key].'</option>';
		}
		
		echo '</select></td></tr>';
		
		
		// table rows
		if(isset($vall)) {
			$test_imp_contact = $vall;
		}
		
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">&nbsp;</td>'
		.'<td valign="top">'
		.'<textarea name="text" id="text" class="tcms_textarea_big">';
		
		if($tcms_main->isReal($test_imp_contact) && $test_imp_contact != 'no_contact') {
			if($choosenDB == 'xml') {
				if(file_exists(_TCMS_PATH.'/tcms_contacts/'.$test_imp_contact.'.xml')) {
					$con_xml = new xmlparser(_TCMS_PATH.'/tcms_contacts/'.$test_imp_contact.'.xml','r');
					
					$contact['name']     = $con_xml->readValue('name');
					$contact['position'] = $con_xml->readValue('position');
					$contact['email']    = $con_xml->readValue('email');
					$contact['street']   = $con_xml->readValue('street');
					$contact['country']  = $con_xml->readValue('country');
					$contact['state']    = $con_xml->readValue('state');
					$contact['town']     = $con_xml->readValue('town');
					$contact['postal']   = $con_xml->readValue('postal');
					$contact['phone']    = $con_xml->readValue('phone');
					$contact['fax']      = $con_xml->readValue('fax');
				}
				
				if($contact['name']     == false) { $contact['name']     = ''; }
				if($contact['position'] == false) { $contact['position'] = ''; }
				if($contact['email']    == false) { $contact['email']    = ''; }
				if($contact['street']   == false) { $contact['street']   = ''; }
				if($contact['country']  == false) { $contact['country']  = ''; }
				if($contact['state']    == false) { $contact['state']    = ''; }
				if($contact['town']     == false) { $contact['town']     = ''; }
				if($contact['postal']   == false) { $contact['postal']   = ''; }
				if($contact['phone']    == false) { $contact['phone']    = ''; }
				if($contact['fax']      == false) { $contact['fax']      = ''; }
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'contacts', $test_imp_contact);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$contact['name']     = $sqlARR['name'];
				$contact['position'] = $sqlARR['position'];
				$contact['email']    = $sqlARR['email'];
				$contact['street']   = $sqlARR['street'];
				$contact['country']  = $sqlARR['country'];
				$contact['state']    = $sqlARR['state'];
				$contact['town']     = $sqlARR['town'];
				$contact['postal']   = $sqlARR['postal'];
				$contact['phone']    = $sqlARR['phone'];
				$contact['fax']      = $sqlARR['fax'];
				
				if($contact['name']     == NULL) { $contact['name']     = ''; }
				if($contact['position'] == NULL) { $contact['position'] = ''; }
				if($contact['email']    == NULL) { $contact['email']    = ''; }
				if($contact['street']   == NULL) { $contact['street']   = ''; }
				if($contact['country']  == NULL) { $contact['country']  = ''; }
				if($contact['state']    == NULL) { $contact['state']    = ''; }
				if($contact['town']     == NULL) { $contact['town']     = ''; }
				if($contact['postal']   == NULL) { $contact['postal']   = ''; }
				if($contact['phone']    == NULL) { $contact['phone']    = ''; }
				if($contact['fax']      == NULL) { $contact['fax']      = ''; }
			}
			
			// CHARSETS
			$contact['name']     = $tcms_main->decodeText($contact['name'], '2', $c_charset);
			$contact['position'] = $tcms_main->decodeText($contact['position'], '2', $c_charset);
			$contact['email']    = $tcms_main->decodeText($contact['email'], '2', $c_charset);
			$contact['street']   = $tcms_main->decodeText($contact['street'], '2', $c_charset);
			$contact['country']  = $tcms_main->decodeText($contact['country'], '2', $c_charset);
			$contact['state']    = $tcms_main->decodeText($contact['state'], '2', $c_charset);
			$contact['town']     = $tcms_main->decodeText($contact['town'], '2', $c_charset);
			$contact['postal']   = $tcms_main->decodeText($contact['postal'], '2', $c_charset);
			$contact['phone']    = $tcms_main->decodeText($contact['phone'], '2', $c_charset);
			$contact['fax']      = $tcms_main->decodeText($contact['fax'], '2', $c_charset);
			
			if(strtolower($contact['country']) == 'deutschland' 
			|| strtolower($contact['country']) == 'germany'
			|| strtolower($contact['country']) == '') {
				if(strlen($contact['postal']) == 4) {
					$contact['postal'] = '0'.$contact['postal'];
				}
			}
			
			echo $contact['name'].' - '.$contact['position'].chr(13).
			$contact['email'].chr(13).
			$contact['street'].chr(13).
			$contact['state'].', '.$contact['postal'].' '.$contact['town'].chr(13).
			$contact['country'].chr(13).
			$contact['phone'].' - '.$contact['fax'];
		}
		
		echo '</textarea>'
		.'<input name="imp_contact" id="imp_contact" type="hidden" value="'.$test_imp_contact.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_TAX
		.'</td><td valign="top">'
		.'<input name="taxno" class="tcms_input_normal" value="'.$old_taxno.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300" valign="top">'
		._IMPRESSUM_UST
		.'</td><td valign="top">'
		.'<input name="ustid" class="tcms_input_normal" value="'.$old_ustid.'" />'
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
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	
	if($todo == 'save') {
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor') {
			$legal = $tcms_main->convertNewlineToHTML($legal);
		}
		
		if($imp_id      == '') { $imp_id      = ''; }
		if($imp_title   == '') { $imp_title   = ''; }
		if($imp_stamp   == '') { $imp_stamp   = ''; }
		if($imp_contact == '') { $imp_contact = ''; }
		if($taxno       == '') { $taxno       = ''; }
		if($ustid       == '') { $ustid       = ''; }
		if($content     == '') { $content     = ''; }
		
		
		if($show_wysiwyg == 'tinymce') {
			//$content = str_replace('../../', '', $content);
			$content = stripslashes($content);
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$content = str_replace('../../../../../../../../../', '', $content);
			$content = str_replace('../../../../', '', $content);
		}
		else {
			$content = $tcms_main->convertNewlineToHTML($content);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce') {
			//$content = str_replace('src="../../', 'src="', $content);
		}
		
		
		// CHARSETS
		$imp_title   = $tcms_main->encodeText($imp_title, '2', $c_charset);
		$imp_stamp   = $tcms_main->encodeText($imp_stamp, '2', $c_charset);
		$taxno       = $tcms_main->encodeText($taxno, '2', $c_charset);
		$ustid       = $tcms_main->encodeText($ustid, '2', $c_charset);
		$content     = $tcms_main->encodeText($content, '2', $c_charset);
		
		
		if($tcms_main->isReal($new_imp_lang)) {
			$setLang = $tcms_config->getLanguageCodeForTCMS($new_imp_lang);
		}
		else {
			$setLang = '';
		}
		
		
		if($imp_contact == 'no_contact') {
			$imp_contact = 'no_contact';
		}
		
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/imprint.'.$setLang.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('imp');
			
			$xmluser->write_value('imp_id', 'imprint');
			$xmluser->write_value('imp_title', $imp_title);
			$xmluser->write_value('imp_stamp', $imp_stamp);
			$xmluser->write_value('imp_contact', $imp_contact);
			$xmluser->write_value('taxno', $taxno);
			$xmluser->write_value('ustid', $ustid);
			$xmluser->write_value('legal', $content);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('imp');
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($lang_exist > 0) {
				$newSQLData = ''
				.$tcms_db_prefix.'imprint.imp_id="imprint", '
				.$tcms_db_prefix.'imprint.imp_title="'.$imp_title.'", '
				.$tcms_db_prefix.'imprint.imp_stamp="'.$imp_stamp.'", '
				.$tcms_db_prefix.'imprint.imp_contact="'.$imp_contact.'", '
				.$tcms_db_prefix.'imprint.taxno="'.$taxno.'", '
				.$tcms_db_prefix.'imprint.ustid="'.$ustid.'", '
				.$tcms_db_prefix.'imprint.legal="'.$content.'"';
				
				switch($choosenDB) {
					case 'mysql':
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'imprint', 
							$newSQLData, 
							'imp_id', 
							'imprint" AND language = "'.$setLang
						);
						break;
					
					default:
						$sqlQR = $sqlAL->updateField(
							$tcms_db_prefix.'imprint', 
							$newSQLData, 
							'imp_id', 
							"imprint' AND language = '".$setLang
						);
						break;
				}
			}
			else {
				switch($choosenDB) {
					case 'mysql':
						$newSQLColumns = '`imp_id`, `imp_title`, `imp_stamp`, `imp_contact`, '
						.'`taxno`, `ustid`, `legal`, `language`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'imp_id, imp_title, imp_stamp, imp_contact, '
						.'"taxno", ustid, "legal", "language"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[imp_id], [imp_title], [imp_stamp], [imp_contact], '
						.'[taxno], [ustid], [legal], [language]';
						break;
				}
				
				$newSQLData = "'imprint', '".$imp_title."', '".$imp_stamp."', '".$imp_contact."', "
				."'".$taxno."', '".$ustid."', '".$content."', '".$setLang."'";
				
				$maintag = $tcms_main->getNewUID(9, 'imprint');
				
				$sqlQR = $sqlAL->createOne(
					$tcms_db_prefix.'imprint', 
					$newSQLColumns, 
					$newSQLData, 
					$maintag
				);
			}
		}
		
		
		if($setLang != '') {
			$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_imprint&imp_contact='.$imp_contact
			.'&lang='.$setLang.'\''
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_imprint'
			.'</script>';
		}
	}
}
else {
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
