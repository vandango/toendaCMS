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
 * @version 0.2.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 * 
 * setTcmsTimeObj              -> Set the tcms_time object
 * setTcmsHtmlObj              -> Set the tcms_html object
 * 
 * searchDocuments()           -> search in documents
 * 
 * </code>
 * 
 */


class tcms_search extends tcms_main {
	// global informaton
	var $m_CHARSET;
	var $m_path;
	var $m_skin;
	var $m_admin;
	var $_tcmsTime;
	var $_tcmsHtml;
	
	// database information
	var $m_choosenDB;
	var $m_sqlUser;
	var $m_sqlPass;
	var $m_sqlHost;
	var $m_sqlDB;
	var $m_sqlPort;
	var $m_sqlPrefix;
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $charset
	 * @param String $skin
	 * @param String $tcms_administer_path = 'data'
	 * @param String $usergroup
	 */
	public function __construct($charset, $skin, $tcms_administer_path = 'data', $usergroup, $tcmsTimeObj = null, $tcmsHtmlObj = null){
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->m_skin = $skin;
		$this->administer = $tcms_administer_path;
		$this->m_admin = $usergroup;
		$this->_tcmsTime = $tcmsTimeObj;
		$this->_tcmsHtml = $tcmsHtmlObj;
		
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
		
		parent::setAdministerSite($tcms_administer_path);
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
	 * Set the tcms_html object
	 *
	 * @param Object $value
	 */
	public function setTcmsHtmlObj($value) {
		$this->_tcmsHtml = $value;
	}
	
	
	
	/**
	 * Seasrch in documents
	 *
	 * @param String $searchword
	 * @return Integer
	 */
	public function searchDocuments($searchword){
		if($this->m_choosenDB == 'xml'){
			$arr_searchfiles = $this->load_xml_files($this->m_path.'/tcms_content/', 'files');
			
			foreach($arr_searchfiles as $skey => $sval){
				$xml = new xmlparser($this->m_path.'/tcms_content/'.$sval,'r');
				
				$acs = $xml->read_section('main', 'access');
				
				$canRead = $this->checkAccess($acs, $this->m_admin);
				
				if($canRead){
					$out = $xml->search_value_front('main', 'content00', $searchword);
					
					if($out != false){
						$tit = $xml->readSection('main', 'title');
						$key = $xml->readSection('main', 'key');
						
						$toendaScript = new toendaScript($key);
						$key = $toendaScript->toendaScript_trigger();
						$key = $toendaScript->checkSEO($key, $imagePath);
						
						$tit = $this->decodeText($tit, '2', $c_charset);
						$key = $this->decodeText($key, '2', $c_charset);
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
						echo $this->_tcmsHtml->searchResultPanel($key);
						echo '<br />';
						
						$sc++;
						
						$xml->flush();
						$xml->_xmlparser();
						unset($xml);
					}
					else{
						$out = $xml->search_value_front('main', 'key', $searchword);
						
						if($out != false){
							$tit = $xml->readSection('main', 'title');
							$key = $xml->readSection('main', 'key');
							
							$toendaScript = new toendaScript($key);
							$key = $toendaScript->toendaScript_trigger();
							$key = $toendaScript->checkSEO($key, $imagePath);
							
							$tit = $this->decodeText($tit, '2', $c_charset);
							$key = $this->decodeText($key, '2', $c_charset);
							
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $this->urlConvertToSEO($link);
							
							echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
							echo $this->_tcmsHtml->searchResultPanel($key);
							echo '<br />';
							
							$sc++;
							
							$xml->flush();
							$xml->_xmlparser();
							unset($xml);
						}
						else{
							$out = $xml->search_value_front('main', 'title', $searchword);
							
							if($out != false){
								$tit = $xml->readSection('main', 'title');
								$key = $xml->readSection('main', 'key');
								
								$toendaScript = new toendaScript($key);
								$key = $toendaScript->toendaScript_trigger();
								$key = $toendaScript->checkSEO($key, $imagePath);
								
								$tit = $this->decodeText($tit, '2', $c_charset);
								$key = $this->decodeText($key, '2', $c_charset);
								
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id='.substr($sval, 0, 5).'&amp;s='.$this->m_skin
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $this->urlConvertToSEO($link);
								
								echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
								echo $this->_tcmsHtml->searchResultPanel($key);
								echo '<br />';
								
								$sc++;
								
								$xml->flush();
								$xml->_xmlparser();
								unset($xml);
							}
						}
					}
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->Connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_admin){
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
			
			$searchword2Percent = str_replace(' ', '%', $searchword);
			
			switch($this->m_choosenDB){
				case 'mysql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."content"
					." WHERE ( `access` = 'Public' "
					.$strAdd
					." ( "
					." AND ( `content00` REGEXP '".$searchword."' OR `content00` LIKE '%".$searchword2Percent."%' )"
					." OR ( `key` REGEXP '".$searchword."' OR `key` LIKE '%".$searchword2Percent."%' )"
					." OR ( `title` REGEXP '".$searchword."' OR `title` LIKE '%".$searchword2Percent."%' )"
					." )";
					break;
				
				case 'pgsql':
					$strSQL = "SELECT *"
					." FROM ".$this->m_sqlPrefix."content"
					." WHERE ( access = 'Public' "
					.$strAdd
					." ( "
					." AND ( content00 LIKE '%".$searchword2Percent."%' )"
					." OR ( key LIKE '%".$searchword2Percent."%' )"
					." OR ( title LIKE '%".$searchword2Percent."%' )"
					." )";
					break;
				
				case 'mssql':
					$strSQL = "SELECT *"
					." FROM [".$this->m_sqlPrefix."content]"
					." WHERE ( [access] = 'Public' "
					.$strAdd
					." ( "
					." AND ( [content00] LIKE '%".$searchword2Percent."%' )"
					." OR ( [key] LIKE '%".$searchword2Percent."%' )"
					." OR ( [title] LIKE '%".$searchword2Percent."%' )"
					." )";
					break;
			}
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0){
				while($sqlObj = $sqlAL->fetchObject($sqlQR)){
					$tit = $sqlObj->title;
					$key = $sqlObj->key;
					$uid = $sqlObj->uid;
					
					if($tit == NULL){ $tit = ''; }
					if($key == NULL){ $key = ''; }
					if($uid == NULL){ $uid = ''; }
					
					$toendaScript = new toendaScript($key);
					$key = $toendaScript->toendaScript_trigger();
					$key = $toendaScript->checkSEO($key, $imagePath);
					
					$tit = $this->decodeText($tit, '2', $c_charset);
					$key = $this->decodeText($key, '2', $c_charset);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id='.$uid.'&amp;s='.$this->m_skin
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
					echo $this->_tcmsHtml->searchResultPanel($key);
					echo '<br />';
					
					$sc++;
				}
			}
		}
		
		return $sc;
	}
}

?>
