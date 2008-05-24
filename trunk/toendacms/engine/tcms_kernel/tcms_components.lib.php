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
| File:	tcms_components.lib.php
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
 * @version 0.3.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_cs
 *
 * <code>
 * 
 * Methods
 *
 * __construct()             -> Constructor
 * __destruct()              -> Destructor
 * 
 * getSettings               -> Loads the current settings from component
 * getSpecialSettings        -> Loads the special settingsfile
 * getAllSideCS              -> Loads all sidebar CS
 * getMainCS                 -> Loads the current mainpage CS
 * 
 * </code>
 *
 */

class tcms_cs extends tcms_main {
	private $tcms_main_path;
	private $tcms_image_path;
	private $tcms_db_prefix;
	private $tcms_admin_path;
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $administer
	 * @param String $imagePath
	 * @param Boolean $forAdmin = false
	 */
	public function __construct($administer, $imagePath, $forAdmin = false) {
		//global $tcms_main;
		
		$this->tcms_main_path = $administer;
		$this->tcms_image_path = $imagePath;
		
		if($forAdmin){
			$this->tcms_admin_path = '../../';
		}
		else{
			$this->tcms_admin_path = '';
		}
		
		parent::setAdministerSite($administer);
		//parent::__construct($administer, $tcmsTimeObj);
		//parent::setDatabaseInfo();
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	/**
	 * Loads the current settings from component
	 *
	 * @param String $item
	 * @return Array
	 */
	public function getSettings($item) {
		if(file_exists($this->tcms_main_path.'/components/'.$item.'/component.xml')){
			$csXML = new xmlparser($this->tcms_main_path.'/components/'.$item.'/component.xml','r');
			
			$arrCS['title']    = $csXML->readValue('title');
			$arrCS['subtitle'] = $csXML->readValue('subtitle');
			$arrCS['desc']     = $csXML->readValue('desc');
			$arrCS['id']       = $csXML->readValue('id');
			$arrCS['enabled']  = $csXML->readValue('enabled');
			$arrCS['mainCS']   = $csXML->readValue('mainCS');
			$arrCS['sideCS']   = $csXML->readValue('sideCS');
			$arrCS['sideSort'] = $csXML->readValue('sideSort');
			$arrCS['access']   = $csXML->readValue('access');
			$arrCS['folder']   = $csXML->readValue('folder');
			$arrCS['backend']  = $csXML->readValue('backendfile');
			$arrCS['frontend'] = $csXML->readValue('frontendfile');
			$arrCS['sidebar']  = $csXML->readValue('sidebarfile');
			$arrCS['settings'] = $csXML->readValue('settingsfile');
			
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
			$arrCS['title']    = $this->decodeText($arrCS['title'], '2', $c_charset);
			$arrCS['subtitle'] = $this->decodeText($arrCS['subtitle'], '2', $c_charset);
			$arrCS['desc']     = $this->decodeText($arrCS['desc'], '2', $c_charset);
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
	public function getSpecialSettings($item, $settingsfile, $current_cs_id) {
		//if(file_exists($this->tcms_admin_path.$this->tcms_main_path.'/components/'.$item.'/'.$settingsfile)){
		//	$csXML = new xmlparser($this->tcms_admin_path.$this->tcms_main_path.'/components/'.$item.'/'.$settingsfile, 'r');
		
		if(file_exists($this->tcms_main_path.'/components/'.$item.'/'.$settingsfile)){
			$csXML = new xmlparser($this->tcms_main_path.'/components/'.$item.'/'.$settingsfile, 'r');
			
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
	 * @param Integer $isAdmin
	 * @return Array
	 */
	public function getAllSideCS($isAdmin) {
		include_once($this->tcms_main_path.'/../engine/tcms_kernel/tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		$i = 0;
		$arrCSFiles = $tcms_file->getPathContent($this->tcms_main_path.'/components/');
		
		if(is_array($arrCSFiles)){
			foreach($arrCSFiles as $key => $val){
				if($val != 'CVS'
				&& $val != 'index.html'
				&& $val != '.svn'
				&& $val != '_svn'
				&& $val != '.SVN'
				&& $val != '_SVN') {
					$csXML = new xmlparser($this->tcms_main_path.'/components/'.$val.'/component.xml','r');
					$checkCS = $csXML->readValue('sideCS');
					
					if($checkCS == 1){
						$csEnabled = $csXML->readValue('enabled');
						
						if($csEnabled == 1){
							$csAccess = $csXML->readValue('access');
							
							$csAcs = $this->checkAccess($csAccess, $isAdmin);
							
							if($csAcs){
								$cs_sort     = $csXML->readValue('sideSort');
								$cs_folder   = $csXML->readValue('folder');
								$cs_id       = $csXML->readValue('id');
								$cs_file     = $csXML->readValue('sidebarfile');
								$cs_settings = $csXML->readValue('settingsfile');
								
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
		
		if($this->isArray($arrSideCS)){
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
	 * @param Integer $isAdmin
	 * @return Array
	 */
	public function getMainCS($item, $isAdmin) {
		include_once($this->tcms_main_path.'/../engine/tcms_kernel/tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		$arrCSFiles = $tcms_file->getPathContent($this->tcms_main_path.'/components/');
		
		if(is_array($arrCSFiles)){
			foreach($arrCSFiles as $key => $val){
				if($val != 'CVS'
				&& $val != 'index.html'
				&& $val != '.svn'
				&& $val != '_svn'
				&& $val != '.SVN'
				&& $val != '_SVN') {
					$csXML = new xmlparser($this->tcms_main_path.'/components/'.$val.'/component.xml','r');
					$checkCS = $csXML->readValue('id');
					
					if($checkCS == $item){
						$csMainCS = $csXML->readValue('mainCS');
						
						if(trim($csMainCS) == 1){
							$csEnabled = $csXML->readValue('enabled');
							
							if($csEnabled == 1){
								$csAccess = $csXML->readValue('access');
								
								$csAcs = $this->checkAccess($csAccess, $isAdmin);
								
								if($csAcs){
									$cs_folder   = $csXML->readValue('folder');
									$cs_id       = $csXML->readValue('id');
									$cs_file     = $csXML->readValue('frontendfile');
									$cs_settings = $csXML->readValue('settingsfile');
									
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
