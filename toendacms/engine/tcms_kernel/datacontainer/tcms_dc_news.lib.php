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
| File:	tcms_dc_news.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS News DataContainer
 *
 * This class is used as a datacontainer for the news.
 *
 * @version 0.1.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_news {
	private $m_title;
	private $m_autor;
	private $m_date;
	private $m_time;
	private $m_newstext;
	private $m_order;
	private $m_stamp;
	private $m_pub;
	private $m_pub_date;
	private $m_cmt;
	private $m_img;
	private $m_cat;
	private $m_acs;
	private $m_frontpage;
	private $m_language;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
	/**
	 * PHP5 Constructor
	 *
	 */
	public function __construct() {
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/**
	 * Set the news id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->m_order = $value;
	}
	
	/**
	 * Get the news id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_order;
	}
	
	/**
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the autor
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAutor($value){
		$this->m_autor = $value;
	}
	
	/**
	 * Get the autor
	 * 
	 * @return String
	 */
	public function getAutor(){
		return $this->m_autor;
	}
	
	/**
	 * Set the date
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setDate($value){
		$this->m_date = $value;
	}
	
	/**
	 * Get the date
	 * 
	 * @return String
	 */
	public function getDate(){
		return $this->m_date;
	}
	
	/**
	 * Set the news time
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTime($value){
		$this->m_time = $value;
	}
	
	/**
	 * Get the news time
	 * 
	 * @return String
	 */
	public function getTime(){
		return $this->m_time;
	}
	
	/**
	 * Set the news newstext
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value){
		$this->m_newstext = $value;
	}
	
	/**
	 * Get the news newstext
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->m_newstext;
	}
	
	/**
	 * Set the news timestamp
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTimestamp($value){
		$this->m_stamp = $value;
	}
	
	/**
	 * Get the news timestamp
	 * 
	 * @return String
	 */
	public function getTimestamp(){
		return $this->m_stamp;
	}
	
	/**
	 * Set the news publishing state
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * Get the news publishing state
	 * 
	 * @return String
	 */
	public function getPublished(){
		return $this->m_pub;
	}
	
	/**
	 * Set the news publish date
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPublishDate($value){
		$this->m_pub_date = $value;
	}
	
	/**
	 * Get the news publish date
	 * 
	 * @return String
	 */
	public function getPublishDate(){
		return $this->m_pub_date;
	}
	
	/**
	 * Set the news comments enabled state
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCommentsEnabled($value){
		$this->m_cmt = $value;
	}
	
	/**
	 * Get the news comments enabled state
	 * 
	 * @return String
	 */
	public function getCommentsEnabled(){
		return $this->m_cmt;
	}
	
	/**
	 * Set the news image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setImage($value){
		$this->m_img = $value;
	}
	
	/**
	 * Get the news image
	 * 
	 * @return String
	 */
	public function getImage(){
		return $this->m_img;
	}
	
	/**
	 * Set the news categories
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCategories($value){
		$this->m_cat = $value;
	}
	
	/**
	 * Get the news categories
	 * 
	 * @return String
	 */
	public function getCategories(){
		return $this->m_cat;
	}
	
	/**
	 * Set the news access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * Get the news access
	 * 
	 * @return String
	 */
	public function getAccess(){
		return $this->m_acs;
	}
	
	/**
	 * Set the show on frontpage setting
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowOnFrontpage($value){
		$this->m_frontpage = $value;
	}
	
	/**
	 * Get the show on frontpage setting
	 * 
	 * @return String
	 */
	public function getShowOnFrontpage(){
		return $this->m_frontpage;
	}
	
	/**
	 * Set the content language
	 * 
	 * @param String $value
	 */
	public function setLanguage($value){
		$this->m_language = $value;
	}
	
	/**
	 * Get the content language
	 * 
	 * @return String
	 */
	public function getLanguage(){
		return $this->m_language;
	}
}

?>
