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
 * @version 0.2.6
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

$arr_language = $tcms_file->getPathContent('../engine/language/');

$ll = 0;
while(!empty($arr_language[$ll])){
	if($arr_language[$ll] != 'lang_admin.php'){ $arr_lang[$ll] = $arr_language[$ll]; }
	$ll++;
}



/*
	main settings
*/

if($todo == 'global') {
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
	
	
	echo '<h3>'._TCMS_SITE_PATH.'</h3>';
	
	
	$sitePath = str_replace('/_setup/index.php', '', $_SERVER['PHP_SELF']);
	$sitePath = str_replace('/setup/index.php', '', $sitePath);
	$sitePath = substr($sitePath, 1);
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_SITE_PATH_NAME
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="tcms_site_path" type="text" value="'
	.$sitePath
	.'" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	
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
	if(!$tcms_file->checkDirExist('../data/tcms_global')) {
		chmod('../data/tcms_global/', 0777);
	}
	
	if($db == 'xml') {
		$m_title          = $tcms_main->encodeText($m_title, '2', $c_charset, false, true);
		$m_name           = $tcms_main->encodeText($m_name, '2', $c_charset, false, true);
		$new_key          = $tcms_main->encodeText($new_key, '2', $c_charset, false, true);
		$new_websiteowner = $tcms_main->encodeText($new_websiteowner, '2', $c_charset, false, true);
		$new_owner_url    = $tcms_main->encodeText($new_owner_url, '2', $c_charset, false, true);
		$new_copyright    = $tcms_main->encodeText($new_copyright, '2', $c_charset, false, true);
		$email            = $tcms_main->encodeText($email, '2', $c_charset, false, true);
		$keywords         = $tcms_main->encodeText($keywords, '2', $c_charset, false, true);
		$description      = $tcms_main->encodeText($description, '2', $c_charset, false, true);
	}
	else {
		$m_title          = $tcms_main->encodeText($m_title, '2', $c_charset, true);
		$m_name           = $tcms_main->encodeText($m_name, '2', $c_charset, true);
		$new_key          = $tcms_main->encodeText($new_key, '2', $c_charset, true);
		$new_websiteowner = $tcms_main->encodeText($new_websiteowner, '2', $c_charset, true);
		$new_owner_url    = $tcms_main->encodeText($new_owner_url, '2', $c_charset, true);
		$new_copyright    = $tcms_main->encodeText($new_copyright, '2', $c_charset, true);
		$email            = $tcms_main->encodeText($email, '2', $c_charset, true);
		$keywords         = $tcms_main->encodeText($keywords, '2', $c_charset, true);
		$description      = $tcms_main->encodeText($description, '2', $c_charset, true);
	}
	
	
	$new_site_off_text = 'This site is down for maintenance.<br />Please check back again soon.';
	
	
	if($new_site_off_text != ''){ $new_site_off_text = $tcms_main->encodeBase64($new_site_off_text); }
	if($m_title           != ''){ $m_title           = $tcms_main->encodeBase64($m_title); }
	if($m_name            != ''){ $m_name            = $tcms_main->encodeBase64($m_name); }
	if($new_key           != ''){ $new_key           = $tcms_main->encodeBase64($new_key); }
	if($new_websiteowner  != ''){ $new_websiteowner  = $tcms_main->encodeBase64($new_websiteowner); }
	if($new_owner_url     != ''){ $new_owner_url     = $tcms_main->encodeBase64($new_owner_url); }
	if($new_copyright     != ''){ $new_copyright     = $tcms_main->encodeBase64($new_copyright); }
	if($email             != ''){ $email             = $tcms_main->encodeBase64($email); }
	if($keywords          != ''){ $keywords          = $tcms_main->encodeBase64($keywords); }
	if($description       != ''){ $description       = $tcms_main->encodeBase64($description); }
	
	
	//***************************************
	
	$var_conf = 'namen';
	
	if($m_title   == ''){ $m_title   = '-'; }
	if($m_name    == ''){ $m_name    = '-'; }
	if($new_key   == ''){ $new_key   = '-'; }
	
	$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/namen.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection($var_conf);
	
	$xmluser->writeValue('title', $m_title);
	$xmluser->writeValue('name', $m_name);
	$xmluser->writeValue('key', $new_key);
	$xmluser->writeValue('logo', '');
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd($var_conf);
	
	//***************************************
	
	$var_conf = 'footer';
	
	if($new_websiteowner == ''){ $new_websiteowner = '-'; }
	if($new_owner_url    == ''){ $new_owner_url    = '-'; }
	if($new_copyright    == ''){ $new_copyright    = '-'; }
	
	$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/footer.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection($var_conf);
	
	$xmluser->writeValue('websiteowner', $new_websiteowner);
	$xmluser->writeValue('owner_url', $new_owner_url);
	$xmluser->writeValue('copyright', $new_copyright);
	$xmluser->writeValue('email', $email);
	$xmluser->writeValue('show_tcmslogo', '0');
	$xmluser->writeValue('show_defaultfooter', '0');
	$xmluser->writeValue('show_page_loading_time', '0');
	$xmluser->writeValue('legal_link_in_footer', '1');
	$xmluser->writeValue('admin_link_in_footer', '1');
	$xmluser->writeValue('footer_text', '');
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd($var_conf);
	
	//***************************************
	
	$var_conf = 'global';
	
	if(empty($keywords))   { $keywords    = '-'; }
	if(empty($description)){ $description = '-'; }
	
	$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/var.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection($var_conf);
	
	$xmluser->writeValue('menu', $menu);
	$xmluser->writeValue('second_menu', $second_menu);
	$xmluser->writeValue('meta', $keywords);
	$xmluser->writeValue('charset', $tmp_charset);
	$xmluser->writeValue('wysiwyg', 'tinymce');
	$xmluser->writeValue('lang', $tmp_lang);
	$xmluser->writeValue('front_lang', $tmp_lang);
	$xmluser->writeValue('description', $description);
	$xmluser->writeValue('currency', 'EUR');
	$xmluser->writeValue('toendacms_in_sitetitle', '1');
	$xmluser->writeValue('default_category', '');
	$xmluser->writeValue('topmenu_active', '1');
	$xmluser->writeValue('statistics', '0');
	$xmluser->writeValue('seo_enabled', '0');
	$xmluser->writeValue('server_folder', $tcms_site_path);
	$xmluser->writeValue('site_offline', '0');
	$xmluser->writeValue('site_offline_text', '');
	$xmluser->writeValue('show_top_pages', '0');
	$xmluser->writeValue('cipher_email', '1');
	$xmluser->writeValue('js_browser_detect', '1');
	$xmluser->writeValue('use_cs', '1');
	$xmluser->writeValue('captcha', '1');
	$xmluser->writeValue('captcha_clean_size', '1024');
	$xmluser->writeValue('show_doc_autor', '0');
	$xmluser->writeValue('admin_topmenu', '0');
	$xmluser->writeValue('pathway_char', '/');
	$xmluser->writeValue('anti_frame', '1');
	$xmluser->writeValue('revisit_after', '2');
	$xmluser->writeValue('robotsfile', '');
	$xmluser->writeValue('pdflink', '1');
	$xmluser->writeValue('cachecontrol', '');
	$xmluser->writeValue('pragma', '');
	$xmluser->writeValue('expires', '');
	$xmluser->writeValue('robots', '');
	$xmluser->writeValue('last_changes', date('Y-m-d H:i:s'));
	$xmluser->writeValue('use_content_language', '1');
	$xmluser->writeValue('valid_links', '1');
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd($var_conf);
	
	//***************************************
	
	$xmluser = new xmlparser('../data/tcms_global/modules.xml', 'w');
	$xmluser->xmlDeclaration();
	$xmluser->xmlSection('config');
	
	$xmluser->writeValue('side_gallery', '0');
	$xmluser->writeValue('layout_chooser', '0');
	$xmluser->writeValue('side_links', '0');
	$xmluser->writeValue('login', '1');
	$xmluser->writeValue('side_category', '1');
	$xmluser->writeValue('side_archives', '1');
	$xmluser->writeValue('syndication', '1');
	$xmluser->writeValue('newsletter', '0');
	$xmluser->writeValue('search', '1');
	$xmluser->writeValue('sidebar', '0');
	$xmluser->writeValue('poll', '0');
	
	$xmluser->xmlSectionBuffer();
	$xmluser->xmlSectionEnd('config');
	
	//***************************************
	
	// update now the settings
	if($db == 'xml') {
		updateLanguageForXML();
	}
	
	if($tcms_file->checkFileExist('../data/tcms_global/namen.xml') 
	&& $tcms_file->checkFileExist('../data/tcms_global/footer.xml') 
	&& $tcms_file->checkFileExist('../data/tcms_global/var.xml')) {
		echo '<script>'
		.'document.location.href=\'index.php?site=user&lang='.$lang.'&db='.$db.'\';'
		.'</script>';
	}
	else {
		echo '<script>'
		.'alert(\''._TCMS_SITE_ERROR.'\');'
		.'document.location.href=\'index.php?site=site&lang='.$lang.'\';'
		.'</script>';
	}
}

?>
