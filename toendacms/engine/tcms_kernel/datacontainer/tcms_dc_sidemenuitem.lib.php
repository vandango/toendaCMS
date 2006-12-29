<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Sidemenu Item DataContainer
|
| File:		tcms_dc_sidemenuitem.lib.php
| Version:	0.0.5
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sidemenu Item DataContainer
 *
 * This class is used as a datacontainer object for
 * sidemenu items.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_sidemenuitem {
	var $m_uid;
	var $m_title;
	var $m_order;
	var $m_suborder;
	var $m_type;
	var $m_parent;
	var $m_link;
	var $m_pub;
	var $m_acs;
	var $m_root;
	
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
	function tcms_dc_sidemenuitem(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/**
	 * Set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * Get the sidemenuitem uid
	 * 
	 * @return String
	 */
	function GetID(){
		return $this->m_uid;
	}
	
	/**
	 * Set the sidemenuitem root
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetRoot($value){
		$this->m_root = $value;
	}
	
	/**
	 * Get the sidemenuitem root
	 * 
	 * @return String
	 */
	function GetRoot(){
		return $this->m_root;
	}
	
	/**
	 * Set the sidemenuitem title
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the sidemenuitem title
	 * 
	 * @return String
	 */
	function GetTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the sidemenuitem position
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPosition($value){
		$this->m_order = $value;
	}
	
	/**
	 * Get the sidemenuitem position
	 * 
	 * @return String
	 */
	function GetPosition(){
		return $this->m_order;
	}
	
	/**
	 * Set the sidemenuitem sub position
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSubmenuPosition($value){
		$this->m_suborder = $value;
	}
	
	/**
	 * Get the sidemenuitem sub position
	 * 
	 * @return String
	 */
	function GetSubmenuPosition(){
		return $this->m_suborder;
	}
	
	/**
	 * Set the sidemenuitem type
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetType($value){
		$this->m_type = $value;
	}
	
	/**
	 * Get the sidemenuitem type
	 * 
	 * @return String
	 */
	function GetType(){
		return $this->m_type;
	}
	
	/**
	 * Set the sidemenuitem psrent
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetParent($value){
		$this->m_parent = $value;
	}
	
	/**
	 * Get the sidemenuitem parent
	 * 
	 * @return String
	 */
	function GetParent(){
		return $this->m_parent;
	}
	
	/**
	 * Set the sidemenuitem link
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLink($value){
		$this->m_link = $value;
	}
	
	/**
	 * Get the sidemenuitem link
	 * 
	 * @return String
	 */
	function GetLink(){
		return $this->m_link;
	}
	
	/**
	 * Set the sidemenuitem publishing state
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * Get the sidemenuitem publishing state
	 * 
	 * @return String
	 */
	function GetPublished(){
		return $this->m_pub;
	}
	
	/**
	 * Set the sidemenuitem access
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * Get the sidemenuitem access
	 * 
	 * @return String
	 */
	function GetAccess(){
		return $this->m_acs;
	}
}
