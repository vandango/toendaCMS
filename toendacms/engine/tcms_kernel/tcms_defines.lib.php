<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Global constants and defines
|
| File:	tcms_defines.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Global constants and defines
 *
 * This is used for global values
 *
 * @version 0.7.9
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */



/*
	DOWNLOAD CATEGORIES
*/

$arr_fs['tag'][0] = 'folder';
$arr_fs['des'][0] = _FOLDER_DEFAULT;
$arr_fs['tag'][1] = 'folder_html';
$arr_fs['des'][1] = _FOLDER_HTML;
$arr_fs['tag'][2] = 'folder_image';
$arr_fs['des'][2] = _FOLDER_IMAGES;
$arr_fs['tag'][3] = 'folder_packages';
$arr_fs['des'][3] = _FOLDER_PACK;
$arr_fs['tag'][4] = 'folder_print';
$arr_fs['des'][4] = _FOLDER_PRINT;
$arr_fs['tag'][5] = 'folder_sound';
$arr_fs['des'][5] = _FOLDER_SOUND;
$arr_fs['tag'][6] = 'folder_txt';
$arr_fs['des'][6] = _FOLDER_DOCU;
$arr_fs['tag'][7] = 'folder_video';
$arr_fs['des'][7] = _FOLDER_VID;





/*
	LANGUAGE NAMES
*/

$languages['code'][0] = 'germany_DE';
$languages['name'][0] = _LANG_GERMAN;
$languages['fine'][0] = 'de';

$languages['code'][1] = 'english_EN';
$languages['name'][1] = _LANG_ENGLISH;
$languages['fine'][1] = 'en';

$languages['code'][2] = 'bulgarian_BG';
$languages['name'][2] = _LANG_BULGARIAN;
$languages['fine'][2] = 'bg';

$languages['code'][3] = 'dutch_NL';
$languages['name'][3] = _LANG_DUTCH;
$languages['fine'][3] = 'nl';

$languages['code'][4] = 'finnish_FI';
$languages['name'][4] = _LANG_FINNISH;
$languages['fine'][4] = 'fi';

$languages['code'][5] = 'italy_IT';
$languages['name'][5] = _LANG_ITALY;
$languages['fine'][5] = 'it';

$languages['code'][6] = 'korean_KR';
$languages['name'][6] = _LANG_KOREAN;
$languages['fine'][6] = 'kr';

$languages['code'][7] = 'norwegian_NO';
$languages['name'][7] = _LANG_NORWEGIAN;
$languages['fine'][7] = 'no';

$languages['code'][8] = 'portugues_BR';
$languages['name'][8] = _LANG_PORTUGUES;
$languages['fine'][8] = 'br';

$languages['code'][9] = 'romanian_RO';
$languages['name'][9] = _LANG_ROMANIAN;
$languages['fine'][9] = 'ro';

$languages['code'][10] = 'slovak_SK';
$languages['name'][10] = _LANG_SLOVAK;
$languages['fine'][10] = 'sk';

$languages['code'][11] = 'spanish_ES';
$languages['name'][11] = _LANG_SPANISH;
$languages['fine'][11] = 'es';

$languages['code'][12] = 'swedish_SE';
$languages['name'][12] = _LANG_SWEDISH;
$languages['fine'][12] = 'se';





/*
	MONTH NAMES
*/

$monthName[1] = _TCMS_MONTH_JANUARY;
$monthName[2] = _TCMS_MONTH_FEBUARY;
$monthName[3] = _TCMS_MONTH_MARCH;
$monthName[4] = _TCMS_MONTH_APRIL;
$monthName[5] = _TCMS_MONTH_MAY;
$monthName[6] = _TCMS_MONTH_JUNE;
$monthName[7] = _TCMS_MONTH_JULY;
$monthName[8] = _TCMS_MONTH_AUGUST;
$monthName[9] = _TCMS_MONTH_SEPTEMBER;
$monthName[10] = _TCMS_MONTH_OCTOBER;
$monthName[11] = _TCMS_MONTH_NOVEMBER;
$monthName[12] = _TCMS_MONTH_DECEMBER;





/*
	DAY NAMES
*/

$dayName['name'][1] = _TCMS_DAY_MONDAY;
$dayName['short'][1] = _TCMS_DAY_MONDAY_XS;
$dayName['name'][2] = _TCMS_DAY_TUESDAY;
$dayName['short'][2] = _TCMS_DAY_TUESDAY_XS;
$dayName['name'][3] = _TCMS_DAY_WEDNESDAY;
$dayName['short'][3] = _TCMS_DAY_WEDNESDAY_XS;
$dayName['name'][4] = _TCMS_DAY_THURSDAY;
$dayName['short'][4] = _TCMS_DAY_THURSDAY_XS;
$dayName['name'][5] = _TCMS_DAY_FRIDAY;
$dayName['short'][5] = _TCMS_DAY_FRIDAY_XS;
$dayName['name'][6] = _TCMS_DAY_SATURDAY;
$dayName['short'][6] = _TCMS_DAY_SATURDAY_XS;
$dayName['name'][7] = _TCMS_DAY_SUNDAY;
$dayName['short'][7] = _TCMS_DAY_SUNDAY_XS;

$dayName['name']['mon'] = _TCMS_DAY_MONDAY;
$dayName['short']['mon'] = _TCMS_DAY_MONDAY_XS;
$dayName['name']['tue'] = _TCMS_DAY_TUESDAY;
$dayName['short']['tue'] = _TCMS_DAY_TUESDAY_XS;
$dayName['name']['wed'] = _TCMS_DAY_WEDNESDAY;
$dayName['short']['wed'] = _TCMS_DAY_WEDNESDAY_XS;
$dayName['name']['thu'] = _TCMS_DAY_THURSDAY;
$dayName['short']['thu'] = _TCMS_DAY_THURSDAY_XS;
$dayName['name']['fri'] = _TCMS_DAY_FRIDAY;
$dayName['short']['fri'] = _TCMS_DAY_FRIDAY_XS;
$dayName['name']['sat'] = _TCMS_DAY_SATURDAY;
$dayName['short']['sat'] = _TCMS_DAY_SATURDAY_XS;
$dayName['name']['sun'] = _TCMS_DAY_SUNDAY;
$dayName['short']['sun'] = _TCMS_DAY_SUNDAY_XS;



/*
	MAIN
*/
/*_PATHWAY*/       if(!defined('_PATHWAY'))        define('_PATHWAY','engine/extensions/ext_pathway.php');
/*_SITETITLE*/     if(!defined('_SITETITLE'))      define('_SITETITLE','engine/extensions/ext_sitetitle.php');
/*_TOP_MENU*/      if(!defined('_TOP_MENU'))       define('_TOP_MENU', 'engine/extensions/ext_topmenu.php');
/*_SIDE_MENU*/     if(!defined('_SIDE_MENU'))      define('_SIDE_MENU', 'engine/extensions/ext_sidemenu.php');
/*_USER_MENU*/     if(!defined('_USER_MENU'))      define('_USER_MENU', 'engine/extensions/ext_usermenu.php');
/*_CONTENT*/       if(!defined('_CONTENT'))        define('_CONTENT','engine/extensions/ext_content.php');
/*_SIDE*/          if(!defined('_SIDE'))           define('_SIDE','engine/extensions/ext_sidebar_content.php');
/*_FOOTER*/        if(!defined('_FOOTER'))         define('_FOOTER', 'engine/extensions/ext_footer.php');



/*
	EXTENSION
*/

//
// --> IN SIDE
//
/*_CS*/            if(!defined('_CS'))             define('_CS', 'engine/extensions/ext_sidebar_components.php');
/*_CATEGORIES*/    if(!defined('_CATEGORIES'))     define('_CATEGORIES', 'engine/extensions/ext_sidebar_category.php');
/*_MONTHVIEW*/     if(!defined('_MONTHVIEW'))      define('_MONTHVIEW', 'engine/extensions/ext_sidebar_monthview.php');
/*_SEARCH*/        if(!defined('_SEARCH'))         define('_SEARCH', 'engine/extensions/ext_search.php');
/*_SEARCH_RESULT*/ if(!defined('_SEARCH_RESULT'))  define('_SEARCH_RESULT', 'engine/extensions/ext_search_result.php');
/*_SHOW_LC*/       if(!defined('_SHOW_LC'))        define('_SHOW_LC', 'engine/extensions/ext_sidebar_layoutchooser.php');
/*_NEWSLETTER*/    if(!defined('_NEWSLETTER'))     define('_NEWSLETTER', 'engine/extensions/ext_sidebar_newsletter.php');
/*_LOGIN*/         if(!defined('_LOGIN'))          define('_LOGIN', 'engine/extensions/ext_sidebar_login.php');
/*_POLL*/          if(!defined('_POLL'))           define('_POLL', 'engine/extensions/ext_sidebar_poll.php');
/*_SIDE_LINKS*/    if(!defined('_SIDE_LINKS'))     define('_SIDE_LINKS', 'engine/extensions/ext_sidebar_links.php');
/*_LAST_IMAGES*/   if(!defined('_LAST_IMAGES'))    define('_LAST_IMAGES', 'engine/extensions/ext_sidebar_gallery.php');
/*_SYNDICATION*/   if(!defined('_SYNDICATION'))    define('_SYNDICATION', 'engine/extensions/ext_syndication.php');
/*_FRONT_NEWS*/    if(!defined('_FRONT_NEWS'))     define('_FRONT_NEWS', 'engine/extensions/ext_sidebar_news.php');
/*_LANG_SELECTOR*/ if(!defined('_LANG_SELECTOR'))  define('_LANG_SELECTOR', 'engine/extensions/ext_language_selector.php');

//
// --> IN CONTENT
//
/*_COMPONENTS*/    if(!defined('_COMPONENTS'))     define('_COMPONENTS', 'engine/extensions/ext_components.php');
/*_PRODUCTS*/      if(!defined('_PRODUCTS'))       define('_PRODUCTS', 'engine/extensions/ext_products.php');
/*_DOWNLOAD*/      if(!defined('_DOWNLOAD'))       define('_DOWNLOAD', 'engine/extensions/ext_download.php');
/*_GUESTBOOK*/     if(!defined('_GUESTBOOK'))      define('_GUESTBOOK', 'engine/extensions/ext_guestbook.php');
/*_IMAGEGALLERY*/  if(!defined('_IMAGEGALLERY'))   define('_IMAGEGALLERY', 'engine/extensions/ext_gallery.php');
/*_NEWSMANAGER*/   if(!defined('_NEWSMANAGER'))    define('_NEWSMANAGER', 'engine/extensions/ext_news.php');
/*_FRONTPAGE*/     if(!defined('_FRONTPAGE'))      define('_FRONTPAGE', 'engine/extensions/ext_frontpage.php');
/*_IMPRESSUM*/     if(!defined('_IMPRESSUM'))      define('_IMPRESSUM', 'engine/extensions/ext_impressum.php');
/*_SEND*/          if(!defined('_SEND'))           define('_SEND', 'engine/extensions/ext_contactform.php');
/*_VERSION*/       if(!defined('_VERSION'))        define('_VERSION', 'engine/extensions/ext_version.php');
/*_REGISTER*/      if(!defined('_REGISTER'))       define('_REGISTER', 'engine/extensions/ext_register.php');
/*_PROFILE*/       if(!defined('_PROFILE'))        define('_PROFILE', 'engine/extensions/ext_profile.php');
/*_ALL_POLLS*/     if(!defined('_ALL_POLLS'))      define('_ALL_POLLS', 'engine/extensions/ext_poll.php');
/*_MAIN_LINKS*/    if(!defined('_MAIN_LINKS'))     define('_MAIN_LINKS', 'engine/extensions/ext_links.php');
/*_KNOWLEDGEBASE*/ if(!defined('_KNOWLEDGEBASE'))  define('_KNOWLEDGEBASE', 'engine/extensions/ext_knowledgebase.php');

//
// --> LITTLE EXTENSIONS
//
/*_CONTENT_FOOTER*/if(!defined('_CONTENT_FOOTER')) define('_CONTENT_FOOTER', 'engine/extensions/ext_content_footer.php');



/*
	CLASSES AND FUNCTIONS
*/
/*_XML*/           if(!defined('_XML'))            define('_XML', 'engine/tcms_kernel/tcms_xml.lib.php');
/*_SQL*/           if(!defined('_SQL'))            define('_SQL', 'engine/tcms_kernel/tcms_sql.lib.php');
/*_CLASSES*/       if(!defined('_CLASSES'))        define('_CLASSES', 'engine/tcms_kernel/tcms.lib.php');
/*_TCMS_SCRIPT*/   if(!defined('_TCMS_SCRIPT'))    define('_TCMS_SCRIPT', 'engine/tcms_kernel/tcms_script.lib.php');



/*
	ERROR PAGES
*/
/*_ERROR_401*/     if(!defined('_ERROR_401'))      define('_ERROR_401', 'engine/extensions/ext_error_401.php');
/*_ERROR_404*/     if(!defined('_ERROR_404'))      define('_ERROR_404', 'engine/extensions/ext_error_404.php');



/*
	SITE NAMES
*/
/*_SITE_NAME*/
$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
.'id=frontpage&amp;s='.$s
.( isset($lang) ? '&amp;lang='.$lang : '' );
$link = $tcms_main->urlConvertToSEO($link);

if(!defined('_SITE_NAME')) define('_SITE_NAME', '<a name="top"></a><span class="title"><a class="index" href="'.$link.'">'.$sitename.'</a></span>');


/*_SITE_KEY*/
if(!defined('_SITE_KEY')) define('_SITE_KEY', '<span class="subtitle">'.$sitekey.'</span>');


/* _SITE_TITLE */
if(!defined('_SITE_TITLE')) define('_SITE_TITLE', $sitetitle);


/* Auslesen der ID f?r die META Daten */
switch($id){
	case 'profile': $id_meta_ad = ''; break;
	case 'register': $id_meta_ad = ''; break;
	case 'polls': $id_meta_ad = _TCMS_MENU_POLL; break;
	case 'imagegallery': $id_meta_ad = _TCMS_MENU_GALLERY; break;
	case 'guestbook': $id_meta_ad = _TCMS_MENU_QBOOK; break;
	case 'newsmanager': $id_meta_ad = _TCMS_MENU_NEWS; break;
	case 'contactform': $id_meta_ad = _TCMS_MENU_CFORM; break;
	case 'knowledgebase': $id_meta_ad = _TCMS_MENU_FAQ; break;
	case 'impressum': $id_meta_ad = _TCMS_MENU_IMP; break;
	case 'frontpage': $id_meta_ad = _TCMS_MENU_FRONT; break;
	case 'search': $id_meta_ad = _TCMS_MENU_SEARCH; break;
	case 'links': $id_meta_ad = _TCMS_MENU_LINK; break;
	case 'download': $id_meta_ad = _TCMS_MENU_NEWS; break;
	case 'products': $id_meta_ad = _TCMS_MENU_PRODUCTS; break;
	case 'components': $id_meta_ad = _TCMS_MENU_CS; break;
	
	default:
		$arrContentAccess = $tcms_dcp->getContentAccess($id, $getLang, $authorized);
		$authorized = $arrContentAccess['authorized'];
		$content_published = $arrContentAccess['content_published'];
		
		if($content_published == 1) {
			$ws_auth = $tcms_main->checkAccess($authorized, $is_admin);
			
			if($ws_auth) {
				using('toendacms.datacontainer.content');
				
				$dcContent = new tcms_dc_content();
				
				$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
				
				$dcContent = $tcms_dcp->getContentDC(
					$id, 
					true, 
					$getLang
				);
				
				$id_meta_ad = $dcContent->getTitle();
				$id_meta_ad .= ': ';
				$id_meta_ad .= $dcContent->getKeynote();
			}
			else {
				$id_meta_ad = '';
			}
		}
		else {
			$id_meta_ad = '';
		}
		break;
}


/* _SITE_METATAG_KEYWORDS */
//$keywords = $tcms_main->decodeText($keywords, '2', $c_charset);
if($tcms_config->getMetadataDescription() != ''
&& trim($id_meta_ad) != '') {
	$keywords = $id_meta_ad.' - '.$keywords;
}
else {
	$keywords = $id_meta_ad;
}

if(!defined('_SITE_METATAG_KEYWORDS')) define('_SITE_METATAG_KEYWORDS', $keywords);


/* _SITE_METATAG_DESCRIPTION */
//$description = $tcms_main->decodeText($description, '2', $c_charset);
if($tcms_config->getMetadataDescription() != ''
&& trim($id_meta_ad) != '') {
	$description = $id_meta_ad.' - '.$description;
}
else {
	$description = $id_meta_ad;
}

if(!defined('_SITE_METATAG_DESCRIPTION')) define('_SITE_METATAG_DESCRIPTION', $description);


/* _SITE_METATAG_AUTOR */
$dynamicDescription = '';
$dynamicKeywords = '';

if(!in_array($id, $arrTCMSModules)) {
	$arrContentAccess = $tcms_dcp->getContentAccess($id, $getLang, $authorized);
	$authorized = $arrContentAccess['authorized'];
	$content_published = $arrContentAccess['content_published'];
	
	if($content_published == 1) {
		$ws_auth = $tcms_main->checkAccess($authorized, $is_admin);
		
		if($ws_auth) {
			using('toendacms.datacontainer.content');
			
			$dcContent = new tcms_dc_content();
			$dcContent = $tcms_dcp->getContentDC($id, true, $getLang);
			
			$docTitle = $dcContent->getTitle();
			$docSubtitle = $dcContent->getKeynote();
			$docContent = $dcContent->getText();
			$docFooter = $dcContent->getFootText();
			$docAutor = $dcContent->getAutor();
			
			$dynamicDescription = $tcms_main->getDocumentMetatagDescription($docContent);
			$dynamicKeywords = $tcms_main->getDocumentMetatagKeywords($docContent);
		}
	}
	
	$websiteownerMETA = $websiteowner.' ('._TABLE_AUTOR.': '.$docAutor.')';
}
else {
	$websiteownerMETA = $websiteowner;
}
if(!defined('_SITE_METATAG_AUTOR')) define('_SITE_METATAG_AUTOR', $websiteownerMETA);


/* _SITE_LOGO */
if($sitelogo != '') {
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
	.'id='.$id.'&amp;s='.$s
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	$sitelogo = '<a href="'.$link.'">'.$sitelogo.'</a>';
}
if(!defined('_SITE_LOGO')) define('_SITE_LOGO', $sitelogo);


/* METADATA */
$strMetaData = '<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
<meta name="generator" content="'.$tcms_version->getName().' - '.$tcms_version->getTagline().'! - Version '.$tcms_version->getVersion().' '.$tcms_version->getBuild().' | Copyright '.$tcms_version->getToendaCopyright().' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" />
<meta name="description" content="'._SITE_METATAG_DESCRIPTION.$dynamicDescription.'" />
<meta name="keywords" content="'._SITE_METATAG_KEYWORDS.$dynamicKeywords.'" />
<meta name="page-topic" content="'._SITE_METATAG_KEYWORDS.$dynamicKeywords.'" />
<meta name="copyright" content="'._SITE_METATAG_AUTOR.' (c) '.$tcms_config->getWebpageCopyright().'" />
<meta name="publisher" content="'._SITE_METATAG_AUTOR.'" />
<meta name="author" content="'._SITE_METATAG_AUTOR.'" />
<meta name="cache-control" content="'.$tcms_config->getMetadataCacheControl().'" />
<meta name="pragma" content="'.$tcms_config->getMetadataPragma().'" />
<meta name="expires" content="'.$tcms_config->getMetadataExpires().'" />
<meta name="date" content="'.$tcms_config->getLastChanges().'" />
<meta name="robots" content="'.$tcms_config->getMetadataRobotsSettings().'" />
<meta name="siteinfo" content="'.$tcms_config->getMetadataRobotsFileURL().'" />
<meta name="revisit-after" content="'.$tcms_config->getMetadataRevisitAfterDays().' days" />
<meta name="msnbot" content="all" />
<meta name="Content-language" content="'.$tcms_config->getLanguageCode().'" />
<meta name="language" content="'.$tcms_config->getLanguageCode().'" />

<!--
 This website is powered by '.$tcms_version->getName().' - '.$tcms_version->getTagline().'!
 Version '.$tcms_version->getVersion().' - '.$tcms_version->getBuild().'
 '.$tcms_version->getName().' is a free open source Content Management Framework created by Jonathan Naumann and licensed under the GNU/GPL license.
 '.$tcms_version->getName().' is copyright (c) '.$tcms_version->getToendaCopyright().' of Toenda Software Development.
 Components are copyright (c) of their respective owners.
 Information and contribution at http://www.toendacms.com
-->

<link rel="stylesheet" href="'.$imagePath.'engine/styles/tcms_common.css" />
<link rel="stylesheet" href="'.$imagePath.'engine/styles/tcms_editor.css" />
';

if($use_syndication == 1) {
	$wsUrlBase = 'http://'.$_SERVER['HTTP_HOST'];
	
	/*
	$wsUrl = '/'.$imagePath.'/cache/ATOM0.3.xml';
	$wsUrl = str_replace('//', '/', $wsUrl);
	
	$strMetaData .= '<link rel="alternate" type="application/atom+xml"'
	.' title="Atom 0.3"'
	.' href="'.$wsUrlBase.$wsUrl.'" />'.chr(13);
	*/
	
	$wsUrl = '/'.$imagePath.'/cache/'.$def_feed.'.'.$lang.'.xml';
	$wsUrl = str_replace('//', '/', $wsUrl);
	
	$strMetaData .= '<link rel="alternate" type="application/rss+xml"'
	.' title="'.$def_feed.'"'
	.' href="'.$wsUrlBase.$wsUrl.'" />';
}

$strMetaData .= '
'.( trim($antiFrame) == 1 ? chr(13).'<script type="text/javascript" language="JavaScript" src="'.$imagePath.'engine/js/antiframe.js"></script>' : '' )
.( trim($detect_browser) == 1 ? chr(13).'<script type="text/javascript" language="JavaScript" src="'.$imagePath.'engine/js/browsercheck.js"></script>' : '' )
.chr(13)
.'<script type="text/javascript" language="JavaScript" src="'.$imagePath.'engine/js/jscrypt.js"></script>
<script type="text/javascript" language="JavaScript" src="'.$imagePath.'engine/js/dhtml.js"></script>
<script type="text/javascript" language="JavaScript" src="'.$imagePath.'engine/js/edit.js"></script>

<!--Lightbox-->
<script type="text/javascript" src="'.$imagePath.'engine/js/lightbox2/prototype.js"></script>
<script type="text/javascript" src="'.$imagePath.'engine/js/lightbox2/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="'.$imagePath.'engine/js/lightbox2/lightbox.js"></script>
<link rel="stylesheet" href="'.$imagePath.'engine/js/lightbox2/css/lightbox.css" type="text/css" media="screen" />

'.( $wysiwygEditor == 'fckeditor' ? '<link rel="stylesheet" href="'.$imagePath.'engine/styles/tcms_fckeditor.css" />' : '' ).'
'.chr(13);
if(!defined('_SITE_META_DATA')) define('_SITE_META_DATA', $strMetaData);



/*
	LAYOUT
*/
if(trim($s) != 'printer') {
	if($tcms_file->checkFileExist('theme/'.$s.'/index.php')) {
		/*_LAYOUT*/
		if(!defined('_LAYOUT')) {
			define('_LAYOUT', 'theme/'.$s.'/index.php');
		}
		
		/*_LAYOUT_GUESTBOOK_ENTRY*/
		if(!defined('_LAYOUT_GUESTBOOK_ENTRY')) {
			define('_LAYOUT_GUESTBOOK_ENTRY', 'theme/'.$s.'/templates/guestbook_entry.tpl');
		}
		
		/*_LAYOUT_LINK_ENTRY*/
		if(!defined('_LAYOUT_LINK_ENTRY')) {
			define('_LAYOUT_LINK_ENTRY', 'theme/'.$s.'/templates/link_entry.tpl');
		}
	}
	else {
		$tcms_error = new tcms_error('tcms_defines.lib.php', 2, $s, $imagePath);
		$tcms_error->showMessage(false);
		
		if(!defined('_LAYOUT')) {
			define('_LAYOUT', '');
		}
		
		if(!defined('_LAYOUT_GUESTBOOK_ENTRY')) {
			define('_LAYOUT_GUESTBOOK_ENTRY', '');
		}
		
		if(!defined('_LAYOUT_LINK_ENTRY')) {
			define('_LAYOUT_LINK_ENTRY', '');
		}
		
		unset($tcms_error);
	}
}
else {
	if(!defined('_LAYOUT')) {
		define('_LAYOUT', 'theme/'.$s.'/index.php');
	}
	
	if(!defined('_LAYOUT_GUESTBOOK_ENTRY')) {
		define('_LAYOUT_GUESTBOOK_ENTRY', '');
	}
	
	if(!defined('_LAYOUT_LINK_ENTRY')) {
		define('_LAYOUT_LINK_ENTRY', '');
	}
}


?>
