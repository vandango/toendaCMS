<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Global Configuration
|
| File:		mod_global.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Global Configuration
 * 
 * This module is for the global configuration settings.
 * 
 * @version 1.1.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Admin Backend
 * 
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }

if(isset($_GET['old_engine'])){ $old_engine = $_GET['old_engine']; }
if(isset($_GET['new_engine'])){ $new_engine = $_GET['new_engine']; }
if(isset($_GET['new_user'])){ $new_user = $_GET['new_user']; }
if(isset($_GET['new_password'])){ $new_password = $_GET['new_password']; }
if(isset($_GET['new_host'])){ $new_host = $_GET['new_host']; }
if(isset($_GET['new_database'])){ $new_database = $_GET['new_database']; }
if(isset($_GET['new_port'])){ $new_port = $_GET['new_port']; }
if(isset($_GET['this_engine'])){ $this_engine = $_GET['this_engine']; }
if(isset($_GET['new_prefix'])){ $new_prefix = $_GET['new_prefix']; }

if(isset($_POST['_RELOCATE'])){ $_RELOCATE = $_POST['_RELOCATE']; }
if(isset($_POST['action'])){ $action = $_POST['action']; }

if(isset($_POST['title'])){ $title = $_POST['title']; }
if(isset($_POST['name'])){ $name = $_POST['name']; }
if(isset($_POST['new_key'])){ $new_key = $_POST['new_key']; }
if(isset($_POST['tmp_logo'])){ $tmp_logo = $_POST['tmp_logo']; }
if(isset($_POST['logo'])){ $logo = $_POST['logo']; }
if(isset($_POST['owner'])){ $owner = $_POST['owner']; }
if(isset($_POST['owner_url'])){ $owner_url = $_POST['owner_url']; }
if(isset($_POST['copy'])){ $copy = $_POST['copy']; }
if(isset($_POST['email'])){ $email = $_POST['email']; }
if(isset($_POST['new_show_tcmslogo'])){ $new_show_tcmslogo = $_POST['new_show_tcmslogo']; }
if(isset($_POST['new_show_plt'])){ $new_show_plt = $_POST['new_show_plt']; }
if(isset($_POST['menu'])){ $menu = $_POST['menu']; }
if(isset($_POST['second_menu'])){ $second_menu = $_POST['second_menu']; }
if(isset($_POST['keywords'])){ $keywords = $_POST['keywords']; }
if(isset($_POST['charset'])){ $charset = $_POST['charset']; }
if(isset($_POST['tmp_use_wysiwyg'])){ $tmp_use_wysiwyg = $_POST['tmp_use_wysiwyg']; }
if(isset($_POST['tmp_lang'])){ $tmp_lang = $_POST['tmp_lang']; }
if(isset($_POST['tmp_front_lang'])){ $tmp_front_lang = $_POST['tmp_front_lang']; }
if(isset($_POST['description'])){ $description = $_POST['description']; }
if(isset($_POST['tmp_currency'])){ $tmp_currency = $_POST['tmp_currency']; }
if(isset($_POST['new_tcmsinst'])){ $new_tcmsinst = $_POST['new_tcmsinst']; }
if(isset($_POST['new_default_cat'])){ $new_default_cat = $_POST['new_default_cat']; }
if(isset($_POST['new_legallink'])){ $new_legallink = $_POST['new_legallink']; }
if(isset($_POST['new_adminlink'])){ $new_adminlink = $_POST['new_adminlink']; }
if(isset($_POST['new_topmenu_active'])){ $new_topmenu_active = $_POST['new_topmenu_active']; }
if(isset($_POST['new_footer_text'])){ $new_footer_text = $_POST['new_footer_text']; }
if(isset($_POST['new_show_defaultfoot'])){ $new_show_defaultfoot = $_POST['new_show_defaultfoot']; }
if(isset($_POST['new_statistics'])){ $new_statistics = $_POST['new_statistics']; }
if(isset($_POST['new_seo_enabled'])){ $new_seo_enabled = $_POST['new_seo_enabled']; }
if(isset($_POST['new_seo_folder'])){ $new_seo_folder = $_POST['new_seo_folder']; }
if(isset($_POST['new_site_offline'])){ $new_site_offline = $_POST['new_site_offline']; }
if(isset($_POST['new_site_off_text'])){ $new_site_off_text = $_POST['new_site_off_text']; }
if(isset($_POST['new_show_top_pages'])){ $new_show_top_pages = $_POST['new_show_top_pages']; }
if(isset($_POST['new_cipher_email'])){ $new_cipher_email = $_POST['new_cipher_email']; }
if(isset($_POST['new_js_browser_detect'])){ $new_js_browser_detect = $_POST['new_js_browser_detect']; }
if(isset($_POST['new_use_cs'])){ $new_use_cs = $_POST['new_use_cs']; }
if(isset($_POST['new_captcha'])){ $new_captcha = $_POST['new_captcha']; }
if(isset($_POST['new_captcha_clean'])){ $new_captcha_clean = $_POST['new_captcha_clean']; }
if(isset($_POST['new_seo_format'])){ $new_seo_format = $_POST['new_seo_format']; }
if(isset($_POST['new_doc_autor'])){ $new_doc_autor = $_POST['new_doc_autor']; }
if(isset($_POST['new_admin_topmenu'])){ $new_admin_topmenu = $_POST['new_admin_topmenu']; }
if(isset($_POST['new_pathchar'])){ $new_pathchar = $_POST['new_pathchar']; }
if(isset($_POST['new_revisit_after'])){ $new_revisit_after = $_POST['new_revisit_after']; }
if(isset($_POST['new_robotsfile'])){ $new_robotsfile = $_POST['new_robotsfile']; }
if(isset($_POST['new_pdflink'])){ $new_pdflink = $_POST['new_pdflink']; }
if(isset($_POST['new_cache_control'])){ $new_cache_control = $_POST['new_cache_control']; }
if(isset($_POST['new_pragma'])){ $new_pragma = $_POST['new_pragma']; }
if(isset($_POST['new_expires'])){ $new_expires = $_POST['new_expires']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['new_robots'])){ $new_robots = $_POST['new_robots']; }
if(isset($_POST['new_last_changes'])){ $new_last_changes = $_POST['new_last_changes']; }
if(isset($_POST['new_use_content_l'])){ $new_use_content_l = $_POST['new_use_content_l']; }

if(isset($_POST['new_mail_with_smtp'])){ $new_mail_with_smtp = $_POST['new_mail_with_smtp']; }
if(isset($_POST['new_mail_as_html'])){ $new_mail_as_html = $_POST['new_mail_as_html']; }
if(isset($_POST['new_mail_server_pop3'])){ $new_mail_server_pop3 = $_POST['new_mail_server_pop3']; }
if(isset($_POST['new_mail_server_smtp'])){ $new_mail_server_smtp = $_POST['new_mail_server_smtp']; }
if(isset($_POST['new_mail_port'])){ $new_mail_port = $_POST['new_mail_port']; }
if(isset($_POST['new_mail_pop3'])){ $new_mail_pop3 = $_POST['new_mail_pop3']; }
if(isset($_POST['new_mail_user'])){ $new_mail_user = $_POST['new_mail_user']; }
if(isset($_POST['new_mail_password'])){ $new_mail_password = $_POST['new_mail_password']; }

if(isset($_POST['new_text_width'])){ $new_text_width = $_POST['new_text_width']; }
if(isset($_POST['new_input_width'])){ $new_input_width = $_POST['new_input_width']; }
if(isset($_POST['new_news_publish'])){ $new_news_publish = $_POST['new_news_publish']; }
if(isset($_POST['new_img_publish'])){ $new_img_publish = $_POST['new_img_publish']; }
if(isset($_POST['new_alb_publish'])){ $new_alb_publish = $_POST['new_alb_publish']; }
if(isset($_POST['new_cat_publish'])){ $new_cat_publish = $_POST['new_cat_publish']; }
if(isset($_POST['new_pic_publish'])){ $new_pic_publish = $_POST['new_pic_publish']; }

if(isset($_POST['old_engine'])){ $old_engine = $_POST['old_engine']; }
if(isset($_POST['new_engine'])){ $new_engine = $_POST['new_engine']; }
if(isset($_POST['new_user'])){ $new_user = $_POST['new_user']; }
if(isset($_POST['new_password'])){ $new_password = $_POST['new_password']; }
if(isset($_POST['new_host'])){ $new_host = $_POST['new_host']; }
if(isset($_POST['new_database'])){ $new_database = $_POST['new_database']; }
if(isset($_POST['new_port'])){ $new_port = $_POST['new_port']; }
if(isset($_POST['this_engine'])){ $this_engine = $_POST['this_engine']; }
if(isset($_POST['new_prefix'])){ $new_prefix = $_POST['new_prefix']; }
if(isset($_POST['with_output'])){ $with_output = $_POST['with_output']; }
if(isset($_POST['structure_only'])){ $structure_only = $_POST['structure_only']; }
if(isset($_POST['new_anti_frame'])){ $new_anti_frame = $_POST['new_anti_frame']; }




if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	// title
	$namen_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/namen.xml','r');
	
	$sitetitle = $namen_xml->read_section('namen', 'title');
	$sitename  = $namen_xml->read_section('namen', 'name');
	$sitekey   = $namen_xml->read_section('namen', 'key');
	$logo      = $namen_xml->read_section('namen', 'logo');
	
	
	// footer
	$footer_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml','r');
	
	$old_websiteowner = $footer_xml->read_section('footer', 'websiteowner');
	$old_owner_url    = $footer_xml->read_section('footer', 'owner_url');
	$old_copyright    = $footer_xml->read_section('footer', 'copyright');
	$old_owner_email  = $footer_xml->read_section('footer', 'email');
	$show_tcmslogo    = $footer_xml->read_section('footer', 'show_tcmslogo');
	$show_defaultfoot = $footer_xml->read_section('footer', 'show_defaultfooter');
	$show_plt         = $footer_xml->read_section('footer', 'show_page_loading_time');
	$old_legallink    = $footer_xml->read_section('footer', 'legal_link_in_footer');
	$old_adminlink    = $footer_xml->read_section('footer', 'admin_link_in_footer');
	$old_footer_text  = $footer_xml->read_section('footer', 'footer_text');
	
	if(!isset($show_defaultfoot) || $show_defaultfoot == ''){
		$show_defaultfoot = 1;
	}
	
	
	// var
	$globals_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
	
	$old_menu           = $globals_xml->read_section('global', 'menu');
	$old_second_menu    = $globals_xml->read_section('global', 'second_menu');
	$old_charset        = $globals_xml->read_section('global', 'charset');
	$old_use_wysiwyg    = $globals_xml->read_section('global', 'wysiwyg');
	$old_lang           = $globals_xml->read_section('global', 'lang');
	$old_currency       = $globals_xml->read_section('global', 'currency');
	$old_front_lang     = $globals_xml->read_section('global', 'front_lang');
	$old_keywords       = $globals_xml->read_section('global', 'meta');
	$old_description    = $globals_xml->read_section('global', 'description');
	$old_tcmsinst       = $globals_xml->read_section('global', 'toendacms_in_sitetitle');
	$old_default_cat    = $globals_xml->read_section('global', 'default_category');
	$old_topmenu_active = $globals_xml->read_section('global', 'topmenu_active');
	$old_statistics     = $globals_xml->read_section('global', 'statistics');
	$old_seo_enabled    = $globals_xml->read_section('global', 'seo_enabled');
	$old_seo_folder     = $globals_xml->read_section('global', 'server_folder');
	$old_seo_format     = $globals_xml->read_section('global', 'seo_format');
	$old_site_offline   = $globals_xml->read_section('global', 'site_offline');
	$old_site_off_text  = $globals_xml->read_section('global', 'site_offline_text');
	$old_show_top_pages = $globals_xml->read_section('global', 'show_top_pages');
	$cipher_email       = $globals_xml->read_section('global', 'cipher_email');
	$js_browser_detect  = $globals_xml->read_section('global', 'js_browser_detect');
	$use_cs             = $globals_xml->read_section('global', 'use_cs');
	$captcha            = $globals_xml->read_section('global', 'captcha');
	$captcha_clean      = $globals_xml->read_section('global', 'captcha_clean_size');
	$old_doc_autor      = $globals_xml->read_section('global', 'show_doc_autor');
	$old_admin_topmenu  = $globals_xml->read_section('global', 'admin_topmenu');
	$old_pathchar       = $globals_xml->read_section('global', 'pathway_char');
	$anti_frame         = $globals_xml->read_section('global', 'anti_frame');
	$old_revisit_after  = $globals_xml->read_section('global', 'revisit_after');
	$old_robotsfile     = $globals_xml->read_section('global', 'robotsfile');
	$old_pdflink        = $globals_xml->read_section('global', 'pdflink');
	$old_cache_control  = $globals_xml->read_section('global', 'cachecontrol');
	$old_pragma         = $globals_xml->read_section('global', 'pragma');
	$old_expires        = $globals_xml->read_section('global', 'expires');
	$old_robots         = $globals_xml->read_section('global', 'robots');
	$old_last_changes   = $globals_xml->read_section('global', 'last_changes');
	$old_use_content_l  = $globals_xml->read_section('global', 'use_content_language');
	
	
	// userpage
	if($choosenDB == 'xml'){
		$contactform_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/userpage.xml','r');
		$old_text_width   = $contactform_xml->read_section('userpage', 'text_width');
		$old_input_width  = $contactform_xml->read_section('userpage', 'input_width');
		$old_news_publish = $contactform_xml->read_section('userpage', 'news_publish');
		$old_img_publish  = $contactform_xml->read_section('userpage', 'image_publish');
		$old_alb_publish  = $contactform_xml->read_section('userpage', 'album_publish');
		$old_cat_publish  = $contactform_xml->read_section('userpage', 'cat_publish');
		$old_pic_publish  = $contactform_xml->read_section('userpage', 'pic_publish');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'userpage', 'userpage');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$old_text_width   = $sqlARR['text_width'];
		$old_input_width  = $sqlARR['input_width'];
		$old_news_publish = $sqlARR['news_publish'];
		$old_img_publish  = $sqlARR['image_publish'];
		$old_alb_publish  = $sqlARR['album_publish'];
		$old_cat_publish  = $sqlARR['cat_publish'];
		$old_pic_publish  = $sqlARR['pic_publish'];
	}
	
	
	
	
	
	/*
		charsets
	*/
	
	$sitetitle        = $tcms_main->decodeText($sitetitle, '2', $c_charset);
	$sitename         = $tcms_main->decodeText($sitename, '2', $c_charset);
	$sitekey          = $tcms_main->decodeText($sitekey, '2', $c_charset);
	$logo             = $tcms_main->decodeText($logo, '2', $c_charset);
	$old_websiteowner = $tcms_main->decodeText($old_websiteowner, '2', $c_charset);
	$old_owner_url    = $tcms_main->decodeText($old_owner_url, '2', $c_charset);
	$old_copyright    = $tcms_main->decodeText($old_copyright, '2', $c_charset);
	$old_owner_email  = $tcms_main->decodeText($old_owner_email, '2', $c_charset);
	$old_keywords     = $tcms_main->decodeText($old_keywords, '2', $c_charset);
	$old_description  = $tcms_main->decodeText($old_description, '2', $c_charset);
	$old_footer_text  = $tcms_main->decodeText($old_footer_text, '2', $c_charset);
	
	$sitetitle        = htmlspecialchars($sitetitle);
	$sitetitle        = htmlspecialchars($sitetitle);
	$sitename         = htmlspecialchars($sitename);
	$sitekey          = htmlspecialchars($sitekey);
	$logo             = htmlspecialchars($logo);
	$old_websiteowner = htmlspecialchars($old_websiteowner);
	$old_owner_url    = htmlspecialchars($old_owner_url);
	$old_copyright    = htmlspecialchars($old_copyright);
	$old_owner_email  = htmlspecialchars($old_owner_email);
	$old_keywords     = htmlspecialchars($old_keywords);
	$old_description  = htmlspecialchars($old_description);
	$old_footer_text  = htmlspecialchars($old_footer_text);
	
	
	
	
	
	if($todo != 'optimize' && $todo != 'backup'){
		echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
		<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
		<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->
		<script>
		var _tcmsVALUE = "Site is proudly powered by toendaCMS &#169; 2003 - 2007 Toenda Software Development. All rights reserved.<br />toendaCMS is Free Software released under the GNU/GPL License.<br />";
		</script>';
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_global" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="save" />'
		.'<input name="action" type="hidden" value="'.$action.'" />';
		
		
		/*
			tabpane start
		*/
		
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			site tab
		*/
		
		echo '<div class="tab-page" id="tab-page-site">'
		.'<h2 class="tab">'._GLOBAL.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'
		._GLOBAL_SITE_OFFLINE.'</td>'
		.'<td>'
		.'<input type="radio" name="new_site_offline" id="config_offline0" value="0"'.($old_site_offline == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input type="radio" name="new_site_offline" id="config_offline1" value="1"'.($old_site_offline == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25" valign="top">'
		._GLOBAL_SITE_OFFLINE_TEXT.'</td>'
		.'<td valign="top">'
		.'<textarea name="new_site_off_text" class="tcms_textarea_big">'.$old_site_off_text.'</textarea>'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25" valign="top">'
		._GLOBAL_TITLE.'</td>'
		.'<td>'
		.'<input name="title" class="tcms_input_normal" value="'.$sitetitle.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_NAME.'</td>'
		.'<td>'
		.'<input name="name" class="tcms_input_normal" value="'.$sitename.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SUBTITLE.'</td>'
		.'<td>'
		.'<input name="new_key" class="tcms_input_normal" value="'.$sitekey.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25" valign="top">'._GLOBAL_LOGO.'</td>'
		.'<td>'
		.'<input title="Old Logo" name="tmp_logo" class="tcms_input_normal" value="'.$logo.'" />'
		.'<br /><img src="../images/px.png" border="0" width="9" height="18" />'
		.'<input class="tcms_upload" name="logo" type="file" accept="image/*" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_OWNER.'</td>'
		.'<td>'
		.'<input name="owner" class="tcms_input_normal" value="'.$old_websiteowner.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_URL.'</td>'
		.'<td>'
		.'<input name="owner_url" class="tcms_input_normal" value="'.$old_owner_url.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_EMAIL.'</td>'
		.'<td>'
		.'<input name="email" class="tcms_input_normal" value="'.$old_owner_email.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_YEAR.'</td>'
		.'<td>'
		.'<input name="copy" class="tcms_input_normal" value="'.$old_copyright.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_DEFAULT_FOOTER.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_show_defaultfoot"'.($show_defaultfoot == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_TCMSLOGO.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_show_tcmslogo"'.($show_tcmslogo == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_TCMSLOGO_IN_SITETITLE.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_tcmsinst"'.($old_tcmsinst == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_PAGELOADINGTIME.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_show_plt"'.($show_plt == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_USE_STATISTICS.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_statistics"'.($old_statistics == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_JS_BROWSER_DETECTION.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_js_browser_detect"'.($js_browser_detect == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SHOW_DOC_AUTOR.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_doc_autor"'.($old_doc_autor == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_USE_CS.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_cs"'.($use_cs == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_USE_NEW_ADMINMENU.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_admin_topmenu"'.($old_admin_topmenu == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_USE_CONTENT_LANG.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_use_content_l"'.($old_use_content_l == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CHARSET.'</td>'
		.'<td>'
		.'<select name="charset" class="tcms_select">';
		foreach($arr_char as $ch_key => $ch_value){
			echo '<option value="'.$ch_value.'"'.( $old_charset == $ch_value ? ' selected="selected"' : '' ).'>'.$ch_value.'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_LANG.'</td>'
		.'<td>'
		.'<select name="tmp_lang" class="tcms_select">';
		foreach($arr_lang as $lg_key => $lg_value){
			echo '<option value="'.$lg_value.'"'.( $old_lang == $lg_value ? ' selected="selected"' : '' ).'>'.$lg_value.'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_FRONT_LANG.'</td>'
		.'<td>'
		.'<select name="tmp_front_lang" class="tcms_select">';
		foreach($arr_lang as $lg_key => $lg_value){
			echo '<option value="'.$lg_value.'"'.( $old_front_lang == $lg_value ? ' selected="selected"' : '' ).'>'.$lg_value.'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CURRENCY.'</td>'
		.'<td>'
		.'<select name="tmp_currency" class="tcms_select">';
		foreach($arr_currency['name'] as $lg_key => $lg_value){
			echo '<option value="'.$arr_currency['code'][$lg_key].'"'.( $old_currency == $arr_currency['code'][$lg_key] ? ' selected="selected"' : '' ).'>'.$lg_value.'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_WYSIWYG.'</td>'
		.'<td>'
		.'<select name="tmp_use_wysiwyg" class="tcms_select">'
			.( file_exists('../js/tinymce') ? '<option value="tinymce"'.( $old_use_wysiwyg == 'tinymce' ? ' selected="selected"' : '' ).'>tinyMCE</option>' : '' )
			.( file_exists('../js/FCKeditor') ? '<option value="fckeditor"'.( $old_use_wysiwyg == 'fckeditor' ? ' selected="selected"' : '' ).'>FCKEditor</option>' : '' )
			.'<option value="toendaScript"'.( $old_use_wysiwyg == 'toendaScript' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.' WYSIWYG (toendaScript)</option>'
			.'<option value="no"'.(           $old_use_wysiwyg == 'no'           ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.' WYSIWYG (HTML)</option>'
		.'</select></td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top" height="25">'._TABLE_DEFAULT_NEWS_CATEGORY.'</td>'
		.'<td valign="top">'
		.'<select name="new_default_cat" class="tcms_select">';
		foreach($arrNewsCat['tag'] as $key => $value){
			echo '<option value="'.$value.'"'.( $old_default_cat == $value ? ' selected="selected"' : '' ).'>'.$arrNewsCat['name'][$key].'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top" height="25">'._GLOBAL_FOOTER_TEXT.'</td>'
		.'<td valign="top">'
		.'<textarea id="new_footer_text" name="new_footer_text" class="tcms_textarea_big">'.$old_footer_text.'</textarea>'
		.'<br /><img src="../images/px.png" width="9" height="9" border="0" style="margin: 5px 2px 0 0 !important;" align="left" />'
		.'<input type="button" name="_paste_tcmsVALUE" value="'._GLOBAL_PASTE_FOOTER_TEXT.'" onclick="document.getElementById(\'new_footer_text\').value = document.getElementById(\'new_footer_text\').value + _tcmsVALUE" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			security tab
		*/
		
		echo '<div class="tab-page" id="tab-page-sec">'
		.'<h2 class="tab">'._GLOBAL_SECURITY.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CIPHER_EMAIL.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_cipher_email"'.($cipher_email == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CIPHER_EMAIL.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_cipher_email"'.($cipher_email == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CAPTCHA.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_captcha"'.($captcha == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CAPTCHA_CLEAN.'</td>'
		.'<td>'
		.'<input name="new_captcha_clean" class="tcms_id_box" value="'.$captcha_clean.'" />'
		.'&nbsp;KB'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_ANTI_FRAME.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_anti_frame"'.($anti_frame == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			navi tab
		*/
		
		echo '<div class="tab-page" id="tab-page-navi">'
		.'<h2 class="tab">'._GLOBAL_SITE_NAVI.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SITE_NAVI_TOP.'</td>'
		.'<td>'
		.'<input type="checkbox" name="second_menu"'.($old_second_menu == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SITE_NAVI_SIDE.'</td>'
		.'<td>'
		.'<input type="checkbox" name="menu"'.($old_menu == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_LEGAL_LINK_IN_FOOTER.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_legallink"'.($old_legallink == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_ADMIN_LINK_IN_FOOTER.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_adminlink"'.($old_adminlink == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_ACTIVE_TOPMENU_LINKS.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_topmenu_active"'.($old_topmenu_active == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SHOW_TOP_PAGES.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_show_top_pages"'.($old_show_top_pages == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_PATHWAY_CHAR.'</td>'
		.'<td>'
		.'<input name="new_pathchar" class="tcms_id_box" value="'.$old_pathchar.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_PDFLINK_IN_FOOTER.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_pdflink"'.($old_pdflink == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			mail tab
		*/
		
		echo '<div class="tab-page" id="tab-page-mail">'
		.'<h2 class="tab">'._GLOBAL_MAIL_SETTINGS.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._GLOBAL_MAIL_WITH_SMTP.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_mail_with_smtp"'.($mail_with_smtp == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._GLOBAL_MAIL_AS_HTML.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_mail_as_html"'.($mail_as_html == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_MAIL_SERVER.'</td>'
		.'<td>'
		.'<input name="new_mail_server_pop3" class="tcms_input_normal" value="'.$mail_server_pop3.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_MAIL_SERVER_SMTP.'</td>'
		.'<td>'
		.'<input name="new_mail_server_smtp" class="tcms_input_normal" value="'.$mail_server_smtp.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_MAIL_PORT.'</td>'
		.'<td>'
		.'<input name="new_mail_port" class="tcms_id_box" value="'.$mail_port.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'._GLOBAL_MAIL_POP3.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_mail_pop3"'.($mail_pop3 == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_MAIL_USER.'</td>'
		.'<td>'
		.'<input name="new_mail_user" class="tcms_input_normal" value="'.$mail_user.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_MAIL_PASSWORD.'</td>'
		.'<td>'
		.'<input name="new_mail_password" class="tcms_input_normal" value="'.$mail_password.'" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			meta tab
		*/
		
		echo '<div class="tab-page" id="tab-page-meta">'
		.'<h2 class="tab">'._GLOBAL_METATAGS.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top" height="25">'._GLOBAL_METATAGS.'</td>'
		.'<td valign="top">'
		.'<textarea name="keywords" class="tcms_textarea_big">'.$old_keywords.'</textarea>'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top" height="25">'._GLOBAL_DESCRIPTION.'</td>'
		.'<td valign="top">'
		.'<textarea name="description" class="tcms_textarea_big">'.$old_description.'</textarea>'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_REVISIT_AFTER.'</td>'
		.'<td>'
		.'<input name="new_revisit_after" class="tcms_id_box" value="'.$old_revisit_after.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_ROBOTSFILE.'</td>'
		.'<td>'
		.'<input name="new_robotsfile" class="tcms_input_normal" value="'.$old_robotsfile.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CACHE_CONTROL.'</td>'
		.'<td>'
		.'<input name="new_cache_control" class="tcms_input_normal" value="'.$old_cache_control.'" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_PRAGMA.'</td>'
		.'<td>'
		.'<input name="new_pragma" class="tcms_input_normal" value="'.$old_pragma.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_EXPIRES.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_expires"'.($old_expires == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_ROBOTSSETTINGS.'</td>'
		.'<td>'
		.'<input name="new_robots" class="tcms_input_normal" value="'.$old_robots.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_LAST_CHANGES.'</td>'
		.'<td>'
		.$old_last_changes
		.'<input name="new_last_changes" type="hidden" value="'.$old_last_changes.'" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			seo tab
		*/
		
		echo '<div class="tab-page" id="tab-page-seo">'
		.'<h2 class="tab">'._GLOBAL_SEO.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SEO_ENABLED.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_seo_enabled"'.($old_seo_enabled == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_SEO_FOLDER.'</td>'
		.'<td>'
		.'<input name="new_seo_folder" class="tcms_input_normal" value="'.$old_seo_folder.'" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini">'._GLOBAL_SEO_FORMAT.'</td>'
		.'<td>'
		.'<input type="radio" name="new_seo_format" id="config_offline0" value="0"'.($old_seo_format == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">index.php/section:frontpage/</label><br />'
		.'<input type="radio" name="new_seo_format" id="config_offline1" value="1"'.($old_seo_format == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">index.php/section/frontpage/</label>'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			userpage tab
		*/
		
		echo '<div class="tab-page" id="tab-page-userpage">'
		.'<h2 class="tab">'._USERPAGE.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_TEXT_WIDTH.'</td>'
		.'<td><input type="text" name="new_text_width" class="tcms_id_box" value="'.$old_text_width.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_INPUT_WIDTH.'</td>'
		.'<td><input type="text" name="new_input_width" class="tcms_id_box" value="'.$old_input_width.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_PUBLISH_NEWS.'</td>'
		.'<td><input type="checkbox" name="new_news_publish"'.( $old_news_publish == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_PUBLISH_IMAGES.'</td>'
		.'<td><input type="checkbox" name="new_img_publish"'.( $old_img_publish == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_PUBLISH_ALBUMS.'</td>'
		.'<td><input type="checkbox" name="new_alb_publish"'.( $old_alb_publish == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_CREATE_CATEGORIES.'</td>'
		.'<td><input type="checkbox" name="new_cat_publish"'.( $old_cat_publish == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._USERPAGE_PUBLISH_PICTURE.'</td>'
		.'<td><input type="checkbox" name="new_pic_publish"'.( $old_pic_publish == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			db tab
		*/
		
		echo '<div class="tab-page" id="tab-page-db">'
		.'<h2 class="tab">'._DB_DB.'</h2>'
		.'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		$old_engine   = $choosenDB;
		$old_user     = $sqlUser;
		$old_password = $sqlPass;
		$old_host     = $sqlHost;
		$old_datadase = $sqlDB;
		$old_port     = $sqlPort;
		$old_prefix   = $sqlPrefix;
		
		if($old_engine   == '')  { $old_engine   = 'xml'; }
		if($old_user     == NULL){ $old_user     = ''; }
		if($old_password == NULL){ $old_password = ''; }
		if($old_host     == NULL){ $old_host     = ''; }
		if($old_datadase == NULL){ $old_datadase = ''; }
		if($old_port     == NULL){ $old_port     = ''; }
		if($old_prefix   == NULL){ $old_prefix   = ''; }
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" width="300" height="25">'._DB_USER.'</td>'
		.'<td>'
		.'<input name="new_user" class="tcms_input_normal" value="'.$old_user.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_PASSWORD.'</td>'
		.'<td>'
		.'<input name="new_password" class="tcms_input_normal" value="'.$old_password.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_HOST.'</td>'
		.'<td>'
		.'<input name="new_host" class="tcms_input_normal" value="'.$old_host.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_DATABASE.'</td>'
		.'<td>'
		.'<input name="new_database" class="tcms_input_normal" value="'.$old_datadase.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_PORT.'</td>'
		.'<td>'
		.'<input name="new_port" class="tcms_input_normal" value="'.$old_port.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_PREFIX.'</td>'
		.'<td>'
		.'<input name="new_prefix" class="tcms_input_normal" value="'.$old_prefix.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._DB_CHOOSE.'</td>'
		.'<td>'
		.'<select name="new_engine" class="tcms_upload">';
		foreach($arrDB['tech'] as $dbKey => $dbVal){
			echo '<option value="'.$dbVal.'"'.( $old_engine == $dbVal ? ' selected' : '' ).'>'.$arrDB['name'][$dbKey].'</option>';
		}
		echo '</select>'
		.'</td></tr>';
		
		
		if($choosenDB == 'mysql'){
			echo '<tr><td colspan="2" class="tcms_padding_mini">'
			.'<br /></td></tr>';
			
			
			echo '<tr><td class="tcms_padding_mini" height="25" valign="top">'._DB_OPTIMIZATION.'</td>'
			.'<td><input type="button" value="'._DB_START_OPTIMIZATION.'" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&site=mod_global&todo=optimize&this_engine='.$choosenDB.'&action='.$action.'\'" />'
			.'</td></tr>';
		}
		
		
		echo '<tr><td colspan="2" class="tcms_padding_mini">'
		.'<br /></td></tr>';
		
		
		echo '<tr><td class="tcms_padding_mini" height="25" valign="top">'._DB_BACKUP.'</td>'
		.'<td>'
		.( $old_engine != 'xml' ?
			'<div style="margin: 0; padding: 0 0 2px 0;">'
			.'<label for="with_output">'
			.'<input type="checkbox" name="with_output" id="with_output" value="1" />'
			.'&nbsp;'._DB_BACKUP_AS_FILE
			.'</label>'
			.'</div>'
			.'<div style="margin: 0; padding: 0 0 2px 0;">'
			.'<label for="structure_only">'
			.'<input type="checkbox" name="structure_only" id="structure_only" value="1" />'
			.'&nbsp;'._DB_BACKUP_AS_STRUCTURE
			.'</label>'
			.'</div>'
		: '' )
		.'<input type="button" name="this_backup" id="this_backup" value="'._DB_START_BACKUP.'" onclick="document.getElementById(\'db_backup\').submit();" />'
		.'</td></tr>';
		
		
		echo '</table>'
		.'</div>';
		
		
		/*
			tabpane end
		*/
		
		echo '</div>'
		.'<script type="text/javascript">
		var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));
		tabPane1.addTabPage(document.getElementById("tab-page-site"));
		tabPane1.addTabPage(document.getElementById("tab-page-sec"));
		tabPane1.addTabPage(document.getElementById("tab-page-navi"));
		tabPane1.addTabPage(document.getElementById("tab-page-mail"));
		tabPane1.addTabPage(document.getElementById("tab-page-meta"));
		tabPane1.addTabPage(document.getElementById("tab-page-seo"));
		tabPane1.addTabPage(document.getElementById("tab-page-userpage"));
		tabPane1.addTabPage(document.getElementById("tab-page-db"));
		setupAllTabs();
		</script>'
		.'<br />';
		
		
		// Table end
		echo '</form><br />';
	}
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	
	if($todo == 'save'){
		if(empty($new_mail_pop3) || $new_mail_pop3 == '' || !isset($new_mail_pop3)){ $new_mail_pop3 = 0; }
		
		$new_mail_with_smtp   = $tcms_main->securePassword($new_mail_with_smtp, false);
		$new_mail_as_html     = $tcms_main->securePassword($new_mail_as_html, false);
		$new_mail_server_pop3 = $tcms_main->securePassword($new_mail_server_pop3, false);
		$new_mail_server_smtp = $tcms_main->securePassword($new_mail_server_smtp, false);
		$new_mail_port        = $tcms_main->securePassword($new_mail_port, false);
		$new_mail_pop3        = $tcms_main->securePassword($new_mail_pop3, false);
		$new_mail_user        = $tcms_main->securePassword($new_mail_user, false);
		$new_mail_password    = $tcms_main->securePassword($new_mail_password, false);
		
		
		$fp_header = ''
.'<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Database Usersettings
|
| File:		mail.php
| Version:	0.0.1
|
+
*/

$tcms_mail_with_smtp   = \''.$new_mail_with_smtp.'\';
$tcms_mail_as_html     = \''.$new_mail_as_html.'\';
$tcms_mail_server_pop3 = \''.$new_mail_server_pop3.'\';
$tcms_mail_server_smtp = \''.$new_mail_server_smtp.'\';
$tcms_mail_port        = \''.$new_mail_port.'\';
$tcms_mail_pop3        = \''.$new_mail_pop3.'\';
$tcms_mail_user        = \''.$new_mail_user.'\';
$tcms_mail_password    = \''.$new_mail_password.'\';

?>
';
		
		$fp = fopen('../../'.$tcms_administer_site.'/tcms_global/mail.php', 'w');
		fwrite($fp, $fp_header);
		fclose($fp);
		
		
		
		if(empty($new_text_width)   || $new_text_width   == ''){ $new_text_width   = 150; }
		if(empty($new_input_width)  || $new_input_width  == ''){ $new_input_width  = 150; }
		if(empty($new_news_publish) || $new_news_publish == ''){ $new_news_publish = 0; }
		if(empty($new_img_publish)  || $new_img_publish  == ''){ $new_img_publish  = 0; }
		if(empty($new_alb_publish)  || $new_alb_publish  == ''){ $new_alb_publish  = 0; }
		if(empty($new_cat_publish)  || $new_cat_publish  == ''){ $new_cat_publish  = 0; }
		if(empty($new_pic_publish)  || $new_pic_publish  == ''){ $new_pic_publish  = 0; }
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/userpage.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('userpage');
			
			$xmluser->write_value('text_width', $new_text_width);
			$xmluser->write_value('input_width', $new_input_width);
			$xmluser->write_value('news_publish', $new_news_publish);
			$xmluser->write_value('image_publish', $new_img_publish);
			$xmluser->write_value('album_publish', $new_alb_publish);
			$xmluser->write_value('cat_publish', $new_cat_publish);
			$xmluser->write_value('pic_publish', $new_pic_publish);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('userpage');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'userpage.text_width="'.$new_text_width.'", '
			.$tcms_db_prefix.'userpage.input_width="'.$new_input_width.'", '
			.$tcms_db_prefix.'userpage.news_publish='.$new_news_publish.', '
			.$tcms_db_prefix.'userpage.image_publish='.$new_img_publish.', '
			.$tcms_db_prefix.'userpage.album_publish='.$new_alb_publish.', '
			.$tcms_db_prefix.'userpage.cat_publish='.$new_cat_publish.', '
			.$tcms_db_prefix.'userpage.pic_publish='.$new_pic_publish;
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'userpage', $newSQLData, 'userpage');
		}
		
		
		
		//***********
		// Image
		//
		if($_FILES['logo']['size'] > 0 && (
		$_FILES['logo']['type'] == 'image/gif' || 
		$_FILES['logo']['type'] == 'image/png' || 
		$_FILES['logo']['type'] == 'image/jpg' || 
		$_FILES['logo']['type'] == 'image/jpeg' || 
		$_FILES['logo']['type'] == 'image/bmp')){
			$fileName = $_FILES['logo']['name'];
			$imgDir = '../../'.$tcms_administer_site.'/images/Image/';
			
			$logo = $_FILES['logo']['name'];
			
			//$fileName = $tcms_main->encodeText_without_crypt($fileName, '2', $c_charset);
			
			if(!file_exists('../../'.$tcms_administer_site.'/images/Image/'.$_FILES['logo']['name'])){
				copy($_FILES['logo']['tmp_name'], $imgDir.$fileName);
			}
			
			$msg = _MSG_IMAGE.' "../Image/'.$_FILES['logo']['name'].'".';
		}else{
			$logo = $tmp_logo;
			
			$msg = _MSG_NOIMAGE;
		}
		//
		//***********
		
		
		
		if(substr($owner_url, 0, 7) != 'http://'){
			$owner_url = 'http://'.$owner_url;
		}
		
		
		
		//***********
		// EMPTY???
		//
		if($title   == ''){ $title = ''; }
		if($name    == ''){ $name  = ''; }
		
		if($owner     == ''){ $owner     = ''; }
		if($owner_url == ''){ $owner_url = ''; }
		if($copy      == ''){ $copy      = ''; }
		if($email     == ''){ $email     = ''; }
		
		if(empty($new_footer_text))      { $new_footer_text       = ''; }
		if(empty($keywords))             { $keywords              = ''; }
		if(empty($description))          { $description           = ''; }
		if(empty($charset))              { $charset               = $old_charset; }
		if(empty($tmp_lang))             { $tmp_lang              = $old_lang; }else{ $tmp_lang = $tmp_lang; }
		if(empty($tmp_front_lang))       { $tmp_front_lang        = $old_front_lang; }else{ $tmp_front_lang = $tmp_front_lang; }
		if(empty($sidebar))              { $sidebar               = 0; }
		if(empty($tmp_use_wysiwyg))      { $tmp_use_wysiwyg       = 0; }
		if(empty($new_show_tcmslogo))    { $new_show_tcmslogo     = 0; }
		if(empty($new_show_plt))         { $new_show_plt          = 0; }
		if(empty($new_tcmsinst))         { $new_tcmsinst          = 0; }
		if(empty($new_legallink))        { $new_legallink         = 0; }
		if(empty($new_adminlink))        { $new_adminlink         = 0; }
		if(empty($new_show_defaultfoot)) { $new_show_defaultfoot  = 0; }
		if(empty($new_statistics))       { $new_statistics        = 0; }
		if(empty($new_seo_enabled))      { $new_seo_enabled       = 0; }
		if(empty($new_cipher_email))     { $new_cipher_email      = 0; }
		if(empty($new_js_browser_detect)){ $new_js_browser_detect = 0; }
		if(empty($new_captcha))          { $new_captcha           = 0; }
		if(empty($new_doc_autor))        { $new_doc_autor         = 0; }
		if(empty($new_admin_topmenu))    { $new_admin_topmenu     = 0; }
		if(empty($new_pdflink))          { $new_pdflink           = 0; }
		if(empty($new_expires))          { $new_expires           = 0; }
		if(empty($new_use_content_l))    { $new_use_content_l     = 0; }
		
		//
		//***********
		
		
		
		//***********
		// Charsets
		//
		if($title           != ''){ $title           = $tcms_main->encodeText($title, '2', $c_charset); }
		if($name            != ''){ $name            = $tcms_main->encodeText($name, '2', $c_charset); }
		if($new_key         != ''){ $new_key         = $tcms_main->encodeText($new_key, '2', $c_charset); }
		if($logo            != ''){ $logo            = $tcms_main->encodeText($logo, '2', $c_charset); }
		if($owner           != ''){ $owner           = $tcms_main->encodeText($owner, '2', $c_charset); }
		if($owner_url       != ''){ $owner_url       = $tcms_main->encodeText($owner_url, '2', $c_charset); }
		if($copy            != ''){ $copy            = $tcms_main->encodeText($copy, '2', $c_charset); }
		if($email           != ''){ $email           = $tcms_main->encodeText($email, '2', $c_charset); }
		if($keywords        != ''){ $keywords        = $tcms_main->encodeText($keywords, '2', $c_charset); }
		if($description     != ''){ $description     = $tcms_main->encodeText($description, '2', $c_charset); }
		if($new_footer_text != ''){ $new_footer_text = $tcms_main->encodeText($new_footer_text, '2', $c_charset); }
		//
		//***********
		
		
		
		if(substr($url, 0, 4) != 'http'){ $url = 'http://'.$url; }
		
		
		
		//***************************************
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/namen.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('namen');
		
		$xmluser->write_value('title', $title);
		$xmluser->write_value('name', $name);
		$xmluser->write_value('key', $new_key);
		$xmluser->write_value('logo', $logo);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('namen');
		$xmluser->_xmlparser();
		
		//***************************************
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('footer');
		
		$xmluser->write_value('websiteowner', $owner);
		$xmluser->write_value('owner_url', $owner_url);
		$xmluser->write_value('copyright', $copy);
		$xmluser->write_value('email', $email);
		$xmluser->write_value('show_tcmslogo', $new_show_tcmslogo);
		$xmluser->write_value('show_defaultfooter', $new_show_defaultfoot);
		$xmluser->write_value('show_page_loading_time', $new_show_plt);
		$xmluser->write_value('legal_link_in_footer', $new_legallink);
		$xmluser->write_value('admin_link_in_footer', $new_adminlink);
		$xmluser->write_value('footer_text', $new_footer_text);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('footer');
		$xmluser->_xmlparser();
		
		// ---------------------------
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('global');
		
		$xmluser->write_value('menu', $menu);
		$xmluser->write_value('second_menu', $second_menu);
		$xmluser->write_value('meta', $keywords);
		$xmluser->write_value('charset', $charset);
		$xmluser->write_value('wysiwyg', $tmp_use_wysiwyg);
		$xmluser->write_value('lang', $tmp_lang);
		$xmluser->write_value('front_lang', $tmp_front_lang);
		$xmluser->write_value('description', $description);
		$xmluser->write_value('currency', $tmp_currency);
		$xmluser->write_value('toendacms_in_sitetitle', $new_tcmsinst);
		$xmluser->write_value('default_category', $new_default_cat);
		$xmluser->write_value('topmenu_active', $new_topmenu_active);
		$xmluser->write_value('statistics', $new_statistics);
		$xmluser->write_value('seo_enabled', $new_seo_enabled);
		$xmluser->write_value('server_folder', $new_seo_folder);
		$xmluser->write_value('seo_format', $new_seo_format);
		$xmluser->write_value('site_offline', $new_site_offline);
		$xmluser->write_value('site_offline_text', $new_site_off_text);
		$xmluser->write_value('show_top_pages', $new_show_top_pages);
		$xmluser->write_value('cipher_email', $new_cipher_email);
		$xmluser->write_value('js_browser_detect', $new_js_browser_detect);
		$xmluser->write_value('use_cs', $new_use_cs);
		$xmluser->write_value('captcha', $new_captcha);
		$xmluser->write_value('captcha_clean_size', $new_captcha_clean);
		$xmluser->write_value('show_doc_autor', $new_doc_autor);
		$xmluser->write_value('admin_topmenu', $new_admin_topmenu);
		$xmluser->write_value('pathway_char', $new_pathchar);
		$xmluser->write_value('anti_frame', $new_anti_frame);
		$xmluser->write_value('revisit_after', $new_revisit_after);
		$xmluser->write_value('robotsfile', $new_robotsfile);
		$xmluser->write_value('pdflink', $new_pdflink);
		$xmluser->write_value('cachecontrol', $new_cache_control);
		$xmluser->write_value('pragma', $new_pragma);
		$xmluser->write_value('expires', $new_expires);
		$xmluser->write_value('robots', $new_robots);
		$xmluser->write_value('last_changes', $new_last_changes);
		$xmluser->write_value('use_content_language', $new_use_content_l);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('global');
		$xmluser->_xmlparser();
		
		
		if($old_engine != $new_engine) {
			echo '<script type="text/javascript">
			var delCheck = confirm("'._MSG_CHANGE_DATABASE_ENGINE.'");
			if(delCheck == false){
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_global&action='.( trim($_RELOCATE) == '0' ? 'db' : $_RELOCATE ).'\';
			}
			else{
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_global&todo=save&check=yes'
				.'&old_engine='.$new_engine
				.'&new_engine='.$new_engine
				.'&new_user='.$new_user
				.'&new_password='.$new_password
				.'&new_host='.$new_host
				.'&new_database='.$new_database
				.'&new_port='.$new_port
				.'&new_prefix='.$new_prefix.'\';
			}
			</script>';
		}
		else{
			$new_engine   = $tcms_main->securePassword($new_engine, false);
			$new_user     = $tcms_main->securePassword($new_user, false);
			$new_password = $tcms_main->securePassword($new_password, false);
			$new_host     = $tcms_main->securePassword($new_host, false);
			$new_database = $tcms_main->securePassword($new_database, false);
			$new_port     = $tcms_main->securePassword($new_port, false);
			$new_prefix   = $tcms_main->securePassword($new_prefix, false);
			
			
			//***************************************
			
			$fp_header = ''
.'<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Database Usersettings
|
| File:		database.php
| Version:	0.0.1
|
+
*/

$tcms_db_engine   = \''.$new_engine.'\';
$tcms_db_user     = \''.$new_user.'\';
$tcms_db_password = \''.$new_password.'\';
$tcms_db_host     = \''.$new_host.'\';
$tcms_db_database = \''.$new_database.'\';
$tcms_db_port     = \''.$new_port.'\';
$tcms_db_prefix   = \''.$new_prefix.'\';

?>
';
				
			$fp = fopen('../../'.$tcms_administer_site.'/tcms_global/database.php', 'w');
			fwrite($fp, $fp_header);
			fclose($fp);
			
			
			if($check == 'yes'){
				echo '<script>document.location=\'index.php\'</script>';
			}
			else {
				echo '<script>'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\';'
				.'</script>';
			}
		}
		
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\';'
		.'</script>';
	}
	
	
	
	
	
	//==================================================
	// BACKUP
	//==================================================
	
	if($todo == 'backup'){
		if($this_engine == 'xml'){
			$archive = new PclZip('../../cache/xml_database_backup.zip');
  			$v_list = $archive->create('../../'.$tcms_administer_site);
  			
  			if($v_list == 0) die('Error : '.$archive->errorInfo(true));
    		
    		echo '<script>alert(\''._MSG_SAVED.'\');</script>';
		}
		else{
			if(empty($with_output))   { $with_output    = 0; };
			if(empty($structure_only)){ $structure_only = 0; };
			
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlResult = $sqlAL->sqlCreateBackup($with_output, $structure_only);
			
			//$affectedTables = $sqlAL->sqlGetNumber($sqlQR);
			
			//if($affectedTables > 0)
			//	echo '<script>alert(\''._MSG_BACKUP_SUCCESSFULL.' '.$affectedTables.'\');</script>';
			//else
			//	echo '<script>alert(\''._MSG_BACKUP_FAILED.'\');</script>';
			
			if($with_output == 0){
				echo '<br />'
				.'<textarea class="tcms_textarea_source" style="overflow: auto !important;">'
				.$sqlResult
				.'</textarea>';
			}
		}
		
		//echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_global&action='.$action.'\'</script>';
	}
	
	
	
	
	
	//==================================================
	// OPTIMIZE
	//==================================================
	
	if($todo == 'optimize'){
		if($this_engine == 'mysql'){
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strOptimize = 'OPTIMIZE TABLE ';
			
			$tic = count($arrTables) - 1;
			
			foreach($arrTables as $key => $val){
				if($key < $tic)
					$strOptimize .= '`'.$tcms_db_prefix.$arrTables[$key].'` , ';
				else
					$strOptimize .= '`'.$tcms_db_prefix.$arrTables[$key].'`';
			}
			
			//echo $strOptimize;
			
			$sqlResult = $sqlAL->sqlQuery($strOptimize);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_global&action='.$action.'\'</script>';
	}
	
	
	
	
	
	//==================================================
	// RESTORE
	//==================================================
	
	if($todo == 'restore'){
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\''
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
