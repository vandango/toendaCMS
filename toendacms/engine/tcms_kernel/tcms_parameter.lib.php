<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Parameter Functions
|
| File:	tcms_parameter.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Parameter Functions
 *
 * This class is used for base checkings.
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 * 
 * __construct                 -> PHP5 Constructor
 * toendaScript                -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _toendaScript               -> PHP4 Destructor
 * 
 * checkInstallDir               -> Check if a the installation dir almost exists
 * checkInstallExist             -> Check if CMS is installed
 * checkWriteableData            -> Check data directory for writing rights
 * checkWriteableSession         -> Check session directory for writing rights
 *
 */


class tcms_parameter {
	/**
	 * PHP5 Constructor
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4 Constructor
	 */
	function tcms_parameter(){
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
	function _tcms_parameter(){
		$this->__destruct();
	}
	
	
	/**
	 * Check if a the installation dir almost exists
	 * 
	 * @param String $tcms_administer_path
	 */
	function checkInstallDir($tcms_administer_path){
		if(!file_exists($tcms_administer_path.'/tcms_global/namen.xml')) return false;
		if(!file_exists($tcms_administer_path.'/tcms_global/var.xml')) return false;
		if(!file_exists($tcms_administer_path.'/tcms_global/footer.xml')) return false;
		
		return true;
	}
	
	
	/**
	 * Check if CMS is installed
	 * 
	 * @return check for exiting installation
	 */
	function checkInstallExist(){
		return ( file_exists('setup/index.php') ? false : true );
	}
	
	
	/**
	 * Check data directory for writing rights
	 * 
	 * @param String $tcms_administer_path
	 */
	function checkWriteableData($tcms_administer_path){
		return ( !is_writable($tcms_administer_path.'/') ? false : true );
	}
	
	
	/**
	 * Check session directory for writing rights
	 * 
	 * @param String $tcms_administer_path
	 */
	function checkWriteableSession($tcms_administer_path){
		return ( !is_writable($tcms_administer_path.'/tcms_session/') ? false : true );
	}
}

?>
