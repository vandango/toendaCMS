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
 * @version 0.1.1
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
 * getLinksCategoryTitle               -> Get the category title template for a link
 * getLinksEntry                       -> Get the entry template for a link
 * parseNewsTemplate                   -> Parse the news template
 * getNewsFrontpageEntry               -> Get the template for the news on the frontpage
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
	 * @return Boolean
	 */
	public function checkTemplateExist($file) {
		if($this->_tcmsFile->checkFileExist($file)) {
			return true;
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
	 * Get the category title template for a link
	 *
	 * @param String $title
	 * @return String
	 */
	public function getLinksCategoryTitle($title) {
		$layoutEntryTitle = '';
		
		if(trim($this->_buffer) != '') {
			if(strpos($this->_buffer, '<!--#####LINK_TITLE_TEMPLATE#####-->') > -1) {
				if(strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->') > -1) {
					$layoutEntryTitle = substr(
						$this->_buffer, 
						0, 
						strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->')
					);
				}
				else {
					$layoutEntryTitle = substr(
						$this->_buffer, 
						0
					);
				}
				
				$layoutEntryTitle = trim($layoutEntryTitle);
				$layoutEntryTitle = str_replace('<!--#####LINK_TITLE_TEMPLATE#####-->', '', $layoutEntryTitle);
				$layoutEntryTitle = str_replace('<!--#####LINK_ENTRY_TEMPLATE#####-->', '', $layoutEntryTitle);
				
				$layoutEntryTitle = str_replace('#####LINK_TITLE#####', $title, $layoutEntryTitle);
			}
		}
		
		return $layoutEntryTitle;
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
		$layoutEntryText = '';
		
		if(trim($this->_buffer) != '') {
			if(strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->') > -1) {
				$layoutEntryText = substr(
					$this->_buffer, 
					strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->')
				);
				
				$layoutEntryText = trim($layoutEntryText);
				$layoutEntryText = str_replace('<!--#####LINK_TITLE_TEMPLATE#####-->', '', $layoutEntryText);
				$layoutEntryText = str_replace('<!--#####LINK_ENTRY_TEMPLATE#####-->', '', $layoutEntryText);
				
				$layoutEntryText = str_replace('#####LINK_TARGET#####', $entryTarget, $layoutEntryText);
				$layoutEntryText = str_replace('#####LINK_LINK#####', $entryLink, $layoutEntryText);
				$layoutEntryText = str_replace('#####LINK_TEXT#####', $entryText, $layoutEntryText);
				$layoutEntryText = str_replace('#####LINK_DESC#####', $entryDesc, $layoutEntryText);
			}
		}
		
		return $layoutEntryText;
	}
	
	
	
	/**
	 * Parse the news template
	 *
	 */
	public function parseNewsTemplate() {
		if(trim($this->_buffer) != '') {
			// part 1
			if(strpos($this->_buffer, '<!--#####NEWS_FRONTPAGE_TEMPLATE#####-->') > -1) {
				if(strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE#####-->') > -1) {
					$this->_part1 = substr(
						$this->_buffer, 
						0, 
						strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE#####-->')
					);
				}
				else {
					if(strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->') > -1) {
						$this->_part1 = substr(
							$this->_buffer, 
							0, 
							strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->')
						);
					}
					else {
						$this->_part1 = substr(
							$this->_buffer, 
							0
						);
					}
				}
				
				if(strpos($this->_part1, 'news.information.seperator') > -1) {
					$posSepStart = strpos($this->_part1, 'news.information.seperator') + 27;
					$posSepEnd = strpos(
						$this->_part1, 
						chr(10), 
						$posSepStart
					);
					
					$this->_sepererator = substr(
						$this->_part1, 
						$posSepStart, 
						$posSepEnd - $posSepStart
					);
					
					$this->_part1 = substr($this->_part1, $posSepEnd);
				}
				
				$this->_part1 = str_replace('<!--#####NEWS_FRONTPAGE_TEMPLATE#####-->', '', $this->_part1);
				$this->_part1 = str_replace('<!--#####NEWS_SINGLE_TEMPLATE#####-->', '', $this->_part1);
				$this->_part1 = str_replace('<!--#####NEWS_COMMENT_TEMPLATE#####-->', '', $this->_part1);
			}
			
			// part 2
			if(strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE#####-->') > -1) {
				if(strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->') > -1) {
					$this->_part2 = substr(
						$this->_buffer, 
						0, 
						strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->')
					);
				}
				else {
					$this->_part2 = substr(
						$this->_buffer, 
						strpos($this->_buffer, '<!--#####NEWS_SINGLE_TEMPLATE#####-->')
					);
				}
				
				$this->_part2 = str_replace('<!--#####NEWS_FRONTPAGE_TEMPLATE#####-->', '', $this->_part2);
				$this->_part2 = str_replace('<!--#####NEWS_SINGLE_TEMPLATE#####-->', '', $this->_part2);
				$this->_part2 = str_replace('<!--#####NEWS_COMMENT_TEMPLATE#####-->', '', $this->_part2);
			}
			
			// part 3
			if(strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->') > -1) {
				$this->_part3 = substr(
					$this->_buffer, 
					strpos($this->_buffer, '<!--#####NEWS_COMMENT_TEMPLATE#####-->')
				);
				
				$this->_part3 = str_replace('<!--#####NEWS_FRONTPAGE_TEMPLATE#####-->', '', $this->_part3);
				$this->_part3 = str_replace('<!--#####NEWS_SINGLE_TEMPLATE#####-->', '', $this->_part3);
				$this->_part3 = str_replace('<!--#####NEWS_COMMENT_TEMPLATE#####-->', '', $this->_part3);
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
}

?>
