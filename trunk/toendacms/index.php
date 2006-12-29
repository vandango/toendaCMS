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
| File:		index.php
| Version:	2.2.7
|
+
*/


//echo md5('banane').'<br />';
//for($i = 0; $i<5; $i++) echo md5(microtime()).'<br />';


/*
	MAIN VARIABLES
*/
if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['s'])){ $s = $_GET['s']; }
if(isset($_GET['u'])){ $u = $_GET['u']; }
if(isset($_GET['session'])){ $session = $_GET['session']; }
if(isset($_GET['item'])){ $item = $_GET['item']; }
if(isset($_GET['feed'])){ $feed = $_GET['feed']; }
if(isset($_GET['page'])){ $page = $_GET['page']; }
if(isset($_GET['contact_email'])){ $contact_email = $_GET['contact_email']; }

if(isset($_POST['id'])){ $id = $_POST['id']; }
if(isset($_POST['s'])){ $s = $_POST['s']; }
if(isset($_POST['u'])){ $u = $_POST['u']; }
if(isset($_POST['session'])){ $session = $_POST['session']; }
if(isset($_POST['item'])){ $item = $_POST['item']; }
if(isset($_POST['feed'])){ $feed = $_POST['feed']; }
if(isset($_POST['page'])){ $page = $_POST['page']; }
if(isset($_POST['contact_email'])){ $contact_email = $_POST['contact_email']; }


/**
 * Startpage and Main file for toendaCMS
 *
 * This is the global startfile and the page loading
 * control.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


/*
	INIT GLOBAL
*/

define('_TCMS_VALID', 1);

include_once('engine/tcms_kernel/tcms_loader.lib.php');

include_once('site.php');
$tcms_administer_site = $tcms_site[0]['path'];

// database
require($tcms_administer_site.'/tcms_global/database.php');
import($tcms_administer_site.'.database.settings');

$choosenDB = $tcms_db_engine;
$sqlUser   = $tcms_db_user;
$sqlPass   = $tcms_db_password;
$sqlHost   = $tcms_db_host;
$sqlDB     = $tcms_db_database;
$sqlPort   = $tcms_db_port;
$sqlPrefix = $tcms_db_prefix;

// page
if(!isset($ws_error))
	$ws_error = false;

$wsShowSite = true;
$noSEOFolder = false;
$isTestEnvironment = false;

using('toendacms.kernel.time');

tcms_time::tcms_load_start();
if(isset($choosenDB) && $choosenDB != 'xml')
	tcms_time::tcms_query_count_start();

include_once('engine/tcms_kernel/tcms_xml.lib.php');
include_once('engine/tcms_kernel/tcms_parameter.lib.php');
include_once('engine/tcms_kernel/tcms_globals.lib.php');
include_once('engine/tcms_kernel/tcms_configuration.lib.php');
include_once('engine/tcms_kernel/tcms_version.lib.php');
include_once('engine/tcms_kernel/tcms_html.lib.php');

// params
$tcms_param = new tcms_parameter();

// html class
$tcms_html = new tcms_html();

// load config
if(file_exists($tcms_administer_site.'/tcms_global/var.xml')){
	$tcms_version = new tcms_version();
	$tcms_config  = new tcms_configuration($tcms_administer_site);
	
	$c_charset      = $tcms_config->getCharset();
	$seoFolder      = $tcms_config->getSEOPath();
	$seoEnabled     = $tcms_config->getSEOEnabled();
	$seoFormat      = $tcms_config->getSEOFormat();
	$cipher_email   = $tcms_config->getEmailCiphering();
	$detect_browser = $tcms_config->getBrowserDetection();
	$statistics     = $tcms_config->getStatistics();
	$use_components = $tcms_config->getComponentsSystemEnabled();
	$use_captcha    = $tcms_config->getCaptchaEnabled();
	$captcha_clean  = $tcms_config->getCaptchaCleanSize();
	$antiFrame      = $tcms_config->getAntiFrameEnabled();
	$show_pages     = $tcms_config->getShowTopPages();
	$site_off_text  = $tcms_config->getSiteOfflineText();
	$currency       = $tcms_config->getCurrency();
	$wysiwygEditor  = $tcms_config->getWYSIWYGEditor();
	$pathwayChar    = $tcms_config->getPathwayChar();
	$site_offline   = $tcms_config->getSiteOffline();
	
	// language
	$language_stage = 'index';
	include_once('engine/language/lang_admin.php');
	
	// site offline / test application
	if($site_offline == 1) {
		using('toendacms.kernel.seo');
		using('toendacms.kernel.main');
		using('toendacms.kernel.sql');
		
		$tcms_seo = new tcms_seo();
		
		if($seoFormat == 0)
			$arrSEO = $tcms_seo->explodeUrlColonFormat();
		else
			$arrSEO = $tcms_seo->explodeUrlSlashFormat();
		
		$tcms_seo->_tcms_seo();
		
		if(!isset($session)) {
			$session = trim($arrSEO['session']);
			
			if($session == '') {
				unset($session);
			}
		}
		
		$tcms_main = new tcms_main($tcms_administer_site);
		$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
		$tcms_main->setDatabaseInfo($choosenDB);
		
		if(isset($session))
			$session = $tcms_main->cleanUrlString($session, true);
		
		if(isset($session)){
			if($choosenDB == 'xml'){
				if(isset($session) 
				&& $session != '' 
				&& file_exists(''.$tcms_administer_site.'/tcms_session/'.$session) 
				&& filesize(''.$tcms_administer_site.'/tcms_session/'.$session) != 0) {
					$check_session = true;
				}
				else {
					$check_session = false;
				}
			}
			else {
				$check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session);
			}
			
			if($check_session){
				$arr_ws = $tcms_main->getUserInfo($session);
				
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
		
		unset($tcms_main);
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
	if($seoEnabled == 1){
		if($seoFolder != '')
			$toendaCMSimage = '/'.$seoFolder.'/';
		else
			$toendaCMSimage = '';
	}
}
else{
	if($tcms_param->checkInstallDir($tcms_administer_site)){
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<img src="engine/images/tcms_top.gif" border="0" />'
		.'<h1>toendaCMS Error 500: Internal Server Error!</h1>'
		.'<h2>This site is temporarily unavailable.<br />Please notify the System Administrator</h2>'
		.'</div>';
		
		$wsShowSite = false;
	}
	else{
		$site_offline = 0;
	}
}



/*
	GLOBAL VAR EXIST / NOT EXIST
*/
if($wsShowSite){
	/*
		SITE ON / OFF
	*/
	if($site_offline == 1){
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<img src="'.$toendaCMSimage.'engine/images/tcms_top.gif" border="0" />'
		.'<h2>'.$site_off_text.'</h2>'
		.'</div>';
	}
	else{
		/*
			SEO URL's
		*/
		if($seoEnabled == 1){
			using('toendacms.kernel.seo');
			
			$tcms_seo = new tcms_seo();
			
			if($seoFormat == 0)
				$arrSEO = $tcms_seo->explodeUrlColonFormat();
			else
				$arrSEO = $tcms_seo->explodeUrlSlashFormat();
			
			$tcms_seo->_tcms_seo();
			
			if(isset($id))
				$noSEOFolder = true;
			
			if(!isset($id))             { $id              = trim($arrSEO['id']);            if($id              == ''){ unset($id); } }
			if(!isset($s))              { $s               = trim($arrSEO['s']);             if($s               == ''){ unset($s); } }
			if(!isset($news))           { $news            = trim($arrSEO['news']);          if($news            == ''){ unset($news); } }
			if(!isset($feed))           { $feed            = trim($arrSEO['feed']);          if($feed            == ''){ unset($feed); } }
			if(!isset($save))           { $save            = trim($arrSEO['save']);          if($save            == ''){ unset($save); } }
			if(!isset($session))        { $session         = trim($arrSEO['session']);       if($session         == ''){ unset($session); } }
			if(!isset($reg_login))      { $reg_login       = trim($arrSEO['reg_login']);     if($reg_login       == ''){ unset($reg_login); } }
			if(!isset($todo))           { $todo            = trim($arrSEO['todo']);          if($todo            == ''){ unset($todo); } }
			if(!isset($u))              { $u               = trim($arrSEO['u']);             if($u               == ''){ unset($u); } }
			if(!isset($file))           { $file            = trim($arrSEO['file']);          if($file            == ''){ unset($file); } }
			if(!isset($category))       { $category        = trim($arrSEO['category']);      if($category        == ''){ unset($category); } }
			if(!isset($cat))            { $cat             = trim($arrSEO['cat']);           if($cat             == ''){ unset($cat); } }
			if(!isset($article))        { $article         = trim($arrSEO['article']);       if($article         == ''){ unset($article); } }
			if(!isset($action))         { $action          = trim($arrSEO['action']);        if($action          == ''){ unset($action); } }
			if(!isset($albums))         { $albums          = trim($arrSEO['albums']);        if($albums          == ''){ unset($albums); } }
			if(!isset($cmd))            { $cmd             = trim($arrSEO['command']);       if($cmd             == ''){ unset($cmd); } }
			if(!isset($current_pollall)){ $current_pollall = trim($arrSEO['poll']);          if($current_pollall == ''){ unset($current_pollall); } }
			if(!isset($ps))             { $ps              = trim($arrSEO['ps']);            if($ps              == ''){ unset($ps); } }
			if(!isset($vote))           { $vote            = trim($arrSEO['vote']);          if($vote            == ''){ unset($vote); } }
			if(!isset($XMLplace))       { $XMLplace        = trim($arrSEO['XMLplace']);      if($XMLplace        == ''){ unset($XMLplace); } }
			if(!isset($XMLfile))        { $XMLfile         = trim($arrSEO['XMLfile']);       if($XMLfile         == ''){ unset($XMLfile); } }
			if(!isset($page))           { $page            = trim($arrSEO['page']);          if($page            == ''){ unset($page); } }
			if(!isset($item))           { $item            = trim($arrSEO['item']);          if($item            == ''){ unset($item); } }
			if(!isset($contact_email))  { $contact_email   = trim($arrSEO['contact_email']); if($contact_email   == ''){ unset($contact_email); } }
			if(!isset($date))           { $date            = trim($arrSEO['date']);          if($date            == ''){ unset($date); } }
			if(!isset($code))           { $code            = trim($arrSEO['code']);          if($code            == ''){ unset($code); } }
			if(!isset($c))              { $c               = trim($arrSEO['c']);             if($c               == ''){ unset($c); } }
			
			if($seoFolder != '')
				$seoFolder = '/'.$seoFolder;
			else
				$seoFolder = '';
		}
		else{
			$seoFolder = '';
		}
		
		
		
		/*
			INCLUDE LIBS
		*/
		using('toendacms.kernel.main');
		using('toendacms.kernel.script');
		using('toendacms.kernel.gd');
		using('toendacms.kernel.components');
		using('toendacms.kernel.sql');
		include_once('engine/tcms_kernel/tcms_modconfig.lib.php');
		include_once('engine/tcms_kernel/tcms_error.lib.php');
		include_once('engine/tcms_kernel/tcms_file.lib.php');
		include_once('engine/tcms_kernel/tcms_statistics.lib.php');
		include_once('engine/tcms_kernel/tcms_blogfeatures.php');
		include_once('engine/tcms_kernel/tcms_datacontainer_provider.lib.php');
		include_once('engine/tcms_kernel/tcms_menu_provider.lib.php');
		include_once('engine/tcms_kernel/tcms_account_provider.lib.php');
		include_once('engine/tcms_kernel/tcms_authentication.lib.php');
		
		include_once('engine/tcms_kernel/feedcreator/feedcreator.class.php');
		include_once('engine/tcms_kernel/phpmailer/class.phpmailer.php');
		
		if($wysiwygEditor == 'fckeditor')
			include_once('engine/js/FCKeditor/fckeditor.php');
		
		
		
		/*
			START MAIN PAGE
		*/
		if(isset($choosenDB) && $choosenDB == 'xml'){
			if(!$tcms_param->checkWriteableSession($tcms_administer_site))
				echo $tcms_html->messageUnwritableSession();
		}
		
		if(!$tcms_param->checkWriteableData($tcms_administer_site))
			echo $tcms_html->messageUnwritableData();
		else{
			/*
				MAIN
			*/
			
			if(!$tcms_param->checkInstallDir($tcms_administer_site))
				echo $tcms_html->messageInstallerLink();
			
			if(!$tcms_param->checkInstallExist() && $tcms_param->checkInstallDir($tcms_administer_site)){
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
			
			if($tcms_param->checkInstallDir($tcms_administer_site) && $tcms_param->checkInstallExist()){
				/*
					LOAD toendaCMS ENGINE
				*/
				
				
				// main
				$tcms_main = new tcms_main($tcms_administer_site);
				$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
				$tcms_main->setDatabaseInfo($choosenDB);
				
				if($seoFormat == 0)
					$tcms_main->setURLSEO('colon');
				else
					$tcms_main->setURLSEO('slash');
				
				
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
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				
				// safe_mode ?
				$param_save_mode = $tcms_main->getPHPSetting('safe_mode');
				if($param_save_mode)
					$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'off');
				
				if(isset($id))             { $id              = $tcms_main->cleanUrlString($id); }
				if(isset($s))              { $s               = $tcms_main->cleanUrlString($s); }
				if(isset($news))           { $news            = $tcms_main->cleanUrlString($news); }
				if(isset($feed))           { $feed            = $tcms_main->cleanUrlString($feed); }
				if(isset($save))           { $save            = $tcms_main->cleanUrlString($save); }
				if(isset($session))        { $session         = $tcms_main->cleanUrlString($session); }
				if(isset($reg_login))      { $reg_login       = $tcms_main->cleanUrlString($reg_login); }
				if(isset($todo))           { $todo            = $tcms_main->cleanUrlString($todo); }
				if(isset($u))              { $u               = $tcms_main->cleanUrlString($u); }
				if(isset($file))           { $file            = $tcms_main->cleanUrlString($file); }
				if(isset($category))       { $category        = $tcms_main->cleanUrlString($category); }
				if(isset($cat))            { $cat             = $tcms_main->cleanUrlString($cat); }
				if(isset($article))        { $article         = $tcms_main->cleanUrlString($article); }
				if(isset($action))         { $action          = $tcms_main->cleanUrlString($action); }
				if(isset($albums))         { $albums          = $tcms_main->cleanUrlString($albums); }
				if(isset($cmd))            { $cmd             = $tcms_main->cleanUrlString($cmd); }
				if(isset($current_pollall)){ $current_pollall = $tcms_main->cleanUrlString($current_pollall); }
				if(isset($ps))             { $ps              = $tcms_main->cleanUrlString($ps); }
				if(isset($vote))           { $vote            = $tcms_main->cleanUrlString($vote); }
				if(isset($XMLplace))       { $XMLplace        = $tcms_main->cleanUrlString($XMLplace); }
				if(isset($XMLfile))        { $XMLfile         = $tcms_main->cleanUrlString($XMLfile); }
				if(isset($page))           { $page            = $tcms_main->cleanUrlString($page); }
				if(isset($item))           { $item            = $tcms_main->cleanUrlString($item); }
				if(isset($contact_email))  { $contact_email   = $tcms_main->cleanUrlString($contact_email); }
				if(isset($date))           { $date            = $tcms_main->cleanUrlString($date); }
				if(isset($code))           { $code            = $tcms_main->cleanUrlString($code); }
				if(isset($c))              { $c               = $tcms_main->cleanUrlString($c); }
				
				
				
				/*
					Set Cookie
				*/
				if($code == 'setc') {
					setcookie('session', $session);
				}
				elseif($code == 'delc') {
					setcookie('session', '', time() - 81400);
				}
				
				
				
				/*
					Layout
				*/
				
				if(!isset($s) || $s == ''){
					$layout_xml = new xmlparser(''.$tcms_administer_site.'/tcms_global/layout.xml','r');
					$s = $layout_xml->read_section('layout', 'select');
				}
				
				if($seoEnabled == 1){
					if($seoFolder != ''){
						if($noSEOFolder){
							$templatePath = 'theme/'.$s.'/';
							$imagePath = '';
						}
						else{
							$templatePath = $seoFolder.'/theme/'.$s.'/';
							$imagePath = $seoFolder.'/';
						}
					}
					else{
						$templatePath = '/theme/'.$s.'/';
						$imagePath = '/';
					}
				}
				else{
					$templatePath = 'theme/'.$s.'/';
					$imagePath = '';
				}
				
				
				
				/*
					some objects
				*/
				// account provider
				$tcms_ap = new tcms_account_provider($tcms_administer_site, $c_charset);
				
				// configuration
				$tcms_modconfig = new tcms_modconfig($tcms_administer_site, $imagePath);
				
				// datacontainer
				$tcms_dcp = new tcms_datacontainer_provider($tcms_administer_site, $c_charset);
				
				// menu
				$tcms_menu = new tcms_menu_provider($tcms_administer_site, $c_charset, $is_admin);
				
				// components system
				if($use_components == 1) {
					$tcms_cs = new tcms_cs($tcms_administer_site, $imagePath);
				}
				
				// authentication
				$tcms_auth = new tcms_authentication($tcms_administer_site, $c_charset, $imagePath);
				
				
				
				/*
					IF ACTIVE
					START THE STATISTIC COUNTER
				*/
				if($statistics == 1){
					$tcms_stats = new tcms_statistics($c_charset, $tcms_administer_site);
					
					$tcms_stats->countSiteURL($s);
					$tcms_stats->countBrowserInfo();
					
					$tcms_stats->_tcms_statistics();
					
					unset($tcms_stats);
				}
				
				
				
				/*
					Authentication settings
				*/
				
				if(isset($session)){
					if($_GET['setXMLSession'] == 1){
						if(file_exists('engine/admin/session/'.$session)){
							$tcms_file = new tcms_file('engine/admin/session/'.$session, 'r');
							$ws_id = $tcms_file->Read();
							
							$tcms_file->ChangeFile($tcms_administer_site.'/tcms_session/'.$session, 'w');
							$tcms_file->Write($ws_id);
							$tcms_file->Close();
							
							$tcms_file->DeleteCustom('engine/admin/session/'.$session);
							
							unset($tcms_file);
						}
					}
					
					
					if($choosenDB == 'xml'){
						if(isset($session) && $session != '' && file_exists(''.$tcms_administer_site.'/tcms_session/'.$session) && filesize(''.$tcms_administer_site.'/tcms_session/'.$session) != 0){ $check_session = true; }
						else{ $check_session = false; }
					}
					else{
						$check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session);
					}
					
					
					if($check_session){
						$arr_ws = $tcms_main->getUserInfo($session);
						
						$ws_name  = $arr_ws['name'];
						$ws_user  = $arr_ws['user'];
						$ws_id    = $arr_ws['id'];
						$is_admin = $arr_ws['group'];
						
						if($is_admin == 'Administrator'
						|| $is_admin == 'Developer'
						|| $is_admin == 'Writer'
						|| $is_admin == 'Editor'){
							$canEdit = true;
						}
						else{
							$canEdit = false;
						}
					}
					
					
					if($choosenDB == 'xml'){ $tcms_main->check_session($session, 'user'); }
					else{ $tcms_main->check_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session); }
				}
				else{
					$check_session = false;
					$is_admin = 'Guest';
				}
				
				
				
				/*
					Web Site config from XML
				*/
				$namen_xml = new xmlparser(''.$tcms_administer_site.'/tcms_global/namen.xml','r');
				$sitetitle = $namen_xml->read_section('namen', 'title');
				$sitename  = $namen_xml->read_section('namen', 'name');
				$sitekey   = $namen_xml->read_section('namen', 'key');
				$logo      = $namen_xml->read_section('namen', 'logo');
				$namen_xml->flush();
				$namen_xml->_xmlparser();
				unset($namen_xml);
				
				$logo = $tcms_main->decodeText($logo, '2', $c_charset);
				$logo = trim($logo);
				
				if($logo != '' || !empty($logo))
					$sitelogo = '<img class="sitelogo" align="left" src="'.$imagePath.''.$tcms_administer_site.'/images/Image/'.$logo.'" border="0" />';
				else
					$sitelogo = '';
		
				// CHARSETS
				$sitetitle  = $tcms_main->decodeText($sitetitle, '2', $c_charset);
				$sitename   = $tcms_main->decodeText($sitename, '2', $c_charset);
				$sitekey    = $tcms_main->decodeText($sitekey, '2', $c_charset);
				
				$cms_name         = $tcms_version->getName();
				$cms_tagline      = $tcms_version->getTagline();
				$cms_version      = $tcms_version->getVersion();
				$cms_build        = $tcms_version->getBuild();
				$toenda_copyright = $tcms_version->getToendaCopyright();
				
				$show_doc_autor = $tcms_config->getShowDocAutor();
				$defaultCat     = $tcms_config->getDefaultCategory();
				$tcmsinst       = $tcms_config->getToendaCMSInSitetitle();
				
				if($tcmsinst == 1)
					$sitetitle  = $cms_name.' | '.$sitetitle;
				
				// Pathway Char
				if(!$tcms_main->isReal($pathwayChar))
					$pathwayChar = '/';
				
				
				
				/*
					Check db connection
				*/
				if($choosenDB != 'xml'){
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if(isset($sqlCN['num']) && $sqlCN['num'] == 0){
						$start_tcms_loading = false;
						
						$tcms_error = new tcms_error('index.php', 500, $sqlCN['msg'], $imagePath);
						$tcms_error->showMessage(false);
						
						unset($tcms_error);
					}
					else{ $start_tcms_loading = true; }
					
					$sqlAL->_sqlAbstractionLayer();
				}
				else{ $start_tcms_loading = true; }
				
				
				
				/*
					Start loading site
				*/
				if($start_tcms_loading){
					// Sidebar modules
					include_once('engine/tcms_kernel/datacontainer/tcms_dc_sidebarmodule.lib.php');
					
					$dcSidebarModule = new tcms_dc_sidebarmodule();
					$dcSidebarModule = $tcms_dcp->getSidebarModuleDC();
					
					$use_side_gallery   = $dcSidebarModule->GetSideGallery();
					$use_side_category  = $dcSidebarModule->GetSideCategory();
					$use_side_archives  = $dcSidebarModule->GetSideArchive();
					$use_side_links     = $dcSidebarModule->GetSideLinks();
					$use_layout_chooser = $dcSidebarModule->GetLayoutChooser();
					$use_login          = $dcSidebarModule->GetLogin();
					$use_syndication    = $dcSidebarModule->GetSyndication();
					$use_newsletter     = $dcSidebarModule->GetNewsletter();
					$use_search         = $dcSidebarModule->GetSearch();
					$use_sidebar        = $dcSidebarModule->GetSidebar();
					$use_poll           = $dcSidebarModule->GetPoll();
					
					unset($dcSidebarModule);
					
					
					
					// Syndication
					if($use_syndication == 1){
						$arrSD = $tcms_modconfig->getSyndicationConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						$use_rss091    = $arrSD['use_rss091'];
						$use_rss10     = $arrSD['use_rss10'];
						$use_rss20     = $arrSD['use_rss20'];
						$use_atom03    = $arrSD['use_atom03'];
						$use_opml      = $arrSD['use_opml'];
						$syn_amount    = $arrSD['syn_amount'];
						$use_syn_title = $arrSD['use_syn_title'];
						$def_feed      = $arrSD['def_feed'];
					}
					
					
					
					/*
						load module configuration
					*/
					
					if(!isset($id)) $id = 'frontpage';
					
					switch($id){
						case 'frontpage':
							$arrFP = $tcms_modconfig->getFrontpageConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$front_id           = $arrFP['front_id'];
							$front_title        = $arrFP['front_title'];
							$front_stamp        = $arrFP['front_stamp'];
							$front_text         = $arrFP['front_text'];
							$front_news_title   = $arrFP['front_news_title'];
							$cut_news           = $arrFP['cut_news'];
							$how_many           = $arrFP['how_many'];
							
							$sb_news_enabled    = $arrFP['front_s_enabled'];
							$sb_news_display    = $arrFP['front_s_display'];
							$front_s_title      = $arrFP['front_s_title'];
							$sb_cut_news        = $arrFP['front_s_cut_news'];
							$sb_how_many        = $arrFP['front_s_how_many'];
							
							$use_news_comments  = $arrFP['use_news_comments'];
							$show_autor         = $arrFP['show_autor'];
							$show_autor_as_link = $arrFP['show_autor_as_link'];
							$use_gravatar       = $arrFP['use_gravatar'];
							$use_emoticons      = $arrFP['use_emoticons'];
							$use_trackback      = $arrFP['use_trackback'];
							$use_timesince      = $arrFP['use_timesince'];
							$readmore_link      = $arrFP['readmore_link'];
							$news_spacing       = $arrFP['news_spacing'];
							
							$cut_news = ( $cut_news == 0 ? '1000000' : $cut_news );
							
							if($use_trackback == 1){
								include_once('engine/tcms_kernel/tcms_trackback.lib.php');
							}
							break;
						
						case 'impressum':
							include_once('engine/tcms_kernel/datacontainer/tcms_dc_impressum.lib.php');
							
							$dcImpressum = new tcms_dc_impressum();
							$dcImpressum = $tcms_dcp->getImpressumDC();
							
							$imp_id      = $dcImpressum->GetID();
							$imp_title   = $dcImpressum->GetTitle();
							$imp_stamp   = $dcImpressum->GetKeynote();
							$legal       = $dcImpressum->GetText();
							$imp_contact = $dcImpressum->GetContact();
							$taxno       = $dcImpressum->GetTaxNumber();
							$ustid       = $dcImpressum->GetUstID();
							
							unset($dcImpressum);
							
							$link_imp = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$imp_id.'&amp;s='.$s;
							break;
						
						case 'newsmanager':
							$arrNM = $tcms_modconfig->getNewsmanagerConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$news_id            = $arrNM['news_id'];
							$news_title         = $arrNM['news_title'];
							$news_stamp         = $arrNM['news_stamp'];
							$news_maintext      = $arrNM['news_text'];
							$news_image         = $arrNM['news_image'];
							$use_news_comments  = $arrNM['use_news_comments'];
							$show_autor         = $arrNM['show_autor'];
							$show_autor_as_link = $arrNM['show_autor_as_link'];
							$news_amount        = $arrNM['news_amount'];
							$cut_news           = $arrNM['cut_news'];
							$authorized         = $arrNM['access'];
							$use_gravatar       = $arrNM['use_gravatar'];
							$use_emoticons      = $arrNM['use_emoticons'];
							$use_trackback      = $arrNM['use_trackback'];
							$use_timesince      = $arrNM['use_timesince'];
							$readmore_link      = $arrNM['readmore_link'];
							$news_spacing       = $arrNM['news_spacing'];
							
							$cut_news = ( $cut_news == 0 ? '1000000' : $cut_news );
							
							$link_news  = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$news_id.'&amp;s='.$s;
							
							if($use_trackback == 1){
								include_once('engine/tcms_kernel/tcms_trackback.lib.php');
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
							$arrCF = $tcms_modconfig->getContactformConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							if(!isset($contact_email))
								$contact_email = $arrCF['cf_contact'];
							
							$send_id           = $arrCF['cf_id'];
							$contact_title     = $arrCF['cf_title'];
							$contact_stamp     = $arrCF['cf_stamp'];
							$contact_text      = $arrCF['cf_text'];
							$authorized        = $arrCF['cf_access'];
							$show_cisb         = $arrCF['cf_scisb'];
							$cform_enabled     = $arrCF['cf_enabled'];
							$use_adressbook    = $arrCF['cf_adbook'];
							$use_contactad     = $arrCF['cf_usecon'];
							$show_contactemail = $arrCF['cf_showce'];
							
							$link_contact = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$send_id.'&amp;s='.$s;
							break;
						
						case 'guestbook':
							$arrGB = $tcms_modconfig->getGuestbookConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$book_id      = $arrGB['guest_id'];
							$book_title   = $arrGB['booktitle'];
							$book_stamp   = $arrGB['bookstamp'];
							$authorized   = $arrGB['access'];
							$book_enabled = $arrGB['enabled'];
							
							$link_guest = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$book_id.'&amp;s='.$s;
							break;
						
						case 'products':
							$arrP = $tcms_modconfig->getProductsConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$products_id    = $arrP['products_id'];
							$products_title = $arrP['products_title'];
							$products_stamp = $arrP['products_stamp'];
							$products_text  = $arrP['products_text'];
							$main_category  = $arrP['category_state'];
							$category_title = $arrP['category_title'];
							$show_pro_ct    = $arrP['use_category_title'];
							break;
						
						case 'imagegallery':
							$arrP = $tcms_modconfig->getImagegalleryConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$image_id           = $arrP['image_id'];
							$image_title        = $arrP['image_title'];
							$image_stamp        = $arrP['image_stamp'];
							$image_details      = $arrP['image_details'];
							$gallery_image_sort = $arrP['image_sort'];
							$use_image_comments = $arrP['use_comments'];
							$authorized         = $arrP['access'];
							$list_option        = $arrP['list_option'];
							
							$link_image  = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$image_id.'&amp;s='.$s;
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
					$keywords       = $tcms_config->getMetadataKeywords();
					$description    = $tcms_config->getMetadataDescription();
					$active_topmenu = $tcms_config->getTopmenuActive();
					
					$footer_xml       = new xmlparser(''.$tcms_administer_site.'/tcms_global/footer.xml','r');
					$websiteowner     = $footer_xml->read_section('footer', 'websiteowner');
					$websitecopyright = $footer_xml->read_section('footer', 'copyright');
					$websiteowner_url = $footer_xml->read_section('footer', 'owner_url');
					$footer_xml->flush();
					$footer_xml->_xmlparser();
					
					// CHARSETS
					$keywords         = $tcms_main->decodeText($keywords, '2', $c_charset);
					$description      = $tcms_main->decodeText($description, '2', $c_charset);
					$websiteowner     = $tcms_main->decodeText($websiteowner, '2', $c_charset);
					$websitecopyright = $tcms_main->decodeText($websitecopyright, '2', $c_charset);
					$websiteowner_url = $tcms_main->decodeText($websiteowner_url, '2', $c_charset);
					
					
					
					/*
						Top or Side Menu
					*/
					$navigation        = $tcms_config->getSidemenuEnabled();
					$second_navigation = $tcms_config->getTopmenuEnabled();
					
					if($choosenDB == 'xml'){
						$xml    = new xmlparser(''.$tcms_administer_site.'/tcms_global/sidebar.xml','r');
						$user_navigation = $xml->read_section('side', 'usermenu');
						
						if($use_login == 1){
							$login_title  = $xml->read_section('side', 'login_title');
							$no_login     = $xml->read_section('side', 'nologin');
							$reg_link     = $xml->read_section('side', 'reg_link');
							$reg_username = $xml->read_section('side', 'reg_user');
							$reg_password = $xml->read_section('side', 'reg_pass');
							$login_user   = $xml->read_section('side', 'login_user');
							$show_lt      = $xml->read_section('side', 'show_login_title');
							$show_ml      = $xml->read_section('side', 'show_memberlist');
							
							$login_title  = $tcms_main->decodeText($login_title, '2', $c_charset);
							$no_login     = $tcms_main->decodeText($no_login, '2', $c_charset);
							$reg_link     = $tcms_main->decodeText($reg_link, '2', $c_charset);
							$reg_username = $tcms_main->decodeText($reg_username, '2', $c_charset);
							$reg_password = $tcms_main->decodeText($reg_password, '2', $c_charset);
						}
						
						$xml->flush();
						$xml->_xmlparser();
					}
					else{
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
						$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
						
						$sqlAL->_sqlAbstractionLayer();
						
						$user_navigation = $sqlARR['usermenu'];
						
						if($use_login == 1){
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
					if($choosenDB == 'xml'){
						$site_max_id = $tcms_main->load_xml_files(''.$tcms_administer_site.'/tcms_content/', 'files');
						
						if(is_array($site_max_id)){
							if(!in_array($id.'.xml', $site_max_id))
								$ws_error = true;
						}
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $id);
						$site_max_id = $sqlAL->sqlGetNumber($sqlQR);
						
						if($site_max_id == 0)
							$ws_error = true;
					}
					
					if(in_array($id, $arrTCMSModules))
						$ws_error = false;
					
					if($ws_error == false){
						if(!isset($download_id)){ $download_id = 'download'; }
						if(!isset($products_id)){ $products_id = 'products'; }
						if(!isset($send_id)){ $send_id = 'contactform'; }
						if(!isset($book_id)){ $book_id = 'guestbook'; }
						if(!isset($image_id)){ $image_id = 'imagegallery'; }
						if(!isset($link_id)){ $link_id = 'links'; }
						if(!isset($news_id)){ $news_id = 'newsmanager'; }
						if(!isset($imp_id)){ $imp_id = 'impressum'; }
						if(!isset($faq_id)){ $faq_id = 'knowledgebase'; }
						
						
						/*
							Main Menu
							Top Menu
							Linkway
							
							-> load only if not in cache
						*/
						//if(!file_exists('cache/'.)){
						if($choosenDB == 'xml'){
							$arr_files     = $tcms_main->readdir_ext(''.$tcms_administer_site.'/tcms_menu/');
							$arr_filesT    = $tcms_main->readdir_ext(''.$tcms_administer_site.'/tcms_topmenu/');
							$arr_side_navi = $tcms_main->mainmenu($arr_files, $c_charset, ( isset($session) ? $session : NULL ), $s, 'link');
							
							$arr_filename = $tcms_main->readdir_ext(''.$tcms_administer_site.'/tcms_topmenu/');
							$arr_top_navi = $tcms_main->topmenu($arr_filename, $c_charset, ( isset($session) ? $session : NULL ), $s);
							
							$arrLinkway = $tcms_main->linkway($arr_files, $arr_filesT, $c_charset, ( isset($session) ? $session : NULL ), $s);
						}
						else{
							$arr_side_navi = $tcms_main->mainmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s, 'link');
							
							$arr_top_navi = $tcms_main->topmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s);
							
							$arrLinkway = $tcms_main->linkwaySQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, ( isset($session) ? $session : NULL ), $s);
						}
						
						
						$arr_path = $arrLinkway['path'];
						$titleway = $arrLinkway['title'];
						$pathway  = $arrLinkway['pathway'];
						
						
						/*
							Load Components System
						*/
						if($use_components == 1)
							$arrSideCS = $tcms_cs->getAllSideCS();
						
						
						/*
							Inluce Defines
						*/
						include_once('engine/tcms_kernel/tcms_defines.lib.php');
						
						
						/*
							Inluce the layout
						*/
						if(_LAYOUT != '')
							include_once(_LAYOUT);
						
						
						/*
							Clean up
						*/
						$tcms_auth->_tcms_authentication();
						$tcms_main->_tcms_main();
						$tcms_config->_tcms_configuration();
						
						unset($tcms_param);
						unset($sqlAL);
						unset($tcms_main);
						unset($tcms_auth);
						unset($tcms_dcp);
						unset($tcms_menu);
						unset($tcms_config);
						unset($tcms_version);
						
						if($use_components == 1)
							unset($tcms_cs);
						
						if($statistics == 1)
							unset($tcms_stats);
					}
					else{
						include_once('engine/tcms_kernel/tcms_defines.lib.php');
						include(_ERROR_404);
					}
				}
			}
		}
	}
}

?>
