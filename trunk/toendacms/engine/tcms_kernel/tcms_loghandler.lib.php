<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Search class
|
| File:	tcms_search.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Search class
 * 
 * This class is used to provide a dynamic
 * search class.
 * 
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 * 
 * <code>
 * 
 * Methods
 * 
 * --------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 * --------------------------------------------------------
 * 
 * __construct                          -> Constructor
 * __destruct                           -> Destructor
 * 
 * --------------------------------------------------------
 * PROPERTIES
 * --------------------------------------------------------
 * 
 * setTcmsTimeObj                       -> Set the tcms_time object
 * setTcmsConfigObj                     -> Set the tcms_config object
 * 
 * --------------------------------------------------------
 * PRIVATE MEMBERS
 * --------------------------------------------------------
 * 
 * _getPathContent                      -> Return a array of all files or directory's inside a path
 * 
 * --------------------------------------------------------
 * PUBLIC MEMBERS
 * --------------------------------------------------------
 * 
 * GetEntryList                         -> Get a list of log entries
 * WriteEntry                           -> Write a entry into the log
 * 
 * </code>
 * 
 */


class tcms_loghandler extends tcms_main {
	// global informaton
	private $_path;
	
	// global objects
	private $_tcmsTime;
	private $_tcmsConfig;
	
	// database information
	private $_choosenDB;
	private $_sqlUser;
	private $_sqlPass;
	private $_sqlHost;
	private $_sqlDB;
	private $_sqlPort;
	private $_sqlPrefix;
	
	
	
	// -------------------------------------------------
	// CONSTRUCTORS
	// -------------------------------------------------
	
	
	
	/**
	 * Constructor
	 * 
	 * @param String $tcms_administer_path = 'data'
	 * @param Object tcmsTimeObj = null
	 * @param Object $tcmsHtmlObj = null
	 * @param Object $tcmsConfigObj = null
	 */
	public function __construct($tcms_administer_path = 'data', $tcmsTimeObj = null, $tcmsConfigObj = null) {
		$this->_path = $tcms_administer_path;
		
		$this->_tcmsTime = $tcmsTimeObj;
		$this->_tcmsConfig = $tcmsConfigObj;
		
		if(file_exists($this->_path.'/tcms_global/database.php')) {
			require($this->_path.'/tcms_global/database.php');
			
			$this->_choosenDB = $tcms_db_engine;
			$this->_sqlUser   = $tcms_db_user;
			$this->_sqlPass   = $tcms_db_password;
			$this->_sqlHost   = $tcms_db_host;
			$this->_sqlDB     = $tcms_db_database;
			$this->_sqlPort   = $tcms_db_port;
			$this->_sqlPrefix = $tcms_db_prefix;
		}
		else {
			$this->_choosenDB = 'xml';
		}
		
		parent::setTcmsTimeObj($tcmsTimeObj);
		parent::setTcmsConfigObj($tcmsConfigObj);
		parent::setURLSEO($this->_tcmsConfig->getSEOFormat());
		parent::setAdministerSite($tcms_administer_path);
		parent::setGlobalFolder(
			$this->_tcmsConfig->getSEOPath(), 
			$this->_tcmsConfig->getSEOEnabled()
		);
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	// -------------------------------------------------
	// PROPERTIES
	// -------------------------------------------------
	
	
	
	/**
	 * Set the tcms_time object
	 *
	 * @param tcms_time $value
	 */
	public function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Set the tcms_config object
	 *
	 * @param tcms_config $value
	 */
	public function setTcmsConfigObj($value) {
		$this->_tcmsConfig = $value;
	}
	
	
	
	// -------------------------------------------------
	// PRIVATE MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Return a array of all files or directory's inside a path
	 *
	 * @param String $path
	 * @param Boolean $onlyFolders
	 * @param String $fileType = ''
	 * @param Boolean $commentFolders = false
	 * @return Array
	 */
	private function _getPathContent($path, $onlyFolders = false, $fileType = '', $commentFolders = false) {
		include_once('tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		return $tcms_file->getPathContent(
			$path, 
			$onlyFolders, 
			$fileType, 
			$commentFolders
		);
	}
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Get a list of log entries
	 *
	 * @param String $userId = ''
	 * @param Integer $amount = -1
	 * @return Array
	 */
	public function GetEntryList($userId = '', $amount = -1) {
		$count = 0;
		$itemCount = -1;
		
		if($amount > 0) {
			$itemCount++;
		}
		
		if($this->db_choosenDB == 'xml') {
			$arrFiles = $this->_getPathContent($this->_path.'/tcms_log/');
			
			// sort by timestamp
			sort($arrFiles, SORT_DESC);
			
			if($this->isArray($arrFiles)) {
				foreach($arrFiles as $key => $value) {
					if($amount >= $itemCount) {
						$xml = new xmlparser($this->_path.'/tcms_log/'.$value,'r');
						
						$wsId      = $xml->readSection('log', 'uid');
						$wsUserId  = $xml->readSection('log', 'user_uid');
						
						if(trim($userId) == '') {
							$wsStamp  = $xml->readSection('log', 'stamp');
							$wsIP     = $xml->readSection('log', 'ip');
							$wsModule = $xml->readSection('log', 'module');
							$wsText   = $xml->readSection('log', 'text');
						}
						else if(trim($userId) == trim($wsUserId)) {
							$wsStamp  = $xml->readSection('log', 'stamp');
							$wsIP     = $xml->readSection('log', 'ip');
							$wsModule = $xml->readSection('log', 'module');
							$wsText   = $xml->readSection('log', 'text');
						}
						
						$xml->flush();
						unset($xml);
						
						$wsText = $this->decodeText($wsText, '2', $this->_tcmsConfig->getCharset());
						
						$dcLog = new tcms_dc_log();
						$dcLog->setID($wsId);
						$dcLog->setUserID($wsUserId);
						$dcLog->setTimestamp($wsStamp);
						$dcLog->setIP($wsIP);
						$dcLog->setModule($wsModule);
						$dcLog->setText($wsText);
						
						$arrLogs[$count] = $dcLog;
					}
					
					$count++;
					
					if($amount > 0) {
						$itemCount++;
					}
				}
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->_sqlUser, 
				$this->_sqlPass, 
				$this->_sqlHost, 
				$this->_sqlDB, 
				$this->_sqlPort
			);
			
			// max items
			switch($this->m_choosenDB) {
				case 'mysql':
					$dbLimitFront = "";
					$dbLimitBack = ( $amount == -1 ? "" : "LIMIT 0, ".$amount );
					break;
				
				case 'pgsql':
					$dbLimitFront = "";
					$dbLimitBack = ( $amount == -1 ? "" : "LIMIT ".$amount );
					break;
				
				case 'mssql':
					$dbLimitFront = ( $amount == -1 ? "" : "TOP ".$amount );
					$dbLimitBack = "";
					break;
				
				default:
					$dbLimitFront = "";
					$dbLimitBack = "";
					break;
			}
			
			$sqlStr = "SELECT * ".$dbLimitFront
			." FROM ".$this->_sqlPrefix."log ";
			
			if(trim($userId) == '') {
				//$sqlStr .= " WHERE user_uid = ".trim($userId)." ";
			}
			else {
				$sqlStr .= " WHERE user_uid = ".trim($userId)." ";
			}
			
			$sqlStr .= " ORDER BY stamp DESC ".$dbLimitBack;
			
			$sqlQR = $sqlAL->query($sqlStr);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$wsId = $sqlObj->uid;
				$wsUserId = $sqlObj->user_uid;
				$wsStamp = $sqlObj->stamp;
				$wsIP = $sqlObj->ip;
				$wsModule = $sqlObj->module;
				$wsText = $sqlObj->text;
				
				$wsText = $this->decodeText($wsText, '2', $this->_tcmsConfig->getCharset());
			
				$dcLog = new tcms_dc_log();
				$dcLog->setID($wsId);
				$dcLog->setUserID($wsUserId);
				$dcLog->setTimestamp($wsStamp);
				$dcLog->setIP($wsIP);
				$dcLog->setModule($wsModule);
				$dcLog->setText($wsText);
				
				$arrLogs[$count] = $dcLog;
				
				$count++;
			}
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
		
		return $arrLogs;
	}
	
	
	
	/**
	 * Write a entry into the log
	 *
	 * @param String $userId
	 * @param String $module
	 * @param String $text
	 */
	public function WriteEntry($userId, $module, $text) {
		$text = $this->encodeText($text, '2', $this->_tcmsConfig->getCharset());
		
		// uid
		$uid = $this->getNewUID(32, 'log');
		
		// ip
		$ip = getenv('REMOTE_ADDR');
		
		if($ip == '') {
			$ip = '127.0.0.1';
		}
		
		// stamp
		$stamp = time();
		
		// save
		if($this->_choosenDB == 'xml') {
			$xmluser = new xmlparser($this->_path.'/tcms_log/'.$stamp.'_'.$uid.'.xml', 'w');
			$xmluser->xmlDeclaration();
			$xmluser->xmlSection('log');
			
			$xmluser->writeValue('uid', $uid);
			$xmluser->writeValue('user_uid', $userId);
			$xmluser->writeValue('stamp', $stamp);
			$xmluser->writeValue('ip', $ip);
			$xmluser->writeValue('module', $module);
			$xmluser->writeValue('text', $text);
			
			$xmluser->xmlSectionBuffer();
			$xmluser->xmlSectionEnd('log');
			unset($xmluser);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->_sqlUser, 
				$this->_sqlPass, 
				$this->_sqlHost, 
				$this->_sqlDB, 
				$this->_sqlPort
			);
			
			switch($this->_choosenDB){
				case 'mysql':
					$newSQLColumns = '`user_uid`, `stamp`, `ip`, `module`, `text`';
					break;
				
				case 'pgsql':
					$newSQLColumns = '"user_uid", "stamp", "ip", "module", "text"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[user_uid], [stamp], [ip], [module], [text]';
					break;
			}
			
			$newSQLData = "'".$userId."', "
			.$stamp.", "
			."'".$ip."', "
			."'".$module."', "
			."'".$text."'";
			
			$sqlQR = $sqlAL->createOne(
				$this->_sqlPrefix.'log', 
				$newSQLColumns, 
				$newSQLData, 
				$uid
			);
			
			$sqlAL->freeResult($sqlQR);
			unset($sqlAL);
		}
	}
}

?>
