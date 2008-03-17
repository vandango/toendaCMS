<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Log DataContainer
|
| File:	tcms_dc_log.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS log data container
 *
 * This class is used as a datacontainer object for
 * log items.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_log {
	private $_uid;
	private $_userId;
	private $_stamp;
	private $_ip;
	private $_module;
	private $_text;
	
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
	
	/**
	 * Set the uid
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->_uid = $value;
	}
	
	/**
	 * Get the uid
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->_uid;
	}
	
	/**
	 * Set the user uid
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUserID($value){
		$this->_userId = $value;
	}
	
	/**
	 * Get the user uid
	 * 
	 * @return String
	 */
	public function getUserID(){
		return $this->_userId;
	}
	
	/**
	 * Set the Timestamp
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTimestamp($value){
		$this->_stamp = $value;
	}
	
	/**
	 * Get the Timestamp
	 * 
	 * @return String
	 */
	public function getTimestamp(){
		return $this->_stamp;
	}
	
	/**
	 * Set the ip
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setIP($value){
		$this->_ip = $value;
	}
	
	/**
	 * Get the ip
	 * 
	 * @return String
	 */
	public function getIP(){
		return $this->_ip;
	}
	
	/**
	 * Set the module
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setModule($value){
		$this->_module = $value;
	}
	
	/**
	 * Get the module
	 * 
	 * @return String
	 */
	public function getModule(){
		return $this->_module;
	}
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value){
		$this->_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->_text;
	}
}

?>
