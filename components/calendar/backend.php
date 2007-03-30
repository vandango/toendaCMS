<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Calendar component Backend
|
| File:		backend.php
| Version:	0.1.1
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
if(isset($_POST['new_cs_calendar_title'])){ $new_cs_calendar_title = $_POST['new_cs_calendar_title']; }
if(isset($_POST['new_cs_show_calendar_title'])){ $new_cs_show_calendar_title = $_POST['new_cs_show_calendar_title']; }
if(isset($_POST['new_cs_sunday_color'])){ $new_cs_sunday_color = $_POST['new_cs_sunday_color']; }
if(isset($_POST['new_cs_saturday_color'])){ $new_cs_saturday_color = $_POST['new_cs_saturday_color']; }
if(isset($_POST['new_cs_currentday_backcolor'])){ $new_cs_currentday_backcolor = $_POST['new_cs_currentday_backcolor']; }
if(isset($_POST['new_cs_weekday_border'])){ $new_cs_weekday_border = $_POST['new_cs_weekday_border']; }
if(isset($_POST['new_cs_day_with_event'])){ $new_cs_day_with_event = $_POST['new_cs_day_with_event']; }
if(isset($_POST['new_cs_decode_title'])){ $new_cs_decode_title = $_POST['new_cs_decode_title']; }
if(isset($_POST['new_cs_day_as_link'])){ $new_cs_day_as_link = $_POST['new_cs_day_as_link']; }
if(isset($_POST['new_cs_linked_module'])){ $new_cs_linked_module = $_POST['new_cs_linked_module']; }







if($action != 'save'){
	$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings('calendar', 'calendar.xml', 'calendar');
	
	
	$cs_calendar_title       = $_TCMS_CS_ARRAY['calendar']['content']['calendar_title'];
	$cs_show_calendar_title  = $_TCMS_CS_ARRAY['calendar']['content']['show_calendar_title'];
	$cs_sunday_color         = $_TCMS_CS_ARRAY['calendar']['content']['sunday_color'];
	$cs_saturday_color       = $_TCMS_CS_ARRAY['calendar']['content']['saturday_color'];
	$cs_currentday_backcolor = $_TCMS_CS_ARRAY['calendar']['content']['currentday_backcolor'];
	$cs_weekday_border       = $_TCMS_CS_ARRAY['calendar']['content']['weekday_border'];
	$cs_day_with_event       = $_TCMS_CS_ARRAY['calendar']['content']['day_with_event'];
	$cs_day_as_link          = $_TCMS_CS_ARRAY['calendar']['content']['day_as_link'];
	$cs_linked_module        = $_TCMS_CS_ARRAY['calendar']['content']['linked_module'];
	$cs_decode_title         = $_TCMS_CS_ARRAY['calendar']['attribute']['calendar_title']['ENCODE'];
	
	if($cs_decode_title == 1){
		$cs_calendar_title = $tcms_main->encode_text_without_crypt($cs_calendar_title, '2', $c_charset);
	}
	
	
	
	
	
	/*
		BEGIN FORM
	*/
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=admin&amp;component='.$component.'&amp;backend='.$backend.'" method="post">'
	.'<input name="component" type="hidden" value="'.$component.'" />'
	.'<input name="backend" type="hidden" value="'.$backend.'" />'
	.'<input name="action" type="hidden" value="save" />';
	
	
	// table head
	echo '<table cellpadding="1" cellspacing="0" width="100%" border="0" class="noborder">';
	
	
	// row
	echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._TABLE_SETTINGS.'</strong></td></tr>';
	
	
	// row
	echo '<tr><td colspan="2" class="tcms_padding_mini"></td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_TITLE.'</td>'
	.'<td valign="top"><input name="new_cs_calendar_title" class="tcms_input_normal" value="'.$cs_calendar_title.'" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">Charset decode '._TABLE_TITLE.'</td>'
	.'<td valign="top"><input name="new_cs_decode_title"'.( $cs_decode_title == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_TITLE.' '._TABLE_ENABLED.'</td>'
	.'<td valign="top"><input name="new_cs_show_calendar_title"'.( $cs_show_calendar_title == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">"Day as link" '._TABLE_ENABLED.'</td>'
	.'<td valign="top"><input name="new_cs_day_as_link"'.( $cs_day_as_link == 1 ? ' checked="checked"' : '' ).' type="checkbox" value="1" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TCMS_COLOR.' '._TCMS_DAY_SUNDAY.'</td>'
	.'<td valign="top">'
	.'<input name="new_cs_sunday_color" id="color_sunday" class="tcms_id_box" value="'.$cs_sunday_color.'" />'
	.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color_sunday\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TCMS_COLOR.' '._TCMS_DAY_SATURDAY.'</td>'
	.'<td valign="top">'
	.'<input name="new_cs_saturday_color" id="color_saturday" class="tcms_id_box" value="'.$cs_saturday_color.'" />'
	.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color_saturday\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TCMS_BACKGROUND.' '._TCMS_COLOR.' '._TCMS_TODAY.'</td>'
	.'<td valign="top">'
	.'<input name="new_cs_currentday_backcolor" id="color_urrentday" class="tcms_id_box" value="'.$cs_currentday_backcolor.'" />'
	.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color_urrentday\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TCMS_BORDER.' '._TCMS_COLOR.' '._TCMS_WEEKDAY.'</td>'
	.'<td valign="top">'
	.'<input name="new_cs_weekday_border" id="color_weekday" class="tcms_id_box" value="'.$cs_weekday_border.'" />'
	.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=color_weekday\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
	.'</td></tr>';
	
	
	// table rows
	echo '<tr><td class="tcms_padding_mini" valign="top">'._TCMS_BACKGROUND.' '._TCMS_COLOR.' for a day with a event</td>'
	.'<td valign="top">'
	.'<input name="new_cs_day_with_event" id="day_with_event" class="tcms_id_box" value="'.$cs_day_with_event.'" />'
	.'<input type="button" value="?" onclick="javascript:openWindow(\'color_chooser.php?id=day_with_event\', \'ColorChooser\', \'300\', \'230\', \'0\', \'0\');" />'
	.'</td></tr>';
	
	
	// table row
	echo '<tr><td class="tcms_padding_mini" width="'.$width.'">Use the calendar for this module</td>'
	.'<td valign="top">'
	.'<select name="new_cs_linked_module" class="tcms_select">'
		.'<option value="newsmanager"'.( $cs_linked_module == 'newsmanager' ? ' selected="selected"' : '' ).'>'._TCMS_MENU_NEWS.'</option>'
		.'<option value="diary"'.      ( $cs_linked_module == 'diary'       ? ' selected="selected"' : '' ).'>'._TCMS_MENU_CS.': Diary</option>'
	.'</select>'
	.'</td></tr>';
	
	
	// Table end
	echo '</table>'
	.'<br />'
	.'</form>';
}







/*
	save function
*/
if($action == 'save'){
	if(empty($new_cs_decode_title))        { $new_cs_decode_title         = 0; }
	if(empty($new_cs_show_calendar_title)) { $new_cs_show_calendar_title  = 0; }
	if(empty($new_cs_linked_module))       { $new_cs_linked_module        = 'newsmanager'; }
	if($new_cs_sunday_color         == '') { $new_cs_sunday_color         = 'ff0000'; }
	if($new_cs_saturday_color       == '') { $new_cs_saturday_color       = '000000'; }
	if($new_cs_currentday_backcolor == '') { $new_cs_currentday_backcolor = 'ffffff'; }
	if($new_cs_weekday_border       == '') { $new_cs_weekday_border       = 'ffffff'; }
	if($new_cs_day_with_event       == '') { $new_cs_day_with_event       = 'f5f5f5'; }
	
	
	// CHARSETS
	$new_csTitle    = $tcms_main->decode_text_without_crypt($new_csTitle, '2', $c_charset);
	$new_csSubTitle = $tcms_main->decode_text_without_crypt($new_csSubTitle, '2', $c_charset);
	$new_csDesc     = $tcms_main->decode_text_without_crypt($new_csDesc, '2', $c_charset);
	
	
	$xmluser = new xmlparser('../../'.$tcms_administer_site.'/components/'.$component.'/calendar.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section('cs');
	
	$xmluser->write_value_with_attribute('calendar_title', $new_cs_calendar_title, 'encode', $new_cs_decode_title);
	$xmluser->write_value('show_calendar_title', $new_cs_show_calendar_title);
	$xmluser->write_value('sunday_color', $new_cs_sunday_color);
	$xmluser->write_value('saturday_color', $new_cs_saturday_color);
	$xmluser->write_value('currentday_backcolor', $new_cs_currentday_backcolor);
	$xmluser->write_value('weekday_border', $new_cs_weekday_border);
	$xmluser->write_value('day_with_event', $new_cs_day_with_event);
	$xmluser->write_value('day_as_link', $new_cs_day_as_link);
	$xmluser->write_value('linked_module', $new_cs_linked_module);
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end('cs');
	$xmluser->_xmlparser();
	
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_components&todo=admin&component='.$component.'&backend='.$backend.'\'</script>';
}










?>
