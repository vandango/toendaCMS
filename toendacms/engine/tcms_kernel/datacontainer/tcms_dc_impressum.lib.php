<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Impressum DataContainer
|
| File:	tcms_dc_impressum.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Impressum data container
 *
 * This class is used as a datacontainer object for
 * publishing form items.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_impressum {
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
	function __construct() {
	}
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_dc_impressum(){
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
	
	/**
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
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	function setText($value){
		$this->m_legal = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	function getText(){
		return $this->m_legal;
	}
	
	/**
	 * Set the contact person
	 * 
	 * @param String $value
	 * @return String
	 */
	function setContact($value){
		$this->m_contact = $value;
	}
	
	/**
	 * Get the contact person
	 * 
	 * @return String
	 */
	function getContact(){
		return $this->m_contact;
	}
	
	/**
	 * Set the tax number
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTaxNumber($value){
		$this->m_taxno = $value;
	}
	
	/**
	 * Get the tax number
	 * 
	 * @return String
	 */
	function getTaxNumber(){
		return $this->m_taxno;
	}
	
	/**
	 * Set the ustdid
	 * 
	 * @param String $value
	 * @return String
	 */
	function setUstID($value){
		$this->m_ustid = $value;
	}
	
	/**
	 * Get the ustdid
	 * 
	 * @return String
	 */
	function getUstID(){
		return $this->m_ustid;
	}
}

?>
