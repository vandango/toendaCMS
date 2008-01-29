<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Download DataContainer
|
| File:	tcms_dc_download.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Product data container
 *
 * This class is used as a datacontainer object for
 * download items.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_download {
	private $_id;
	private $_download_title;
	private $_download_stamp;
	private $_download_text;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
	/**
	 * Constructor
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
	 * Set the Title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value){
		$this->_download_title = $value;
	}
	
	/**
	 * Get the Title
	 * 
	 * @return String
	 */
	public function getTitle(){
		return $this->_download_title;
	}
	
	/**
	 * Set the Subtitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubtitle($value){
		$this->_download_stamp = $value;
	}
	
	/**
	 * Get the Subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle(){
		return $this->_download_stamp;
	}
	
	/**
	 * Set the Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value){
		$this->_download_text = $value;
	}
	
	/**
	 * Get the Text
	 * 
	 * @return String
	 */
	public function getText(){
		return $this->_download_text;
	}
}

?>
