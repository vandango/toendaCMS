<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Guestbook entrys
|
| File:	mod_guestbook.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Guestbook entrys
 *
 * This module is used for the guestbook entrys.
 *
 * @version 0.1.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_POST['new_guest_name'])){ $new_guest_name = $_POST['new_guest_name']; }
if(isset($_POST['new_guest_mail'])){ $new_guest_mail = $_POST['new_guest_mail']; }
if(isset($_POST['new_guest_text'])){ $new_guest_text = $_POST['new_guest_text']; }
if(isset($_POST['new_guest_date'])){ $new_guest_date = $_POST['new_guest_date']; }
if(isset($_POST['new_guest_time'])){ $new_guest_time = $_POST['new_guest_time']; }
if(isset($_POST['dbAction'])){ $dbAction = $_POST['dbAction']; }




//=====================================================
// INIT
//=====================================================

if(!isset($todo)){ $todo = 'show'; }

echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';




if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	//=====================================================
	// SHOW OLD VALUES
	//=====================================================
	
	if($todo == 'show'){
		echo tcms_html::bold(_BOOK_TITLE);
		echo tcms_html::text(_BOOK_TEXT.'<br /><br />', 'left');
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_guestbook/');
			
			$count = 0;
			
			if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
				foreach($arr_filename as $key => $value){
					$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_guestbook/'.$value,'r');
					
					$arrCat['uid'][$count]  = substr($value, 0, 32);
					$arrCat['name'][$count] = $menu_xml->read_section('entry', 'name');
					$arrCat['text'][$count] = $menu_xml->read_section('entry', 'text');
					$arrCat['mail'][$count] = $menu_xml->read_section('entry', 'email');
					$arrCat['date'][$count] = $menu_xml->read_section('entry', 'date');
					$arrCat['time'][$count] = $menu_xml->read_section('entry', 'time');
					
					if($arrCat['name'][$count] == false){ $arrCat['name'][$count] = ''; }
					if($arrCat['text'][$count] == false){ $arrCat['text'][$count] = ''; }
					if($arrCat['mail'][$count] == false){ $arrCat['mail'][$count] = ''; }
					if($arrCat['date'][$count] == false){ $arrCat['date'][$count] = ''; }
					if($arrCat['time'][$count] == false){ $arrCat['time'][$count] = ''; }
					
					// CHARSETS
					$arrCat['name'][$count] = $tcms_main->decodeText($arrCat['name'][$count], '2', $c_charset);
					$tempStr = $tcms_main->decodeText($arrCat['text'][$count], '2', $c_charset);
					$arrCat['text'][$count] = ( strlen($tempStr) > 60 ? substr($tempStr, 0, 60).'...' : $tempStr );
					$arrCat['mail'][$count] = $tcms_main->decodeText($arrCat['mail'][$count], '2', $c_charset);
					
					$count++;
				}
				
				array_multisort(
					$arrCat['date'], SORT_DESC, 
					$arrCat['time'], SORT_DESC, 
					$arrCat['name'], SORT_DESC, 
					$arrCat['mail'], SORT_DESC, 
					$arrCat['text'], SORT_DESC, 
					$arrCat['uid'], SORT_DESC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'guestbook_items ORDER BY date DESC, time DESC');
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arrCat['uid'][$count]  = $sqlARR['uid'];
				$arrCat['name'][$count] = $sqlARR['name'];
				$arrCat['mail'][$count] = $sqlARR['email'];
				$arrCat['text'][$count] = $sqlARR['text'];
				$arrCat['date'][$count] = $sqlARR['date'];
				$arrCat['time'][$count] = $sqlARR['time'];
				
				if($arrCat['name'][$count] == NULL){ $arrCat['name'][$count] = ''; }
				if($arrCat['text'][$count] == NULL){ $arrCat['text'][$count] = ''; }
				if($arrCat['mail'][$count] == NULL){ $arrCat['mail'][$count] = ''; }
				if($arrCat['date'][$count] == NULL){ $arrCat['date'][$count] = ''; }
				if($arrCat['time'][$count] == NULL){ $arrCat['time'][$count] = ''; }
					
				
				// CHARSETS
				$arrCat['name'][$count] = $tcms_main->decodeText($arrCat['name'][$count], '2', $c_charset);
				$tempStr = $tcms_main->decodeText($arrCat['text'][$count], '2', $c_charset);
				$arrCat['text'][$count] = ( strlen($tempStr) > 60 ? substr($tempStr, 0, 60).'...' : $tempStr );
				$arrCat['mail'][$count] = $tcms_main->decodeText($arrCat['mail'][$count], '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="left" colspan="2">'._TABLE_DATE.' - '._TABLE_TIME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_EMAIL.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="80%" align="left">'._TABLE_DESCRIPTION.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th></tr>';
		
		if(isset($arrCat['name']) && !empty($arrCat['name']) && $arrCat['name'] != ''){
			foreach($arrCat['name'] as $key => $value){
				if(is_integer($key/2)){ $wsc = 0; }
				else{ $wsc = 1; }
				
				
				$arrCat['name'][$key] = $tcms_main->cleanGBLink($arrCat['name'][$key]);
				$arrCat['mail'][$key] = $tcms_main->cleanGBLink($arrCat['mail'][$key]);
				$arrCat['text'][$key] = $tcms_main->cleanGBLink($arrCat['text'][$key]);
				
				
				$arrCat['name'][$key] = $tcms_main->cleanGBScript($arrCat['name'][$key]);
				$arrCat['mail'][$key] = $tcms_main->cleanGBScript($arrCat['mail'][$key]);
				$arrCat['text'][$key] = $tcms_main->cleanGBScript($arrCat['text'][$key]);
				
				
				$tmpDate = $arrCat['date'][$key];
				$tmpDate = substr($tmpDate, 6, 2).'.'.substr($tmpDate, 4, 2).'.'.substr($tmpDate, 0, 4);
				
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$arr_color[$wsc].'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')" '
				.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_guestbook&amp;todo=edit&amp;maintag='.$arrCat['uid'][$key].'\';">';
				
				echo '<td class="tcms_db_2" style="width: 13px !important;"><img border="0" src="../images/guests.png" /></td>';
				echo '<td class="tcms_db_2">'.$tmpDate.' - '.$arrCat['time'][$key].'</td>';
				
				echo '<td class="tcms_db_2">'.$arrCat['name'][$key].'&nbsp;</td>';
				
				echo '<td class="tcms_db_2">'.$arrCat['mail'][$key].'&nbsp;</td>';
				
				echo '<td class="tcms_db_2">'.$arrCat['text'][$key].'&nbsp;</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook&amp;todo=edit&amp;maintag='.$arrCat['uid'][$key].'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook&amp;&todo=delete&amp;maintag='.$arrCat['uid'][$key].'">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	//=====================================================
	// FORM
	//=====================================================
	
	if($todo == 'edit') {
		if(isset($maintag) && !empty($maintag) && $maintag != ''){
			if($choosenDB == 'xml'){
				$user_xml  = new xmlparser('../../'.$tcms_administer_site.'/tcms_guestbook/'.$maintag.'.xml','r');
				
				$guest_name =  $user_xml->read_value('name');
				$guest_mail =  $user_xml->read_value('email');
				$guest_text =  $user_xml->read_value('text');
				$guest_date =  $user_xml->read_value('date');
				$guest_time =  $user_xml->read_value('time');
				
				if($guest_name == false){ $guest_name = ''; }
				if($guest_mail == false){ $guest_mail = ''; }
				if($guest_text == false){ $guest_text = ''; }
				if($guest_date == false){ $guest_date = ''; }
				if($guest_time == false){ $guest_time = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'guestbook_items', $maintag);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$guest_name = $sqlARR['name'];
				$guest_mail = $sqlARR['email'];
				$guest_text = $sqlARR['text'];
				$guest_date = $sqlARR['date'];
				$guest_time = $sqlARR['time'];
				
				if($guest_name == NULL){ $guest_name = ''; }
				if($guest_mail == NULL){ $guest_mail = ''; }
				if($guest_text == NULL){ $guest_text = ''; }
				if($guest_date == NULL){ $guest_date = ''; }
				if($guest_time == NULL){ $guest_time = ''; }
				
				$dbDo = 'save';
			}
			
			
			$guest_name = $tcms_main->decodeText($guest_name, '2', $c_charset);
			$guest_mail = $tcms_main->decodeText($guest_mail, '2', $c_charset);
			$guest_text = $tcms_main->decodeText($guest_text, '2', $c_charset);
			
			
			$guest_name = htmlspecialchars($guest_name);
			$guest_mail = htmlspecialchars($guest_mail);
			
			
			$guest_text = ereg_replace('<br />'.chr(10), chr(13), $guest_text);
			$guest_text = ereg_replace('<br />'.chr(13), chr(13), $guest_text);
			$guest_text = ereg_replace('<br />', chr(13), $guest_text);
			
			$guest_text = ereg_replace('<br/>'.chr(10), chr(13), $guest_text);
			$guest_text = ereg_replace('<br/>'.chr(13), chr(13), $guest_text);
			$guest_text = ereg_replace('<br/>', chr(13), $guest_text);
			
			$guest_text = ereg_replace('<br>'.chr(10), chr(13), $guest_text);
			$guest_text = ereg_replace('<br>'.chr(13), chr(13), $guest_text);
			$guest_text = ereg_replace('<br>', chr(13), $guest_text);
			
			
			echo tcms_html::bold(_TABLE_EDIT);
			$odot = 'save';
			
			$guest_date = substr($guest_date, 6, 2).'.'.substr($guest_date, 4, 2).'.'.substr($guest_date, 0, 4);
		}
		else{
			$guest_name = '';
			$guest_mail = '';
			$guest_text = '';
			$guest_date = date('d.m.Y');
			$guest_time = date('H:i');
			
			if($choosenDB == 'xml'){ while(($maintag=substr(md5(time()),0,32)) && file_exists('../../'.$tcms_administer_site.'/tcms_guestbook/'.$maintag.'.xml')){} }
			else{ $maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'guestbook_items', 32); }
			
			echo tcms_html::bold(_TABLE_NEW);
			$odot = 'save';
			if($choosenDB != 'xml'){ $dbDo = 'next'; }
		}
		
		
		
		$width = '200';
		
		echo tcms_html::text(_NEWS_CATEGORIES_TEXT.'<br /><br />', 'left');
		
		
		// form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook" method="post">'
		.'<input name="todo" type="hidden" value="'.$odot.'" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
		
		if($choosenDB != 'xml'){
			echo '<input name="dbAction" type="hidden" value="'.$dbDo.'" />';
		}
		else{
			echo '<input name="CatCount" type="hidden" value="'.$cat_count.'" />';
		}
		
		
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
		.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
		.'</tr></table>';
		
		
		// table head
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_NAME.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_guest_name" type="text" value="'.$guest_name.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_EMAIL.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_guest_mail" type="text" value="'.$guest_mail.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_DESCRIPTION.'</strong></td>'
		.'<td valign="top"><textarea class="tcms_textarea_big" name="new_guest_text">'.$guest_text.'</textarea>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_DATE.'</strong></td>'
		.'<td><input class="tcms_input_small" id="new_guest_date" name="new_guest_date" type="text" value="'.$guest_date.'" />'
		.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDate" />'
		.'</td></tr>';
		
		echo '<script type="text/javascript">
			Calendar.setup({
		        inputField     :    "new_guest_date",
		        ifFormat       :    "%d.%m.%Y",
		        showsTime      :    false,
		        button         :    "triggerButtonDate",
		        singleClick    :    false,
		        step           :    1
		    });
		</script>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_TIME.'</strong></td>'
		.'<td><input class="tcms_input_small" id="new_guest_time" name="new_guest_time" type="text" value="'.$guest_time.'" />'
		.'</td></tr>';
		
		
		// table end
		echo '</table>';
		
		
		// form end
		echo '</form>';
	}
	
	
	
	
	
	//=====================================================
	// SAVING
	//=====================================================
	
	if($todo == 'save') {
		if($new_guest_date == '' || !isset($new_guest_date)){ $new_guest_date = date('d.m.Y'); }
		if($new_guest_time == '' || !isset($new_guest_time)){ $new_guest_time = date('H:i'); }
		
		
		$new_guest_text = $tcms_main->nl2br($new_guest_text);
		
		
		$new_guest_date = substr($new_guest_date, 6, 4).substr($new_guest_date, 3, 2).substr($new_guest_date, 0, 2);
		
		
		$new_guest_name = $tcms_main->decode_text($new_guest_name, '2', $c_charset);
		$new_guest_mail = $tcms_main->decode_text($new_guest_mail, '2', $c_charset);
		$new_guest_text = $tcms_main->decode_text($new_guest_text, '2', $c_charset);
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_guestbook/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('entry');
			
			$xmluser->write_value('name', $new_guest_name);
			$xmluser->write_value('email', $new_guest_mail);
			$xmluser->write_value('text', $new_guest_text);
			$xmluser->write_value('date', $new_guest_date);
			$xmluser->write_value('time', $new_guest_time);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('entry');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($dbAction){
				case 'save':
					$newSQLData = ''
					.$tcms_db_prefix.'guestbook_items.name="'.$new_guest_name.'", '
					.$tcms_db_prefix.'guestbook_items.email="'.$new_guest_mail.'", '
					.$tcms_db_prefix.'guestbook_items.text="'.$new_guest_text.'", '
					.$tcms_db_prefix.'guestbook_items.date="'.$new_guest_date.'", '
					.$tcms_db_prefix.'guestbook_items.time="'.$new_guest_time.'"';
					
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'guestbook_items', $newSQLData, $maintag);
					break;
				
				case 'next':
					switch($choosenDB){
						case 'mysql':
							$newSQLColumns = '`name`, `email`, `text`, `date`, `time`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'name, email, text, "date", time';
							break;
						
						case 'mssql':
							$newSQLColumns = '[name], [email], [text], [date], [time]';
							break;
					}
					$newSQLData = "'".$new_guest_name."', '".$new_guest_mail."', '".$new_guest_text."', '".$new_guest_date."', '".$new_guest_time."'";
					
					$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'guestbook_items', $newSQLColumns, $newSQLData, $maintag);
					break;
			}
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook\''
		.'</script>';
	}
	
	
	
	
	
	//=====================================================
	// DELETE
	//=====================================================
	
	if($todo == 'delete'){
		if($choosenDB == 'xml') {
			unlink('../../'.$tcms_administer_site.'/tcms_guestbook/'.$maintag.'.xml');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'guestbook_items', $maintag);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook\''
		.'</script>';
	}
	
	
	
	
	
	//=====================================================
	// DELETE ALL
	//=====================================================
	
	if($todo == 'deleteall'){
		if($choosenDB == 'xml') {
			$tcms_main->deleteDirContent('../../'.$tcms_administer_site.'/tcms_guestbook/');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlAL->sqlDeleteAll($tcms_db_prefix.'guestbook_items');
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_guestbook\''
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
