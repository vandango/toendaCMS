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
 * @version 0.1.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_account {
	private $m_uid;
	private $m_username;
	private $m_password;
	private $m_email;
	private $m_name;
	private $m_group;
	private $m_joindate;
	private $m_lastlogin;
	private $m_birthday;
	private $m_gender;
	private $m_occupation;
	private $m_homepage;
	private $m_icq;
	private $m_aim;
	private $m_yim;
	private $m_msn;
	private $m_skype;
	private $m_enabled;
	private $m_tcms_enabled;
	private $m_static_value;
	private $m_signature;
	private $m_location;
	private $m_hobby;
	
	/**
	 * PHP5 Constructor
	 *
	 */
	public function __construct() {
	}
	
	/**
	 * set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * get the sidemenuitem uid
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_uid;
	}
	
	/**
	 * set the username
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUsername($value){
		$this->m_username = $value;
	}
	
	/**
	 * get the username
	 * 
	 * @return String
	 */
	public function getUsername(){
		return $this->m_username;
	}
	
	/**
	 * set the password
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPassword($value){
		$this->m_password = $value;
	}
	
	/**
	 * get the password
	 * 
	 * @return String
	 */
	public function getPassword(){
		return $this->m_password;
	}
	
	/**
	 * set the email
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setEmail($value){
		$this->m_email = $value;
	}
	
	/**
	 * get the email
	 * 
	 * @return String
	 */
	public function getEmail(){
		return $this->m_email;
	}
	
	/**
	 * set the name
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setName($value){
		$this->m_name = $value;
	}
	
	/**
	 * get the name
	 * 
	 * @return String
	 */
	public function getName(){
		return $this->m_name;
	}
	
	/**
	 * set the group
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setGroup($value){
		$this->m_group = $value;
	}
	
	/**
	 * get the group
	 * 
	 * @return String
	 */
	public function getGroup(){
		return $this->m_group;
	}
	
	/**
	 * set the join date
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setJoinDate($value){
		$this->m_joindate = $value;
	}
	
	/**
	 * get the join date
	 * 
	 * @return String
	 */
	public function getJoinDate(){
		return $this->m_joindate;
	}
	
	/**
	 * set the last login
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLastLogin($value){
		$this->m_lastlogin = $value;
	}
	
	/**
	 * get the last login
	 * 
	 * @return String
	 */
	public function getLastLogin(){
		return $this->m_lastlogin;
	}
	
	/**
	 * set the birthday
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setBirthday($value){
		$this->m_birthday = $value;
	}
	
	/**
	 * get the birthday
	 * 
	 * @return String
	 */
	public function getBirthday(){
		return $this->m_birthday;
	}
	
	/**
	 * set the gender
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setGender($value){
		$this->m_gender = $value;
	}
	
	/**
	 * get the gender
	 * 
	 * @return String
	 */
	public function getGender(){
		return $this->m_gender;
	}
	
	/**
	 * set the occupation
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setOccupation($value){
		$this->m_occupation = $value;
	}
	
	/**
	 * get the occupation
	 * 
	 * @return String
	 */
	public function getOccupation(){
		return $this->m_occupation;
	}
	
	/**
	 * set the homepage
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setHomepage($value){
		$this->m_homepage = $value;
	}
	
	/**
	 * get the homepage
	 * 
	 * @return String
	 */
	public function getHomepage(){
		return $this->m_homepage;
	}
	
	/**
	 * set the icq
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setICQ($value){
		$this->m_icq = $value;
	}
	
	/**
	 * get the icq
	 * 
	 * @return String
	 */
	public function getICQ(){
		return $this->m_icq;
	}
	
	/**
	 * set the aim
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAIM($value){
		$this->m_aim = $value;
	}
	
	/**
	 * get the aim
	 * 
	 * @return String
	 */
	public function getAIM(){
		return $this->m_aim;
	}
	
	/**
	 * set the yim
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setYIM($value){
		$this->m_yim = $value;
	}
	
	/**
	 * get the yim
	 * 
	 * @return String
	 */
	public function getYIM(){
		return $this->m_yim;
	}
	
	/**
	 * set the msn
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setMSN($value){
		$this->m_msn = $value;
	}
	
	/**
	 * get the msn
	 * 
	 * @return String
	 */
	public function getMSN(){
		return $this->m_msn;
	}
	
	/**
	 * set the skype
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSkype($value){
		$this->m_skype = $value;
	}
	
	/**
	 * get the skype
	 * 
	 * @return String
	 */
	public function getSkype(){
		return $this->m_skype;
	}
	
	/**
	 * set the enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setEnabled($value){
		$this->m_enabled = $value;
	}
	
	/**
	 * get the enabled
	 * 
	 * @return String
	 */
	public function getEnabled(){
		return $this->m_enabled;
	}
	
	/**
	 * set the tcms_enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTCMSScriptEnabled($value){
		$this->m_tcms_enabled = $value;
	}
	
	/**
	 * get the tcms_enabled
	 * 
	 * @return String
	 */
	public function getTCMSScriptEnabled(){
		return $this->m_tcms_enabled;
	}
	
	/**
	 * set the static_value
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setStaticValue($value){
		$this->m_static_value = $value;
	}
	
	/**
	 * get the static_value
	 * 
	 * @return String
	 */
	public function getStaticValue(){
		return $this->m_static_value;
	}
	
	/**
	 * set the signature
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSignature($value){
		$this->m_signature = $value;
	}
	
	/**
	 * get the signature
	 * 
	 * @return String
	 */
	public function getSignature(){
		return $this->m_signature;
	}
	
	/**
	 * set the location
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLocation($value){
		$this->m_location = $value;
	}
	
	/**
	 * get the location
	 * 
	 * @return String
	 */
	public function getLocation(){
		return $this->m_location;
	}
	
	/**
	 * set the hobby
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setHobby($value){
		$this->m_hobby = $value;
	}
	
	/**
	 * get the hobby
	 * 
	 * @return String
	 */
	public function getHobby(){
		return $this->m_hobby;
	}
}

?>
