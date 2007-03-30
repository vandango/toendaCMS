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
| File:		backend.php
| Version:	0.1.6
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





if(isset($_GET['component'])){ $component = $_GET['component']; }
if(isset($_GET['backend'])){ $backend = $_GET['backend']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['component'])){ $component = $_POST['component']; }
if(isset($_POST['backend'])){ $backend = $_POST['backend']; }
if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['maintag'])){ $maintag = $_POST['maintag']; }

if(isset($_POST['new_cs_diary_title'])){ $new_cs_diary_title = $_POST['new_cs_diary_title']; }
if(isset($_POST['new_cs_diary_subtitle'])){ $new_cs_diary_subtitle = $_POST['new_cs_diary_subtitle']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_cs_sb_diary_title'])){ $new_cs_sb_diary_title = $_POST['new_cs_sb_diary_title']; }
if(isset($_POST['new_cs_sb_diary_subtitle'])){ $new_cs_sb_diary_subtitle = $_POST['new_cs_sb_diary_subtitle']; }
if(isset($_POST['new_cs_how_many_dates'])){ $new_cs_how_many_dates = $_POST['new_cs_how_many_dates']; }
if(isset($_POST['new_color_row_1'])){ $new_color_row_1 = $_POST['new_color_row_1']; }
if(isset($_POST['new_color_row_2'])){ $new_color_row_2 = $_POST['new_color_row_2']; }

if(isset($_POST['new_cs_decode_title'])){ $new_cs_decode_title = $_POST['new_cs_decode_title']; }
if(isset($_POST['new_cs_decode_subtitle'])){ $new_cs_decode_subtitle = $_POST['new_cs_decode_subtitle']; }
if(isset($_POST['new_cs_decode_text'])){ $new_cs_decode_text = $_POST['new_cs_decode_text']; }
if(isset($_POST['new_cs_decode_sb_title'])){ $new_cs_decode_sb_title = $_POST['new_cs_decode_sb_title']; }
if(isset($_POST['new_cs_decode_sb_subtitle'])){ $new_cs_decode_sb_subtitle = $_POST['new_cs_decode_sb_subtitle']; }

if(isset($_POST['new_cs_show_diary_title'])){ $new_cs_show_diary_title = $_POST['new_cs_show_diary_title']; }

if(isset($_POST['new_d_stamp'])){ $new_d_stamp = $_POST['new_d_stamp']; }
if(isset($_POST['new_d_title'])){ $new_d_title = $_POST['new_d_title']; }
if(isset($_POST['new_d_date'])){ $new_d_date = $_POST['new_d_date']; }
if(isset($_POST['new_d_tic'])){ $new_d_tic = $_POST['new_d_tic']; }
if(isset($_POST['new_d_loc'])){ $new_d_loc = $_POST['new_d_loc']; }
if(isset($_POST['new_d_land'])){ $new_d_land = $_POST['new_d_land']; }
if(isset($_POST['new_d_town'])){ $new_d_town = $_POST['new_d_town']; }
if(isset($_POST['new_d_zip'])){ $new_d_zip = $_POST['new_d_zip']; }
if(isset($_POST['new_d_adress'])){ $new_d_adress = $_POST['new_d_adress']; }
if(isset($_POST['new_d_access'])){ $new_d_access = $_POST['new_d_access']; }
if(isset($_POST['new_d_pub'])){ $new_d_pub = $_POST['new_d_pub']; }









if(!isset($action)){ $action = 'settings'; }

if($action != 'save' && $action != 'edit' && $action != 'delete'){
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
	
	
	
	if($action == 'settings'){
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
		
		
		$cs_diary_title       = $tcms_main->encode_text_without_db($cs_diary_title, '2', $c_charset);
		$cs_diary_subtitle    = $tcms_main->encode_text_without_db($cs_diary_subtitle, '2', $c_charset);
		$cs_diary_text        = $tcms_main->encode_text_without_db($cs_diary_text, '2', $c_charset);
		$cs_sb_diary_title    = $tcms_main->encode_text_without_db($cs_sb_diary_title, '2', $c_charset);
		$cs_sb_diary_subtitle = $tcms_main->encode_text_without_db($cs_sb_diary_subtitle, '2', $c_charset);
		
		
		
		
		if($show_wysiwyg == 'tinymce'){
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
		elseif($show_wysiwyg == 'fckeditor'){
			$cs_diary_text = str_replace('src="', 'src="../../../../', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../http:', 'src="http:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../https:', 'src="https:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../../ftp:', 'src="ftp:', $cs_diary_text);
			$cs_diary_text = str_replace('src="../../../..//', 'src="/', $cs_diary_text);
		}
		else{
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
		
		if($show_wysiwyg == 'tinymce'){ echo '<br /><br />'; }
		elseif($show_wysiwyg == 'fckeditor'){ }
		else{
			if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'links\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else{ echo '<script>createToolbar(\'links\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content" mce_editable="true">'.$cs_diary_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $cs_diary_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea name="content" id="content" class="tcms_textarea_huge">'.$cs_diary_text.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo '</table>';
	}
	elseif($action == 'items'){
		/*
			list all the items
			in the diary
			and let the editable
		*/
		$path = '../../'.$tcms_administer_site.'/components/diary/data';
		
		$arrFile = $tcms_main->readdir_ext($path);
		
		$count = 0;
		
		if(is_array($arrFile)){
			foreach($arrFile as $cKey => $cValue){
				$xml = new xmlparser($path.'/'.$cValue, 'r');
				
				$arrDiary['tag'][$count]    = substr($cValue, 0, 10);
				$arrDiary['stamp'][$count]  = $xml->read_section('date', 'stamp');
				$arrDiary['date'][$count]   = $xml->read_section('date', 'timestamp');
				$arrDiary['title'][$count]  = $xml->read_section('date', 'title');
				$arrDiary['text'][$count]   = $xml->read_section('date', 'text');
				$arrDiary['loc'][$count]    = $xml->read_section('date', 'location');
				$arrDiary['town'][$count]   = $xml->read_section('date', 'town');
				$arrDiary['access'][$count] = $xml->read_section('date', 'access');
				$arrDiary['pub'][$count]    = $xml->read_section('date', 'published');
				
				$arrDiary['title'][$count]  = $tcms_main->encode_text_without_db($arrDiary['title'][$count], '2', $c_charset);
				$arrDiary['loc'][$count]    = $tcms_main->encode_text_without_db($arrDiary['loc'][$count], '2', $c_charset);
				$arrDiary['town'][$count]   = $tcms_main->encode_text_without_db($arrDiary['town'][$count], '2', $c_charset);
				
				$tempStr = $tcms_main->encode_text_without_db($arrDiary['text'][$count], '2', $c_charset);
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
				$xml->_xmlparser();
			}
		}
		
		
		if(is_array($arrDiary)){
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
		
		
		if(is_array($arrDiary)){
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
			echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_DATE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="35%" align="left">'._TABLE_LOCATION.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="100%" align="left">'._TABLE_DESCRIPTION.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th>'
			.'</tr>';
			
			if(is_array($arrDiary)){
				foreach($arrDiary['stamp'] as $key => $value){
					if(is_integer($key/2)){ $wsc = 0; }
					else{ $wsc = 1; }
					
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

if($action == 'edit'){
	//***************************
	//
	$path = '../../'.$tcms_administer_site.'/components/diary/data/';
	
	if(isset($maintag) && !empty($maintag) && $maintag != ''){
		$xml  = new xmlparser($path.$maintag.'.xml','r');
		
		$d_stamp  = $xml->read_section('date', 'stamp');
		$d_date   = $xml->read_section('date', 'timestamp');
		$d_title  = $xml->read_section('date', 'title');
		$d_text   = $xml->read_section('date', 'text');
		$d_tic    = $xml->read_section('date', 'tickets');
		$d_loc    = $xml->read_section('date', 'location');
		$d_land   = $xml->read_section('date', 'country');
		$d_town   = $xml->read_section('date', 'town');
		$d_zip    = $xml->read_section('date', 'zip');
		$d_adress = $xml->read_section('date', 'adress');
		$d_access = $xml->read_section('date', 'access');
		$d_pub    = $xml->read_section('date', 'published');
		
		
		if($d_stamp  == false){ $d_stamp  = ''; }
		if($d_date   == false){ $d_date   = ''; }
		if($d_title  == false){ $d_title  = ''; }
		if($d_text   == false){ $d_text   = ''; }
		if($d_tic    == false){ $d_tic    = ''; }
		if($d_loc    == false){ $d_loc    = ''; }
		if($d_land   == false){ $d_land   = ''; }
		if($d_town   == false){ $d_town   = ''; }
		if($d_zip    == false){ $d_zip    = ''; }
		if($d_adress == false){ $d_adress = ''; }
		if($d_access == false){ $d_access = ''; }
		if($d_pub    == false){ $d_pub    = ''; }
		
		
		$d_title  = $tcms_main->encode_text_without_db($d_title, '2', $c_charset);
		$d_text   = $tcms_main->encode_text_without_db($d_text, '2', $c_charset);
		$d_tic    = $tcms_main->encode_text_without_db($d_tic, '2', $c_charset);
		$d_loc    = $tcms_main->encode_text_without_db($d_loc, '2', $c_charset);
		$d_land   = $tcms_main->encode_text_without_db($d_land, '2', $c_charset);
		$d_town   = $tcms_main->encode_text_without_db($d_town, '2', $c_charset);
		$d_adress = $tcms_main->encode_text_without_db($d_adress, '2', $c_charset);
		
		
		echo tcms_html::bold(_TABLE_EDIT);
	}
	else{
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
		
		while(($maintag=substr(md5(time()),0,10)) && file_exists($path.$maintag.'.xml')){}
		
		echo tcms_html::bold(_TABLE_NEW);
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
	
	echo tcms_html::text(_CONTENT_TEXT_PAGE.'<br /><br />', 'left');
	
	
	echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
	echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
	echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
	echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';
	
	
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
	.'<script>createToendaToolbar(\'side\', \''.$tcms_lang.'\', \''.( $show_wysiwyg == 'toendaScript' ? $show_wysiwyg : 'HTML' ).'\', \'?n=without\', \'\', \''.$id_user.'\');</script>';
	
	if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'side\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
	else{ echo '<script>createToolbar(\'side\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
	
	echo '<textarea class="tcms_textarea_huge" id="content" name="content">'.$d_text.'</textarea>'
	.'</td></tr>';
	
	
	
	//================================================
	echo '</table>';
	
	echo '</form>';
}







//         

/*
	save item
*/

if($action == 'save_item'){
	if(empty($new_d_pub))  { $new_d_pub    = 0; }
	if($new_d_access == ''){ $new_d_access = 'Public'; }
	
	
	$content = $tcms_main->nl2br($content);
	
	
	// CHARSETS
	$new_d_title  = $tcms_main->decode_text_without_db($new_d_title, '2', $c_charset);
	$content      = $tcms_main->decode_text_without_db($content, '2', $c_charset);
	$new_d_tic    = $tcms_main->decode_text_without_db($new_d_tic, '2', $c_charset);
	$new_d_loc    = $tcms_main->decode_text_without_db($new_d_loc, '2', $c_charset);
	$new_d_land   = $tcms_main->decode_text_without_db($new_d_land, '2', $c_charset);
	$new_d_town   = $tcms_main->decode_text_without_db($new_d_town, '2', $c_charset);
	$new_d_adress = $tcms_main->decode_text_without_db($new_d_adress, '2', $c_charset);
	
	
	if($new_d_stamp == ''){
		$new_d_stamp = substr($new_d_date, 6, 4).substr($new_d_date, 3, 2).substr($new_d_date, 0, 2).substr($new_d_date, 11, 2).substr($new_d_date, 14, 2);
	}
	
	
	$xmluser = new xmlparser('../../'.$tcms_administer_site.'/components/'.$component.'/data/'.$maintag.'.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section('date');
	
	$xmluser->write_value('stamp', $new_d_stamp);
	$xmluser->write_value('timestamp', $new_d_date);
	$xmluser->write_value('title', $new_d_title);
	$xmluser->write_value('text', $content);
	$xmluser->write_value('tickets', $new_d_tic);
	$xmluser->write_value('location', $new_d_loc);
	$xmluser->write_value('country', $new_d_land);
	$xmluser->write_value('town', $new_d_town);
	$xmluser->write_value('zip', $new_d_zip);
	$xmluser->write_value('adress', $new_d_adress);
	$xmluser->write_value('published', $new_d_pub);
	$xmluser->write_value('access', $new_d_access);
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end('date');
	$xmluser->_xmlparser();
	
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'&action=items\'</script>';
}









/*
	save changes
	on the settings
*/

if($action == 'save'){
	if(empty($new_cs_show_diary_title))  { $new_cs_show_diary_title   = 0; }
	
	
	// CHARSETS
	$new_cs_diary_title       = $tcms_main->decode_text_without_db($new_cs_diary_title, '2', $c_charset);
	$new_cs_diary_subtitle    = $tcms_main->decode_text_without_db($new_cs_diary_subtitle, '2', $c_charset);
	$content                  = $tcms_main->decode_text_without_db($content, '2', $c_charset);
	$new_cs_sb_diary_title    = $tcms_main->decode_text_without_db($new_cs_sb_diary_title, '2', $c_charset);
	$new_cs_sb_diary_subtitle = $tcms_main->decode_text_without_db($new_cs_sb_diary_subtitle, '2', $c_charset);
	
	
	$xmluser = new xmlparser('../../'.$tcms_administer_site.'/components/'.$component.'/diary.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section('cs');
	
	$xmluser->write_value('diary_title', $new_cs_diary_title);
	$xmluser->write_value('diary_subtitle', $new_cs_diary_subtitle);
	$xmluser->write_value('diary_text', $content);
	$xmluser->write_value('sb_diary_title', $new_cs_sb_diary_title);
	$xmluser->write_value('sb_diary_subtitle', $new_cs_sb_diary_subtitle);
	$xmluser->write_value('sb_show_diary_title', $new_cs_show_diary_title);
	$xmluser->write_value('sb_how_many_dates', $new_cs_how_many_dates);
	$xmluser->write_value('color_row_1', $new_color_row_1);
	$xmluser->write_value('color_row_2', $new_color_row_2);
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end('cs');
	$xmluser->_xmlparser();
	
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'\'</script>';
}









/*
	DELETE
*/
if($action == 'delete'){
	//****************************************
	
	unlink('../../'.$tcms_administer_site.'/components/diary/data/'.$maintag.'.xml');
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'&action=items\'</script>';
	
	//****************************************
}

?>
