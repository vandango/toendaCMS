<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| XML Parser
|
| File:	tcms_xml.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS XML Parser
 *
 * This class is the toendaCMS internal xml parser.
 *
 * @version 0.3.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * --------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 * --------------------------------------------------------
 * 
 * __construct                -> PHP5 Constructor
 * xmlparser                  -> PHP4 Constructor
 * __destruct                 -> PHP5 Destructor
 * _xmlparser                 -> PHP4 Destructor
 *
 * --------------------------------------------------------
 * PUBLIC METHODS
 * --------------------------------------------------------
 * 
 * xmlToArray                 -> Get the XML file structure as a array
 * openTag                    -> Open a tag
 * readData                   -> Read the data (needs to open and close the tags)
 * closeTag                   -> Close the tag
 * checkTagsExist             -> Check if a tag exist
 * flush                      -> Disposes all values
 * readValue                  -> Read a value from a tag
 * 
 * --------------------------------------------------------
 * DEPRECATED METHODS
 * --------------------------------------------------------
 * 
 * xml_to_array               -> read a xml document and fill an array
 * open_tag                   -> open a tag
 * flush                      -> clear buffer
 * read_value                 -> read an value
 * read_section               -> read an value from section
 * xml_test_tags              -> test for right xml tags (intern)
 * read_data                  -> read the data
 * close_tag                  -> close a tag
 * 
 */


/***********************************
* XML Parser class
*
*
* xml_declaration       -> writes xml declaration (utf-8)
* xml_c_declaration     -> writes xml declaration with custom charset
* xml_section_buffer    -> writes section buffer (intern)
*
* xml_section           -> writes start section tag
* xml_section_end       -> writes end section tag
*
* write_value           -> writes value in section between tags
* write_value_with_attribute -> writes value in section between tags with an attribute
* edit_value            -> edit values in xml files
*
*
* search_value_front    -> search for a word
*
* choose_section        -> choose section (for read_section, intern)
*
**/

class xmlparser {
	var $filename;
	var $content;
	var $sections;
	var $file_handle;
	
	var $domXML;
	var $resXML;
	
	var $arrOutput = array();
	var $strXmlData;
	
	var $writings = 0;
	
	
	
	/**
	 * PHP5: Default constructor
	 */
	function __construct($xml_file, $mode){
		// For Remote (only read-only)
		//
		
		if ($mode == 'o'){
			if(!fopen($xml_file, 'r'))
				die ('Remote XML-File <strong>'.$xml_file.'</strong> not found!');
		}
		else{
			if((!file_exists($xml_file)) && ($mode == 'r'))
				die ('XML-File <strong>'.$xml_file.'</strong> not found!');
		}
		
		$this->filename = $xml_file;
		
		switch ($mode){
			case 'r':
				$this->file_handle = fopen($xml_file, "r");
				$this->content = fread($this->file_handle, filesize($xml_file));
				fclose($this->file_handle);
				
				//$this->content = unserialize($this->content);
				break;
			
			case 'o':
				ob_start();
				$this->content = ob_get_contents();
				ob_end_flush();
				break;
			
			case 'w':
				// If file exists, open and load in buffer, then we make it writable
				//
				if(file_exists($xml_file)){
					$this->file_handle = fopen($xml_file, "r");
					$this->content = fread($this->file_handle, filesize($xml_file));
					@fclose($this->file_handle);
					
					//$this->content = serialize($this->content);
				}
				else{
					// create, if its not exists
					//
					touch($xml_file);
					chmod($xml_file, 0777);
				}
				
				while(false == is_writeable($xml_file)){
					sleep(2);
					$this->writings++;
					
					if ($this->writings > 10){
						die ('<br />Can`t write to file, BREAK!<br />');
					}
				}
				
				$this->file_handle = fopen($xml_file, 'w');
				break;
			
			default: die ('Unknown modus for XML-File '.$this->filename);
		}
		
		//tcms_time::tcms_query_counter();
		
		//$this->domXML = domxml_open_file($xml_file);
		$this->resXML = xml_parser_create();
	}
	
	
	
	/**
	 * PHP4: Default constructor
	 */
	function xmlparser($xml_file, $mode){
		$this->__construct($xml_file, $mode);
	}
	
	
	
	/**
	 * PHP5: Default destructor
	 */
	function __destruct(){
		clearstatcache();
		@fclose($this->file_handle);
	}
	
	
	
	/**
	 * PHP4: Default destructor
	 */
	function _xmlparser(){
		$this->__destruct();
	}
	
	
	
	/*
		Methods
	*/
	
	
	
	/**
	 * Get the XML file structure as a array
	 * 
	 * @return Array
	 */
	function xmlToArray(){
		$strInputXML = $this->content;
		
		xml_set_object($this->resXML, $this);
		xml_set_element_handler($this->resXML, 'open_tag', 'close_tag');
		xml_set_character_data_handler($this->resXML, 'read_data');
		
		$this->strXmlData = xml_parse($this->resXML, $strInputXML);
		
		if(!$this->strXmlData){
			echo 'XML error: '
			.xml_error_string(xml_get_error_code($this->resXML))
			.' at line '
			.xml_get_current_line_number($this->resXML);
		}
		
		xml_parser_free($this->resXML);
		
		return $this->arrOutput;
	}
	
	
	
	/**
	 * Open a tag
	 * 
	 * @param Unknown $parser
	 * @param String $name
	 * @param Unknown $attrs
	 */
	function openTag($parser, $name, $attrs){
		$tag = array('name' => $name, 'attribute' => $attrs);
		array_push($this->arrOutput, $tag);
	}
	
	
	
	/**
	 * Read the data (needs to open and close the tags)
	 * 
	 * @param Unknown $parser
	 * @param Unknown $tagData
	 * @return Unknown
	 */
	function readData($parser, $tagData){
		if(trim($tagData)){
			if(isset($this->arrOutput[count($this->arrOutput) - 1]['data'])){
				$this->arrOutput[count($this->arrOutput) - 1]['data'] .= $tagData;
			}
			else{
				$this->arrOutput[count($this->arrOutput) - 1]['data'] = $tagData;
			}
		}
	}
	
	
	
	/**
	 * Close a tag
	 * 
	 * @param Unknown $parser
	 * @param String $name
	 */
	function closeTag($parser, $name){
		$this->arrOutput[count($this->arrOutput) - 2]['children'][] = $this->arrOutput[count($this->arrOutput) - 1];
		array_pop($this->arrOutput);
	}
	
	
	
	/**
	 * Check if a tag exist
	 * 
	 * @param String $starttag
	 * @param String $endtag
	 * @param String $string
	 * @return Boolean
	 */
	function checkTagsExist($starttag, $endtag, $string){
		$tagsOk = true;
		
		if(!ereg($starttag, $string)) {
			//echo 'Error in starttag '.$starttag.' in file '.$this->filename;
			$tagsOk = false;
		}
		
		if(!ereg($endtag, $string)) {
			//echo 'Error in endtag '.$starttag.' in file '.$this->filename;
			$tagsOk = false;
		}
		
		return $tagsOk;
	}
	
	
	
	/**
	 * Disposes all values
	 *
	 */
	function flush(){
		$this->sections = '';
		$this->content = '';
	}
	
	
	
	/**
	 * Read a value from a tag
	 * 
	 * @param String $tag
	 * @return String
	 */
	function readValue($tag) {
		if(ereg($tag, $this->content)){
			$starttag = "<$tag>";
			$endtag = "</$tag>";
			
			if($this->checkTagsExist($starttag, $endtag, $this->content)) {
				$startpos = strpos($this->content, $starttag) + strlen($starttag);
				$endpos = strpos($this->content, $endtag) - $startpos;
				
				$value = substr($this->content, $startpos, $endpos);
				
				return $value;
			}
			else {
				return '';
			}
		}
		
		return '';
	}
	
	
	
	/**
	 * Read a value from a tag inside a section
	 * 
	 * @param String $section
	 * @param String $tag
	 * @return String
	 */
	function readSection($section, $tag){
		$this->choose_section($section);
		
		if(ereg($tag, $this->sections)){
			$starttag = "<$tag>";
			$endtag = "</$tag>";
			
			if($this->checkTagsExist($starttag, $endtag, $this->sections)) {
				$startpos = strpos($this->sections, $starttag) + strlen($starttag);
				$endpos = strpos($this->sections, $endtag) - $startpos;
				
				$value = substr($this->sections, $startpos, $endpos);
				
				return $value;
			}
			else {
				return '';
			}
		}
		
		return '';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	*
	* toenda XML Parser:
	* write to xml file functions
	*
	*/
	
	/*
		Writs section and sectionend in buffer
	*/
	function write_value($tag, $value){
		$this->sections .= "\t<".$tag.">".$value."</".$tag.">\n";
	}
	
	function write_value_with_attribute($tag, $value, $attribute, $attribute_value){
		$this->sections .= "\t<".$tag." ".$attribute."=\"".$attribute_value."\">".$value."</".$tag.">\n";
	}
	
	function xml_section_buffer(){
		fwrite ($this->file_handle, $this->sections);
	}
	
	function xml_declaration(){
		fwrite ($this->file_handle, '<?xml version="1.0" encoding="utf-8"?>');
	}
	
	function xml_c_declaration($charset){
		if(!isset($charset)){ $charset = 'ISO-8859-1'; }
		fwrite ($this->file_handle, '<?xml version="1.0" encoding="'.$charset.'"?>');
	}
	
	function xml_section($section){
		fwrite ($this->file_handle, "<".$section.">\n");
	}
	
	function xml_section_end($section){
		fwrite ($this->file_handle, "\n</".$section.">\n");
	}
	
	/*
		write section content in buffer
	*/
	function choose_section($section){
		if(ereg($section, $this->content)){
			$starttag = "<$section>";
			$endtag = "</$section>";
			
			$this->xml_test_tags($starttag, $endtag, $this->content);
			
			$startpos = strpos($this->content, $starttag) + strlen($starttag);
			$endpos = strpos($this->content, $endtag) - $startpos;
			
			$this->sections = substr($this->content, $startpos, $endpos);
		}
		else{
			echo 'The section '.$section.' dont exists in file '.$this->filename;
		}
	}
	
	
	/*
		replace value in section
	*/
	function edit_value($file_with_path, $tag, $old_value, $new_value){
		//echo "Before replace:<br>";
		//echo $this->sections;
		
		$starttag = '<'.$tag.'>';
		$endtag   = '</'.$tag.'>';
		$old_content = $starttag.$old_value.$endtag;
		$new_content = $starttag.$new_value.$endtag;
		
		$fp = fopen($file_with_path, 'r');
		$file_content = fread($fp, filesize($file_with_path));
		fclose($fp);
		
		$new_file_content = str_replace($old_content, $new_content, $file_content);
		
		$fp = fopen($file_with_path, 'w');
		fwrite($fp, $new_file_content);
		fclose($fp);
		
		//echo "<br><br>After replace:<br>";
		//echo $this->sections;
	}
	
	
	/*
		write on value to one section
	*/
	function write_one_value($file_with_path, $tag, $new_value){
		//echo "Before replace:<br>";
		//echo $this->sections;
		
		$starttag = '<'.$tag.'>';
		$endtag   = '</'.$tag.'>';
		$old_content = $starttag.$endtag;
		$new_content = $starttag.$new_value.$endtag;
		
		$fp = fopen($file_with_path, 'r');
		$file_content = fread($fp, filesize($file_with_path));
		fclose($fp);
		
		$new_file_content = str_replace($old_content, $new_content, $file_content);
		
		$fp = fopen($file_with_path, 'w');
		fwrite($fp, $new_file_content);
		fclose($fp);
		
		//echo "<br><br>After replace:<br>";
		//echo $this->sections;
	}
	
	
	/*
		add on value to one section
	*/
	function add_one_value($file_with_path, $roottag, $tag, $new_value){
		$old_content = '</'.$roottag.'>';
		$new_content = '<'.$tag.'>'.$new_value.'</'.$tag.'>'.$old_content;
		
		$fp = fopen($file_with_path, 'r');
		$file_content = fread($fp, filesize($file_with_path));
		fclose($fp);
		
		$new_file_content = str_replace($old_content, $new_content, $file_content);
		
		$fp = fopen($file_with_path, 'w');
		fwrite($fp, $new_file_content);
		fclose($fp);
		
		//echo "<br><br>After replace:<br>";
		//echo $this->sections;
	}
	
	
	
	
	
	/*
	*
	* toenda XML Parser:
	* search functions
	*
	*/
	
	/*
		replace value in section
	*/
	function search_value_front($section, $tag, $search_word){
		$this->choose_section($section);
		$tcms_main = new tcms_main('data');
		
		if(ereg($tag, $this->sections)){
			$starttag = '<'.$tag.'>';
			$endtag = '</'.$tag.'>';
			
			$this->xml_test_tags($starttag, $endtag, $this->sections);
			
			$startpos = strpos($this->sections, $starttag) + strlen($starttag);
			$endpos = strpos($this->sections, $endtag) - $startpos;
			
			$content_area = substr($this->sections, $startpos, $endpos);
			
			$content_area = $tcms_main->decodeText($content_area, '2', $c_charset);
			
			$search_word = strtolower(trim($search_word));
			$search_area = strtolower(trim($content_area));
			$search_area = ' '.$search_area;
			
			/*******************
			* SEARCH NOW
			*/
			$offset = 0;
			if(strpos($search_area, $search_word, $offset)){
				$pos = strpos($search_area, $search_word, $offset);
				$pos = ( $pos > 23 ? $pos - 20 : $pos );
				$len = ( strlen($search_area) > 80 ? 80 : strlen($search_area) );
				$search_result = ( $pos > 23 ? '... '.substr($content_area, $pos, $len).' ...' : substr($content_area, $pos, $len).' ...' );
				return $search_result;
			}
			else{
				return false;
			}
		}
		
		return false;
	}
	
	
	
	/*
		DEPRECATED
	*/
	
	
	
	/**
	 * @deprecated 
	 * Get the XML file structure as a array
	 * 
	 * @return Array
	 */
	function xml_to_array(){
		//echo $this->domXML->document_element();
		
		$strInputXML = $this->content;
		
		xml_set_object($this->resXML, $this);
		xml_set_element_handler($this->resXML, 'open_tag', 'close_tag');
		xml_set_character_data_handler($this->resXML, 'read_data');
		
		$this->strXmlData = xml_parse($this->resXML, $strInputXML);
		
		if(!$this->strXmlData){
			echo 'XML error: '
			.xml_error_string(xml_get_error_code($this->resXML))
			.' at line '
			.xml_get_current_line_number($this->resXML);
		}
		
		xml_parser_free($this->resXML);
		
		return $this->arrOutput;
	}
	
	
	
	/**
	 * @deprecated 
	 * Open a tag
	 */
	function open_tag($parser, $name, $attrs){
		$tag = array('name' => $name, 'attribute' => $attrs);
		array_push($this->arrOutput, $tag);
	}
	
	/**
	 * @deprecated 
	 * Open a tag
	 */
	function read_data($parser, $tagData){
		if(trim($tagData)){
			if(isset($this->arrOutput[count($this->arrOutput) - 1]['data'])){
				$this->arrOutput[count($this->arrOutput) - 1]['data'] .= $tagData;
			}
			else{
				$this->arrOutput[count($this->arrOutput) - 1]['data'] = $tagData;
			}
		}
	}
	
	
	/**
	 * @deprecated 
	 * Open a tag
	 */
	function close_tag($parser, $name){
		$this->arrOutput[count($this->arrOutput) - 2]['children'][] = $this->arrOutput[count($this->arrOutput) - 1];
		array_pop($this->arrOutput);
	}
	
	
	
	/**
	 * @deprecated 
	 * read value from tag
	 */
	function read_value($tag){
		return $this->readValue($tag);
	}
	
	
	
	/**
	 * @deprecated 
	 * Read a value from a tag inside a section
	 * 
	 * @param String $section
	 * @param String $tag
	 * @return String
	 */
	function read_section($section, $tag){
		return $this->readSection($section, $tag);
	}
	
	
	
	/**
	 * @deprecated 
	 * Check if a tag exist
	 * 
	 * @param String
	 * @param String
	 * @param String
	 */
	function xml_test_tags($starttag, $endtag, $string){
		if(!ereg($starttag, $string)) {
			echo 'Error in starttag '.$starttag.' in file '.$this->filename;
		}
		
		if(!ereg($endtag, $string)) {
			echo 'Error in endtag '.$starttag.' in file '.$this->filename;
		}
	}
}

?>
