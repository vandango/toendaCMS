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
 * @version 0.6.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
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
 * getSEOOptionNewsTitle       -> Get the SEO format option: with news title
 * getSEOOptionContentTitle    -> Get the SEO format option: with content title
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
 * getCurrencyHtmlEntity       -> Get the currency html entity
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
 * useContentLanguage          -> Get the usage value for the content languages
 * usePDFLink                  -> Get the setting if the pdf link should be display in footer
 * showValidationLinks         -> Get the setting if the validation links should be displayed
 * getSiteTitle                -> Get the site title
 * getSiteName                 -> Get the site name
 * getSiteKey                  -> Get the site key
 * getSiteLogo                 -> Get the site logo
 * getWebpageOwner             -> Get the webpage owner
 * getWebpageCopyright         -> Get the webpage copyright
 * getWebpageOwnerUrl          -> Get the webpage owner url
 * getWebpageOwnerMail         -> Get the webpage owner mail
 * showTCMSLogo                -> Get the setting if the toendaCMS logo should be displayed
 * showDefaultFooterText       -> Get the setting if the default footer text should be displayed
 * showPageLoadingTime         -> Get the setting if the page loading time should be displayed
 * showLegalLinkInFooter       -> Get the setting if the admin link should be displayed in footer
 * showAdminLinkInFooter       -> Get the setting if the admin link should be displayed in footer
 * getFooterText               -> Get the footer text
 * getAdminTheme               -> Get the admin theme
 * getFrontendTheme            -> Get the frontend theme
 * toendaCMSShopIsInstalled    -> Get the setting if the toendaCMS shop is installed
 * toendaCMSIsInstalled        -> Check if toendaCMS is installed
 * showBookmarkLinks           -> Get a value that indicates if the bookmark links enabled on footer
 * 
 * </code>
 *
 */


class tcms_configuration {
	private $o_xml;
	private $m_administer;
	
	// Config data
	private $m_frontlang;
	private $m_lang;
	private $m_charset;
	private $m_SEOpath;
	private $m_SEOenabled;
	private $m_SEOformat;
	private $m_SEOOptionNewsTitle;
	private $m_SEOOptionContentTitle;
	private $m_cipherEmail;
	private $m_detectBrowser;
	private $m_statistics;
	private $m_use_components;
	private $m_use_captcha;
	private $m_captcha_clean;
	private $m_antiFrame;
	private $m_showTopPages;
	private $m_siteOffline;
	private $m_siteOfflineText;
	private $m_currency;
	private $m_wysiwygEditor;
	private $m_pathwayChar;
	private $m_showDocAutor;
	private $m_defaultCat;
	private $m_tcmsinst;
	private $m_keywords;
	private $m_description;
	private $m_activeTopmenu;
	private $m_sidemenu;
	private $m_topmenu;
	private $m_adminTopmenu;
	private $m_revisit_after;
	private $m_robotsfile;
	private $m_pdflink;
	private $m_cachecontrol;
	private $m_pragma;
	private $m_expires;
	private $m_robots;
	private $m_last_changes;
	private $m_useContentLang;
	private $m_validLinks;
	private $m_mediaman_view;
	private $m_show_bookmark_links;
	
	// names
	private $m_sitetitle;
	private $m_sitename;
	private $m_sitekey;
	private $m_sitelogo;
	
	// footer
	private $m_wpowner;
	private $m_wpcopyright;
	private $m_wpowner_url;
	private $m_wpowner_mail;
	private $m_showtcmslogo;
	private $m_show_default;
	private $m_show_plt;
	private $m_show_llif;
	private $m_show_alif;
	private $m_footer_text;
	
	// layout
	private $m_adminTheme;
	private $m_frontendTheme;
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $administer
	 */
	public function __construct($administer) {
		$this->m_administer = $administer;
		
		if(function_exists('simplexml_load_file')) {
			// var.xml
			if(file_exists($administer.'/tcms_global/var.xml')) {
				$this->o_xml = simplexml_load_file($administer.'/tcms_global/var.xml');
				
				$this->m_charset               = $this->o_xml->charset;
				$this->m_frontlang             = $this->o_xml->front_lang;
				$this->m_lang                  = $this->o_xml->lang;
				$this->m_SEOpath               = $this->o_xml->server_folder;
				$this->m_SEOenabled            = $this->o_xml->seo_enabled;
				$this->m_SEOformat             = $this->o_xml->seo_format;
				$this->m_SEOOptionNewsTitle    = $this->o_xml->seo_news_title;
				$this->m_SEOOptionContentTitle = $this->o_xml->seo_content_title;
				$this->m_cipherEmail           = $this->o_xml->cipher_email;
				$this->m_detectBrowser         = $this->o_xml->js_browser_detect;
				$this->m_statistics            = $this->o_xml->statistics;
				$this->m_use_components        = $this->o_xml->use_cs;
				$this->m_use_captcha           = $this->o_xml->captcha;
				$this->m_captcha_clean         = $this->o_xml->captcha_clean_size;
				$this->m_antiFrame             = $this->o_xml->anti_frame;
				$this->m_showTopPages          = $this->o_xml->show_top_pages;
				$this->m_siteOffline           = $this->o_xml->site_offline;
				$this->m_siteOfflineText       = $this->o_xml->site_offline_text;
				$this->m_currency              = $this->o_xml->currency;
				$this->m_wysiwygEditor         = $this->o_xml->wysiwyg;
				$this->m_pathwayChar           = $this->o_xml->pathway_char;
				$this->m_showDocAutor          = $this->o_xml->show_doc_autor;
				$this->m_defaultCat            = $this->o_xml->default_category;
				$this->m_tcmsinst              = $this->o_xml->toendacms_in_sitetitle;
				$this->m_keywords              = $this->o_xml->meta;
				$this->m_description           = $this->o_xml->description;
				$this->m_activeTopmenu         = $this->o_xml->topmenu_active;
				$this->m_sidemenu              = $this->o_xml->menu;
				$this->m_topmenu               = $this->o_xml->second_menu;
				$this->m_adminTopmenu          = $this->o_xml->admin_topmenu;
				$this->m_revisit_after         = $this->o_xml->revisit_after;
				$this->m_robotsfile            = $this->o_xml->robotsfile;
				$this->m_pdflink               = $this->o_xml->pdflink;
				$this->m_cachecontrol          = $this->o_xml->cachecontrol;
				$this->m_pragma                = $this->o_xml->pragma;
				$this->m_expires               = $this->o_xml->expires;
				$this->m_robots                = $this->o_xml->robots;
				$this->m_last_changes          = $this->o_xml->last_changes;
				$this->m_useContentLang        = $this->o_xml->use_content_language;
				$this->m_validLinks            = $this->o_xml->valid_links;
				$this->m_mediaman_view         = $this->o_xml->mediaman_view;
				
				unset($this->o_xml);
			}
			
			
			// namen.xml
			if(file_exists($administer.'/tcms_global/namen.xml')) {
				$this->o_xml = simplexml_load_file($administer.'/tcms_global/namen.xml');
				
				$this->m_sitetitle = $this->o_xml->title;
				$this->m_sitename  = $this->o_xml->name;
				$this->m_sitekey   = $this->o_xml->key;
				$this->m_sitelogo  = $this->o_xml->logo;
				
				unset($this->o_xml);
			}
			
			
			// footer.xml
			if(file_exists($administer.'/tcms_global/footer.xml')) {
				$this->o_xml = simplexml_load_file($administer.'/tcms_global/footer.xml');
				
				$this->m_wpowner             = $this->o_xml->websiteowner;
				$this->m_wpcopyright         = $this->o_xml->copyright;
				$this->m_wpowner_url         = $this->o_xml->owner_url;
				$this->m_wpowner_mail        = $this->o_xml->email;
				$this->m_showtcmslogo        = $this->o_xml->show_tcmslogo;
				$this->m_show_default        = $this->o_xml->show_defaultfooter;
				$this->m_show_plt            = $this->o_xml->show_page_loading_time;
				$this->m_show_llif           = $this->o_xml->legal_link_in_footer;
				$this->m_show_alif           = $this->o_xml->admin_link_in_footer;
				$this->m_footer_text         = $this->o_xml->footer_text;
				$this->m_show_bookmark_links = $this->o_xml->show_bookmark_links;
				
				unset($this->o_xml);
			}
			
			
			// layout
			if(file_exists($administer.'/tcms_global/footer.xml')) {
				$this->o_xml = simplexml_load_file($administer.'/tcms_global/layout.xml');
				
				$this->m_frontendTheme = $this->o_xml->select;
				$this->m_adminTheme    = $this->o_xml->admin;
				
				unset($this->o_xml);
			}
		}
		else {
			// old xml parser
			
			die('ERROR: SimpleXML not loaded. Please use PHP5 or a newer Version.');
		}
		
		
		// utf8 chars
		$this->m_siteOfflineText = base64_decode($this->m_siteOfflineText);
		$this->m_description     = base64_decode($this->m_description);
		$this->m_keywords        = base64_decode($this->m_keywords);
		$this->m_sitetitle       = base64_decode($this->m_sitetitle);
		$this->m_sitename        = base64_decode($this->m_sitename);
		$this->m_sitekey         = base64_decode($this->m_sitekey);
		$this->m_sitelogo        = base64_decode($this->m_sitelogo);
		$this->m_wpowner         = base64_decode($this->m_wpowner);
		$this->m_wpcopyright     = base64_decode($this->m_wpcopyright);
		$this->m_wpowner_url     = base64_decode($this->m_wpowner_url);
		$this->m_wpowner_mail    = base64_decode($this->m_wpowner_mail);
		$this->m_footer_text     = base64_decode($this->m_footer_text);
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	/**
	 * Decode the configuration object
	 *
	 * @param tcms_main &$tcms_main
	 */
	public function decodeConfiguration(&$tcms_main) {
		$this->m_siteOfflineText = $tcms_main->decodeText($this->m_siteOfflineText, '2', $this->m_charset);
		$this->m_description = $tcms_main->decodeText($this->m_description, '2', $this->m_charset);
		$this->m_keywords = $tcms_main->decodeText($this->m_keywords, '2', $this->m_charset);
		$this->m_sitetitle = $tcms_main->decodeText($this->m_sitetitle, '2', $this->m_charset);
		$this->m_sitename = $tcms_main->decodeText($this->m_sitename, '2', $this->m_charset);
		$this->m_sitekey = $tcms_main->decodeText($this->m_sitekey, '2', $this->m_charset);
		$this->m_sitelogo = $tcms_main->decodeText($this->m_sitelogo, '2', $this->m_charset);
		$this->m_wpowner = $tcms_main->decodeText($this->m_wpowner, '2', $this->m_charset);
		//$this->m_wpcopyright = $tcms_main->decodeText($this->m_wpcopyright, '2', $this->m_charset);
		$this->m_wpowner_url = $tcms_main->decodeText($this->m_wpowner_url, '2', $this->m_charset);
		$this->m_wpowner_mail = $tcms_main->decodeText($this->m_wpowner_mail, '2', $this->m_charset);
		$this->m_footer_text = $tcms_main->decodeText($this->m_footer_text, '2', $this->m_charset);
	}
	
	
	
	/**
	 * Get the language used for the frontend
	 *
	 * @return String
	 */
	public function getLanguageFrontend() {
		return $this->m_frontlang;
	}
	
	
	
	/**
	 * Get the language used for the backend
	 *
	 * @return String
	 */
	public function getLanguageBackend() {
		return $this->m_lang;
	}
	
	
	
	/**
	 * Get the language code
	 *
	 * @param Boolean $inLowerCase = false
	 * @return String
	 */
	public function getLanguageCode($inLowerCase = false){
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
		
		if($inLowerCase) {
			return strtolower($return);
		}
		else {
			return $return;
		}
	}
	
	
	
	/**
	 * Get the language code
	 *
	 * @param String $langCode
	 * @return String
	 */
	public function getLanguageCodeByTCMSCode($langCode){
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
	public function getLanguageCodeForTCMS($langCode){
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
	public function getCharset() {
		return $this->m_charset;
	}
	
	
	
	/**
	 * Get the SEO path
	 *
	 * @return String
	 */
	public function getSEOPath() {
		return $this->m_SEOpath;
	}
	
	
	
	/**
	 * Get the SEO enabled state
	 *
	 * @return Boolean
	 */
	public function getSEOEnabled() {
    	return ( $this->m_SEOenabled == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the SEO format option
	 *
	 * @return String
	 */
	public function getSEOFormat() {
		return $this->m_SEOformat;
	}
  
  
  
  /**
   * Get the SEO format option: with news title
   *
   * @return Boolean
   */
  public function getSEOOptionNewsTitle() {
    return ( $this->m_SEOOptionNewsTitle == '1' ? true : false );
  }
  
  
  
  /**
   * Get the SEO format option: with content title
   *
   * @return Boolean
   */
  public function getSEOOptionContentTitle() {
    return ( $this->m_SEOOptionContentTitle == '1' ? true : false );
  }
	
	
	
	/**
	 * Get the setting if all emails must be ciphered
	 *
	 * @return Integer
	 */
	public function getEmailCiphering() {
		return $this->m_cipherEmail;
	}
	
	
	
	/**
	 * Get the setting if the client browser should be detected by a javascript
	 *
	 * @return Boolean
	 */
	public function getBrowserDetection() {
    	return ( $this->m_detectBrowser == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the statistic is enabled
	 *
	 * @return Boolean
	 */
	public function getStatistics() {
		return ( $this->m_statistics == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if installation uses the components system (API)
	 *
	 * @return Boolean
	 */
	public function getComponentsSystemEnabled() {
		return ( $this->m_use_components == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the installation uses captcha image
	 *
	 * @return Boolean
	 */
	public function getCaptchaEnabled() {
		return ( $this->m_use_captcha == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the captcha clean size setting
	 *
	 * @return Integer
	 */
	public function getCaptchaCleanSize() {
		return $this->m_captcha_clean;
	}
	
	
	
	/**
	 * Get the setting if anti frame is enabled
	 *
	 * @return Boolean
	 */
	public function getAntiFrameEnabled() {
		return ( $this->m_antiFrame == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the document options like the pages are displayed at the top of a document
	 *
	 * @return Boolean
	 */
	public function getShowTopPages() {
		return ( $this->m_showTopPages == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the site is offline
	 *
	 * @return Boolean
	 */
	public function getSiteOffline() {
		return ( $this->m_siteOffline == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the site offline text
	 *
	 * @return String
	 */
	public function getSiteOfflineText() {
		return $this->m_siteOfflineText;
	}
	
	
	
	/**
	 * Get the currency
	 *
	 * @return String
	 */
	public function getCurrency() {
		return $this->m_currency;
	}
	
	
	
	/**
	 * Get the currency html entity
	 *
	 * @return String
	 */
	public function getCurrencyHtmlEntity() {
		$wsCur = '&euro;';
		
		switch($this->m_currency) {
			case 'EUR': $wsCur = '&euro;'; break;
			case 'USD': $wsCur = '$'; break;
			default: $wsCur = '&euro;'; break;
		}
		
		return $wsCur;
	}
	
	
	
	/**
	 * Get the wysiwyg editor
	 *
	 * @return String
	 */
	public function getWYSIWYGEditor() {
		return $this->m_wysiwygEditor;
	}
	
	
	
	/**
	 * Get the pathway char
	 *
	 * @return String
	 */
	public function getPathwayChar() {
		return $this->m_pathwayChar;
	}
	
	
	
	/**
	 * Get the setting if the autor of document should be display
	 *
	 * @return Boolean
	 */
	public function getShowDocAutor() {
		return ( $this->m_showDocAutor == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the default news category
	 *
	 * @return Integer
	 */
	public function getDefaultCategory() {
		return $this->m_defaultCat;
	}
	
	
	
	/**
	 * Get the setting if "toendaCMS" should be in the sitetitle
	 *
	 * @return Boolean
	 */
	public function getToendaCMSInSitetitle() {
		return ( $this->m_tcmsinst == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the active topmenu
	 *
	 * @return Boolean
	 */
	public function getTopmenuActive() {
		return ( $this->m_activeTopmenu == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the keywords for the metadata
	 *
	 * @return String
	 */
	public function getMetadataKeywords() {
		return $this->m_keywords;
	}
	
	
	
	/**
	 * Get the description for the metadata
	 *
	 * @return String
	 */
	public function getMetadataDescription() {
		return $this->m_description;
	}
	
	
	
	/**
	 * Get the setting if the sidemenu is enabled
	 *
	 * @return Boolean
	 */
	public function getSidemenuEnabled() {
		return ( $this->m_sidemenu == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the topmenu is enabled
	 *
	 * @return Boolean
	 */
	public function getTopmenuEnabled() {
		return ( $this->m_topmenu == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting which dropdown menu is enabled for the admin
	 *
	 * @return Integer
	 */
	public function getAdminTopmenu() {
		return $this->m_adminTopmenu;
	}
	
	
	
	/**
	 * Get the time in days to the next searchengine indizies
	 *
	 * @return Integer
	 */
	public function getMetadataRevisitAfterDays() {
		return $this->m_revisit_after;
	}
	
	
	
	/**
	 * Get the url to the robots.txt file
	 *
	 * @return Integer
	 */
	public function getMetadataRobotsFileURL() {
		return $this->m_robotsfile;
	}
	
	
	
	/**
	 * Get the usetting for the cache control metasetting
	 *
	 * @return Integer
	 */
	public function getMetadataCacheControl() {
		return $this->m_cachecontrol;
	}
	
	
	
	/**
	 * Get the settings for the web robots
	 *
	 * @return Integer
	 */
	public function getMetadataRobotsSettings() {
		return $this->m_robots;
	}
	
	
	
	/**
	 * Get the pragma setting
	 *
	 * @return Integer
	 */
	public function getMetadataPragma() {
		return $this->m_pragma;
	}
	
	
	
	/**
	 * Get the setting if the site can disbaled on a time
	 *
	 * @return Integer
	 */
	public function getMetadataExpires() {
		return $this->m_expires;
	}
	
	
	
	/**
	 * Get the last changes
	 *
	 * @return Integer
	 */
	public function getLastChanges() {
		return $this->m_last_changes;
	}
	
	
	
	/**
	 * Get the usage value for the content languages
	 *
	 * @return Boolean
	 */
	public function useContentLanguage() {
		return ( $this->m_useContentLang == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the pdf link should be display in footer
	 *
	 * @return Boolean
	 */
	public function usePDFLink() {
		return ( $this->m_pdflink == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the validation links should be displayed
	 *
	 * @return Boolean
	 */
	public function showValidationLinks() {
		return ( $this->m_validLinks == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the site title
	 *
	 * @return String
	 */
	public function getSiteTitle() {
		return $this->m_sitetitle;
	}
	
	
	
	/**
	 * Get the site name
	 *
	 * @return String
	 */
	public function getSiteName() {
		return $this->m_sitename;
	}
	
	
	
	/**
	 * Get the site key
	 *
	 * @return String
	 */
	public function getSiteKey() {
		return $this->m_sitekey;
	}
	
	
	
	/**
	 * Get the site logo
	 *
	 * @return String
	 */
	public function getSiteLogo() {
		return $this->m_sitelogo;
	}
	
	
	
	/**
	 * Get the webpage owner
	 *
	 * @return String
	 */
	public function getWebpageOwner() {
		return $this->m_wpowner;
	}
	
	
	
	/**
	 * Get the webpage copyright
	 *
	 * @return String
	 */
	public function getWebpageCopyright() {
		return $this->m_wpcopyright;
	}
	
	
	
	/**
	 * Get the webpage owner url
	 *
	 * @return String
	 */
	public function getWebpageOwnerUrl() {
		return $this->m_wpowner_url;
	}
	
	
	
	/**
	 * Get the webpage owner mail
	 *
	 * @return String
	 */
	public function getWebpageOwnerMail() {
		return $this->m_wpowner_mail;
	}
	
	
	
	/**
	 * Get the setting if the toendaCMS logo should be displayed
	 *
	 * @return Boolean
	 */
	public function showTCMSLogo() {
		return ( $this->m_showtcmslogo == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the default footer text should be displayed
	 *
	 * @return Boolean
	 */
	public function showDefaultFooterText() {
		return ( $this->m_show_default == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the page loading time should be displayed
	 *
	 * @return Boolean
	 */
	public function showPageLoadingTime() {
		return ( $this->m_show_plt == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the admin link should be displayed in footer
	 *
	 * @return Boolean
	 */
	public function showLegalLinkInFooter() {
		return ( $this->m_show_llif == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the setting if the admin link should be displayed in footer
	 *
	 * @return Boolean
	 */
	public function showAdminLinkInFooter() {
		return ( $this->m_show_alif == '1' ? true : false );
	}
	
	
	
	/**
	 * Get the footer text
	 *
	 * @return String
	 */
	public function getFooterText() {
		return $this->m_footer_text;
	}
	
	
	
	/**
	 * Get the admin theme
	 *
	 * @return String
	 */
	public function getAdminTheme() {
		return $this->m_adminTheme;
	}
	
	
	
	/**
	 * Get the frontend theme
	 *
	 * @return String
	 */
	public function getFrontendTheme() {
		return $this->m_frontendTheme;
	}
	
	
	
	/**
	 * Get the item view setting for the mediamanager
	 *
	 * @return String
	 */
	public function getMediamanagerItemView() {
		return $this->m_mediaman_view;
	}
	
	
	
	/**
	 * Get the setting if the toendaCMS shop is installed
	 *
	 * @return Boolean
	 */
	public function toendaCMSShopIsInstalled() {
		if(file_exists($this->m_administer.'/components/tcmsshop/tcmsshop.php')) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Check if toendaCMS is installed
	 *
	 */
	public function toendaCMSIsInstalled() {
		if(!file_exists($this->m_administer.'/tcms_global/namen.xml')) {
			return false;
		}
		
		if(!file_exists($this->m_administer.'/tcms_global/var.xml')) {
			return false;
		}
		
		if(!file_exists($this->m_administer.'/tcms_global/footer.xml')) {
			return false;
		}
		
		return true;
	}
	
	
	
	/**
	 * Get a value that indicates if the bookmark links enabled on footer
	 *
	 * @return Boolean
	 */
	public function showBookmarkLinks() {
		return ( $this->m_show_bookmark_links == 1 || $this->m_show_bookmark_links == '1' ? true : false );
	}
}

?>
