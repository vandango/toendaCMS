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
 * @version 0.6.5
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
 * __construct($charset, $tcms_administer_path = 'data')         -> PHP5 Constructor
 * tcms_datacontainer_provider($charset, $tcms_administer_path)  -> PHP4 Constructor
 *
 * getNewsDC($newsID)                                            -> Get a specific news data container
 * getNewsDCList($usergroup = '', $amount, $published = '1')     -> Get a list of news data container
 *
 * getCommentDCList($news, $module = 'news', $load = true)       -> Get a list of news data container
 *
 * getContentDC($contentID)                                      -> Get a specific content data container
 * getContentLanguages                                           -> Get a list of content languages
 * getXmlIdFromContentLanguage                                   -> Get the id of a language content file
 *
 * getImpressumDC                                                -> Get a impressum data container
 * getFrontpageDC                                                -> Get a frontpage data container
 * getNewsmanagerDC                                              -> Get a newsmanager data container
 * getContactformDC                                              -> Get a contactform data container
 *
 * getSidebarModuleDC()                                          -> Get a sidebarmodul data container
 * getSidebarExtensionSettings()                                 -> Get the sidebar extension settings
 * 
 * </code>
 *
 */


class tcms_datacontainer_provider extends tcms_main {
	// global informaton
	var $m_CHARSET;
	var $m_path;
	
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
	 */
	function __construct($tcms_administer_path = 'data', $charset){
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->administer = $tcms_administer_path;
		
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
	 * @param String $tcms_administer_path = 'data'
	 * @param String $charset
	 */
	function tcms_datacontainer_provider($tcms_administer_path = 'data', $charset){
		$this->__construct($tcms_administer_path, $charset);
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
	 * Get a news data container
	 *
	 * @param String $newsID = ''
	 * @param String $usergroup = ''
	 * @return tcms_news_dc Object
	 */
	function getNewsDC($newsID, $usergroup){
		$newsDC = new tcms_dc_news();
		
		if($this->m_choosenDB == 'xml'){
			$xml = new xmlparser($this->m_path.'/tcms_news/'.$newsID.'.xml', 'r');
			$wsAcs = $xml->read_section('news', 'access');
			
			$show_this_news = $this->checkAccess($wsAcs, $usergroup);
			
			if($show_this_news == true){
				$wsTitle = $xml->read_section('news', 'title');
				$wsAutor = $xml->read_section('news', 'autor');
				$wsNews  = $xml->read_section('news', 'newstext');
				$wsPub   = $xml->read_section('news', 'published');
				$wsDate  = $xml->read_section('news', 'date');
				$wsTime  = $xml->read_section('news', 'time');
				$wsOrder = $xml->read_section('news', 'order');
				$wsStamp = $xml->read_section('news', 'stamp');
				$wsCat   = $xml->read_section('news', 'category');
				$wsCmt   = $xml->read_section('news', 'comments_enabled');
				$wsPubD  = $xml->read_section('news', 'publish_date');
				$wsImage = $xml->read_section('news', 'image');
				$wsSOF   = $xml->read_section('news', 'show_on_frontpage');
				
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
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
			."AND ( access = 'Public' "
			.$strAdd;
			
			$sqlQR = $sqlAL->sqlQuery($sqlStr);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
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
			
			$sqlAL->sqlFreeResult($sqlQR);
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
		
		$newsDC->SetTitle($wsTitle);
		$newsDC->SetAutor($wsAutor);
		$newsDC->SetDate($wsDate);
		$newsDC->SetTime($wsTime);
		$newsDC->SetText($wsNews);
		$newsDC->SetID($wsOrder);
		$newsDC->SetTimestamp($wsStamp);
		$newsDC->SetPublished($wsPub);
		$newsDC->SetPublishDate($wsPubD);
		$newsDC->SetCommentsEnabled($wsCmt);
		$newsDC->SetImage($wsImage);
		$newsDC->SetCategories($wsCat);
		$newsDC->SetAccess($wsAcs);
		$newsDC->SetShowOnFrontpage($wsSOF);
		
		return $newsDC;
	}
	
	
	
	/**
	 * Get a list of news data container
	 * 
	 * @param String $usergroup
	 * @param Integer $amount
	 * @param String $published = '1'
	 * @param Boolean $withShowOnFrontpage = false
	 * @return tcms_news_dc Object Array
	 */
	function getNewsDCList($usergroup = '', $amount, $published = '1', $withShowOnFrontpage = false){
		$doFill = false;
		
		if($this->m_choosenDB == 'xml'){
			$arr_filename = $this->getPathContent($this->m_path.'/tcms_news/');
			
			$count = 0;
			
			if(!empty($arr_filename) && $arr_filename != '' && isset($arr_filename)){
				foreach($arr_filename as $nkey => $nvalue){
					$xml = new xmlparser($this->m_path.'/tcms_news/'.$nvalue,'r');
					
					$is_pub  = $xml->read_section('news', 'published');
					$is_date = $xml->read_section('news', 'publish_date');
					$is_auth = $xml->read_section('news', 'access');
					
					$show_this_news = $this->checkAccess($is_auth, $usergroup);
					
					if($show_this_news == true){
						$is_date = mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
						
						if($is_pub == 1 && $is_date < time()){
							$is_sof = $xml->read_section('news', 'show_on_frontpage');
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
								$arr_news['title'][$count] = $xml->read_section('news', 'title');
								$arr_news['autor'][$count] = $xml->read_section('news', 'autor');
								$arr_news['news'][$count]  = $xml->read_section('news', 'newstext');
								$arr_news['pub'][$count]   = $is_pub;
								$arr_news['date'][$count]  = $xml->read_section('news', 'date');
								$arr_news['time'][$count]  = $xml->read_section('news', 'time');
								$arr_news['order'][$count] = $xml->read_section('news', 'order');
								$arr_news['stamp'][$count] = $xml->read_section('news', 'stamp');
								$arr_news['cat'][$count]   = $xml->read_section('news', 'category');
								$arr_news['cmt'][$count]   = $xml->read_section('news', 'comments_enabled');
								$arr_news['pubd'][$count]  = $xml->read_section('news', 'publish_date');
								$arr_news['image'][$count] = $xml->read_section('news', 'image');
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
						
						$newsDC->SetTitle($arr_news['title'][$n_key]);
						$newsDC->SetAutor($arr_news['autor'][$n_key]);
						$newsDC->SetDate($arr_news['date'][$n_key]);
						$newsDC->SetTime($arr_news['time'][$n_key]);
						$newsDC->SetText($arr_news['news'][$n_key]);
						$newsDC->SetID($arr_news['order'][$n_key]);
						$newsDC->SetTimestamp($arr_news['stamp'][$n_key]);
						$newsDC->SetPublished($arr_news['pub'][$n_key]);
						$newsDC->SetPublishDate($arr_news['pubd'][$n_key]);
						$newsDC->SetCommentsEnabled($arr_news['cmt'][$n_key]);
						$newsDC->SetImage($arr_news['image'][$n_key]);
						$newsDC->SetCategories($arr_news['cat'][$n_key]);
						$newsDC->SetAccess($arr_news['acs'][$n_key]);
						$newsDC->SetShowOnFrontpage($arr_news['sof'][$n_key]);
						
						$arrReturn[$count] = $newsDC;
						
						$count++;
					}
					
					$counting++;
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			switch($this->m_choosenDB){
				case 'mysql': $dbLimit = ( $amount == 0 ? "" : "LIMIT 0, ".$amount ); break;
				case 'pgsql': $dbLimit = ( $amount == 0 ? "" : "LIMIT ".$amount ); break;
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
			
			$sqlStr = "SELECT * "
			."FROM ".$this->m_sqlPrefix."news "
			."WHERE published = ".$published." "
			."AND ( access = 'Public' "
			.$strAdd
			.$strAddSOF
			."ORDER BY stamp DESC, date DESC, time DESC ".$dbLimit;
			
			$sqlQR = $sqlAL->sqlQuery($sqlStr);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$wsPubD = $sqlARR['publish_date'];
				
				$wsPubD = mktime(substr($wsPubD, 11, 2), substr($wsPubD, 14, 2), 0, substr($wsPubD, 3, 2), substr($wsPubD, 0, 2), substr($wsPubD, 6, 4));
				
				if($wsPubD <= time()){
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
						
						$newsDC->SetTitle($wsTitle);
						$newsDC->SetAutor($wsAutor);
						$newsDC->SetDate($wsDate);
						$newsDC->SetTime($wsTime);
						$newsDC->SetText($wsNews);
						$newsDC->SetID($wsOrder);
						$newsDC->SetTimestamp($wsStamp);
						$newsDC->SetPublished($wsPub);
						$newsDC->SetPublishDate($wsPubD);
						$newsDC->SetCommentsEnabled($wsCmt);
						$newsDC->SetImage($wsImage);
						$newsDC->SetCategories($wsCat);
						$newsDC->SetAccess($wsAcs);
						$newsDC->SetShowOnFrontpage($wsSOF);
						
						$arrReturn[$count] = $newsDC;
						
						$count++;
					}
				}
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * ReGenerate the news syndication feeds
	 * 
	 * @param String $defaultFormat = 'RSS2.0'
	 * @param String $seoFolder = ''
	 * @param Boolean $admin = false
	 * @param Integer $amount = 5
	 * @param Boolean $show_autor = false
	 */
	function generateFeed($defaultFormat = 'RSS2.0', $seoFolder = '', $admin = false, $amount = 5, $show_autor = false) {
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
		
		$xml = new xmlparser($this->m_path.'/tcms_global/namen.xml','r');
		$wstitle = $xml->read_section('namen', 'title');
		$wsname  = $xml->read_section('namen', 'name');
		$wskey   = $xml->read_section('namen', 'key');
		$logo      = $xml->read_section('namen', 'logo');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		$xml = new xmlparser($this->m_path.'/tcms_global/footer.xml','r');
		$wsowner     = $xml->read_section('footer', 'websiteowner');
		$wscopyright = $xml->read_section('footer', 'copyright');
		$wsowner_url = $xml->read_section('footer', 'owner_url');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		$rss = new UniversalFeedCreator();
		$rss->_setFormat($defaultFormat);
		$rss->useCached();
		$rss->title = $wsname;
		$rss->description = $wskey;
		$rss->link = $wsowner_url;
		$rss->syndicationURL = $wsowner_url.$seoFolder.'/cache/'.$defaultFormat.'.xml';
		
		$image = new FeedImage();
		$image->title = $wsname.' Logo';
		$image->url = '../engine/images/logos/toendaCMS_button_01.png';
		$image->link = $wsowner_url;
		$image->description = 'Feed provided by '.$wsname.'. Click to visit.';
		
		$rss->image = $image;
		
		// generate now ...
		$_tcms_ap = new tcms_account_provider($this->m_path, $c_charset);
		
		if($seoFolder != ''){
			$imagePath = $seoFolder.'/';
		}
		else{
			$imagePath = '/';
		}
		
		$arrNewsDC = $this->getNewsDCList('Guest', $amount, '1', true);
		
		if($this->isReal($arrNewsDC)) {
			foreach($arrNewsDC as $n_key => $n_value){
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				$dcAcc = new tcms_dc_account();
				$dcAcc = $_tcms_ap->getAccountByUsername($dcNews->GetAutor());
				
				$item = new FeedItem();
				
				$item->title = $dcNews->GetTitle();
				$item->link = $wsowner_url.$seoFolder.'/?id=newsmanager&news='.$dcNews->GetID();
				
				$toendaScript = new toendaScript();
				$news_content = $toendaScript->checkSEO($dcNews->GetText(), $imagePath);
				$news_content = $toendaScript->cutAtTcmsMoreTag($news_content);
				
				$item->description = $news_content;
				$item->date = mktime(
					substr($dcNews->GetTime(), 0, 2), 
					substr($dcNews->GetTime(), 3, 2), 
					0, 
					substr($dcNews->GetDate(), 3, 2), 
					substr($dcNews->GetDate(), 0, 2), 
					substr($dcNews->GetDate(), 6, 4)
				);
				$item->source = $wsowner_url;
				
				$item->author = ( $show_autor == 1 ? $dcNews->GetAutor() : $wsowner );
				
				if($show_autor == 1)
					$item->authorEmail = $dcAcc->GetEmail();
				
				$rss->addItem($item);
				
				unset($toendaScript);
			}
		}
		
		if($admin) {
			$rss->saveFeed($defaultFormat, '../../cache/'.$defaultFormat.'.xml', false);
		}
		else {
			$rss->saveFeed($defaultFormat, 'cache/'.$defaultFormat.'.xml', false);
		}
	}
	
	
	
	/**
	 * Get a list of comment data container
	 * 
	 * @param String $newsID
	 * @param String $module = 'news'
	 * @param Boolean $load = true
	 * @return tcms_dc_comment Object Array
	 */
	function getCommentDCList($newsID, $module = 'news', $load = true){
		if($this->m_choosenDB == 'xml'){
			if($module == 'news')
				$arr_comments = $this->readdir_ext($this->m_path.'/tcms_news/comments_'.$newsID.'/');
			
			$count = 0;
			
			if($load){
				if(!empty($arr_comments) && $arr_comments != '' && isset($arr_comments)){
					foreach($arr_comments as $nkey => $nvalue){
						$xml = new xmlparser($this->m_path.'/tcms_news/comments_'.$newsID.'/'.$nvalue, 'r');
						
						$arr_news['name'][$count]   = $xml->read_section('comment', 'name');
						$arr_news['email'][$count]  = $xml->read_section('comment', 'email');
						$arr_news['url'][$count]    = $xml->read_section('comment', 'web');
						$arr_news['text'][$count]   = $xml->read_section('comment', 'msg');
						$arr_news['time'][$count]   = $xml->read_section('comment', 'time');
						$arr_news['ip'][$count]     = $xml->read_section('comment', 'ip');
						$arr_news['domain'][$count] = $xml->read_section('comment', 'domain');
						$arr_news['id'][$count]     = substr($arr_filename[$nvalue], 0, 14);
						
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
				
				
				if(is_array($arr_news['time']) && isset($arr_news['time'])){
					$count = 0;
					
					unset($n_key);
					
					foreach($arr_news['time'] as $n_key => $n_value){
						$commentDC = new tcms_dc_comment();
						
						$commentDC->SetName($arr_news['name'][$n_key]);
						$commentDC->SetEMail($arr_news['email'][$n_key]);
						$commentDC->SetURL($arr_news['url'][$n_key]);
						$commentDC->SetModule($module);
						$commentDC->SetText($arr_news['text'][$n_key]);
						$commentDC->SetDomain($arr_news['domain'][$n_key]);
						$commentDC->SetIP($arr_news['ip'][$n_key]);
						$commentDC->SetID($arr_news['id'][$n_key]);
						$commentDC->SetTime($arr_news['time'][$n_key]);
						$commentDC->SetTimestamp($arr_news['time'][$n_key]);
						
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$sqlStr = "SELECT * "
			."FROM ".$this->m_sqlPrefix."comments "
			."WHERE uid = '".$newsID."' "
			."AND module = '".$module."' "
			."ORDER BY timestamp ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlStr);
			
			if($load){
				$count = 0;
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$commentDC = new tcms_dc_comment();
					
					$wsWeb    = $sqlARR['web'];
					$wsName   = $sqlARR['name'];
					$wsTime   = $sqlARR['time'];
					$wsMsg    = $sqlARR['msg'];
					$wsStamp  = $sqlARR['timestamp'];
					$wsEMail  = $sqlARR['email'];
					$wsID     = $sqlARR['uid'];
					$wsIP     = $sqlARR['ip'];
					$wsDomain = $sqlARR['domain'];
					$wsModule = $sqlARR['module'];
					
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
					
					$commentDC->SetName($wsName);
					$commentDC->SetEMail($wEMail);
					$commentDC->SetURL($wsWeb);
					$commentDC->SetModule($wsModule);
					$commentDC->SetText($wsMsg);
					$commentDC->SetDomain($wsDomain);
					$commentDC->SetIP($wsIP);
					$commentDC->SetID($wsID);
					$commentDC->SetTime($wsTime);
					$commentDC->SetTimestamp($wsStamp);
					
					$arrReturn[$count] = $commentDC;
					
					$count++;
				}
			}
			else{
				$arrReturn = $sqlAL->sqlGetNumber($sqlQR);
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
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
				$wsCUid = $this->getXmlIdFromContentLanguage(
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
				}
			}
			else {
				$xml = new xmlparser(
					$this->m_path.'/tcms_content/'.$contentID.'.xml', 'r'
				);
			}
			
			$wsTitle      = $xml->read_section('main', 'title');
			$wsKeynote    = $xml->read_section('main', 'key');
			$wsText       = $xml->read_section('main', 'content00');
			$wsSecondText = $xml->read_section('main', 'content01');
			$wsFootText   = $xml->read_section('main', 'foot');
			$wsID         = $xml->read_section('main', 'order');
			$wsLayout     = $xml->read_section('main', 'db_layout');
			$wsAutor      = $xml->read_section('main', 'autor');
			$wsInWork     = $xml->read_section('main', 'in_work');
			$wsAcs        = $xml->read_section('main', 'access');
			$wsPub        = $xml->read_section('main', 'published');
			
			if($withLanguages && $no > 0) {
				$wsLang = $xml->read_section('main', 'language');
				
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
			if($wsLayout     == false) $wsLayout     = '';
			if($wsInWork     == false) $wsInWork     = '';
			if($wsPub        == false) $wsPub        = '';
			if($wsAcs        == false) $wsAcs        = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			if($withLanguages) {
				$sql = "SELECT * "
				."FROM ".$this->m_sqlPrefix."content_languages "
				."WHERE content_uid = '".$contentID."' "
				."AND language = '".$language."'";
				
				$sqlQR = $sqlAL->sqlQuery($sql);
				$no = $sqlAL->sqlGetNumber($sqlQR);
				
				if($no == 0) {
					$sqlQR = $sqlAL->sqlGetOne($this->m_sqlPrefix.'content', $contentID);
				}
			}
			else {
				$sqlQR = $sqlAL->sqlGetOne($this->m_sqlPrefix.'content', $contentID);
			}
			
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$wsID         = $sqlObj->uid;
			$wsTitle      = $sqlObj->title;
			$wsKeynote    = $sqlObj->key;
			$wsText       = $sqlObj->content00;
			$wsSecondText = $sqlObj->content01;
			$wsFootText   = $sqlObj->foot;
			$wsLayout     = $sqlObj->db_layout;
			$wsAutor      = $sqlObj->autor;
			$wsInWork     = $sqlObj->in_work;
			$wsPub        = $sqlObj->published;
			$wsAcs        = $sqlObj->access;
			
			if($withLanguages && $no > 0) {
				$wsLang = $sqlObj->language;
				
				if($wsLang == NULL) $wsLang = 'english_EN';
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsTitle      == NULL) $wsTitle      = '';
			if($wsAutor      == NULL) $wsAutor      = '';
			if($wsKeynote    == NULL) $wsKeynote    = '';
			if($wsSecondText == NULL) $wsSecondText = '';
			if($wsText       == NULL) $wsText       = '';
			if($wsFootText   == NULL) $wsFootText   = '';
			if($wsID         == NULL) $wsID         = '';
			if($wsLayout     == NULL) $wsLayout     = '';
			if($wsInWork     == NULL) $wsInWork     = '';
			if($wsPub        == NULL) $wsPub        = '';
			if($wsAcs        == NULL) $wsAcs        = '';
		}
		
		$wsTitle      = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsKeynote    = $this->decodeText($wsKeynote, '2', $this->m_CHARSET);
		$wsText       = $this->decodeText($wsText, '2', $this->m_CHARSET);
		$wsSecondText = $this->decodeText($wsSecondText, '2', $this->m_CHARSET);
		$wsFootText   = $this->decodeText($wsFootText, '2', $this->m_CHARSET);
		
		$contentDC->SetTitle($wsTitle);
		$contentDC->SetKeynote($wsKeynote);
		$contentDC->SetText($wsText);
		$contentDC->SetSecondContent($wsSecondText);
		$contentDC->SetFootText($wsFootText);
		$contentDC->SetAutor($wsAutor);
		$contentDC->SetTextLayout($wsLayout);
		$contentDC->SetID($wsID);
		$contentDC->SetInWorkState($wsInWork);
		$contentDC->SetPublished($wsPub);
		$contentDC->SetAccess($wsAcs);
		
		if($withLanguages && $no > 0) {
			$contentDC->SetLanguage($wsLang);
		}
		
		return $contentDC;
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$sql = "SELECT * "
			."FROM blog_content_languages "
			."WHERE content_uid = '".$id."'";
			
			$sqlQR = $sqlAL->sqlQuery($sql);
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)) {
				$arrReturn[$count] = $sqlObj->language;
				
				$count++;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arrReturn;
	}
	
	
	
	/**
	 * Get the id of a language content file
	 * 
	 * @param String $id
	 * @param String $lang
	 * @return String
	 */
	function getXmlIdFromContentLanguage($id, $language) {
		if($this->m_choosenDB == 'xml'){
			$arr_docs = $this->getPathContent(
				$this->m_path.'/tcms_content_languages/'
			);
			
			$wsCUid = '';
			
			if($this->isReal($arr_docs)) {
				foreach($arr_docs as $key => $val) {
					$xml = new xmlparser(
						$this->m_path.'/tcms_content_languages/'.$val, 'r'
					);
					
					$wsLang = $xml->read_value('language');
					$wsUid  = $xml->read_value('content_uid');
					
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
	 * Get a impressum data container
	 * 
	 * @return tcms_dc_impressum Object
	 */
	function getImpressumDC($language){
		$impDC = new tcms_dc_impressum();
		
		if($this->m_choosenDB == 'xml'){
			$xml = new xmlparser(''.$this->m_path.'/tcms_global/impressum.'.$language.'.xml', 'r');
			$wsID      = $xml->read_section('imp', 'imp_id');
			$wsTitle   = $xml->read_section('imp', 'imp_title');
			$wsKeynote = $xml->read_section('imp', 'imp_stamp');
			$wsContact = $xml->read_section('imp', 'imp_contact');
			$wsTaxno   = $xml->read_section('imp', 'taxno');
			$wsUstID   = $xml->read_section('imp', 'ustid');
			$wsText    = $xml->read_section('imp', 'legal');
			
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$strQuery = "SELECT imp_title, imp_stamp, imp_contact, taxno, ustid, legal "
			."FROM ".$this->m_sqlPrefix."impressum "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$wsID      = 'impressum';
			$wsTitle   = $sqlObj->imp_title;
			$wsKeynote = $sqlObj->imp_stamp;
			$wsText    = $sqlObj->legal;
			$wsContact = $sqlObj->imp_contact;
			$wsTaxno   = $sqlObj->taxno;
			$wsUstID   = $sqlObj->ustid;
			
			$sqlAL->sqlFreeResult($sqlQR);
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
			$xml = new xmlparser(''.$this->m_path.'/tcms_global/frontpage.'.$language.'.xml', 'r');
			$wsID            = $xml->read_section('front', 'front_id');
			$wsLang          = $xml->read_section('front', 'language');
			$wsTitle         = $xml->read_section('front', 'front_title');
			$wsSubtitle      = $xml->read_section('front', 'front_stamp');
			$wsText          = $xml->read_section('front', 'front_text');
			$wsNewsTitle     = $xml->read_section('front', 'news_title');
			$wsNewsCut       = $xml->read_section('front', 'news_cut');
			$wsNewsAmount    = $xml->read_section('front', 'module_use_0');
			$wsSBNewsTitle   = $xml->read_section('front', 'sb_news_title');
			$wsSBNewsAmount  = $xml->read_section('front', 'sb_news_amount');
			$wsSBNewsCut     = $xml->read_section('front', 'sb_news_chars');
			$wsSBNewsEnabled = $xml->read_section('front', 'sb_news_enabled');
			$wsSBNewsDisplay = $xml->read_section('front', 'sb_news_display');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle   == false) $wsTitle   = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$strQuery = "SELECT language, front_title, front_stamp, front_text, news_title, news_cut, "
			."module_use_0, sb_news_title, sb_news_amount, sb_news_chars, sb_news_enabled, "
			."sb_news_display "
			."FROM ".$this->m_sqlPrefix."frontpage "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
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
			
			$sqlAL->sqlFreeResult($sqlQR);
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
	function getNewsmanagerDC($language){
		$newsDC = new tcms_dc_newsmanager();
		
		if($this->m_choosenDB == 'xml'){
			$xml = new xmlparser(''.$this->m_path.'/tcms_global/newsmanager.'.$language.'.xml', 'r');
			$wsID              = $xml->read_section('config', 'news_id');
			$wsLang            = $xml->read_section('config', 'language');
			$wsTitle           = $xml->read_section('config', 'news_title');
			$wsSubtitle        = $xml->read_section('config', 'news_stamp');
			$wsText            = $xml->read_section('config', 'news_text');
			$wsImage           = $xml->read_section('config', 'news_image');
			$wsUseComments     = $xml->read_section('config', 'use_comments');
			$wsShowAutor       = $xml->read_section('config', 'show_autor');
			$wsShowAutorAsLink = $xml->read_section('config', 'show_autor_as_link');
			$wsNewsAmount      = $xml->read_section('config', 'news_amount');
			$wsNewsChars       = $xml->read_section('config', 'news_cut');
			$wsAccess          = $xml->read_section('config', 'access');
			$wsUseGravatar     = $xml->read_section('config', 'use_gravatar');
			$wsUseEmoticons    = $xml->read_section('config', 'use_emoticons');
			$wsUseTrachback    = $xml->read_section('config', 'use_trackback');
			$wsUseTimesince    = $xml->read_section('config', 'use_timesince');
			$wsReadmoreLink    = $xml->read_section('config', 'readmore_link');
			$wsNewsSpacing     = $xml->read_section('config', 'news_spacing');
			$wsSynRSS091       = $xml->read_section('config', 'use_rss091');
			$wsSynRSS10        = $xml->read_section('config', 'use_rss10');
			$wsSynRSS20        = $xml->read_section('config', 'use_rss20');
			$wsSynRSSAtom      = $xml->read_section('config', 'use_atom03');
			$wsSynRSSOpml      = $xml->read_section('config', 'use_opml');
			$wsSynAmount       = $xml->read_section('config', 'syn_amount');
			$wsSynUseTitle     = $xml->read_section('config', 'use_syn_title');
			$wsSynDefaultFeed  = $xml->read_section('config', 'def_feed');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsTitle   == false) $wsTitle   = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$strQuery = "SELECT language, news_title, news_stamp, news_image, use_comments, show_autor, "
			."show_autor_as_link, news_amount, news_cut, access, use_gravatar, use_emoticons, "
			."use_trackback, use_timesince, news_text, readmore_link, news_spacing, use_rss091, use_rss10, "
			."use_rss20, use_atom03, use_opml, syn_amount, use_syn_title, def_feed "
			."FROM ".$this->m_sqlPrefix."newsmanager "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
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
			$wsUseTrachback    = $sqlObj->use_trackback;
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
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID            == NULL) $wsID            = '';
			if($wsLang          == NULL) $wsLang          = '';
			if($wsTitle         == NULL) $wsTitle         = '';
			if($wsSubtitle      == NULL) $wsSubtitle      = '';
			if($wsText          == NULL) $wsText          = '';
		}
		
		$wsTitle       = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		$wsSubtitle    = $this->decodeText($wsSubtitle, '2', $this->m_CHARSET);
		$wsText        = $this->decodeText($wsText, '2', $this->m_CHARSET);
		
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
		$newsDC->setUseTrachback($wsUseTrachback);
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
			$xml = new xmlparser($this->m_path.'/tcms_global/contactform.'.$language.'.xml', 'r');
			
			$wsID      = 'contactform';
			$wsTitle   = $xml->read_section('email', 'contacttitle');
			$wsKeynote = $xml->read_section('email', 'contactstamp');
			$wsText    = $xml->read_section('email', 'contacttext');
			$wsContact = $xml->read_section('email', 'contact');
			$wsSCIS    = $xml->read_section('email', 'show_contacts_in_sidebar');
			$wsAccess  = $xml->read_section('email', 'access');
			$wsEnabled = $xml->read_section('email', 'enabled');
			$wsUA      = $xml->read_section('email', 'use_adressbook');
			$wsUC      = $xml->read_section('email', 'use_contact');
			$wsSC      = $xml->read_section('email', 'show_contactemail');
			
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
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$strQuery = "SELECT * "
			."FROM ".$this->m_sqlPrefix."contactform "
			."WHERE language = '".$language."'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
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
			
			$sqlAL->sqlFreeResult($sqlQR);
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
	 * Get a sidebarmodul data container
	 * 
	 * @return tcms_dc_sidebarmodule Object
	 */
	function getSidebarModuleDC(){
		$sbmDC = new tcms_dc_sidebarmodule();
		
		$xmlActive = new xmlparser(''.$this->m_path.'/tcms_global/modules.xml','r');
		
		$arrASM['use_side_gallery']   = $xmlActive->read_section('config', 'side_gallery');
		$arrASM['use_layout_chooser'] = $xmlActive->read_section('config', 'layout_chooser');
		$arrASM['use_side_links']     = $xmlActive->read_section('config', 'side_links');
		$arrASM['use_login']          = $xmlActive->read_section('config', 'login');
		$arrASM['use_side_category']  = $xmlActive->read_section('config', 'side_category');
		$arrASM['use_side_archives']  = $xmlActive->read_section('config', 'side_archives');
		$arrASM['use_syndication']    = $xmlActive->read_section('config', 'syndication');
		$arrASM['use_newsletter']     = $xmlActive->read_section('config', 'newsletter');
		$arrASM['use_search']         = $xmlActive->read_section('config', 'search');
		$arrASM['use_sidebar']        = $xmlActive->read_section('config', 'sidebar');
		$arrASM['use_poll']           = $xmlActive->read_section('config', 'poll');
		
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
		
		$sbmDC->SetSideGallery($arrASM['use_side_gallery']);
		$sbmDC->SetLayoutChooser($arrASM['use_layout_chooser']);
		$sbmDC->SetSideLinks($arrASM['use_side_links']);
		$sbmDC->SetLogin($arrASM['use_login']);
		$sbmDC->SetSideCategory($arrASM['use_side_category']);
		$sbmDC->SetSideArchive($arrASM['use_side_archives']);
		$sbmDC->SetSyndication($arrASM['use_syndication']);
		$sbmDC->SetNewsletter($arrASM['use_newsletter']);
		$sbmDC->SetSearch($arrASM['use_search']);
		$sbmDC->SetSidebar($arrASM['use_sidebar']);
		$sbmDC->SetPoll($arrASM['use_poll']);
		
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
			
			$wsLang          = $xml->read_section('side', 'lang');
			$wsSidemenuTitle = $xml->read_section('side', 'sidemenu_title');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsLang          == false) $wsLang          = '';
			if($wsSidemenuTitle == false) $wsSidemenuTitle = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->m_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->m_sqlUser, $this->m_sqlPass, $this->m_sqlHost, $this->m_sqlDB, $this->m_sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($this->m_sqlPrefix.'sidebar_extensions', 'sidebar_extensions');
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$wsLang          = $sqlObj->lang;
			$wsSidemenuTitle = $sqlObj->sidemenu_title;
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsLang          == NULL) $wsLang          = '';
			if($wsSidemenuTitle == NULL) $wsSidemenuTitle = '';
		}
		
		//$wsTitle   = $this->decodeText($wsTitle, '2', $this->m_CHARSET);
		
		$se->setID('sidebar_extensions');
		$se->setLanguages($wsLang);
		$se->setSidemenuTitle($wsSidemenuTitle);
		
		return $se;
	}
}

?>
