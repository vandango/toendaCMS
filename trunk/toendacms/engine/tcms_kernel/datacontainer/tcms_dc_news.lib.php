<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS News DataContainer
|
| File:		tcms_dc_news.lib.php
| Version:	0.1.3
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS News DataContainer
 *
 * This class is used as a datacontainer for the news.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_news {
	var $m_title;
	var $m_autor;
	var $m_date;
	var $m_time;
	var $m_newstext;
	var $m_order;
	var $m_stamp;
	var $m_pub;
	var $m_pub_date;
	var $m_cmt;
	var $m_img;
	var $m_cat;
	var $m_acs;
	var $m_frontpage;
	
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
	function tcms_dc_news(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/***
	 * Set the news id
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetID($value){
		$this->m_order = $value;
	}
	
	/**
	 * Get the news id
	 * 
	 * @return String
	 */
	function GetID(){
		return $this->m_order;
	}
	
	/***
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	function GetTitle(){
		return $this->m_title;
	}
	
	/***
	 * Set the autor
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetAutor($value){
		$this->m_autor = $value;
	}
	
	/**
	 * Get the autor
	 * 
	 * @return String
	 */
	function GetAutor(){
		return $this->m_autor;
	}
	
	/***
	 * Set the date
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetDate($value){
		$this->m_date = $value;
	}
	
	/**
	 * Get the date
	 * 
	 * @return String
	 */
	function GetDate(){
		return $this->m_date;
	}
	
	/***
	 * Set the news time
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetTime($value){
		$this->m_time = $value;
	}
	
	/**
	 * Get the news time
	 * 
	 * @return String
	 */
	function GetTime(){
		return $this->m_time;
	}
	
	/***
	 * Set the news newstext
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetText($value){
		$this->m_newstext = $value;
	}
	
	/**
	 * Get the news newstext
	 * 
	 * @return String
	 */
	function GetText(){
		return $this->m_newstext;
	}
	
	/***
	 * Set the news timestamp
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetTimestamp($value){
		$this->m_stamp = $value;
	}
	
	/**
	 * Get the news timestamp
	 * 
	 * @return String
	 */
	function GetTimestamp(){
		return $this->m_stamp;
	}
	
	/***
	 * Set the news publishing state
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * Get the news publishing state
	 * 
	 * @return String
	 */
	function GetPublished(){
		return $this->m_pub;
	}
	
	/***
	 * Set the news publish date
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetPublishDate($value){
		$this->m_pub_date = $value;
	}
	
	/**
	 * Get the news publish date
	 * 
	 * @return String
	 */
	function GetPublishDate(){
		return $this->m_pub_date;
	}
	
	/***
	 * Set the news comments enabled state
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetCommentsEnabled($value){
		$this->m_cmt = $value;
	}
	
	/**
	 * Get the news comments enabled state
	 * 
	 * @return String
	 */
	function GetCommentsEnabled(){
		return $this->m_cmt;
	}
	
	/***
	 * Set the news image
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetImage($value){
		$this->m_img = $value;
	}
	
	/**
	 * Get the news image
	 * 
	 * @return String
	 */
	function GetImage(){
		return $this->m_img;
	}
	
	/***
	 * Set the news categories
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetCategories($value){
		$this->m_cat = $value;
	}
	
	/**
	 * Get the news categories
	 * 
	 * @return String
	 */
	function GetCategories(){
		return $this->m_cat;
	}
	
	/***
	 * Set the news access
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * Get the news access
	 * 
	 * @return String
	 */
	function GetAccess(){
		return $this->m_acs;
	}
	
	/***
	 * Set the show on frontpage setting
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetShowOnFrontpage($value){
		$this->m_frontpage = $value;
	}
	
	/**
	 * Get the show on frontpage setting
	 * 
	 * @return String
	 */
	function GetShowOnFrontpage(){
		return $this->m_frontpage;
	}
}
