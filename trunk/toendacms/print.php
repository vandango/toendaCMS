<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Print page
|
| File:	print.php
|
+
*/


/**
 * Generate Print Document
 * 
 * This module is used to generate a pdf document
 * 
 * @version 0.2.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


if(isset($_GET['seoEnabled'])){ $seoEnabled = $_GET['seoEnabled']; }
if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['s'])){ $s = $_GET['s']; }
if(isset($_GET['session'])){ $session = $_GET['session']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['albums'])){ $albums = $_GET['albums']; }


define('_TCMS_VALID', 1);

include_once('engine/tcms_kernel/tcms_loader.lib.php');

// load current active page
include_once('site.php');
$tcms_administer_site = $tcms_site[0]['path'];
define('_TCMS_PATH', $tcms_site[0]['path']);

//include_once ('engine/tcms_kernel/tcms_xml.lib.php');

using('toendacms.kernel.time');
using('toendacms.kernel.xml');
using('toendacms.kernel.configuration');
using('toendacms.kernel.main');
using('toendacms.kernel.sql');
using('toendacms.kernel.script');
using('toendacms.kernel.modconfig');
using('toendacms.kernel.gd');
using('toendacms.kernel.version');
using('toendacms.kernel.html');
using('toendacms.kernel.authentication');
using('toendacms.kernel.account_provider');


if(file_exists($tcms_administer_site.'/tcms_global/database.php')
&& file_exists($tcms_administer_site.'/tcms_global/var.xml')){
	/*
	if(file_exists($tcms_administer_site.'/tcms_global/var.xml')){
		$c_xml        = new xmlparser($tcms_administer_site.'/tcms_global/var.xml', 'r');
		$c_charset    = $c_xml->readSection('global', 'charset');
		$statistics   = $c_xml->readSection('global', 'statistics');
		$seoEnabled   = $c_xml->readSection('global', 'seo_enabled');
		$seoFolder    = $c_xml->readSection('global', 'server_folder');
		$seoFormat    = $c_xml->readSection('global', 'seo_format');
	}
	*/
	
	if($seoEnabled == 1){
		//include_once ('engine/tcms_kernel/tcms_seo.lib.php');
		
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
		unset($tcms_seo);
		
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
		
		if($seoFolder != '') {
			$seoFolder = '/'.$seoFolder;
		}
		else {
			$seoFolder = '';
		}
	}
	
	/*
	include_once ('engine/tcms_kernel/tcms.lib.php');
	include_once ('engine/tcms_kernel/tcms_time.lib.php');
	include_once ('engine/tcms_kernel/tcms_script.lib.php');
	include_once ('engine/tcms_kernel/tcms_html.lib.php');
	include_once ('engine/tcms_kernel/tcms_sql.lib.php');
	include_once ('engine/tcms_kernel/tcms_modconfig.lib.php');
	include_once ('engine/tcms_kernel/tcms_gd.lib.php');
	*/
	
	echo '<script language="JavaScript" src="engine/js/dhtml.js"></script>';
	
	
	$tcms_main      = new tcms_main($tcms_administer_site, $choosenDB);
	$tcms_modconfig = new tcms_modconfig($tcms_administer_site, '');
	$tcms_version   = new tcms_version();
	$tcms_config    = new tcms_configuration($tcms_administer_site);
	$tcms_time      = new tcms_time();
	
	
	$language_stage = 'print';
	include_once('engine/language/lang_admin.php');
	
	require($tcms_administer_site.'/tcms_global/database.php');
	
	$choosenDB = $tcms_db_engine;
	$sqlUser   = $tcms_db_user;
	$sqlPass   = $tcms_db_password;
	$sqlHost   = $tcms_db_host;
	$sqlDB     = $tcms_db_database;
	$sqlPort   = $tcms_db_port;
	$sqlPrefix = $tcms_db_prefix;
	
	$tcms_main->setDatabaseInfo($choosenDB);
	$tcms_config->decodeConfiguration($tcms_main);
	
	
	$charset    = $tcms_config->getCharset();
	$seoEnabled = $tcms_config->getSEOEnabled();
	
	if($seoEnabled) {
		$seoFolder = $tcms_config->getSEOPath();
		
		if($seoFolder != '') {
			$seoFolder = '/'.$seoFolder.'/';
		}
		else {
			$seoFolder = '/';
		}
	}
	else {
		$seoFolder = '/';
	}
	
	// authentication
	$tcms_auth = new tcms_authentication(_TCMS_PATH, $charset, $seoFolder);
	
	// account provider
	$tcms_ap = new tcms_account_provider(_TCMS_PATH, $charset);
	
	
	
	
	
	//******************************
	// ACCESS LEVEL
	//
	
	switch($id){
		case 'profile':
		case 'polls':
		case 'register':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'imagegallery':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'guestbook':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'newsmanager':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'contactform':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'impressum':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'frontpage':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'search':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'links':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'download':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'products':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		case 'components':
			$authorized = 'Public';
			$content_published = 1;
			break;
		
		default:
			if($choosenDB == 'xml'){
				$cl_xml = new xmlparser($tcms_administer_site.'/tcms_content/'.$id.'.xml','r');
				$authorized = $cl_xml->readSection('main', 'access');
				$content_published = $cl_xml->readSection('main', 'published');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'content', $id);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				$authorized = $sqlARR['access'];
				$content_published = $sqlARR['published'];
			}
			break;
	}
	
	
	
	
	/*
		CHECK FOR PUBLIC ACCESS
	*/
	
	$check_session = $tcms_auth->checkSessionExist($session);
	
	if($check_session){
		$arr_ws = $tcms_ap->getUserInfo($session);
		
		$ws_user  = $arr_ws['user'];
		$ws_id    = $arr_ws['id'];
		$is_admin = $arr_ws['group'];
	}
	
	if($authorized == 'Public'){ $ws_auth = 1; }
	
	if($authorized == 'Protected'){
		$ws_auth = 0;
		if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $ws_auth = 1; }
		else{ $ws_auth = 0; }
	}
	
	if($authorized == 'Private'){
		$ws_auth = 0;
		if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $ws_auth = 1; }
		else{ $ws_auth = 0; }
	}
	
	
	
	
	
	//*********************************
	// READ XML
	//
	
	if($ws_auth == 1){
		if($id != 'newsmanager'){
			//===================================
			// CONTENTS
			//===================================
			if($choosenDB == 'xml'){
				$content_xml = new xmlparser($tcms_administer_site.'/tcms_content/'.$id.'.xml','r');
				$title     = $content_xml->readSection('main', 'title');
				$key       = $content_xml->readSection('main', 'key');
				$content00 = $content_xml->readSection('main', 'content00');
				$content01 = $content_xml->readSection('main', 'content01');
				$foot      = $content_xml->readSection('main', 'foot');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'content', $id);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$title     = $sqlARR['title'];
				$key       = $sqlARR['key'];
				$content00 = $sqlARR['content00'];
				$content01 = $sqlARR['content01'];
				$foot      = $sqlARR['foot'];
			}
			
			// TCMS SCRIPT
			$toendaScript = new toendaScript($key);
			$key = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content00);
			$content00 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content01);
			$content01 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($foot);
			$foot = $toendaScript->toendaScript_trigger();
			
			// CHARSETS
			$title       = $tcms_main->decodeText($title, '2', $c_charset);
			$key         = $tcms_main->decodeText($key, '2', $c_charset);
			$content00   = $tcms_main->decodeText($content00, '2', $c_charset);
			$content01   = $tcms_main->decodeText($content01, '2', $c_charset);
			$foot        = $tcms_main->decodeText($foot, '2', $c_charset);
		}
		else{
			if($choosenDB == 'xml'){
				$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$news.'.xml','r');
				$arr_news['title'] = $main_xml->readSection('news', 'title');
				$arr_news['autor'] = $main_xml->readSection('news', 'autor');
				$arr_news['date']  = $main_xml->readSection('news', 'date');
				$arr_news['time']  = $main_xml->readSection('news', 'time');
				$arr_news['news']  = $main_xml->readSection('news', 'newstext');
				$arr_news['order'] = $main_xml->readSection('news', 'order');
				$arr_news['stamp'] = $main_xml->readSection('news', 'stamp');
				$arr_news['image'] = $main_xml->readSection('news', 'image');
				
				if(!$arr_news['title']){ $arr_news['title'] = ''; }
				if(!$arr_news['autor']){ $arr_news['autor'] = ''; }
				if(!$arr_news['date']) { $arr_news['date']  = ''; }
				if(!$arr_news['time']) { $arr_news['time']  = ''; }
				if(!$arr_news['news']) { $arr_news['news']  = ''; }
				if(!$arr_news['order']){ $arr_news['order'] = ''; }
				if(!$arr_news['stamp']){ $arr_news['stamp'] = ''; }
				if(!$arr_news['image']){ $arr_news['image'] = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'news', $news);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				//$tcms_main->paf($sqlARR);
				
				$arr_news['title'] = $sqlARR['title'];
				$arr_news['autor'] = $sqlARR['autor'];
				$arr_news['date']  = $sqlARR['date'];
				$arr_news['time']  = $sqlARR['time'];
				$arr_news['news']  = $sqlARR['newstext'];
				$arr_news['order'] = $sqlARR['uid'];
				$arr_news['stamp'] = $sqlARR['stamp'];
				$arr_news['image'] = $sqlARR['published'];
				
				if($arr_news['title'] == NULL){ $arr_news['title'] = ''; }
				if($arr_news['autor'] == NULL){ $arr_news['autor'] = ''; }
				if($arr_news['date']  == NULL){ $arr_news['date']  = ''; }
				if($arr_news['time']  == NULL){ $arr_news['time']  = ''; }
				if($arr_news['news']  == NULL){ $arr_news['news']  = ''; }
				if($arr_news['order'] == NULL){ $arr_news['order'] = ''; }
				if($arr_news['stamp'] == NULL){ $arr_news['stamp'] = ''; }
				if($arr_news['image'] == NULL){ $arr_news['image'] = ''; }
			}
			
			$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
			$arr_news['autor'] = $tcms_main->decodeText($arr_news['autor'], '2', $c_charset);
			$arr_news['news']  = $tcms_main->decodeText($arr_news['news'], '2', $c_charset);
			
			
			$news_content = $arr_news['news'];
			
			$toendaScript = new toendaScript($news_content);
			$news_content = $toendaScript->toendaScript_trigger();
			
			$news_content = $toendaScript->toendaScript_more($news_content, 'text');
			
			
			$title = $arr_news['title'];
			$key = '<span class="text_small">'.$arr_news['date'].' - '.$arr_news['time'].' &bull; '._NEWS_WRITTEN.' '.$arr_news['autor'].'</span>';
			$content00 = $news_content;
			$content01 = '';
			$foot = '';
		}
		
		
		if(file_exists('theme/'.$s.'/print.php')) include_once('theme/'.$s.'/print.php');
		else include_once('engine/extensions/ext_print_default.php');
	}
	else{
		include_once(_ERROR_401);
	}
}



?>
