<?php 

$phpVersionRequired = '5.0.0';

?>

<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Setup Configuration
|
| File:	configuration.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Setup Configuration
 *
 * This class is used to provide the global
 * setup configuration data.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_setup_configuration    -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_setup_configuration   -> PHP4 Destructor
 *
 * getRequiredPHPVersion       -> Get the required PHP version
 * 
 * </code>
 *
 */


class tcms_setup_configuration {
	private $_requiredPHPVersion;
	
	
	
	/**
	 * PHP5 Constructor
	 */
	function __construct() {
		$this->_requiredPHPVersion = '5.0.0';
	}
	
	
	
	/**
	 * PHP4 Constructor
	 */
	function tcms_setup_configuration(){
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct() {
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_setup_configuration() {
		$this->__destruct();
	}
	
	
	
	/**
	 * Get the required PHP version
	 *
	 * @return String
	 */
	function getRequiredPHPVersion() {
		return $this->_requiredPHPVersion;
	}
}

?>
