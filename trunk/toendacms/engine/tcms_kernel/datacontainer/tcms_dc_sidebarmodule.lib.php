<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Sidebar Module DataContainer
|
| File:	tcms_dc_sidebarmodule.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sidebar module DataContainer
 *
 * This class is used as a datacontainer object for
 * sidemenu items.
 *
 * @version 0.0.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_sidebarmodule {
	var $m_side_gallery;
	var $m_side_category;
	var $m_side_archives;
	var $m_side_links;
	var $m_layout_chooser;
	var $m_login;
	var $m_syndication;
	var $m_newsletter;
	var $m_search;
	var $m_sidebar;
	var $m_poll;
	
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
	function tcms_dc_sidebarmodule(){
		$this->__construct();
	}
	
	/**
	 * Set the side gallery
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSideGallery($value){
		$this->m_side_gallery = $value;
	}
	
	/**
	 * Get the side gallery
	 * 
	 * @return String
	 */
	function GetSideGallery(){
		return $this->m_side_gallery;
	}
	
	/**
	 * Set the side category
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSideCategory($value){
		$this->m_side_category = $value;
	}
	
	/**
	 * Get the side category
	 * 
	 * @return String
	 */
	function GetSideCategory(){
		return $this->m_side_category;
	}
	
	/**
	 * Set the side side archive
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSideArchive($value){
		$this->m_side_archives = $value;
	}
	
	/**
	 * Get the side side archive
	 * 
	 * @return String
	 */
	function GetSideArchive(){
		return $this->m_side_archives;
	}
	
	/**
	 * Set the side side links
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSideLinks($value){
		$this->m_side_links = $value;
	}
	
	/**
	 * Get the side side links
	 * 
	 * @return String
	 */
	function GetSideLinks(){
		return $this->m_side_links;
	}
	
	/**
	 * Set the side layout chooser
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLayoutChooser($value){
		$this->m_layout_chooser = $value;
	}
	
	/**
	 * Get the side layout chooser
	 * 
	 * @return String
	 */
	function GetLayoutChooser(){
		return $this->m_layout_chooser;
	}
	
	/**
	 * Set the side login
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetLogin($value){
		$this->m_login = $value;
	}
	
	/**
	 * Get the side login
	 * 
	 * @return String
	 */
	function GetLogin(){
		return $this->m_login;
	}
	
	/**
	 * Set the side syndication
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSyndication($value){
		$this->m_syndication = $value;
	}
	
	/**
	 * Get the side syndication
	 * 
	 * @return String
	 */
	function GetSyndication(){
		return $this->m_syndication;
	}
	
	/**
	 * Set the side newsletter
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetNewsletter($value){
		$this->m_newsletter = $value;
	}
	
	/**
	 * Get the side newsletter
	 * 
	 * @return String
	 */
	function GetNewsletter(){
		return $this->m_newsletter;
	}
	
	/**
	 * Set the side search
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSearch($value){
		$this->m_search = $value;
	}
	
	/**
	 * Get the side search
	 * 
	 * @return String
	 */
	function GetSearch(){
		return $this->m_search;
	}
	
	/**
	 * Set the side sidebar
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetSidebar($value){
		$this->m_sidebar = $value;
	}
	
	/**
	 * Get the side sidebar
	 * 
	 * @return String
	 */
	function GetSidebar(){
		return $this->m_sidebar;
	}
	
	/**
	 * Set the side poll
	 * 
	 * @param String $value
	 * @return String
	 */
	function SetPoll($value){
		$this->m_poll = $value;
	}
	
	/**
	 * Get the side poll
	 * 
	 * @return String
	 */
	function GetPoll(){
		return $this->m_poll;
	}
}

?>
