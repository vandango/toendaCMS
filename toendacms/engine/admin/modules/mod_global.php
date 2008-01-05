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
| File:	mod_global.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Global Configuration
 * 
 * This module is for the global configuration settings.
 * 
 * @version 1.4.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Admin Backend
 * 
 */


if(isset($_GET['action'])) { $action = $_GET['action']; }
if(isset($_GET['check'])) { $check = $_GET['check']; }

if(isset($_GET['old_engine'])) { $old_engine = $_GET['old_engine']; }
if(isset($_GET['new_engine'])) { $new_engine = $_GET['new_engine']; }
if(isset($_GET['new_user'])) { $new_user = $_GET['new_user']; }
if(isset($_GET['new_password'])) { $new_password = $_GET['new_password']; }
if(isset($_GET['new_host'])) { $new_host = $_GET['new_host']; }
if(isset($_GET['new_database'])) { $new_database = $_GET['new_database']; }
if(isset($_GET['new_port'])) { $new_port = $_GET['new_port']; }
if(isset($_GET['this_engine'])) { $this_engine = $_GET['this_engine']; }
if(isset($_GET['new_prefix'])) { $new_prefix = $_GET['new_prefix']; }

if(isset($_POST['_RELOCATE'])) { $_RELOCATE = $_POST['_RELOCATE']; }
if(isset($_POST['action'])) { $action = $_POST['action']; }

if(isset($_POST['title'])) { $title = $_POST['title']; }
if(isset($_POST['name'])) { $name = $_POST['name']; }
if(isset($_POST['new_key'])) { $new_key = $_POST['new_key']; }
if(isset($_POST['tmp_logo'])) { $tmp_logo = $_POST['tmp_logo']; }
if(isset($_POST['logo'])) { $logo = $_POST['logo']; }
if(isset($_POST['owner'])) { $owner = $_POST['owner']; }
if(isset($_POST['owner_url'])) { $owner_url = $_POST['owner_url']; }
if(isset($_POST['copy'])) { $copy = $_POST['copy']; }
if(isset($_POST['email'])) { $email = $_POST['email']; }
if(isset($_POST['new_show_tcmslogo'])) { $new_show_tcmslogo = $_POST['new_show_tcmslogo']; }
if(isset($_POST['new_show_plt'])) { $new_show_plt = $_POST['new_show_plt']; }
if(isset($_POST['menu'])) { $menu = $_POST['menu']; }
if(isset($_POST['second_menu'])) { $second_menu = $_POST['second_menu']; }
if(isset($_POST['keywords'])) { $keywords = $_POST['keywords']; }
if(isset($_POST['charset'])) { $charset = $_POST['charset']; }
if(isset($_POST['tmp_use_wysiwyg'])) { $tmp_use_wysiwyg = $_POST['tmp_use_wysiwyg']; }
if(isset($_POST['tmp_lang'])) { $tmp_lang = $_POST['tmp_lang']; }
if(isset($_POST['tmp_front_lang'])) { $tmp_front_lang = $_POST['tmp_front_lang']; }
if(isset($_POST['description'])) { $description = $_POST['description']; }
if(isset($_POST['tmp_currency'])) { $tmp_currency = $_POST['tmp_currency']; }
if(isset($_POST['new_tcmsinst'])) { $new_tcmsinst = $_POST['new_tcmsinst']; }
if(isset($_POST['new_default_cat'])) { $new_default_cat = $_POST['new_default_cat']; }
if(isset($_POST['new_legallink'])) { $new_legallink = $_POST['new_legallink']; }
if(isset($_POST['new_adminlink'])) { $new_adminlink = $_POST['new_adminlink']; }
if(isset($_POST['new_topmenu_active'])) { $new_topmenu_active = $_POST['new_topmenu_active']; }
if(isset($_POST['new_footer_text'])) { $new_footer_text = $_POST['new_footer_text']; }
if(isset($_POST['new_show_defaultfoot'])) { $new_show_defaultfoot = $_POST['new_show_defaultfoot']; }
if(isset($_POST['new_statistics'])) { $new_statistics = $_POST['new_statistics']; }
if(isset($_POST['new_seo_enabled'])) { $new_seo_enabled = $_POST['new_seo_enabled']; }
if(isset($_POST['new_seo_folder'])) { $new_seo_folder = $_POST['new_seo_folder']; }
if(isset($_POST['new_site_offline'])) { $new_site_offline = $_POST['new_site_offline']; }
if(isset($_POST['new_site_off_text'])) { $new_site_off_text = $_POST['new_site_off_text']; }
if(isset($_POST['new_show_top_pages'])) { $new_show_top_pages = $_POST['new_show_top_pages']; }
if(isset($_POST['new_cipher_email'])) { $new_cipher_email = $_POST['new_cipher_email']; }
if(isset($_POST['new_js_browser_detect'])) { $new_js_browser_detect = $_POST['new_js_browser_detect']; }
if(isset($_POST['new_use_cs'])) { $new_use_cs = $_POST['new_use_cs']; }
if(isset($_POST['new_captcha'])) { $new_captcha = $_POST['new_captcha']; }
if(isset($_POST['new_captcha_clean'])) { $new_captcha_clean = $_POST['new_captcha_clean']; }
if(isset($_POST['new_seo_format'])) { $new_seo_format = $_POST['new_seo_format']; }
if(isset($_POST['new_doc_autor'])) { $new_doc_autor = $_POST['new_doc_autor']; }
if(isset($_POST['new_admin_topmenu'])) { $new_admin_topmenu = $_POST['new_admin_topmenu']; }
if(isset($_POST['new_pathchar'])) { $new_pathchar = $_POST['new_pathchar']; }
if(isset($_POST['new_revisit_after'])) { $new_revisit_after = $_POST['new_revisit_after']; }
if(isset($_POST['new_robotsfile'])) { $new_robotsfile = $_POST['new_robotsfile']; }
if(isset($_POST['new_pdflink'])) { $new_pdflink = $_POST['new_pdflink']; }
if(isset($_POST['new_cache_control'])) { $new_cache_control = $_POST['new_cache_control']; }
if(isset($_POST['new_pragma'])) { $new_pragma = $_POST['new_pragma']; }
if(isset($_POST['new_expires'])) { $new_expires = $_POST['new_expires']; }
if(isset($_POST['new_date'])) { $new_date = $_POST['new_date']; }
if(isset($_POST['new_robots'])) { $new_robots = $_POST['new_robots']; }
if(isset($_POST['new_last_changes'])) { $new_last_changes = $_POST['new_last_changes']; }
if(isset($_POST['new_use_content_l'])) { $new_use_content_l = $_POST['new_use_content_l']; }
if(isset($_POST['new_seo_news_title'])) { $new_seo_news_title = $_POST['new_seo_news_title']; }
if(isset($_POST['new_seo_content_title'])) { $new_seo_content_title = $_POST['new_seo_content_title']; }
if(isset($_POST['new_mediaman_view'])) { $new_mediaman_view = $_POST['new_mediaman_view']; }
if(isset($_POST['new_show_bookmark_links'])) { $new_show_bookmark_links = $_POST['new_show_bookmark_links']; }

if(isset($_POST['new_mail_with_smtp'])) { $new_mail_with_smtp = $_POST['new_mail_with_smtp']; }
if(isset($_POST['new_mail_as_html'])) { $new_mail_as_html = $_POST['new_mail_as_html']; }
if(isset($_POST['new_mail_server_pop3'])) { $new_mail_server_pop3 = $_POST['new_mail_server_pop3']; }
if(isset($_POST['new_mail_server_smtp'])) { $new_mail_server_smtp = $_POST['new_mail_server_smtp']; }
if(isset($_POST['new_mail_port'])) { $new_mail_port = $_POST['new_mail_port']; }
if(isset($_POST['new_mail_pop3'])) { $new_mail_pop3 = $_POST['new_mail_pop3']; }
if(isset($_POST['new_mail_user'])) { $new_mail_user = $_POST['new_mail_user']; }
if(isset($_POST['new_mail_password'])) { $new_mail_password = $_POST['new_mail_password']; }

if(isset($_POST['new_text_width'])) { $new_text_width = $_POST['new_text_width']; }
if(isset($_POST['new_input_width'])) { $new_input_width = $_POST['new_input_width']; }
if(isset($_POST['new_news_publish'])) { $new_news_publish = $_POST['new_news_publish']; }
if(isset($_POST['new_img_publish'])) { $new_img_publish = $_POST['new_img_publish']; }
if(isset($_POST['new_alb_publish'])) { $new_alb_publish = $_POST['new_alb_publish']; }
if(isset($_POST['new_cat_publish'])) { $new_cat_publish = $_POST['new_cat_publish']; }
if(isset($_POST['new_pic_publish'])) { $new_pic_publish = $_POST['new_pic_publish']; }

if(isset($_POST['old_engine'])) { $old_engine = $_POST['old_engine']; }
if(isset($_POST['new_engine'])) { $new_engine = $_POST['new_engine']; }
if(isset($_POST['new_user'])) { $new_user = $_POST['new_user']; }
if(isset($_POST['new_password'])) { $new_password = $_POST['new_password']; }
if(isset($_POST['new_host'])) { $new_host = $_POST['new_host']; }
if(isset($_POST['new_database'])) { $new_database = $_POST['new_database']; }
if(isset($_POST['new_port'])) { $new_port = $_POST['new_port']; }
if(isset($_POST['this_engine'])) { $this_engine = $_POST['this_engine']; }
if(isset($_POST['new_prefix'])) { $new_prefix = $_POST['new_prefix']; }
if(isset($_POST['with_output'])) { $with_output = $_POST['with_output']; }
if(isset($_POST['structure_only'])) { $structure_only = $_POST['structure_only']; }
if(isset($_POST['new_anti_frame'])) { $new_anti_frame = $_POST['new_anti_frame']; }
if(isset($_POST['new_valid_links'])) { $new_valid_links = $_POST['new_valid_links']; }




if($id_group == 'Developer' 
|| $id_group == 'Administrator') {
	// title
	if($tcms_file->checkFileExist($tcms_administer_path.'/tcms_global/namen.xml')) {
		$xml = simplexml_load_file($tcms_administer_path.'/tcms_global/namen.xml');
		
		$sitetitle = $xml->title;
		$sitename  = $xml->name;
		$sitekey   = $xml->key;
		$logo  = $xml->logo;
		
		unset($xml);
	}
	
	
	// footer
	if($tcms_file->checkFileExist($tcms_administer_path.'/tcms_global/footer.xml')) {
		$xml = simplexml_load_file($tcms_administer_path.'/tcms_global/footer.xml');
		
		$old_websiteowner   = $xml->websiteowner;
		$old_copyright      = $xml->copyright;
		$old_owner_url      = $xml->owner_url;
		$old_owner_email    = $xml->email;
		$show_tcmslogo      = $xml->show_tcmslogo;
		$show_defaultfoot   = $xml->show_defaultfooter;
		$show_plt           = $xml->show_page_loading_time;
		$old_legallink      = $xml->legal_link_in_footer;
		$old_adminlink      = $xml->admin_link_in_footer;
		$old_footer_text    = $xml->footer_text;
		$old_show_bookmarkl = $xml->show_bookmark_links;
		
		unset($xml);
	}
	
	if(!isset($show_defaultfoot) || $show_defaultfoot == '') {
		$show_defaultfoot = 1;
	}
	
	
	// var
	if(file_exists($tcms_administer_path.'/tcms_global/var.xml')) {
		$xml = simplexml_load_file($tcms_administer_path.'/tcms_global/var.xml');
		
		$old_charset        = $xml->charset;
		$old_front_lang     = $xml->front_lang;
		$old_lang           = $xml->lang;
		$old_seo_folder     = $xml->server_folder;
		$old_seo_enabled    = $xml->seo_enabled;
		$old_seo_format     = $xml->seo_format;
		$old_seo_news_title = $xml->seo_news_title;
		$old_seo_c_title    = $xml->seo_content_title;
		$cipher_email       = $xml->cipher_email;
		$js_browser_detect  = $xml->js_browser_detect;
		$old_statistics     = $xml->statistics;
		$use_cs             = $xml->use_cs;
		$captcha            = $xml->captcha;
		$captcha_clean      = $xml->captcha_clean_size;
		$anti_frame         = $xml->anti_frame;
		$old_show_top_pages = $xml->show_top_pages;
		$old_site_offline   = $xml->site_offline;
		$old_site_off_text  = $xml->site_offline_text;
		$old_currency       = $xml->currency;
		$old_use_wysiwyg    = $xml->wysiwyg;
		$old_pathchar       = $xml->pathway_char;
		$old_doc_autor      = $xml->show_doc_autor;
		$old_default_cat    = $xml->default_category;
		$old_tcmsinst       = $xml->toendacms_in_sitetitle;
		$old_keywords       = $xml->meta;
		$old_description    = $xml->description;
		$old_topmenu_active = $xml->topmenu_active;
		$old_menu           = $xml->menu;
		$old_second_menu    = $xml->second_menu;
		$old_admin_topmenu  = $xml->admin_topmenu;
		$old_revisit_after  = $xml->revisit_after;
		$old_robotsfile     = $xml->robotsfile;
		$old_pdflink        = $xml->pdflink;
		$old_cache_control  = $xml->cachecontrol;
		$old_pragma         = $xml->pragma;
		$old_expires        = $xml->expires;
		$old_robots         = $xml->robots;
		$old_last_changes   = $xml->last_changes;
		$old_use_content_l  = $xml->use_content_language;
		$old_valid_links    = $xml->valid_links;
		$old_mediaman_view  = $xml->mediaman_view;
		
		unset($xml);
	}
	
	//$globals_xml = new xmlparser(
	//	'../../'.$tcms_administer_site.'/tcms_global/var.xml', 
	//	'r'
	//);
	
	//$old_menu           = $globals_xml->readSection('global', 'menu');
	//$old_second_menu    = $globals_xml->readSection('global', 'second_menu');
	//$old_charset        = $globals_xml->readSection('global', 'charset');
	//$old_use_wysiwyg    = $globals_xml->readSection('global', 'wysiwyg');
	//$old_lang           = $globals_xml->readSection('global', 'lang');
	//$old_currency       = $globals_xml->readSection('global', 'currency');
	//$old_front_lang     = $globals_xml->readSection('global', 'front_lang');
	//$old_keywords       = $globals_xml->readSection('global', 'meta');
	//$old_description    = $globals_xml->readSection('global', 'description');
	//$old_tcmsinst       = $globals_xml->readSection('global', 'toendacms_in_sitetitle');
	//$old_default_cat    = $globals_xml->readSection('global', 'default_category');
	//$old_topmenu_active = $globals_xml->readSection('global', 'topmenu_active');
	//$old_statistics     = $globals_xml->readSection('global', 'statistics');
	//$old_seo_enabled    = $globals_xml->readSection('global', 'seo_enabled');
	//$old_seo_folder     = $globals_xml->readSection('global', 'server_folder');
	//$old_seo_format     = $globals_xml->readSection('global', 'seo_format');
	//$old_seo_news_title = $globals_xml->readSection('global', 'seo_news_title');
	//$old_seo_c_title    = $globals_xml->readSection('global', 'seo_content_title');
	//$old_site_offline   = $globals_xml->readSection('global', 'site_offline');
	//$old_site_off_text  = $globals_xml->readSection('global', 'site_offline_text');
	//$old_show_top_pages = $globals_xml->readSection('global', 'show_top_pages');
	//$cipher_email       = $globals_xml->readSection('global', 'cipher_email');
	//$js_browser_detect  = $globals_xml->readSection('global', 'js_browser_detect');
	//$use_cs             = $globals_xml->readSection('global', 'use_cs');
	//$captcha            = $globals_xml->readSection('global', 'captcha');
	//$captcha_clean      = $globals_xml->readSection('global', 'captcha_clean_size');
	//$old_doc_autor      = $globals_xml->readSection('global', 'show_doc_autor');
	//$old_admin_topmenu  = $globals_xml->readSection('global', 'admin_topmenu');
	//$old_pathchar       = $globals_xml->readSection('global', 'pathway_char');
	//$anti_frame         = $globals_xml->readSection('global', 'anti_frame');
	//$old_revisit_after  = $globals_xml->readSection('global', 'revisit_after');
	//$old_robotsfile     = $globals_xml->readSection('global', 'robotsfile');
	//$old_pdflink        = $globals_xml->readSection('global', 'pdflink');
	//$old_cache_control  = $globals_xml->readSection('global', 'cachecontrol');
	//$old_pragma         = $globals_xml->readSection('global', 'pragma');
	//$old_expires        = $globals_xml->readSection('global', 'expires');
	//$old_robots         = $globals_xml->readSection('global', 'robots');
	//$old_last_changes   = $globals_xml->readSection('global', 'last_changes');
	//$old_use_content_l  = $globals_xml->readSection('global', 'use_content_language');
	//$old_valid_links    = $globals_xml->readSection('global', 'valid_links');
	//$old_mediaman_view  = $globals_xml->readSection('global', 'mediaman_view');
	
	//$globals_xml->flush();
	//unset($globals_xml);
	
	
	// userpage
	if($choosenDB == 'xml') {
		$contactform_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/userpage.xml','r');
		
		$old_text_width   = $contactform_xml->readSection('userpage', 'text_width');
		$old_input_width  = $contactform_xml->readSection('userpage', 'input_width');
		$old_news_publish = $contactform_xml->readSection('userpage', 'news_publish');
		$old_img_publish  = $contactform_xml->readSection('userpage', 'image_publish');
		$old_alb_publish  = $contactform_xml->readSection('userpage', 'album_publish');
		$old_cat_publish  = $contactform_xml->readSection('userpage', 'cat_publish');
		$old_pic_publish  = $contactform_xml->readSection('userpage', 'pic_publish');
		
		$contactform_xml->flush();
		unset($contactform_xml);
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect(
			$sqlUser, 
			$sqlPass, 
			$sqlHost, 
			$sqlDB, 
			$sqlPort
		);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$old_text_width   = $sqlObj->text_width;
		$old_input_width  = $sqlObj->input_width;
		$old_news_publish = $sqlObj->news_publish;
		$old_img_publish  = $sqlObj->image_publish;
		$old_alb_publish  = $sqlObj->album_publish;
		$old_cat_publish  = $sqlObj->cat_publish;
		$old_pic_publish  = $sqlObj->pic_publish;
		
		$sqlAL->freeResult($sqlQR);
		unset($sqlAL);
	}
	
	
	
	/*
		charsets
	*/
	$old_site_off_text = $tcms_main->decodeBase64($old_site_off_text);
	$old_keywords      = $tcms_main->decodeBase64($old_keywords);
	$old_description   = $tcms_main->decodeBase64($old_description);
	$sitetitle         = $tcms_main->decodeBase64($sitetitle);
	$sitename          = $tcms_main->decodeBase64($sitename);
	$sitekey           = $tcms_main->decodeBase64($sitekey);
	$logo              = $tcms_main->decodeBase64($logo);
	$old_websiteowner  = $tcms_main->decodeBase64($old_websiteowner);
	$old_owner_url     = $tcms_main->decodeBase64($old_owner_url);
	$old_copyright     = $tcms_main->decodeBase64($old_copyright);
	$old_owner_email   = $tcms_main->decodeBase64($old_owner_email);
	$old_footer_text   = $tcms_main->decodeBase64($old_footer_text);
	
	$old_site_off_text = $tcms_main->decodeText($old_site_off_text, '2', $c_charset);
	$old_keywords      = $tcms_main->decodeText($old_keywords, '2', $c_charset);
	$old_description   = $tcms_main->decodeText($old_description, '2', $c_charset);
	$sitetitle         = $tcms_main->decodeText($sitetitle, '2', $c_charset);
	$sitename          = $tcms_main->decodeText($sitename, '2', $c_charset);
	$sitekey           = $tcms_main->decodeText($sitekey, '2', $c_charset);
	$logo              = $tcms_main->decodeText($logo, '2', $c_charset);
	$old_websiteowner  = $tcms_main->decodeText($old_websiteowner, '2', $c_charset);
	$old_owner_url     = $tcms_main->decodeText($old_owner_url, '2', $c_charset);
	//$old_copyright     = $tcms_main->decodeText($old_copyright, '2', $c_charset);
	$old_owner_email   = $tcms_main->decodeText($old_owner_email, '2', $c_charset);
	$old_footer_text   = $tcms_main->decodeText($old_footer_text, '2', $c_charset);
	
	$old_site_off_text = htmlspecialchars($old_site_off_text);
	$old_keywords      = htmlspecialchars($old_keywords);
	$old_description   = htmlspecialchars($old_description);
	$sitetitle         = htmlspecialchars($sitetitle);
	$sitename          = htmlspecialchars($sitename);
	$sitekey           = htmlspecialchars($sitekey);
	$logo              = htmlspecialchars($logo);
	$old_websiteowner  = htmlspecialchars($old_websiteowner);
	$old_owner_url     = htmlspecialchars($old_owner_url);
	$old_copyright     = htmlspecialchars($old_copyright);
	$old_owner_email   = htmlspecialchars($old_owner_email);
	$old_footer_text   = htmlspecialchars($old_footer_text);
	
	
	
	if($todo != 'optimize' 
	&& $todo != 'backup') {
		echo '<script type="text/javascript" src="../js/tabs/tabpane.js"></script>
		<link type="text/css" rel="StyleSheet" href="../js/tabs/css/luna/tab.css" />
		<!--<link type="text/css" rel="StyleSheet" href="../js/tabs/tabpane.css" />-->';
		//<script language="Javascript">
		//var _tcmsVALUE = "Site is proudly powered by toendaCMS &#169; 2003 - 2008 Toenda Software Development. All rights reserved.<br />toendaCMS is Free Software released under the GNU/GPL License.<br />";
		//var _tcmsOFFLINE = "This site is down for maintenance.<br />Please check back again soon.";
		//</script>';
		
		
		
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
		.$tcms_html->tableHeadNoBorder();
		
		
		echo '<tr>'
		.'<td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'
		._GLOBAL_SITE_OFFLINE.'</td>'
		.'<td>'
		.'<input type="radio" name="new_site_offline" id="config_offline0" value="0"'.($old_site_offline == 0 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline0">No</label>'
		.'<input type="radio" name="new_site_offline" id="config_offline1" value="1"'.($old_site_offline == 1 ? ' checked="checked"' : '' ).' />'
		.'<label for="config_offline1">Yes</label>'
		.'</td></tr>';
		
		
		echo $tcms_html->tableRow(
			1, 
			2, 
			_GLOBAL_SITE_OFFLINE_TEXT, 
			$old_site_off_text, 
			'new_site_off_text', 
			true, 
			$arr_color[1], 
			2
		);
		
		
		echo $tcms_html->tableRow(
			1, 
			3, 
			_GLOBAL_TITLE, 
			$sitetitle, 
			'title', 
			false, 
			'', 
			0, 
			'tcms_input_normal'
		);
		
		
		/*echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25" valign="top">'
		._GLOBAL_TITLE.'</td>'
		.'<td>'
		.'<input name="title" class="tcms_input_normal" value="'.$sitetitle.'" />'
		.'</td></tr>';*/
		
		
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
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_USE_CONTENT_LANG
		.'</td><td>'
		.'<input type="checkbox" name="new_use_content_l"'.($old_use_content_l == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_MM_VIEW
		.'</td><td>'
		.'<select name="new_mediaman_view" class="tcms_select">'
		.'<option value="list"'.( $old_mediaman_view == 'list' ? ' selected="selected"' : '' ).'>'._GLOBAL_MM_VIEW_LIST.'</option>'
		.'<option value="icon"'.( $old_mediaman_view == 'icon' ? ' selected="selected"' : '' ).'>'._GLOBAL_MM_VIEW_ICON.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_CHARSET
		.'</td><td>'
		.'<select name="charset" class="tcms_select">';
		foreach($arr_char as $ch_key => $ch_value) {
			echo '<option'
			.' value="'.$ch_value.'"'
			.( $old_charset == $ch_value ? ' selected="selected"' : '' )
			.'>'
			.$ch_value
			.'</option>';
		}
		echo '</select>'
		.'</td>'
		.'</tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_LANG.'</td>'
		.'<td>'
		.'<select name="tmp_lang" class="tcms_select">';
		
		foreach($arr_lang as $lg_key => $lg_value) {
			echo '<option value="'.$lg_value.'"'
			.( $old_lang == $lg_value ? ' selected="selected"' : '' )
			.'>'.$tcms_main->getLanguageNameByTCMSLanguageCode($languages, $lg_value).'</option>';
		}
		
		echo '</select>'
		.'</td>'
		.'</tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_FRONT_LANG
		.'</td><td>'
		.'<select name="tmp_front_lang" class="tcms_select">';
		
		foreach($arr_lang as $lg_key => $lg_value) {
			echo '<option value="'.$lg_value.'"'
			.( $old_front_lang == $lg_value ? ' selected="selected"' : '' )
			.'>'.$tcms_main->getLanguageNameByTCMSLanguageCode($languages, $lg_value).'</option>';
		}
		
		echo '</select></td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_CURRENCY
		.'</td><td>'
		.'<select name="tmp_currency" class="tcms_select">';
		foreach($arr_currency['name'] as $lg_key => $lg_value) {
			echo '<option value="'.$arr_currency['code'][$lg_key].'"'.( $old_currency == $arr_currency['code'][$lg_key] ? ' selected="selected"' : '' ).'>'
			.$lg_value
			.'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_WYSIWYG
		.'</td><td>'
		.'<select name="tmp_use_wysiwyg" class="tcms_select">'
			.( file_exists('../js/tinymce') ? '<option value="tinymce"'.( $old_use_wysiwyg == 'tinymce' ? ' selected="selected"' : '' ).'>tinyMCE</option>' : '' )
			.( file_exists('../js/FCKeditor') ? '<option value="fckeditor"'.( $old_use_wysiwyg == 'fckeditor' ? ' selected="selected"' : '' ).'>FCKEditor</option>' : '' )
			.'<option value="toendaScript"'.( $old_use_wysiwyg == 'toendaScript' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.' WYSIWYG (toendaScript)</option>'
			.'<option value="no"'.( $old_use_wysiwyg == 'no' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.' WYSIWYG (HTML)</option>'
			//.'<option value="wiki"'.( $old_use_wysiwyg == 'wiki' ? ' selected="selected"' : '' ).'>'._TCMS_ADMIN_NO.' WYSIWYG (Wiki Syntax)</option>'
		.'</select>'
		.'</td>'
		.'</tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" valign="top" height="25">'._TABLE_DEFAULT_NEWS_CATEGORY.'</td>'
		.'<td valign="top">'
		.'<select name="new_default_cat" class="tcms_select">';
		foreach($arrNewsCat['tag'] as $key => $value) {
			echo '<option value="'.$value.'"'.( $old_default_cat == $value ? ' selected="selected"' : '' ).'>'.$arrNewsCat['name'][$key].'</option>';
		}
		echo '</select></td></tr>';
		
		
		echo $tcms_html->tableEnd()
		.'</div>';
		
		
		/*
			footer tab
		*/
		
		echo '<div class="tab-page" id="tab-page-footer">'
		.'<h2 class="tab">'._GLOBAL_FOOTER.'</h2>'
		.$tcms_html->tableHeadNoBorder();
		
		
		echo $tcms_html->tableRow(
			1, 
			1, 
			_GLOBAL_DEFAULT_FOOTER, 
			$show_defaultfoot, 
			'new_show_defaultfoot'
		);
		
		
		echo $tcms_html->tableRow(
			1, 
			2, 
			_GLOBAL_FOOTER_TEXT, 
			$old_footer_text, 
			'new_footer_text', 
			true, 
			$arr_color[1]
		);
		
		
		echo $tcms_html->tableRow(
			1, 
			1, 
			_GLOBAL_TCMSLOGO, 
			$show_tcmslogo, 
			'new_show_tcmslogo'
		);
		
		
		echo $tcms_html->tableRow(
			1, 
			1, 
			_GLOBAL_TCMSLOGO_IN_SITETITLE, 
			$old_tcmsinst, 
			'new_tcmsinst', 
			true, 
			$arr_color[1]
		);
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_PAGELOADINGTIME
		.'</td><td>'
		.'<input type="checkbox" name="new_show_plt"'.($show_plt == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_VALIDLINKS
		.'</td><td>'
		.'<input type="checkbox" name="new_valid_links"'.($old_valid_links == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._GLOBAL_SHOW_BOOKMARK_LINKS
		.'</td><td>'
		.'<input type="checkbox" name="new_show_bookmark_links"'.($old_show_bookmarkl == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo $tcms_html->tableEnd()
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
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CAPTCHA.'</td>'
		.'<td>'
		.'<input type="checkbox" name="new_captcha"'.($captcha == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr>'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'._GLOBAL_CAPTCHA_CLEAN.'</td>'
		.'<td>'
		.'<input name="new_captcha_clean" class="tcms_id_box" value="'.$captcha_clean.'" />'
		.'&nbsp;KB'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
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
		
		echo '<tr style="background: '.$arr_color[0].';">'
		.'<td width="300" height="25" style="width: 300px !important;" class="tcms_padding_mini" valign="top">'
		._GLOBAL_SEO_FORMAT
		.'</td><td>'
		.'<label for="urlformat_0">'
		.'<input type="radio" name="new_seo_format" id="urlformat_0" value="0"'.($old_seo_format == 0 ? ' checked="checked"' : '' ).' />'
		.'index.php/section:frontpage/lang:en'
		.'</label>'
		.'<br />'
		.'<label for="urlformat_1">'
		.'<input type="radio" name="new_seo_format" id="urlformat_1" value="1"'.($old_seo_format == 1 ? ' checked="checked"' : '' ).' />'
		.'index.php/section/frontpage/lang/en'
		.'</label>'
		.'<br />'
		.'<label for="urlformat_2">'
		.'<input type="radio" name="new_seo_format" id="urlformat_2" value="2"'.($old_seo_format == 2 ? ' checked="checked"' : '' ).' />'
		.'index.php/en/frontpage.html'
		.'</label>'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[1].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'
		._GLOBAL_SEO_NEWS_TITLE
    	.'</td><td>'
		.'<input type="checkbox" name="new_seo_news_title"'.($old_seo_news_title == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		echo '<tr style="background: '.$arr_color[0].';">'
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini">'
		._GLOBAL_SEO_CONTENT_TITLE
	    .'</td><td>'
		.'<input type="checkbox" name="new_seo_content_title"'.($old_seo_c_title == 1 ? ' checked' : '' ).' value="1" />'
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
		.'<td width="300" style="width: 300px !important;" class="tcms_padding_mini" height="25">'
		._USERPAGE_TEXT_WIDTH
		.'</td><td>'
		.'<input type="text" name="new_text_width" class="tcms_id_box" value="'.$old_text_width.'" />'
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
		if($old_user     == NULL) { $old_user     = ''; }
		if($old_password == NULL) { $old_password = ''; }
		if($old_host     == NULL) { $old_host     = ''; }
		if($old_datadase == NULL) { $old_datadase = ''; }
		if($old_port     == NULL) { $old_port     = ''; }
		if($old_prefix   == NULL) { $old_prefix   = ''; }
		
		
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
		foreach($arrDB['tech'] as $dbKey => $dbVal) {
			echo '<option value="'.$dbVal.'"'.( $old_engine == $dbVal ? ' selected' : '' ).'>'.$arrDB['name'][$dbKey].'</option>';
		}
		echo '</select>'
		.'</td></tr>';
		
		
		if($choosenDB == 'mysql') {
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
		.'</form>'
		.''
		.'' // close main form
		.'' // open backup form
		.''
		.'<form action="admin.php?id_user='.$id_user.'&amp;site=mod_global" method="post" id="db_backup">'
		.'<input name="todo" type="hidden" value="backup" />'
		.'<input name="action" type="hidden" value="'.$action.'" />'
		.''
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
		.'</form>'
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
		tabPane1.addTabPage(document.getElementById("tab-page-footer"));
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
		echo '<br />';
	}
	
	
	
	
	
	//==================================================
	// SAVE, EDIT AND DELETE
	//==================================================
	
	if($todo == 'save') {
		if($old_engine != $new_engine && !$tcms_main->isReal($check)) {
			echo '<script type="text/javascript">
			var delCheck = confirm("'._MSG_CHANGE_DATABASE_ENGINE.'\nIF YOU SAVE, YOU\'LL LOSE ALL THIS GLOBAL SITE SETTINGS!");
			if(delCheck == false) {
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\';
			}
			else {
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
		else {
			if(empty($new_mail_pop3) || $new_mail_pop3 == '' || !isset($new_mail_pop3)) { $new_mail_pop3 = 0; }
			
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

?>';
			
			$fp = fopen('../../'.$tcms_administer_site.'/tcms_global/mail.php', 'w');
			fwrite($fp, $fp_header);
			fclose($fp);
			
			
			
			if(empty($new_text_width)   || $new_text_width   == '') { $new_text_width   = 150; }
			if(empty($new_input_width)  || $new_input_width  == '') { $new_input_width  = 150; }
			if(empty($new_news_publish) || $new_news_publish == '') { $new_news_publish = 0; }
			if(empty($new_img_publish)  || $new_img_publish  == '') { $new_img_publish  = 0; }
			if(empty($new_alb_publish)  || $new_alb_publish  == '') { $new_alb_publish  = 0; }
			if(empty($new_cat_publish)  || $new_cat_publish  == '') { $new_cat_publish  = 0; }
			if(empty($new_pic_publish)  || $new_pic_publish  == '') { $new_pic_publish  = 0; }
			
			if($choosenDB == 'xml') {
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/userpage.xml', 'w');
				$xmluser->xmlDeclaration();
				$xmluser->xmlSection('userpage');
				
				$xmluser->writeValue('text_width', $new_text_width);
				$xmluser->writeValue('input_width', $new_input_width);
				$xmluser->writeValue('news_publish', $new_news_publish);
				$xmluser->writeValue('image_publish', $new_img_publish);
				$xmluser->writeValue('album_publish', $new_alb_publish);
				$xmluser->writeValue('cat_publish', $new_cat_publish);
				$xmluser->writeValue('pic_publish', $new_pic_publish);
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('userpage');
				$xmluser->_xmlparser();
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$newSQLData = ''
				.$tcms_db_prefix.'userpage.text_width="'.$new_text_width.'", '
				.$tcms_db_prefix.'userpage.input_width="'.$new_input_width.'", '
				.$tcms_db_prefix.'userpage.news_publish='.$new_news_publish.', '
				.$tcms_db_prefix.'userpage.image_publish='.$new_img_publish.', '
				.$tcms_db_prefix.'userpage.album_publish='.$new_alb_publish.', '
				.$tcms_db_prefix.'userpage.cat_publish='.$new_cat_publish.', '
				.$tcms_db_prefix.'userpage.pic_publish='.$new_pic_publish;
				
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'userpage', $newSQLData, 'userpage');
			}
			
			
			
			//***********
			// Image
			//
			if($_FILES['logo']['size'] > 0 && (
			$_FILES['logo']['type'] == 'image/gif' || 
			$_FILES['logo']['type'] == 'image/png' || 
			$_FILES['logo']['type'] == 'image/jpg' || 
			$_FILES['logo']['type'] == 'image/jpeg' || 
			$_FILES['logo']['type'] == 'image/bmp')) {
				$fileName = $_FILES['logo']['name'];
				$imgDir = '../../'.$tcms_administer_site.'/images/Image/';
				
				$logo = $_FILES['logo']['name'];
				
				//$fileName = $tcms_main->encodeText_without_crypt($fileName, '2', $c_charset);
				
				if(!file_exists('../../'.$tcms_administer_site.'/images/Image/'.$_FILES['logo']['name'])) {
					copy($_FILES['logo']['tmp_name'], $imgDir.$fileName);
				}
				
				$msg = _MSG_IMAGE.' "../Image/'.$_FILES['logo']['name'].'".';
			}
			else {
				$logo = $tmp_logo;
				
				$msg = _MSG_NOIMAGE;
			}
			//
			//***********
			
			
			
			if(substr($owner_url, 0, 7) != 'http://') {
				$owner_url = 'http://'.$owner_url;
			}
			
			
			
			//***********
			// EMPTY???
			//
			if($title   == '') { $title = ''; }
			if($name    == '') { $name  = ''; }
			
			if($owner     == '') { $owner     = ''; }
			if($owner_url == '') { $owner_url = ''; }
			if($copy      == '') { $copy      = ''; }
			if($email     == '') { $email     = ''; }
			
			if(empty($new_footer_text))         { $new_footer_text         = ''; }
			if(empty($keywords))                { $keywords                = ''; }
			if(empty($description))             { $description             = ''; }
			if(empty($charset))                 { $charset                 = $old_charset; }
			if(empty($tmp_lang))                { $tmp_lang                = $old_lang; } else { $tmp_lang = $tmp_lang; }
			if(empty($tmp_front_lang))          { $tmp_front_lang          = $old_front_lang; } else { $tmp_front_lang = $tmp_front_lang; }
			if(empty($sidebar))                 { $sidebar                 = 0; }
			if(empty($tmp_use_wysiwyg))         { $tmp_use_wysiwyg         = 0; }
			if(empty($new_show_tcmslogo))       { $new_show_tcmslogo       = 0; }
			if(empty($new_show_plt))            { $new_show_plt            = 0; }
			if(empty($new_tcmsinst))            { $new_tcmsinst            = 0; }
			if(empty($new_legallink))           { $new_legallink           = 0; }
			if(empty($new_adminlink))           { $new_adminlink           = 0; }
			if(empty($new_show_defaultfoot))    { $new_show_defaultfoot    = 0; }
			if(empty($new_statistics))          { $new_statistics          = 0; }
			if(empty($new_seo_enabled))         { $new_seo_enabled         = 0; }
			if(empty($new_seo_news_title))      { $new_seo_news_title      = 0; }
			if(empty($new_seo_content_title))   { $new_seo_content_title   = 0; }
			if(empty($new_cipher_email))        { $new_cipher_email        = 0; }
			if(empty($new_js_browser_detect))   { $new_js_browser_detect   = 0; }
			if(empty($new_captcha))             { $new_captcha             = 0; }
			if(empty($new_doc_autor))           { $new_doc_autor           = 0; }
			if(empty($new_admin_topmenu))       { $new_admin_topmenu       = 0; }
			if(empty($new_pdflink))             { $new_pdflink             = 0; }
			if(empty($new_expires))             { $new_expires             = 0; }
			if(empty($new_use_content_l))       { $new_use_content_l       = 0; }
			if(empty($new_last_changes))        { $new_last_changes        = date('Y-m-d H:i:s'); }
			if(empty($new_mediaman_view))       { $new_mediaman_view       = 0; }
			if(empty($new_show_bookmark_links)) { $new_show_bookmark_links = 0; }
			
			//
			//***********
			
			
			
			//***********
			// Charsets
			//
			if($new_site_off_text != '') { $new_site_off_text = $tcms_main->encodeText($new_site_off_text, '2', $c_charset); }
			if($keywords          != '') { $keywords          = $tcms_main->encodeText($keywords, '2', $c_charset); }
			if($description       != '') { $description       = $tcms_main->encodeText($description, '2', $c_charset); }
			if($title             != '') { $title             = $tcms_main->encodeText($title, '2', $c_charset); }
			if($name              != '') { $name              = $tcms_main->encodeText($name, '2', $c_charset); }
			if($new_key           != '') { $new_key           = $tcms_main->encodeText($new_key, '2', $c_charset); }
			if($logo              != '') { $logo              = $tcms_main->encodeText($logo, '2', $c_charset); }
			if($owner             != '') { $owner             = $tcms_main->encodeText($owner, '2', $c_charset); }
			if($owner_url         != '') { $owner_url         = $tcms_main->encodeText($owner_url, '2', $c_charset); }
			//if($copy              != '') { $copy              = $tcms_main->encodeText($copy, '2', $c_charset); }
			if($email             != '') { $email             = $tcms_main->encodeText($email, '2', $c_charset); }
			if($new_footer_text   != '') { $new_footer_text   = $tcms_main->encodeText($new_footer_text, '2', $c_charset); }
			
			if($new_site_off_text != '') { $new_site_off_text = $tcms_main->encodeBase64($new_site_off_text); }
			if($keywords          != '') { $keywords          = $tcms_main->encodeBase64($keywords); }
			if($description       != '') { $description       = $tcms_main->encodeBase64($description); }
			if($title             != '') { $title             = $tcms_main->encodeBase64($title); }
			if($name              != '') { $name              = $tcms_main->encodeBase64($name); }
			if($new_key           != '') { $new_key           = $tcms_main->encodeBase64($new_key); }
			if($logo              != '') { $logo              = $tcms_main->encodeBase64($logo); }
			if($owner             != '') { $owner             = $tcms_main->encodeBase64($owner); }
			if($owner_url         != '') { $owner_url         = $tcms_main->encodeBase64($owner_url); }
			if($copy              != '') { $copy              = $tcms_main->encodeBase64($copy); }
			if($email             != '') { $email             = $tcms_main->encodeBase64($email); }
			if($new_footer_text   != '') { $new_footer_text   = $tcms_main->encodeBase64($new_footer_text); }
			//
			//***********
			
			
			
			if(substr($url, 0, 4) != 'http') { $url = 'http://'.$url; }
			
			
			
			//***************************************
			
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/namen.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('namen');
			
			$xmluser->writeValue('title', $title);
			$xmluser->writeValue('name', $name);
			$xmluser->writeValue('key', $new_key);
			$xmluser->writeValue('logo', $logo);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('namen');
			$xmluser->_xmlparser();
			
			//***************************************
			
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('footer');
			
			$xmluser->writeValue('websiteowner', $owner);
			$xmluser->writeValue('owner_url', $owner_url);
			$xmluser->writeValue('copyright', $copy);
			$xmluser->writeValue('email', $email);
			$xmluser->writeValue('show_tcmslogo', $new_show_tcmslogo);
			$xmluser->writeValue('show_defaultfooter', $new_show_defaultfoot);
			$xmluser->writeValue('show_page_loading_time', $new_show_plt);
			$xmluser->writeValue('legal_link_in_footer', $new_legallink);
			$xmluser->writeValue('admin_link_in_footer', $new_adminlink);
			$xmluser->writeValue('footer_text', $new_footer_text);
			$xmluser->writeValue('show_bookmark_links', $new_show_bookmark_links);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('footer');
			$xmluser->_xmlparser();
			
			// ---------------------------
			
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('global');
			
			$xmluser->writeValue('menu', $menu);
			$xmluser->writeValue('second_menu', $second_menu);
			$xmluser->writeValue('meta', $keywords);
			$xmluser->writeValue('charset', $charset);
			$xmluser->writeValue('wysiwyg', $tmp_use_wysiwyg);
			$xmluser->writeValue('lang', $tmp_lang);
			$xmluser->writeValue('front_lang', $tmp_front_lang);
			$xmluser->writeValue('description', $description);
			$xmluser->writeValue('currency', $tmp_currency);
			$xmluser->writeValue('toendacms_in_sitetitle', $new_tcmsinst);
			$xmluser->writeValue('default_category', $new_default_cat);
			$xmluser->writeValue('topmenu_active', $new_topmenu_active);
			$xmluser->writeValue('statistics', $new_statistics);
			$xmluser->writeValue('seo_enabled', $new_seo_enabled);
			$xmluser->writeValue('server_folder', $new_seo_folder);
			$xmluser->writeValue('seo_format', $new_seo_format);
			$xmluser->writeValue('seo_news_title', $new_seo_news_title);
			$xmluser->writeValue('seo_content_title', $new_seo_content_title);
			$xmluser->writeValue('site_offline', $new_site_offline);
			$xmluser->writeValue('site_offline_text', $new_site_off_text);
			$xmluser->writeValue('show_top_pages', $new_show_top_pages);
			$xmluser->writeValue('cipher_email', $new_cipher_email);
			$xmluser->writeValue('js_browser_detect', $new_js_browser_detect);
			$xmluser->writeValue('use_cs', $new_use_cs);
			$xmluser->writeValue('captcha', $new_captcha);
			$xmluser->writeValue('captcha_clean_size', $new_captcha_clean);
			$xmluser->writeValue('show_doc_autor', $new_doc_autor);
			$xmluser->writeValue('admin_topmenu', $new_admin_topmenu);
			$xmluser->writeValue('pathway_char', $new_pathchar);
			$xmluser->writeValue('anti_frame', $new_anti_frame);
			$xmluser->writeValue('revisit_after', $new_revisit_after);
			$xmluser->writeValue('robotsfile', $new_robotsfile);
			$xmluser->writeValue('pdflink', $new_pdflink);
			$xmluser->writeValue('cachecontrol', $new_cache_control);
			$xmluser->writeValue('pragma', $new_pragma);
			$xmluser->writeValue('expires', $new_expires);
			$xmluser->writeValue('robots', $new_robots);
			$xmluser->writeValue('last_changes', $new_last_changes);
			$xmluser->writeValue('use_content_language', $new_use_content_l);
			$xmluser->writeValue('valid_links', $new_valid_links);
			$xmluser->writeValue('mediaman_view', $new_mediaman_view);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('global');
			$xmluser->_xmlparser();
			
			
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

?>';
				
			$fp = fopen('../../'.$tcms_administer_site.'/tcms_global/database.php', 'w');
			fwrite($fp, $fp_header);
			fclose($fp);
			
			
			if($check == 'yes') {
				echo '<script>'
				.'document.location=\'index.php\';'
				.'</script>';
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
	
	if($todo == 'backup') {
		if($choosenDB == 'xml') {
			$archive = new PclZip('../../cache/xml_database_backup_'.date('dmYHi').'.zip');
  			$v_list = $archive->create('../../'.$tcms_administer_site);
  			
  			if($v_list == 0) {
  				die('Error : '.$archive->errorInfo(true));
  			}
    		
    		echo '<script>'
    		.'alert(\''._MSG_SAVED.'\');'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\';'
			.'</script>';
		}
		else {
			if(empty($with_output))   { $with_output    = 0; };
			if(empty($structure_only)) { $structure_only = 0; };
			
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlResult = $sqlAL->sqlCreateBackup($with_output, $structure_only);
			
			//$affectedTables = $sqlAL->sqlGetNumber($sqlQR);
			
			//if($affectedTables > 0)
			//	echo '<script>alert(\''._MSG_BACKUP_SUCCESSFULL.' '.$affectedTables.'\');</script>';
			//else
			//	echo '<script>alert(\''._MSG_BACKUP_FAILED.'\');</script>';
			
			if($with_output == 0) {
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
	
	if($todo == 'optimize') {
		if($this_engine == 'mysql') {
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strOptimize = 'OPTIMIZE TABLE ';
			
			$tic = count($arrTables) - 1;
			
			foreach($arrTables as $key => $val) {
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
	
	if($todo == 'restore') {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_global\''
		.'</script>';
	}
}
else {
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
