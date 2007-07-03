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
| File:	ext_footer.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Website Footer
 *
 * This module is used as a footer.
 *
 * @version 0.3.7
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



$tcms_time->stopTimer();
$page_load_time = $tcms_time->getTimerValue();
if($choosenDB != 'xml')
	$page_query_count = $tcms_time->getSqlQueryCountValue();

//$page_load_time = tcms_time::tcms_load_end();
//if($choosenDB != 'xml')
//	$page_query_count = tcms_time::tcms_query_count_end_out();



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
	.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" class="legal" href="http://www.toendacms.com" target="_blank">'.$tcms_version->getName().'</a>&nbsp;&copy;&nbsp;'.$toenda_copyright.'&nbsp;'
	.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
	._TCMS_ADMIN_RIGHT.'<br />'.$tcms_version->getName().' - '.$tcms_version->getTagline().'! '._ABOUT_FREE_SOFTWARE.'</span><br />';
}



/*
	ADDITIONAL FOOTER TEXT
*/
echo '<span class="legal">'.$footer_text.'</span>';



/*
	SHOW LOGO IN FOOTER
*/
if($show_tcms == 1){
	if($show_plt == 1){
		/*
			SHOW PAGE LOADING TIME
		*/
		echo '<div>'
		.'<span class="legal">'.$page_load_time.'. '.$page_query_count.'</span>'
		.'</div>';
	}
	
	echo '<div>'
	.'<br />'
	.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" class="legal" href="http://www.toendacms.com" target="_blank">'
	.'<img align="center" '
	.'alt="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" '
	.'title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" '
	.'src="'.$imagePath.'engine/images/logos/toendaCMS_button_02.png" border="0" />'
	.'</a>'
	.'</div>';
}
else {
	/*
		SHOW PAGE LOADING TIME
	*/
	if($show_plt == 1){
		if($show_tcms == 1) echo '<br />';
		
		echo '<div>'
		.'<span class="legal">'.$page_load_time.'. '.$page_query_count.'</span>'
		.'</div>';
	}
}


/*
	SHOW THE VALIDATION LINKS
*/
if($tcms_config->showValidationLinks()) {
	echo '<p class="legal">'._FOOTER_VALID_TITLE.': </p>';
	
	echo '<a title="'._FOOTER_VALID_US_805.'" '
	.'class="legal" href="http://www.section508.gov" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_US_805.'" '
	.'title="'._FOOTER_VALID_US_805.'" '
	.'src="'.$imagePath.'engine/images/logos/check_sec508.gif" border="0" />'
	.'</a>'
	.'&nbsp;';
	
	echo '<a title="'._FOOTER_VALID_W3C_WAI.'" '
	.'class="legal" href="http://www.w3.org/WAI/WCAG1AA-Conformance" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_W3C_WAI.'" '
	.'title="'._FOOTER_VALID_W3C_WAI.'" '
	.'src="'.$imagePath.'engine/images/logos/check_wai-aa.gif" border="0" />'
	.'</a>'
	.'&nbsp;';
	
	echo '<a title="'._FOOTER_VALID_XHTML.'" '
	.'class="legal" href="http://validator.w3.org/check/referer" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_XHTML.'" '
	.'title="'._FOOTER_VALID_XHTML.'" '
	.'src="'.$imagePath.'engine/images/logos/check_xhtml.png" border="0" />'
	.'</a>'
	.'&nbsp;';
	
	echo '<a title="'._FOOTER_VALID_CSS.'" '
	.'class="legal" href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_CSS.'" '
	.'title="'._FOOTER_VALID_CSS.'" '
	.'src="'.$imagePath.'engine/images/logos/check_css.png" border="0" />'
	.'</a>'
	.'&nbsp;';
	
	echo '<a title="'._FOOTER_VALID_ANY_BROWSER.'" '
	.'class="legal" href="http://wiki.toendacms.com/index.php/ToendaCMS_Browser_Support" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_ANY_BROWSER.'" '
	.'title="'._FOOTER_VALID_ANY_BROWSER.'" '
	.'src="'.$imagePath.'engine/images/logos/any_browser.png" border="0" />'
	.'</a>';
}

echo '</div>';


?>
