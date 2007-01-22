<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Impressum DataContainer
|
| File:	tcms_dc_impressum.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Impressum data container
 *
 * This class is used as a datacontainer object for
 * publishing form items.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_impressum {
	var $m_title;
	var $m_key;
	var $m_legal;
	var $m_contact;
	var $m_id;
	var $m_taxno;
	var $m_ustid;
	
	/***
	* @return
	* @desc Constructor: initialize the data container
	*/
	function tcms_dc_impressum(){
	}
	
	/***
	* @return string
	* @desc Get or set the title
	*/
	function SetTitle($value){ $this->m_title = $value; }
	function GetTitle(){ return $this->m_title; }
	
	/***
	* @return string
	* @desc Get or set the key
	*/
	function SetKeynote($value){ $this->m_key = $value; }
	function GetKeynote(){ return $this->m_key; }
	/***
	* @return string
	* @desc Get or set the text
	*/
	function SetText($value){ $this->m_legal = $value; }
	function GetText(){ return $this->m_legal; }
	
	/***
	* @return string
	* @desc Get or set the content content01
	*/
	function SetContact($value){ $this->m_contact = $value; }
	function GetContact(){ return $this->m_contact; }
	
	/***
	* @return string
	* @desc Get or set the news id
	*/
	function SetID($value){ $this->m_id = $value; }
	function GetID(){ return $this->m_id; }
	
	/***
	* @return string
	* @desc Get or set the tax no
	*/
	function SetTaxNumber($value){ $this->m_taxno = $value; }
	function GetTaxNumber(){ return $this->m_taxno; }
	
	/***
	* @return string
	* @desc Get or set the ust id
	*/
	function SetUstID($value){ $this->m_ustid = $value; }
	function GetUstID(){ return $this->m_ustid; }
}

?>
