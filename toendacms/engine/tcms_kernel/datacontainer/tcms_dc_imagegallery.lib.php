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
| File:	tcms_dc_imagegallery.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS imagegallery data container
 *
 * This class is used as a datacontainer object for
 * the imagegallery.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_imagegallery {
	private $m_uid;
	private $m_lang;
	private $m_title;
	private $m_key;
	private $m_use_details;
	private $m_image_sort;
	private $m_use_comments;
	private $m_access;
	private $m_list_option;
	private $m_max_image;
	private $m_needle_image;
	private $m_show_lastimg_title;
	private $m_align_image;
	private $m_size_image;
	private $m_list_option_amount;
	
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
	public function setID($value) {
		$this->m_uid = $value;
	}
	
	/**
	 * Get the uid
	 * 
	 * @return String
	 */
	public function getID() {
		return $this->m_uid;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLanguage($value) {
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	public function getLanguage() {
		return $this->m_lang;
	}
	
	/***
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	*/
	public function setTitle($value) {
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle() {
		return $this->m_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	public function setSubtitle($value) {
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle() {
		return $this->m_key;
	}
	
	/**
	 * Set the UseImageDetails
	 * 
	 * @param String $value
	 */
	public function setUseImageDetails($value) {
		$this->m_use_details = $value;
	}
	
	/**
	 * Get the UseImageDetails
	 * 
	 * @return String
	 */
	public function getUseImageDetails() {
		return ( $this->m_use_details == 1 || $this->m_use_details == '1' || $this->m_use_details ? true : false );
	}
	
	/**
	 * Set the ImageSort
	 * 
	 * @param String $value
	 */
	public function setImageSort($value) {
		$this->m_image_sort = $value;
	}
	
	/**
	 * Get the ImageSort
	 * 
	 * @return String
	 */
	public function getImageSort() {
		return $this->m_image_sort;
	}
	
	/**
	 * Set the UseComments
	 * 
	 * @param String $value
	 */
	public function setUseComments($value) {
		$this->m_use_comments = $value;
	}
	
	/**
	 * Get the UseComments
	 * 
	 * @return String
	 */
	public function getUseComments() {
		return ( $this->m_use_comments == 1 || $this->m_use_comments == '1' || $this->m_use_comments ? true : false );
	}
	
	/**
	 * Set the Access
	 * 
	 * @param String $value
	 */
	public function setAccess($value) {
		$this->m_access = $value;
	}
	
	/**
	 * Get the Access
	 * 
	 * @return String
	 */
	public function getAccess() {
		return $this->m_access;
	}
	
	/**
	 * Set the ListOption
	 * 
	 * @param String $value
	 */
	public function setListOption($value) {
		$this->m_list_option = $value;
	}
	
	/**
	 * Get the ListOption
	 * 
	 * @return String
	 */
	public function getListOption() {
		return $this->m_list_option;
	}
	
	/**
	 * Set the MaxImages
	 * 
	 * @param String $value
	 */
	public function setMaxImages($value) {
		$this->m_max_image = $value;
	}
	
	/**
	 * Get the MaxImages
	 * 
	 * @return String
	 */
	public function getMaxImages() {
		return $this->m_max_image;
	}
	
	/**
	 * Set the needle_image
	 * 
	 * @param String $value
	 */
	public function setNeedleImage($value) {
		$this->m_needle_image = $value;
	}
	
	/**
	 * Get the needle_image
	 * 
	 * @return String
	 */
	public function getNeedleImage() {
		return $this->m_needle_image;
	}
	
	/**
	 * Set the m_show_lastimg_title
	 * 
	 * @param String $value
	 */
	public function setShowLastImageTitle($value) {
		$this->m_show_lastimg_title = $value;
	}
	
	/**
	 * Get the m_show_lastimg_title
	 * 
	 * @return String
	 */
	public function getShowLastImageTitle() {
		return ( $this->m_show_lastimg_title == 1 ? true : false );
	}
	
	/**
	 * Set the m_align_image
	 * 
	 * @param String $value
	 */
	public function setImageAlignment($value) {
		$this->m_align_image = $value;
	}
	
	/**
	 * Get the m_align_image
	 * 
	 * @return String
	 */
	public function getImageAlignment() {
		return $this->m_align_image;
	}
	
	/**
	 * Set the m_size_image
	 * 
	 * @param String $value
	 */
	public function setImageSize($value) {
		$this->m_size_image = $value;
	}
	
	/**
	 * Get the m_size_image
	 * 
	 * @return String
	 */
	public function getImageSize() {
		return $this->m_size_image;
	}
	
	/**
	 * Set the ListOptionAmount
	 * 
	 * @param String $value
	 */
	public function setListOptionAmount($value) {
		$this->m_list_option_amount = $value;
	}
	
	/**
	 * Get the ListOptionAmount
	 * 
	 * @return String
	 */
	public function getListOptionAmount() {
		return $this->m_list_option_amount;
	}
}

?>
