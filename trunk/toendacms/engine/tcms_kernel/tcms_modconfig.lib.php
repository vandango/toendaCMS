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
 * 
 * getLinkConfig              -> Return a array with all link configuration data
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
}

?>
