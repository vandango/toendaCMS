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
 * @version 0.3.0
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
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 * 
 * --------------------------------------------------------
 * PROPERTIES
 * --------------------------------------------------------
 * 
 * setTcmsTimeObj              -> Set the tcms_time object
 * setTcmsHtmlObj              -> Set the tcms_html object
 * 
 * --------------------------------------------------------
 * PRIVATE MEMBERS
 * --------------------------------------------------------
 * 
 * _getPathContent                           -> Return a array of all files or directory's inside a path
 *
 * --------------------------------------------------------
 * PUBLIC MEMBERS
 * --------------------------------------------------------
 * 
 * searchNews                  -> Search in news
 * searchDocuments             -> Search in documents
 * 
 * </code>
 * 
 */


class tcms_search extends tcms_main {
	// global informaton
	private $m_CHARSET;
	private $m_path;
	private $m_skin;
	private $m_admin;
	private $_tcmsTime;
	private $_tcmsHtml;
	private $_tcmsConfig;
	
	// database information
	private $m_choosenDB;
	private $m_sqlUser;
	private $m_sqlPass;
	private $m_sqlHost;
	private $m_sqlDB;
	private $m_sqlPort;
	private $m_sqlPrefix;
	
	
	
	// -------------------------------------------------
	// CONSTRUCTORS
	// -------------------------------------------------
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $charset
	 * @param String $skin
	 * @param String $tcms_administer_path = 'data'
	 * @param String $usergroup
	 * @param Object tcmsTimeObj = null
	 * @param Object $tcmsHtmlObj = null
	 * @param Object $tcmsConfigObj = null
	 */
	public function __construct($charset, $skin, $tcms_administer_path = 'data', $usergroup, $tcmsTimeObj = null, $tcmsHtmlObj = null, $tcmsConfigObj = null) {
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->m_skin = $skin;
		$this->administer = $tcms_administer_path;
		$this->m_admin = $usergroup;
		$this->_tcmsTime = $tcmsTimeObj;
		$this->_tcmsHtml = $tcmsHtmlObj;
		$this->_tcmsConfig = $tcmsConfigObj;
		
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
	 * @param Object $value
	 */
	public function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Set the tcms_html object
	 *
	 * @param Object $value
	 */
	public function setTcmsHtmlObj($value) {
		$this->_tcmsHtml = $value;
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
	 * Search in news
	 *
	 * @param String $searchWord
	 * @param String $language
	 * @return Integer
	 */
	public function searchNews($searchWord, $language) {
		$sc = 0;
		
		parent::setCurrentLang($language);
		
		if($this->m_choosenDB == 'xml') {
			$arr_searchfiles = $this->_getPathContent(
				$this->m_path.'/tcms_news/', 
				false, 
				'.xml'
			);
			
			if($this->isArray($arr_searchfiles)) {
				foreach($arr_searchfiles as $skey => $sval) {
					//echo $sval.'<br>';
					$search_xml = new xmlparser($this->m_path.'/tcms_news/'.$sval,'r');
					
					$acs = $search_xml->readSection('news', 'access');
					
					$canRead = $this->checkAccess($acs, $is_admin);
					
					if($canRead) {
						$out = $search_xml->search_value_front('news', 'newstext', $searchword);
						
						if($out != false) {
							$tit = $search_xml->readSection('news', 'title');
							$date = $search_xml->readSection('news', 'date');
							$time = $search_xml->readSection('news', 'time');
							
							$tit = $this->decodeText($tit, '2', $c_charset);
							
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=newsmanager&amp;news='.substr($sval, 0, 10).'&amp;s='.$this->m_skin
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
							.'<div class="search_result">'
							.'<span class="text_small">'.$date.' - '.$time.'</span>'
							.'</div>'
							.'<br />';
							
							$sc++;
						}
						else {
							$out = $search_xml->search_value_front('news', 'title', $searchword);
							
							if($out != false) {
								$tit = $search_xml->readSection('news', 'title');
								$date = $search_xml->readSection('news', 'date');
								$time = $search_xml->readSection('news', 'time');
								
								$tit = $this->decodeText($tit, '2', $c_charset);
								
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id=newsmanager&amp;news='.substr($sval, 0, 10).'&amp;s='.$this->m_skin
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlConvertToSEO($link);
								
								echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
								.'<div class="search_result">'
								.'<span class="text_small">'.$date.' - '.$time.'</span>'
								.'</div>'
								.'<br />';
								
								$sc++;
							}
						}
					}
				}
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer(
				$this->m_choosenDB, 
				$this->_tcmsTime
			);
			
			$sqlCN = $sqlAL->Connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_admin) {
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
			
			$searchWord2Percent = str_replace(' ', '%', $searchWord);
			
			switch($this->m_choosenDB) {
				case 'mysql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."news"
					." WHERE ( `access` = 'Public' "
					.$strAdd
					//." AND (( `newstext` REGEXP '".$searchword."' OR `newstext` LIKE '%".$searchWord2Percent."%' )"
					//." OR ( `title` REGEXP '".$searchword."' OR `title` LIKE '%".$searchWord2Percent."%' ))"
					." AND (( `newstext` LIKE '%".$searchWord2Percent."%' )"
					." OR ( `title` LIKE '%".$searchWord2Percent."%' ))"
					." AND (`language` = '".$language."')";
					break;
				
				case 'pgsql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."news"
					." WHERE ( access = 'Public' "
					.$strAdd
					." AND (( newstext LIKE '%".$searchWord2Percent."%' )"
					." OR ( title LIKE '%".$searchWord2Percent."%' ))"
					." AND (language = '".$language."')";
					break;
				
				case 'mssql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."news"
					." WHERE ( [access] = 'Public' "
					.$strAdd
					." AND (( [newstext] LIKE '%".$searchWord2Percent."%' )"
					." OR ( [title] LIKE '%".$searchWord2Percent."%' ))"
					." AND ([language] = '".$language."')";
					break;
			}
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0) {
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
					$tit  = $sqlObj->title;
					$date = $sqlObj->date;
					$time = $sqlObj->time;
					$uid  = $sqlObj->uid;
					
					if($tit  == NULL){ $tit  = ''; }
					if($date == NULL){ $date = ''; }
					if($time == NULL){ $time = ''; }
					if($uid  == NULL){ $uid  = ''; }
					
					$tit = $this->decodeText($tit, '2', $this->m_CHARSET);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=newsmanager&amp;news='.$uid.'&amp;s='.$this->m_skin
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
					.$this->_tcmsHtml->searchResultPanel($date.' - '.$time)
					.'<br />';
					
					$sc++;
				}
			}
		}
		
		return $sc;
	}
	
	
	
	/**
	 * Search in documents
	 *
	 * @param String $searchWord
	 * @param String $language
	 * @return Integer
	 */
	public function searchDocuments($searchWord, $language) {
		$sc = 0;
		
		parent::setCurrentLang($language);
		
		if($this->m_choosenDB == 'xml') {
			$arr_searchfiles = $this->_getPathContent(
				$this->m_path.'/tcms_content/', 
				false, 
				'.xml'
			);
			
			if($this->isArray($arr_searchfiles)) {
				foreach($arr_searchfiles as $skey => $sval) {
					$xml = new xmlparser($this->m_path.'/tcms_content/'.$sval,'r');
					
					$acs = $xml->read_section('main', 'access');
					
					$canRead = $this->checkAccess($acs, $this->m_admin);
					
					if($canRead) {
						$out = $xml->search_value_front('main', 'content00', $searchWord);
						
						if($out != false) {
							$tit = $xml->readSection('main', 'title');
							$key = $xml->readSection('main', 'key');
							
							$toendaScript = new toendaScript($key);
							$key = $toendaScript->toendaScript_trigger();
							$key = $toendaScript->checkSEO($key, $imagePath);
							
							$tit = $this->decodeText($tit, '2', $this->m_CHARSET);
							$key = $this->decodeText($key, '2', $this->m_CHARSET);
							
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $this->urlConvertToSEO($link);
							
							echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
							echo $this->_tcmsHtml->searchResultPanel($key);
							echo '<br />';
							
							$sc++;
							
							$xml->flush();
							unset($xml);
						}
						else {
							$out = $xml->search_value_front('main', 'key', $searchWord);
							
							if($out != false) {
								$tit = $xml->readSection('main', 'title');
								$key = $xml->readSection('main', 'key');
								
								$toendaScript = new toendaScript($key);
								$key = $toendaScript->toendaScript_trigger();
								$key = $toendaScript->checkSEO($key, $imagePath);
								
								$tit = $this->decodeText($tit, '2', $this->m_CHARSET);
								$key = $this->decodeText($key, '2', $this->m_CHARSET);
								
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $this->urlConvertToSEO($link);
								
								echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
								echo $this->_tcmsHtml->searchResultPanel($key);
								echo '<br />';
								
								$sc++;
								
								$xml->flush();
								unset($xml);
							}
							else {
								$out = $xml->search_value_front('main', 'title', $searchWord);
								
								if($out != false) {
									$tit = $xml->readSection('main', 'title');
									$key = $xml->readSection('main', 'key');
									
									$toendaScript = new toendaScript($key);
									$key = $toendaScript->toendaScript_trigger();
									$key = $toendaScript->checkSEO($key, $imagePath);
									
									$tit = $this->decodeText($tit, '2', $this->m_CHARSET);
									$key = $this->decodeText($key, '2', $this->m_CHARSET);
									
									$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
									.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
									.( isset($lang) ? '&amp;lang='.$lang : '' );
									$link = $this->urlConvertToSEO($link);
									
									echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
									echo $this->_tcmsHtml->searchResultPanel($key);
									echo '<br />';
									
									$sc++;
									
									$xml->flush();
									unset($xml);
								}
							}
						}
					}
				}
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer(
				$this->m_choosenDB, 
				$this->_tcmsTime
			);
			
			$sqlCN = $sqlAL->Connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_admin) {
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
			
			$searchWord2Percent = str_replace(' ', '%', $searchWord);
			
			switch($this->m_choosenDB) {
				case 'mysql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."content"
					." WHERE ( `access` = 'Public' "
					.$strAdd
					//." AND (( `content00` REGEXP '".$searchWord."' OR `content00` LIKE '%".$searchWord2Percent."%' )"
					//." OR ( `key` REGEXP '".$searchWord."' OR `key` LIKE '%".$searchWord2Percent."%' )"
					//." OR ( `title` REGEXP '".$searchWord."' OR `title` LIKE '%".$searchWord2Percent."%' ))"
					." AND (( `content00` LIKE '%".$searchWord2Percent."%' )"
					." OR ( `key` LIKE '%".$searchWord2Percent."%' )"
					." OR ( `title` LIKE '%".$searchWord2Percent."%' ))"
					." AND ( `language` = '".$language."')";
					break;
				
				case 'pgsql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."content"
					." WHERE ( access = 'Public' "
					.$strAdd
					." AND (( content00 LIKE '%".$searchWord2Percent."%' )"
					." OR ( key LIKE '%".$searchWord2Percent."%' )"
					." OR ( title LIKE '%".$searchWord2Percent."%' ))"
					." AND ( language = '".$language."')";
					break;
				
				case 'mssql':
					$strSQL = "SELECT *"
					." FROM [".$this->m_sqlPrefix."content]"
					." WHERE ( [access] = 'Public' "
					.$strAdd
					." AND (( [content00] LIKE '%".$searchWord2Percent."%' )"
					." OR ( [key] LIKE '%".$searchWord2Percent."%' )"
					." OR ( [title] LIKE '%".$searchWord2Percent."%' ))"
					." AND ( [language] = '".$language."')";
					break;
			}
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0) {
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
					$tit = $sqlObj->title;
					$key = $sqlObj->key;
					$uid = $sqlObj->uid;
					
					if($tit == NULL) { $tit = ''; }
					if($key == NULL) { $key = ''; }
					if($uid == NULL) { $uid = ''; }
					
					$toendaScript = new toendaScript($key);
					$key = $toendaScript->toendaScript_trigger();
					$key = $toendaScript->checkSEO($key, $imagePath);
					
					$tit = $this->decodeText($tit, '2', $this->m_CHARSET);
					$key = $this->decodeText($key, '2', $this->m_CHARSET);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id='.$uid.'&amp;s='.$this->m_skin
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
					.$this->_tcmsHtml->searchResultPanel($key.'&nbsp;')
					.'<br />';
					
					$sc++;
				}
			}
		}
		
		return $sc;
	}
}

?>
