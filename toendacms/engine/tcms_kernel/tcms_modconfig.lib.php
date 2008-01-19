<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Load Modules Configuration
|
| File:	tcms_modconfig.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Load Modules Configuration
 *
 * This class is used to load teh mocule condiguration
 *
 * @version 0.7.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 *
 * Methods
 *
 * __construct                -> Constructor
 * __destruct                 -> Destructor
 * 
 * tcms_modconfig             -> toendaCMS webpage path
 * getDownloadConfig          -> Return a array with all download configuration data
 * getGuestbookConfig         -> Return a array with all guestbook configuration data
 * getLinkConfig              -> Return a array with all link configuration data
 * getFAQConfig               -> Return a array with all FAQ configuration data
 *
 * </code>
 *
 */


class tcms_modconfig {
	var $tcms_main_path;
	var $tcms_image_path;
	var $tcms_db_prefix;
	
	
	
	
	
	/**
	 * Ctor
	 *
	 * @param unknown_type $administer
	 * @param unknown_type $imagePath
	 */
	function __construct($administer, $imagePath){
		global $tcms_main;
		
		$this->tcms_main_path = $administer;
		$this->tcms_image_path = $imagePath;
		
		require($administer.'/tcms_global/database.php');
		$this->tcms_db_prefix = $tcms_db_prefix;
	}
	
	
	
	
	
	/***
	* @return Return a array with all download configuration data
	* @desc ...
	*/
	function getDownloadConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort){
		global $tcms_main;
		
		if($choosenDB == 'xml'){
			$down_xml     = new xmlparser(''.$this->tcms_main_path.'/tcms_global/download.xml','r');
			
			$arrDW['download_id']    = $down_xml->read_section('config', 'download_id');
			$arrDW['download_title'] = $down_xml->read_section('config', 'download_title');
			$arrDW['download_stamp'] = $down_xml->read_section('config', 'download_stamp');
			$arrDW['download_text']  = $down_xml->read_section('config', 'download_text');
			
			if(!$arrDW['download_id'])   { $arrDW['download_id']    = ''; }
			if(!$arrDW['download_title']){ $arrDW['download_title'] = ''; }
			if(!$arrDW['download_stamp']){ $arrDW['download_stamp'] = ''; }
			if(!$arrDW['download_text']) { $arrDW['download_text']  = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT download_title, download_stamp, download_text "
			."FROM ".$this->tcms_db_prefix."downloads_config "
			."WHERE uid = 'download'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$arrDW['download_id']    = 'download';
			$arrDW['download_title'] = $sqlARR['download_title'];
			$arrDW['download_stamp'] = $sqlARR['download_stamp'];
			$arrDW['download_text']  = $sqlARR['download_text'];
			
			if($arrDW['download_id']    == NULL){ $arrDW['download_id']    = ''; }
			if($arrDW['download_title'] == NULL){ $arrDW['download_title'] = ''; }
			if($arrDW['download_stamp'] == NULL){ $arrDW['download_stamp'] = ''; }
			if($arrDW['download_text']  == NULL){ $arrDW['download_text']  = ''; }
		}
		
		$arrDW['download_title'] = $tcms_main->decodeText($arrDW['download_title'], '2', $c_charset);
		$arrDW['download_stamp'] = $tcms_main->decodeText($arrDW['download_stamp'], '2', $c_charset);
		$arrDW['download_text']  = $tcms_main->decodeText($arrDW['download_text'], '2', $c_charset);
		
		return $arrDW;
	}
	
	
	
	
	
	/***
	* @return Return a array with all newsmanager configuration data
	* @desc ...
	*/
	function getGuestbookConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort){
		global $tcms_main;
		
		if($choosenDB == 'xml'){
			$gbxml = new xmlparser(''.$this->tcms_main_path.'/tcms_global/guestbook.xml','r');
			
			$arrGB['guest_id']  = $gbxml->read_section('config', 'guest_id');
			$arrGB['booktitle'] = $gbxml->read_section('config', 'booktitle');
			$arrGB['bookstamp'] = $gbxml->read_section('config', 'bookstamp');
			$arrGB['access']    = $gbxml->read_section('config', 'access');
			$arrGB['enabled']   = $gbxml->read_section('config', 'enabled');
			
			if(!$arrGB['guest_id']) { $arrGB['guest_id']  = ''; }
			if(!$arrGB['booktitle']){ $arrGB['booktitle'] = ''; }
			if(!$arrGB['bookstamp']){ $arrGB['bookstamp'] = ''; }
			if(!$arrGB['access'])   { $arrGB['access']    = ''; }
			if(!$arrGB['enabled'])  { $arrGB['enabled']   = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT booktitle, bookstamp, access, enabled "
			."FROM ".$this->tcms_db_prefix."guestbook "
			."WHERE uid = 'guestbook'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$arrGB['guest_id']  = 'guestbook';
			$arrGB['booktitle'] = $sqlARR['booktitle'];
			$arrGB['bookstamp'] = $sqlARR['bookstamp'];
			$arrGB['access']    = $sqlARR['access'];
			$arrGB['enabled']   = $sqlARR['enabled'];
			
			if($arrGB['guest_id']  == NULL){ $arrGB['guest_id']  = ''; }
			if($arrGB['booktitle'] == NULL){ $arrGB['booktitle'] = ''; }
			if($arrGB['bookstamp'] == NULL){ $arrGB['bookstamp'] = ''; }
			if($arrGB['access']    == NULL){ $arrGB['access']    = ''; }
			if($arrGB['enabled']   == NULL){ $arrGB['enabled']   = ''; }
		}
		
		$arrGB['booktitle'] = $tcms_main->decodeText($arrGB['booktitle'], '2', $c_charset);
		$arrGB['bookstamp'] = $tcms_main->decodeText($arrGB['bookstamp'], '2', $c_charset);
		
		return $arrGB;
	}
	
	
	
	
	
	/***
	* @return Return a array with all link configuration data
	* @desc ...
	*/
	function getLinkConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort){
		global $tcms_main;
		
		if($choosenDB == 'xml'){
			$pro_xml = new xmlparser(''.$this->tcms_main_path.'/tcms_global/linkmanager.xml','r');
			
			$arrL['link_title']    = $pro_xml->read_section('config', 'link_main_title');
			$arrL['link_subtitle'] = $pro_xml->read_section('config', 'link_main_subtitle');
			$arrL['link_text']     = $pro_xml->read_section('config', 'link_main_text');
			$arrL['link_use_desc'] = $pro_xml->read_section('config', 'link_use_main_desc');
			$arrL['access']        = $pro_xml->read_section('config', 'link_main_access');
			
			if(!$arrL['link_id'])      { $arrL['link_id']       = ''; }
			if(!$arrL['link_title'])   { $arrL['link_title']    = ''; }
			if(!$arrL['link_subtitle']){ $arrL['link_subtitle'] = ''; }
			if(!$arrL['link_text'])    { $arrL['link_text']     = ''; }
			if(!$arrL['link_use_desc']){ $arrL['link_use_desc'] = ''; }
			if(!$arrL['access'])       { $arrL['access']        = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT link_main_title, link_main_subtitle, link_main_text, link_use_main_desc, "
			."link_main_access "
			."FROM ".$this->tcms_db_prefix."links_config "
			."WHERE uid = 'links_config_main'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$arrL['link_title']    = $sqlARR['link_main_title'];
			$arrL['link_subtitle'] = $sqlARR['link_main_subtitle'];
			$arrL['link_text']     = $sqlARR['link_main_text'];
			$arrL['link_use_desc'] = $sqlARR['link_use_main_desc'];
			$arrL['access']        = $sqlARR['link_main_access'];
			
			if($arrL['link_title']    == NULL){ $arrL['link_title']    = ''; }
			if($arrL['link_subtitle'] == NULL){ $arrL['link_subtitle'] = ''; }
			if($arrL['link_text']     == NULL){ $arrL['link_text']     = ''; }
			if($arrL['link_use_desc'] == NULL){ $arrL['link_use_desc'] = ''; }
			if($arrL['access']        == NULL){ $arrL['access']        = ''; }
		}
		
		$arrL['link_title']    = $tcms_main->decodeText($arrL['link_title'], '2', $c_charset);
		$arrL['link_subtitle'] = $tcms_main->decodeText($arrL['link_subtitle'], '2', $c_charset);
		$arrL['link_text']     = $tcms_main->decodeText($arrL['link_text'], '2', $c_charset);
		
		return $arrL;
	}
	
	
	
	
	
	/***
	* @return Return a array with all link configuration data
	* @desc ...
	*/
	function getFAQConfig($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort){
		global $tcms_main;
		
		if($choosenDB == 'xml'){
			$pro_xml = new xmlparser(''.$this->tcms_main_path.'/tcms_global/knowledgebase.xml','r');
			
			$arrFAQ['faq_uid']       = 'knowledgebase';
			$arrFAQ['faq_title']     = $pro_xml->read_section('config', 'title');
			$arrFAQ['faq_subtitle']  = $pro_xml->read_section('config', 'subtitle');
			$arrFAQ['faq_text']      = $pro_xml->read_section('config', 'text');
			$arrFAQ['faq_enabled']   = $pro_xml->read_section('config', 'enabled');
			$arrFAQ['faq_a_enabled'] = $pro_xml->read_section('config', 'autor_enabled');
			$arrFAQ['access']        = $pro_xml->read_section('config', 'access');
			
			if($arrFAQ['faq_uid']       == false){ $arrFAQ['faq_uid']       = ''; }
			if($arrFAQ['faq_title']     == false){ $arrFAQ['faq_title']     = ''; }
			if($arrFAQ['faq_subtitle']  == false){ $arrFAQ['faq_subtitle']  = ''; }
			if($arrFAQ['faq_text']      == false){ $arrFAQ['faq_text']      = ''; }
			if($arrFAQ['faq_enabled']   == false){ $arrFAQ['faq_enabled']   = ''; }
			if($arrFAQ['faq_a_enabled'] == false){ $arrFAQ['faq_a_enabled'] = ''; }
			if($arrFAQ['access']        == false){ $arrFAQ['access']        = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT uid, title, subtitle, text, "
			."enabled, autor_enabled, access "
			."FROM ".$this->tcms_db_prefix."knowledgebase_config "
			."WHERE uid = 'knowledgebase'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$arrFAQ['faq_uid']       = 'knowledgebase';
			$arrFAQ['faq_title']     = $sqlARR['title'];
			$arrFAQ['faq_subtitle']  = $sqlARR['subtitle'];
			$arrFAQ['faq_text']      = $sqlARR['text'];
			$arrFAQ['faq_enabled']   = $sqlARR['enabled'];
			$arrFAQ['faq_a_enabled'] = $sqlARR['autor_enabled'];
			$arrFAQ['access']        = $sqlARR['access'];
			
			if($arrFAQ['faq_uid']       == NULL){ $arrFAQ['faq_uid']       = ''; }
			if($arrFAQ['faq_title']     == NULL){ $arrFAQ['faq_title']     = ''; }
			if($arrFAQ['faq_subtitle']  == NULL){ $arrFAQ['faq_subtitle']  = ''; }
			if($arrFAQ['faq_text']      == NULL){ $arrFAQ['faq_text']      = ''; }
			if($arrFAQ['faq_enabled']   == NULL){ $arrFAQ['faq_enabled']   = ''; }
			if($arrFAQ['faq_a_enabled'] == NULL){ $arrFAQ['faq_a_enabled'] = ''; }
			if($arrFAQ['access']        == NULL){ $arrFAQ['access']        = ''; }
		}
		
		$arrFAQ['faq_title']    = $tcms_main->decodeText($arrFAQ['faq_title'], '2', $c_charset);
		$arrFAQ['faq_subtitle'] = $tcms_main->decodeText($arrFAQ['faq_subtitle'], '2', $c_charset);
		$arrFAQ['faq_text']     = $tcms_main->decodeText($arrFAQ['faq_text'], '2', $c_charset);
		
		return $arrFAQ;
	}
}

?>
