<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Kernel - System framework
|
| File:	tcms.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Kernel - System framework
 * 
 * This class is used for a basic public functions.
 * 
 * @version 3.2.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 * 
 * --------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 * --------------------------------------------------------
 * 
 * __construct                       -> Constructor
 * __destruct                        -> Destructor
 * 
 * --------------------------------------------------------
 * PROPERTIES
 * --------------------------------------------------------
 * 
 * setTcmsTimeObj                    -> Set the tcms_time object
 * setTcmsConfigObj                  -> Set the tcms_config object
 * setDatabaseInfo                   -> Setter for the databse information
 * setURLSEO                         -> Setter for urlSEO
 * setGlobalFolder                   -> Set the global folder
 * setCurrentLang                    -> Set the current lang settings
 * setAdministerSite                 -> Set the administer-site string
 * getCurrentLang                    -> Get the current lang settings
 * getAdministerSite                 -> Get the administer-site string
 * 
 * --------------------------------------------------------
 * PRIVATE MEMBERS
 * --------------------------------------------------------
 * 
 * _getPathContentAmount             -> Get the amount of related files in a path (without directorys)
 * _getPathContent                   -> Return a array of all files or directory's inside a path
 * 
 * --------------------------------------------------------
 * PUBLIC MEMBERS
 * --------------------------------------------------------
 * 
 * getNewUID                         -> Get a new guid
 * getAmountOfItems                  -> Get the amount of items from a table.
 * getPHPSetting                     -> Get a PHP setting
 * getLanguageNameByTCMSLanguageCode -> Get the name of a language by it's TCMS language code
 * getTaxPrice                       -> Get the tax (mwst) price
 * getClearPrice                     -> Get the clear (netto) price
 * getTaxPriceFromClearPrice         -> Get the tax price from a clear price
 * setPHPSetting                     -> Set a PHP setting
 * getUploadMaxSizeInBytes           -> Get the maximal uplaod size of a file applicated in the php.ini file
 * getPostMaxSizeInBytes             -> Get the maximal post size of a file applicated in the php.ini file
 * isElementInArray                  -> Check if a element in in a array
 * isArray                           -> Check if a array is realy a array
 * isImage                           -> Check if a file type is a image file
 * isAudio                           -> Check if a file type is a audio file
 * isVideo                           -> Check if a file type is a video file
 * isMultimedia                      -> Check if a file type is a multimedia file
 * isReal                            -> Check if a variable is not empty and is set
 * encodeUtf8                        -> Encode (cipher) a string to a utf8 string
 * decodeUtf8                        -> Decode (decipher) a string from a utf8 string
 * encodeBase64                      -> Encode (decipher) a crypt a string from a base64 crypt string
 * decodeBase64                      -> Decode (cipher) a string into a base64 crypt string
 * decodeIconV                       -> Decode (decipher) a string using iconv
 * encodeText                        -> Encode (cipher) a text
 * decodeText                        -> Decode (decipher) a text
 * countWords                        -> Count Words in a phrase
 * countItemsInArray                 -> Count the items in a array
 * getDocumentMetatagDescription     -> Get the description of a document for the metatags
 * getDocumentMetatagKeywords        -> Get generated keywords from a content document
 * checkWebLink                      -> Check if a link is a weblink
 * checkAccess                       -> Check if a usergroup can read a access level
 * cleanUrlString                    -> Clean a text from javascript code
 * cleanGBLink                       -> Clean a text from links code
 * cleanGBScript                     -> Clean a text from javascript and php code
 * cleanFilename                     -> Clean a filename
 * cleanImageFromString              -> Clean images from a string
 * cleanAllImagesFromString          -> Clean all images from a string
 * cleanHTMLforPDF                   -> Return a cleaned string for PDF output
 * cleanStringForUrlName             -> Clean a string for a url (or a lightbox) name
 * removeAccents                     -> Removes accents from a string
 * addAccents                        -> Add the accents
 * seemsUTF8                         -> Check a string if it is utf-8
 * urlConvertToSEO                   -> Convert a url link into a SEO friendly link
 * urlConvertToHTMLFormat            -> Converts a normal link into a html based link
 * urlAddSlash                       -> Convert a equal-char (=) into a slash-char (/)
 * urlAddColon                       -> Convert a equal-char (=) into a double-dot-char (:)
 * replaceSmilyTags                  -> Replace all smiley tags with the icons
 * replaceAmp                        -> Replace different chars with unicode chars
 * paf                               -> Prints a array
 * lastIndexOf                       -> The same as strrpos, except $searchThis can be a string
 * indexOf                           -> The same as strpos
 * contains                          -> Returns true if a string containing a other specific string
 * startsWith                        -> Checks if a text starts with a specific string
 * endsWith                          -> Checks if a text ends with a specific string
 * convertNewlineToHTML              -> Replaces all newlines in a string with <br /> tags
 * cutStringToLength                 -> Cut a string and append a string
 * cutLongStringToShortString        -> Cut a long strong to a short string
 * countArrayValues                  -> Count values in an array
 * createCharString                  -> Create string with chars
 * 
 * xml_readdir_content         -> return id saved in xml file
 * xml_readdir_content_without -> return id saved in xml file
 * count_submenu_xml           -> return a numer of files
 * readdir_comment             -> return all comment folders from the news folder
 * readdir_image_comment       -> return all comment folders from the image folder
 * count_subid                 -> count all xml files in an dir ( files or numbers files )
 * count_answers               -> count answers in poll
 * count_answers_sql           -> count answers in poll from sql
 * create_sort_id              -> create a sort id
 * create_sort_id_sub          -> create a sort id for subid tag (with parent as parent)
 * linkway                     -> return arrays with links for sitetitle and pathway
 * mainmenu                    -> return links for the sidemenu
 * topmenu                     -> return links for the topmenu
 * topmenuSQL                  -> return links for the topmenu (read from database)
 * get_max_id                  -> return the max id
 * get_id_array                -> return an array with all ID numbers
 * get_default_contact         -> return the default contact for the contactform
 * get_default_sql_contact     -> return the default contact for the contactform from sql db
 * split_sql                   -> return splittet sql string
 * getNewsCatAmount            -> return the amount of news in cat with the given cat uid
 * chkDefaultContact           -> return a boolean if a default contact exists
 * returnInsertCommand         -> return a command for inserting
 * 
 * </code>
 *
 */


class tcms_main {
	private $administer;
	private $globalFolder;
	private $globalSEO;
	private $urlSEO;
	private $_getLang;
	private $_tcmsConfig;
	private $_tcmsTime;
	
	// database information
	private $db_choosenDB;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $db_database;
	private $db_port;
	private $db_prefix;
	
	
	
	// -------------------------------------------------
	// CONSTRUCTORS
	// -------------------------------------------------
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $administer = 'data'
	 * @param Object $tcmsTimeObj = null
	 * @param Object $tcmsConfigObj = null
	 */
	public function __construct($administer = 'data', $tcmsTimeObj = null, $tcmsConfigObj = null) {
		$this->administer = $administer;
		$this->urlSEO = 'colon';
		
		if(!defined('_TCMS_PATH')) {
			define('_TCMS_PATH', $administer);
		}
		
		if($tcmsTimeObj == null) {
			$this->_tcmsTime = new tcms_time();
		}
		else {
			$this->_tcmsTime = $tcmsTimeObj;
		}
		
		if($tcmsConfigObj == null) {
			$this->_tcmsConfig = new tcms_configuration($administer);
		}
		else {
			$this->_tcmsConfig = $tcmsConfigObj;
		}
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	// -------------------------------------------------
	// PROPERTIES
	// -------------------------------------------------
	
	
	
	/**
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	public function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Set the tcms_config object
	 *
	 * @param Object $value
	 */
	public function setTcmsConfigObj($value) {
		$this->_tcmsConfig = $value;
	}
	
	
	
	/**
	 * Set the database information
	 *
	 * @param String $choosenDB = ''
	 */
	public function setDatabaseInfo($choosenDB = '') {
		if(file_exists(_TCMS_PATH.'/tcms_global/database.php')) {
			//include($this->administer.'/tcms_global/database.php');
			require(_TCMS_PATH.'/tcms_global/database.php');
			
			if(trim($choosenDB) == '') {
				$this->db_choosenDB = $tcms_db_engine;
			}
			else {
				$this->db_choosenDB = $choosenDB;
			}
			
			$this->db_user     = $tcms_db_user;
			$this->db_pass     = $tcms_db_password;
			$this->db_host     = $tcms_db_host;
			$this->db_database = $tcms_db_database;
			$this->db_port     = $tcms_db_port;
			$this->db_prefix   = $tcms_db_prefix;
		}
		else {
			$this->db_prefix = 'tcms_';
		}
	}
	
	
	
	/**
	 * Set the seo display art
	 *
	 * @param String $art
	 */
	public function setURLSEO($art) {
		$this->urlSEO = $art;
	}
	
	
	
	/**
	 * Set the seo settings
	 *
	 * @param String $text
	 * @param Boolean $seo
	 */
	public function setGlobalFolder($text, $seo) {
		$this->globalFolder = $text;
		$this->globalSEO = $seo;
	}
	
	
	
	/**
	 * Set the current lang settings
	 *
	 * @param String $lang
	 */
	public function setCurrentLang($lang) {
		$this->_getLang = $lang;
	}
	
	
	
	/**
	 * Set the active data stores forlder
	 *
	 * @param String $value
	 */
	public function setAdministerSite($value) {
		$this->administer = $value;
	}
	
	
	
	/**
	 * Get the current lang settings
	 *
	 * @param String $lang
	 */
	public function getCurrentLang() {
		return $this->_getLang;
	}
	
	
	
	/**
	 * Return the active data stores forlder
	 *
	 * @return String
	 */
	public function getAdministerSite() {
		return $this->administer;
	}
	
	
	
	// -------------------------------------------------
	// PRIVATE MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Get the amount of related files in a path (without directorys)
	 * 
	 * @param String $path
	 * @return Integer
	 */
	private function _getPathContentAmount($path) {
		include_once($this->administer.'/../engine/tcms_kernel/tcms_file.lib.php');
		
		$f = new tcms_file();
		return $f->getPathContentAmount($path);
	}
	
	
	
	/**
	 * Return a array of all files or directory's inside a path
	 *
	 * @param String $path
	 * @param Boolean $onlyFolders
	 * @param String $fileType = ''
	 * @return Array
	 */
	private function _getPathContent($path, $onlyFolders = false, $fileType = '', $commentFolders = false) {
		include_once($this->administer.'/../engine/tcms_kernel/tcms_file.lib.php');
		
		$f = new tcms_file();
		return $f->getPathContent($path, $onlyFolders, $fileType, $commentFolders);
	}
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Get a new uid for a specific table
	 *
	 * @param Integer $length
	 * @param String $table
	 * @return String
	 */
	public function getNewUID($length, $table) {
		if($this->db_choosenDB == 'xml') {
			while(($uid = substr(md5(microtime()), 0, $length)) 
			&& file_exists($this->administer.'/tcms_'.$table.'/'.$uid.'.xml')
			) {}
		}
		else {
			$sqlAL = new sqlAbstractionLayer(
				$this->db_choosenDB, 
				$this->_tcmsTime
			);
			
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$uid_exists = 1;
			
			do {
				$uid = substr(md5(microtime()), 0, $length);
				$sqlQR = $sqlAL->getOne($this->db_prefix.$table, $uid);
				$uid_exists = $sqlAL->getNumber($sqlQR);
			}
			while($uid_exists > 0);
			
			unset($sqlAL);
		}
		
		return $uid;
	}
	
	
	
	/**
	 * Get the amount of items from a table.
	 * [$table] can be a path.
	 *
	 * @param String $table
	 * @param String $countField = 'uid'
	 * @param String $categoryField = 'category'
	 * @param String $category = ''
	 * @return String
	 */
	public function getAmountOfItems($table, $countField = 'uid', $categoryField = 'category', $category = '') {
		if($this->db_choosenDB == 'xml') {
			return $this->_getPathContentAmount($table);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$sql = "SELECT COUNT(".$countField.") AS amount "
			."FROM ".$this->db_prefix.$table." ";
			
			if(trim($category) != '') {
				$sql .= "WHERE ".$categoryField." = '".$category."'";
			}
			
			$sqlQR = $sqlAL->query($sql);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			return $sqlObj->amount;
		}
	}
	
	
	
	/**
	 * Get a PHP setting
	 *
	 * @param String $value
	 * @param Boolean $asString = false
	 * @param Integer $returnValue = 0
	 * @return Boolean or String
	 */
	public function getPHPSetting($value, $asString = false, $returnValue = 0) {
		if($asString) {
			if(ini_get($value) == '1') {
				$r = '1';
			}
			else if(ini_get($value) == 'on') {
				$r = 'on';
			}
			else if(ini_get($value) == '0') {
				$r = '0';
			}
			else if(ini_get($value) == 'off') {
				$r = 'off';
			}
			else {
				if($returnValue == 0) {
					$r = ini_get($value);
				}
				else {
					$tmp = (ini_get($value) == '1' || ini_get($value) == 'on' ? true : false);
					
					$r = ( $tmp ? 'on' : 'off' );
				}
			}
		}
		else {
			$r = (ini_get($value) == '1' || ini_get($value) == 'on' ? true : false);
		}
		
		return $r;
	}
	
	
	
	/**
	 * Get the maximal uplaod size of a file applicated in the php.ini file
	 *
	 * @return Integer
	 */
	public function getUploadMaxSizeInBytes() {
		$upload_max_filesize = ini_get('upload_max_filesize');
		$result = 0;
		
		if(preg_match('/g/i', strtolower($upload_max_filesize))) {
			$result = (($upload_max_filesize * 1024) * 1024) * 1024;
		}
		else if(preg_match('/m/i', strtolower($upload_max_filesize))) {
			$result = ($upload_max_filesize * 1024) * 1024;
		}
		else if(preg_match('/k/i', strtolower($upload_max_filesize))) {
			$result = $upload_max_filesize * 1024;
		}
		
		return $result;
	}
	
	
	
	/**
	 * Get the maximal post size of a file applicated in the php.ini file
	 *
	 * @return Integer
	 */
	public function getPostMaxSizeInBytes() {
		$upload_max_filesize = ini_get('post_max_size');
		$result = 0;
		
		if(preg_match('/g/i', strtolower($upload_max_filesize))) {
			$result = (($upload_max_filesize * 1024) * 1024) * 1024;
		}
		else if(preg_match('/m/i', strtolower($upload_max_filesize))) {
			$result = ($upload_max_filesize * 1024) * 1024;
		}
		else if(preg_match('/k/i', strtolower($upload_max_filesize))) {
			$result = $upload_max_filesize * 1024;
		}
		
		return $result;
	}
	
	
	
	/**
	 * Get the name of a language by it's TCMS language code
	 * 
	 * @param Array $array
	 * @param String $code
	 * @return String
	 */
	public function getLanguageNameByTCMSLanguageCode($array, $code) {
		$retValue = '&nbsp;';
		
		if($this->isReal($code)) {
			foreach($array['code'] as $key => $value) {
				if($value == $code) {
					$retValue = $array['name'][$key];
				}
			}
		}
		
		return $retValue;
	}
	
	
	
	/**
	 * Get the tax (mwst) price
	 * 
	 * @param Double $price
	 * @param Integer $taxkey
	 * @return Double
	 */
	public function getTaxPrice($price, $taxkey) {
		$tmp = ($price * ($taxkey / (100 + $taxkey)));// / 100;
		//$tmp = $price * ('0.'.$taxkey);
		return round($tmp, 2);
	}
	
	
	
	/**
	 * Get the clear (netto) price
	 * 
	 * @param Double $price
	 * @param Integer $taxkey
	 * @return Double
	 */
	public function getClearPrice($price, $taxkey) {
		$tmp = ($price * 100 / (100 + $taxkey));// / 100;
		return round($tmp, 2);
	}
	
	
	
	/**
	 * Get the tax price from a clear price
	 * 
	 * @param Double $price
	 * @param Integer $taxkey
	 * @return Double
	 */
	public function getTaxPriceFromClearPrice($price, $taxkey) {
		$tmp = $price * ('0.'.$taxkey);
		return round($tmp, 2);
	}
	
	
	
	/**
	 * Get a normal string from a URL string
	 *
	 * @param String $text
	 * @return String
	 */
	public function getNormalStringFromUrlString($text) {
		$text = str_replace('-', ' ', $text);
		
		$text = $this->addAccents($text);
		
		return $text;
	}
	
	
	
	/**
	 * Set a PHP setting
	 *
	 * @param String $setting
	 * @param String $value
	 * @return Boolean
	 */
	public function setPHPSetting($setting, $value) {
		ini_set($setting, $value);
		return true;
	}
	
	
	
	/**
	 * Check if a element in in a array
	 * 
	 * @param String $element
	 * @param Array $array
	 * @param String $subDimension = ''
	 * @return Unknown
	 */
	public function isElementInArray($element, $array, $subDimension = '') {
		if(trim($subDimension) != '') {
			foreach($array as $key => $value) {
				if(trim($array[$key][$subDimension]) == trim($element)) {
					return true;
				}
			}
			
			return false;
		}
		else {
			foreach($array as $value) {
				if(trim($value) == trim($element)) {
					return true;
				}
			}
			
			return false;
		}
	}
	
	
	
	/**
	 * Check if a array is realy a array
	 *
	 * @param Array $variable
	 * @return Boolean
	 */
	public function isArray($variable) {
		if(is_array($variable) 
		&& isset($variable) 
		&& !empty($variable) 
		&& $variable != NULL) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Check if a file type is a image file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	public function isImage($type, $checkType = true) {
		if($checkType) {
			if($type == 'image/gif'
			|| $type == 'image/png'
			|| $type == 'image/jpg'
			|| $type == 'image/jpeg'
			|| $type == 'image/bmp'
			|| $type == 'image/pjpeg'
			|| $type == 'image/tiff') {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			if(preg_match('/.jpg/i', strtolower($type))
			|| preg_match('/.jpeg/i', strtolower($type))
			|| preg_match('/.jpe/i', strtolower($type))
			|| preg_match('/.png/i', strtolower($type))
			|| preg_match('/.gif/i', strtolower($type))
			|| preg_match('/.bmp/i', strtolower($type))
			|| preg_match('/.pjpeg/i', strtolower($type))) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	
	
	/**
	 * Check if a file type is a audio file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	public function isAudio($type, $checkType = true) {
		if($checkType) {
			if($type == 'audio/x-mpeg'
			|| $type == 'audio/x-wav'
			|| $type == 'audio/x-midi'
			|| $type == 'audio/mpeg'
			|| $type == 'audio/wma') {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			if(preg_match('/.mp3/i', strtolower($type))
			|| preg_match('/.wma/i', strtolower($type))
			|| preg_match('/.wav/i', strtolower($type))
			|| preg_match('/.ogg/i', strtolower($type))
			|| preg_match('/.midi/i', strtolower($type))) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	
	/**
	 * Check if a file type is a video file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	public function isVideo($type, $checkType = true) {
		if($checkType) {
			if($type == 'video/mpeg'
			|| $type == 'video/quicktime'
			|| $type == 'video/x-msvideo'
			|| $type == 'video/avi'
			|| $type == 'application/x-shockwave-flash'
			|| $type == 'video/wmv') {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			if(preg_match('/.avi/i', strtolower($type))
			|| preg_match('/.mpeg/i', strtolower($type))
			|| preg_match('/.mpg/i', strtolower($type))
			|| preg_match('/.wmv/i', strtolower($type))
			|| preg_match('/.swf/i', strtolower($type))
			|| preg_match('/.cab/i', strtolower($type))
			|| preg_match('/.qt/i', strtolower($type))
			|| preg_match('/.mov/i', strtolower($type))) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	
	/**
	 * Check if a file type is a multimedia file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	public function isMultimedia($type, $checkType = true) {
		if($checkType) {
			if($type == 'application/x-shockwave-flash') {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			if(preg_match('/.swf/i', strtolower($type))
			|| preg_match('/.cab/i', strtolower($type))) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	
	
	/**
	 * Check if a variable is not empty and is set
	 *
	 * @param unknown_type $variable
	 * @return Boolean
	 */
	public function isReal($variable) {
		if(isset($variable) 
		&& trim($variable) != '' 
		&& !empty($variable) 
		&& $variable != NULL) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Encode (cipher) a string to a utf8 string
	 *
	 * @param String $value
	 * @return String
	 */
	public function encodeUtf8($value) {
		$value = utf8_encode($value);
		
		return $value;
	}
	
	
	
	/**
	 * Decode (decipher) a string from a utf8 string
	 *
	 * @param String $value
	 * @return String
	 */
	public function decodeUtf8($value) {
		$value = utf8_decode($value);
		
		return $value;
	}
	
	
	
	/**
	 * Encode (cipher) a string to a base64 crypt string
	 *
	 * @param String $value
	 * @return String
	 */
	public function encodeBase64($value) {
		$value = base64_encode($value);
		
		return $value;
	}
	
	
	
	/**
	 * Decode (decipher) a string from a base64 crypt string
	 *
	 * @param String $value
	 * @return String
	 */
	public function decodeBase64($value) {
		$value = base64_decode($value);
		
		return $value;
	}
	
	
	
	/**
	 * Decode (decipher) a string using iconv
	 *
	 * @param String $value
	 * @param String $charset
	 * @return String
	 */
	public function decodeIconV($value, $charset = 'iso-8859-1') {
		if(extension_loaded('iconv')) {
			$arrChars = array(
				'&auml;' => '&#228;', //'�', // ae
				'&ouml;' => '&#246;', //'�', // oe
				'&uuml;' => '&#252;', //'�', // ue
				'&Auml;' => '&#196;', //'�', // Ae
				'&Ouml;' => '&#214;', //'�', // Oe
				'&Uuml;' => '&#220;', //'�', // Ue
				'&szlig;' => '&#223;', //'�' // ss
			);
			
			foreach($arrChars as $key => $val) {
				$value = str_replace(
					$key, 
					iconv($charset, 'UTF-8', $val), 
					$value
				);
			}
			
			return $value;
		}
		else {
			return $value;
		}
	}
	
	
	
	/**
	 * Encode (cipher) a text
	 *
	 * @param String $text
	 * @param String $quote
	 * @param String $charset
	 * @param Boolean $withoutEncryption = false
	 * @param Boolean $withoutDatabase = false
	 * @return String
	 */
	public function encodeText($text, $quote, $charset, $withoutEncryption = false, $withoutDatabase = false) {
		$trans = get_html_translation_table(HTML_ENTITIES);
		
		switch($quote) {
			case '1':
				//$_SET = ENT_COMPAT;
				//$tmp = htmlentities($text, $_SET, $charset);
				$trans = array_flip($trans);
				$text = strtr($text, $trans);
				break;
			
			case '2':
				$trans = array_flip($trans);
				$text = str_replace('=', '__________', $text);
				//$text = strtr($text, $trans);
				$text = $this->replaceAmp($text);
				$text = htmlentities($text, ENT_QUOTES, $charset);
				
				if(extension_loaded('mbstring')) {
					$text = mb_substr($text, 0, mb_strlen($text));
				}
				break;
			
			case '3':
				//$_SET = ENT_NOQUOTES;
				//$tmp = htmlentities($text, $_SET, $charset);
				$trans = array_flip($trans);
				$text = strtr($text, $trans);
				break;
		}
		
		if($withoutEncryption == false) {
			if($withoutDatabase == false) {
				include(_TCMS_PATH.'/tcms_global/database.php');
				
				if($tcms_db_engine == 'xml') {
					$encode = true;
				}
				else {
					$encode = false;
				}
			}
			else {
				$encode = true;
			}
			
			if($encode) {
				$text = serialize($text);
				$text = base64_encode($text);
			}
		}
		
		return $text;
	}
	
	
	
	/**
	 * Decode (decipher) a text
	 *
	 * @param String $text
	 * @param String $quote
	 * @param String $charset
	 * @param Boolean $withoutEncryption = false
	 * @param Boolean $withoutDatabase = false
	 * @return String
	 */
	public function decodeText($text, $quote, $charset, $withoutEncryption = false, $withoutDatabase = false) {
		if($withoutEncryption == false) {
			if($withoutDatabase == false) {
				include(_TCMS_PATH.'/tcms_global/database.php');
				
				if($tcms_db_engine == 'xml') {
					$encode = true;
				}
				else {
					$encode = false;
				}
			}
			else {
				$encode = true;
			}
			
			if($encode) {
				$text = base64_decode($text);
				$text = unserialize($text);
			}
		}
		
		switch($quote) {
			case '1':
				$trans = get_html_translation_table(HTML_ENTITIES);
				$text = strtr($text, $trans);
				break;
			
			case '2':
				//$trans = get_html_translation_table(HTML_ENTITIES);
				//$trans = array_flip($trans);
				
				$text = str_replace('__________', '=', $text);
				
				//////$text = strtr($text, $trans);
				//////$text = html_entity_decode($text, null, $charset);
				//////$text = htmlentities($text, null, $charset);
				
				/*$xml = new xmlparser($this->administer.'/tcms_global/var.xml', 'r');
				$lang = $xml->read_section('global', 'front_lang');
				
				$text = $this->decodeIconV(
					$text, 
					$charset
				);
				
				if(phpversion() >= '5.1.6' && $lang == 'germany_DE') {
					//echo phpversion().' >= 5.1.6';
					$text = htmlspecialchars_decode($text);
					$text = strtr($text, $trans);
				}
				else {
					//echo '< 5.1.6';
					$text = strtr($text, $trans);
				}*/
				
				
				
				
				
				/*
					testing:
					new utf8 decoding
				*/
				
				$text = $this->convertChars($text);
				
				if(phpversion() >= '5.1.0') {
					$text = htmlspecialchars_decode($text, ENT_QUOTES);
				}
				else {
					$text = strtr(
						$text, 
						array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES))
					);
				}
				
				$text = $this->decodeIconV($text, $charset);
				$text = stripslashes($text);
				
				$text = str_replace('&quot;', '"', $text);
				$text = str_replace('&#039;', "'", $text);
				break;
			
			case '3':
				$trans = get_html_translation_table(HTML_ENTITIES);
				$text = strtr($text, $trans);
				break;
		}
		
		return $text;
	}
	
	
	
	/**
	 * Encode a utf8 uri
	 *
	 * @param String $utf8_string
	 * @param Integer $length
	 * @return String
	 */
	public function encodeUtf8Uri($utf8_string, $length = 0) {
		$unicode = '';
		$values = array();
		$num_octets = 1;
	
		for ($i = 0; $i < strlen( $utf8_string ); $i++ ) {
			$value = ord( $utf8_string[ $i ] );
	
			if ( $value < 128 ) {
				if ( $length && ( strlen($unicode) + 1 > $length ) )
					break;
				$unicode .= chr($value);
			} else {
				if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;
	
				$values[] = $value;
	
				if ( $length && ( (strlen($unicode) + ($num_octets * 3)) > $length ) )
					break;
				if ( count( $values ) == $num_octets ) {
					if ($num_octets == 3) {
						$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
					} else {
						$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
					}
	
					$values = array();
					$num_octets = 1;
				}
			}
		}
	
		return $unicode;
	}
	
	
	
	/**
	 * Converter like htmlspecialchars except don't double-encode HTML entities
	 *
	 * @param String $text
	 * @param String $quotes
	 * @return String
	 */
	public function specialChars($text, $quotes = 0) {
		// Like htmlspecialchars except don't double-encode HTML entities
		$text = str_replace('&&', '&#038;&', $text);
		$text = str_replace('&&', '&#038;&', $text);
		$text = preg_replace('/&(?:$|([^#])(?![a-z1-4]{1,8};))/', '&#038;$1', $text);
		$text = str_replace('<', '&lt;', $text);
		$text = str_replace('>', '&gt;', $text);
		
		if('double' === $quotes) {
			$text = str_replace('"', '&quot;', $text);
		}
		elseif('single' === $quotes) {
			$text = str_replace("'", '&#039;', $text);
		}
		elseif($quotes) {
			$text = str_replace('"', '&quot;', $text);
			$text = str_replace("'", '&#039;', $text);
		}
		return $text;
	}
	
	
	
	/**
	 * Convert chars
	 *
	 * @param String $content
	 * @return String
	 */
	public function convertChars($content) {
		// Translation of invalid Unicode references range to valid range
		$htmltranswinuni = array(
		'&#128;' => '&#8364;', // the Euro sign
		'&#129;' => '',
		'&#130;' => '&#8218;', // these are Windows CP1252 specific characters
		'&#131;' => '&#402;',  // they would look weird on non-Windows browsers
		'&#132;' => '&#8222;',
		'&#133;' => '&#8230;',
		'&#134;' => '&#8224;',
		'&#135;' => '&#8225;',
		'&#136;' => '&#710;',
		'&#137;' => '&#8240;',
		'&#138;' => '&#352;',
		'&#139;' => '&#8249;',
		'&#140;' => '&#338;',
		'&#141;' => '',
		'&#142;' => '&#382;',
		'&#143;' => '',
		'&#144;' => '',
		'&#145;' => '&#8216;',
		'&#146;' => '&#8217;',
		'&#147;' => '&#8220;',
		'&#148;' => '&#8221;',
		'&#149;' => '&#8226;',
		'&#150;' => '&#8211;',
		'&#151;' => '&#8212;',
		'&#152;' => '&#732;',
		'&#153;' => '&#8482;',
		'&#154;' => '&#353;',
		'&#155;' => '&#8250;',
		'&#156;' => '&#339;',
		'&#157;' => '',
		'&#158;' => '',
		'&#159;' => '&#376;'
		);
		
		// Remove metadata tags
		$content = preg_replace('/<title>(.+?)<\/title>/','',$content);
		$content = preg_replace('/<category>(.+?)<\/category>/','',$content);
		
		// Converts lone & characters into &#38; (a.k.a. &amp;)
		$content = preg_replace('/&([^#])(?![a-z1-4]{1,8};)/i', '&#038;$1', $content);
		
		// Fix Word pasting
		$content = strtr($content, $htmltranswinuni);
		
		// Just a little XHTML help
		$content = str_replace('<br>', '<br />', $content);
		$content = str_replace('<hr>', '<hr />', $content);
		
		return $content;
	}
	
	
	
	/**
	 * Count Words in a phrase
	 *
	 * @param String $text
	 * @param String $wordToCount
	 * @return String
	 */
	public function countWords($text, $wordToCount = '') {
		if($wordToCount == '') {
			return str_word_count($text);
		}
		else {
			$text = strip_tags(trim($text));
			$arr = explode(' ', $text);
			$counter = 0;
			
			foreach($arr as $key => $val) {
				if(strpos(' '.$val.' ', $wordToCount)) {
					$counter++;
				}
			}
			
			return $counter;
		}
	}
	
	
	
	/**
	 * Count the items in a array
	 *
	 * @param Array $array
	 * @param Boolean $checkForDir = false
	 * @param Boolean $checkForFile = false
	 * @param String $path = ''
	 * @return Integer
	 */
	public function countItemsInArray($array, $checkForDir = false, $checkForFile = false, $path = '') {
		$count = 0;
		
		if($this->isArray($array)) {
			foreach($array as $key => $value) {
				if($checkForDir) {
					if(is_dir(trim($this->administer.'/images/Image/'.( $path == '' ? '' : $path.'/' ).$value))) {
						$count++;
					}
				}
				else if($checkForFile) {
					if($this->isImage($value, false)
					|| $this->isAudio($value, false)
					|| $this->isVideo($value, false)
					|| $this->isMultimedia($value, false)) {
						$count++;
					}
				}
				else {
					$count++;
				}
			}
		}
		
		return $count;
	}
	
	
	
	/**
	 * Get the description of a document for the metatags
	 * 
	 * @param String $text
	 * @return String
	 */
	public function getDocumentMetatagDescription($text) {
		$text = strip_tags(' - '.trim(substr($text, 0, 240)));
		$text = str_replace(chr(10), ' ', $text);
		$text = str_replace(chr(13), ' ', $text);
		$text = $this->replaceAmp($text);
		$text = htmlentities($text);
		
		return $text;
	}
	
	
	
	/**
	 * Get generated keywords from a content document
	 * 
	 * @param String $text
	 * @return String
	 */
	public function getDocumentMetatagKeywords($text) {
		// only words longer 5 letters
		// and min. existing of 2 times
		
		$words = str_word_count(strip_tags($text), 1);
		$wordarray = array();
		$countMe = array_count_values($words);
		
		while(list($key, $val) = each($countMe)) {
			if(strlen($key) >= 5 
			&& $val >= 2) {
				array_push($wordarray, $val.'.'.$key);
			}
		}
		
		arsort($wordarray);
		
		for($x = 0; $x < 9; $x++) {
			$word = split('[.]', $wordarray[$x]);
			
			if(strlen($word[1]) >= 5) {
				$test = preg_match('/^[A-Z���]*$/', trim(substr($word[1], 0, 1)));
				
				if($test == 1) {
					$dynamicKeywords = $dynamicKeywords.', '.$word[1];
				}
			}
		}
		
		return ' - '.substr($dynamicKeywords, 2);
	}
	
	
	
	/**
	 * Check if a link is a weblink
	 *
	 * @param String $link
	 * @return Boolean
	 */
	public function checkWebLink($link) {
		if(substr($link, 0, 7) == 'http://' || substr($link, 0, 6) == 'ftp://') {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Check if a usergroup can read a access level
	 *
	 * @param String $access
	 * @param String $usergroup
	 * @return Boolean
	 */
	public function checkAccess($access, $usergroup) {
		$show_this = true;
		
		if($access == 'Public') {
			$show_this = true;
		}
		elseif($access == 'Protected') {
			if($usergroup == 'User'
			|| $usergroup == 'Administrator'
			|| $usergroup == 'Developer'
			|| $usergroup == 'Editor'
			|| $usergroup == 'Presenter') {
				$show_this = true;
			}
			else {
				$show_this = false;
			}
		}
		elseif($access == 'Private') {
			if($usergroup == 'Administrator'
			|| $usergroup == 'Developer') {
				$show_this = true;
			}
			else {
				$show_this = false;
			}
		}
		
		return $show_this;
	}
	
	
	
	/**
	 * Clean a url from javascript code
	 *
	 * @param String $text
	 * @param Boolean $withHtmlEntities = false
	 * @return String
	 */
	public function cleanUrlString($text, $withHtmlEntities = false) {
		$text = $this->cleanGBScript($text);
		
		$text = preg_replace("'/<script[^>]*>/i.*?/</script>/gi'", '', $text);
		$text = preg_replace('/{.+?}/', '', $text);
		
		if($withHtmlEntities)
			$text = htmlentities($text);
		
		return $text;
	}
	
	
	
	/**
	 * Clean a text from links code
	 *
	 * @param String $text
	 * @return String
	 */
	public function cleanGBLink($text) {
		$text = preg_replace("'<a[^>]*>'", '', $text);
		$text = preg_replace("'</a>'", '', $text);
		
		return $text;
	}
	
	
	
	/**
	 * Clean a text from javascript and php code
	 *
	 * @param String $text
	 * @return String
	 */
	public function cleanGBScript($text) {
		$text = preg_replace("'/<script[^>]*>/i.*?/</script>/gi'", '', $text);
		$text = preg_replace("'<?php*.*?\?>'", '', $text);
		$text = str_replace('<?', '', $text);
		$text = str_replace('?>', '', $text);
		$text = preg_replace('/{.+?}/', '', $text);
		$text = preg_replace('/{.+?}/', '', $text);
		$text = preg_replace("'<script[^>]*>.*?</script>'", '', $text);
    	$text = strip_tags($text);
		
		return $text;
	}
	
	
	
	/**
	 * Clean a filename
	 *
	 * @param String $file
	 * @return String
	 */
	public function cleanFilename($file) {
		$file = preg_replace("'<script[^>]*>.*?</script>'", '', $file);
		$file = preg_replace("'<?php*.*?\?>'", '', $file);
		$file = str_replace('<?', '', $file);
		$file = str_replace('?>', '', $file);
		$file = str_replace(' ', '_', $file);
		$file = str_replace('&nbsp;', '_', $file);
		$file = preg_replace('/{.+?}/', '', $file);
    	$file = strip_tags($file);
		
		return $file;
	}
	
	
	
	/**
	 * Clean a string from images
	 *
	 * @param String $string
	 * @return String
	 */
	public function cleanImageFromString($string) {
		if(strpos($string, '<img')) {
			$str3 = '';
			$offset = 0;
			
			$pos1 = strpos($string, '<img', $offset);
			$pos2 = strpos($string, ' />', $pos1) + 3;
			
			//$len = strlen(substr($str4, $pos1, $pos2));
			
			$str1 = substr($string, $offset, $pos1);
			$str2 = substr($string, $pos2);
			
			$str3 .= $str1.$str2;
			
			if($str3 != '') $string = $str3;
		}
		
		return $string;
	}
	
	
	
	/**
	 * Clean all images from a string
	 *
	 * @param String $string
	 * @return String
	 */
	public function cleanAllImagesFromString($string) {
		if(strpos($string, '<img')) {
			while(strpos($string, '<img')) {
				$string = $this->cleanImageFromString($string);
			}
		}
		
		return $string;
	}
	
	
	
	/**
	 * Return a cleaned string for PDF output
	 * 
	 * @param String $string
	 * @return String
	 */
	public function cleanHTMLforPDF($string) {
		$string = str_replace('<p>', "\n\n" , $string);
		$string = str_replace('<P>', "\n\n" , $string);
		$string = str_replace('<br />', "\n" , $string);
		$string = str_replace('<br>', "\n" , $string);
		$string = str_replace('<BR />', "\n" , $string);
		$string = str_replace('<BR>', "\n" , $string);
		$string = str_replace('<li>', "\n - " , $string);
		$string = str_replace('<LI>', "\n - " , $string);
		$string = str_replace('&bull;', "??" , $string);
		$string = str_replace('& #039;', "'" , $string);
		$string = str_replace('& ldquo;', "\"" , $string);
		$string = str_replace('& euro;', "??" , $string);
		$string = str_replace('& rdquo;', "\"" , $string);
		$string = str_replace('& quot;', "\"" , $string);
		$string = str_replace('& rsquo;', "'" , $string);
		
		$string = strip_tags($string);
		$string = trim($string);
		
		return $string;
	}
	
	
	
	/**
	 * Clean a string for a url (or a lightbox) name
	 *
	 * @param String $text
	 * @param Boolean $withHtmlEntities = false
	 * @return String
	 */
	public function cleanStringForUrlName($text) {
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans = array_flip($trans);
		
		$text = strtr($text, $trans);
		//$text = html_entity_decode($text, null, $charset);
		//$text = htmlentities($text, null, $this->);
		
		if(phpversion() >= '5.1.0') {
			$text = htmlspecialchars_decode($text);
		}
		else {
			$text = strtr(
				$text, 
				array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES))
			);
		}
		
		for($i = 160; $i < 256; $i++) {
			//$text = str_replace('&#'.$i.';', '', $text);
			$text = str_replace('&#'.$i.';', ' ', $text);
		}
		
	    $text = str_replace('&#034;', '-', $text); // ??? \'
	    $text = str_replace('&#038;', '-', $text); // ??? \'
	    $text = str_replace('&#039;', '-', $text); // ??? \'
	    $text = str_replace('&#060;', '-', $text); // ??? \'
	    $text = str_replace('&#062;', '-', $text); // ??? \'
	    
		$text = str_replace('&euro;', '', $text);
		
		//$text = str_replace('"', '&quot;', $text);
		//$text = str_replace("'", '&#039;', $text);
		//$text = str_replace('<', '&lt;', $text);
		//$text = str_replace('>', '&gt;', $text);
		
		$text = $this->cleanGBScript($text);
		
		$text = strtolower($text);
		
		//$text = str_replace('&&', '&#038;&', $text);
		//$text = str_replace('&&', '&#038;&', $text);
		//$text = preg_replace('/&(?:$|([^#])(?![a-z1-4]{1,8};))/', '&#038;$1', $text);
		$text = str_replace('&&', '', $text);
		$text = str_replace('&', '', $text);
		$text = preg_replace('/&(?:$|([^#])(?![a-z1-4]{1,8};))/', '$1', $text);
		
		$text = str_replace('<', '', $text);
		$text = str_replace('>', '', $text);
		$text = str_replace('"', '', $text);
    	$text = str_replace('?', '', $text);
		$text = str_replace('!', '', $text);
		$text = str_replace(';', '', $text);
		$text = str_replace('$', '', $text);
		$text = str_replace('�', '', $text);
		$text = str_replace('%', '', $text);
		//$text = str_replace('/', '', $text);
		//$text = str_replace('(', '', $text);
		//$text = str_replace(')', '', $text);
		//$text = str_replace('\\', '', $text);
		$text = str_replace('[', '', $text);
		$text = str_replace(']', '', $text);
		$text = str_replace('{', '', $text);
		$text = str_replace('}', '', $text);
		//$text = str_replace('`', '', $text);
		//$text = str_replace('*', '', $text);
		//$text = str_replace('+', '', $text);
    	//$text = str_replace('&nbsp;-&nbsp;', '', $text);
		//$text = str_replace(' - ', '', $text);
		$text = str_replace('#', '', $text);
		//$text = str_replace('^', '', $text);
		//$text = str_replace(':', '', $text);
		//$text = str_replace(';', '', $text);
		$text = str_replace(',', '', $text);
		//$text = str_replace('_', '', $text);
		$text = str_replace('@', '', $text);
	    
	    $text = str_replace('...', '', $text);
	    $text = str_replace('..', '', $text);
	    $text = str_replace('... ', '', $text);
	    $text = str_replace('.. ', '', $text);
	    $text = str_replace('. ', '', $text);
	    $text = str_replace('...&nbsp;', '', $text);
	    $text = str_replace('..&nbsp;', '', $text);
	    $text = str_replace('.&nbsp;', '', $text);
	    //$text = str_replace('.', '', $text);
	    
		$text = str_replace("'", '-', $text); // ??? \'
		$text = str_replace('&#039;', '-', $text); // ??? \'
		$text = str_replace('&039;', '-', $text); // ??? \'
		
		$text = trim($text);
		
		$text = $this->removeAccents($text);
		
		$text = htmlentities($text);
		
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('&nbsp;&nbsp;', ' ', $text);
		$text = str_replace('          ', ' ', $text);
		$text = str_replace('         ', ' ', $text);
		$text = str_replace('        ', ' ', $text);
		$text = str_replace('       ', ' ', $text);
		$text = str_replace('      ', ' ', $text);
		$text = str_replace('     ', ' ', $text);
		$text = str_replace('    ', ' ', $text);
		$text = str_replace('   ', ' ', $text);
		$text = str_replace('  ', ' ', $text);
		
		$text = str_replace('&nbsp;', '-', $text);
		$text = str_replace(' ', '-', $text);
    	
	    $text = str_replace('-----', '-', $text);
	    $text = str_replace('----', '-', $text);
	    $text = str_replace('---', '-', $text);
	    $text = str_replace('--', '-', $text);
		
		return $text;
	}
	
	
	/**
	 * Removes accents from a string
	 * (by Wordpress Team)
	 *
	 * @param String $string
	 * @return String
	 */
	public function removeAccents($string) {
		if(!preg_match('/[\x80-\xff]/', $string)) {
			return $string;
		}
		
		if($this->seemsUTF8($string)) {
			$chars = array(
			// Decompositions for Latin-1 Supplement
			chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
			chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
			chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
			chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
			chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
			chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
			chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
			chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
			chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
			chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
			chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
			chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
			chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
			chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
			chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
			chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
			chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
			chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
			chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
			chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
			chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
			chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
			chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
			chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
			chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
			chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
			chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
			chr(195).chr(191) => 'y',
			// Decompositions for Latin Extended-A
			chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
			chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
			chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
			chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
			chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
			chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
			chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
			chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
			chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
			chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
			chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
			chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
			chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
			chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
			chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
			chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
			chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
			chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
			chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
			chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
			chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
			chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
			chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
			chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
			chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
			chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
			chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
			chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
			chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
			chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
			chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
			chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
			chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
			chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
			chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
			chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
			chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
			chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
			chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
			chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
			chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
			chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
			chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
			chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
			chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
			chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
			chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
			chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
			chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
			chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
			chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
			chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
			chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
			chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
			chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
			chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
			chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
			chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
			chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
			chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
			chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
			chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
			chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
			chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
			// Euro Sign
			chr(226).chr(130).chr(172) => 'E',
			// GBP (Pound) Sign
			chr(194).chr(163) => '');
			
			$string = strtr($string, $chars);
		}
		else {
			$asci_chars['in'] = array(
				chr(228), 
				chr(246), 
				chr(252)
			);
			
			$asci_chars['out'] = array(
				'ae', 
				'oe', 
				'ue'
			);
			
			//$string = str_replace($asci_chars['in'], $asci_chars['out'], $string);
			
			// Assume ISO-8859-1 if not UTF-8
			$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
			.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
			.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
			.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
			.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
			.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
			.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
			.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
			.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
			.chr(252).chr(253).chr(255);
			
			//$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";
			$chars['out'] = "                                                                 ";
			
			$string = strtr($string, $chars['in'], $chars['out']);
			
			$double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
			//$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
			$double_chars['out'] = array('', '', '', '', '', '', '', '', '');
			
			$string = str_replace($double_chars['in'], $double_chars['out'], $string);
		}
		
		return $string;
	}
	
	
	
	/**
	 * Add the accents
	 *
	 * @param String $string
	 * @return String
	 */
	public function addAccents($string) {
		// Assume ISO-8859-1 if not UTF-8
		/*$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
		.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
		.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
		.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
		.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
		.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
		.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
		.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
		.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
		.chr(252).chr(253).chr(255);
		
		$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

		$string = strtr($string, $chars['out'], $chars['in']);
		
		$double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
		$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
		
		$string = str_replace($double_chars['out'], $double_chars['in'], $string);
		
		return $string;*/
		
		$asci_chars['in'] = array(
			'ae', 
			'oe', 
			'ue'
		);
		
		$asci_chars['out'] = array(
			'&auml;', 
			'&ouml;', 
			'&uuml;'
		);
		
		//$string = str_replace($asci_chars['in'], $asci_chars['out'], $string);
	    
	    $string = str_replace('%E2%80%99', '\\\'', $string);
	    $string = str_replace('�', '\\\'', $string);
		
		return $string;
	}
	
	
	
	/**
	 * Check a string if it is utf-8
	 *
	 * @param String $Str
	 * @return String
	 */
	public function seemsUTF8($Str) {
		// by bmorel at ssi dot fr
		for($i = 0; $i < strlen($Str); $i++) {
			if(ord($Str[$i]) < 0x80) {
				continue; // 0bbbbbbb
			}
			elseif((ord($Str[$i]) & 0xE0) == 0xC0) {
				$n = 1; // 110bbbbb
			}
			elseif((ord($Str[$i]) & 0xF0) == 0xE0) {
				$n = 2; // 1110bbbb
			}
			elseif((ord($Str[$i]) & 0xF8) == 0xF0) {
				$n = 3; // 11110bbb
			}
			elseif((ord($Str[$i]) & 0xFC) == 0xF8) {
				$n = 4; // 111110bb
			}
			elseif((ord($Str[$i]) & 0xFE) == 0xFC) {
				$n = 5; // 1111110b
			}
			else {
				return false; // Does not match any model
			}
			
			for($j = 0; $j < $n; $j++) {
				// n bytes matching 10bbbbbb follow ?
				if((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) {
					return false;
				}
			}
		}
		
		return true;
	}
	
	
	
	/**
	 * Convert a url link into a SEO friendly link
	 * 
	 * @param String $text
	 * @param Boolean $withAmpersant = true
	 * @param Boolean $onlyDefaultLanguage = false
	 */
	public function urlConvertToSEO($text, $withAmpersant = true, $onlyDefaultLanguage = false) {
		$text = str_replace('&#', '*-*', $text);
		
		if($withAmpersant) {
			$text = preg_replace('|&(?![\w]+;)|', '&amp;', $text);
			$text = str_replace('&amp;amp;', '&amp;', $text);
		}
		
		$text = str_replace('*-*', '&#', $text);
		
		if($this->globalSEO == 1) {
			if($this->urlSEO == 'colon' 
			|| $this->urlSEO == 'slash') {
				// id -> section
				$text = str_replace('id=', 'section=', $text);
				
				// s -> template
				$text = str_replace('?s=', '?template=', $text);
				$text = str_replace('&amp;s=', '&amp;template=', $text);
				$text = str_replace('&s=', '&template=', $text);
				
				// cmd -> command
				$text = str_replace('&amp;cmd=', '&amp;command=', $text);
				$text = str_replace('&cmd=', '&command=', $text);
				
				// u -> user
				$text = str_replace('&amp;u=', '&amp;user=', $text);
				$text = str_replace('&u=', '&user=', $text);
				
				// current_pollall -> poll
				$text = str_replace('&amp;current_pollall=', '&amp;poll=', $text);
				$text = str_replace('&current_pollall=', '&poll=', $text);
				
				// cat -> category
				//$text = str_replace('&amp;cat=', '&amp;category=', $text);
				//$text = str_replace('&cat=', '&category=', $text);
				
				// main replace
				//$text = str_replace('?', 'index.php/', $text);
				$text = str_replace('?', '/'.$this->globalFolder.'/index.php/', $text);
				$text = str_replace('&amp;', '/', $text);
				$text = str_replace('&', '/', $text);
				
				if($this->urlSEO == 'colon') {
					$text = $this->urlAddColon($text);
				}
				else if($this->urlSEO == 'slash') {
					$text = $this->urlAddSlash($text);
				}
			}
			else {
				//echo '<span style="color:#fff;">url-vorher:'.$text.'</span><br>';
				
				$text = $this->encodeUtf8Uri($text);
				
				$text = $this->urlConvertToHTMLFormat(
					$text, 
					( $this->urlSEO == 'html' || $this->urlSEO == 2 ? true : false ), 
					$onlyDefaultLanguage
				);
				
				//echo '<span style="color:#fff;">url-nachher:'.$text.'</span><br><br>';
			}
		}
		 
		return $text;
	}
	
	
	
	/**
	 * Converts a normal link into a html based link
	 * 
	 * @param String $text
	 * @param Boolean $withIndexPHP = true
	 * @param Boolean $onlyDefaultLanguage = false
	 * @return String
	 */
	public function urlConvertToHTMLFormat($text, $withIndexPHP = true, $onlyDefaultLanguage = false) {
		//echo $text.'<br>';
		
		$arr_url = explode('&amp;', $text);
		
		$text_copy = $text;
		$text = '';
		$ret = '';
		$lang = '';
		$template = '';
		$add = '';
		$encodeMore = false;
		
		if($withIndexPHP) {
			$indexPHP = 'index.php/';
		}
		else {
			$indexPHP = '';
		}
		
		foreach($arr_url as $key => $val) {
			//echo '<span style="color:#fff;">'.$val.'</span><br>';
			$val = str_replace($this->globalFolder.'/index.php?id=', '', $val);
			
			//echo '<span style="color:#fff;">'.$val.'</span><br>';
			
			if($val == 'id=frontpage' || substr($val, 1) == 'id=frontpage') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'startseite.html'; break;
					case 'english_EN': $text = 'frontpage.html'; break;
					default:  $text = 'frontpage.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=newsmanager' || substr($val, 1) == 'id=newsmanager') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'neuigkeiten.html'; break;
					case 'english_EN': $text = 'news.html'; break;
					default:  $text = 'news.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=download' || substr($val, 1) == 'id=download') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'download.html'; break;
					case 'english_EN': $text = 'download.html'; break;
					default:  $text = 'download.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=contactform' || substr($val, 1) == 'id=contactform') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'kontakt.html'; break;
					case 'english_EN': $text = 'contact.html'; break;
					default:  $text = 'contact.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=register' || substr($val, 1) == 'id=register') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'anmeldung.html'; break;
					case 'english_EN': $text = 'register.html'; break;
					default:  $text = 'register.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=profile' || substr($val, 1) == 'id=profile') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'profil.html'; break;
					case 'english_EN': $text = 'profile.html'; break;
					default:  $text = 'profile.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=polls' || substr($val, 1) == 'id=polls') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'umfragen.html'; break;
					case 'english_EN': $text = 'polls.html'; break;
					default:  $text = 'polls.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=imprint' || substr($val, 1) == 'id=imprint') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'impressum.html'; break;
					case 'english_EN': $text = 'imprint.html'; break;
					default:  $text = 'imprint.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=imagegallery' || substr($val, 1) == 'id=imagegallery') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'galerie.html'; break;
					case 'english_EN': $text = 'gallery.html'; break;
					default:  $text = 'gallery.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=guestbook' || substr($val, 1) == 'id=guestbook') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'gaestebuch.html'; break;
					case 'english_EN': $text = 'guestbook.html'; break;
					default:  $text = 'guestbook.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=knowledgebase' || substr($val, 1) == 'id=knowledgebase') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'artikel.html'; break;
					case 'english_EN': $text = 'articles.html'; break;
					default:  $text = 'articles.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=products' || substr($val, 1) == 'id=products') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'produkte.html'; break;
					case 'english_EN': $text = 'products.html'; break;
					default:  $text = 'products.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=search' || substr($val, 1) == 'id=search') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'suche.html'; break;
					case 'english_EN': $text = 'search.html'; break;
					default:  $text = 'search.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=links' || substr($val, 1) == 'id=links') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'links.html'; break;
					case 'english_EN': $text = 'links.html'; break;
					default:  $text = 'links.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=sitemap' || substr($val, 1) == 'id=sitemap') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				
				switch($this->_tcmsConfig->getLanguageFrontend()) {
					case 'germany_DE': $text = 'sitemap.html'; break;
					case 'english_EN': $text = 'sitemap.html'; break;
					default:  $text = 'sitemap.html'; break;
				}
				
				$encodeMore = true;
			}
			else if($val == 'id=components' || substr($val, 1) == 'id=components') {
				$ret = $this->globalFolder.'/'.$indexPHP;
				$text = 'cs.html';
				
				$encodeMore = true;
			}
			else if(substr($val, 0, 3) == 'id=' || substr($val, 1, 3) == 'id=') {
				if(trim($text) == '') {
					$ret = $this->globalFolder.'/'.$indexPHP;
					
					$val = substr($val, strpos($val, 'id=') + 3);
					
					if($this->_tcmsConfig->getSEOOptionContentTitle()) {
						$dcp = new tcms_datacontainer_provider(
							$this->administer, 
							$this->_tcmsConfig->getCharset(), 
							$this->_tcmsTime
						);
						
						if($onlyDefaultLanguage) {
							$lang = $this->_tcmsConfig->getLanguageCodeByTCMSCode(
								$this->_tcmsConfig->getLanguageFrontend()
							);
						}
						else {
							$lang = $this->_getLang;
						}
						
						$val = $dcp->getContentTitle(
							$val, 
							$lang
						);
						unset($dcp);
						
						$val = $this->cleanStringForUrlName($val);
					}
					
					$text = $val.'.html';
					
					$encodeMore = true;
				}
			}
			/*
				language
			*/
			else if(substr($val, 0, 5) == 'lang=') {
				if($encodeMore) {
					$lang = substr($val, strpos($val, 'lang=') + 5).'/';
				}
				else {
					$add .= '&amp;'.$val;
				}
			}
			/*
				template
			*/
			else if(substr($val, 0, 2) == 's=') {
				if($encodeMore) {
					$template = substr($val, strpos($val, 's=') + 2).'/';
				}
				else {
					$add .= '&amp;'.$val;
				}
			}
			/*
				session
			*/
			else if(substr($val, 0, 7) == 'session') {
				$add .= '&amp;'.$val;
			}
			else if(substr($val, 0, 8) == '?session') {
				$add .= $val;
			}
			/*
				rest of the params
			*/
			else {
				if(substr($val, 0, 2) != 's=') {
					/*
						news
					*/
					if(substr($val, 0, 4) == 'news' 
					&& $this->_tcmsConfig->getSEOOptionNewsTitle()) {
						if(trim($add) == '') {
							switch($this->_tcmsConfig->getLanguageFrontend()) {
								case 'germany_DE':
									$text = str_replace('neuigkeiten.html', 'neuigkeiten/', $text);
									break;
								
								case 'english_EN':
									$text = str_replace('news.html', 'news/', $text);
									break;
								
								default:
									$text = str_replace('news.html', 'news/', $text);
									break;
							}
							
							$val = substr($val, strpos($val, 'news=') + 5);
							
							$dcp = new tcms_datacontainer_provider(
								$this->administer, 
								$this->_tcmsConfig->getCharset(), 
								$this->_tcmsTime
							);
							$val = $dcp->getNewsTitle($val, $this->_getLang);
							unset($dcp);
							
							$val = $this->cleanStringForUrlName($val);
							
							$add .= $val.'.html';
						}
						else {
							$add .= '&amp;'.$val;
						}
					}
					else {
						if(trim($add) == '') {
							$add .= '?'.$val;
						}
						else {
							$add .= '&amp;'.$val;
						}
					}
				}
			}
		}
		
		//echo '<span style="color:#fff;"><b>url:'.$text.'</b></span><br>';
		
		if(trim($text) != '') {
			$ret = $ret.$lang.$template.$text.$add;
		}
		else {
			$ret = str_replace('?', $this->globalFolder.'/index.php?', $text_copy);
		}
		
		if($this->globalFolder != '') {
			$ret = '/'.$ret;
		}
		
		//echo '<span style="color:#000;"><b>url:'.$ret.'</b></span><br>';
		//echo '<span style="color:#fff;"><b>url:'.$ret.$lang.$text.$add.'</b></span><br><br>';
		
		return $ret;
	}
	
	
	
	/**
	 * Convert a equal-char (=) into a slash (/)
	 * 
	 * @param String $text
	 */
	public function urlAddSlash($text) {
		$text = str_replace('=', '/', $text);
		 
		return $text;
	}
	
	
	
	/**
	 * Convert a equal-char (=) into a colon-char (:)
	 * 
	 * @param String $text
	 */
	public function urlAddColon($text) {
		$text = str_replace('=', ':', $text);
		 
		return $text;
	}
	
	
	
	/**
	 * Replace all smiley tags with the icons
	 * 
	 * @param String $msg
	 * @param String $imagePath
	 * @return String
	 */
	public function replaceSmilyTags($msg, $imagePath) {
		$msg = str_replace(';-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_wink.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' ;) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_wink.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_smile.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_smile.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-D', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_laughing.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :D ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_laughing.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-O', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_yell.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':O', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_yell.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-o', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_surprised.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':o', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_surprised.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-(', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sad.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :( ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sad.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-P', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :P ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':-p', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :p ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-S', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_undecided.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :S ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_undecided.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('B-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cool.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' B) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cool.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-|', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_neutral.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':|', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_neutral.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-e', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cry.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :e ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cry.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('%(|)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_lol.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-/', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sceptic.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' :/ ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sceptic.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('%-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_confused.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(' >:) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' >) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(' >: ) ', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		
		return $msg;
	}
	
	
	
	/**
	 * Replace different chars with unicode chars
	 * 
	 * @param String $text
	 * @return String
	 */
	public function replaceAmp($text) {
		$text = stripslashes($text);
		
		//$text = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $text);
		//$text = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $text);
		
		//$text = str_replace( '&#', '*-*', $text );
		//$text = preg_replace( '|&(?![\w]+;)|', '&amp;', $text );
		//$text = str_replace("'", '&#8216;', $text );
		//$text = str_replace('"', '&#34;', $text );
		$text = str_replace('&amp;amp;', '&amp;', $text );
		$text = str_replace(chr(92), '&#92;', $text );
		$text = str_replace("'", "\'", $text );
		//$text = str_replace( '*-*', '&#', $text );
		
		return $text;
	}
	
	
	
	/**
	 * Prints a array
	 */
	public function paf($array) {
		echo '<span style="font-size: 12px;"><pre>';
		print_r($array);
		echo '</pre></span>';
	}
	
	
	
	/**
	 * The same as strrpos, except $searchThis can be a string
	 * 
	 * @param String $findHere
	 * @param  String $searchThis
	 * @param Integer $offset
	 * @return Integer (The index of the last position of a expression)
	 */
	public function lastIndexOf($findHere, $searchThis, $offset = 0) {
		$strrpos = false;
		
		if(is_string($findHere) 
		&& is_string($searchThis) 
		&& is_numeric($offset)) {
			$strlen = strlen($findHere);
			$strpos = strpos(strrev(substr($findHere, $offset)), strrev($searchThis));
			
			if(is_numeric($strpos)) {
				$strrpos = $strlen - $strpos - strlen($searchThis);
			}
		}
		
		return $strrpos;
	}
	
	
	
	/**
	 * The same as strpos
	 * 
	 * @param String $findHere
	 * @param String $searchThis
	 * @param Integer $offset
	 * @return Integer
	 */
	public function indexOf($findHere, $searchThis, $offset = 0) {
		return strpos($findHere, $searchThis, $offset);
	}
	
	
	
	/**
	 * Returns true if a string containing a other specific string
	 * 
	 * @param String $findHere
	 * @param String $searchThis
	 * @return Integer
	 */
	public function contains($findHere, $searchThis) {
		$pos = strpos($findHere, $searchThis);
		
		if(is_numeric($pos)
		&& $pos > -1) {
			return true;
		}
		
		return false;
	}
	
	
	
	/**
	 * Checks if a text starts with a specific string
	 * 
	 * @param String $startString
	 * @param String $findHere
	 * @return Boolean
	 */
	public function startsWith($startString, $findHere) {
		if(@substr(trim($findHere), 0, @strlen(trim($startString))) == trim($startString)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Checks if a text ends with a specific string
	 * 
	 * @param String $startString
	 * @param String $findHere
	 * @return Boolean
	 */
	public function endsWith($endString, $findHere) {
		if(strlen($endString) < strlen($findHere)) {
			/*
			echo 'len:'.$findHere.'=='.strlen($findHere).'<br>';
			echo 'lp:'.strlen($endString).'<br>';
			echo 'tag-len:'.(strlen($findHere) - strlen($endString)).'<br>';
			echo '==>'.htmlentities(substr(trim($findHere), (strlen($findHere) - strlen($endString)))).'<br>';
			echo '==>'.htmlentities($endString).'<br>';
			echo '<br><br>';
			*/
			if(@substr(trim($findHere), @strlen($findHere) - @strlen($endString)) == trim($endString)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Replaces all newlines in a stzring with <br /> tags
	 * 
	 * @param String $text
	 * @return String
	 */
	public function convertNewlineToHTML($text) {
		return nl2br($text);
		
		/*$pee = $text;
		
		$pee = $pee . "\n"; // just to make things a little easier, pad the end
		$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
		$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
		$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
		$pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
		$pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
		$pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
		$pee = preg_replace( '|<p>|', "$1<p>", $pee );
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
		
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		if (strpos($pee, '<pre') !== false)
		$pee = preg_replace_callback('!(<pre.*?>)(.*?)</pre>!is', 'clean_pre', $pee );
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
		
		return $pee;*/
	}
	
	
	
	/**
	 * Cut a string and append a string
	 * 
	 * @param String $text
	 * @param Integer $length = 15
	 * @param String $appendString = ''
	 * @return String
	 */
	public function cutStringToLength($text, $length = 15, $appendString = '') {
		return ( strlen($text) > $length ? substr($text, 0, $length).$appendString : $text );
	}
	
	
	
	/**
	 * Cut a long strong to a short string
	 *
	 * @param String $text
	 * @param Integer $length
	 * @return String
	 */
	public function cutLongStringToShortString($text, $length = 50) {
		return ( strlen($text) > $length 
			? substr($text, 0, (($length / 2) - 3)).'...' .substr($text, strlen($text) - (($length / 2) - 3))
			: $text 
		);
	}
	
	
	
	/**
	 * Count values in an array
	 * 
	 * @param Array $array
	 * @param Boolean $withReduce = true
	 * @return Integer
	 */
	public function countArrayValues($array, $withReduce = true) {
		$count = 0;
		
		if($this->isArray($array)) {
			foreach($array as $item) {//$key => $val) {
				$count++;
			}
		}
		
		return $count - ( $withReduce ? 1 : 0 );
	}
	
	
	
	/**
	 * Create string with chars
	 *
	 * @param Integer $amount
	 * @param Char $char = ' '
	 * @return String
	 */
	public function createCharString($amount, $char = ' ') {
		$res = '';
		
		for($i = 0; $i <= $amount; $i++) {
			$res .= $char;
		}
		
		return $res;
	}
	
	
	
	/*
		toendaCMS system class
		
		- in recoding -
	*/
	
	
	
	/***
	* @return unknown
	* @desc Loads from "$path" the content from order-no. "$look4"
	*/
	public function xml_readdir_content($look4, $path, $tag, $parenttag, $len) {
		$handle = opendir($path);
		$i = 0;
		while ($files = readdir ($handle)) {
			$del_files[$i] = substr($files, 0, 4);
			if ($files != '.' 
			&& $files != '..' 
			&& $del_files[$i] != 'del_' 
			&& $files != 'CVS'
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html') {
				$all_xml = new xmlparser($path.$files,'r');
				$check_id = $all_xml->read_section($parenttag, $tag);
				
				if($look4 == $check_id) {
					$id = substr($files, 0, $len);
					break;
				}
				$i++;
			}
		}
		return ( isset($id) ? $id : '' );
	}
	
	
	
	/***
	* @return unknown
	* @desc Loads from "$path" the content from order-no. "$zahl"
	*/
	public function xml_readdir_content_without($look4, $without,  $path, $tag, $tag2, $parenttag, $len) {
		$handle = opendir($path);
		$i = 0;
		while ($files = readdir ($handle)) {
			$del_files[$i] = substr($files, 0, 4);
			if ($files != '.' 
			&& $files != '..' 
			&& $del_files[$i] != 'del_' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html') {
				$all_xml = new xmlparser($path.$files,'r');
				$check_id  = $all_xml->read_section($parenttag, $tag);
				$check_sub = $all_xml->read_section($parenttag, $tag2);
				
				if($look4 == $check_id) {
					if($check_sub != $without) {
						$id = substr($files, 0, $len);
						break;
					}
				}
				$i++;
			}
		}
		return ( isset($id) ? $id : '' );
	}
	
	
	
	/***
	* @return unknown
	* @desc Loads from "$path" the content from order-no. "$zahl"
	*/
	public function count_submenu_xml($look4, $without,  $path, $tag, $tag2, $parenttag, $len) {
		$handle = opendir($path);
		$i = 0;
		while ($files = readdir ($handle)) {
			$del_files[$i] = substr($files, 0, 4);
			if ($files != '.' 
			&& $files != '..' 
			&& $del_files[$i] != 'del_' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html') {
				$all_xml = new xmlparser($path.$files,'r');
				$check_id  = $all_xml->read_section($parenttag, $tag);
				$check_sub = $all_xml->read_section($parenttag, $tag2);
				
				if($check_sub != $without) {
					if($look4 == $check_id) {
						$i++;
					}
				}
			}
		}
		return ( isset($i) ? $i : '' );
	}
	
	
	
	/***
	* @return Array with files from directory
	* @desc Return a array with the files in "path"
	*/
	public function readdir_comment($path) {
		$handle = opendir($path);
		$i = 0;
		
		while($dir = readdir($handle)) {
			if($dir != '.' 
			&& $dir != '..' 
			&& $dir != 'CVS' 
			&& $dir != '.svn'
			&& $dir != '_svn'
			&& $dir != '.SVN'
			&& $dir != '_SVN'
			&& $dir != 'index.html') {
				if(substr($dir, 0, 9) == 'comments_') {
					$arr_dirContent[$i] = $dir;
					$i++;
				}
			}
		}
		
		return (
			isset($arr_dirContent) && $arr_dirContent != '' && !empty($arr_dirContent) 
			? $arr_dirContent 
			: NULL
		);
	}
	
	
	
	/***
	* @return Array with files from directory
	* @desc Return a array with the files in "path"
	*/
	public function readdir_image_comment($path, $cmd) {
		$handle = opendir($path);
		$i = 0;
		
		while($dir = readdir($handle)) {
			if($dir != '.' 
			&& $dir != '..' 
			&& $dir != 'CVS' 
			&& $dir != '.svn'
			&& $dir != '_svn'
			&& $dir != '.SVN'
			&& $dir != '_SVN'
			&& $dir != 'index.html') {
				$arrThis = $this->readdir_comment($path.$dir.'/');
				
				if(is_array($arrThis)) {
					foreach($arrThis as $key => $val) {
						$arr_dirContent[$i] = $val;
						$arr_dirAlbum[$i] = $dir;
						$i++;
					}
				}
				
			}
		}
		
		if($cmd == 'image') {
			return (
				isset($arr_dirContent) && $arr_dirContent != '' && !empty($arr_dirContent) 
				? $arr_dirContent 
				: NULL
			);
		}
		else {
			return (
				isset($arr_dirAlbum) && $arr_dirAlbum != '' && !empty($arr_dirAlbum) 
				? $arr_dirAlbum 
				: NULL
			);
		}
	}
	
	
	
	/***
	* @return READ A DIR AND RETURN THE XML FILES OR THE NUMBER
	* @desc Return a array with the files in "path" (only .xml)
	*/
	public function count_subid($path, $search_id, $file_or_number) {
		$handle = opendir($path);
		$i = 0;
		if(!isset($s)) { $s = 0; }
		
		while ($directories = readdir ($handle)) {
			if ($directories != '.' 
			&& $directories != '..' 
			&& $directories != 'CVS' 
			&& $directories != '.svn'
			&& $directories != '_svn'
			&& $directories != '.SVN'
			&& $directories != '_SVN'
			&& $directories != 'index.html') {
				
				$arr_xml['files'][$i] = $directories;
				
				$sub_xml = new xmlparser($path.$arr_xml['files'][$i], 'r');
				$sub_id  = $sub_xml->read_value('sub_for');
				
				if($sub_id == $search_id) { $s++; }
				
				$i++;
			}
		}
		
		if($file_or_number == 'files') { return $arr_xml['files']; }
		if($file_or_number == 'number') { return $s; }
	}
	
	
	
	/***
	* @return Array with all poll answers
	* @desc 
	*/
	public function count_answers($ca_path) {
		$arr_cpoll = $this->_getPathContent($ca_path);
		$all_answers = 0;
		
		$vote_xml = new xmlparser($ca_path.'.xml', 'r');
		
		$qc = 1;
		do{
			$arr_question[$qc] = $vote_xml->read_section('poll', 'question'.$qc);
			/* COUNT AMOUNT OF QUESTIONS */ $aw[$qc] = $qc;
			/* CREATE ARRAY FOR COUNTING */ $arr_count_answers[$qc] = 0;
			$qc++;
		}while($arr_question[$qc-1] != '__END_POLL_QUESTION__');
		
		if(is_array($arr_cpoll)) {
			foreach($arr_cpoll as $key => $value) {
				if($value != 'index.html') {
					$res_xml = new xmlparser($ca_path.'/'.$value, 'r');
					$answer  = $res_xml->read_section('vote', 'answer');
					
					for($caq = 1; $caq < $qc; $caq++) {
						if($answer == $aw[$caq]) {
							$arr_count_answers[$answer] += 1;
						}
					}
					
					$all_answers = $key + 1;
				}
			}
		}
		
		$arrPollSet['amounta']  = $all_answers;
		$arrPollSet['amount']   = $qc;
		$arrPollSet['answers']  = $arr_count_answers;
		$arrPollSet['question'] = $arr_question;
		
		return $arrPollSet;
	}
	
	
	
	/***
	* @return Array with all poll answers
	* @desc 
	*/
	public function count_answers_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $ac_poll, $command) {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($command == 'nothing') {
			$qc = 1;
			
			$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'polls', $ac_poll);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			do{
				$question = $sqlARR['question'.$qc];
				if($question != NULL) {
					$arr_question[$qc] = $question;
					$aw[$qc] = $qc;
				}
				$qc++;
			}while($arr_question[$qc-1] != NULL);
			
			
			$sqlQR = $sqlAL->getAll($this->db_prefix."poll_items WHERE  poll_uid='".$ac_poll."'");
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0) {
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)) {
					$answer = $sqlARR['answer'];
					
					for($caq = 1; $caq < $qc; $caq++) {
						if($answer == $aw[$caq]) {
							$arr_count_answers[$answer] += 1;
						}
					}
				}
			}
			
			
			$arrPollSet['amount']   = $qc;
			$arrPollSet['answers']  = $arr_count_answers;
			$arrPollSet['question'] = $arr_question;
			
			return $arrPollSet;
		}
		
		if($command == 'poll_answers') {
			$sqlQR = $sqlAL->getAll($this->db_prefix."poll_items WHERE  poll_uid='".$ac_poll."'");
			$sqlNR = $sqlAL->getNumber($sqlQR);
			return $sqlNR;
		}
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	public function create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $sqlTable, $sqlField, $forDownload = false, $category = '') {
		if($choosenDB == 'xml') {
			$returnME = 1;
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$session_exists = 1;
			
			if($forDownload == false) {
				switch($choosenDB) {
					case 'mysql': $sqlStr = 'SELECT MAX(`'.$sqlTable.'`.`'.$sqlField.'`) AS newMax FROM '.$sqlTable; break;
					case 'pgsql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable; break;
					case 'mssql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable; break;
				}
				
				$sqlQR  = $sqlAL->query($sqlStr);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				switch($choosenDB) {
					case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
					case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
					case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
				}
			}
			else {
				switch($choosenDB) {
					case 'mysql':
						$sqlStr = 'SELECT CASE WHEN ( MAX(`'.$sqlTable.'`.`'.$sqlField.'`) IS NULL ) THEN 0'
						.' ELSE MAX(`'.$sqlTable.'`.`'.$sqlField.'`) END AS newMax'
						.' FROM '.$sqlTable.' WHERE cat '.( $category == '' ? 'IS NULL' : '= "'.$category.'"' );
						break;
					
					case 'pgsql':
						$sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable;
						break;
					
					case 'mssql':
						$sqlStr = "SELECT CASE WHEN ( MAX(".$sqlTable.".[".$sqlField."]) IS NULL ) THEN 0"
						." ELSE MAX(".$sqlTable.".[".$sqlField."]) END AS newMax"
						." FROM ".$sqlTable." WHERE [cat] ".( $category == '' ? "IS NULL" : "= '".$category."'" );
						break;
				}
				
				$sqlQR  = $sqlAL->query($sqlStr);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				switch($choosenDB) {
					case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
					case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
					case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
				}
			}
		}
		
		return $returnME;
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	public function create_sort_id_sub($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $sqlTable, $sqlField, $sqlFromField = '', $sqlFromValue = '') {
		if($choosenDB == 'xml') {
			$handle = opendir($this->administer.'/'.$sqlTable.'/');
			$i = 0;
			while ($dir = readdir($handle)) {
				if ($dir != '.' 
				&& $dir != '..' 
				&& $dir != 'CVS' 
				&& $dir != '.svn'
				&& $dir != '_svn'
				&& $dir != '.SVN'
				&& $dir != '_SVN'
				&& substr($dir, 0, 9) != 'comments_' 
				&& $dir != 'index.html') {
					$xmlUser = new xmlparser($this->administer.'/'.$sqlTable.'/'.$dir, 'r');
					
					switch($sqlTable) {
						case $this->db_prefix.'links': $tmpSection = 'link'; break;
						case $this->db_prefix.'user': $tmpSection = 'user'; break;
						default: $tmpSection = 'link'; break;
					}
					
					$tmpCheck = $xmlUser->read_section($tmpSection, $sqlFromField);
					
					if($tmpCheck == $sqlFromValue) {
						$i++;
					}
				}
			}
			
			$returnME = $i;
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$session_exists = 1;
			
			switch($choosenDB) {
				case 'mysql': $sqlStr = 'SELECT MAX(`'.$sqlTable.'`.`'.$sqlField.'`) AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE '.$sqlFromField.'='.$sqlFromValue : '' ); break;
				case 'pgsql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE '.$sqlFromField.'='.$sqlFromValue : '' ); break;
				case 'mssql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE ['.$sqlFromField.']='.$sqlFromValue : '' ); break;
			}
			
			$sqlQR  = $sqlAL->query($sqlStr);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			switch($choosenDB) {
				case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
				case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
				case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
			}
		}
		
		return $returnME;
	}
	
	
	
	/***
	* @return Linkway generating
	* @desc $which
	*      path    => Pathway (as Link)
	*      title   => Sitetitle
	*      pathway => Pathway
	*/
	public function linkway($arr_files, $arr_filesT, $c_charset, $session, $s, $lang) {
		global $tcms_config;
		
		$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		$count = 0;
		
		
		// from sidemenu
		if($this->isArray($arr_files)) {
			foreach($arr_files as $fnk => $fnvalue) {
				if($fnvalue != 'index.html') {
					$link_xml = new xmlparser($this->administer.'/tcms_menu/'.$fnvalue,'r');
					
					$is_lang = $link_xml->read_value('language');
					
					if($getLang == $is_lang) {
						$arr_link['name'][$count] = $link_xml->read_value('name');
						$arr_link['id'][$count]   = $link_xml->read_value('id');
						$arr_link['link'][$count] = $link_xml->read_value('link');
						
						// CHARSETS
						$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
						
						$count++;
					}
					
					$link_xml->flush();
					unset($link_xml);
				}
			}
			
			if($this->isArray($arr_link)) {
				if($which != 'check_id') {
					array_multisort(
						$arr_link['id'], SORT_ASC, 
						$arr_link['name'], SORT_ASC, 
						$arr_link['link'], SORT_ASC
					);
					
					foreach ($arr_link['link'] as $key => $value) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value.'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_path[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
						$titleway[$value] = $arr_link['name'][$key];
						$pathway[$value]  = $arr_link['name'][$key];
					}
				}
			}
		}
		
		
		// from topmenu
		if($this->isArray($arr_filesT)) {
			foreach($arr_filesT as $fnk => $fnvalue) {
				if($fnvalue != 'index.html') {
					$link_xml = new xmlparser($this->administer.'/tcms_topmenu/'.$fnvalue,'r');
					
					$is_lang = $link_xml->read_value('language');
					
					if($getLang == $is_lang) {
						$arr_link['name'][$count] = $link_xml->read_value('name');
						$arr_link['id'][$count]   = $link_xml->read_value('id');
						$arr_link['link'][$count] = $link_xml->read_value('link');
						
						// CHARSETS
						$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
						
						$count++;
					}
					
					$link_xml->flush();
					unset($link_xml);
				}
			}
			
			if($this->isArray($arr_link)) {
				if($which != 'check_id') {
					array_multisort(
						$arr_link['id'], SORT_ASC, 
						$arr_link['name'], SORT_ASC, 
						$arr_link['link'], SORT_ASC
					);
					
					foreach ($arr_link['link'] as $key => $value) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$value.'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_pathT[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
						$titlewayT[$value] = $arr_link['name'][$key];
						$pathwayT[$value]  = $arr_link['name'][$key];
					}
				}
			}
		}
		
		
		if(is_array($pathwayT) && !empty($pathwayT)) {
			foreach($pathwayT as $key => $value) { $tmpPathway[$key] = $value; }
		}
		if(is_array($pathway) && !empty($pathway)) {
			foreach($pathway as $key => $value) { $tmpPathway[$key] = $value; }
		}
		
		
		if(!is_array($arr_path)) { $arr_path[0]  = ''; }
		if(!is_array($arr_pathT)) { $arr_pathT[0] = ''; }
		if(!is_array($titleway)) { $titleway[0]  = ''; }
		if(!is_array($titlewayT)) { $titlewayT[0] = ''; }
		
		
		$arr_path = array_merge($arr_path, $arr_pathT);
		$titleway = array_merge($titleway, $titlewayT);
		
		
		$arrLinkway['path']    = $arr_path;
		$arrLinkway['title']   = $titleway;
		$arrLinkway['pathway'] = $tmpPathway;
		
		return $arrLinkway;
	}
	
	
	
	/***
	* @return Linkway generating
	* @desc $which
	*      path    => Pathway (as Link)
	*      title   => Sitetitle
	*      pathway => Pathway
	*/
	public function linkwaySQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, $session, $s, $lang) {
		global $tcms_config;
		
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlStr = "SELECT * "
		."FROM ".$this->db_prefix."sidemenu "
		."WHERE language = '".$tcms_config->getLanguageCodeForTCMS($lang)."' "
		."ORDER BY id ASC, name ASC, link ASC";
		
		//$sqlQR = $sqlAL->getAll($this->db_prefix.'sidemenu');
		$sqlQR = $sqlAL->query($sqlStr);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)) {
			$arr_link['name'][$count] = $sqlARR['name'];
			$arr_link['id'][$count]   = $sqlARR['id'];
			$arr_link['link'][$count] = $sqlARR['link'];
			
			if($arr_link['name'][$count] == NULL) { $arr_link['name'][$count] = ''; }
			if($arr_link['id'][$count]   == NULL) { $arr_link['id'][$count]   = ''; }
			if($arr_link['link'][$count] == NULL) { $arr_link['link'][$count] = ''; }
			
			// CHARSETS
			$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		
		if($which != 'check_id') {
			/*if(is_array($arr_link)) {
				array_multisort(
					$arr_link['id'], SORT_ASC, 
					$arr_link['name'], SORT_ASC, 
					$arr_link['link'], SORT_ASC
				);
			}*/
			
			if(is_array($arr_link['link']) && !empty($arr_link['link'])) {
				foreach($arr_link['link'] as $key => $value) {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id='.$value.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					$arr_path[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
					$titleway[$value] = $arr_link['name'][$key];
					$pathway[$value]  = $arr_link['name'][$key];
				}
			}
		}
		
		$sqlStr = "SELECT * "
		."FROM ".$this->db_prefix."topmenu "
		."WHERE language = '".$tcms_config->getLanguageCodeForTCMS($lang)."' "
		."ORDER BY id ASC, name ASC, link ASC";
		
		//$sqlQR = $sqlAL->getAll($this->db_prefix.'sidemenu');
		$sqlQR = $sqlAL->query($sqlStr);
		
		//$sqlQR = $sqlAL->getAll($this->db_prefix.'topmenu');
		$count = 0;
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)) {
			$arr_link['name'][$count] = $sqlARR['name'];
			$arr_link['id'][$count]   = $sqlARR['id'];
			$arr_link['link'][$count] = $sqlARR['link'];
			
			if($arr_link['name'][$count] == NULL) { $arr_link['name'][$count] = ''; }
			if($arr_link['id'][$count]   == NULL) { $arr_link['id'][$count]   = ''; }
			if($arr_link['link'][$count] == NULL) { $arr_link['link'][$count] = ''; }
			
			// CHARSETS
			$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		
		if($which != 'check_id') {
			/*if(is_array($arr_link)) {
				array_multisort(
					$arr_link['id'], SORT_ASC, 
					$arr_link['name'], SORT_ASC, 
					$arr_link['link'], SORT_ASC
				);
			}*/
			
			if(is_array($arr_link['link']) && !empty($arr_link['link'])) {
				foreach($arr_link['link'] as $key => $value) {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id='.$value.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					$arr_pathT[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
					$titlewayT[$value] = $arr_link['name'][$key];
					$pathwayT[$value]  = $arr_link['name'][$key];
				}
			}
		}
		
		
		if(is_array($pathwayT) && !empty($pathwayT)) {
			foreach($pathwayT as $key => $value) { $tmpPathway[$key] = $value; }
		}
		if(is_array($pathway) && !empty($pathway)) {
			foreach($pathway as $key => $value) { $tmpPathway[$key] = $value; }
		}
		
		
		if(!is_array($arr_path)) { $arr_path[0]  = ''; }
		if(!is_array($arr_pathT)) { $arr_pathT[0] = ''; }
		if(!is_array($titleway)) { $titleway[0]  = ''; }
		if(!is_array($titlewayT)) { $titlewayT[0] = ''; }
		
		$arr_path = array_merge($arr_path, $arr_pathT);
		$titleway = array_merge($titleway, $titlewayT);
		
		
		$arrLinkway['path']    = $arr_path;
		$arrLinkway['title']   = $titleway;
		$arrLinkway['pathway'] = $tmpPathway;
		
		return $arrLinkway;
	}
	
	
	
	/***
	* @return Mainmenu links
	* @desc returns an multi array with all mainmenulinks as array, the follow idizies exists
	*   array -> 'link'		-> complete link
	*   array -> 'auth'		-> access level
	*   array -> 'id'		-> position
	*   array -> 'subid'	-> position in submenu
	*   array -> 'type'		-> type of menuetry
	*   array -> 'parent'	-> which parent item
	*   array -> 'pub'      -> is item published or not
	*   array -> 'submenu'	-> complete submenu link
	*   array -> 'name'		-> simple link name
	*/
	public function mainmenu($arr_file, $c_charset, $session, $s, $lang) {
		global $tcms_config;
		
		$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		$count = 0;
		
		if($this->isArray($arr_file)) {
			foreach($arr_file as $key => $value) {
				if($value != 'index.html') {
					$side_xml = new xmlparser($this->administer.'/tcms_menu/'.$value,'r');
					
					$is_lang = $side_xml->read_value('language');
					
					if($getLang == $is_lang) {
						$arr_menu['name'][$count] = $side_xml->read_value('name');
						$arr_menu['id'][$count]   = $side_xml->read_value('id');
						$arr_menu['sub'][$count]  = $side_xml->read_value('subid');
						$arr_menu['type'][$count] = $side_xml->read_value('type');
						$arr_menu['link'][$count] = $side_xml->read_value('link');
						$arr_menu['pub'][$count]  = $side_xml->read_value('published');
						$arr_menu['auth'][$count] = $side_xml->read_value('access');
						$arr_menu['par'][$count]  = $side_xml->read_value('parent');
						$arr_menu['tar'][$count]  = $side_xml->read_value('target');
						
						// CHARSETS
						$arr_menu['name'][$count] = $this->decodeText($arr_menu['name'][$count], '2', $c_charset);
						
						$count++;
					}
					
					$side_xml->flush();
					unset($side_xml);
				}
			}
			
			if($this->isArray($arr_menu)) {
				array_multisort(
					$arr_menu['id'], SORT_ASC, 
					$arr_menu['sub'], SORT_ASC, 
					$arr_menu['name'], SORT_ASC, 
					$arr_menu['type'], SORT_ASC, 
					$arr_menu['link'], SORT_ASC, 
					$arr_menu['auth'], SORT_ASC, 
					$arr_menu['pub'], SORT_ASC, 
					$arr_menu['par'], SORT_ASC, 
					$arr_menu['tar'], SORT_ASC
				);
				
				foreach($arr_menu['id'] as $mkey => $mvalue) {
					if($arr_menu['tar'][$mkey] != '')
						$ltarget = ' target="'.$arr_menu['tar'][$mkey].'"';
					else
						$ltarget = '';
					
					if($arr_menu['type'][$mkey] == 'web') {
						$arr_mainmenu['link'][$mkey] = '<a'.$ltarget.' class="mainlevel" href="'.$arr_menu['link'][$mkey].'">'.$arr_menu['name'][$mkey].'</a>';
					}
					else {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$arr_menu['link'][$mkey].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_mainmenu['link'][$mkey] = '<a'.$ltarget.' class="mainlevel" href="'.$link.'">'.$arr_menu['name'][$mkey].'</a>';
					}
					
					$arr_mainmenu['auth'][$mkey] = $arr_menu['auth'][$mkey];
					$arr_mainmenu['id'][$mkey] = $arr_menu['id'][$mkey];
					$arr_mainmenu['type'][$mkey] = $arr_menu['type'][$mkey];
					$arr_mainmenu['subid'][$mkey] = $arr_menu['sub'][$mkey];
					$arr_mainmenu['parent'][$mkey] = $arr_menu['par'][$mkey];
					$arr_mainmenu['name'][$mkey] = $arr_menu['name'][$mkey];
					$arr_mainmenu['pub'][$mkey] = $arr_menu['pub'][$mkey];
					$arr_mainmenu['url'][$mkey] = $arr_menu['link'][$mkey];
					$arr_mainmenu['tar'][$mkey] = $arr_menu['tar'][$mkey];
					
					if($arr_menu['type'][$mkey] == 'web') {
						$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.$arr_menu['link'][$mkey].'">'.$arr_menu['name'][$mkey].'</a>';
					}
					else {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.$arr_menu['link'][$mkey].'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.$link.'">'.$arr_menu['name'][$mkey].'</a>';
					}
				}
			}
			
			return $arr_mainmenu;
		}
		else { return ''; }
	}
	
	
	
	/***
	* @return Topmenu links
	* @desc 
	*/
	public function topmenu($arr_filename, $c_charset, $session, $s, $lang) {
		global $tcms_config;
		
		$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		$count = 0;
		
		if($this->isArray($arr_filename)) {
			foreach($arr_filename as $k => $v) {
				if($v != 'index.html') {
					$all_xml = new xmlparser($this->administer.'/tcms_topmenu/'.$v,'r');
					
					$is_lang = $all_xml->read_value('language');
					
					if($getLang == $is_lang) {
						$arr_top['name'][$count] = $all_xml->read_value('name');
						$arr_top['id'][$count]   = $all_xml->read_value('id');
						$arr_top['link'][$count] = $all_xml->read_value('link');
						$arr_top['type'][$count] = $all_xml->read_value('type');
						$arr_top['pub'][$count]  = $all_xml->read_value('published');
						$arr_top['acs'][$count]  = $all_xml->read_value('access');
						$arr_top['tar'][$count]  = $all_xml->read_value('target');
						
						// CHARSETS
						$arr_top['name'][$count] = $this->decodeText($arr_top['name'][$count], '2', $c_charset);
						
						$count++;
					}
					
					$all_xml->flush();
					unset($all_xml);
				}
			}
			
			if($this->isArray($arr_top)) {
				array_multisort(
					$arr_top['id'], SORT_ASC, 
					$arr_top['name'], SORT_ASC, 
					$arr_top['pub'], SORT_ASC, 
					$arr_top['acs'], SORT_ASC, 
					$arr_top['type'], SORT_ASC, 
					$arr_top['link'], SORT_ASC, 
					$arr_top['tar'], SORT_ASC
				);
				
				foreach($arr_top['id'] as $key => $value) {
					if($arr_top['tar'][$key] != '')
						$ltarget = ' target="'.$arr_top['tar'][$key].'"';
					else
						$ltarget = '';
					
					
					if(trim($arr_top['type'][$key]) == 'web') {
						$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.trim($arr_top['link'][$key]).'">'.trim($arr_top['name'][$key]).'</a>';
					}
					else {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id='.trim($arr_top['link'][$key]).'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $this->urlConvertToSEO($link);
						
						$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.$link.'">'.trim($arr_top['name'][$key]).'</a>';
					}
					
					$arr_top_navi['pub'][$key] = trim($arr_top['pub'][$key]);
					$arr_top_navi['access'][$key] = trim($arr_top['acs'][$key]);
					$arr_top_navi['last'][$key] = max($arr_top['id']);
					$arr_top_navi['id'][$key] = trim($arr_top['link'][$key]);
					$arr_top_navi['name'][$key] = trim($arr_top['name'][$key]);
					$arr_top_navi['type'][$key] = trim($arr_top['type'][$key]);
				}
			}
			
			return $arr_top_navi;
		}
		else { return ''; }
	}
	
	
	
	/***
	* @return Topmenu links
	* @desc 
	*/
	public function topmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, $session, $s, $lang) {
		global $tcms_config;
		
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlStr = "SELECT * "
		."FROM ".$this->db_prefix."topmenu "
		."WHERE language = '".$tcms_config->getLanguageCodeForTCMS($lang)."' "
		."ORDER BY id ASC, name ASC";
		
		//$sqlQR = $sqlAL->getAll($this->db_prefix.'sidemenu');
		$sqlQR = $sqlAL->query($sqlStr);
		
		//$sqlQR = $sqlAL->getAll($this->db_prefix.'topmenu');
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)) {
			$arr_top['tag'][$count]    = $sqlARR['uid'];
			$arr_top['name'][$count]   = $sqlARR['name'];
			$arr_top['id'][$count]     = $sqlARR['id'];
			$arr_top['access'][$count] = $sqlARR['access'];
			$arr_top['type'][$count]   = $sqlARR['type'];
			$arr_top['link'][$count]   = $sqlARR['link'];
			$arr_top['pub'][$count]    = $sqlARR['published'];
			$arr_top['tar'][$count]    = $sqlARR['target'];
			
			if($arr_top['name'][$count]   == NULL) { $arr_top['name'][$count]   = ''; }
			if($arr_top['id'][$count]     == NULL) { $arr_top['id'][$count]     = ''; }
			if($arr_top['access'][$count] == NULL) { $arr_top['access'][$count] = ''; }
			if($arr_top['link'][$count]   == NULL) { $arr_top['link'][$count]   = ''; }
			if($arr_top['pub'][$count]    == NULL) { $arr_top['pub'][$count]    = ''; }
			if($arr_top['type'][$count]   == NULL) { $arr_top['type'][$count]   = ''; }
			if($arr_top['tar'][$count]    == NULL) { $arr_top['tar'][$count]    = ''; }
			
			// CHARSETS
			$arr_top['name'][$count] = $this->decodeText($arr_top['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		/*if(is_array($arr_top)) {
			array_multisort(
				$arr_top['id'], SORT_ASC, 
				$arr_top['name'], SORT_ASC, 
				$arr_top['pub'], SORT_ASC, 
				$arr_top['access'], SORT_ASC, 
				$arr_top['type'], SORT_ASC, 
				$arr_top['link'], SORT_ASC, 
				$arr_top['tar'], SORT_ASC
			);
		}*/
		
		if(!empty($arr_top) && isset($arr_top)) {
			foreach($arr_top['id'] as $key => $value) {
				if($arr_top['tar'][$key] != '')
					$ltarget = ' target="'.$arr_top['tar'][$key].'"';
				else
					$ltarget = '';
				
				
				if(trim($arr_top['type'][$key]) == 'web') {
					$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.trim($arr_top['link'][$key]).'">'.trim($arr_top['name'][$key]).'</a>';
				}
				else {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id='.trim($arr_top['link'][$key]).'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $this->urlConvertToSEO($link);
					
					$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.$link.'">'.trim($arr_top['name'][$key]).'</a>';
				}
				
				$arr_top_navi['type'][$key] = $arr_top['type'][$key];
				$arr_top_navi['pub'][$key] = trim($arr_top['pub'][$key]);
				$arr_top_navi['access'][$key] = trim($arr_top['access'][$key]);
				$arr_top_navi['last'][$key] = max($arr_top['id']);
				$arr_top_navi['id'][$key] = trim($arr_top['link'][$key]);
			}
			
			return $arr_top_navi;
		}
		else { return ''; }
	}
	
	
	
	/***
	* @return max id in content
	* @desc 
	*/
	public function get_max_id($backend) {
		if($backend == 'admin') { $path = $this->administer.'/tcms_content/'; }
		if($backend == 'front') { $path = $this->administer.'/tcms_content/'; }
		$arr_fn = readdir_ext($path);
		$i = 0;
		while(!empty($arr_fn[$i])) {
			if($arr_fn[$i] != 'index.html') {
				$all_xml = new xmlparser($path.$arr_fn[$i],'r');
				$arr_tc[$i] = $all_xml->read_value('id');
			}
			$i++;
		}
		return max($arr_tc);
	}
	
	
	
	/***
	* @return array with all id's
	* @desc Returns an array with all available ID numbers
	*/
	public function get_id_array() {
		$handle = opendir($this->administer.'/tcms_content/');
		$i = 0;
		while ($files = readdir($handle)) {
			if ($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html') {
				$maintag = substr($files, 0, 10);
				
				$all_xml = new xmlparser($this->administer.'/tcms_content/'.$files,'r');
				$arr_IDNumbers[$i] = $all_xml->read_section($maintag, 'id');
				
				$i++;
			}
		}
		return $arr_IDNumbers;
	}
	
	
	
	/***
	* @return contact xml filename
	* @desc the default contact for the contactform
	*/
	public function get_default_contact() {
		$handle = opendir($this->administer.'/tcms_contacts/');
		$i = 0;
		while($files = readdir($handle)) {
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html') {
				$len = strlen($files);
				$maintag = substr($files, 0, $len);
				
				$all_xml = new xmlparser($this->administer.'/tcms_contacts/'.$files,'r');
				$check_pub = $all_xml->read_section('contact', 'published');
				
				if($check_pub == 1) {
					$check_def = $all_xml->read_section('contact', 'default_con');
					if($check_def == 1) {
						$def_con = $files;
					}
				}
			}
		}
		return $def_con;
	}
	
	
	
	/***
	* @return contact xml filename
	* @desc the default contact for the contactform
	*/
	public function get_default_sql_contact($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort) {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->query('SELECT * FROM '.$this->db_prefix.'contacts WHERE default_con = 1 AND published = 1');
		
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		$def_con = $sqlARR['uid'];
		
		return $def_con;
	}
	
	
	
	/***
	* @return splitet sql string
	* @desc 
	*/
	public function split_sql($sql) {
		$sql = trim($sql);
		$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);
		
		$buffer = array();
		$ret = array();
		$in_string = false;
		
		for($i=0; $i<strlen($sql)-1; $i++) {
			if($sql[$i] == ";" && !$in_string) {
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}
			
			if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
				$in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
				$in_string = $sql[$i];
			}
			
			if(isset($buffer[1])) { $buffer[0] = $buffer[1]; }
			
			$buffer[1] = $sql[$i];
		}
		
		if(!empty($sql)) { $ret[] = $sql; }
		return($ret);
	}
	
	
	
	/***
	* @return The amount of news in categories with the given cat uid
	* @desc 
	*/
	public function getNewsCatAmount($catUID, $authSQL1, $authSQL2) {
		$path = $this->administer.'/tcms_news/';
		$handle = opendir($path);
		$i = 0;
		
		while($files = readdir ($handle)) {
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& substr($files, 0, 9) != 'comments_' 
			&& $files != 'index.html') {
				$chkXML = new xmlparser($path.$files, 'r');
				$chkACS = $chkXML->read_section('news', 'access');
				
				// check public rights
				if($chkACS == 'Public') { $chk = true; }
				
				// check protected rights
				if($authSQL1 != '') {
					if($chk == false) {
						if($chkACS == $authSQL1) {
							$chk = true;
						}
					}
				}
				
				// check private rights
				if($authSQL2 != '') {
					if($chk == false) {
						if($chkACS == $authSQL2) {
							$chk = true;
						}
					}
				}
				
				if($chk) {
					$chkCAT = $chkXML->read_section('news', 'category');
					$arrCAT = explode('{###}', $chkCAT);
					
					if(in_array($catUID, $arrCAT)) { $i++; }
				}
			}
		}
		
		return $i;
	}
	
	
	
	/***
	* @return boolean
	* @desc Checks contacts for a default contact
	*/
	public function chkDefaultContact() {
		$path = $this->administer.'/tcms_contacts/';
		$handle = opendir($path);
		$i = 0;
		$chkACScount = 0;
		$return = false;
		
		while($files = readdir ($handle)) {
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& substr($files, 0, 9) != 'comments_' 
			&& $files != 'index.html') {
				$chkXML = new xmlparser($path.$files, 'r');
				$chkACS = $chkXML->read_section('contact', 'default_con');
				
				if($chkACS == 1) { $chkACScount++; }
			}
		}
		
		if($chkACScount > 0) {
			$return = true;
		}
		else {
			$return = false;
		}
		
		return $return;
	}
	
	
	
	/***
	* @return string
	* @desc return a string with a command for inserting
	*/
	public function returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $key, $a = 1, $b = '', $c = '', $url = '') {
		$cmdImage = '';
		
		if($url != '') {
			$url = str_replace($this->globalFolder, '', $url);
			$url = str_replace('///', '/', $url);
			//$url = str_replace('//', '/', $url);
		}
		
		if(isset($dvalue) && $dvalue != '') {
			$rTemp2 = $dvalue;
			$rTemp2 = str_replace('///', '/', $rTemp2);
			$rTemp2 = str_replace('//', '/', $rTemp2);
		}
		
		if(isset($n) && $n == 'without') {
			if(isset($url) && $url != '') {
				$rTemp = $url.$dvalue;
				$rTemp = str_replace('///', '/', $rTemp);
				$rTemp = str_replace('//', '/', $rTemp);
			}
			
			if($show_wysiwyg == 'toendaScript') {
				$cmdImage = 'setLink(\''.$rTemp.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'toendaScript\')';
			}
			else {
				$cmdImage = 'setLink(\''.$rTemp.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'HTML\')';
			}
		}
		else {
			if($show_wysiwyg == 'tinymce' && $v != 'links') {
				if($a == 1) {
					$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$rTemp2.'&quot;&gt;\' + document.getElementById(\'lb_title_'.$key.'\').value + \'&lt;/a&gt;\');self.close()';
				}
				else {
					$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$rTemp2.'&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;'.$b.'/images/albums/'.$c.'/'.$a.'&quot; border=&quot;0&quot; alt=&quot;\' + document.getElementById(\'lb_title_'.$key.'\').value + \'&quot; /&gt;&lt;/a&gt;\');self.close()';
				}
			}
			else {
				if($show_wysiwyg == 'toendaScript') {
					$cmdImage = 'setLink(\''.$rTemp2.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'toendaScript\')';
				}
				else {
					$cmdImage = 'setLink(\''.$rTemp2.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'HTML\')';
				}
			}
		}
		
		return $cmdImage;
	}
}

?>
