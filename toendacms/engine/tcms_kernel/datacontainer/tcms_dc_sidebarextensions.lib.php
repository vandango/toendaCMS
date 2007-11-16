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
 * @version 0.0.5
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
	function tcms_dc_sidebarextensions(){
		$this->__construct();
	}
	
	/**
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the languages
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLanguages($value){
		$this->m_lang = $value;
	}
	
	/**
	 * Get the languages
	 * 
	 * @return String
	 */
	function getLanguages(){
		return $this->m_lang;
	}
	
	/**
	 * Set the sidemenu title
	 * 
	 * @param String $value
	 * @return String
	 */
	function setSidemenuTitle($value){
		$this->m_sidemenu_title = $value;
	}
	
	/**
	 * Get the sidemenu title
	 * 
	 * @return String
	 */
	function getSidemenuTitle(){
		return $this->m_sidemenu_title;
	}
	
	/**
	 * Set the layout chooser title show flag
	 * 
	 * @param String $value
	 * @return String
	 */
	function setShowLayoutChooserTitle($value){
		$this->m_show_chooser_title = $value;
	}
	
	/**
	 * Get the layout chooser title show flag
	 * 
	 * @return String
	 */
	function getShowLayoutChooserTitle(){
		return ( $this->m_show_chooser_title == 1 ? true : false );
	}
	
	/**
	 * Set the layout chooser title
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLayoutChooserTitle($value){
		$this->m_chooser_title = $value;
	}
	
	/**
	 * Get the layout chooser title
	 * 
	 * @return String
	 */
	function getLayoutChooserTitle(){
		return $this->m_chooser_title;
	}
}

?>
