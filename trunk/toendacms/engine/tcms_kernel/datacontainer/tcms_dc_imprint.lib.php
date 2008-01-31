<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Imprint DataContainer
|
| File:	tcms_dc_imprint.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Imprint data container
 *
 * This class is used as a datacontainer object for
 * publishing form items.
 *
 * @version 0.0.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_imprint {
	private $m_title;
	private $m_key;
	private $m_legal;
	private $m_contact;
	private $m_id;
	private $m_taxno;
	private $m_ustid;
	private $m_lang;
	
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
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLanguage($value){
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	public function getLanguage(){
		return $this->m_lang;
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
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	public function setSubtitle($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle(){
		return $this->m_key;
	}
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value){
		$this->m_legal = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->m_legal;
	}
	
	/**
	 * Set the contact person
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setContact($value){
		$this->m_contact = $value;
	}
	
	/**
	 * Get the contact person
	 * 
	 * @return String
	 */
	public function getContact(){
		return $this->m_contact;
	}
	
	/**
	 * Set the tax number
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTaxNumber($value){
		$this->m_taxno = $value;
	}
	
	/**
	 * Get the tax number
	 * 
	 * @return String
	 */
	public function getTaxNumber(){
		return $this->m_taxno;
	}
	
	/**
	 * Set the ustdid
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUstID($value){
		$this->m_ustid = $value;
	}
	
	/**
	 * Get the ustdid
	 * 
	 * @return String
	 */
	public function getUstID(){
		return $this->m_ustid;
	}
}

?>
