<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Website Footer
|
| File:		ext_footer.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Website Footer
 *
 * This module is used as a footer.
 *
 * @version 0.3.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


$footer_xml   = new xmlparser($tcms_administer_site.'/tcms_global/footer.xml','r');
$websiteowner = $footer_xml->read_section('footer', 'websiteowner');
$owner_url    = $footer_xml->read_section('footer', 'owner_url');
$copyright    = $footer_xml->read_section('footer', 'copyright');
$show_tcms    = $footer_xml->read_section('footer', 'show_tcmslogo');
$show_default = $footer_xml->read_section('footer', 'show_defaultfooter');
$show_plt     = $footer_xml->read_section('footer', 'show_page_loading_time');
$show_ll      = $footer_xml->read_section('footer', 'legal_link_in_footer');
$show_al      = $footer_xml->read_section('footer', 'admin_link_in_footer');
$footer_text  = $footer_xml->read_section('footer', 'footer_text');
$footer_xml->flush();
$footer_xml->_xmlparser();

if($websiteowner != ''){ $websiteowner = $tcms_main->decodeText($websiteowner, '2', $c_charset); }
if($owner_url    != ''){ $owner_url    = $tcms_main->decodeText($owner_url, '2', $c_charset); }
if($copyright    != ''){ $copyright    = $tcms_main->decodeText($copyright, '2', $c_charset); }
if($footer_text  != ''){ $footer_text  = $tcms_main->decodeText($footer_text, '2', $c_charset); }

include_once(_VERSION);

if(!isset($show_default) || $show_default == ''){
	$show_default = 1;
}



$page_load_time = tcms_time::tcms_load_end();
if($choosenDB != 'xml')
	$page_query_count = tcms_time::tcms_query_count_end_out();



echo '<div class="legal">';



/*
	FOOTER TOP
*/

$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=impressum&amp;s='.$s
.( isset($lang) ? '&amp;lang='.$lang : '' );
$link = $tcms_main->urlAmpReplace($link);

echo '<a class="legal" href="'.$owner_url.'" target="_blank">'.$websiteowner.'</a>&nbsp;'
.'<span class="legal">&copy; '.$copyright.' '._TCMS_ADMIN_RIGHT.'</span>&nbsp;';
if($show_ll == 1){ echo '|&nbsp;<a class="legal" href="'.$link.'">'._PATH_LEGAL.'</a>&nbsp;'; }
if($show_al == 1){ echo '|&nbsp;<a class="legal" href="'.$imagePath.'engine/admin/index.php">'._LOGIN_ADMIN.'</a>'; }
echo '<br />';



/*
	SHOW ONLY TEXT IN FOOTER
*/
if($show_default == 1){
	echo '<span class="legal">'._ABOUT_POWERED_BY.'&nbsp;'
	.'<a title="'._ABOUT_POWERED_BY.' toendaCMS - Your ideas ahead!" class="legal" href="http://www.toenda.com" target="_blank">toendaCMS</a>&nbsp;&copy;&nbsp;'.$toenda_copyright.'&nbsp;'
	.'<a title="'._ABOUT_POWERED_BY.' toendaCMS - Your ideas ahead!" class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
	._TCMS_ADMIN_RIGHT.'<br />toendaCMS - Your ideas ahead! '._ABOUT_FREE_SOFTWARE.'</span><br />';
}



/*
	ADDITIONAL FOOTER TEXT
*/
echo '<span class="legal">'.$footer_text.'</span>';



/*
	SHOW LOGO IN FOOTER
*/
if($show_tcms == 1){
	echo '<div>'
	.'<br />'
	.'<a title="'._ABOUT_POWERED_BY.' toendaCMS - Your ideas ahead!" class="legal" href="http://www.toenda.com" target="_blank">'
	.'<img align="center" '
	.'alt="'._ABOUT_POWERED_BY.' toendaCMS - Your ideas ahead!" '
	.'title="'._ABOUT_POWERED_BY.' toendaCMS - Your ideas ahead!" '
	.'src="'.$imagePath.'engine/images/logos/toendaCMS_button_02.png" border="0" />'
	.'</a>'
	.'</div>';
}



/*
	SHOW PAGE LOADING TIME
*/
if($show_plt == 1){
	//if($show_tcms == 1) --- .'<br />'
	echo '<div>'
	.'<span class="legal">'.$page_load_time.'. '.$page_query_count.'</span>'
	.'</div>';
}

/*
echo '<br />'
.'<p class="legal">Diese Website erf�llt die folgenden Standards: </p>';

echo '<a title="Diese Website entspricht den Section-508-Barrierefreiheitsrichtlinien der US-Regierung." '
.'class="legal" href="http://www.section508.gov" target="_blank">'
.'<img align="center" '
.'alt="Diese Website entspricht den Section-508-Barrierefreiheitsrichtlinien der US-Regierung." '
.'title="Diese Website entspricht den Section-508-Barrierefreiheitsrichtlinien der US-Regierung." '
.'src="'.$imagePath.'engine/images/logos/check_sec508.gif" border="0" />'
.'</a>'
.'&nbsp;';

echo '<a title="Diese toendaCMS-Website entspricht den W3C-WAI-Richtlinien zur Barrierefreiheit von Websites." '
.'class="legal" href="http://www.w3.org/WAI/WCAG1AA-Conformance" target="_blank">'
.'<img align="center" '
.'alt="Diese toendaCMS-Website entspricht den W3C-WAI-Richtlinien zur Barrierefreiheit von Websites." '
.'title="Diese toendaCMS-Website entspricht den W3C-WAI-Richtlinien zur Barrierefreiheit von Websites." '
.'src="'.$imagePath.'engine/images/logos/check_wai-aa.gif" border="0" />'
.'</a>'
.'&nbsp;';

echo '<a title="Diese toendaCMS-Website enth�lt valides XHTML." '
.'class="legal" href="http://validator.w3.org/check/referer" target="_blank">'
.'<img align="center" '
.'alt="Diese toendaCMS-Website enth�lt valides XHTML." '
.'title="Diese toendaCMS-Website enth�lt valides XHTML." '
.'src="'.$imagePath.'engine/images/logos/check_xhtml.png" border="0" />'
.'</a>'
.'&nbsp;';

echo '<a title="Diese Website wurde mit g�ltigem CSS erstellt." '
.'class="legal" href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">'
.'<img align="center" '
.'alt="Diese Website wurde mit g�ltigem CSS erstellt." '
.'title="Diese Website wurde mit g�ltigem CSS erstellt." '
.'src="'.$imagePath.'engine/images/logos/check_css.png" border="0" />'
.'</a>'
.'&nbsp;';
*/

echo '</div>';


?>
