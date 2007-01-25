<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Contactform
|
| File:	tcms_dc_contactform.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Contactform
 *
 * This class is used as a datacontainer object for
 * the contactform.
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_contactform {
	var $m_id;
	var $m_lang;
	var $m_title;
	var $m_key;
	var $m_text;
	var $m_contact;
	var $m_show_contacts_in_sidebar;
	var $m_access;
	var $m_enabled;
	var $m_use_adressbook;
	var $m_use_contact;
	var $m_show_contactemail;
	
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
	function tcms_dc_contactform(){
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
	 * Set the contact
	 * 
	 * @param String $value
	 * @return String
	*/
	function setContact($value){
		$this->m_contact = $value;
	}
	
	/**
	 * Get the contact
	 * 
	 * @return String
	 */
	function getContact(){
		return $this->m_contact;
	}
	
	/***
	 * Set the show contacts in sidebar
	 * 
	 * @param String $value
	 * @return String
	*/
	function setShowContactsInSidebar($value){
		$this->m_show_contacts_in_sidebar = $value;
	}
	
	/**
	 * Get the show contacts in sidebar
	 * 
	 * @return String
	 */
	function getShowContactsInSidebar(){
		return $this->m_show_contacts_in_sidebar;
	}
	
	/***
	 * Set the access
	 * 
	 * @param String $value
	 * @return String
	*/
	function setAccess($value){
		$this->m_access = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	function getAccess(){
		return $this->m_access;
	}
	
	/***
	 * Set the enabled
	 * 
	 * @param String $value
	 * @return String
	*/
	function setEnabled($value){
		$this->m_enabled = $value;
	}
	
	/**
	 * Get the enabled
	 * 
	 * @return String
	 */
	function getEnabled(){
		return $this->m_enabled;
	}
	
	/***
	 * Set the use_adressbook
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseAdressbook($value){
		$this->m_use_adressbook = $value;
	}
	
	/**
	 * Get the use_adressbook
	 * 
	 * @return String
	 */
	function getUseAdressbook(){
		return $this->m_use_adressbook;
	}
	
	/***
	 * Set the use_contact
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseContact($value){
		$this->m_use_contact = $value;
	}
	
	/**
	 * Get the use_contact
	 * 
	 * @return String
	 */
	function getUseContact(){
		return $this->m_use_contact;
	}
	
	/***
	 * Set the show_contactemail
	 * 
	 * @param String $value
	 * @return String
	*/
	function setShowContactemail($value){
		$this->m_show_contactemail = $value;
	}
	
	/**
	 * Get the show_contactemail
	 * 
	 * @return String
	 */
	function getShowContactemail(){
		return $this->m_show_contactemail;
	}
}

?>
