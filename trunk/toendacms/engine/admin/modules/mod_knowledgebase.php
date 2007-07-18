<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Knowledgebase
|
| File:		mod_knowledgebase.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Knowledgebase
 *
 * This is used as a Knowledgebase.
 *
 * @version 0.5.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['type'])){ $type = $_GET['type']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }

if(isset($_POST['category'])){ $category = $_POST['category']; }
if(isset($_POST['new_faq_title'])){ $new_faq_title = $_POST['new_faq_title']; }
if(isset($_POST['new_faq_subt'])){ $new_faq_subt = $_POST['new_faq_subt']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_faq_date'])){ $new_faq_date = $_POST['new_faq_date']; }
if(isset($_POST['new_faq_type'])){ $new_faq_type = $_POST['new_faq_type']; }
if(isset($_POST['new_faq_sort'])){ $new_faq_sort = $_POST['new_faq_sort']; }
if(isset($_POST['new_faq_cat'])){ $new_faq_cat = $_POST['new_faq_cat']; }
if(isset($_POST['new_faq_img'])){ $new_faq_img = $_POST['new_faq_img']; }
if(isset($_POST['new_faq_pub'])){ $new_faq_pub = $_POST['new_faq_pub']; }
if(isset($_POST['new_faq_access'])){ $new_faq_access = $_POST['new_faq_access']; }
if(isset($_POST['new_faq_autor'])){ $new_faq_autor = $_POST['new_faq_autor']; }
if(isset($_POST['new_faq_id'])){ $new_faq_id = $_POST['new_faq_id']; }
if(isset($_POST['new_faq_subtitle'])){ $new_faq_subtitle = $_POST['new_faq_subtitle']; }
if(isset($_POST['new_faq_access'])){ $new_faq_access = $_POST['new_faq_access']; }
if(isset($_POST['new_faq_enabled'])){ $new_faq_enabled = $_POST['new_faq_enabled']; }
if(isset($_POST['new_faq_autor_enabled'])){ $new_faq_autor_enabled = $_POST['new_faq_autor_enabled']; }





//=====================================================
// INIT
//=====================================================

if(!isset($todo)){ $todo = 'show'; }

echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';

if($show_wysiwyg == 'tinymce'){
	include('../tcms_kernel/tcms_tinyMCE.lib.php');
	
	$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
	$tcms_tinyMCE->initTinyMCE();
}





//=====================================================
// CONFIG
//=====================================================

if($todo == 'config'){
	if($id_group == 'Developer' || $id_group == 'Administrator'){
		if($choosenDB == 'xml'){
			$knowledgebase_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/knowledgebase.xml','r');
			
			$faq_title         = $knowledgebase_xml->read_section('config', 'title');
			$faq_subtitle      = $knowledgebase_xml->read_section('config', 'subtitle');
			$faq_text          = $knowledgebase_xml->read_section('config', 'text');
			$faq_enabled       = $knowledgebase_xml->read_section('config', 'enabled');
			$faq_autor_enabled = $knowledgebase_xml->read_section('config', 'autor_enabled');
			$faq_access        = $knowledgebase_xml->read_section('config', 'access');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'knowledgebase_config', 'knowledgebase');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$faq_id             = $sqlARR['id'];
			$faq_title          = $sqlARR['title'];
			$faq_subtitle       = $sqlARR['subtitle'];
			$faq_text           = $sqlARR['text'];
			$faq_access         = $sqlARR['access'];
			$faq_enabled        = $sqlARR['enabled'];
			$faq_autor_enabled  = $sqlARR['autor_enabled'];
			
			if($faq_id            == NULL){ $faq_id            = ''; }
			if($faq_title         == NULL){ $faq_title         = ''; }
			if($faq_subtitle      == NULL){ $faq_subtitle      = ''; }
			if($faq_text          == NULL){ $faq_text          = ''; }
			if($faq_access        == NULL){ $faq_access        = ''; }
			if($faq_enabled       == NULL){ $faq_enabled       = ''; }
			if($faq_autor_enabled == NULL){ $faq_autor_enabled = ''; }
		}
		
		
		$faq_title    = $tcms_main->decodeText($faq_title, '2', $c_charset);
		$faq_subtitle = $tcms_main->decodeText($faq_subtitle, '2', $c_charset);
		$faq_text     = $tcms_main->decodeText($faq_text, '2', $c_charset);
		
		$faq_title    = htmlspecialchars($faq_title);
		$faq_subtitle = htmlspecialchars($faq_subtitle);
		
		
		if($show_wysiwyg == 'tinymce'){
			$faq_text = stripslashes($faq_text);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$faq_text = str_replace('src="', 'src="../../../../', $faq_text);
			$faq_text = str_replace('src="../../../../http:', 'src="http:', $faq_text);
			$faq_text = str_replace('src="../../../../https:', 'src="https:', $faq_text);
			$faq_text = str_replace('src="../../../../ftp:', 'src="ftp:', $faq_text);
			$faq_text = str_replace('src="../../../..//', 'src="/', $faq_text);
		}
		else{
			$faq_text = ereg_replace('<br />'.chr(10), chr(13), $faq_text);
			$faq_text = ereg_replace('<br />'.chr(13), chr(13), $faq_text);
			$faq_text = ereg_replace('<br />', chr(13), $faq_text);
			
			$faq_text = ereg_replace('<br/>'.chr(10), chr(13), $faq_text);
			$faq_text = ereg_replace('<br/>'.chr(13), chr(13), $faq_text);
			$faq_text = ereg_replace('<br/>', chr(13), $faq_text);
			
			$faq_text = ereg_replace('<br>'.chr(10), chr(13), $faq_text);
			$faq_text = ereg_replace('<br>'.chr(13), chr(13), $faq_text);
			$faq_text = ereg_replace('<br>', chr(13), $faq_text);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$faq_text = str_replace('src="', 'src="../../', $faq_text);
		}
		
		
		//*********************************************************************************
		// MEDIACENTER CONFIG
		
		$arr_media = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/images/Image');
		
		
		
		// begin form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase" id="knowledgebase" method="post">'
		.'<input name="todo" type="hidden" value="save_config" />';
		
		
		// table head
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table row
		echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini">'
		.'<strong>'._FAQ_CFG_TITLE.'</strong>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._TABLE_TITLE.'</td>'
		.'<td><input name="new_faq_title" class="tcms_input_normal" value="'.$faq_title.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._TABLE_SUBTITLE.'</td>'
		.'<td><input name="new_faq_subtitle" class="tcms_input_normal" value="'.$faq_subtitle.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td>'
		.'<select name="new_faq_access" class="tcms_select">'
			.'<option value="Public"'.( $faq_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $faq_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $faq_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._TABLE_ENABLED.'</td>'
		.'<td><input type="checkbox" name="new_faq_enabled" '.( $faq_enabled == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_AUTOR_LINK.'</td>'
		.'<td><input type="checkbox" name="new_faq_autor_enabled" '.( $faq_autor_enabled == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" valign="top" colspan="2">'._TABLE_TEXT.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" colspan="2">'
		.'<script>createToendaToolbar(\'knowledgebase\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>';
		
		if($show_wysiwyg == 'tinymce'){ echo '<br /><br />'; }
		elseif($show_wysiwyg == 'fckeditor'){ }
		else{
			if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'knowledgebase\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
			else{ echo '<script>createToolbar(\'knowledgebase\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
		}
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content" mce_editable="true">'.$faq_text.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $faq_text;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea name="content" id="content" class="tcms_textarea_huge">'.$faq_text.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo '</table><br /></form>';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





//=====================================================
// SHOW OLD VALUES
//=====================================================

if($todo == 'show'){
	echo tcms_html::bold(_FAQ_TITLE);
	echo tcms_html::text(_FAQ_TEXT.'<br /><br />', 'left');
	
	
	
	if(isset($category)){
		if($choosenDB == 'xml'){
			$count = 0;
			
			$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$category.'.xml','r');
			
			//$access_cat = $down_xml->read_section('faq', 'access');
			
			$arrFAQparent['type'][$count] = $xml->read_section('faq', 'type');
			$arrFAQparent['pub'][$count]  = $xml->read_section('faq', 'publish_state');
			
			if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
				$arrFAQparent['title'][$count]  = $xml->read_section('faq', 'title');
				$arrFAQparent['parent'][$count] = $xml->read_section('faq', 'parent');
				$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
				
				// CHARSETS
				$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
				
				$checkCat = $xml->read_section('faq', 'category');
				
				$count++;
				
				while($checkCat != ""){
					$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$arrFAQparent['parent'][$count - 1].'.xml','r');
					
					$checkCat = $xml->read_section('faq', 'category');
					$arrFAQparent['type'][$count]   = $xml->read_section('faq', 'type');
					$arrFAQparent['pub'][$count]    = $xml->read_section('faq', 'publish_state');
					
					if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
						$arrFAQparent['title'][$count]  = $xml->read_section('faq', 'title');
						$arrFAQparent['parent'][$count] = $xml->read_section('faq', 'parent');
						$arrFAQparent['uid'][$count]    = substr($arrFAQparent['parent'][$count - 1], 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						//echo $count.' -> '.$arrFAQparent['parent'][$count].' -> '.$arrFAQparent['title'][$count].'<br>';
						
						$count++;
						$checkFAQTitle = $count;
					}
				}
			}
		}
		else{
			switch($id_group){
				case 'Developer':
				case 'Administrator':
					$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
					break;
				
				case 'User':
				case 'Editor':
				case 'Presenter':
					$strAdd = " OR access = 'Protected' ) ";
					break;
				
				default:
					$strAdd = ' ) ';
					break;
			}
			
			$sqlSTRparent = "SELECT * "
			."FROM ".$tcms_db_prefix."knowledgebase "
			."WHERE uid = '".$category."' "
			."AND publish_state = 2 "
			."AND type = 'c' "
			."AND ( access = 'Public' "
			.$strAdd;
			
			$count = 0;
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			while($sqlNR > 0){
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				unset($sqlQR);
				
				$arrFAQparent['title'][$count]  = $sqlARR['title'];
				$arrFAQparent['uid'][$count]    = $sqlARR['uid'];
				$arrFAQparent['parent'][$count] = $sqlARR['parent'];
				
				if($arrFAQparent['title'][$count]  == NULL){ $arrFAQparent['title'][$count]  = ''; }
				if($arrFAQparent['uid'][$count]    == NULL){ $arrFAQparent['uid'][$count]    = ''; }
				if($arrFAQparent['parent'][$count] == NULL){ $arrFAQparent['parent'][$count] = ''; }
				
				// CHARSETS
				$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
				
				$sqlSTRparent = "SELECT * "
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$arrFAQparent['parent'][$count]."' "
				."AND publish_state = 2 "
				."AND type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
				
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				$count++;
				$checkFAQTitle = $count;
			}
		}
		
		if(!isset($checkFAQTitle)){ $checkFAQTitle = 1; }
		
		
		echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase">'
		.'<strong>'
		._TCMS_MENU_FAQ
		.'</strong>'
		.'</a>';
		
		
		for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
			echo '&nbsp;/&nbsp;';
			
			if($i == 0){
				echo $arrFAQparent['title'][$i];
			}
			else{
				echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;category='.$arrFAQparent['uid'][$i].'">'
				.$arrFAQparent['title'][$i]
				.'</a>';
			}
		}
		
		echo '<br /><br />';
	}
	

	$arrFAQ = '';
	
	if($choosenDB == 'xml'){
		$arr_filename = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_knowledgebase/');
		
		$count = 0;
		
		if(is_array($arr_filename)){
			foreach($arr_filename as $key => $value){
				$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$value,'r');
				$checkCat = $menu_xml->read_section('faq', 'category');
				
				
				/*
					rules
				*/
				if(!isset($category) || $category == ''){
					if($checkCat == '') $countThis = true;
					else $countThis = false;
				}
				else{
					if($checkCat == $category) $countThis = true;
					else $countThis = false;
				}
				
				
				if($countThis){
					$arrFAQ['uid'][$count]     = substr($value, 0, 10);
					$arrFAQ['cat'][$count]     = $checkCat;
					$arrFAQ['title'][$count]   = $menu_xml->read_section('faq', 'title');
					$arrFAQ['subt'][$count]    = $menu_xml->read_section('faq', 'subtitle');
					$arrFAQ['content'][$count] = $menu_xml->read_section('faq', 'content');
					$arrFAQ['date'][$count]    = $menu_xml->read_section('faq', 'date');
					$arrFAQ['type'][$count]    = $menu_xml->read_section('faq', 'type');
					$arrFAQ['sort'][$count]    = $menu_xml->read_section('faq', 'sort');
					$arrFAQ['img'][$count]     = $menu_xml->read_section('faq', 'image');
					$arrFAQ['pub'][$count]     = $menu_xml->read_section('faq', 'publish_state');
					$arrFAQ['access'][$count]  = $menu_xml->read_section('faq', 'access');
					$arrFAQ['autor'][$count]   = $menu_xml->read_section('faq', 'autor');
					
					// CHARSETS
					$arrFAQ['title'][$count]   = $tcms_main->decodeText($arrFAQ['title'][$count], '2', $c_charset);
					$arrFAQ['subt'][$count]    = $tcms_main->decodeText($arrFAQ['subt'][$count], '2', $c_charset);
					$arrFAQ['content'][$count] = $tcms_main->decodeText($arrFAQ['content'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
				
				$count++;
				$checkCatAmount = $count;
			}
		}
		
		if(is_array($arrFAQ)){
			array_multisort(
				$arrFAQ['sort'], SORT_ASC, 
				$arrFAQ['date'], SORT_ASC, 
				$arrFAQ['title'], SORT_ASC, 
				$arrFAQ['subt'], SORT_ASC, 
				$arrFAQ['content'], SORT_ASC, 
				$arrFAQ['type'], SORT_ASC, 
				$arrFAQ['cat'], SORT_ASC, 
				$arrFAQ['img'], SORT_ASC, 
				$arrFAQ['pub'], SORT_ASC, 
				$arrFAQ['access'], SORT_ASC, 
				$arrFAQ['autor'], SORT_ASC, 
				$arrFAQ['uid'], SORT_ASC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($id_group){
			case 'Developer':
			case 'Administrator':
				$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
				break;
			
			case 'User':
			case 'Editor':
			case 'Presenter':
				$strAdd = " OR access = 'Protected' ) ";
				break;
			
			default:
				$strAdd = ' ) ';
				break;
		}
		
		if(!isset($category)){
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."knowledgebase "
			."WHERE parent IS NULL "
			."OR parent = '' "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC, title ASC";
		}
		else{
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."knowledgebase "
			."WHERE category = '".$category."' "
			//."AND parent IS NULL "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC, title ASC";
		}
		
		$sqlQR = $sqlAL->sqlQuery($sqlSTR);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arrFAQ['uid'][$count]     = $sqlARR['uid'];
			$arrFAQ['title'][$count]   = $sqlARR['title'];
			$arrFAQ['subt'][$count]    = $sqlARR['subtitle'];
			$arrFAQ['content'][$count] = $sqlARR['content'];
			$arrFAQ['date'][$count]    = $sqlARR['date'];
			$arrFAQ['type'][$count]    = $sqlARR['type'];
			$arrFAQ['sort'][$count]    = $sqlARR['sort'];
			$arrFAQ['cat'][$count]     = $sqlARR['category'];
			$arrFAQ['img'][$count]     = $sqlARR['image'];
			$arrFAQ['pub'][$count]     = $sqlARR['publish_state'];
			$arrFAQ['access'][$count]  = $sqlARR['access'];
			$arrFAQ['autor'][$count]   = $sqlARR['autor'];
			
			
			if($arrFAQ['uid'][$count]     == NULL){ $arrFAQ['uid'][$count]     = ''; }
			if($arrFAQ['title'][$count]   == NULL){ $arrFAQ['title'][$count]   = ''; }
			if($arrFAQ['subt'][$count]    == NULL){ $arrFAQ['subt'][$count]    = ''; }
			if($arrFAQ['content'][$count] == NULL){ $arrFAQ['content'][$count] = ''; }
			if($arrFAQ['date'][$count]    == NULL){ $arrFAQ['date'][$count]    = ''; }
			if($arrFAQ['type'][$count]    == NULL){ $arrFAQ['type'][$count]    = ''; }
			if($arrFAQ['sort'][$count]    == NULL){ $arrFAQ['sort'][$count]    = ''; }
			if($arrFAQ['pub'][$count]     == NULL){ $arrFAQ['pub'][$count]     = ''; }
			if($arrFAQ['access'][$count]  == NULL){ $arrFAQ['access'][$count]  = ''; }
			if($arrFAQ['autor'][$count]   == NULL){ $arrFAQ['autor'][$count]   = ''; }
			
			
			// CHARSETS
			$arrFAQ['title'][$count]   = $tcms_main->decodeText($arrFAQ['title'][$count], '2', $c_charset);
			$arrFAQ['subt'][$count]    = $tcms_main->decodeText($arrFAQ['subt'][$count], '2', $c_charset);
			$arrFAQ['content'][$count] = $tcms_main->decodeText($arrFAQ['content'][$count], '2', $c_charset);
			
			
			$count++;
			$checkCatAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="35%" align="left" colspan="2">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="20%" align="left">'._TABLE_SUBTITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_DATE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="center">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th></tr>';
	
	if($tcms_main->isArray($arrFAQ)){
		foreach($arrFAQ['uid'] as $key => $value){
			if(is_integer($key/2)){ $wsc = 0; }
			else{ $wsc = 1; }
			
			switch(trim($arrFAQ['type'][$key])){
				case 'c':
					$strLocation = '';
					//'document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;category='.$arrFAQ['uid'][$key].'\';';
					break;
				
				case 'a':
					$strLocation = 'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;todo=edit&amp;type=a&amp;maintag='.$arrFAQ['uid'][$key].'\';"';
					break;
			}
			
			echo '<tr height="25" id="row'.$key.'" '
			.'bgcolor="'.$arr_color[$wsc].'" '
			.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')">';
			
			switch(trim($arrFAQ['type'][$key])){
				case 'c':
					echo '<td class="tcms_db_2" style="width: 13px !important;" '.$strLocation.'>'
					.'<img border="0" src="../images/explore/faq_folder.png" />'
					.'</td>';
					break;
				
				case 'a':
					echo '<td class="tcms_db_2" style="width: 13px !important;" '.$strLocation.'>'
					.'<img border="0" src="../images/explore/faq_text.png" />'
					.'</td>';
					break;
			}
			
			
			echo '<td class="tcms_db_2" '.$strLocation.'>'.$arrFAQ['title'][$key].'&nbsp;</td>';
			echo '<td class="tcms_db_2" '.$strLocation.'>'.$arrFAQ['subt'][$key].'&nbsp;</td>';
			echo '<td class="tcms_db_2" '.$strLocation.'>'.$arrFAQ['date'][$key].'&nbsp;</td>';
			
			
			if($choosenDB == 'xml'){
				$strAutor = $tcms_main->getUser($arrFAQ['autor'][$key]);
			}
			else{
				$strAutor = $tcms_main->getUserFromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $arrFAQ['autor'][$key]);
			}
			
			echo '<td class="tcms_db_2" '.$strLocation.'>'.$strAutor.'&nbsp;</td>';
			
			
			echo '<td align="center" class="tcms_db_2" '.$strLocation.'>'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;todo=changePublish&amp;action=';
			
			switch($arrFAQ['pub'][$key]){
				case 0: echo 'st'; break;
				case 1: echo 'on'; break;
				case 2: echo 'off'; break;
			}
			
			echo '&amp;maintag='.$arrFAQ['uid'][$key].'">';
			
			switch($arrFAQ['pub'][$key]){
				case 0: echo '<img src="../images/no.png" border="0" />'; break;
				case 1: echo '<img src="../images/wait.png" border="0" />'; break;
				case 2: echo '<img src="../images/yes.png" border="0" />'; break;
			}
			
			echo '</a></td>';
			
			
			echo '<td class="tcms_db_2" '.$strLocation.' align="center" style="color: '.( $arrFAQ['access'][$key] == 'Public' ? '#008800' : '#ff0000' ).';">'.$arrFAQ['access'][$key].'</td>';
			
			
			switch(trim($arrFAQ['type'][$key])){
				case 'c':
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_GOUPBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;category='.$arrFAQ['uid'][$key].'">'
					.'<img title="'._TABLE_GOUPBUTTON.'" alt="'._TABLE_GOUPBUTTON.'" style="padding-top: 3px;" border="0" src="../images/go_right.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;todo=edit&amp;type=c&amp;maintag='.$arrFAQ['uid'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/pencil.png" />'
					.'</a>&nbsp;';
					break;
				
				case 'a':
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;todo=edit&amp;type=a&amp;maintag='.$arrFAQ['uid'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/pencil.png" />'
					.'</a>&nbsp;';
					break;
			}
			
			echo '<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase&amp;&todo=delete&amp;maintag='.$arrFAQ['uid'][$key].'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.png" />'
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

if($todo == 'edit'){
	if($tcms_main->isReal($maintag)){
		if($choosenDB == 'xml'){
			$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml','r');
			$arrFAQ_title   = $menu_xml->read_section('faq', 'title');
			$arrFAQ_subt    = $menu_xml->read_section('faq', 'subtitle');
			$arrFAQ_content = $menu_xml->read_section('faq', 'content');
			$arrFAQ_date    = $menu_xml->read_section('faq', 'date');
			$arrFAQ_type    = $menu_xml->read_section('faq', 'type');
			$arrFAQ_sort    = $menu_xml->read_section('faq', 'sort');
			$arrFAQ_img     = $menu_xml->read_section('faq', 'image');
			$arrFAQ_pub     = $menu_xml->read_section('faq', 'publish_state');
			$arrFAQ_access  = $menu_xml->read_section('faq', 'access');
			$arrFAQ_cat     = $menu_xml->read_section('faq', 'category');
			$arrFAQ_autor   = $menu_xml->read_section('faq', 'autor');
			
			if($arrFAQ_title   == false){ $arrFAQ_title   = ''; }
			if($arrFAQ_subt    == false){ $arrFAQ_subt    = ''; }
			if($arrFAQ_content == false){ $arrFAQ_content = ''; }
			if($arrFAQ_date    == false){ $arrFAQ_date    = ''; }
			if($arrFAQ_type    == false){ $arrFAQ_type    = ''; }
			//if($arrFAQ_sort    == false){ $arrFAQ_sort    = ''; }
			if($arrFAQ_img     == false){ $arrFAQ_img     = ''; }
			if($arrFAQ_pub     == false){ $arrFAQ_pub     = '0'; }
			if($arrFAQ_access  == false){ $arrFAQ_access  = ''; }
			if($arrFAQ_autor   == false){ $arrFAQ_autor   = ''; }
			if($arrFAQ_cat     == false){ $arrFAQ_cat     = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'knowledgebase', $maintag);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			
			$arrFAQ_uid     = $sqlARR['uid'];
			$arrFAQ_title   = $sqlARR['title'];
			$arrFAQ_subt    = $sqlARR['subtitle'];
			$arrFAQ_content = $sqlARR['content'];
			$arrFAQ_date    = $sqlARR['date'];
			$arrFAQ_type    = $sqlARR['type'];
			$arrFAQ_sort    = $sqlARR['sort'];
			$arrFAQ_cat     = $sqlARR['category'];
			$arrFAQ_img     = $sqlARR['image'];
			$arrFAQ_pub     = $sqlARR['publish_state'];
			$arrFAQ_access  = $sqlARR['access'];
			$arrFAQ_autor   = $sqlARR['autor'];
			
			
			if($arrFAQ_uid     == NULL){ $arrFAQ_uid     = ''; }
			if($arrFAQ_title   == NULL){ $arrFAQ_title   = ''; }
			if($arrFAQ_subt    == NULL){ $arrFAQ_subt    = ''; }
			if($arrFAQ_content == NULL){ $arrFAQ_content = ''; }
			if($arrFAQ_date    == NULL){ $arrFAQ_date    = ''; }
			if($arrFAQ_type    == NULL){ $arrFAQ_type    = ''; }
			if($arrFAQ_sort    == NULL){ $arrFAQ_sort    = ''; }
			if($arrFAQ_pub     == NULL){ $arrFAQ_pub     = ''; }
			if($arrFAQ_access  == NULL){ $arrFAQ_access  = ''; }
			if($arrFAQ_autor   == NULL){ $arrFAQ_autor   = ''; }
		}
		
		$arrFAQ_title   = $tcms_main->decodeText($arrFAQ_title, '2', $c_charset);
		$arrFAQ_subt    = $tcms_main->decodeText($arrFAQ_subt, '2', $c_charset);
		$arrFAQ_content = $tcms_main->decodeText($arrFAQ_content, '2', $c_charset);
		
		echo tcms_html::bold(_TABLE_EDIT);
		$odot = 'save';
	}
	else{
		$arrFAQ_uid     = '';
		$arrFAQ_title   = '';
		$arrFAQ_subt    = '';
		$arrFAQ_content = '';
		$arrFAQ_date    = '';
		$arrFAQ_type    = $type;
		$arrFAQ_sort    = '';
		$arrFAQ_cat     = '';
		$arrFAQ_img     = '';
		$arrFAQ_pub     = '0';
		$arrFAQ_access  = 'Public';
		$arrFAQ_autor   = '';
		
		
		if($choosenDB =! 'xml')
			$arrFAQ_sort = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'knowledgebase', 'sort');
		
		$maintag = $tcms_main->getNewUID(10, 'knowledgebase');
		
		
		echo tcms_html::bold(_TABLE_NEW);
		$odot = 'next';
	}
	
	
	$arrFAQ_title = htmlspecialchars($arrFAQ_title);
	$arrFAQ_subt  = htmlspecialchars($arrFAQ_subt);
	
	if($show_wysiwyg == 'tinymce'){
		$arrFAQ_content = stripslashes($arrFAQ_content);
	}
	elseif($show_wysiwyg == 'fckeditor'){
		$arrFAQ_content = str_replace('src="', 'src="../../../../', $arrFAQ_content);
		$arrFAQ_content = str_replace('src="../../../../http:', 'src="http:', $arrFAQ_content);
		$arrFAQ_content = str_replace('src="../../../..//', 'src="/', $arrFAQ_content);
	}
	else{
		$arrFAQ_content = ereg_replace('<br />'.chr(10), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br />'.chr(13), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br />', chr(13),  $arrFAQ_content);
		
		$arrFAQ_content = ereg_replace('<br/>'.chr(10), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br/>'.chr(13), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br/>', chr(13),  $arrFAQ_content);
		
		$arrFAQ_content = ereg_replace('<br>'.chr(10), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br>'.chr(13), chr(13),  $arrFAQ_content);
		$arrFAQ_content = ereg_replace('<br>', chr(13),  $arrFAQ_content);
		
		$arrFAQ_content = htmlspecialchars( $arrFAQ_content);
	}
	
	
	if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
		//$arrFAQ_content = str_replace('src="', 'src="../../', $arrFAQ_content);
	}
	
	
	$width = '200';
	
	echo tcms_html::text(_FAQ_TEXT.'<br /><br />', 'left');
	
	
	// begin form
	echo '<form id="faq" action="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase" method="post">'
	.'<input name="todo" type="hidden" value="'.$odot.'" />'
	.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
	.'<input name="new_faq_type" type="hidden" value="'.$arrFAQ_type.'" />';
	
	
	// table
	echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="noborder"><tr class="tcms_bg_blue_01">';
	echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
	echo '</tr></table>';
	
	
	// table
	echo '<table width="100%" cellpadding="1" cellspacing="5" border="0" class="tcms_table">';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_faq_title" type="text" value="'.$arrFAQ_title.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_SUBTITLE.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_faq_subt" type="text" value="'.$arrFAQ_subt.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DATE.'</strong></td>'
	.'<td valign="top"><input class="tcms_input_small" id="new_faq_date" name="new_faq_date" type="text" value="'.( $arrFAQ_date == '' ? date('d.m.Y-H:i') : $arrFAQ_date ).'" />'
	.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDateTime" />'
	.'</td></tr>';
	
	echo '<script type="text/javascript">
	Calendar.setup({
        inputField     :    "new_faq_date",
        ifFormat       :    "%d.%m.%Y-%H:%M",
        showsTime      :    true,
        timeFormat     :    24,
        button         :    "triggerButtonDateTime",
        singleClick    :    false,
        step           :    1
    });
	</script>';
	
	
	// table row
	echo '<tr><td valign="top" colspan="2"><br />'
	.'<strong class="tcms_bold">'._TABLE_TEXT.' ('._TCMS_MENU_FAQ.' '._TABLE_ORDER.': '.$maintag.')</strong>'
	.( $show_wysiwyg != 'fckeditor' ? '<br /><br />' : '' )
	.( $type == 'a' ? '<script>createToendaToolbar(\'faq\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>' : '' );
	
	if($type == 'a'){
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor'){
			if($show_wysiwyg == 'toendaScript')
				echo '<script>createToolbar(\'faq\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			else
				echo '<script>createToolbar(\'faq\', \''.$tcms_lang.'\', \'HTML\');</script>';
		}
	}
	else{
		if($show_wysiwyg == 'toendaScript')
			echo '<script>createToolbar(\'faq\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
		else
			echo '<script>createToolbar(\'faq\', \''.$tcms_lang.'\', \'HTML\');</script>';
	}
	
	echo '<br />'
	.'</td></tr>';
	
	
	// table row
	echo '<tr><td valign="top" colspan="2">';
	
	if($type == 'a'){
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 100%;" id="content" name="content" mce_editable="true">'.$arrFAQ_content.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $arrFAQ_content;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 100%;" id="content" name="content">'.$arrFAQ_content.'</textarea>';
		}
	}
	else{
		echo '<textarea class="tcms_textarea_huge" style="width: 100%;" id="content" name="content">'.$arrFAQ_content.'</textarea>';
	}
	
	echo '<br /><br />'
	.'</td>';
	
	
	echo '<td width="250" valign="top">'
	.'<div style="width: 200px; overflow: auto; border: 0px solid #fff; padding: 3px;">';
	
	// position
	echo '<strong class="tcms_bold">'._TABLE_POS.'</strong>'
	.'<br />'
	.'<input class="tcms_input_makro" id="new_faq_sort" name="new_faq_sort" type="text" value="'.$arrFAQ_sort.'" />';
	
	echo '<br /><br />';
	
	// category
	echo '<strong class="tcms_bold">'._TABLE_CATEGORY.'</strong>'
	.'<select class="tcms_select" name="new_faq_cat">';
	
	echo '<option value=""'.( $arrFAQ_cat == null ? ' selected="selected"' : '' ).'>'._FAQ_BASE_CATEGORY.'</option>';
	
	foreach($arrFAQCategories['tag'] as $key => $value){
		echo '<option value="'.$value.'"'.( $value == $arrFAQ_cat ? ' selected="selected"' : '' ).'>'.$arrFAQCategories['title'][$key].'</option>';
	}
	
	echo '</select>';
	
	echo '<br /><br />';
	
	// access
	echo '<strong class="tcms_bold">'._TABLE_ACCESS.'</strong>'
	.'<select name="new_faq_access" class="tcms_select">'
	.'<option value="Public"'.( $arrFAQ_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
	.'<option value="Protected"'.( $arrFAQ_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
	.'<option value="Private"'.( $arrFAQ_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
	.'</select>';
	
	echo '<br /><br />';
	
	// access
	echo '<strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong>'
	.'<select name="new_faq_pub" class="tcms_select">'
	.'<option value="0"'.( $arrFAQ_pub == '0' ? ' selected="selected"' : '' ).'>'._TABLE_NOT_PUBLISHED.'</option>'
	.'<option value="1"'.( $arrFAQ_pub == '1' ? ' selected="selected"' : '' ).'>'._TABLE_IS_IN_WORK.'</option>'
	.'<option value="2"'.( $arrFAQ_pub == '2' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLISHED.'</option>'
	.'</select>';
	
	echo '<br /><br />';
	
	// autor
	echo '<strong class="tcms_bold">'._TABLE_AUTOR.'</strong>'
	.'<select class="tcms_select" name="new_faq_autor">';
	
	if($id_group == 'Developer' || $id_group == 'Administrator'){
		$strAutor = $tcms_main->getUserFromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_uid);
		
		echo '<optgroup label="'._USER_SELF.'">'
		.'<option value="'.$id_uid.'"'.( $arrFAQ_autor == $id_uid ? ' selected="selected"' : '').'>'.$strAutor.'</option>'
		.'</optgroup>'
		.'<optgroup label="'._USER_ALL.'">';
		
		foreach($arrActiveUser['tag'] as $key => $value){
			echo '<option value="'.$value.'"'.( $arrFAQ_autor == $value ? ' selected="selected"' : '').'>'.$arrActiveUser['user'][$key].'</option>';
		}
		
		echo '</optgroup>';
	}
	else{
		$strAutor = $tcms_main->getUserFromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_uid);
		
		echo '<option value="'.$id_uid.'"'.( $arrFAQ_autor == $id_uid ? ' selected="selected"' : '').'>'.$strAutor.'</option>';
		
		$strAutor = $tcms_main->getUserFromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $arrFAQ_autor);
		
		if(isset($arrFAQ_autor) && $arrFAQ_autor != '' && ($arrFAQ_autor != $id_username && $arrFAQ_autor != $id_name)){
			echo '<option value="'.$arrFAQ_autor.'" selected="selected">'.$strAutor.'</option>';
		}
	}
	
	echo '</select>';
	
	echo '<br /><br />';
	
	// access
	echo '<strong class="tcms_bold">'._TABLE_IMAGE.'</strong>';
	
	echo '<br /><input type="button" name="tcms" value="'._TCMSSCRIPT_IMAGES.'" onclick="window.open(\'media.php?id_user='.$id_user.'&v=faq&faq=faq\', \'ImageBrowser\', \'width=400,height=500,left=50,top=50,scrollbars=yes\');" />'
	.'<input type="button" name="tcms" value="'._EXT_NEWS_DESELECT.'" onclick="document.getElementById(\'faq_img\').src=\'\';document.getElementById(\'new_faq_img\').value=\'\';document.getElementById(\'faq_img\').style.display=\'none\';" />'
	.'<br />';
	
	if(isset($new_faq_img)){ $arrFAQ_img = $new_faq_img; }
	
	echo '<img width="100"'.( $arrFAQ_img == '' ? ' style="display:block;"' : '' ).' id="faq_img" src="../../'.$tcms_administer_site.'/images/knowledgebase/'.$arrFAQ_img.'" border="0" />'
	.'<input name="new_faq_img" id="new_faq_img" value="'.$arrFAQ_img.'" type="hidden" />';
	
	echo '<br />';
	
	echo '</div>'
	.'</td></tr>';
	
	
	// table end
	echo '</table>';
	
	
	echo '</form>';
}





//===================================================================================
// CHANGE PUBLISHING
//===================================================================================

if($todo == 'changePublish'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml', 'publish_state', '2', '0'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'knowledgebase.publish_state=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'knowledgebase', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\';</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml', 'publish_state', '1', '2'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'knowledgebase.publish_state=2';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'knowledgebase', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\';</script>';
			}
			break;
		
		// Take it on
		case 'st':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml', 'publish_state', '0', '1'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'knowledgebase.publish_state=1';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'knowledgebase', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\';</script>';
			}
			break;
	}
}





//=====================================================
// SAVEING
//=====================================================

if($todo == 'save_config'){
	if(empty($new_faq_enabled))      { $new_faq_enabled       = 0; }
	if(empty($new_faq_autor_enabled)){ $new_faq_autor_enabled = 0; }
	if($new_faq_title    == ''){ $new_faq_title    = ''; }
	if($new_faq_subtitle == ''){ $new_faq_subtitle = ''; }
	if($content          == ''){ $content          = ''; }
	if($new_faq_access   == ''){ $new_faq_access   = 'Public'; }
	
	
	if($show_wysiwyg == 'tinymce'){
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
	$new_faq_title    = $tcms_main->decode_text($new_faq_title, '2', $c_charset);
	$new_faq_subtitle = $tcms_main->decode_text($new_faq_subtitle, '2', $c_charset);
	$content          = $tcms_main->decode_text($content, '2', $c_charset);
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/knowledgebase.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('config');
		
		$xmluser->write_value('title', $new_faq_title);
		$xmluser->write_value('subtitle', $new_faq_subtitle);
		$xmluser->write_value('text', $content);
		$xmluser->write_value('enabled', $new_faq_enabled);
		$xmluser->write_value('autor_enabled', $new_faq_autor_enabled);
		$xmluser->write_value('access', $new_faq_access);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('config');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'knowledgebase_config.title="'.$new_faq_title.'", '
		.$tcms_db_prefix.'knowledgebase_config.subtitle="'.$new_faq_subtitle.'", '
		.$tcms_db_prefix.'knowledgebase_config.text="'.$content.'", '
		.$tcms_db_prefix.'knowledgebase_config.access="'.$new_faq_access.'", '
		.$tcms_db_prefix.'knowledgebase_config.enabled='.$new_faq_enabled.', '
		.$tcms_db_prefix.'knowledgebase_config.autor_enabled='.$new_faq_autor_enabled;
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'knowledgebase_config', $newSQLData, 'knowledgebase');
	}
	
	//---------------------------------------------------------------------
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase&todo=config\'</script>';
}





//=====================================================
// SAVING
//=====================================================

if($todo == 'save'){
	//****************************************
	
	if($new_faq_cat  == '' || !isset($new_faq_cat)) { $new_faq_cat  = null; }
	if($new_faq_sort == '' || !isset($new_faq_sort)){ $new_faq_sort = 0; }
	
	
	if($show_wysiwyg == 'tinymce'){
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
	$new_faq_title = $tcms_main->encodeText($new_faq_title, '2', $c_charset);
	$new_faq_subt  = $tcms_main->encodeText($new_faq_subt, '2', $c_charset);
	$content       = $tcms_main->encodeText($content, '2', $c_charset);
	
	
	if($choosenDB == 'xml'){
		if(!isset($_POST['CatCount']) || $_POST['CatCount'] == '' || empty($_POST['CatCount'])){ $_POST['CatCount'] = 0; }
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('faq');
		
		$xmluser->write_value('category', $new_faq_cat);
		$xmluser->write_value('parent', $new_faq_cat);
		$xmluser->write_value('title', $new_faq_title);
		$xmluser->write_value('subtitle', $new_faq_subt);
		$xmluser->write_value('content', $content);
		$xmluser->write_value('image', $new_faq_img);
		$xmluser->write_value('type', $new_faq_type);
		$xmluser->write_value('date', $new_faq_date);
		$xmluser->write_value('last_update', date('d.m.Y-H:i'));
		$xmluser->write_value('access', $new_faq_access);
		$xmluser->write_value('autor', $new_faq_autor);
		$xmluser->write_value('sort', $new_faq_sort);
		$xmluser->write_value('publish_state', $new_faq_pub);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('faq');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'knowledgebase.category="'.$new_faq_cat.'", '
		.$tcms_db_prefix.'knowledgebase.parent="'.$new_faq_cat.'", '
		.$tcms_db_prefix.'knowledgebase.title="'.$new_faq_title.'", '
		.$tcms_db_prefix.'knowledgebase.subtitle="'.$new_faq_subt.'", '
		.$tcms_db_prefix.'knowledgebase.content="'.$content.'", '
		.$tcms_db_prefix.'knowledgebase.image="'.$new_faq_img.'", '
		.$tcms_db_prefix.'knowledgebase.type="'.$new_faq_type.'", '
		.$tcms_db_prefix.'knowledgebase.date="'.$new_faq_date.'", '
		.$tcms_db_prefix.'knowledgebase.last_update="'.date('d.m.Y-H:i').'", '
		.$tcms_db_prefix.'knowledgebase.access="'.$new_faq_access.'", '
		.$tcms_db_prefix.'knowledgebase.autor="'.$new_faq_autor.'", '
		.$tcms_db_prefix.'knowledgebase.sort='.$new_faq_sort.', '
		.$tcms_db_prefix.'knowledgebase.publish_state='.$new_faq_pub.'';
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'knowledgebase', $newSQLData, $maintag);
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\'</script>';
	
	//****************************************
}





//=====================================================
// SAVING
//=====================================================

if($todo == 'next'){
	//****************************************
	
	if($new_faq_cat  == '' || !isset($new_faq_cat)) { $new_faq_cat  = null; }
	if($new_faq_sort == '' || !isset($new_faq_sort)){ $new_faq_sort = 0; }
	
	
	if($show_wysiwyg == 'tinymce'){
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
	$new_faq_title = $tcms_main->decode_text($new_faq_title, '2', $c_charset);
	$new_faq_subt = $tcms_main->decode_text($new_faq_subt, '2', $c_charset);
	$content = $tcms_main->decode_text($content, '2', $c_charset);
	
	//$content = htmlentities($content);
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('faq');
		
		$xmluser->write_value('category', $new_faq_cat);
		$xmluser->write_value('parent', $new_faq_cat);
		$xmluser->write_value('title', $new_faq_title);
		$xmluser->write_value('subtitle', $new_faq_subt);
		$xmluser->write_value('content', $content);
		$xmluser->write_value('image', $new_faq_img);
		$xmluser->write_value('type', $new_faq_type);
		$xmluser->write_value('date', $new_faq_date);
		$xmluser->write_value('last_update', date('d.m.Y-H:i'));
		$xmluser->write_value('access', $new_faq_access);
		$xmluser->write_value('autor', $new_faq_autor);
		$xmluser->write_value('sort', $new_faq_sort);
		$xmluser->write_value('publish_state', $new_faq_pub);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('faq');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($choosenDB){
			case 'mysql':
				$newSQLColumns = '`category`, `parent`, `title`, `subtitle`, `content`, `image`, '
				.'`type`, `date`, `last_update`, `access`, `autor`, `sort`, `publish_state`';
				break;
			
			case 'pgsql':
				$newSQLColumns = 'category, parent, title, subtitle, content, image, type, '
				.'date, last_update, access, autor, sort, publish_state';
				break;
			
			case 'mssql':
				$newSQLColumns = '[category], [parent], [title], [subtitle], [content], [image], [type], '
				.'[date], [last_update], [access], [autor], [sort], [publish_state]';
				break;
		}
		
		$newSQLData = "'".$new_faq_cat."', '".$new_faq_cat."', '".$new_faq_title."', '".$new_faq_subt."', '".$content."', "
		."'".$new_faq_img."', '".$new_faq_type."', '".$new_faq_date."', '".date('d.m.Y-H:i')."', '".$new_faq_access."', "
		."'".$new_faq_autor."', ".$new_faq_sort.", ".$new_faq_pub;
		
		$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'knowledgebase', $newSQLColumns, $newSQLData, $maintag);
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\'</script>';
	
	//****************************************
}





//===================================================================================
// DELETE
//===================================================================================

if($todo == 'delete'){
	//****************************************
	
	if($choosenDB == 'xml'){
		unlink('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$maintag.'.xml');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'knowledgebase', $maintag);
		
		$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."knowledgebase WHERE category='".$maintag."' AND type='c'");
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		$sqlQR2 = $sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."knowledgebase WHERE category='".$maintag."'");
		
		//while($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$new_maintag = $sqlARR['uid'];
				
				$sqlQR = $sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."knowledgebase WHERE category='".$new_maintag."'");
				
				//$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."downloads WHERE cat='".$new_maintag."' AND sql_type='d'");
				//$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				//$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				//$new_maintag = $sqlARR['uid'];
			}
		//}
		
		$sqlAL->_sqlAbstractionLayer();
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_knowledgebase\'</script>';
	
	//****************************************
}

?>
