<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
| "your ideas ahead"                                                     |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Startpage and Main file for toendaCMS
|
| File:	index.php
|
+
*/


//echo md5('banane').'<br />';
//for($i = 0; $i<5; $i++) echo md5(microtime()).'<br />';


/**
 * Startpage and Main file for toendaCMS
 * 
 * This is the global startfile and the page loading
 * control.
 * 
 * @version 2.8.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


/*
	MAIN VARIABLES
*/
if(isset($_GET['id'])) { $id = $_GET['id']; }
if(isset($_GET['s'])) { $s = $_GET['s']; }
if(isset($_GET['u'])) { $u = $_GET['u']; }
if(isset($_GET['session'])) { $session = $_GET['session']; }
if(isset($_GET['item'])) { $item = $_GET['item']; }
if(isset($_GET['feed'])) { $feed = $_GET['feed']; }
if(isset($_GET['page'])) { $page = $_GET['page']; }
if(isset($_GET['lang'])) { $lang = $_GET['lang']; }
if(isset($_GET['contact_email'])) { $contact_email = $_GET['contact_email']; }

if(isset($_POST['id'])) { $id = $_POST['id']; }
if(isset($_POST['s'])) { $s = $_POST['s']; }
if(isset($_POST['u'])) { $u = $_POST['u']; }
if(isset($_POST['session'])) { $session = $_POST['session']; }
if(isset($_POST['item'])) { $item = $_POST['item']; }
if(isset($_POST['feed'])) { $feed = $_POST['feed']; }
if(isset($_POST['page'])) { $page = $_POST['page']; }
if(isset($_POST['lang'])) { $lang = $_POST['lang']; }
if(isset($_POST['contact_email'])) { $contact_email = $_POST['contact_email']; }


/*
	INIT GLOBAL
*/

define('_TCMS_VALID', 1);

include_once('engine/tcms_kernel/tcms_loader.lib.php');

include_once('site.php');
$tcms_administer_site = $tcms_site[0]['path'];

// database
if(file_exists($tcms_administer_site.'/tcms_global/database.php')) {
	require($tcms_administer_site.'/tcms_global/database.php');
	
	$choosenDB = $tcms_db_engine;
	$sqlUser   = $tcms_db_user;
	$sqlPass   = $tcms_db_password;
	$sqlHost   = $tcms_db_host;
	$sqlDB     = $tcms_db_database;
	$sqlPort   = $tcms_db_port;
	$sqlPrefix = $tcms_db_prefix;
}

// page
if(!isset($ws_error)) {
	$ws_error = false;
}

$wsShowSite = true;
$noSEOFolder = false;
$isTestEnvironment = false;

using('toendacms.kernel.time');
using('toendacms.kernel.xml');
using('toendacms.kernel.parameter');
using('toendacms.kernel.configuration');
using('toendacms.kernel.version');
using('toendacms.kernel.html');
using('toendacms.kernel.main');
using('toendacms.kernel.sql');
using('toendacms.kernel.file');
using('toendacms.kernel.datacontainer_provider');
using('toendacms.kernel.authentication');
using('toendacms.kernel.account_provider');

// time class
$tcms_time = new tcms_time();

$tcms_time->startTimer();
if(isset($choosenDB) && $choosenDB != 'xml') {
	$tcms_time->startSqlQueryCounter();
}

// params
$tcms_param = new tcms_parameter();

// html class
$tcms_html = new tcms_html();

// filehandler
$tcms_file = new tcms_file();

// load config
if($tcms_file->checkFileExist($tcms_administer_site.'/tcms_global/var.xml')) {
	$tcms_version = new tcms_version();
	$tcms_config  = new tcms_configuration($tcms_administer_site);
	
	$c_charset      = $tcms_config->getCharset();
	$seoFolder      = $tcms_config->getSEOPath();
	$seoEnabled     = $tcms_config->getSEOEnabled();
	$seoFormat      = $tcms_config->getSEOFormat();
	$cipher_email   = $tcms_config->getEmailCiphering();
	$detect_browser = ( $tcms_config->getBrowserDetection() ? 1 : 0 );
	$statistics     = $tcms_config->getStatistics();
	$use_components = $tcms_config->getComponentsSystemEnabled();
	$use_captcha    = $tcms_config->getCaptchaEnabled();
	$captcha_clean  = $tcms_config->getCaptchaCleanSize();
	$antiFrame      = $tcms_config->getAntiFrameEnabled();
	$show_pages     = $tcms_config->getShowTopPages();
	$currency       = $tcms_config->getCurrency();
	$wysiwygEditor  = $tcms_config->getWYSIWYGEditor();
	$pathwayChar    = $tcms_config->getPathwayChar();
	$site_offline   = $tcms_config->getSiteOffline();
	
	// create main object
	$tcms_main = new tcms_main($tcms_administer_site, $tcms_time, $tcms_config);
	$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	$tcms_main->setDatabaseInfo($choosenDB);
	
	$tcms_config->decodeConfiguration($tcms_main);
	
	
	/*
		language
	*/
	$language_stage = 'index';
	include_once('engine/language/lang_admin.php');
	//using('toendacms.language.admin');
	
	
	/*
		SEO URL's
	*/
	if($seoEnabled == 1) {
		using('toendacms.kernel.seo');
		
		$tcms_seo = new tcms_seo();
		
		if($seoFormat == 0) {
			$arrSEO = $tcms_seo->explodeUrlColonFormat();
		}
		else if($seoFormat == 1) {
			$arrSEO = $tcms_seo->explodeUrlSlashFormat();
		}
		else {
			$arrSEO = $tcms_seo->explodeHTMLFormat();
		}
		
		$tcms_seo->_tcms_seo();
		
		if(isset($id)) {
			$noSEOFolder = true;
		}
		
		if(!isset($id))             { $id              = trim($arrSEO['id']);            if($id              == '') { unset($id); } }
		if(!isset($s))              { $s               = trim($arrSEO['s']);             if($s               == '') { unset($s); } }
		if(!isset($news))           { $news            = trim($arrSEO['news']);          if($news            == '') { unset($news); } }
		if(!isset($feed))           { $feed            = trim($arrSEO['feed']);          if($feed            == '') { unset($feed); } }
		if(!isset($save))           { $save            = trim($arrSEO['save']);          if($save            == '') { unset($save); } }
		if(!isset($session))        { $session         = trim($arrSEO['session']);       if($session         == '') { unset($session); } }
		if(!isset($reg_login))      { $reg_login       = trim($arrSEO['reg_login']);     if($reg_login       == '') { unset($reg_login); } }
		if(!isset($todo))           { $todo            = trim($arrSEO['todo']);          if($todo            == '') { unset($todo); } }
		if(!isset($u))              { $u               = trim($arrSEO['u']);             if($u               == '') { unset($u); } }
		if(!isset($file))           { $file            = trim($arrSEO['file']);          if($file            == '') { unset($file); } }
		if(!isset($category))       { $category        = trim($arrSEO['category']);      if($category        == '') { unset($category); } }
		if(!isset($cat))            { $cat             = trim($arrSEO['cat']);           if($cat             == '') { unset($cat); } }
		if(!isset($article))        { $article         = trim($arrSEO['article']);       if($article         == '') { unset($article); } }
		if(!isset($action))         { $action          = trim($arrSEO['action']);        if($action          == '') { unset($action); } }
		if(!isset($albums))         { $albums          = trim($arrSEO['albums']);        if($albums          == '') { unset($albums); } }
		if(!isset($cmd))            { $cmd             = trim($arrSEO['command']);       if($cmd             == '') { unset($cmd); } }
		if(!isset($current_pollall)){ $current_pollall = trim($arrSEO['poll']);          if($current_pollall == '') { unset($current_pollall); } }
		if(!isset($ps))             { $ps              = trim($arrSEO['ps']);            if($ps              == '') { unset($ps); } }
		if(!isset($vote))           { $vote            = trim($arrSEO['vote']);          if($vote            == '') { unset($vote); } }
		if(!isset($XMLplace))       { $XMLplace        = trim($arrSEO['XMLplace']);      if($XMLplace        == '') { unset($XMLplace); } }
		if(!isset($XMLfile))        { $XMLfile         = trim($arrSEO['XMLfile']);       if($XMLfile         == '') { unset($XMLfile); } }
		if(!isset($page))           { $page            = trim($arrSEO['page']);          if($page            == '') { unset($page); } }
		if(!isset($item))           { $item            = trim($arrSEO['item']);          if($item            == '') { unset($item); } }
		if(!isset($contact_email))  { $contact_email   = trim($arrSEO['contact_email']); if($contact_email   == '') { unset($contact_email); } }
		if(!isset($date))           { $date            = trim($arrSEO['date']);          if($date            == '') { unset($date); } }
		if(!isset($code))           { $code            = trim($arrSEO['code']);          if($code            == '') { unset($code); } }
		if(!isset($c))              { $c               = trim($arrSEO['c']);             if($c               == '') { unset($c); } }
		if(!isset($lang))           { $lang            = trim($arrSEO['lang']);          if($lang            == '') { unset($lang); } }
		
		$seoOriginalFolder = $seoFolder;
		
		if($seoFolder != '') {
			$seoFolder = '/'.$seoFolder;
		}
		else {
			$seoFolder = '';
		}
	}
	else {
		$seoFolder = '';
		$seoOriginalFolder = '';
	}
	
	// imagepath
	if($seoEnabled == 1) {
		if($seoFolder != '') {
			if($noSEOFolder) {
				$imagePath = '';
			}
			else {
				$imagePath = $seoFolder.'/';
			}
		}
		else {
			$imagePath = '/';
		}
	}
	else {
		$imagePath = '';
	}
	
	// authentication
	$tcms_auth = new tcms_authentication($tcms_administer_site, $c_charset, $imagePath);
	
	// account provider
	$tcms_ap = new tcms_account_provider($tcms_administer_site, $c_charset);
	
	
	/*
		site offline
		test application
	*/
	if($site_offline == 1) {
		/*using('toendacms.kernel.seo');
		
		$tcms_seo = new tcms_seo();
		
		if($seoFormat == 0) {
			$arrSEO = $tcms_seo->explodeUrlColonFormat();
		}
		else if($seoFormat == 1) {
			$arrSEO = $tcms_seo->explodeUrlSlashFormat();
		}
		else {
			$arrSEO = $tcms_seo->explodeHTMLFormat();
		}
		
		$tcms_seo->_tcms_seo();*/
		
		if(!isset($session)) {
			$session = trim($arrSEO['session']);
			
			if($session == '') {
				unset($session);
			}
		}
		
		if(isset($session)) {
			$session = $tcms_main->cleanUrlString($session, true);
		}
		
		if(isset($session)) {
			$check_session = $tcms_auth->checkSessionExist($session);
			
			if($check_session) {
				$arr_ws = $tcms_ap->getUserInfo($session);
				
				$ws_name  = $arr_ws['name'];
				$ws_user  = $arr_ws['user'];
				$ws_id    = $arr_ws['id'];
				$is_admin = $arr_ws['group'];
				
				if($is_admin == 'Administrator'
				|| $is_admin == 'Developer'
				|| $is_admin == 'Writer'
				|| $is_admin == 'Editor') {
					$site_offline = 0;
					$isTestEnvironment = true;
					echo $tcms_html->messageIsTestEnvironment();
				}
			}
		}
		
		unset($tcms_seo);
	}
	
	// next
	$wsShowSite = true;
	
	$seoPath = $seoFolder;
	
	if($seoEnabled == '')
		$seoEnabled = 0;
	
	// check the folder if seo is enabled
	// !! needed to know if the cms is installed
	// !! at a root level or in a directory
	if($seoEnabled == 1) {
		if($seoFolder != '') {
			$toendaCMSimage = $seoFolder.'/';
		}
		else {
			$toendaCMSimage = '';
		}
	}
}
else {
	if($tcms_param->checkInstallDir($tcms_administer_site)) {
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<img src="engine/images/tcms_top.gif" border="0" />'
		.'<h1>toendaCMS Error 500: Internal Server Error!</h1>'
		.'<h2>This site is temporarily unavailable.<br />Please notify the System Administrator</h2>'
		.'</div>';
		
		$wsShowSite = false;
	}
	else {
		$site_offline = 0;
	}
}



/*
	GLOBAL VAR EXIST / NOT EXIST
*/
if($wsShowSite) {
	/*
		SITE ON / OFF
	*/
	if($site_offline == 1) {
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<img src="'.$toendaCMSimage.'engine/images/tcms_top.gif" border="0" />'
		.'<h2>'.$tcms_config->getSiteOfflineText().'</h2>'
		.'</div>';
	}
	else {
		// clean url strings (against cross-site scripting)
		if(isset($id))              $id              = $tcms_main->cleanUrlString($id, true);
		if(isset($s))               $s               = $tcms_main->cleanUrlString($s, true);
		if(isset($news))            $news            = $tcms_main->cleanUrlString($news, true);
		if(isset($feed))            $feed            = $tcms_main->cleanUrlString($feed, true);
		if(isset($save))            $save            = $tcms_main->cleanUrlString($save, true);
		if(isset($session))         $session         = $tcms_main->cleanUrlString($session, true);
		if(isset($reg_login))       $reg_login       = $tcms_main->cleanUrlString($reg_login, true);
		if(isset($todo))            $todo            = $tcms_main->cleanUrlString($todo, true);
		if(isset($u))               $u               = $tcms_main->cleanUrlString($u, true);
		if(isset($file))            $file            = $tcms_main->cleanUrlString($file, true);
		if(isset($category))        $category        = $tcms_main->cleanUrlString($category, true);
		if(isset($cat))             $cat             = $tcms_main->cleanUrlString($cat, true);
		if(isset($article))         $article         = $tcms_main->cleanUrlString($article, true);
		if(isset($action))          $action          = $tcms_main->cleanUrlString($action, true);
		if(isset($albums))          $albums          = $tcms_main->cleanUrlString($albums, true);
		if(isset($cmd))             $cmd             = $tcms_main->cleanUrlString($cmd, true);
		if(isset($current_pollall)) $current_pollall = $tcms_main->cleanUrlString($current_pollall, true);
		if(isset($ps))              $ps              = $tcms_main->cleanUrlString($ps, true);
		if(isset($vote))            $vote            = $tcms_main->cleanUrlString($vote, true);
		if(isset($XMLplace))        $XMLplace        = $tcms_main->cleanUrlString($XMLplace, true);
		if(isset($XMLfile))         $XMLfile         = $tcms_main->cleanUrlString($XMLfile, true);
		if(isset($page))            $page            = $tcms_main->cleanUrlString($page, true);
		if(isset($item))            $item            = $tcms_main->cleanUrlString($item, true);
		if(isset($contact_email))   $contact_email   = $tcms_main->cleanUrlString($contact_email, true);
		if(isset($date))            $date            = $tcms_main->cleanUrlString($date, true);
		if(isset($code))            $code            = $tcms_main->cleanUrlString($code, true);
		if(isset($c))               $c               = $tcms_main->cleanUrlString($c, true);
		if(isset($lang))            $lang            = $tcms_main->cleanUrlString($lang, true);
		
		if(!isset($id)) $id = 'frontpage';
		
		
		
		/*
			INCLUDE LIBS
		*/
		
		// global
		using('toendacms.kernel.main');
		using('toendacms.kernel.script');
		using('toendacms.kernel.gd');
		using('toendacms.kernel.sql');
		using('toendacms.kernel.modconfig');
		using('toendacms.kernel.error');
		//using('toendacms.kernel.file');
		using('toendacms.kernel.menu_provider');
		using('toendacms.kernel.modconfig');
		//using('toendacms.kernel.globals');
		include_once('engine/tcms_kernel/tcms_globals.lib.php');
		
		// stats
		if($statistics) {
			using('toendacms.kernel.statistics');
		}
		
		// cs
		if($use_components) {
			using('toendacms.kernel.components');
		}
		
		// id specific
		switch($id) {
			case 'frontpage':
			case 'newsmanager':
				using('toendacms.kernel.blogfeatures');
				using('toendacms.tools.feedcreator.feedcreator_class');
				break;
			
			case 'contactform':
			case 'register':
				using('toendacms.tools.phpmailer.class_phpmailer');
				break;
			
			case 'profile':
				// fckeditor
				if($wysiwygEditor == 'fckeditor') {
					using('toendacms.js.FCKeditor.fckeditor');
				}
				break;
			
			default:
				break;
		}
		
		
		
		/*
			START MAIN PAGE
		*/
		if(isset($choosenDB) && $choosenDB == 'xml') {
			if(!$tcms_param->checkWriteableSession($tcms_administer_site)) {
				echo $tcms_html->messageUnwritableSession();
			}
		}
		
		if(!$tcms_param->checkWriteableData($tcms_administer_site)) {
			echo $tcms_html->messageUnwritableData();
		}
		else {
			/*
				MAIN
			*/
			
			if(!$tcms_param->checkInstallDir($tcms_administer_site)) {
				echo $tcms_html->messageInstallerLink();
			}
			
			if(!$tcms_param->checkInstallExist() && $tcms_param->checkInstallDir($tcms_administer_site)) {
				/*
				include('setup/functions.php');
				
				if(getVersion() < $tcms_version->getVersion()
				&& getBuild() < $tcms_version->getBuild())
					echo $tcms_html->messageStartUpdate();
				else
					echo $tcms_html->messageIsInstalled();
				*/
				echo $tcms_html->messageIsInstalled();
			}
			
			if($tcms_param->checkInstallDir($tcms_administer_site) && $tcms_param->checkInstallExist()) {
				/*
					LOAD toendaCMS ENGINE
				*/
				if($seoFormat == 0) {
					$tcms_main->setURLSEO('colon');
				}
				else if($seoFormat == 1) {
					$tcms_main->setURLSEO('slash');
				}
				else if($seoFormat == 2) {
					$tcms_main->setURLSEO('');
				}
				
					
				// mail
				require($tcms_administer_site.'/tcms_global/mail.php');
				
				$mail_with_smtp   = $tcms_mail_with_smtp;
				$mail_as_html     = $tcms_mail_as_html;
				$mail_server_pop3 = $tcms_mail_server_pop3;
				$mail_server_smtp = $tcms_mail_server_smtp;
				$mail_port        = $tcms_mail_port;
				$mail_pop3        = $tcms_mail_pop3;
				$mail_user        = $tcms_mail_user;
				$mail_password    = $tcms_mail_password;
				
				// sql abstraction layer
				$tcms_dal = new sqlAbstractionLayer($choosenDB, $tcms_time);
				
				// safe_mode ?
				$param_save_mode = $tcms_main->getPHPSetting('safe_mode');
				if($param_save_mode)
					$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'off');
				
				/*
					Set Cookie
				*/
				if($code == 'setc') {
					//setcookie('session', $session);
				}
				elseif($code == 'delc') {
					//setcookie('session', '', time() - 81400);
				}
				
				
				
				/*
					Layout
				*/
				
				if(!isset($s) || $s == '') {
					$layout_xml = new xmlparser(''.$tcms_administer_site.'/tcms_global/layout.xml','r');
					$s = $layout_xml->readSection('layout', 'select');
				}
				
				if($seoEnabled == 1) {
					if($seoFolder != '') {
						if($noSEOFolder) {
							$templatePath = 'theme/'.$s.'/';
						}
						else {
							$templatePath = $seoFolder.'/theme/'.$s.'/';
						}
					}
					else {
						$templatePath = '/theme/'.$s.'/';
					}
				}
				else {
					$templatePath = 'theme/'.$s.'/';
				}
				
				
				
				/*
					Check db connection
				*/
				if($choosenDB != 'xml') {
					$sqlCN = $tcms_dal->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if(isset($sqlCN['num']) && $sqlCN['num'] == 0) {
						$start_tcms_loading = false;
						
						$tcms_error = new tcms_error('index.php', 500, $sqlCN['msg'], $imagePath);
						$tcms_error->showMessage($toendaCMSimage, false);
						
						unset($tcms_error);
					}
					else {
						$start_tcms_loading = true;
					}
				}
				else {
					$start_tcms_loading = true;
				}
				
				
				
				/*
					Start loading site
				*/
				if($start_tcms_loading) {
					/*
						IF ACTIVE
						START THE STATISTIC COUNTER
					*/
					if($statistics == 1) {
						$tcms_stats = new tcms_statistics($c_charset, $tcms_administer_site);
						
						$tcms_stats->countSiteURL($s);
						$tcms_stats->countBrowserInfo();
						
						$tcms_stats->_tcms_statistics();
						
						unset($tcms_stats);
					}
					
					
					
					/*
						Authentication settings
					*/
					
					if(isset($session)) {
						if($_GET['setXMLSession'] == 1) {
							if($tcms_file->checkFileExist('engine/admin/session/'.$session)) {
								$file = new tcms_file('engine/admin/session/'.$session, 'r');
								$ws_id = $file->read();
								
								$file->changeFile($tcms_administer_site.'/tcms_session/'.$session, 'w');
								$file->write($ws_id);
								$file->close();
								
								$file->deleteCustom('engine/admin/session/'.$session);
								
								unset($file);
							}
						}
						
						$tcms_auth->cleanupOutdatedSessions($session);
						$check_session = $tcms_auth->checkSessionExist($session);
						
						if($check_session) {
							$arr_ws = $tcms_ap->getUserInfo($session);
							
							$ws_name  = $arr_ws['name'];
							$ws_user  = $arr_ws['user'];
							$ws_id    = $arr_ws['id'];
							$is_admin = $arr_ws['group'];
							
							if(trim($is_admin) == 'Administrator'
							|| trim($is_admin) == 'Developer'
							|| trim($is_admin) == 'Writer'
							|| trim($is_admin) == 'Editor') {
								$canEdit = true;
							}
							else {
								$canEdit = false;
							}
						}
						else {
							$canEdit = false;
						}
					}
					else {
						$check_session = false;
						$canEdit = false;
						$is_admin = 'Guest';
					}
					
					
					
					/*
						some objects
					*/
					// configuration
					$tcms_modconfig = new tcms_modconfig($tcms_administer_site, $imagePath);
					
					// datacontainer
					$tcms_dcp = new tcms_datacontainer_provider($tcms_administer_site, $c_charset);
					
					// menu object provider
					$tcms_menu = new tcms_menu_provider($tcms_administer_site, $c_charset, $is_admin);
					
					// components system
					if($tcms_config->getComponentsSystemEnabled()) {
						$tcms_cs = new tcms_cs($tcms_administer_site, $imagePath);
					}
					
					// blogfeatures
					if($id == 'frontpage' || $id == 'newsmanager') {
						$tcms_blogfeatures = new tcms_blogfeatures();
					}
					
					// graphic engine
					$tcms_gd = new tcms_gd();
					
					
					
					/*
						Web Site config from XML
					*/
					
					if(!$tcms_main->isReal($lang)) {
						$lang = strtolower($tcms_config->getLanguageCode());
					}
					
					$sitetitle = $tcms_config->getSiteTitle();
					$sitename  = $tcms_config->getSiteName();
					$sitekey   = $tcms_config->getSiteKey();
					$logo      = $tcms_config->getSiteLogo();
					
					$logo = $tcms_main->decodeText($logo, '2', $c_charset);
					$logo = trim($logo);
					
					if($logo != '' || !empty($logo)) {
						$sitelogo = '<img class="sitelogo" align="left"'
						.' src="'.$imagePath.''.$tcms_administer_site.'/images/Image/'.$logo.'"'
						.' border="0" />';
					}
					else {
						$sitelogo = '';
					}
					
					// CHARSETS
					$cms_name         = $tcms_version->getName();
					$cms_tagline      = $tcms_version->getTagline();
					$cms_version      = $tcms_version->getVersion();
					$cms_build        = $tcms_version->getBuild();
					$toenda_copyright = $tcms_version->getToendaCopyright();
					
					$show_doc_autor = $tcms_config->getShowDocAutor();
					$defaultCat     = $tcms_config->getDefaultCategory();
					$tcmsinst       = $tcms_config->getToendaCMSInSitetitle();
					
					if($tcmsinst == 1) {
						$sitetitle  = $cms_name.' | '.$sitetitle;
					}
					
					// Pathway Char
					if(!$tcms_main->isReal($pathwayChar)) {
						$pathwayChar = '/';
					}
					
					
					
					$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
					$tcms_main->setCurrentLang($getLang);
					
					// Sidebar modules
					using('toendacms.datacontainer.sidebarmodule');
					
					$dcSidebarModule = new tcms_dc_sidebarmodule();
					$dcSidebarModule = $tcms_dcp->getSidebarModuleDC();
					
					$use_side_gallery   = $dcSidebarModule->getSideGallery();
					$use_side_category  = $dcSidebarModule->getSideCategory();
					$use_side_archives  = $dcSidebarModule->getSideArchive();
					$use_side_links     = $dcSidebarModule->getSideLinks();
					$use_layout_chooser = $dcSidebarModule->getLayoutChooser();
					$use_login          = $dcSidebarModule->getLogin();
					$use_syndication    = $dcSidebarModule->getSyndication();
					$use_newsletter     = $dcSidebarModule->getNewsletter();
					$use_search         = $dcSidebarModule->getSearch();
					$use_sidebar        = $dcSidebarModule->getSidebar();
					$use_poll           = $dcSidebarModule->getPoll();
					
					unset($dcSidebarModule);
					
					
					
					// Syndication
					if($use_syndication == 1) {
						using('toendacms.datacontainer.newsmanager');
						
						$dcNewsMan = new tcms_dc_newsmanager();
						$dcNewsMan = $tcms_dcp->getNewsmanagerDC($getLang);
						
						$use_rss091     = $dcNewsMan->getSyndicationRSS091();
						$use_rss10      = $dcNewsMan->getSyndicationRSS10();
						$use_rss20      = $dcNewsMan->getSyndicationRSS20();
						$use_atom03     = $dcNewsMan->getSyndicationRSSAtom();
						$use_opml       = $dcNewsMan->getSyndicationRSSOpml();
						$syn_amount     = $dcNewsMan->getSyndicationAmount();
						$use_syn_title  = $dcNewsMan->getSyndicationUseTitle();
						$def_feed       = $dcNewsMan->getSyndicationDefaultFeed();
						$use_rss091_img = $dcNewsMan->getSyndicationUseRSS091Image();
						$rss091_text    = $dcNewsMan->getSyndicationRSS091Text();
						$use_rss10_img  = $dcNewsMan->getSyndicationUseRSS10Image();
						$rss10_text     = $dcNewsMan->getSyndicationRSS10Text();
						$use_rss20_img  = $dcNewsMan->getSyndicationUseRSS20Image();
						$rss20_text     = $dcNewsMan->getSyndicationRSS20Text();
						$use_atom03_img = $dcNewsMan->getSyndicationUseATOM03Image();
						$atom03_text    = $dcNewsMan->getSyndicationATOM03Text();
						$use_opml_img   = $dcNewsMan->getSyndicationUseOPMLImage();
						$opml_text      = $dcNewsMan->getSyndicationOPMLText();
						$use_cfeed      = $dcNewsMan->getSyndicationUseCommentFeed();
						$use_cfeed_img  = $dcNewsMan->getSyndicationUseCommentFeedImage();
						$cfeed_text     = $dcNewsMan->getSyndicationCommentFeedText();
						$cfeed_type     = $dcNewsMan->getSyndicationCommentFeedType();
						$show_autor     = $dcNewsMan->getShowAutor();
						$cfeed_amount   = $dcNewsMan->getSyndicationCommentFeedAmount();
					}
					
					
					
					/*
						load module configuration
					*/
					
					switch($id) {
						case 'frontpage':
							using('toendacms.datacontainer.frontpage');
							using('toendacms.datacontainer.newsmanager');
							
							$dcFront = new tcms_dc_frontpage();
							$dcFront = $tcms_dcp->getFrontpageDC($getLang);
							
							$front_id         = $dcFront->getID();
							$front_title      = $dcFront->getTitle();
							$front_stamp      = $dcFront->getSubtitle();
							$front_text       = $dcFront->getText();
							$front_news_title = $dcFront->getNewsTitle();
							$cut_news         = $dcFront->getNewsChars();
							$how_many         = $dcFront->getNewsAmount();
							$sb_news_enabled  = $dcFront->getSidebarNewsEnabled();
							$sb_news_display  = $dcFront->getSidebarNewsDisplay();
							$front_s_title    = $dcFront->getSidebarNewsTitle();
							$sb_cut_news      = $dcFront->getSidebarNewsChars();
							$sb_how_many      = $dcFront->getSidebarNewsAmount();
							
							$dcNewsMan = new tcms_dc_newsmanager();
							$dcNewsMan = $tcms_dcp->getNewsmanagerDC($getLang);
							
							$use_news_comments  = $dcNewsMan->getUseComments();
							$show_autor         = $dcNewsMan->getShowAutor();
							$show_autor_as_link = $dcNewsMan->getShowAutorAsLink();
							$use_gravatar       = $dcNewsMan->getUseGravatar();
							$use_emoticons      = $dcNewsMan->getUseEmoticons();
							$use_trackback      = $dcNewsMan->getUseTrackback();
							$use_timesince      = $dcNewsMan->getUseTimesince();
							$readmore_link      = $dcNewsMan->getReadmoreLink();
							$news_spacing       = $dcNewsMan->getNewsSpacing();
							
							$cut_news = ( $cut_news == 0 ? '1000000' : $cut_news );
							
							if($use_trackback == 1) {
								using('toendacms.kernel.trackback');
							}
							break;
						
						case 'impressum':
							using('toendacms.datacontainer.impressum');
							
							$dcImpressum = new tcms_dc_impressum();
							$dcImpressum = $tcms_dcp->getImpressumDC($getLang);
							
							$imp_id      = $dcImpressum->getID();
							$imp_title   = $dcImpressum->getTitle();
							$imp_stamp   = $dcImpressum->getSubtitle();
							$legal       = $dcImpressum->getText();
							$imp_contact = $dcImpressum->getContact();
							$taxno       = $dcImpressum->getTaxNumber();
							$ustid       = $dcImpressum->getUstID();
							
							unset($dcImpressum);
							
							$link_imp = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$imp_id.'&amp;s='.$s.'&amp;lang='.$lang;
							break;
						
						case 'newsmanager':
							using('toendacms.datacontainer.newsmanager');
							
							$dcNewsMan = new tcms_dc_newsmanager();
							$dcNewsMan = $tcms_dcp->getNewsmanagerDC($getLang);
							
							$news_id            = $dcNewsMan->getID();
							$news_title         = $dcNewsMan->getTitle();
							$news_stamp         = $dcNewsMan->getSubtitle();
							$news_maintext      = $dcNewsMan->getText();
							$news_image         = $dcNewsMan->getImage();
							$use_news_comments  = $dcNewsMan->getUseComments();
							$show_autor         = $dcNewsMan->getShowAutor();
							$show_autor_as_link = $dcNewsMan->getShowAutorAsLink();
							$news_amount        = $dcNewsMan->getNewsAmount();
							$cut_news           = $dcNewsMan->getNewsChars();
							$authorized         = $dcNewsMan->getAccess();
							$use_gravatar       = $dcNewsMan->getUseGravatar();
							$use_emoticons      = $dcNewsMan->getUseEmoticons();
							$use_trackback      = $dcNewsMan->getUseTrackback();
							$use_timesince      = $dcNewsMan->getUseTimesince();
							$readmore_link      = $dcNewsMan->getReadmoreLink();
							$news_spacing       = $dcNewsMan->getNewsSpacing();
							
							$cut_news = ( $cut_news == 0 ? '1000000' : $cut_news );
							
							$link_news  = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$news_id.'&amp;s='.$s.'&amp;lang='.$lang;
							
							if($use_trackback == 1) {
								using('toendacms.kernel.trackback');
							}
							break;
						
						case 'download':
							$arrDW = $tcms_modconfig->getDownloadConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$download_id    = $arrDW['download_id'];
							$download_title = $arrDW['download_title'];
							$download_stamp = $arrDW['download_stamp'];
							$download_text  = $arrDW['download_text'];
							break;
						
						case 'contactform':
							using('toendacms.datacontainer.contactform');
							
							$dcCF = new tcms_dc_contactform();
							$dcCF = $tcms_dcp->getContactformDC($getLang);
							
							if(!isset($contact_email)) {
								$contact_email = $dcCF->getContact();
							}
							else {
								$contact_email = $tcms_main->decodeBase64($contact_email);
							}
							
							$send_id           = $dcCF->getID();
							$contact_title     = $dcCF->getTitle();
							$contact_stamp     = $dcCF->getSubtitle();
							$contact_text      = $dcCF->getText();
							$show_cisb         = $dcCF->getShowContactsInSidebar();
							$authorized        = $dcCF->getAccess();
							$cform_enabled     = $dcCF->getEnabled();
							$use_adressbook    = $dcCF->getUseAdressbook();
							$use_contactad     = $dcCF->getUseContact();
							$show_contactemail = $dcCF->getShowContactemail();
							
							$link_contact = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$send_id.'&amp;s='.$s.'&amp;lang='.$lang;
							break;
						
						case 'guestbook':
							$arrGB = $tcms_modconfig->getGuestbookConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$book_id      = $arrGB['guest_id'];
							$book_title   = $arrGB['booktitle'];
							$book_stamp   = $arrGB['bookstamp'];
							$authorized   = $arrGB['access'];
							$book_enabled = $arrGB['enabled'];
							
							$link_guest = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$book_id.'&amp;s='.$s.'&amp;lang='.$lang;
							break;
						
						case 'products':
							using('toendacms.datacontainer.products');
							
							$dcP = new tcms_dc_products();
							$dcP = $tcms_dcp->getProductsDC($getLang);
							
							$products_id            = $dcP->getID();
							$products_title         = $dcP->getTitle();
							$products_stamp         = $dcP->getSubtitle();
							$products_text          = $dcP->getText();
							$main_category          = $dcP->getProductMainCategory();
							$category_title         = $dcP->getSidebarCategoryTitle();
							$show_pro_ct            = $dcP->getUseSideCategory();
							$show_price_only_users  = $dcP->getShowPriceOnlyUsers();
							$startpage_title        = $dcP->getStartpageTitle();
							$use_sidebar_categories = $dcP->getUseSideCategory();
							$max_latest_products    = $dcP->getMaxLatestProducts();
							break;
						
						case 'imagegallery':using('toendacms.datacontainer.imagegallery');
							
							$dcIG = new tcms_dc_imagegallery();
							$dcIG = $tcms_dcp->getImagegalleryDC();
							
							$image_id           = $dcIG->getID();
							$image_title        = $dcIG->getTitle();
							$image_stamp        = $dcIG->getSubtitle();
							$image_details      = $dcIG->getUseImageDetails();
							$gallery_image_sort = $dcIG->getImageSort();
							$use_image_comments = $dcIG->getUseComments();
							$authorized         = $dcIG->getAccess();
							$list_option        = $dcIG->getListOption();
							$maxImg             = $dcIG->getMaxImages();
							$needleImg          = $dcIG->getNeedleImage();
							$showTitleImg       = $dcIG->getShowLastImageTitle();
							$alignImg           = $dcIG->getImageAlignment();
							$sizeImg            = $dcIG->getImageSize();
							
							$link_image  = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.$image_id.'&amp;s='.$s.'&amp;lang='.$lang;
							break;
						
						case 'links':
							$arrL = $tcms_modconfig->getLinkConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$link_title    = $arrL['link_title'];
							$link_subtitle = $arrL['link_subtitle'];
							$link_text     = $arrL['link_text'];
							$link_use_desc = $arrL['link_use_desc'];
							$authorized    = $arrL['access'];
							break;
						
						case 'knowledgebase':
							$arrFAQConfig = $tcms_modconfig->getFAQConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$faq_id        = $arrFAQConfig['faq_uid'];
							$faq_title     = $arrFAQConfig['faq_title'];
							$faq_subtitle  = $arrFAQConfig['faq_subtitle'];
							$faq_text      = $arrFAQConfig['faq_text'];
							$faq_enabled   = $arrFAQConfig['faq_enabled'];
							$faq_autorlink = $arrFAQConfig['faq_a_enabled'];
							$authorized    = $arrFAQConfig['access'];
							break;
					}
					
					
					
					/*
						Global Configuration from XML
					*/
					$keywords         = $tcms_config->getMetadataKeywords();
					$description      = $tcms_config->getMetadataDescription();
					$active_topmenu   = $tcms_config->getTopmenuActive();
					
					// CHARSETS
					$keywords         = $tcms_main->decodeText($keywords, '2', $c_charset);
					$description      = $tcms_main->decodeText($description, '2', $c_charset);
					$websiteowner     = $tcms_main->decodeText($tcms_config->getWebpageOwner(), '2', $c_charset);
					$websitecopyright = $tcms_main->decodeText($tcms_config->getWebpageCopyright(), '2', $c_charset);
					$websiteowner_url = $tcms_main->decodeText($tcms_config->getWebpageOwnerUrl(), '2', $c_charset);
					$footer_text      = $tcms_main->decodeText($tcms_config->getFooterText(), '2', $c_charset);
					
					
					
					/*
						Top or Side Menu
					*/
					$navigation        = $tcms_config->getSidemenuEnabled();
					$second_navigation = $tcms_config->getTopmenuEnabled();
					
					if($choosenDB == 'xml') {
						$xml    = new xmlparser(''.$tcms_administer_site.'/tcms_global/sidebar.xml','r');
						$user_navigation = $xml->readSection('side', 'usermenu');
						
						if($use_login == 1) {
							$login_title  = $xml->readSection('side', 'login_title');
							$no_login     = $xml->readSection('side', 'nologin');
							$reg_link     = $xml->readSection('side', 'reg_link');
							$reg_username = $xml->readSection('side', 'reg_user');
							$reg_password = $xml->readSection('side', 'reg_pass');
							$login_user   = $xml->readSection('side', 'login_user');
							$show_lt      = $xml->readSection('side', 'show_login_title');
							$show_ml      = $xml->readSection('side', 'show_memberlist');
							
							$login_title  = $tcms_main->decodeText($login_title, '2', $c_charset);
							$no_login     = $tcms_main->decodeText($no_login, '2', $c_charset);
							$reg_link     = $tcms_main->decodeText($reg_link, '2', $c_charset);
							$reg_username = $tcms_main->decodeText($reg_username, '2', $c_charset);
							$reg_password = $tcms_main->decodeText($reg_password, '2', $c_charset);
						}
						
						$xml->flush();
						$xml->_xmlparser();
					}
					else {
						$sqlCN = $tcms_dal->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $tcms_dal->getOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
						$sqlARR = $tcms_dal->fetchArray($sqlQR);
						
						$user_navigation = $sqlARR['usermenu'];
						
						if($use_login == 1) {
							$login_title  = $sqlARR['login_title'];
							$no_login     = $sqlARR['nologin'];
							$reg_link     = $sqlARR['reg_link'];
							$reg_username = $sqlARR['reg_user'];
							$reg_password = $sqlARR['reg_pass'];
							$login_user   = $sqlARR['login_user'];
							$show_lt      = $sqlARR['show_login_title'];
							$show_ml      = $sqlARR['show_memberlist'];
							
							$login_title  = $tcms_main->decodeText($login_title, '2', $c_charset);
							$no_login     = $tcms_main->decodeText($no_login, '2', $c_charset);
							$reg_link     = $tcms_main->decodeText($reg_link, '2', $c_charset);
							$reg_username = $tcms_main->decodeText($reg_username, '2', $c_charset);
							$reg_password = $tcms_main->decodeText($reg_password, '2', $c_charset);
							$login_user   = $tcms_main->decodeText($login_user, '2', $c_charset);
						}
					}
					
					
					
					/*
						SITE MANAGEMENT :: WITH ERRORFILES
					*/
					if($choosenDB == 'xml') {
						//$site_max_id  = $tcms_main->load_xml_files(''.$tcms_administer_site.'/tcms_content/', 'files');
						//$site_max_id2 = $tcms_main->load_xml_files(''.$tcms_administer_site.'/tcms_content_languages/', 'files');
						
						$site_max_id = $tcms_main->getPathContent(
							$tcms_administer_site.'/tcms_content/', 
							false, 
							'.xml'
						);
						
						$site_max_id2 = $tcms_main->getPathContent(
							$tcms_administer_site.'/tcms_content_languages/', 
							false, 
							'.xml'
						);
						
						if($tcms_main->isArray($site_max_id2)) {
							$site_max_id = array_merge($site_max_id, $site_max_id2);
						}
						
						if(is_array($site_max_id)) {
							if(!in_array($id.'.xml', $site_max_id)) {
								$ws_error = true;
							}
						}
					}
					else {
						$sqlCN = $tcms_dal->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $tcms_dal->getOne($tcms_db_prefix.'content', $id);
						$site_max_id = $tcms_dal->getNumber($sqlQR);
						
						if($site_max_id == 0) {
							$ws_error = true;
						}
					}
					
					if(in_array($id, $arrTCMSModules)) {
						$ws_error = false;
					}
					
					if($ws_error == false) {
						if(!isset($download_id)) { $download_id = 'download'; }
						if(!isset($products_id)) { $products_id = 'products'; }
						if(!isset($send_id)) { $send_id = 'contactform'; }
						if(!isset($book_id)) { $book_id = 'guestbook'; }
						if(!isset($image_id)) { $image_id = 'imagegallery'; }
						if(!isset($link_id)) { $link_id = 'links'; }
						if(!isset($news_id)) { $news_id = 'newsmanager'; }
						if(!isset($imp_id)) { $imp_id = 'impressum'; }
						if(!isset($faq_id)) { $faq_id = 'knowledgebase'; }
						
						
						/*
							Main Menu
							Top Menu
							Linkway
							
							-> load only if not in cache
						*/
						//if(!file_exists('cache/'.)) {
						if($choosenDB == 'xml') {
							$arr_files     = $tcms_main->getPathContent(''.$tcms_administer_site.'/tcms_menu/');
							$arr_filesT    = $tcms_main->getPathContent(''.$tcms_administer_site.'/tcms_topmenu/');
							$arr_side_navi = $tcms_main->mainmenu($arr_files, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
							
							$arr_filename = $tcms_main->getPathContent(''.$tcms_administer_site.'/tcms_topmenu/');
							$arr_top_navi = $tcms_main->topmenu($arr_filename, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
							
							$arrLinkway = $tcms_main->linkway($arr_files, $arr_filesT, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
						}
						else {
							//$arr_side_navi = $tcms_main->mainmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
							
							$arr_top_navi = $tcms_main->topmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
							
							$arrLinkway = $tcms_main->linkwaySQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s, ( isset($lang) ? $lang : NULL ));
						}
						
						
						$arr_path = $arrLinkway['path'];
						$titleway = $arrLinkway['title'];
						$pathway  = $arrLinkway['pathway'];
						
						
						/*
							Load Components System
						*/
						if($use_components) {
							$arrSideCS = $tcms_cs->getAllSideCS($is_admin);
						}
						
						
						/*
							Inluce Defines
						*/
						include_once('engine/tcms_kernel/tcms_defines.lib.php');
						//using('toendacms.kernel.defines');
						
						
						/*
							Inluce the layout
						*/
						if(_LAYOUT != '') {
							include_once(_LAYOUT);
						}
						
						
						/*
							Clean up
						*/
						unset($tcms_config);
						unset($tcms_version);
						unset($tcms_param);
						unset($tcms_dal);
						unset($tcms_gd);
						unset($tcms_main);
						unset($tcms_dcp);
						unset($tcms_menu);
						
						if($use_components) {
							unset($tcms_cs);
						}
						
						if($statistics) {
							unset($tcms_stats);
						}
					}
					else {
						include_once('engine/tcms_kernel/tcms_defines.lib.php');
						//using('toendacms.kernel.defines');
						include(_ERROR_404);
					}
				}
			}
		}
	}
}

?>
