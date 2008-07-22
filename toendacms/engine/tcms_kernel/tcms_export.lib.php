<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Export class
|
| File:	tcms_export.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Export class
 *
 * This class is used to provide a export class.
 *
 * @version 0.0.1
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
 *
 * --------------------------------------------------------
 * PUBLIC METHODS
 * --------------------------------------------------------
 * 
 * importVCard                 -> Import a vcard
 * 
 * </code>
 *
 */


class tcms_export extends tcms_main {
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
	 * PHP5: Default constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 * @param Object $tcmsTimeObj = null
	 */
	public function __construct($tcms_administer_path = 'data', $charset, $tcmsTimeObj = null){
		$this->m_CHARSET = $charset;
		$this->m_path = $tcms_administer_path;
		$this->_tcmsTime = $tcmsTimeObj;
		
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
		//parent::__construct($tcms_administer_path, $tcmsTimeObj);
		//parent::setDatabaseInfo($this->m_choosenDB);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	public function __destruct(){
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
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Generate a Wordpress Export file
	 * 
	 * @param String $language
	 * @param String $seoFolder = ''
	 * @return String XML-Stream
	 */
	public function generateWordpressExportFile($language, $seoFolder = '') {
		using('toendacms.tools.feedcreator.feedcreator_class', false, true);
		using('toendacms.kernel.script', false, true);
		using('toendacms.kernel.sql', false, true);
		using('toendacms.kernel.account_provider', false, true);
		using('toendacms.kernel.datacontainer_provider', false, true);
		using('toendacms.datacontainer.news', false, true);
		using('toendacms.datacontainer.account', false, true);
		using('toendacms.datacontainer.comment', false, true);
		
		$tcms_version = new tcms_version('../../');
		$cfgObj = new tcms_configuration($this->m_path);
		$cfgObj->decodeConfiguration($this);
		
		$lang = $cfgObj->getLanguageCodeByTCMSCode($language);
		
		$wstitle      = $this->decodeText($cfgObj->getSiteTitle(), '2', $this->m_CHARSET);
		$wsname       = $this->decodeText($cfgObj->getSiteName(), '2', $this->m_CHARSET);
		$wskey        = $this->decodeText($cfgObj->getSiteKey(), '2', $this->m_CHARSET);
		$wsowner      = $this->decodeText($cfgObj->getWebpageOwner(), '2', $this->m_CHARSET);
		$wscopyright  = $this->decodeText($cfgObj->getWebpageCopyright(), '2', $this->m_CHARSET);
		$wsowner_url  = $this->decodeText($cfgObj->getWebpageOwnerUrl(), '2', $this->m_CHARSET);
		$wsowner_mail = $this->decodeText($cfgObj->getWebpageOwnerMail(), '2', $this->m_CHARSET);
		
		$path = ( trim($seoFolder) != '' ? $seoFolder.'/' : '' );
		
		if(!$this->endsWith('/', $wsowner_url)) {
			$wsowner_url = $wsowner_url.'/';
		}
		
		$base_site_url = $wsowner_url.$path;
		$base_blog_url = $wsowner_url.$path;
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>'.chr(13);
		//$xml .= '<!-- generator="toendaCMS '.$tcms_version->getVersion().' - '.$tcms_version->getBuild().'" created="'.date('Y-m-d H:i').'"-->'.chr(13);
		$xml .= '<!-- generator="WordPress/2.6" created="'.date('Y-m-d H:i').'"-->'.chr(13);
		$xml .= '<rss version="2.0"'.chr(13);
		$xml .= $this->createCharString(4).'xmlns:content="http://purl.org/rss/1.0/modules/content/"'.chr(13);
		$xml .= $this->createCharString(4).'xmlns:wfw="http://wellformedweb.org/CommentAPI/"'.chr(13);
		$xml .= $this->createCharString(4).'xmlns:dc="http://purl.org/dc/elements/1.1/"'.chr(13);
		$xml .= $this->createCharString(4).'xmlns:wp="http://wordpress.org/export/1.0/"'.chr(13);
		$xml .= '>'.chr(13);
		$xml .= $this->createCharString(4).'<channel>'.chr(13);
		$xml .= $this->createCharString(8).'<title>'.$wsname.'</title>'.chr(13);
		$xml .= $this->createCharString(8).'<link>'.$wsowner_url.'</link>'.chr(13);
		$xml .= $this->createCharString(8).'<description>'.$wskey.'</description>'.chr(13);
		$xml .= $this->createCharString(8).'<pubDate>'.date('r').'</pubDate>'.chr(13);
		//$xml .= $this->createCharString(8).'<generator>toendaCMS '.$tcms_version->getVersion().' - '.$tcms_version->getBuild().'</generator>'.chr(13);
		$xml .= $this->createCharString(8).'<generator>http://wordpress.org/?v=2.6</generator>'.chr(13);
	    $xml .= $this->createCharString(8).'<language>'.$cfgObj->getLanguageCodeByTCMSCode($language).'</language>'.chr(13);
	    $xml .= $this->createCharString(8).'<wp:wxr_version>1.0</wp:wxr_version>'.chr(13);
	    $xml .= $this->createCharString(8).'<wp:base_site_url>'.$base_site_url.'</wp:base_site_url>'.chr(13);
	    $xml .= $this->createCharString(8).'<wp:base_blog_url>'.$base_blog_url.'</wp:base_blog_url>'.chr(13);
		
		
		
		/*
		$rss = new UniversalFeedCreator();
		$rss->encoding = $this->m_CHARSET;
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
		*/
		
		// generate now ...
		$_tcms_ap = new tcms_account_provider($this->m_path, $this->m_CHARSET, $this->_tcmsTime);
		$_tcms_auth = new tcms_authentication($this->m_path, $this->m_CHARSET, '', $this->_tcmsTime);
		$_tcms_dc = new tcms_datacontainer_provider($this->m_path, $this->m_CHARSET, $this->_tcmsTime);
		
		if($seoFolder != '') {
			$imagePath = $seoFolder.'/';
		}
		else {
			$imagePath = '/';
		}
		
		$wstitle = '';
		
		/*
			categories; also generates as tags
		*/
		$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
		$sqlCN = $sqlAL->connect(
			$this->m_sqlUser, 
			$this->m_sqlPass, 
			$this->m_sqlHost, 
			$this->m_sqlDB, 
			$this->m_sqlPort
		);
		
		$sqlQR = $sqlAL->getAll($this->m_sqlPrefix.'news_categories ORDER BY name');
		
		$count = 0;
		
		$xml2 = '';
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$wsName = $this->decodeText($sqlObj->name, '2', $this->m_CHARSET);
			$wsDesc = $this->decodeText($sqlObj->desc, '2', $this->m_CHARSET);
			$wsNice = $this->cleanStringForUrlName($wsName);
			
			$xml .= $this->createCharString(8).'<wp:category>';
			$xml .= '<wp:category_nicename>'.$wsNice.'</wp:category_nicename>';
		    $xml .= '<wp:category_parent></wp:category_parent>';
		    $xml .= '<wp:cat_name><![CDATA['.$wsName.']]></wp:cat_name>';
		    $xml .= '</wp:category>'.chr(13);
		    
			$xml2 .= $this->createCharString(8).'<wp:tag>';
			$xml2 .= '<wp:tag_slug>'.$wsNice.'</wp:tag_slug>';
		    $xml2 .= '<wp:tag_name><![CDATA['.$wsName.']]></wp:tag_name>';
		    $xml2 .= '</wp:tag>'.chr(13);
		}
		
		$xml = $xml.$xml2;
		
		$sqlAL->sqlFreeResult($sqlQR);
		
		$count = 10;
		$cCount = 10;
		
		/*
			news
		*/
		$arrNewsDC = $_tcms_dc->getNewsDCList('', 'Administrator', 0, '-1', true, true);
		
		//echo count($arrNewsDC);
		
		if($this->isArray($arrNewsDC)) {
			foreach($arrNewsDC as $n_key => $n_value) {
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				$userID = $_tcms_ap->getUserID($dcNews->GetAutor());
				
				if($userID != false) {
					$dcAcc = new tcms_dc_account();
					$dcAcc = $_tcms_ap->getAccount($userID);
					$wsMail = $dcAcc->getEmail();
				}
				else {
					$wsMail = $wsowner_mail;
				}
				
				$xml .= $this->createCharString(8).'<item>'.chr(13);
				$xml .= $this->createCharString(12).'<title>'.$dcNews->getTitle().'</title>'.chr(13);
				$xml .= $this->createCharString(12).'<link>'.$wsowner_url.$seoFolder.'/archives/'.$count.'</link>'.chr(13);
				
				$xml .= $this->createCharString(12).'<pubDate>'
				.date(
					'r', 
					mktime(
						substr($dcNews->getTime(), 0, 2), 
						substr($dcNews->getTime(), 3, 2), 
						0, 
						substr($dcNews->getDate(), 3, 2), 
						substr($dcNews->getDate(), 0, 2), 
						substr($dcNews->getDate(), 6, 4)
					)
				).'</pubDate>'.chr(13);
				
				$xml .= $this->createCharString(12).'<dc:creator><![CDATA['.$dcNews->getAutor().']]></dc:creator>'.chr(13);
				
				
				// load categories and tags
				$sqlAL = new sqlAbstractionLayer($this->m_choosenDB, $this->_tcmsTime);
				$sqlCN = $sqlAL->connect(
					$this->m_sqlUser, 
					$this->m_sqlPass, 
					$this->m_sqlHost, 
					$this->m_sqlDB, 
					$this->m_sqlPort
				);
				
				$strSQL = "SELECT * "
				."FROM ".$this->m_sqlPrefix."news_to_categories "
				."INNER JOIN ".$this->m_sqlPrefix."news_categories ON (".$this->m_sqlPrefix."news_to_categories.cat_uid = ".$this->m_sqlPrefix."news_categories.uid) "
				."WHERE (".$this->m_sqlPrefix."news_to_categories.news_uid = '".$dcNews->GetID()."')";
				
				$sqlQR = $sqlAL->query($strSQL);
				$sqlNR = $sqlAL->getNumber($sqlQR);
				
				if($sqlNR == 0) {
					$sqlQR = $sqlAL->getOne($this->m_sqlPrefix.'news_categories', $defaultCat);
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$wsName = $this->decodeText($sqlObj->name, '2', $this->m_CHARSET);
					$wsNice = $this->cleanStringForUrlName($wsName);
					
					$xml .= $this->createCharString(12).'<category><![CDATA['.$wsName.']]></category>'.chr(13);
					$xml .= $this->createCharString(12).'<category domain="category" nicename="'.$wsNice.'"><![CDATA['.$wsName.']]></category>'.chr(13);
					$xml .= $this->createCharString(12).'<category domain="tag"><![CDATA['.$wsName.']]></category>'.chr(13);
					$xml .= $this->createCharString(12).'<category domain="tag" nicename="'.$wsNice.'"><![CDATA['.$wsName.']]></category>'.chr(13);
				}
				else {
					while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
						$wsName = $this->decodeText($sqlObj->name, '2', $this->m_CHARSET);
						$wsNice = $this->cleanStringForUrlName($wsName);
						
						$xml .= $this->createCharString(12).'<category><![CDATA['.$wsName.']]></category>'.chr(13);
						$xml .= $this->createCharString(12).'<category domain="category" nicename="'.$wsNice.'"><![CDATA['.$wsName.']]></category>'.chr(13);
						$xml .= $this->createCharString(12).'<category domain="tag"><![CDATA['.$wsName.']]></category>'.chr(13);
						$xml .= $this->createCharString(12).'<category domain="tag" nicename="'.$wsNice.'"><![CDATA['.$wsName.']]></category>'.chr(13);
					}
				}
				
				$sqlAL->freeResult($sqlQR);
				unset($sqlAL);
				
				
				$xml .= $this->createCharString(12).'<guid isPermaLink="false">'.$wsowner_url.$seoFolder.'/?p='.$count.'</guid>'.chr(13);
				$xml .= $this->createCharString(12).'<description></description>'.chr(13);
				
				$toendaScript = new toendaScript();
				
				$news_content = $dcNews->getText();
				$news_content = $toendaScript->checkSEO($news_content, $imagePath);
				$news_content = $toendaScript->cutAtTcmsMoreTag($news_content);
				
				$xml .= $this->createCharString(12).'<content:encoded><![CDATA['.$news_content.']]></content:encoded>'.chr(13);
				$xml .= $this->createCharString(12).'<excerpt:encoded><![CDATA[]]></excerpt:encoded>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_id>'.$count.'</wp:post_id>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_date>'.date(
					'Y-m-d H:i:s', 
					mktime(
						substr($dcNews->getTime(), 0, 2), 
						substr($dcNews->getTime(), 3, 2), 
						0, 
						substr($dcNews->getDate(), 3, 2), 
						substr($dcNews->getDate(), 0, 2), 
						substr($dcNews->getDate(), 6, 4)
					)
				).'</wp:post_date>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_date_gmt>'.date(
					'Y-m-d H:i:s', 
					mktime(
						substr($dcNews->getTime(), 0, 2), 
						substr($dcNews->getTime(), 3, 2), 
						0, 
						substr($dcNews->getDate(), 3, 2), 
						substr($dcNews->getDate(), 0, 2), 
						substr($dcNews->getDate(), 6, 4)
					)
				).'</wp:post_date_gmt>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:comment_status>'.( $dcNews->getCommentsEnabled() ? 'open' : 'closed' ).'</wp:comment_status>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:ping_status>closed</wp:ping_status>'.chr(13);
				
				$wsNice = $this->cleanStringForUrlName($dcNews->getTitle());
				$xml .= $this->createCharString(12).'<wp:post_name>'.$wsNice.'</wp:post_name>'.chr(13);
				
				$xml .= $this->createCharString(12).'<wp:status>'.( $dcNews->getPublished() ? 'publish' : 'draft' ).'</wp:status>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_parent>0</wp:post_parent>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:menu_order>0</wp:menu_order>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_type>post</wp:post_type>'.chr(13);
				$xml .= $this->createCharString(12).'<wp:post_password></wp:post_password>'.chr(13);
				
				$xml .= $this->createCharString(12).'<wp:postmeta>'.chr(13);
				$xml .= $this->createCharString(16).'<wp:meta_key>_edit_lock</wp:meta_key>'.chr(13);
				$xml .= $this->createCharString(16).'<wp:meta_value>1215175430</wp:meta_value>'.chr(13);
				$xml .= $this->createCharString(12).'</wp:postmeta>'.chr(13);
				
				$xml .= $this->createCharString(12).'<wp:postmeta>'.chr(13);
				$xml .= $this->createCharString(16).'<wp:meta_key>_edit_last</wp:meta_key>'.chr(13);
				$xml .= $this->createCharString(16).'<wp:meta_value>1</wp:meta_value>'.chr(13);
				$xml .= $this->createCharString(12).'</wp:postmeta>'.chr(13);
				
				
				// comments
				$arrCommentDC = $_tcms_dc->getCommentDCList($dcNews->getID());
				
				if($this->isArray($arrCommentDC)) {
					foreach($arrCommentDC as $key => $value) {
						$commentDC = new tcms_dc_comment();
						$commentDC = $arrCommentDC[$key];
						
						$xml .= $this->createCharString(12).'<wp:comment>'.chr(13);
						
						$xml .= $this->createCharString(16).'<wp:comment_id>'.$cCount.'</wp:comment_id>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_author>'.$commentDC->getName().'</wp:comment_author>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_author_email>'.$commentDC->getEMail().'</wp:comment_author_email>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_author_url>'.$commentDC->getURL().'</wp:comment_author_url>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_author_IP>'.$commentDC->getIP().'</wp:comment_author_IP>'.chr(13);
						
						$xml .= $this->createCharString(16).'<wp:comment_date>'.date(
							'Y-m-d H:i:s', 
							mktime(
								substr($commentDC->getTime(), 0, 4), 
								substr($commentDC->getTime(), 10, 2), 
								substr($commentDC->getTime(), 12, 2), 
								substr($commentDC->getTime(), 4, 2), 
								substr($commentDC->getTime(), 6, 2), 
								substr($commentDC->getTime(), 0, 4)
							)
						).'</wp:comment_date>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_date_gmt>'.date(
							'Y-m-d H:i:s', 
							mktime(
								substr($commentDC->getTime(), 0, 4), 
								substr($commentDC->getTime(), 10, 2), 
								substr($commentDC->getTime(), 12, 2), 
								substr($commentDC->getTime(), 4, 2), 
								substr($commentDC->getTime(), 6, 2), 
								substr($commentDC->getTime(), 0, 4)
							)
						).'</wp:comment_date_gmt>'.chr(13);
						
						$xml .= $this->createCharString(16).'<wp:comment_content><![CDATA['.$commentDC->getText().']]></wp:comment_content>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_approved>1</wp:comment_approved>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_type></wp:comment_type>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_parent>0</wp:comment_parent>'.chr(13);
						$xml .= $this->createCharString(16).'<wp:comment_user_id>0</wp:comment_user_id>'.chr(13);
						
						$xml .= $this->createCharString(12).'</wp:comment>'.chr(13);
					}
				}
				
				$xml .= $this->createCharString(8).'</item>'.chr(13);
				
				$count++;
				$cCount++;
			}
		}
		
		/*
		$arrNewsDC = $this->getNewsDCList($language, 'Administrator', $amount, '1', true);
		
		if($this->isArray($arrNewsDC)) {
			foreach($arrNewsDC as $n_key => $n_value) {
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				$userID = $_tcms_ap->getUserID($dcNews->GetAutor());
				
				if($userID != false) {
					$dcAcc = new tcms_dc_account();
					$dcAcc = $_tcms_ap->getAccount($userID);
					$wsMail = $dcAcc->getEmail();
				}
				else {
					$wsMail = $wsowner_mail;
				}
				*/
				/*
				$item = new FeedItem();
				
				$item->title = html_entity_decode($dcNews->getTitle());
				$item->link = $wsowner_url.$seoFolder.'/?id=newsmanager&news='.$dcNews->getID();
				
				$toendaScript = new toendaScript();
				
				$news_content = $dcNews->getText();
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
				*/
				/*
				unset($toendaScript);
			}
		}
		*/
		
		
		
		$xml .= $this->createCharString(4).'</channel>'.chr(13);
		$xml .= '</rss>'.chr(13);
		
		return $xml;
		
		/*
		
    
        <item>
<title>Hello world!</title>
<link>http://galaxy.vandango.org/archives/1</link>
<pubDate>Fri, 04 Jul 2008 12:00:38 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

        <category domain="tag"><![CDATA[Hello]]></category>

        <category domain="tag" nicename="hello"><![CDATA[Hello]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=1</guid>
<description></description>
<content:encoded><![CDATA[Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>1</wp:post_id>
<wp:post_date>2008-07-04 14:00:38</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:00:38</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>hello-world</wp:post_name>
<wp:status>publish</wp:status>
<wp:post_parent>0</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>post</wp:post_type>
<wp:post_password></wp:post_password>
<wp:postmeta>
<wp:meta_key>_edit_lock</wp:meta_key>
<wp:meta_value>1215175430</wp:meta_value>
</wp:postmeta>
<wp:postmeta>
<wp:meta_key>_edit_last</wp:meta_key>
<wp:meta_value>1</wp:meta_value>
</wp:postmeta>
<wp:comment>
<wp:comment_id>1</wp:comment_id>
<wp:comment_author><![CDATA[Mr WordPress]]></wp:comment_author>
<wp:comment_author_email></wp:comment_author_email>
<wp:comment_author_url>http://wordpress.org/</wp:comment_author_url>
<wp:comment_author_IP></wp:comment_author_IP>
<wp:comment_date>2008-07-04 14:00:38</wp:comment_date>
<wp:comment_date_gmt>2008-07-04 12:00:38</wp:comment_date_gmt>
<wp:comment_content><![CDATA[Hi, this is a comment.<br />To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.]]></wp:comment_content>
<wp:comment_approved>1</wp:comment_approved>
<wp:comment_type></wp:comment_type>
<wp:comment_parent>0</wp:comment_parent>
<wp:comment_user_id>0</wp:comment_user_id>
</wp:comment>
    </item>
    
    
<item>
<title>About</title>
<link>http://galaxy.vandango.org/about</link>
<pubDate>Fri, 04 Jul 2008 12:00:38 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

<guid isPermaLink="false">http://galaxy.vandango.org/?page_id=2</guid>
<description></description>
<content:encoded><![CDATA[This is an example of a WordPress page, you could edit this to put information about yourself or your site so readers know where you are coming from. You can create as many pages like this one or sub-pages as you like and manage all of your content inside of WordPress.]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>2</wp:post_id>
<wp:post_date>2008-07-04 14:00:38</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:00:38</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>about</wp:post_name>
<wp:status>publish</wp:status>
<wp:post_parent>0</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>page</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
    
    
    
    
    
    
    
    
    
<item>
<title>Hello world!</title>
<link>http://galaxy.vandango.org/archives/9</link>
<pubDate>Fri, 04 Jul 2008 12:00:38 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=9</guid>
<description></description>
<content:encoded><![CDATA[Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>9</wp:post_id>
<wp:post_date>2008-07-04 14:00:38</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:00:38</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>1-revision</wp:post_name>
<wp:status>inherit</wp:status>
<wp:post_parent>1</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>revision</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
    
    
    
    
    
<item>
<title>Test Post</title>
<link>http://galaxy.vandango.org/archives/4</link>
<pubDate>Fri, 04 Jul 2008 12:02:00 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=4</guid>
<description></description>
<content:encoded><![CDATA[]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>4</wp:post_id>
<wp:post_date>2008-07-04 14:02:00</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:02:00</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>3-revision</wp:post_name>
<wp:status>inherit</wp:status>
<wp:post_parent>3</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>revision</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
    
    
    
    
    
    
<item>
<title>Test Post</title>
<link>http://galaxy.vandango.org/archives/5</link>
<pubDate>Fri, 04 Jul 2008 12:02:17 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=5</guid>
<description></description>
<content:encoded><![CDATA[asdasdsadsa]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>5</wp:post_id>
<wp:post_date>2008-07-04 14:02:17</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:02:17</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>3-revision-2</wp:post_name>
<wp:status>inherit</wp:status>
<wp:post_parent>3</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>revision</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
    
    
    
    
    
    
    
    
    
    
<item>
<title>Test Post</title>
<link>http://galaxy.vandango.org/archives/3</link>
<pubDate>Fri, 04 Jul 2008 12:02:20 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

        <category domain="tag"><![CDATA[Hello]]></category>

        <category domain="tag" nicename="hello"><![CDATA[Hello]]></category>

        <category domain="tag"><![CDATA[Post]]></category>

        <category domain="tag" nicename="post"><![CDATA[Post]]></category>

        <category domain="tag"><![CDATA[Test]]></category>

        <category domain="tag" nicename="test"><![CDATA[Test]]></category>

        <category domain="tag"><![CDATA[Test Post]]></category>

        <category domain="tag" nicename="test-post"><![CDATA[Test Post]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=3</guid>
<description></description>
<content:encoded><![CDATA[asdasdsadsa]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>3</wp:post_id>
<wp:post_date>2008-07-04 14:02:20</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:02:20</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>test-post</wp:post_name>
<wp:status>publish</wp:status>
<wp:post_parent>0</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>post</wp:post_type>
<wp:post_password></wp:post_password>
<wp:postmeta>
<wp:meta_key>_edit_lock</wp:meta_key>
<wp:meta_value>1215687522</wp:meta_value>
</wp:postmeta>
<wp:postmeta>
<wp:meta_key>_edit_last</wp:meta_key>
<wp:meta_value>1</wp:meta_value>
</wp:postmeta>
    </item>
<item>
<title>Test Post</title>
<link>http://galaxy.vandango.org/archives/8</link>
<pubDate>Fri, 04 Jul 2008 12:02:20 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=8</guid>
<description></description>
<content:encoded><![CDATA[asdasdsadsa]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>8</wp:post_id>
<wp:post_date>2008-07-04 14:02:20</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:02:20</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>3-revision-3</wp:post_name>
<wp:status>inherit</wp:status>
<wp:post_parent>3</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>revision</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
<item>
<title>Test Post</title>
<link>http://galaxy.vandango.org/archives/10</link>
<pubDate>Fri, 04 Jul 2008 12:43:36 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/?p=10</guid>
<description></description>
<content:encoded><![CDATA[asdasdsadsa]]></content:encoded>
<excerpt:encoded><![CDATA[]]></excerpt:encoded>
<wp:post_id>10</wp:post_id>
<wp:post_date>2008-07-04 14:43:36</wp:post_date>
<wp:post_date_gmt>2008-07-04 12:43:36</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>3-revision-4</wp:post_name>
<wp:status>inherit</wp:status>
<wp:post_parent>3</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>revision</wp:post_type>
<wp:post_password></wp:post_password>
    </item>
<item>
<title>Archives</title>
<link>http://galaxy.vandango.org/archivepage</link>
<pubDate>Mon, 14 Jul 2008 13:28:10 +0000</pubDate>
<dc:creator><![CDATA[vandango]]></dc:creator>

        <category><![CDATA[Uncategorized]]></category>

        <category domain="category" nicename="uncategorized"><![CDATA[Uncategorized]]></category>

<guid isPermaLink="false">http://galaxy.vandango.org/archivepage</guid>
<description></description>
<content:encoded><![CDATA[Do not edit this page]]></content:encoded>
<excerpt:encoded><![CDATA[Do not edit this page]]></excerpt:encoded>
<wp:post_id>13</wp:post_id>
<wp:post_date>2008-07-14 15:28:10</wp:post_date>
<wp:post_date_gmt>2008-07-14 13:28:10</wp:post_date_gmt>
<wp:comment_status>open</wp:comment_status>
<wp:ping_status>open</wp:ping_status>
<wp:post_name>archivepage</wp:post_name>
<wp:status>publish</wp:status>
<wp:post_parent>0</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type>page</wp:post_type>
<wp:post_password></wp:post_password>
    </item>

		*/
	}
}
