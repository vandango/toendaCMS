<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Diary component Backend
|
| File:	backend.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Diary component for backend
 *
 * This components generates a diary.
 *
 * @version 0.2.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


if(isset($_GET['component'])) { $component = $_GET['component']; }
if(isset($_GET['backend'])) { $backend = $_GET['backend']; }
if(isset($_GET['action'])) { $action = $_GET['action']; }

if(isset($_POST['component'])) { $component = $_POST['component']; }
if(isset($_POST['backend'])) { $backend = $_POST['backend']; }
if(isset($_POST['action'])) { $action = $_POST['action']; }
if(isset($_POST['maintag'])) { $maintag = $_POST['maintag']; }

if(isset($_POST['new_cs_diary_title'])) { $new_cs_diary_title = $_POST['new_cs_diary_title']; }
if(isset($_POST['new_cs_diary_subtitle'])) { $new_cs_diary_subtitle = $_POST['new_cs_diary_subtitle']; }
if(isset($_POST['content'])) { $content = $_POST['content']; }
if(isset($_POST['new_cs_sb_diary_title'])) { $new_cs_sb_diary_title = $_POST['new_cs_sb_diary_title']; }
if(isset($_POST['new_cs_sb_diary_subtitle'])) { $new_cs_sb_diary_subtitle = $_POST['new_cs_sb_diary_subtitle']; }
if(isset($_POST['new_cs_how_many_dates'])) { $new_cs_how_many_dates = $_POST['new_cs_how_many_dates']; }
if(isset($_POST['new_color_row_1'])) { $new_color_row_1 = $_POST['new_color_row_1']; }
if(isset($_POST['new_color_row_2'])) { $new_color_row_2 = $_POST['new_color_row_2']; }

if(isset($_POST['new_cs_decode_title'])) { $new_cs_decode_title = $_POST['new_cs_decode_title']; }
if(isset($_POST['new_cs_decode_subtitle'])) { $new_cs_decode_subtitle = $_POST['new_cs_decode_subtitle']; }
if(isset($_POST['new_cs_decode_text'])) { $new_cs_decode_text = $_POST['new_cs_decode_text']; }
if(isset($_POST['new_cs_decode_sb_title'])) { $new_cs_decode_sb_title = $_POST['new_cs_decode_sb_title']; }
if(isset($_POST['new_cs_decode_sb_subtitle'])) { $new_cs_decode_sb_subtitle = $_POST['new_cs_decode_sb_subtitle']; }

if(isset($_POST['new_cs_show_diary_title'])) { $new_cs_show_diary_title = $_POST['new_cs_show_diary_title']; }

if(isset($_POST['new_d_stamp'])) { $new_d_stamp = $_POST['new_d_stamp']; }
if(isset($_POST['new_d_title'])) { $new_d_title = $_POST['new_d_title']; }
if(isset($_POST['new_d_date'])) { $new_d_date = $_POST['new_d_date']; }
if(isset($_POST['new_d_tic'])) { $new_d_tic = $_POST['new_d_tic']; }
if(isset($_POST['new_d_loc'])) { $new_d_loc = $_POST['new_d_loc']; }
if(isset($_POST['new_d_land'])) { $new_d_land = $_POST['new_d_land']; }
if(isset($_POST['new_d_town'])) { $new_d_town = $_POST['new_d_town']; }
if(isset($_POST['new_d_zip'])) { $new_d_zip = $_POST['new_d_zip']; }
if(isset($_POST['new_d_adress'])) { $new_d_adress = $_POST['new_d_adress']; }
if(isset($_POST['new_d_access'])) { $new_d_access = $_POST['new_d_access']; }
if(isset($_POST['new_d_pub'])) { $new_d_pub = $_POST['new_d_pub']; }





/*
	init
*/

if(!isset($action)) {
	$action = 'settings';
}





/*
	start
*/

if($action != 'save' 
&& $action != 'edit' 
&& $action != 'delete') {
	echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
	.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
	.'<a'.( $action == 'settings' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=settings">'._TABLE_SETTINGS.'</a>'
	.'<a'.( $action == 'items' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=items">'._TABLE_DATES.'</a>'
	.'<a'.( $action == 'items' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=edit">'._TCMS_ADMIN_NEW_ITEM.'</a>'
	.'</div>';
	
	echo '<div class="tcms_tabPage"><br />';
	
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'" method="post">'
	.'<input name="component" type="hidden" value="'.$component.'" />'
	.'<input name="backend" type="hidden" value="'.$backend.'" />'
	.'<input name="action" type="hidden" value="save" />';
	
	
	
	if($action == 'settings') {
		$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings('diary', 'diary.xml', 'diary');
		
		
		$cs_diary_title       = $_TCMS_CS_ARRAY['diary']['content']['diary_title'];
		$cs_diary_subtitle    = $_TCMS_CS_ARRAY['diary']['content']['diary_subtitle'];
		$cs_diary_text        = $_TCMS_CS_ARRAY['diary']['content']['diary_text'];
		$cs_sb_diary_title    = $_TCMS_CS_ARRAY['diary']['content']['sb_diary_title'];
		$cs_sb_diary_subtitle = $_TCMS_CS_ARRAY['diary']['content']['sb_diary_subtitle'];
		$cs_show_diary_title  = $_TCMS_CS_ARRAY['diary']['content']['sb_show_diary_title'];
		$cs_how_many_dates    = $_TCMS_CS_ARRAY['diary']['content']['sb_how_many_dates'];
		$cs_color_row_1       = $_TCMS_CS_ARRAY['diary']['content']['color_row_1'];
		$cs_color_row_2       = $_TCMS_CS_ARRAY['diary']['content']['color_row_2'];
		
		
		$cs_diary_title       = $tcms_main->decodeText($cs_diary_title, '2', $c_charset, false, true);
		$cs_diary_subtitle    = $tcms_main->decodeText($cs_diary_subtitle, '2', $c_charset, false, true);
		$cs_diary_text        = $tcms_main->decodeText($cs_diary_text, '2', $c_charset, false, true);
		$cs_sb_diary_title    = $tcms_main->decodeText($cs_sb_diary_title, '2', $c_charset, false, true);
		$cs_sb_diary_subtitle = $tcms_main->decodeText($cs_sb_diary_subtitle, '2', $c_charset, false, true);
		
		
		
		
		if($show_wysiwyg == 'tinymce') {
			echo '<!-- tinyMCE -->
			<script language="javascript" type="text/javascript" src="../js/tinymce/tiny_mce.js"></script>
			<script language="javascript" type="text/javascript">
			tinyMCE.init({
				theme : "advanced",
				language : "en",
				relative_urls : false,
				remove_script_host : false,
				mode : "specific_textareas",
				document_base_url : "'.( $tcms_path == '' ? '' : '/'.$tcms_path ).'/",
				extended_valid_elements: "font[size|color|face]",
				
				plugins : "table,contextmenu,searchreplace,paste,insertdatetime,flash,fullscreen,preview,advhr,advlink",
				plugin_insertdate_dateFormat : "%d.%m.%Y",
				plugin_insertdate_timeFormat : "%H:%M:%S",
				
				theme_advanced_buttons1_add_before : "cut,copy,paste,pasteword,selectall,separator,search,replace,separator",
				theme_advanced_buttons1_add : "forecolor,backcolor",
				
				theme_advanced_buttons2_add_before : "fontselect,fontsizeselect,seperator",
				theme_advanced_buttons2_add : "fullscreen,preview",
				
				theme_advanced_buttons3_add_before : "tablecontrols,separator,advhr",
				theme_advanced_buttons3_add : "flash,insertdate,inserttime",
				
				content_css : "../styles/tcms_common.css", 
				
				fullscreen_settings : {
					theme_advanced_path_location : "top",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left"
				},
				
				invalid_elements : "script,applet,iframe",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_source_editor_height : "550",
				theme_advanced_source_editor_width : "750",
				theme_advanced_path_location : "bottom",
				theme_advanced_resize_horizontal : false,
				theme_advanced_resizing : true,
				
				directionality: "ltr",
				force_br_newlines : "false",
				debug : false,
				cleanup : true,
				safari_warning : false
			});
			</script>
			<!-- /tinyMCE -->';
			
			$cs_diary_text = stripslashes($cs_diary_text);
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$cs_diary_text = str_replace('src="', 'src="../../../../', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../http:', 'src="http:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../https:', 'src="https:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../ftp:', 'src="ftp:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../..//', 'src="/', $cs_diary_text);
		}
		else {
			$cs_diary_text = ereg_replace('<br />'.chr(10), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br />'.chr(13), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br />', chr(13), $cs_diary_text);
			
			$cs_diary_text = ereg_replace('<br/>'.chr(10), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br/>'.chr(13), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br/>', chr(13), $cs_diary_text);
			
			$cs_diary_text = ereg_replace('<br>'.chr(10), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br>'.chr(13), chr(13), $cs_diary_text);
			$cs_diary_text = ereg_replace('<br>', chr(13), $cs_diary_text);
		}
		
		
		
		
		
		/*
			BEGIN FORM
		*/
		
		// table head
		echo '<table cellpadding="1" cellspacing="0" width="100%" border="0" class="noborder">'
		.'<input name="new_cs_decode_title" type="hidden" value="1" />'
		.'<input name="new_cs_decode_subtitle" type="hidden" value="1" />'
		.'<input name="new_cs_decode_sb_title" type="hidden" value="1" />'
		.'<input name="new_cs_decode_sb_subtitle" type="hidden" value="1" />'
		.'<input name="new_cs_decode_text" type="hidden" value="1" />';
		
		
		// row
		echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._TABLE_SETTINGS.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_padding_mini"></td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._TABLE_TITLE.'</td>'
		.'<td valign="top"><input name="new_cs_diary_title" class="tcms_input_normal" value="'.$cs_diary_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._TABLE_SUBTITLE.'</td>'
		.'<td valign="top"><input name="new_cs_diary_subtitle" class="tcms_input_normal" value="'.$cs_diary_subtitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._TABLE_TITLE.' '._TABLE_SIDEBAR.'</td>'
		.'<td valign="top"><input name="new_cs_sb_diary_title" class="tcms_input_normal" value="'.$cs_sb_diary_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._TABLE_SUBTITLE.' '._TABLE_SIDEBAR.'</td>'
		.'<td valign="top"><input name="new_cs_sb_diary_subtitle" class="tcms_input_normal" value="'.$cs_sb_diary_subtitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._TABLE_TITLE.' '._TABLE_SIDEBAR.' '._TABLE_ENABLED.'</td>'
		.'<td valign="top"><input name="new_cs_show_diary_title"'.( $cs_show_diary_title == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">How many dates listed in sidebar</td>'
		.'<td valign="top">'
		.'<input name="new_cs_how_many_dates" class="tcms_id_box" value="'.$cs_how_many_dates.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_1.'</td>'
		.'<td valign="top">'
		.'<input name="new_color_row_1" id="new_color_row_1" class="tcms_id_box" value="'.$cs_color_row_1.'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=new_color_row_1\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'._BOOK_COLOR_ROW_2.'</td>'
		.'<td valign="top">'
		.'<input name="new_color_row_2" id="new_color_row_2" class="tcms_id_box" value="'.$cs_color_row_2.'" />'
		.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=new_color_row_2\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
		.'</td></tr>';
		
		
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top" colspan="2">'._TABLE_TEXT.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" colspan="2">'
		.'<script>createToendaToolbar(\'links\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>';
		
		if($show_wysiwyg == 'tinymce') { echo '<br /><br />'; }
		elseif($show_wysiwyg == 'fckeditor') { }
		else {
			if($show_wysiwyg == 'toendaScript') { echo '<script>createToolbar(\'links\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else { echo '<script>createToolbar(\'links\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		if($show_wysiwyg == 'tinymce') {
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content" mce_editable="true">'.$cs_diary_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $cs_diary_text;
			$oFCKeditor->Create();
		}
		else {
			echo '<textarea name="content" id="content" class="tcms_textarea_huge">'.$cs_diary_text.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo '</table>';
	}
	elseif($action == 'items') {
		/*
			list all the items
			in the diary
			and let the editable
		*/
		$path = _TCMS_PATH.'/components/diary/data';
		
		$arrFile = $tcms_file->getPathContent($path);
		
		$count = 0;
		
		if(is_array($arrFile)) {
			foreach($arrFile as $cKey => $cValue) {
				$xml = new xmlparser($path.'/'.$cValue, 'r');
				
				$arrDiary['tag'][$count]    = substr($cValue, 0, 10);
				$arrDiary['stamp'][$count]  = $xml->readSection('date', 'stamp');
				$arrDiary['date'][$count]   = $xml->readSection('date', 'timestamp');
				$arrDiary['title'][$count]  = $xml->readSection('date', 'title');
				$arrDiary['text'][$count]   = $xml->readSection('date', 'text');
				$arrDiary['loc'][$count]    = $xml->readSection('date', 'location');
				$arrDiary['town'][$count]   = $xml->readSection('date', 'town');
				$arrDiary['access'][$count] = $xml->readSection('date', 'access');
				$arrDiary['pub'][$count]    = $xml->readSection('date', 'published');
				
				$arrDiary['title'][$count]  = $tcms_main->decodeText($arrDiary['title'][$count], '2', $c_charset, false, true);
				$arrDiary['loc'][$count]    = $tcms_main->decodeText($arrDiary['loc'][$count], '2', $c_charset, false, true);
				$arrDiary['town'][$count]   = $tcms_main->decodeText($arrDiary['town'][$count], '2', $c_charset, false, true);
				
				$tempStr = $tcms_main->decodeText($arrDiary['text'][$count], '2', $c_charset, false, true);
				$arrDiary['text'][$count] = ( strlen($tempStr) > 60 ? substr($tempStr, 0, 60).'...' : $tempStr );
				
				
				$arrDiary['text'][$count] = ereg_replace('<br />'.chr(10), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br />'.chr(13), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br />', chr(13), $arrDiary['text'][$count]);
				
				$arrDiary['text'][$count] = ereg_replace('<br/>'.chr(10), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br/>'.chr(13), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br/>', chr(13), $arrDiary['text'][$count]);
				
				$arrDiary['text'][$count] = ereg_replace('<br>'.chr(10), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br>'.chr(13), chr(13), $arrDiary['text'][$count]);
				$arrDiary['text'][$count] = ereg_replace('<br>', chr(13), $arrDiary['text'][$count]);
				
				$d_text = htmlspecialchars($d_text);
				
				
				$count++;
				
				$xml->flush();
				unset($xml);
			}
		}
		
		
		if(is_array($arrDiary)) {
			array_multisort(
				$arrDiary['stamp'], SORT_DESC, 
				$arrDiary['date'], SORT_DESC, 
				$arrDiary['title'], SORT_DESC, 
				$arrDiary['text'], SORT_DESC, 
				$arrDiary['loc'], SORT_DESC, 
				$arrDiary['town'], SORT_DESC, 
				$arrDiary['pub'], SORT_DESC, 
				$arrDiary['access'], SORT_DESC, 
				$arrDiary['tag'], SORT_DESC
			);
		}
		
		
		if(is_array($arrDiary)) {
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
			echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_DATE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="35%" align="left">'._TABLE_LOCATION.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="100%" align="left">'._TABLE_DESCRIPTION.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th>'
			.'</tr>';
			
			if(is_array($arrDiary)) {
				foreach($arrDiary['stamp'] as $key => $value) {
					if(is_integer($key/2)) { $wsc = 0; }
					else { $wsc = 1; }
					
					echo '<tr height="25" id="row'.$key.'" '
					.'bgcolor="'.$arr_color[$wsc].'" '
					.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')" '
					.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=edit&amp;maintag='.$arrDiary['tag'][$key].'\';">';
					
					echo '<td class="tcms_db_2">'.$arrDiary['date'][$key].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2">'.$arrDiary['title'][$key].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2">'.$arrDiary['loc'][$key].'&nbsp;'.$arrDiary['town'][$key].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2">'.$arrDiary['text'][$key].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=edit&amp;maintag='.$arrDiary['tag'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'&amp;action=delete&amp;maintag='.$arrDiary['tag'][$key].'">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>'
					.'</td>';
					
					echo '</tr>';
				}
			}
			
			echo '</table><br />';
		}
	}
	
	
	echo '</form>';
}









/*
	edit item
	from the diary
*/

if($action == 'edit') {
	//***************************
	//
	$path = _TCMS_PATH.'/components/diary/data/';
	
	if(isset($maintag) && !empty($maintag) && $maintag != '') {
		$xml  = new xmlparser($path.$maintag.'.xml','r');
		
		$d_stamp  = $xml->readSection('date', 'stamp');
		$d_date   = $xml->readSection('date', 'timestamp');
		$d_title  = $xml->readSection('date', 'title');
		$d_text   = $xml->readSection('date', 'text');
		$d_tic    = $xml->readSection('date', 'tickets');
		$d_loc    = $xml->readSection('date', 'location');
		$d_land   = $xml->readSection('date', 'country');
		$d_town   = $xml->readSection('date', 'town');
		$d_zip    = $xml->readSection('date', 'zip');
		$d_adress = $xml->readSection('date', 'adress');
		$d_access = $xml->readSection('date', 'access');
		$d_pub    = $xml->readSection('date', 'published');
		
		
		if($d_stamp  == false) { $d_stamp  = ''; }
		if($d_date   == false) { $d_date   = ''; }
		if($d_title  == false) { $d_title  = ''; }
		if($d_text   == false) { $d_text   = ''; }
		if($d_tic    == false) { $d_tic    = ''; }
		if($d_loc    == false) { $d_loc    = ''; }
		if($d_land   == false) { $d_land   = ''; }
		if($d_town   == false) { $d_town   = ''; }
		if($d_zip    == false) { $d_zip    = ''; }
		if($d_adress == false) { $d_adress = ''; }
		if($d_access == false) { $d_access = ''; }
		if($d_pub    == false) { $d_pub    = ''; }
		
		
		$d_title  = $tcms_main->decodeText($d_title, '2', $c_charset, false, true);
		$d_text   = $tcms_main->decodeText($d_text, '2', $c_charset, false, true);
		$d_tic    = $tcms_main->decodeText($d_tic, '2', $c_charset, false, true);
		$d_loc    = $tcms_main->decodeText($d_loc, '2', $c_charset, false, true);
		$d_land   = $tcms_main->decodeText($d_land, '2', $c_charset, false, true);
		$d_town   = $tcms_main->decodeText($d_town, '2', $c_charset, false, true);
		$d_adress = $tcms_main->decodeText($d_adress, '2', $c_charset, false, true);
		
		
		echo $tcms_html->bold(_TABLE_EDIT);
		
		$xml->flush();
		unset($xml);
	}
	else {
		$d_stamp  = '';
		$d_date   = date('d.m.Y-H:i');
		$d_title  = '';
		$d_text   = '';
		$d_tic    = '';
		$d_loc    = '';
		$d_land   = '';
		$d_town   = '';
		$d_zip    = '';
		$d_adress = '';
		$d_access = 'Public';
		$d_pub    = 0;
		
		while(($maintag=substr(md5(time()),0,10)) && file_exists($path.$maintag.'.xml')) {}
		
		echo $tcms_html->bold(_TABLE_NEW);
	}
	//
	//***************************
	
	
	$d_title = htmlspecialchars($d_title);
	
	$d_text = ereg_replace('<br />'.chr(10), chr(13), $d_text);
	$d_text = ereg_replace('<br />'.chr(13), chr(13), $d_text);
	$d_text = ereg_replace('<br />', chr(13), $d_text);
	
	$d_text = ereg_replace('<br/>'.chr(10), chr(13), $d_text);
	$d_text = ereg_replace('<br/>'.chr(13), chr(13), $d_text);
	$d_text = ereg_replace('<br/>', chr(13), $d_text);
	
	$d_text = ereg_replace('<br>'.chr(10), chr(13), $d_text);
	$d_text = ereg_replace('<br>'.chr(13), chr(13), $d_text);
	$d_text = ereg_replace('<br>', chr(13), $d_text);
	
	$d_text = htmlspecialchars($d_text);
	
	
	$width = '200';
	
	echo $tcms_html->text(_CONTENT_TEXT_PAGE.'<br /><br />', 'left');
	
	
	echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
	echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
	echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
	echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';
	
	if($show_wysiwyg == 'tinymce') {
		include('../tcms_kernel/tcms_tinyMCE.lib.php');
		
		$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
		$tcms_tinyMCE->initTinyMCE();
	}
	
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'" method="post">'
	.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
	.'<input name="component" type="hidden" value="'.$component.'" />'
	.'<input name="backend" type="hidden" value="'.$backend.'" />'
	.'<input name="action" type="hidden" value="save_item" />'
	.'<input name="new_d_stamp" type="hidden" value="'.$d_stamp.'" />';
	
	
	// table
	echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
	echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
	echo '</tr></table>';
	
	
	// table
	echo '<table width="100%" cellpadding="1" cellspacing="5" border="0" class="tcms_table">';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_NAME.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_title" type="text" value="'.$d_title.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DATES.'</strong></td>'
	.'<td valign="top"><input class="tcms_input_small" id="new_d_date" name="new_d_date" type="text" value="'.$d_date.'" />'
	.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDateTime" />'
	.'</td></tr>';
	
	echo '<script type="text/javascript">
		Calendar.setup({
	        inputField     :    "new_d_date",
	        ifFormat       :    "%d.%m.%Y-%H:%M",
	        showsTime      :    true,
	        timeFormat     :    24,
	        button         :    "triggerButtonDateTime",
	        singleClick    :    false,
	        step           :    1
	    });
	</script>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_LOCATION.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_loc" type="text" value="'.$d_loc.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DIARY_TICKET.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_tic" type="text" value="'.$d_tic.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_COUNTRY.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_land" type="text" value="'.$d_land.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_TOWN.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_town" type="text" value="'.$d_town.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_POSTAL.'</strong></td>'
	.'<td><input class="tcms_id_box" name="new_d_zip" type="text" value="'.$d_zip.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._PERSON_STREET.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_d_adress" type="text" value="'.$d_adress.'" />'
	.'</td></tr>';
	
	
	// table row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
	.'<td valign="top">'
	.'<select name="new_d_access" class="tcms_select">'
		.'<option value="Public"'.(    $d_access == 'Public'    ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( $d_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
		.'<option value="Private"'.(   $d_access == 'Private'   ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
	.'</select>'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
	.'<td><input name="new_d_pub" value="1" type="checkbox"'.( $d_pub == 1 ? ' checked="checked"' : '' ).' />'
	.'</td></tr>';
	
	
	// table row
	echo '<tr><td valign="top" colspan="2"><strong class="tcms_bold">'._TABLE_TEXT.'</strong>'
	.'<br /><br />'
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
	
	
	
	//================================================
	echo '</table>';
	
	echo '</form>';
}





/*
	save item
*/

if($action == 'save_item') {
	if(empty($new_d_pub))  { $new_d_pub    = 0; }
	if($new_d_access == '') { $new_d_access = 'Public'; }
	
	
	$content = $tcms_main->convertNewlineToHTML($content);
	
	
	// CHARSETS
	$new_d_title  = $tcms_main->encodeText($new_d_title, '2', $c_charset, false, true);
	$content      = $tcms_main->encodeText($content, '2', $c_charset, false, true);
	$new_d_tic    = $tcms_main->encodeText($new_d_tic, '2', $c_charset, false, true);
	$new_d_loc    = $tcms_main->encodeText($new_d_loc, '2', $c_charset, false, true);
	$new_d_land   = $tcms_main->encodeText($new_d_land, '2', $c_charset, false, true);
	$new_d_town   = $tcms_main->encodeText($new_d_town, '2', $c_charset, false, true);
	$new_d_adress = $tcms_main->encodeText($new_d_adress, '2', $c_charset, false, true);
	
	
	if($new_d_stamp == '') {
		$new_d_stamp = substr($new_d_date, 6, 4).substr($new_d_date, 3, 2).substr($new_d_date, 0, 2).substr($new_d_date, 11, 2).substr($new_d_date, 14, 2);
	}
	
	
	$xmluser = new xmlparser(_TCMS_PATH.'/components/'.$component.'/data/'.$maintag.'.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection('date');
	
	$xmluser->writeValue('stamp', $new_d_stamp);
	$xmluser->writeValue('timestamp', $new_d_date);
	$xmluser->writeValue('title', $new_d_title);
	$xmluser->writeValue('text', $content);
	$xmluser->writeValue('tickets', $new_d_tic);
	$xmluser->writeValue('location', $new_d_loc);
	$xmluser->writeValue('country', $new_d_land);
	$xmluser->writeValue('town', $new_d_town);
	$xmluser->writeValue('zip', $new_d_zip);
	$xmluser->writeValue('adress', $new_d_adress);
	$xmluser->writeValue('published', $new_d_pub);
	$xmluser->writeValue('access', $new_d_access);
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd('date');
	unset($xmluser);
	
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'&action=items\';'
	.'</script>';
}





/*
	save changes
	on the settings
*/

if($action == 'save') {
	if(empty($new_cs_show_diary_title))  { $new_cs_show_diary_title   = 0; }
	
	
	// CHARSETS
	$new_cs_diary_title       = $tcms_main->encodeText($new_cs_diary_title, '2', $c_charset, false, true);
	$new_cs_diary_subtitle    = $tcms_main->encodeText($new_cs_diary_subtitle, '2', $c_charset, false, true);
	$content                  = $tcms_main->encodeText($content, '2', $c_charset, false, true);
	$new_cs_sb_diary_title    = $tcms_main->encodeText($new_cs_sb_diary_title, '2', $c_charset, false, true);
	$new_cs_sb_diary_subtitle = $tcms_main->encodeText($new_cs_sb_diary_subtitle, '2', $c_charset, false, true);
	
	
	$xmluser = new xmlparser(_TCMS_PATH.'/components/'.$component.'/diary.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection('cs');
	
	$xmluser->writeValue('diary_title', $new_cs_diary_title);
	$xmluser->writeValue('diary_subtitle', $new_cs_diary_subtitle);
	$xmluser->writeValue('diary_text', $content);
	$xmluser->writeValue('sb_diary_title', $new_cs_sb_diary_title);
	$xmluser->writeValue('sb_diary_subtitle', $new_cs_sb_diary_subtitle);
	$xmluser->writeValue('sb_show_diary_title', $new_cs_show_diary_title);
	$xmluser->writeValue('sb_how_many_dates', $new_cs_how_many_dates);
	$xmluser->writeValue('color_row_1', $new_color_row_1);
	$xmluser->writeValue('color_row_2', $new_color_row_2);
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd('cs');
	unset($xmluser);
	
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'\';'
	.'</script>';
}





/*
	DELETE
*/
if($action == 'delete') {
	unlink(_TCMS_PATH.'/components/diary/data/'.$maintag.'.xml');
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'&action=items\';'
	.'</script>';
}

?>
