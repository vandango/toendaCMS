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
 * @version 0.0.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_contact {
	var $m_uid;
	var $m_default_con;
	var $m_published;
	var $m_name;
	var $m_firstname;
	var $m_lastname;
	var $m_nameadd;
	var $m_email;
	var $m_position;
	var $m_street;
	var $m_country;
	var $m_state;
	var $m_town;
	var $m_postal;
	var $m_phone;
	var $m_fax;
	
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
	function tcms_dc_contact(){
		$this->__construct();
	}
	
	/**
	 * Set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * Get the sidemenuitem uid
	 * 
	 * @return String
	 */
	function GetID(){
		return $this->m_uid;
	}
	
	/**
	 * Set the default contact setting
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetDefaultContact($value){
		$this->m_default_con = $value;
	}
	
	/**
	 * Get the default contact setting
	 * 
	 * @return String
	 */
	function GetDefaultContact(){
		return $this->m_default_con;
	}
	
	/**
	 * Set the published setting
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPublished($value){
		$this->m_published = $value;
	}
	
	/**
	 * Get the published setting
	 * 
	 * @return String
	 */
	function GetPublished(){
		return $this->m_published;
	}
	
	/**
	 * Set the name
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetName($value){
		$this->m_name = $value;
	}
	
	/**
	 * Get the name
	 * 
	 * @return String
	 */
	function GetName(){
		return $this->m_name;
	}
	
	/**
	 * Set the firstname
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetFirstname($value){
		$this->m_firstname = $value;
	}
	
	/**
	 * Get the firstname
	 * 
	 * @return String
	 */
	function GetFirstname(){
		return $this->m_firstname;
	}
	
	/**
	 * Set the lastname
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLastname($value){
		$this->m_lastname = $value;
	}
	
	/**
	 * Get the lastname
	 * 
	 * @return String
	 */
	function GetLastname(){
		return $this->m_lastname;
	}
	
	/**
	 * Set the NameAdd
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetNameAdd($value){
		$this->m_nameadd = $value;
	}
	
	/**
	 * Get the NameAdd
	 * 
	 * @return String
	 */
	function GetNameAdd(){
		return $this->m_nameadd;
	}
	
	/**
	 * Set the email
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetEmail($value){
		$this->m_email = $value;
	}
	
	/**
	 * Get the email
	 * 
	 * @return String
	 */
	function GetEmail(){
		return $this->m_email;
	}
	
	/**
	 * Set the position
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPosition($value){
		$this->m_position = $value;
	}
	
	/**
	 * Get the position
	 * 
	 * @return String
	 */
	function GetPosition(){
		return $this->m_position;
	}
	
	/**
	 * Set the street
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetStreet($value){
		$this->m_street = $value;
	}
	
	/**
	 * Get the street
	 * 
	 * @return String
	 */
	function GetStreet(){
		return $this->m_street;
	}
	
	/**
	 * Set the country
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetCountry($value){
		$this->m_country = $value;
	}
	
	/**
	 * Get the country
	 * 
	 * @return String
	 */
	function GetCountry(){
		return $this->m_country;
	}
	
	/**
	 * Set the state
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetState($value){
		$this->m_state = $value;
	}
	
	/**
	 * Get the state
	 * 
	 * @return String
	 */
	function GetState(){
		return $this->m_state;
	}
	
	/**
	 * Set the town
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetCity($value){
		$this->m_town = $value;
	}
	
	/**
	 * Get the town
	 * 
	 * @return String
	 */
	function GetCity(){
		return $this->m_town;
	}
	
	/**
	 * Set the zipcode
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetZipcode($value){
		$this->m_postal = $value;
	}
	
	/**
	 * Get the zipcode
	 * 
	 * @return String
	 */
	function GetZipcode(){
		return $this->m_postal;
	}
	
	/**
	 * Set the phone
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPhone($value){
		$this->m_phone = $value;
	}
	
	/**
	 * Get the phone
	 * 
	 * @return String
	 */
	function GetPhone(){
		return $this->m_phone;
	}
	
	/**
	 * Set the fax
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetFax($value){
		$this->m_fax = $value;
	}
	
	/**
	 * Get the fax
	 * 
	 * @return String
	 */
	function GetFax(){
		return $this->m_fax;
	}
}

?>
