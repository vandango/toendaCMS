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
| File:	tcms_menu_provider.lib.php
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
 * @version 0.4.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * TCMS Menu methods
 *
 * __construct()                           -> Constructor
 * 
 * setTcmsTimeObj                          -> Set the tcms_time object
 *
 * _checkIDByLink                          -> Check a menuitem by link
 * _getIDByLink                            -> Get a menuitem by link
 * 
 * checkIdFromSubmenuItem                  -> Checks if the id is the link from the subitem of a menuitem
 * getBasemenu                             -> Get a array of sidemenu items from the base
 * getSubmenu                              -> Get a array of sidemenu items from the base
 * getSidemenu                             -> Get a array of menu items
 * generateLinkWay                         -> Generate a linkway arraylist
 * 
 * </code>
 *
 */


class tcms_menu_provider extends tcms_main {
	// global informaton
	private $m_CHARSET;
	private $m_path;
	private $m_IsAdmin;
	private $_tcmsTime;
	private $_tcmsConfig;
	
	// database information
	private $m_choosenDB;
	private $m_sqlUser;
	private $m_sqlPass;
	private $m_sqlHost;
	private $m_sqlDB;
	private $m_sqlPort;
	private $m_sqlPrefix;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $tcms_administer_path = 'data'
	 * @param String $charset
	 * @param String $isAdmin
	 * @param Object $tcmsTimeObj = null
	 */
	public function __construct($tcms_administer_path = 'data', $charset, $isAdmin, $tcmsTimeObj = null, $tcmsConfigObj = null) {
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->m_IsAdmin = $isAdmin;
		$this->_tcmsTime = $tcmsTimeObj;
		$this->_tcmsConfig = $tcmsConfigObj;
		
		//echo 'pfad: '.$this->m_path.' ---> '.$tcms_administer_path.' ---> '.$this->administer.'<br>';
		
		if(file_exists($this->m_path.'/tcms_global/database.php')) {
			require($this->m_path.'/tcms_global/database.php');
			
			$this->m_choosenDB = $tcms_db_engine;
			$this->m_sqlUser   = $tcms_db_user;
			$this->m_sqlPass   = $tcms_db_password;
			$this->m_sqlHost   = $tcms_db_host;
			$this->m_sqlDB     = $tcms_db_database;
			$this->m_sqlPort   = $tcms_db_port;
			$this->m_sqlPrefix = $tcms_db_prefix;
		}
		else {
			$this->m_choosenDB = 'xml';
		}
		
		parent::setAdministerSite($tcms_administer_path);
		parent::setURLSEO($this->_tcmsConfig->getSEOFormatString());
		parent::setGlobalFolder(
			$this->_tcmsConfig->getSEOPath(), 
			$this->_tcmsConfig->getSEOEnabled()
		);
		//parent::__construct($tcms_administer_path, $tcmsTimeObj);
		//parent::setDatabaseInfo($this->m_choosenDB);
	}
	
	
	
	/**
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	public function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * [PRIVATE] Check the parent id of a item
	 *
	 * @param String $lang
	 * @param String $id
	 * @param String $root
	 * @param Integer $level = 0
	 * @param Integer $item_id
	 * @return String
	 */
	private function _checkIDByLink($lang, $id, $root, $level = 0, $item_id) {
		//$menuItem = new tcms_dc_sidemenuitem();
		
		//$menuItem->SetLink('_NOTHING_');
		$exeCute = false;
		
		if($this->m_choosenDB == 'xml') {
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			if($this->isArray($arr_filename)) {
				foreach($arr_filename as $nkey => $nvalue) {
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$my_link = $xml->read_section('menu', 'link');
					$my_id   = $xml->read_section('menu', 'id');
					
					if(trim($my_link) == trim($id) && trim($my_id) == trim($item_id)) {
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
		else {
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$parentID = '';
			
			switch($this->m_IsAdmin) {
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
			." AND language = '".$lang."'"
			//." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//echo $strSQL.'<br>';
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			//echo $sqlARR['root'].' - '.$sqlARR['uid'].' - '.$root.'<br />';
			
			if($level = 1) {
				if($sqlObj->root == null || $sqlObj->root == '-') {
					if($sqlObj->uid == $root) {
						$exeCute = true;
					}
					elseif($sqlObj->parent == $item_id) {
						$exeCute = true;
					}
				}
				else {
					if($sqlObj->root == $root) {
						$exeCute = true;
					}
				}
			}
			if($level = 2) {
				$exeCute = true;
			}
			if($level = 3) {
				$exeCute = true;
			}
			else {
				if($sqlObj->root == null || $sqlObj->root == '-') {
					if($sqlObj->parent_lvl2 == $root) {
						$exeCute = true;
					}
				}
				else {
					if($sqlObj->root == $root) {
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
	 * @param String $lang
	 * @param String $id
	 * @param String $root
	 * @param Integer $level = 0
	 * @return String
	 */
	private function _getDByLink($lang, $id, $root, $level = 0) {
		$result = '0';
		
		if($this->m_choosenDB == 'xml') {
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			if($this->isArray($arr_filename)) {
				foreach($arr_filename as $nkey => $nvalue) {
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$my_link = $xml->read_section('menu', 'link');
					$my_id   = $xml->read_section('menu', 'id');
					
					if(trim($my_link) == trim($id) && trim($my_id) == trim($item_id)) {
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
		else {
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$parentID = '';
			
			switch($this->m_IsAdmin) {
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
			." AND language = '".$lang."'"
			//." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$result = $sqlObj->id;
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		return $result;
	}
	
	
	
	/**
	 * Checks if the id is the link from the subitem of a menuitem
	 *
	 * @param String $lang
	 * @param String $id
	 * @param String $parent
	 * @param Integer $level
	 * @return String
	 */
	public function checkIdFromSubmenuItem($lang, $id, $parent, $level) {
		$result = false;
		
		if($this->m_choosenDB == 'xml') {
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			if($this->isArray($arr_filename)) {
				foreach($arr_filename as $nkey => $nvalue) {
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$my_link = $xml->read_section('menu', 'link');
					$my_id   = $xml->read_section('menu', 'id');
					
					if(trim($my_link) == trim($id) && trim($my_id) == trim($item_id)) {
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
		else {
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_IsAdmin) {
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
			
			switch($level) {
				case 1:
					$sql_parent = "parent_lvl1";
					break;
				
				case 2:
					$sql_parent = "parent_lvl2";
					break;
				
				case 3:
					$sql_parent = "parent_lvl3";
					break;
				
				default:
					$sql_parent = "parent_lvl1";
					break;
			}
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent." = '".$parent."'"
			." AND language = '".$lang."'"
			//." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level == 2) {
			//	echo $strSQL;
			//}
			
			$sqlQR = $sqlAL->query($strSQL);
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				if($sqlObj->link == $id) {
					$result = true;
					break;
				}
			}
			
			//echo ( $result ? 'ja' : 'nein' ).'<br>';
						
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		return $result;
	}
	
	
	
	/**
	 * Checks if the id is the link from the subitems of a menuitem
	 *
	 * @param String $lang
	 * @param String $id
	 * @param String $parent
	 * @return String
	 */
	public function checkIdFromAllSubmenuItems($lang, $id, $parent) {
		//echo $id.'-'.$parent.'<br>';
		
		$wsChk = $this->checkIdFromSubmenuItem($lang, $id, $parent, 1);
		
		if(!$wsChk) {
			$wsChk = $this->checkIdFromSubmenuItem($lang, $id, $parent, 2);
			
			if(!$wsChk) {
				$wsChk = $this->checkIdFromSubmenuItem($lang, $id, $parent, 3);
			}
		}
		
		//echo ( $wsChk ? 'ja' : 'nein' ).'<br>';
		
		return $wsChk;
	}
	
	
	
	/**
	 * Get a array of sidemenu items from the base
	 *
	 * @param String $lang
	 * @return Array
	 */
	public function getBasemenu($lang) {
		if($this->m_choosenDB == 'xml') {
			/*foreach($arr_file as $key => $value) {
				if($value != 'index.html') {
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
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
			
			$sql_parent = "( subid IS NULL OR subid = '' OR subid = '-' )"
			." AND ( parent_lvl1 IS NULL OR parent_lvl1 = '' OR parent_lvl1 = '-' )"
			." AND ( parent_lvl2 IS NULL OR parent_lvl2 = '' OR parent_lvl2 = '-' )"
			." AND ( parent_lvl3 IS NULL OR parent_lvl3 = '' OR parent_lvl3 = '-' )";
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent
			." AND language = '".$lang."'"
			//." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level >= 2)
			//	echo $strSQL.'<br />';
			
			$sqlQR = $sqlAL->query($strSQL);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
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
				$menuItem->SetTarget($sqlObj->target);
				
				$arrReturn[$count] = $menuItem;
				
				$count++;
			}
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get a array of sidemenu items from the base
	 *
	 * @param String $lang
	 * @param Integer $level = 1
	 * @param String $subMenuOf
	 * @param String $currentPage
	 * @param String $currentPageItem
	 * @return Array
	 */
	public function getSubmenu($lang, $level = 1, $subMenuOf, $currentPage, $currentPageItem) {
		if($this->m_choosenDB == 'xml') {
			//
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
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
			
			$item_id = $this->_getDByLink($lang, $currentPage, $subMenuOf, $level);
			//echo $currentPage.' - '.$subMenuOf.' - '.$level.' - '.$item_id.'<br>';
			//echo $currentPage.' - '.$subMenuOf.' - '.$level.' - '.$item_id.'<br>';
			
			$executeQuery = $this->_checkIDByLink(
				$lang, 
				$currentPage, 
				$subMenuOf, 
				$level, 
				$item_id
			);
			
			//echo ( $executeQuery ? 'ja' : 'nein' ).'<br>';
			
			
			if($executeQuery) {
				//
				//
				//
				switch($level) {
					case 1:
						$sql_parent = "( "
						."(parent_lvl1 = '".$subMenuOf."' OR parent = '".$item_id."') "
						."AND (parent_lvl2 = '' OR parent_lvl2 = '-') "
						."AND (parent_lvl3 = '' OR parent_lvl3 = '-') "
						.")";
						break;
					
					case 2:
						$sql_parent = "( parent_lvl2 = '".$subMenuOf."' )";
						break;
					
					case 3:
						$sql_parent = "( parent_lvl3 = '".$subMenuOf."' )";
						break;
				}
				
				
				//
				//
				//
				$strSQL = "SELECT *"
				." FROM ".$this->m_sqlPrefix."sidemenu"
				." WHERE ".$sql_parent
				." AND language = '".$lang."'"
				//." AND published = 1"
				." AND ( access = 'Public' ".$strAdd
				." ORDER BY id ASC, subid ASC";
				
				if($level > 1) {
					//echo $strSQL.'<br />';
				}
				
				//
				//
				//
				$sqlQR = $sqlAL->query($strSQL);
				
				$count = 0;
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
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
					$menuItem->SetTarget($sqlObj->target);
					
					$arrReturn[$count] = $menuItem;
					
					$count++;
				}
				
				$sqlAL->freeResult($sqlQR);
				unset($sqlAL);
			}
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * DEPRECATED: Get a array of sidemenu items
	 *
	 * @param String $lang
	 * @param String $item_id = ''
	 * @param Integer $level = 0
	 * @param String $id = ''
	 * @param String $item = ''
	 * @param String $root = ''
	 * @return Array
	 * @deprecated Since all time
	 */
	public function getSidemenu($lang, $item_id = '', $level = 0, $id = '', $item = '', $root = '') {
		if($this->m_choosenDB == 'xml') {
			/*$arr_filename = $this->readdir_ext($this->m_path.'/tcms_menu/');
			
			$count = 0;
			$show_item = false;
			
			if($this->isReal($id)) {
				if($id == 'components')
					$id = $id.'&item='.$item;
				
				$menuItem = new tcms_dc_sidemenuitem();
				$menuItem = $this->_GetParentItem($item_id, $id);
			}
			
			if($this->isArray($arr_filename)) {
				foreach($arr_filename as $nkey => $nvalue) {
					$xml = new xmlparser($this->m_path.'/tcms_menu/'.$nvalue,'r');
					
					$is_pub  = $xml->read_section('menu', 'published');
					
					if($is_pub == 1) {
						$is_auth = $xml->read_section('menu', 'access');
						
						$show_item = $this->checkAccess($is_auth, $this->m_IsAdmin);
						
						if($show_item == true) {
							$mi_parent = $xml->read_section('menu', 'parent');
							
							// only parent
							if($item_id == '') {
								if(trim($mi_parent) == '-')
									$show_item = true;
								else
									$show_item = false;
							}
							// or sub items
							else {
								if($menuItem->GetLink() == '_NOTHING_') {
									$show_item = false;
								}
								else {
									if($this->isReal($id))
										$item_id = $menuItem->GetPosition();
									
									if(trim($item_id) == trim($mi_parent))
										$show_item = true;
									else
										$show_item = false;
								}
							}
							
							// and now write
							if($show_item) {
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
					unset($xml);
				}
			}
			
			if(is_array($arr_menu['id']) && isset($arr_menu['id'])) {
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
			
			if(is_array($arr_menu['id']) && isset($arr_menu['id'])) {
				$count = 0;
				
				unset($n_key);
				
				foreach($arr_menu['id'] as $key => $n_value) {
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
		else {
			//
			//
			//
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$executeQuery = false;
			
			switch($this->m_IsAdmin) {
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
			if($this->isReal($id)) {
				if($id == 'components')
					$id = $id.'&item='.$item;
				
				$executeQuery = $this->_getIDByLink($lang, $id, $item_id, $level);
				
				//echo '<b>'.$root.' - '.( $executeQuery ? '1' : '0' ).'</b>';
				// - '.$id.' ('.$level.'): '.$item_id.' == '.$currentID.'</b><br />';
			}
			else {
				$executeQuery = true;
			}
			
			//
			// hier dran ist zu erkennen ob root oder sub
			//
			if($item_id == '') {
				$sql_parent = "( parent_lvl1 IS NULL OR parent_lvl1parent_lvl1 = '-' )"
				." AND ( parent_lvl2 IS NULL OR parent_lvl2 = '-' )"
				." AND ( parent_lvl3 IS NULL OR parent_lvl3 = '-' )";
			}
			else {
				switch($level) {
					case 2: $sql_parent = "parent_lvl2 = '".$item_id."'"; break;
					case 3: $sql_parent = "parent_lvl3 = '".$item_id."'"; break;
				}
			}
			
			$strSQL = "SELECT *"
			." FROM ".$this->m_sqlPrefix."sidemenu"
			." WHERE ".$sql_parent
			." AND LANGUAGE = '".$lang."'"
			." AND published = 1"
			." AND ( access = 'Public' ".$strAdd
			." ORDER BY id ASC, subid ASC";
			
			//if($level >= 2)
			//	echo $strSQL.'<br />';
			
			if($executeQuery) {
				$sqlQR = $sqlAL->query($strSQL);
				
				$count = 0;
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
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
					$menuItem->SetTarget($sqlObj->target);
					
					$arrReturn[$count] = $menuItem;
					
					$count++;
				}
			}
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Generate a linkway arraylist
	 * 
	 * @param String $session
	 * @param String $template
	 * @param String $language
	 * @return Array
	 */
	public function generateLinkWay($session, $template, $language) {
		if($this->m_choosenDB == 'xml') {
			
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$sqlStr = "SELECT * "
			."FROM ".$this->db_prefix."sidemenu "
			."WHERE language = '".$tcms_config->getLanguageCodeForTCMS($language)."' "
			."ORDER BY id ASC, name ASC, link ASC";
			
			$sqlQR = $sqlAL->query($sqlStr);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arr_link['name'][$count] = $sqlObj->name;
				$arr_link['id'][$count]   = $sqlObj->id;
				$arr_link['link'][$count] = $sqlObj->link;
				
				if($arr_link['name'][$count] == NULL) { $arr_link['name'][$count] = ''; }
				if($arr_link['id'][$count]   == NULL) { $arr_link['id'][$count]   = ''; }
				if($arr_link['link'][$count] == NULL) { $arr_link['link'][$count] = ''; }
				
				// CHARSETS
				$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
				
				$checkReorder = $count;
				$count++;
			}
			
			
			if($which != 'check_id') {
				if(is_array($arr_link['link']) && !empty($arr_link['link'])) {
					foreach($arr_link['link'] as $key => $value) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value.'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_path[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
						$titleway[$value] = $arr_link['name'][$key];
						$pathway[$value]  = $arr_link['name'][$key];
					}
				}
			}
			
			$sqlStr = "SELECT * "
			."FROM ".$this->db_prefix."topmenu "
			."WHERE language = '".$tcms_config->getLanguageCodeForTCMS($lang)."' "
			."ORDER BY id ASC, name ASC, link ASC";
			
			$sqlQR = $sqlAL->query($sqlStr);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arr_link['name'][$count] = $sqlObj->name;
				$arr_link['id'][$count]   = $sqlObj->id;
				$arr_link['link'][$count] = $sqlObj->link;
				
				if($arr_link['name'][$count] == NULL) { $arr_link['name'][$count] = ''; }
				if($arr_link['id'][$count]   == NULL) { $arr_link['id'][$count]   = ''; }
				if($arr_link['link'][$count] == NULL) { $arr_link['link'][$count] = ''; }
				
				// CHARSETS
				$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
				
				$checkReorder = $count;
				$count++;
			}
			
			
			if($which != 'check_id') {
				if(is_array($arr_link['link']) && !empty($arr_link['link'])) {
					foreach($arr_link['link'] as $key => $value) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value.'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_pathT[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
						$titlewayT[$value] = $arr_link['name'][$key];
						$pathwayT[$value]  = $arr_link['name'][$key];
					}
				}
			}
		}
		
		if(is_array($pathwayT) && !empty($pathwayT)) {
			foreach($pathwayT as $key => $value) { $tmpPathway[$key] = $value; }
		}
		
		if(is_array($pathway) && !empty($pathway)) {
			foreach($pathway as $key => $value) { $tmpPathway[$key] = $value; }
		}
		
		if(!is_array($arr_path)) { $arr_path[0]  = ''; }
		if(!is_array($arr_pathT)) { $arr_pathT[0] = ''; }
		if(!is_array($titleway)) { $titleway[0]  = ''; }
		if(!is_array($titlewayT)) { $titlewayT[0] = ''; }
		
		$arr_path = array_merge($arr_path, $arr_pathT);
		$titleway = array_merge($titleway, $titlewayT);
		
		$arrLinkway['path']    = $arr_path;
		$arrLinkway['title']   = $titleway;
		$arrLinkway['pathway'] = $tmpPathway;
		
		return $arrLinkway;
	}
}

?>
