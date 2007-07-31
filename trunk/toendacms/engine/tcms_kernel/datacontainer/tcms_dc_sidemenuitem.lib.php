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
| File:	tcms_dc_sidemenuitem.lib.php
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
 * @version 0.0.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_sidemenuitem {
	private $m_uid;
	private $m_title;
	private $m_order;
	private $m_suborder;
	private $m_type;
	private $m_parent;
	private $m_link;
	private $m_pub;
	private $m_acs;
	private $m_root;
	private $m_target;
	
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
	 * set the sidemenuitem uid
	 * 
	 * @param String $value
	 * @return String
	 */
	function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * get the sidemenuitem uid
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_uid;
	}
	
	/**
	 * set the sidemenuitem root
	 * 
	 * @param String $value
	 * @return String
	 */
	function setRoot($value){
		$this->m_root = $value;
	}
	
	/**
	 * get the sidemenuitem root
	 * 
	 * @return String
	 */
	function getRoot(){
		return $this->m_root;
	}
	
	/**
	 * set the sidemenuitem title
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * get the sidemenuitem title
	 * 
	 * @return String
	 */
	function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * set the sidemenuitem position
	 * 
	 * @param String $value
	 * @return String
	 */
	function setPosition($value){
		$this->m_order = $value;
	}
	
	/**
	 * get the sidemenuitem position
	 * 
	 * @return String
	 */
	function getPosition(){
		return $this->m_order;
	}
	
	/**
	 * set the sidemenuitem sub position
	 * 
	 * @param String $value
	 * @return String
	 */
	function setSubmenuPosition($value){
		$this->m_suborder = $value;
	}
	
	/**
	 * get the sidemenuitem sub position
	 * 
	 * @return String
	 */
	function getSubmenuPosition(){
		return $this->m_suborder;
	}
	
	/**
	 * set the sidemenuitem type
	 * 
	 * @param String $value
	 * @return String
	 */
	function setType($value){
		$this->m_type = $value;
	}
	
	/**
	 * get the sidemenuitem type
	 * 
	 * @return String
	 */
	function getType(){
		return $this->m_type;
	}
	
	/**
	 * set the sidemenuitem psrent
	 * 
	 * @param String $value
	 * @return String
	 */
	function setParent($value){
		$this->m_parent = $value;
	}
	
	/**
	 * get the sidemenuitem parent
	 * 
	 * @return String
	 */
	function getParent(){
		return $this->m_parent;
	}
	
	/**
	 * set the sidemenuitem link
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLink($value){
		$this->m_link = $value;
	}
	
	/**
	 * get the sidemenuitem link
	 * 
	 * @return String
	 */
	function getLink(){
		return $this->m_link;
	}
	
	/**
	 * set the sidemenuitem publishing state
	 * 
	 * @param String $value
	 * @return String
	 */
	function setPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * get the sidemenuitem publishing state
	 * 
	 * @return String
	 */
	function getPublished(){
		return $this->m_pub;
	}
	
	/**
	 * set the sidemenuitem access
	 * 
	 * @param String $value
	 * @return String
	 */
	function setAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * get the sidemenuitem access
	 * 
	 * @return String
	 */
	function getAccess(){
		return $this->m_acs;
	}
	
	/**
	 * set the sidemenuitem target
	 * 
	 * @param String $value
	 * @return String
	 */
	function setTarget($value){
		$this->m_target = $value;
	}
	
	/**
	 * get the sidemenuitem target
	 * 
	 * @return String
	 */
	function getTarget(){
		return $this->m_target;
	}
}

?>
