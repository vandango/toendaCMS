<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Personal Notebook
|
| File:	mod_notebook.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Personal Notebook
 *
 * This module is used as a personal notebook.
 *
 * @version 0.2.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['sender'])){ $sender = $_GET['sender']; }

if(isset($_POST['new_note'])){ $new_note = $_POST['new_note']; }
if(isset($_POST['new_name'])){ $new_name = $_POST['new_name']; }
if(isset($_POST['sender'])){ $sender = $_POST['sender']; }



// ----------------------------------------------------
// INIT
// ----------------------------------------------------



// ----------------------------------------------------
// USERNAME
// ----------------------------------------------------

if($choosenDB == 'xml'){
	$note_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_notepad/'.$m_tag.'.xml','r');
	$nname = $note_xml->read_section('note', 'name');
	$nnote = $note_xml->read_section('note', 'text');
	
	if(!$nname){ $nname = ''; }
	if(!$nnote){ $nnote = ''; }
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB);
	$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'notepad', $m_tag);
	$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
	
	$nname = $sqlARR['name'];
	$nnote = $sqlARR['note'];
	
	if($nname == NULL){ $nname = ''; }
	if($nnote == NULL){ $nnote = ''; }
}

$nname = $tcms_main->decodeText($nname, '2', $c_charset);
$nnote = $tcms_main->decodeText($nnote, '2', $c_charset);

$nnote = ereg_replace('<br />'.chr(10), chr(13), $nnote);
$nnote = ereg_replace('<br />'.chr(13), chr(13), $nnote);
$nnote = ereg_replace('<br />', chr(13), $nnote);

$nnote = ereg_replace('<br/>'.chr(10), chr(13), $nnote);
$nnote = ereg_replace('<br/>'.chr(13), chr(13), $nnote);
$nnote = ereg_replace('<br/>', chr(13), $nnote);

$nnote = ereg_replace('<br>'.chr(10), chr(13), $nnote);
$nnote = ereg_replace('<br>'.chr(13), chr(13), $nnote);
$nnote = ereg_replace('<br>', chr(13), $nnote);



// ----------------------------------------------------
// BEGIN FORM
// ----------------------------------------------------

echo '<!--BEGIN-FORM-->'
.'<form action="admin.php?id_user='.$id_user.'&amp;site=mod_notebook" method="post">'
.'<input type="hidden" name="new_name" value="'.$nname.'" />'
.'<input type="hidden" name="maintag" value="'.$m_tag.'" />'
.'<input type="hidden" name="todo" value="save" />'
.'<!--BEGIN-TABLE-->';


// if open from dektop
if($sender == 'desktop'){
	echo '<input type="hidden" name="sender" value="desktop" />';
}


// TABLE FOR OUTPUT AND INPUT
echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';


// table title
echo '<tr><td><strong>'._NOTEBOOK_TITLE.'</strong></td></tr>';


// table rows
echo '<tr><td><br /><img border="0" align="left" src="../images/editbook.gif" />'._NOTEBOOK_TEXT.'<br /><br /></td></tr>';


// table rows
echo '<tr><td>';
	echo '<table width="450" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
	.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._NOTEBOOK_DETAIL.'</th>'
	.'</tr><tr><td>'
	.'<textarea name="new_note" class="tcms_notebook">'.$nnote.'</textarea>'
	.'</td></tr></table>';
echo '</td></tr>';


// Table end
echo '</table></form><br />';



// ----------------------------------------------------
// SAVE, EDIT AND DELETE
// ----------------------------------------------------

if($todo == 'save') {
	if($new_note == ''){ $new_note = _NOTEBOOK_MSG.' ...'; }
	
	$new_note = $tcms_main->convertNewlineToHTML($new_note);
	
	$new_note = $tcms_main->encodeText($new_note, '2', $c_charset);
	$new_name = $tcms_main->encodeText($new_name, '2', $c_charset);
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_notepad/'.$maintag.'.xml','w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('note');
		
		$xmluser->write_value('name', $new_name);
		$xmluser->write_value('text', $new_note);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('note');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = $tcms_db_prefix.'notepad.name="'.$new_name.'", '.$tcms_db_prefix.'notepad.note="'.$new_note.'"';
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'notepad', $newSQLData, $maintag);
	}
	
	if($sender == 'desktop') {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
		.'</script>';
	}
	else {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_notebook\';'
		.'</script>';
	}
}