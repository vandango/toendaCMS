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
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_imagegallery {
	var $m_uid;
	var $m_lang;
	var $m_title;
	var $m_key;
	var $m_use_details;
	var $m_image_sort;
	var $m_use_comments;
	var $m_access;
	var $m_list_option;
	var $m_max_image;
	var $m_needle_image;
	var $m_show_lastimg_title;
	var $m_align_image;
	var $m_size_image;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
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
	function tcms_dc_imagegallery(){
		$this->__construct();
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
	function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * Get the uid
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_uid;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLanguage($value){
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	function getLanguage(){
		return $this->m_lang;
	}
	
	/***
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	*/
	function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	function setSubtitle($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	function getSubtitle(){
		return $this->m_key;
	}
	
	/**
	 * Set the UseImageDetails
	 * 
	 * @param String $value
	 */
	function setUseImageDetails($value){
		$this->m_use_details = $value;
	}
	
	/**
	 * Get the UseImageDetails
	 * 
	 * @return String
	 */
	function getUseImageDetails(){
		return $this->m_use_details;
	}
	
	/**
	 * Set the ImageSort
	 * 
	 * @param String $value
	 */
	function setImageSort($value){
		$this->m_image_sort = $value;
	}
	
	/**
	 * Get the ImageSort
	 * 
	 * @return String
	 */
	function getImageSort(){
		return $this->m_image_sort;
	}
	
	/**
	 * Set the UseComments
	 * 
	 * @param String $value
	 */
	function setUseComments($value){
		$this->m_use_comments = $value;
	}
	
	/**
	 * Get the UseComments
	 * 
	 * @return String
	 */
	function getUseComments(){
		return $this->m_use_comments;
	}
	
	/**
	 * Set the Access
	 * 
	 * @param String $value
	 */
	function setAccess($value){
		$this->m_access = $value;
	}
	
	/**
	 * Get the Access
	 * 
	 * @return String
	 */
	function getAccess(){
		return $this->m_access;
	}
	
	/**
	 * Set the ListOption
	 * 
	 * @param String $value
	 */
	function setListOption($value){
		$this->m_list_option = $value;
	}
	
	/**
	 * Get the ListOption
	 * 
	 * @return String
	 */
	function getListOption(){
		return $this->m_list_option;
	}
	
	/**
	 * Set the MaxImages
	 * 
	 * @param String $value
	 */
	function setMaxImages($value){
		$this->m_max_image = $value;
	}
	
	/**
	 * Get the MaxImages
	 * 
	 * @return String
	 */
	function getMaxImages(){
		return $this->m_max_image;
	}
	
	/**
	 * Set the needle_image
	 * 
	 * @param String $value
	 */
	function setNeedleImage($value){
		$this->m_needle_image = $value;
	}
	
	/**
	 * Get the needle_image
	 * 
	 * @return String
	 */
	function getNeedleImage(){
		return $this->m_needle_image;
	}
	
	/**
	 * Set the m_show_lastimg_title
	 * 
	 * @param String $value
	 */
	function setShowLastImageTitle($value){
		$this->m_show_lastimg_title = $value;
	}
	
	/**
	 * Get the m_show_lastimg_title
	 * 
	 * @return String
	 */
	function getShowLastImageTitle(){
		return $this->m_show_lastimg_title;
	}
	
	/**
	 * Set the m_align_image
	 * 
	 * @param String $value
	 */
	function setImageAlignment($value){
		$this->m_align_image = $value;
	}
	
	/**
	 * Get the m_align_image
	 * 
	 * @return String
	 */
	function getImageAlignment(){
		return $this->m_align_image;
	}
	
	/**
	 * Set the m_size_image
	 * 
	 * @param String $value
	 */
	function setImageSize($value){
		$this->m_size_image = $value;
	}
	
	/**
	 * Get the m_size_image
	 * 
	 * @return String
	 */
	function getImageSize(){
		return $this->m_size_image;
	}
}

?>
