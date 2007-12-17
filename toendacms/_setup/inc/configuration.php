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
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
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
	public function __construct() {
		$this->_requiredPHPVersion = '5.0.0';
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	public function __destruct() {
	}
	
	
	
	/**
	 * Get the required PHP version
	 *
	 * @return String
	 */
	public function getRequiredPHPVersion() {
		return $this->_requiredPHPVersion;
	}
}

?>
