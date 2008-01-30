<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS LinksConfiguration DataContainer
|
| File:	tcms_dc_links.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS LinksConfiguration data container
 *
 * This class is used as a datacontainer object for
 * links configuration.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_links {
	private $_id;
	
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
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value){
		$this->_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	public function getID(){
		return $this->_id;
	}
}

?>
