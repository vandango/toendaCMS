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
 * @version 0.5.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


echo '<div class="legal">';



/*
	FOOTER TOP
*/

$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=impressum&amp;s='.$s
.( isset($lang) ? '&amp;lang='.$lang : '' );
$link = $tcms_main->urlConvertToSEO($link);

echo '<a class="legal" href="'.$tcms_config->getWebpageOwnerUrl().'" target="_blank">'.$tcms_config->getWebpageOwner().'</a>&nbsp;'
.'<span class="legal">&copy; '.$tcms_config->getWebpageCopyright().' '._TCMS_ADMIN_RIGHT.'</span>&nbsp;';
if($tcms_config->showLegalLinkInFooter()){ echo '|&nbsp;<a class="legal" href="'.$link.'">'._PATH_LEGAL.'</a>&nbsp;'; }
if($tcms_config->showAdminLinkInFooter()){ echo '|&nbsp;<a class="legal" href="'.$imagePath.'engine/admin/index.php">'._LOGIN_ADMIN.'</a>'; }
echo '<br />';



/*
	SHOW ONLY TEXT IN FOOTER
*/
if($tcms_config->showDefaultFooterText()) {
	echo '<span class="legal">'._ABOUT_POWERED_BY.'&nbsp;'
	.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" class="legal" href="http://www.toendacms.com" target="_blank">'.$tcms_version->getName().'</a>&nbsp;&copy;&nbsp;'.$toenda_copyright.'&nbsp;'
	.'<a title="'._ABOUT_POWERED_BY.' '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!" class="legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
	._TCMS_ADMIN_RIGHT.'<br />'.$tcms_version->getName().' - '.$tcms_version->getTagline().'! '._ABOUT_FREE_SOFTWARE.'</span><br />';
}



/*
	ADDITIONAL FOOTER TEXT
*/
echo '<span class="legal">'
.$footer_text
.'</span>';



/*
	SHOW LOGO IN FOOTER
*/
if($tcms_config->showTCMSLogo()) {
	if($tcms_config->showPageLoadingTime()) {
		/*
			SHOW PAGE LOADING TIME
		*/
		echo '<div>'
		.'<span class="legal">'
		._MSG_PAGE_LOAD_1.'&nbsp;'.$tcms_time->getCurrentTimerValue().'&nbsp;'._MSG_PAGE_LOAD_2
		.'. '
		.$tcms_time->getSqlQueryCountValue()
		.'</span>'
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
	if($tcms_config->showPageLoadingTime()){
		if($tcms_config->showTCMSLogo()) {
			echo '<br />';
		}
		
		echo '<div>'
		.'<span class="legal">'
		._MSG_PAGE_LOAD_1.'&nbsp;'.$tcms_time->getCurrentTimerValue().'&nbsp;'._MSG_PAGE_LOAD_2
		.'. '
		.$tcms_time->getSqlQueryCountValue()
		.'</span>'
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
	.'class="legal" href="http://toendacms.com/index.php/en/articles.html?cmd=detail&amp;article=0de66f4a19" target="_blank">'
	.'<img align="center" '
	.'alt="'._FOOTER_VALID_ANY_BROWSER.'" '
	.'title="'._FOOTER_VALID_ANY_BROWSER.'" '
	.'src="'.$imagePath.'engine/images/logos/any_browser.png" border="0" />'
	.'</a>';
}

echo '</div>';


?>
