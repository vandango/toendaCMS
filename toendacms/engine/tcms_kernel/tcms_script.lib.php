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
 * @version 0.8.7
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
 * __construct                   -> Constructor
 * __destruct                    -> Destructor
 * 
 * --------------------------------------------------------
 * PRIVATE MEMBERS
 * --------------------------------------------------------
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
 * _parseExt                     -> [PRIVATE] Parse the ext tags
 * _parseIfThenElse              -> [PRIVATE] Parse the if-then-else tags
 * _parseFilter                  -> [PRIVATE] Parse the filter tags
 * __filter_SessionLinks         -> [PRIVATE] Parse the session
 * __filter_Toenda               -> [PRIVATE] Parse the toenda and toendacms words
 *
 * --------------------------------------------------------
 * PUBLIC MEMBERS
 * --------------------------------------------------------
 * 
 * cutAtTcmsMoreTag              -> Cut a text at the {tcms_more} tag
 * getTcmsMoreTagPos             -> Get the position of the {tcms_more} tag
 * removeTcmsMoreTag             -> Remove the {tcms_more} tag
 * hasTcmsMoreTag                -> Has a text the {tcms_more} tag?
 * checkSEO                      -> Set the image folder if SEO is enabled
 * doParse                       -> Start the toendaScript parser
 * doParsePHP                    -> Parse the php tags
 * 
 * </code>
 *
 */


class toendaScript {
	private $content;
	
	
	
	// -------------------------------------------------
	// CONSTRUCTORS
	// -------------------------------------------------
	
	
	
	/**
	 * Constructor
	 *
	 * @param String $content
	 */
	public function __construct($content = '') {
		$this->content = $content;
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct(){
	}
	
	
	
	// -------------------------------------------------
	// PRIVATE MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * [PRIVATE] Count Words in a phrase
	 *
	 * @param String $text
	 * @param String $wordToCount
	 * @return String
	 */
	private function _countWords($text, $wordToCount = '') {
		if($wordToCount == '') {
			return str_word_count($text);
		}
		else {
			$text = strip_tags(trim($text));
			$arr = explode(' ', $text);
			$counter = 0;
			
			foreach($arr as $key => $val) {
				if(strpos(' '.$val.' ', $wordToCount, 0)) {
					$counter++;
				}
			}
			
			return $counter;
		}
	}
	
	
	
	/**
	 * [PRIVATE] Parse the image tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	private function _parseImages($newsContent){
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
	private function _parseLinebreaks($newsContent){
		return str_replace('{br}', '<br />', $newsContent);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the rule tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	private function _parseRules($newsContent){
		return str_replace('{hr}', '<hr class="hr_line" />', $newsContent);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the bold tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	private function _parseBold($newsContent){
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
	private function _parseItalize($newsContent){
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
	private function _parseCenter($newsContent){
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
	private function _parseLeft($newsContent){
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
	private function _parseRight($newsContent){
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
	private function _parseUnderline($newsContent){
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
	private function _parseHeader($newsContent){
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
	private function _parseBlockquote($newsContent){
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
	private function _parseTeletyper($newsContent){
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
	private function _parseUl($newsContent){
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
	private function _parseOl($newsContent){
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
	private function _parseLi($newsContent){
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
	private function _parseFontColor($newsContent){
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
	private function _parseUrl($newsContent){
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
	private function _parseExt($newsContent){
		$output = str_replace('{ext#url=', '<iframe src="', $newsContent);
		
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		
		$output = str_replace('#ext}', '" scrolling="auto" marginheight="0" marginwidth="0" frameborder="0" style="border: 0px solid #fff !important;"></iframe>', $output);
		
		if(preg_match('/#width=/', $output)) {
			$output = str_replace('></iframe>', '></iframe>', $output);
		}
		else {
			$output = str_replace('></iframe>', ' width="100%"></iframe>', $output);
		}
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the if-then-else tags
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	private function _parseIfThenElse($newsContent){
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
	private function _parseFilter($newsContent){
		$newsContent = $this->__filter_Toenda($newsContent);
		$newsContent = $this->__filter_SessionLinks($newsContent);
		return $newsContent;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the session
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	private function __filter_SessionLinks($newsContent){
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
	private function __filter_Toenda($newsContent){
		$text = $newsContent;
		//$text = preg_replace('/toendacms/i', '<a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		/*
		$text = preg_replace('/<p>toendacms/i', '<p><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<b>toendacms/i', '<b><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<strong>toendacms/i', '<strong><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<u>toendacms/i', '<u><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<em>toendacms/i', '<em><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<li>toendacms/i', '<li><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h1>toendacms/i', '<h1><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h2>toendacms/i', '<h2><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h3>toendacms/i', '<h3><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h4>toendacms/i', '<h4><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h5>toendacms/i', '<h5><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		$text = preg_replace('/<h6>toendacms/i', '<h6><a href="http://www.toendacms.org" target="_blank">toendaCMS</a>', $text);
		*/
		//$text = preg_replace('/(Toenda)/i', '<a href="http://www.toenda.com" target="_blank">Toenda</a>', $text);
		//$text = preg_replace('/(Toenda Software Development)/i', '<a href="http://www.toenda.com" target="_blank">Toenda Software Development</a>', $text);
		
		return $text;
	}
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Cut a text at the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	public function cutAtTcmsMoreTag($newsContent){
		if(strpos($newsContent, '{tcms_more}')) {
			return substr($newsContent, 0, strpos($newsContent, '{tcms_more}'));
		}
		else {
			return $newsContent;
		}
	}
	
	
	
	/**
	 * Get the position of the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	public function getTcmsMoreTagPos($newsContent){
		return strpos($newsContent, '{tcms_more}');
	}
	
	
	
	/**
	 * Remove the {tcms_more} tag
	 * 
	 * @param String $newsContent
	 * @param Boolean $withCssImage = false
	 * @return String
	 */
	public function removeTcmsMoreTag($newsContent, $withCssImage = false){
		$newsContent = str_replace('{tcms_more}<br>', '{tcms_more}', $newsContent);
		$newsContent = str_replace('{tcms_more}<br/>', '{tcms_more}', $newsContent);
		$newsContent = str_replace('{tcms_more}<br />', '{tcms_more}', $newsContent);
		$newsContent = str_replace('{tcms_more}<BR>', '{tcms_more}', $newsContent);
		$newsContent = str_replace('{tcms_more}<BR/>', '{tcms_more}', $newsContent);
		$newsContent = str_replace('{tcms_more}<BR />', '{tcms_more}', $newsContent);
		
		return str_replace(
			'{tcms_more}', 
			( $withCssImage ? '<div class="tcms_more"></div>' : '' ), 
			$newsContent
		);
	}
	
	
	
	/**
	 * Has a text the {tcms_more} tag?
	 * 
	 * @param String $newsContent
	 * @return String
	 */
	public function hasTcmsMoreTag($newsContent){
		return ( strpos($newsContent, '{tcms_more}') ? true : false );
	}
	
	
	
	/**
	 * Set the image folder if SEO is enabled
	 * 
	 * @param String $text
	 * @param String $seoImageFolder
	 * @return String
	 */
	public function checkSEO($text, $seoImageFolder){
		global $session;
		global $seoEnabled;
		global $seoPath;
		global $seoFormat;
		global $tcms_main;
		
		//echo 'seo:'.$seoImageFolder.'<br>';
		
		if($seoEnabled == 1 
		&& trim($seoImageFolder) != ''
		&& trim($seoImageFolder) != '/') {
			$tempSEO = str_replace('/', '', $seoImageFolder);
			$text = preg_replace('/(src=")(?!\/'.$tempSEO.')(?!http)/i', 'src="'.$seoImageFolder, $text);
			
			$text = str_replace($seoImageFolder.$seoImageFolder, $seoImageFolder, $text);
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
			else {
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
	public function doParse() {
		global $tcms_config;
		
		if($tcms_config->getWYSIWYGEditor() == 'Wiki') {
			$wiki = new tcms_wikiparser($this->content);
			$this->content = $wiki->doParse();
			unset($wiki);
		}
		else {
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
			$this->content = $this->_parseExt($this->content);
			$this->content = $this->_parseFilter($this->content);
			$this->content = $this->_parseIfThenElse($this->content);
		}
		
		return $this->content;
	}
	
	
	
	/**
	 * Parse the php tags
	 * 
	 * @param String $newsContent
	 * @param Boolean $onlyClear = false
	 * @return String
	 */
	public function doParsePHP($text, $onlyClear = false) {
		$out1 = '';
		$out = '';
		
		//if($onlyClear) {
			//$text = str_replace('{php:}', '', $text);
			//return str_replace('{:php}', '', $text);
		//}
		//else {
		$wordCount = $this->_countWords($text, '{php:}');
		
		//echo '<br>'.$wordCount.'<br>';
		
		
		/*
			nothing found
		*/
		if($wordCount == 0) {
			if(!$onlyClear) {
				echo $text;
			}
			else {
				return $text;
			}
		}
		/*
			one php-block found
		*/
		else if($wordCount == 1) {
			$out1 = substr($text, 0, strpos($text, '{php:}'));
			
			if(!$onlyClear) {
				echo $out1;
			}
			else {
				$out .= $out1;
			}
			
			if(!$onlyClear) {
				$phpCode = substr(
					$text, 
					strpos($text, '{php:}') + 6, 
					strpos($text, '{:php}') - ((strpos($text, '{php:}') + 6))
				);
				
				eval($phpCode);
			}
			
			$out2 = substr($text, strpos($text, '{:php}') + 6);
			
			if(!$onlyClear) {
				echo $out2;
			}
			else {
				$out .= $out2;
			}
		}
		/*
			more php-block's found
		*/
		else if($wordCount > 1) {
			$currentPos = 0;
			$posStart = 0;
			$posEnd = 0;
			$go = true;
			$count = 0;
			
			//echo '<br>len:'.strlen($text).'<br>';
			
			while($go) {
				$posStart = strpos($text, '{php:}', $posStart);
				$posEnd = strpos($text, '{:php}', $posEnd);
				
				if(strpos($text, '{php:}', $posStart) === false
				&& $go === true) {
					$go = false;
				}
				else {
					#echo '<br>ps:'.$posStart.'<br>';
					#echo 'pe:'.$posEnd.'<br>';
					#echo 'cp:'.$currentPos.'<br>';
					
					
					$posStart += 6;
					
					$out1 = substr($text, $currentPos, $posStart - $currentPos);
					
					//$out2 = substr($text, $posEnd + 6, );
					
					$out1 = str_replace('{php:}', '', $out1);
					$out1 = str_replace('{:php}', '', $out1);
					
					//echo '<hr class="hr_line">1: '.$out1.'<br><hr class="hr_line">php: ';
					//echo eval($phpCode).'<br>';
					//echo ' :php<hr class="hr_line"><br>';
					
					//$out .= $out1.eval($phpCode);
					if(!$onlyClear) {
						echo $out1;
					}
					else {
						$out .= $out1;
					}
					
					if(!$onlyClear) {
						$phpCode = substr(
							$text, 
							$posStart, 
							$posEnd - ($posStart)
						);
						
						eval($phpCode);
					}
					
					$posEnd += 6;
					$posStart = $posEnd;
					$currentPos = $posEnd;
					
					$count++;
					
					if($count == $wordCount) {
						$go = false;
					}
				}
			}
			
			if(!$onlyClear) {
				echo substr($text, $currentPos, strlen($text) - $currentPos);
			}
			else {
				$out .= substr($text, $currentPos, strlen($text) - $currentPos);
				return $out;
			}
		}
		//}
	}
}

?>
