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
| File:		tcms_dc_account.lib.php
| Version:	0.1.0
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
	 * Set the username
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetUsername($value){
		$this->m_username = $value;
	}
	
	/**
	 * Get the username
	 * 
	 * @return String
	 */
	function GetUsername(){
		return $this->m_username;
	}
	
	/**
	 * Set the password
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPassword($value){
		$this->m_password = $value;
	}
	
	/**
	 * Get the password
	 * 
	 * @return String
	 */
	function GetPassword(){
		return $this->m_password;
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
	 * Set the group
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetGroup($value){
		$this->m_group = $value;
	}
	
	/**
	 * Get the group
	 * 
	 * @return String
	 */
	function GetGroup(){
		return $this->m_group;
	}
	
	/**
	 * Set the join date
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetJoinDate($value){
		$this->m_joindate = $value;
	}
	
	/**
	 * Get the join date
	 * 
	 * @return String
	 */
	function GetJoinDate(){
		return $this->m_joindate;
	}
	
	/**
	 * Set the last login
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLastLogin($value){
		$this->m_lastlogin = $value;
	}
	
	/**
	 * Get the last login
	 * 
	 * @return String
	 */
	function GetLastLogin(){
		return $this->m_lastlogin;
	}
	
	/**
	 * Set the birthday
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetBirthday($value){
		$this->m_birthday = $value;
	}
	
	/**
	 * Get the birthday
	 * 
	 * @return String
	 */
	function GetBirthday(){
		return $this->m_birthday;
	}
	
	/**
	 * Set the gender
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetGender($value){
		$this->m_gender = $value;
	}
	
	/**
	 * Get the gender
	 * 
	 * @return String
	 */
	function GetGender(){
		return $this->m_gender;
	}
	
	/**
	 * Set the occupation
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetOccupation($value){
		$this->m_occupation = $value;
	}
	
	/**
	 * Get the occupation
	 * 
	 * @return String
	 */
	function GetOccupation(){
		return $this->m_occupation;
	}
	
	/**
	 * Set the homepage
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetHomepage($value){
		$this->m_homepage = $value;
	}
	
	/**
	 * Get the homepage
	 * 
	 * @return String
	 */
	function GetHomepage(){
		return $this->m_homepage;
	}
	
	/**
	 * Set the icq
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetICQ($value){
		$this->m_icq = $value;
	}
	
	/**
	 * Get the icq
	 * 
	 * @return String
	 */
	function GetICQ(){
		return $this->m_icq;
	}
	
	/**
	 * Set the aim
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetAIM($value){
		$this->m_aim = $value;
	}
	
	/**
	 * Get the aim
	 * 
	 * @return String
	 */
	function GetAIM(){
		return $this->m_aim;
	}
	
	/**
	 * Set the yim
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetYIM($value){
		$this->m_yim = $value;
	}
	
	/**
	 * Get the yim
	 * 
	 * @return String
	 */
	function GetYIM(){
		return $this->m_yim;
	}
	
	/**
	 * Set the msn
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetMSN($value){
		$this->m_msn = $value;
	}
	
	/**
	 * Get the msn
	 * 
	 * @return String
	 */
	function GetMSN(){
		return $this->m_msn;
	}
	
	/**
	 * Set the skype
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSkype($value){
		$this->m_skype = $value;
	}
	
	/**
	 * Get the skype
	 * 
	 * @return String
	 */
	function GetSkype(){
		return $this->m_skype;
	}
	
	/**
	 * Set the enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetEnabled($value){
		$this->m_enabled = $value;
	}
	
	/**
	 * Get the enabled
	 * 
	 * @return String
	 */
	function GetEnabled(){
		return $this->m_enabled;
	}
	
	/**
	 * Set the tcms_enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetTCMSScriptEnabled($value){
		$this->m_tcms_enabled = $value;
	}
	
	/**
	 * Get the tcms_enabled
	 * 
	 * @return String
	 */
	function GetTCMSScriptEnabled(){
		return $this->m_tcms_enabled;
	}
	
	/**
	 * Set the static_value
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetStaticValue($value){
		$this->m_static_value = $value;
	}
	
	/**
	 * Get the static_value
	 * 
	 * @return String
	 */
	function GetStaticValue(){
		return $this->m_static_value;
	}
	
	/**
	 * Set the signature
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSignature($value){
		$this->m_signature = $value;
	}
	
	/**
	 * Get the signature
	 * 
	 * @return String
	 */
	function GetSignature(){
		return $this->m_signature;
	}
	
	/**
	 * Set the location
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLocation($value){
		$this->m_location = $value;
	}
	
	/**
	 * Get the location
	 * 
	 * @return String
	 */
	function GetLocation(){
		return $this->m_location;
	}
	
	/**
	 * Set the hobby
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetHobby($value){
		$this->m_hobby = $value;
	}
	
	/**
	 * Get the hobby
	 * 
	 * @return String
	 */
	function GetHobby(){
		return $this->m_hobby;
	}
}
