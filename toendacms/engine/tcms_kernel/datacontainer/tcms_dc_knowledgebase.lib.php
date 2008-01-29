<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS knowledgebase DataContainer
|
| File:	tcms_dc_knowledgebase.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS knowledgebase data container
 *
 * This class is used as a datacontainer object for
 * knowledgebase items.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_knowledgebase {
	private $_id;
	private $_title;
	private $_stamp;
	private $_text;
	private $_enabled;
	private $_autor_enabled;
	private $_access;
	
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
	public function setID($value) {
		$this->_uid = $value;
	}
	
	/**
	 * Get the uid
	 * 
	 * @return String
	 */
	public function getID() {
		return $this->_uid;
	}
	
	/**
	 * Set the Title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value) {
		$this->_download_title = $value;
	}
	
	/**
	 * Get the Title
	 * 
	 * @return String
	 */
	public function getTitle() {
		return $this->_download_title;
	}
	
	/**
	 * Set the Subtitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubtitle($value) {
		$this->_download_stamp = $value;
	}
	
	/**
	 * Get the Subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle() {
		return $this->_download_stamp;
	}
	
	/**
	 * Set the Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value) {
		$this->_download_text = $value;
	}
	
	/**
	 * Get the Text
	 * 
	 * @return String
	 */
	public function getText() {
		return $this->_download_text;
	}
	
	/**
	 * Set the Enabled flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setEnabled($value) {
		$this->_enabled = $value;
	}
	
	/**
	 * Get the Enabled flag
	 * 
	 * @return String
	 */
	public function getEnabled() {
		return ( $this->_enabled == 1 || $this->_enabled == '1' || $this->_enabled ? true : false );
	}
	
	/**
	 * Set the AutorEnabled flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAutorEnabled($value) {
		$this->_autor_enabled = $value;
	}
	
	/**
	 * Get the AutorEnabled flag
	 * 
	 * @return String
	 */
	public function getAutorEnabled() {
		return ( $this->_autor_enabled == 1 || $this->_autor_enabled == '1' || $this->_autor_enabled ? true : false );
	}
	
	/**
	 * Set the Access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value) {
		$this->_access = $value;
	}
	
	/**
	 * Get the Access
	 * 
	 * @return String
	 */
	public function getAccess() {
		return $this->_access;
	}
}

?>
