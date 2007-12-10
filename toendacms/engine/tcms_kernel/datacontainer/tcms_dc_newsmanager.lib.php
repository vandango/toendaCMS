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
 * @version 0.1.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


class tcms_dc_newsmanager {
	private $m_id;
	private $m_lang;
	private $m_title;
	private $m_key;
	private $m_text;
	private $m_image;
	private $m_UseComments;
	private $m_ShowAutor;
	private $m_ShowAutorAsLink;
	private $m_NewsAmount;
	private $m_NewsChars;
	private $m_Access;
	private $m_UseGravatar;
	private $m_UseEmoticons;
	private $m_UseTrachback;
	private $m_UseTimesince;
	private $m_ReadmoreLink;
	private $m_NewsSpacing;
	private $m_SynRSS091;
	private $m_SynRSS10;
	private $m_SynRSS20;
	private $m_SynRSSAtom;
	private $m_SynRSSOpml;
	private $m_SynAmount;
	private $m_SynUseTitle;
	private $m_SynDefaultFeed;
	private $m_UseRSS091Image;
	private $m_RSS091Text;
	private $m_UseRSS10Image;
	private $m_RSS10Text;
	private $m_UseRSS20Image;
	private $m_RSS20Text;
	private $m_UseATOM03Image;
	private $m_ATOM03Text;
	private $m_UseOPMLImage;
	private $m_OPMLText;
	private $m_use_comment_feed;
	private $m_comment_feed_text;
	private $m_comment_feed_type;
	private $m_use_comment_feed_img;
	private $m_comment_feed_amount;
	
	// ---------------------------------------
	// Constructors / Destructors
	// ---------------------------------------
	
	/**
	 * PHP5 Constructor
	 *
	 */
	public function __construct() {
	}
	
	/**
	 * PHP4 Constructor
	 *
	 */
	public function tcms_dc_newsmanager() {
		$this->__construct();
	}
	
	// ---------------------------------------
	// Properties
	// ---------------------------------------
	
	/**
	 * Set the id
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setID($value) {
		$this->m_id = $value;
	}
	
	/**
	 * Get the id
	 * 
	 * @return String
	 */
	public function getID() {
		return $this->m_id;
	}
	
	/**
	 * Set the language
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setLanguage($value) {
		$this->m_lang = $value;
	}
	
	/**
	 * Get the language
	 * 
	 * @return String
	 */
	public function getLanguage() {
		return $this->m_lang;
	}
	
	/**
	 * Set the title
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setTitle($value) {
		$this->m_title = $value;
	}
	
	/**
	 * Get the title
	 * 
	 * @return String
	 */
	public function getTitle() {
		return $this->m_title;
	}
	
	/**
	 * Set the subtitle
	 * 
	 * @param String $value
	 */
	public function setSubtitle($value) {
		$this->m_key = $value;
	}
	
	/**
	 * Get the subtitle
	 * 
	 * @return String
	 */
	public function getSubtitle() {
		return $this->m_key;
	}
	
	/**
	 * Set the text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setText($value) {
		$this->m_text = $value;
	}
	
	/**
	 * Get the text
	 * 
	 * @return String
	 */
	public function getText() {
		return $this->m_text;
	}
	
	/**
	 * Set the image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setImage($value) {
		$this->m_image = $value;
	}
	
	/**
	 * Get the image
	 * 
	 * @return String
	 */
	public function getImage() {
		return $this->m_image;
	}
	
	/**
	 * Set the UseComments
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseComments($value) {
		$this->m_UseComments = $value;
	}
	
	/**
	 * Get the UseComments
	 * 
	 * @return String
	 */
	public function getUseComments() {
		return $this->m_UseComments;
	}
	
	/**
	 * Set the ShowAutor
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowAutor($value) {
		$this->m_ShowAutor = $value;
	}
	
	/**
	 * Get the ShowAutor
	 * 
	 * @return String
	 */
	public function getShowAutor() {
		return $this->m_ShowAutor;
	}
	
	/**
	 * Set the ShowAutorAsLink
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setShowAutorAsLink($value) {
		$this->m_ShowAutorAsLink = $value;
	}
	
	/**
	 * Get the ShowAutorAsLink
	 * 
	 * @return String
	 */
	public function getShowAutorAsLink() {
		return $this->m_ShowAutorAsLink;
	}
	
	/**
	 * Set the NewsAmount
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNewsAmount($value) {
		$this->m_NewsAmount = $value;
	}
	
	/**
	 * Get the NewsAmount
	 * 
	 * @return String
	 */
	public function getNewsAmount() {
		return $this->m_NewsAmount;
	}
	
	/**
	 * Set the NewsChars
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNewsChars($value) {
		$this->m_NewsChars = $value;
	}
	
	/**
	 * Get the NewsChars
	 * 
	 * @return String
	 */
	public function getNewsChars() {
		return $this->m_NewsChars;
	}
	
	/**
	 * Set the Access
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setAccess($value) {
		$this->m_Access = $value;
	}
	
	/**
	 * Get the Access
	 * 
	 * @return String
	 */
	public function getAccess() {
		return $this->m_Access;
	}
	
	/**
	 * Set the UseGravatar
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseGravatar($value) {
		$this->m_UseGravatar = $value;
	}
	
	/**
	 * Get the UseGravatar
	 * 
	 * @return String
	 */
	public function getUseGravatar() {
		return $this->m_UseGravatar;
	}
	
	/**
	 * Set the UseEmoticons
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseEmoticons($value) {
		$this->m_UseEmoticons = $value;
	}
	
	/**
	 * Get the UseEmoticons
	 * 
	 * @return String
	 */
	public function getUseEmoticons() {
		return $this->m_UseEmoticons;
	}
	
	/**
	 * Set the UseTrachback
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseTrackback($value) {
		$this->m_UseTrachback = $value;
	}
	
	/**
	 * Get the UseTrachback
	 * 
	 * @return String
	 */
	public function getUseTrackback() {
		return $this->m_UseTrachback;
	}
	
	/**
	 * Set the UseTimesince
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setUseTimesince($value) {
		$this->m_UseTimesince = $value;
	}
	
	/**
	 * Get the UseTimesince
	 * 
	 * @return String
	 */
	public function getUseTimesince() {
		return $this->m_UseTimesince;
	}
	
	/**
	 * Set the ReadmoreLink
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setReadmoreLink($value) {
		$this->m_ReadmoreLink = $value;
	}
	
	/**
	 * Get the ReadmoreLink
	 * 
	 * @return String
	 */
	public function getReadmoreLink() {
		return $this->m_ReadmoreLink;
	}
	
	/**
	 * Set the NewsSpacing
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setNewsSpacing($value) {
		$this->m_NewsSpacing = $value;
	}
	
	/**
	 * Get the NewsSpacing
	 * 
	 * @return String
	 */
	public function getNewsSpacing() {
		return $this->m_NewsSpacing;
	}
	
	/**
	 * Set the SynRSS091
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS091($value) {
		$this->m_SynRSS091 = $value;
	}
	
	/**
	 * Get the SynRSS091
	 * 
	 * @return String
	 */
	public function getSyndicationRSS091() {
		return $this->m_SynRSS091;
	}
	
	/**
	 * Set the SynRSS10
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS10($value) {
		$this->m_SynRSS10 = $value;
	}
	
	/**
	 * Get the SynRSS10
	 * 
	 * @return String
	 */
	public function getSyndicationRSS10() {
		return $this->m_SynRSS10;
	}
	
	/**
	 * Set the SynRSS20
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS20($value) {
		$this->m_SynRSS20 = $value;
	}
	
	/**
	 * Get the SynRSS20
	 * 
	 * @return String
	 */
	public function getSyndicationRSS20() {
		return $this->m_SynRSS20;
	}
	
	/**
	 * Set the SynRSSAtom
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSSAtom($value) {
		$this->m_SynRSSAtom = $value;
	}
	
	/**
	 * Get the SynRSSAtom
	 * 
	 * @return String
	 */
	public function getSyndicationRSSAtom() {
		return $this->m_SynRSSAtom;
	}
	
	/**
	 * Set the SynRSSOpml
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSSOpml($value) {
		$this->m_SynRSSOpml = $value;
	}
	
	/**
	 * Get the SynRSSOpml
	 * 
	 * @return String
	 */
	public function getSyndicationRSSOpml() {
		return $this->m_SynRSSOpml;
	}
	
	/**
	 * Set the SynAmount
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationAmount($value) {
		$this->m_SynAmount = $value;
	}
	
	/**
	 * Get the SynAmount
	 * 
	 * @return String
	 */
	public function getSyndicationAmount() {
		return $this->m_SynAmount;
	}
	
	/**
	 * Set the SynUseTitle
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseTitle($value) {
		$this->m_SynUseTitle = $value;
	}
	
	/**
	 * Get the SynUseTitle
	 * 
	 * @return String
	 */
	public function getSyndicationUseTitle() {
		return $this->m_SynUseTitle;
	}
	
	/**
	 * Set the SynDefaultFeed
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationDefaultFeed($value) {
		$this->m_SynDefaultFeed = $value;
	}
	
	/**
	 * Get the SynDefaultFeed
	 * 
	 * @return String
	 */
	public function getSyndicationDefaultFeed() {
		return $this->m_SynDefaultFeed;
	}
	
	/**
	 * Set the UseRSS091Image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseRSS091Image($value) {
		$this->m_UseRSS091Image = $value;
	}
	
	/**
	 * Get the UseRSS091Image
	 * 
	 * @return String
	 */
	public function getSyndicationUseRSS091Image() {
		return $this->m_UseRSS091Image;
	}
	
	/**
	 * Set the RSS091Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS091Text($value) {
		$this->m_RSS091Text = $value;
	}
	
	/**
	 * Get the RSS091Text
	 * 
	 * @return String
	 */
	public function getSyndicationRSS091Text() {
		return $this->m_RSS091Text;
	}
	
	/**
	 * Set the UseRSS10Image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseRSS10Image($value) {
		$this->m_UseRSS10Image = $value;
	}
	
	/**
	 * Get the UseRSS10Image
	 * 
	 * @return String
	 */
	public function getSyndicationUseRSS10Image() {
		return $this->m_UseRSS10Image;
	}
	
	/**
	 * Set the RSS10Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS10Text($value) {
		$this->m_RSS10Text = $value;
	}
	
	/**
	 * Get the RSS10Text
	 * 
	 * @return String
	 */
	public function getSyndicationRSS10Text() {
		return $this->m_RSS10Text;
	}
	
	/**
	 * Set the UseRSS20Image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseRSS20Image($value) {
		$this->m_UseRSS20Image = $value;
	}
	
	/**
	 * Get the UseRSS20Image
	 * 
	 * @return String
	 */
	public function getSyndicationUseRSS20Image() {
		return $this->m_UseRSS20Image;
	}
	
	/**
	 * Set the RSS20Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationRSS20Text($value) {
		$this->m_RSS20Text = $value;
	}
	
	/**
	 * Get the RSS20Text
	 * 
	 * @return String
	 */
	public function getSyndicationRSS20Text() {
		return $this->m_RSS20Text;
	}
	
	/**
	 * Set the UseATOM03Image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseATOM03Image($value) {
		$this->m_UseATOM03Image = $value;
	}
	
	/**
	 * Get the UseATOM03Image
	 * 
	 * @return String
	 */
	public function getSyndicationUseATOM03Image() {
		return $this->m_UseATOM03Image;
	}
	
	/**
	 * Set the ATOM03Text
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationATOM03Text($value) {
		$this->m_ATOM03Text = $value;
	}
	
	/**
	 * Get the ATOM03Text
	 * 
	 * @return String
	 */
	public function getSyndicationATOM03Text() {
		return $this->m_ATOM03Text;
	}
	
	/**
	 * Set the UseATOM03Image
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseOPMLImage($value) {
		$this->m_UseOPMLImage = $value;
	}
	
	/**
	 * Get the UseOPMLImage
	 * 
	 * @return String
	 */
	public function getSyndicationUseOPMLImage() {
		return $this->m_UseOPMLImage;
	}
	
	/**
	 * Set the OPMLText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationOPMLText($value) {
		$this->m_OPMLText = $value;
	}
	
	/**
	 * Get the OPMLText
	 * 
	 * @return String
	 */
	public function getSyndicationOPMLText() {
		return $this->m_OPMLText;
	}
	
	/**
	 * Set the UseCommentFeed
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseCommentFeed($value) {
		$this->m_use_comment_feed = $value;
	}
	
	/**
	 * Get the UseCommentFeed
	 * 
	 * @return String
	 */
	public function getSyndicationUseCommentFeed() {
		return $this->m_use_comment_feed;
	}
	
	/**
	 * Set the CommentFeedText
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationCommentFeedText($value) {
		$this->m_comment_feed_text = $value;
	}
	
	/**
	 * Get the CommentFeedText
	 * 
	 * @return String
	 */
	public function getSyndicationCommentFeedText() {
		return $this->m_comment_feed_text;
	}
	
	/**
	 * Set the CommentFeedType
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationCommentFeedType($value) {
		$this->m_comment_feed_type = $value;
	}
	
	/**
	 * Get the CommentFeedType
	 * 
	 * @return String
	 */
	public function getSyndicationCommentFeedType() {
		return $this->m_comment_feed_type;
	}
	
	/**
	 * Set the UseCommentFeedImage
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationUseCommentFeedImage($value) {
		$this->m_use_comment_feed_img = $value;
	}
	
	/**
	 * Get the UseCommentFeedImage
	 * 
	 * @return String
	 */
	public function getSyndicationUseCommentFeedImage() {
		return $this->m_use_comment_feed_img;
	}
	
	/**
	 * Set the CommentFeedAmount
	 * 
	 * @param String $value
	 * @return String
	 */
	public function setSyndicationCommentFeedAmount($value) {
		$this->m_comment_feed_amount = $value;
	}
	
	/**
	 * Get the CommentFeedAmount
	 * 
	 * @return String
	 */
	public function getSyndicationCommentFeedAmount() {
		return $this->m_comment_feed_amount;
	}
}

?>
