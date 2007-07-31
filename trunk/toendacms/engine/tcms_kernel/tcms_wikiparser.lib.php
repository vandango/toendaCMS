<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Wiki-Syntax Parser
|
| File:	tcms_wikiparser.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Wiki-Syntax Parser
 *
 * This class is used as a parser and a base class
 * for the toendaScript.
 * 
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * Methods
 *
 * __construct                   -> PHP5 Constructor
 * tcms_wikiparser               -> PHP4 Constructor
 * __destruct                    -> PHP5 Destructor
 * _tcms_wikiparser              -> PHP4 Destructor
 *
 *
 * ------- toendaScript Parser -------
 * 
 * doParse                       -> Start the wiki parser parser
 * 
 * _parseImages                  -> [PRIVATE] Parse the image tags
 * _parseLinebreaks              -> [PRIVATE] Parse the linebreak tags
 * _parseRules                   -> [PRIVATE] Parse the rule tags
 * _parseBold                    -> [PRIVATE] Parse the bold tags
 * _parseItalize                 -> [PRIVATE] Parse the italize tags
 * _parseCenter                  -> [PRIVATE] Parse the center tags
 * _parseLeft                    -> [PRIVATE] Parse the left tags
 * _parseRight                   -> [PRIVATE] Parse the right tags
 * _parseUnderline               -> [PRIVATE] Parse the underline tags
 * _parseHeader                  -> [PRIVATE] Parse the header tags
 * _parseBlockquote              -> [PRIVATE] Parse the blockquote tags
 * _parseTeletyper               -> [PRIVATE] Parse the tetetyper tags
 * _parseUl                      -> [PRIVATE] Parse the ul tags
 * _parseOl                      -> [PRIVATE] Parse the ol tags
 * _parseLi                      -> [PRIVATE] Parse the li tags
 * _parseFontColor               -> [PRIVATE] Parse the fontcolor tags
 * _parseUrl                     -> [PRIVATE] Parse the url tags
 * _parsePHP                     -> [PRIVATE] Parse the php tags
 * _parseExt                     -> [PRIVATE] Parse the ext tags
 * _parseIfThenElse              -> [PRIVATE] Parse the if-then-else tags
 * _parseFilter                  -> [PRIVATE] Parse the filter tags
 * __filter_SessionLinks         -> [PRIVATE] Parse the session
 * __filter_Toenda               -> [PRIVATE] Parse the toenda and toendacms words
 * 
 * </code>
 *
 */


class tcms_wikiparser {
	private $content;
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $content
	 */
	function __construct($content = ''){
		$this->content = $content;
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $content
	 */
	function tcms_wikiparser($content = ''){
		$this->__construct($content);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_wikiparser(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Start the toendaScript parser
	 * 
	 * @return String
	 */
	function doParse(){
		$this->content = $this->_parseImages($this->content);
		$this->content = $this->_parseLinebreaks($this->content);
		$this->content = $this->_parseRules($this->content);
		$this->content = $this->_parseBold($this->content);
		$this->content = $this->_parseItalize($this->content);
		$this->content = $this->_parseCenter($this->content);
		$this->content = $this->_parseLeft($this->content);
		$this->content = $this->_parseRight($this->content);
		$this->content = $this->_parseUnderline($this->content);
		$this->content = $this->_parseHeader($this->content);
		$this->content = $this->_parseBlockquote($this->content);
		$this->content = $this->_parseTeletyper($this->content);
		$this->content = $this->_parseUl($this->content);
		$this->content = $this->_parseOl($this->content);
		$this->content = $this->_parseLi($this->content);
		$this->content = $this->_parseFontColor($this->content);
		$this->content = $this->_parseUrl($this->content);
		$this->content = $this->_parsePHP($this->content);
		$this->content = $this->_parseExt($this->content);
		$this->content = $this->_parseFilter($this->content);
		
		return $this->content;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the image tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseImages($newsContent){
		$output = str_replace('{img#', '<img src="', $newsContent);
		$output = str_replace('#border=', '" border="', $output);
		$output = str_replace('#align=', '" align="', $output);
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		$output = str_replace('#}', '" />', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the linebreak tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseLinebreaks($newsContent){
		return str_replace('{br}', '<br />', $newsContent);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the rule tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseRules($newsContent){
		return str_replace('{hr}', '<hr />', $newsContent);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the bold tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseBold($newsContent){
		$output = str_replace('{b:}', '<strong>', $newsContent);
		$output = str_replace('{:b}', '</strong>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the italize tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseItalize($newsContent){
		$output = str_replace('{i:}', '<em>', $newsContent);
		$output = str_replace('{:i}', '</em>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the center tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseCenter($newsContent){
		$output = str_replace('{center:}', '<div align="center">', $newsContent);
		$output = str_replace('{:center}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the left tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseLeft($newsContent){
		$output = str_replace('{left:}', '<div align="left">', $newsContent);
		$output = str_replace('{:left}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the right tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseRight($newsContent){
		$output = str_replace('{right:}', '<div align="right">', $newsContent);
		$output = str_replace('{:right}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the underline tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseUnderline($newsContent){
		$output = str_replace('{u:}', '<u>', $newsContent);
		$output = str_replace('{:u}', '</u>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the header tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseHeader($newsContent){
		$output = str_replace('{h1:}', '<h1>', $newsContent);
		$output = str_replace('{h2:}', '<h2>', $output);
		$output = str_replace('{h3:}', '<h3>', $output);
		$output = str_replace('{h4:}', '<h4>', $output);
		$output = str_replace('{h5:}', '<h5>', $output);
		$output = str_replace('{h6:}', '<h6>', $output);
		$output = str_replace('{:h1}', '</h1>', $output);
		$output = str_replace('{:h2}', '</h2>', $output);
		$output = str_replace('{:h3}', '</h3>', $output);
		$output = str_replace('{:h4}', '</h4>', $output);
		$output = str_replace('{:h5}', '</h5>', $output);
		$output = str_replace('{:h6}', '</h6>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the blockquote tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseBlockquote($newsContent){
		$output = str_replace('{cite:}', '<blockquote>', $newsContent);
		$output = str_replace('{:cite}', '</blockquote>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the teletyper tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseTeletyper($newsContent){
		$output = str_replace('{tt:}', '<tt>', $newsContent);
		$output = str_replace('{:tt}', '</tt>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the ul tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseUl($newsContent){
		$output = str_replace('{ul:}', '<ul>', $newsContent);
		$output = str_replace('{:ul}', '</ul>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the ol tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseOl($newsContent){
		$output = str_replace('{ol:}', '<ol>', $newsContent);
		$output = str_replace('{:ol}', '</ol>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the li tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseLi($newsContent){
		$output = str_replace('{li:}', '<li>', $newsContent);
		$output = str_replace('{:li}', '</li>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the fontcolor tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseFontColor($newsContent){
		$color = substr(
			$newsContent, 
			strpos($newsContent, '{fc#') + 4, 
			strpos($newsContent, '#}') - 4
		);
		
		switch($color) {
			case 'white':
				$output = str_replace('{fc#'.$color, '<span style="color: #ffffff;', $newsContent);
				break;
			
			case 'black':
				$output = str_replace('{fc#'.$color, '<span style="color: #000000;', $newsContent);
				break;
			
			case 'red':
				$output = str_replace('{fc#'.$color, '<span style="color: #ff0000;', $newsContent);
				break;
			
			case 'green':
				$output = str_replace('{fc#'.$color, '<span style="color: #00ff00;', $newsContent);
				break;
			
			case 'blue':
				$output = str_replace('{fc#'.$color, '<span style="color: #0000ff;', $newsContent);
				break;
			
			default:
				$output = str_replace('{fc#'.$color, '<span style="color: #'.$color.';', $newsContent);
				break;
		}
		
		$output = str_replace('#:}', '">', $output);
		$output = str_replace('{:fc}', '</span>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the url tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseUrl($newsContent){
		$output = str_replace('{url#', '<a href="', $newsContent);
		$output = str_replace('#:}', '">', $output);
		$output = str_replace('#_blank:}', '" target="_blank">', $output);
		$output = str_replace('{:url}', '</a>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the ext tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseExt($newsContent){
		$output = str_replace('{ext#url=', '<iframe src="', $newsContent);
		
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		
		$output = str_replace('#ext}', '" scrolling="auto" marginheight="0" marginwidth="0" frameborder="0" style="border: 0px solid #fff !important;"></iframe>', $output);
		
		if(preg_match('/#width=/', $output))
			$output = str_replace('></iframe>', '></iframe>', $output);
		else
			$output = str_replace('></iframe>', ' width="100%"></iframe>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the if-then-else tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseIfThenElse($newsContent){
		//$output = str_replace('{li:}', '<li>', $newsContent);
		//$output = str_replace('{:li}', '</li>', $output);
		
		if(strpos($newsContent, '{if(')){
			// entscheiden
		}
		
		$output = $newsContent;
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the filter tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parseFilter($newsContent){
		$newsContent = $this->_filter_Toenda($newsContent);
		$newsContent = $this->_filter_SessionLinks($newsContent);
		return $newsContent;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the session
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function __filter_SessionLinks($newsContent){
		//global $session;
		
		//$text = preg_replace('/<a href="/i', '<a href="?session='.$session, $text);
		
		return $newsContent;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the toenda and toendacms words
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function __filter_Toenda($newsContent){
		$text = $newsContent;
		//$text = preg_replace('/toendacms/i', '<a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		/*
		$text = preg_replace('/<p>toendacms/i', '<p><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<b>toendacms/i', '<b><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<strong>toendacms/i', '<strong><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<u>toendacms/i', '<u><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<em>toendacms/i', '<em><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<li>toendacms/i', '<li><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h1>toendacms/i', '<h1><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h2>toendacms/i', '<h2><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h3>toendacms/i', '<h3><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h4>toendacms/i', '<h4><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h5>toendacms/i', '<h5><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h6>toendacms/i', '<h6><a href="http://www.toendacms.com" target="_blank">toendaCMS</a>', $text);
		*/
		//$text = preg_replace('/(Toenda)/i', '<a href="http://www.toenda.com" target="_blank">Toenda</a>', $text);
		//$text = preg_replace('/(Toenda Software Development)/i', '<a href="http://www.toenda.com" target="_blank">Toenda Software Development</a>', $text);
		
		return $text;
	}
}

?>
