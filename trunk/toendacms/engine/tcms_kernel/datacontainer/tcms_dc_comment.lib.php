<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Comment DataContainer
|
| File:	tcms_dc_comment.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Comment data container
 *
 * This class is used as a datacontainer object for
 * comment items.
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_comment {
	private $m_name;
	private $m_email;
	private $m_url;
	private $m_time;
	private $m_timestamp;
	private $m_text;
	private $m_id;
	private $m_ip;
	private $m_domain;
	private $m_module;
	
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
	function tcms_dc_comment(){
		$this->__construct();
	}
	
	/**
	 * Set the news id
	 * 
	 * @param String $value
	 * @return String
	 */
	function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the news id
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the name
	 * 
	 * @param String $value
	 * @return String
	 */
	function setName($value){
		$this->m_name = $value;
	}
	
	/**
	 * Get the name
	 * 
	 * @return String
	 */
	function getName(){
		return $this->m_name;
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
	 * Set the timestamp
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTimestamp($value){
		$this->m_timestamp = $value;
	}
	
	/**
	 * Get the timestamp
	 * 
	 * @return String
	 */
	function getTimestamp(){
		return $this->m_timestamp;
	}
	
	/**
	 * Set the news text
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
	
	/**
	 * Set the url
	 * 
	 * @param String $value
	 * @return String
	 */
	function setURL($value){
		$this->m_url = $value;
	}
	
	/**
	 * Get the url
	 * 
	 * @return String
	 */
	function getURL(){
		return $this->m_url;
	}
	
	/**
	 * Set the time
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTime($value){
		$this->m_time = $value;
	}
	
	/**
	 * Get the time
	 * 
	 * @return String
	 */
	function getTime(){
		return $this->m_time;
	}
	
	/**
	 * Set the ip
	 * 
	 * @param String $value
	 * @return String
	 */
	function setIP($value){
		$this->m_ip = $value;
	}
	
	/**
	 * Get the ip
	 * 
	 * @return String
	 */
	function getIP(){
		return $this->m_ip;
	}
	
	/**
	 * Set the domain
	 * 
	 * @param String $value
	 * @return String
	 */
	function setDomain($value){
		$this->m_domain = $value;
	}
	
	/**
	 * Get the domain
	 * 
	 * @return String
	 */
	function getDomain(){
		return $this->m_domain;
	}
	
	/**
	 * Set the module
	 * 
	 * @param String $value
	 * @return String
	 */
	function setModule($value){
		$this->m_module = $value;
	}
	
	/**
	 * Get the module
	 * 
	 * @return String
	 */
	function getModule(){
		return $this->m_module;
	}
}

?>
