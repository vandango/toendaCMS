<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Impressum Designer
|
| File:		mod_impressum.php
| Version:	0.5.3
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





if(isset($_GET['vall'])){ $vall = $_GET['vall']; }

if(isset($_POST['imp_id'])){ $imp_id = $_POST['imp_id']; }
if(isset($_POST['imp_title'])){ $imp_title = $_POST['imp_title']; }
if(isset($_POST['imp_stamp'])){ $imp_stamp = $_POST['imp_stamp']; }
if(isset($_POST['imp_contact'])){ $imp_contact = $_POST['imp_contact']; }
if(isset($_POST['taxno'])){ $taxno = $_POST['taxno']; }
if(isset($_POST['ustid'])){ $ustid = $_POST['ustid']; }
if(isset($_POST['legal'])){ $legal = $_POST['legal']; }
if(isset($_POST['vall'])){ $vall = $_POST['vall']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }







if($id_group == 'Developer' || $id_group == 'Administrator'){
	if($todo != 'save'){
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
		}
		
		
		/*
			legal configuration
		*/
		
		if($choosenDB == 'xml'){
			$imp_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/impressum.xml','r');
			$old_imp_id       = $imp_xml->read_section('imp', 'imp_id');
			$old_imp_title    = $imp_xml->read_section('imp', 'imp_title');
			$old_imp_stamp    = $imp_xml->read_section('imp', 'imp_stamp');
			$old_taxno        = $imp_xml->read_section('imp', 'taxno');
			$old_ustid        = $imp_xml->read_section('imp', 'ustid');
			$old_legal        = $imp_xml->read_section('imp', 'legal');
			$test_imp_contact = $imp_xml->read_section('imp', 'imp_contact');
			
			if(!$old_imp_id)       { $old_imp_id       = ''; }
			if(!$old_imp_title)    { $old_imp_title    = ''; }
			if(!$old_imp_stamp)    { $old_imp_stamp    = ''; }
			if(!$old_taxno)        { $old_taxno        = ''; }
			if(!$old_ustid)        { $old_ustid        = ''; }
			if(!$old_legal)        { $old_legal        = ''; }
			if(!$test_imp_contact) { $test_imp_contact = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'impressum', 'impressum');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_imp_id       = $sqlARR['imp_id'];
			$old_imp_title    = $sqlARR['imp_title'];
			$old_imp_stamp    = $sqlARR['imp_stamp'];
			$old_taxno        = $sqlARR['taxno'];
			$old_ustid        = $sqlARR['ustid'];
			$old_legal        = $sqlARR['legal'];
			$test_imp_contact = $sqlARR['imp_contact'];
			
			if($old_imp_id       == NULL){ $old_imp_id       = ''; }
			if($old_imp_title    == NULL){ $old_imp_title    = ''; }
			if($old_imp_stamp    == NULL){ $old_imp_stamp    = ''; }
			if($old_taxno        == NULL){ $old_taxno        = ''; }
			if($old_ustid        == NULL){ $old_ustid        = ''; }
			if($old_legal        == NULL){ $old_legal        = ''; }
			if($test_imp_contact == NULL){ $test_imp_contact = ''; }
		}
		
		// CHARSETS
		$old_imp_title = $tcms_main->decodeText($old_imp_title, '2', $c_charset);
		$old_imp_stamp = $tcms_main->decodeText($old_imp_stamp, '2', $c_charset);
		$old_taxno     = $tcms_main->decodeText($old_taxno, '2', $c_charset);
		$old_ustid     = $tcms_main->decodeText($old_ustid, '2', $c_charset);
		$old_legal     = $tcms_main->decodeText($old_legal, '2', $c_charset);
		
		$old_imp_title = htmlspecialchars($old_imp_title);
		$old_imp_stamp = htmlspecialchars($old_imp_stamp);
		
		
		if($show_wysiwyg == 'tinymce'){
			$old_legal = stripslashes($old_legal);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$old_legal = str_replace('src="', 'src="../../../../', $old_legal);
			$old_legal = str_replace('src="../../../../http:', 'src="http:', $old_legal);
			$old_legal = str_replace('src="../../../../https:', 'src="https:', $old_legal);
			$old_legal = str_replace('src="../../../../ftp:', 'src="ftp:', $old_legal);
			$old_legal = str_replace('src="../../../..//', 'src="/', $old_legal);
		}
		else{
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
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$old_legal = str_replace('src="', 'src="../../', $old_legal);
		}
		
		
		
		if($choosenDB == 'xml'){
			$arr_contacts['all'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_contacts/');
			
			if(is_array($arr_contacts['all']) && !empty($arr_contacts['all'])){
				foreach($arr_contacts['all'] as $key => $val){
					$contact_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_contacts/'.$val,'r');
					$cp = $contact_xml->read_value('published');
					if($cp == 1){
						$arr_contacts['arr'][$key] = $contact_xml->read_value('name');
						$arr_contacts['all'][$key] = substr($val, 0, 10);
					}
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'contacts WHERE published=1');
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_contacts['arr'][$count] = $sqlARR['name'];
				$arr_contacts['all'][$count] = $sqlARR['uid'];
				
				if($arr_contacts['arr'][$count] == NULL){ $arr_contacts['arr'][$count] = ''; }
				
				$arr_contacts['arr'][$count] = $tcms_main->decodeText($arr_contacts['arr'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_impressum" method="post" id="imp">'
		.'<input name="todo" type="hidden" value="save" />';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._IMPRESSUM_CONFIG.'</th>';
		echo '</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table" border="0">';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_ID.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input readonly name="imp_id" class="tcms_input_small" value="'.$old_imp_id.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_TITLE.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input name="imp_title" class="tcms_input_normal" value="'.$old_imp_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_SUBTITLE.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input name="imp_stamp" class="tcms_input_normal" value="'.$old_imp_stamp.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_CONTACT.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<select class="tcms_select" onchange="document.location=\'admin.php?id_user='.$id_user.'&site=mod_impressum&vall=\'+this.value;">'
		.'<option value=""> &bull; '._IMPRESSUM_SELECT.' &bull; </option>'
		.'<option value="_no_contact_"'.( $vall == '_no_contact_' ? ' selected="selected"' : '' ).'> &bull; '._IMPRESSUM_NO_CONTACT.' &bull; </option>';
		
		arsort($arr_contacts['arr']);
		foreach($arr_contacts['arr'] as $c_key => $c_value){
			$arr_contacts['arr'][$c_key] = $tcms_main->decodeText($arr_contacts['arr'][$c_key], '2', $c_charset);
			echo '<option name="vall" value="'.$arr_contacts['all'][$c_key].'">'.$arr_contacts['arr'][$c_key].'</option>';
		}
		
		echo '</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">&nbsp;</td>'
		.'<td valign="top"><img src="../images/px.png" width="9" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<textarea name="text" id="text" class="tcms_textarea_big">';
		
		if(isset($vall)){
			$test_imp_contact = $vall;
		}
		
		if(isset($test_imp_contact) && $test_imp_contact != '_no_contact_'){
			if($choosenDB == 'xml'){
				if(file_exists('../../'.$tcms_administer_site.'/tcms_contacts/'.$test_imp_contact.'.xml')){
					$con_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_contacts/'.$test_imp_contact.'.xml','r');
					
					$contact['name']     = $con_xml->read_value('name');
					$contact['position'] = $con_xml->read_value('position');
					$contact['email']    = $con_xml->read_value('email');
					$contact['street']   = $con_xml->read_value('street');
					$contact['country']  = $con_xml->read_value('country');
					$contact['state']    = $con_xml->read_value('state');
					$contact['town']     = $con_xml->read_value('town');
					$contact['postal']   = $con_xml->read_value('postal');
					$contact['phone']    = $con_xml->read_value('phone');
					$contact['fax']      = $con_xml->read_value('fax');
				}
				
				if($contact['name']     == false){ $contact['name']     = ''; }
				if($contact['position'] == false){ $contact['position'] = ''; }
				if($contact['email']    == false){ $contact['email']    = ''; }
				if($contact['street']   == false){ $contact['street']   = ''; }
				if($contact['country']  == false){ $contact['country']  = ''; }
				if($contact['state']    == false){ $contact['state']    = ''; }
				if($contact['town']     == false){ $contact['town']     = ''; }
				if($contact['postal']   == false){ $contact['postal']   = ''; }
				if($contact['phone']    == false){ $contact['phone']    = ''; }
				if($contact['fax']      == false){ $contact['fax']      = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'contacts', $test_imp_contact);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
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
				
				if($contact['name']     == NULL){ $contact['name']     = ''; }
				if($contact['position'] == NULL){ $contact['position'] = ''; }
				if($contact['email']    == NULL){ $contact['email']    = ''; }
				if($contact['street']   == NULL){ $contact['street']   = ''; }
				if($contact['country']  == NULL){ $contact['country']  = ''; }
				if($contact['state']    == NULL){ $contact['state']    = ''; }
				if($contact['town']     == NULL){ $contact['town']     = ''; }
				if($contact['postal']   == NULL){ $contact['postal']   = ''; }
				if($contact['phone']    == NULL){ $contact['phone']    = ''; }
				if($contact['fax']      == NULL){ $contact['fax']      = ''; }
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
			
			echo $contact['name'].' - '.
			$contact['position'].' - '.
			$contact['email'].' - '.
			$contact['street'].' - '.
			$contact['country'].' - '.
			$contact['state'].' - '.
			$contact['town'].' - '.
			$contact['postal'].' - '.
			$contact['phone'].' - '.
			$contact['fax'];
		}
		
		echo '</textarea><input name="imp_contact" id="imp_contact" type="hidden" value="'.$test_imp_contact.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_TAX.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input name="taxno" class="tcms_input_normal" value="'.$old_taxno.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'._IMPRESSUM_UST.'</td>'
		.'<td valign="top"><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input name="ustid" class="tcms_input_normal" value="'.$old_ustid.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr></table>';
		
		
		// table rows
		echo '<table cellpadding="1" cellspacing="5" class="tcms_table" width="100%" border="0">';
		echo '<tr><td valign="top" colspan="2"><strong class="tcms_bold">'._IMPRESSUM_LEGAL.'</strong>'
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
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'.$old_legal.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_legal;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'.$old_legal.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo '</table></form><br />';
	}
	
	
	
	
	
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	if($todo == 'save'){
		//****************************************
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor'){
			$legal = $tcms_main->nl2br($legal);
		}
		
		if($imp_id      == ''){ $imp_id      = ''; }
		if($imp_title   == ''){ $imp_title   = ''; }
		if($imp_stamp   == ''){ $imp_stamp   = ''; }
		if($imp_contact == ''){ $imp_contact = ''; }
		if($taxno       == ''){ $taxno       = ''; }
		if($ustid       == ''){ $ustid       = ''; }
		if($content     == ''){ $content     = ''; }
		
		
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
		
		
		// CHARSETS
		$imp_title   = $tcms_main->decode_text($imp_title, '2', $c_charset);
		$imp_stamp   = $tcms_main->decode_text($imp_stamp, '2', $c_charset);
		$taxno       = $tcms_main->decode_text($taxno, '2', $c_charset);
		$ustid       = $tcms_main->decode_text($ustid, '2', $c_charset);
		$content     = $tcms_main->decode_text($content, '2', $c_charset);
		
		//****************************************
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/impressum.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('imp');
			
			$xmluser->write_value('imp_id', $imp_id);
			$xmluser->write_value('imp_title', $imp_title);
			$xmluser->write_value('imp_stamp', $imp_stamp);
			$xmluser->write_value('imp_contact', $imp_contact);
			$xmluser->write_value('taxno', $taxno);
			$xmluser->write_value('ustid', $ustid);
			$xmluser->write_value('legal', $content);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('imp');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'impressum.imp_id="'.$imp_id.'", '
			.$tcms_db_prefix.'impressum.imp_title="'.$imp_title.'", '
			.$tcms_db_prefix.'impressum.imp_stamp="'.$imp_stamp.'", '
			.$tcms_db_prefix.'impressum.imp_contact="'.$imp_contact.'", '
			.$tcms_db_prefix.'impressum.taxno="'.$taxno.'", '
			.$tcms_db_prefix.'impressum.ustid="'.$ustid.'", '
			.$tcms_db_prefix.'impressum.legal="'.$content.'"';
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'impressum', $newSQLData, 'impressum');
		}
		
		//****************************************
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_impressum\';</script>';
		
		//****************************************
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
