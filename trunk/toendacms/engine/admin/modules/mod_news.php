<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| News Manager
|
| File:		mod_news.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * News Manager
 *
 * This module is used for the news.
 *
 * @version 1.4.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['minValue'])){ $minValue = $_GET['minValue']; }
if(isset($_GET['maxValue'])){ $maxValue = $_GET['maxValue']; }
if(isset($_GET['thisValue'])){ $thisValue = $_GET['thisValue']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['new_news_mm_image'])){ $new_news_mm_image = $_GET['new_news_mm_image']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['sender'])){ $sender = $_GET['sender']; }

if(isset($_POST['extra'])){ $extra = $_POST['extra']; }
if(isset($_POST['new_news_mm_amount'])){ $new_news_mm_amount = $_POST['new_news_mm_amount']; }
if(isset($_POST['new_news_mm_id'])){ $new_news_mm_id = $_POST['new_news_mm_id']; }
if(isset($_POST['new_use_comments'])){ $new_use_comments = $_POST['new_use_comments']; }
if(isset($_POST['new_use_autor'])){ $new_use_autor = $_POST['new_use_autor']; }
if(isset($_POST['new_use_autor_link'])){ $new_use_autor_link = $_POST['new_use_autor_link']; }
if(isset($_POST['news_mm_title'])){ $news_mm_title = $_POST['news_mm_title']; }
if(isset($_POST['news_mm_stamp'])){ $news_mm_stamp = $_POST['news_mm_stamp']; }
if(isset($_POST['news_mm_image'])){ $news_mm_image = $_POST['news_mm_image']; }
if(isset($_POST['news_mm_access'])){ $news_mm_access = $_POST['news_mm_access']; }
if(isset($_POST['stamp'])){ $stamp = $_POST['stamp']; }
if(isset($_POST['titel'])){ $titel = $_POST['titel']; }
if(isset($_POST['autor'])){ $autor = $_POST['autor']; }
if(isset($_POST['order'])){ $order = $_POST['order']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['new_time'])){ $new_time = $_POST['new_time']; }
if(isset($_POST['new_publish_date'])){ $new_publish_date = $_POST['new_publish_date']; }
if(isset($_POST['new_published'])){ $new_published = $_POST['new_published']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['news_image'])){ $news_image = $_POST['news_image']; }
if(isset($_POST['new_news_cut'])){ $new_news_cut = $_POST['new_news_cut']; }
if(isset($_POST['new_access'])){ $new_access = $_POST['new_access']; }
if(isset($_POST['new_comments_en'])){ $new_comments_en = $_POST['new_comments_en']; }
if(isset($_POST['use_emoticons'])){ $use_emoticons = $_POST['use_emoticons']; }
if(isset($_POST['use_gravatar'])){ $use_gravatar = $_POST['use_gravatar']; }
if(isset($_POST['sender'])){ $sender = $_POST['sender']; }
if(isset($_POST['new_use_rss091'])){ $new_use_rss091 = $_POST['new_use_rss091']; }
if(isset($_POST['new_use_rss10'])){ $new_use_rss10 = $_POST['new_use_rss10']; }
if(isset($_POST['new_use_rss20'])){ $new_use_rss20 = $_POST['new_use_rss20']; }
if(isset($_POST['new_use_atom03'])){ $new_use_atom03 = $_POST['new_use_atom03']; }
if(isset($_POST['new_use_opml'])){ $new_use_opml = $_POST['new_use_opml']; }
if(isset($_POST['new_syn_amount'])){ $new_syn_amount = $_POST['new_syn_amount']; }
if(isset($_POST['new_use_syn_title'])){ $new_use_syn_title = $_POST['new_use_syn_title']; }
if(isset($_POST['new_def_feed'])){ $new_def_feed = $_POST['new_def_feed']; }
if(isset($_POST['new_use_trackback'])){ $new_use_trackback = $_POST['new_use_trackback']; }
if(isset($_POST['new_use_timesince'])){ $new_use_timesince = $_POST['new_use_timesince']; }
if(isset($_POST['new_readmore_link'])){ $new_readmore_link = $_POST['new_readmore_link']; }
if(isset($_POST['new_news_spacing'])){ $new_news_spacing = $_POST['new_news_spacing']; }
if(isset($_POST['new_sof'])){ $new_sof = $_POST['new_sof']; }





echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';

if($show_wysiwyg == 'tinymce'){
	include('../tcms_kernel/tcms_tinyMCE.lib.php');
	
	$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
	$tcms_tinyMCE->initTinyMCE();
	
	unset($tcms_tinyMCE);
}





//=====================================================
// INIT
//=====================================================

if(!isset($todo)){ $todo = 'show'; }

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;
$showAll   = false;

$arr_media['upload'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/images/Image');

if($choosenDB == 'xml'){ $arr_filename = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_news/'); }

if(!isset($minValue)){ $minValue = 0; }
if(!isset($maxValue)){ $maxValue = 10; }
if(!isset($thisValue)){ $thisValue = 10; }





//=====================================================
// CONFIG
//=====================================================

if($todo == 'config'){
	if($id_group == 'Developer' || $id_group == 'Administrator'){
		if(!isset($action)){ $action = 'news'; }
		
		if($choosenDB == 'xml'){
			$news_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml','r');
			
			$old_news_mm_id       = $news_xml->read_section('config', 'news_id');
			$old_news_mm_title    = $news_xml->read_section('config', 'news_title');
			$old_news_mm_stamp    = $news_xml->read_section('config', 'news_stamp');
			$old_news_mm_text     = $news_xml->read_section('config', 'news_text');
			$old_news_mm_image    = $news_xml->read_section('config', 'news_image');
			$old_news_mm_usec     = $news_xml->read_section('config', 'use_comments');
			$old_news_mm_usea     = $news_xml->read_section('config', 'show_autor');
			$old_news_mm_useal    = $news_xml->read_section('config', 'show_autor_as_link');
			$old_news_mm_amount   = $news_xml->read_section('config', 'news_amount');
			$old_news_mm_access   = $news_xml->read_section('config', 'access');
			$old_news_cut         = $news_xml->read_section('config', 'news_cut');
			$old_use_gravatar     = $news_xml->read_section('config', 'use_gravatar');
			$old_use_emoticons    = $news_xml->read_section('config', 'use_emoticons');
			$old_use_rss091       = $news_xml->read_section('config', 'use_rss091');
			$old_use_rss10        = $news_xml->read_section('config', 'use_rss10');
			$old_use_rss20        = $news_xml->read_section('config', 'use_rss20');
			$old_use_atom03       = $news_xml->read_section('config', 'use_atom03');
			$old_use_opml         = $news_xml->read_section('config', 'use_opml');
			$old_syn_amount       = $news_xml->read_section('config', 'syn_amount');
			$old_use_syn_title    = $news_xml->read_section('config', 'use_syn_title');
			$old_def_feed         = $news_xml->read_section('config', 'def_feed');
			$old_use_trackback    = $news_xml->read_section('config', 'use_trackback');
			$old_use_timesince    = $news_xml->read_section('config', 'use_timesince');
			$old_readmore_link    = $news_xml->read_section('config', 'readmore_link');
			$old_news_spacing     = $news_xml->read_section('config', 'news_spacing');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsmanager', 'newsmanager');
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$old_news_mm_id     = $sqlObj->news_id;
			$old_news_mm_title  = $sqlObj->news_title;
			$old_news_mm_stamp  = $sqlObj->news_stamp;
			$old_news_mm_text   = $sqlObj->news_text;
			$old_news_mm_image  = $sqlObj->news_image;
			$old_news_mm_usec   = $sqlObj->use_comments;
			$old_news_mm_usea   = $sqlObj->show_autor;
			$old_news_mm_useal  = $sqlObj->show_autor_as_link;
			$old_news_mm_amount = $sqlObj->news_amount;
			$old_news_mm_access = $sqlObj->access;
			$old_news_cut       = $sqlObj->news_cut;
			$old_use_gravatar   = $sqlObj->use_gravatar;
			$old_use_emoticons  = $sqlObj->use_emoticons;
			$old_use_rss091     = $sqlObj->use_rss091;
			$old_use_rss10      = $sqlObj->use_rss10;
			$old_use_rss20      = $sqlObj->use_rss20;
			$old_use_atom03     = $sqlObj->use_atom03;
			$old_use_opml       = $sqlObj->use_opml;
			$old_syn_amount     = $sqlObj->syn_amount;
			$old_use_syn_title  = $sqlObj->use_syn_title;
			$old_def_feed       = $sqlObj->def_feed;
			$old_use_trackback  = $sqlObj->use_trackback;
			$old_use_timesince  = $sqlObj->use_timesince;
			$old_readmore_link  = $sqlObj->readmore_link;
			$old_news_spacing   = $sqlObj->news_spacing;
			
			if($old_news_mm_id     == NULL){ $old_news_mm_id     = ''; }
			if($old_news_mm_title  == NULL){ $old_news_mm_title  = ''; }
			if($old_news_mm_stamp  == NULL){ $old_news_mm_stamp  = ''; }
			if($old_news_mm_text   == NULL){ $old_news_mm_text   = ''; }
			if($old_news_mm_image  == NULL){ $old_news_mm_image  = ''; }
			if($old_news_mm_usec   == NULL){ $old_news_mm_usec   = 0; }
			if($old_news_mm_usea   == NULL){ $old_news_mm_usea   = 0; }
			if($old_news_mm_useal  == NULL){ $old_news_mm_useal  = 0; }
			if($old_news_mm_amount == NULL){ $old_news_mm_amount = ''; }
			if($old_news_mm_access == NULL){ $old_news_mm_access = ''; }
			if($old_news_cut       == NULL){ $old_news_cut       = 0; }
			if($old_use_gravatar   == NULL){ $old_use_gravatar   = 0; }
			if($old_use_emoticons  == NULL){ $old_use_emoticons  = 0; }
			if($old_use_rss091     == NULL){ $old_use_rss091     = 0; }
			if($old_use_rss10      == NULL){ $old_use_rss10      = 0; }
			if($old_use_rss20      == NULL){ $old_use_rss20      = 0; }
			if($old_use_atom03     == NULL){ $old_use_atom03     = 0; }
			if($old_use_opml       == NULL){ $old_use_opml       = 0; }
			if($old_syn_amount     == NULL){ $old_syn_amount     = ''; }
			if($old_use_syn_title  == NULL){ $old_use_syn_title  = 0; }
			if($old_def_feed       == NULL){ $old_def_feed       = ''; }
			if($old_use_trackback  == NULL){ $old_use_trackback  = 0; }
			if($old_use_timesince  == NULL){ $old_use_timesince  = 0; }
			if($old_readmore_link  == NULL){ $old_readmore_link  = 0; }
			if($old_news_spacing   == NULL){ $old_news_spacing   = 0; }
		}
		
		
		if($action == 'news'){
			$old_news_mm_title = $tcms_main->decodeText($old_news_mm_title, '2', $c_charset);
			$old_news_mm_stamp = $tcms_main->decodeText($old_news_mm_stamp, '2', $c_charset);
			$old_news_mm_text  = $tcms_main->decodeText($old_news_mm_text, '2', $c_charset);
			
			$old_news_mm_title = htmlspecialchars($old_news_mm_title);
			$old_news_mm_stamp = htmlspecialchars($old_news_mm_stamp);
			$old_news_mm_text  = htmlspecialchars($old_news_mm_text);
			
			
			switch(trim($show_wysiwyg)){
				case 'tinymce':
					//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
					$old_news_mm_text = stripslashes($old_news_mm_text);
					break;
				
				case 'fckeditor':
					$old_news_mm_text = str_replace('src="', 'src="../../../../', $old_news_mm_text);
					$old_news_mm_text = str_replace('src="../../../../http:', 'src="http:', $old_news_mm_text);
					$old_news_mm_text = str_replace('src="../../../../https:', 'src="https:', $old_news_mm_text);
					$old_news_mm_text = str_replace('src="../../../../ftp:', 'src="ftp:', $old_news_mm_text);
					$old_news_mm_text = str_replace('src="../../../..//', 'src="/', $old_news_mm_text);
					break;
				
				default:
					$old_news_mm_text = ereg_replace('<br />'.chr(10), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br />'.chr(13), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br />', chr(13), $old_news_mm_text);
					
					$old_news_mm_text = ereg_replace('<br/>'.chr(10), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br/>'.chr(13), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br/>', chr(13), $old_news_mm_text);
					
					$old_news_mm_text = ereg_replace('<br>'.chr(10), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br>'.chr(13), chr(13), $old_news_mm_text);
					$old_news_mm_text = ereg_replace('<br>', chr(13), $old_news_mm_text);
					break;
			}
			
			
			if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
				//$old_news_mm_text = str_replace('src="', 'src="../../', $old_news_mm_text);
			}
		}
		else{
			if(trim($old_news_mm_text) != '')
				$old_news_mm_text = $tcms_main->encodeBase64($old_news_mm_text);
		}
		
		
		$arr_media = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/images/Image');
		
		
		// begin form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_news" method="post">'
		.'<input name="todo" type="hidden" value="save_config" />'
		.'<input name="extra" type="hidden" value="'.( $action == 'news' ? '1' : '0' ).'" />'
		.'<input name="_RELOCATE" id="_RELOCATE" type="hidden" value="0" />';
		
		
		echo '<script>
		var CHANGED = false;
		var RELOCATE = false;
		
		function checkChanges(target){
			if(CHANGED){
				var confirmSave = confirm("'._MSG_CHANGES.'\n'._MSG_SAVE_NOW.'");
				
				if(confirmSave == false){
					RELOCATE = false;
					document.getElementById(\'_RELOCATE\').value = \'0\';
					document.location = \'admin.php?id_user='.$id_user.'&site=mod_news&todo=config&action=\' + target;
				}
				else{
					RELOCATE = true;
					document.getElementById(\'_RELOCATE\').value = \'1\';
					save();
				}
			}
			else{
				RELOCATE = false;
				document.getElementById(\'_RELOCATE\').value = \'0\';
				document.location = \'admin.php?id_user='.$id_user.'&site=mod_news&todo=config&action=\' + target;
			}
		}
		</script>';
		
		echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
		.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
		.'<a'.( $action == 'news' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'news\');" href="#">'._TABLE_DESCRIPTION.'</a>'
		.'<a'.( $action == 'extra' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'extra\');" href="#">'._TABLE_SETTINGS.'</a>'
		.'</div>';
		
		echo '<div class="tcms_tabPage">'
		.'<br />';
		
		
		// table head
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table row
		if($action == 'news'){
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini">'
			.'<strong>'._EXT_NEWS.' '._TABLE_DESCRIPTION.'</strong></td></tr>'
			.'<tr><td colspan="2" style="height: 4px;"></td></tr>';
		}
		else{
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini">'
			.'<strong>'._EXT_NEWS.' '._TABLE_SETTINGS.'</strong></td></tr>';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_COMMENTS.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_comments" '.( $old_news_mm_usec == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_comments" value="'.$old_news_mm_usec.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_GRAVATAR.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="use_gravatar" '.( $old_use_gravatar == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="use_gravatar" value="'.$old_use_gravatar.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_EMOTICONS.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="use_emoticons" '.( $old_use_emoticons == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="use_emoticons" value="'.$old_use_emoticons.'" />';
		}
		
		
		// table row
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini">'._EXT_NEWS_DISPLAY.'</td>'
			.'<td><img src="../images/px.png" border="0" width="1" />'
			.'<select name="new_use_timesince" class="tcms_select">'
			.'<option value="0"'.( $old_use_timesince == '0' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_DATE.'</option>'
			.'<option value="1"'.( $old_use_timesince == '1' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_TIMESINCE.'</option>'
			.'<option value="2"'.( $old_use_timesince == '2' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_TEXT.'</option>'
			.'</select></td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_timesince" value="'.$old_use_timesince.'" />';
		}
		
		
		// table row
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini">'._EXT_NEWS_DISPLAY_MORE.'</td>'
			.'<td><img src="../images/px.png" border="0" width="1" />'
			.'<select name="new_readmore_link" class="tcms_select">'
			.'<option value="0"'.( $old_readmore_link == '0' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_LEFT.'</option>'
			.'<option value="1"'.( $old_readmore_link == '1' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_RIGHT.'</option>'
			.'<option value="2"'.( $old_readmore_link == '2' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_DIRECT.'</option>'
			.'</select></td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_timesince" value="'.$old_use_timesince.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_AUTOR.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_autor" '.( $old_news_mm_usea == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_autor" value="'.$old_news_mm_usea.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_AUTOR_LINK.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_autor_link" '.( $old_news_mm_useal == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_autor_link" value="'.$old_news_mm_useal.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_NEWSAMOUNT.'</td>'
			.'<td valign="top">'
			.'<input onchange="CHANGED = true;" name="new_news_mm_amount" class="tcms_input_small" value="'.$old_news_mm_amount.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_news_mm_amount" value="'.$old_news_mm_amount.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250" valign="top">'._FRONTPAGE_NEWS_CHARS.'</td>'
			.'<td valign="top">'
			.'<input onchange="CHANGED = true;" name="new_news_cut" class="tcms_id_box" value="'.$old_news_cut.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_news_cut" value="'.$old_news_cut.'" />';
		}
		
		
		// table rows
		if($action == 'news'){
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_ID.'</td>'
			.'<td valign="top">'
			.'<input onchange="CHANGED = true;" name="new_news_mm_id" readonly class="tcms_input_small" value="'.$old_news_mm_id.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_news_mm_id" value="'.$old_news_mm_id.'" />';
		}
		
		
		// table row
		if($action == 'news'){
			echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
			.'<td>'
			.'<select name="news_mm_access" class="tcms_select">'
			.'<option value="Public"'.( $old_news_mm_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected"'.( $old_news_mm_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
			.'<option value="Private"'.( $old_news_mm_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
			.'</select></td></tr>';
		}
		else{
			echo '<input type="hidden" name="news_mm_access" value="'.$old_news_mm_access.'" />';
		}
		
		
		// table rows
		if($action == 'news'){
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_TITLE.'</td>'
			.'<td valign="top">'
			.'<input onchange="CHANGED = true;" name="news_mm_title" class="tcms_input_normal" value="'.$old_news_mm_title.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="news_mm_title" value="'.$old_news_mm_title.'" />';
		}
		
		
		// table rows
		if($action == 'news'){
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SUBTITLE.'</td>'
			.'<td valign="top">'
			.'<input onchange="CHANGED = true;" name="news_mm_stamp" class="tcms_input_normal" value="'.$old_news_mm_stamp.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="news_mm_stamp" value="'.$old_news_mm_stamp.'" />';
		}
		
		
		// table rows
		if($action == 'news'){
			echo '<tr><td valign="top" colspan="2"><br />'._TABLE_TEXT
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
				echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'.$old_news_mm_text.'</textarea>';
			}
			elseif($show_wysiwyg == 'fckeditor'){
				$sBasePath = '../js/FCKeditor/';
				
				$oFCKeditor = new FCKeditor('content') ;
				$oFCKeditor->BasePath = $sBasePath;
				$oFCKeditor->Value = $old_news_mm_text;
				$oFCKeditor->Create();
			}
			else{
				echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'.$old_news_mm_text.'</textarea>';
			}
			
			echo '<br /></td></tr>';
		}
		else{
			echo '<input type="hidden" name="content" value="'.$old_news_mm_text.'" />';
		}
		
		
		// table row
		if($action == 'news'){
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_IMAGE.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="button" name="tcms" value="'._TCMSSCRIPT_IMAGES.'" onclick="window.open(\'media.php?id_user='.$id_user.'&v=news_config\', \'ImageBrowser\', \'width=400,height=500,left=50,top=50,scrollbars=yes\');" />'
			.'<input onchange="CHANGED = true;" type="button" name="tcms" value="'._EXT_NEWS_DESELECT.'" onclick="document.getElementById(\'news_mm_image\').src=\'\';document.getElementById(\'news_tt_image\').value=\'\';document.getElementById(\'news_mm_image\').style.visibility=\'hidden\';" />'
			.'<br />';
			
			if(isset($new_news_mm_image)){ $old_news_mm_image = $new_news_mm_image; }
			
			echo '<img width="100"'.( $old_news_mm_image == '' ? ' style="visibility:hidden;"' : '' ).' id="news_mm_image" src="../../'.$tcms_administer_site.'/images/Image/'.$old_news_mm_image.'" border="0" />'
			.'<input onchange="CHANGED = true;" name="news_mm_image" id="news_tt_image" value="'.$old_news_mm_image.'" type="hidden" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="news_mm_image" value="'.$old_news_mm_image.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_NEWS_SPACING.' (px)</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="text" class="tcms_id_box" name="new_news_spacing" value="'.$old_news_spacing.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_news_spacing" value="'.$old_news_spacing.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_TRACKBACK.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_trackback" '.( $old_use_trackback == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_trackback" value="'.$old_use_trackback.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_SYN_TITLE.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_syn_title" '.( $old_use_syn_title == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_syn_title" value="'.$old_use_syn_title.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS091.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_rss091" '.( $old_use_rss091 == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_rss091" value="'.$old_use_rss091.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS10.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_rss10" '.( $old_use_rss10 == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_rss10" value="'.$old_use_rss10.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS20.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_rss20" '.( $old_use_rss20 == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_rss20" value="'.$old_use_rss20.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_ATOM03.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_atom03" '.( $old_use_atom03 == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_atom03" value="'.$old_use_atom03.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_OPML.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_opml" '.( $old_use_opml == 1 ? 'checked="checked"' : '' ).' value="1" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_use_opml" value="'.$old_use_opml.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[1].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_AMOUNT.'</td>'
			.'<td>'
			.'<input onchange="CHANGED = true;" class="tcms_id_box" name="new_syn_amount" value="'.$old_syn_amount.'" />'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_syn_amount" value="'.$old_syn_amount.'" />';
		}
		
		
		// table rows
		if($action == 'extra'){
			echo '<tr style="background: '.$arr_color[0].';">'
			.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_DEFAULT_FEED.'</td>'
			.'<td>'
			.'<select name="new_def_feed" class="tcms_select">'
				.'<option value="RSS0.91"'.( $old_def_feed == 'RSS0.91' ? ' selected="selected"' : '' ).'>RSS 0.91</option>'
				.'<option value="RSS1.0"'.( $old_def_feed == 'RSS1.0' ? ' selected="selected"' : '' ).'>RSS 1.0</option>'
				.'<option value="RSS2.0"'.( $old_def_feed == 'RSS2.0' ? ' selected="selected"' : '' ).'>RSS 2.0</option>'
				.'<option value="AT0M0.3"'.( $old_def_feed == 'ATOM0.3' ? ' selected="selected"' : '' ).'>Atom 0.3</option>'
				.'<option value="OPML"'.( $old_def_feed == 'OPML' ? ' selected="selected"' : '' ).'>OPML</option>'
			.'</select>'
			.'</td></tr>';
		}
		else{
			echo '<input type="hidden" name="new_def_feed" value="'.$old_def_feed.'" />';
		}
		
		
		// Table end
		echo '</table>'
		.'<br />'
		.'</div>'
		.'</form>';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





//=====================================================
// VALUES
//=====================================================

if($todo == 'show'){
	echo tcms_html::bold(_NEWS_TITLE);
	echo tcms_html::text(_NEWS_TEXT.'<br /><br />', 'left');
	
	if($choosenDB == 'xml'){
		if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
			$count = 0;
			
			foreach($arr_filename as $key => $value){
				$main_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$value,'r');
				$chk_autor = $main_xml->read_value('autor');
				
				if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
					$showAll = true;
				}
				else{
					if($chk_autor == $id_username){ $showAll = true; }
					else{ $showAll = false; }
				}
				
				if($showAll == true){
					$arr_news['title'][$count] = $main_xml->read_value('title');
					$arr_news['date'][$count]  = $main_xml->read_value('date');
					$arr_news['time'][$count]  = $main_xml->read_value('time');
					$arr_news['order'][$count] = $main_xml->read_value('order');
					$arr_news['stamp'][$count] = $main_xml->read_value('stamp');
					$arr_news['pub'][$count]   = $main_xml->read_value('published');
					$arr_news['cmt'][$count]   = $main_xml->read_value('comments_enabled');
					$arr_news['acc'][$count]   = $main_xml->read_value('access');
					$arr_news['autor'][$count] = $main_xml->read_value('autor');
					$arr_news['sof'][$count]   = $main_xml->read_value('show_on_frontpage');
					
					if(!$arr_news['title'][$count]){ $arr_news['title'][$count] = ''; }
					if(!$arr_news['date'][$count]) { $arr_news['date'][$count]  = ''; }
					if(!$arr_news['time'][$count]) { $arr_news['time'][$count]  = ''; }
					if(!$arr_news['order'][$count]){ $arr_news['order'][$count] = ''; }
					if(!$arr_news['stamp'][$count]){ $arr_news['stamp'][$count] = ''; }
					if(!$arr_news['pub'][$count])  { $arr_news['pub'][$count]   = ''; }
					if(!$arr_news['cmt'][$count])  { $arr_news['cmt'][$count]   = ''; }
					if(!$arr_news['acc'][$count])  { $arr_news['acc'][$count]   = ''; }
					if(!$arr_news['autor'][$count]){ $arr_news['autor'][$count] = ''; }
					//if(!$arr_news['sof'][$count])  { $arr_news['sof'][$count]   = 1; }
					
					// CHARSETS
					$arr_news['title'][$count] = $tcms_main->decodeText($arr_news['title'][$count], '2', $c_charset);
					$arr_news['autor'][$count] = $tcms_main->decodeText($arr_news['autor'][$count], '2', $c_charset);
					
					$count++;
				}
				
				$showAll = false;
			}
		}
		
		$sqlNr = $count;
		
		if($arr_news && is_array($arr_news)){
			array_multisort(
				$arr_news['stamp'], SORT_DESC, 
				$arr_news['date'], SORT_DESC, 
				$arr_news['time'], SORT_DESC, 
				$arr_news['title'], SORT_DESC, 
				$arr_news['pub'], SORT_DESC, 
				$arr_news['cmt'], SORT_DESC, 
				$arr_news['order'], SORT_DESC, 
				$arr_news['autor'], SORT_DESC, 
				$arr_news['acc'], SORT_DESC, 
				$arr_news['sof'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
			$strAdd = "";
		}
		else{
			$strAdd = "AND ( autor = '".$id_username."' OR autor = '".$id_name."' ) ";
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."news "
		."WHERE NOT (uid IS NULL) "
		.$strAdd
		."ORDER BY stamp DESC, date DESC, time DESC";
		
		$sqlQR = $sqlAL->sqlQuery($sqlSTR);
		$sqlNr = $sqlAL->sqlGetNumber($sqlQR);
		
		$count = 0;
		
		while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
			$arr_news['order'][$count] = $sqlObj->uid;
			$arr_news['title'][$count] = $sqlObj->title;
			$arr_news['date'][$count]  = $sqlObj->date;
			$arr_news['time'][$count]  = $sqlObj->time;
			$arr_news['stamp'][$count] = $sqlObj->stamp;
			$arr_news['pub'][$count]   = $sqlObj->published;
			$arr_news['cmt'][$count]   = $sqlObj->comments_enabled;
			$arr_news['acc'][$count]   = $sqlObj->access;
			$arr_news['autor'][$count] = $sqlObj->autor;
			$arr_news['sof'][$count]   = $sqlObj->show_on_frontpage;
			
			if($arr_news['order'][$count] == NULL){ $arr_news['order'][$count] = ''; }
			if($arr_news['title'][$count] == NULL){ $arr_news['title'][$count] = ''; }
			if($arr_news['date'][$count]  == NULL){ $arr_news['date'][$count]  = ''; }
			if($arr_news['time'][$count]  == NULL){ $arr_news['time'][$count]  = ''; }
			if($arr_news['stamp'][$count] == NULL){ $arr_news['stamp'][$count] = ''; }
			if($arr_news['cmt'][$count]   == NULL){ $arr_news['cmt'][$count]   = ''; }
			if($arr_news['acc'][$count]   == NULL){ $arr_news['acc'][$count]   = ''; }
			if($arr_news['autor'][$count] == NULL){ $arr_news['autor'][$count] = ''; }
			if($arr_news['sof'][$count]   == NULL){ $arr_news['sof'][$count]   = 1; }
			
			// CHARSETS
			$arr_news['title'][$count] = $tcms_main->decodeText($arr_news['title'][$count], '2', $c_charset);
			$arr_news['autor'][$count] = $tcms_main->decodeText($arr_news['autor'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="10%" colspan="2">'._TABLE_DATE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="55%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_COMMENTS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="center">'._TABLE_FRONTPAGE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="center">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th>'
		.'<tr>';
	
	if(isset($arr_news['stamp']) && !empty($arr_news['stamp']) && $arr_news['stamp'] != ''){
		$count = -1;
		
		foreach($arr_news['stamp'] as $key => $value){
			$count++;
			
			if($key >= $minValue && $key < $maxValue){
				if($id_group == 'Developer' 
				|| $id_group == 'Administrator') {
					$showAll = true;
				}
				else {
					if($arr_news['acc'][$key] == 'Public' 
					|| $arr_news['acc'][$key] == 'Protected') {
						$showAll = true;
					}
					else {
						$showAll = false;
					}
				}
				//}
				
				if($showAll == true){
					$bgkey++;
					
					if(is_integer($bgkey/2)) $ws_farbe = $arr_farbe[0];
					else $ws_farbe = $arr_farbe[1];
					
					$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arr_news['order'][$key].'\';"';
					
					echo '<tr height="25" id="row'.$count.'" '
					.'bgcolor="'.$ws_farbe.'" '
					.'onMouseOver="wxlBgCol(\'row'.$count.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$count.'\',\''.$ws_farbe.'\')">';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
					.'<img src="../images/news.gif" border="0" />'
					.'</td>';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
					.( !$tcms_main->isReal($arr_news['date'][$count]) ? '&nbsp;' : $arr_news['date'][$count] )
					.'</td>';
					
					echo '<td class="tcms_db_2"'.$strJS.'>'
					.( !$tcms_main->isReal($arr_news['title'][$count]) ? '&nbsp;' : $arr_news['title'][$count] )
					.'</td>';
					
					echo '<td class="tcms_db_2"'.$strJS.'>'
					.( !$tcms_main->isReal($arr_news['autor'][$count]) ? '&nbsp;' : $arr_news['autor'][$count] )
					.'</td>';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
					.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=publishItem&amp;action='.( $arr_news['pub'][$count] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_news['order'][$count].'">'
					.( $arr_news['pub'][$count] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a>'
					.'</td>';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
					.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=enableComments&amp;action='.( $arr_news['cmt'][$count] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_news['order'][$count].'">'
					.( $arr_news['cmt'][$count] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a>'
					.'</td>';
					
					echo '<td align="center" class="tcms_db_2"'.$strJS.'>'
					.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=enableFrontpage&amp;action='.( $arr_news['sof'][$count] == 1 ? 'off' : 'on' ).'&amp;maintag='.$arr_news['order'][$count].'">'
					.( $arr_news['sof'][$count] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' )
					.'</a>'
					.'</td>';
					
					echo '<td class="tcms_db_2" align="center" style="color: '.( $arr_news['acc'][$count] == 'Public' ? '#008800' : '#ff0000' ).';"'.$strJS.'>'.$arr_news['acc'][$count].'</td>';
					
					echo '<td class="tcms_db_2" align="right">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arr_news['order'][$count].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=delete&amp;maintag='.$arr_news['order'][$count].'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.'</td>';
					
					echo '</tr>';
				}
			}
			
			$morePages = count($arr_news['stamp']);
		}
		
		
		
		echo '<tr class="tcms_bg_blue_01">'
		.'<td height="18" align="center" class="tcms_db_title tcms_padding_mini" colspan="9"'
		.'<strong>';
		
		if($minValue > 0 || $maxValue == $morePages){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;thisValue='.$thisValue.'">&laquo; '._TABLE_START.'</a>';
		}
		else{ echo '&laquo; '._TABLE_START; }
		
		
		echo '&nbsp;';
		
		
		if($minValue > 0){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;thisValue='.$thisValue.'&amp;minValue='.( $minValue - $thisValue ).'&amp;maxValue='.( $maxValue - $thisValue ).'">&#8249; '._TABLE_PREVIOUS.'</a>';
		}
		else{ echo '&#8249; '._TABLE_PREVIOUS; }
		
		
		echo '&nbsp;|&nbsp;';
		
		echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;thisValue='.$thisValue.'&amp;minValue=0&amp;maxValue='.$morePages.'">'._NEWS_ALL.'</a>';
		
		echo '&nbsp;|&nbsp;';
		
		
		if($morePages > $maxValue){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;thisValue='.$thisValue.'&amp;minValue='.( $minValue + $thisValue ).'&amp;maxValue='.( $maxValue + $thisValue ).'">'._TABLE_NEXT.' &#8250;</a>';
		}
		else{ echo _TABLE_NEXT.' &#8250;'; }
		
		
		echo '&nbsp;';
		
		
		if($morePages > $maxValue){
			if(strlen($morePages) < 3){
				$tmpmorePages = $morePages / 10;
			}
			elseif(strlen($morePages)== 3){
				$tmpmorePages = $morePages / 100;
			}
			else{
				$tmpmorePages = $morePages / 100;
			}
			
			$tmpmorePages = round($tmpmorePages);
			$tmpmorePages = ( strlen($tmpmorePages) == 1 ? $tmpmorePages.'0' : $tmpmorePages );
			
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;thisValue='.$thisValue.'&amp;minValue='.( $tmpmorePages ).'&amp;maxValue='.( $tmpmorePages + $thisValue ).'">'._TABLE_END.' &raquo;</a>';
		}
		else{ echo _TABLE_END.' &raquo;'; }
		
		echo '</strong></td></tr>';
	}
	
	echo '</table><br />';
	
	
	echo '<div align="center">';
	
	echo _TABLE_DISPLAY.' <select name="displayAmount" class="tcms_select_day" '
	.'onchange="document.location=\'admin.php?id_user='.$id_user.'&site=mod_news&maxValue=\' + this.value + \'&thisValue=\' + this.value;">'
	.'<option '.( $thisValue == '5' ? 'selected="selected" ' : '' ).'value="5">5</option>'
	.'<option '.( $thisValue == '10' ? 'selected="selected" ' : '' ).'value="10">10</option>'
	.'<option '.( $thisValue == '15' ? 'selected="selected" ' : '' ).'value="15">15</option>'
	.'<option '.( $thisValue == '20' ? 'selected="selected" ' : '' ).'value="20">20</option>'
	.'<option '.( $thisValue == '25' ? 'selected="selected" ' : '' ).'value="25">25</option>'
	.'<option '.( $thisValue == '30' ? 'selected="selected" ' : '' ).'value="30">30</option>'
	.'<option '.( $thisValue == '50' ? 'selected="selected" ' : '' ).'value="50">50</option>'
	.'</select> '._TABLE_A_PAGE;
	
	echo '&nbsp;|&nbsp;';
	
	echo ($minValue + 1).' - '.$maxValue.' '._TABLE_OF.' '.$morePages;
	
	echo '</div>';
}





//=====================================================
// EDIT AND CREATE FORM
//=====================================================

if($todo == 'edit'){
	$canEdit = true;
	
	if(isset($maintag)){
		if($choosenDB == 'xml'){
			$main_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml','r');
			$nws_autor        = $main_xml->read_value('autor');
			
			if($id_group != 'Developer' && $id_group != 'Administrator'){
				if($nws_autor != $id_username && $$nws_autor != $id_name)
					$canEdit = false;
				else
					$canEdit = true;
			}
			
			if($canEdit){
				$nws_title        = $main_xml->read_value('title');
				$nws_date         = $main_xml->read_value('date');
				$nws_time         = $main_xml->read_value('time');
				$nws_news         = $main_xml->read_value('newstext');
				$nws_order        = $main_xml->read_value('order');
				$nws_stamp        = $main_xml->read_value('stamp');
				$nws_published    = $main_xml->read_value('published');
				$nws_publish_date = $main_xml->read_value('publish_date');
				$nws_comments_en  = $main_xml->read_value('comments_enabled');
				$nws_image        = $main_xml->read_value('image');
				$nws_cat          = $main_xml->read_value('category');
				$nws_access       = $main_xml->read_value('access');
				$nws_sof          = $main_xml->read_value('show_on_frontpage');
				
				if(!$nws_title)       { $nws_title        = ''; }
				if(!$nws_autor)       { $nws_autor        = ''; }
				if(!$nws_date)        { $nws_date         = ''; }
				if(!$nws_time)        { $nws_time         = ''; }
				if(!$nws_news)        { $nws_news         = ''; }
				if(!$nws_order)       { $nws_order        = ''; }
				if(!$nws_published)   { $nws_published    = ''; }
				if(!$nws_publish_date){ $nws_publish_date = ''; }
				if(!$nws_comments_en) { $nws_comments_en  = ''; }
				if(!$nws_image)       { $nws_image        = ''; }
				if(!$nws_cat)         { $nws_cat          = ''; }
				if(!$nws_access)      { $nws_access       = ''; }
				//if(!$nws_sof)         { $nws_sof          = ''; }
				
				if($nws_cat != ''){
					$arr_cat = explode('{###}', $nws_cat);
				}
				else{
					$globals_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
					$old_default_cat = $globals_xml->read_section('global', 'default_category');
					
					$arr_cat[0] = $old_default_cat;
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($id_group == 'Developer' || $id_group == 'Administrator')
				$strAdd = "";
			else
				$strAdd = "AND ( autor = '".$id_username."' OR autor = '".$id_name."' ) ";
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."news "
			."WHERE uid = '".$maintag."' "
			.$strAdd;
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($id_group != 'Developer' || $id_group != 'Administrator'){
				if($sqlNR == 0)
					$canEdit = false;
				else
					$canEdit = true;
			}
			
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$nws_title        = $sqlObj->title;
			$nws_autor        = $sqlObj->autor;
			$nws_date         = $sqlObj->date;
			$nws_time         = $sqlObj->time;
			$nws_news         = $sqlObj->newstext;
			$nws_order        = $sqlObj->uid;
			$nws_stamp        = $sqlObj->stamp;
			$nws_published    = $sqlObj->published;
			$nws_publish_date = $sqlObj->publish_date;
			$nws_comments_en  = $sqlObj->comments_enabled;
			$nws_image        = $sqlObj->image;
			$nws_access       = $sqlObj->access;
			$nws_sof          = $sqlObj->show_on_frontpage;
			
			if($nws_title        == NULL){ $nws_title        = ''; }
			if($nws_autor        == NULL){ $nws_autor        = ''; }
			if($nws_date         == NULL){ $nws_date         = ''; }
			if($nws_time         == NULL){ $nws_time         = ''; }
			if($nws_news         == NULL){ $nws_news         = ''; }
			if($nws_order        == NULL){ $nws_order        = ''; }
			if($nws_stamp        == NULL){ $nws_stamp        = ''; }
			if($nws_published    == NULL){ $nws_published    = ''; }
			if($nws_publish_date == NULL){ $nws_publish_date = ''; }
			if($nws_comments_en  == NULL){ $nws_comments_en  = ''; }
			if($nws_image        == NULL){ $nws_image        = ''; }
			if($nws_access       == NULL){ $nws_access       = ''; }
			if($nws_sof          == NULL){ $nws_sof          = ''; }
			
			
			unset($sqlARR);
			unset($sqlQR);
			
			
			$strSQL = "SELECT * "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.cat_uid = ".$tcms_db_prefix."news_categories.uid) "
			."WHERE (".$tcms_db_prefix."news_to_categories.news_uid = '".$maintag."')";
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_cat[$count] = $sqlARR['cat_uid'];
				
				if($arr_cat[$count] == NULL){ $arr_cat[$count] = ''; }
				
				$count++;
			}
			
			$dbDo = 'save';
		}
		
		// CHARSETS
		$nws_title = $tcms_main->decodeText($nws_title, '2', $c_charset);
		$nws_autor = $tcms_main->decodeText($nws_autor, '2', $c_charset);
		$nws_news  = $tcms_main->decodeText($nws_news, '2', $c_charset);
		
		$nws_title = htmlspecialchars($nws_title);
		$nws_autor = htmlspecialchars($nws_autor);
		
		echo tcms_html::bold(_TABLE_EDIT);
		$edit_add_news = _NEWS_NEW_CURRENT;
		$odot = 'save';
	}
	else{
		$maintag = $tcms_main->getNewUID(10, 'news');
		
		$nws_title        = '';
		$nws_autor        = '';
		$nws_date         = '';
		$nws_time         = '';
		$nws_news         = '';
		$nws_order        = $maintag;
		$nws_stamp        = '';
		$nws_published    = 1;
		$nws_publish_date = '';
		$nws_comments_en  = 1;
		$nws_image        = '';
		$nws_cat          = '';
		$nws_access       = 'Public';
		$nws_sof          = 1;
		
		echo tcms_html::bold(_TABLE_NEW);
		$edit_add_news = _NEWS_EDIT_CURRENT;
		$odot = 'next';
	}
	
	
	if($canEdit){
		if($show_wysiwyg == 'tinymce'){
			$nws_news = stripslashes($nws_news);
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$nws_news = str_replace('src="', 'src="../../../../', $nws_news);
			$nws_news = str_replace('src="../../../../http:', 'src="http:', $nws_news);
			$nws_news = str_replace('src="../../../../https:', 'src="https:', $nws_news);
			$nws_news = str_replace('src="../../../../ftp:', 'src="ftp:', $nws_news);
			$nws_news = str_replace('src="../../../..//', 'src="/', $nws_news);
		}
		else{
			$nws_news = ereg_replace('<br />'.chr(10), chr(13), $nws_news);
			$nws_news = ereg_replace('<br />'.chr(13), chr(13), $nws_news);
			$nws_news = ereg_replace('<br />', chr(13), $nws_news);
			
			$nws_news = ereg_replace('<br/>'.chr(10), chr(13), $nws_news);
			$nws_news = ereg_replace('<br/>'.chr(13), chr(13), $nws_news);
			$nws_news = ereg_replace('<br/>', chr(13), $nws_news);
			
			$nws_news = ereg_replace('<br>'.chr(10), chr(13), $nws_news);
			$nws_news = ereg_replace('<br>'.chr(13), chr(13), $nws_news);
			$nws_news = ereg_replace('<br>', chr(13), $nws_news);
		}
		
		
		if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
			//$nws_news = str_replace('src="', 'src="../../', $nws_news);
		}
		
		
		if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
		else{
			if($nws_access == 'Public' || $nws_access == 'Protected'){ $showAll = true; }
			else{ $showAll = false; }
		}
		
		
		if($showAll == true){
			if(!isset($nws_image) || $nws_image == '' || empty($nws_image) || !strpos($nws_image, '.')){ $nws_image = 'system/toendacms.png'; }
			$width = '150';
			
			
			echo tcms_html::text(_NEWS_EDIT_CURRENT.'<br /><br />', 'left');
			
			
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_news" method="post" id="news">'
			.'<input name="todo" type="hidden" value="'.$odot.'" />'
			.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
			.'<input name="stamp" type="hidden" value="'.$nws_stamp.'" />'
			.'<input name="order" type="hidden" value="'.$maintag.'" />';
			
			
			
			// table header
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">'
			.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
			.'</tr></table>';
			
			
			
			// table begin
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
			.'<td valign="top"><input class="tcms_input_normal" name="titel" type="text" value="'.$nws_title.'" /></td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_AUTOR.'</strong></td>'
			.'<td valign="top"><select class="tcms_select" name="autor">';
			
			if($id_group == 'Developer' || $id_group == 'Administrator'){
				echo '<optgroup label="'._USER_SELF.'">'
				.'<option value="'.$id_username.'"'.( $nws_autor == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $nws_autor == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>'
				.'</optgroup>'
				.'<optgroup label="'._USER_ALL.'">';
				
				foreach($arrActiveUser['user'] as $key => $value){
					echo '<option value="'.$value.'"'.( $nws_autor == $value ? ' selected="selected"' : '').'>'.$value.'</option>';
				}
				
				echo '</optgroup>';
			}
			else{
				echo '<option value="'.$id_username.'"'.( $nws_autor == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $nws_autor == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>';
				
				if(isset($nws_autor) && $nws_autor != '' && ($nws_autor != $id_username && $nws_autor != $id_name)){
					echo '<option value="'.$nws_autor.'" selected="selected">'.$nws_autor.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._NEWS_TIME.' / '._NEWS_DATE.'</strong></td>'
			.'<td valign="top"><input class="tcms_id_box" id="new_time" name="new_time" type="text" value="'.( $nws_time == '' ? date('H:i') : $nws_time ).'" onchange="JSAjax.ajaxChangeDateTime(this.id, this.value);" />'
			.'&nbsp;'
			.'<input class="tcms_input_mini" name="new_date" id="new_date" type="text" value="'.( $nws_date == '' ? date('d.m.Y') : $nws_date ).'" onchange="JSAjax.ajaxChangeDateTime(this.id, this.value);" />'
			.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDate" />'
			.'</td></tr>';
			
			echo '<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "new_date",
			        ifFormat       :    "%d.%m.%Y",
			        showsTime      :    false,
			        button         :    "triggerButtonDate",
			        singleClick    :    false,
			        step           :    1
			    });
			</script>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHING.'</strong></td>'
			.'<td valign="top"><input class="tcms_input_small" id="new_publish_date" name="new_publish_date" type="text" value="'.( $nws_publish_date == '' ? date('d.m.Y-H:i') : $nws_publish_date ).'" onchange="JSAjax.ajaxChangeDateTime(\'new_publish_date\', this.value);" />'
			.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDateTime" />'
			.'</td></tr>';
			
			echo '<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "new_publish_date",
			        ifFormat       :    "%d.%m.%Y-%H:%M",
			        showsTime      :    true,
			        timeFormat     :    24,
			        button         :    "triggerButtonDateTime",
			        singleClick    :    false,
			        step           :    1
			    });
			</script>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
			.'<td valign="top"><input name="new_published" value="1" type="checkbox"'.( $nws_published == 1 ? ' checked="checked"' : '' ).' />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_COMMENTS.'</strong></td>'
			.'<td valign="top"><input name="new_comments_en" value="1" type="checkbox"'.( $nws_comments_en == 1 ? ' checked="checked"' : '' ).' />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._NEWS_SHOW_ON_FRONTPAGE.'</strong></td>'
			.'<td valign="top"><input name="new_sof" value="1" type="checkbox"'.( $nws_sof == 1 ? ' checked="checked"' : '' ).' />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
			.'<td valign="top">'
			.'<select name="new_access" class="tcms_select">'
				.'<option value="Public"'.( $nws_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected"'.( $nws_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>';
				if($id_group == 'Developer' || $id_group == 'Administrator'){
					echo '<option value="Private"'.( $nws_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>';
				}
			echo '</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" colspan="3"><br /><strong class="tcms_bold">'._NEWS_MAINTEXT.' ('._NEWS_ID.': '.$maintag.')</strong>'
			.'<br /><br />'
			.'<script>createToendaToolbar(\'news\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>'
			.'<script>createToendaHelpButton(\''.$tcms_lang.'\', \''._NEWS_IMAGE_HELP
			.( $show_wysiwyg == 'fckeditor' ? '<br /><br /><strong>'._TCMSSCRIPT_MORE.': {tcms_more}</strong>' : '' )
			.'\');</script>';
			
			if($show_wysiwyg == 'tinymce'){ }
			elseif($show_wysiwyg == 'fckeditor'){ }
			else{
				if($show_wysiwyg == 'toendaScript'){ echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'toendaScript\');</script>'; }
				else{ echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'HTML\');</script>'; }
			}
			
			echo '<br /><br />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" colspan="2">';
			
			if($show_wysiwyg == 'tinymce'){
				echo '<textarea cols="75" rows="50" class="tcms_textarea_huge" style="width: 100%;" id="content" name="content" mce_editable="true">'
				.$nws_news
				.'</textarea>';
				//mce_editable="true"
			}
			elseif($show_wysiwyg == 'fckeditor'){
				$sBasePath = '../js/FCKeditor/';
				
				$oFCKeditor = new FCKeditor('content') ;
				$oFCKeditor->BasePath = $sBasePath;
				
				$oFCKeditor->Value = $nws_news;
				$oFCKeditor->Create();
			}
			else{
				?>
				<script language="JavaScript" type="text/javascript">
				function contentResizer(id){
					if(document.layers){
						document.layers[0].left = id.pageX;
						document.layers[0].top = id.pageY;
					}
					else if(document.getElementById){
						//document.getElementById('content_body').style.width = id.pageX + "px";
						//if(document.getElementById('content_body').style.height > 20)
							document.getElementById('content_body').style.height = ( id.pageY - 450 ) + "px";
					}
				}
				
				//document.getElementById('content_resizer').onmouseover = contentResizer;
				//document.onmouseover = contentResizer;
				</script>
				<!--<style type="text/css">
				div.ebene {
				  position: relative;
				  width: 100%;
				  height: 200px;
				  visibility: visible;
				}
				</style>-->
				<?
				echo '<div class="ebene" id="content_body">'
				.'<textarea class="tcms_textarea_huge" title="This is tooltip text 1" id="content" name="content">'.$nws_news.'</textarea>'
				.'</div>'
				.'<div class="tcms_textarea_bottom" onmousedown="contentResizer(\'content\');" id="content_resizer"></div>';
			}
			
			echo '<br /><br />'
			.'</td>';
			
			
			// table row
			echo '<td width="250" valign="top">'
			.'<div style="width: 200px; overflow: auto; border: 0px solid #fff; padding: 3px;">'
			.'<fieldset><legend><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></legend>'
			.'<br />';
			
			$globals_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
			$old_default_cat = $globals_xml->read_section('global', 'default_category');
			
			foreach($arrNewsCat['tag'] as $key => $value){
				$checkME = false;
				
				if(!empty($arr_cat)){
					foreach($arr_cat as $ckey => $cval){
						if($cval == $value){ $checkME = true; }
					}
				}
				else{
					if($old_default_cat == $value){ $checkME = true; }
					else{ $checkME = false; }
				}
				
				echo '<div class="tcms_switchcolor_4" style="margin: 0; padding: 0 0 4px 0;" onmouseover="this.style.background=\''.$arr_farbe[1].'\';" onmouseout="this.style.background=\''.$arr_farbe[0].'\';">'
				.'<label for="new_cat_'.$key.'">'
				.'<input type="checkbox" style="margin: 0 0 0px 0 !important;" id="new_cat_'.$key.'" name="new_cat_'.$key.'" value="'.$value.'"'.( $checkME == true ? ' checked="checked"' : '' ).' />'
				.'&nbsp;'.$arrNewsCat['name'][$key]
				.'</label>'
				.'</div>';
				
				$catAmount = $key;
			}
			echo '</fieldset>'
			.'</div>'
			.'</td></tr>';
			//.'<br /><br />'
			
			
			// tabel end
			echo '</table>';
			
			/*
				END
			*/
			
			
			echo '</form>';
		}
		else{
			echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
		}
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





//=====================================================
// SAVE CONFIG
//=====================================================

if($todo == 'save_config'){
	if(empty($new_use_comments))  { $new_use_comments   = 0; }
	if(empty($new_use_autor))     { $new_use_autor      = 0; }
	if(empty($new_use_autor_link)){ $new_use_autor_link = 0; }
	if(empty($use_emoticons))     { $use_emoticons      = 0; }
	if(empty($use_gravatar))      { $use_gravatar       = 0; }
	if(empty($new_use_feeds))     { $new_use_feeds      = 0; }
	if(empty($new_use_rss091))    { $new_use_rss091     = 0; }
	if(empty($new_use_rss10))     { $new_use_rss10      = 0; }
	if(empty($new_use_rss20))     { $new_use_rss20      = 0; }
	if(empty($new_use_atom03))    { $new_use_atom03     = 0; }
	if(empty($new_news_cut))      { $new_news_cut       = 0; }
	if(empty($new_use_opml))      { $new_use_opml       = 0; }
	if(empty($new_syn_amount))    { $new_syn_amount     = 0; }
	if(empty($new_use_syn_title)) { $new_use_syn_title  = 0; }
	if($new_news_mm_amount == '') { $new_news_mm_amount = 20; }
	if(empty($new_news_mm_id))    { $new_news_mm_id     = $old_news_mm_id; }
	if($news_mm_title == '')      { $news_mm_title      = ''; }
	if($news_mm_stamp == '')      { $news_mm_stamp      = ''; }
	if($new_def_feed  == '')      { $new_def_feed       = 'RSS0.91'; }
	if(empty($new_use_trackback)) { $new_use_trackback  = 0; }
	if(empty($new_use_timesince)) { $new_use_timesince  = 0; }
	if(empty($new_readmore_link)) { $new_readmore_link  = 0; }
	
	
	// CHARSETS
	if($extra == 1){
		$content = str_replace('src="../../../../http:', 'src="http:', $content);
		
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
		
		$news_mm_title = $tcms_main->encodeText($news_mm_title, '2', $c_charset);
		$news_mm_stamp = $tcms_main->encodeText($news_mm_stamp, '2', $c_charset);
		$content = $tcms_main->encodeText($content, '2', $c_charset);
	}
	else{
		$content = $tcms_main->decodeBase64($content);
	}
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('config');
		
		$xmluser->write_value('news_id', $new_news_mm_id);
		$xmluser->write_value('news_title', $news_mm_title);
		$xmluser->write_value('news_stamp', $news_mm_stamp);
		$xmluser->write_value('news_text', $content);
		$xmluser->write_value('news_image', $news_mm_image);
		$xmluser->write_value('use_comments', $new_use_comments);
		$xmluser->write_value('show_autor', $new_use_autor);
		$xmluser->write_value('show_autor_as_link', $new_use_autor_link);
		$xmluser->write_value('news_amount', $new_news_mm_amount);
		$xmluser->write_value('access', $news_mm_access);
		$xmluser->write_value('news_cut', $new_news_cut);
		$xmluser->write_value('use_emoticons', $use_emoticons);
		$xmluser->write_value('use_gravatar', $use_gravatar);
		$xmluser->write_value('use_rss091', $new_use_rss091);
		$xmluser->write_value('use_rss10', $new_use_rss10);
		$xmluser->write_value('use_rss20', $new_use_rss20);
		$xmluser->write_value('use_atom03', $new_use_atom03);
		$xmluser->write_value('use_opml', $new_use_opml);
		$xmluser->write_value('syn_amount', $new_syn_amount);
		$xmluser->write_value('use_syn_title', $new_use_syn_title);
		$xmluser->write_value('def_feed', $new_def_feed);
		$xmluser->write_value('use_trackback', $new_use_trackback);
		$xmluser->write_value('use_timesince', $new_use_timesince);
		$xmluser->write_value('readmore_link', $new_readmore_link);
		$xmluser->write_value('news_spacing', $new_news_spacing);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('config');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'newsmanager.news_id="'.$new_news_mm_id.'", '
		.$tcms_db_prefix.'newsmanager.news_title="'.$news_mm_title.'", '
		.$tcms_db_prefix.'newsmanager.news_stamp="'.$news_mm_stamp.'", '
		.$tcms_db_prefix.'newsmanager.news_text="'.$content.'", '
		.$tcms_db_prefix.'newsmanager.news_image="'.$news_mm_image.'", '
		.$tcms_db_prefix.'newsmanager.use_comments='.$new_use_comments.', '
		.$tcms_db_prefix.'newsmanager.show_autor='.$new_use_autor.', '
		.$tcms_db_prefix.'newsmanager.show_autor_as_link='.$new_use_autor_link.', '
		.$tcms_db_prefix.'newsmanager.news_amount='.$new_news_mm_amount.', '
		.$tcms_db_prefix.'newsmanager.access="'.$news_mm_access.'", '
		.$tcms_db_prefix.'newsmanager.news_cut='.$new_news_cut.', '
		.$tcms_db_prefix.'newsmanager.use_emoticons='.$use_emoticons.', '
		.$tcms_db_prefix.'newsmanager.use_gravatar='.$use_gravatar.', '
		.$tcms_db_prefix.'newsmanager.use_rss091='.$new_use_rss091.', '
		.$tcms_db_prefix.'newsmanager.use_rss10='.$new_use_rss10.', '
		.$tcms_db_prefix.'newsmanager.use_rss20='.$new_use_rss20.', '
		.$tcms_db_prefix.'newsmanager.use_atom03='.$new_use_atom03.', '
		.$tcms_db_prefix.'newsmanager.use_opml='.$new_use_opml.', '
		.$tcms_db_prefix.'newsmanager.syn_amount='.$new_syn_amount.', '
		.$tcms_db_prefix.'newsmanager.use_syn_title='.$new_use_syn_title.', '
		.$tcms_db_prefix.'newsmanager.def_feed="'.$new_def_feed.'", '
		.$tcms_db_prefix.'newsmanager.use_trackback='.$new_use_trackback.', '
		.$tcms_db_prefix.'newsmanager.use_timesince='.$new_use_timesince.', '
		.$tcms_db_prefix.'newsmanager.readmore_link='.$new_readmore_link.', '
		.$tcms_db_prefix.'newsmanager.news_spacing='.$new_news_spacing;
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'newsmanager', $newSQLData, 'newsmanager');
	}
	
	
	if($extra == 1){
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news&todo=config&action=news\'</script>';
	}
	else{
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news&todo=config&action=extra\'</script>';
	}
}





//=====================================================
// SAVE
//=====================================================

if($todo == 'save'){
	if($new_published == '' || empty($new_published) || !isset($new_published)){ $new_published = 0; }
	if($new_comments_en == '' || empty($new_comments_en) || !isset($new_comments_en)){ $new_comments_en = 0; }
	if($new_sof == '' || empty($new_sof) || !isset($new_sof)){ $new_sof = 0; }
	
	
	if($choosenDB == 'xml'){
		$myCat = '';
		$i = 0;
		
		while($i <= count($arrNewsCat['tag'])){
			if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
				$myCat .= $_POST['new_cat_'.$i].'{###}';
				/*
				$user_xml  = new xmlparser('../../'.$tcms_administer_site.'/tcms_news_categories/'.$_POST['new_cat_'.$i].'.xml','r');
				$cat_count = $user_xml->read_value('count');
				
				xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news_categories/'.$_POST['new_cat_'.$i].'.xml', 'count', $cat_count, ($cat_count + 1));*/
			}
			
			$i++;
		}
		
		$new_cat = $myCat;
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
		$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."news_to_categories WHERE news_uid = '".$maintag."'");
		
		
		switch($choosenDB){
			case 'mysql':
				$newSQLColumns = '`news_uid`, `cat_uid`';
				break;
			
			case 'pgsql':
				$newSQLColumns = 'news_uid, cat_uid';
				break;
			
			case 'mssql':
				$newSQLColumns = '[news_uid], [cat_uid]';
				break;
		}
		
		
		for($i = 0; $i <= count($arrNewsCat['tag']); $i++){
			if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
				$n2c_maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'news_to_categories', 32);
				
				$newSQLData = "'".$maintag."', '".$_POST['new_cat_'.$i]."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news_to_categories', $newSQLColumns, $newSQLData, $n2c_maintag);
			}
		}
		
		if($i == 0){
			$globals_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
			$old_default_cat = $globals_xml->read_section('global', 'default_category');
			
			$n2c_maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'news_to_categories', 32);
			
			$newSQLData = "'".$maintag."', '".$old_default_cat."'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news_to_categories', $newSQLColumns, $newSQLData, $n2c_maintag);
		}
	}
	
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
	$titel   = $tcms_main->decode_text($titel, '2', $c_charset);
	$autor   = $tcms_main->decode_text($autor, '2', $c_charset);
	$content = $tcms_main->decode_text($content, '2', $c_charset);
	
	
	$stamp = substr($new_publish_date, 6, 4).substr($new_publish_date, 3, 2).substr($new_publish_date, 0, 2).substr($new_publish_date, 11, 2).substr($new_publish_date, 14, 2);
	
	
	if($new_date == ''){ $new_date = $date; }
	if($new_time == ''){ $new_time = $time; }
	if($new_publish_date == ''){ $new_publish_date = $date.'-'.$time; }
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('news');
		
		$xmluser->write_value('title', $titel);
		$xmluser->write_value('autor', $autor);
		$xmluser->write_value('date', $new_date);
		$xmluser->write_value('time', $new_time);
		$xmluser->write_value('newstext', $content);
		$xmluser->write_value('order', $order);
		$xmluser->write_value('stamp', $stamp);
		$xmluser->write_value('published', $new_published);
		$xmluser->write_value('publish_date', $new_publish_date);
		$xmluser->write_value('comments_enabled', $new_comments_en);
		$xmluser->write_value('image', $news_image);
		$xmluser->write_value('category', $new_cat);
		$xmluser->write_value('access', $new_access);
		$xmluser->write_value('show_on_frontpage', $new_sof);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('news');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'news.title="'.$titel.'", '
		.$tcms_db_prefix.'news.autor="'.$autor.'", '
		.$tcms_db_prefix.'news.date="'.$new_date.'", '
		.$tcms_db_prefix.'news.time="'.$new_time.'", '
		.$tcms_db_prefix.'news.newstext="'.$content.'", '
		.$tcms_db_prefix.'news.stamp='.$stamp.', '
		.$tcms_db_prefix.'news.published='.$new_published.', '
		.$tcms_db_prefix.'news.publish_date="'.$new_publish_date.'", '
		.$tcms_db_prefix.'news.comments_enabled='.$new_comments_en.', '
		.$tcms_db_prefix.'news.image="'.$news_image.'", '
		.$tcms_db_prefix.'news.access="'.$new_access.'", '
		.$tcms_db_prefix.'news.show_on_frontpage='.$new_sof;
		
		$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml','r');
		$defaultFeed = $news_xml->read_section('config', 'def_feed');
		$synAmount   = $news_xml->read_section('config', 'syn_amount');
		$showAutor   = $news_xml->read_section('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsmanager', 'newsmanager');
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$tcms_dcp->generateFeed($defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\'</script>';
}





//=====================================================
// CREATE
//=====================================================

if($todo == 'next'){
	if($new_published == '' || empty($new_published) || !isset($new_published)){ $new_published = 0; }
	//if($new_cat       == '' || empty($new_cat)       || !isset($new_cat))      { $new_cat = ''; }
	if($new_comments_en == '' || empty($new_comments_en) || !isset($new_comments_en)){ $new_comments_en = 0; }
	if($new_sof == '' || empty($new_sof) || !isset($new_sof)){ $new_sof = 0; }
	
	
	
	if($choosenDB == 'xml'){
		$myCat = '';
		$i = 0;
		
		while($i <= count($arrNewsCat['tag'])){
			if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
				$myCat .= $_POST['new_cat_'.$i].'{###}';
				/*
				$user_xml  = new xmlparser('../../'.$tcms_administer_site.'/tcms_news_categories/'.$_POST['new_cat_'.$i].'.xml','r');
				$cat_count = $user_xml->read_value('count');
				
				xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news_categories/'.$_POST['new_cat_'.$i].'.xml', 'count', $cat_count, ($cat_count + 1));
				*/
			}
			
			$i++;
		}
		
		$new_cat = $myCat;
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
		switch($choosenDB){
			case 'mysql':
				$newSQLColumns = '`news_uid`, `cat_uid`';
				break;
			
			case 'pgsql':
				$newSQLColumns = 'news_uid, cat_uid';
				break;
			
			case 'mssql':
				$newSQLColumns = '[news_uid], [cat_uid]';
				break;
		}
		
		
		for($i = 0; $i <= count($arrNewsCat['tag']); $i++){
			if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
				$n2c_maintag = $tcms_main->getNewUID(32, 'news_to_categories');
				
				$newSQLData = "'".$maintag."', '".$_POST['new_cat_'.$i]."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news_to_categories', $newSQLColumns, $newSQLData, $n2c_maintag);
			}
		}
	}
	
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
	$titel   = $tcms_main->decode_text($titel, '2', $c_charset);
	$autor   = $tcms_main->decode_text($autor, '2', $c_charset);
	$content = $tcms_main->decode_text($content, '2', $c_charset);
	
	$stamp = substr($new_publish_date, 6, 4).substr($new_publish_date, 3, 2).substr($new_publish_date, 0, 2).substr($new_publish_date, 11, 2).substr($new_publish_date, 14, 2);
	
	if($new_date == ''){ $new_date = $date; }
	if($new_time == ''){ $new_time = $time; }
	if($new_publish_date == ''){ $new_publish_date = $date.'-'.$time; }
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('news');
		
		$xmluser->write_value('title', $titel);
		$xmluser->write_value('autor', $autor);
		$xmluser->write_value('date', $new_date);
		$xmluser->write_value('time', $new_time);
		$xmluser->write_value('newstext', $content);
		$xmluser->write_value('order', $order);
		$xmluser->write_value('stamp', $stamp);
		$xmluser->write_value('published', $new_published);
		$xmluser->write_value('publish_date', $new_publish_date);
		$xmluser->write_value('comments_enabled', $new_comments_en);
		$xmluser->write_value('image', $news_image);
		$xmluser->write_value('category', $new_cat);
		$xmluser->write_value('access', $new_access);
		$xmluser->write_value('show_on_frontpage', $new_sof);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('news');
		$xmluser->_xmlparser();
		
		$old_umask = umask(0);
		mkdir('../../'.$tcms_administer_site.'/tcms_news/comments_'.$maintag.'/', 0777);
		umask($old_umask);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($choosenDB){
			case 'mysql':
				$newSQLColumns = '`title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, '
				.'`publish_date`, `comments_enabled`, `image`, `access`, `show_on_frontpage`';
				break;
			
			case 'pgsql':
				$newSQLColumns = 'title, autor, date, "time", newstext, stamp, published, '
				.'publish_date, comments_enabled, image, "access", "show_on_frontpage"';
				break;
			
			case 'mssql':
				$newSQLColumns = '[title], [autor], [date], [time], [newstext], [stamp], [published], '
				.'[publish_date], [comments_enabled], [image], [access], [show_on_frontpage]';
				break;
		}
		
		$newSQLData = "'".$titel."', '".$autor."', '".$new_date."', '".$new_time."', '".$content."', "
		.$stamp.", ".$new_published.", '".$new_publish_date."', ".$new_comments_en.", '".$news_image."', "
		."'".$new_access."', ".$new_sof;
		
		$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news', $newSQLColumns, $newSQLData, $maintag);
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml','r');
		$defaultFeed = $news_xml->read_section('config', 'def_feed');
		$synAmount   = $news_xml->read_section('config', 'syn_amount');
		$showAutor   = $news_xml->read_section('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsmanager', 'newsmanager');
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$tcms_dcp->generateFeed($defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\'</script>';
}





//===================================================================================
// ENABLE / DISABLE COMMENTS
//===================================================================================

if($todo == 'enableComments'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'comments_enabled', '1', '0'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.comments_enabled=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'comments_enabled', '0', '1'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.comments_enabled=1';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
	}
}





//===================================================================================
// PUBLISH / UNPUBLISH
//===================================================================================

if($todo == 'publishItem'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'published', '1', '0'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.published=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'published', '0', '1'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.published=1';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
	}
}





//===================================================================================
// ENABLE FRONTPAGE
//===================================================================================

if($todo == 'enableFrontpage'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml') {
				xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'show_on_frontpage', '1', '0');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.show_on_frontpage=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml') {
				xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'show_on_frontpage', '0', '1');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.show_on_frontpage=1';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';</script>';
			}
			else{
				echo '<script type="text/javascript">document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
			}
			break;
	}
}





//===================================================================================
// DELETE
//===================================================================================

if($todo == 'delete'){
	if($choosenDB == 'xml'){
		unlink('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml');
		/*
		
		
		INCREASE NEWS CATEGORY COUNTER
		IN NEWS CATEGORY
		
		
		*/
		$tcms_main->rmdirr('../../'.$tcms_administer_site.'/tcms_news/comments_'.$maintag.'/');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'news', $maintag);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'comments', $maintag);
		$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."news_to_categories WHERE news_uid = '".$maintag."'");
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml','r');
		$defaultFeed = $news_xml->read_section('config', 'def_feed');
		$synAmount   = $news_xml->read_section('config', 'syn_amount');
		$showAutor   = $news_xml->read_section('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsmanager', 'newsmanager');
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$tcms_dcp->generateFeed($defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
}

?>
