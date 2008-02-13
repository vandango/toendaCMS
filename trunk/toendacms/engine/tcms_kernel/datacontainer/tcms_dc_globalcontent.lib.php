<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Global Content DataContainer
|
| File:	tcms_dc_globalcontent.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Global Content DataContainer
 *
 * This class is used as a datacontainer object for
 * the global content item.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_globalcontent {
	private $_uid;
	private $_title;
	private $_subtitle;
	private $_text;
	private $_foot;
	
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
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value){
		$this->_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle(){
		return $this->_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubtitle($value){
		$this->_subtitle = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle(){
		return $this->_subtitle;
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
	
	/**
	 * Set the footer
	 * 
	 * @param String $value
	 */
	public function setFootText($value){
		$this->_foot = $value;
	}
	
	/**
	 * Get the footer
	 * 
	 * @return String
	 */
	public function getFootText(){
		return $this->_foot;
	}
}

?>
