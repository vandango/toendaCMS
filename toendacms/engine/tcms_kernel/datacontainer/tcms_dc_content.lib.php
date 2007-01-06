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
| File:		tcms_dc_content.lib.php
| Version:	0.0.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Content data container
 *
 * This class is used as a datacontainer object for
 * content items.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_content {
	var $m_title;
	var $m_key;
	var $m_content00;
	var $m_content01;
	var $m_foot;
	var $m_id;
	var $m_text_layout;
	var $m_acs;
	var $m_pub;
	var $m_autor;
	var $m_in_work;
	var $m_language;
	
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
	function tcms_dc_content(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/***
	 * Set the content id
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the content id
	 * 
	 * @return String
	 */
	function GetID(){
		return $this->m_id;
	}
	
	
	
	
	
	
	
	/***
	* @return string
	* @desc Get or set the content title
	*/
	function SetTitle($value){ $this->m_title = $value; }
	function GetTitle(){ return $this->m_title; }
	
	/***
	* @return string
	* @desc Get or set the content key
	*/
	function SetKeynote($value){ $this->m_key = $value; }
	function GetKeynote(){ return $this->m_key; }
	/***
	* @return string
	* @desc Get or set the content content00
	*/
	function SetText($value){ $this->m_content00 = $value; }
	function GetText(){ return $this->m_content00; }
	
	/***
	* @return string
	* @desc Get or set the content content01
	*/
	function SetSecondContent($value){ $this->m_content01 = $value; }
	function GetSecondContent(){ return $this->m_content01; }
	
	/***
	* @return string
	* @desc Get or set the news footer
	*/
	function SetFootText($value){ $this->m_foot = $value; }
	function GetFootText(){ return $this->m_foot; }
	
	/***
	* @return string
	* @desc Get or set the content text layout
	*/
	function SetTextLayout($value){ $this->m_text_layout = $value; }
	function GetTextLayout(){ return $this->m_text_layout; }
	
	/***
	* @return string
	* @desc Get or set the content access
	*/
	function SetAccess($value){ $this->m_acs = $value; }
	function GetAccess(){ return $this->m_acs; }
	
	/***
	* @return string
	* @desc Get or set the content publishing state
	*/
	function SetPublished($value){ $this->m_pub = $value; }
	function GetPublished(){ return $this->m_pub; }
	
	/***
	* @return string
	* @desc Get or set the content autor
	*/
	function SetAutor($value){ $this->m_autor = $value; }
	function GetAutor(){ return $this->m_autor; }
	
	/***
	* @return string
	* @desc Get or set the inWork state
	*/
	function SetInWorkState($value){ $this->m_in_work = $value; }
	function GetInWorkState(){ return $this->m_in_work; }
	
	
	
	
	
	/***
	 * Set the content language
	 * 
	 * @param String $value
	 * @return String
	*/
	function SetLanguage($value){
		$this->m_language = $value;
	}
	
	/**
	 * Get the content language
	 * 
	 * @return String
	 */
	function GetLanguage(){
		return $this->m_language;
	}
}
