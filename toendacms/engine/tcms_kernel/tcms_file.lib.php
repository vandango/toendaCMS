<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS File Handling
|
| File:	tcms_file.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS File Handling
 *
 * This class is used to provide a small file
 * handler.
 *
 * @version 0.2.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                       -> PHP5 Constructor
 * tcms_file                         -> PHP4 Constructor
 * __destruct                        -> PHP5 Destructor
 * _tcms_file                        -> PHP4 Destructor
 * 
 * open                              -> Open a file
 * close                             -> Close
 * isEOF                             -> Checks if the end of the file is reched
 * read                              -> Read
 * readLine                          -> Read a line from the active file
 * write                             -> Write
 * backup                            -> Backup
 * changeFile                        -> Change the active file
 * delete                            -> Close and delete the active file
 * deleteCustom                      -> Delete a custom file
 * getFilesize                       -> Get the size of a file in bytes
 * checkDirExist                     -> Checks if a directory exist
 * checkFileExist                    -> Checks if a file exist
 * isCHMODable                       -> Checks if a file is CHMODable
 * CHMOD                             -> Chmod a file
 * reCHMOD                           -> Chmods files and directories recursivel to given permissions
 * getDirectorySize                  -> Get the complete filesize of a directory
 * getDirectorySizeString            -> Get the complete filesize of a directory as a string
 *
 */


class tcms_file {
	private $m_file;
	private $m_openMode;
	private $m_fp;
	
	
	
	/**
	 * PHP5: Default constructor<br>OpenMode:<br>r  - open file for reading<br>r+ - open file for reading and writing<br>w  - open file for reading, reduce content to 0, if it not exist, create it<br>w+ - open file for reading and writing, reduce content to 0, if it not exist, create it<br>a  - open file for reading, char pointer at the end<br>a+ - open file for reading and writing, char pointer at the end
	 * 
	 * @param String $openFile
	 * @param String $openMode
	 */
	function __construct($openFile = '', $openMode = '') {
		if(trim($openFile) != ''
		&& trim($openMode) != '') {
			$this->m_file = $openFile;
			$this->m_openMode = $openMode;
			
			$this->m_fp = fopen($this->m_file, $this->m_openMode);
		}
	}
	
	
	
	/**
	 * PHP4: Default constructor<br>OpenMode:<br>r  - open file for reading<br>r+ - open file for reading and writing<br>w  - open file for reading, reduce content to 0, if it not exist, create it<br>w+ - open file for reading and writing, reduce content to 0, if it not exist, create it<br>a  - open file for reading, char pointer at the end<br>a+ - open file for reading and writing, char pointer at the end
	 * 
	 * @param String $openFile
	 * @param String $openMode
	 */
	function tcms_file($openFile = '', $openMode = '') {
		$this->__construct($openFile, $openMode);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct() {
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_file() {
		$this->__destruct();
	}
	
	
	
	// -------------------------------------------------
	// PROPERTIES
	// -------------------------------------------------
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Open a file<br>OpenMode:<br>r  - open file for reading<br>r+ - open file for reading and writing<br>w  - open file for reading, reduce content to 0, if it not exist, create it<br>w+ - open file for reading and writing, reduce content to 0, if it not exist, create it<br>a  - open file for reading, char pointer at the end<br>a+ - open file for reading and writing, char pointer at the end
	 *
	 * @param String $openFile
	 * @param String $openMode
	 */
	function open($openFile, $openMode) {
		if(trim($openFile) != ''
		&& trim($openMode) != '') {
			$this->m_file = $openFile;
			$this->m_openMode = $openMode;
			
			$this->m_fp = fopen($this->m_file, $this->m_openMode);
		}
	}
	
	
	
	/**
	 * Close the active file
	 */
	function close() {
		fclose($this->m_fp);
	}
	
	
	
	/**
	 * Checks if the end of the file is reched
	 * 
	 * @return Boolean
	 */
	function isEOF() {
		return feof($this->m_fp);
	}
	
	
	
	/**
	 * Read the active file
	 * 
	 * @return String
	 */
	function read() {
		return fread($this->m_fp, filesize($this->m_file));
	}
	
	
	
	/**
	 * Read a line from the active file
	 * 
	 * @return String
	 */
	function readLine() {
		return fgets($this->m_fp);
	}
	
	
	
	/**
	 * Write the active file
	 * 
	 * @param String $content
	 */
	function write($content) {
		fwrite($this->m_fp, $content);
	}
	
	
	
	/**
	 * Backup the active file
	 */
	function backup() {
		/*copy(
			$this->m_file, 
			$this->m_file.'.bak'
		);*/
		
		$tmp = $this->Read();
		
		$fp = fopen($this->m_file.'.bak', 'w+');
		fwrite($fp, $tmp);
		fclose($fp);
	}
	
	
	
	/**
	 * Close the active file and change it
	 * r  - open file for reading
	 * r+ - open file for reading and writing
	 * w  - open file for reading, reduce content to 0, if it not exist, create it
	 * w+ - open file for reading and writing, reduce content to 0, if it not exist, create it
	 * a  - open file for reading, char pointer at the end
	 * a+ - open file for reading and writing, char pointer at the end
	 * 
	 * @param String $openFile
	 * @param String $openMode
	*/
	function changeFile($openFile, $openMode) {
		fclose($this->m_fp);
		
		$this->m_file = $openFile;
		$this->m_openMode = $openMode;
		
		$this->m_fp = fopen($this->m_file, $this->m_openMode);
	}
	
	
	
	/**
	 * Close and delete the active file
	 */
	function delete() {
		$this->fileClose();
		unlink($this->m_fp);
	}
	
	
	
	/**
	 * Delete a custom file
	 * 
	 * @param String $file
	 */
	function deleteCustom($file) {
		unlink($file);
	}
	
	
	
	/**
	 * Get the size of a file in bytes
	 *
	 * @param String $fileWithPath
	 * @return Integer
	 */
	function getFilesize($fileWithPath) {
		return filesize($fileWithPath);
	}
	
	
	
	/**
	 * Checks if a directory exist
	 *
	 * @param string $directoryWithPath
	 * @return bool
	 */
	function checkDirExist($directoryWithPath) {
		if(is_writable($directoryWithPath)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Checks if a file exist
	 *
	 * @param string $fileWithPath
	 * @return bool
	 */
	function checkFileExist($fileWithPath) {
		if(file_exists($fileWithPath)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Checks if a file is CHMODable
	 * 
	 * @return Boolean
	 */
	function isCHMODable($file) {
		$perms = fileperms($file);
		
		if($perms !== false) {
			if(@chmod($file, $perms ^ 0001)) {
				@chmod($file, $perms);
				return true;
			}
		}
		
		return false;
	}
	
	
	
	/**
	 * Chmod a file
	 *
	 * @param String $file
	 * @param Integer $filemode
	 * @return Boolean
	 */
	function CHMOD($file, $filemode = 0777) {
		return @chmod($file, $filemode);
	}
	
	
	
	/**
	 * --- FUNCTION FROM Joomla! (www.joomla.org) ---<br>Chmods files and directories recursivel to given permissions
	 * 
	 * @param String path The starting file or directory (no trailing slash)
	 * @param Integer filemode Integer value to chmod files. NULL = dont chmod files.
	 * @param Integer dirmode Integer value to chmod directories. NULL = dont chmod directories.
	 * @return Boolean TRUE=all succeeded FALSE=one or more chmods failed
	 */
	function reCHMOD($path, $filemode = 0777, $dirmode = 1) {
		$ret = true;
		
		if(is_dir($path)) {
			$dh = opendir($path);
			
			while($file = readdir($dh)) {
				if($file != '.' && $file != '..') {
					$fullpath = $path.'/'.$file;
					
					if(is_dir($fullpath)) {
						if(!reCHMOD($fullpath, $filemode, $dirmode)) {
							$ret = false;
						}
					}
					else{
						if(isset($filemode)) {
							if(!@chmod($fullpath, $filemode)) {
								$ret = false;
							}
						}
					} // if
				} // if
			} // while
			
			closedir($dh);
			
			if(isset($dirmode)) {
				if(!@chmod($path, $dirmode)) {
					$ret = false;
				}
			}
		}
		else {
			if(isset($filemode)) {
				$ret = @chmod($path, $filemode);
			}
		} // if
		
		return $ret;
	}
	
	
	
	/**
	 * Get the complete filesize of a directory
	 *
	 * @param String $path
	 * @param Integer $size
	 * @return Integer
	 */
	function getDirectorySize($path, $size = 0) {
		if(!is_dir($path)) {
			$size += filesize($path);
		}
		else{
			$dir = opendir($path);
			
			while($file = readdir($dir)) {
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
	function getDirectorySizeString($path) {
		$size = $this->getDirectorySize($path, 0);
		
		$measure = 'Byte';
		
		if($size >= 1024) {
			$measure = 'KB';
			$size = $size / 1024;
		}
		
		if($size >= 1024) {
			$measure = 'MB';
			$size = $size / 1024;
		}
		
		if($size >= 1024) {
			$measure = 'GB';
			$size = $size / 1024;
		}
		
		$size = sprintf("%01.2f", $size);
		
		return $size.'&nbsp;'.$measure;
	}
}

?>
