<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Configuration
|
| File:	tcms_configuration.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Configuration
 *
 * This class is used to provide the global
 * configuration data.
 *
 * @version 0.3.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_configuration          -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_configuration         -> PHP4 Destructor
 *
 * getLanguageFrontend         -> Get the language used for the frontend
 * getLanguageBackend          -> Get the language used for the backend
 * getLanguageCode             -> Get the language code
 * getLanguageCodeByTCMSCode   -> Get the language code
 * getLanguageCodeForTCMS      -> Get the language code for toendaCMS
 * getCharset                  -> Get the charset
 * getSEOPath                  -> Get the SEO path
 * getSEOEnabled               -> Get the SEO enabled state
 * getSEOFormat                -> Get the SEO format option
 * getEmailCiphering           -> Get the setting if all emails must be ciphered
 * getBrowserDetection         -> Get the setting if the client browser should be detected by a javascript
 * getStatistics               -> Get the setting if the statistic is enabled
 * getComponentsSystemEnabled  -> Get the setting if installation uses the components system (API)
 * getCaptchaEnabled           -> Get the setting if the installation uses captcha image
 * getCaptchaCleanSize         -> Get the captcha clean size setting
 * getAntiFrameEnabled         -> Get the setting if anti frame is enabled
 * getShowTopPages             -> Get the setting if the document options like the pages are displayed at the top of a document
 * getSiteOffline              -> Get the setting if the site is offline
 * getSiteOfflineText          -> Get the site offline text
 * getCurrency                 -> Get the currency
 * getWYSIWYGEditor            -> Get the wysiwyg editor
 * getPathwayChar              -> Get the pathway char
 * getToendaCMSInSitetitle     -> Get the setting if "toendaCMS" should be in the sitetitle
 * getDefaultCategory          -> Get the defualt news category
 * getShowDocAutor             -> Get the setting if the autor of document should be display
 * getTopmenuActive            -> Get the active topmenu
 * getMetadataKeywords         -> Get the keywords for the metadata
 * getMetadataDescription      -> Get the description for the metadata
 * getSidemenuEnabled          -> Get the setting if the sidemenu is enabled
 * getTopmenuEnabled           -> Get the setting if the topmenu is enabled
 * getAdminTopmenu             -> Get the setting which dropdown menu is enabled for the admin
 * getMetadataRevisitAfterDays -> Get the time in days to the next searchengine indizies
 * getMetadataRobotsFileURL    -> Get the url to the robots.txt file
 * getMetadataCacheControl     -> Get the setting for the cache control metasetting
 * getMetadataRobotsSettings   -> Get the settings for the web robots
 * getMetadataPragma           -> Get the pragma setting
 * getMetadataExpires          -> Get the setting if the site can disbaled on a time
 * getLastChanges              -> Get the last changes
 * 
 * useContentLanguage          -> Get the usage value for the content languages
 * usePDFLink                  -> Get the setting if the pdf link should be display in footer
 * 
 * showValidationLinks         -> Get the setting if the validation links should be displayed
 * 
 * </code>
 *
 */


class tcms_configuration {
	var $o_xml;
	var $m_administer;
	
	// Config data
	var $m_frontlang;
	var $m_lang;
	var $m_charset;
	var $m_SEOpath;
	var $m_SEOenabled;
	var $m_SEOformat;
	var $m_cipherEmail;
	var $m_detectBrowser;
	var $m_statistics;
	var $m_use_components;
	var $m_use_captcha;
	var $m_captcha_clean;
	var $m_antiFrame;
	var $m_showTopPages;
	var $m_siteOffline;
	var $m_siteOfflineText;
	var $m_currency;
	var $m_wysiwygEditor;
	var $m_pathwayChar;
	var $m_showDocAutor;
	var $m_defaultCat;
	var $m_tcmsinst;
	var $m_keywords;
	var $m_description;
	var $m_activeTopmenu;
	var $m_sidemenu;
	var $m_topmenu;
	var $m_adminTopmenu;
	var $m_revisit_after;
	var $m_robotsfile;
	var $m_pdflink;
	var $m_cachecontrol;
	var $m_pragma;
	var $m_expires;
	var $m_robots;
	var $m_last_changes;
	var $m_useContentLang;
	var $m_validLinks;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $administer
	 */
	function __construct($administer){
		$this->o_xml = new xmlparser($administer.'/tcms_global/var.xml', 'r');
		
		$this->m_charset          = $this->o_xml->read_section('global', 'charset');
		$this->m_frontlang        = $this->o_xml->read_section('global', 'front_lang');
		$this->m_lang             = $this->o_xml->read_section('global', 'lang');
		$this->m_SEOpath          = $this->o_xml->read_section('global', 'server_folder');
		$this->m_SEOenabled       = $this->o_xml->read_section('global', 'seo_enabled');
		$this->m_SEOformat        = $this->o_xml->read_section('global', 'seo_format');
		$this->m_cipherEmail      = $this->o_xml->read_section('global', 'cipher_email');
		$this->m_detectBrowser    = $this->o_xml->read_section('global', 'js_browser_detect');
		$this->m_statistics       = $this->o_xml->read_section('global', 'statistics');
		$this->m_use_components   = $this->o_xml->read_section('global', 'use_cs');
		$this->m_use_captcha      = $this->o_xml->read_section('global', 'captcha');
		$this->m_captcha_clean    = $this->o_xml->read_section('global', 'captcha_clean_size');
		$this->m_antiFrame        = $this->o_xml->read_section('global', 'anti_frame');
		$this->m_showTopPages     = $this->o_xml->read_section('global', 'show_top_pages');
		$this->m_siteOffline      = $this->o_xml->read_section('global', 'site_offline');
		$this->m_siteOfflineText  = $this->o_xml->read_section('global', 'site_offline_text');
		$this->m_currency         = $this->o_xml->read_section('global', 'currency');
		$this->m_wysiwygEditor    = $this->o_xml->read_section('global', 'wysiwyg');
		$this->m_pathwayChar      = $this->o_xml->read_section('global', 'pathway_char');
		$this->m_showDocAutor     = $this->o_xml->read_section('global', 'show_doc_autor');
		$this->m_defaultCat       = $this->o_xml->read_section('global', 'default_category');
		$this->m_tcmsinst         = $this->o_xml->read_section('global', 'toendacms_in_sitetitle');
		$this->m_keywords         = $this->o_xml->read_section('global', 'meta');
		$this->m_description      = $this->o_xml->read_section('global', 'description');
		$this->m_activeTopmenu    = $this->o_xml->read_section('global', 'topmenu_active');
		$this->m_sidemenu         = $this->o_xml->read_section('global', 'menu');
		$this->m_topmenu          = $this->o_xml->read_section('global', 'second_menu');
		$this->m_adminTopmenu     = $this->o_xml->read_section('global', 'admin_topmenu');
		$this->m_revisit_after    = $this->o_xml->read_section('global', 'revisit_after');
		$this->m_robotsfile       = $this->o_xml->read_section('global', 'robotsfile');
		$this->m_pdflink          = $this->o_xml->read_section('global', 'pdflink');
		$this->m_cachecontrol     = $this->o_xml->read_section('global', 'cachecontrol');
		$this->m_pragma           = $this->o_xml->read_section('global', 'pragma');
		$this->m_expires          = $this->o_xml->read_section('global', 'expires');
		$this->m_robots           = $this->o_xml->read_section('global', 'robots');
		$this->m_last_changes     = $this->o_xml->read_section('global', 'last_changes');
		$this->m_useContentLang   = $this->o_xml->read_section('global', 'use_content_language');
		$this->m_validLinks       = $this->o_xml->read_section('global', 'valid_links');
		
		$this->o_xml->flush();
		$this->o_xml->_xmlparser();
		unset($this->o_xml);
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $administer
	 */
	function tcms_configuration($administer){
		$this->__construct($administer);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_configuration(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Get the language used for the frontend
	 *
	 * @return String
	 */
	function getLanguageFrontend(){
		return $this->m_frontlang;
	}
	
	
	
	/**
	 * Get the language used for the backend
	 *
	 * @return String
	 */
	function getLanguageBackend(){
		return $this->m_lang;
	}
	
	
	
	/**
	 * Get the language code
	 *
	 * @param Boolean $inLowerCase = false
	 * @return String
	 */
	function getLanguageCode($inLowerCase = false){
		switch($this->m_frontlang){
			case 'bulgarian_BG': $return = 'BG'; break;
			case 'dutch_NL': $return = 'NL'; break;
			case 'english_EN': $return = 'EN'; break;
			case 'finnish_FI': $return = 'FI'; break;
			case 'germany_DE': $return = 'DE'; break;
			case 'italy_IT': $return = 'IT'; break;
			case 'korean_KR': $return = 'KR'; break;
			case 'norwegian_NO': $return = 'NO'; break;
			case 'portugues_BR': $return = 'BR'; break;
			case 'romanian_RO': $return = 'RO'; break;
			case 'slovak_SK': $return = 'SK'; break;
			case 'spanish_ES': $return = 'ES'; break;
			case 'swedish_SE': $return = 'SE'; break;
		}
		
		if($inLowerCase)
			return strtolower($return);
		else
			return $return;
	}
	
	
	
	/**
	 * Get the language code
	 *
	 * @param String $langCode
	 * @return String
	 */
	function getLanguageCodeByTCMSCode($langCode){
		switch($langCode){
			case 'bulgarian_BG': $return = 'bg'; break;
			case 'dutch_NL': $return = 'nl'; break;
			case 'english_EN': $return = 'en'; break;
			case 'finnish_FI': $return = 'fi'; break;
			case 'germany_DE': $return = 'de'; break;
			case 'italy_IT': $return = 'it'; break;
			case 'korean_KR': $return = 'kr'; break;
			case 'norwegian_NO': $return = 'no'; break;
			case 'portugues_BR': $return = 'br'; break;
			case 'romanian_RO': $return = 'ro'; break;
			case 'slovak_SK': $return = 'sk'; break;
			case 'spanish_ES': $return = 'es'; break;
			case 'swedish_SE': $return = 'se'; break;
		}
		
		return $return;
	}
	
	
	
	/**
	 * Get the language code for toendaCMS.
	 * Change <de> into <germany_DE> and <en> into <english_EN>.
	 *
	 * @param String $langCode
	 * @return String
	 */
	function getLanguageCodeForTCMS($langCode){
		switch(strtolower($langCode)){
			case 'bg': $return = 'bulgarian_BG'; break;
			case 'nl': $return = 'dutch_NL'; break;
			case 'en': $return = 'english_EN'; break;
			case 'fi': $return = 'finnish_FI'; break;
			case 'de': $return = 'germany_DE'; break;
			case 'it': $return = 'italy_IT'; break;
			case 'kr': $return = 'korean_KR'; break;
			case 'no': $return = 'norwegian_NO'; break;
			case 'br': $return = 'portugues_BR'; break;
			case 'ro': $return = 'romanian_RO'; break;
			case 'sk': $return = 'slovak_SK'; break;
			case 'es': $return = 'spanish_ES'; break;
			case 'se': $return = 'swedish_SE'; break;
		}
		
		return $return;
	}
	
	
	
	/**
	 * Get the charset
	 *
	 * @return String
	 */
	function getCharset(){
		return $this->m_charset;
	}
	
	
	
	/**
	 * Get the SEO path
	 *
	 * @return String
	 */
	function getSEOPath(){
		return $this->m_SEOpath;
	}
	
	
	
	/**
	 * Get the SEO enabled state
	 *
	 * @return Integer
	 */
	function getSEOEnabled(){
		return $this->m_SEOenabled;
	}
	
	
	
	/**
	 * Get the SEO format option
	 *
	 * @return String
	 */
	function getSEOFormat(){
		return $this->m_SEOformat;
	}
	
	
	
	/**
	 * Get the setting if all emails must be ciphered
	 *
	 * @return Integer
	 */
	function getEmailCiphering(){
		return $this->m_cipherEmail;
	}
	
	
	
	/**
	 * Get the setting if the client browser should be detected by a javascript
	 *
	 * @return Integer
	 */
	function getBrowserDetection(){
		return $this->m_detectBrowser;
	}
	
	
	
	/**
	 * Get the setting if the statistic is enabled
	 *
	 * @return Integer
	 */
	function getStatistics(){
		return $this->m_statistics;
	}
	
	
	
	/**
	 * Get the setting if installation uses the components system (API)
	 *
	 * @return Integer
	 */
	function getComponentsSystemEnabled(){
		return $this->m_use_components;
	}
	
	
	
	/**
	 * Get the setting if the installation uses captcha image
	 *
	 * @return Integer
	 */
	function getCaptchaEnabled(){
		return $this->m_use_captcha;
	}
	
	
	
	/**
	 * Get the captcha clean size setting
	 *
	 * @return Integer
	 */
	function getCaptchaCleanSize(){
		return $this->m_captcha_clean;
	}
	
	
	
	/**
	 * Get the setting if anti frame is enabled
	 *
	 * @return Integer
	 */
	function getAntiFrameEnabled(){
		return $this->m_antiFrame;
	}
	
	
	
	/**
	 * Get the setting if the document options like the pages are displayed at the top of a document
	 *
	 * @return Integer
	 */
	function getShowTopPages(){
		return $this->m_showTopPages;
	}
	
	
	
	/**
	 * Get the setting if the site is offline
	 *
	 * @return Integer
	 */
	function getSiteOffline(){
		return $this->m_siteOffline;
	}
	
	
	
	/**
	 * Get the site offline text
	 *
	 * @return String
	 */
	function getSiteOfflineText(){
		return $this->m_siteOfflineText;
	}
	
	
	
	/**
	 * Get the currency
	 *
	 * @return String
	 */
	function getCurrency(){
		return $this->m_currency;
	}
	
	
	
	/**
	 * Get the wysiwyg editor
	 *
	 * @return String
	 */
	function getWYSIWYGEditor(){
		return $this->m_wysiwygEditor;
	}
	
	
	
	/**
	 * Get the pathway char
	 *
	 * @return String
	 */
	function getPathwayChar(){
		return $this->m_pathwayChar;
	}
	
	
	
	/**
	 * Get the setting if the autor of document should be display
	 *
	 * @return Integer
	 */
	function getShowDocAutor(){
		return $this->m_showDocAutor;
	}
	
	
	
	/**
	 * Get the default news category
	 *
	 * @return Integer
	 */
	function getDefaultCategory(){
		return $this->m_defaultCat;
	}
	
	
	
	/**
	 * Get the setting if "toendaCMS" should be in the sitetitle
	 *
	 * @return String
	 */
	function getToendaCMSInSitetitle(){
		return $this->m_tcmsinst;
	}
	
	
	
	/**
	 * Get the active topmenu
	 *
	 * @return Integer
	 */
	function getTopmenuActive(){
		return $this->m_activeTopmenu;
	}
	
	
	
	/**
	 * Get the keywords for the metadata
	 *
	 * @return String
	 */
	function getMetadataKeywords(){
		return $this->m_keywords;
	}
	
	
	
	/**
	 * Get the description for the metadata
	 *
	 * @return String
	 */
	function getMetadataDescription(){
		return $this->m_description;
	}
	
	
	
	/**
	 * Get the setting if the sidemenu is enabled
	 *
	 * @return Integer
	 */
	function getSidemenuEnabled(){
		return $this->m_sidemenu;
	}
	
	
	
	/**
	 * Get the setting if the topmenu is enabled
	 *
	 * @return Integer
	 */
	function getTopmenuEnabled(){
		return $this->m_topmenu;
	}
	
	
	
	/**
	 * Get the setting which dropdown menu is enabled for the admin
	 *
	 * @return Integer
	 */
	function getAdminTopmenu(){
		return $this->m_adminTopmenu;
	}
	
	
	
	/**
	 * Get the time in days to the next searchengine indizies
	 *
	 * @return Integer
	 */
	function getMetadataRevisitAfterDays(){
		return $this->m_revisit_after;
	}
	
	
	
	/**
	 * Get the url to the robots.txt file
	 *
	 * @return Integer
	 */
	function getMetadataRobotsFileURL(){
		return $this->m_robotsfile;
	}
	
	
	
	/**
	 * Get the usetting for the cache control metasetting
	 *
	 * @return Integer
	 */
	function getMetadataCacheControl(){
		return $this->m_cachecontrol;
	}
	
	
	
	/**
	 * Get the settings for the web robots
	 *
	 * @return Integer
	 */
	function getMetadataRobotsSettings(){
		return $this->m_robots;
	}
	
	
	
	/**
	 * Get the pragma setting
	 *
	 * @return Integer
	 */
	function getMetadataPragma(){
		return $this->m_pragma;
	}
	
	
	
	/**
	 * Get the setting if the site can disbaled on a time
	 *
	 * @return Integer
	 */
	function getMetadataExpires(){
		return $this->m_expires;
	}
	
	
	
	/**
	 * Get the last changes
	 *
	 * @return Integer
	 */
	function getLastChanges(){
		return $this->m_last_changes;
	}
	
	
	
	/**
	 * Get the usage value for the content languages
	 *
	 * @return String
	 */
	function useContentLanguage() {
		return $this->m_useContentLang;
	}
	
	
	
	/**
	 * Get the setting if the pdf link should be display in footer
	 *
	 * @return Integer
	 */
	function usePDFLink(){
		return $this->m_pdflink;
	}
	
	
	
	/**
	 * Get the setting if the validation links should be displayed
	 *
	 * @return Integer
	 */
	function showValidationLinks(){
		return $this->m_validLinks;
	}
}

?>
