<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Frontpage
|
| File:	tcms_dc_frontpage.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Frontpage
 *
 * This class is used as a datacontainer object for
 * the frontpage.
 *
 * @version 0.0.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_frontpage {
	private $m_id;
	private $m_lang;
	private $m_title;
	private $m_key;
	private $m_text;
	private $m_newstitle;
	private $m_newschars;
	private $m_newsamount;
	private $m_sbnewstitle;
	private $m_sbnewsamount;
	private $m_sbnewscut;
	private $m_sbnewsenabled;
	private $m_sbnewsdisplay;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
	/**
	 * PHP5 Constructor
	 *
	 */
	function __construct() {
	}
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_dc_frontpage(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/***
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	*/
	function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLanguage($value){
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	function getLanguage(){
		return $this->m_lang;
	}
	
	/***
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	*/
	function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	function setSubtitle($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	function getSubtitle(){
		return $this->m_key;
	}
	
	/***
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	*/
	function setText($value){
		$this->m_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	function getText(){
		return $this->m_text;
	}
	
	/***
	 * Set the news title
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsTitle($value){
		$this->m_newstitle = $value;
	}
	
	/**
	 * Get the news title
	 * 
	 * @return String
	 */
	function getNewsTitle(){
		return $this->m_newstitle;
	}
	
	/***
	 * Set the news chars
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsChars($value){
		$this->m_newschars = $value;
	}
	
	/**
	 * Get the news chars
	 * 
	 * @return String
	 */
	function getNewsChars(){
		return $this->m_newschars;
	}
	
	/***
	 * Set the news amount
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsAmount($value){
		$this->m_newsamount = $value;
	}
	
	/**
	 * Get the news amount
	 * 
	 * @return String
	 */
	function getNewsAmount(){
		return $this->m_newsamount;
	}
	
	/***
	 * Set the sidebar newstitle
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarNewsTitle($value){
		$this->m_sbnewstitle = $value;
	}
	
	/**
	 * Get the sidebar newstitle
	 * 
	 * @return String
	 */
	function getSidebarNewsTitle(){
		return $this->m_sbnewstitle;
	}
	
	/***
	 * Set the sidebar news amount
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarNewsAmount($value){
		$this->m_sbnewsamount = $value;
	}
	
	/**
	 * Get the sidebar news amount
	 * 
	 * @return String
	 */
	function getSidebarNewsAmount(){
		return $this->m_sbnewsamount;
	}
	
	/***
	 * Set the sidebar news chars
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarNewsChars($value){
		$this->m_sbnewscut = $value;
	}
	
	/**
	 * Get the sidebar news chars
	 * 
	 * @return String
	 */
	function getSidebarNewsChars(){
		return $this->m_sbnewscut;
	}
	
	/***
	 * Set the sidebar news enabled
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarNewsEnabled($value){
		$this->m_sbnewsenabled = $value;
	}
	
	/**
	 * Get the sidebar news enabled
	 * 
	 * @return String
	 */
	function getSidebarNewsEnabled(){
		return $this->m_sbnewsenabled;
	}
	
	/***
	 * Set the sidebar news display
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarNewsDisplay($value){
		$this->m_sbnewsdisplay = $value;
	}
	
	/**
	 * Get the sidebar news display
	 * 
	 * @return String
	 */
	function getSidebarNewsDisplay(){
		return $this->m_sbnewsdisplay;
	}
}

?>
