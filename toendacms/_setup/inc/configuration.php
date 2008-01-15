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
 * @version 0.0.5
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
 * getRequiredPHPVersion       -> Get the required PHP settings
 * getWritableFilesystem       -> Get the required writable filesystem
 * 
 * </code>
 *
 */


class tcms_setup_configuration {
	private $_requiredPHPVersion;
	private $_arrPHPSetting;
	private $_arrWritableFilesystem;
	
	
	
	/**
	 * PHP5 Constructor
	 */
	public function __construct() {
		$this->_requiredPHPVersion = '5.2.0';
		
		/*
			PHP Setting
		*/
		
		$this->_arrPHPSetting['name'][0] = 'Save Mode (optional)';
		$this->_arrPHPSetting['code'][0] = 'safe_mode';
		$this->_arrPHPSetting['must'][0] = 0;
		
		$this->_arrPHPSetting['name'][1] = 'Register Globals';
		$this->_arrPHPSetting['code'][1] = 'register_globals';
		$this->_arrPHPSetting['must'][1] = 1;
		
		
		/*
			Writable filesystem
		*/
		
		$this->_arrWritableFilesystem['name'][0] = '/data';
		$this->_arrWritableFilesystem['path'][0] = '../data';
		
		$this->_arrWritableFilesystem['name'][1] = '/data/images/albums';
		$this->_arrWritableFilesystem['path'][1] = '../data/images/albums';
		
		$this->_arrWritableFilesystem['name'][2] = '/data/images/knowledgebase';
		$this->_arrWritableFilesystem['path'][2] = '../data/images/knowledgebase';
		
		$this->_arrWritableFilesystem['name'][3] = '/data/images/upload_thumb';
		$this->_arrWritableFilesystem['path'][3] = '../data/images/upload_thumb';
		
		$this->_arrWritableFilesystem['name'][4] = '/data/images/Image';
		$this->_arrWritableFilesystem['path'][4] = '../data/images/Image';
		
		$this->_arrWritableFilesystem['name'][5] = '/cache';
		$this->_arrWritableFilesystem['path'][5] = '../cache';
		
		$this->_arrWritableFilesystem['name'][6] = '/cache/captcha';
		$this->_arrWritableFilesystem['path'][6] = '../cache/captcha';
		
		$this->_arrWritableFilesystem['name'][7] = '/data/tcms_global';
		$this->_arrWritableFilesystem['path'][7] = '../data/tcms_global';
		
		$this->_arrWritableFilesystem['name'][8] = '/engine/admin/session';
		$this->_arrWritableFilesystem['path'][8] = '../engine/admin/session';
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
	
	
	
	/**
	 * Get the required PHP settings
	 *
	 * @return String
	 */
	public function getRequiredPHPSettings() {
		return $this->_arrPHPSetting;
	}
	
	
	
	/**
	 * Get the required writable filesystem
	 *
	 * @return String
	 */
	public function getWritableFilesystem() {
		return $this->_arrWritableFilesystem;
	}
}

?>
