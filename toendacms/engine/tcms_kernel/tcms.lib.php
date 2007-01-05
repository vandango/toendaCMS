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
| File:		tcms.lib.php
| Version:	1.9.2
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Kernel - System framework
 *
 * This class is used for a basic functions.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * Methods
 *
 * --------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 * --------------------------------------------------------
 *
 * __construct                 -> PHP5 Constructor
 * tcms_main                   -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_main                  -> PHP4 Destructor
 *
 * --------------------------------------------------------
 * MAIN FUNCTIONS
 * --------------------------------------------------------
 *
 * setDatabaseInfo             -> Setter for the databse information
 * setURLSEO                   -> Setter for urlSEO
 * setGlobalFolder             -> Set the global folder
 * getAdministerSite           -> Get the administer-site string
 *
 * --------------------------------------------------------
 * PUBLIC METHODS
 * --------------------------------------------------------
 *
 * // todo: take into account class
 * getUser                     -> Return the username
 * getUserID                   -> Return ID for username or realname
 * getUserInfo                 -> Get some information about a user
 *
 * getPathContentAmount        -> Get the amount of related files in a path (without directorys)
 * getPathContent              -> Return a array of all files or folders inside a path
 * getXMLFiles                 -> Return a array of all xml files inside a path
 * getDirectorySize            -> Get the complete filesize of a directory
 * getDirectorySizeString      -> Get the complete filesize of a directory as a string
 * getNewUID                   -> Get a new guid
 * getMimeType                 -> Get the mimetype of a filename
 * getPHPSetting               -> Get a PHP setting
 * setPHPSetting               -> Set a PHP setting
 * isArray                     -> Check if a array is realy a array
 * isImage                     -> Check if a file type is a image file
 * isAudio                     -> Check if a file type is a audio file
 * isVideo                     -> Check if a file type is a video file
 * isMultimedia                -> Check if a file type is a multimedia file
 * isReal                      -> Check if a variable is not empty and is set
 * isCHMODable                 -> Checks if a file is CHMODable
 * deleteDir                   -> Remove dir with all files and directorys inside
 * deleteDirContent            -> Remove all files and directorys inside a directory
 * encodeBase64                -> Encode (decipher) a crypt a string from a base64 crypt string
 * decodeBase64                -> Decode (cipher) a string into a base64 crypt string
 * encodeText                  -> Encode (cipher) a text
 * decodeText                  -> Decode (decipher) a text
 * securePassword              -> Secure or unsecure a password string
 * checkWebLink                -> Check if a link is a weblink
 * checkAccess                 -> Check if a usergroup can read a access level
 * cleanUrlString              -> Clean a text from javascript code
 * cleanGBLink                 -> Clean a text from links code
 * cleanGBScript               -> Clean a text from javascript and php code
 * cleanFilename               -> Clean a filename
 * cleanImageFromString        -> Clean images from a string
 * cleanAllImagesFromString    -> Clean all images from a string
 * urlAmpReplace               -> Convert a url link into a SEO friendly link
 * urlAddSlash                 -> Convert a equal-char (=) into a slash-char (/)
 * urlAddColon                 -> Convert a equal-char (=) into a double-dot-char (:)
 * reCHMOD                     -> Chmods files and directories recursivel to given permissions
 * replaceSmilyTags            -> Replace all smiley tags with the icons
 *
 * xml_readdir_content         -> return id saved in xml file
 * xml_readdir_content_without -> return id saved in xml file
 * count_submenu_xml           -> return a numer of files
 * readdir_comment             -> return all comment folders from the news folder
 * readdir_image_comment       -> return all comment folders from the image folder
 * readdir_count               -> return the amount of datasets
 * ampReplace                  -> clean a string
 * load_css_files              -> loads all css files from an dir ( files or numbers files )
 * count_subid                 -> count all xml files in an dir ( files or numbers files )
 * count_answers               -> count answers in poll
 * count_answers_sql           -> count answers in poll from sql
 * check_session               -> checks the session files for the mtime
 * create_admin                -> get the admin session uid
 * check_sql_session           -> check session time in sql
 * check_session_exists        -> check if sql session exists
 * create_sort_id              -> create a sort id
 * create_sort_id_sub          -> create a sort id for subid tag (with parent as parent)
 * linkway                     -> return arrays with links for sitetitle and pathway
 * mainmenu                    -> return links for the sidemenu
 * mainmenuSQL                 -> return links for the sidemenu (read from database)
 * topmenu                     -> return links for the topmenu
 * topmenuSQL                  -> return links for the topmenu (read from database)
 * get_max_id                  -> return the max id
 * get_id_array                -> return an array with all ID numbers
 * get_default_contact         -> return the default contact for the contactform
 * get_default_sql_contact     -> return the default contact for the contactform from sql db
 * split_sql                   -> return splittet sql string
 * cleanHTMLforPDF             -> return a string, cleaned for PDF
 * nl2br                       -> return a string where all nl replaced with a <br> tag
 * getNewsCatAmount            -> return the amount of news in cat with the given cat uid
 * paf                         -> prints a array formated
 * tcms_strrpos                -> return the last index of a expression
 * chkDefaultContact           -> return a boolean if a default contact exists
 * returnInsertCommand         -> return a command for inserting
 *
 * --------------------------------------------------------
 * DEPRECATED FUNCTIONS
 * --------------------------------------------------------
 *
 * DEPRECATED create_uid                  -> getNewUID
 * DEPRECATED getUserFromSQL              -> getUser
 * DEPRECATED readdir_ext                 -> getPathContent
 * DEPRECATED create_username             -> getUserInfo
 * DEPRECATED create_sql_username         -> getUserInfo
 * DEPRECATED rmdirr                      -> deleteDir
 * DEPRECATED getUserIDFromSQL            -> getUserID
 * DEPRECATED get_php_setting             -> getPHPSetting
 * DEPRECATED set_php_setting             -> setPHPSetting
 * DEPRECATED secure_password             -> securePassword
 * DEPRECATED log_login                   -> see tcms_authentication
 * DEPRECATED delete_sql_session          -> see tcms_authentication
 * DEPRECATED decode_text                 -> encodeText
 * DEPRECATED encode_text                 -> decodeText
 * DEPRECATED decode_text_without_crypt   -> encodeText (with true)
 * DEPRECATED encode_text_without_crypt   -> decodeText (with true)
 * DEPRECATED decode_text_without_db      -> encodeText (with true, true)
 * DEPRECATED encode_text_without_db      -> decodeText (with true, true)
 * DEPRECATED create_session              -> see tcms_authentication
 * DEPRECATED create_sql_session          -> see tcms_authentication
 * DEPRECATED load_xml_files              -> loads all xml files from an dir ( files or numbers files )
 * DEPRECATED canCHMOD                    -> isCHMODable
 * </code>
 *
 */


class tcms_main {
	var $administer;
	var $globalFolder;
	var $globalSEO;
	var $urlSEO;
	
	// database information
	var $db_choosenDB;
	var $db_user;
	var $db_pass;
	var $db_host;
	var $db_database;
	var $db_port;
	var $db_prefix;
	
	
	
	/*
		Constructors
		Destructors
	*/
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $administer = 'data'
	 */
	function __construct($administer = 'data'){
		$this->administer = $administer;
		$this->urlSEO = 'colon';
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $administer = 'data'
	 */
	function tcms_main($administer = 'data'){
		$this->__construct($administer);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_main(){
		$this->__destruct();
	}
	
	
	
	/*
		Internal functions
	*/
	
	
	
	/**
	 * Set the database information
	 *
	 * @param String $choosenDB
	 */
	function setDatabaseInfo($choosenDB){
		$this->db_choosenDB = $choosenDB;
		
		if(file_exists($this->administer.'/tcms_global/database.php')){
			include($this->administer.'/tcms_global/database.php');
			
			$this->db_user     = $this->securePassword($tcms_db_user);
			$this->db_pass     = $this->securePassword($tcms_db_password);
			$this->db_host     = $this->securePassword($tcms_db_host);
			$this->db_database = $this->securePassword($tcms_db_database);
			$this->db_port     = $this->securePassword($tcms_db_port);
			$this->db_prefix   = $this->securePassword($tcms_db_prefix);
		}
		else{
			$this->db_prefix = 'tcms_';
		}
	}
	
	
	
	/**
	 * Set the seo display art
	 *
	 * @param String $art
	 */
	function setURLSEO($art){
		$this->urlSEO = $art;
	}
	
	
	
	/**
	 * Set the seo settings
	 *
	 * @param String $text
	 * @param Boolean $seo
	 */
	function setGlobalFolder($text, $seo){
		$this->globalFolder = $text;
		$this->globalSEO = $seo;
	}
	
	
	
	/**
	 * Return the active data stores forlder
	 *
	 * @return String
	 */
	function getAdministerSite(){
		return $this->administer;
	}
	
	
	
	/*
		toendaCMS system framework
	*/
	
	
	
	/**
	 * Get the username of a user id
	 *
	 * @param String $userID
	 * @return String
	 */
	function getUser($userID){
		if($this->db_choosenDB == 'xml'){
			$tcms_config = new tcms_configuration($this->administer);
			$c_charset = $tcms_config->getCharset();
			unset($tcms_config);
			
			if(file_exists($this->administer.'/tcms_user/'.$userID.'.xml')){
				$xmlUser = new xmlparser($this->administer.'/tcms_user/'.$userID.'.xml', 'r');
				
				$tmpNickXML = $xmlUser->read_section('user', 'username');
			}
			else{
				$tmpNickXML = '';
			}
			
			if($tmpNickXML == ''){
				$nickXML = false;
			}
			else{
				$nickXML = $this->decodeText($tmpNickXML, '2', $c_charset);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$this->db_prefix."user WHERE uid = '".$userID."'");
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR > 0){
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				$nickXML = $sqlARR['username'];
			}
			else{
				$nickXML = false;
			}
		}
		
		return $nickXML;
	}
	
	
	
	/**
	 * Get the id for a user
	 *
	 * @param String $realOrNick
	 * @return String
	 */
	function getUserID($realOrNick){
		if($this->db_choosenDB == 'xml'){
			$tcms_config = new tcms_configuration($this->administer);
			$c_charset = $tcms_config->getCharset();
			unset($tcms_config);
			
			$arrUserXML = $this->getPathContent($this->administer.'/tcms_user');
			
			$userFound = false;
			
			foreach($arrUserXML as $key => $XMLUserFile){
				if($XMLUserFile != 'index.html'){
					$xmlUser = new xmlparser($this->administer.'/tcms_user/'.$XMLUserFile, 'r');
					
					$tmpNickXML = $xmlUser->read_section('user', 'name');
					$nickXML = $this->decodeText($tmpNickXML, '2', $c_charset);
					
					if($realOrNick == $nickXML){
						return substr($XMLUserFile, 0, 32);
						$userFound = true;
						break;
					}
					else{
						$tmpRealXML = $xmlUser->read_section('user', 'username');
						$arrRealXML = $this->decodeText($tmpRealXML, '2', $c_charset);
						
						if($realOrNick == $arrRealXML){
							return substr($XMLUserFile, 0, 32);
							$userFound = true;
							break;
						}
						else{
							$userFound = false;
						}
					}
					
					$nickXML = '';
					$arrRealXML = '';
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$this->db_prefix."user WHERE username = '".$realOrNick."'");
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR != 0){
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				$userID = $sqlARR['uid'];
			}
			else{
				$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$this->db_prefix."user WHERE name = '".$realOrNick."'");
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				if($sqlNR != 0){
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$userID = $sqlARR['uid'];
				}
				else{
					$userID = false;
				}
			}
			
			return $userID;
		}
		
		if(!$userFound){ return false; }
	}
	
	
	
	/**
	 * Get some information about the current user
	 *
	 * @param String $session
	 * @return Array
	 */
	function getUserInfo($session){
		if($this->db_choosenDB == 'xml'){
			$fileopen = fopen($this->administer.'/tcms_session/'.$session, 'r');
			$arr_user = fread($fileopen, filesize($this->administer.'/tcms_session/'.$session));
			
			$arr_username = explode('##', $arr_user);
			$ws_user = $arr_username[0];
			$ws_id   = $arr_username[1];
			
			fclose($fileopen);
			
			$authXML = new xmlparser($this->administer.'/tcms_user/'.$ws_id.'.xml', 'r');
			
			$arr_ws['user']  = $ws_user;
			$arr_ws['id']    = $ws_id;
			$arr_ws['group'] = $authXML->read_section('user', 'group');
			$arr_ws['name']  = $authXML->read_section('user', 'name');
			
			$authXML->flush();
			$authXML->_xmlparser();
			unset($authXML);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			if($this->db_choosenDB == 'mssql'){
				$strSQL = "SELECT "
				.$this->db_prefix."session.[user_id], "
				.$this->db_prefix."user.[name], "
				.$this->db_prefix."user.username, "
				.$this->db_prefix."user.[group]"
				//.$this->db_prefix."usergroup.right"
				." FROM ".$this->db_prefix."session"
				." INNER JOIN ".$this->db_prefix."user ON (".$this->db_prefix."session.[user_id] = ".$this->db_prefix."user.uid)"
				//." INNER JOIN ".$this->db_prefix."usergroup ON (".$this->db_prefix."user.group = ".$this->db_prefix."usergroup.uid)"
				." WHERE (".$this->db_prefix."session.uid = '".$session."')";
			}
			else{
				$strSQL = "SELECT "
				.$this->db_prefix."session.user_id, "
				.$this->db_prefix."user.name, "
				.$this->db_prefix."user.username, "
				.$this->db_prefix."user.group"
				//.$this->db_prefix."usergroup.right"
				." FROM ".$this->db_prefix."session"
				." INNER JOIN ".$this->db_prefix."user ON (".$this->db_prefix."session.user_id = ".$this->db_prefix."user.uid)"
				//." INNER JOIN ".$this->db_prefix."usergroup ON (".$this->db_prefix."user.group = ".$this->db_prefix."usergroup.uid)"
				." WHERE (".$this->db_prefix."session.uid = '".$session."')";
			}
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$arr_ws['name']  = $sqlObj->name;
			$arr_ws['user']  = $sqlObj->username;
			$arr_ws['id']    = $sqlObj->user_id;
			$arr_ws['group'] = $sqlObj->group;
			//$arr_ws['right'] = $sqlObj->right;
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arr_ws;
	}
	
	
	
	/**
	 * Get the amount of related files in a path (without directorys)
	 * 
	 * @param String $path
	 * @return Integer
	 */
	function getPathContentAmount($path){
		$handle = opendir($path);
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
				$i++;
			}
		}
		
		return $i;
	}
	
	
	
	/**
	 * Return a array of all files or directory's inside a path
	 *
	 * @param String $path
	 * @param Boolean $onlyFolders
	 * @param String $fileType = ''
	 * @return Array
	 */
	function getPathContent($path, $onlyFolders = false, $fileType = ''){
		$i = 0;
		$handle = opendir($path);
		
		while($dir = readdir($handle)){
			if ($dir != '.'
			&& $dir != '..'
			&& $dir != 'CVS'
			&& $dir != '.svn'
			&& $dir != '_svn'
			&& $dir != '.SVN'
			&& $dir != '_SVN'
			&& substr($dir, 0, 9) != 'comments_'
			&& $dir != 'index.html'){
				if($onlyFolders){
					if(is_dir($path.$dir)){
						$arr_dirContent[$i] = $dir;
						$i++;
					}
				}
				else{
					if($fileType == ''){
						$arr_dirContent[$i] = $dir;
						$i++;
					}
					else{
						if(strpos($dir, $fileType)){
							$arr_dirContent[$i] = $dir;
							$i++;
						}
					}
				}
			}
		}
		
		return ( $this->isReal($arr_dirContent) ? $arr_dirContent : NULL );
	}
	
	
	
	/**
	 * Return a array of all xml files inside a path
	 * 
	 * @param String $path
	 * @return Array
	 */
	function getXMLFiles($path){
		return $this->getPathContent($path, false, '.xml');
	}
	
	
	
	/**
	 * Get the complete filesize of a directory
	 *
	 * @param String $path
	 * @param Integer $size
	 * @return Integer
	 */
	function getDirectorySize($path, $size){
		if(!is_dir($path)){
			$size += filesize($path);
		}
		else{
			$dir = opendir($path);
			
			while($file = readdir($dir)){
				if(is_file($path."/".$file))
					$size += filesize($path.'/'.$file);
				
				if(is_dir($path.'/'.$file) && $file != '.' && $file != '..')
					$size = $this->getDirectorySize($path.'/'.$file, $size);
			}
		}
		
		return($size);
	}
	
	
	
	/**
	 * Get the complete filesize of a directory as string
	 *
	 * @param String $path
	 * @return String
	 */
	function getDirectorySizeString($path){
		$size = $this->getDirectorySize($path, 0);
		
		$measure = 'Byte';
		
		if($size >= 1024){
			$measure = 'KB';
			$size = $size / 1024;
		}
		
		if($size >= 1024){
			$measure = 'MB';
			$size = $size / 1024;
		}
		
		if($size >= 1024){
			$measure = 'GB';
			$size = $size / 1024;
		}
		
		$size = sprintf("%01.2f", $size);
		
		return $size.'&nbsp;'.$measure;
	}
	
	
	
	/**
	 * Get a new uid for a specific table
	 *
	 * @param Integer $length
	 * @param String $table
	 * @return String
	 */
	function getNewUID($length, $table){
		if($this->db_choosenDB == 'xml'){
			while(($uid = substr(md5(microtime()), 0, $length)) && file_exists($this->administer.'/tcms_'.$table.'/'.$uid.'.xml')){}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			$session_exists = 1;
			
			do{
				$uid = substr(md5(microtime()), 0, $length);
				$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.$table, $uid);
				$uid_exists = $sqlAL->sqlGetNumber($sqlQR);
			}
			while($uid_exists > 0);
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $uid;
	}
	
	
	
	/**
	 * Get the mimetype of an filename
	 *
	 * @param String $filename
	 * @param Boolean $tolower = false
	 * @return String
	 */
	function getMimeType($filename, $tolower = false){
		// get the filename from an url
		if(substr($filename, 0, 7) == 'http://' || substr($filename, 0, 6) == 'ftp://'){
			$filename = substr(strrchr($filename, "/"), 1);
			
			if(strlen($filename) > 6 && strpos($filename, '?'))
				$filename = substr($filename, 0, strpos($filename, '?'));
		}
		
		// tar.gz
		if(strpos($filename, '.tar.gz')){
			$mime = 'tar';
		}
		else{
			$mime = substr(strrchr($filename, '.'), 1);
			
			if($filename == '')
				$mime = 'empty';
			else
				$mime = strtolower(str_replace('.', '', $mime));
		}
		
		if($tolower)
			return strtolower($mime);
		else
			return $mime;
	}
	
	
	
	/**
	 * Get a PHP setting
	 *
	 * @param String $value
	 * @param Boolean $asString
	 * @return Boolean or String
	 */
	function getPHPSetting($value, $asString = false){
		if($asString){
			return ini_get($value);
		}
		else{
			$r = (ini_get($value) == '1' || ini_get($value) == 'on' ? true : false);
			return $r;
		}
	}
	
	
	
	/**
	 * Set a PHP setting
	 *
	 * @param String $setting
	 * @param String $value
	 * @return Boolean
	 */
	function setPHPSetting($setting, $value){
		ini_set($setting, $value);
		return true;
	}
	
	
	
	/**
	 * Check if a array is realy a array
	 *
	 * @param Array $variable
	 * @return Boolean
	 */
	function isArray($variable){
		if(is_array($variable) && isset($variable) && !empty($variable) && $variable != NULL)
			return true;
		else
			return false;
	}
	
	
	
	/**
	 * Check if a file type is a image file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	function isImage($type, $checkType = true){
		if($checkType){
			if($type == 'image/gif'
			|| $type == 'image/png'
			|| $type == 'image/jpg'
			|| $type == 'image/jpeg'
			|| $type == 'image/bmp'
			|| $type == 'image/pjpeg'
			|| $type == 'image/tiff')
				return true;
			else
				return false;
		}
		else{
			if(preg_match('/.jpg/i', strtolower($type))
			|| preg_match('/.jpeg/i', strtolower($type))
			|| preg_match('/.jpe/i', strtolower($type))
			|| preg_match('/.png/i', strtolower($type))
			|| preg_match('/.gif/i', strtolower($type))
			|| preg_match('/.bmp/i', strtolower($type))
			|| preg_match('/.pjpeg/i', strtolower($type)))
				return true;
			else
				return false;
		}
	}
	
	
	
	/**
	 * Check if a file type is a audio file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	function isAudio($type, $checkType = true){
		if($checkType){
			if($type == 'audio/x-mpeg'
			|| $type == 'audio/x-wav'
			|| $type == 'audio/x-midi'
			|| $type == 'audio/mpeg'
			|| $type == 'audio/wma')
				return true;
			else
				return false;
		}
		else{
			if(preg_match('/.mp3/i', strtolower($type))
			|| preg_match('/.wma/i', strtolower($type))
			|| preg_match('/.wav/i', strtolower($type))
			|| preg_match('/.ogg/i', strtolower($type))
			|| preg_match('/.midi/i', strtolower($type)))
				return true;
			else
				return false;
		}
	}
	
	
	/**
	 * Check if a file type is a video file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	function isVideo($type, $checkType = true){
		if($checkType){
			if($type == 'video/mpeg'
			|| $type == 'video/quicktime'
			|| $type == 'video/x-msvideo'
			|| $type == 'video/avi'
			|| $type == 'video/wmv')
				return true;
			else
				return false;
		}
		else{
			if(preg_match('/.avi/i', strtolower($type))
			|| preg_match('/.mpeg/i', strtolower($type))
			|| preg_match('/.mpg/i', strtolower($type))
			|| preg_match('/.wmv/i', strtolower($type))
			|| preg_match('/.qt/i', strtolower($type))
			|| preg_match('/.mov/i', strtolower($type)))
				return true;
			else
				return false;
		}
	}
	
	
	/**
	 * Check if a file type is a multimedia file
	 *
	 * @param String $type
	 * @param Boolean $checkType = true
	 * @return Boolean
	 */
	function isMultimedia($type, $checkType = true){
		if($checkType){
			if($type == 'application/x-shockwave-flash')
				return true;
			else
				return false;
		}
		else{
			if(preg_match('/.swf/i', strtolower($type))
			|| preg_match('/.cab/i', strtolower($type)))
				return true;
			else
				return false;
		}
	}
	
	
	
	/**
	 * Check if a variable is not empty and is set
	 *
	 * @param unknown_type $variable
	 * @return Boolean
	 */
	function isReal($variable){
		if(isset($variable) && trim($variable) != '' && !empty($variable) && $variable != NULL)
			return true;
		else
			return false;
	}
	
	
	
	/**
	 * Checks if a file is CHMODable
	 * 
	 * @return Boolean
	 */
	function isCHMODable($file){
		$perms = fileperms($file);
		
		if($perms !== false)
			if(@chmod($file, $perms ^ 0001)){
				@chmod($file, $perms);
				return true;
			}
		
		return false;
	}
	
	
	
	/**
	 * Deletes a directory beginning at the deepest path
	 * 
	 * @param String $dir
	 * @return Boolean
	 */
	function deleteDir($dir) {
		if(substr($dir, strlen($dir) - 1, 1) != '/')
			$dir .= '/';
		
		if($handle = opendir($dir)){
			while($obj = readdir($handle)){
				if($obj != '.' && $obj != '..'){
					if(is_dir($dir.$obj)){
						if(!$this->deleteDir($dir.$obj))
							return false;
					}
					elseif(is_file($dir.$obj)){
						if(!unlink($dir.$obj))
							return false;
					}
				}
			}
			
			closedir($handle);
			
			if(!@rmdir($dir))
				return false;
			
			return true;
		}
		
		return false;
	}
	
	
	
	/**
	 * Deletes the content of a directory
	 * 
	 * @param String $dir
	 * @return Boolean
	 */
	function deleteDirContent($dir) {
		if(substr($dir, strlen($dir) - 1, 1) != '/')
			$dir .= '/';
		
		if($handle = opendir($dir)){
			while($obj = readdir($handle)){
				if($obj != '.' && $obj != '..'){
					if(is_dir($dir.$obj)){
						if(!$this->deleteDir($dir.$obj))
							return false;
					}
					elseif(is_file($dir.$obj)){
						if(!unlink($dir.$obj))
							return false;
					}
				}
			}
			
			closedir($handle);
			
			return true;
		}
		
		return false;
	}
	
	
	
	/**
	 * Encode (cipher) a string to a base64 crypt string
	 *
	 * @param String $value
	 * @return String
	 */
	function encodeBase64($value){
		$value = base64_encode($value);
		
		return $value;
	}
	
	
	
	/**
	 * Decode (decipher) a string from a base64 crypt string
	 *
	 * @param String $value
	 * @return String
	 */
	function decodeBase64($value){
		$value = base64_decode($value);
		
		return $value;
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
	function encodeText($text, $quote, $charset, $withoutEncryption = false, $withoutDatabase = false){
		$trans = get_html_translation_table(HTML_ENTITIES);
		
		switch($quote){
			case '1':
				//$_SET = ENT_COMPAT;
				//$tmp = htmlentities($text, $_SET, $charset);
				$trans = array_flip($trans);
				$text = strtr($text, $trans);
				break;
			
			case '2':
				$trans = array_flip($trans);
				$text = str_replace('=', '__________', $text);
				$text = strtr($text, $trans);
				$text = $this->ampReplace($text);
				$text = htmlentities($text);
				
				if(extension_loaded('mbstring')){
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
		
		if($withoutEncryption == false){
			if($withoutDatabase == false){
				include($this->administer.'/tcms_global/database.php');
				$thisDB = $this->secure_password($tcms_db_engine, 'en');
				
				if($thisDB == 'xml') $encode = true;
				else $encode = false;
			}
			else{
				$encode = true;
			}
			
			if($encode){
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
	function decodeText($text, $quote, $charset, $withoutEncryption = false, $withoutDatabase = false){
		if($withoutEncryption == false){
			if($withoutDatabase == false){
				include($this->administer.'/tcms_global/database.php');
				$thisDB = $this->secure_password($tcms_db_engine, 'en');
				
				if($thisDB == 'xml') $encode = true;
				else $encode = false;
			}
			else{
				$encode = true;
			}
			
			if($encode){
				$text = base64_decode($text);
				$text = unserialize($text);
			}
		}
		
		$trans = get_html_translation_table(HTML_ENTITIES);
		
		switch($quote){
			case '1':
				//$_SET = ENT_COMPAT;
				//$text = html_entity_decode($text, $_SET, $charset);
				$text = strtr($text, $trans);
				break;
			
			case '2':
				$trans = array_flip($trans);
				
				$text = str_replace('__________', '=', $text);
				
				$text = strtr($text, $trans);
				
				$text = stripslashes($text);
				break;
			
			case '3':
				//$_SET = ENT_NOQUOTES;
				//$text = html_entity_decode($text, $_SET, $charset);
				$text = strtr($text, $trans);
				break;
		}
		
		return $text;
	}
	
	
	
	/**
	 * Secure or unsecure a password string
	 *
	 * @param String $password
	 * @param Boolean $encode = true
	 * @return String
	 */
	function securePassword($password, $encode = true){
		/*
		if($encode){
			$password = unserialize($password);
			$password = str_rot13($password);
		}
		else{
			$password = str_rot13($password);
			$password = serialize($password);
		}
		*/
		return $password;
	}
	
	
	
	/**
	 * Check if a link is a weblink
	 *
	 * @param String $link
	 * @return Boolean
	 */
	function checkWebLink($link){
		if(substr($link, 0, 7) == 'http://' || substr($link, 0, 6) == 'ftp://')
			return true;
		else
			return false;
	}
	
	
	
	/**
	 * Check if a usergroup can read a access level
	 *
	 * @param String $access
	 * @param String $usergroup
	 * @return Boolean
	 */
	function checkAccess($access, $usergroup){
		$show_this = true;
		
		if($access == 'Public'){
			$show_this = true;
		}
		elseif($access == 'Protected'){
			if($usergroup == 'User'
			|| $usergroup == 'Administrator'
			|| $usergroup == 'Developer'
			|| $usergroup == 'Editor'
			|| $usergroup == 'Presenter')
				$show_this = true;
			else
				$show_this = false;
		}
		elseif($access == 'Private'){
			if($usergroup == 'Administrator'
			|| $usergroup == 'Developer')
				$show_this = true;
			else
				$show_this = false;
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
	function cleanUrlString($text, $withHtmlEntities = false){
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
	function cleanGBLink($text){
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
	function cleanGBScript($text){
		$text = preg_replace("'/<script[^>]*>/i.*?/</script>/gi'", '', $text);
		$text = preg_replace("'<?php*.*?\?>'", '', $text);
		$text = str_replace('<?', '', $text);
		$text = str_replace('?>', '', $text);
		$text = preg_replace('/{.+?}/', '', $text);
		
		return $text;
	}
	
	
	
	/**
	 * Clean a filename
	 *
	 * @param String $file
	 * @return String
	 */
	function cleanFilename($file){
		$file = preg_replace("'<script[^>]*>.*?</script>'", '', $file);
		$file = preg_replace("'<?php*.*?\?>'", '', $file);
		$file = str_replace('<?', '', $file);
		$file = str_replace('?>', '', $file);
		$file = str_replace(' ', '_', $file);
		$file = str_replace('&nbsp;', '_', $file);
		$file = preg_replace('/{.+?}/', '', $file);
		
		return $file;
	}
	
	
	
	/**
	 * Clean a string from images
	 *
	 * @param String $string
	 * @return String
	 */
	function cleanImageFromString($string){
		if(strpos($string, '<img')){
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
	function cleanAllImagesFromString($string){
		if(strpos($string, '<img')){
			while(strpos($string, '<img')){
				$string = $this->cleanImageFromString($string);
			}
		}
		
		return $string;
	}
	
	
	
	/**
	 * Convert a url link into a SEO friendly link
	 * 
	 * @param String $text
	 * @param Boolean $withApmersant = true
	 */
	function urlAmpReplace($text, $withApmersant = true){
		$text = str_replace('&#', '*-*', $text);
		
		if($withApmersant) {
			$text = preg_replace('|&(?![\w]+;)|', '&amp;', $text);
			$text = str_replace('&amp;amp;', '&amp;', $text);
		}
		
		$text = str_replace('*-*', '&#', $text);
		
		if($this->globalSEO == 1){
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
			$text = str_replace('?', $this->globalFolder.'/index.php/', $text);
			$text = str_replace('&amp;', '/', $text);
			$text = str_replace('&', '/', $text);
			
			if($this->urlSEO == 'colon'){
				$text = $this->urlAddColon($text);
			}
			else{
				$text = $this->urlAddSlash($text);
			}
		}
		 
		return $text;
	}
	
	
	
	/**
	 * Convert a equal-char (=) into a slash (/)
	 * 
	 * @param String $text
	 */
	function urlAddSlash($text){
		$text = str_replace('=', '/', $text);
		 
		return $text;
	}
	
	
	
	/**
	 * Convert a equal-char (=) into a colon-char (:)
	 * 
	 * @param String $text
	 */
	function urlAddColon($text){
		$text = str_replace('=', ':', $text);
		 
		return $text;
	}
	
	
	
	/**
	 * --- FUNCTION FROM Joomla! (www.joomla.org) ---
	 * 
	 * Chmods files and directories recursivel to given permissions
	 * 
	 * @param path The starting file or directory (no trailing slash)
	 * @param filemode Integer value to chmod files. NULL = dont chmod files.
	 * @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
	 * @return TRUE=all succeeded FALSE=one or more chmods failed
	 */
	function reCHMOD($path, $filemode = 0777, $dirmode = 1){
		$ret = true;
		
		if(is_dir($path)){
			$dh = opendir($path);
			
			while($file = readdir($dh)){
				if($file != '.' && $file != '..'){
					$fullpath = $path.'/'.$file;
					
					if(is_dir($fullpath)){
						if(!reCHMOD($fullpath, $filemode, $dirmode)){
							$ret = false;
						}
					}
					else{
						if(isset($filemode)){
							if(!@chmod($fullpath, $filemode)){
								$ret = false;
							}
						}
					} // if
				} // if
			} // while
			
			closedir($dh);
			
			if(isset($dirmode))
				if(!@chmod($path, $dirmode)){
					$ret = false;
				}
		}
		else{
			if(isset($filemode))
				$ret = @chmod($path, $filemode);
		} // if
		
		return $ret;
	}
	
	
	
	/**
	 * Replace all smiley tags with the icons
	 * 
	 * @param String $msg
	 * @param String $imagePath
	 * @return String
	 */
	function replaceSmilyTags($msg, $imagePath){
		$msg = str_replace(';-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_wink.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(';)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_wink.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_smile.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_smile.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-D', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_laughing.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':D', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_laughing.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-O', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_yell.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':O', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_yell.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-o', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_surprised.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':o', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_surprised.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-(', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sad.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':(', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sad.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-P', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':P', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':-p', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':p', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_tongue_out.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-S', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_undecided.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':S', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_undecided.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('B-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cool.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace('B)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cool.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-|', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_neutral.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':|', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_neutral.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-e', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cry.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':e', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_cry.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('%(|)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_lol.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace(':-/', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sceptic.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace(':/', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_sceptic.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('%-)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_confused.gif" border="0" title="" alt="" />', $msg);
		
		$msg = str_replace('>:)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace('>)', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		$msg = str_replace('>: )', '<img src="'.$imagePath.'engine/images/emoticons/_smiley_evil.gif" border="0" title="" alt="" />', $msg);
		
		return $msg;
	}
	
	
	
	/*
		toendaCMS system class
		
		- in recoding -
	*/
	
	
	
	/***
	* @return unknown
	* @desc Loads from "$path" the content from order-no. "$look4"
	*/
	function xml_readdir_content($look4, $path, $tag, $parenttag, $len){
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
				
				if($look4 == $check_id){
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
	function xml_readdir_content_without($look4, $without,  $path, $tag, $tag2, $parenttag, $len){
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
				
				if($look4 == $check_id){
					if($check_sub != $without){
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
	function count_submenu_xml($look4, $without,  $path, $tag, $tag2, $parenttag, $len){
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
				
				if($check_sub != $without){
					if($look4 == $check_id){
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
	function readdir_comment($path){
		$handle = opendir($path);
		$i = 0;
		while($dir = readdir($handle)){
			if($dir != '.' 
			&& $dir != '..' 
			&& $dir != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $dir != 'index.html'){
				if(substr($dir, 0, 9) == 'comments_'){
					$arr_dirContent[$i] = $dir;
					$i++;
				}
			}
		}
		return ( isset($arr_dirContent) && $arr_dirContent != '' && !empty($arr_dirContent) ? $arr_dirContent : NULL );
	}
	
	
	
	/***
	* @return Array with files from directory
	* @desc Return a array with the files in "path"
	*/
	function readdir_image_comment($path, $cmd){
		$handle = opendir($path);
		$i = 0;
		while($dir = readdir($handle)){
			if($dir != '.' 
			&& $dir != '..' 
			&& $dir != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $dir != 'index.html'){
				$arrThis = $this->readdir_comment($path.$dir.'/');
				
				if(is_array($arrThis)){
					foreach($arrThis as $key => $val){
						$arr_dirContent[$i] = $val;
						$arr_dirAlbum[$i] = $dir;
						$i++;
					}
				}
				
			}
		}
		
		if($cmd == 'image'){
			return ( isset($arr_dirContent) && $arr_dirContent != '' && !empty($arr_dirContent) ? $arr_dirContent : NULL );
		}
		else{
			return ( isset($arr_dirAlbum) && $arr_dirAlbum != '' && !empty($arr_dirAlbum) ? $arr_dirAlbum : NULL );
		}
	}
	
	
	
	/***
	* @return string
	* @desc check unicode problems
	*/
	function ampReplace($text){
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
	
	
	
	/***
	* @return READ A DIR AND RETURN THE CSS FILES
	* @desc Return a array with the files in "path" (only .xml)
	*/
	function load_css_files($path, $file_or_number){
		$handle = opendir($path);
		$i = 0;
		$c = 0;
		
		while($directories = readdir($handle)){
			if($directories != '.' 
			&& $directories != '..' 
			&& $directories != 'CVS' 
			&& $directories != '.svn'
			&& $directories != '_svn'
			&& $directories != '.SVN'
			&& $directories != '_SVN'
			&& $directories != 'index.html'){
				if(strpos($directories, '.css')){
					$arr_css['files'][$i] = $directories;
					$i++;
				}
				else{
					if(!is_file($directories) && !strpos($directories, '.')){
						$arr_css['dir'][$i] = $directories;
						$i++;
					}
				}
			}
		}
		
		if(is_array($arr_css['dir'])){
			foreach($arr_css['dir'] as $key => $value){
				$handle = opendir($path.'/'.$value);
				while($directories = readdir($handle)){
					if($directories != '.' 
					&& $directories != '..' 
					&& $directories != 'CVS' 
					&& $directories != '.svn'
					&& $directories != '_svn'
					&& $directories != '.SVN'
					&& $directories != '_SVN'
					&& $directories != 'index.html'){
						if(strpos($directories, '.css')){
							$arr_css['files'][$i] = $directories;
							$i++;
						}
					}
				}
			}
		}
		
		if($i == 0){
			return NULL;
		}
		else{
			if($file_or_number == 'files'){ return $arr_css; }
			if($file_or_number == 'number'){ return $i; }
		}
	}
	
	
	
	/***
	* @return READ A DIR AND RETURN THE XML FILES OR THE NUMBER
	* @desc Return a array with the files in "path" (only .xml)
	*/
	function count_subid($path, $search_id, $file_or_number){
		$handle = opendir($path);
		$i = 0;
		if(!isset($s)){ $s = 0; }
		
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
				
				if($sub_id == $search_id){ $s++; }
				
				$i++;
			}
		}
		
		if($file_or_number == 'files'){ return $arr_xml['files']; }
		if($file_or_number == 'number'){ return $s; }
	}
	
	
	
	/***
	* @return Array with all poll answers
	* @desc 
	*/
	function count_answers($ca_path){
		$arr_cpoll = $this->load_xml_files($ca_path, 'files');
		$all_answers = 0;
		
		$vote_xml = new xmlparser($ca_path.'.xml', 'r');
		
		$qc = 1;
		do{
			$arr_question[$qc] = $vote_xml->read_section('poll', 'question'.$qc);
			/* COUNT AMOUNT OF QUESTIONS */ $aw[$qc] = $qc;
			/* CREATE ARRAY FOR COUNTING */ $arr_count_answers[$qc] = 0;
			$qc++;
		}while($arr_question[$qc-1] != '__END_POLL_QUESTION__');
		
		if(is_array($arr_cpoll)){
			foreach($arr_cpoll as $key => $value){
				if($value != 'index.html'){
					$res_xml = new xmlparser($ca_path.'/'.$value, 'r');
					$answer  = $res_xml->read_section('vote', 'answer');
					
					for($caq = 1; $caq < $qc; $caq++){
						if($answer == $aw[$caq]){
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
	function count_answers_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $ac_poll, $command){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($command == 'nothing'){
			$qc = 1;
			
			$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'polls', $ac_poll);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			do{
				$question = $sqlARR['question'.$qc];
				if($question != NULL){
					$arr_question[$qc] = $question;
					$aw[$qc] = $qc;
				}
				$qc++;
			}while($arr_question[$qc-1] != NULL);
			
			
			$sqlQR = $sqlAL->sqlGetAll($this->db_prefix."poll_items WHERE  poll_uid='".$ac_poll."'");
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR != 0){
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$answer = $sqlARR['answer'];
					
					for($caq = 1; $caq < $qc; $caq++){
						if($answer == $aw[$caq]){
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
		
		if($command == 'poll_answers'){
			$sqlQR = $sqlAL->sqlGetAll($this->db_prefix."poll_items WHERE  poll_uid='".$ac_poll."'");
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			return $sqlNR;
		}
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	function check_session($session, $webend){
		if($webend == 'user'){ $pp = $this->administer.'/tcms_'; }
		if($webend == 'admin'){ $pp = ''; }
		
		$check_handle = opendir($pp.'session/');
		while($check_file = readdir($check_handle)){
			if($check_file != '.' 
			&& $check_file != '..' 
			&& $check_file != $session 
			&& $check_file != 'CVS' 
			&& $check_file != '.svn'
			&& $check_file != '_svn'
			&& $check_file != '.SVN'
			&& $check_file != '_SVN'
			&& $check_file != 'index.html'){
				if(date('U') - date('U', filemtime($pp.'session/'.$check_file)) > 36000){ unlink($pp.'session/'.$check_file); }
			}
		}
		closedir($check_handle);
	}
	
	
	
	/***
	* @return return username and id
	* @desc 
	*/
	function create_admin($session, $rt = 'id'){
		$sp = fopen('session/'.$session, 'r');
		$m_tag = fread($sp, filesize('session/'.$session));
		fclose($sp);
		
		$m_tag = explode('##', $m_tag);
		$ws_user = $m_tag[0];
		$ws_id   = $m_tag[1];
		
		if($rt == 'user'){ return $ws_user; }
		if($rt == 'id')  { return $ws_id; }
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	function check_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetALL($this->db_prefix.'session');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$checkSessionUID = $sqlARR['uid'];
			
			if($session != $checkSessionUID){
				$checkSessionTime = $sqlARR['date'];
				
				if(date('U') - $checkSessionTime > 36000 || $checkSessionTime == NULL){
					$sqlAL->sqlDeleteOne($this->db_prefix.'session', $checkSessionUID);
					$sqlAL->_sqlAbstractionLayer();
					return true;
				}
				else{ return false; }
			}
		}
	}
	
	
	
	/***
	* @return Check if session in SQL exists
	* @desc 
	*/
	function check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'session', $session);
		$session_exists = $sqlAL->sqlGetNumber($sqlQR);
		
		$sqlAL->_sqlAbstractionLayer();
		unset($sqlAL);
		
		if($session_exists != 0){ return true; }
		else{ return false; }
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	function create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $sqlTable, $sqlField, $forDownload = false, $category = ''){
		if($choosenDB == 'xml'){
			$returnME = 1;
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$session_exists = 1;
			
			if($forDownload == false){
				switch($choosenDB){
					case 'mysql': $sqlStr = 'SELECT MAX(`'.$sqlTable.'`.`'.$sqlField.'`) AS newMax FROM '.$sqlTable; break;
					case 'pgsql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable; break;
					case 'mssql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable; break;
				}
				
				$sqlQR  = $sqlAL->sqlQuery($sqlStr);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				switch($choosenDB){
					case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
					case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
					case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
				}
			}
			else{
				switch($choosenDB){
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
				
				$sqlQR  = $sqlAL->sqlQuery($sqlStr);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				switch($choosenDB){
					case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
					case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
					case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
				}
			}
		}
		
		$sqlAL->_sqlAbstractionLayer();
		
		return $returnME;
	}
	
	
	
	/***
	* @return Checks the session files for his old
	* @desc 
	*/
	function create_sort_id_sub($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $sqlTable, $sqlField, $sqlFromField = '', $sqlFromValue = ''){
		if($choosenDB == 'xml'){
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
					
					switch($sqlTable){
						case $this->db_prefix.'links': $tmpSection = 'link'; break;
						case $this->db_prefix.'user': $tmpSection = 'user'; break;
						default: $tmpSection = 'link'; break;
					}
					
					$tmpCheck = $xmlUser->read_section($tmpSection, $sqlFromField);
					
					if($tmpCheck == $sqlFromValue){
						$i++;
					}
				}
			}
			
			$returnME = $i;
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$session_exists = 1;
			
			switch($choosenDB){
				case 'mysql': $sqlStr = 'SELECT MAX(`'.$sqlTable.'`.`'.$sqlField.'`) AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE '.$sqlFromField.'='.$sqlFromValue : '' ); break;
				case 'pgsql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE '.$sqlFromField.'='.$sqlFromValue : '' ); break;
				case 'mssql': $sqlStr = 'SELECT MAX('.$sqlField.') AS newMax FROM '.$sqlTable.( $sqlFromField != '' ? ' WHERE ['.$sqlFromField.']='.$sqlFromValue : '' ); break;
			}
			
			$sqlQR  = $sqlAL->sqlQuery($sqlStr);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			switch($choosenDB){
				case 'mysql': $returnME = ($sqlARR['newMax'] + 1); break;
				case 'pgsql': $returnME = ($sqlARR['newmax'] + 1); break;
				case 'mssql': $returnME = ($sqlARR['newMax'] + 1); break;
			}
		}
		
		$sqlAL->_sqlAbstractionLayer();
		
		return $returnME;
	}
	
	
	
	/***
	* @return Linkway generating
	* @desc $which
	*      path    => Pathway (as Link)
	*      title   => Sitetitle
	*      pathway => Pathway
	*/
	function linkway($arr_files, $arr_filesT, $c_charset, $session, $s){
		foreach($arr_files as $fnk => $fnvalue){
			if($fnvalue != 'index.html'){
				$link_xml = new xmlparser($this->administer.'/tcms_menu/'.$fnvalue,'r');
				$arr_link['name'][$fnk] = $link_xml->read_value('name');
				$arr_link['id'][$fnk]   = $link_xml->read_value('id');
				$arr_link['link'][$fnk] = $link_xml->read_value('link');
				
				// CHARSETS
				$arr_link['name'][$fnk] = $this->decodeText($arr_link['name'][$fnk], '2', $c_charset);
			}
		}
		
		if($which != 'check_id'){
			array_multisort(
				$arr_link['id'], SORT_ASC, 
				$arr_link['name'], SORT_ASC, 
				$arr_link['link'], SORT_ASC
			);
			
			foreach ($arr_link['link'] as $key => $value){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$value.'&amp;s='.$s;
				$link = $this->urlAmpReplace($link);
				
				$arr_path[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
				$titleway[$value] = $arr_link['name'][$key];
				$pathway[$value]  = $arr_link['name'][$key];
			}
		}
		
		foreach($arr_filesT as $fnk => $fnvalue){
			if($fnvalue != 'index.html'){
				$link_xml = new xmlparser($this->administer.'/tcms_topmenu/'.$fnvalue,'r');
				$arr_link['name'][$fnk] = $link_xml->read_value('name');
				$arr_link['id'][$fnk]   = $link_xml->read_value('id');
				$arr_link['link'][$fnk] = $link_xml->read_value('link');
				
				// CHARSETS
				$arr_link['name'][$fnk] = $this->decodeText($arr_link['name'][$fnk], '2', $c_charset);
			}
		}
		
		if($which != 'check_id'){
			array_multisort(
				$arr_link['id'], SORT_ASC, 
				$arr_link['name'], SORT_ASC, 
				$arr_link['link'], SORT_ASC
			);
			
			foreach ($arr_link['link'] as $key => $value){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$value.'&amp;s='.$s;
				$link = $this->urlAmpReplace($link);
				
				$arr_pathT[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
				$titlewayT[$value] = $arr_link['name'][$key];
				$pathwayT[$value]  = $arr_link['name'][$key];
			}
		}
		
		
		if(is_array($pathwayT) && !empty($pathwayT)){
			foreach($pathwayT as $key => $value){ $tmpPathway[$key] = $value; }
		}
		if(is_array($pathway) && !empty($pathway)){
			foreach($pathway as $key => $value){ $tmpPathway[$key] = $value; }
		}
		
		
		if(!is_array($arr_path)) { $arr_path[0]  = ''; }
		if(!is_array($arr_pathT)){ $arr_pathT[0] = ''; }
		if(!is_array($titleway)) { $titleway[0]  = ''; }
		if(!is_array($titlewayT)){ $titlewayT[0] = ''; }
		
		
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
	function linkwaySQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, $session, $s){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		
		$sqlQR = $sqlAL->sqlGetAll($this->db_prefix.'sidemenu');
		$count = 0;
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_link['name'][$count] = $sqlARR['name'];
			$arr_link['id'][$count]   = $sqlARR['id'];
			$arr_link['link'][$count] = $sqlARR['link'];
			
			if($arr_link['name'][$count] == NULL){ $arr_link['name'][$count] = ''; }
			if($arr_link['id'][$count]   == NULL){ $arr_link['id'][$count]   = ''; }
			if($arr_link['link'][$count] == NULL){ $arr_link['link'][$count] = ''; }
			
			// CHARSETS
			$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		
		if($which != 'check_id'){
			if(is_array($arr_link)){
				array_multisort(
					$arr_link['id'], SORT_ASC, 
					$arr_link['name'], SORT_ASC, 
					$arr_link['link'], SORT_ASC
				);
			}
			
			if(is_array($arr_link['link']) && !empty($arr_link['link'])){
				foreach($arr_link['link'] as $key => $value){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$value.'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_path[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
					$titleway[$value] = $arr_link['name'][$key];
					$pathway[$value]  = $arr_link['name'][$key];
				}
			}
		}
		
		
		$sqlQR = $sqlAL->sqlGetAll($this->db_prefix.'topmenu');
		$count = 0;
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_link['name'][$count] = $sqlARR['name'];
			$arr_link['id'][$count]   = $sqlARR['id'];
			$arr_link['link'][$count] = $sqlARR['link'];
			
			if($arr_link['name'][$count] == NULL){ $arr_link['name'][$count] = ''; }
			if($arr_link['id'][$count]   == NULL){ $arr_link['id'][$count]   = ''; }
			if($arr_link['link'][$count] == NULL){ $arr_link['link'][$count] = ''; }
			
			// CHARSETS
			$arr_link['name'][$count] = $this->decodeText($arr_link['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		
		if($which != 'check_id'){
			if(is_array($arr_link)){
				array_multisort(
					$arr_link['id'], SORT_ASC, 
					$arr_link['name'], SORT_ASC, 
					$arr_link['link'], SORT_ASC
				);
			}
			
			if(is_array($arr_link['link']) && !empty($arr_link['link'])){
				foreach($arr_link['link'] as $key => $value){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$value.'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_pathT[$value] = '<a class="pathway" href="'.$link.'">'.$arr_link['name'][$key].'</a>';
					$titlewayT[$value] = $arr_link['name'][$key];
					$pathwayT[$value]  = $arr_link['name'][$key];
				}
			}
		}
		
		
		if(is_array($pathwayT) && !empty($pathwayT)){
			foreach($pathwayT as $key => $value){ $tmpPathway[$key] = $value; }
		}
		if(is_array($pathway) && !empty($pathway)){
			foreach($pathway as $key => $value){ $tmpPathway[$key] = $value; }
		}
		
		
		if(!is_array($arr_path)) { $arr_path[0]  = ''; }
		if(!is_array($arr_pathT)){ $arr_pathT[0] = ''; }
		if(!is_array($titleway)) { $titleway[0]  = ''; }
		if(!is_array($titlewayT)){ $titlewayT[0] = ''; }
		
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
	function mainmenu($arr_file, $c_charset, $session, $s){
		if(isset($arr_file) && !empty($arr_file) && $arr_file != ''){
			foreach($arr_file as $key => $value){
				if($value != 'index.html'){
					$side_xml = new xmlparser($this->administer.'/tcms_menu/'.$value,'r');
					$arr_menu['name'][$key] = $side_xml->read_value('name');
					$arr_menu['id'][$key]   = $side_xml->read_value('id');
					$arr_menu['sub'][$key]  = $side_xml->read_value('subid');
					$arr_menu['type'][$key] = $side_xml->read_value('type');
					$arr_menu['link'][$key] = $side_xml->read_value('link');
					$arr_menu['pub'][$key]  = $side_xml->read_value('published');
					$arr_menu['auth'][$key] = $side_xml->read_value('access');
					$arr_menu['par'][$key]  = $side_xml->read_value('parent');
					$arr_menu['tar'][$key]  = $side_xml->read_value('target');
					
					// CHARSETS
					$arr_menu['name'][$key] = $this->decodeText($arr_menu['name'][$key], '2', $c_charset);
				}
			}
			
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
			
			foreach($arr_menu['id'] as $mkey => $mvalue){
				if($arr_menu['tar'][$mkey] != '')
					$ltarget = ' target="'.$arr_menu['tar'][$mkey].'"';
				else
					$ltarget = '';
				
				if($arr_menu['type'][$mkey] == 'web'){
					$arr_mainmenu['link'][$mkey] = '<a'.$ltarget.' class="mainlevel" href="'.$arr_menu['link'][$mkey].'">'.$arr_menu['name'][$mkey].'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$arr_menu['link'][$mkey].'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
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
				
				if($arr_menu['type'][$mkey] == 'web'){
					$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.$arr_menu['link'][$mkey].'">'.$arr_menu['name'][$mkey].'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$arr_menu['link'][$mkey].'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.$link.'">'.$arr_menu['name'][$mkey].'</a>';
				}
			}
			
			return $arr_mainmenu;
		}
		else{ return ''; }
	}
	
	
	
	/***
	* @return Mainmenu links (for SQL DB)
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
	function mainmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, $session, $s){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($this->db_prefix.'sidemenu');
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_menu['tag'][$count]  = $sqlARR['uid'];
			$arr_menu['name'][$count] = $sqlARR['name'];
			$arr_menu['id'][$count]   = $sqlARR['id'];
			$arr_menu['sub'][$count]  = $sqlARR['subid'];
			$arr_menu['type'][$count] = $sqlARR['type'];
			$arr_menu['link'][$count] = $sqlARR['link'];
			$arr_menu['par'][$count]  = $sqlARR['parent'];
			$arr_menu['pub'][$count]  = $sqlARR['published'];
			$arr_menu['auth'][$count] = $sqlARR['access'];
			$arr_menu['tar'][$count]  = $sqlARR['target'];
			
			if($arr_menu['name'][$count] == NULL){ $arr_menu['name'][$count] = ''; }
			if($arr_menu['id'][$count]   == NULL){ $arr_menu['id'][$count]   = ''; }
			if($arr_menu['auth'][$count] == NULL){ $arr_menu['auth'][$count] = ''; }
			if($arr_menu['link'][$count] == NULL){ $arr_menu['link'][$count] = ''; }
			if($arr_menu['pub'][$count]  == NULL){ $arr_menu['pub'][$count]  = ''; }
			if($arr_menu['tar'][$count]  == NULL){ $arr_menu['tar'][$count]  = ''; }
			
			// CHARSETS
			$arr_menu['name'][$count] = $this->decodeText($arr_menu['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		if(is_array($arr_menu)){
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
			
			foreach($arr_menu['id'] as $mkey => $mvalue){
				if($arr_menu['tar'][$mkey] != '')
					$ltarget = ' target="'.$arr_menu['tar'][$mkey].'"';
				else
					$ltarget = '';
				
				if($arr_menu['type'][$mkey] == 'web'){
					$arr_mainmenu['link'][$mkey] = '<a'.$ltarget.' class="mainlevel" href="'.trim($arr_menu['link'][$mkey]).'">'.trim($arr_menu['name'][$mkey]).'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$arr_menu['link'][$mkey].'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_mainmenu['link'][$mkey] = '<a'.$ltarget.' class="mainlevel" href="'.$link.'">'.trim($arr_menu['name'][$mkey]).'</a>';
				}
				$arr_mainmenu['auth'][$mkey] = trim($arr_menu['auth'][$mkey]);
				$arr_mainmenu['id'][$mkey] = trim($arr_menu['id'][$mkey]);
				$arr_mainmenu['type'][$mkey] = trim($arr_menu['type'][$mkey]);
				$arr_mainmenu['subid'][$mkey] = trim($arr_menu['sub'][$mkey]);
				$arr_mainmenu['parent'][$mkey] = trim($arr_menu['par'][$mkey]);
				$arr_mainmenu['name'][$mkey] = trim($arr_menu['name'][$mkey]);
				$arr_mainmenu['pub'][$mkey] = trim($arr_menu['pub'][$mkey]);
				$arr_mainmenu['url'][$mkey] = trim($arr_menu['link'][$mkey]);
				
				if($arr_menu['type'][$mkey] == 'web'){
					$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.trim($arr_menu['link'][$mkey]).'">'.trim($arr_menu['name'][$mkey]).'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.trim($arr_menu['link'][$mkey]).'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_mainmenu['submenu'][$mvalue][$mkey] = '<a'.$ltarget.' class="submenu" href="'.$link.'">'.trim($arr_menu['name'][$mkey]).'</a>';
				}
			}
			
			return $arr_mainmenu;
		}
		else{ return ''; }
	}
	
	
	
	/***
	* @return Topmenu links
	* @desc 
	*/
	function topmenu($arr_filename, $c_charset, $session, $s){
		if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
			foreach($arr_filename as $k => $v){
				if($v != 'index.html'){
					$all_xml = new xmlparser($this->administer.'/tcms_topmenu/'.$v,'r');
					$arr_top['name'][$k] = $all_xml->read_value('name');
					$arr_top['id'][$k]   = $all_xml->read_value('id');
					$arr_top['link'][$k] = $all_xml->read_value('link');
					$arr_top['type'][$k] = $all_xml->read_value('type');
					$arr_top['pub'][$k]  = $all_xml->read_value('published');
					$arr_top['acs'][$k]  = $all_xml->read_value('access');
					$arr_top['tar'][$k]  = $all_xml->read_value('target');
					
					// CHARSETS
					$arr_top['name'][$k] = $this->decodeText($arr_top['name'][$k], '2', $c_charset);
				}
			}
			
			array_multisort(
				$arr_top['id'], SORT_ASC, 
				$arr_top['name'], SORT_ASC, 
				$arr_top['pub'], SORT_ASC, 
				$arr_top['acs'], SORT_ASC, 
				$arr_top['type'], SORT_ASC, 
				$arr_top['link'], SORT_ASC, 
				$arr_top['tar'], SORT_ASC
			);
			
			foreach($arr_top['id'] as $key => $value){
				if($arr_top['tar'][$key] != '')
					$ltarget = ' target="'.$arr_top['tar'][$key].'"';
				else
					$ltarget = '';
				
				
				if(trim($arr_top['type'][$key]) == 'web'){
					$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.trim($arr_top['link'][$key]).'">'.trim($arr_top['name'][$key]).'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.trim($arr_top['link'][$key]).'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
					$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.$link.'">'.trim($arr_top['name'][$key]).'</a>';
				}
				
				$arr_top_navi['pub'][$key] = trim($arr_top['pub'][$key]);
				$arr_top_navi['access'][$key] = trim($arr_top['acs'][$key]);
				$arr_top_navi['last'][$key] = max($arr_top['id']);
				$arr_top_navi['id'][$key] = trim($arr_top['link'][$key]);
			}
			
			return $arr_top_navi;
		}
		else{ return ''; }
	}
	
	
	
	/***
	* @return Topmenu links
	* @desc 
	*/
	function topmenuSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $c_charset, $session, $s){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($this->db_prefix.'topmenu');
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arr_top['tag'][$count]    = $sqlARR['uid'];
			$arr_top['name'][$count]   = $sqlARR['name'];
			$arr_top['id'][$count]     = $sqlARR['id'];
			$arr_top['access'][$count] = $sqlARR['access'];
			$arr_top['type'][$count]   = $sqlARR['type'];
			$arr_top['link'][$count]   = $sqlARR['link'];
			$arr_top['pub'][$count]    = $sqlARR['published'];
			$arr_top['tar'][$count]    = $sqlARR['target'];
			
			if($arr_top['name'][$count]   == NULL){ $arr_top['name'][$count]   = ''; }
			if($arr_top['id'][$count]     == NULL){ $arr_top['id'][$count]     = ''; }
			if($arr_top['access'][$count] == NULL){ $arr_top['access'][$count] = ''; }
			if($arr_top['link'][$count]   == NULL){ $arr_top['link'][$count]   = ''; }
			if($arr_top['pub'][$count]    == NULL){ $arr_top['pub'][$count]    = ''; }
			if($arr_top['type'][$count]   == NULL){ $arr_top['type'][$count]   = ''; }
			if($arr_top['tar'][$count]    == NULL){ $arr_top['tar'][$count]    = ''; }
			
			// CHARSETS
			$arr_top['name'][$count] = $this->decodeText($arr_top['name'][$count], '2', $c_charset);
			
			$checkReorder = $count;
			$count++;
		}
		
		if(is_array($arr_top)){
			array_multisort(
				$arr_top['id'], SORT_ASC, 
				$arr_top['name'], SORT_ASC, 
				$arr_top['pub'], SORT_ASC, 
				$arr_top['access'], SORT_ASC, 
				$arr_top['type'], SORT_ASC, 
				$arr_top['link'], SORT_ASC, 
				$arr_top['tar'], SORT_ASC
			);
		}
		
		if(!empty($arr_top) && isset($arr_top)){
			foreach($arr_top['id'] as $key => $value){
				if($arr_top['tar'][$key] != '')
					$ltarget = ' target="'.$arr_top['tar'][$key].'"';
				else
					$ltarget = '';
				
				
				if(trim($arr_top['type'][$key]) == 'web'){
					$arr_top_navi['link'][$key] = '<a'.$ltarget.' class="toplevel" href="'.trim($arr_top['link'][$key]).'">'.trim($arr_top['name'][$key]).'</a>';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.trim($arr_top['link'][$key]).'&amp;s='.$s;
					$link = $this->urlAmpReplace($link);
					
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
		else{ return ''; }
	}
	
	
	
	/***
	* @return max id in content
	* @desc 
	*/
	function get_max_id($backend){
		if($backend == 'admin'){ $path = $this->administer.'/tcms_content/'; }
		if($backend == 'front'){ $path = $this->administer.'/tcms_content/'; }
		$arr_fn = readdir_ext($path);
		$i = 0;
		while(!empty($arr_fn[$i])){
			if($arr_fn[$i] != 'index.html'){
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
	function get_id_array(){
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
	function get_default_contact(){
		$handle = opendir($this->administer.'/tcms_contacts/');
		$i = 0;
		while($files = readdir($handle)){
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& $files != 'index.html'){
				$len = strlen($files);
				$maintag = substr($files, 0, $len);
				
				$all_xml = new xmlparser($this->administer.'/tcms_contacts/'.$files,'r');
				$check_pub = $all_xml->read_section('contact', 'published');
				
				if($check_pub == 1){
					$check_def = $all_xml->read_section('contact', 'default_con');
					if($check_def == 1){
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
	function get_default_sql_contact($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlQuery('SELECT * FROM '.$this->db_prefix.'contacts WHERE default_con = 1 AND published = 1');
		
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		$def_con = $sqlARR['uid'];
		
		return $def_con;
	}
	
	
	
	/***
	* @return splitet sql string
	* @desc 
	*/
	function split_sql($sql){
		$sql = trim($sql);
		$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);
		
		$buffer = array();
		$ret = array();
		$in_string = false;
		
		for($i=0; $i<strlen($sql)-1; $i++){
			if($sql[$i] == ";" && !$in_string){
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}
			
			if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\"){
				$in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")){
				$in_string = $sql[$i];
			}
			
			if(isset($buffer[1])){ $buffer[0] = $buffer[1]; }
			
			$buffer[1] = $sql[$i];
		}
		
		if(!empty($sql)){ $ret[] = $sql; }
		return($ret);
	}
	
	
	
	/***
	* @return Return a cleaned string for PDF output
	* @desc 
	*/
	function cleanHTMLforPDF($string){
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
	
	
	
	/***
	* @return A string where all nl replaced with a <br> tag
	* @desc
	*/
	function nl2br($msg){
		$output = nl2br($msg);
		
		return $output;
	}
	
	
	
	/***
	* @return The amount of news in categories with the given cat uid
	* @desc 
	*/
	function getNewsCatAmount($catUID, $authSQL1, $authSQL2){
		$path = $this->administer.'/tcms_news/';
		$handle = opendir($path);
		$i = 0;
		
		while($files = readdir ($handle)){
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& substr($files, 0, 9) != 'comments_' 
			&& $files != 'index.html'){
				$chkXML = new xmlparser($path.$files, 'r');
				$chkACS = $chkXML->read_section('news', 'access');
				
				// check public rights
				if($chkACS == 'Public'){ $chk = true; }
				
				// check protected rights
				if($authSQL1 != ''){
					if($chk == false){
						if($chkACS == $authSQL1){
							$chk = true;
						}
					}
				}
				
				// check private rights
				if($authSQL2 != ''){
					if($chk == false){
						if($chkACS == $authSQL2){
							$chk = true;
						}
					}
				}
				
				if($chk){
					$chkCAT = $chkXML->read_section('news', 'category');
					$arrCAT = explode('{###}', $chkCAT);
					
					if(in_array($catUID, $arrCAT)){ $i++; }
				}
			}
		}
		
		return $i;
	}
	
	
	
	/***
	* @return
	* @desc Prints a array formated
	*/
	function paf($array){
		echo '<span style="font-size: 12px;"><pre>';
		print_r($array);
		echo '</pre></span>';
	}
	
	
	
	/***
	* @return The index of the last position of a expression
	* @desc The same as strrpos, except $searchThis can be a string
	*/
	function tcms_strrpos($findHere, $searchThis, $offset = 0){
		$strrpos = false;
		
		if(is_string($findHere) && is_string($searchThis) && is_numeric($offset)){
			$strlen = strlen($findHere);
			$strpos = strpos(strrev(substr($findHere, $offset)), strrev($searchThis));
			
			if(is_numeric($strpos)){
				$strrpos = $strlen - $strpos - strlen($searchThis);
			}
		}
		
		return $strrpos;
	}
	
	
	
	/***
	* @return boolean
	* @desc Checks contacts for a default contact
	*/
	function chkDefaultContact(){
		$path = $this->administer.'/tcms_contacts/';
		$handle = opendir($path);
		$i = 0;
		$chkACScount = 0;
		$return = false;
		
		while($files = readdir ($handle)){
			if($files != '.' 
			&& $files != '..' 
			&& $files != 'CVS' 
			&& $files != '.svn'
			&& $files != '_svn'
			&& $files != '.SVN'
			&& $files != '_SVN'
			&& substr($files, 0, 9) != 'comments_' 
			&& $files != 'index.html'){
				$chkXML = new xmlparser($path.$files, 'r');
				$chkACS = $chkXML->read_section('contact', 'default_con');
				
				if($chkACS == 1){ $chkACScount++; }
			}
		}
		
		if($chkACScount > 0){
			$return = true;
		}
		else{
			$return = false;
		}
		
		return $return;
	}
	
	
	
	/***
	* @return string
	* @desc return a string with a command for inserting
	*/
	function returnInsertCommand($n, $show_wysiwyg, $dvalue, $v, $key, $a = 1, $b = '', $c = '', $url = ''){
		$cmdImage = '';
		
		if($url != ''){
			$url = str_replace($this->globalFolder, '', $url);
			$url = str_replace("///", "/", $url);
		}
		
		if(isset($n) && $n == 'without'){
			if(isset($url) && $url != '')
				$rTemp = $url;
			
			if($show_wysiwyg == 'toendaScript')
				$cmdImage = 'setLink(\''.$rTemp.$dvalue.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'toendaScript\')';
			else
				$cmdImage = 'setLink(\''.$rTemp.$dvalue.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'HTML\')';
		}
		else{
			if($show_wysiwyg == 'tinymce' && $v != 'links'){
				if($a == 1)
					$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$dvalue.'&quot;&gt;\' + document.getElementById(\'lb_title_'.$key.'\').value + \'&lt;/a&gt;\');self.close()';
				else
					$cmdImage = 'opener.tinyMCE.execCommand(\'mceInsertContent\', false, \'&lt;a href=&quot;'.$dvalue.'&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;'.$b.'/images/albums/'.$c.'/'.$a.'&quot; border=&quot;0&quot; alt=&quot;\' + document.getElementById(\'lb_title_'.$key.'\').value + \'&quot; /&gt;&lt;/a&gt;\');self.close()';
			}
			else{
				if($show_wysiwyg == 'toendaScript')
					$cmdImage = 'setLink(\''.$dvalue.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'toendaScript\')';
				else
					$cmdImage = 'setLink(\''.$dvalue.'\', document.getElementById(\'lb_title_'.$key.'\').value, \'content\', \'HTML\')';
			}
		}
		
		return $cmdImage;
	}
	
	
	
	/*
		- COMPATIBILITY LAYER -
		
		Deprecated functions
	*/
	
	
	
	/**
	 * DEPRECATED: Get the amount of related files in a path (without directorys)
	 * 
	 * @deprecated
	 * @param String $path
	 * @return Integer
	 */
	function readdir_count($path){
		return $this->getPathContentAmount($path);
	}
	
	
	
	/**
	 * @deprecated
	 * @return Checks the session files for his old
	 * @desc 
	 */
	function create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $sqlTable, $sqlNumber){
		$sqlTable = substr($sqlTable, strlen($this->db_prefix), strlen($sqlTable));
		return $this->getNewUID($sqlNumber, $sqlTable);
	}
	
	
	
	/**
	 * @deprecated
	 * @return return XML ID for username or realname
	 * @desc returns false, if nothing found
	 */
	function getUserFromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $userID){
		return $this->getUser($userID);
	}
	
	
	
	/**
	 * @deprecated
	 * @return Array with files from directory
	 * @desc Return a array with the files in "path"
	 */
	function readdir_ext($path){
		return $this->getPathContent($path);
	}
	
	
	
	/**
	 * @deprecated
	 * @return return username and id
	 * @desc 
	 */
	function create_username($session){
		return $this->getUserInfo($session);
	}
	
	
	
	/**
	 * @deprecated
	 * @return return username and id (SQL)
	 * @desc 
	 */
	function create_sql_username($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session){
		return $this->getUserInfo($session);
	}
	
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function rmdirr($path){
		return $this->deleteDir($path);
	}
	
	
	
	/**
	 * @deprecated
	 * @return return XML ID for username or realname
	 * @desc returns false, if nothing found
	 */
	function getUserIDfromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $realOrNick){
		return $this->getUserID($realOrNick);
	}
	
	
	
	/**
	 * @deprecated
	 * @return string
	 * @desc give a php setting
	 */
	function get_php_setting($val){
		$r = $this->getPHPSetting($val, false);
		return $r ? 'on' : 'off';
	}
	
	
	
	/**
	 * @deprecated
	 * @return boolean
	 * @desc set a php setting
	 */
	function set_php_setting($setting, $val){
		$this->setPHPSetting($setting, $val);
		return true;
	}
	
	
	
	/**
	 * @deprecated
	 * @return return a decoded or encoded string to secure the database password
	 * @desc $de_or_encode -> 'de' or $de_or_encode -> 'en'
	 */
	function secure_password($password_string, $de_or_encode){
		return $this->securePassword($password_string, ( $de_or_encode == 'en' ? true : false ));
	}
	
	
	
	/**
	 * @deprecated
	 * @return boolean
	 * @desc Log the login
	 */
	function log_login($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcmsUserID){
		//$this->updateLoginTime($tcmsUserID);
	}
	
	
	
	/**
	 * @deprecated
	 * @return Checks the session files for his old
	 * @desc 
	 */
	function delete_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlAL->sqlDeleteOne($this->db_prefix.'session', $session);
		
		$sqlAL->_sqlAbstractionLayer();
		return true;
	}
	
	
	
	/**
	 * @deprecated
	 * DECODING TO CHARSETS
	 * --
	 * INPUT 2 SAVE
	 *
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function decode_text($text, $quote, $charset){
		return $this->encodeText($text, $quote, $charset);
	}
	
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function encode_text($text, $quote, $charset){
		return $this->decodeText($text, $quote, $charset);
	}
	
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function decode_text_without_crypt($text, $quote, $charset){
		return $this->encodeText($text, $quote, $charset, true);
	}
	
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function encode_text_without_crypt($text, $quote, $charset){
		return $this->decodeText($text, $quote, $charset, true);
	}
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function decode_text_without_db($text, $quote, $charset){
		return $this->encodeText($text, $quote, $charset, false, true);
	}
	
	
	
	/**
	 * @deprecated
	 * @return With charset convert text
	 * @desc converts text with charset
	 */
	function encode_text_without_db($text, $quote, $charset){
		return $this->decodeText($text, $quote, $charset, false, true);
	}
	
	
	
	/**
	 * @deprecated
	 * @return Checks the session files for his old
	 * @desc 
	 */
	function create_session($webend){
		if($webend == 'user'){ $pp = $this->administer.'/tcms_'; }
		if($webend == 'admin'){ $pp = ''; }
		
		while(($session = md5(microtime())) && file_exists($pp.'session/'.$session)){}
		
		$session_save = fopen($pp.'session/'.$session, 'w');
		fclose($session_save);
		
		chmod($pp.'session/'.$session, 0777);
		
		return $session;
	}
	
	
	
	/**
	 * @deprecated
	 * @return Checks the session files for his old
	 * @desc 
	 */
	function create_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcmsUser, $tcmsUserID){
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$session_exists = 1;
		
		do{
			$session = md5(microtime());
			$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'session', $session);
			$session_exists = $sqlAL->sqlGetNumber($sqlQR);
		}
		while($session_exists > 0);
		
		switch($choosenDB){
			case 'mysql': $newSQLColumns = 'date, user, user_id'; break;
			case 'pgsql': $newSQLColumns = 'date, "user", user_id'; break;
			case 'mssql': $newSQLColumns = '[date], [user], [user_id]'; break;
		}
		$newSQLData = "'".date('U')."', '".$tcmsUser."', '".$tcmsUserID."'";
		
		$sqlQR = $sqlAL->sqlCreateOne($this->db_prefix.'session', $newSQLColumns, $newSQLData, $session);
		
		$sqlAL->_sqlAbstractionLayer();
		
		return $session;
	}
	
	
	
	/**
	 * @deprecated
	 * @return Array
	 * @desc Return a array with the files in "path" (only .xml)
	 */
	function load_xml_files($path, $file_or_number){
		$handle = opendir($path);
		$i = 0;
		while ($directories = readdir ($handle)) {
			if ($directories != '.' 
			&& $directories != '..' 
			&& $directories != 'CVS' 
			&& $directories != '.svn'
			&& $directories != '_svn'
			&& $directories != '.SVN'
			&& $directories != '_SVN'
			&& $directories != 'index.html') {
				
				if(strpos($directories, '.xml')){
					$arr_xml['files'][$i] = $directories;
					$i++;
				}
			}
		}
		
		if($file_or_number == 'files'){ return $arr_xml['files']; }
		if($file_or_number == 'number'){ return $i; }
	}
	
	
	
	/**
	 * Checks if a file is CHMODable
	 * 
	 * @deprecated
	 * @return Boolean
	 */
	function canCHMOD($file){
		$perms = fileperms($file);
		
		if($perms !== false)
			if(@chmod($file, $perms ^ 0001)){
				@chmod($file, $perms);
				return true;
			}
		
		return false;
	}
}




?>
