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
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Statistics
 *
 * This class is used to write all the website statistics.
 *
 * @version 0.2.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                -> PHP5 Constructor
 * tcms_error                 -> PHP4 Constructor
 * __destruct                 -> PHP5 Destructor
 * _tcms_error                -> PHP4 Destructor
 *
 * countSiteURL($s)           -> Count a click and remove the template string from the url
 * countBrowserInfo           -> Saves the browser information data
 * getBrowser($browserString) -> Returns the Browser Software
 * getOS($osString)           -> Returns the Operating System
 *
 */


class tcms_statistics {
	var $m_CHARSET;
	var $_ipUID;
	var $_tcmsPath;
	var $_tcmsMain;
	
	// database information
	var $_choosenDB;
	var $_sqlUser;
	var $_sqlPass;
	var $_sqlHost;
	var $_sqlDB;
	var $_sqlPort;
	var $_db_prefix;
	
	
	
	/**
	 * PHP5: Default constructor
	 * 
	 * @param String $charset
	 * @param String $tcms_administer_path = 'data'
	 */
	function __construct($charset, $tcms_administer_path = 'data'){
		$this->m_CHARSET = $charset;
		$this->_tcmsPath = $tcms_administer_path;
		//echo 'Constructor: '.$this->_tcmsPath.'<br>';
		
		$_tcmsMain = new tcms_main($this->_tcmsPath);
		$_tcmsMain->setDatabaseInfo($this->_choosenDB);
		
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
		
		unset($_tcmsMain);
	}
	
	
	
	/**
	 * PHP4: Default constructor
	 * 
	 * @param String $charset
	 * @param String $tcms_administer_path = 'data'
	 */
	function tcms_statistics($charset, $tcms_administer_path = 'data'){
		$this->__construct($charset, $tcms_administer_path);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_statistics(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Count the site url
	 * 
	 * @param String $s
	 */
	function countSiteURL($s){
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
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->_sqlUser, $this->_sqlPass, $this->_sqlHost, $this->_sqlDB, $this->_sqlPort);
		}
		
		$_tcmsMain = new tcms_main($this->_tcmsPath);
		$_tcmsMain->setDatabaseInfo($this->_choosenDB);
		
		
		/*
			search for value
		*/
		if($this->_choosenDB == 'xml'){
			$arr_statfiles = $_tcmsMain->readdir_ext($this->_tcmsPath.'/tcms_statistics/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics/'.$value, 'r');
					
					$stat_host = $statXML->read_value('host');
					$stat_url = $statXML->read_value('site_url');
					
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
			
			$tempQR = $sqlAL->sqlQuery($sqlSTR);
			$oldValue = $sqlAL->sqlGetNumber($tempQR);
		}
		
		
		if($oldValue == 0){
			/*
				create ip value
			*/
			$maintag = $_tcmsMain->getNewUID(32, 'statistics_ip');
			
			if($this->_choosenDB == 'xml'){
				$xmluser = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_ip/'.$maintag.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('stat_ip');
				
				$xmluser->write_value('uid', $maintag);
				$xmluser->write_value('ip', $stats_ip);
				$xmluser->write_value('value', '1');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('stat_ip');
				$xmluser->_xmlparser();
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
				$xmluser->_xmlparser();
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
				$oldStatValue = $statXML->read_value('value');
				$oldIPValue = $statXML->read_value('ip_uid');
			}
			else{
				$sqlARR = $sqlAL->sqlFetchArray($tempQR);
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
					$xmluser->_xmlparser();
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
				
				$tempIPQR = $sqlAL->sqlQuery($sqlSTR);
				$oldValueIP = $sqlAL->sqlGetNumber($tempIPQR);
				
				
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
					$sqlARRIP = $sqlAL->sqlFetchArray($tempIPQR);
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
					
					$tempIPQR = $sqlAL->sqlQuery($sqlSTRIP);
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
				$xmluser->_xmlparser();
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
			$tempQR = $sqlAL->sqlQuery($sqlSTR);
			unset($sqlAL);
		}
		
		unset($_tcmsMain);
	}
	
	
	
	/**
	 * Saves the browser informations
	 */
	function countBrowserInfo(){
		$tmpAgent = $_SERVER['HTTP_USER_AGENT'];
		$stats_browser = $this->getBrowser($tmpAgent);
		
		$tmpAgent = explode(';', $tmpAgent);
		$stats_os = $this->getOS($tmpAgent[2]);
		
		//echo '<br>os: '.$stats_os;
		//echo '<br>browser: '.$stats_browser;
		
		
		
		if($this->_choosenDB != 'xml'){
			$sqlAL = new sqlAbstractionLayer($this->_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->_sqlUser, $this->_sqlPass, $this->_sqlHost, $this->_sqlDB, $this->_sqlPort);
		}
		
		$_tcmsMain = new tcms_main($this->_tcmsPath);
		$_tcmsMain->setDatabaseInfo($this->_choosenDB);
		
		
		
		/*
			xml and sql
			software counter
		*/
		if($this->_choosenDB == 'xml'){
			$arr_statfiles = $_tcmsMain->readdir_ext(''.$this->_tcmsPath.'/tcms_statistics_os/');
			
			if(!empty($arr_statfiles) && $arr_statfiles != '' && isset($arr_statfiles)){
				foreach($arr_statfiles as $key => $value){
					$statXML = new xmlparser(''.$this->_tcmsPath.'/tcms_statistics_os/'.$value, 'r');
					
					$stat_browser = $statXML->read_value('browser');
					$stat_os = $statXML->read_value('os');
					
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
			
			$tempQR = $sqlAL->sqlQuery($sqlSTR);
			$oldValue = $sqlAL->sqlGetNumber($tempQR);
		}
		
		
		
		/*
			if no item saved
			create a new one
		*/
		if($oldValue == 0){
			$maintag = $_tcmsMain->getNewUID(32, 'statistics_ip');
			
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
				$xmluser->_xmlparser();
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
				$sqlARR = $sqlAL->sqlFetchArray($tempQR);
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
			$tempQR = $sqlAL->sqlQuery($sqlSTR);
			unset($sqlAL);
		}
		
		
		unset($_tcmsMain);
	}
	
	
	
	/**
	 * Returns the Browser Software
	 * 
	 * @return String
	 */
	function getBrowser($browserString){
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
	function getOS($osString){
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
