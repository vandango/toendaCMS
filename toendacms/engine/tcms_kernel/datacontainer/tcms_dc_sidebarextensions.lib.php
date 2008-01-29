<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Sidebar Extensions
|
| File:	tcms_dc_sidebarmodule.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sidebar Extensions
 *
 * This class is used as a datacontainer object for
 * sidebar extension settings.
 *
 * @version 0.1.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_sidebarextensions {
	private $m_id;
	private $m_lang;
	private $m_sidemenu_title;
	private $m_show_chooser_title;
	private $m_chooser_title;
	private $m_sidebar_title;
	private $m_show_sidebar_title;
	private $m_login_title;
	private $m_nologin;
	private $m_reg_link;
	private $m_reg_user;
	private $m_reg_pass;
	private $m_login_user;
	private $m_show_login_title;
	private $m_show_memberlist;
	private $m_usermenu;
	private $m_usermenu_title;
	private $m_show_news_cat_amount;
	
	/**
	 * PHP5 Constructor
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
	 * Set the languages
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLanguages($value) {
		$this->m_lang = $value;
	}
	
	/**
	 * Get the languages
	 * 
	 * @return String
	 */
	public function getLanguages() {
		return $this->m_lang;
	}
	
	/**
	 * Set the sidemenu title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSidemenuTitle($value) {
		$this->m_sidemenu_title = $value;
	}
	
	/**
	 * Get the sidemenu title
	 * 
	 * @return String
	 */
	public function getSidemenuTitle() {
		return $this->m_sidemenu_title;
	}
	
	/**
	 * Set the layout chooser title show flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowLayoutChooserTitle($value) {
		$this->m_show_chooser_title = $value;
	}
	
	/**
	 * Get the layout chooser title show flag
	 * 
	 * @return String
	 */
	public function getShowLayoutChooserTitle() {
		return ( $this->m_show_chooser_title == 1 ? true : false );
	}
	
	/**
	 * Set the layout chooser title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLayoutChooserTitle($value) {
		$this->m_chooser_title = $value;
	}
	
	/**
	 * Get the layout chooser title
	 * 
	 * @return String
	 */
	public function getLayoutChooserTitle() {
		return $this->m_chooser_title;
	}
	
	/**
	 * Set the sidebar title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSidebarTitle($value) {
		$this->m_sidebar_title = $value;
	}
	
	/**
	 * Get the sidebar title
	 * 
	 * @return String
	 */
	public function getSidebarTitle() {
		return $this->m_sidebar_title;
	}
	
	/**
	 * Set the sidebar title show flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowSidebarTitle($value) {
		$this->m_show_sidebar_title = $value;
	}
	
	/**
	 * Get the sidebar title show flag
	 * 
	 * @return String
	 */
	public function getShowSidebarTitle() {
		return ( $this->m_show_sidebar_title == 1 ? true : false );
	}
	
	/**
	 * Set the Login title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLoginTitle($value) {
		$this->m_login_title = $value;
	}
	
	/**
	 * Get the Login title
	 * 
	 * @return String
	 */
	public function getLoginTitle() {
		return $this->m_login_title;
	}
	
	/**
	 * Set the Login title show flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowLoginTitle($value) {
		$this->m_show_login_title = $value;
	}
	
	/**
	 * Get the Login title show flag
	 * 
	 * @return String
	 */
	public function getShowLoginTitle() {
		return ( $this->$m_show_login_title == 1 ? true : false );
	}
	
	/**
	 * Set the Memberlist show flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowMemberlist($value) {
		$this->m_show_memberlist = $value;
	}
	
	/**
	 * Get the Memberlist show flag
	 * 
	 * @return String
	 */
	public function getShowMemberlist() {
		return ( $this->m_show_memberlist == 1 ? true : false );
	}
	
	/**
	 * Set the LoginUser flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLoginUser($value) {
		$this->m_login_user = $value;
	}
	
	/**
	 * Get the LoginUser flag
	 * 
	 * @return String
	 */
	public function getLoginUser() {
		return ( $this->m_login_user == 1 ? true : false );
	}
	
	/**
	 * Set the NoLoginText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNoLoginText($value) {
		$this->m_nologin = $value;
	}
	
	/**
	 * Get the NoLoginText
	 * 
	 * @return String
	 */
	public function getNoLoginText() {
		return $this->m_nologin;
	}
	
	/**
	 * Set the RegisterLinkText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setRegisterLinkText($value) {
		$this->m_reg_link = $value;
	}
	
	/**
	 * Get the RegisterLinkText
	 * 
	 * @return String
	 */
	public function getRegisterLinkText() {
		return $this->m_reg_link;
	}
	
	/**
	 * Set the RegisterUserText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setRegisterUserText($value) {
		$this->m_reg_user = $value;
	}
	
	/**
	 * Get the RegisterUserText
	 * 
	 * @return String
	 */
	public function getRegisterUserText() {
		return $this->m_reg_user;
	}
	
	/**
	 * Set the RegisterPasswordText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setRegisterPasswordText($value) {
		$this->m_reg_pass = $value;
	}
	
	/**
	 * Get the RegisterPasswordText
	 * 
	 * @return String
	 */
	public function getRegisterPasswordText() {
		return $this->m_reg_pass;
	}
	
	/**
	 * Set the Usermenu
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUsermenu($value) {
		$this->m_usermenu = $value;
	}
	
	/**
	 * Get the Usermenu
	 * 
	 * @return String
	 */
	public function getUsermenu() {
		return $this->m_usermenu;
	}
	
	/**
	 * Set the UsermenuTitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUsermenuTitle($value) {
		$this->m_usermenu_title = $value;
	}
	
	/**
	 * Get the UsermenuTitle
	 * 
	 * @return String
	 */
	public function getUsermenuTitle() {
		return $this->m_usermenu_title;
	}
	
	/**
	 * Set the ShowNewsCategoryAmount flag
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowNewsCategoryAmount($value) {
		$this->m_show_news_cat_amount = $value;
	}
	
	/**
	 * Get the ShowNewsCategoryAmount flag
	 * 
	 * @return String
	 */
	public function getShowNewsCategoryAmount() {
		return ( $this->m_show_news_cat_amount == 1 ? true : false );
	}
}

?>
