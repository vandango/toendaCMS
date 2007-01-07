<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Menu Provider
|
| File:		tcms_menu_provider.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sidemenu Item DataContainer
 *
 * This class is used as a provider for sidemenu datacontainer
 * objects.
 *
 * @version 0.1.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * TCMS Menu methods
 *
 * __construct()                           -> PHP5 Constructor
 * tcms_menu_provider()                    -> PHP4 Constructor
 *
 * _checkIDByLink                          -> Check a menuitem by link
 * _getIDByLink                            -> Get a menuitem by link
 * getSidemenu                             -> Get a array of menu items
 * 
 * </code>
 *
 */


class tcms_menu_provider extends tcms_main {
	// global informaton
	var $m_CHARSET;
	var $m_path;
	var $m_IsAdmin;
	
	// database information
	var $m_choosenDB;
	var $m_sqlUser;
	var $m_sqlPass;
	var $m_sqlHost;
	var $m_sqlDB;
	var $m_sqlPort;
	var $m_sqlPrefix;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $tcms_administer_path = 'data'
	 * @param String $charset
	 * @param String $isAdmin
	 */
	function __construct($tcms_administer_path = 'data', $charset, $isAdmin){
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->administer = $tcms_administer_path;
		$this->m_IsAdmin = $isAdmin;
		
		//echo 'pfad: '.$this->m_path.' ---> '.$tcms_administer_path.' ---> '.$this->administer.'<br>';
		
		if(file_exists($this->m_path.'/tcms_global/database.php')){
			require($this->m_path.'/tcms_global/database.php');
			
			$this->m_choosenDB = $tcms_db_engine;
			$this->m_sqlUser   = $tcms_db_user;
			$this->m_sqlPass   = $tcms_db_password;
			$this->m_sqlHost   = $tcms_db_host;
			$this->m_sqlDB     = $tcms_db_database;
			$this->m_sqlPort   = $tcms_db_port;
			$this->m_sqlPrefix = $tcms_db_prefix;
		}
		else{
			$this->m_choosenDB = 'xml';
		}
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_menu_provider($tcms_administer_path = 'data', $charset, $isAdmin){
		$this->__construct($tcms_administer_path, $charset, $isAdmin);
	}
	
	
	
	/**
	 * [PRIVATE] Check the parent id of a item
	 *
	 * @param String $id
	 * @param String $root
	 * @param Integer $level = 0
	 * @param Integer $item_id
	 * @return String
	 */
	function _checkIDByLink($id, $root, $level = 0, $item_id){
		//$menuItem = new tcms_dc_sidemenuitem();
		
		//$menuItem->SetLink('_NOTHING_');
		$exeCute = false;
		
		if($this->m_choosenDB == 'xml'){
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			if($this->isArray($arr_filename)){
				foreach($arr_filename as $nkey => $nvalue){
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$my_link = $xml->read_section('menu', 'link');
					$my_id   = $xml->read_section('menu', 'id');
					
					if(trim($my_link) == trim($id) && trim($my_id) == trim($item_id)){
						//echo $item_id.' - '.$id.' - '.$nvalue.'<br>';
						
						$menuItem->SetTitle($xml->read_section('menu', 'name'));
						$menuItem->SetPosition($my_id);
						$menuItem->SetSubmenuPosition($xml->read_section('menu', 'subid'));
						$menuItem->SetLink($my_link);
						$menuItem->SetType($xml->read_section('menu', 'type'));
						$menuItem->SetAccess($xml->read_section('menu', 'access'));
						$menuItem->SetParent($xml->read_section('menu', 'parent'));
						$menuItem->GetPublished($xml->read_section('menu', 'published'));
						
						break;
					}
				}
			}*/
		}
		else{
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$parentID = '';
			
			switch($this->m_IsAdmin){
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
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE link = '".$id."'"
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//echo $strSQL.'<br>';
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			//echo $sqlARR['root'].' - '.$sqlARR['uid'].' - '.$root.'<br />';
			
			if($level = 1) {
				if($sqlARR['root'] == null || $sqlARR['root'] == '-') {
					if($sqlARR['uid'] == $root) {
						$exeCute = true;
					}
					elseif($sqlARR['parent'] == $item_id) {
						$exeCute = true;
					}
				}
				else {
					if($sqlARR['root'] == $root) {
						$exeCute = true;
					}
				}
			}
			else {
				if($sqlARR['root'] == null || $sqlARR['root'] == '-') {
					if($sqlARR['parent_lvl2'] == $root) {
						$exeCute = true;
					}
				}
				else {
					if($sqlARR['root'] == $root) {
						$exeCute = true;
					}
				}
			}
		}
		
		return $exeCute;
	}
	
	
	
	/**
	 * [PRIVATE] Get the parent id of a item
	 *
	 * @param String $id
	 * @param String $root
	 * @param Integer $level = 0
	 * @return String
	 */
	function _getDByLink($id, $root, $level = 0){
		$result = '0';
		
		if($this->m_choosenDB == 'xml'){
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			if($this->isArray($arr_filename)){
				foreach($arr_filename as $nkey => $nvalue){
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$my_link = $xml->read_section('menu', 'link');
					$my_id   = $xml->read_section('menu', 'id');
					
					if(trim($my_link) == trim($id) && trim($my_id) == trim($item_id)){
						//echo $item_id.' - '.$id.' - '.$nvalue.'<br>';
						
						$menuItem->SetTitle($xml->read_section('menu', 'name'));
						$menuItem->SetPosition($my_id);
						$menuItem->SetSubmenuPosition($xml->read_section('menu', 'subid'));
						$menuItem->SetLink($my_link);
						$menuItem->SetType($xml->read_section('menu', 'type'));
						$menuItem->SetAccess($xml->read_section('menu', 'access'));
						$menuItem->SetParent($xml->read_section('menu', 'parent'));
						$menuItem->GetPublished($xml->read_section('menu', 'published'));
						
						break;
					}
				}
			}*/
		}
		else{
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$parentID = '';
			
			switch($this->m_IsAdmin){
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
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE uid = '".$root."'"
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$result = $sqlObj->id;
		}
		
		return $result;
	}
	
	
	
	/**
	 * Get a array of sidemenu items from the base
	 *
	 * @return Array
	 */
	function getBasemenu() {
		if($this->m_choosenDB == 'xml') {
			/*foreach($arr_file as $key => $value){
				if($value != 'index.html'){
					$side_xml = new xmlparser($this->administer.'/tcms_menu/'.$value,'r');
					$arr_menu['name'][$key] = $side_xml->read_value('name');
					$arr_menu['id'][$key]   = $side_xml->read_value('id');
					$arr_menu['sub'][$key]  = $side_xml->read_value('subid');
					$arr_menu['type'][$key] = $side_xml->read_value('type');
					$arr_menu['link'][$key] = $side_xml->read_value('link');
					$arr_menu['pub'][$key]  = $side_xml->read_value('published');
					$arr_menu['auth'][$key] = $side_xml->read_value('access');
					$arr_menu['par'][$key]  = $side_xml->read_value('parent');
					$arr_menu['tar'][$key]  = $side_xml->read_value('target');
					
					// CHARSETS
					$arr_menu['name'][$key] = $this->decodeText($arr_menu['name'][$key], '2', $c_charset);
				}
			}
			
			array_multisort(
				$arr_menu['id'], SORT_ASC, 
				$arr_menu['sub'], SORT_ASC, 
				$arr_menu['name'], SORT_ASC, 
				$arr_menu['type'], SORT_ASC, 
				$arr_menu['link'], SORT_ASC, 
				$arr_menu['auth'], SORT_ASC, 
				$arr_menu['pub'], SORT_ASC, 
				$arr_menu['par'], SORT_ASC, 
				$arr_menu['tar'], SORT_ASC
			);*/
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$executeQuery = false;
			
			switch($this->m_IsAdmin){
				case 'Developer':
				case 'Administrator':
					$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
					break;
				
				case 'User':
				case 'Editor':
				case 'Presenter':
				case 'Writer':
					$strAdd = " OR access = 'Protected' ) ";
					break;
				
				default:
					$strAdd = ' ) ';
					break;
			}
			
			$sql_parent = "( subid IS NULL OR subid = '-' )"
			." AND ( parent_lvl1 IS NULL OR parent_lvl1 = '-' )"
			." AND ( parent_lvl2 IS NULL OR parent_lvl2 = '-' )"
			." AND ( parent_lvl3 IS NULL OR parent_lvl3 = '-' )";
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level >= 2)
			//	echo $strSQL.'<br />';
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$menuItem = new tcms_dc_sidemenuitem();
				
				$sql_name = $this->decodeText($sqlObj->name, '2', $c_charset);
				
				$menuItem->SetID($sqlObj->uid);
				$menuItem->SetRoot($sqlObj->root);
				$menuItem->SetTitle($sql_name);
				$menuItem->SetPosition($sqlObj->id);
				$menuItem->SetSubmenuPosition($sqlObj->subid);
				$menuItem->SetLink($sqlObj->link);
				$menuItem->SetType($sqlObj->type);
				$menuItem->SetAccess($sqlObj->access);
				$menuItem->SetParent($sqlObj->parent);
				$menuItem->SetPublished($sqlObj->published);
				
				$arrReturn[$count] = $menuItem;
				
				$count++;
			}
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get a array of sidemenu items from the base
	 *
	 * @param Integer $level = 1
	 * @param String $subMenuOf
	 * @param String $currentPage
	 * @param String $currentPageItem
	 * @return Array
	 */
	function getSubmenu($level = 1, $subMenuOf, $currentPage, $currentPageItem) {
		if($this->m_choosenDB == 'xml') {
			
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$executeQuery = false;
			
			switch($this->m_IsAdmin) {
				case 'Developer':
				case 'Administrator':
					$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
					break;
				
				case 'User':
				case 'Editor':
				case 'Presenter':
				case 'Writer':
					$strAdd = " OR access = 'Protected' ) ";
					break;
				
				default:
					$strAdd = ' ) ';
					break;
			}
			
			
			//
			//
			//
			if($currentPage == 'components') {
				$currentPage = $currentPage.'&item='.$currentPageItem;
			}
			
			$item_id = $this->_getDByLink($currentPage, $subMenuOf, $level);
			//echo $currentPage.' - '.$subMenuOf.' - '.$level.' - '.$item_id.'<br>';
			$executeQuery = $this->_checkIDByLink($currentPage, $subMenuOf, $level, $item_id);
			
			
			//
			//
			//
			switch($level){
				case 1:
					$sql_parent = "parent_lvl1 = '".$subMenuOf."' OR parent = '".$item_id."'";
					break;
				
				case 2:
					$sql_parent = "parent_lvl2 = '".$subMenuOf."'";
					break;
				
				case 3: $sql_parent = "parent_lvl3 = '".$subMenuOf."'"; break;
			}
			
			
			//
			//
			//
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level >= 2)
				//echo $strSQL.'<br />';
			
			
			//
			//
			//
			if($executeQuery) {
				$sqlQR = $sqlAL->sqlQuery($strSQL);
				
				$count = 0;
				
				while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
					$menuItem = new tcms_dc_sidemenuitem();
					
					$sql_name = $this->decodeText($sqlObj->name, '2', $c_charset);
					
					$menuItem->SetID($sqlObj->uid);
					$menuItem->SetRoot($sqlObj->root);
					$menuItem->SetTitle($sql_name);
					$menuItem->SetPosition($sqlObj->id);
					$menuItem->SetSubmenuPosition($sqlObj->subid);
					$menuItem->SetLink($sqlObj->link);
					$menuItem->SetType($sqlObj->type);
					$menuItem->SetAccess($sqlObj->access);
					$menuItem->SetParent($sqlObj->parent);
					$menuItem->SetPublished($sqlObj->published);
					
					$arrReturn[$count] = $menuItem;
					
					$count++;
				}
				
				$sqlAL->_sqlAbstractionLayer();
				unset($sqlAL);
			}
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get a array of sidemenu items
	 *
	 * @param String $item_id = ''
	 * @param Integer $level = 0
	 * @param String $id = ''
	 * @param String $item = ''
	 * @param String $root = ''
	 * @return Array
	 */
	function getSidemenu($item_id = '', $level = 0, $id = '', $item = '', $root = ''){
		if($this->m_choosenDB == 'xml'){
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			$count = 0;
			$show_item = false;
			
			if($this->isReal($id)){
				if($id == 'components')
					$id = $id.'&item='.$item;
				
				$menuItem = new tcms_dc_sidemenuitem();
				$menuItem = $this->_GetParentItem($item_id, $id);
			}
			
			if($this->isArray($arr_filename)){
				foreach($arr_filename as $nkey => $nvalue){
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$is_pub  = $xml->read_section('menu', 'published');
					
					if($is_pub == 1){
						$is_auth = $xml->read_section('menu', 'access');
						
						$show_item = $this->checkAccess($is_auth, $this->m_IsAdmin);
						
						if($show_item == true){
							$mi_parent = $xml->read_section('menu', 'parent');
							
							// only parent
							if($item_id == ''){
								if(trim($mi_parent) == '-')
									$show_item = true;
								else
									$show_item = false;
							}
							// or sub items
							else{
								if($menuItem->GetLink() == '_NOTHING_'){
									$show_item = false;
								}
								else{
									if($this->isReal($id))
										$item_id = $menuItem->GetPosition();
									
									if(trim($item_id) == trim($mi_parent))
										$show_item = true;
									else
										$show_item = false;
								}
							}
							
							// and now write
							if($show_item){
								$arr_menu['name'][$count] = $xml->read_section('menu', 'name');
								$arr_menu['id'][$count]   = $xml->read_section('menu', 'id');
								$arr_menu['sub'][$count]  = $xml->read_section('menu', 'subid');
								$arr_menu['type'][$count] = $xml->read_section('menu', 'type');
								$arr_menu['link'][$count] = $xml->read_section('menu', 'link');
								$arr_menu['acs'][$count]  = $is_auth;
								$arr_menu['par'][$count]  = $mi_parent;
								$arr_menu['pub'][$count]  = $is_pub;
								
								$arr_menu['name'][$count] = $this->decodeText($arr_menu['name'][$count], '2', $c_charset);
								
								$count++;
							}
						}
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
			
			if(is_array($arr_menu['id']) && isset($arr_menu['id'])){
				array_multisort(
					$arr_menu['id'], SORT_ASC, 
					$arr_menu['sub'], SORT_ASC, 
					$arr_menu['name'], SORT_ASC, 
					$arr_menu['type'], SORT_ASC, 
					$arr_menu['link'], SORT_ASC, 
					$arr_menu['acs'], SORT_ASC, 
					$arr_menu['pub'], SORT_ASC, 
					$arr_menu['par'], SORT_ASC
				);
			}
			
			if(is_array($arr_menu['id']) && isset($arr_menu['id'])){
				$count = 0;
				
				unset($n_key);
				
				foreach($arr_menu['id'] as $key => $n_value){
					$menuItem = new tcms_dc_sidemenuitem();
					
					$menuItem->SetTitle($arr_menu['name'][$key]);
					$menuItem->SetPosition($arr_menu['id'][$key]);
					$menuItem->SetSubmenuPosition($arr_menu['sub'][$key]);
					$menuItem->SetLink($arr_menu['link'][$key]);
					$menuItem->SetType($arr_menu['type'][$key]);
					$menuItem->SetAccess($arr_menu['acs'][$key]);
					$menuItem->SetParent($arr_menu['par'][$key]);
					$menuItem->GetPublished($arr_menu['pub'][$key]);
					
					$arrReturn[$count] = $menuItem;
					
					$count++;
				}
			}*/
		}
		else{
			//
			//
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$executeQuery = false;
			
			switch($this->m_IsAdmin){
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
			
			//
			// hier dran: current page
			//
			// $id   = id
			// $item = cs
			if($this->isReal($id)){
				if($id == 'components')
					$id = $id.'&item='.$item;
				
				$executeQuery = $this->_getIDByLink($id, $item_id, $level);
				
				//echo '<b>'.$root.' - '.( $executeQuery ? '1' : '0' ).'</b>';
				// - '.$id.' ('.$level.'): '.$item_id.' == '.$currentID.'</b><br />';
			}
			else{
				$executeQuery = true;
			}
			
			//
			// hier dran ist zu erkennen ob root oder sub
			//
			if($item_id == ''){
				$sql_parent = "( parent_lvl1 IS NULL OR parent_lvl1parent_lvl1 = '-' )"
				." AND ( parent_lvl2 IS NULL OR parent_lvl2 = '-' )"
				." AND ( parent_lvl3 IS NULL OR parent_lvl3 = '-' )";
			}
			else{
				switch($level){
					case 2: $sql_parent = "parent_lvl2 = '".$item_id."'"; break;
					case 3: $sql_parent = "parent_lvl3 = '".$item_id."'"; break;
				}
			}
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level >= 2)
			//	echo $strSQL.'<br />';
			
			if($executeQuery){
				$sqlQR = $sqlAL->sqlQuery($strSQL);
				
				$count = 0;
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$menuItem = new tcms_dc_sidemenuitem();
					
					$sql_name = $this->decodeText($sqlARR['name'], '2', $c_charset);
					
					$menuItem->SetID($sqlARR['uid']);
					$menuItem->SetRoot($sqlARR['root']);
					$menuItem->SetTitle($sql_name);
					$menuItem->SetPosition($sqlARR['id']);
					$menuItem->SetSubmenuPosition($sqlARR['subid']);
					$menuItem->SetLink($sqlARR['link']);
					$menuItem->SetType($sqlARR['type']);
					$menuItem->SetAccess($sqlARR['access']);
					$menuItem->SetParent($sqlARR['parent']);
					$menuItem->GetPublished($sqlARR['published']);
					
					$arrReturn[$count] = $menuItem;
					
					$count++;
				}
			}
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			
			
			
			
			
			/*
			
			
			
			
			
			
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($this->db_prefix.'sidemenu');
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_menu['tag'][$count]  = $sqlARR['uid'];
				$arr_menu['name'][$count] = $sqlARR['name'];
				$arr_menu['id'][$count]   = $sqlARR['id'];
				$arr_menu['sub'][$count]  = $sqlARR['subid'];
				$arr_menu['type'][$count] = $sqlARR['type'];
				$arr_menu['link'][$count] = $sqlARR['link'];
				$arr_menu['par'][$count]  = $sqlARR['parent'];
				$arr_menu['pub'][$count]  = $sqlARR['published'];
				$arr_menu['auth'][$count] = $sqlARR['access'];
				
				if($arr_menu['name'][$count] == NULL){ $arr_menu['name'][$count] = ''; }
				if($arr_menu['id'][$count]   == NULL){ $arr_menu['id'][$count]   = ''; }
				if($arr_menu['auth'][$count] == NULL){ $arr_menu['auth'][$count] = ''; }
				if($arr_menu['link'][$count] == NULL){ $arr_menu['link'][$count] = ''; }
				if($arr_menu['pub'][$count]  == NULL){ $arr_menu['pub'][$count]  = ''; }
				
				// CHARSETS
				$arr_menu['name'][$count] = $this->decodeText($arr_menu['name'][$count], '2', $c_charset);
				
				$checkReorder = $count;
				$count++;
			}
			
			if(is_array($arr_menu)){
				array_multisort(
					$arr_menu['id'], SORT_ASC, 
					$arr_menu['sub'], SORT_ASC, 
					$arr_menu['name'], SORT_ASC, 
					$arr_menu['type'], SORT_ASC, 
					$arr_menu['link'], SORT_ASC, 
					$arr_menu['auth'], SORT_ASC, 
					$arr_menu['pub'], SORT_ASC, 
					$arr_menu['par'], SORT_ASC
				);
				
				foreach($arr_menu['id'] as $mkey => $mvalue){
					if($arr_menu['type'][$mkey] == 'web'){
						$arr_mainmenu['link'][$mkey] = '<a class="mainlevel" href="'.trim($arr_menu['link'][$mkey]).'" target="_blank">'.trim($arr_menu['name'][$mkey]).'</a>';
					}
					else{
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$arr_menu['link'][$mkey].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlAmpReplace($link);
						
						$arr_mainmenu['link'][$mkey] = '<a class="mainlevel" href="'.$link.'">'.trim($arr_menu['name'][$mkey]).'</a>';
					}
					$arr_mainmenu['auth'][$mkey] = trim($arr_menu['auth'][$mkey]);
					$arr_mainmenu['id'][$mkey] = trim($arr_menu['id'][$mkey]);
					$arr_mainmenu['type'][$mkey] = trim($arr_menu['type'][$mkey]);
					$arr_mainmenu['subid'][$mkey] = trim($arr_menu['sub'][$mkey]);
					$arr_mainmenu['parent'][$mkey] = trim($arr_menu['par'][$mkey]);
					$arr_mainmenu['name'][$mkey] = trim($arr_menu['name'][$mkey]);
					$arr_mainmenu['pub'][$mkey] = trim($arr_menu['pub'][$mkey]);
					$arr_mainmenu['url'][$mkey] = trim($arr_menu['link'][$mkey]);
					
					if($arr_menu['type'][$mkey] == 'web'){
						$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a class="submenu" href="'.trim($arr_menu['link'][$mkey]).'" target="_blank">'.trim($arr_menu['name'][$mkey]).'</a>';
					}
					else{
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.trim($arr_menu['link'][$mkey]).'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlAmpReplace($link);
						
						$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a class="submenu" href="'.$link.'">'.trim($arr_menu['name'][$mkey]).'</a>';
					}
				}
				
				return $arr_mainmenu;
			}
			else{ return ''; }*/
		}
		
		return $arrReturn;
	}
}

?>
