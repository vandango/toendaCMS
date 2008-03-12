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
 * @version 0.1.1
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
 * _parseLinebreaks              -> [PRIVATE] Parse the linebreak tags
 * _parseRules                   -> [PRIVATE] Parse the rule tags
 * _parseQuotes                  -> [PRIVATE] Parse the bold and italize tags
 * _parseHeader                  -> [PRIVATE] Parse the header tags
 * _parseList                    -> [PRIVATE] Parse the list tags
 * _parseUrl                     -> [PRIVATE] Parse the url tags
 * 
 * _parseImages                  -> [PRIVATE] Parse the image tags
 * _parseCenter                  -> [PRIVATE] Parse the center tags
 * _parseLeft                    -> [PRIVATE] Parse the left tags
 * _parseRight                   -> [PRIVATE] Parse the right tags
 * _parseUnderline               -> [PRIVATE] Parse the underline tags
 * _parseBlockquote              -> [PRIVATE] Parse the blockquote tags
 * _parseTeletyper               -> [PRIVATE] Parse the tetetyper tags
 * _parseFontColor               -> [PRIVATE] Parse the fontcolor tags
 * _parseExt                     -> [PRIVATE] Parse the ext tags
 * _parseFilter                  -> [PRIVATE] Parse the filter tags
 * __filter_SessionLinks         -> [PRIVATE] Parse the session
 * __filter_Toenda               -> [PRIVATE] Parse the toenda and toendacms words
 * 
 * _doHeaders                    -> [PRIVATE] Helper function for parsers
 * _doQuotes                     -> [PRIVATE] Helper function for parsers
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

define( 'HTTP_PROTOCOLS', 'http:\/\/|https:\/\/' );
# Everything except bracket, space, or control characters
define( 'EXT_LINK_URL_CLASS', '[^]<>"\\x00-\\x20\\x7F]' );
# Including space
define( 'EXT_LINK_TEXT_CLASS', '[^\]\\x00-\\x1F\\x7F]' );
		define( 'EXT_LINK_BRACKETED',  '/\[(\b(http:\/\/|https:\/\/|ftp:\/\/|irc:\/\/|gopher:\/\/|news:|mailto:)'.EXT_LINK_URL_CLASS.'+) *('.EXT_LINK_TEXT_CLASS.'*?)\]/S' );
		

class tcms_wikiparser {
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
	public function __destruct() {
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
	 * [PRIVATE] Parse the linebreak tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseLinebreaks($text) {
		$text = str_replace('<br>', '<br />', $text);
		$text = str_replace('<br/>', '<br />', $text);
		$text = str_replace('<BR>', '<br />', $text);
		$text = str_replace('<BR/>', '<br />', $text);
		$text = str_replace('<BR />', '<br />', $text);
		//$text = str_replace("\n", '<br />', $text);
		//$text = str_replace(chr(10), '<br />', $text);
		//$text = str_replace(chr(13), '<br />', $text);
		
		return $text;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the rule tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseRules($text) {
		return str_replace('----', '<hr class="hr_line" />', $text);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the bold and italize tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseQuotes($text) {
		$lines = explode("\n", $text);
		
		foreach($lines as $line) {
			$output .= $this->_doQuotes($line)."\n";
		}
		
		return substr($output, 0, -1);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the header tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseHeader($text) {
		$lines = explode("\n", $text);
		
		foreach($lines as $line) {
			$output .= $this->_doHeaders($line)."\n";
		}
		
		return substr($output, 0, -1);
	}
	
	
	
	/**
	 * [PRIVATE] Parse the list tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseList($text) {
		global $tcms_main;
		
		$lines = explode("\n", $text);
		
		$hasStartTag = false;
		$listType = 0; // 0 == nothing
		               // 1 == ul
		               // 2 == ol
		$lastType = 0;
		$lastTag = '';
		
		foreach($lines as $line) {
			//echo '--->'.$line.'<---';
			
			if($tcms_main->startsWith('* ', $line)
			|| $tcms_main->startsWith('# ', $line)) {
				if($tcms_main->startsWith('* ', $line)) {
					$listType = 1;
				}
				elseif($tcms_main->startsWith('# ', $line)) {
					$listType = 2;
				}
			}
			else {
				$listType = 0;
			}
			
			// ul-list
			if($listType == 1) {
				// remove wiki tag
				$line = trim(substr(
					$line, 
					$tcms_main->indexOf($line, '* ') + 2)
				);
				
				if($hasStartTag 
				&& $lastType != $listType) {
					$hasStartTag = false;
					$output .= $lastTag;
				}
				
				if(!$hasStartTag) {
					$hasStartTag = true;
					$output .= '<ul>';
				}
				
				// remove end-<br /> tag
				if($tcms_main->endsWith('<br />', $line)) {
					$line = substr(
						$line, 
						0, 
						(strlen($line) - strlen('<br />'))
					);
				}
				
				$output .= '<li>'.$line.'</li>';
				
				$lastType = $listType;
				$lastTag = '</ul>';
			}
			
			// ol-list
			else if($listType == 2) {
				// remove wiki tag
				$line = trim(substr(
					$line, 
					$tcms_main->indexOf($line, '# ') + 2)
				);
				
				if($hasStartTag 
				&& $lastType != $listType) {
					$hasStartTag = false;
					$output .= $lastTag;
				}
				
				if(!$hasStartTag) {
					$hasStartTag = true;
					$output .= '<ol>';
				}
				
				// remove end-<br /> tag
				if($tcms_main->endsWith('<br />', $line)) {
					$line = substr(
						$line, 
						0, 
						(strlen($line) - strlen('<br />'))
					);
				}
				
				$output .= '<li>'.$line.'</li>';
				
				$lastType = $listType;
				$lastTag = '</ol>';
			}
			
			// no list
			else {
				if($hasStartTag) {
					if($listType == 0) {
						$output .= '</ul>';
					}
					elseif($listType == 1) {
						$output .= '</ol>';
					}
				}
				
				$hasStartTag = false;
				$output .= $line."\n";
				
				$lastType = $listType;
				$lastTag = '';
			}
		}
		
		if($hasStartTag) {
			if($listType == 1) {
				$output .= '</ul>';
			}
			elseif($listType == 2) {
				$output .= '</ol>';
			}
		}
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the url tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseUrl($text) {
		$bits = preg_split(EXT_LINK_BRACKETED, $text, -1, PREG_SPLIT_DELIM_CAPTURE);

		$s = $this->replaceFreeExternalLinks(array_shift($bits));
		$i = 0;
		
		
		
		
		
		/*
		echo '<span style="font-size: 12px;"><pre>';
		print_r($bits);
		echo '</pre></span>';
		*/
		
		while ( $i<count( $bits ) ) {
			$url = $bits[$i++];
			$protocol = $bits[$i++];
			$text = $bits[$i++];
			$trail = $bits[$i++];
			
			

			# The characters '<' and '>' (which were escaped by
			# removeHTMLtags()) should not be included in
			# URLs, per RFC 2396.
			if (preg_match('/&(lt|gt);/', $url, $m2, PREG_OFFSET_CAPTURE)) {
				$text = substr($url, $m2[0][1]) . ' ' . $text;
				$url = substr($url, 0, $m2[0][1]);
			}

			# If the link text is an image URL, replace it with an <img> tag
			# This happened by accident in the original parser, but some people used it extensively
			//$img = $this->maybeMakeExternalImage( $text );
			//if($img !== false ) {
			//	$text = $img;
			//}

			$dtrail = '';


			# No link text, e.g. [http://domain.tld/some.link]
			if ( $text == '' ) {
				# Autonumber if allowed
				
				if ( strpos( HTTP_PROTOCOLS, str_replace('/','\/', $protocol) ) !== false ) {
					$text = '[' . ++$this->mAutonumber . ']';
					$linktype = 'autonumber';
				} else {
					# Otherwise just use the URL
					$text = htmlspecialchars( $url );
					$linktype = 'free';
				}
			} else {
				# Have link text, e.g. [http://domain.tld/some.link text]s
				# Check for trail
				//list( $dtrail, $trail ) = Linker::splitTrail( $trail );
			}

			//$text = $wgContLang->markNoConversion($text);
			$text = $text;

			# Replace &amp; from obsolete syntax with &.
			# All HTML entities will be escaped by makeExternalLink()
			# or maybeMakeExternalImage()
			$url = str_replace( '&amp;', '&', $url );

			# Process the trail (i.e. everything after this link up until start of the next link),
			# replacing any non-bracketed links
			$trail = $this->replaceFreeExternalLinks( $trail );


			# Use the encoded URL
			# This means that users can paste URLs directly into the text
			# Funny characters like &ouml; aren't valid in URLs anyway
			# This was changed in August 2004
			$s .= $this->_makeLink( $url, $text, false ) . $dtrail . $trail;
		}
		
		return $s;
	}
	
	/**
	 * Replace anything that looks like a URL with a link
	 * @access private
	 */
	function replaceFreeExternalLinks( $text ) {
		

		$bits = preg_split( '/(\b(?:http:\/\/|https:\/\/|ftp:\/\/|irc:\/\/|gopher:\/\/|news:|mailto:))/S', $text, -1, PREG_SPLIT_DELIM_CAPTURE );
		$s = array_shift( $bits );
		$i = 0;


		while ( $i < count( $bits ) ){
			$protocol = $bits[$i++];
			$remainder = $bits[$i++];

			if ( preg_match( '/^('.EXT_LINK_URL_CLASS.'+)(.*)$/s', $remainder, $m ) ) {
				# Found some characters after the protocol that look promising
				$url = $protocol . $m[1];
				$trail = $m[2];

				# The characters '<' and '>' (which were escaped by
				# removeHTMLtags()) should not be included in
				# URLs, per RFC 2396.
				if (preg_match('/&(lt|gt);/', $url, $m2, PREG_OFFSET_CAPTURE)) {
					$trail = substr($url, $m2[0][1]) . $trail;
					$url = substr($url, 0, $m2[0][1]);
				}

				# Move trailing punctuation to $trail
				$sep = ',;\.:!?';
				# If there is no left bracket, then consider right brackets fair game too
				if ( strpos( $url, '(' ) === false ) {
					$sep .= ')';
				}

				$numSepChars = strspn( strrev( $url ), $sep );
				if ( $numSepChars ) {
					$trail = substr( $url, -$numSepChars ) . $trail;
					$url = substr( $url, 0, -$numSepChars );
				}

				# Replace &amp; from obsolete syntax with &.
				# All HTML entities will be escaped by makeExternalLink()
				# or maybeMakeExternalImage()
				$url = str_replace( '&amp;', '&', $url );

				# Is this an external image?
				//$text = $this->maybeMakeExternalImage( $url );
				if ( $text === false ) {
					# Not an image, make a link
					$text = $this->_makeLink( $url, $url, true );
				}
				$s .= $text . $trail;
			} else {
				$s .= $protocol . $remainder;
			}
		}
		
		return $s;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * [PRIVATE] Parse the image tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseImages($text) {
		$output = str_replace('{img#', '<img src="', $text);
		$output = str_replace('#border=', '" border="', $output);
		$output = str_replace('#align=', '" align="', $output);
		$output = str_replace('#width=', '" width="', $output);
		$output = str_replace('#height=', '" height="', $output);
		$output = str_replace('#}', '" />', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the center tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseCenter($text) {
		$output = str_replace('{center:}', '<div align="center">', $text);
		$output = str_replace('{:center}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the left tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseLeft($text) {
		$output = str_replace('{left:}', '<div align="left">', $text);
		$output = str_replace('{:left}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the right tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseRight($text) {
		$output = str_replace('{right:}', '<div align="right">', $text);
		$output = str_replace('{:right}', '</div>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the underline tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseUnderline($text) {
		$output = str_replace('{u:}', '<u>', $text);
		$output = str_replace('{:u}', '</u>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the blockquote tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseBlockquote($text) {
		$output = str_replace('{cite:}', '<blockquote>', $text);
		$output = str_replace('{:cite}', '</blockquote>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the teletyper tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseTeletyper($text) {
		$output = str_replace('{tt:}', '<tt>', $text);
		$output = str_replace('{:tt}', '</tt>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the fontcolor tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseFontColor($text) {
		$color = substr(
			$text, 
			strpos($text, '{fc#') + 4, 
			strpos($text, '#}') - 4
		);
		
		switch($color) {
			case 'white':
				$output = str_replace('{fc#'.$color, '<span style="color: #ffffff;', $text);
				break;
			
			case 'black':
				$output = str_replace('{fc#'.$color, '<span style="color: #000000;', $text);
				break;
			
			case 'red':
				$output = str_replace('{fc#'.$color, '<span style="color: #ff0000;', $text);
				break;
			
			case 'green':
				$output = str_replace('{fc#'.$color, '<span style="color: #00ff00;', $text);
				break;
			
			case 'blue':
				$output = str_replace('{fc#'.$color, '<span style="color: #0000ff;', $text);
				break;
			
			default:
				$output = str_replace('{fc#'.$color, '<span style="color: #'.$color.';', $text);
				break;
		}
		
		$output = str_replace('#:}', '">', $output);
		$output = str_replace('{:fc}', '</span>', $output);
		
		return $output;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the ext tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseExt($text) {
		$output = str_replace('{ext#url=', '<iframe src="', $text);
		
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
	 * [PRIVATE] Parse the filter tags
	 * 
	 * @param String $text
	 * @return String
	 */
	private function _parseFilter($text) {
		$text = $this->__filter_Toenda($text);
		$text = $this->__filter_SessionLinks($text);
		
		return $text;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the session
	 * 
	 * @param String $text
	 * @return String
	 */
	private function __filter_SessionLinks($text) {
		//global $session;
		
		//$text = preg_replace('/<a href="/i', '<a href="?session='.$session, $text);
		
		return $text;
	}
	
	
	
	/**
	 * [PRIVATE] Parse the toenda and toendacms words
	 * 
	 * @param String $text
	 * @return String
	 */
	private function __filter_Toenda($text) {
		$text = $text;
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * Create a link
	 * 
	 * @param String $url
	 * @param String $text
	 * @param Boolean $escape
	 * @return String
	 * @access Private
	 */
	private function _makeLink($url, $text, $escape = true) {
		$same = ($url == $text);
		$url = urldecode($url);
		$url = preg_replace('/[\\x00-\\x1f_]/', ' ', $url);
		$url = htmlspecialchars($url);
		
		$style .= " title=\"{$link}\"";
		
		if($escape) {
			$text = htmlspecialchars($text);
		}
		
		return '<a href="'.$url.'"'.$style.'>'.$text.'</a>';
	}
	
	
	
	/**
	 * [PRIVATE] Helper function for parsers
	 * 
	 * @access private
	 * @param String $text
	 * @return String
	 */
	private function _doHeaders($text) {
		$arr = preg_split("/(=+ )/", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		
		if(count($arr) == 1) {
			return $text;
		}
		else {
			foreach($arr as $r) {
				if($r != '= '
				&& $r != '== '
				&& $r != '=== '
				&& $r != '==== ') {
					if(preg_match("/( ====)/", $r)) {
						$r = '<h4>'.$r;
						$output .= preg_replace("/( ====)/", '</h4>', $r);
					}
					else if(preg_match("/( ===)/", $r)) {
						$r = '<h3>'.$r;
						$output .= preg_replace("/( ===)/", '</h3>', $r);
					}
					else if(preg_match("/( ==)/", $r)) {
						$r = '<h2>'.$r;
						$output .= preg_replace("/( ==)/", '</h2>', $r);
					}
					else if(preg_match("/( =)/", $r)) {
						$r = '<h1>'.$r;
						$output .= preg_replace("/( =)/", '</h1>', $r);
					}
				}
			}
			
			return $output;
		}
	}
	
	
	
	/**
	 * [PRIVATE] Helper function for parsers
	 * 
	 * @access private
	 * @param String $text
	 * @return String
	 */
	private function _doQuotes($text) {
		$arr = preg_split( "/(''+)/", $text, -1, PREG_SPLIT_DELIM_CAPTURE );
		
		if(count($arr) == 1) {
			return $text;
		}
		else {
			// First, do some preliminary work. This may shift some apostrophes from
			// being mark-up to being text. It also counts the number of occurrences
			// of bold and italics mark-ups.
			$i = 0;
			$numbold = 0;
			$numitalics = 0;
			
			foreach($arr as $r) {
				if(($i % 2) == 1) {
					// If there are ever four apostrophes, assume the first is supposed to
					// be text, and the remaining three constitute mark-up for bold text.
					if(strlen($arr[$i]) == 4 ) {
						$arr[$i-1] .= "'";
						$arr[$i] = "'''";
					}
					
					// If there are more than 5 apostrophes in a row, assume they're all
					// text except for the last 5.
					else if(strlen($arr[$i]) > 5 ) {
						$arr[$i-1] .= str_repeat( "'", strlen( $arr[$i] ) - 5 );
						$arr[$i] = "'''''";
					}
					
					// Count the number of occurrences of bold and italics mark-ups.
					// We are not counting sequences of five apostrophes.
					if(strlen($arr[$i]) == 2 ) {
						$numitalics++;
					}
					elseif(strlen($arr[$i]) == 3 ) {
						$numbold++;
					}
					elseif(strlen($arr[$i]) == 5 ) {
						$numitalics++;
						$numbold++;
					}
				}
				
				$i++;
			}

			// If there is an odd number of both bold and italics, it is likely
			// that one of the bold ones was meant to be an apostrophe followed
			// by italics. Which one we cannot know for certain, but it is more
			// likely to be one that has a single-letter word before it.
			if(($numbold % 2 == 1) 
			&& ($numitalics % 2 == 1)) {
				$i = 0;
				$firstsingleletterword = -1;
				$firstmultiletterword = -1;
				$firstspace = -1;
				
				foreach($arr as $r) {
					if(($i % 2 == 1) and (strlen($r) == 3 )) {
						$x1 = substr ($arr[$i-1], -1);
						$x2 = substr ($arr[$i-1], -2, 1);
						
						if($x1 == ' ') {
							if($firstspace == -1) $firstspace = $i;
						}
						else if($x2 == ' ') {
							if($firstsingleletterword == -1) {
								$firstsingleletterword = $i;
							}
						}
						else {
							if($firstmultiletterword == -1) {
								$firstmultiletterword = $i;
							}
						}
					}
					$i++;
				}

				// If there is a single-letter word, use it!
				if($firstsingleletterword > -1) {
					$arr [ $firstsingleletterword ] = "''";
					$arr [ $firstsingleletterword-1 ] .= "'";
				}
				// If not, but there's a multi-letter word, use that one.
				else if($firstmultiletterword > -1) {
					$arr [ $firstmultiletterword ] = "''";
					$arr [ $firstmultiletterword-1 ] .= "'";
				}
				// ... otherwise use the first one that has neither.
				// (notice that it is possible for all three to be -1 if, for example,
				// there is only one pentuple-apostrophe in the line)
				else if($firstspace > -1) {
					$arr [ $firstspace ] = "''";
					$arr [ $firstspace-1 ] .= "'";
				}
			}

			// Now let's actually convert our apostrophic mush to HTML!
			$output = '';
			$buffer = '';
			$state = '';
			$i = 0;
			foreach($arr as $r) {
				if(($i % 2) == 0) {
					if($state == 'both') {
						$buffer .= $r;
					}
					else {
						$output .= $r;
					}
				}
				else {
					if(strlen($r) == 2) {
						if($state == 'i') {
							$output .= '</em>';
							$state = '';
						}
						else if($state == 'bi') {
							$output .= '</em>';
							$state = 'b';
						}
						else if($state == 'ib') {
							$output .= '</strong></em><strong>';
							$state = 'b';
						}
						else if($state == 'both') {
							$output .= '<strong><em>'.$buffer.'</em>';
							$state = 'b';
						}
						else { // $state can be 'b' or ''
							$output .= '<em>';
							$state .= 'i';
						}
					}
					else if(strlen($r) == 3) {
						if($state == 'b') {
							$output .= '</strong>';
							$state = '';
						}
						else if($state == 'bi') {
							$output .= '</em></strong><em>';
							$state = 'i';
						}
						else if($state == 'ib') {
							$output .= '</strong>';
							$state = 'i';
						}
						else if($state == 'both') {
							$output .= '<em><strong>'.$buffer.'</strong>';
							$state = 'i';
						}
						else { // $state can be 'i' or ''
							$output .= '<strong>';
							$state .= 'b';
						}
					}
					else if(strlen ($r) == 5) {
						if($state == 'b') {
							$output .= '</strong><em>';
							$state = 'i';
						}
						else if($state == 'i') {
							$output .= '</em><strong>';
							$state = 'b';
						}
						else if($state == 'bi') {
							$output .= '</em></strong>';
							$state = '';
						}
						else if($state == 'ib') {
							$output .= '</strong></em>';
							$state = '';
						}
						else if($state == 'both') {
							$output .= '<em><strong>'.$buffer.'</strong></em>';
							$state = '';
						}
						else { // ($state == '')
							$buffer = '';
							$state = 'both';
						}
					}
				}
				$i++;
			}
			
			// Now close all remaining tags.  Notice that the order is important.
			if($state == 'b' || $state == 'ib') {
				$output .= '</strong>';
			}
			
			if($state == 'i' || $state == 'bi' || $state == 'ib') {
				$output .= '</em>';
			}
			
			if($state == 'bi') {
				$output .= '</strong>';
			}
			
			if($state == 'both') {
				$output .= '<strong><em>'.$buffer.'</em></strong>';
			}
			
			return $output;
		}
	}
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Cut a text at the {tcms_more} tag
	 * 
	 * @param String $text
	 * @return String
	 */
	public function cutAtTcmsMoreTag($text) {
		if(strpos($text, '{tcms_more}')) {
			return substr($text, 0, strpos($text, '{tcms_more}'));
		}
		else {
			return $text;
		}
	}
	
	
	
	/**
	 * Get the position of the {tcms_more} tag
	 * 
	 * @param String $text
	 * @return String
	 */
	public function getTcmsMoreTagPos($text) {
		return strpos($text, '{tcms_more}');
	}
	
	
	
	/**
	 * Remove the {tcms_more} tag
	 * 
	 * @param String $text
	 * @param Boolean $withCssImage = false
	 * @return String
	 */
	public function removeTcmsMoreTag($text, $withCssImage = false) {
		return str_replace(
			'{tcms_more}', 
			( $withCssImage ? '<div class="tcms_more"></div>' : '' ), 
			$text
		);
	}
	
	
	
	/**
	 * Has a text the {tcms_more} tag?
	 * 
	 * @param String $text
	 * @return String
	 */
	public function hasTcmsMoreTag($text) {
		return ( strpos($text, '{tcms_more}') ? true : false );
	}
	
	
	
	/**
	 * Set the image folder if SEO is enabled
	 * 
	 * @param String $text
	 * @param String $seoImageFolder
	 * @return String
	 */
	public function checkSEO($text, $seoImageFolder) {
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
		
		if($tcms_main->isReal($session)) {
			//echo $text;
			//$text = preg_replace('/<a href="\/'.$seoPath.'\/\?/i', '<a href="/'.$seoPath.'/?session='.$session.'&amp;', $text);
			$text = str_replace(
				'<a href="'.$seoPath.'/?', 
				'<a href="'.$seoPath.'/?session='.$session.'&amp;', 
				$text
			);
			//echo $text;
			
			if($seoFormat == 0) {
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
		$this->content = $this->_parseLinebreaks($this->content);
		$this->content = $this->_parseRules($this->content);
		$this->content = $this->_parseQuotes($this->content);
		$this->content = $this->_parseHeader($this->content);
		$this->content = $this->_parseList($this->content);
		$this->content = $this->_parseUrl($this->content);
		//$this->content = $this->_parseImages($this->content);
		//$this->content = $this->_parseCenter($this->content);
		//$this->content = $this->_parseLeft($this->content);
		//$this->content = $this->_parseRight($this->content);
		//$this->content = $this->_parseUnderline($this->content);
		//$this->content = $this->_parseBlockquote($this->content);
		//$this->content = $this->_parseTeletyper($this->content);
		//$this->content = $this->_parseFontColor($this->content);
		//$this->content = $this->_parseExt($this->content);
		//$this->content = $this->_parseFilter($this->content);
		
		return $this->content;
	}
	
	
	
	/**
	 * Parse the php tags
	 * 
	 * @param String $text
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
