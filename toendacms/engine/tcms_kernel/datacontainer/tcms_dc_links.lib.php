<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS LinksConfiguration DataContainer
|
| File:	tcms_dc_links.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS LinksConfiguration data container
 *
 * This class is used as a datacontainer object for
 * links configuration.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_links {
	private $_id;
	private $_link_main_title;
	private $_link_main_subtitle;
	private $_link_main_text;
	private $_link_use_main_desc;
	private $_link_main_access;
	private $_link_use_side_desc;
	private $_link_use_side_title;
	private $_link_side_title;
	
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
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->_id;
	}
	
	/**
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value) {
		$this->_link_main_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle() {
		return $this->_link_main_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubtitle($value) {
		$this->_link_main_subtitle = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle() {
		return $this->_link_main_subtitle;
	}
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value) {
		$this->_link_main_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText() {
		return $this->_link_main_text;
	}
	
	/**
	 * Set the access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value) {
		$this->_link_main_access = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	public function getAccess() {
		return $this->_link_main_access;
	}
	
	/**
	 * Set the side title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSideTitle($value) {
		$this->_link_side_title = $value;
	}
	
	/**
	 * Get the side title
	 * 
	 * @return String
	 */
	public function getSideTitle() {
		return $this->_link_side_title;
	}
	
	/**
	 * Set the UseMainDescription
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseMainDescription($value) {
		$this->_link_use_main_desc = $value;
	}
	
	/**
	 * Get the UseMainDescription
	 * 
	 * @return String
	 */
	public function getUseMainDescription() {
		return ( $this->_link_use_main_desc == 1 || $this->_link_use_main_desc == '1' || $this->_link_use_main_desc ? true : false );
	}
	
	/**
	 * Set the UseSideDescription
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseSideDescription($value) {
		$this->_link_use_side_desc = $value;
	}
	
	/**
	 * Get the UseSideDescription
	 * 
	 * @return String
	 */
	public function getUseSideDescription() {
		return ( $this->_link_use_side_desc == 1 || $this->_link_use_side_desc == '1' || $this->_link_use_side_desc ? true : false );
	}
	
	/**
	 * Set the UseSideTitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseSideTitle($value) {
		$this->_link_use_side_title = $value;
	}
	
	/**
	 * Get the UseSideTitle
	 * 
	 * @return String
	 */
	public function getUseSideTitle() {
		return ( $this->_link_use_side_title == 1 || $this->_link_use_side_title == '1' || $this->_link_use_side_title ? true : false );
	}
}

?>
