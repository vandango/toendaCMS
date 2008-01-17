<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS ODT Converter
|
| File:	tcms_odtconverter.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS ODT Converter
 *
 * This class is used to convert documents from
 * the opendocument format into html.
 *
 * @version 0.1.6
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
 * __construct                        -> Constructor
 * __destruct                         -> Destructor
 *
 * --------------------------------------------------------
 * PUBLIC METHODS
 * --------------------------------------------------------
 * 
 * unzipFile                          -> Unzip a file an get the contents as xml
 * convertUnzippedContent             -> Convert OpenDocument XML into HTML
 *
 * --------------------------------------------------------
 * PRIVATE METHODS
 * --------------------------------------------------------
 * 
 * _makeImage                         -> Internal function to create a image string
 * _makeNewXmlWithOdfFiles            -> Make new file xml with ODF files xml
 * _modifyTitle                       -> Modify title code html
 * _mvImg                             -> Make directory image and moving images
 * _readXml                           -> Read file xml
 * _replaceContent                    -> Replace content
 * _rewritePosition                   -> Search text in position indice or exposant and transform it
 *
 * --------------------------------------------------------
 * PROTECTED METHODS
 * --------------------------------------------------------
 * 
 * _makePosition                      -> Function is run by method _rewrite_position()
 *
 */


class tcms_odtconverter {
	public $dir = array();
	public $file = array();
	
	private $attribute = '';
	private $body = '';
	private $code = '';
	private $content = '';
	private $ext = array();
	private $id = '';
	private $meta = '';
	private $pattern = '';
	private $position = array();
	private $style = '';
	private $title = '';
	private $buffer = '';
	
	
	
	/**
	 * Default constructor
	 * 
	 * @param String
	 */
	public function __construct($root, $frontend, $file) {
		$this->dir['odf'] = $root.$frontend;
		$this->dir['odf_tmp'] = $this->dir['odf'].'/tmp';
		$this->dir['img'] = $this->dir['odf'].'/img';
		$this->dir['img_src'] = $frontend.'/img';
		
		$this->file['name'] = substr($file, 0, -4);
		$this->file['ext'] = substr($file, -3, 3);
		$this->file['dir_tmp'] = $this->dir['odf_tmp'].'/'.$this->file['name'].'_'.$this->file['ext'];
		$this->file['html_tmp'] = $this->file['dir_tmp'].'_tmp.html';
		$this->file['xml_tmp'] = $this->file['dir_tmp'].'.xml';
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct() {
	}
	
	
	
	// -------------------------------------------------
	// PROPERTIES
	// -------------------------------------------------
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Unzip a file an get the contents as xml
	 *
	 * @param String $filename
	 * @param Object $tcms_file
	 * @return String
	 */
	public function unzipFile($filename, &$tcms_file) {
		//if(!function_exists('zip_open')) {
		//	throw new Exception('NO ZIP FUNCTIONS DETECTED. Do you have the PECL ZIP extensions loaded?');
		//}
		
		if(!is_file($filename)) {
			throw new Exception('Can\'t find file: '.$filename);
		}
		
		$dir = $filename.'_dir/';
		
		//echo 'open zip using PclZip<br />';
		$pcl = new PclZip($filename);
		//$io = new tcms_file();
		
		//include_once('pclzip/pclzip.lib.php');
		//$pcl->listContent();
		
		if(!$tcms_file->checkDirExist($dir)) {
			$tcms_file->createDir($dir);
		}
		
		if($pcl->extract(PCLZIP_OPT_PATH, $dir) == 0){
			die('PclZip ERROR : '.$archive->errorInfo(true));
		}
		
		/*
		echo '<hr />open zip<br />';
		$zip = zip_open($filename);
		
		echo 'read zip<br />';
		$zip_entry = zip_read($zip);
		echo '1. :'.$zip_entry.'<br>';
		*/
		
		$files = $tcms_file->getPathContent($dir);
		
		foreach($files as $key => $value) {
			//echo $key.' - '.$value.'<br>';
			
			if($value == 'content.xml') {
				$tcms_file->open($dir.$value, 'r');
				$content = $tcms_file->read();
				$tcms_file->close();
			}
			
			/*if(ereg('Pictures/', $value) && !ereg('Object', $value)) {
				$img[$value] = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
				zip_entry_close($zip_entry);
			}*/
		}
		
		$tcms_file->deleteDir($dir);
		
		/*
		while($zip_entry = zip_read($zip)) {
			$filename = zip_entry_name($zip_entry);
			
			if(zip_entry_name($zip_entry) == 'content.xml' and zip_entry_open($zip, $zip_entry, "r")) {
				$content = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
				zip_entry_close($zip_entry);
			}
			
			if(ereg('Pictures/', $filename) and !ereg('Object', $filename)  and zip_entry_open($zip, $zip_entry, "r")) {
				$img[$filename] = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
				zip_entry_close($zip_entry);
			}
		}*/
		
		if(isset($content)) {
			/*if(is_array($img)) {
				if(!is_dir($path.'Pictures')) {
					mkdir($path.'Pictures');
				}
				
				foreach($img as $key => $val) {
					file_put_contents($path.$key, $val);
				}
			}*/
			
			return $content;
		}
		else {
			return '';
		}
	}
	
	
	
	/**
	 * Convert OpenDocument XML into HTML
	 *
	 * @param String $xml
	 * @return String
	 */
	public function convertUnzippedContent($xml) {
		$xls = new DOMDocument('');
		$xls->load('../styles/template.xsl');
		
		$xslt = new XSLTProcessor();
		$xslt->importStylesheet($xls);
		
		$x = preg_replace('#<draw:image xlink:href="Pictures/([a-z .A-Z_0-9]*)" (.*?)/>#es', "ODT2XHTML::makeImage('\\1')", $xml);
		
		$xml = new DOMDocument('');
		$xml->loadXML($x);
		
		return html_entity_decode($xslt->transformToXML($xml));
	}
	
	
	
	// -------------------------------------------------
	// PRIVATE MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Function to create a image string
	 *
	 * @param String $name
	 * @return String
	 */
	private function _makeImage($name) {
		return 'xlink:href="'
		.substr($this->dir['img_src'],2)
		.'/'.$this->file['ext']
		.'/'.$this->file['name']
		.'/'.$name.'"';
	}
	
	
	
	/**
	 * Make new file xml with ODF files xml
	 *
	 */
	private function _makeNewXmlWithOdfFiles() {
		// make file xml
		$this->content = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
		
		switch($this->file['ext']) {
			case 'odt' :
			case 'ott' :
				$this->content .= $this->_replace_content('open_element_xml4odt');
				break;
			
			case 'sxw' :
			case 'stt' :
				$this->content .= $this->_replace_content('open_element_xml4sxw');
				break;
		}
		
		$this->_writeFile(
			$this->file['dir_tmp'].'.xml', 
			'w', 
			$this->content
		);
		
		// add meta.xml in file xml
		$this->file['xml'] = $this->file['dir_tmp'].'/meta.xml';
		
		if(file_exists($this->file['xml']) 
		&& is_readable($this->file['xml'])) {
			$this->_readXml($this->file['xml']);
			
			// modify the content
			$this->content = str_replace('<?xml version="1.0" encoding="UTF-8"?>','',$this->content);
			
			switch($this->file['ext']) {
				case 'sxw' :
				case 'stw' :
					$this->content = str_replace(
						'<!DOCTYPE office:document-meta PUBLIC "-//OpenOffice.org//DTD OfficeDocument 1.0//EN" "office.dtd">', 
						'', 
						$this->content
					);
					break;
			}
			
			// build new file xml segun the modified content
			$this->_writeFile(
				$this->file['dir_tmp'].'.xml', 
				'a', 
				$this->content
			);
		}
		else {
			die('Problem with file: '.$this->file['xml']);
		}
		
		// add styles.xml in file xml modified
		$this->file['xml'] = $this->file['dir_tmp'].'/styles.xml';
		
		if(file_exists($this->file['xml']) 
		&& is_readable($this->file['xml'])) {
			$this->_read_xml($this->file['xml']);
			
			// modify the content
			$this->content = str_replace(
				'<?xml version="1.0" encoding="UTF-8"?>', 
				'', 
				$this->content
			);
			
			switch($this->file['ext']) {
				case 'sxw' :
				case 'stw' :
					$this->content = str_replace(
						'<!DOCTYPE office:document-styles PUBLIC "-//OpenOffice.org//DTD OfficeDocument 1.0//EN" "office.dtd">', 
						'', 
						$this->content
					);
					break;
			}
			
			// analyze attribute to transform style's value cm in px
			$this->content = $this->_replaceContent('analyze_attribute');
			
			if(preg_match_all('/<style:header>(.*)<\/style:header>/Us',$this->content,$this->match)) {
				$this->header = str_replace('style:header','text:header',$this->match[0][0]);
			}
			
			if(preg_match_all('/<style:footer>(.*)<\/style:footer>/Us',$this->content,$this->match)) {
				$this->footer = str_replace('style:footer','text:footer',$this->match[0][0]);
			}
			
			// build new file xml segun the modified content
			$this->_writeFile(
				$this->file['dir_tmp'].'.xml', 
				'a', 
				$this->content
			);
		}
		else {
			die('Problem with file: '.$this->file['xml']);
		}
		
		// add content.xml in file xml modified
		$this->file['xml'] = $this->file['dir_tmp'].'/content.xml';
		
		if(file_exists($this->file['xml']) 
		&& is_readable($this->file['xml'])) {
			$this->_read_xml($this->file['xml']);
			
			// modify the content
			$this->content = str_replace(
				'<?xml version="1.0" encoding="UTF-8"?>', 
				'', 
				$this->content
			);
			
			switch($this->file['ext']) {
				case 'odt' :
				case 'ott' :
					if(!empty($this->header)) {
						$this->content = str_replace(
							'<office:text>', 
							'<office:text>'.$this->header, 
							$this->content
						); 
					}
					
					// modify src img
					$this->content = $this->_replace_content('img_odt');
					
					// add footer page
					if(!empty($this->footer)) {
						$this->content = str_replace(
							'</office:text>', 
							$this->footer.'</office:text>', 
							$this->content
						); 
					}
					break;
				
				case 'sxw' :
				case 'stw' :
					$this->content = str_replace(
						'<!DOCTYPE office:document-content PUBLIC "-//OpenOffice.org//DTD OfficeDocument 1.0//EN" "office.dtd">', 
						'', 
						$this->content
					);
					
					// add header page
					if(!empty($this->header)) {
						$this->content = str_replace(
							'<office:body>', 
							'<office:body>'.$this->header, 
							$this->content
						);
					}
					
					// modify src img
					$this->content = $this->_replace_content('img_sxw');
					
					// add footer page
					if(!empty($this->footer)) {
						$this->content = str_replace(
							'</office:body>', 
							$this->footer.'</office:body>', 
							$this->content
						);
					}
					break;
			}
			
			// analyze attribute to transform style's value cm in px
			$this->content = $this->_replaceContent('analyze_attribute');
			
			// search text in position indice or exposant to transform it correctly
			$this->_rewritePosition();
			
			// build new file xml segun the modified content
			$this->_writeFile(
				$this->file['dir_tmp'].'.xml', 
				'a', 
				$this->content
			);
		}
		else {
			die('Problem with file: '.$this->file['xml']);
		}
		
		// modify the content
		$this->content = "\n".'</office:document>'."\n";
		
		// terminate file xml
		$this->_writeFile(
			$this->file['dir_tmp'].'.xml', 
			'a', 
			$this->content
		);
	}

	
	
	/**
	 * Modify title code html
	 *
	 * @return unknown
	 */
	private function _modifyTitle() {
		return "<head>\n\t<title>&quot;".$this->file['name']
		.'.'.$this->file['ext'].'&quot; :: converted by toendaCMS</title>';
	}
	
	
	
	/**
	 * Make directory image and moving images
	 *
	 */
	private function _mvImg() {
		$this->dir['pictures'] = $this->file['dir_tmp'].'/Pictures';
		$this->dir['img_OOo'] = $this->dir['img'].'/php5/'.$this->file['ext'].'/'.$this->file['name'];
		
		// move img
		if(file_exists($this->dir['pictures']) 
		&& $this->handle = opendir($this->dir['pictures'])) {
			// create image directory
			umask(000);
			
			if(!file_exists($this->dir['img']) 
			&& !is_dir($this->dir['img'])) {
				mkdir($this->dir['img'], 0755);
			}
			
			if(!file_exists($this->dir['img'].'/') 
			&& !is_dir($this->dir['img'].'/')) {
				mkdir($this->dir['img'].'/', 0755);
			}
			
			if(!file_exists($this->dir['img'].'/'.$this->file['ext']) 
			&& !is_dir($this->dir['img'].'/'.$this->file['ext'])) {
				mkdir($this->dir['img'].'/'.$this->file['ext'], 0755);
			}
			
			if(!file_exists($this->dir['img_OOo']) 
			&& !is_dir($this->dir['img_OOo'])) {
				mkdir($this->dir['img_OOo'], 0755);
			}
			
			while(false !== $this->file['img'] = readdir($this->handle)) {
				if(is_file($this->dir['pictures'].'/'.$this->file['img'])) {					
					// move img at temp directory to img directory
					if(rename($this->dir['pictures'].'/'.$this->file['img'], $this->dir['img_OOo'].'/'.$this->file['img'])) {
						chmod($this->dir['img_OOo'].'/'.$this->file['img'], 0644);
					}
					else {
						die('Image '.$this->file['img'].' can\'t be moved.');
					}
				}
			}
			
			closedir($this->handle);
		}
		//else die('Directory can\'t be opened: '.$this->dir['img']['tmp']);
	}
	
	
	
	/**
	 * Read file xml
	 *
	 * @param String $xml
	 */
	private function _readXml($xml) {
		$this->handle = fopen($xml, 'r');
		$this->content = fread($this->handle, filesize($this->file['xml']));
		fclose($this->handle);
	}
	
	
	
	/**
	 * Replace content
	 *
	 * @param String $info
	 * @return String
	 */
	private function _replaceContent($info) {
		switch($info) {
			case 'analyze_attribute' :
				$this->exec=1;
				$this->search = '/="(.*?)"/es';
				$this->replace = "odt2xhtml::_analyze_attribute('$1')";
				$this->subject = $this->content;
				break;
			
			case 'img_odt' :
				$this->exec=1;
				$this->search = '#xlink:href="Pictures/([.a-zA-Z_0-9]*)"#es';
				$this->replace = "odt2xhtml::_make_image('$1')";
				$this->subject = $this->content;
				break;
			
			case 'img_sxw' :
				$this->exec=1;
				$this->search = '!xlink:href="\#Pictures/([.a-zA-Z_0-9]*)"!es';
				$this->replace = "odt2xhtml::_make_image('$1')";
				$this->subject = $this->content;
				break;
			
			case 'open_element_xml4odt' :
				$this->buffer = '<office:document xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0">';
				break;
			
			case 'open_element_xml4sxw' :
				$this->buffer = '<office:document xmlns:office="http://openoffice.org/2000/office">';
				break;
			
			case 'title' :
				$this->exec=1;
				$this->search = '/<head>/es';
				$this->replace = "odt2xhtml::_modify_title()";
				$this->subject = $this->file['tmp'];
				break;
		}
		
		if(!empty($this->exec)) {
			$this->buffer = preg_replace(
				$this->search, 
				$this->replace, 
				$this->subject
			);
		}
		
		$tmp = $this->buffer;
		unset($this->buffer, $this->exec);
		
		return $tmp;
	}
	
	
	
	/**
	 * Search text in position indice or exposant and transform it
	 *
	 */
	private function _rewritePosition() 
	{
		# search styles text-position
		switch($this->file['ext']) {
			case 'odt' :
			case 'ott' :
				if(preg_match_all('`<style:style style:name="T([0-9]+)" style:family="text"><style:text-properties style:text-position="(.*?)"/></style:style>`es',$this->content,$this->match)) {
					$this->_make_position($this->match);
				}
			break;
			case 'sxw' :
			case 'stw' :
				if(preg_match_all('`<style:style style:name="T([0-9]+)" style:family="text"><style:properties style:text-position="(.*?)"/></style:style>`es',$this->content,$this->match)) {
					$this->_make_position($this->match);
				}
			break;
		}
		unset($this->match);
		# search text relative to style text-position
		if(!empty($this->position) && preg_match_all('`<text:span text:style-name="T([0-9]+)">(.*?)</text:span>`es',$this->content,$this->match)) {
			
			foreach($this->match[1] as $k => $v) {
				if(in_array($v,$this->position['name'])) {
					foreach($this->position['name'] as $k2 => $v2) {
						if($v2 == $v) {
							$this->position['search'][$k2] = '<text:span text:style-name="T'.$this->position['name'][$k2].'">'.$this->match[2][$k].'</text:span>';
							$this->position['replace'][$k2] = '<text:'.$this->position['string'][$k2].' text:style-name="T'.$this->position['name'][$k2].'">'.$this->match[2][$k].'</text:'.$this->position['string'][$k2].'>';
						}
					}
				}
			}
		}
		unset($this->match);
		# replace search text position par replace text position
		if(!empty($this->position['search']) && is_array($this->position['search'])) {
			foreach($this->position['search'] as $k => $v) {
				$this->content = str_replace($v, $this->position['replace'][$k], $this->content);
			}
		}
		unset($this->position);
	}
	
	/*** Unzip file ODT ***/
	private function _unzip_odf() 
	{
		$archive = new PclZip($this->dir['odf'].'/'.$this->file['name'].'.'.$this->file['ext']);
		
		if($archive->extract(PCLZIP_OPT_PATH, $this->file['dir_tmp']) == 0) 
		{
			die('Error: '.$archive->errorInfo(true));
		}
		
	}
	
	/*** Verify if extension is really odt ***/
	private function _valid_ext() 
	{
		$this->ext['valid'] = array('odt', 'ott', 'stw', 'sxw');
		
		if(!in_array($this->file['ext'], $this->ext['valid'])) {
			die('No valid extension ! The script stop it ! Your extension could be odt, ott or sxw, stw...');
		}
	}
	
	/*** write file ***/
	private function _write_file($filename,$mode,$resource) {
		$this->handle = fopen($filename,$mode);
		fwrite($this->handle,$resource);
		fclose($this->handle);
	}
	
	/*** PHP Convert XML ***/
	private function _xslt_convert_odf() 
	{
		$xls = new DOMDocument();
		$xls->load($this->file['xsl']);
		
		$xslt = new XSLTProcessor();
		$xslt->importStylesheet($xls);

		$xml = new DOMDocument();
		$xml->load($this->file['xml_tmp']);
		
		$this->file['tmp'] = html_entity_decode($xslt->transformToXML($xml));
	}
	
	
	
	// -------------------------------------------------
	// PROTECTED MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Function is run by method _rewrite_position()
	 *
	 * @param unknown_type $match
	 */
	protected function _makePosition($match) {
		if(!empty($match) && is_array($match)) {
			foreach($match[1] as $k => $v) {
				$this->position['name'][$k] = $v;
				$this->position['string'][$k] = substr($match[2][$k], 0, 3);
			}
		}
	}
}

?>
