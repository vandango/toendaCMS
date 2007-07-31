<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS XML RPC
|
| File:	tcms_xmlrpc.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS XML RPC
 *
 * This class is used for the MetaWeblog API
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 * __construct                -> PHP5 Constructor
 * tcms_xmlrpc                -> PHP4 Constructor
 * __destruct                 -> PHP5 Destructor
 * _tcms_xmlrpc               -> PHP4 Destructor
 * 
 * xx                         -> Checks if the end of the file is reched
 * 
 * </code>
 *
 */


class tcms_xmlrpc {
	private $m_var;
	
	
	
	/**
	 * PHP5: Default constructor
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4: Default constructor
	 */
	function tcms_file(){
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_file(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Checks if the end of the file is reched
	 * 
	 * @return String
	 */
	function xx(){
		return '';
	}
}

?>
