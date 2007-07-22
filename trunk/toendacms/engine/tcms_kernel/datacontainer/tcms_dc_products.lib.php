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
| File:	tcms_dc_products.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Products data container
 *
 * This class is used as a datacontainer object for
 * products manager.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_products {
	var $m_uid;
	var $m_lang;
	var $m_title;
	var $m_key;
	var $m_text;
	var $m_product_main_category;
	var $m_side_category_title;
	var $m_use_side_category;
	var $m_show_price_only_user;
	var $m_startpagetitle;
	var $m_use_sidebar_categories;
	
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
	function tcms_dc_products(){
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
	
	/***
	 * Set the text
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
	
	/***
	 * Set the Product Main Category
	 * 
	 * @param String $value
	 * @return String
	*/
	function setProductMainCategory($value){
		$this->m_product_main_category = $value;
	}
	
	/**
	 * Get the Product Main Category
	 * 
	 * @return String
	 */
	function getProductMainCategory(){
		return $this->m_product_main_category;
	}
	
	/***
	 * Set the Sidebar Category Title
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSidebarCategoryTitle($value){
		$this->m_side_category_title = $value;
	}
	
	/**
	 * Get the Sidebar Category Title
	 * 
	 * @return String
	 */
	function getSidebarCategoryTitle(){
		return $this->m_side_category_title;
	}
	
	/***
	 * Set the use Sidebar Category
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseSideCategory($value){
		$this->m_use_side_category = $value;
	}
	
	/**
	 * Get the use Sidebar Category
	 * 
	 * @return String
	 */
	function getUseSideCategory(){
		return $this->m_use_side_category;
	}
	
	/***
	 * Set the ShowPriceOnlyUsers
	 * 
	 * @param String $value
	 * @return String
	*/
	function setShowPriceOnlyUsers($value){
		$this->m_show_price_only_user = $value;
	}
	
	/**
	 * Get the ShowPriceOnlyUsers
	 * 
	 * @return String
	 */
	function getShowPriceOnlyUsers(){
		return $this->m_show_price_only_user;
	}
	
	/***
	 * Set the StartpageTitle
	 * 
	 * @param String $value
	 * @return String
	*/
	function setStartpageTitle($value){
		$this->m_startpagetitle = $value;
	}
	
	/**
	 * Get the StartpageTitle
	 * 
	 * @return String
	 */
	function getStartpageTitle(){
		return $this->m_startpagetitle;
	}
	
	/***
	 * Set the m_use_sidebar_categories
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseSidebarCategories($value){
		$this->m_use_sidebar_categories = $value;
	}
	
	/**
	 * Get the m_use_sidebar_categories
	 * 
	 * @return String
	 */
	function getUseSidebarCategories(){
		return $this->m_use_sidebar_categories;
	}
}

?>
