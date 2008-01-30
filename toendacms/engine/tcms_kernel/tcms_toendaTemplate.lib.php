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
 * @version 0.0.5
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
 * PUBLIC MEMBERS
 *--------------------------------------------------------
 * 
 * checkTemplateExist                  -> Check if the template exist
 * loadTemplate                        -> Load a template into the buffer
 * unloadTemplate                      -> Unload a template into the buffer
 * getGuestbookEntry                   -> Get the entry template for a guestbook entry
 * getLinksCategoryTitle               -> Get the category title template for a link
 * getLinksEntry                       -> Get the entry template for a link
 * 
 * </code>
 *
 */


class tcms_toendaTemplate {
	private $_tcmsFile;
	
	private $_buffer;
	
	
	
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
			if(strpos($this->_buffer, '<!--#####LINK_TITLE_TEMPLATE#####-->') > 0
			&& strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->') > 0) {
				$layoutEntryTitle = substr(
					$this->_buffer, 
					0, 
					strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->')
				);
				
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
			if(strpos($this->_buffer, '<!--#####LINK_ENTRY_TEMPLATE#####-->') > 0) {
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
}

?>
