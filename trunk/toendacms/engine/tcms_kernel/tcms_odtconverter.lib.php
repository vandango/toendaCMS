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
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                       -> Constructor
 * __destruct                        -> Destructor
 * 
 * unzipFile                         -> Unzip a file an get the contents as xml
 * convertUnzippedContent            -> Convert OpenDocument XML into HTML
 * makeImage                         -> Internal function to create a image string
 *
 */


class tcms_odtconverter {
	//private $m_file;
	
	
	
	/**
	 * Default constructor
	 */
	function __construct() {
	}
	
	
	
	/**
	 * Destructor
	 */
	function __destruct() {
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
	 * @return String
	 */
	function unzipFile($filename) {
		if(!function_exists('zip_open')) {
			throw new Exception('NO ZIP FUNCTIONS DETECTED. Do you have the PECL ZIP extensions loaded?');
		}
		
		if(!is_file($filename)) {
			throw new Exception('Can\'t find file: '.$filename);
		}
		
		echo 'open zip<br />';
		$zip = zip_open($filename);
		
		echo 'read zip<br />';
		$zip_entry = zip_read($zip);
		echo '1. :'.$zip_entry.'<br>';
		
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
		}
		
		if(isset($content)) {
			if(is_array($img)) {
				if(!is_dir($path.'Pictures')) {
					mkdir($path.'Pictures');
				}
				
				foreach($img as $key => $val) {
					file_put_contents($path.$key, $val);
				}
			}
			
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
		$xls = new DOMDocument;
		$xls->load('template.xsl');
		
		$xslt = new XSLTProcessor;
		$xslt->importStylesheet($xls);
		
		$x = preg_replace('#<draw:image xlink:href="Pictures/([a-z .A-Z_0-9]*)" (.*?)/>#es', "ODT2XHTML::makeImage('\\1')", $xml);
		
		$xml = new DOMDocument;
		$xml->loadXML($x);
		
		return html_entity_decode($xslt->transformToXML($xml));
	}
	
	
	
	/**
	 * Internal function to create a image string
	 *
	 * @param String $img
	 * @return String
	 */
	public function makeImage($img) {
		return '&lt;img src="Pictures/'.$img.'" border="0" /&gt;';
	}
}

?>
