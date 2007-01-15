<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS News Configuration
|
| File:		tcms_news_configuration.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS News Configuration
 *
 * This class is used for the news configuration.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * ---------------------------------------------
 * TCMS News Configuration
 * ---------------------------------------------
 * 
 * __construct()                       -> PHP5 Constructor
 * news_configuration()                -> PHP4 Constructor
 * __destruct()                        -> PHP5 Destructor
 * _news_configuration()               -> PHP4 Destructor
 *
 * 
 * </code>
 *
 */


class news_configuration extends tcms_main {
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
		
		if($this->m_choosenDB == 'xml'){
			
		}
		else {
			
		}
		
		/*
		if($choosenDB == 'xml'){
			$news_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsmanager.xml','r');
			
			$old_news_mm_id       = $news_xml->read_section('config', 'news_id');
			$old_news_mm_title    = $news_xml->read_section('config', 'news_title');
			$old_news_mm_stamp    = $news_xml->read_section('config', 'news_stamp');
			$old_news_mm_text     = $news_xml->read_section('config', 'news_text');
			$old_news_mm_image    = $news_xml->read_section('config', 'news_image');
			$old_news_mm_usec     = $news_xml->read_section('config', 'use_comments');
			$old_news_mm_usea     = $news_xml->read_section('config', 'show_autor');
			$old_news_mm_useal    = $news_xml->read_section('config', 'show_autor_as_link');
			$old_news_mm_amount   = $news_xml->read_section('config', 'news_amount');
			$old_news_mm_access   = $news_xml->read_section('config', 'access');
			$old_news_cut         = $news_xml->read_section('config', 'news_cut');
			$old_use_gravatar     = $news_xml->read_section('config', 'use_gravatar');
			$old_use_emoticons    = $news_xml->read_section('config', 'use_emoticons');
			$old_use_rss091       = $news_xml->read_section('config', 'use_rss091');
			$old_use_rss10        = $news_xml->read_section('config', 'use_rss10');
			$old_use_rss20        = $news_xml->read_section('config', 'use_rss20');
			$old_use_atom03       = $news_xml->read_section('config', 'use_atom03');
			$old_use_opml         = $news_xml->read_section('config', 'use_opml');
			$old_syn_amount       = $news_xml->read_section('config', 'syn_amount');
			$old_use_syn_title    = $news_xml->read_section('config', 'use_syn_title');
			$old_def_feed         = $news_xml->read_section('config', 'def_feed');
			$old_use_trackback    = $news_xml->read_section('config', 'use_trackback');
			$old_use_timesince    = $news_xml->read_section('config', 'use_timesince');
			$old_readmore_link    = $news_xml->read_section('config', 'readmore_link');
			$old_news_spacing     = $news_xml->read_section('config', 'news_spacing');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsmanager', 'newsmanager');
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$old_news_mm_id     = $sqlObj->news_id;
			$old_news_mm_title  = $sqlObj->news_title;
			$old_news_mm_stamp  = $sqlObj->news_stamp;
			$old_news_mm_text   = $sqlObj->news_text;
			$old_news_mm_image  = $sqlObj->news_image;
			$old_news_mm_usec   = $sqlObj->use_comments;
			$old_news_mm_usea   = $sqlObj->show_autor;
			$old_news_mm_useal  = $sqlObj->show_autor_as_link;
			$old_news_mm_amount = $sqlObj->news_amount;
			$old_news_mm_access = $sqlObj->access;
			$old_news_cut       = $sqlObj->news_cut;
			$old_use_gravatar   = $sqlObj->use_gravatar;
			$old_use_emoticons  = $sqlObj->use_emoticons;
			$old_use_rss091     = $sqlObj->use_rss091;
			$old_use_rss10      = $sqlObj->use_rss10;
			$old_use_rss20      = $sqlObj->use_rss20;
			$old_use_atom03     = $sqlObj->use_atom03;
			$old_use_opml       = $sqlObj->use_opml;
			$old_syn_amount     = $sqlObj->syn_amount;
			$old_use_syn_title  = $sqlObj->use_syn_title;
			$old_def_feed       = $sqlObj->def_feed;
			$old_use_trackback  = $sqlObj->use_trackback;
			$old_use_timesince  = $sqlObj->use_timesince;
			$old_readmore_link  = $sqlObj->readmore_link;
			$old_news_spacing   = $sqlObj->news_spacing;
			
			if($old_news_mm_id     == NULL){ $old_news_mm_id     = ''; }
			if($old_news_mm_title  == NULL){ $old_news_mm_title  = ''; }
			if($old_news_mm_stamp  == NULL){ $old_news_mm_stamp  = ''; }
			if($old_news_mm_text   == NULL){ $old_news_mm_text   = ''; }
			if($old_news_mm_image  == NULL){ $old_news_mm_image  = ''; }
			if($old_news_mm_usec   == NULL){ $old_news_mm_usec   = 0; }
			if($old_news_mm_usea   == NULL){ $old_news_mm_usea   = 0; }
			if($old_news_mm_useal  == NULL){ $old_news_mm_useal  = 0; }
			if($old_news_mm_amount == NULL){ $old_news_mm_amount = ''; }
			if($old_news_mm_access == NULL){ $old_news_mm_access = ''; }
			if($old_news_cut       == NULL){ $old_news_cut       = 0; }
			if($old_use_gravatar   == NULL){ $old_use_gravatar   = 0; }
			if($old_use_emoticons  == NULL){ $old_use_emoticons  = 0; }
			if($old_use_rss091     == NULL){ $old_use_rss091     = 0; }
			if($old_use_rss10      == NULL){ $old_use_rss10      = 0; }
			if($old_use_rss20      == NULL){ $old_use_rss20      = 0; }
			if($old_use_atom03     == NULL){ $old_use_atom03     = 0; }
			if($old_use_opml       == NULL){ $old_use_opml       = 0; }
			if($old_syn_amount     == NULL){ $old_syn_amount     = ''; }
			if($old_use_syn_title  == NULL){ $old_use_syn_title  = 0; }
			if($old_def_feed       == NULL){ $old_def_feed       = ''; }
			if($old_use_trackback  == NULL){ $old_use_trackback  = 0; }
			if($old_use_timesince  == NULL){ $old_use_timesince  = 0; }
			if($old_readmore_link  == NULL){ $old_readmore_link  = 0; }
			if($old_news_spacing   == NULL){ $old_news_spacing   = 0; }
		}*/
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $tcms_administer_path = 'data'
	 * @param String $charset
	 */
	function news_configuration($tcms_administer_path = 'data', $charset){
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
	function _tcms_news_configuration(){
		$this->__destruct();
	}
}

?>
