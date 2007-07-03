<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaScript - Parser and Libary
|
| File:	tcms_script.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Script - Parser and Libary
 *
 * This class is used as a parser and a base class
 * for the toendaScript.
 * 
 * @version 0.4.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * Methods
 *
 * __construct                   -> PHP5 Constructor
 * toendaScript                  -> PHP4 Constructor
 * __destruct                    -> PHP5 Destructor
 * _toendaScript                 -> PHP4 Destructor
 *
 *
 * ------- toendaScript default methods -------
 *
 * cutAtTcmsMoreTag              -> Cut a text at the {tcms_more} tag
 * getTcmsMoreTagPos             -> Get the position of the {tcms_more} tag
 * removeTcmsMoreTag             -> Remove the {tcms_more} tag
 * hasTcmsMoreTag                -> Has a text the {tcms_more} tag?
 * checkSEO                      -> Set the image folder if SEO is enabled
 *
 *
 * ------- toendaScript Parser -------
 * 
 * doParse                       -> Start the toendaScript parser
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
 *
 * ------- DEPRECATED -------
 *
 * toendaScript_more             -> custom line break
 * toendaScript_img              -> creates output with image html tag - for trigger
 * toendaScript_trigger          -> Start the toendaScript parser
 * toendaScript_br               -> creates output with br - for trigger
 * toendaScript_hr               -> creates output with hr - for trigger
 * toendaScript_bold             -> creates output with strong - for trigger
 * toendaScript_italize          -> creates output with italized text
 * toendaScript_center           -> creates output with centered text - for trigger
 * toendaScript_left             -> creates output with left aligned text
 * toendaScript_right            -> creates output with right aligned text
 * toendaScript_underline        -> creates output with underline - for trigger
 * toendaScript_header           -> creates output with header text - for trigger
 * toendaScript_blockquote       -> creates output with blockquoted text - for trigger
 * toendaScript_teletyper        -> creates output with teletyper - for trigger
 * toendaScript_ul               -> creates output with list - for trigger
 * toendaScript_ol               -> creates output with numbered list - for trigger
 * toendaScript_li               -> creates output with list item - for trigger
 * toendaScript_fontcolor        -> creates output with fontcolor - for trigger
 * toendaScript_url              -> creates output with link - for trigger
 * toendaScript_php              -> creates output with php tag - for trigger
 * toendaScript_ext              -> creates output with included extern php file - for trigger
 * toendaScript_filter           -> creates output with filtered text - for trigger
 * _filter_SessionLinks          -> Parse the session
 * _filter_Toenda                -> Parse the toenda and toendacms words
 * 
 * </code>
 *
 */


class toendaScript{
	var $content;
	
	
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
	function toendaScript($content = ''){
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
	function _toendaScript(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Cut a text at the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 */
	function cutAtTcmsMoreTag($newsContent){
		if(strpos($newsContent, '{tcms_more}'))
			return substr($newsContent, 0, strpos($newsContent, '{tcms_more}'));
		else
			return $newsContent;
	}
	
	
	
	/**
	 * Get the position of the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 */
	function getTcmsMoreTagPos($newsContent){
		return strpos($newsContent, '{tcms_more}');
	}
	
	
	
	/**
	 * Remove the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 */
	function removeTcmsMoreTag($newsContent){
		return str_replace('{tcms_more}', '', $newsContent);
	}
	
	
	
	/**
	 * Has a text the {tcms_more} tag?
	 * 
	 * @param String $newsContent
	 */
	function hasTcmsMoreTag($newsContent){
		return ( strpos($newsContent, '{tcms_more}') ? true : false );
	}
	
	
	
	/**
	 * Set the image folder if SEO is enabled
	 * 
	 * @param String $text
	 * @param String $seoImageFolder
	 */
	function checkSEO($text, $seoImageFolder){
		global $session;
		global $seoEnabled;
		global $seoPath;
		global $seoFormat;
		global $tcms_main;
		
		if($seoEnabled == 1){
			$tempSEO = str_replace('/', '', $seoImageFolder);
			$text = preg_replace('/(src=")(?!\/'.$tempSEO.')(?!http)/i', 'src="'.$seoImageFolder, $text);
		}
		
		if($tcms_main->isReal($session)){
			//echo $text;
			//$text = preg_replace('/<a href="\/'.$seoPath.'\/\?/i', '<a href="/'.$seoPath.'/?session='.$session.'&amp;', $text);
			$text = str_replace(
				'<a href="'.$seoPath.'/?', 
				'<a href="'.$seoPath.'/?session='.$session.'&amp;', 
				$text
			);
			//echo $text;
			
			if($seoFormat == 0){
				//$text = preg_replace('/<a href="\/'.$seoPath.'\/\index.php\//i', '<a href="/'.$seoPath.'/index.php/session:'.$session.'/', $text);
				$text = str_replace(
					'<a href="'.$seoPath.'/index.php/', 
					'<a href="'.$seoPath.'/index.php/session:'.$session.'/', 
					$text
				);
			}
			else{
				//$text = preg_replace('/<a href="\/'.$seoPath.'\/\index.php\//i', '<a href="/'.$seoPath.'/index.php/session/'.$session.'/', $text);
				$text = str_replace(
					'<a href="'.$seoPath.'/index.php/', 
					'<a href="'.$seoPath.'/index.php/session/'.$session.'/', 
					$text
				);
			}
		}
		
		return $text;
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
	 * [PRIVATE] Parse the php tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	function _parsePHP($newsContent){
		$output = str_replace('{php:}', '<?php ', $newsContent);
		$output = str_replace('{:php}', ' ?>', $output);
		
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
	
	
	
	// ------------------------------------------
	// DEPRECATED
	// ------------------------------------------
	
	
	
	/**
	 * Start the toendaScript parser
	 * 
	 * @return String
	 */
	function toendaScript_trigger(){
		$this->content = $this->toendaScript_img($this->content);
		$this->content = $this->toendaScript_br($this->content);
		$this->content = $this->toendaScript_hr($this->content);
		$this->content = $this->toendaScript_bold($this->content);
		$this->content = $this->toendaScript_italize($this->content);
		$this->content = $this->toendaScript_underline($this->content);
		$this->content = $this->toendaScript_fontcolor($this->content);
		$this->content = $this->toendaScript_center($this->content);
		$this->content = $this->toendaScript_right($this->content);
		$this->content = $this->toendaScript_left($this->content);
		$this->content = $this->toendaScript_teletyper($this->content);
		$this->content = $this->toendaScript_url($this->content);
		$this->content = $this->toendaScript_ul($this->content);
		$this->content = $this->toendaScript_ol($this->content);
		$this->content = $this->toendaScript_li($this->content);
		$this->content = $this->toendaScript_header($this->content);
		$this->content = $this->toendaScript_blockquote($this->content);
		$this->content = $this->toendaScript_filter($this->content);
		
		$this->content = $this->toendaScript_php($this->content);
		
		$this->content = $this->toendaScript_ext($this->content);
		
		return $this->content;
	}
	
	
	
	/**
	 * Parse the image strings
	 * 
	 * @param String $news_content
	 * @return String
	 */
	function toendaScript_img($news_content){
		$output = str_replace('{img#', '<img src="', $news_content);
		$output = str_replace('#border=', '" border="', $output);
		$output = str_replace('#align=', '" align="', $output);
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		$output = str_replace('#}', '" />', $output);
		
		//$output = str_replace('{:url}', '</a>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return boolean
	* @desc Return true or false, if {tcms_more} include
	* news_content -> News Content
	* text_or_bool -> 'bool' = true or false
	*                 'text' = text without tcmsScript tag
	*                 'pos'  = position of the tag
	*/
	function toendaScript_more($news_content, $text_or_bool = 'bool'){
		$output = ( strpos($news_content, '{tcms_more}') ? true : false );
		
		if($text_or_bool == 'text'){ return str_replace('{tcms_more}', '', $news_content); }
		if($text_or_bool == 'bool'){ return $output; }
		if($text_or_bool == 'pos'){ return strpos($news_content, '{tcms_more}'); }
	}
	
	
	
	/***
	* @return News Content
	* @desc Gives content back, that are with tcms_script and br's
	* news_content -> News Content
	*/
	function toendaScript_br($news_content){
		$output = str_replace('{br}', '<br />', $news_content);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Gives content back, that are with tcms_script and br's
	* news_content -> News Content
	*/
	function toendaScript_hr($news_content){
		$output = str_replace('{hr}', '<hr />', $news_content);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_bold($news_content){
		$output = str_replace('{b:}', '<strong>', $news_content);
		$output = str_replace('{:b}', '</strong>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_italize($news_content){
		$output = str_replace('{i:}', '<em>', $news_content);
		$output = str_replace('{:i}', '</em>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_center($news_content){
		$output = str_replace('{center:}', '<div align="center">', $news_content);
		$output = str_replace('{:center}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_left($news_content){
		$output = str_replace('{left:}', '<div align="left">', $news_content);
		$output = str_replace('{:left}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_right($news_content){
		$output = str_replace('{right:}', '<div align="right">', $news_content);
		$output = str_replace('{:right}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_underline($news_content){
		$output = str_replace('{u:}', '<u>', $news_content);
		$output = str_replace('{:u}', '</u>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_header($news_content){
		$output = str_replace('{h1:}', '<h1>', $news_content);
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
	
	
	
	/***
	* @return News Content
	* @desc List item
	* news_content -> News Content
	*/
	function toendaScript_blockquote($news_content){
		$output = str_replace('{cite:}', '<blockquote>', $news_content);
		$output = str_replace('{:cite}', '</blockquote>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set text to bold
	* news_content -> News Content
	*/
	function toendaScript_teletyper($news_content){
		$output = str_replace('{tt:}', '<tt>', $news_content);
		$output = str_replace('{:tt}', '</tt>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Create list
	* news_content -> News Content
	*/
	function toendaScript_ul($news_content){
		$output = str_replace('{ul:}', '<ul>', $news_content);
		$output = str_replace('{:ul}', '</ul>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Create numbered list
	* news_content -> News Content
	*/
	function toendaScript_ol($news_content){
		$output = str_replace('{ol:}', '<ol>', $news_content);
		$output = str_replace('{:ol}', '</ol>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc List item
	* news_content -> News Content
	*/
	function toendaScript_li($news_content){
		$output = str_replace('{li:}', '<li>', $news_content);
		$output = str_replace('{:li}', '</li>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set fontcolor
	* news_content -> News Content
	*/
	function toendaScript_fontcolor($news_content){
		$output = str_replace('{fc#', '<span style="color: #', $news_content);
		$output = str_replace('#:}', '">', $output);
		$output = str_replace('{:fc}', '</span>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set url to a link
	* news_content -> News Content
	*/
	function toendaScript_url($news_content){
		$output = str_replace('{url#', '<a href="', $news_content);
		$output = str_replace('#:}', '">', $output);
		$output = str_replace('#_blank:}', '" target="_blank">', $output);
		$output = str_replace('{:url}', '</a>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Set php tag into newscontent
	* news_content -> News Content
	*/
	function toendaScript_php($news_content){
		$output = str_replace('{php:}', '<?php ', $news_content);
		$output = str_replace('{:php}', ' ?>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return News Content
	* @desc Include extern php file
	* news_content -> News Content
	*/
	function toendaScript_ext($news_content){
		$output = str_replace('{ext#url=', '<iframe src="', $news_content);
		
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		
		$output = str_replace('#ext}', '" scrolling="auto" marginheight="0" marginwidth="0" frameborder="0" style="border: 0px solid #fff !important;"></iframe>', $output);
		
		if(preg_match('/#width=/', $output))
			$output = str_replace('></iframe>', '></iframe>', $output);
		else
			$output = str_replace('></iframe>', ' width="100%"></iframe>', $output);
		
		return $output;
	}
	
	
	
	/***
	* @return string
	* @desc Computer filter
	*/
	function toendaScript_filter($text){
		$text = $this->_filter_Toenda($text);
		$text = $this->_filter_SessionLinks($text);
		return $text;
	}
	
	
	
	/***
	* @return string
	* @desc Text with Session links
	*/
	function _filter_SessionLinks($text){
		//global $session;
		
		//$text = preg_replace('/<a href="/i', '<a href="?session='.$session, $text);
		
		return $text;
	}
	
	
	
	/***
	* @return string
	* @desc Text with SEO image folder
	*/
	function _filter_Toenda($text){
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
