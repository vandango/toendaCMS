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
 * @version 0.0.9
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
	public function __construct() {
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/**
	 * Set the content id
	 * 
	 * @param String $value
	 */
	public function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the content id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the content title
	 * 
	 * @param String $value
	 */
	public function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the content title
	 * 
	 * @return String
	 */
	public function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the content key
	 * 
	 * @param String $value
	 */
	public function setKeynote($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the content key
	 * 
	 * @return String
	 */
	public function getKeynote(){
		return $this->m_key;
	}
	
	/**
	 * Set the content content00
	 * 
	 * @param String $value
	 */
	public function setText($value){
		$this->m_content00 = $value;
	}
	
	/**
	 * Get the content content00
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->m_content00;
	}
	
	/**
	 * Set the content content01
	 * 
	 * @param String $value
	 */
	public function setSecondContent($value){
		$this->m_content01 = $value;
	}
	
	/**
	 * Get the content content01
	 * 
	 * @return String
	 */
	public function getSecondContent(){
		return $this->m_content01;
	}
	
	/**
	 * Set the footer
	 * 
	 * @param String $value
	 */
	public function setFootText($value){
		$this->m_foot = $value;
	}
	
	/**
	 * Get the footer
	 * 
	 * @return String
	 */
	public function getFootText(){
		return $this->m_foot;
	}
	
	/**
	 * Set the text layout
	 * 
	 * @param String $value
	 */
	public function setTextLayout($value){
		$this->m_text_layout = $value;
	}
	
	/**
	 * Get the text layout
	 * 
	 * @return String
	 */
	public function getTextLayout(){
		return $this->m_text_layout;
	}
	
	/**
	 * Set the access
	 * 
	 * @param String $value
	 */
	public function setAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	public function getAccess(){
		return $this->m_acs;
	}
	
	/**
	 * Set the autor
	 * 
	 * @param String $value
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
	 * Set the publishing state
	 * 
	 * @param Boolean $value
	 */
	public function setPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * Get the publishing state
	 * 
	 * @return Boolean
	 */
	public function getPublished() {
		return ( $this->m_pub == '1' || $this->m_pub == 1 ? true : false );
	}
	
	/**
	 * Set the inWork state
	 * 
	 * @param Boolean $value
	 */
	public function setInWorkState($value){
		$this->m_in_work = $value;
	}
	
	/**
	 * Get the inWork state
	 * 
	 * @return Boolean
	 */
	public function getInWorkState() {
		return ( $this->m_in_work == '1' || $this->m_in_work == 1 ? true : false );
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
