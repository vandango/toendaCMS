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
| File:	mod_news.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * News Manager
 *
 * This module is used for the news.
 *
 * @version 1.7.6
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
if(isset($_POST['new_news_lang'])){ $new_news_lang = $_POST['new_news_lang']; }
if(isset($_POST['lang_exist'])){ $lang_exist = $_POST['lang_exist']; }
if(isset($_POST['language'])){ $language = $_POST['language']; }
if(isset($_POST['draft'])){ $draft = $_POST['draft']; }
if(isset($_POST['newSynRSS091UseImg'])){ $newSynRSS091UseImg = $_POST['newSynRSS091UseImg']; }
if(isset($_POST['newSynRSS091Text'])){ $newSynRSS091Text = $_POST['newSynRSS091Text']; }
if(isset($_POST['newSynRSS10UseImg'])){ $newSynRSS10UseImg = $_POST['newSynRSS10UseImg']; }
if(isset($_POST['newSynRSS10Text'])){ $newSynRSS10Text = $_POST['newSynRSS10Text']; }
if(isset($_POST['newSynRSS20UseImg'])){ $newSynRSS20UseImg = $_POST['newSynRSS20UseImg']; }
if(isset($_POST['newSynRSS20Text'])){ $newSynRSS20Text = $_POST['newSynRSS20Text']; }
if(isset($_POST['newSynATOM03UseImg'])){ $newSynATOM03UseImg = $_POST['newSynATOM03UseImg']; }
if(isset($_POST['newSynATOM03Text'])){ $newSynATOM03Text = $_POST['newSynATOM03Text']; }
if(isset($_POST['newSynOPMLUseImg'])){ $newSynOPMLUseImg = $_POST['newSynOPMLUseImg']; }
if(isset($_POST['newSynOPMLText'])){ $newSynOPMLText = $_POST['newSynOPMLText']; }
if(isset($_POST['newSynUseCFeed'])){ $newSynUseCFeed = $_POST['newSynUseCFeed']; }
if(isset($_POST['newSynUseCFeedImg'])){ $newSynUseCFeedImg = $_POST['newSynUseCFeedImg']; }
if(isset($_POST['newSynCFeedText'])){ $newSynCFeedText = $_POST['newSynCFeedText']; }
if(isset($_POST['newSynCFeedType'])){ $newSynCFeedType = $_POST['newSynCFeedType']; }
if(isset($_POST['newSynCFeedAmount'])){ $newSynCFeedAmount = $_POST['newSynCFeedAmount']; }



echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>
<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />
<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';

if($show_wysiwyg == 'tinymce'){
	include('../tcms_kernel/tcms_tinyMCE.lib.php');
	
	$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
	$tcms_tinyMCE->initTinyMCE();
	
	unset($tcms_tinyMCE);
}





// -----------------------------------------------------
// INIT
// -----------------------------------------------------

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





// -----------------------------------------------------
// CONFIG
// -----------------------------------------------------

if($todo == 'config') {
	if($id_group == 'Developer' 
	|| $id_group == 'Administrator') {
		if(!isset($action)){ $action = 'news'; }
		
		using('toendacms.datacontainer.newsmanager', false, true);
		
		if($tcms_main->isReal($lang)) {
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		}
		else {
			$getLang = $tcms_front_lang;
		}
		
		// check lang
		if($choosenDB == 'xml') {
			if($tcms_file->checkFileExist('../../'.$tcms_administer_site.'/tcms_global/newsmanager.'.$getLang.'.xml')) {
				$langExist = 1;
			}
			else {
				$langExist = 0;
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT uid "
			."FROM ".$tcms_db_prefix."newsmanager "
			."WHERE language = '".$getLang."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$langExist = $sqlAL->getNumber($sqlQR);
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		if($langExist == 0) {
			$old_news_mm_id = 'newsmanager';
			$old_news_lang = $getLang;
		}
		
		// load data
		$dcNewsMan = $tcms_dcp->getNewsmanagerDC($getLang);
		
		$old_news_mm_id     = $dcNewsMan->getID();
		$old_news_mm_title  = $dcNewsMan->getTitle();
		$old_news_mm_stamp  = $dcNewsMan->getSubtitle();
		$old_news_mm_text   = $dcNewsMan->getText();
		$old_news_mm_image  = $dcNewsMan->getImage();
		$old_news_mm_usec   = $dcNewsMan->getUseComments();
		$old_news_mm_usea   = $dcNewsMan->getShowAutor();
		$old_news_mm_useal  = $dcNewsMan->getShowAutorAsLink();
		$old_news_mm_amount = $dcNewsMan->getNewsAmount();
		$old_news_mm_access = $dcNewsMan->getAccess();
		$old_news_cut       = $dcNewsMan->getNewsChars();
		$old_use_gravatar   = $dcNewsMan->getUseGravatar();
		$old_use_emoticons  = $dcNewsMan->getUseEmoticons();
		$old_use_rss091     = $dcNewsMan->getSyndicationRSS091();
		$old_use_rss10      = $dcNewsMan->getSyndicationRSS10();
		$old_use_rss20      = $dcNewsMan->getSyndicationRSS20();
		$old_use_atom03     = $dcNewsMan->getSyndicationRSSAtom();
		$old_use_opml       = $dcNewsMan->getSyndicationRSSOpml();
		$old_syn_amount     = $dcNewsMan->getSyndicationAmount();
		$old_use_syn_title  = $dcNewsMan->getSyndicationUseTitle();
		$old_def_feed       = $dcNewsMan->getSyndicationDefaultFeed();
		$old_use_trackback  = $dcNewsMan->getUseTrackback();
		$old_use_timesince  = $dcNewsMan->getUseTimesince();
		$old_readmore_link  = $dcNewsMan->getReadmoreLink();
		$old_news_spacing   = $dcNewsMan->getNewsSpacing();
		$old_news_lang      = $dcNewsMan->getLanguage();
		$wsSynRSS091UseImg  = $dcNewsMan->getSyndicationUseRSS091Image();
		$wsSynRSS091Text    = $dcNewsMan->getSyndicationRSS091Text();
		$wsSynRSS10UseImg   = $dcNewsMan->getSyndicationUseRSS10Image();
		$wsSynRSS10Text     = $dcNewsMan->getSyndicationRSS10Text();
		$wsSynRSS20UseImg   = $dcNewsMan->getSyndicationUseRSS20Image();
		$wsSynRSS20Text     = $dcNewsMan->getSyndicationRSS20Text();
		$wsSynATOM03UseImg  = $dcNewsMan->getSyndicationUseATOM03Image();
		$wsSynATOM03Text    = $dcNewsMan->getSyndicationATOM03Text();
		$wsSynOPMLUseImg    = $dcNewsMan->getSyndicationUseOPMLImage();
		$wsSynOPMLText      = $dcNewsMan->getSyndicationOPMLText();
		$wsSynUseCFeed      = $dcNewsMan->getSyndicationUseCommentFeed();
		$wsSynCFeedText     = $dcNewsMan->getSyndicationCommentFeedText();
		$wsSynCFeedType     = $dcNewsMan->getSyndicationCommentFeedType();
		$wsSynUseCFeedImg   = $dcNewsMan->getSyndicationUseCommentFeedImage();
		$wsSynCFeedAmount   = $dcNewsMan->getSyndicationCommentFeedAmount();
		
		$old_news_mm_title = htmlspecialchars($old_news_mm_title);
		$old_news_mm_stamp = htmlspecialchars($old_news_mm_stamp);
		$old_news_mm_text  = htmlspecialchars($old_news_mm_text);
		$wsSynRSS091Text   = htmlspecialchars($wsSynRSS091Text);
		$wsSynRSS10Text    = htmlspecialchars($wsSynRSS10Text);
		$wsSynRSS20Text    = htmlspecialchars($wsSynRSS20Text);
		$wsSynATOM03Text   = htmlspecialchars($wsSynATOM03Text);
		$wsSynOPMLText     = htmlspecialchars($wsSynOPMLText);
		$wsSynCFeedText    = htmlspecialchars($wsSynCFeedText);
		
		
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
		
		
		$arr_media = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/images/Image');
		
		
		// begin form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_news" method="post">'
		.'<input name="todo" type="hidden" value="save_config" />'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />'
		.'<input name="extra" type="hidden" value="1" />';
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		echo $tcms_html->tableHeadNoBorder('1', '5', '0', '100%');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_news'
		.'&amp;todo=config'
		.'&amp;action='.$action
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td class="tcms_padding_mini" width="250" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_news_lang" name="new_news_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_news_lang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td class="tcms_padding_mini"><br /></td></tr>'
		.$tcms_html->tableEnd();
		
		
		/*
			tabpane start
		*/
		
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			mod tab
		*/
		
		echo '<div class="tab-page" id="tab-page-text">'
		.'<h2 class="tab">'._TABLE_DESCRIPTION.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_ID.'</td>'
		.'<td valign="top">'
		.'<input name="new_news_mm_id" readonly class="tcms_input_small" value="'.$old_news_mm_id.'" />'
		.'</td></tr>';
		
		
		echo '<tr><td class="tcms_padding_mini">'._TABLE_ACCESS.'</td>'
		.'<td>'
		.'<select name="news_mm_access" class="tcms_select">'
		.'<option value="Public"'.( $old_news_mm_access == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( $old_news_mm_access == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
		.'<option value="Private"'.( $old_news_mm_access == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select></td></tr>';
		
		
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_TITLE.'</td>'
		.'<td valign="top">'
		.'<input name="news_mm_title" class="tcms_input_normal" value="'.$old_news_mm_title.'" />'
		.'</td></tr>';
		
		
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SUBTITLE.'</td>'
		.'<td valign="top">'
		.'<input name="news_mm_stamp" class="tcms_input_normal" value="'.$old_news_mm_stamp.'" />'
		.'</td></tr>';
		
		
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
		
		
		echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_NEWS_IMAGE.'</td>'
		.'<td>'
		.'<input type="button" name="tcms" value="'._TCMSSCRIPT_IMAGES.'" onclick="window.open(\'media.php?id_user='.$id_user.'&v=news_config\', \'ImageBrowser\', \'width=400,height=500,left=50,top=50,scrollbars=yes\');" />'
		.'<input type="button" name="tcms" value="'._EXT_NEWS_DESELECT.'" onclick="document.getElementById(\'news_mm_image\').src=\'\';document.getElementById(\'news_tt_image\').value=\'\';document.getElementById(\'news_mm_image\').style.visibility=\'hidden\';" />'
		.'<br />';
		
		if(isset($new_news_mm_image)){ $old_news_mm_image = $new_news_mm_image; }
		
		echo '<img width="100"'.( $old_news_mm_image == '' ? ' style="visibility:hidden;"' : '' ).' id="news_mm_image" src="../../'.$tcms_administer_site.'/images/Image/'.$old_news_mm_image.'" border="0" />'
		.'<input name="news_mm_image" id="news_tt_image" value="'.$old_news_mm_image.'" type="hidden" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			mod tab
		*/
		
		echo '<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_COMMENTS.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_comments" '.( $old_news_mm_usec == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_GRAVATAR.'</td>'
		.'<td>'
		.'<input type="checkbox" name="use_gravatar" '.( $old_use_gravatar == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_EMOTICONS.'</td>'
		.'<td>'
		.'<input type="checkbox" name="use_emoticons" '.( $old_use_emoticons == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini">'._EXT_NEWS_DISPLAY.'</td>'
		.'<td><img src="../images/px.png" border="0" width="1" />'
		.'<select name="new_use_timesince" class="tcms_select">'
		.'<option value="0"'.( $old_use_timesince == '0' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_DATE.'</option>'
		.'<option value="1"'.( $old_use_timesince == '1' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_TIMESINCE.'</option>'
		.'<option value="2"'.( $old_use_timesince == '2' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_D_TEXT.'</option>'
		.'</select></td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini">'._EXT_NEWS_DISPLAY_MORE.'</td>'
		.'<td><img src="../images/px.png" border="0" width="1" />'
		.'<select name="new_readmore_link" class="tcms_select">'
		.'<option value="0"'.( $old_readmore_link == '0' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_LEFT.'</option>'
		.'<option value="1"'.( $old_readmore_link == '1' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_RIGHT.'</option>'
		.'<option value="2"'.( $old_readmore_link == '2' ? ' selected="selected"' : '' ).'>'._EXT_NEWS_MORE_NL_DIRECT.'</option>'
		.'</select></td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_AUTOR.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_autor" '.( $old_news_mm_usea == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_AUTOR_LINK.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_autor_link" '.( $old_news_mm_useal == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_NEWSAMOUNT.'</td>'
		.'<td valign="top">'
		.'<input name="new_news_mm_amount" class="tcms_input_small" value="'.$old_news_mm_amount.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250" valign="top">'._FRONTPAGE_NEWS_CHARS.'</td>'
		.'<td valign="top">'
		.'<input name="new_news_cut" class="tcms_id_box" value="'.$old_news_cut.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_NEWS_SPACING.' (px)</td>'
		.'<td>'
		.'<input type="text" class="tcms_id_box" name="new_news_spacing" value="'.$old_news_spacing.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_TRACKBACK.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_trackback" '.( $old_use_trackback == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_SYN_TITLE.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_syn_title" '.( $old_use_syn_title == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS091.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_rss091" '.( $old_use_rss091 == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS10.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_rss10" '.( $old_use_rss10 == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_RSS20.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_rss20" '.( $old_use_rss20 == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_ATOM03.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_atom03" '.( $old_use_atom03 == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_OPML.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_opml" '.( $old_use_opml == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_AMOUNT.'</td>'
		.'<td>'
		.'<input class="tcms_id_box" name="new_syn_amount" value="'.$old_syn_amount.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
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
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_RSS091_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynRSS091UseImg" '.( $wsSynRSS091UseImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_RSS091_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynRSS091Text" class="tcms_input_small" value="'.$wsSynRSS091Text.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_RSS10_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynRSS10UseImg" '.( $wsSynRSS10UseImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_RSS10_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynRSS10Text" class="tcms_input_small" value="'.$wsSynRSS10Text.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_RSS20_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynRSS20UseImg" '.( $wsSynRSS20UseImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_RSS20_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynRSS20Text" class="tcms_input_small" value="'.$wsSynRSS20Text.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_ATOM03_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynATOM03UseImg" '.( $wsSynATOM03UseImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_ATOM03_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynATOM03Text" class="tcms_input_small" value="'.$wsSynATOM03Text.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_OPML_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynOPMLUseImg" '.( $wsSynOPMLUseImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_OPML_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynOPMLText" class="tcms_input_small" value="'.$wsSynOPMLText.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_CFEED.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynUseCFeed" '.( $wsSynUseCFeed == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_USE_CFEED_IMG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="newSynUseCFeedImg" '.( $wsSynUseCFeedImg == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" valign="top">'._EXT_NEWS_SYN_CFEED_TEXT.'</td>'
		.'<td valign="top">'
		.'<input name="newSynCFeedText" class="tcms_input_small" value="'.$wsSynCFeedText.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_CFEED_AMOUNT.'</td>'
		.'<td>'
		.'<input class="tcms_id_box" name="newSynCFeedAmount" value="'.$wsSynCFeedAmount.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td class="tcms_padding_mini" width="250">'._EXT_NEWS_SYN_CFEED_TYPE.'</td>'
		.'<td>'
		.'<select name="newSynCFeedType" class="tcms_select">'
			.'<option value="RSS0.91"'.( $wsSynCFeedType == 'RSS0.91' ? ' selected="selected"' : '' ).'>RSS 0.91</option>'
			.'<option value="RSS1.0"'.( $wsSynCFeedType == 'RSS1.0' ? ' selected="selected"' : '' ).'>RSS 1.0</option>'
			.'<option value="RSS2.0"'.( $wsSynCFeedType == 'RSS2.0' ? ' selected="selected"' : '' ).'>RSS 2.0</option>'
		.'</select>'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			tabpane end
		*/
		
		echo '</div>'
		.'<script type="text/javascript">
		var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
		tabPane1.addTabPage(document.getElementById("tab-page-text"));
		tabPane1.addTabPage(document.getElementById("tab-page-set"));
		tabPanel.setSelectedIndex(0);
		setupAllTabs();
		</script>'
		.'<br />';
		
		
		// Table end
		echo '</form>'
		.'<br />';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





// -----------------------------------------------------
// VALUES
// -----------------------------------------------------

if($todo == 'show'){
	echo $tcms_html->bold(_NEWS_TITLE);
	echo $tcms_html->text(_NEWS_TEXT.'<br /><br />', 'left');
	
	if($choosenDB == 'xml'){
		if($tcms_main->isArray($arr_filename)){
			$count = 0;
			
			foreach($arr_filename as $key => $value) {
				$main_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$value,'r');
				$chk_autor = $main_xml->read_value('autor');
				
				if($id_group == 'Developer' 
				|| $id_group == 'Administrator' 
				|| $id_group == 'Writer') {
					$showAll = true;
				}
				else {
					if($chk_autor == $id_username) {
						$showAll = true;
					}
					else {
						$showAll = false;
					}
				}
				
				if($showAll == true) {
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
					$arr_news['lang'][$count]  = $main_xml->read_value('language');
					
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
				$arr_news['sof'], SORT_DESC, 
				$arr_news['lang'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
			$arr_news['lang'][$count]  = $sqlObj->language;
			
			if($arr_news['order'][$count] == NULL){ $arr_news['order'][$count] = ''; }
			if($arr_news['title'][$count] == NULL){ $arr_news['title'][$count] = ''; }
			if($arr_news['date'][$count]  == NULL){ $arr_news['date'][$count]  = ''; }
			if($arr_news['time'][$count]  == NULL){ $arr_news['time'][$count]  = ''; }
			if($arr_news['stamp'][$count] == NULL){ $arr_news['stamp'][$count] = ''; }
			if($arr_news['cmt'][$count]   == NULL){ $arr_news['cmt'][$count]   = ''; }
			if($arr_news['acc'][$count]   == NULL){ $arr_news['acc'][$count]   = ''; }
			if($arr_news['autor'][$count] == NULL){ $arr_news['autor'][$count] = ''; }
			if($arr_news['sof'][$count]   == NULL){ $arr_news['sof'][$count]   = 1; }
			if($arr_news['lang'][$count]  == NULL){ $arr_news['lang'][$count]  = ''; }
			
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
		.'<th valign="middle" class="tcms_db_title" width="45%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TCMS_LANGUAGE.'</th>'
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
					
					if(is_integer($bgkey/2)) {
						$ws_farbe = $arr_farbe[0];
					}
					else {
						$ws_farbe = $arr_farbe[1];
					}
					
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
					.$tcms_main->getLanguageNameByTCMSLanguageCode($languages, $arr_news['lang'][$count])
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
		.'<td height="18" align="center" class="tcms_db_title tcms_padding_mini" colspan="10"'
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





// -----------------------------------------------------
// EDIT AND CREATE FORM
// -----------------------------------------------------

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
				$nws_lang         = $main_xml->read_value('language');
				
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
					$old_default_cat = $globals_xml->readSection('global', 'default_category');
					
					$arr_cat[0] = $old_default_cat;
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
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
			$nws_lang         = $sqlObj->language;
			
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
			if($nws_lang         == NULL){ $nws_lang         = ''; }
			
			
			unset($sqlARR);
			unset($sqlQR);
			
			
			$strSQL = "SELECT * "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.cat_uid = ".$tcms_db_prefix."news_categories.uid) "
			."WHERE (".$tcms_db_prefix."news_to_categories.news_uid = '".$maintag."')";
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
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
		
		echo $tcms_html->bold(_TABLE_EDIT);
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
		$nws_lang         = $tcms_config->getLanguageFrontend();
		
		echo $tcms_html->bold(_TABLE_NEW);
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
			if(!isset($nws_image) || $nws_image == '' || empty($nws_image) || !strpos($nws_image, '.')){
				$nws_image = 'system/toendacms.png';
			}
			
			$width = '150';
			
			
			echo $tcms_html->text(_NEWS_EDIT_CURRENT.'<br /><br />', 'left');
			
			
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_news" method="post" id="news">'
			.'<input name="todo" type="hidden" value="'.$odot.'" />'
			.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
			.'<input name="stamp" type="hidden" value="'.$nws_stamp.'" />'
			.'<input name="order" type="hidden" value="'.$maintag.'" />'
			.'<input name="draft" id="draft" type="hidden" value="1" />';
			
			
			/*
				tabpane start
			*/
			
			echo '<div class="tab-pane" id="tab-pane-1">';
			
			
			/*
				text tab
			*/
			
			echo '<div class="tab-page" id="tab-page-text">'
			.'<h2 class="tab">'._TABLE_EDIT.'</h2>'
			.$tcms_html->tableHeadNoBorder('1', '5', '0', '100%');
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TABLE_TITLE.'</strong>'
			.'</td><td valign="top">'
			.'<input class="tcms_input_normal" name="titel" type="text" value="'.$nws_title.'" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" colspan="3">'
			.'<br />'
			.'<strong class="tcms_bold">'._NEWS_MAINTEXT.' ('._NEWS_ID.': '.$maintag.')</strong>'
			.'<br /><br />'
			.'<script>'
			.'createToendaToolbar(\'news\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');'
			.'createToendaHelpButton(\''.$tcms_lang.'\', \''._NEWS_IMAGE_HELP
			.( $show_wysiwyg == 'fckeditor' ? '<br /><br /><strong>'._TCMSSCRIPT_MORE.': {tcms_more}</strong>' : '' )
			.'\');'
			.'</script>';
			
			if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor') {
				if($show_wysiwyg == 'toendaScript') {
					echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
				}
				else {
					echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'HTML\');</script>';
				}
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
				echo '<div class="ebene" id="content_body">'
				.'<textarea class="tcms_textarea_huge" id="content" name="content">'.$nws_news.'</textarea>'
				.'</div>'
				.'<div class="tcms_textarea_bottom" id="content_resizer">'
				.'&nbsp;'
				.'</div>';
				
				echo '<script language="JavaScript" type="text/javascript">
				JSAjax.ajaxTextAreaSize(200);
				document.getElementById(\'content_resizer\').onmousedown = JSAjax.ajaxContentResizer;
				//document.getElementById(\'content_resizer\').onmousemove = JSAjax.ajaxContentResizer;
				</script>';
			}
			
			echo '<br />'
			.'</td>';
			
			
			// table row
			echo '<td width="210" valign="top">'
			.'<div style="width: 200px; overflow: auto; border: 0px solid #fff; padding: 3px;">'
			.'<fieldset><legend><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></legend>'
			.'<br />';
			
			$globals_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
			$old_default_cat = $globals_xml->readSection('global', 'default_category');
			
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
			
			
			echo '</table>'
			.'</div>';
			
			
			/*
				settings tab
			*/
			
			echo '<div class="tab-page" id="tab-page-set">'
			.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'
			.'<table cellpadding="1" cellspacing="5" width="100%" border="0" class="noborder">';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="language" name="language">';
			
			foreach($languages['code'] as $key => $value) {
				if($value != $tcms_config->getLanguageCode(true)) {
					if($nws_lang == $value)
						$dl = ' selected="selected"';
					else
						$dl = '';
					
					echo '<option value="'.$value.'"'.$dl.'>'
					.$languages['name'][$key]
					.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TABLE_AUTOR.'</strong>'
			.'</td><td valign="top">'
			.'<select class="tcms_select" name="autor">';
			
			if($id_group == 'Developer' 
			|| $id_group == 'Administrator') {
				echo '<optgroup label="'._USER_SELF.'">'
				.'<option value="'.$id_username.'"'.( $nws_autor == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $nws_autor == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>'
				.'</optgroup>'
				.'<optgroup label="'._USER_ALL.'">';
				
				foreach($arrActiveUser['user'] as $key => $value) {
					echo '<option value="'.$value.'"'.( $nws_autor == $value ? ' selected="selected"' : '').'>'.$value.'</option>';
				}
				
				echo '</optgroup>';
			}
			else {
				echo '<option value="'.$id_username.'"'.( $nws_autor == $id_username ? ' selected="selected"' : '').'>'.$id_username.'</option>'
				.'<option value="'.$id_name.'"'.( $nws_autor == $id_name ? ' selected="selected"' : '').'>'.$id_name.'</option>';
				
				if(isset($nws_autor) && $nws_autor != '' && ($nws_autor != $id_username && $nws_autor != $id_name)){
					echo '<option value="'.$nws_autor.'" selected="selected">'.$nws_autor.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._NEWS_TIME.' / '._NEWS_DATE.'</strong>'
			.'</td><td valign="top">'
			.'<input class="tcms_id_box" id="new_time" name="new_time" type="text" value="'.( $nws_time == '' ? date('H:i') : $nws_time ).'"'
			.' onchange="JSAjax.ajaxChangeDateTime(this.id, this.value);" />'
			.'&nbsp;'
			.'<input class="tcms_input_mini" name="new_date" id="new_date" type="text" value="'.( $nws_date == '' ? date('d.m.Y') : $nws_date ).'"'
			.' onchange="JSAjax.ajaxChangeDateTime(this.id, this.value);" />'
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
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TABLE_PUBLISHING.'</strong>'
			.'</td><td valign="top">'
			.'<input class="tcms_input_small" id="new_publish_date" name="new_publish_date" type="text" value="'.( $nws_publish_date == '' ? date('d.m.Y-H:i') : $nws_publish_date ).'"'
			.' onchange="JSAjax.ajaxChangeDateTime(\'new_publish_date\', this.value);" />'
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
			
			
			echo '</table>'
			.'</div>';
			
			
			/*
				tabpane end
			*/
			
			echo '</div>'
			.'<script type="text/javascript">'
			.'var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));'
			.'tabPane1.addTabPage(document.getElementById("tab-page-text"));'
			.'tabPane1.addTabPage(document.getElementById("tab-page-set"));'
			.'setupAllTabs();'
			.'</script>'
			.'<br />';
			
			
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





// -----------------------------------------------------
// SAVE CONFIG
// -----------------------------------------------------

if($todo == 'save_config') {
	if(empty($new_use_comments))    { $new_use_comments     = 0; }
	if(empty($new_use_autor))       { $new_use_autor        = 0; }
	if(empty($new_use_autor_link))  { $new_use_autor_link   = 0; }
	if(empty($use_emoticons))       { $use_emoticons        = 0; }
	if(empty($use_gravatar))        { $use_gravatar         = 0; }
	if(empty($new_use_feeds))       { $new_use_feeds        = 0; }
	if(empty($new_use_rss091))      { $new_use_rss091       = 0; }
	if(empty($new_use_rss10))       { $new_use_rss10        = 0; }
	if(empty($new_use_rss20))       { $new_use_rss20        = 0; }
	if(empty($new_use_atom03))      { $new_use_atom03       = 0; }
	if(empty($new_news_cut))        { $new_news_cut         = 0; }
	if(empty($new_use_opml))        { $new_use_opml         = 0; }
	if(empty($new_syn_amount))      { $new_syn_amount       = 0; }
	if(empty($new_use_syn_title))   { $new_use_syn_title    = 0; }
	if($new_news_mm_amount == '')   { $new_news_mm_amount   = 20; }
	if(empty($new_news_mm_id))      { $new_news_mm_id       = $old_news_mm_id; }
	if($news_mm_title == '')        { $news_mm_title        = ''; }
	if($news_mm_stamp == '')        { $news_mm_stamp        = ''; }
	if($new_def_feed  == '')        { $new_def_feed         = 'RSS2.0'; }
	if(empty($new_use_trackback))   { $new_use_trackback    = 0; }
	if(empty($new_use_timesince))   { $new_use_timesince    = 0; }
	if(empty($new_readmore_link))   { $new_readmore_link    = 0; }
	if(empty($newSynRSS091UseImg))  { $newSynRSS091UseImg   = 0; }
	if(empty($newSynRSS091Text))    { $newSynRSS091Text     = ''; }
	if(empty($newSynRSS10UseImg))   { $newSynRSS10UseImg    = 0; }
	if(empty($newSynRSS10Text))     { $newSynRSS10Text      = ''; }
	if(empty($newSynRSS20UseImg))   { $newSynRSS20UseImg    = 0; }
	if(empty($newSynRSS20Text))     { $newSynRSS20Text      = ''; }
	if(empty($newSynATOM03UseImg))  { $newSynATOM03UseImg   = 0; }
	if(empty($newSynATOM03Text))    { $newSynATOM03Text     = ''; }
	if(empty($newSynOPMLUseImg))    { $newSynOPMLUseImg     = 0; }
	if(empty($newSynOPMLText))      { $newSynOPMLText       = ''; }
	if(empty($newSynUseCFeed))      { $newSynUseCFeed       = 0; }
	if(empty($newSynCFeedText))     { $newSynCFeedText      = ''; }
	if(empty($newSynCFeedType))     { $newSynCFeedType      = ''; }
	if(empty($newSynUseCFeedImg))   { $newSynUseCFeedImg    = 0; }
	if(empty($newSynCFeedAmount))   { $newSynCFeedAmount    = '25'; }
	
	
	
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
		//$content = $tcms_main->decodeBase64($content);
	}
	
	
	if($tcms_main->isReal($new_news_lang)) {
		$setLang = $tcms_config->getLanguageCodeForTCMS($new_news_lang);
	}
	else {
		$setLang = '';
	}
	
	
	if($choosenDB == 'xml') {
		$xmluser = new xmlparser($tcms_administer_path.'/tcms_global/newsmanager.'.$setLang.'.xml', 'w');
		$xmluser->xmlDeclaration();
		$xmluser->xmlSection('config');
		
		$xmluser->writeValue('language', $setLang);
		$xmluser->writeValue('news_id', $new_news_mm_id);
		$xmluser->writeValue('news_title', $news_mm_title);
		$xmluser->writeValue('news_stamp', $news_mm_stamp);
		$xmluser->writeValue('news_text', $content);
		$xmluser->writeValue('news_image', $news_mm_image);
		$xmluser->writeValue('use_comments', $new_use_comments);
		$xmluser->writeValue('show_autor', $new_use_autor);
		$xmluser->writeValue('show_autor_as_link', $new_use_autor_link);
		$xmluser->writeValue('news_amount', $new_news_mm_amount);
		$xmluser->writeValue('access', $news_mm_access);
		$xmluser->writeValue('news_cut', $new_news_cut);
		$xmluser->writeValue('use_emoticons', $use_emoticons);
		$xmluser->writeValue('use_gravatar', $use_gravatar);
		$xmluser->writeValue('use_rss091', $new_use_rss091);
		$xmluser->writeValue('use_rss10', $new_use_rss10);
		$xmluser->writeValue('use_rss20', $new_use_rss20);
		$xmluser->writeValue('use_atom03', $new_use_atom03);
		$xmluser->writeValue('use_opml', $new_use_opml);
		$xmluser->writeValue('syn_amount', $new_syn_amount);
		$xmluser->writeValue('use_syn_title', $new_use_syn_title);
		$xmluser->writeValue('def_feed', $new_def_feed);
		$xmluser->writeValue('use_trackback', $new_use_trackback);
		$xmluser->writeValue('use_timesince', $new_use_timesince);
		$xmluser->writeValue('readmore_link', $new_readmore_link);
		$xmluser->writeValue('news_spacing', $new_news_spacing);
		$xmluser->writeValue('use_rss091_img', $newSynRSS091UseImg);
		$xmluser->writeValue('rss091_text', $newSynRSS091Text);
		$xmluser->writeValue('use_rss10_img', $newSynRSS10UseImg);
		$xmluser->writeValue('rss10_text', $newSynRSS10Text);
		$xmluser->writeValue('use_rss20_img', $newSynRSS20UseImg);
		$xmluser->writeValue('rss20_feed', $newSynRSS20Text);
		$xmluser->writeValue('use_atom03_img', $newSynATOM03UseImg);
		$xmluser->writeValue('atom03_text', $newSynATOM03Text);
		$xmluser->writeValue('use_opml_img', $newSynOPMLUseImg);
		$xmluser->writeValue('opml_text', $newSynOPMLText);
		$xmluser->writeValue('use_comment_feed', $newSynUseCFeed);
		$xmluser->writeValue('comment_feed_text', $newSynCFeedText);
		$xmluser->writeValue('comment_feed_type', $newSynCFeedType);
		$xmluser->writeValue('use_comment_feed_img', $newSynUseCFeedImg);
		$xmluser->writeValue('comments_feed_amount', $newSynCFeedAmount);
		
		$xmluser->xmlSectionBuffer();
		$xmluser->xmlSectionEnd('config');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($lang_exist > 0) {
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
			.$tcms_db_prefix.'newsmanager.news_spacing='.$new_news_spacing.', '
			
			.$tcms_db_prefix.'newsmanager.use_rss091_img='.$newSynRSS091UseImg.', '
			.$tcms_db_prefix.'newsmanager.rss091_text="'.$newSynRSS091Text.'", '
			.$tcms_db_prefix.'newsmanager.use_rss10_img='.$newSynRSS10UseImg.', '
			.$tcms_db_prefix.'newsmanager.rss10_text="'.$newSynRSS10Text.'", '
			.$tcms_db_prefix.'newsmanager.use_rss20_img='.$newSynRSS20UseImg.', '
			.$tcms_db_prefix.'newsmanager.rss20_feed="'.$newSynRSS20Text.'", '
			.$tcms_db_prefix.'newsmanager.use_atom03_img='.$newSynATOM03UseImg.', '
			.$tcms_db_prefix.'newsmanager.atom03_text="'.$newSynATOM03Text.'", '
			.$tcms_db_prefix.'newsmanager.use_opml_img='.$newSynOPMLUseImg.', '
			.$tcms_db_prefix.'newsmanager.opml_text="'.$newSynOPMLText.'", '
			.$tcms_db_prefix.'newsmanager.use_comment_feed='.$newSynUseCFeed.', '
			.$tcms_db_prefix.'newsmanager.comment_feed_text="'.$newSynCFeedText.'", '
			.$tcms_db_prefix.'newsmanager.comment_feed_type="'.$newSynCFeedType.'", '
			.$tcms_db_prefix.'newsmanager.use_comment_feed_img='.$newSynUseCFeedImg.', '
			.$tcms_db_prefix.'newsmanager.comments_feed_amount='.$newSynCFeedAmount;
			
			
			switch($choosenDB) {
				case 'mysql':
					$sqlQR = $sqlAL->sqlUpdateField(
						$tcms_db_prefix.'newsmanager', 
						$newSQLData, 
						'news_id', 
						'newsmanager" AND language = "'.$setLang
					);
					break;
				
				default:
					$sqlQR = $sqlAL->sqlUpdateField(
						$tcms_db_prefix.'newsmanager', 
						$newSQLData, 
						'news_id', 
						"newsmanager' AND language = '".$setLang
					);
					break;
			}
		}
		else {
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`news_id`, `news_title`, `news_stamp`, `news_text`, '
					.'`news_image`, `use_comments`, `show_autor`, `show_autor_as_link`, '
					.'`news_amount`, `access`, `news_cut`, `use_emoticons`, '
					.'`language`, `use_gravatar`, `syn_amount`, `use_syn_title`, '
					.'`use_rss091`, `use_rss10`, `use_rss20`, `use_atom03`, `use_opml`, '
					.'`def_feed`, `use_trackback`, `use_timesince`, `readmore_link`, `news_spacing`, '
					.'`use_rss091_img`, `rss091_text`, `use_rss10_img`, `rss10_text`, `use_rss20_img`, '
					.'`rss20_feed`, `use_atom03_img`, `atom03_text`, `use_opml_img`, `opml_text`, '
					.'`use_comment_feed`, `comment_feed_text`, `comment_feed_type`, `use_comment_feed_img`, '
					.'`comments_feed_amount` ';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'news_id, news_title, news_stamp, news_text, '
					.'"news_image", use_comments, show_autor, show_autor_as_link, '
					.'news_amount, access, news_cut, "use_emoticons", '
					.'"language", use_gravatar, syn_amount, use_syn_title, '
					.'use_rss091, use_rss10, use_rss20, "use_atom03", "use_opml", '
					.'def_feed, use_trackback, use_timesince, "readmore_link", "news_spacing", '
					.'use_rss091_img, rss091_text, use_rss10_img, rss10_text, use_rss20_img, '
					.'rss20_feed, use_atom03_img, atom03_text, use_opml_img, opml_text, '
					.'use_comment_feed, comment_feed_text, comment_feed_type, use_comment_feed_img, '
					.'comments_feed_amount ';
					break;
				
				case 'mssql':
					$newSQLColumns = '[news_id], [news_title], [news_stamp], [news_text], '
					.'[news_image], [use_comments], [show_autor], [show_autor_as_link], '
					.'[news_amount], [access], [news_cut], [use_emoticons], '
					.'[language], [use_gravatar], [syn_amount], [use_syn_title], '
					.'[use_rss091], [use_rss10], [use_rss20], [use_atom03], [use_opml], '
					.'[def_feed], [use_trackback], [use_timesince], [readmore_link], [news_spacing], '
					.'[use_rss091_img], [rss091_text], [use_rss10_img], [rss10_text], [use_rss20_img], '
					.'[rss20_feed], [use_atom03_img], [atom03_text], [use_opml_img], [opml_text], '
					.'[use_comment_feed], [comment_feed_text], [comment_feed_type], [use_comment_feed_img], '
					.'[comments_feed_amount] ';
					break;
			}
			
			$newSQLData = "'".$new_news_mm_id."', '".$news_mm_title."', '".$news_mm_stamp."', '".$content."', "
			."'".$news_mm_image."', ".$new_use_comments.", ".$new_use_autor.", ".$new_use_autor_link.", "
			.$new_news_mm_amount.", '".$news_mm_access."', ".$new_news_cut.", ".$use_emoticons.", "
			."'".$setLang."', ".$use_gravatar.", ".$new_syn_amount.", ".$new_use_syn_title.", "
			.$new_use_rss091.", ".$new_use_rss10.", ".$new_use_rss20.", ".$new_use_atom03.", ".$new_use_opml.", "
			."'".$new_def_feed."', ".$new_use_trackback.", ".$new_use_timesince.", ".$new_readmore_link
			.", ".$newSynRSS10UseImg.", ".$newSynRSS091UseImg.", '".$newSynRSS091Text."'"
			.", ".$newSynRSS10UseImg.", '".$newSynRSS10Text."'"
			.", ".$newSynRSS20UseImg.", '".$newSynRSS20Text."'"
			.", ".$newSynATOM03UseImg.", '".$newSynATOM03Text."'"
			.", ".$newSynOPMLUseImg.", '".$newSynOPMLText."'"
			.", ".$newSynUseCFeed.", '".$newSynCFeedText."', '".$newSynCFeedType."'"
			.", ".$newSynUseCFeedImg.", ".$newSynCFeedAmount;
			
			$maintag = $tcms_main->getNewUID(11, 'newsmanager');
			
			$sqlQR = $sqlAL->sqlCreateOne(
				$tcms_db_prefix.'newsmanager', 
				$newSQLColumns, 
				$newSQLData, 
				$maintag
			);
		}
	}
	
	if($extra == 1){
		if($setLang != '') {
			$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news'
			.'&todo=config&action='.$action.'&lang='.$setLang.'\''
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news'
			.'&todo=config&action='.$action.'\''
			.'</script>';
		}
	}
	else{
		if($setLang != '') {
			$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
			
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news'
			.'&todo=config&action=news&lang='.$setLang.'\''
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news'
			.'&todo=config&action=extra&lang='.$setLang.'\''
			.'</script>';
		}
	}
}





// -----------------------------------------------------
// SAVE
// -----------------------------------------------------

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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
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
			$old_default_cat = $globals_xml->readSection('global', 'default_category');
			
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
	$titel   = $tcms_main->encodeText($titel, '2', $c_charset);
	$autor   = $tcms_main->encodeText($autor, '2', $c_charset);
	$content = $tcms_main->encodeText($content, '2', $c_charset);
	
	
	$stamp = substr($new_publish_date, 6, 4).substr($new_publish_date, 3, 2).substr($new_publish_date, 0, 2).substr($new_publish_date, 11, 2).substr($new_publish_date, 14, 2);
	
	
	if($new_date == ''){ $new_date = $date; }
	if($new_time == ''){ $new_time = $time; }
	if($new_publish_date == ''){ $new_publish_date = $date.'-'.$time; }
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'w');
		$xmluser->xmlDeclaration();
		$xmluser->xmlSection('news');
		
		$xmluser->writeValue('title', $titel);
		$xmluser->writeValue('autor', $autor);
		$xmluser->writeValue('date', $new_date);
		$xmluser->writeValue('time', $new_time);
		$xmluser->writeValue('newstext', $content);
		$xmluser->writeValue('order', $order);
		$xmluser->writeValue('stamp', $stamp);
		$xmluser->writeValue('published', $new_published);
		$xmluser->writeValue('publish_date', $new_publish_date);
		$xmluser->writeValue('comments_enabled', $new_comments_en);
		$xmluser->writeValue('image', $news_image);
		$xmluser->writeValue('category', $new_cat);
		$xmluser->writeValue('access', $new_access);
		$xmluser->writeValue('show_on_frontpage', $new_sof);
		$xmluser->writeValue('language', $language);
		
		$xmluser->xmlSection_buffer();
		$xmluser->xmlSection_end('news');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		.$tcms_db_prefix.'news.language="'.$language.'", '
		.$tcms_db_prefix.'news.show_on_frontpage='.$new_sof;
		
		$sqlQR = $sqlAL->updateOne(
			$tcms_db_prefix.'news', 
			$newSQLData, 
			$maintag
		);
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.'.$language.'.xml','r');
		$defaultFeed = $xml->readSection('config', 'def_feed');
		$synAmount   = $xml->readSection('config', 'syn_amount');
		$showAutor   = $xml->readSection('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$strQuery = "SELECT * "
		."FROM ".$tcms_db_prefix."newsmanager "
		."WHERE language = '".$language."'";
		
		$sqlQR = $sqlAL->sqlQuery($strQuery);
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$getLang = $tcms_config->getLanguageFrontend();
	
	$tcms_dcp->generateFeed($getLang, $defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	if($draft == '1') {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\''
		.'</script>';
	}
	else {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news&todo=edit&maintag='.$maintag.'\''
		.'</script>';
	}
}





// -----------------------------------------------------
// CREATE
// -----------------------------------------------------

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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
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
		$xmluser->xmlDeclaration();
		$xmluser->xmlSection('news');
		
		$xmluser->writeValue('title', $titel);
		$xmluser->writeValue('autor', $autor);
		$xmluser->writeValue('date', $new_date);
		$xmluser->writeValue('time', $new_time);
		$xmluser->writeValue('newstext', $content);
		$xmluser->writeValue('order', $order);
		$xmluser->writeValue('stamp', $stamp);
		$xmluser->writeValue('published', $new_published);
		$xmluser->writeValue('publish_date', $new_publish_date);
		$xmluser->writeValue('comments_enabled', $new_comments_en);
		$xmluser->writeValue('image', $news_image);
		$xmluser->writeValue('category', $new_cat);
		$xmluser->writeValue('access', $new_access);
		$xmluser->writeValue('show_on_frontpage', $new_sof);
		$xmluser->writeValue('language', $language);
		
		$xmluser->xmlSection_buffer();
		$xmluser->xmlSection_end('news');
		$xmluser->_xmlparser();
		
		$old_umask = umask(0);
		mkdir('../../'.$tcms_administer_site.'/tcms_news/comments_'.$maintag.'/', 0777);
		umask($old_umask);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($choosenDB){
			case 'mysql':
				$newSQLColumns = '`title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, '
				.'`publish_date`, `comments_enabled`, `image`, `access`, `show_on_frontpage`, `language`';
				break;
			
			case 'pgsql':
				$newSQLColumns = 'title, autor, date, "time", newstext, stamp, published, '
				.'publish_date, comments_enabled, image, "access", "show_on_frontpage", "language"';
				break;
			
			case 'mssql':
				$newSQLColumns = '[title], [autor], [date], [time], [newstext], [stamp], [published], '
				.'[publish_date], [comments_enabled], [image], [access], [show_on_frontpage], [language]';
				break;
		}
		
		$newSQLData = "'".$titel."', '".$autor."', '".$new_date."', '".$new_time."', '".$content."', "
		.$stamp.", ".$new_published.", '".$new_publish_date."', ".$new_comments_en.", '".$news_image."', "
		."'".$new_access."', ".$new_sof.", '".$language."'";
		
		$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news', $newSQLColumns, $newSQLData, $maintag);
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.'.$language.'.xml','r');
		$defaultFeed = $xml->readSection('config', 'def_feed');
		$synAmount   = $xml->readSection('config', 'syn_amount');
		$showAutor   = $xml->readSection('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$strQuery = "SELECT * "
		."FROM ".$tcms_db_prefix."newsmanager "
		."WHERE language = '".$language."'";
		
		$sqlQR = $sqlAL->sqlQuery($strQuery);
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$getLang = $tcms_config->getLanguageFrontend();
	
	$tcms_dcp->generateFeed($getLang, $defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	if($draft == '1') {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\''
		.'</script>';
	}
	else {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news&todo=edit&maintag='.$maintag.'\''
		.'</script>';
	}
}





// -----------------------------------------------------==============================
// ENABLE / DISABLE COMMENTS
// -----------------------------------------------------==============================

if($todo == 'enableComments'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){
				xmlparser::edit_value(
					'../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 
					'comments_enabled', 
					'1', 
					'0'
				);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'news.comments_enabled=0';
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
				.'</script>';
			}
			else{
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';'
				.'</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'comments_enabled', '0', '1'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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





// -----------------------------------------------------==============================
// PUBLISH / UNPUBLISH
// -----------------------------------------------------==============================

if($todo == 'publishItem'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml'){ xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'published', '1', '0'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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





// -----------------------------------------------------==============================
// ENABLE FRONTPAGE
// -----------------------------------------------------==============================

if($todo == 'enableFrontpage'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml') {
				xmlparser::edit_value('../../'.$tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'show_on_frontpage', '1', '0');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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





// -----------------------------------------------------==============================
// DELETE
// -----------------------------------------------------==============================

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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'news', $maintag);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'comments', $maintag);
		$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."news_to_categories WHERE news_uid = '".$maintag."'");
	}
	
	// regenerate feeds
	if($choosenDB == 'xml'){
		$xml = new xmlparser(
			'../../'.$tcms_administer_site.'/tcms_global/newsmanager.'.$tcms_config->getLanguageFrontend().'.xml',
			'r'
		);
		$defaultFeed = $xml->readSection('config', 'def_feed');
		$synAmount   = $xml->readSection('config', 'syn_amount');
		$showAutor   = $xml->readSection('config', 'show_autor');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$strQuery = "SELECT * "
		."FROM ".$tcms_db_prefix."newsmanager "
		."WHERE language = '".$tcms_config->getLanguageFrontend()."'";
		
		$sqlQR = $sqlAL->sqlQuery($strQuery);
		$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
		
		$defaultFeed = $sqlObj->def_feed;
		$synAmount   = $sqlObj->syn_amount;
		$showAutor   = $sqlObj->show_autor;
		
		if($defaultFeed == NULL){ $defaultFeed = 'RSS2.0'; }
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	$getLang = $tcms_config->getLanguageFrontend();
	
	$tcms_dcp->generateFeed($getLang, $defaultFeed, $seoFolder, true, $synAmount, $showAutor);
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news\';</script>';
}

?>
