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
 * @version 0.0.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_contactform {
	private $m_id;
	private $m_lang;
	private $m_title;
	private $m_key;
	private $m_text;
	private $m_contact;
	private $m_show_contacts_in_sidebar;
	private $m_access;
	private $m_enabled;
	private $m_use_adressbook;
	private $m_use_contact;
	private $m_show_contactemail;
	
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
	
	/***
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
	
	/***
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
	
	/***
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setText($value){
		$this->m_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->m_text;
	}
	
	/***
	 * Set the contact
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setContact($value){
		$this->m_contact = $value;
	}
	
	/**
	 * Get the contact
	 * 
	 * @return String
	 */
	public function getContact(){
		return $this->m_contact;
	}
	
	/***
	 * Set the show contacts in sidebar
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setShowContactsInSidebar($value){
		$this->m_show_contacts_in_sidebar = $value;
	}
	
	/**
	 * Get the show contacts in sidebar
	 * 
	 * @return String
	 */
	public function getShowContactsInSidebar(){
		return $this->m_show_contacts_in_sidebar;
	}
	
	/***
	 * Set the access
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setAccess($value){
		$this->m_access = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	public function getAccess(){
		return $this->m_access;
	}
	
	/***
	 * Set the enabled
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setEnabled($value){
		$this->m_enabled = $value;
	}
	
	/**
	 * Get the enabled
	 * 
	 * @return String
	 */
	public function getEnabled(){
		return $this->m_enabled;
	}
	
	/***
	 * Set the use_adressbook
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setUseAdressbook($value){
		$this->m_use_adressbook = $value;
	}
	
	/**
	 * Get the use_adressbook
	 * 
	 * @return String
	 */
	public function getUseAdressbook(){
		return $this->m_use_adressbook;
	}
	
	/***
	 * Set the use_contact
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setUseContact($value){
		$this->m_use_contact = $value;
	}
	
	/**
	 * Get the use_contact
	 * 
	 * @return String
	 */
	public function getUseContact(){
		return $this->m_use_contact;
	}
	
	/***
	 * Set the show_contactemail
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setShowContactemail($value){
		$this->m_show_contactemail = $value;
	}
	
	/**
	 * Get the show_contactemail
	 * 
	 * @return String
	 */
	public function getShowContactemail(){
		return $this->m_show_contactemail;
	}
}

?>
