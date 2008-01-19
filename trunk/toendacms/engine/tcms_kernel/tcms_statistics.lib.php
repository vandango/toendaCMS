<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Statistics
|
| File:	tcms_statistics.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Statistics
 *
 * This class is used to write all the website statistics.
 *
 * @version 0.3.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 * 
 * setTcmsTimeObj              -> Set the tcms_time object
 *
 * countSiteURL                -> Count a click and remove the template string from the url
 * countBrowserInfo            -> Saves the browser information data
 * getBrowser                  -> Returns the Browser Software
 * getOS                       -> Returns the Operating System
 *
 */


class tcms_statistics extends tcms_main {
	private $m_CHARSET;
	private $_ipUID;
	private $_tcmsPath;
	//private $_tcmsMain;
	private $_tcmsTime;
	
	// database information
	private $_choosenDB;
	private $_sqlUser;
	private $_sqlPass;
	private $_sqlHost;
	private $_sqlDB;
	private $_sqlPort;
	private $_db_prefix;
	
	
	
	/**
	 * Default constructor
	 * 
	 * @param String $charset
	 * @param String $tcms_administer_path = 'data'
	 */
	public function __construct($charset, $tcms_administer_path = 'data', $tcmsTimeObj = null){
		$this->m_CHARSET = $charset;
		$this->_tcmsPath = $tcms_administer_path;
		$this->_tcmsTime = $tcmsTimeObj;
		//echo 'Constructor: '.$this->_tcmsPath.'<br>';
		
		if(file_exists($this->_tcmsPath.'/tcms_global/database.php')){
			require($this->_tcmsPath.'/tcms_global/database.php');
			
			$this->_choosenDB = $tcms_db_engine;
			$this->_sqlUser   = $tcms_db_user;
			$this->_sqlPass   = $tcms_db_password;
			$this->_sqlHost   = $tcms_db_host;
			$this->_sqlDB     = $tcms_db_database;
			$this->_sqlPort   = $tcms_db_port;
			$this->_db_prefix = $tcms_db_prefix;
		}
		else{
			$this->m_choosenDB = 'xml';
		}
		
		//$_tcmsMain = new tcms_main($this->_tcmsPath);
		//$this->setDatabaseInfo($this->_choosenDB);
		
		parent::__construct($tcms_administer_path, $tcmsTimeObj);
		//parent::setDatabaseInfo($this->db_choosenDB);
		
		//unset($_tcmsMain);
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct(){
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
	 * Count the site url
	 * 
	 * @param String $s
	 */
	public function countSiteURL($s){
		$stats_ip   = getenv('REMOTE_ADDR');
		$stats_host = $_SERVER['SERVER_NAME'];
		$stats_url  = $_SERVER['REQUEST_URI'];
		$stats_ref  = $_SERVER['HTTP_REFERER'];
		
		// noch fehlerhaft
		if(strpos($stats_url, '&s='.$s)){ $stats_url  = str_replace('&s='.$s, '', $stats_url); }
		elseif(strpos($stats_url, '&amp;s='.$s)){ $stats_url  = str_replace('&amp;s='.$s, '', $stats_url); }
		elseif(strpos($stats_url, '?s='.$s)){ $stats_url  = str_replace('?s='.$s, '', $stats_url); }
		elseif(strpos($stats_url, 's='.$s)){ $stats_url  = str_replace('s='.$s, '', $stats_url); }
		
		
		
		if($stats_ip == ''){
			$stats_remote = 'localhost';
			$stats_ip = '127.0.0.1';
		}
		else{
			$stats_remote = getHostByAddr($stats_ip);
		}
		
		
		if($this->_choosenDB != 'xml'){
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->_sqlUser, 
				$this->_sqlPass, 
				$this->_sqlHost, 
				$this->_sqlDB, 
				$this->_sqlPort
			);
		}
		
		//$_tcmsMain = new tcms_main($this->_tcmsPath);
		//$this->setDatabaseInfo($this->_choosenDB);
		
		
		/*
			search for value
		*/
		if($this->_choosenDB == 'xml'){
			$arr_statfiles = $this->getPathContent($this->_tcmsPath.'/tcms_statistics/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics/'.$value, 'r');
					
					$stat_host = $statXML->readValue('host');
					$stat_url = $statXML->readValue('site_url');
					
					if($stat_host == $stats_host && $stat_url == $stats_url){
						$tempQR = $value;
						$oldValue = 1;
						break;
					}
					else{
						$oldValue = 0;
					}
				}
			}
			else{
				$oldValue = 0;
			}
		}
		else{
			$sqlSTR = "SELECT * "
			."FROM ".$this->_db_prefix."statistics "
			."WHERE ".$this->_db_prefix."statistics.host = '".$stats_host."' "
			."AND ".$this->_db_prefix."statistics.site_url = '".$stats_url."'";
			
			$tempQR = $sqlAL->query($sqlSTR);
			$oldValue = $sqlAL->getNumber($tempQR);
		}
		
		
		if($oldValue == 0){
			/*
				create ip value
			*/
			$maintag = $this->getNewUID(32, 'statistics_ip');
			
			if($this->_choosenDB == 'xml'){
				$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$maintag.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('stat_ip');
				
				$xmluser->write_value('uid', $maintag);
				$xmluser->write_value('ip', $stats_ip);
				$xmluser->write_value('value', '1');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('stat_ip');
			}
			else{
				switch($this->_choosenDB){
					case 'mysql':
						$newSQLColumns = '`uid`, `ip`, `value`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'uid, ip, value';
						break;
				}
				
				$newSQLData = ""
				."'".$maintag."', "
				."'".$stats_ip."', "
				."1";
				
				$sqlSTR = "INSERT INTO ".$this->_db_prefix."statistics_ip "
				."( ".$newSQLColumns.") "
				."VALUES( ".$newSQLData." )";
				
				$tempQR = $sqlAL->sqlQuery($sqlSTR);
			}
			
			
			
			/*
				new value
			*/
			if($this->_choosenDB == 'xml'){
				$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics/'.$maintag.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('stat');
				
				$xmluser->write_value('host', $stats_host);
				$xmluser->write_value('site_url', $stats_url);
				$xmluser->write_value('value', '1');
				$xmluser->write_value('ip_uid', $maintag);
				$xmluser->write_value('referrer', $stats_ref);
				$xmluser->write_value('timestamp', date('Y-m-d H:i:s'));
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('stat');
			}
			else{
				switch($this->_choosenDB){
					case 'mysql':
						$newSQLColumns = '`host`, `site_url`, `value`, `ip_uid`, `referrer`, `timestamp`';
						$newSQLData = ""
						."'".$stats_host."', "
						."'".$stats_url."', "
						."1, "
						."'".$maintag."', "
						."'".$stats_ref."', "
						." NOW()";
						break;
					
					case 'pgsql':
						$newSQLColumns = 'host, site_url, value, ip_uid, referrer, "timestamp"';
						$newSQLData = ""
						."'".$stats_host."', "
						."'".$stats_url."', "
						."1, "
						."'".$maintag."', "
						."'".$stats_ref."', "
						." CURRENT_TIMESTAMP";
						break;
				}
				
				
				
				$sqlSTR = "INSERT INTO ".$this->_db_prefix."statistics "
				."( ".$newSQLColumns.") "
				."VALUES( ".$newSQLData." )";
			}
			
			
			$returnIPUID = $maintag;
		}
		else{
			/*
				old value
			*/
			
			if($this->_choosenDB == 'xml'){
				$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics/'.$tempQR, 'r');
				$oldStatValue = $statXML->readValue('value');
				$oldIPValue = $statXML->readValue('ip_uid');
			}
			else{
				$sqlARR = $sqlAL->fetchArray($tempQR);
				$oldStatValue = $sqlARR['value'];
				$oldIPValue = $sqlARR['ip_uid'];
			}
			
			
			
			/*
				search for ip value
			*/
			if($this->_choosenDB == 'xml'){
				if(!file_exists(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$oldIPValue.'.xml')){
					$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$oldIPValue.'.xml', 'w');
					$xmluser->xml_declaration();
					$xmluser->xml_section('stat_ip');
					
					$xmluser->write_value('uid', $oldIPValue);
					$xmluser->write_value('ip', $stats_ip);
					$xmluser->write_value('value', '1');
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('stat_ip');
				}
				else{
					$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$oldIPValue.'.xml', 'r');
					$oldValueIP = $statXML->read_value('value');
					xmlparser::edit_value(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$oldIPValue.'.xml', 'value', $oldValueIP, ($oldValueIP + 1));
				}
			}
			else{
				$sqlSTR = "SELECT * "
				."FROM ".$this->_db_prefix."statistics_ip "
				."WHERE ".$this->_db_prefix."statistics_ip.ip = '".$stats_ip."'";
				
				$tempIPQR = $sqlAL->query($sqlSTR);
				$oldValueIP = $sqlAL->getNumber($tempIPQR);
				
				
				if($oldValueIP == 0){
					switch($this->_choosenDB){
						case 'mysql':
							$newSQLColumns = '`uid`, `ip`, `value`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'uid, ip, value';
							break;
					}
					
					$newSQLData = ""
					."'".$oldIPValue."', "
					."'".$stats_ip."', "
					."1";
					
					$sqlSTR = "INSERT INTO ".$this->_db_prefix."statistics_ip "
					."( ".$newSQLColumns.") "
					."VALUES( ".$newSQLData." )";
					
					$tempQR = $sqlAL->sqlQuery($sqlSTR);
				}
				else{
					$sqlARRIP = $sqlAL->fetchArray($tempIPQR);
					$oldStatValueVAL = $sqlARRIP['value'];
					
					switch($this->_choosenDB){
						case 'mysql':
							$newSQLDataIP = "value = ".( $oldStatValueVAL + 1 );
							break;
						
						case 'pgsql':
							$newSQLDataIP = "value = ".( $oldStatValueVAL + 1 );
							break;
					}
					
					$sqlSTRIP = "UPDATE ".$this->_db_prefix."statistics_ip "
					."SET ".$newSQLDataIP." "
					."WHERE uid = '".$oldIPValue."' "
					."AND ip = '".$stats_ip."' ";
					
					$tempIPQR = $sqlAL->query($sqlSTRIP);
				}
			}
			
			
			
			/*
				update value's
			*/
			if($this->_choosenDB == 'xml'){
				$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics/'.$tempQR, 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('stat');
				
				$xmluser->write_value('host', $stats_host);
				$xmluser->write_value('site_url', $stats_url);
				$xmluser->write_value('value', ($oldStatValue + 1));
				$xmluser->write_value('ip_uid', substr($tempQR, 0, 32));
				$xmluser->write_value('referrer', $stats_ref);
				$xmluser->write_value('timestamp', date('Y-m-d H:i:s'));
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('stat');
			}
			else{
				switch($this->_choosenDB){
					case 'mysql':
						$newSQLData = ""
						."value = ".( $oldStatValue + 1 ).", "
						."referrer = '".$stats_ref."', "
						."timestamp = NOW()";
						break;
					
					case 'pgsql':
						$newSQLData = ""
						."value = ".( $oldStatValue + 1 ).", "
						."referrer = '".$stats_ref."', "
						."timestamp = CURRENT_TIMESTAMP";
						break;
				}
				
				
				$sqlSTR = "UPDATE ".$this->_db_prefix."statistics "
				."SET ".$newSQLData." "
				."WHERE site_url = '".$stats_url."' "
				."AND host = '".$stats_host."' ";
			}
			
			
			$returnIPUID = $oldIPValue;
		}
		
		if($this->_choosenDB != 'xml'){
			$tempQR = $sqlAL->query($sqlSTR);
			unset($sqlAL);
		}
		
		//unset($_tcmsMain);
	}
	
	
	
	/**
	 * Saves the browser informations
	 */
	public function countBrowserInfo(){
		$tmpAgent = $_SERVER['HTTP_USER_AGENT'];
		$stats_browser = $this->getBrowser($tmpAgent);
		
		$tmpAgent = explode(';', $tmpAgent);
		$stats_os = $this->getOS($tmpAgent[2]);
		
		//echo '<br>os: '.$stats_os;
		//echo '<br>browser: '.$stats_browser;
		
		
		
		if($this->_choosenDB != 'xml'){
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->_sqlUser, 
				$this->_sqlPass, 
				$this->_sqlHost, 
				$this->_sqlDB, 
				$this->_sqlPort
			);
		}
		
		//$_tcmsMain = new tcms_main($this->_tcmsPath);
		//$this->setDatabaseInfo($this->_choosenDB);
		
		
		
		/*
			xml and sql
			software counter
		*/
		if($this->_choosenDB == 'xml'){
			$arr_statfiles = $this->getPathContent(''.$this->_tcmsPath.'/tcms_statistics_os/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_os/'.$value, 'r');
					
					$stat_browser = $statXML->read_value('browser');
					$stat_os = $statXML->readValue('os');
					
					if($stat_browser == $stats_browser && $stat_os == $stats_os){
						$tempQR = $value;
						$oldValue = 1;
						break;
					}
					else{
						$oldValue = 0;
					}
				}
			}
			else{
				$oldValue = 0;
			}
		}
		else{
			$sqlSTR = "SELECT * "
			."FROM ".$this->_db_prefix."statistics_os "
			."WHERE browser = '".$stats_browser."' "
			."AND os = '".$stats_os."' ";
			
			$tempQR = $sqlAL->query($sqlSTR);
			$oldValue = $sqlAL->getNumber($tempQR);
		}
		
		
		
		/*
			if no item saved
			create a new one
		*/
		if($oldValue == 0){
			$maintag = $this->getNewUID(32, 'statistics_ip');
			
			if($this->_choosenDB == 'xml'){
				$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_os/'.$maintag.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('stat_os');
				
				$xmluser->write_value('uid', $maintag);
				$xmluser->write_value('browser', $stats_browser);
				$xmluser->write_value('os', $stats_os);
				$xmluser->write_value('value', '1');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('stat_os');
			}
			else{
				switch($this->_choosenDB){
					case 'mysql':
						$newSQLColumns = '`uid`, `browser`, `os`, `value`';
						$newSQLData = ""
						."'".$maintag."', "
						."'".$stats_browser."', "
						."'".$stats_os."', "
						."1";
						break;
					
					case 'pgsql':
						$newSQLColumns = 'uid, browser, os, value';
						$newSQLData = ""
						."'".$maintag."', "
						."'".$stats_browser."', "
						."'".$stats_os."', "
						."1";
						break;
				}
				
				
				
				$sqlSTR = "INSERT INTO ".$this->_db_prefix."statistics_os "
				."( ".$newSQLColumns.") "
				."VALUES( ".$newSQLData." )";
			}
		}
		else{
			if($this->_choosenDB == 'xml'){
				$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_os/'.$tempQR, 'r');
				$oldStatValue = $statXML->read_value('value');
				
				xmlparser::edit_value(''.$this->_tcmsPath.'/tcms_statistics_os/'.$tempQR, 'value', $oldStatValue, ($oldStatValue + 1));
			}
			else{
				$sqlARR = $sqlAL->fetchArray($tempQR);
				$oldStatValue = $sqlARR['value'];
				
				
				
				$newSQLData = "value = ".( $oldStatValue + 1 );
				
				
				
				$sqlSTR = "UPDATE ".$this->_db_prefix."statistics_os "
				."SET ".$newSQLData." "
				."WHERE browser = '".$stats_browser."' "
				."AND os = '".$stats_os."'";
			}
		}
		
		
		
		/*
			insert and
			update query
		*/
		if($this->_choosenDB != 'xml'){
			$tempQR = $sqlAL->query($sqlSTR);
			unset($sqlAL);
		}
		
		
		//unset($_tcmsMain);
	}
	
	
	
	/**
	 * Returns the Browser Software
	 * 
	 * @return String
	 */
	public function getBrowser($browserString){
		$agent = $browserString;
		
		require('tcms_browserlist.lib.php');
		
		if(preg_match('/msie[\/\sa-z]*([\d\.]*)/i', $agent, $m)
			&& !preg_match('/webtv/i', $agent)
			&& !preg_match('/omniweb/i', $agent)
			&& !preg_match('/opera/i', $agent)){
			$returnBrowser = 'Microsoft Internet Explorer '.$m[1];
		}
		elseif(preg_match('/opera ([\d\.]*)/i', $agent, $m)){
			$returnBrowser = 'Opera '.$m[1];
		}
		elseif(preg_match('/netscape.?\/([\d\.]*)/i', $agent, $m)){
			$returnBrowser = 'Netscape '.$m[1];
		}
		elseif(preg_match('/mozilla[\/\sa-z]*([\d\.]*)/i', $agent, $m)
			&& !preg_match('/gecko/i', $agent)
			&& !preg_match('/compatible/i', $agent)
			&& !preg_match('/opera/i', $agent)
			&& !preg_match('/galeon/i', $agent)
			&& !preg_match('/safari/i', $agent)){
			$returnBrowser = 'Netscape '.$m[2];
		}
		else{
			foreach($browserSearchOrder as $key){
				if(preg_match('/'.$key.'.?\/([\d\.]*)/i', $agent, $m)){
					$returnBrowser = $browsersAlias[$key].' '.$m[1];
					break;
				}
			}
		}
		
		return $returnBrowser;
	}
	
	
	
	/**
	 * Returns the Operating System
	 * 
	 * @return String
	 */
	public function getOS($osString){
		$osString = trim(strtolower($osString));
		
		require('tcms_oslist.lib.php');
		
		foreach($arrOS as $key => $value){
			$os = trim(strtolower($value['nick']));
			
			if(preg_match('/'.$os.'/i', $osString)){
				$returnOS = $value['name'];
				break;
			}
			else{
				$returnOS = 'Undefinied';
			}
		}
		
		return $returnOS;
	}
}

?>
