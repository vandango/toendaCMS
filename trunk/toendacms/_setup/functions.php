<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Functions
|
| File:	functions.php
|
+
*/


/**
 * Functions
 *
 * This file is used for some needed functions.
 *
 * @version 0.1.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


function getBuild(){
	$xml = new xmlparser('setup/tcms_version.xml', 'r');
	return $xml->read_section('version', 'build');
}

function getVersion(){
	$xml = new xmlparser('setup/tcms_version.xml', 'r');
	return $xml->read_section('version', 'release');
}

function getPHPSetting($val){
	$r = (ini_get($val) == '1' ? 1 : 0);
	return $r ? '<span style="font-weight: bold; color: red; text-decoration: underline;">ON</span>' : '<span style="font-weight: bold; color: green;">OFF</span>';
}

function getOS($osString){
	$osString = trim(strtolower($osString));
	
	switch($osString){
		case 'windows nt 5.0': $returnOS = 'Microsoft Windows 2000'; break;
		case 'windows nt 5.1': $returnOS = 'Microsoft Windows XP'; break;
		case 'windows nt 5.2': $returnOS = 'Microsoft Windows 2003'; break;
		case 'windows nt 6.0': $returnOS = 'Microsoft Windows Vista'; break;
		case 'windows nt': $returnOS = 'Microsoft Windows NT'; break;
		case 'winnt': $returnOS = 'Microsoft Windows NT'; break;
		case 'winnt 4.0': $returnOS = 'Microsoft Windows NT 4.0'; break;
		case 'winnt4.0': $returnOS = 'Microsoft Windows NT 4.0'; break;
		case 'windows 98': $returnOS = 'Microsoft Windows 98'; break;
		case 'win98': $returnOS = 'Microsoft Windows 98'; break;
		case 'windows 95': $returnOS = 'Microsoft Windows 95'; break;
		case 'win95': $returnOS = 'Microsoft Windows 95'; break;
		case 'sunos': $returnOS = 'Sun Solaris'; break;
		case 'freebsd': $returnOS = 'FreeBSD'; break;
		case 'ppc': $returnOS = 'Macintosh'; break;
		case 'mac os x': $returnOS = 'Mac OS X'; break;
		case 'linux': $returnOS = 'Linux'; break;
		case 'debian': $returnOS = 'Debian'; break;
		case 'beos': $returnOS = 'BeOS'; break;
		case 'apachebench': $returnOS = 'ApacheBench'; break;
		case 'aix': $returnOS = 'AIX'; break;
		case 'irix': $returnOS = 'Irix'; break;
		case 'osf': $returnOS = 'DEC OSF'; break;
		case 'hp-ux': $returnOS = 'HP-UX'; break;
		case 'netbsd': $returnOS = 'NetBSD'; break;
		case 'bsdi': $returnOS = 'BSDi'; break;
		case 'openbsd': $returnOS = 'OpenBSD'; break;
		case 'gnu': $returnOS = 'GNU/Linux'; break;
		case 'unix': $returnOS = 'Unknown Unix system'; break;
		default: $returnOS = 'Undefinied'; break;
	}
	
	return $returnOS;
}

/**
 * Update the xml files for the selected language
 *
 */
function updateLanguageForXML() {
	global $tcms_main;
	global $tcms_file;
	
	// update to new multi-language
	$layout_xml = new xmlparser(_TCMS_PATH.'/tcms_global/var.xml','r');
	$plang = $layout_xml->read_value('front_lang');
	
	// update setting files
	
	// contactform
	if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/frontpage.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/frontpage.xml', 
			_TCMS_PATH.'/tcms_global/frontpage.'.$plang.'.xml'
		);
	}
	
	// contactform
	if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/newsmanager.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/newsmanager.xml', 
			_TCMS_PATH.'/tcms_global/newsmanager.'.$plang.'.xml'
		);
	}
	
	// guestbook
	if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/guestbook.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/guestbook.xml', 
			_TCMS_PATH.'/tcms_global/guestbook.'.$plang.'.xml'
		);
	}
	
	// contactform
	if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/contactform.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/contactform.xml', 
			_TCMS_PATH.'/tcms_global/contactform.'.$plang.'.xml'
		);
	}
	
	// imprint
	if($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/impressum.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/impressum.xml', 
			_TCMS_PATH.'/tcms_global/imprint.'.$plang.'.xml'
		);
	}
	elseif($tcms_file->checkFileExist(_TCMS_PATH.'/tcms_global/imprint.xml')) {
		rename(
			_TCMS_PATH.'/tcms_global/imprint.xml', 
			_TCMS_PATH.'/tcms_global/imprint.'.$plang.'.xml'
		);
	}
	
	// update news
	unset($arr_news);
	$arr_news = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_news/');
	
	foreach($arr_news as $key => $val) {
		$xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.$val, 'r');
		
		// save news with language
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_news/tmp_'.$val, 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('news');
		
		$xmluser->write_value('title', $xml->read_section('news', 'title'));
		$xmluser->write_value('autor', $xml->read_section('news', 'autor'));
		$xmluser->write_value('date', $xml->read_section('news', 'date'));
		$xmluser->write_value('time', $xml->read_section('news', 'time'));
		$xmluser->write_value('newstext', $xml->read_section('news', 'newstext'));
		$xmluser->write_value('order', $xml->read_section('news', 'order'));
		$xmluser->write_value('stamp', $xml->read_section('news', 'stamp'));
		$xmluser->write_value('published', $xml->read_section('news', 'published'));
		$xmluser->write_value('publish_date', $xml->read_section('news', 'publish_date'));
		$xmluser->write_value('comments_enabled', $xml->read_section('news', 'comments_enabled'));
		$xmluser->write_value('image', $xml->read_section('news', 'image'));
		$xmluser->write_value('category', $xml->read_section('news', 'category'));
		$xmluser->write_value('access', $xml->read_section('news', 'access'));
		$xmluser->write_value('show_on_frontpage', 1);
		$xmluser->write_value('language', $plang);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('news');
		unset($xmluser);
		
		$xml->flush();
		unset($xml);
		
		// delete sourcefile and rename temp file
		unlink(_TCMS_PATH.'/tcms_news/'.$val);
		
		rename(
			_TCMS_PATH.'/tcms_news/tmp_'.$val, 
			_TCMS_PATH.'/tcms_news/'.$val
		);
	}
	
	// update sidemenu items
	unset($arr_news);
	$arr_news = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
	
	foreach($arr_news as $key => $val) {
		$xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$val, 'r');
		
		// save sidemenu item with language
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_menu/tmp_'.$val, 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('menu');
		
		$xmluser->write_value('name', $xml->read_section('menu', 'name'));
		$xmluser->write_value('id', $xml->read_section('menu', 'id'));
		$xmluser->write_value('subid', $xml->read_section('menu', 'subid'));
		$xmluser->write_value('type', $xml->read_section('menu', 'type'));
		$xmluser->write_value('parent', $xml->read_section('menu', 'parent'));
		$xmluser->write_value('link', $xml->read_section('menu', 'link'));
		$xmluser->write_value('published', $xml->read_section('menu', 'published'));
		$xmluser->write_value('access', $xml->read_section('menu', 'access'));
		$xmluser->write_value('target', '');
		$xmluser->write_value('language', $plang);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('menu');
		unset($xmluser);
		
		$xml->flush();
		unset($xml);
		
		// delete sourcefile and rename temp file
		unlink(_TCMS_PATH.'/tcms_menu/'.$val);
		
		rename(
			_TCMS_PATH.'/tcms_menu/tmp_'.$val, 
			_TCMS_PATH.'/tcms_menu/'.$val
		);
	}
	
	// update topmenu items
	unset($arr_news);
	$arr_news = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_topmenu/');
	
	foreach($arr_news as $key => $val) {
		$xml = new xmlparser(_TCMS_PATH.'/tcms_topmenu/'.$val, 'r');
		
		// save sidemenu item with language
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_topmenu/tmp_'.$val, 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('menu');
		
		$xmluser->write_value('name', $xml->read_section('top', 'name'));
		$xmluser->write_value('id', $xml->read_section('top', 'id'));
		$xmluser->write_value('type', $xml->read_section('top', 'type'));
		$xmluser->write_value('link', $xml->read_section('top', 'link'));
		$xmluser->write_value('published', $xml->read_section('top', 'published'));
		$xmluser->write_value('access', $xml->read_section('top', 'access'));
		$xmluser->write_value('target', '');
		$xmluser->write_value('language', $plang);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('menu');
		unset($xmluser);
		
		$xml->flush();
		unset($xml);
		
		// delete sourcefile and rename temp file
		unlink(_TCMS_PATH.'/tcms_topmenu/'.$val);
		
		rename(
			_TCMS_PATH.'/tcms_topmenu/tmp_'.$val, 
			_TCMS_PATH.'/tcms_topmenu/'.$val
		);
	}
}


?>
