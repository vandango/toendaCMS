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
| File:	tcms_dc_contact.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Contact data container
 *
 * This class is used as a datacontainer object for
 * contact items.
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_contact {
	private $m_uid;
	private $m_default_con;
	private $m_published;
	private $m_name;
	private $m_firstname;
	private $m_lastname;
	private $m_nameadd;
	private $m_email;
	private $m_position;
	private $m_street;
	private $m_country;
	private $m_state;
	private $m_town;
	private $m_postal;
	private $m_phone;
	private $m_fax;
	
	/**
	 * PHP5 Constructor
	 *
	 */
	public function __construct() {
	}
	
	/**
	 * Set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * Get the sidemenuitem uid
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_uid;
	}
	
	/**
	 * Set the default contact setting
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setDefaultContact($value){
		$this->m_default_con = $value;
	}
	
	/**
	 * Get the default contact setting
	 * 
	 * @return String
	 */
	public function getDefaultContact(){
		return $this->m_default_con;
	}
	
	/**
	 * Set the published setting
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPublished($value){
		$this->m_published = $value;
	}
	
	/**
	 * Get the published setting
	 * 
	 * @return String
	 */
	public function getPublished(){
		return $this->m_published;
	}
	
	/**
	 * Set the name
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setName($value){
		$this->m_name = $value;
	}
	
	/**
	 * Get the name
	 * 
	 * @return String
	 */
	public function getName(){
		return $this->m_name;
	}
	
	/**
	 * Set the firstname
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setFirstname($value){
		$this->m_firstname = $value;
	}
	
	/**
	 * Get the firstname
	 * 
	 * @return String
	 */
	public function getFirstname(){
		return $this->m_firstname;
	}
	
	/**
	 * Set the lastname
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLastname($value){
		$this->m_lastname = $value;
	}
	
	/**
	 * Get the lastname
	 * 
	 * @return String
	 */
	public function getLastname(){
		return $this->m_lastname;
	}
	
	/**
	 * Set the NameAdd
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNameAdd($value){
		$this->m_nameadd = $value;
	}
	
	/**
	 * Get the NameAdd
	 * 
	 * @return String
	 */
	public function getNameAdd(){
		return $this->m_nameadd;
	}
	
	/**
	 * Set the email
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setEmail($value){
		$this->m_email = $value;
	}
	
	/**
	 * Get the email
	 * 
	 * @return String
	 */
	public function getEmail(){
		return $this->m_email;
	}
	
	/**
	 * Set the position
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPosition($value){
		$this->m_position = $value;
	}
	
	/**
	 * Get the position
	 * 
	 * @return String
	 */
	public function getPosition(){
		return $this->m_position;
	}
	
	/**
	 * Set the street
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setStreet($value){
		$this->m_street = $value;
	}
	
	/**
	 * Get the street
	 * 
	 * @return String
	 */
	public function getStreet(){
		return $this->m_street;
	}
	
	/**
	 * Set the country
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCountry($value){
		$this->m_country = $value;
	}
	
	/**
	 * Get the country
	 * 
	 * @return String
	 */
	public function getCountry(){
		return $this->m_country;
	}
	
	/**
	 * Set the state
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setState($value){
		$this->m_state = $value;
	}
	
	/**
	 * Get the state
	 * 
	 * @return String
	 */
	public function getState(){
		return $this->m_state;
	}
	
	/**
	 * Set the town
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCity($value){
		$this->m_town = $value;
	}
	
	/**
	 * Get the town
	 * 
	 * @return String
	 */
	public function getCity(){
		return $this->m_town;
	}
	
	/**
	 * Set the zipcode
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setZipcode($value){
		$this->m_postal = $value;
	}
	
	/**
	 * Get the zipcode
	 * 
	 * @return String
	 */
	public function getZipcode(){
		return $this->m_postal;
	}
	
	/**
	 * Set the phone
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPhone($value){
		$this->m_phone = $value;
	}
	
	/**
	 * Get the phone
	 * 
	 * @return String
	 */
	public function getPhone(){
		return $this->m_phone;
	}
	
	/**
	 * Set the fax
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setFax($value){
		$this->m_fax = $value;
	}
	
	/**
	 * Get the fax
	 * 
	 * @return String
	 */
	public function getFax(){
		return $this->m_fax;
	}
}

?>
