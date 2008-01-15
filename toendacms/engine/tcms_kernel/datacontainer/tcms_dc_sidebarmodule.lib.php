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
 * @version 0.0.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_sidebarmodule {
	private $m_side_gallery;
	private $m_side_category;
	private $m_side_archives;
	private $m_side_links;
	private $m_layout_chooser;
	private $m_login;
	private $m_syndication;
	private $m_newsletter;
	private $m_search;
	private $m_sidebar;
	private $m_poll;
	
	/**
	 * PHP5 Constructor
	 *
	 */
	public function __construct() {
	}
	
	/**
	 * set the side gallery
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSideGallery($value){
		$this->m_side_gallery = $value;
	}
	
	/**
	 * get the side gallery
	 * 
	 * @return String
	 */
	public function getSideGallery(){
		return $this->m_side_gallery;
	}
	
	/**
	 * set the side category
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSideCategory($value){
		$this->m_side_category = $value;
	}
	
	/**
	 * get the side category
	 * 
	 * @return String
	 */
	public function getSideCategory(){
		return $this->m_side_category;
	}
	
	/**
	 * set the side side archive
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSideArchive($value){
		$this->m_side_archives = $value;
	}
	
	/**
	 * get the side side archive
	 * 
	 * @return String
	 */
	public function getSideArchive(){
		return $this->m_side_archives;
	}
	
	/**
	 * set the side side links
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSideLinks($value){
		$this->m_side_links = $value;
	}
	
	/**
	 * get the side side links
	 * 
	 * @return String
	 */
	public function getSideLinks(){
		return $this->m_side_links;
	}
	
	/**
	 * set the side layout chooser
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLayoutChooser($value){
		$this->m_layout_chooser = $value;
	}
	
	/**
	 * get the side layout chooser
	 * 
	 * @return String
	 */
	public function getLayoutChooser(){
		return $this->m_layout_chooser;
	}
	
	/**
	 * set the side login
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLogin($value){
		$this->m_login = $value;
	}
	
	/**
	 * get the side login
	 * 
	 * @return String
	 */
	public function getLogin(){
		return $this->m_login;
	}
	
	/**
	 * set the side syndication
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndication($value){
		$this->m_syndication = $value;
	}
	
	/**
	 * get the side syndication
	 * 
	 * @return String
	 */
	public function getSyndication(){
		return $this->m_syndication;
	}
	
	/**
	 * set the side newsletter
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNewsletter($value){
		$this->m_newsletter = $value;
	}
	
	/**
	 * get the side newsletter
	 * 
	 * @return String
	 */
	public function getNewsletter(){
		return $this->m_newsletter;
	}
	
	/**
	 * set the side search
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSearch($value){
		$this->m_search = $value;
	}
	
	/**
	 * get the side search
	 * 
	 * @return String
	 */
	public function getSearch(){
		return $this->m_search;
	}
	
	/**
	 * set the side sidebar
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSidebar($value){
		$this->m_sidebar = $value;
	}
	
	/**
	 * get the side sidebar
	 * 
	 * @return String
	 */
	public function getSidebar(){
		return $this->m_sidebar;
	}
	
	/**
	 * set the side poll
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setPoll($value){
		$this->m_poll = $value;
	}
	
	/**
	 * get the side poll
	 * 
	 * @return String
	 */
	public function getPoll(){
		return $this->m_poll;
	}
}

?>
