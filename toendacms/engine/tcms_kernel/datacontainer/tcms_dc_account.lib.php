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
| File:	tcms_dc_account.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Account data container
 *
 * This class is used as a datacontainer object for
 * user accounts items.
 *
 * @version 0.1.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_account {
	var $m_uid;
	var $m_username;
	var $m_password;
	var $m_email;
	var $m_name;
	var $m_group;
	var $m_joindate;
	var $m_lastlogin;
	var $m_birthday;
	var $m_gender;
	var $m_occupation;
	var $m_homepage;
	var $m_icq;
	var $m_aim;
	var $m_yim;
	var $m_msn;
	var $m_skype;
	var $m_enabled;
	var $m_tcms_enabled;
	var $m_static_value;
	var $m_signature;
	var $m_location;
	var $m_hobby;
	
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
	function tcms_dc_account(){
		$this->__construct();
	}
	
	/**
	 * set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * get the sidemenuitem uid
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_uid;
	}
	
	/**
	 * set the username
	 * 
	 * @param String $value
	 * @return String
	 */
	function setUsername($value){
		$this->m_username = $value;
	}
	
	/**
	 * get the username
	 * 
	 * @return String
	 */
	function getUsername(){
		return $this->m_username;
	}
	
	/**
	 * set the password
	 * 
	 * @param String $value
	 * @return String
	 */
	function setPassword($value){
		$this->m_password = $value;
	}
	
	/**
	 * get the password
	 * 
	 * @return String
	 */
	function getPassword(){
		return $this->m_password;
	}
	
	/**
	 * set the email
	 * 
	 * @param String $value
	 * @return String
	 */
	function setEmail($value){
		$this->m_email = $value;
	}
	
	/**
	 * get the email
	 * 
	 * @return String
	 */
	function getEmail(){
		return $this->m_email;
	}
	
	/**
	 * set the name
	 * 
	 * @param String $value
	 * @return String
	 */
	function setName($value){
		$this->m_name = $value;
	}
	
	/**
	 * get the name
	 * 
	 * @return String
	 */
	function getName(){
		return $this->m_name;
	}
	
	/**
	 * set the group
	 * 
	 * @param String $value
	 * @return String
	 */
	function setGroup($value){
		$this->m_group = $value;
	}
	
	/**
	 * get the group
	 * 
	 * @return String
	 */
	function getGroup(){
		return $this->m_group;
	}
	
	/**
	 * set the join date
	 * 
	 * @param String $value
	 * @return String
	 */
	function setJoinDate($value){
		$this->m_joindate = $value;
	}
	
	/**
	 * get the join date
	 * 
	 * @return String
	 */
	function getJoinDate(){
		return $this->m_joindate;
	}
	
	/**
	 * set the last login
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLastLogin($value){
		$this->m_lastlogin = $value;
	}
	
	/**
	 * get the last login
	 * 
	 * @return String
	 */
	function getLastLogin(){
		return $this->m_lastlogin;
	}
	
	/**
	 * set the birthday
	 * 
	 * @param String $value
	 * @return String
	 */
	function setBirthday($value){
		$this->m_birthday = $value;
	}
	
	/**
	 * get the birthday
	 * 
	 * @return String
	 */
	function getBirthday(){
		return $this->m_birthday;
	}
	
	/**
	 * set the gender
	 * 
	 * @param String $value
	 * @return String
	 */
	function setGender($value){
		$this->m_gender = $value;
	}
	
	/**
	 * get the gender
	 * 
	 * @return String
	 */
	function getGender(){
		return $this->m_gender;
	}
	
	/**
	 * set the occupation
	 * 
	 * @param String $value
	 * @return String
	 */
	function setOccupation($value){
		$this->m_occupation = $value;
	}
	
	/**
	 * get the occupation
	 * 
	 * @return String
	 */
	function getOccupation(){
		return $this->m_occupation;
	}
	
	/**
	 * set the homepage
	 * 
	 * @param String $value
	 * @return String
	 */
	function setHomepage($value){
		$this->m_homepage = $value;
	}
	
	/**
	 * get the homepage
	 * 
	 * @return String
	 */
	function getHomepage(){
		return $this->m_homepage;
	}
	
	/**
	 * set the icq
	 * 
	 * @param String $value
	 * @return String
	 */
	function setICQ($value){
		$this->m_icq = $value;
	}
	
	/**
	 * get the icq
	 * 
	 * @return String
	 */
	function getICQ(){
		return $this->m_icq;
	}
	
	/**
	 * set the aim
	 * 
	 * @param String $value
	 * @return String
	 */
	function setAIM($value){
		$this->m_aim = $value;
	}
	
	/**
	 * get the aim
	 * 
	 * @return String
	 */
	function getAIM(){
		return $this->m_aim;
	}
	
	/**
	 * set the yim
	 * 
	 * @param String $value
	 * @return String
	 */
	function setYIM($value){
		$this->m_yim = $value;
	}
	
	/**
	 * get the yim
	 * 
	 * @return String
	 */
	function getYIM(){
		return $this->m_yim;
	}
	
	/**
	 * set the msn
	 * 
	 * @param String $value
	 * @return String
	 */
	function setMSN($value){
		$this->m_msn = $value;
	}
	
	/**
	 * get the msn
	 * 
	 * @return String
	 */
	function getMSN(){
		return $this->m_msn;
	}
	
	/**
	 * set the skype
	 * 
	 * @param String $value
	 * @return String
	 */
	function setSkype($value){
		$this->m_skype = $value;
	}
	
	/**
	 * get the skype
	 * 
	 * @return String
	 */
	function getSkype(){
		return $this->m_skype;
	}
	
	/**
	 * set the enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	function setEnabled($value){
		$this->m_enabled = $value;
	}
	
	/**
	 * get the enabled
	 * 
	 * @return String
	 */
	function getEnabled(){
		return $this->m_enabled;
	}
	
	/**
	 * set the tcms_enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTCMSScriptEnabled($value){
		$this->m_tcms_enabled = $value;
	}
	
	/**
	 * get the tcms_enabled
	 * 
	 * @return String
	 */
	function getTCMSScriptEnabled(){
		return $this->m_tcms_enabled;
	}
	
	/**
	 * set the static_value
	 * 
	 * @param String $value
	 * @return String
	 */
	function setStaticValue($value){
		$this->m_static_value = $value;
	}
	
	/**
	 * get the static_value
	 * 
	 * @return String
	 */
	function getStaticValue(){
		return $this->m_static_value;
	}
	
	/**
	 * set the signature
	 * 
	 * @param String $value
	 * @return String
	 */
	function setSignature($value){
		$this->m_signature = $value;
	}
	
	/**
	 * get the signature
	 * 
	 * @return String
	 */
	function getSignature(){
		return $this->m_signature;
	}
	
	/**
	 * set the location
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLocation($value){
		$this->m_location = $value;
	}
	
	/**
	 * get the location
	 * 
	 * @return String
	 */
	function getLocation(){
		return $this->m_location;
	}
	
	/**
	 * set the hobby
	 * 
	 * @param String $value
	 * @return String
	 */
	function setHobby($value){
		$this->m_hobby = $value;
	}
	
	/**
	 * get the hobby
	 * 
	 * @return String
	 */
	function getHobby(){
		return $this->m_hobby;
	}
}

?>
