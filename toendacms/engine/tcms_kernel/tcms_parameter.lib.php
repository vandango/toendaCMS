<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Parameter public functions
|
| File:	tcms_parameter.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Parameter public functions
 *
 * This class is used for base checkings.
 *
 * @version 0.0.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 * 
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 * 
 * checkInstallDir               -> Check if a the installation dir almost exists
 * checkInstallExist             -> Check if CMS is installed
 * checkWriteableData            -> Check data directory for writing rights
 * checkWriteableSession         -> Check session directory for writing rights
 *
 */


class tcms_parameter {
	/**
	 * Constructor
	 */
	public function __construct(){
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct(){
	}
	
	
	/**
	 * Check if a the installation dir almost exists
	 * 
	 * @param String $tcms_administer_path
	 */
	public function checkInstallDir($tcms_administer_path){
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
	public function checkInstallExist(){
		return ( file_exists('setup/index.php') ? false : true );
	}
	
	
	/**
	 * Check data directory for writing rights
	 * 
	 * @param String $tcms_administer_path
	 */
	public function checkWriteableData($tcms_administer_path){
		return ( !is_writable($tcms_administer_path.'/') ? false : true );
	}
	
	
	/**
	 * Check session directory for writing rights
	 * 
	 * @param String $tcms_administer_path
	 */
	public function checkWriteableSession($tcms_administer_path){
		return ( !is_writable($tcms_administer_path.'/tcms_session/') ? false : true );
	}
}

?>
