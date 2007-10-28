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
 * This class is used to provide all file and directory
 * related methods und functions.
 *
 * @version 0.3.5
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
 * __construct                       -> PHP5 Constructor
 * tcms_file                         -> PHP4 Constructor
 * __destruct                        -> PHP5 Destructor
 * _tcms_file                        -> PHP4 Destructor
 *
 * --------------------------------------------------------
 * PUBLIC METHODS
 * --------------------------------------------------------
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
 * createDir                         -> Create a directory
 * isCHMODable                       -> Checks if a file is CHMODable
 * CHMOD                             -> Chmod a file
 * reCHMOD                           -> Chmods files and directories recursivel to given permissions
 * getDirectorySize                  -> Get the complete filesize of a directory
 * getDirectorySizeString            -> Get the complete filesize of a directory as a string
 * getAllDocuments                   -> Get all documents
 * getPathContentAmount              -> Get the amount of related files in a path (without directorys)
 * getPathContent                    -> Return a array of all files or folders inside a path
 * getPathContentCSSFilesRecursivly  -> Return a array with the files in "path"
 * getXMLFiles                       -> Return a array of all xml files inside a path
 * getMimeType                       -> Get the mimetype of a filename
 * deleteDir                         -> Remove dir with all files and directorys inside
 * deleteDirContent                  -> Remove all files and directorys inside a directory
 * deleteFile                        -> Delete a file (if it exist)
 * 
 * </code>
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
		if(is_writable($directoryWithPath)
		&& is_dir($directoryWithPath)) {
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
	 * Create a directory
	 *
	 * @param String $path
	 */
	function createDir($path) {
		mkdir($path, 0777);
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
	
	
	
	/**
	 * Get all documents
	 * 
	 * @return Array
	 */
	function getAllDocuments() {
		$count = 0;
		
		$c_charset = $this->_tcmsConfig->getCharset();
		
		if($this->db_choosenDB == 'xml') {
			$arr_docs = $this->getPathContent($this->administer.'/tcms_content/');
			
			if(is_array($arr_docs)) {
				unset($val);
				
				foreach($arr_docs as $key => $val) {
					$xml = new xmlparser($this->administer.'/tcms_content/'.$val,'r');
					
					$arrDocuments['id'][$count] = $xml->readSection('main', 'id');
					$arrDocuments['name'][$count] = $this->decodeText(
						$xml->readSection('main', 'title'), '2', $c_charset
					);
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
					
					$count++;
				}
			}
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
			
			$sqlQR = $sqlAL->getAll($this->db_prefix.'content');
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arrDocuments['id'][$count] = $sqlObj->uid;
				$arrDocuments['name'][$count] = $this->decodeText($sqlObj->title, '2', $c_charset);
				
				$count++;
			}
			
			$sqlAL->freeResult($sqlQR);
		}
		
		return $arrDocuments;
	}
	
	
	
	/**
	 * Get the amount of related files in a path (without directorys)
	 * 
	 * @param String $path
	 * @return Integer
	 */
	function getPathContentAmount($path) {
		$handle = opendir($path);
		$i = 0;
		
		while($dir = readdir($handle)) {
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
	function getPathContent($path, $onlyFolders = false, $fileType = '') {
		$i = 0;
		$handle = opendir($path);
		
		while($dir = readdir($handle)) {
			if ($dir != '.'
			&& $dir != '..'
			&& $dir != 'CVS'
			&& $dir != '.svn'
			&& $dir != '_svn'
			&& $dir != '.SVN'
			&& $dir != '_SVN'
			&& substr($dir, 0, 9) != 'comments_'
			&& $dir != 'index.html') {
				if($onlyFolders) {
					if(is_dir($path.$dir)) {
						$arr_dirContent[$i] = $dir;
						$i++;
					}
				}
				else{
					if($fileType == '') {
						$arr_dirContent[$i] = $dir;
						$i++;
					}
					else{
						if(strpos($dir, $fileType)) {
							$arr_dirContent[$i] = $dir;
							$i++;
						}
					}
				}
			}
		}
		
		return ( is_array($arr_dirContent) ? $arr_dirContent : NULL );
	}
	
	
	
	/**
	 * Return a array with the files in "path"
	 * 
	 * @param String $path
	 * @param Unknown $returnOnlyAmount = false
	 * @return READ A DIR AND RETURN THE CSS FILES
	 */
	function getPathContentCSSFilesRecursivly($path, $returnOnlyAmount = false) {
		$handle = opendir($path);
		$i = 0;
		$c = 0;
		
		while($directories = readdir($handle)) {
			if($directories != '.' 
			&& $directories != '..' 
			&& $directories != 'CVS' 
			&& $directories != '.svn'
			&& $directories != '_svn'
			&& $directories != '.SVN'
			&& $directories != '_SVN'
			&& $directories != 'index.html') {
				if(strpos($directories, '.css')) {
					$arr_css['files'][$i] = $directories;
					$i++;
				}
				else{
					if(!is_file($directories) && !strpos($directories, '.')) {
						$arr_css['dir'][$i] = $directories;
						$i++;
					}
				}
			}
		}
		
		if(is_array($arr_css['dir'])) {
			foreach($arr_css['dir'] as $key => $value) {
				$handle = opendir($path.'/'.$value);
				while($directories = readdir($handle)) {
					if($directories != '.' 
					&& $directories != '..' 
					&& $directories != 'CVS' 
					&& $directories != '.svn'
					&& $directories != '_svn'
					&& $directories != '.SVN'
					&& $directories != '_SVN'
					&& $directories != 'index.html') {
						if(strpos($directories, '.css')) {
							$arr_css['files'][$i] = $directories;
							$i++;
						}
					}
				}
			}
		}
		
		if($i == 0) {
			return NULL;
		}
		else{
			if($returnOnlyAmount) {
				return $i;
			}
			else {
				return $arr_css;
			}
		}
	}
	
	
	
	/**
	 * Return a array of all xml files inside a path
	 * 
	 * @param String $path
	 * @return Array
	 */
	function getXMLFiles($path) {
		return $this->getPathContent($path, false, '.xml');
	}
	
	
	
	/**
	 * Get the mimetype of an filename
	 *
	 * @param String $filename
	 * @param Boolean $tolower = false
	 * @return String
	 */
	function getMimeType($filename, $tolower = false) {
		// get the filename from an url
		if(substr($filename, 0, 7) == 'http://' || substr($filename, 0, 6) == 'ftp://') {
			$filename = substr(strrchr($filename, "/"), 1);
			
			if(strlen($filename) > 6 && strpos($filename, '?')) {
				$filename = substr($filename, 0, strpos($filename, '?'));
			}
		}
		
		// tar.gz
		if(strpos($filename, '.tar.gz')) {
			$mime = 'tar';
		}
		else{
			$mime = substr(strrchr($filename, '.'), 1);
			
			if($filename == '') {
				$mime = 'empty';
			}
			else {
				$mime = strtolower(str_replace('.', '', $mime));
			}
		}
		
		if($tolower) {
			return strtolower($mime);
		}
		else {
			return $mime;
		}
	}
	
	
	
	/**
	 * Deletes a directory beginning at the deepest path
	 * 
	 * @param String $dir
	 * @return Boolean
	 */
	function deleteDir($dir) {
		if(substr($dir, strlen($dir) - 1, 1) != '/') {
			$dir .= '/';
		}
		
		if($handle = opendir($dir)) {
			while($obj = readdir($handle)) {
				if($obj != '.' 
				&& $obj != '..'
				&& $obj != 'CVS'
				&& $obj != 'cvs'
				&& $obj != '.SVN'
				&& $obj != '.svn'
				&& $obj != '_svn'
				&& $obj != '_SVN') {
					if(is_dir($dir.$obj)) {
						if(!$this->deleteDir($dir.$obj))
							return false;
					}
					elseif(is_file($dir.$obj)) {
						if(!unlink($dir.$obj))
							return false;
					}
				}
			}
			
			closedir($handle);
			
			if(!@rmdir($dir)) {
				return false;
			}
			
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
		if(substr($dir, strlen($dir) - 1, 1) != '/') {
			$dir .= '/';
		}
		
		if($handle = opendir($dir)) {
			while($obj = readdir($handle)) {
				if($obj != '.' 
				&& $obj != '..'
				&& $obj != 'CVS'
				&& $obj != 'cvs'
				&& $obj != '.SVN'
				&& $obj != '.svn'
				&& $obj != '_svn'
				&& $obj != '_SVN') {
					if(is_dir($dir.$obj)) {
						if(!$this->deleteDir($dir.$obj))
							return false;
					}
					elseif(is_file($dir.$obj)) {
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
	 * Delete a file (if it exist)
	 * 
	 * @param String $file
	 * @return Boolean
	 */
	function deleteFile($file) {
		if(file_exists($file)) {
			unlink($file);
			return true;
		}
		else {
			return false;
		}
	}
}

?>
