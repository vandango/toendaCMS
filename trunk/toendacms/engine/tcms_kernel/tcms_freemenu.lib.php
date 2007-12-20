<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Free Menu Entrys
|
| File:	tcms_freemenu.lib.php
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Free Menu Entrys
 *
 * This is used for globar backend values.
 *
 * @version 0.5.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


// ----------------------------------
// MENU
// ----------------------------------

// Home
$mod_title['name']['mod_start'] = _MOD_HOME.' &bull; '.$id_name.' ( '.$id_group.' )';
$mod_title['show']['mod_start'] = '';

$mod_title['name']['mod_newpage'] = _MOD_NEWPAGE;
$mod_title['show']['mod_newpage'] = 2;

$mod_title['name']['mod_notebook'] = _MOD_NOTE;
$mod_title['show']['mod_notebook'] = 1;


// Personal
$mod_title['name']['mod_page'] = _MOD_PAGE;
$mod_title['show']['mod_page'] = '';

$mod_title['name']['mod_media'] = _MOD_MEDIA;
$mod_title['show']['mod_media'] = 'tb_media.php';

$mod_title['name']['mod_news_categories'] = _MOD_NEWS_CATEGORIES;
$mod_title['show']['mod_news_categories'] = 2;

$mod_title['name']['mod_comments'] = _MOD_COMMENTS;
$mod_title['show']['mod_comments'] = 2;

$mod_title['name']['mod_guestbook'] = _MOD_GUESTBOOK;
$mod_title['show']['mod_guestbook'] = 'tb_guestbook.php';


// Navigation
$mod_title['name']['mod_sidemenu'] = _MOD_SIDEMENU;
$mod_title['show']['mod_sidemenu'] = 'tb_sidemenu.php';

$mod_title['name']['mod_topmenu'] = _MOD_TOPMENU;
$mod_title['show']['mod_topmenu'] = 'tb_topmenu.php';


// Content
$mod_title['name']['mod_content'] = _MOD_CONTENT;
$mod_title['show']['mod_content'] = 'tb_content.php';

$mod_title['name']['mod_news'] = _MOD_NEWS;
$mod_title['show']['mod_news'] = 'tb_news.php';

$mod_title['name']['mod_download'] = _MOD_DOWN;
$mod_title['show']['mod_download'] = 'tb_download.php';

$mod_title['name']['mod_products'] = _MOD_PRODUCTS;
$mod_title['show']['mod_products'] = 'tb_products.php';

$mod_title['name']['mod_gallery'] = _MOD_GALLERY;
$mod_title['show']['mod_gallery'] = 'tb_gallery.php';

$mod_title['name']['mod_links']=_MOD_LINK;
$mod_title['show']['mod_links']=2;

$mod_title['name']['mod_knowledgebase'] = _MOD_KNOWLEDGEBASE;
$mod_title['show']['mod_knowledgebase'] = 'tb_knowledgebase.php';


// Sidebar Extensions
$mod_title['name']['mod_side_extensions']=_MOD_SIDEBAR_EXTENSION;
$mod_title['show']['mod_side_extensions']=1;

$mod_title['name']['mod_side']=_MOD_SIDEBAR;
$mod_title['show']['mod_side']=2;

$mod_title['name']['mod_newsletter'] = _MOD_NEWSLETTER;
$mod_title['show']['mod_newsletter'] = 'tb_newsletter.php';

$mod_title['name']['mod_poll']=_MOD_POLL;
$mod_title['show']['mod_poll']=2;


// Extension
$mod_title['name']['mod_contactform'] = _MOD_CFORM;
$mod_title['show']['mod_contactform'] = 'tb_contactform.php';

$mod_title['name']['mod_guestbook_config'] = _MOD_BOOK;
$mod_title['show']['mod_guestbook_config'] = 'tb_guestbook_config.php';

$mod_title['name']['mod_frontpage']=_MOD_FRONTPAGE;
$mod_title['show']['mod_frontpage']=1;

$mod_title['name']['mod_impressum']=_MOD_IMPRESSUM;
$mod_title['show']['mod_impressum']=1;

$mod_title['name']['mod_contact'] = _MOD_CONTACT;
$mod_title['show']['mod_contact'] = 'tb_contact.php';

$mod_title['name']['mod_user'] = _MOD_USER;
$mod_title['show']['mod_user'] = 'tb_user.php';

$mod_title['name']['mod_userpage']=_MOD_USERPAGE;
$mod_title['show']['mod_userpage']=2;


// Site
$mod_title['name']['mod_components'] = _MOD_COMPONENTS;
$mod_title['show']['mod_components'] = 'tb_components.php';

$mod_title['name']['mod_upload_components'] = _MOD_COMPONENTS_UPLOAD;
$mod_title['show']['mod_upload_components'] = 'tb_upload_components.php';


// Site
$mod_title['name']['mod_global'] = _MOD_GLOBAL;
$mod_title['show']['mod_global'] = 1;

$mod_title['name']['mod_import'] = _MOD_IMPORT;
$mod_title['show']['mod_import'] = '';

$mod_title['name']['mod_stats'] = _MOD_STATS;
$mod_title['show']['mod_stats'] = '';

$mod_title['name']['mod_layout'] =_MOD_TEMPLATE;
$mod_title['show']['mod_layout'] = 1;

$mod_title['name']['mod_upload_layout'] = _MOD_TEMPLATE_UPLOAD;
$mod_title['show']['mod_upload_layout'] = 'tb_upload_layout.php';


// Help
$mod_title['name']['mod_credits'] = _MOD_CREDITS;
$mod_title['show']['mod_credits'] = '';

$mod_title['name']['mod_help'] = _MOD_HELP;
$mod_title['show']['mod_help'] = '';

$mod_title['name']['mod_aboutmodule'] = _MOD_ABOUT_MODULE;
$mod_title['show']['mod_aboutmodule'] = '';

$mod_title['name']['mod_about'] = _MOD_ABOUT;
$mod_title['show']['mod_about'] = '';








//***********************
// PAGE COMPONENTS
//
if($site == 'mod_newpage' || $site == 'mod_sidemenu'){
	/*if($choosenDB == 'xml'){
		$arrMenuItems = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_menu/');
		foreach($arrMenuItems as $key => $val){
			if($val != 'index.html'){
				$xmlFileList = new xmlparser('../../'.$tcms_administer_site.'/tcms_menu/'.$val,'r');
				$arrXMLID[$key] = $xmlFileList->read_section('menu', 'link');
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'sidemenu');
		$count = 0;
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arrXMLID[$count] = $sqlARR['link'];
			$count++;
		}
	}
	*/
	if(!is_array($arrXMLID)){ $arrXMLID[0] = ''; }
	
	$i = 0;
	if(!in_array('search', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_SEARCH;
		$arr_linkcom['link'][$i] = 'search';
		$i++;
	}
	
	if(!in_array('poll', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_POLL;
		$arr_linkcom['link'][$i] = 'polls';
		$i++;
	}
	
	if(!in_array('knowledgebase', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_FAQ;
		$arr_linkcom['link'][$i] = 'knowledgebase';
		$i++;
	}
	
	if(!in_array('newsmanager', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_NEWS;
		$arr_linkcom['link'][$i] = 'newsmanager';
		$i++;
	}
	
	if(!in_array('download', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_DOWN;
		$arr_linkcom['link'][$i] = 'download';
		$i++;
	}
	
	if(!in_array('frontpage', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_FRONT;
		$arr_linkcom['link'][$i] = 'frontpage';
		$i++;
	}
	
	if(!in_array('impressum', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_IMP;
		$arr_linkcom['link'][$i] = 'impressum';
		$i++;
	}
	
	if(!in_array('imagegallery', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_GALLERY;
		$arr_linkcom['link'][$i] = 'imagegallery';
		$i++;
	}
	
	if(!in_array('guestbook', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_QBOOK;
		$arr_linkcom['link'][$i] = 'guestbook';
		$i++;
	}
	
	if(!in_array('contactform', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_CFORM;
		$arr_linkcom['link'][$i] = 'contactform';
		$i++;
	}
	
	if(!in_array('products', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_PRODUCTS;
		$arr_linkcom['link'][$i] = 'products';
		$i++;
	}
	
	if(!in_array('links', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_LINK;
		$arr_linkcom['link'][$i] = 'links';
		$i++;
	}
	
	
	unset($arrDocuments);
	
	$arrDocuments = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/components/');
	
	if($tcms_main->isArray($arrDocuments)){
		foreach($arrDocuments as $key => $val){
			if($val != 'index.html'){
				$csXML = new xmlparser('../../'.$tcms_administer_site.'/components/'.$val.'/component.xml', 'r');
				$chkXML = $csXML->readValue('mainCS');
				
				if($chkXML == 1){
					$xmlID = $csXML->readValue('id');
					
				//	if(!in_array('components&amp;item='.$xmlID, $arrXMLID) || !in_array('components&item='.$xmlID, $arrXMLID)){
					$xmlTitle = $csXML->readValue('title');
					$arr_linkcom['name'][$i] = _TCMS_MENU_CS.': '.$xmlTitle;
					$arr_linkcom['link'][$i] = 'components&amp;item='.$xmlID;
					
					$arr_linkcom['name'][$i] = $tcms_main->decodeText($arr_linkcom['name'][$i], '2', $c_charset, true);
					
					$i++;
				//	}
				}
			}
		}
	}
	unset($arrDocuments);
	
	
	if($choosenDB == 'xml'){
		$arrDocuments = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_content/');
		
		if($tcms_main->isArray($arrDocuments)){
			foreach($arrDocuments as $key => $val){
				if($val != 'index.html'){
					$xmlFileList    = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$val,'r');
					$xmlID    = $xmlFileList->readSection('main', 'id');
					
					//if(!in_array($xmlID, $arrXMLID)){
					$xmlTitle = $xmlFileList->readSection('main', 'title');
					$arr_linkcom['name'][$i] = $xmlTitle;
					$arr_linkcom['link'][$i] = $xmlID;
					
					$arr_linkcom['name'][$i] = '* '.$tcms_main->decodeText($arr_linkcom['name'][$i], '2', $c_charset);
					
					$i++;
					//}
				}
			}
		}
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll($tcms_db_prefix.'content');
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$xmlID = $sqlObj->uid;
			
			if($xmlID == NULL) {
				$xmlID = '';
			}
			
			$arr_linkcom['name'][$i] = $sqlObj->title;
			$arr_linkcom['link'][$i] = $xmlID;
			
			$arr_linkcom['name'][$i] = '* '.$tcms_main->decodeText($arr_linkcom['name'][$i], '2', $c_charset);
			
			$i++;
		}
		
		$sqlAL->freeResult($sqlQR);
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
	}
}











if($site == 'mod_topmenu'){
	/*if($choosenDB == 'xml'){
		$arrMenuItems = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_topmenu/');
		foreach($arrMenuItems as $key => $val){
			if($val != 'index.html'){
				$xmlFileList = new xmlparser('../../'.$tcms_administer_site.'/tcms_topmenu/'.$val,'r');
				$arrXMLID[$key] = $xmlFileList->read_section('top', 'link');
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'topmenu');
		$count = 0;
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arrXMLID[$count] = $sqlARR['link'];
			$count++;
		}
	}
	*/
	if(!is_array($arrXMLID)){ $arrXMLID[0] = ''; }
	
	$i = 0;
	if(!in_array('search', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_SEARCH;
		$arr_linkcom['link'][$i] = 'search';
		$i++;
	}
	
	if(!in_array('poll', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_POLL;
		$arr_linkcom['link'][$i] = 'polls';
		$i++;
	}
	
	if(!in_array('knowledgebase', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_FAQ;
		$arr_linkcom['link'][$i] = 'knowledgebase';
		$i++;
	}
	
	if(!in_array('newsmanager', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_NEWS;
		$arr_linkcom['link'][$i] = 'newsmanager';
		$i++;
	}
	
	if(!in_array('download', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_DOWN;
		$arr_linkcom['link'][$i] = 'download';
		$i++;
	}
	
	if(!in_array('frontpage', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_FRONT;
		$arr_linkcom['link'][$i] = 'frontpage';
		$i++;
	}
	
	if(!in_array('impressum', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_IMP;
		$arr_linkcom['link'][$i] = 'impressum';
		$i++;
	}
	
	if(!in_array('imagegallery', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_GALLERY;
		$arr_linkcom['link'][$i] = 'imagegallery';
		$i++;
	}
	
	if(!in_array('guestbook', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_QBOOK;
		$arr_linkcom['link'][$i] = 'guestbook';
		$i++;
	}
	
	if(!in_array('contactform', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_CFORM;
		$arr_linkcom['link'][$i] = 'contactform';
		$i++;
	}
	
	if(!in_array('products', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_PRODUCTS;
		$arr_linkcom['link'][$i] = 'products';
		$i++;
	}
	
	if(!in_array('links', $arrXMLID)){
		$arr_linkcom['name'][$i] = _TCMS_MENU_LINK;
		$arr_linkcom['link'][$i] = 'links';
		$i++;
	}
	
	
	unset($arrDocuments);
	
	$arrDocuments = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/components/');
	
	if($tcms_main->isArray($arrDocuments)){
		foreach($arrDocuments as $key => $val){
			if($val != 'index.html'){
				$csXML = new xmlparser('../../'.$tcms_administer_site.'/components/'.$val.'/component.xml', 'r');
				$chkXML = $csXML->readValue('mainCS');
				
				if($chkXML == 1){
					$xmlID = $csXML->readValue('id');
					
					//if(!in_array('components&amp;item='.$xmlID, $arrXMLID) || !in_array('components&item='.$xmlID, $arrXMLID)){
						$xmlTitle = $csXML->readValue('title');
						//echo $xmlID.' -> '.$xmlTitle.'<br>';
						$arr_linkcom['name'][$i] = _TCMS_MENU_CS.': '.$xmlTitle;
						$arr_linkcom['link'][$i] = 'components&amp;item='.$xmlID;
						
						$arr_linkcom['name'][$i] = $tcms_main->decodeText($arr_linkcom['name'][$i], '2', $c_charset, true);
						
						$i++;
					//}
				}
			}
		}
	}
	unset($arrDocuments);
	
	
	if($choosenDB == 'xml'){
		$arrDocuments = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_content/');
		
		if($tcms_main->isArray($arrDocuments)){
			foreach($arrDocuments as $key => $val){
				if($val != 'index.html'){
					$xmlFileList    = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$val,'r');
					$xmlID    = $xmlFileList->readSection('main', 'id');
					
					//if(!in_array($xmlID, $arrXMLID)){
						$xmlTitle = $xmlFileList->readSection('main', 'title');
						$arr_linkcom['name'][$i] = '* '.$tcms_main->decodeText($xmlTitle, '2', $c_charset);
						$arr_linkcom['link'][$i] = $xmlID;
						
						$i++;
					//}
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll($tcms_db_prefix.'content');
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$xmlID = $sqlObj->uid;
			if($xmlID == NULL){ $xmlID = ''; }
			
			//if(!in_array($xmlID, $arrXMLID)){
				$xmlTitle = $sqlObj->title;
				$arr_linkcom['name'][$i] = '* '.$tcms_main->decodeText($xmlTitle, '2', $c_charset);
				$arr_linkcom['link'][$i] = $xmlID;
				
				$i++;
			//}
			
			$i++;
		}
		
		$sqlAL->freeResult($sqlQR);
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
	}
}










//***********************
// NEWS CATEGORIES
//
if($choosenDB == 'xml'){
	$arrCatFiles = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_news_categories/');
	
	if($tcms_main->isArray($arrCatFiles)){
		foreach($arrCatFiles as $key => $value){
			if($value != 'index.html'){
				$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news_categories/'.$value,'r');
				$arrNewsCat['tag'][$key]  = substr($value, 0, 5);
				$arrNewsCat['name'][$key] = $menu_xml->readSection('cat', 'name');
				$arrNewsCat['desc'][$key] = $menu_xml->readSection('cat', 'desc');
				
				if(!$arrNewsCat['name'][$key]){ $arrNewsCat['name'][$key]  = ''; }
				if(!$arrNewsCat['desc'][$key]){ $arrNewsCat['desc'][$key]  = ''; }
				
				// CHARSETS
				$arrNewsCat['name'][$key] = $tcms_main->decodeText($arrNewsCat['name'][$key], '2', $c_charset);
				$arrNewsCat['desc'][$key] = $tcms_main->decodeText($arrNewsCat['desc'][$key], '2', $c_charset);
			}
		}
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->getAll($tcms_db_prefix.'news_categories');
	$count = 0;
	
	while($sqlObj = $sqlAL->fetchObject($sqlQR)){
		$arrNewsCat['tag'][$count]  = $sqlObj->uid;
		$arrNewsCat['name'][$count] = $sqlObj->name;
		$arrNewsCat['desc'][$count]   = $sqlObj->desc;
		
		if($arrNewsCat['name'][$count] == NULL){ $arrNewsCat['name'][$count]  = ''; }
		if($arrNewsCat['desc'][$count] == NULL){ $arrNewsCat['desc'][$count]  = ''; }
		
		// CHARSETS
		$arrNewsCat['name'][$count] = $tcms_main->decodeText($arrNewsCat['name'][$count], '2', $c_charset);
		$arrNewsCat['desc'][$count] = $tcms_main->decodeText($arrNewsCat['desc'][$count], '2', $c_charset);
		
		$count++;
	}
}










//***********************
// USER
//
if($choosenDB == 'xml'){
	$arr_userfiles = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_user/');
	
	$count = 0;
	
	if($tcms_main->isArray($arr_userfiles)){
		foreach($arr_userfiles as $key => $value){
			$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_user/'.$value,'r');
			$isEnabled = $menu_xml->readSection('user', 'enabled');
			
			if($isEnabled == 1){
				$arrActiveUser['tag'][$count]  = substr($value, 0, 32);
				$arrActiveUser['user'][$count] = $menu_xml->readSection('user', 'username');
				
				if($arrActiveUser['user'][$count] == false){ $arrActiveUser['user'][$count] = ''; }
				
				// CHARSETS
				$arrActiveUser['user'][$count] = $tcms_main->decodeText($arrActiveUser['user'][$count], '2', $c_charset);
				
				$count++;
			}
		}
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$strSQL = "SELECT * "
	."FROM ".$tcms_db_prefix."user "
	."WHERE enabled = 1";
	
	$sqlQR = $sqlAL->query($strSQL);
	
	$count = 0;
	
	while($sqlObj = $sqlAL->fetchObject($sqlQR)){
		$arrActiveUser['tag'][$count]  = $sqlObj->uid;
		$arrActiveUser['user'][$count] = $sqlObj->username;
		
		if($arrActiveUser['user'][$count] == NULL){ $arrActiveUser['user'][$count] = ''; }
		
		// CHARSETS
		$arrActiveUser['user'][$count] = $tcms_main->decodeText($arrActiveUser['user'][$count], '2', $c_charset);
		
		$count++;
	}
	
	$sqlAL->freeResult($sqlQR);
	$sqlAL->_sqlAbstractionLayer();
	unset($sqlAL);
}










//***********************
// FAQ VATEGORIES
//
if($site == 'mod_knowledgebase'){
	if($choosenDB == 'xml'){
		$count = 0;
		
		$arr_files = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_knowledgebase/');
		
		if($tcms_main->isArray($arr_files)){
			foreach($arr_files as $key => $value){
				if($value != 'index.html'){
					$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$value,'r');
					
					$checkType = $xml->readSection('faq', 'type');
					
					if($checkType == 'c'){
						$arrFAQCategories['title'][$count]  = $xml->readSection('faq', 'title');
						$arrFAQCategories['tag'][$count]    = substr($value, 0, 10);
						
						// CHARSETS
						$arrFAQCategories['title'][$count] = $tcms_main->decodeText($arrFAQCategories['title'][$count], '2', $c_charset);
						
						$count++;
					}
				}
			}
		}
		
		unset($arr_files);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		unset($sqlQR);
		
		switch($id_group){
			case 'Developer':
			case 'Administrator':
				$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
				break;
			
			case 'User':
			case 'Editor':
			case 'Presenter':
				$strAdd = " OR access = 'Protected' ) ";
				break;
			
			default:
				$strAdd = ' ) ';
				break;
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."knowledgebase "
		."WHERE type = 'c' "
		."AND ( access = 'Public' "
		.$strAdd
		."ORDER BY sort ASC, date ASC, title ASC";
		
		$sqlQR = $sqlAL->query($sqlSTR);
		
		$count = 0;
		unset($sqlARR);
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$arrFAQCategories['tag'][$count]   = $sqlObj->uid;
			$arrFAQCategories['title'][$count] = $sqlObj->title;
			
			if($arrFAQCategories['title'][$count] == NULL){ $arrFAQCategories['title'][$count] = ''; }
			
			// CHARSETS
			$arrFAQCategories['title'][$count] = $tcms_main->decodeText($arrFAQCategories['title'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->freeResult($sqlQR);
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
	}
}










//***********************
// DOWNLOAD VATEGORIES
//
if($site == 'mod_download'){
	if($choosenDB == 'xml'){
		$count = 0;
		
		$arr_files = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/files/');
		
		if($tcms_main->isArray($arr_files)){
			foreach($arr_files as $key => $value){
				if($value != 'index.html'){
					$xml = new xmlparser('../../'.$tcms_administer_site.'/files/'.$value.'/info.xml', 'r');
					
					$checkType = $xml->readSection('info', 'sql_type');
					
					if($checkType == 'd'){
						$checkAcc = $xml->readSection('info', 'access');
						
						
						/*
							access
						*/
						switch($id_group){
							case 'Developer':
							case 'Administrator':
								if($checkAcc == 'Public' || $checkAcc == 'Protected' || $checkAcc == 'Private')
									$showThis = true;
								else
									$showThis = false;
								break;
							
							case 'User':
							case 'Editor':
							case 'Presenter':
								if($checkAcc == 'Public' || $checkAcc == 'Protected')
									$showThis = true;
								else
									$showThis = false;
								break;
							
							default:
								if($checkAcc == 'Public')
									$showThis = true;
								else
									$showThis = false;
								break;
						}
						
						
						// show access
						if($showThis){
							$arrDownCategories['title'][$count]  = $xml->readSection('info', 'name');
							$arrDownCategories['tag'][$count]    = substr($value, 0, 10);
							
							// CHARSETS
							$arrDownCategories['title'][$count] = $tcms_main->decodeText($arrDownCategories['title'][$count], '2', $c_charset);
							
							$count++;
						}
					}
					
					$xml->flush();
					$xml->_xmlparser();
				}
			}
		}
		
		unset($arr_files);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		unset($sqlQR);
		
		switch($id_group){
			case 'Developer':
			case 'Administrator':
				$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
				break;
			
			case 'User':
			case 'Editor':
			case 'Presenter':
				$strAdd = " OR access = 'Protected' ) ";
				break;
			
			default:
				$strAdd = ' ) ';
				break;
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."downloads "
		."WHERE sql_type = 'd' "
		."AND ( access = 'Public' "
		.$strAdd
		."ORDER BY sort ASC, date ASC, name ASC";
		
		$sqlQR = $sqlAL->query($sqlSTR);
		
		$count = 0;
		unset($sqlARR);
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$arrDownCategories['tag'][$count]   = $sqlObj->uid;
			$arrDownCategories['title'][$count] = $sqlObj->name;
			
			if($arrDownCategories['title'][$count] == NULL){ $arrDownCategories['title'][$count] = ''; }
			
			// CHARSETS
			$arrDownCategories['title'][$count] = $tcms_main->decodeText($arrDownCategories['title'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->freeResult($sqlQR);
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
	}
}










//***********************
// PRODUCT CATEGORIES
//
if($site == 'mod_products'){
	if($choosenDB == 'xml'){
		/*$count = 0;
		
		$arr_files = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/files/');
		
		if($tcms_main->isArray($arr_files)){
			foreach($arr_files as $key => $value){
				if($value != 'index.html'){
					$xml = new xmlparser('../../'.$tcms_administer_site.'/files/'.$value.'/info.xml', 'r');
					
					$checkType = $xml->readSection('info', 'sql_type');
					
					if($checkType == 'd'){
						$checkAcc = $xml->readSection('info', 'access');
						
						
						// access
						switch($id_group){
							case 'Developer':
							case 'Administrator':
								if($checkAcc == 'Public' || $checkAcc == 'Protected' || $checkAcc == 'Private')
									$showThis = true;
								else
									$showThis = false;
								break;
							
							case 'User':
							case 'Editor':
							case 'Presenter':
								if($checkAcc == 'Public' || $checkAcc == 'Protected')
									$showThis = true;
								else
									$showThis = false;
								break;
							
							default:
								if($checkAcc == 'Public')
									$showThis = true;
								else
									$showThis = false;
								break;
						}
						
						
						// show access
						if($showThis){
							$arrDownCategories['title'][$count]  = $xml->readSection('info', 'name');
							$arrDownCategories['tag'][$count]    = substr($value, 0, 10);
							
							// CHARSETS
							$arrDownCategories['title'][$count] = $tcms_main->decodeText($arrDownCategories['title'][$count], '2', $c_charset);
							
							$count++;
						}
					}
					
					$xml->flush();
					$xml->_xmlparser();
				}
			}
		}
		
		unset($arr_files);*/
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		unset($sqlQR);
		
		switch($id_group){
			case 'Developer':
			case 'Administrator':
				$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
				break;
			
			case 'User':
			case 'Editor':
			case 'Presenter':
				$strAdd = " OR access = 'Protected' ) ";
				break;
			
			default:
				$strAdd = ' ) ';
				break;
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."products "
		."WHERE sql_type = 'c' "
		."AND ( access = 'Public' "
		.$strAdd
		."ORDER BY sort ASC, date ASC, name ASC";
		
		$sqlQR = $sqlAL->query($sqlSTR);
		
		$count = 0;
		unset($sqlARR);
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$arrProductCategories['tag'][$count]   = $sqlObj->uid;
			$arrProductCategories['title'][$count] = $sqlObj->name;
			
			if($arrProductCategories['title'][$count] == NULL){ $arrProductCategories['title'][$count] = ''; }
			
			// CHARSETS
			$arrProductCategories['title'][$count] = $tcms_main->decodeText($arrProductCategories['title'][$count], '2', $c_charset);
			
			$count++;
		}
		
		$sqlAL->freeResult($sqlQR);
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
	}
}

?>
