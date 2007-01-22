<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Newsmanager
|
| File:	tcms_dc_newsmanager.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Newsmanager
 *
 * This class is used as a datacontainer object for
 * the newsmanager.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_newsmanager {
	var $m_id;
	var $m_lang;
	var $m_title;
	var $m_key;
	var $m_text;
	var $m_image;
	var $m_UseComments;
	var $m_ShowAutor;
	var $m_ShowAutorAsLink;
	var $m_NewsAmount;
	var $m_NewsChars;
	var $m_Access;
	var $m_UseGravatar;
	var $m_UseEmoticons;
	var $m_UseTrachback;
	var $m_UseTimesince;
	var $m_ReadmoreLink;
	var $m_NewsSpacing;
	var $m_SynRSS091;
	var $m_SynRSS10;
	var $m_SynRSS20;
	var $m_SynRSSAtom;
	var $m_SynRSSOpml;
	var $m_SynAmount;
	var $m_SynUseTitle;
	var $m_SynDefaultFeed;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
	/**
	 * PHP5 Constructor
	 *
	 */
	function __construct() {
	}
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_dc_newsmanager(){
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/***
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	*/
	function setID($value){
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	function getID(){
		return $this->m_id;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	function setLanguage($value){
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	function getLanguage(){
		return $this->m_lang;
	}
	
	/***
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	*/
	function setTitle($value){
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	function getTitle(){
		return $this->m_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	function setSubtitle($value){
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	function getSubtitle(){
		return $this->m_key;
	}
	
	/***
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	*/
	function setText($value){
		$this->m_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	function getText(){
		return $this->m_text;
	}
	
	/***
	 * Set the image
	 * 
	 * @param String $value
	 * @return String
	*/
	function setImage($value){
		$this->m_image = $value;
	}
	
	/**
	 * Get the image
	 * 
	 * @return String
	 */
	function getImage(){
		return $this->m_image;
	}
	
	/***
	 * Set the UseComments
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseComments($value){
		$this->m_UseComments = $value;
	}
	
	/**
	 * Get the UseComments
	 * 
	 * @return String
	 */
	function getUseComments(){
		return $this->m_UseComments;
	}
	
	/***
	 * Set the ShowAutor
	 * 
	 * @param String $value
	 * @return String
	*/
	function setShowAutor($value){
		$this->m_ShowAutor = $value;
	}
	
	/**
	 * Get the ShowAutor
	 * 
	 * @return String
	 */
	function getShowAutor(){
		return $this->m_ShowAutor;
	}
	
	/***
	 * Set the ShowAutorAsLink
	 * 
	 * @param String $value
	 * @return String
	*/
	function setShowAutorAsLink($value){
		$this->m_ShowAutorAsLink = $value;
	}
	
	/**
	 * Get the ShowAutorAsLink
	 * 
	 * @return String
	 */
	function getShowAutorAsLink(){
		return $this->m_ShowAutorAsLink;
	}
	
	/***
	 * Set the NewsAmount
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsAmount($value){
		$this->m_NewsAmount = $value;
	}
	
	/**
	 * Get the NewsAmount
	 * 
	 * @return String
	 */
	function getNewsAmount(){
		return $this->m_NewsAmount;
	}
	
	/***
	 * Set the NewsChars
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsChars($value){
		$this->m_NewsChars = $value;
	}
	
	/**
	 * Get the NewsChars
	 * 
	 * @return String
	 */
	function getNewsChars(){
		return $this->m_NewsChars;
	}
	
	/***
	 * Set the Access
	 * 
	 * @param String $value
	 * @return String
	*/
	function setAccess($value){
		$this->m_Access = $value;
	}
	
	/**
	 * Get the Access
	 * 
	 * @return String
	 */
	function getAccess(){
		return $this->m_Access;
	}
	
	/***
	 * Set the UseGravatar
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseGravatar($value){
		$this->m_UseGravatar = $value;
	}
	
	/**
	 * Get the UseGravatar
	 * 
	 * @return String
	 */
	function getUseGravatar(){
		return $this->m_UseGravatar;
	}
	
	/***
	 * Set the UseEmoticons
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseEmoticons($value){
		$this->m_UseEmoticons = $value;
	}
	
	/**
	 * Get the UseEmoticons
	 * 
	 * @return String
	 */
	function getUseEmoticons(){
		return $this->m_UseEmoticons;
	}
	
	/***
	 * Set the UseTrachback
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseTrachback($value){
		$this->m_UseTrachback = $value;
	}
	
	/**
	 * Get the UseTrachback
	 * 
	 * @return String
	 */
	function getUseTrachback(){
		return $this->m_UseTrachback;
	}
	
	/***
	 * Set the UseTimesince
	 * 
	 * @param String $value
	 * @return String
	*/
	function setUseTimesince($value){
		$this->m_UseTimesince = $value;
	}
	
	/**
	 * Get the UseTimesince
	 * 
	 * @return String
	 */
	function getUseTimesince(){
		return $this->m_UseTimesince;
	}
	
	/***
	 * Set the ReadmoreLink
	 * 
	 * @param String $value
	 * @return String
	*/
	function setReadmoreLink($value){
		$this->m_ReadmoreLink = $value;
	}
	
	/**
	 * Get the ReadmoreLink
	 * 
	 * @return String
	 */
	function getReadmoreLink(){
		return $this->m_ReadmoreLink;
	}
	
	/***
	 * Set the NewsSpacing
	 * 
	 * @param String $value
	 * @return String
	*/
	function setNewsSpacing($value){
		$this->m_NewsSpacing = $value;
	}
	
	/**
	 * Get the NewsSpacing
	 * 
	 * @return String
	 */
	function getNewsSpacing(){
		return $this->m_NewsSpacing;
	}
	
	/***
	 * Set the SynRSS091
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationRSS091($value){
		$this->m_SynRSS091 = $value;
	}
	
	/**
	 * Get the SynRSS091
	 * 
	 * @return String
	 */
	function getSyndicationRSS091(){
		return $this->m_SynRSS091;
	}
	
	/***
	 * Set the SynRSS10
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationRSS10($value){
		$this->m_SynRSS10 = $value;
	}
	
	/**
	 * Get the SynRSS10
	 * 
	 * @return String
	 */
	function getSyndicationRSS10(){
		return $this->m_SynRSS10;
	}
	
	/***
	 * Set the SynRSS20
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationRSS20($value){
		$this->m_SynRSS20 = $value;
	}
	
	/**
	 * Get the SynRSS20
	 * 
	 * @return String
	 */
	function getSyndicationRSS20(){
		return $this->m_SynRSS20;
	}
	
	/***
	 * Set the SynRSSAtom
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationRSSAtom($value){
		$this->m_SynRSSAtom = $value;
	}
	
	/**
	 * Get the SynRSSAtom
	 * 
	 * @return String
	 */
	function getSyndicationRSSAtom(){
		return $this->m_SynRSSAtom;
	}
	
	/***
	 * Set the SynRSSOpml
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationRSSOpml($value){
		$this->m_SynRSSOpml = $value;
	}
	
	/**
	 * Get the SynRSSOpml
	 * 
	 * @return String
	 */
	function getSyndicationRSSOpml(){
		return $this->m_SynRSSOpml;
	}
	
	/***
	 * Set the SynAmount
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationAmount($value){
		$this->m_SynAmount = $value;
	}
	
	/**
	 * Get the SynAmount
	 * 
	 * @return String
	 */
	function getSyndicationAmount(){
		return $this->m_SynAmount;
	}
	
	/***
	 * Set the SynUseTitle
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationUseTitle($value){
		$this->m_SynUseTitle = $value;
	}
	
	/**
	 * Get the SynUseTitle
	 * 
	 * @return String
	 */
	function getSyndicationUseTitle(){
		return $this->m_SynUseTitle;
	}
	
	/***
	 * Set the SynDefaultFeed
	 * 
	 * @param String $value
	 * @return String
	*/
	function setSyndicationDefaultFeed($value){
		$this->m_SynDefaultFeed = $value;
	}
	
	/**
	 * Get the SynDefaultFeed
	 * 
	 * @return String
	 */
	function getSyndicationDefaultFeed(){
		return $this->m_SynDefaultFeed;
	}
}

?>
