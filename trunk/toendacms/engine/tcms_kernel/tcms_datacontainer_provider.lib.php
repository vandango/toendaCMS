<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Data Container Provider
|
| File:	tcms_datacontainer_provider.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Data Container Provider
 *
 * This class is used for the datacontainer.
 *
 * @version 1.2.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * ---------------------------------------------
 * TCMS Data Container methods
 * ---------------------------------------------
 * 
 * __construct                               -> PHP5 Constructor
 * tcms_datacontainer_provider               -> PHP4 Constructor
 * 
 * setTcmsTimeObj                            -> Set the tcms_time object
 *
 * getNewsDC                                 -> Get a specific news data container
 * getNewsDCList                             -> Get a list of news data container
 * getNewsTitle                              -> Get the title of a news element
 * getNewsIdByTitle                          -> Get the id of a news element by its title
 * getXmlIdFromNewsLanguage                  -> Get the id of a language news file
 * generateFeed                              -> ReGenerate the news syndication feeds
 * generateCommentsFeed                      -> ReGenerate the news comments syndication feeds
 *
 * getCommentDCList                          -> Get a list of news data container
 *
 * getContentDC                              -> Get a specific content data container
 * getContentAccess                          -> Get the access infos from a content item
 * getContentLanguages                       -> Get a list of content languages
 * getXmlIdFromContentLanguage               -> Get the id of a language content file
 * getContentTitle                           -> Get the title of a content element
 * getContentIdByTitle                       -> Get the id of a content element by its title
 *
 * getImpressumDC                            -> Get a impressum data container
 * getFrontpageDC                            -> Get a frontpage data container
 * getNewsmanagerDC                          -> Get a newsmanager data container
 * getContactformDC                          -> Get a contactform data container
 * getProductsDC                             -> Get a products data container
 * getImagegalleryDC                         -> Get a imagegallery data container
 *
 * getSidebarModuleDC()                      -> Get a sidebarmodul data container
 * getSidebarExtensionSettings()             -> Get the sidebar extension settings
 * 
 * </code>
 *
 */


class tcms_datacontainer_provider extends tcms_main {
	// global informaton
	private $m_CHARSET;
	private $m_path;
	private $_tcmsTime;
	
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
	 * @param Object $tcmsTimeObj = null
	 */
	function __construct($tcms_administer_path = 'data', $charset, $tcmsTimeObj = null){
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->_tcmsTime = $tcmsTimeObj;
		
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
		//parent::__construct($tcms_administer_path, $tcmsTimeObj);
		//parent::setDatabaseInfo($this->m_choosenDB);
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $tcms_administer_path = 'data'
	 * @param String $charset
	 * @param Object $tcmsTimeObj = null
	 */
	function tcms_datacontainer_provider($tcms_administer_path = 'data', $charset, $tcmsTimeObj = null){
		$this->__construct($tcms_administer_path, $charset, $tcmsTimeObj);
	}
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function _tcms_datacontainer_provider(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Get a news data container
	 *
	 * @param String $language
	 * @param String $newsID = ''
	 * @param String $usergroup = ''
	 * @return tcms_news_dc Object
	 */
	function getNewsDC($language, $newsID, $usergroup){
		$newsDC = new tcms_dc_news();
		
		if($this->m_choosenDB == 'xml'){
			$xml = new xmlparser($this->m_path.'/tcms_news/'.$newsID.'.xml', 'r');
			$wsAcs = $xml->readSection('news', 'access');
			
			$show_this_news = $this->checkAccess($wsAcs, $usergroup);
			
			if($show_this_news == true){
				$wsTitle = $xml->readSection('news', 'title');
				$wsAutor = $xml->readSection('news', 'autor');
				$wsNews  = $xml->readSection('news', 'newstext');
				$wsPub   = $xml->readSection('news', 'published');
				$wsDate  = $xml->readSection('news', 'date');
				$wsTime  = $xml->readSection('news', 'time');
				$wsOrder = $xml->readSection('news', 'order');
				$wsStamp = $xml->readSection('news', 'stamp');
				$wsCat   = $xml->readSection('news', 'category');
				$wsCmt   = $xml->readSection('news', 'comments_enabled');
				$wsPubD  = $xml->readSection('news', 'publish_date');
				$wsImage = $xml->readSection('news', 'image');
				$wsSOF   = $xml->readSection('news', 'show_on_frontpage');
				
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				if($wsTitle == false) $wsTitle = '';
				if($wsAutor == false) $wsAutor = '';
				if($wsNews  == false) $wsNews  = '';
				//if($wsPub   == false) $wsPub   = '';
				if($wsTime  == false) $wsTime  = '';
				if($wsDate  == false) $wsDate  = '';
				if($wsOrder == false) $wsOrder = '';
				if($wsStamp == false) $wsStamp = '';
				if($wsCat   == false) $wsCat   = '';
				if($wsPubD  == false) $wsPubD  = '';
				//if($wsCmt   == false) $wsCmt   = '';
				if($wsImage == false) $wsImage = '';
				if($wsAcs   == false) $wsAcs   = '';
				if($wsSOF   == false) $wsSOF   = 1;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($usergroup){
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
			
			$sqlStr = "SELECT * "
			."FROM ".$this->m_sqlPrefix."news "
			."WHERE uid = '".$newsID."' "
			."AND language = '".$language."' "
			."AND ( access = 'Public' "
			.$strAdd;
			
			$sqlQR = $sqlAL->query($sqlStr);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsTitle = $sqlObj->title;
			$wsAutor = $sqlObj->autor;
			$wsNews  = $sqlObj->newstext;
			$wsPub   = $sqlObj->published;
			$wsTime  = $sqlObj->time;
			$wsDate  = $sqlObj->date;
			$wsOrder = $sqlObj->uid;
			$wsStamp = $sqlObj->stamp;
			$wsCmt   = $sqlObj->comments_enabled;
			$wsPubD  = $sqlObj->publish_date;
			$wsImage = $sqlObj->image;
			$wsAcs   = $sqlObj->access;
			$wsCat   = $sqlObj->category;
			$wsSOF   = $sqlObj->show_on_frontpage;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsTitle == NULL) $wsTitle = '';
			if($wsAutor == NULL) $wsAutor = '';
			if($wsNews  == NULL) $wsNews  = '';
			//if($wsPub   == NULL) $wsPub   = '';
			if($wsTime  == NULL) $wsTime  = '';
			if($wsDate  == NULL) $wsDate  = '';
			if($wsOrder == NULL) $wsOrder = '';
			if($wsStamp == NULL) $wsStamp = '';
			if($wsCat   == NULL) $wsCat   = '';
			if($wsPubD  == NULL) $wsPubD  = '';
			if($wsCmt   == NULL) $wsCmt   = '';
			if($wsImage == NULL) $wsImage = '';
			if($wsAcs   == NULL) $wsAcs   = '';
			if($wsSOF   == NULL) $wsSOF   = 1;
		}
		
		$wsTitle = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsAutor = $this->decodeText($wsAutor, '2', $this->m_CHARSET);
		$wsNews  = $this->decodeText($wsNews, '2', $this->m_CHARSET);
		
		$newsDC->setTitle($wsTitle);
		$newsDC->setAutor($wsAutor);
		$newsDC->setDate($wsDate);
		$newsDC->setTime($wsTime);
		$newsDC->setText($wsNews);
		$newsDC->setID($wsOrder);
		$newsDC->setTimestamp($wsStamp);
		$newsDC->setPublished($wsPub);
		$newsDC->setPublishDate($wsPubD);
		$newsDC->setCommentsEnabled($wsCmt);
		$newsDC->setImage($wsImage);
		$newsDC->setCategories($wsCat);
		$newsDC->setAccess($wsAcs);
		$newsDC->setShowOnFrontpage($wsSOF);
		
		return $newsDC;
	}
	
	
	
	/**
	 * Get a list of news data container
	 * 
	 * @param String $language
	 * @param String $usergroup
	 * @param Integer $amount
	 * @param String $published = '1'
	 * @param Boolean $withShowOnFrontpage = false
	 * @return tcms_news_dc Object Array
	 */
	function getNewsDCList($language, $usergroup = '', $amount, $published = '1', $withShowOnFrontpage = false){
		$doFill = false;
		
		if($this->m_choosenDB == 'xml') {
			$arr_filename = $this->getPathContent($this->m_path.'/tcms_news/');
			
			$count = 0;
			
			if($this->isArray($arr_filename)) {
				foreach($arr_filename as $nkey => $nvalue) {
					$xml = new xmlparser($this->m_path.'/tcms_news/'.$nvalue,'r');
					
					$is_pub  = $xml->readSection('news', 'published');
					$is_date = $xml->readSection('news', 'publish_date');
					$is_auth = $xml->readSection('news', 'access');
					$is_lang = $xml->readSection('news', 'language');
					
					if($is_lang == $language) {
						$show_this_news = $this->checkAccess($is_auth, $usergroup);
						
						if($show_this_news == true) {
							$is_date = mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
							
							if($is_pub == 1 && $is_date < time()) {
								$is_sof = $xml->readSection('news', 'show_on_frontpage');
								//if($is_sof == false) $is_sof  = 1;
								
								if($withShowOnFrontpage) {
									if($is_sof == '1') {
										$doFill = true;
									}
									else {
										$doFill = false;
									}
								}
								else {
									$doFill = true;
								}
								
								if($doFill) {
									$n_maintag = substr($arr_filename[$nkey], 0, 10);
									$arr_news['title'][$count] = $xml->readSection('news', 'title');
									$arr_news['autor'][$count] = $xml->readSection('news', 'autor');
									$arr_news['news'][$count]  = $xml->readSection('news', 'newstext');
									$arr_news['pub'][$count]   = $is_pub;
									$arr_news['date'][$count]  = $xml->readSection('news', 'date');
									$arr_news['time'][$count]  = $xml->readSection('news', 'time');
									$arr_news['order'][$count] = $xml->readSection('news', 'order');
									$arr_news['stamp'][$count] = $xml->readSection('news', 'stamp');
									$arr_news['cat'][$count]   = $xml->readSection('news', 'category');
									$arr_news['cmt'][$count]   = $xml->readSection('news', 'comments_enabled');
									$arr_news['pubd'][$count]  = $xml->readSection('news', 'publish_date');
									$arr_news['image'][$count] = $xml->readSection('news', 'image');
									$arr_news['acs'][$count]   = $is_auth;
									$arr_news['sof'][$count]   = $is_sof;
									
									$xml->flush();
									$xml->_xmlparser();
									
									if($arr_news['title'][$count] == false) $arr_news['title'][$count] = '';
									if($arr_news['autor'][$count] == false) $arr_news['autor'][$count] = '';
									if($arr_news['news'][$count]  == false) $arr_news['news'][$count]  = '';
									if($arr_news['pub'][$count]   == false) $arr_news['pub'][$count]   = '';
									if($arr_news['time'][$count]  == false) $arr_news['time'][$count]  = '';
									if($arr_news['date'][$count]  == false) $arr_news['date'][$count]  = '';
									if($arr_news['order'][$count] == false) $arr_news['order'][$count] = '';
									if($arr_news['stamp'][$count] == false) $arr_news['stamp'][$count] = '';
									if($arr_news['cat'][$count]   == false) $arr_news['cat'][$count]   = '';
									if($arr_news['pubd'][$count]  == false) $arr_news['pubd'][$count]  = '';
									if($arr_news['cmt'][$count]   == false) $arr_news['cmt'][$count]   = '';
									if($arr_news['image'][$count] == false) $arr_news['image'][$count] = '';
									if($arr_news['acs'][$count]   == false) $arr_news['acs'][$count]   = '';
									
									$arr_news['title'][$count] = $this->decodeText($arr_news['title'][$count], '2', $this->m_CHARSET);
									$arr_news['autor'][$count] = $this->decodeText($arr_news['autor'][$count], '2', $this->m_CHARSET);
									$arr_news['news'][$count]  = $this->decodeText($arr_news['news'][$count], '2', $this->m_CHARSET);
									
									$count++;
									$counting++;
								}
							}
						}
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
			
			
			if(is_array($arr_news['stamp']) && isset($arr_news['stamp'])){
				array_multisort(
					$arr_news['stamp'], SORT_DESC, 
					$arr_news['date'], SORT_DESC, 
					$arr_news['time'], SORT_DESC, 
					$arr_news['title'], SORT_DESC, 
					$arr_news['news'], SORT_DESC, 
					$arr_news['autor'], SORT_DESC, 
					$arr_news['order'], SORT_DESC, 
					$arr_news['cmt'], SORT_DESC, 
					$arr_news['cat'], SORT_DESC, 
					$arr_news['image'], SORT_DESC, 
					$arr_news['pubd'], SORT_DESC, 
					$arr_news['pub'], SORT_DESC, 
					$arr_news['acs'], SORT_DESC, 
					$arr_news['sof'], SORT_DESC
				);
			}
			
			
			if(is_array($arr_news['stamp']) && isset($arr_news['stamp'])){
				$count = 0;
				$counting = 0;
				
				unset($n_key);
				
				foreach($arr_news['stamp'] as $n_key => $n_value){
					$all = false;
					
					if($amount == 0) {
						$all = true;
					}
					else {
						if($counting < $amount){
							$all = true;
						}
						else {
							$all = false;
						}
					}
					
					if($all) {
						$newsDC = new tcms_dc_news();
						
						$newsDC->setTitle($arr_news['title'][$n_key]);
						$newsDC->setAutor($arr_news['autor'][$n_key]);
						$newsDC->setDate($arr_news['date'][$n_key]);
						$newsDC->setTime($arr_news['time'][$n_key]);
						$newsDC->setText($arr_news['news'][$n_key]);
						$newsDC->setID($arr_news['order'][$n_key]);
						$newsDC->setTimestamp($arr_news['stamp'][$n_key]);
						$newsDC->setPublished($arr_news['pub'][$n_key]);
						$newsDC->setPublishDate($arr_news['pubd'][$n_key]);
						$newsDC->setCommentsEnabled($arr_news['cmt'][$n_key]);
						$newsDC->setImage($arr_news['image'][$n_key]);
						$newsDC->setCategories($arr_news['cat'][$n_key]);
						$newsDC->setAccess($arr_news['acs'][$n_key]);
						$newsDC->setShowOnFrontpage($arr_news['sof'][$n_key]);
						
						$arrReturn[$count] = $newsDC;
						
						$count++;
					}
					
					$counting++;
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_choosenDB){
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
			
			switch($usergroup){
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
			
			if($withShowOnFrontpage) {
				$strAddSOF = "";// AND show_on_frontpage = 1 ";
			}
			else {
				$strAddSOF = "";
			}
			
			$sqlStr = "SELECT * ".$dbLimitFront
			." FROM ".$this->m_sqlPrefix."news "
			." WHERE published = ".$published." "
			." AND language = '".$language."' "
			." AND ( access = 'Public' "
			.$strAdd
			.$strAddSOF
			." ORDER BY stamp DESC, date DESC, time DESC ".$dbLimitBack;
			
			$sqlQR = $sqlAL->query($sqlStr);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$wsPubD = $sqlARR['publish_date'];
				
				$wsPubD = mktime(substr($wsPubD, 11, 2), substr($wsPubD, 14, 2), 0, substr($wsPubD, 3, 2), substr($wsPubD, 0, 2), substr($wsPubD, 6, 4));
				
				if($wsPubD <= time()) {
					$wsSOF   = $sqlObj->show_on_frontpage;
					if($wsSOF   == NULL) $wsSOF   = 1;
					
					if($withShowOnFrontpage) {
						if($wsSOF == '1') {
							$doFill = true;
						}
						else {
							$doFill = false;
						}
					}
					else {
						$doFill = true;
					}
					
					if($doFill) {
						$newsDC = new tcms_dc_news();
						
						$wsTitle = $sqlObj->title;
						$wsAutor = $sqlObj->autor;
						$wsNews  = $sqlObj->newstext;
						$wsPub   = $sqlObj->published;
						$wsTime  = $sqlObj->time;
						$wsDate  = $sqlObj->date;
						$wsOrder = $sqlObj->uid;
						$wsStamp = $sqlObj->stamp;
						$wsCmt   = $sqlObj->comments_enabled;
						$wsPubD  = $sqlObj->publish_date;
						$wsImage = $sqlObj->image;
						$wsAcs   = $sqlObj->access;
						$wsCat   = $sqlObj->category;
						
						if($wsTitle == NULL) $wsTitle = '';
						if($wsAutor == NULL) $wsAutor = '';
						if($wsNews  == NULL) $wsNews  = '';
						if($wsPub   == NULL) $wsPub   = '';
						if($wsTime  == NULL) $wsTime  = '';
						if($wsDate  == NULL) $wsDate  = '';
						if($wsOrder == NULL) $wsOrder = '';
						if($wsStamp == NULL) $wsStamp = '';
						if($wsCat   == NULL) $wsCat   = '';
						if($wsPubD  == NULL) $wsPubD  = '';
						if($wsCmt   == NULL) $wsCmt   = '';
						if($wsImage == NULL) $wsImage = '';
						if($wsAcs   == NULL) $wsAcs   = '';
						
						$wsTitle = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
						$wsAutor = $this->decodeText($wsAutor, '2', $this->m_CHARSET);
						$wsNews  = $this->decodeText($wsNews, '2', $this->m_CHARSET);
						
						$newsDC->setTitle($wsTitle);
						$newsDC->setAutor($wsAutor);
						$newsDC->setDate($wsDate);
						$newsDC->setTime($wsTime);
						$newsDC->setText($wsNews);
						$newsDC->setID($wsOrder);
						$newsDC->setTimestamp($wsStamp);
						$newsDC->setPublished($wsPub);
						$newsDC->setPublishDate($wsPubD);
						$newsDC->setCommentsEnabled($wsCmt);
						$newsDC->setImage($wsImage);
						$newsDC->setCategories($wsCat);
						$newsDC->setAccess($wsAcs);
						$newsDC->setShowOnFrontpage($wsSOF);
						
						$arrReturn[$count] = $newsDC;
						
						$count++;
					}
				}
			}
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get the title of a news element
	 * 
	 * @param String $id
	 * @param String $language
	 * @return String
	 */
	function getNewsTitle($id, $language) {
		if($this->db_choosenDB == 'xml') {
			$xml = new xmlparser(
				$this->m_path.'/tcms_news/'.$id.'.xml', 'r'
			);
			
			$ret = $this->decodeText($xml->readSection('news', 'title'), '2', $c_charset);
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
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
			
			$sql = "SELECT title "
			."FROM ".$this->m_sqlPrefix."news "
			."WHERE uid = '".$id."' "
			."AND language = '".$language."'";
			
			//echo $sql.'<br>';
			
			$sqlQR = $sqlAL->query($sql);
			
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			$ret = $this->decodeText($sqlObj->title, '2', $c_charset);
			
			$sqlAL->freeResult($sqlQR);
		}
		
		return $ret;
	}
	
	
	
	/**
	 * Get the id of a news element by its title
	 * 
	 * @param String $title
	 * @param String $language
	 * @return String
	 */
	function getNewsIdByTitle($title, $language) {
		if($this->db_choosenDB == 'xml'){
			/*$wsCUid = $this->getXmlIdFromContentLanguage(
				$id, 
				$language
			);
			
			if($wsCUid != '') {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content_languages/'.$wsCUid.'.xml', 'r'
				);
			}
			else {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
				);
			}
			
			$ret = $this->decodeText($xml->readSection('main', 'title'), '2', $c_charset);*/
			
			$arr_docs = $this->getPathContent(
				$this->m_path.'/tcms_news/'
			);
			
			$count = 0;
			
			if($this->isArray($arr_docs)) {
				foreach($arr_docs as $key => $val) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_news/'.$val, 'r'
					);
					
					$wsTitle = $xml->readValue('title');
					
					if($this->indexOf($wsTitle, $title)) {
						// got a match
						
						$count++;
					}
					else if($this->indexOf($wsTitle, $title) && $count > 0) {
						// too much
						
						$count++;
					}
					else {
						// nothing found
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
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
			
			$sql = "SELECT uid "
			."FROM ".$this->m_sqlPrefix."news "
			."WHERE language = '".$language."' ";
			
			//echo $title.'<br>';
			
			$arrTitle = explode(' ', $title);
			
			foreach($arrTitle as $key => $value) {
				if($key == 0) {
					if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
						$sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
					}
					else {
						$sql .= "AND (title LIKE '%".$value."%') ";
					}
				}
				else {
					if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
						$sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
					}
					else {
						$sql .= "AND (title LIKE '%".$value."%') ";
					}
				}
			}
			
			//echo $sql.'<br>';
			
			$sqlQR = $sqlAL->query($sql);
			$no = $sqlAL->getNumber($sqlQR);
			
			if($no == 1) {
				// got a match
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				$ret = $sqlObj->uid;
			}
			else if($no > 1) {
				// too much
				$sql = "SELECT uid "
				."FROM ".$this->m_sqlPrefix."news "
				."WHERE language = '".$language."' ";
				
				foreach($arrTitle as $key => $value) {
					if($key == 0) {
						if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
							$sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
						}
						else {
							$sql .= "AND (title LIKE '%".$value."%') ";
						}
					}
					else {
						if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
							$sql .= "OR ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
						}
						else {
							$sql .= "OR (title LIKE '%".$value."%') ";
						}
					}
				}
				
				//$sql .= " )";
				
				//echo $sql.'<br>';
				
				$sqlQR = $sqlAL->query($sql);
				$no = $sqlAL->getNumber($sqlQR);
				
				if($no == 1) {
					// got a match
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					$ret = $sqlObj->uid;
				}
				else if($no > 1) {
					// too much
					$ret = '';
				}
				else {
					// nothing found
					// last chance!
					
					// too much
					$sql = "SELECT uid "
					."FROM ".$this->m_sqlPrefix."news "
					."WHERE language = '".$language."' ";
          			
					if($this->indexOf($title, "'") || $this->indexOf($title, "\'")) {
						$sql .= "AND ( (title LIKE '%".$title."%') OR (title LIKE '%".str_replace('\'', '&#039;', $title)."%') ) ";
					}
					else {
						$sql .= "AND (title LIKE '%".$title."%') ";
					}
					
					switch($this->m_choosenDB){
						case 'mysql':
							$sql .= " AND ( NOT LENGTH(title) > ".( strlen($title) + 2 )." )";
							break;
						
						case 'pgsql':
							$sql .= " AND ( NOT LEN(title) > ".( strlen($title) + 2 )." )";
							break;
						
						case 'mssql':
							$sql .= " AND ( NOT LEN(title) > ".( strlen($title) + 2 )." )";
							break;
					}
					
					//echo $sql.'<br>';
					
					$sqlQR = $sqlAL->query($sql);
					$no = $sqlAL->getNumber($sqlQR);
					
					if($no == 1) {
						// got a match
						$sqlObj = $sqlAL->fetchObject($sqlQR);
						$ret = $sqlObj->uid;
					}
					else {
						// nothing found
						$ret = '';
					}
				}
			}
			else {
				// nothing found
				$ret = '';
			}
			
			$sqlAL->freeResult($sqlQR);
		}
		
		return $ret;
	}
	
	
	
	/**
	 * Get the id of a language news file
	 * 
	 * @param String $id
	 * @param String $lang
	 * @return String
	 */
	function getXmlIdFromNewsLanguage($id, $language) {
		if($this->m_choosenDB == 'xml'){
			$arr_docs = $this->getPathContent(
				$this->m_path.'/tcms_news/'
			);
			
			$wsCUid = '';
			
			if($this->isArray($arr_docs)) {
				foreach($arr_docs as $key => $val) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_news/'.$val, 'r'
					);
					
					$wsLang = $xml->readValue('language');
					
					if($language == $wsLang) {
						$wsCUid = substr($val, 0, 5);
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
			
			return $wsCUid;
		}
		else {
			return '';
		}
	}
	
	
	
	/**
	 * ReGenerate the news syndication feeds
	 * 
	 * @param String $language
	 * @param String $defaultFormat = 'RSS2.0'
	 * @param String $seoFolder = ''
	 * @param Boolean $admin = false
	 * @param Integer $amount = 5
	 * @param Boolean $show_autor = false
	 */
	function generateFeed($language, $defaultFormat = 'RSS2.0', $seoFolder = '', $admin = false, $amount = 5, $show_autor = false) {
		if($admin) {
			using('toendacms.tools.feedcreator.feedcreator_class', false, true);
			using('toendacms.kernel.script', false, true);
			using('toendacms.kernel.account_provider', false, true);
			using('toendacms.datacontainer.news', false, true);
			using('toendacms.datacontainer.account', false, true);
		}
		else {
			using('toendacms.tools.feedcreator.feedcreator_class');
			using('toendacms.kernel.script');
			using('toendacms.kernel.account_provider');
			using('toendacms.datacontainer.news');
			using('toendacms.datacontainer.account');
		}
		
		$cfgObj = new tcms_configuration($this->m_path);
		
		$lang = $cfgObj->getLanguageCodeByTCMSCode($language);
		
		$wstitle      = $this->decodeText($cfgObj->getSiteTitle(), '2', $this->m_CHARSET);
		$wsname       = $this->decodeText($cfgObj->getSiteName(), '2', $this->m_CHARSET);
		$wskey        = $this->decodeText($cfgObj->getSiteKey(), '2', $this->m_CHARSET);
		$wsowner      = $this->decodeText($cfgObj->getWebpageOwner(), '2', $this->m_CHARSET);
		$wscopyright  = $this->decodeText($cfgObj->getWebpageCopyright(), '2', $this->m_CHARSET);
		$wsowner_url  = $this->decodeText($cfgObj->getWebpageOwnerUrl(), '2', $this->m_CHARSET);
		$wsowner_mail = $this->decodeText($cfgObj->getWebpageOwnerMail(), '2', $this->m_CHARSET);
		
		$rss = new UniversalFeedCreator();
		$rss->_setFormat($defaultFormat);
		$rss->useCached();
		$rss->title = $wsname;
		$rss->description = $wskey;
		$rss->link = $wsowner_url;
		$rss->syndicationURL = $wsowner_url.$seoFolder.'/cache/'.$defaultFormat.'.'.$lang.'.xml';
		
		$image = new FeedImage();
		$image->title = $wsname.' Logo';
		$image->url = '../engine/images/logos/toendaCMS_button_01.png';
		$image->link = $wsowner_url;
		$image->description = 'Feed provided by '.$wsname.'. Click to visit.';
		
		$rss->image = $image;
		
		// generate now ...
		$_tcms_ap = new tcms_account_provider($this->m_path, $this->m_CHARSET);
		$_tcms_auth = new tcms_authentication($this->m_path, $this->m_CHARSET, '', null);
		
		if($seoFolder != ''){
			$imagePath = $seoFolder.'/';
		}
		else{
			$imagePath = '/';
		}
		
		$arrNewsDC = $this->getNewsDCList($language, 'Guest', $amount, '1', true);
		
		if($this->isArray($arrNewsDC)) {
			foreach($arrNewsDC as $n_key => $n_value){
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				$userID = $_tcms_auth->getUserID($dcNews->GetAutor());
				
				if($userID != false) {
					$dcAcc = new tcms_dc_account();
					$dcAcc = $_tcms_ap->getAccount($userID);
					$wsMail = $dcAcc->getEmail();
				}
				else {
					$wsMail = $wsowner_mail;
				}
				
				$item = new FeedItem();
				
				$item->title = $dcNews->getTitle();
				$item->link = $wsowner_url.$seoFolder.'/?id=newsmanager&news='.$dcNews->getID();
				
				$toendaScript = new toendaScript();
				
				$news_content = $this->decodeIconV(
					$dcNews->getText(), 
					$this->m_CHARSET
				);
				
				$news_content = $toendaScript->checkSEO($news_content, $imagePath);
				$news_content = $toendaScript->cutAtTcmsMoreTag($news_content);
				
				$item->description = $news_content;
				$item->date = mktime(
					substr($dcNews->getTime(), 0, 2), 
					substr($dcNews->getTime(), 3, 2), 
					0, 
					substr($dcNews->getDate(), 3, 2), 
					substr($dcNews->getDate(), 0, 2), 
					substr($dcNews->getDate(), 6, 4)
				);
				$item->source = $wsowner_url;
				
				$item->author = ( $show_autor == 1 ? $dcNews->getAutor() : $wsowner );
				
				if($show_autor == 1) {
					$item->authorEmail = $wsMail;
				}
				
				$rss->addItem($item);
				
				unset($toendaScript);
			}
		}
		
		if($admin) {
			$rss->saveFeed($defaultFormat, '../../cache/'.$defaultFormat.'.'.$lang.'.xml', false);
		}
		else {
			$rss->saveFeed($defaultFormat, 'cache/'.$defaultFormat.'.'.$lang.'.xml', false);
		}
	}
	
	
	
	/**
	 * ReGenerate the news comments syndication feeds
	 * 
	 * @param String $language
	 * @param String $defaultFormat = 'RSS2.0'
	 * @param String $seoFolder = ''
	 * @param Boolean $admin = false
	 * @param Integer $amount = 5
	 * @param Boolean $show_autor = false
	 */
	function generateCommentsFeed($language, $defaultFormat = 'RSS2.0', $seoFolder = '', $admin = false, $amount = 5, $show_autor = false) {
		if($admin) {
			using('toendacms.tools.feedcreator.feedcreator_class', false, true);
			using('toendacms.kernel.script', false, true);
			using('toendacms.kernel.account_provider', false, true);
			using('toendacms.datacontainer.news', false, true);
			using('toendacms.datacontainer.account', false, true);
		}
		else {
			using('toendacms.tools.feedcreator.feedcreator_class');
			using('toendacms.kernel.script');
			using('toendacms.kernel.account_provider');
			using('toendacms.datacontainer.news');
			using('toendacms.datacontainer.account');
		}
		
		$cfgObj = new tcms_configuration($this->m_path);
		
		$lang = $cfgObj->getLanguageCodeByTCMSCode($language);
		
		$wstitle      = $this->decodeText($cfgObj->getSiteTitle(), '2', $this->m_CHARSET);
		$wsname       = $this->decodeText($cfgObj->getSiteName(), '2', $this->m_CHARSET);
		$wskey        = $this->decodeText($cfgObj->getSiteKey(), '2', $this->m_CHARSET);
		$wsowner      = $this->decodeText($cfgObj->getWebpageOwner(), '2', $this->m_CHARSET);
		$wscopyright  = $this->decodeText($cfgObj->getWebpageCopyright(), '2', $this->m_CHARSET);
		$wsowner_url  = $this->decodeText($cfgObj->getWebpageOwnerUrl(), '2', $this->m_CHARSET);
		$wsowner_mail = $this->decodeText($cfgObj->getWebpageOwnerMail(), '2', $this->m_CHARSET);
		
		$rss = new UniversalFeedCreator();
		$rss->_setFormat($defaultFormat);
		$rss->useCached();
		$rss->title = $wsname;
		$rss->description = $wskey;
		$rss->link = $wsowner_url;
		$rss->syndicationURL = $wsowner_url.$seoFolder.'/cache/comments'.$defaultFormat.'.'.$lang.'.xml';
		
		$image = new FeedImage();
		$image->title = $wsname.' Logo';
		$image->url = '../engine/images/logos/toendaCMS_button_01.png';
		$image->link = $wsowner_url;
		$image->description = 'Feed provided by '.$wsname.'. Click to visit.';
		
		$rss->image = $image;
		
		// generate now ...
		$_tcms_ap = new tcms_account_provider($this->m_path, $this->m_CHARSET);
		$_tcms_auth = new tcms_authentication($this->m_path, $this->m_CHARSET, '', null);
		
		if($seoFolder != ''){
			$imagePath = $seoFolder.'/';
		}
		else{
			$imagePath = '/';
		}
		
		$arrCommentsDC = $this->getCommentDCList(
			'__ALL_NEWS__', 
			'news', 
			true, 
			$language, 
			$amount
		);
		
		if($this->isArray($arrCommentsDC)) {
			foreach($arrCommentsDC as $n_key => $n_value) {
				$dcComment = new tcms_dc_comment();
				$dcComment = $arrCommentsDC[$n_key];
				
				$item = new FeedItem();
				
				$wsTitle = $this->getNewsTitle(
					$dcComment->getID(), 
					$language
				);
				
				$item->title = $wsTitle.' - '.$dcComment->getName();
				$item->link = $wsowner_url.$seoFolder.'/?id=newsmanager&amp;news='.$dcComment->getID();
				
				$item->description = $dcComment->getText();
				$item->date = mktime(
					substr($dcComment->getTimestamp(), 8, 2), 
					substr($dcComment->getTimestamp(), 10, 2), 
					substr($dcComment->getTimestamp(), 12, 2), 
					substr($dcComment->getTimestamp(), 4, 2), 
					substr($dcComment->getTimestamp(), 6, 2), 
					substr($dcComment->getTimestamp(), 0, 4)
				);
				$item->source = $wsowner_url;
				
				$item->author = $dcComment->getName();
				
				$rss->addItem($item);
			}
		}
		
		if($admin) {
			$rss->saveFeed($defaultFormat, '../../cache/comments'.$defaultFormat.'.'.$lang.'.xml', false);
		}
		else {
			$rss->saveFeed($defaultFormat, 'cache/comments'.$defaultFormat.'.'.$lang.'.xml', false);
		}
	}
	
	
	
	/**
	 * Get a list of comment data container
	 * 
	 * @param String $newsID
	 * @param String $module = 'news'
	 * @param Boolean $load = true
	 * @param String $language = ''
	 * @param Integer $amount = -1
	 * @return tcms_dc_comment Object Array
	 */
	function getCommentDCList($newsID, $module = 'news', $load = true, $language = '', $amount = -1) {			
		if($this->m_choosenDB == 'xml') {
			if($module == 'news') {
				if(trim($newsID) == '__ALL_NEWS__') {
					$arr_comments = $this->getPathContent(
						$this->m_path.'/tcms_news/', 
						true, 
						'', 
						true
					);
				}
				else {
					$arr_comments = $this->getPathContent(
						$this->m_path.'/tcms_news/comments_'.$newsID.'/'
					);
				}
			}
			
			$count = 0;
			$doBreak = false;
			$doLoad = true;
			
			//echo $amount.'<br>';
			
			if($load) {
				if($this->isArray($arr_comments)) {
					foreach($arr_comments as $nkey => $nvalue) {
						if(trim($newsID) == '__ALL_NEWS__') {
							$arrCommentFile = $this->getPathContent(
								$this->m_path.'/tcms_news/'.$nvalue.'/'
							);
							
							if($this->isArray($arrCommentFile)) {
								foreach($arrCommentFile as $ckey => $cvalue) {
									if($amount != -1) {
										if($count < $amount) {
											$doLoad = true;
										}
										else {
											$doLoad = false;
										}
									}
									else {
										$doLoad = true;
									}
									
									if($doLoad) {
										$path = $this->m_path.'/tcms_news/'.$nvalue.'/'.$cvalue;
										
										//echo $path.'<br>';
										
										$xml = new xmlparser($path, 'r');
										
										$arr_news['name'][$count]   = $xml->readSection('comment', 'name');
										$arr_news['email'][$count]  = $xml->readSection('comment', 'email');
										$arr_news['url'][$count]    = $xml->readSection('comment', 'web');
										$arr_news['text'][$count]   = $xml->readSection('comment', 'msg');
										$arr_news['time'][$count]   = $xml->readSection('comment', 'time');
										$arr_news['ip'][$count]     = $xml->readSection('comment', 'ip');
										$arr_news['domain'][$count] = $xml->readSection('comment', 'domain');
										$arr_news['id'][$count]     = $nvalue;
										
										$xml->flush();
										$xml->_xmlparser();
										unset($xml);
										
										if($arr_news['name'][$count]   == false) $arr_news['name'][$count]   = '';
										if($arr_news['email'][$count]  == false) $arr_news['email'][$count]  = '';
										if($arr_news['url'][$count]    == false) $arr_news['url'][$count]    = '';
										if($arr_news['text'][$count]   == false) $arr_news['text'][$count]   = '';
										if($arr_news['time'][$count]   == false) $arr_news['time'][$count]   = '';
										if($arr_news['ip'][$count]     == false) $arr_news['ip'][$count]     = '';
										if($arr_news['domain'][$count] == false) $arr_news['domain'][$count] = '';
										if($arr_news['id'][$count]     == false) $arr_news['id'][$count]     = '';
										
										$arr_news['text'][$count]  = $this->decodeText($arr_news['text'][$count], '2', $this->m_CHARSET);
										
										$count++;
									}
									else {
										$doBreak = true;
										break;
									}
								}
							}
						}
						else {
							$path = $this->m_path.'/tcms_news/comments_'.$newsID.'/'.$nvalue;
							
							$xml = new xmlparser($path, 'r');
							
							$arr_news['name'][$count]   = $xml->readSection('comment', 'name');
							$arr_news['email'][$count]  = $xml->readSection('comment', 'email');
							$arr_news['url'][$count]    = $xml->readSection('comment', 'web');
							$arr_news['text'][$count]   = $xml->readSection('comment', 'msg');
							$arr_news['time'][$count]   = $xml->readSection('comment', 'time');
							$arr_news['ip'][$count]     = $xml->readSection('comment', 'ip');
							$arr_news['domain'][$count] = $xml->readSection('comment', 'domain');
							$arr_news['id'][$count]     = $newsID;
							
							$xml->flush();
							$xml->_xmlparser();
							unset($xml);
							
							if($arr_news['name'][$count]   == false) $arr_news['name'][$count]   = '';
							if($arr_news['email'][$count]  == false) $arr_news['email'][$count]  = '';
							if($arr_news['url'][$count]    == false) $arr_news['url'][$count]    = '';
							if($arr_news['text'][$count]   == false) $arr_news['text'][$count]   = '';
							if($arr_news['time'][$count]   == false) $arr_news['time'][$count]   = '';
							if($arr_news['ip'][$count]     == false) $arr_news['ip'][$count]     = '';
							if($arr_news['domain'][$count] == false) $arr_news['domain'][$count] = '';
							if($arr_news['id'][$count]     == false) $arr_news['id'][$count]     = '';
							
							$arr_news['text'][$count]  = $this->decodeText($arr_news['text'][$count], '2', $this->m_CHARSET);
							
							$count++;
						}
						
						if($doBreak) {
							break;
						}
					}
				}
				
				
				if(is_array($arr_news['time']) && isset($arr_news['time'])){
					array_multisort(
						$arr_news['time'], SORT_ASC, 
						$arr_news['name'], SORT_ASC, 
						$arr_news['email'], SORT_ASC, 
						$arr_news['text'], SORT_ASC, 
						$arr_news['url'], SORT_ASC, 
						$arr_news['ip'], SORT_ASC, 
						$arr_news['domain'], SORT_ASC, 
						$arr_news['id'], SORT_ASC
					);
				}
				
				if($this->isArray($arr_news['time'])) {
					$count = 0;
					
					unset($n_key);
					
					foreach($arr_news['time'] as $n_key => $n_value) {
						$commentDC = new tcms_dc_comment();
						
						$commentDC->setName($arr_news['name'][$n_key]);
						$commentDC->setEMail($arr_news['email'][$n_key]);
						$commentDC->setURL($arr_news['url'][$n_key]);
						$commentDC->setModule($module);
						$commentDC->setText($arr_news['text'][$n_key]);
						$commentDC->setDomain($arr_news['domain'][$n_key]);
						$commentDC->setIP($arr_news['ip'][$n_key]);
						$commentDC->setID($arr_news['id'][$n_key]);
						$commentDC->setTime($arr_news['time'][$n_key]);
						$commentDC->setTimestamp($arr_news['time'][$n_key]);
						
						$arrReturn[$count] = $commentDC;
						
						$count++;
					}
				}
			}
			else{
				$arrReturn = count($arr_comments);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			switch($this->m_choosenDB){
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
			." FROM ".$this->m_sqlPrefix."comments ";
			
			if(trim($newsID) == '__ALL_NEWS__') {
				$sqlStr .= "WHERE module = '".$module."' ";
			}
			else {
				$sqlStr .= "WHERE uid = '".$newsID."'"
				." AND module = '".$module."' ";
			}
			
			if($language != '') {
				$sqlStr .= " AND uid IN"
				." (SELECT uid FROM blog_news WHERE language = '".$language."') ";
			}
			
			$sqlStr .= "ORDER BY timestamp ASC ".$dbLimit;
			
			$sqlQR = $sqlAL->query($sqlStr);
			
			if($load){
				$count = 0;
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)){
					$commentDC = new tcms_dc_comment();
					
					$wsWeb    = $sqlObj->web;
					$wsName   = $sqlObj->name;
					$wsTime   = $sqlObj->time;
					$wsMsg    = $sqlObj->msg;
					$wsStamp  = $sqlObj->timestamp;
					$wsEMail  = $sqlObj->email;
					$wsID     = $sqlObj->uid;
					$wsIP     = $sqlObj->ip;
					$wsDomain = $sqlObj->domain;
					$wsModule = $sqlObj->module;
					
					if($wsStamp  == NULL) $wsStamp  = '';
					if($wsEMail  == NULL) $wsEMail  = '';
					if($wsID     == NULL) $wsID     = '';
					if($wsMsg    == NULL) $wsMsg    = '';
					if($wsTime   == NULL) $wsTime   = '';
					if($wsName   == NULL) $wsName   = '';
					if($wsWeb    == NULL) $wsWeb    = '';
					if($wsIP     == NULL) $wsIP     = '';
					if($wsDomain == NULL) $wsDomain = '';
					if($wsModule == NULL) $wsModule = '';
					
					$wsMsg = $this->decodeText($wsMsg, '2', $this->m_CHARSET);
					
					$commentDC->setName($wsName);
					$commentDC->setEMail($wsEMail);
					$commentDC->setURL($wsWeb);
					$commentDC->setModule($wsModule);
					$commentDC->setText($wsMsg);
					$commentDC->setDomain($wsDomain);
					$commentDC->setIP($wsIP);
					$commentDC->setID($wsID);
					$commentDC->setTime($wsTime);
					$commentDC->setTimestamp($wsStamp);
					
					$arrReturn[$count] = $commentDC;
					
					$count++;
				}
			}
			else {
				$arrReturn = $sqlAL->getNumber($sqlQR);
			}
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get a content data container
	 * 
	 * @param String $contentID
	 * @param Boolean $withLanguages = false
	 * @param String $language = ''
	 * @return tcms_content_dc Object
	 */
	function getContentDC($contentID, $withLanguages = false, $language = ''){
		$contentDC = new tcms_dc_content();
		
		$no = 0;
		
		if($this->m_choosenDB == 'xml'){
			if($withLanguages) {
				/*$wsCUid = $this->getXmlIdFromContentLanguage(
					$contentID, 
					$language
				);
				
				if($wsCUid != '') {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content_languages/'.$wsCUid.'.xml', 'r'
					);
				}
				else {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
					);
				}*/
				if(file_exists($this->m_path.'/tcms_content/'.$contentID.'.xml')) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
					);
				}
				else if(file_exists($this->m_path.'/tcms_content_languages/'.$contentID.'.xml')) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content_languages/'.$contentID.'.xml', 'r'
					);
				}
			}
			else {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
				);
			}
			
			$wsTitle      = $xml->readSection('main', 'title');
			$wsKeynote    = $xml->readSection('main', 'key');
			$wsText       = $xml->readSection('main', 'content00');
			$wsSecondText = $xml->readSection('main', 'content01');
			$wsFootText   = $xml->readSection('main', 'foot');
			$wsID         = $xml->readSection('main', 'order');
			//$wsLayout     = $xml->readSection('main', 'db_layout');
			$wsAutor      = $xml->readSection('main', 'autor');
			$wsInWork     = $xml->readSection('main', 'in_work');
			$wsAcs        = $xml->readSection('main', 'access');
			$wsPub        = $xml->readSection('main', 'published');
			
			if($withLanguages && $no > 0) {
				$wsLang = $xml->readSection('main', 'language');
				
				if(!$wsLang == false) $wsLang = 'english_EN';
			}
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle      == false) $wsTitle      = '';
			if($wsAutor      == false) $wsAutor      = '';
			if($wsKeynote    == false) $wsKeynote    = '';
			if($wsSecondText == false) $wsSecondText = '';
			if($wsText       == false) $wsText       = '';
			if($wsFootText   == false) $wsFootText   = '';
			if($wsID         == false) $wsID         = '';
			//if($wsLayout     == false) $wsLayout     = '';
			if($wsInWork     == false) $wsInWork     = '';
			if($wsPub        == false) $wsPub        = '';
			if($wsAcs        == false) $wsAcs        = '';
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
			
			if($withLanguages) {
				$sql = "SELECT * "
				."FROM ".$this->m_sqlPrefix."content_languages "
				."WHERE content_uid = '".$contentID."' "
				."AND language = '".$language."'";
				
				$sqlQR = $sqlAL->query($sql);
				$no = $sqlAL->getNumber($sqlQR);
				
				if($no == 0) {
					$sqlAL->freeResult($sqlQR);
					
					$sql = "SELECT * "
					."FROM ".$this->m_sqlPrefix."content "
					."WHERE uid = '".$contentID."'";
					
					$sqlQR = $sqlAL->query($sql);
				}
			}
			else {
				$sql = "SELECT * "
				."FROM ".$this->m_sqlPrefix."content "
				."WHERE uid = '".$contentID."'";
				
				$sqlQR = $sqlAL->query($sql);
				
				//$sqlQR = $sqlAL->getOne($this->m_sqlPrefix.'content', $contentID);
			}
			
			//echo $sql.'<br>';
			
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID         = $sqlObj->uid;
			$wsTitle      = $sqlObj->title;
			$wsKeynote    = $sqlObj->key;
			$wsText       = $sqlObj->content00;
			$wsSecondText = $sqlObj->content01;
			$wsFootText   = $sqlObj->foot;
			//$wsLayout     = $sqlObj->db_layout;
			$wsAutor      = $sqlObj->autor;
			$wsInWork     = $sqlObj->in_work;
			$wsPub        = $sqlObj->published;
			$wsAcs        = $sqlObj->access;
			
			if($withLanguages && $no > 0) {
				$wsLang = $sqlObj->language;
				
				if($wsLang == NULL) $wsLang = 'english_EN';
			}
			else {
				$wsLang = $language;
			}
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsTitle      == NULL) $wsTitle      = '';
			if($wsAutor      == NULL) $wsAutor      = '';
			if($wsKeynote    == NULL) $wsKeynote    = '';
			if($wsSecondText == NULL) $wsSecondText = '';
			if($wsText       == NULL) $wsText       = '';
			if($wsFootText   == NULL) $wsFootText   = '';
			if($wsID         == NULL) $wsID         = '';
			//if($wsLayout     == NULL) $wsLayout     = '';
			if($wsInWork     == NULL) $wsInWork     = '';
			if($wsPub        == NULL) $wsPub        = '';
			if($wsAcs        == NULL) $wsAcs        = '';
		}
		
		$wsTitle      = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote    = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText       = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsSecondText = $this->decodeText($wsSecondText, '2', $this->m_CHARSET);
		$wsFootText   = $this->decodeText($wsFootText, '2', $this->m_CHARSET);
		
		$contentDC->setTitle($wsTitle);
		$contentDC->setKeynote($wsKeynote);
		$contentDC->setText($wsText);
		$contentDC->setSecondContent($wsSecondText);
		$contentDC->setFootText($wsFootText);
		$contentDC->setAutor($wsAutor);
		//$contentDC->setTextLayout($wsLayout);
		$contentDC->setID($wsID);
		$contentDC->setInWorkState($wsInWork);
		$contentDC->setPublished($wsPub);
		$contentDC->setAccess($wsAcs);
		
		if($withLanguages && $no > 0) {
			$contentDC->setLanguage($wsLang);
		}
		
		return $contentDC;
	}
	
	
	
	/**
	 * Get the access infos from a content item
	 *
	 * @param String $id
	 * @return Array
	 */
	function getContentAccess($id) {
		switch($id) {
			case 'profile':
			case 'polls':
			case 'register':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'imagegallery':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'guestbook':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'newsmanager':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'contactform':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'knowledgebase':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'impressum':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'frontpage':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'search':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'links':
				$authorized = $authorized;
				$content_published = 1;
				break;
			
			case 'download':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'products':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			case 'components':
				$authorized = 'Public';
				$content_published = 1;
				break;
			
			default:
				if($choosenDB == 'xml') {
					if(file_exists($this->m_path.'/tcms_content/'.$id.'.xml')) {
						$xml = new xmlparser($this->m_path.'/tcms_content/'.$id.'.xml','r');
						
						$authorized = $xml->readSection('main', 'access');
						$content_published = $xml->readSection('main', 'published');
						
						$xml->flush();
						$xml->_xmlparser();
						unset($xml);
					}
					else if(file_exists($this->m_path.'/tcms_content_languages/'.$id.'.xml')) {
						$xml = new xmlparser($this->m_path.'/tcms_content_languages/'.$id.'.xml','r');
						
						$authorized = $xml->readSection('main', 'access');
						$content_published = $xml->readSection('main', 'published');
						
						$xml->flush();
						$xml->_xmlparser();
						unset($xml);
					}
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
					
					$sqlQR = $sqlAL->getOne($this->m_sqlPrefix.'content', $id);
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$authorized = $sqlObj->access;
					$content_published = $sqlObj->published;
					
					$sqlAL->freeResult($sqlQR);
					unset($sqlAL);
				}
				break;
		}
		
		$arrContentAccess['authorized'] = $authorized;
		$arrContentAccess['content_published'] = $content_published;
		
		return $arrContentAccess;
	}
	
	
	
	/**
	 * Get a list of content languages
	 * 
	 * @param String $id
	 * @return Array
	 */
	function getContentLanguages($id) {
		$count = 0;
		
		if($this->m_choosenDB == 'xml'){
			$arr_docs = $this->getPathContent(
				$this->m_path.'/tcms_content_languages/'
			);
			
			
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
			
			// load content
			$sql = "SELECT * "
			."FROM ".$this->m_sqlPrefix."content_languages "
			."WHERE content_uid = '".$id."'";
			
			$sqlQR = $sqlAL->query($sql);
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arrReturn[$count] = $sqlObj->language;
				
				$count++;
			}
			
			$sqlAL->freeResult($sqlQR);
			
			// load now the main content
			$sql = "SELECT * "
			."FROM ".$this->m_sqlPrefix."content "
			."WHERE uid = '".$id."'";
			
			$sqlQR = $sqlAL->query($sql);
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arrReturn[$count] = $sqlObj->language;
				
				$count++;
			}
			
			// finish
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get the id of a language content file
	 * 
	 * @param String $id
	 * @param String $language
	 * @return String
	 */
	function getXmlIdFromContentLanguage($id, $language) {
		if($this->m_choosenDB == 'xml') {
			$arr_docs = $this->getPathContent(
				$this->m_path.'/tcms_content_languages/'
			);
			
			$wsCUid = '';
			
			if($this->isArray($arr_docs)) {
				foreach($arr_docs as $key => $val) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content_languages/'.$val, 'r'
					);
					
					$wsLang = $xml->readValue('language');
					$wsUid  = $xml->readValue('content_uid');
					
					if($id == $wsUid && $language == $wsLang) {
						$wsCUid = substr($val, 0, 5);
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
			
			return $wsCUid;
		}
		else {
			return '';
		}
	}
	
	
	
	/**
	 * Get the title of a content element
	 * 
	 * @param String $id
	 * @param String $language
	 * @return String
	 */
	function getContentTitle($id, $language) {
		if($this->db_choosenDB == 'xml'){
			$wsCUid = $this->getXmlIdFromContentLanguage(
				$id, 
				$language
			);
			
			if($wsCUid != '') {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content_languages/'.$wsCUid.'.xml', 'r'
				);
			}
			else {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
				);
			}
			
			$ret = $this->decodeText($xml->readSection('main', 'title'), '2', $c_charset);
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
			
			$sql = "SELECT title "
			."FROM ".$this->m_sqlPrefix."content_languages "
			."WHERE content_uid = '".$id."' "
			."AND language = '".$language."'";
			
			//echo $sql.'<br>';
			
			$sqlQR = $sqlAL->query($sql);
			$no = $sqlAL->getNumber($sqlQR);
			
			if($no == 0) {
				$sqlQR = $sqlAL->getOne($this->m_sqlPrefix.'content', $id);
			}
			
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			$ret = $this->decodeText($sqlObj->title, '2', $c_charset);
			
			$sqlAL->freeResult($sqlQR);
		}
		
		return $ret;
	}
	
	
	
	/**
	 * Get the id of a content element by its title
	 * 
	 * @param String $title
	 * @param String $language
	 * @return String
	 */
	function getContentIdByTitle($title, $language) {
		if($this->db_choosenDB == 'xml'){
			$wsCUid = $this->getXmlIdFromContentLanguage(
				$id, 
				$language
			);
			
			if($wsCUid != '') {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content_languages/'.$wsCUid.'.xml', 'r'
				);
			}
			else {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
				);
			}
			
			$ret = $this->decodeText($xml->readSection('main', 'title'), '2', $c_charset);
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
			
			$sql = "SELECT content_uid "
			."FROM ".$this->m_sqlPrefix."content_languages "
			."WHERE language = '".$language."' ";
			
			$arrTitle = explode(' ', $title);
			
			foreach($arrTitle as $key => $value) {
				if($key == 0) {
          if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
            $sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
          }
          else {
            $sql .= "AND (title LIKE '%".$value."%') ";
          }
				}
				else {
          if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
            $sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
          }
          else {
            $sql .= "AND (title LIKE '%".$value."%') ";
          }
				}
			}
			
			//echo $sql.'<br>';
			
			$sqlQR = $sqlAL->query($sql);
			$no = $sqlAL->getNumber($sqlQR);
			
			if($no > 0) {
				// got a match
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				$ret = $sqlObj->content_uid;
			}
			else {
				// nothing found
				$sql = "SELECT uid "
				."FROM ".$this->m_sqlPrefix."content ";
				
				foreach($arrTitle as $key => $value) {
					if($key == 0) {
            if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
              $sql .= "WHERE ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
            }
            else {
              $sql .= "WHERE (title LIKE '%".$value."%') ";
            }
					}
					else {
            if($this->indexOf($value, "'") || $this->indexOf($value, "\'")) {
              $sql .= "AND ( (title LIKE '%".$value."%') OR (title LIKE '%".str_replace('\'', '&#039;', $value)."%') ) ";
            }
            else {
              $sql .= "AND (title LIKE '%".$value."%') ";
            }
					}
				}
				
				//echo $sql.'<br>';
				
				$sqlQR = $sqlAL->query($sql);
				
				$no = $sqlAL->getNumber($sqlQR);
				
				if($no > 0) {
					// got a match
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					$ret = $sqlObj->uid;
				}
				else {
					// nothing found
					$ret = '';
				}
			}
			
			$sqlAL->freeResult($sqlQR);
		}
		
		return $ret;
	}
	
	
	
	/**
	 * Get a impressum data container
	 * 
	 * @return tcms_dc_impressum Object
	 */
	function getImpressumDC($language){
		$impDC = new tcms_dc_impressum();
		
		if($this->m_choosenDB == 'xml'){
			if(file_exists($this->m_path.'/tcms_global/impressum.'.$language.'.xml')) {
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/impressum.'.$language.'.xml',
					'r'
				);
			}
			else {
				$xml = new xmlparser($this->m_path.'/tcms_global/var.xml','r');
				$language = $xml->readValue('front_lang');
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/impressum.'.$language.'.xml',
					'r'
				);
			}
			
			$wsID      = $xml->readSection('imp', 'imp_id');
			$wsTitle   = $xml->readSection('imp', 'imp_title');
			$wsKeynote = $xml->readSection('imp', 'imp_stamp');
			$wsContact = $xml->readSection('imp', 'imp_contact');
			$wsTaxno   = $xml->readSection('imp', 'taxno');
			$wsUstID   = $xml->readSection('imp', 'ustid');
			$wsText    = $xml->readSection('imp', 'legal');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle   == false) $wsTitle   = '';
			if($wsTaxno   == false) $wsTaxno   = '';
			if($wsKeynote == false) $wsKeynote = '';
			if($wsContact == false) $wsContact = '';
			if($wsText    == false) $wsText    = '';
			if($wsUstID   == false) $wsUstID   = '';
			if($wsID      == false) $wsID      = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT imp_title, imp_stamp, imp_contact, taxno, ustid, legal "
			."FROM ".$this->m_sqlPrefix."impressum "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID      = 'impressum';
			$wsTitle   = $sqlObj->imp_title;
			$wsKeynote = $sqlObj->imp_stamp;
			$wsText    = $sqlObj->legal;
			$wsContact = $sqlObj->imp_contact;
			$wsTaxno   = $sqlObj->taxno;
			$wsUstID   = $sqlObj->ustid;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID      == NULL) $wsID      = '';
			if($wsTitle   == NULL) $wsTitle   = '';
			if($wsKeynote == NULL) $wsKeynote = '';
			if($wsText    == NULL) $wsText    = '';
			if($wsContact == NULL) $wsContact = '';
			if($wsTaxno   == NULL) $wsTaxno   = '';
			if($wsUstID   == NULL) $wsUstID   = '';
		}
		
		$wsTitle   = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText    = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsUstID   = $this->decodeText($wsUstID, '2', $this->m_CHARSET);
		$wsTaxno   = $this->decodeText($wsTaxno, '2', $this->m_CHARSET);
		
		$impDC->setTitle($wsTitle);
		$impDC->setSubtitle($wsKeynote);
		$impDC->setText($wsText);
		$impDC->setContact($wsContact);
		$impDC->setID($wsID);
		$impDC->setTaxNumber($wsTaxno);
		$impDC->setUstID($wsUstID);
		
		return $impDC;
	}
	
	
	
	/**
	 * Get a frontpage data container
	 * 
	 * @param String $language
	 * @return tcms_dc_frontpage Object
	 */
	function getFrontpageDC($language){
		$frontDC = new tcms_dc_frontpage();
		
		if($this->m_choosenDB == 'xml'){
			if(file_exists($this->m_path.'/tcms_global/frontpage.'.$language.'.xml')) {
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/frontpage.'.$language.'.xml',
					'r'
				);
			}
			else {
				$xml = new xmlparser($this->m_path.'/tcms_global/var.xml','r');
				$language = $xml->readValue('front_lang');
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/frontpage.'.$language.'.xml',
					'r'
				);
			}
			
			$wsID            = $xml->readSection('front', 'front_id');
			$wsLang          = $xml->readSection('front', 'language');
			$wsTitle         = $xml->readSection('front', 'front_title');
			$wsSubtitle      = $xml->readSection('front', 'front_stamp');
			$wsText          = $xml->readSection('front', 'front_text');
			$wsNewsTitle     = $xml->readSection('front', 'news_title');
			$wsNewsCut       = $xml->readSection('front', 'news_cut');
			$wsNewsAmount    = $xml->readSection('front', 'module_use_0');
			$wsSBNewsTitle   = $xml->readSection('front', 'sb_news_title');
			$wsSBNewsAmount  = $xml->readSection('front', 'sb_news_amount');
			$wsSBNewsCut     = $xml->readSection('front', 'sb_news_chars');
			$wsSBNewsEnabled = $xml->readSection('front', 'sb_news_enabled');
			$wsSBNewsDisplay = $xml->readSection('front', 'sb_news_display');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle   == false) $wsTitle   = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT language, front_title, front_stamp, front_text, news_title, news_cut, "
			."module_use_0, sb_news_title, sb_news_amount, sb_news_chars, sb_news_enabled, "
			."sb_news_display "
			."FROM ".$this->m_sqlPrefix."frontpage "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID            = 'frontpage';
			$wsLang          = $sqlObj->language;
			$wsTitle         = $sqlObj->front_title;
			$wsSubtitle      = $sqlObj->front_stamp;
			$wsText          = $sqlObj->front_text;
			$wsNewsTitle     = $sqlObj->news_title;
			$wsNewsCut       = $sqlObj->news_cut;
			$wsNewsAmount    = $sqlObj->module_use_0;
			$wsSBNewsTitle   = $sqlObj->sb_news_title;
			$wsSBNewsAmount  = $sqlObj->sb_news_amount;
			$wsSBNewsCut     = $sqlObj->sb_news_chars;
			$wsSBNewsEnabled = $sqlObj->sb_news_enabled;
			$wsSBNewsDisplay = $sqlObj->sb_news_display;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID            == NULL) $wsID            = '';
			if($wsLang          == NULL) $wsLang          = '';
			if($wsTitle         == NULL) $wsTitle         = '';
			if($wsSubtitle      == NULL) $wsSubtitle      = '';
			if($wsText          == NULL) $wsText          = '';
			if($wsNewsTitle     == NULL) $wsNewsTitle     = '';
			if($wsNewsCut       == NULL) $wsNewsCut       = '';
			if($wsNewsAmount    == NULL) $wsNewsAmount    = '';
			if($wsSBNewsTitle   == NULL) $wsSBNewsTitle   = '';
			if($wsSBNewsAmount  == NULL) $wsSBNewsAmount  = '';
			if($wsSBNewsCut     == NULL) $wsSBNewsCut     = '';
			if($wsSBNewsEnabled == NULL) $wsSBNewsEnabled = '';
			if($wsSBNewsDisplay == NULL) $wsSBNewsDisplay = '';
		}
		
		$wsTitle       = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsSubtitle    = $this->decodeText($wsSubtitle, '2', $this->m_CHARSET);
		$wsText        = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsNewsTitle   = $this->decodeText($wsNewsTitle, '2', $this->m_CHARSET);
		$wsSBNewsTitle = $this->decodeText($wsSBNewsTitle, '2', $this->m_CHARSET);
		
		$frontDC->setID($wsID);
		$frontDC->setLanguage($wsLang);
		$frontDC->setTitle($wsTitle);
		$frontDC->setSubtitle($wsSubtitle);
		$frontDC->setText($wsText);
		$frontDC->setNewsTitle($wsNewsTitle);
		$frontDC->setNewsChars($wsNewsCut);
		$frontDC->setNewsAmount($wsNewsAmount);
		$frontDC->setSidebarNewsTitle($wsSBNewsTitle);
		$frontDC->setSidebarNewsAmount($wsSBNewsAmount);
		$frontDC->setSidebarNewsChars($wsSBNewsCut);
		$frontDC->setSidebarNewsEnabled($wsSBNewsEnabled);
		$frontDC->setSidebarNewsDisplay($wsSBNewsDisplay);
		
		return $frontDC;
	}
	
	
	
	/**
	 * Get a newsmanager data container
	 * 
	 * @param String $language
	 * @return tcms_dc_newsmanager Object
	 */
	function getNewsmanagerDC($language) {
		$newsDC = new tcms_dc_newsmanager();
		
		if($this->m_choosenDB == 'xml'){
			if(file_exists($this->m_path.'/tcms_global/newsmanager.'.$language.'.xml')) {
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/newsmanager.'.$language.'.xml',
					'r'
				);
			}
			else {
				$xml = new xmlparser($this->m_path.'/tcms_global/var.xml','r');
				$language = $xml->readValue('front_lang');
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/newsmanager.'.$language.'.xml',
					'r'
				);
			}
			
			$wsID              = $xml->readSection('config', 'news_id');
			$wsLang            = $xml->readSection('config', 'language');
			$wsTitle           = $xml->readSection('config', 'news_title');
			$wsSubtitle        = $xml->readSection('config', 'news_stamp');
			$wsText            = $xml->readSection('config', 'news_text');
			$wsImage           = $xml->readSection('config', 'news_image');
			$wsUseComments     = $xml->readSection('config', 'use_comments');
			$wsShowAutor       = $xml->readSection('config', 'show_autor');
			$wsShowAutorAsLink = $xml->readSection('config', 'show_autor_as_link');
			$wsNewsAmount      = $xml->readSection('config', 'news_amount');
			$wsNewsChars       = $xml->readSection('config', 'news_cut');
			$wsAccess          = $xml->readSection('config', 'access');
			$wsUseGravatar     = $xml->readSection('config', 'use_gravatar');
			$wsUseEmoticons    = $xml->readSection('config', 'use_emoticons');
			$wsUseTrackback    = $xml->readSection('config', 'use_trackback');
			$wsUseTimesince    = $xml->readSection('config', 'use_timesince');
			$wsReadmoreLink    = $xml->readSection('config', 'readmore_link');
			$wsNewsSpacing     = $xml->readSection('config', 'news_spacing');
			$wsSynRSS091       = $xml->readSection('config', 'use_rss091');
			$wsSynRSS10        = $xml->readSection('config', 'use_rss10');
			$wsSynRSS20        = $xml->readSection('config', 'use_rss20');
			$wsSynRSSAtom      = $xml->readSection('config', 'use_atom03');
			$wsSynRSSOpml      = $xml->readSection('config', 'use_opml');
			$wsSynAmount       = $xml->readSection('config', 'syn_amount');
			$wsSynUseTitle     = $xml->readSection('config', 'use_syn_title');
			$wsSynDefaultFeed  = $xml->readSection('config', 'def_feed');
			$wsSynRSS091UseImg = $xml->readSection('config', 'use_rss091_img');
			$wsSynRSS091Text   = $xml->readSection('config', 'rss091_text');
			$wsSynRSS10UseImg  = $xml->readSection('config', 'use_rss10_img');
			$wsSynRSS10Text    = $xml->readSection('config', 'rss10_text');
			$wsSynRSS20UseImg  = $xml->readSection('config', 'use_rss20_img');
			$wsSynRSS20Text    = $xml->readSection('config', 'rss20_feed');
			$wsSynATOM03UseImg = $xml->readSection('config', 'use_atom03_img');
			$wsSynATOM03Text   = $xml->readSection('config', 'atom03_text');
			$wsSynOPMLUseImg   = $xml->readSection('config', 'use_opml_img');
			$wsSynOPMLText     = $xml->readSection('config', 'opml_text');
			$wsSynUseCFeed     = $xml->readSection('config', 'use_comment_feed');
			$wsSynCFeedText    = $xml->readSection('config', 'comment_feed_text');
			$wsSynCFeedType    = $xml->readSection('config', 'comment_feed_type');
			$wsSynUseCFeedImg  = $xml->readSection('config', 'use_comment_feed_img');
			$wsSynCFeedAmount  = $xml->readSection('config', 'comments_feed_amount');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle   == false) $wsTitle   = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT language, news_title, news_stamp, news_image, use_comments, show_autor, "
			."show_autor_as_link, news_amount, news_cut, access, use_gravatar, use_emoticons, "
			."use_trackback, use_timesince, news_text, readmore_link, news_spacing, use_rss091, use_rss10, "
			."use_rss20, use_atom03, use_opml, syn_amount, use_syn_title, def_feed, "
			."use_rss091_img, rss091_text, use_rss10_img, rss10_text, use_rss20_img, "
			."rss20_feed, use_atom03_img, atom03_text, use_opml_img, opml_text, "
			."use_comment_feed, comment_feed_text, comment_feed_type, use_comment_feed_img, "
			."comments_feed_amount "
			."FROM ".$this->m_sqlPrefix."newsmanager "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID              = 'newsmanager';
			$wsLang            = $sqlObj->language;
			$wsTitle           = $sqlObj->news_title;
			$wsSubtitle        = $sqlObj->news_stamp;
			$wsText            = $sqlObj->news_text;
			$wsImage           = $sqlObj->news_image;
			$wsUseComments     = $sqlObj->use_comments;
			$wsShowAutor       = $sqlObj->show_autor;
			$wsShowAutorAsLink = $sqlObj->show_autor_as_link;
			$wsNewsAmount      = $sqlObj->news_amount;
			$wsNewsChars       = $sqlObj->news_cut;
			$wsAccess          = $sqlObj->access;
			$wsUseGravatar     = $sqlObj->use_gravatar;
			$wsUseEmoticons    = $sqlObj->use_emoticons;
			$wsUseTrackback    = $sqlObj->use_trackback;
			$wsUseTimesince    = $sqlObj->use_timesince;
			$wsReadmoreLink    = $sqlObj->readmore_link;
			$wsNewsSpacing     = $sqlObj->news_spacing;
			$wsSynRSS091       = $sqlObj->use_rss091;
			$wsSynRSS10        = $sqlObj->use_rss10;
			$wsSynRSS20        = $sqlObj->use_rss20;
			$wsSynRSSAtom      = $sqlObj->use_atom03;
			$wsSynRSSOpml      = $sqlObj->use_opml;
			$wsSynAmount       = $sqlObj->syn_amount;
			$wsSynUseTitle     = $sqlObj->use_syn_title;
			$wsSynDefaultFeed  = $sqlObj->def_feed;
			$wsSynRSS091UseImg = $sqlObj->use_rss091_img;
			$wsSynRSS091Text   = $sqlObj->rss091_text;
			$wsSynRSS10UseImg  = $sqlObj->use_rss10_img;
			$wsSynRSS10Text    = $sqlObj->rss10_text;
			$wsSynRSS20UseImg  = $sqlObj->use_rss20_img;
			$wsSynRSS20Text    = $sqlObj->rss20_feed;
			$wsSynATOM03UseImg = $sqlObj->use_atom03_img;
			$wsSynATOM03Text   = $sqlObj->atom03_text;
			$wsSynOPMLUseImg   = $sqlObj->use_opml_img;
			$wsSynOPMLText     = $sqlObj->opml_text;
			$wsSynUseCFeed     = $sqlObj->use_comment_feed;
			$wsSynCFeedText    = $sqlObj->comment_feed_text;
			$wsSynCFeedType    = $sqlObj->comment_feed_type;
			$wsSynUseCFeedImg  = $sqlObj->use_comment_feed_img;
			$wsSynCFeedAmount  = $sqlObj->comments_feed_amount;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID            == NULL) $wsID            = '';
			if($wsLang          == NULL) $wsLang          = '';
			if($wsTitle         == NULL) $wsTitle         = '';
			if($wsSubtitle      == NULL) $wsSubtitle      = '';
			if($wsText          == NULL) $wsText          = '';
		}
		
		$wsTitle           = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsSubtitle        = $this->decodeText($wsSubtitle, '2', $this->m_CHARSET);
		$wsText            = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsSynRSS091Text   = $this->decodeText($wsSynRSS091Text, '2', $this->m_CHARSET);
		$wsSynRSS10Text    = $this->decodeText($wsSynRSS10Text, '2', $this->m_CHARSET);
		$wsSynRSS20Text    = $this->decodeText($wsSynRSS20Text, '2', $this->m_CHARSET);
		$wsSynATOM03Text   = $this->decodeText($wsSynATOM03Text, '2', $this->m_CHARSET);
		$wsSynOPMLText     = $this->decodeText($wsSynOPMLText, '2', $this->m_CHARSET);
		$wsSynCFeedText    = $this->decodeText($wsSynCFeedText, '2', $this->m_CHARSET);
		
		$newsDC->setID($wsID);
		$newsDC->setLanguage($wsLang);
		$newsDC->setTitle($wsTitle);
		$newsDC->setSubtitle($wsSubtitle);
		$newsDC->setText($wsText);
		$newsDC->setImage($wsImage);
		$newsDC->setUseComments($wsUseComments);
		$newsDC->setShowAutor($wsShowAutor);
		$newsDC->setShowAutorAsLink($wsShowAutorAsLink);
		$newsDC->setNewsAmount($wsNewsAmount);
		$newsDC->setNewsChars($wsNewsChars);
		$newsDC->setAccess($wsAccess);
		$newsDC->setUseGravatar($wsUseGravatar);
		$newsDC->setUseEmoticons($wsUseEmoticons);
		$newsDC->setUseTrackback($wsUseTrackback);
		$newsDC->setUseTimesince($wsUseTimesince);
		$newsDC->setReadmoreLink($wsReadmoreLink);
		$newsDC->setNewsSpacing($wsNewsSpacing);
		$newsDC->setSyndicationRSS091($wsSynRSS091);
		$newsDC->setSyndicationRSS10($wsSynRSS10);
		$newsDC->setSyndicationRSS20($wsSynRSS20);
		$newsDC->setSyndicationRSSAtom($wsSynRSSAtom);
		$newsDC->setSyndicationRSSOpml($wsSynRSSOpml);
		$newsDC->setSyndicationAmount($wsSynAmount);
		$newsDC->setSyndicationUseTitle($wsSynUseTitle);
		$newsDC->setSyndicationDefaultFeed($wsSynDefaultFeed);
		$newsDC->setSyndicationUseRSS091Image($wsSynRSS091UseImg);
		$newsDC->setSyndicationRSS091Text($wsSynRSS091Text);
		$newsDC->setSyndicationUseRSS10Image($wsSynRSS10UseImg);
		$newsDC->setSyndicationRSS10Text($wsSynRSS10Text);
		$newsDC->setSyndicationUseRSS20Image($wsSynRSS20UseImg);
		$newsDC->setSyndicationRSS20Text($wsSynRSS20Text);
		$newsDC->setSyndicationUseATOM03Image($wsSynATOM03UseImg);
		$newsDC->setSyndicationATOM03Text($wsSynATOM03Text);
		$newsDC->setSyndicationUseOPMLImage($wsSynOPMLUseImg);
		$newsDC->setSyndicationOPMLText($wsSynOPMLText);
		$newsDC->setSyndicationUseCommentFeed($wsSynUseCFeed);
		$newsDC->setSyndicationUseCommentFeedImage($wsSynUseCFeedImg);
		$newsDC->setSyndicationCommentFeedText($wsSynCFeedText);
		$newsDC->setSyndicationCommentFeedType($wsSynCFeedType);
		$newsDC->setSyndicationCommentFeedAmount($wsSynCFeedAmount);
				
		return $newsDC;
	}
	
	
	
	/**
	 * Get a Contactform data container
	 * 
	 * @return tcms_dc_contactform Object
	 */
	function getContactformDC($language){
		$cfDC = new tcms_dc_contactform();
		
		if($this->m_choosenDB == 'xml'){
			if(file_exists($this->m_path.'/tcms_global/contactform.'.$language.'.xml')) {
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/contactform.'.$language.'.xml',
					'r'
				);
			}
			else {
				$xml = new xmlparser($this->m_path.'/tcms_global/var.xml','r');
				$language = $xml->readValue('front_lang');
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/contactform.'.$language.'.xml',
					'r'
				);
			}
			
			$wsID      = 'contactform';
			$wsTitle   = $xml->readSection('email', 'contacttitle');
			$wsKeynote = $xml->readSection('email', 'contactstamp');
			$wsText    = $xml->readSection('email', 'contacttext');
			$wsContact = $xml->readSection('email', 'contact');
			$wsSCIS    = $xml->readSection('email', 'show_contacts_in_sidebar');
			$wsAccess  = $xml->readSection('email', 'access');
			$wsEnabled = $xml->readSection('email', 'enabled');
			$wsUA      = $xml->readSection('email', 'use_adressbook');
			$wsUC      = $xml->readSection('email', 'use_contact');
			$wsSC      = $xml->readSection('email', 'show_contactemail');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsID      == false) $wsID      = '';
			if($wsTitle   == false) $wsTitle   = '';
			if($wsKeynote == false) $wsKeynote = '';
			if($wsText    == false) $wsText    = '';
			if($wsContact == false) $wsContact = '';
			//if($wsSCIS    == false) $wsSCIS    = '';
			if($wsAccess  == false) $wsAccess  = '';
			//if($wsEnabled == false) $wsEnabled = '';
			//if($wsUA      == false) $wsUA      = '';
			//if($wsUC      == false) $wsUC      = '';
			//if($wsSC      == false) $wsSC      = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT * "
			."FROM ".$this->m_sqlPrefix."contactform "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID      = 'contactform';
			$wsTitle   = $sqlObj->contacttitle;
			$wsKeynote = $sqlObj->contactstamp;
			$wsText    = $sqlObj->contacttext;
			$wsContact = $sqlObj->contact;
			$wsSCIS    = $sqlObj->show_contacts_in_sidebar;
			$wsAccess  = $sqlObj->access;
			$wsEnabled = $sqlObj->enabled;
			$wsUA      = $sqlObj->use_adressbook;
			$wsUC      = $sqlObj->use_contact;
			$wsSC      = $sqlObj->show_contactemail;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID      == NULL) $wsID      = '';
			if($wsTitle   == NULL) $wsTitle   = '';
			if($wsKeynote == NULL) $wsKeynote = '';
			if($wsText    == NULL) $wsText    = '';
			if($wsContact == NULL) $wsContact = '';
			if($wsSCIS    == NULL) $wsSCIS    = '';
			if($wsAccess  == NULL) $wsAccess  = '';
			if($wsEnabled == NULL) $wsEnabled = '';
			if($wsUA      == NULL) $wsUA      = '';
			if($wsUC      == NULL) $wsUC      = '';
			if($wsSC      == NULL) $wsSC      = '';
		}
		
		$wsTitle   = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText    = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsContact = $this->decodeText($wsContact, '2', $this->m_CHARSET);
		
		$cfDC->setID($wsID);
		$cfDC->setTitle($wsTitle);
		$cfDC->setSubtitle($wsKeynote);
		$cfDC->setText($wsText);
		$cfDC->setContact($wsContact);
		$cfDC->setShowContactsInSidebar($wsSCIS);
		$cfDC->setAccess($wsAccess);
		$cfDC->setEnabled($wsEnabled);
		$cfDC->setUseAdressbook($wsUA);
		$cfDC->setUseContact($wsUC);
		$cfDC->setShowContactemail($wsSC);
		
		return $cfDC;
	}
	
	
	
	/**
	 * Get a products data container
	 * 
	 * @return tcms_dc_products Object
	 */
	function getProductsDC($language){
		$pDC = new tcms_dc_products();
		
		if($this->m_choosenDB == 'xml'){
			if(file_exists($this->m_path.'/tcms_global/products.'.$language.'.xml')) {
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/products.'.$language.'.xml',
					'r'
				);
			}
			else {
				$xml = new xmlparser($this->m_path.'/tcms_global/var.xml','r');
				$language = $xml->readValue('front_lang');
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
				
				$xml = new xmlparser(
					$this->m_path.'/tcms_global/products.'.$language.'.xml',
					'r'
				);
			}
			
			$wsID       = 'products';
			$wsTitle    = $xml->readSection('config', 'products_title');
			$wsKeynote  = $xml->readSection('config', 'products_stamp');
			$wsText     = $xml->readSection('config', 'products_text');
			$wsMainCat  = $xml->readSection('config', 'category_state');
			$wsCatTitle = $xml->readSection('config', 'category_title');
			$wsUCT      = $xml->readSection('config', 'use_category_title');
			$wsSPOU     = $xml->readSection('config', 'show_price_only_users');
			$wsSPT      = $xml->readSection('config', 'startpagetitle');
			$wsUSC      = $xml->readSection('config', 'use_sidebar_categories');
			$wsMLP      = $xml->readSection('config', 'max_latest_products');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsID       == false) $wsID       = '';
			if($wsTitle    == false) $wsTitle    = '';
			if($wsKeynote  == false) $wsKeynote  = '';
			if($wsText     == false) $wsText     = '';
			if($wsMainCat  == false) $wsMainCat  = '';
			if($wsCatTitle == false) $wsCatTitle = '';
			//if($wsUCT  == false)     $wsUCT     = 0;
			//if($wsSPOU  == false)     $wsSPOU     = 0;
			if($wsSPT      == false) $wsSPT      = '';
			//if($wsUSC  == false)     $wsUSC     = 0;
			//if($wsMLP  == false)     $wsMLP     = 0;
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT products_title, products_stamp, products_text, category_state, "
			."category_title, use_category_title, show_price_only_users, startpagetitle, "
			."use_sidebar_categories, max_latest_products "
			."FROM ".$this->m_sqlPrefix."products_config "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID       = 'products';
			$wsTitle    = $sqlObj->products_title;
			$wsKeynote  = $sqlObj->products_stamp;
			$wsText     = $sqlObj->products_text;
			$wsMainCat  = $sqlObj->category_state;
			$wsCatTitle = $sqlObj->category_title;
			$wsUCT      = $sqlObj->use_category_title;
			$wsSPOU     = $sqlObj->show_price_only_users;
			$wsSPT      = $sqlObj->startpagetitle;
			$wsUSC      = $sqlObj->use_sidebar_categories;
			$wsMLP      = $sqlObj->max_latest_products;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID       == NULL) $wsID       = '';
			if($wsTitle    == NULL) $wsTitle    = '';
			if($wsKeynote  == NULL) $wsKeynote  = '';
			if($wsText     == NULL) $wsText     = '';
			if($wsMainCat  == NULL) $wsMainCat  = '';
			if($wsCatTitle == NULL) $wsCatTitle = '';
			if($wsUCT      == NULL) $wsUCT      = 0;
			if($wsSPT      == NULL) $wsSPT      = '';
			if($wsUSC      == NULL) $wsUSC      = 0;
			if($wsMLP      == NULL) $wsMLP      = 15;
		}
		
		$wsTitle   = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText    = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsSPT     = $this->decodeText($wsSPT, '2', $this->m_CHARSET);
		
		$pDC->setLanguage($language);
		$pDC->setID($wsID);
		$pDC->setTitle($wsTitle);
		$pDC->setSubtitle($wsKeynote);
		$pDC->setText($wsText);
		$pDC->setProductMainCategory($wsMainCat);
		$pDC->setSidebarCategoryTitle($wsCatTitle);
		$pDC->setUseSideCategory($wsUCT);
		$pDC->setShowPriceOnlyUsers($wsSPOU);
		$pDC->setStartpageTitle($wsSPT);
		$pDC->setUseSideCategory($wsUSC);
		$pDC->setMaxLatestProducts($wsMLP);
		
		return $pDC;
	}
	
	
	
	/**
	 * Get a imagegallery data container
	 * 
	 * @return tcms_dc_imagegallery Object
	 */
	function getImagegalleryDC() {
		$iDC = new tcms_dc_imagegallery();
		
		if($this->m_choosenDB == 'xml') {
			$xml = new xmlparser(
				$this->m_path.'/tcms_global/imagegallery.xml',
				'r'
			);
			
			$wsID       = 'imagegallery';
			$wsTitle    = $xml->readSection('config', 'image_title');
			$wsKeynote  = $xml->readSection('config', 'image_stamp');
			$wsDetails  = $xml->readSection('config', 'image_details');
			$wsSort     = $xml->readSection('config', 'image_sort');
			$wsComments = $xml->readSection('config', 'use_comments');
			$wsAccess   = $xml->readSection('config', 'access');
			$wsOption   = $xml->readSection('config', 'list_option');
			$maxImg     = $xml->readSection('config', 'max_image');
			$needleImg  = $xml->readSection('config', 'needle_image');
			$showTImg   = $xml->readSection('config', 'show_lastimg_title');
			$alignImg   = $xml->readSection('config', 'align_image');
			$sizeImg    = $xml->readSection('config', 'size_image');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsID       == false) $wsID       = '';
			if($wsTitle    == false) $wsTitle    = '';
			if($wsKeynote  == false) $wsKeynote  = '';
			if($wsSort     == false) $wsSort     = '';
			//if($wsComments == false) $wsComments = '';
			if($wsAccess   == false) $wsAccess   = '';
			//if($wsUCT  == false)     $wsUCT     = 0;
			//if($wsSPOU  == false)     $wsSPOU     = 0;
			if($wsOption   == false) $wsOption   = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$strQuery = "SELECT * "
			."FROM ".$this->m_sqlPrefix."imagegallery_config ";
			//."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->query($strQuery);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsID       = 'imagegallery';
			$wsTitle    = $sqlObj->image_title;
			$wsKeynote  = $sqlObj->image_stamp;
			$wsDetails  = $sqlObj->image_details;
			$wsSort     = $sqlObj->image_sort;
			$wsComments = $sqlObj->use_comments;
			$wsAccess   = $sqlObj->access;
			$wsOption   = $sqlObj->list_option;
			$maxImg     = $sqlObj->max_image;
			$needleImg  = $sqlObj->needle_image;
			$showTImg   = $sqlObj->show_lastimg_title;
			$alignImg   = $sqlObj->align_image;
			$sizeImg    = $sqlObj->size_image;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID       == NULL) $wsID       = '';
			if($wsTitle    == NULL) $wsTitle    = '';
			if($wsKeynote  == NULL) $wsKeynote  = '';
			if($wsSort     == NULL) $wsSort     = '';
			//if($wsComments == NULL) $wsComments = '';
			if($wsAccess   == NULL) $wsAccess   = '';
			if($wsOption   == NULL) $wsOption   = '';
		}
		
		$wsTitle   = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText    = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsSPT     = $this->decodeText($wsSPT, '2', $this->m_CHARSET);
		$needleImg = $this->decodeText($needleImg, '2', $this->m_CHARSET);
		
		$iDC->setID($wsID);
		$iDC->setTitle($wsTitle);
		$iDC->setSubtitle($wsKeynote);
		$iDC->setUseImageDetails($wsDetails);
		$iDC->setImageSort($wsSort);
		$iDC->setUseComments($wsComments);
		$iDC->setAccess($wsAccess);
		$iDC->setListOption($wsOption);
		$iDC->setMaxImages($maxImg);
		$iDC->setNeedleImage($needleImg);
		$iDC->setShowLastImageTitle($showTImg);
		$iDC->setImageAlignment($alignImg);
		$iDC->setImageSize($sizeImg);
		
		return $iDC;
	}
	
	
	
	/**
	 * Get a sidebarmodul data container
	 * 
	 * @return tcms_dc_sidebarmodule Object
	 */
	function getSidebarModuleDC(){
		$sbmDC = new tcms_dc_sidebarmodule();
		
		$xmlActive = new xmlparser(''.$this->m_path.'/tcms_global/modules.xml','r');
		
		$arrASM['use_side_gallery']   = $xmlActive->readSection('config', 'side_gallery');
		$arrASM['use_layout_chooser'] = $xmlActive->readSection('config', 'layout_chooser');
		$arrASM['use_side_links']     = $xmlActive->readSection('config', 'side_links');
		$arrASM['use_login']          = $xmlActive->readSection('config', 'login');
		$arrASM['use_side_category']  = $xmlActive->readSection('config', 'side_category');
		$arrASM['use_side_archives']  = $xmlActive->readSection('config', 'side_archives');
		$arrASM['use_syndication']    = $xmlActive->readSection('config', 'syndication');
		$arrASM['use_newsletter']     = $xmlActive->readSection('config', 'newsletter');
		$arrASM['use_search']         = $xmlActive->readSection('config', 'search');
		$arrASM['use_sidebar']        = $xmlActive->readSection('config', 'sidebar');
		$arrASM['use_poll']           = $xmlActive->readSection('config', 'poll');
		
		$xmlActive->flush();
		$xmlActive->_xmlparser();
		unset($xmlActive);
		
		if($arrASM['use_side_gallery']   == false) $arrASM['use_side_gallery']   = '';
		if($arrASM['use_layout_chooser'] == false) $arrASM['use_layout_chooser'] = '';
		if($arrASM['use_side_links']     == false) $arrASM['use_side_links']     = '';
		if($arrASM['use_login']          == false) $arrASM['use_login']          = '';
		if($arrASM['use_side_category']  == false) $arrASM['use_side_category']  = '';
		if($arrASM['use_side_archives']  == false) $arrASM['use_side_archives']  = '';
		if($arrASM['use_syndication']    == false) $arrASM['use_syndication']    = '';
		if($arrASM['use_newsletter']     == false) $arrASM['use_newsletter']     = '';
		if($arrASM['use_search']         == false) $arrASM['use_search']         = '';
		if($arrASM['use_sidebar']        == false) $arrASM['use_sidebar']        = '';
		if($arrASM['use_poll']           == false) $arrASM['use_poll']           = '';
		
		$sbmDC->setSideGallery($arrASM['use_side_gallery']);
		$sbmDC->setLayoutChooser($arrASM['use_layout_chooser']);
		$sbmDC->setSideLinks($arrASM['use_side_links']);
		$sbmDC->setLogin($arrASM['use_login']);
		$sbmDC->setSideCategory($arrASM['use_side_category']);
		$sbmDC->setSideArchive($arrASM['use_side_archives']);
		$sbmDC->setSyndication($arrASM['use_syndication']);
		$sbmDC->setNewsletter($arrASM['use_newsletter']);
		$sbmDC->setSearch($arrASM['use_search']);
		$sbmDC->setSidebar($arrASM['use_sidebar']);
		$sbmDC->setPoll($arrASM['use_poll']);
		
		return $sbmDC;
	}
	
	
	
	/**
	 * Get the sidebar extension settings
	 * 
	 * @return String
	 */
	function getSidebarExtensionSettings() {
		$se = new tcms_dc_sidebarextensions();
		
		if($this->m_choosenDB == 'xml'){
			$xml = new xmlparser(''.$this->m_path.'/tcms_global/sidebar.xml', 'r');
			
			$wsLang          = $xml->readSection('side', 'lang');
			$wsSidemenuTitle = $xml->readSection('side', 'sidemenu_title');
			$wsShowCT        = $xml->readSection('side', 'show_chooser_title');
			$wsChooserTitle  = $xml->readSection('side', 'chooser_title');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsLang          == false) $wsLang          = '';
			if($wsSidemenuTitle == false) $wsSidemenuTitle = '';
			if($wsShowCT        == false) $wsShowCT        = '';
			if($wsChooserTitle  == false) $wsChooserTitle  = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->m_sqlUser, 
				$this->m_sqlPass, 
				$this->m_sqlHost, 
				$this->m_sqlDB, 
				$this->m_sqlPort
			);
			
			$sqlQR = $sqlAL->getOne($this->m_sqlPrefix.'sidebar_extensions', 'sidebar_extensions');
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$wsLang          = $sqlObj->lang;
			$wsSidemenuTitle = $sqlObj->sidemenu_title;
			$wsShowCT        = $sqlObj->show_chooser_title;
			$wsChooserTitle  = $sqlObj->chooser_title;
			
			$sqlAL->freeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsLang          == NULL) $wsLang          = '';
			if($wsSidemenuTitle == NULL) $wsSidemenuTitle = '';
			if($wsShowCT        == NULL) $wsShowCT        = '';
			if($wsChooserTitle  == NULL) $wsChooserTitle  = '';
		}
		
		$wsSidemenuTitle = $this->decodeText($wsSidemenuTitle, '2', $this->m_CHARSET);
		$wsChooserTitle  = $this->decodeText($wsChooserTitle, '2', $this->m_CHARSET);
		
		$se->setID('sidebar_extensions');
		$se->setLanguages($wsLang);
		$se->setSidemenuTitle($wsSidemenuTitle);
		$se->setShowLayoutChooserTitle($wsShowCT);
		$se->setLayoutChooserTitle($wsChooserTitle);
		
		return $se;
	}
}

?>
