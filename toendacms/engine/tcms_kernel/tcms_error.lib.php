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
| File:	tcms_error.lib.php
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
 * @version 0.1.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 *
 * showMessage()               -> Show the error message. If param is true display it as a javascript messagebox.
 * errorCodeTable()            -> A table with all error codes for toendaCMS
 * 
 * </code>
 * 
 */


class tcms_error {
	private $_errorCode;
	private $_errorDesc;
	private $_errorMsg;
	private $_errorInformation;
	private $_file;
	private $_imagePath;
	
	
	
	/**
	 * Default constructor
	 * 
	 * @param String $errorFile
	 * @param Integer $errorCode
	 * @param String $errorInformation
	 * @param String $imagePath
	 */
	public function __construct($errorFile, $errorCode, $errorInformation, $imagePath){
		$this->_file = $errorFile;
		$this->_errorCode = $errorCode;
		$this->_errorInformation = $errorInformation;
		$this->_imagePath = $imagePath;
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct(){
	}
	
	
	
	/**
	 * Show the error message. If param is true
	 * display it as a javascript messagebox.
	 * 
	 * @param String $toendaCMSimage
	 * @param Boolean $bShowMessageBox = true
	 */
	public function showMessage($toendaCMSimage, $bShowMessageBox = true){
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
			.'<img src="'.$toendaCMSimage.'engine/images/tcms_top.gif" border="0" />'
			.'<h1>toendaCMS '._MSG_ERROR.' '.$this->_errorCode.': '.$this->_errorDesc.'</h1>'
			.'<h2>'.$this->_errorMsg.'</h2>'
			.'</div>';
		}
	}
	
	
	
	/**
	 * A table with all error codes for toendaCMS
	 */
	public function errorCodeTable(){
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
