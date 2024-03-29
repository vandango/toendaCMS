<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS GD Class
|
| File:	tcms_gd.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS GD Class
 *
 * This class is used for all graphic actions.
 *
 * @version 0.5.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 * 
 * __construct                       -> Constructor
 * __destruct                        -> Destructor
 * 
 * getImageWidth                     -> Get the width of the image (loaded by readImageInformation)
 * getImageHeight                    -> Get the height of the image (loaded by readImageInformation)
 * getImageMimetyp                   -> Get the mimetyp of the image (loaded by readImageInformation)
 * readImageInformation              -> Read information about an image
 * createThumbnail                   -> Create a thumbnail of a image located in "path" and save it to "target_path"
 * createCaptchaImage                -> Creates a captcha image and returns the imagename
 * getLastCaptchaImage               -> Get the last captcha image
 * 
 * DEPRECATED gd_imginfo                        -> Get information about an image
 * DEPRECATED gd_thumbnail                      -> creates thumbnails in png
 * DEPRECATED gd_thumbnail_with_transparency    -> creates thumbnails in png with transparenzy
 * 
 * </code>
 *
 */

class tcms_gd {
	private $m_width;
	private $m_height;
	private $m_mimetype;
	
	private $m_transparentRed;
	private $m_transparentGreen;
	private $m_transparentBlue;
	private $m_signature;
	private $m_version;
	private $m_colorFlag;
	private $m_backgroundIndex;
	
	
	
	/**
	 * Default constructor
	 */
	public function __construct() {
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	/**
	 * Get the width of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	public function getImageWidth() {
		return $this->m_width;
	}
	
	
	
	/**
	 * Get the height of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	public function getImageHeight() {
		return $this->m_height;
	}
	
	
	
	/**
	 * Get the mimetyp of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	public function getImageMimetyp() {
		return $this->m_mimetype;
	}
	
	
	
	/**
	 * Get information about an image
	 *
	 * @return String
	 */
	public function readImageInformation($filename) {
		$arrImageSize = getimagesize($filename);
		
		$this->m_width      = $arrImageSize[0];
		$this->m_height     = $arrImageSize[1];
		$this->m_mimetype   = $arrImageSize['mime'];
		
		$fp = fopen($filename,"rb");
		$result = fread($fp,13);
		
		$this->m_signature  = substr($result,0,3);
		$this->m_version    = substr($result,3,3);
		$ws_width           = ord(substr($result,6,1)) + ord(substr($result,7,1)) * 256;
		$ws_height          = ord(substr($result,8,1)) + ord(substr($result,9,1)) * 256;
		$this->m_colorFlag  = ord(substr($result,10,1)) >> 7;
		$this->m_background = ord(substr($result,11));
		
		if($this->m_colorFlag) {
			$tableSizeNeeded = ($this->m_background + 1) * 3;
			$result = fread($fp, $tableSizeNeeded);
			$this->m_transparentRed   = ord(substr($result, $this->m_background * 3,1));
			$this->m_transparentGreen = ord(substr($result, $this->m_background * 3 + 1,1));
			$this->m_transparentBlue  = ord(substr($result, $this->m_background * 3 + 2,1));
		}
		
		fclose($fp);
	}
	
	
	
	/**
	 * Create a thumbnail of a image located in "path"
	 * and save it to "target_path"
	 * 
	 * @param String $path
	 * @param String $targetPath
	 * @param String $image
	 * @param Integer $size
	 * @param Boolean $withTransparency = false
	 * @param Boolean $sizeInName = false
	 * @return Boolean
	 */
	public function createThumbnail($path, $targetPath, $image, $size, $withTransparency = false, $sizeInName = false) {
		return $this->createThumbnailExt('thumb_', $path, $targetPath, $image, $size, $withTransparency, $sizeInName);
	}
	
	
	
	/**
	 * Create a thumbnail of a image located in "path"
	 * and save it to "target_path"
	 *
	 * @param String $thumbPrefix
	 * @param String $path
	 * @param String $targetPath
	 * @param String $image
	 * @param Integer $size
	 * @param Boolean $withTransparency = false
	 * @param Boolean $sizeInName = false
	 * @return Boolean
	 */
	public function createThumbnailExt($thumbPrefix, $path, $targetPath, $image, $size, $withTransparency = false, $sizeInName = false) {
		include_once('tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		$isImage = true;
		
		switch($tcms_file->getMimeType($path.$image, true)) {
			case 'jpg':
			case 'jpeg':
			case 'jpe':
				//try {
				$img_src = imagecreatefromjpeg($path.$image);
				/*}
				catch(Exception $e) {
					echo $e->getMessage();
				}*/
				break;
			
			case 'png':
				$img_src = @imagecreatefrompng($path.$image);
				break;
			
			case 'gif':
				$img_src = @imagecreatefromgif($path.$image);
				break;
			
			case 'bmp':
				$img_src = @imagecreatefromwbmp($path.$image);
				break;
			
			default:
				$isImage = false;
				break;
		}
		
		if($isImage) {
			$img_o_width  = @imagesx($img_src);
			$img_o_height = @imagesy($img_src);
			
			$X_factor100  = $img_o_width / $size;
			
			if($img_o_width > 0 && $img_o_height > 0) {
				$img_width = $img_o_width / $X_factor100;
				$img_height = $img_o_height / $X_factor100;
				
				if($sizeInName) {
					$img_path = $targetPath.$thumbPrefix.$size.'_'.$image;
				}
				else {
					$img_path = $targetPath.$thumbPrefix.$image;
				}
				
				if($withTransparency) {
					$img_file = @imagecreatetruecolor($img_width, $img_height);
				}
				else {
					//$img_file = @imagecreate($img_width, $img_height);
					$img_file = @imagecreatetruecolor($img_width, $img_height);
					
					$this->readImageInformation($path.$image);
					
					if($this->m_version == '89a' && $this->m_colorFlag == 1) {
						$transparent = @imagecolorallocate($img_file, 
							$this->m_transparentRed, 
							$this->m_transparentGreen, 
							$this->m_transparentBlue);
						@imagecolortransparent ($img_file, $transparent);
					}
				}
				
				@imagecopyresampled(
					$img_file, 
					$img_src, 
					0, 
					0, 
					0, 
					0, 
					$img_width, 
					$img_height, 
					$img_o_width, 
					$img_o_height
				);
				//imagecolortransparent($img_file);
				//@imagepng($img_file, $img_path);
				
				switch($tcms_file->getMimeType($image)) {
					case 'jpg':
					case 'jpeg':
					case 'jpe':
					case 'JPG':
					case 'JPEG':
					case 'JPE':
						@imagejpeg($img_file, $img_path, 75);
						break;
					
					case 'png':
					case 'PNG':
						@imagepng($img_file, $img_path);
						break;
					
					case 'gif':
					case 'GIF':
						@imagegif($img_file, $img_path);
						break;
				}
				
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
	 * Creates a captcha image and returns the imagename
	 * 
	 * @return String
	 */
	public function createCaptchaImage($path, $cacheCleanSize) {
		include_once('tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		mt_srand((double)microtime()*1000000);
		$captcha = mt_rand(10000, 99999);
		
		if($tcms_file->checkFileExist($path.'captcha.txt')) {
			if($tcms_file->getFilesize($path.'captcha.txt') > $cacheCleanSize) {
				$tcms_file->deleteDirContent($path, true);
				
				//mkdir($path, 0777);
				
				$handle = fopen($path.'captcha.txt', 'a');
				fwrite($handle, '');
				fclose($handle);
			}
		}
		
		$captchaFilename = md5($captcha);
		
		$handle = fopen($path.'captcha.txt', 'a');
		fwrite($handle, '-'.$captcha.$captchaFilename);
		fclose($handle);
		
		$cImage = imagecreate(45, 18);
		//$bg = ImageColorAllocate($image, 247, 241, 223);
		$bg = ImageColorAllocate($cImage, 255, 255, 255);
		@imagestring($cImage, 4, 1, 1, $captcha, 1);
		
		@imagepng($cImage, $path.$captchaFilename.'.png');
		//ImageDestroy($image);
		
		return $captchaFilename;
	}
	
	
	
	/**
	 * Get the last captcha image
	 *
	 * @param tcms_main $tcms_main
	 * @param String $path
	 * @param String $captcha
	 * @param String $value
	 * @return String
	 */
	public function getLastCaptchaImage(&$tcms_main, $path, $captcha, $value) {
		include_once('tcms_file.lib.php');
		
		$tcms_file = new tcms_file();
		
		$cnt = $tcms_file->readToEnd($path.'captcha.txt');
		$full = explode('-', $cnt);
		$upper = $tcms_main->countArrayValues($full);
		$lastKey = substr($full[$upper], 0, 5);
		$lastFile = substr($full[$upper], 5);
		
		if($lastFile == $captcha
		&& $value == $lastKey) {
			return $lastKey;
		}
		else {
			return '';
		}
	}
	
	
	
	/**
	 * Generates all the needed data xml files for a
	 * ftp uploaded image folder
	 * 
	 * @param String $path
	 * @param String $targetPath
	 * @param String $choosenDB = 'xml'
	 */
	public function generateFTPImageData($path, $targetPath, $choosenDB = 'xml') {
		global $tcms_main;
		global $tcms_time;
		
		$dir = opendir($path);
		
		if($choosenDB != 'xml') {
			include($tcms_main->getAdministerSite().'/tcms_global/database.php');
			
			$db_user     = $tcms_db_user;
			$db_pass     = $tcms_db_password;
			$db_host     = $tcms_db_host;
			$db_database = $tcms_db_database;
			$db_port     = $tcms_db_port;
			$db_prefix   = $tcms_db_prefix;
			
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($db_user, $db_pass, $db_host, $db_database, $db_port, $tcms_time);
		}
		
		while($entry = readdir($dir)) {
			if($entry != '.' && $entry != '..' && $entry != 'CVS') {
				if($choosenDB == 'xml') {
					$xml = new xmlparser($targetPath.$entry.'.xml', 'w');
					$xml->xmlDeclaration();
					$xml->xml_section('image');
					
					$xml->writeValue('text', $entry);
					$xml->writeValue('timecode', date('YmdHis'));
					
					$xml->xmlSectionBuffer();
					$xml->xmlSectionEnd('image');
					
					$xml->flush();
					unset($xml);
				}
				else {
					$new_image_id = substr(md5(microtime()), 0, 10);
					
					$newSQLColumns = 'album, image, date';
					
					switch($choosenDB) {
						case 'mysql':
							$newSQLColumns = 'album, image, date';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'album, image, "date"';
							break;
						
						case 'mssql':
							$newSQLColumns = '[album], [image], [date]';
							break;
					}
					
					$newSQLData = "'".$image_folder."', '".$entry."', '".date('YmdHis')."'";
					
					$sqlQR = $sqlAL->createOne($db_prefix.'imagegallery', $newSQLColumns, $newSQLData, $new_image_id);
				}
			}
		}
		
		closedir($dir);
		
		if($choosenDB != 'xml') {
			unset($sqlAL);
		}
		
		return $targetPath;
	}
	
	
	
	//------------------------------
	// DEPRECATED METHODS
	//------------------------------
	
	
	
	/**
	 * DEPRECATED: Get information about an image
	 *
	 * @deprecated 
	 * @return String
	 */
	public function gd_imginfo($filename) {
		//$this->readImageInformation($filename);
		
		$fp  = fopen($filename,"rb");
		$result = fread($fp,13);
		
		$this->m_signature  = substr($result,0,3);
		$this->m_version    = substr($result,3,3);
		$this->m_width      = ord(substr($result,6,1)) + ord(substr($result,7,1)) * 256;
		$this->m_height     = ord(substr($result,8,1)) + ord(substr($result,9,1)) * 256;
		$this->m_colorFlag  = ord(substr($result,10,1)) >> 7;
		$this->m_background = ord(substr($result,11));
		
		if($this->m_colorFlag) {
			$tableSizeNeeded = ($this->m_background + 1) * 3;
			$result = fread($fp, $tableSizeNeeded);
			$this->m_transparentRed   = ord(substr($result, $this->m_background * 3,1));
			$this->m_transparentGreen = ord(substr($result, $this->m_background * 3 + 1,1));
			$this->m_transparentBlue  = ord(substr($result, $this->m_background * 3 + 2,1));
		}
		
		fclose($fp);
	}
	
	
	
	/**
	 * DEPRECATED: Create a thumbnail of a image located in "path"
	 * and save it to "target_path"
	 *
	 * @deprecated 
	 * @param String $path
	 * @param String $targetPath
	 * @param String $image
	 * @param Integer $size
	 */
	public function gd_thumbnail($path, $target_path, $image, $size, $w_or_h) {
		//$this->createThumbnail($path, $target_path, $image, $size);
		$targetPath = $target_path;
		
		if(strpos($image, '.jpg') != false || 
		strpos($image, '.jpeg') != false || 
		strpos($image, '.jpe') != false || 
		strpos($image, '.JPG') != false || 
		strpos($image, '.JPEG') != false || 
		strpos($image, '.JPE') != false)
			$img_src = @imagecreatefromjpeg($path.$image);
		
		if(strpos($image, '.png') != false || 
		strpos($image, '.PNG') != false)
			$img_src = @imagecreatefrompng($path.$image);
		
		if(strpos($image, '.gif') != false || 
		strpos($image, '.GIF') != false)
			$img_src = @imagecreatefromgif($path.$image);
		
		$img_o_width  = @imagesx($img_src);
		$img_o_height = @imagesy($img_src);
		
		$X_factor100  = $img_o_width/$size;
		
		$img_width    = $img_o_width/$X_factor100;
		$img_height   = $img_o_height/$X_factor100;
		
		$img_path     = $targetPath.'thumb_'.$image;
		
		$img_file    = @imagecreatetruecolor($img_width, $img_height);
		//$img_file    = imagecreate($img_width, $img_height);
		
		@imagecopyresampled($img_file, $img_src, 0, 0, 0, 0, $img_width, $img_height, $img_o_width, $img_o_height);
		//imagecolortransparent($img_file);
		@imagepng($img_file, $img_path);
	}
	
	
	
	/**
	 * DEPRECATED: Create a thumbnail of a image with
	 * transparency located in "path" and save it to "target_path"
	 *
	 * @deprecated 
	 * @param String $path
	 * @param String $targetPath
	 * @param String $image
	 * @param Integer $size
	 */
	public function gd_thumbnail_with_transparency($path, $target_path, $image, $size, $w_or_h) {
		if( strpos($image, '.jpg') != false || 
			strpos($image, '.jpeg') != false || 
			strpos($image, '.jpe') != false || 
			strpos($image, '.JPG') != false || 
			strpos($image, '.JPEG') != false || 
			strpos($image, '.JPE') != false) { $img_src = @imagecreatefromjpeg($path.$image); }
		
		if( strpos($image, '.png') != false || 
			strpos($image, '.PNG') != false) { $img_src = @imagecreatefrompng($path.$image); }
		
		if( strpos($image, '.gif') != false || 
			strpos($image, '.GIF') != false) { $img_src = @imagecreatefromgif($path.$image); }
		
		$img_o_width  = imagesx($img_src);
		$img_o_height = imagesy($img_src);
		
		if($w_or_h == 'create') {
			$X_factor100  = $img_o_width/$size;
			
			$img_width    = $img_o_width/$X_factor100;
			$img_height   = $img_o_height/$X_factor100;
			
			$img_path     = $target_path.'thumb_'.$image;
			
			//$img_file    = imagecreatetruecolor($img_width, $img_height);
			$img_file    = @imagecreate($img_width, $img_height);
			
			if($this->m_version == '89a' && $this->m_colorFlag == 1) {
				$transparent = @imagecolorallocate($img_file, 
					$this->m_transparentRed, 
					$this->m_transparentGreen, 
					$this->m_transparentBlue);
				@imagecolortransparent ($img_file, $transparent);
			}
			
			@imagecopyresampled($img_file, $img_src, 0, 0, 0, 0, $img_width, $img_height, $img_o_width, $img_o_height);
			
			//imagecolortransparent($img_file);
			@imagepng($img_file, $img_path);
		}
		
		if($w_or_h == 'w') { return $img_o_width; }
		if($w_or_h == 'h') { return $img_o_height; }
	}
}





?>
