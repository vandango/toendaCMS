<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Links Manager
|
| File:	mod_links.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Links Manager
 *
 * This module is used for the links.
 *
 * @version 0.6.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['new_link_type'])){ $new_link_type = $_POST['new_link_type']; }
if(isset($_POST['new_link_cat'])){ $new_link_cat = $_POST['new_link_cat']; }
if(isset($_POST['new_link_sort'])){ $new_link_sort = $_POST['new_link_sort']; }
if(isset($_POST['new_link_name'])){ $new_link_name = $_POST['new_link_name']; }
if(isset($_POST['new_link_desc'])){ $new_link_desc = $_POST['new_link_desc']; }
if(isset($_POST['new_link_link'])){ $new_link_link = $_POST['new_link_link']; }
if(isset($_POST['new_link_pub'])){ $new_link_pub = $_POST['new_link_pub']; }
if(isset($_POST['new_link_target'])){ $new_link_target = $_POST['new_link_target']; }
if(isset($_POST['new_link_rss'])){ $new_link_rss = $_POST['new_link_rss']; }
if(isset($_POST['new_link_acs'])){ $new_link_acs = $_POST['new_link_acs']; }
if(isset($_POST['dbAction'])){ $dbAction = $_POST['dbAction']; }
if(isset($_POST['new_link_use_side_desc'])){ $new_link_use_side_desc = $_POST['new_link_use_side_desc']; }
if(isset($_POST['new_link_use_side_title'])){ $new_link_use_side_title = $_POST['new_link_use_side_title']; }
if(isset($_POST['new_link_side_title'])){ $new_link_side_title = $_POST['new_link_side_title']; }
if(isset($_POST['new_link_main_title'])){ $new_link_main_title = $_POST['new_link_main_title']; }
if(isset($_POST['new_link_main_subtitle'])){ $new_link_main_subtitle = $_POST['new_link_main_subtitle']; }
if(isset($_POST['new_link_use_main_desc'])){ $new_link_use_main_desc = $_POST['new_link_use_main_desc']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_link_main_access'])){ $new_link_main_access = $_POST['new_link_main_access']; }
if(isset($_POST['new_link_doc'])){ $new_link_doc = $_POST['new_link_doc']; }




//=====================================================
// INIT
//=====================================================

echo '<script language="JavaScript" src="../js/dhtml.js"></script>';

if(!isset($todo)){ $todo = 'show'; }




//=====================================================
// CONFIG
//=====================================================

if($todo == 'config'){
	if($id_group == 'Developer' || $id_group == 'Administrator'){
		if($choosenDB == 'xml'){
			$news_xml = new xmlparser(_TCMS_PATH.'/tcms_global/linkmanager.xml','r');
			
			$old_link_use_side_desc  = $news_xml->read_section('config', 'link_use_side_desc');
			$old_link_use_side_title = $news_xml->read_section('config', 'link_use_side_title');
			$old_link_side_title     = $news_xml->read_section('config', 'link_side_title');
			$old_link_main_title     = $news_xml->read_section('config', 'link_main_title');
			$old_link_main_subtitle  = $news_xml->read_section('config', 'link_main_subtitle');
			$old_link_main_text      = $news_xml->read_section('config', 'link_main_text');
			$old_link_use_main_desc  = $news_xml->read_section('config', 'link_use_main_desc');
			$old_link_main_access    = $news_xml->read_section('config', 'link_main_access');
			
			$old_link_side_title    = $tcms_main->decodeText($old_link_side_title, '2', $c_charset);
			$old_link_main_title    = $tcms_main->decodeText($old_link_main_title, '2', $c_charset);
			$old_link_main_subtitle = $tcms_main->decodeText($old_link_main_subtitle, '2', $c_charset);
			$old_link_main_text     = $tcms_main->decodeText($old_link_main_text, '2', $c_charset);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'links_config', 'links_config_side');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_link_use_side_desc  = $sqlARR['link_use_side_desc'];
			$old_link_use_side_title = $sqlARR['link_use_side_title'];
			$old_link_side_title     = $sqlARR['link_side_title'];
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'links_config', 'links_config_main');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_link_main_title     = $sqlARR['link_main_title'];
			$old_link_main_subtitle  = $sqlARR['link_main_subtitle'];
			$old_link_main_text      = $sqlARR['link_main_text'];
			$old_link_use_main_desc  = $sqlARR['link_use_main_desc'];
			$old_link_main_access    = $sqlARR['link_main_access'];
			
			if($old_link_use_side_desc  == NULL){ $old_link_use_side_desc  = ''; }
			if($old_link_use_side_title == NULL){ $old_link_use_side_title = ''; }
			if($old_link_side_title     == NULL){ $old_link_side_title     = ''; }
			if($old_link_main_title     == NULL){ $old_link_main_title     = ''; }
			if($old_link_main_subtitle  == NULL){ $old_link_main_subtitle  = ''; }
			if($old_link_main_text      == NULL){ $old_link_main_text      = ''; }
			if($old_link_use_main_desc  == NULL){ $old_link_use_main_desc  = ''; }
			if($old_link_main_access    == NULL){ $old_link_main_access    = ''; }
			
			$old_link_side_title    = $tcms_main->decodeText($old_link_side_title, '2', $c_charset);
			$old_link_main_title    = $tcms_main->decodeText($old_link_main_title, '2', $c_charset);
			$old_link_main_subtitle = $tcms_main->decodeText($old_link_main_subtitle, '2', $c_charset);
			$old_link_main_text     = $tcms_main->decodeText($old_link_main_text, '2', $c_charset);
		}
		
		
		$old_link_side_title    = htmlspecialchars($old_link_side_title);
		$old_link_main_title    = htmlspecialchars($old_link_main_title);
		$old_link_main_subtitle = htmlspecialchars($old_link_main_subtitle);
		
		
		
		
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
			
			//$old_link_main_text = str_replace('src="', 'src="../../', $old_link_main_text);
			$old_link_main_text = stripslashes($old_link_main_text);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$old_link_main_text = str_replace('src="', 'src="../../../../', $old_link_main_text);
			$old_link_main_text = str_replace('src="../../../../http:', 'src="http:', $old_link_main_text);
			$old_link_main_text = str_replace('src="../../../../https:', 'src="https:', $old_link_main_text);
			$old_link_main_text = str_replace('src="../../../../ftp:', 'src="ftp:', $old_link_main_text);
			$old_link_main_text = str_replace('src="../../../..//', 'src="/', $old_link_main_text);
		}
		else{
			$old_link_main_text = ereg_replace('<br />'.chr(10), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br />'.chr(13), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br />', chr(13), $old_link_main_text);
			
			$old_link_main_text = ereg_replace('<br/>'.chr(10), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br/>'.chr(13), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br/>', chr(13), $old_link_main_text);
			
			$old_link_main_text = ereg_replace('<br>'.chr(10), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br>'.chr(13), chr(13), $old_link_main_text);
			$old_link_main_text = ereg_replace('<br>', chr(13), $old_link_main_text);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$old_link_main_text = str_replace('src="', 'src="../../', $old_link_main_text);
		}
		
		
		
		
		//==================================================
		// BEGIN FORM
		//==================================================
		echo '<form action="admin.php?id_user='.$id_user.'&site=mod_links" method="post" id="links">'
		.'<input name="todo" type="hidden" value="save_config" />';
		
		
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		//
		echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._LINK_MODULE.'</strong></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300">'._LINK_USE_SIDELINKS_DESC.'</td>'
		.'<td><input type="checkbox" name="new_link_use_side_desc" '.( $old_link_use_side_desc == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="300">'._LINK_USE_SIDELINKS_TITLE.'</td>'
		.'<td><input type="checkbox" name="new_link_use_side_title" '.( $old_link_use_side_title == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._LINK_SIDELINKS_TITLE.'</td>'
		.'<td valign="top"><input name="new_link_side_title" class="tcms_input_normal" value="'.$old_link_side_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._LINK_MAINLINKS_TITLE.'</td>'
		.'<td valign="top"><input name="new_link_main_title" class="tcms_input_normal" value="'.$old_link_main_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._LINK_MAINLINKS_SUBTITLE.'</td>'
		.'<td valign="top"><input name="new_link_main_subtitle" class="tcms_input_normal" value="'.$old_link_main_subtitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._LINK_USE_MAINLINKS_DESC.'</td>'
		.'<td valign="top"><input type="checkbox" name="new_link_use_main_desc" '.( $old_link_use_main_desc == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top">'._TABLE_ACCESS.'</td>'
		.'<td valign="top"><select name="new_link_main_access" class="tcms_select">'
			.'<option value="Public"'.( $old_link_main_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_link_main_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_link_main_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top" colspan="2">&nbsp;</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top" colspan="2">'._LINK_MAINLINKS_TEXT.'</td></tr>';
		
		
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
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content" mce_editable="true">'.$old_link_main_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $old_link_main_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea name="content" id="content" class="tcms_textarea_huge">'.$old_link_main_text.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		echo '</form>';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}




//=====================================================
// SHOW OLD VALUES
//=====================================================

if($todo == 'show'){
	echo tcms_html::bold(_LINK_MODULE_TITLE);
	echo tcms_html::text(_LINK_MODULE_DESC.'<br /><br />', 'left');
	
	if($choosenDB == 'xml'){
		$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
		
		$count = 0;
		
		if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
			foreach($arr_filename as $key => $value){
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$value,'r');
				
				$arrLinkType = $menu_xml->read_section('link', 'type');
				
				if($arrLinkType == 'c'){
				$arrLink['tag'][$count]  = substr($value, 0, 32);
					$arrLink['name'][$count] = $menu_xml->read_section('link', 'name');
					$arrLink['desc'][$count] = $menu_xml->read_section('link', 'desc');
					$arrLink['pub'][$count]  = $menu_xml->read_section('link', 'published');
					$arrLink['sort'][$count] = $menu_xml->read_section('link', 'sort');
					
					if(!$arrLink['name'][$count]){ $arrLink['name'][$count] = ''; }
					if(!$arrLink['desc'][$count]){ $arrLink['desc'][$count] = ''; }
					if(!$arrLink['pub'][$count]) { $arrLink['pub'][$count]  = ''; }
					
					// CHARSETS
					$arrLink['name'][$count] = $tcms_main->decodeText($arrLink['name'][$count], '2', $c_charset);
					$arrLink['desc'][$count] = $tcms_main->decodeText($arrLink['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."links WHERE type='c'");
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arrLink['tag'][$count]  = $sqlARR['uid'];
			$arrLink['name'][$count] = $sqlARR['name'];
			$arrLink['desc'][$count] = $sqlARR['desc'];
			$arrLink['pub'][$count]  = $sqlARR['published'];
			$arrLink['sort'][$count] = $sqlARR['sort'];
			
			if($arrLink['name'][$count] == NULL){ $arrLink['name'][$count] = ''; }
			if($arrLink['desc'][$count] == NULL){ $arrLink['desc'][$count] = ''; }
			if($arrLink['pub'][$count]  == NULL){ $arrLink['pub'][$count]  = ''; }
			if($arrLink['sort'][$count] == NULL){ $arrLink['sort'][$count] = ''; }
			
			// CHARSETS
			$arrLink['name'][$count] = $tcms_main->decodeText($arrLink['name'][$count], '2', $c_charset);
			$arrLink['desc'][$count] = $tcms_main->decodeText($arrLink['desc'][$count], '2', $c_charset);
			
			$count++;
			$checkCatAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	if($arrLink && is_array($arrLink)){
		array_multisort(
			$arrLink['sort'], SORT_ASC, 
			$arrLink['name'], SORT_ASC, 
			$arrLink['desc'], SORT_ASC, 
			$arrLink['pub'], SORT_ASC, 
			$arrLink['tag'], SORT_ASC
		);
	}
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_POS.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left" width="25%">'._TABLE_NAME.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left" width="80%">'._TABLE_DESCRIPTION.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th>'
		.'<tr>';
	
	$change_row_color = 0;
	
	if(isset($arrLink['name']) && !empty($arrLink['name']) && $arrLink['name'] != ''){
		foreach($arrLink['name'] as $key => $value){
			if(is_integer($key/2)){ $wsc = 0; }
			else{ $wsc = 1; }
			
			echo '<tr height="25" id="row'.$change_row_color.'" '
			.'bgcolor="'.$arr_color[$wsc].'" '
			.'onMouseOver="wxlBgCol(\'row'.$change_row_color.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$change_row_color.'\',\''.$arr_color[$wsc].'\')" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=edit&amp;maintag='.$arrLink['tag'][$key].'\';">';
			
			echo '<td class="tcms_db_2" align="left">'
			.'<img border="0" src="../images/link.png" />'
			.'&nbsp;'.$arrLink['sort'][$key].'&nbsp;</td>';
			
			echo '<td class="tcms_db_2"><strong>'.$arrLink['name'][$key].'</strong></td>';
			echo '<td class="tcms_db_2" align="left">'.$arrLink['desc'][$key].'&nbsp;</td>';
			
			echo '<td class="tcms_db_2" align="center">'
			.'<a href="admin.php?id_user='.$id_user.'&site=mod_links&amp;todo=publishItem&amp;action='.( $arrLink['pub'][$key] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arrLink['tag'][$key].'">'
			.( $arrLink['pub'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
			.'</a></td>';
			
			echo '<td class="tcms_db_2" align="right" valign="middle">'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=edit&maintag='.$arrLink['tag'][$key].'">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a>&nbsp;'
			.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=delete&amp;maintag='.$arrLink['tag'][$key].'">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>&nbsp;'
			.'</td>';
			
			echo '</tr>';
			
			
			
			
			if($choosenDB == 'xml'){
				unset($arrLinkItem);
				unset($arr_filename);
				
				$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
				
				$count = 0;
				
				if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
					foreach($arr_filename as $llkey => $llvalue){
						$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$llvalue,'r');
						$arrLinkType = $menu_xml->read_section('link', 'type');
						$arrLinkCat  = $menu_xml->read_section('link', 'category');
						
						if($arrLinkType == 'l' && $arrLinkCat == $arrLink['tag'][$key]){
							$arrLinkItem['tag'][$count]  = substr($llvalue, 0, 32);
							$arrLinkItem['name'][$count] = $menu_xml->read_section('link', 'name');
							$arrLinkItem['desc'][$count] = $menu_xml->read_section('link', 'desc');
							$arrLinkItem['pub'][$count]  = $menu_xml->read_section('link', 'published');
							$arrLinkItem['sort'][$count] = $menu_xml->read_section('link', 'sort');
							
							if(!$arrLinkItem['name'][$count]){ $arrLinkItem['name'][$count] = ''; }
							if(!$arrLinkItem['desc'][$count]){ $arrLinkItem['desc'][$count] = ''; }
							if(!$arrLinkItem['pub'][$count]) { $arrLinkItem['pub'][$count]  = ''; }
							
							// CHARSETS
							$arrLinkItem['name'][$count] = $tcms_main->decodeText($arrLinkItem['name'][$count], '2', $c_charset);
							$arrLinkItem['desc'][$count] = $tcms_main->decodeText($arrLinkItem['desc'][$count], '2', $c_charset);
							
							$count++;
							$checkCatAmount = $count;
						}
					}
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				unset($arrLinkItem);
				
				$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."links WHERE category='".$arrLink['tag'][$key]."' AND type='l'");
				
				$count = 0;
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$arrLinkItem['tag'][$count]  = $sqlARR['uid'];
					$arrLinkItem['name'][$count] = $sqlARR['name'];
					$arrLinkItem['desc'][$count] = $sqlARR['desc'];
					$arrLinkItem['pub'][$count]  = $sqlARR['published'];
					$arrLinkItem['sort'][$count] = $sqlARR['sort'];
					
					if($arrLinkItem['name'][$count] == NULL){ $arrLinkItem['name'][$count] = ''; }
					if($arrLinkItem['desc'][$count] == NULL){ $arrLinkItem['desc'][$count] = ''; }
					if($arrLinkItem['pub'][$count]  == NULL){ $arrLinkItem['pub'][$count]  = ''; }
					if($arrLinkItem['sort'][$count] == NULL){ $arrLinkItem['sort'][$count] = ''; }
					
					// CHARSETS
					$arrLinkItem['name'][$count] = $tcms_main->decodeText($arrLinkItem['name'][$count], '2', $c_charset);
					$arrLinkItem['desc'][$count] = $tcms_main->decodeText($arrLinkItem['desc'][$count], '2', $c_charset);
					$arrLinkItem['pub'][$count]  = $tcms_main->decodeText($arrLinkItem['pub'][$count], '2', $c_charset);
					$arrLinkItem['sort'][$count] = $tcms_main->decodeText($arrLinkItem['sort'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
				
				$sqlAL->sqlFreeResult($sqlQR);
			}
			
			if($arrLinkItem && is_array($arrLinkItem)){
				array_multisort(
					$arrLinkItem['sort'], SORT_ASC, 
					$arrLinkItem['name'], SORT_ASC, 
					$arrLinkItem['desc'], SORT_ASC, 
					$arrLinkItem['pub'], SORT_ASC, 
					$arrLinkItem['tag'], SORT_ASC
				);
			}
			
			$change_row_color++;
			
			if(isset($arrLinkItem['tag']) && !empty($arrLinkItem['tag']) && $arrLinkItem['tag'] != ''){
				foreach($arrLinkItem['tag'] as $liKey => $liVal){
					if(is_integer($change_row_color/2)){ $wsc2 = 0; }
					else{ $wsc2 = 1; }
					
					echo '<tr height="25" id="row'.$change_row_color.'" '
					.'bgcolor="'.$arr_color[$wsc2].'" '
					.'onMouseOver="wxlBgCol(\'row'.$change_row_color.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$change_row_color.'\',\''.$arr_color[$wsc2].'\')" '
					.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=edit&amp;maintag='.$arrLinkItem['tag'][$liKey].'\';">';
					
					echo '<td class="tcms_db_2" align="left">'
					.'<img border="0" src="../images/link.png" />&nbsp;&raquo;&nbsp;'
					.$arrLinkItem['sort'][$liKey].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2">'.$arrLinkItem['name'][$liKey].'</td>';
					echo '<td class="tcms_db_2" align="left">'.$arrLinkItem['desc'][$liKey].'&nbsp;</td>';
					
					echo '<td class="tcms_db_2" align="center">'
					.'<a href="admin.php?id_user='.$id_user.'&site=mod_links&amp;todo=publishItem&amp;action='.( $arrLinkItem['pub'][$liKey] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arrLinkItem['tag'][$liKey].'">'
					.( $arrLinkItem['pub'][$liKey] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a></td>';
					
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=edit&maintag='.$arrLinkItem['tag'][$liKey].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links&amp;todo=delete&amp;maintag='.$arrLinkItem['tag'][$liKey].'">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.'</td>';
					
					echo '</tr>';
					
					$change_row_color++;
				}
			}
		}
	}
	
	echo '</table><br />';
}




//=====================================================
// FORM
//=====================================================

if($todo == 'edit'){
	//***************************
	//
	if(isset($maintag) && !empty($maintag) && $maintag != ''){
		if($choosenDB == 'xml'){
			$user_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$maintag.'.xml','r');
			$link_name = $user_xml->read_section('link', 'name');
			$link_desc = $user_xml->read_section('link', 'desc');
			$link_pub  = $user_xml->read_section('link', 'published');
			$link_cat  = $user_xml->read_section('link', 'category');
			$link_sort = $user_xml->read_section('link', 'sort');
			$link_link = $user_xml->read_section('link', 'link_to');
			$link_targ = $user_xml->read_section('link', 'target');
			$link_rss  = $user_xml->read_section('link', 'rss');
			$link_acs  = $user_xml->read_section('link', 'access');
			$link_type = $user_xml->read_section('link', 'type');
			$link_doc  = $user_xml->read_section('link', 'module');
			
			if(!$link_name){ $link_name = ''; }
			if(!$link_desc){ $link_desc = ''; }
			if(!$link_pub) { $link_pub  = ''; }
			if(!$link_cat) { $link_cat  = ''; }
			if(!$link_sort){ $link_sort = ''; }
			if(!$link_link){ $link_link = ''; }
			if(!$link_targ){ $link_targ = ''; }
			if(!$link_rss) { $link_rss  = ''; }
			if(!$link_acs) { $link_acs  = ''; }
			if(!$link_type){ $link_type = ''; }
			if(!$link_doc) { $link_doc  = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'links', $maintag);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$link_type = $sqlARR['type'];
			$link_name = $sqlARR['name'];
			$link_desc = $sqlARR['desc'];
			$link_pub  = $sqlARR['published'];
			$link_cat  = $sqlARR['category'];
			$link_sort = $sqlARR['sort'];
			$link_link = $sqlARR['link'];
			$link_targ = $sqlARR['target'];
			$link_rss  = $sqlARR['rss'];
			$link_acs  = $sqlARR['access'];
			$link_doc  = $sqlARR['module'];
			
			if($link_name == NULL){ $link_name = ''; }
			if($link_desc == NULL){ $link_desc = ''; }
			if($link_pub  == NULL){ $link_pub  = ''; }
			if($link_cat  == NULL){ $link_cat  = ''; }
			if($link_sort == NULL){ $link_sort = ''; }
			if($link_link == NULL){ $link_link = ''; }
			if($link_targ == NULL){ $link_targ = ''; }
			if($link_rss  == NULL){ $link_rss  = ''; }
			if($link_acs  == NULL){ $link_acs  = ''; }
			if($link_type == NULL){ $link_type = ''; }
			if($link_doc  == NULL){ $link_doc  = ''; }
			
			$dbDo = 'save';
		}
		
		$link_name = $tcms_main->decodeText($link_name, '2', $c_charset);
		$link_desc = $tcms_main->decodeText($link_desc, '2', $c_charset);
		
		echo $tcms_html->bold(_TABLE_EDIT);
		$odot = 'save';
		$dbDo = 'save';
	}
	else{
		$link_doc  = 3;
		$link_pub  = 0;
		$link_targ = '_blank';
		$link_acs  = 'Public';
		$link_type = 'l';
		
		$maintag = $tcms_main->getNewUID(32, 'links');
		
		echo $tcms_html->bold(_TABLE_NEW);
		$odot = 'save';
		$dbDo = 'next';
	}
	//
	//***************************
	
	
	$width = '200';
	
	echo $tcms_html->text(_TOPMENU_TEXT.'<br /><br />', 'left');
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_links" method="post">'
	.'<input name="todo" type="hidden" value="'.$odot.'" />'
	.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
	.'<input name="new_link_acs" type="hidden" value="Public" />'
	.'<input class="tcms_input_normal" name="new_link_rss" type="hidden" value="'.$link_rss.'" />';
	
	if($choosenDB != 'xml'){ echo '<input name="dbAction" type="hidden" value="'.$dbDo.'" />'; }
	
	
	// table head
	echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
	echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
	echo '</tr></table>';
	
	
	// table head
	echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
	
	
	// name
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_NAME.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_link_name" type="text" value="'.$link_name.'" /></td></tr>';
	
	
	// desc
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DESCRIPTION.'</strong></td>'
	.'<td valign="top"><textarea class="tcms_textarea_big" name="new_link_desc">'.$link_desc.'</textarea></td></tr>';
	
	
	// link to
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_LINKTO.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_link_link" type="text" value="'.$link_link.'" /></td></tr>';
	
	
	// pos
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_POS.'</strong></td>'
	.'<td><input class="tcms_id_box" name="new_link_sort" type="text" value="'.$link_sort.'" /></td></tr>';
	
	
	// published
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
	.'<td><input name="new_link_pub" value="1" type="checkbox"'.( $link_pub == 1 ? ' checked="checked"' : '' ).' /></td></tr>';
	
	
	// target
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TARGET.'</strong></td>'
	.'<td valign="top">'
	.'<select name="new_link_target" class="tcms_select">'
		.'<option value="_blank"'.( $link_acs == '_blank' ? ' selected="selected"' : '' ).'>_blank</option>'
		.'<option value="_self"'.( $link_acs == '_self' ? ' selected="selected"' : '' ).'>_self</option>'
		.'<option value=""'.( $link_acs == '' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.'</option>'
	.'</select></td></tr>';
	
	
	//================================================
	
	if($link_type == 'l' || $link_type == ''){
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></td>
		<td valign="top"><select name="new_link_cat" class="tcms_select">';
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_links/');
			
			$count = 0;
			
			if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
				foreach($arr_filename as $skey => $svalue){
					$user_xml = new xmlparser(_TCMS_PATH.'/tcms_links/'.$svalue,'r');
					$link_cat_type = $user_xml->read_value('type');
					
					if($link_cat_type == 'c'){
						$link_cat_name = $user_xml->read_value('name');
						$link_cat_uid  = substr($svalue, 0, 32);
						
						if(!$link_cat_name){ $link_cat_name = ''; }
						if(!$link_cat_uid) { $link_cat_uid  = ''; }
						
						$link_cat_name = $tcms_main->decodeText($link_cat_name, '2', $c_charset);
						
						echo '<option value="'.$link_cat_uid.'"'.( $link_cat_uid == $link_cat ? ' selected="selected"' : '' ).'>'.$link_cat_name.'</option>';
					}
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetALL($tcms_db_prefix."links WHERE type='c'");
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$link_cat_name = $sqlARR['name'];
				$link_cat_uid  = $sqlARR['uid'];
				
				if($link_cat_name == NULL){ $link_cat_name = ''; }
				if($link_cat_uid  == NULL){ $link_cat_uid  = ''; }
				
				$link_cat_name = $tcms_main->decodeText($link_cat_name, '2', $c_charset);
				
				echo '<option value="'.$link_cat_uid.'"'.( $link_cat_uid == $link_cat ? ' selected="selected"' : '' ).'>'.$link_cat_name.'</option>';
			}
		}
		
		echo '</select></td></tr>';
	}
	
	
	// type
	if($dbDo == 'next'){
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TYPE.'</strong></td>'
		.'<td valign="top">'
		.'<select name="new_link_type" class="tcms_select">'
			.'<option value="l">'._TABLE_MENULINK.'</option>'
			.'<option value="c">'._TABLE_CATEGORY.'</option>'
		.'</select></td></tr>';
	}
	else{ echo '<input class="tcms_input_normal" name="new_link_type" type="hidden" value="'.$link_type.'" />'; }
	
	
	// access
	/*
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
	.'<td valign="top">'
	.'<select name="new_link_acs" class="tcms_select">'
		.'<option value="Public"'.( $link_acs == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( $link_acs == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
		.'<option value="Private"'.( $link_acs == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
	.'</select></td></tr>';
	*/
	
	
	// sidebar or maincontent or both
	if(!isset($link_doc) || $link_doc == 0 || empty($link_doc)){ $link_doc = 3; }
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._LINK_WICH_MODULE.'</strong></td>'
	.'<td valign="top">'
	.'<select name="new_link_doc" class="tcms_select">'
		.'<option value="1"'.( $link_doc == 1 ? ' selected="selected"' : '' ).'>'._TABLE_SIDEBAR.'</option>'
		.'<option value="2"'.( $link_doc == 2 ? ' selected="selected"' : '' ).'>'._TABLE_MAINCONTENT.'</option>'
		.'<option value="3"'.( $link_doc == 3 ? ' selected="selected"' : '' ).'>'._TABLE_BOTH.'</option>'
	.'</select></td></tr>';
	
	
	// table end
	echo '</table></form>';
}




//=====================================================
// SAVEING
//=====================================================

if($todo == 'save_config'){
	if(empty($new_link_use_side_desc))  { $new_link_use_side_desc  = 0; }
	if(empty($new_link_use_main_desc))  { $new_link_use_main_desc  = 0; }
	if(empty($new_link_use_side_title)) { $new_link_use_side_title = 0; }
	if($new_link_side_title == '')      { $new_link_side_title     = $old_link_side_title; }
	
	
	if($show_wysiwyg == 'tinymce'){
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
	
	
	// CHARSETS
	$new_link_side_title    = $tcms_main->encodeText($new_link_side_title, '2', $c_charset);
	$new_link_main_title    = $tcms_main->encodeText($new_link_main_title, '2', $c_charset);
	$new_link_main_subtitle = $tcms_main->encodeText($new_link_main_subtitle, '2', $c_charset);
	$content                = $tcms_main->encodeText($content, '2', $c_charset);
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/linkmanager.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('config');
		
		$xmluser->write_value('link_use_side_desc', $new_link_use_side_desc);
		$xmluser->write_value('link_use_side_title', $new_link_use_side_title);
		$xmluser->write_value('link_side_title', $new_link_side_title);
		$xmluser->write_value('link_main_title', $new_link_main_title);
		$xmluser->write_value('link_main_subtitle', $new_link_main_subtitle);
		$xmluser->write_value('link_main_text', $content);
		$xmluser->write_value('link_use_main_desc', $new_link_use_main_desc);
		$xmluser->write_value('link_main_access', $new_link_main_access);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('config');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'links_config.link_use_side_desc='.$new_link_use_side_desc.', '
		.$tcms_db_prefix.'links_config.link_use_side_title='.$new_link_use_side_title.', '
		.$tcms_db_prefix.'links_config.link_side_title="'.$new_link_side_title.'"';
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'links_config', $newSQLData, 'links_config_side');
		
		
		$newSQLData = ''
		.$tcms_db_prefix.'links_config.link_main_title="'.$new_link_main_title.'", '
		.$tcms_db_prefix.'links_config.link_main_subtitle="'.$new_link_main_subtitle.'", '
		.$tcms_db_prefix.'links_config.link_main_text="'.$content.'", '
		.$tcms_db_prefix.'links_config.link_use_main_desc='.$new_link_use_main_desc.', '
		.$tcms_db_prefix.'links_config.link_main_access="'.$new_link_main_access.'"';
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'links_config', $newSQLData, 'links_config_main');
	}
	
	//---------------------------------------------------------------------
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_links&todo=config\'</script>';
}




//=====================================================
// SAVING
//=====================================================

if($todo == 'save') {
	//****************************************
	
	if($new_link_name == '' || !isset($new_link_name)){ $new_link_name = ''; }
	if($new_link_desc == '' || !isset($new_link_desc)){ $new_link_desc = ''; }
	if($new_link_acs  == '' || !isset($new_link_acs)) { $new_link_acs  = 'Public'; }
	if($new_link_targ == '' || !isset($new_link_targ)){ $new_link_targ = '_blank'; }
	if($new_link_type == '' || !isset($new_link_type)){ $new_link_type = 'l'; }
	
	if(!isset($new_link_doc)  || empty($new_link_doc)  || $new_link_doc  == ''){ $new_link_doc  = 3; }
	if(!isset($new_link_pub)  || empty($new_link_pub)  || $new_link_pub  == ''){ $new_link_pub  = 0; }
	
	
	if($new_link_type == 'c'){
		$new_link_link = '';
		$new_link_target = '';
		$new_link_rss = '';
	}
	
	
	// CHARSETS
	$new_link_name = $tcms_main->encodeText($new_link_name, '2', $c_charset);
	$new_link_desc = $tcms_main->encodeText($new_link_desc, '2', $c_charset);
	
	
	if($new_link_sort == ''){
		$new_link_sort = $tcms_main->create_sort_id_sub(
			$choosenDB, 
			$sqlUser, 
			$sqlPass, 
			$sqlHost, 
			$sqlDB, 
			$sqlPort, 
			$tcms_db_prefix.'links', 'sort', 'category', "'".$new_link_cat."'");
	}
	
	
	if($choosenDB == 'xml') {
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_links/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('link');
		
		$xmluser->write_value('type', $new_link_type);
		$xmluser->write_value('category', $new_link_cat);
		$xmluser->write_value('sort', $new_link_sort);
		$xmluser->write_value('name', $new_link_name);
		$xmluser->write_value('desc', $new_link_desc);
		$xmluser->write_value('link_to', $new_link_link);
		$xmluser->write_value('published', $new_link_pub);
		$xmluser->write_value('target', $new_link_target);
		$xmluser->write_value('rss', $new_link_rss);
		$xmluser->write_value('access', $new_link_acs);
		$xmluser->write_value('module', $new_link_doc);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('link');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		//if($new_link_sort == ''){
			//$new_link_sort = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'links', 'sort');
			//$new_link_sort = 0;
		//}
		
		switch($dbAction){
			case 'save':
				$newSQLData = ''
				.$tcms_db_prefix.'links.type="'.$new_link_type.'", '
				.$tcms_db_prefix.'links.category="'.$new_link_cat.'", '
				.$tcms_db_prefix.'links.sort='.$new_link_sort.', '
				.$tcms_db_prefix.'links.name="'.$new_link_name.'", '
				.$tcms_db_prefix.'links.desc="'.$new_link_desc.'", '
				.$tcms_db_prefix.'links.link="'.$new_link_link.'", '
				.$tcms_db_prefix.'links.target="'.$new_link_target.'", '
				.$tcms_db_prefix.'links.rss="'.$new_link_rss.'", '
				.$tcms_db_prefix.'links.access="'.$new_link_acs.'", '
				.$tcms_db_prefix.'links.module='.$new_link_doc;
				
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'links', $newSQLData, $maintag);
				break;
			
			case 'next':
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`type`, `category`, `sort`, `name`, `desc`, `link`, `published`, `target`, `rss`, `access`, `module`';
						break;
					
					case 'pgsql':
						$newSQLColumns = '"type", category, sort, name, "desc", link, published, target, rss, "access", module';
						break;
					
					case 'mssql':
						$newSQLColumns = '[type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module]';
						break;
				}
				
				$newSQLData = "'".$new_link_type."', '".$new_link_cat."', ".$new_link_sort.", '".$new_link_name."', '".$new_link_desc."', '".$new_link_link."', ".$new_link_pub.", '".$new_link_target."', '".$new_link_rss."', '".$new_link_acs."', ".$new_link_doc;
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'links', $newSQLColumns, $newSQLData, $maintag);
				break;
		}
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_links\'</script>';
	
	//****************************************
}




//===================================================================================
// PUBLISH / UNPUBLISH
//===================================================================================

if($todo == 'publishItem'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_links/'.$maintag.'.xml', 'published', '1', '0'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'links.published=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'links', $newSQLData, $maintag);
			}
			echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_links\';</script>';
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml'){ xmlparser::edit_value(_TCMS_PATH.'/tcms_links/'.$maintag.'.xml', 'published', '0', '1'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'links.published=1';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'links', $newSQLData, $maintag);
			}
			echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_links\';</script>';
			break;
	}
}




//===================================================================================
// DELETE
//===================================================================================

if($todo == 'delete'){
	if($choosenDB == 'xml'){
		unlink(_TCMS_PATH.'/tcms_links/'.$maintag.'.xml');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."links WHERE uid = '".$maintag."'");
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_links\'</script>';
}

?>
