<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Version
|
| File:	tcms_version.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Version
 *
 * This class is used to provide the cms
 * version information.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_version                -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_version               -> PHP4 Destructor
 *
 * getName                     -> Get the name of toendaCMS
 * getTagline                  -> Get the tagline of toendaCMS
 * getCodename                 -> Get the codeline of toendaCMS
 * getVersion                  -> Get the version of toendaCMS
 * getBuild                    -> Get the build of toendaCMS
 * getState                    -> Get the state of toendaCMS
 * getReleaseDate              -> Get the release date of toendaCMS
 * getToendaCopyright          -> Get the toenda copyright of toendaCMS
 * 
 */


class tcms_version {
	var $m_name;
	var $m_tagline;
	var $m_codename;
	var $m_version;
	var $m_build;
	var $m_status;
	var $m_release_date;
	var $m_toenda_copy;
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $relativePath = ''
	 */
	function __construct($relativePath = ''){
		$this->o_xml = new xmlparser($relativePath.'engine/tcms_kernel/tcms_version.xml', 'r');
		
		$this->m_name         = $this->o_xml->read_section('version', 'name');
		$this->m_tagline      = $this->o_xml->read_section('version', 'tagline');
		$this->m_codename     = $this->o_xml->read_section('version', 'codename');
		$this->m_version      = $this->o_xml->read_section('version', 'release');
		$this->m_build        = $this->o_xml->read_section('version', 'build');
		$this->m_status       = $this->o_xml->read_section('version', 'status');
		$this->m_release_date = $this->o_xml->read_section('version', 'release_date');
		$this->m_toenda_copy  = $this->o_xml->read_section('version', 'toenda_copyright');
		
		$this->o_xml->flush();
		$this->o_xml->_xmlparser();
		unset($this->o_xml);
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $relativePath = ''
	 */
	function tcms_version($relativePath = ''){
		$this->__construct($relativePath);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_version(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Get the name of toendaCMS
	 *
	 * @return String
	 */
	function getName(){
		return $this->m_name;
	}
	
	
	
	/**
	 * Get the tagline of toendaCMS
	 *
	 * @return String
	 */
	function getTagline(){
		return $this->m_tagline;
	}
	
	
	
	/**
	 * Get the codename of toendaCMS
	 *
	 * @return String
	 */
	function getCodename(){
		return $this->m_codename;
	}
	
	
	
	/**
	 * Get the version of toendaCMS
	 *
	 * @return String
	 */
	function getVersion(){
		return $this->m_version;
	}
	
	
	
	/**
	 * Get the build of toendaCMS
	 *
	 * @return String
	 */
	function getBuild(){
		return $this->m_build;
	}
	
	
	
	/**
	 * Get the state of toendaCMS
	 *
	 * @return String
	 */
	function getState(){
		return $this->m_status;
	}
	
	
	
	/**
	 * Get the release date of toendaCMS
	 *
	 * @return String
	 */
	function getReleaseDate(){
		return $this->m_release_date;
	}
	
	
	
	/**
	 * Get the toenda copyright of toendaCMS
	 *
	 * @return String
	 */
	function getToendaCopyright(){
		return $this->m_toenda_copy;
	}
}
