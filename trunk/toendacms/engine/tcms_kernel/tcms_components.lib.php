<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS CS - Components System Classes
| 
| File:		tcms_components.lib.php
| Version:	0.2.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS CS - Components System
 *
 * This class is used for the components system API.
 * It can loads all the settings for a components, provide
 * a complete API with toendaCMS constants and can load the
 * component itself.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_cs
 *
 * <code>
 * 
 * Methods
 *
 * __construct()             -> PHP5 Constructor
 * tcms_seo()                -> PHP4 Constructor
 * __destruct()              -> PHP5 Destructor
 * _tcms_seo                 -> PHP4 Destructor
 * getSettings               -> Loads the current settings from component
 * getSpecialSettings        -> Loads the special settingsfile
 * getAllSideCS              -> Loads all sidebar CS
 * getMainCS                 -> Loads the current mainpage CS
 * 
 * </code>
 *
 */

class tcms_cs {
	var $tcms_main_path;
	var $tcms_image_path;
	var $tcms_db_prefix;
	var $tcms_admin_path;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $administer
	 * @param String $imagePath
	 * @param Boolean $forAdmin = false
	 */
	function __construct($administer, $imagePath, $forAdmin = false){
		global $tcms_main;
		
		$this->tcms_main_path = $administer;
		$this->tcms_image_path = $imagePath;
		
		if($forAdmin){
			$this->tcms_admin_path = '../../';
		}
		else{
			$this->tcms_admin_path = '';
		}
		
		//require($administer.'/tcms_global/database.php');
		//$this->tcms_db_prefix = $tcms_main->secure_password($tcms_db_prefix, 'en');
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $administer
	 * @param String $imagePath
	 * @param Boolean $forAdmin = false
	 */
	function tcms_cs($administer, $imagePath, $forAdmin = false){
		$this->__construct($administer, $imagePath, $forAdmin);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_main(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Loads the current settings from component
	 *
	 * @param String $item
	 * @return Array
	 */
	function getSettings($item){
		global $tcms_main;
		
		if(file_exists($this->tcms_main_path.'/components/'.$item.'/component.xml')){
			$csXML = new xmlparser($this->tcms_main_path.'/components/'.$item.'/component.xml','r');
			
			$arrCS['title']    = $csXML->read_value('title');
			$arrCS['subtitle'] = $csXML->read_value('subtitle');
			$arrCS['desc']     = $csXML->read_value('desc');
			$arrCS['id']       = $csXML->read_value('id');
			$arrCS['enabled']  = $csXML->read_value('enabled');
			$arrCS['mainCS']   = $csXML->read_value('mainCS');
			$arrCS['sideCS']   = $csXML->read_value('sideCS');
			$arrCS['sideSort'] = $csXML->read_value('sideSort');
			$arrCS['access']   = $csXML->read_value('access');
			$arrCS['folder']   = $csXML->read_value('folder');
			$arrCS['backend']  = $csXML->read_value('backendfile');
			$arrCS['frontend'] = $csXML->read_value('frontendfile');
			$arrCS['sidebar']  = $csXML->read_value('sidebarfile');
			$arrCS['settings'] = $csXML->read_value('settingsfile');
			
			if($arrCS['title']    == false){ $arrCS['title']    = ''; }
			if($arrCS['subtitle'] == false){ $arrCS['subtitle'] = ''; }
			if($arrCS['desc']     == false){ $arrCS['desc']     = ''; }
			if($arrCS['id']       == false){ $arrCS['id']       = ''; }
			if($arrCS['enabled']  == false){ $arrCS['enabled']  = ''; }
			if($arrCS['mainCS']   == false){ $arrCS['mainCS']   = ''; }
			if($arrCS['sideCS']   == false){ $arrCS['sideCS']   = ''; }
			if($arrCS['sideSort'] == false){ $arrCS['sideSort'] = ''; }
			if($arrCS['access']   == false){ $arrCS['access']   = ''; }
			if($arrCS['folder']   == false){ $arrCS['folder']   = ''; }
			if($arrCS['backend']  == false){ $arrCS['backend']  = ''; }
			if($arrCS['frontend'] == false){ $arrCS['frontend'] = ''; }
			if($arrCS['sidebar']  == false){ $arrCS['sidebar']  = ''; }
			if($arrCS['settings'] == false){ $arrCS['settings'] = ''; }
			
			// CHARSETS
			$arrCS['title']    = $tcms_main->decode_text($arrCS['title'], '2', $c_charset);
			$arrCS['subtitle'] = $tcms_main->decode_text($arrCS['subtitle'], '2', $c_charset);
			$arrCS['desc']     = $tcms_main->decode_text($arrCS['desc'], '2', $c_charset);
		}
		else{
			$arrCS = false;
		}
		
		return $arrCS;
	}
	
	
	
	/**
	 * Loads the special settingsfile
	 *
	 * @param String $item
	 * @param String $settingsfile
	 * @param String $current_cs_id
	 * @return Array
	 */
	function getSpecialSettings($item, $settingsfile, $current_cs_id){
		global $tcms_main;
		
		if(file_exists($this->tcms_admin_path.$this->tcms_main_path.'/components/'.$item.'/'.$settingsfile)){
			$csXML = new xmlparser($this->tcms_admin_path.$this->tcms_main_path.'/components/'.$item.'/'.$settingsfile, 'r');
			
			$xmlFileStructure = $csXML->xml_to_array();
			
			foreach($xmlFileStructure[0]['children'] as $xmlKey => $xmlVal){
				//echo $xmlKey.' -> '.$xmlVal['name'].'<br />';
				//echo $xmlKey.' -> '.$tcms_main->paf($xmlVal['attribute']).'<br />';
				//echo $xmlKey.' -> '.$xmlVal['data'].'<br />';
				
				$arrCSSettings[$current_cs_id]['content'][strtolower($xmlVal['name'])]   = $xmlVal['data'];
				$arrCSSettings[$current_cs_id]['attribute'][strtolower($xmlVal['name'])] = $xmlVal['attribute'];
			}
			
			return $arrCSSettings;
		}
		else{
			return false;
		}
	}
	
	
	
	/**
	 * Loads all sidebar CS
	 *
	 * @return Array
	 */
	function getAllSideCS(){
		global $tcms_main;
		global $is_admin;
		
		$i = 0;
		$arrCSFiles = $tcms_main->readdir_ext($this->tcms_main_path.'/components/');
		
		if(is_array($arrCSFiles)){
			foreach($arrCSFiles as $key => $val){
				if($val != 'CVS'
				&& $val != 'index.html'
				&& $val != '.svn'
				&& $val != '_svn'
				&& $val != '.SVN'
				&& $val != '_SVN') {
					$csXML = new xmlparser($this->tcms_main_path.'/components/'.$val.'/component.xml','r');
					$checkCS = $csXML->read_value('sideCS');
					
					if($checkCS == 1){
						$csEnabled = $csXML->read_value('enabled');
						
						if($csEnabled == 1){
							$csAccess = $csXML->read_value('access');
							
							$csAcs = $tcms_main->checkAccess($csAccess, $is_admin);
							
							if($csAcs){
								$cs_sort     = $csXML->read_value('sideSort');
								$cs_folder   = $csXML->read_value('folder');
								$cs_id       = $csXML->read_value('id');
								$cs_file     = $csXML->read_value('sidebarfile');
								$cs_settings = $csXML->read_value('settingsfile');
								
								$arrSideCS['sort'][$i]     = $cs_sort;
								$arrSideCS['folder'][$i]   = $cs_folder;
								$arrSideCS['id'][$i]       = $cs_id;
								$arrSideCS['file'][$i]     = $cs_file;
								$arrSideCS['settings'][$i] = $cs_settings;
								$arrSideCS['path'][$i]     = $this->tcms_admin_path.$this->tcms_main_path.'/components/'.$cs_folder;
								
								$i++;
							}
						}
					}
				}
			}
		}
		
		if(is_array($arrSideCS)){
			array_multisort(
				$arrSideCS['sort'], SORT_ASC, 
				$arrSideCS['folder'], SORT_ASC, 
				$arrSideCS['id'], SORT_ASC, 
				$arrSideCS['file'], SORT_ASC, 
				$arrSideCS['settings'], SORT_ASC, 
				$arrSideCS['path'], SORT_ASC
			);
		}
		
		return $arrSideCS;
	}
	
	
	
	/**
	 * Loads the current mainpage CS
	 *
	 * @param String $item
	 * @return Array
	 */
	function getMainCS($item){
		global $tcms_main;
		global $is_admin;
		
		$arrCSFiles = $tcms_main->readdir_ext($this->tcms_main_path.'/components/');
		
		if(is_array($arrCSFiles)){
			foreach($arrCSFiles as $key => $val){
				if($val != 'CVS'
				&& $val != 'index.html'
				&& $val != '.svn'
				&& $val != '_svn'
				&& $val != '.SVN'
				&& $val != '_SVN') {
					$csXML = new xmlparser($this->tcms_main_path.'/components/'.$val.'/component.xml','r');
					$checkCS = $csXML->read_value('id');
					
					if($checkCS == $item){
						$csMainCS = $csXML->read_value('mainCS');
						
						if(trim($csMainCS) == 1){
							$csEnabled = $csXML->read_value('enabled');
							
							if($csEnabled == 1){
								$csAccess = $csXML->read_value('access');
								
								$csAcs = $tcms_main->checkAccess($csAccess, $is_admin);
								
								if($csAcs){
									$cs_folder   = $csXML->read_value('folder');
									$cs_id       = $csXML->read_value('id');
									$cs_file     = $csXML->read_value('frontendfile');
									$cs_settings = $csXML->read_value('settingsfile');
									
									$arrMainCS['folder']   = $cs_folder;
									$arrMainCS['id']       = $cs_id;
									$arrMainCS['file']     = $cs_file;
									$arrMainCS['settings'] = $cs_settings;
									$arrMainCS['path']     = $this->tcms_admin_path.$this->tcms_main_path.'/components/'.$cs_folder;
								}
								else{
									$arrMainCS['id'] = '_TCMS_COMPONENT_DISABLED_';
								}
							}
							else{
								$arrMainCS['id'] = '_TCMS_COMPONENT_DISABLED_';
							}
						}
						else{
							$arrMainCS['id'] = '_TCMS_COMPONENT_DISABLED_';
						}
						
						break;
					}
				}
			}
		}
		
		return $arrMainCS;
	}
}

?>
