<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Guestbook Extensions
|
| File:	tcms_dc_guestbook.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Guestbook Extensions
 *
 * This class is used as a datacontainer object for
 * guestbook settings.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_guestbook {
	private $m_id;
	private $m_booktitle;
	private $m_bookstamp;
	private $m_text;
	private $m_access;
	private $m_enabled;
	private $m_clean_link;
	private $m_clean_script;
	private $m_convert_at;
	private $m_show_email;
	private $m_name_width;
	private $m_text_width;
	private $m_color_row_1;
	private $m_color_row_2;
	
	/**
	 * Constructor
	 *
	 */
	public function __construct() {
	}
	
	/**
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value) {
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	public function getID() {
		return $this->m_id;
	}
	
	/**
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value) {
		$this->m_booktitle = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle() {
		return $this->m_booktitle;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubtitle($value) {
		$this->m_bookstamp = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle() {
		return $this->m_bookstamp;
	}
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value) {
		$this->m_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText() {
		return $this->m_text;
	}
	
	/**
	 * Set the access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value) {
		$this->m_access = $value;
	}
	
	/**
	 * Get the access
	 * 
	 * @return String
	 */
	public function getAccess() {
		return $this->m_access;
	}
	
	/**
	 * Set the enabled
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setEnabled($value) {
		$this->m_enabled = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getEnabled() {
		return ( $this->m_enabled == 1 || $this->m_enabled == '1' || $this->m_enabled ? true : false );
	}
	
	/**
	 * Set the clean link
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCleanLink($value) {
		$this->m_clean_link = $value;
	}
	
	/**
	 * Get the clean link
	 * 
	 * @return String
	 */
	public function getCleanLink() {
		return ( $this->m_clean_link == 1 || $this->m_clean_link == '1' || $this->m_clean_link ? true : false );
	}
	
	/**
	 * Set the clean script
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setCleanScript($value) {
		$this->m_clean_script = $value;
	}
	
	/**
	 * Get the clean script
	 * 
	 * @return String
	 */
	public function getCleanScript() {
		return ( $this->m_clean_script == 1 || $this->m_clean_script == '1' || $this->m_clean_script ? true : false );
	}
	
	/**
	 * Set the convert at
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setConvertAt($value) {
		$this->m_convert_at = $value;
	}
	
	/**
	 * Get the convert at
	 * 
	 * @return String
	 */
	public function getConvertAt() {
		return ( $this->m_convert_at == 1 || $this->m_convert_at == '1' || $this->m_convert_at ? true : false );
	}
	
	/**
	 * Set the show email
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowEMail($value) {
		$this->m_show_email = $value;
	}
	
	/**
	 * Get the show email
	 * 
	 * @return String
	 */
	public function getShowEMail() {
		return ( $this->m_show_email == 1 || $this->m_show_email == '1' || $this->m_show_email ? true : false );
	}
	
	/**
	 * Set the name width
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNameWidth($value) {
		$this->m_name_width = $value;
	}
	
	/**
	 * Get the name width
	 * 
	 * @return String
	 */
	public function getNameWidth() {
		return $this->m_name_width;
	}
	
	/**
	 * Set the text width
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTextWidth($value) {
		$this->m_text_width = $value;
	}
	
	/**
	 * Get the text width
	 * 
	 * @return String
	 */
	public function getTextWidth() {
		return $this->m_text_width;
	}
	
	/**
	 * Set the color row 1
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setColorRow1($value) {
		$this->m_color_row_1 = $value;
	}
	
	/**
	 * Get the color row 1
	 * 
	 * @return String
	 */
	public function getColorRow1() {
		return $this->m_color_row_1;
	}
	
	/**
	 * Set the color row 2
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setColorRow2($value) {
		$this->m_color_row_2 = $value;
	}
	
	/**
	 * Get the color row 2
	 * 
	 * @return String
	 */
	public function getColorRow2() {
		return $this->m_color_row_2;
	}
}

?>
