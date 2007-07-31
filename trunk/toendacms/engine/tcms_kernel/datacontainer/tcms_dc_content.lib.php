<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Content DataContainer
|
| File:	tcms_dc_content.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Content data container
 *
 * This class is used as a datacontainer object for
 * content items.
 *
 * @version 0.0.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_content {
	private $m_title;
	private $m_key;
	private $m_content00;
	private $m_content01;
	private $m_foot;
	private $m_id;
	private $m_text_layout;
	private $m_acs;
	private $m_pub;
	private $m_autor;
	private $m_in_work;
	private $m_language;
	
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
	function tcms_dc_content(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/**
	 * Set the content id
	 * 
	 * @param String $value
	 */
	function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the content id
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the content title
	 * 
	 * @param String $value
	 */
	function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the content title
	 * 
	 * @return String
	 */
	function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the content key
	 * 
	 * @param String $value
	 */
	function setKeynote($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the content key
	 * 
	 * @return String
	 */
	function getKeynote(){
		return $this->m_key;
	}
	
	/**
	 * Set the content content00
	 * 
	 * @param String $value
	 */
	function setText($value){
		$this->m_content00 = $value;
	}
	
	/**
	 * Get the content content00
	 * 
	 * @return String
	 */
	function getText(){
		return $this->m_content00;
	}
	
	/**
	 * Set the content content01
	 * 
	 * @param String $value
	 */
	function setSecondContent($value){
		$this->m_content01 = $value;
	}
	
	/**
	 * Get the content content01
	 * 
	 * @return String
	 */
	function getSecondContent(){
		return $this->m_content01;
	}
	
	/**
	 * Set the footer
	 * 
	 * @param String $value
	 */
	function setFootText($value){
		$this->m_foot = $value;
	}
	
	/**
	 * Get the footer
	 * 
	 * @return String
	 */
	function getFootText(){
		return $this->m_foot;
	}
	
	/**
	 * Set the text layout
	 * 
	 * @param String $value
	 */
	function setTextLayout($value){
		$this->m_text_layout = $value;
	}
	
	/**
	 * Get the text layout
	 * 
	 * @return String
	 */
	function getTextLayout(){
		return $this->m_text_layout;
	}
	
	/**
	 * Set the access
	 * 
	 * @param String $value
	 */
	function setAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	function getAccess(){
		return $this->m_acs;
	}
	
	/**
	 * Set the autor
	 * 
	 * @param String $value
	 */
	function setAutor($value){
		$this->m_autor = $value;
	}
	
	/**
	 * Get the autor
	 * 
	 * @return String
	 */
	function getAutor(){
		return $this->m_autor;
	}
	
	/**
	 * Set the publishing state
	 * 
	 * @param Boolean $value
	 */
	function setPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * Get the publishing state
	 * 
	 * @return Boolean
	 */
	function getPublished(){
		return $this->m_pub;
	}
	
	/**
	 * Set the inWork state
	 * 
	 * @param Boolean $value
	 */
	function setInWorkState($value){
		$this->m_in_work = $value;
	}
	
	/**
	 * Get the inWork state
	 * 
	 * @return Boolean
	 */
	function getInWorkState(){
		return $this->m_in_work;
	}
	
	/**
	 * Set the content language
	 * 
	 * @param String $value
	 */
	function setLanguage($value){
		$this->m_language = $value;
	}
	
	/**
	 * Get the content language
	 * 
	 * @return String
	 */
	function getLanguage(){
		return $this->m_language;
	}
}

?>
