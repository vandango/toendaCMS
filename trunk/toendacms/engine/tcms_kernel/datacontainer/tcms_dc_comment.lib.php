<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Comment DataContainer
|
| File:		tcms_dc_comment.lib.php
| Version:	0.0.1
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Comment data container
 *
 * This class is used as a datacontainer object for
 * comment items.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_comment {
	var $m_name;
	var $m_email;
	var $m_url;
	var $m_time;
	var $m_timestamp;
	var $m_text;
	var $m_id;
	var $m_ip;
	var $m_domain;
	var $m_module;
	
	/***
	* @return
	* @desc Constructor: initialize the data container
	*/
	function tcms_dc_comment(){
	}
	
	/***
	* @return string
	* @desc Get or set the name
	*/
	function SetName($value){ $this->m_name = $value; }
	function GetName(){ return $this->m_name; }
	
	/***
	* @return string
	* @desc Get or set the email
	*/
	function SetEMail($value){ $this->m_email = $value; }
	function GetEMail(){ return $this->m_email; }
	
	/***
	* @return string
	* @desc Get or set the url
	*/
	function SetURL($value){ $this->m_url = $value; }
	function GetURL(){ return $this->m_url; }
	
	/***
	* @return string
	* @desc Get or set the news time
	*/
	function SetTime($value){ $this->m_time = $value; }
	function GetTime(){ return $this->m_time; }
	
	/***
	* @return string
	* @desc Get or set the news timestamp
	*/
	function SetTimestamp($value){ $this->m_timestamp = $value; }
	function GetTimestamp(){ return $this->m_timestamp; }
	
	/***
	* @return string
	* @desc Get or set the text
	*/
	function SetText($value){ $this->m_text = $value; }
	function GetText(){ return $this->m_text; }
	
	/***
	* @return string
	* @desc Get or set the id
	*/
	function SetID($value){ $this->m_id = $value; }
	function GetID(){ return $this->m_id; }
	
	/***
	* @return string
	* @desc Get or set the ip
	*/
	function SetIP($value){ $this->m_ip = $value; }
	function GetIP(){ return $this->m_ip; }
	
	/***
	* @return string
	* @desc Get or set the domain
	*/
	function SetDomain($value){ $this->m_domain = $value; }
	function GetDomain(){ return $this->m_domain; }
	
	/***
	* @return string
	* @desc Get or set the module
	*/
	function SetModule($value){ $this->m_module = $value; }
	function GetModule(){ return $this->m_module; }
}
