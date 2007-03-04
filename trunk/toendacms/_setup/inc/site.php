<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Site settings
|
| File:	site.php
|
+
*/


/**
 * Site settings
 *
 * This file is used for the dite settings.
 *
 * @version 0.2.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


/*
	init
*/

if(!isset($todo)){ $todo = 'global'; }



/*
	charsets
*/

$arr_char[0] = 'ISO-8859-1';
$arr_char[1] = 'ISO-8859-2';
$arr_char[2] = 'ISO-8859-9';
$arr_char[3] = 'ISO-8859-15';
$arr_char[4] = 'UTF-8';
$arr_char[5] = 'cp866';
$arr_char[6] = 'cp1251';
$arr_char[7] = 'cp1252';
$arr_char[8] = 'KOI8-R';
$arr_char[9] = 'BIG5';
$arr_char[10] = 'GB2312';
$arr_char[11] = 'BIG5-HKSCS';
$arr_char[12] = 'Shift_JIS';
$arr_char[13] = 'EUC-JP';



/*
	languages
*/

$arr_language = $tcms_main->readdir_ext('../engine/language/');

$ll = 0;
while(!empty($arr_language[$ll])){
	if($arr_language[$ll] != 'lang_admin.php'){ $arr_lang[$ll] = $arr_language[$ll]; }
	$ll++;
}



/*
	main settings
*/

if($todo == 'global'){
	echo '<h2>'._TCMS_SITE_TITLE.'</h2>';
	echo '<h3>'._TCMS_DB_NEWINSTALL_DB1.' '
	.( $db == 'mysql' ? 'MySQL' : ( $db == 'pgsql' ? 'PostgreSQL' : 'XML' ) ).'&nbsp;'
	._TCMS_DB_NEWINSTALL_DB2.'</h3>';
	echo '<hr />';
	echo '<br />';
	
	
	echo _TCMS_SITE_TEXT;
	
	
	echo '<br />';
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	
	// form head
	echo '<form action="index.php?site=site&amp;lang='.$lang.'" id="site_form" method="post">'
	.'<input name="todo" type="hidden" value="save" />'
	.'<input name="db" type="hidden" value="'.$db.'" />';
	
	
	
	echo '<h3>'._TCMS_SITE_WEBSITE_SETTINGS.'</h3>';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_SITETITLE
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="m_title" type="text" value="The Home of toendaCMS" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_NAME
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="m_name" type="text" value="toendaCMS" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_SUBTITLE
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="new_key" type="text" value="Your ideas ahead" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_OWNER
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="new_websiteowner" type="text" value="Webmaster" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_URL
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="new_owner_url" type="text" value="http://www.example.url" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_COPYRIGHT_YEARS
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="new_copyright" type="text" value="2006" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_CHARSET
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">';
	echo '<!--[if IE]><div style="margin: 0 0 0 30px;"><![endif]-->';
	echo '<select name="tmp_charset" class="tcms_input_site">';
	foreach($arr_char as $ch_key => $ch_value){
		echo '<option value="'.$ch_value.'"'.( $old_charset == $ch_value ? ' selected="selected"' : '' ).'>'.$ch_value.'</option>';
	}
	echo '</select>'
	.'</div>';
	echo '<!--[if IE]></div><![endif]-->';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_LANGUAGE
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">';
	echo '<!--[if IE]><div style="margin: 0 0 0 30px;"><![endif]-->';
	echo '
	<select name="tmp_lang" class="tcms_input_site">';
	foreach($arr_lang as $lg_key => $lg_value){
		echo '
		<option value="'.$lg_value.'"'
		.(
			trim($lang) == 'de' && trim($lg_value) == 'germany_DE'
			?
			' selected="selected"'
			:
			(
				trim($lang) == 'en' && trim($lg_value) == 'english_EN'
				?
				' selected="selected"'
				:
				(
					trim($lg_value) == 'germany_DE'
					?
					' selected="selected"'
					:
					''
				)
			)
		).'>'.$lg_value.'</option>';
	}
	echo '</select>'
	.'</div>';
	echo '<!--[if IE]></div><![endif]-->';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<h3>'._TCMS_SITE_EMAIL.'</h3>';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_GLOBAL_EMAIL
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="email" type="text" value="your@email.here" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<h3>'._TCMS_SITE_NAVIGATION.'</h3>';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_USE_TOPMENU
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">';
	echo '<!--[if IE]><div style="margin: 0 0 0 30px;"><![endif]-->';
	echo '<input checked="checked" type="checkbox" name="second_menu" value="1" />'
	.'</div>';
	echo '<!--[if IE]></div><![endif]-->';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_USE_SIDEMENU
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">';
	echo '<!--[if IE]><div style="margin: 0 0 0 30px;"><![endif]-->';
	echo '<input checked="checked" type="checkbox" name="menu" value="1" />'
	.'</div>';
	echo '<!--[if IE]></div><![endif]-->';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<h3>'._TCMS_SITE_METADATA.'</h3>';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_METATAGS
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="keywords" type="text" value="toendaCMS, Website" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_DESCRIPTION
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="description" type="text" value="The Home of toendaCMS" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'">'
	.'&larr; '._TCMS_BACK
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="javascript:document.getElementById(\'site_form\').submit();">'
	._TCMS_NEXT.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
	
	
	
	
	// table end
	echo '</form>';
}



/*
	save settings
*/

if($todo == 'save'){
	if(!is_writable('../data/tcms_global')){ chmod('../data/tcms_global/', 0777); }
	
	
	
	if($db == 'xml'){
		$m_title          = $tcms_main->decode_text_without_db($m_title, '2', $c_charset);
		$m_name           = $tcms_main->decode_text_without_db($m_name, '2', $c_charset);
		$new_key          = $tcms_main->decode_text_without_db($new_key, '2', $c_charset);
		$new_websiteowner = $tcms_main->decode_text_without_db($new_websiteowner, '2', $c_charset);
		$new_owner_url    = $tcms_main->decode_text_without_db($new_owner_url, '2', $c_charset);
		$new_copyright    = $tcms_main->decode_text_without_db($new_copyright, '2', $c_charset);
		$email            = $tcms_main->decode_text_without_db($email, '2', $c_charset);
		$keywords         = $tcms_main->decode_text_without_db($keywords, '2', $c_charset);
		$description      = $tcms_main->decode_text_without_db($description, '2', $c_charset);
	}
	else{
		$m_title          = $tcms_main->decode_text_without_crypt($m_title, '2', $c_charset);
		$m_name           = $tcms_main->decode_text_without_crypt($m_name, '2', $c_charset);
		$new_key          = $tcms_main->decode_text_without_crypt($new_key, '2', $c_charset);
		$new_websiteowner = $tcms_main->decode_text_without_crypt($new_websiteowner, '2', $c_charset);
		$new_owner_url    = $tcms_main->decode_text_without_crypt($new_owner_url, '2', $c_charset);
		$new_copyright    = $tcms_main->decode_text_without_crypt($new_copyright, '2', $c_charset);
		$email            = $tcms_main->decode_text_without_crypt($email, '2', $c_charset);
		$keywords         = $tcms_main->decode_text_without_crypt($keywords, '2', $c_charset);
		$description      = $tcms_main->decode_text_without_crypt($description, '2', $c_charset);
	}
	
	
	//***************************************
	
	$var_conf = 'namen';
	
	if($m_title   == ''){ $m_title   = '-'; }
	if($m_name    == ''){ $m_name    = '-'; }
	if($new_key   == ''){ $new_key   = '-'; }
	
	$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_global/namen.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section($var_conf);
	
	$xmluser->write_value('title', $m_title);
	$xmluser->write_value('name', $m_name);
	$xmluser->write_value('key', $new_key);
	$xmluser->write_value('logo', '');
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end($var_conf);
	$xmluser->_xmlparser();
	
	//***************************************
	
	$var_conf = 'footer';
	
	if($new_websiteowner == ''){ $new_websiteowner = '-'; }
	if($new_owner_url    == ''){ $new_owner_url    = '-'; }
	if($new_copyright    == ''){ $new_copyright    = '-'; }
	
	$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_global/footer.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section($var_conf);
	
	$xmluser->write_value('websiteowner', $new_websiteowner);
	$xmluser->write_value('owner_url', $new_owner_url);
	$xmluser->write_value('copyright', $new_copyright);
	$xmluser->write_value('email', $email);
	$xmluser->write_value('show_tcmslogo', '0');
	$xmluser->write_value('show_defaultfooter', '0');
	$xmluser->write_value('show_page_loading_time', '0');
	$xmluser->write_value('legal_link_in_footer', '1');
	$xmluser->write_value('admin_link_in_footer', '1');
	$xmluser->write_value('footer_text', '');
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end($var_conf);
	$xmluser->_xmlparser();
	
	//***************************************
	
	$var_conf = 'global';
	
	if(empty($keywords))   { $keywords    = '-'; }
	if(empty($description)){ $description = '-'; }
	
	$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_global/var.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section($var_conf);
	
	$xmluser->write_value('menu', $menu);
	$xmluser->write_value('second_menu', $second_menu);
	$xmluser->write_value('meta', $keywords);
	$xmluser->write_value('charset', $tmp_charset);
	$xmluser->write_value('wysiwyg', 'tinymce');
	$xmluser->write_value('lang', $tmp_lang);
	$xmluser->write_value('front_lang', $tmp_lang);
	$xmluser->write_value('description', $description);
	$xmluser->write_value('currency', 'EUR');
	$xmluser->write_value('toendacms_in_sitetitle', '1');
	$xmluser->write_value('default_category', '');
	$xmluser->write_value('topmenu_active', '1');
	$xmluser->write_value('statistics', '0');
	$xmluser->write_value('seo_enabled', '0');
	$xmluser->write_value('server_folder', '');
	$xmluser->write_value('site_offline', '0');
	$xmluser->write_value('site_offline_text', 'This site is down for maintenance.<br /> Please check back again soon.');
	$xmluser->write_value('show_top_pages', '0');
	$xmluser->write_value('cipher_email', '1');
	$xmluser->write_value('js_browser_detect', '1');
	$xmluser->write_value('use_cs', '1');
	$xmluser->write_value('captcha', '1');
	$xmluser->write_value('captcha_clean_size', '1024');
	$xmluser->write_value('show_doc_autor', '0');
	$xmluser->write_value('admin_topmenu', '0');
	$xmluser->write_value('pathway_char', '/');
	$xmluser->write_value('anti_frame', '1');
	$xmluser->write_value('revisit_after', '2');
	$xmluser->write_value('robotsfile', '');
	$xmluser->write_value('pdflink', '1');
	$xmluser->write_value('cachecontrol', '');
	$xmluser->write_value('pragma', '');
	$xmluser->write_value('expires', '');
	$xmluser->write_value('robots', '');
	$xmluser->write_value('last_changes', date('Y-m-d H:i:s'));
	$xmluser->write_value('use_content_language', '1');
	$xmluser->write_value('valid_links', '1');
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end($var_conf);
	$xmluser->_xmlparser();
	
	//***************************************
	
	$xmluser = new xmlparser('../data/tcms_global/modules.xml', 'w');
	$xmluser->xml_declaration();
	$xmluser->xml_section('config');
	
	$xmluser->write_value('side_gallery', '0');
	$xmluser->write_value('layout_chooser', '0');
	$xmluser->write_value('side_links', '0');
	$xmluser->write_value('login', '1');
	$xmluser->write_value('side_category', '1');
	$xmluser->write_value('side_archives', '1');
	$xmluser->write_value('syndication', '1');
	$xmluser->write_value('newsletter', '0');
	$xmluser->write_value('search', '1');
	$xmluser->write_value('sidebar', '0');
	$xmluser->write_value('poll', '0');
	
	$xmluser->xml_section_buffer();
	$xmluser->xml_section_end('config');
	$xmluser->_xmlparser();
	
	//***************************************
	
	// update now the settings
	if($db == 'xml') {
		updateLanguageForXML($tcms_administer_site);
	}
	
	if(file_exists('../data/tcms_global/namen.xml') && file_exists('../data/tcms_global/footer.xml') && file_exists('../data/tcms_global/var.xml')){
		echo '<script>document.location.href=\'index.php?site=user&lang='.$lang.'&db='.$db.'\';</script>';
	}
	else{
		echo '<script>alert(\''._TCMS_SITE_ERROR.'\');</script>';
		echo '<script>document.location.href=\'index.php?site=site&lang='.$lang.'\';</script>';
	}
}

?>
