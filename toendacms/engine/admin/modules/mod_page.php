<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Desktop
|
| File:	mod_page.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Desktop
 *
 * This module is used as the base for the workflow
 * engine.
 *
 * @version 0.2.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


// -----------------------------------------------------
// INIT
// -----------------------------------------------------

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;
$showAll   = false;





// -----------------------------------------------------
// TITLE
// -----------------------------------------------------

echo _DESKTOP_TOP_TEXT
.'<br /><br /><br />';





// -----------------------------------------------------
// LIST ALL
// -----------------------------------------------------

// row one - cell one: content -> list all not published news
if($choosenDB == 'xml') {
	$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_news/');
	$count = 0;
	
	if($tcms_main->isArray($arr_filename)) {
		foreach($arr_filename as $dkey => $value) {
			$main_xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.$value,'r');
			$desk_pub = $main_xml->read_value('published');
			$desk_acc = $main_xml->read_value('access');
			
			if($desk_pub == 0){
				if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
				else{
					if(trim($desk_acc) == 'Public' || trim($desk_acc) == 'Protected'){ $showAll = true; }
					else{ $showAll = false; }
				}
				
				if($showAll == true){
					$arr_desk_news['title'][$count] = $main_xml->read_value('title');
					$arr_desk_news['date'][$count]  = $main_xml->read_value('date');
					$arr_desk_news['time'][$count]  = $main_xml->read_value('time');
					$arr_desk_news['order'][$count] = $main_xml->read_value('order');
					$arr_desk_news['stamp'][$count] = $main_xml->read_value('stamp');
					$arr_desk_news['cmt'][$count]   = $main_xml->read_value('comments_enabled');
					$arr_desk_news['acc'][$count]   = $main_xml->read_value('access');
					$arr_desk_news['autor'][$count] = $main_xml->read_value('autor');
					$arr_desk_news['sof'][$count]   = $main_xml->read_value('show_on_frontpage');
					
					if(!$arr_desk_news['title'][$count]){ $arr_desk_news['title'][$count] = ''; }
					if(!$arr_desk_news['date'][$count]) { $arr_desk_news['date'][$count]  = ''; }
					if(!$arr_desk_news['time'][$count]) { $arr_desk_news['time'][$count]  = ''; }
					if(!$arr_desk_news['order'][$count]){ $arr_desk_news['order'][$count] = ''; }
					if(!$arr_desk_news['stamp'][$count]){ $arr_desk_news['stamp'][$count] = ''; }
					if(!$arr_desk_news['cmt'][$count])  { $arr_desk_news['cmt'][$count]   = ''; }
					if(!$arr_desk_news['acc'][$count])  { $arr_desk_news['acc'][$count]   = ''; }
					if(!$arr_desk_news['autor'][$count]){ $arr_desk_news['autor'][$count] = ''; }
					if(!$arr_desk_news['sof'][$count])  { $arr_desk_news['sof'][$count]   = ''; }
					
					// CHARSETS
					$arr_desk_news['title'][$count] = $tcms_main->decodeText($arr_desk_news['title'][$count], '2', $c_charset);
					$arr_desk_news['autor'][$count] = $tcms_main->decodeText($arr_desk_news['autor'][$count], '2', $c_charset);
					
					$count++;
				}
				
				$showAll = false;
			}
		}
	}
	
	if($arr_desk_news && is_array($arr_desk_news)){
		array_multisort(
			$arr_desk_news['stamp'], SORT_DESC, 
			$arr_desk_news['date'], SORT_DESC, 
			$arr_desk_news['time'], SORT_DESC, 
			$arr_desk_news['title'], SORT_DESC, 
			$arr_desk_news['cmt'], SORT_DESC, 
			$arr_desk_news['order'], SORT_DESC, 
			$arr_desk_news['autor'], SORT_DESC, 
			$arr_desk_news['acc'], SORT_DESC, 
			$arr_desk_news['sof'], SORT_DESC
		);
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	if($id_group == 'Developer' || $id_group == 'Administrator'){
		$strAdd = "OR access = 'Protected' OR access = 'Private' ) ";
	}
	else{
		$strAdd = "OR access = 'Protected' ) AND ( autor = '".$id_username."' ) ";
	}
	
	$sqlSTR = "SELECT * "
	."FROM ".$tcms_db_prefix."news "
	."WHERE published = 0 "
	."AND ( access = 'Public' ".$strAdd
	."ORDER BY stamp DESC, date DESC, time DESC";
	
	$sqlQR = $sqlAL->sqlQuery($sqlSTR);
	
	$count = 0;
	
	while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
		$arr_desk_news['order'][$count] = $sqlObj->uid;
		$arr_desk_news['title'][$count] = $sqlObj->title;
		$arr_desk_news['date'][$count]  = $sqlObj->date;
		$arr_desk_news['stamp'][$count] = $sqlObj->stamp;
		$arr_desk_news['time'][$count]  = $sqlObj->time;
		$arr_desk_news['acc'][$count]   = $sqlObj->access;
		$arr_desk_news['cmt'][$count]   = $sqlObj->comments_enabled;
		$arr_desk_news['autor'][$count] = $sqlObj->autor;
		$arr_desk_news['sof'][$count]   = $sqlObj->show_on_frontpage;
		
		if($arr_desk_news['order'][$count] == NULL){ $arr_desk_news['order'][$count] = ''; }
		if($arr_desk_news['title'][$count] == NULL){ $arr_desk_news['title'][$count] = ''; }
		if($arr_desk_news['date'][$count]  == NULL){ $arr_desk_news['date'][$count]  = ''; }
		if($arr_desk_news['time'][$count]  == NULL){ $arr_desk_news['time'][$count]  = ''; }
		if($arr_desk_news['stamp'][$count] == NULL){ $arr_desk_news['stamp'][$count] = ''; }
		if($arr_desk_news['acc'][$count]   == NULL){ $arr_desk_news['acc'][$count]   = ''; }
		if($arr_desk_news['cmt'][$count]   == NULL){ $arr_desk_news['cmt'][$count]   = ''; }
		if($arr_desk_news['autor'][$count] == NULL){ $arr_desk_news['autor'][$count] = ''; }
		//if($arr_desk_news['sof'][$count]   == NULL){ $arr_desk_news['sof'][$count]   = ''; }
		
		// CHARSETS
		$arr_desk_news['title'][$count] = $tcms_main->decodeText($arr_desk_news['title'][$count], '2', $c_charset);
		$arr_desk_news['autor'][$count] = $tcms_main->decodeText($arr_desk_news['autor'][$count], '2', $c_charset);
		
		$count++;
	}
	
	$sqlAL->sqlFreeResult($sqlQR);
}

echo '<div style="margin: 0 0 3px 0;"><strong class="tcms_ft_white">'._DESKTOP_UNPUBLISHED_NEWS.'</strong></div>';

echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
echo '<tr class="tcms_bg_blue_01">'
	.'<th valign="middle" class="tcms_db_title" width="10%" colspan="2">'._TABLE_DATE.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="45%" align="left">'._TABLE_TITLE.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_PUBLISHED.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_COMMENTS.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_FRONTPAGE.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="10%" align="center">'._TABLE_ACCESS.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';

if(isset($arr_desk_news['stamp']) && !empty($arr_desk_news['stamp']) && $arr_desk_news['stamp'] != ''){
	foreach($arr_desk_news['stamp'] as $key => $value){
		if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
		else{
			if($arr_desk_news['acc'][$key] == 'Public' || $arr_desk_news['acc'][$key] == 'Protected'){ $showAll = true; }
			else{ $showAll = false; }
		}
		
		if($showAll == true){
			$bgkey++;
			
			if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
			else{ $ws_farbe = $arr_farbe[1]; }
			
			echo '<tr height="25" id="row'.$key.'" '
			.'bgcolor="'.$ws_farbe.'" '
			.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arr_desk_news['order'][$key].'\';">';
			
			echo '<td align="center" width="5%" class="tcms_db_2"><img src="../images/news.gif" border="0" /></td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.( $arr_desk_news['date'][$key] == '' ? '<em>-empty-</em>' : $arr_desk_news['date'][$key] )
			.'&nbsp;</td>';
			
			echo '<td class="tcms_db_2">'
			.( empty($arr_desk_news['title'][$key]) ? '<em>-empty-</em>' : $arr_desk_news['title'][$key] )
			.'</td>';
			
			echo '<td class="tcms_db_2">'
			.( empty($arr_desk_news['autor'][$key]) ? '<em>-empty-</em>' : $arr_desk_news['autor'][$key] )
			.'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=publishItem&amp;action=on&amp;maintag='.$arr_desk_news['order'][$key].'&amp;sender=desktop">'
			.'<img src="../images/no.png" border="0" />'
			.'</a>'
			.'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=enableComments&amp;action='.( $arr_desk_news['cmt'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_desk_news['order'][$key].'&amp;sender=desktop">'
			.( $arr_desk_news['cmt'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
			.'</a>'
			.'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=enableFrontpage&amp;action='.( $arr_desk_news['cmt'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_desk_news['sof'][$key].'&amp;sender=desktop">'
			.( $arr_desk_news['sof'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
			.'</a>'
			.'</td>';
			
			echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_desk_news['acc'][$key] == 'Public' ? '#008800' : '#ff0000' ).';">'.$arr_desk_news['acc'][$key].'</td>';
			
			echo '<td class="tcms_db_2" align="right">'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arr_desk_news['order'][$key].'">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a>&nbsp;'
			.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=delete&amp;maintag='.$arr_desk_news['order'][$key].'">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>&nbsp;'
			.'</td>';
			
			echo '</tr>';
		}
	}
}

echo '</table>';







/*
	UNPUBLISHED DOCUMENTS
*/
echo '<br />';
echo '<br />';
echo '<br />';



if($id_group == 'Developer' || $id_group == 'Administrator'){
	// row one - cell one: content -> list all not published documents
	if($choosenDB == 'xml'){
		unset($value);
		
		$arr_contentname = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_content/');
		$count = 0;
		
		if($tcms_main->isArray($arr_contentname)) {
			foreach($arr_contentname as $key => $value) {
				$deskXML = new xmlparser(_TCMS_PATH.'/tcms_content/'.$value,'r');
				$pubVal  = $deskXML->read_value('published');
				
				if($pubVal == 0){
					if($id_group == 'Developer' || $id_group == 'Administrator'){
						$checkIn = true;
					}
					else{
						$autVal  = $deskXML->read_value('autor');
						
						if($autVal != $id_username){
							$checkIn = false;
						}
						else{
							$accVal  = $deskXML->read_value('access');
							
							switch($accVal){
								case 'Public': $checkIn = true; break;
								case 'Protected': $checkIn = true; break;
								case 'Private': $checkIn = false; break;
								default: $checkIn = false; break;
							}
						}
					}
					
					if($checkIn){
						$arr_desk_content['title'][$count]     = $deskXML->read_value('title');
						$arr_desk_content['id'][$count]        = $deskXML->read_value('id');
						$arr_desk_content['access'][$count]    = $deskXML->read_value('access');
						$arr_desk_content['autor'][$count]     = $deskXML->read_value('autor');
						$arr_desk_content['inw'][$count]       = $deskXML->read_value('in_work');
						
						if(!$arr_desk_content['title'][$count]) { $arr_desk_content['title'][$count] = ''; }
						if(!$arr_desk_content['id'][$count])    { $arr_desk_content['id'][$count]    = ''; }
						if(!$arr_desk_content['access'][$count]){ $arr_desk_content['acc'][$count]   = ''; }
						if(!$arr_desk_content['autor'][$count]) { $arr_desk_content['autor'][$count] = ''; }
						if(!$arr_desk_content['inw'][$count])   { $arr_desk_content['inw'][$count]   = ''; }
						
						// CHARSETS
						$arr_desk_content['title'][$count] = $tcms_main->decodeText($arr_desk_content['title'][$count], '2', $c_charset);
						
						$count++;
					}
				}
			}
		}
		
		if(!empty($arr_desk_content) && is_array($arr_desk_content)){
			array_multisort(
				$arr_desk_content['title'], SORT_DESC, 
				$arr_desk_content['id'], SORT_DESC, 
				$arr_desk_content['inw'], SORT_DESC, 
				$arr_desk_content['autor'], SORT_DESC, 
				$arr_desk_content['access'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$strAdd = '';
		
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			$strAdd = "OR access = 'Protected' OR access = 'Private') ";
		}
		else{
			$strAdd = "OR access = 'Protected') AND NOT (autor <> '".$id_username."') ";
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."content "
		."WHERE published = 0 "
		."AND (access = 'Public' "
		.$strAdd
		."ORDER BY title DESC, uid DESC";
		
		$sqlQR = $sqlAL->sqlQuery($sqlSTR);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->fetchArray($sqlQR)){
			$arr_desk_content['id'][$count]     = $sqlARR['uid'];
			$arr_desk_content['title'][$count]  = $sqlARR['title'];
			$arr_desk_content['access'][$count] = $sqlARR['access'];
			$arr_desk_content['autor'][$count]  = $sqlARR['autor'];
			$arr_desk_content['inw'][$count]    = $sqlARR['in_work'];
			
			if($arr_desk_content['title'][$count]  == NULL){ $arr_desk_content['title'][$count]  = ''; }
			if($arr_desk_content['id'][$count]     == NULL){ $arr_desk_content['id'][$count]     = ''; }
			if($arr_desk_content['access'][$count] == NULL){ $arr_desk_content['access'][$count] = ''; }
			if($arr_desk_content['autor'][$count]  == NULL){ $arr_desk_content['autor'][$count]  = ''; }
			if($arr_desk_content['inw'][$count]    == NULL){ $arr_desk_content['inw'][$count]    = ''; }
			
			// CHARSETS
			$arr_desk_content['title'][$count] = $tcms_main->decodeText($arr_desk_content['title'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	echo '<div style="margin: 0 0 3px 0;"><strong class="tcms_ft_white">'._DESKTOP_UNPUBLISHED_PAGES.'</strong></div>';
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="60%" align="left" colspan="2">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_IN_WORK.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
	
	if(isset($arr_desk_content['id']) && !empty($arr_desk_content['id']) && $arr_desk_content['id'] != ''){
		foreach ($arr_desk_content['id'] as $key => $value){
			$bgkey++;
			
			if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
			else{ $ws_farbe = $arr_farbe[1]; }
			
			echo '<tr height="25" id="row2'.$key.'" '
			.'bgcolor="'.$ws_farbe.'" '
			.'onMouseOver="wxlBgCol(\'row2'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row2'.$key.'\',\''.$ws_farbe.'\')" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_desk_content['id'][$key].'\';">';
			
			echo '<td align="center" width="5%" class="tcms_db_2"><img src="../images/dir_1.gif" border="0" /></td>';
			
			echo '<td class="tcms_db_2">'.( empty($arr_desk_content['title'][$key]) ? '<em>-empty-</em>' : $arr_desk_content['title'][$key] ).'</td>';
			echo '<td class="tcms_db_2">'.( empty($arr_desk_content['autor'][$key]) ? '<em>-empty-</em>' : $arr_desk_content['autor'][$key] ).'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=publishItem&amp;action=on&amp;maintag='.$arr_desk_content['id'][$key].'&amp;sender=desktop">'
			.'<img src="../images/no.png" border="0" />'
			.'</a>'
			.'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=finalize&amp;action='.( $arr_desk_content['inw'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_desk_content['id'][$key].'&amp;sender=desktop">'
			.( $arr_desk_content['inw'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
			.'</a>'
			.'</td>';
			
			echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_desk_content['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';">'.$arr_desk_content['access'][$key].'</td>';
			
			echo '<td class="tcms_db_2" align="right">'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_desk_content['id'][$key].'">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a>&nbsp;'
			.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=delete&amp;maintag='.$arr_desk_content['id'][$key].'">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>&nbsp;'
			.'</td>';
			
			echo '</tr>';
		}
	}
	
	echo '</table>';
}




/*
	UNFINISHED DOCUMENTS
*/
echo '<br />';
echo '<br />';
echo '<br />';



// row one - cell two: list all not finished documents
if($id_group == 'Developer' || $id_group == 'Administrator'){
	if($choosenDB == 'xml'){
		unset($value);
		
		$arr_contentname = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_content/');
		$count = 0;
		
		if($tcms_main->isArray($arr_contentname)) {
			foreach($arr_contentname as $key => $value) {
				$deskXML = new xmlparser(_TCMS_PATH.'/tcms_content/'.$value,'r');
				$pubVal  = $deskXML->read_value('in_work');
				
				if($pubVal == 0){
					if($id_group == 'Developer' || $id_group == 'Administrator'){
						$checkIn = true;
					}
					else{
						$autVal  = $deskXML->read_value('autor');
						
						if($autVal != $id_username){
							$checkIn = false;
						}
						else{
							$accVal  = $deskXML->read_value('access');
							
							switch($accVal){
								case 'Public': $checkIn = true; break;
								case 'Protected': $checkIn = true; break;
								case 'Private': $checkIn = false; break;
								default: $checkIn = false; break;
							}
						}
					}
					
					if($checkIn){
						$arr_desk_unfinished['title'][$count]     = $deskXML->read_value('title');
						$arr_desk_unfinished['id'][$count]        = $deskXML->read_value('id');
						$arr_desk_unfinished['access'][$count]    = $deskXML->read_value('access');
						$arr_desk_unfinished['autor'][$count]     = $deskXML->read_value('autor');
						$arr_desk_unfinished['pub'][$count]       = $deskXML->read_value('published');
						
						if(!$arr_desk_unfinished['title'][$count]) { $arr_desk_unfinished['title'][$count] = ''; }
						if(!$arr_desk_unfinished['id'][$count])    { $arr_desk_unfinished['id'][$count]    = ''; }
						if(!$arr_desk_unfinished['access'][$count]){ $arr_desk_unfinished['acc'][$count]   = ''; }
						if(!$arr_desk_unfinished['autor'][$count]) { $arr_desk_unfinished['autor'][$count] = ''; }
						if(!$arr_desk_unfinished['pub'][$count])   { $arr_desk_unfinished['pub'][$count]   = ''; }
						
						// CHARSETS
						$arr_desk_unfinished['title'][$count] = $tcms_main->decodeText($arr_desk_unfinished['title'][$count], '2', $c_charset);
						
						$count++;
					}
				}
			}
		}
		
		if(!empty($arr_desk_unfinished) && is_array($arr_desk_unfinished)){
			array_multisort(
				$arr_desk_unfinished['title'], SORT_DESC, 
				$arr_desk_unfinished['id'], SORT_DESC, 
				$arr_desk_unfinished['pub'], SORT_DESC, 
				$arr_desk_unfinished['autor'], SORT_DESC, 
				$arr_desk_unfinished['access'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$strAdd = '';
		
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			$strAdd = "OR access = 'Protected' OR access = 'Private') ";
		}
		else{
			$strAdd = "OR access = 'Protected') AND autor = '".$id_username."' ";
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."content "
		."WHERE in_work = 0 "
		."AND (access = 'Public' "
		.$strAdd
		."ORDER BY title DESC, uid DESC";
		
		$sqlQR = $sqlAL->sqlQuery($sqlSTR);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->fetchArray($sqlQR)){
			$arr_desk_unfinished['id'][$count]     = $sqlARR['uid'];
			$arr_desk_unfinished['title'][$count]  = $sqlARR['title'];
			$arr_desk_unfinished['access'][$count] = $sqlARR['access'];
			$arr_desk_unfinished['autor'][$count]  = $sqlARR['autor'];
			$arr_desk_unfinished['pub'][$count]    = $sqlARR['published'];
			
			if($arr_desk_unfinished['title'][$count]  == NULL){ $arr_desk_unfinished['title'][$count]  = ''; }
			if($arr_desk_unfinished['id'][$count]     == NULL){ $arr_desk_unfinished['id'][$count]     = ''; }
			if($arr_desk_unfinished['access'][$count] == NULL){ $arr_desk_unfinished['access'][$count] = ''; }
			if($arr_desk_unfinished['autor'][$count]  == NULL){ $arr_desk_unfinished['autor'][$count]  = ''; }
			if($arr_desk_unfinished['pub'][$count]    == NULL){ $arr_desk_unfinished['pub'][$count]    = ''; }
			
			// CHARSETS
			$arr_desk_unfinished['title'][$count] = $tcms_main->decodeText($arr_desk_unfinished['title'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	echo '<div style="margin: 0 0 3px 0;"><strong class="tcms_ft_white">'._DESKTOP_UNFINISHED_PAGES.'</strong></div>';
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="60%" align="left" colspan="2">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_IN_WORK.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
	
	if(isset($arr_desk_unfinished['id']) && !empty($arr_desk_unfinished['id']) && $arr_desk_unfinished['id'] != ''){
		foreach ($arr_desk_unfinished['id'] as $key => $value){
			$bgkey++;
			
			if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
			else{ $ws_farbe = $arr_farbe[1]; }
			
			echo '<tr height="25" id="row3'.$key.'" '
			.'bgcolor="'.$ws_farbe.'" '
			.'onMouseOver="wxlBgCol(\'row3'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row3'.$key.'\',\''.$ws_farbe.'\')" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_desk_unfinished['id'][$key].'\';">';
			
			echo '<td align="center" width="5%" class="tcms_db_2"><img src="../images/dir_1.gif" border="0" /></td>';
			
			echo '<td class="tcms_db_2">'.( empty($arr_desk_unfinished['title'][$key]) ? '<em>-empty-</em>' : $arr_desk_unfinished['title'][$key] ).'</td>';
			echo '<td class="tcms_db_2">'.( empty($arr_desk_unfinished['autor'][$key]) ? '<em>-empty-</em>' : $arr_desk_unfinished['autor'][$key] ).'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=publishItem&amp;action='.( $arr_desk_unfinished['pub'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_desk_unfinished['id'][$key].'&amp;sender=desktop">'
			.( $arr_desk_unfinished['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
			.'</a>'
			.'</td>';
			
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=finalize&amp;action='.( $arr_desk_unfinished['inw'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_desk_unfinished['id'][$key].'&amp;sender=desktop">'
			.'<img src="../images/no.png" border="0" />'
			.'</a>'
			.'</td>';
			
			echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_desk_unfinished['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';">'.$arr_desk_unfinished['access'][$key].'</td>';
			
			echo '<td class="tcms_db_2" align="right">'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_desk_unfinished['id'][$key].'">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a>&nbsp;'
			.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=delete&amp;maintag='.$arr_desk_unfinished['id'][$key].'">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>&nbsp;'
			.'</td>';
			
			echo '</tr>';
		}
	}
	
	echo '</table>';
}





// -----------------------------------------------------
// NOTEBOOK
// -----------------------------------------------------

echo '<br /><br /><br />';


if($id_group == 'Developer' 
|| $id_group == 'Administrator') {
	// row one - cell two: content -> note
	if($choosenDB == 'xml') {
		$note_xml = new xmlparser(_TCMS_PATH.'/tcms_notepad/'.$m_tag.'.xml','r');
		$nname = $note_xml->readSection('note', 'name');
		$nnote = $note_xml->readSection('note', 'text');
		
		if(!$nname){ $nname = ''; }
		if(!$nnote){ $nnote = ''; }
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'notepad', $m_tag);
		$sqlARR = $sqlAL->fetchArray($sqlQR);
		
		$nname = $sqlARR['name'];
		$nnote = $sqlARR['note'];
		
		if($nname == NULL){ $nname = ''; }
		if($nnote == NULL){ $nnote = ''; }
	}
	
	$nname = $tcms_main->decodeText($nname, '2', $c_charset);
	$nnote = $tcms_main->decodeText($nnote, '2', $c_charset);
	
	echo '<div style="margin: 0 0 3px 0;">'
	.'<strong class="tcms_ft_white">'._TCMS_MENU_NOTE.'</strong>'
	.'</div>';

	echo '<table width="450" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
	.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'
	._NOTEBOOK_DETAIL
	.'</th></tr>'
	.'<tr><td>'
	.'<div style="height: 180px !important; overflow: auto !important;" class="tcms_notebook">'
	.$nnote
	.'</div>'
	.'</td></tr></table>';
	
	echo '<div style="display: block; width: 448px; height: 18px; text-align: left; padding: 2px; background-color: #f5f5f5;">'
	.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_notebook&amp;sender=desktop">'
	.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 1px;" border="0" src="../images/a_edit.gif" />'
	.'</a></div>';
}






?>
