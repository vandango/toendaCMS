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
 * @version 0.0.8
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
	public function __construct() {
	}
	
	/**
	 * Set the news id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the news id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_id;
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
	 * Set the timestamp
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTimestamp($value){
		$this->m_timestamp = $value;
	}
	
	/**
	 * Get the timestamp
	 * 
	 * @return String
	 */
	public function getTimestamp(){
		return $this->m_timestamp;
	}
	
	/**
	 * Set the news text
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
	
	/**
	 * Set the url
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setURL($value){
		$this->m_url = $value;
	}
	
	/**
	 * Get the url
	 * 
	 * @return String
	 */
	public function getURL(){
		return $this->m_url;
	}
	
	/**
	 * Set the time
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTime($value){
		$this->m_time = $value;
	}
	
	/**
	 * Get the time
	 * 
	 * @return String
	 */
	public function getTime(){
		return $this->m_time;
	}
	
	/**
	 * Set the ip
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setIP($value){
		$this->m_ip = $value;
	}
	
	/**
	 * Get the ip
	 * 
	 * @return String
	 */
	public function getIP(){
		return $this->m_ip;
	}
	
	/**
	 * Set the domain
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setDomain($value){
		$this->m_domain = $value;
	}
	
	/**
	 * Get the domain
	 * 
	 * @return String
	 */
	public function getDomain(){
		return $this->m_domain;
	}
	
	/**
	 * Set the module
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setModule($value){
		$this->m_module = $value;
	}
	
	/**
	 * Get the module
	 * 
	 * @return String
	 */
	public function getModule(){
		return $this->m_module;
	}
}

?>
