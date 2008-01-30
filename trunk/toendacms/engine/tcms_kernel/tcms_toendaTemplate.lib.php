<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaTemplate Engine
|
| File:	tcms_toendaTemplate.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaTemplate Engine
 *
 * This class is used to implement toendaTemplate Engine.
 *
 * @version 0.2.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 *--------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 *--------------------------------------------------------
 *
 * __construct()                       -> Default constructor
 * __destruct()                        -> Default destructor
 * 
 *--------------------------------------------------------
 * PROPERTIES
 *--------------------------------------------------------
 * 
 * getBuffer                           -> Get the buffer
 * setBuffer                           -> Set the buffer
 * getSeperator                        -> Get the seperator
 * setSeperator                        -> Set the seperator
 *
 *--------------------------------------------------------
 * PUBLIC MEMBERS
 *--------------------------------------------------------
 * 
 * checkTemplateExist                  -> Check if the template exist
 * loadTemplate                        -> Load a template into the buffer
 * unloadTemplate                      -> Unload a template into the buffer
 * getGuestbookEntry                   -> Get the entry template for a guestbook entry
 * parseLinksTemplate                  -> Parse the links template
 * getLinksCategoryTitle               -> Get the category title template for a link
 * getLinksEntry                       -> Get the entry template for a link
 * parseNewsTemplate                   -> Parse the news template
 * getNewsFrontpageEntry               -> Get the template for the news on the frontpage
 * getNewsSingleEntry                  -> Get the template for the news details
 * getNewsCommentEntry                 -> Get the template for the news comments
 * 
 * </code>
 *
 */


class tcms_toendaTemplate {
	private $_tcmsFile;
	
	private $_buffer;
	private $_sepererator;
	private $_part1;
	private $_part2;
	private $_part3;
	
	
	
	// -------------------------------------------------
	// CONSTRUCTORS
	// -------------------------------------------------
	
	
	
	/**
	 * Default constructor
	 */
	public function __construct() {
		include_once('tcms_file.lib.php');
		
		$this->_tcmsFile = new tcms_file();
	}
	
	
	
	/**
	 * Default destructor
	 */
	public function __destruct() {
	}
	
	
	
	// -------------------------------------------------
	// PROPERTIES
	// -------------------------------------------------
	
	
	
	/**
	 * Get the buffer
	 *
	 * @return String
	 */
	public function getBuffer() {
		return $this->_buffer;
	}
	
	
	
	/**
	 * Set the buffer
	 *
	 * @param String $value
	 */
	public function setBuffer($value) {
		$this->_buffer = $value;
	}
	
	
	
	/**
	 * Get the seperator
	 *
	 * @return String
	 */
	public function getSeperator() {
		return $this->_sepererator;
	}
	
	
	
	/**
	 * Set the seperator
	 *
	 * @param String $value
	 */
	public function setSeperator($value) {
		$this->_sepererator = $value;
	}
	
	
	
	// -------------------------------------------------
	// PUBLIC MEMBERS
	// -------------------------------------------------
	
	
	
	/**
	 * Check if the template exist
	 *
	 * @param String $file
	 * @param Integer $checkPart
	 * @return Boolean
	 */
	public function checkTemplateExist($file, $checkPart = 0) {
		if($this->_tcmsFile->checkFileExist($file)) {
			if($checkPart > 0) {
				switch($checkPart) {
					case 1:
						if($this->_part1 != NULL
						&& trim($this->_part1) != '') {
							return true;
						}
						else {
							return false;
						}
						break;
					
					case 2:
						if($this->_part2 != NULL
						&& trim($this->_part2) != '') {
							return true;
						}
						else {
							return false;
						}
						break;
					
					case 3:
						if($this->_part3 != NULL
						&& trim($this->_part3) != '') {
							return true;
						}
						else {
							return false;
						}
						break;
					
					default:
						return false;
						break;
				}
			}
			else {
				return true;
			}
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Load a template into the buffer
	 *
	 * @param String $file
	 */
	public function loadTemplate($file) {
		if($this->checkTemplateExist($file)) {
			$this->_buffer = $this->_tcmsFile->readToEnd($file);
		}
	}
	
	
	
	/**
	 * Unload a template into the buffer
	 */
	public function unloadTemplate() {
		$this->_buffer = '';
	}
	
	
	
	/**
	 * Get the entry template for a guestbook entry
	 *
	 * @param String $rowColor
	 * @param String $nameColumnWidth
	 * @param String $textColumnWidth
	 * @param String $entryCreator
	 * @param String $entryNumber
	 * @param String $entryDate
	 * @param String $entryText
	 * @return String
	 */
	public function getGuestbookEntry($rowColor, $nameColumnWidth, $textColumnWidth, $entryCreator, $entryNumber, $entryDate, $entryText) {
		$layoutEntry = '';
		
		if(trim($this->_buffer) != '') {
			$layoutEntry = str_replace('#####TABLE_ROW_BG_COLOR#####', $rowColor, $this->_buffer);
			$layoutEntry = str_replace('#####GUESTBOOK_COLUMN_NAME_WIDTH#####', $nameColumnWidth, $layoutEntry);
			$layoutEntry = str_replace('#####GUESTBOOK_ENTRY_CREATOR#####', $entryCreator, $layoutEntry);
			$layoutEntry = str_replace('#####GUESTBOOK_ENTRY_NUMBER#####', $entryNumber, $layoutEntry);
			$layoutEntry = str_replace('#####GUESTBOOK_ENTRY_DATE#####', $entryDate, $layoutEntry);
			$layoutEntry = str_replace('#####GUESTBOOK_ENTRY_TEXT#####', $entryText, $layoutEntry);
			$layoutEntry = str_replace('#####GUESTBOOK_COLUMN_TEXT_WIDTH#####', $textColumnWidth, $layoutEntry);
		}
		
		return $layoutEntry;
	}
	
	
	
	/**
	 * Parse the links template
	 *
	 */
	public function parseLinksTemplate() {
		if(trim($this->_buffer) != '') {
			// part 1
			$part1_pos_begin = strpos($this->_buffer, '<!--#####LINK_TITLE_TEMPLATE_BEGIN#####-->');
			$part1_pos_end = strpos($this->_buffer, '<!--#####LINK_TITLE_TEMPLATE_END#####-->');
			
			if($part1_pos_begin > -1 && $part1_pos_end > -1) {
				$this->_part1 = substr(
					$this->_buffer, 
					$part1_pos_begin, 
					$part1_pos_end - $part1_pos_begin
				);
				
				$this->_part1 = str_replace('<!--#####LINK_TITLE_TEMPLATE_BEGIN#####-->', '', $this->_part1);
				$this->_part1 = str_replace('<!--#####LINK_TITLE_TEMPLATE_END#####-->', '', $this->_part1);
			}
			
			// part 2
			$part2_pos_begin = strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE_BEGIN#####-->');
			$part2_pos_end = strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE_END#####-->');
			
			if($part2_pos_begin > -1 && $part2_pos_end > -1) {
				$this->_part2 = substr(
					$this->_buffer, 
					$part2_pos_begin, 
					$part2_pos_end - $part2_pos_begin
				);
				
				$this->_part2 = str_replace('<!--#####LINK_ENTRY_TEMPLATE_BEGIN#####-->', '', $this->_part2);
				$this->_part2 = str_replace('<!--#####LINK_ENTRY_TEMPLATE_END#####-->', '', $this->_part2);
			}
		}
	}
	
	
	
	/**
	 * Get the category title template for a link
	 *
	 * @param String $title
	 * @return String
	 */
	public function getLinksCategoryTitle($title) {
		$layoutEntry = '';
		
		if(trim($this->_part1) != '') {
			$layoutEntry = trim($this->_part1);
			
			$layoutEntry = str_replace('#####LINK_TITLE#####', $title, $layoutEntry);
		}
		
		return $layoutEntry;
	}
	
	
	
	/**
	 * Get the entry template for a link
	 *
	 * @param String $entryTarget
	 * @param String $entryLink
	 * @param String $entryText
	 * @param String $entryDesc
	 * @return String
	 */
	public function getLinksEntry($entryTarget, $entryLink, $entryText, $entryDesc) {
		$layoutEntry = '';
		
		if(trim($this->_part2) != '') {
			$layoutEntry = trim($this->_part2);
			
			$layoutEntry = str_replace('#####LINK_TARGET#####', $entryTarget, $layoutEntry);
			$layoutEntry = str_replace('#####LINK_LINK#####', $entryLink, $layoutEntry);
			$layoutEntry = str_replace('#####LINK_TEXT#####', $entryText, $layoutEntry);
			$layoutEntry = str_replace('#####LINK_DESC#####', $entryDesc, $layoutEntry);
		}
		
		return $layoutEntry;
	}
	
	
	
	/**
	 * Parse the news template
	 *
	 */
	public function parseNewsTemplate() {
		if(trim($this->_buffer) != '') {
			// configuration
			if(strpos($this->_buffer, 'news.information.seperator') > -1) {
				$posSepStart = strpos($this->_buffer, 'news.information.seperator') + 27;
				$posSepEnd = strpos(
					$this->_buffer, 
					chr(10), 
					$posSepStart
				);
				
				// seperator
				$this->_sepererator = substr(
					$this->_buffer, 
					$posSepStart, 
					$posSepEnd - $posSepStart
				);
			}
			
			// part 1
			$part1_pos_begin = strpos($this->_buffer, '<!--#####NEWS_FRONTPAGE_TEMPLATE_BEGIN#####-->');
			$part1_pos_end = strpos($this->_buffer, '<!--#####NEWS_FRONTPAGE_TEMPLATE_END#####-->');
			
			if($part1_pos_begin > -1 && $part1_pos_end > -1) {
				$this->_part1 = substr(
					$this->_buffer, 
					$part1_pos_begin, 
					$part1_pos_end - $part1_pos_begin
				);
				
				$this->_part1 = str_replace('<!--#####NEWS_FRONTPAGE_TEMPLATE_BEGIN#####-->', '', $this->_part1);
				$this->_part1 = str_replace('<!--#####NEWS_FRONTPAGE_TEMPLATE_END#####-->', '', $this->_part1);
			}
			
			// part 2
			$part2_pos_begin = strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE_BEGIN#####-->');
			$part2_pos_end = strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE_END#####-->');
			
			if($part2_pos_begin > -1 && $part2_pos_end > -1) {
				$this->_part2 = substr(
					$this->_buffer, 
					$part2_pos_begin, 
					$part2_pos_end - $part2_pos_begin
				);
				
				$this->_part2 = str_replace('<!--#####NEWS_SINGLE_TEMPLATE_BEGIN#####-->', '', $this->_part2);
				$this->_part2 = str_replace('<!--#####NEWS_SINGLE_TEMPLATE_END#####-->', '', $this->_part2);
			}
			
			// part 3
			$part3_pos_begin = strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE_BEGIN#####-->');
			$part3_pos_end = strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE_END#####-->');
			
			if($part3_pos_begin > -1 && $part3_pos_end > -1) {
				$this->_part3 = substr(
					$this->_buffer, 
					$part3_pos_begin, 
					$part3_pos_end - $part3_pos_begin
				);
				
				$this->_part3 = str_replace('<!--#####NEWS_COMMENT_TEMPLATE_BEGIN#####-->', '', $this->_part3);
				$this->_part3 = str_replace('<!--#####NEWS_COMMENT_TEMPLATE_END#####-->', '', $this->_part3);
			}
		}
	}
	
	
	
	/**
	 * Get the template for the news on the frontpage
	 * 
	 * @param String $link
	 * @param String $title
	 * @param String $info
	 * @param String $text
	 * @return String
	 */
	public function getNewsFrontpageEntry($link, $title, $info, $text) {
		$layoutEntry = '';
		
		if(trim($this->_part1) != '') {
			$layoutEntry = trim($this->_part1);
			
			$layoutEntry = str_replace('#####NEWS_LINK#####', $link, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_TITLE#####', $title, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_INFORMATON#####', $info, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_TEXT#####', $text, $layoutEntry);
		}
		
		return $layoutEntry;
	}
	
	
	
	/**
	 * Get the template for the news details
	 * 
	 * @param String $link
	 * @param String $title
	 * @param String $info
	 * @param String $text
	 * @return String
	 */
	public function getNewsSingleEntry($link, $title, $info, $text) {
		$layoutEntry = '';
		
		if(trim($this->_part2) != '') {
			$layoutEntry = trim($this->_part2);
			
			$layoutEntry = str_replace('#####NEWS_LINK#####', $link, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_TITLE#####', $title, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_INFORMATON#####', $info, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_TEXT#####', $text, $layoutEntry);
		}
		
		return $layoutEntry;
	}
	
	
	
	/**
	 * Get the template for the news comments
	 * 
	 * @param String $row
	 * @param String $gravatarLink
	 * @param String $counter
	 * @param String $autor
	 * @param String $date
	 * @param String $text
	 * @param String $admin
	 * @return String
	 */
	public function getNewsCommentEntry($row, $gravatarLink, $counter, $autor, $date, $text, $admin) {
		$layoutEntry = '';
		
		if(trim($this->_part3) != '') {
			$layoutEntry = trim($this->_part3);
			
			$text = str_replace('{php:}', '', $text);
			$text = str_replace('{:php}', '', $text);
			
			$layoutEntry = str_replace('#####NEWS_COMMENT_ROW#####', $row, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_GRAVATAR_LINK#####', $gravatarLink, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_COUNTER#####', $counter, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_AUTOR_NAME#####', $autor, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_DATE#####', $date, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_TEXT#####', $text, $layoutEntry);
			$layoutEntry = str_replace('#####NEWS_COMMENT_ADMIN#####', $admin, $layoutEntry);
		}
		
		return $layoutEntry;
	}
}

?>
