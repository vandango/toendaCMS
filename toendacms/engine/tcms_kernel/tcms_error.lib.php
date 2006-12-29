<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Error Handler
|
| File:		tcms_error.lib.php
| Version:	0.0.7
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Error Handler
 *
 * This class is used to provide a small error handler
 * for the CMS framework engine.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_error                  -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_error                 -> PHP4 Destructor
 *
 * showMessage()               -> Show the error message. If param is true display it as a javascript messagebox.
 * errorCodeTable()            -> A table with all error codes for toendaCMS
 *
 */


class tcms_error {
	var $_errorCode;
	var $_errorDesc;
	var $_errorMsg;
	var $_errorInformation;
	var $_file;
	var $_imagePath;
	
	
	
	/**
	 * PHP5 Default constructor
	 * 
	 * @param String $errorFile
	 * @param Integer $errorCode
	 * @param String $errorInformation
	 * @param String $imagePath
	 */
	function __construct($errorFile, $errorCode, $errorInformation, $imagePath){
		$this->_file = $errorFile;
		$this->_errorCode = $errorCode;
		$this->_errorInformation = $errorInformation;
		$this->_imagePath = $imagePath;
	}
	
	
	
	/**
	 * PHP4 Default constructor
	 * 
	 * @param String $errorFile
	 * @param Integer $errorCode
	 * @param String $errorInformation
	 * @param String $imagePath
	*/
	function tcms_error($errorFile, $errorCode, $errorInformation, $imagePath){
		$this->__construct($errorFile, $errorCode, $errorInformation, $imagePath);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_error(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Show the error message. If param is true
	 * display it as a javascript messagebox.
	 * 
	 * @param Boolean $bShowMessageBox = true
	 */
	function showMessage($bShowMessageBox = true){
		if($bShowMessageBox){
			$this->errorCodeTable();
			
			echo '<script type="text/javascript" language="JavaScript">alert(\''
			.'toendaCMS '._MSG_ERROR.'\n'
			._TABLE_FILE.': '.$this->_file.'\n'
			._MSG_ERROR.' '._MSG_CODE.': '.$this->_errorCode.'\n'
			.$this->_errorMsg
			.'\');</script>';
		}
		else{
			$this->errorCodeTable();
			
			echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
			.'<img src="'.$this->_imagePath.'engine/images/tcms_top.jpg" border="0" />'
			.'<h1>toendaCMS '._MSG_ERROR.' '.$this->_errorCode.': '.$this->_errorDesc.'</h1>'
			.'<h2>'.$this->_errorMsg.'</h2>'
			.'</div>';
		}
	}
	
	
	
	/**
	 * A table with all error codes for toendaCMS
	 */
	function errorCodeTable(){
		switch($this->_errorCode){
			case 0:
				$this->_errorMsg = $this->_errorInformation.' Connection Error';
				$this->_errorDesc = 'Connection Error';
				break;
			
			case 1:
			
			case 2:
				$this->_errorMsg = $this->_errorInformation.' Template not found!';
				$this->_errorDesc = 'Template not found!';
				break;
			
			case 500:
				$this->_errorMsg = $this->_errorInformation.' Internal Server Error!';
				$this->_errorDesc = 'Internal Server Error!';
				break;
		}
	}
}

?>
