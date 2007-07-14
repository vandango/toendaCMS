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
| File:	tcms_dc_product.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Product data container
 *
 * This class is used as a datacontainer object for
 * product items.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_product {
	var $_uid;
	
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
	function tcms_dc_product(){
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
		$this->_uid = $value;
	}
	
	/**
	 * Get the uid
	 * 
	 * @return String
	 */
	function getID(){
		return $this->_uid;
	}
}

?>
