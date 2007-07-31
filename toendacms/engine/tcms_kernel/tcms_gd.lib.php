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
 * @version 0.3.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 * 
 * __construct                       -> PHP5 Constructor
 * tcms_gd                           -> PHP4 Constructor
 * 
 * getImageWidth                     -> Get the width of the image (loaded by readImageInformation)
 * getImageHeight                    -> Get the height of the image (loaded by readImageInformation)
 * getImageMimetyp                   -> Get the mimetyp of the image (loaded by readImageInformation)
 * readImageInformation              -> Read information about an image
 * createThumbnail                   -> Create a thumbnail of a image located in "path" and save it to "target_path"
 * createCaptchaImage                -> Creates a captcha image and returns the imagename
 * 
 * DEPRECATED gd_imginfo                        -> Get information about an image
 * DEPRECATED gd_thumbnail                      -> creates thumbnails in png
 * DEPRECATED gd_thumbnail_with_transparency    -> creates thumbnails in png with transparenzy
 * DEPRECATED createftp                         -> creates tcms album from uploaded album
 * DEPRECATED createftp_sql                     -> creates tcms album from uploaded album - sql
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
	 * PHP5: Default constructor
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4: Default constructor
	 */
	function tcms_gd(){
		$this->__construct();
	}
	
	
	
	/**
	 * Get the width of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	function getImageWidth(){
		return $this->m_width;
	}
	
	
	
	/**
	 * Get the height of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	function getImageHeight(){
		return $this->m_height;
	}
	
	
	
	/**
	 * Get the mimetyp of the image (loaded by readImageInformation)
	 *
	 * @return String
	 */
	function getImageMimetyp(){
		return $this->m_mimetype;
	}
	
	
	
	/**
	 * Get information about an image
	 *
	 * @return String
	 */
	function readImageInformation($filename){
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
		
		if($this->m_colorFlag){
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
	function createThumbnail($path, $targetPath, $image, $size, $withTransparency = false, $sizeInName = false){
		global $tcms_main;
		
		$isImage = true;
		
		switch($tcms_main->getMimeType($path.$image, true)) {
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
					$img_path = $targetPath.'thumb_'.$size.'_'.$image;
				}
				else {
					$img_path = $targetPath.'thumb_'.$image;
				}
				
				if($withTransparency){
					$img_file = @imagecreatetruecolor($img_width, $img_height);
				}
				else{
					//$img_file = @imagecreate($img_width, $img_height);
					$img_file = @imagecreatetruecolor($img_width, $img_height);
					
					$this->readImageInformation($path.$image);
					
					if($this->m_version == '89a' && $this->m_colorFlag == 1){
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
				
				switch($tcms_main->getMimeType($image)){
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
	function createCaptchaImage($path, $cacheCleanSize){
		global $tcms_main;
		
		mt_srand((double)microtime()*1000000);
		$captcha = mt_rand(10000, 99999);
		
		if(file_exists($path.'captcha.txt')){
			if(filesize($path.'captcha.txt') > $cacheCleanSize){
				$tcms_main->deleteDirContent($path);
				
				//mkdir($path, 0777);
				
				$handle = fopen($path.'captcha.txt', 'a');
				fwrite($handle, '');
				fclose($handle);
			}
		}
		
		$handle = fopen($path.'captcha.txt', 'a');
		fwrite($handle, "$captcha\n");
		fclose($handle);
		
		$cImage = imagecreate(45, 18);
		//$bg = ImageColorAllocate($image, 247, 241, 223);
		$bg = ImageColorAllocate($cImage, 255, 255, 255);
		@imagestring($cImage, 4, 1, 1, $captcha, 1);
		
		@imagepng($cImage, $path.$captcha.'.png');
		//ImageDestroy($image);
		
		return $captcha;
	}
	
	
	
	/**
	 * Generates all the needed data xml files for a
	 * ftp uploaded image folder
	 * 
	 * @param String $path
	 * @param String $targetPath
	 * @param String $choosenDB = 'xml'
	 */
	function generateFTPImageData($path, $targetPath, $choosenDB = 'xml'){
		global $tcms_main;
		global $tcms_time;
		
		$dir = opendir($path);
		
		if($choosenDB != 'xml'){
			include($tcms_main->getAdministerSite().'/tcms_global/database.php');
			
			$db_user     = $tcms_db_user;
			$db_pass     = $tcms_db_password;
			$db_host     = $tcms_db_host;
			$db_database = $tcms_db_database;
			$db_port     = $tcms_db_port;
			$db_prefix   = $tcms_db_prefix;
			
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->connect($db_user, $db_pass, $db_host, $db_database, $db_port, $tcms_time);
		}
		
		while($entry = readdir($dir)){
			if($entry != '.' && $entry != '..' && $entry != 'CVS'){
				if($choosenDB == 'xml'){
					$xml = new xmlparser($targetPath.$entry.'.xml', 'w');
					$xml->xml_declaration();
					$xml->xml_section('image');
					
					$xml->write_value('text', $entry);
					$xml->write_value('timecode', date('YmdHis'));
					
					$xml->xml_section_buffer();
					$xml->xml_section_end('image');
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
				else{
					$new_image_id = substr(md5(microtime()), 0, 10);
					
					$newSQLColumns = 'album, image, date';
					
					switch($choosenDB){
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
		
		if($choosenDB != 'xml')
			unset($sqlAL);
		
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
	function gd_imginfo($filename){
		//$this->readImageInformation($filename);
		
		$fp  = fopen($filename,"rb");
		$result = fread($fp,13);
		
		$this->m_signature  = substr($result,0,3);
		$this->m_version    = substr($result,3,3);
		$this->m_width      = ord(substr($result,6,1)) + ord(substr($result,7,1)) * 256;
		$this->m_height     = ord(substr($result,8,1)) + ord(substr($result,9,1)) * 256;
		$this->m_colorFlag  = ord(substr($result,10,1)) >> 7;
		$this->m_background = ord(substr($result,11));
		
		if($this->m_colorFlag){
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
	function gd_thumbnail($path, $target_path, $image, $size, $w_or_h){
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
	function gd_thumbnail_with_transparency($path, $target_path, $image, $size, $w_or_h){
		if( strpos($image, '.jpg') != false || 
			strpos($image, '.jpeg') != false || 
			strpos($image, '.jpe') != false || 
			strpos($image, '.JPG') != false || 
			strpos($image, '.JPEG') != false || 
			strpos($image, '.JPE') != false){ $img_src = @imagecreatefromjpeg($path.$image); }
		
		if( strpos($image, '.png') != false || 
			strpos($image, '.PNG') != false){ $img_src = @imagecreatefrompng($path.$image); }
		
		if( strpos($image, '.gif') != false || 
			strpos($image, '.GIF') != false){ $img_src = @imagecreatefromgif($path.$image); }
		
		$img_o_width  = imagesx($img_src);
		$img_o_height = imagesy($img_src);
		
		if($w_or_h == 'create'){
			$X_factor100  = $img_o_width/$size;
			
			$img_width    = $img_o_width/$X_factor100;
			$img_height   = $img_o_height/$X_factor100;
			
			$img_path     = $target_path.'thumb_'.$image;
			
			//$img_file    = imagecreatetruecolor($img_width, $img_height);
			$img_file    = @imagecreate($img_width, $img_height);
			
			if($this->m_version == '89a' && $this->m_colorFlag == 1){
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
		
		if($w_or_h == 'w'){ return $img_o_width; }
		if($w_or_h == 'h'){ return $img_o_height; }
	}
	
	
	
	/**
	 * DEPRECATED: Generates all the needed data xml files for a
	 * ftp uploaded image folder
	 * 
	 * @deprecated 
	 * @param String $path
	 * @param String $targetPath
	 */
	function createftp($path, $target_path){
		$dir = opendir($path);
		
		while($entry = readdir($dir)){
			if($entry != '.' && $entry != '..' && $entry != 'CVS'){
				$xmluser = new xmlparser($target_path.$entry.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('image');
				$xmluser->write_value('text', '');
				$xmluser->write_value('timecode', date('YmdHis'));
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('image');
				$xmluser->_xmlparser();
			}
		}
		
		closedir($dir);
		
		return $target_path;
	}
	
	
	
	/**
	 * DEPRECATED: Generates all the needed data in the database for a
	 * ftp uploaded image folder
	 * 
	 * @deprecated 
	 * @param String $choosenDB
	 * @param String $sqlUser
	 * @param String $sqlPass
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param String $sqlPort
	 * @param String $path
	 * @param String $targetPath
	 */
	function createftp_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $path, $image_folder){
		$dir = opendir($path);
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		while($entry = readdir($dir)){
			if($entry != '.' && $entry != '..' && $entry != 'CVS'){
				//$new_image_id = $this->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, 'tcms_imagegallery', 10);
				$new_image_id = substr(md5(microtime()), 0, 10);
				
				$newSQLColumns = 'album, image, date';
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = 'album, image, date';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'album, image, "date"';
						break;
					
					case 'pgsql':
						$newSQLColumns = '[album], [image], [date]';
						break;
				}
				
				$newSQLData = "'".$image_folder."', '".$entry."', '".date('YmdHis')."'";
				
				$sqlQR = $sqlAL->sqlCreateOne('tcms_imagegallery', $newSQLColumns, $newSQLData, $new_image_id);
			}
		}
		
		closedir($dir);
		
		return $image_folder;
	}
}





?>
