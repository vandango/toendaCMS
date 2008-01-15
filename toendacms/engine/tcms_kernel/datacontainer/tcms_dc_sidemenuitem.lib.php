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
 * @version 0.0.9
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
	public function __construct() {
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
	public function setID($value){
		$this->m_uid = $value;
	}
	
	/**
	 * get the sidemenuitem uid
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->m_uid;
	}
	
	/**
	 * set the sidemenuitem root
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setRoot($value){
		$this->m_root = $value;
	}
	
	/**
	 * get the sidemenuitem root
	 * 
	 * @return String
	 */
	public function getRoot(){
		return $this->m_root;
	}
	
	/**
	 * set the sidemenuitem title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * get the sidemenuitem title
	 * 
	 * @return String
	 */
	public function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * set the sidemenuitem position
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPosition($value){
		$this->m_order = $value;
	}
	
	/**
	 * get the sidemenuitem position
	 * 
	 * @return String
	 */
	public function getPosition(){
		return $this->m_order;
	}
	
	/**
	 * set the sidemenuitem sub position
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSubmenuPosition($value){
		$this->m_suborder = $value;
	}
	
	/**
	 * get the sidemenuitem sub position
	 * 
	 * @return String
	 */
	public function getSubmenuPosition(){
		return $this->m_suborder;
	}
	
	/**
	 * set the sidemenuitem type
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setType($value){
		$this->m_type = $value;
	}
	
	/**
	 * get the sidemenuitem type
	 * 
	 * @return String
	 */
	public function getType(){
		return $this->m_type;
	}
	
	/**
	 * set the sidemenuitem psrent
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setParent($value){
		$this->m_parent = $value;
	}
	
	/**
	 * get the sidemenuitem parent
	 * 
	 * @return String
	 */
	public function getParent(){
		return $this->m_parent;
	}
	
	/**
	 * set the sidemenuitem link
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLink($value){
		$this->m_link = $value;
	}
	
	/**
	 * get the sidemenuitem link
	 * 
	 * @return String
	 */
	public function getLink(){
		return $this->m_link;
	}
	
	/**
	 * set the sidemenuitem publishing state
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPublished($value){
		$this->m_pub = $value;
	}
	
	/**
	 * get the sidemenuitem publishing state
	 * 
	 * @return String
	 */
	public function getPublished(){
		return $this->m_pub;
	}
	
	/**
	 * set the sidemenuitem access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value){
		$this->m_acs = $value;
	}
	
	/**
	 * get the sidemenuitem access
	 * 
	 * @return String
	 */
	public function getAccess(){
		return $this->m_acs;
	}
	
	/**
	 * set the sidemenuitem target
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTarget($value){
		$this->m_target = $value;
	}
	
	/**
	 * get the sidemenuitem target
	 * 
	 * @return String
	 */
	public function getTarget(){
		return $this->m_target;
	}
}

?>
