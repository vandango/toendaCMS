<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| RSS, Atom and OPML Syndication
|
| File:	ext_syndication.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * RSS, Atom and OPML Syndication
 *
 * This module provides the syndication.
 *
 * @version 0.1.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_syndication == 1) {
	if($use_syn_title == 1) {
		echo $tcms_html->subTitle(_NEWS_SYNDICATION);
	}
	
	echo '<br />';
	
	if($use_rss091 == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed=RSS0.91&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_rss091_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_rss091_img ? 'center' : 'left' ).'">';
		
		if($use_rss091_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/f_rss091.png"'
			.' alt="RSS 0.91"'
			.' title="RSS 0.91 Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="RSS 0.91"'
			.' title="RSS 0.91 Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$rss091_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	if($use_rss10 == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed=RSS1.0&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_rss10_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_rss10_img ? 'center' : 'left' ).'">';
		
		if($use_rss10_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/f_rss10.png"'
			.' alt="RSS 1.0"'
			.' title="RSS 1.0 Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="RSS 1.0"'
			.' title="RSS 1.0 Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$rss10_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	if($use_rss20 == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed=RSS2.0&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_rss20_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_rss20_img ? 'center' : 'left' ).'">';
		
		if($use_rss20_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/f_rss20.png"'
			.' alt="RSS 2.0"'
			.' title="RSS 2.0 Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="RSS 2.0"'
			.' title="RSS 2.0 Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$rss20_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	if($use_atom03 == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed=ATOM0.3&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_atom03_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_atom03_img ? 'center' : 'left' ).'">';
		
		if($use_atom03_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/atom03.gif"'
			.' alt="ATOM 0.3"'
			.' title="ATOM 0.3 Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="ATOM 0.3"'
			.' title="ATOM 0.3 Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$atom03_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	if($use_opml == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed=OPML&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_opml_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_opml_img ? 'center' : 'left' ).'">';
		
		if($use_opml_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/opml.png"'
			.' alt="OPML"'
			.' title="OPML Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="OPML"'
			.' title="OPML Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$opml_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	if($use_cfeed == 1) {
		$link = '?id=frontpage&amp;s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' )
		.'&amp;feed='.$cfeed_type.'&amp;item=comments&amp;save=true';
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<div'
		.' style="display: block;'.( $use_cfeed_img ? '' : ' margin: 7px 0 2px 0;' ).'"'
		.' align="'.( $use_cfeed_img ? 'center' : 'left' ).'">';
		
		if($use_cfeed_img) {
			echo '<a href="'.$link.'">'
			.'<img'
			.' src="'.$imagePath.'engine/images/logos/f_rss20.png"'
			.' alt="'.$cfeed_type.'"'
			.' title="'.$cfeed_type.' Syndication"'
			.' align="middle"'
			.' name="image"'
			.' border="0" />';
		}
		else {
			echo '<img'
			.' class="syndicationImage"'
			.' src="'.$imagePath.'engine/images/logos/feed.png"'
			.' alt="'.$cfeed_type.'"'
			.' title="'.$cfeed_type.' Syndication"'
			.' name="image"'
			.' border="0" />';
			
			echo '<a class="syndicationLink" href="'.$link.'">'
			.'<strong>'
			.$cfeed_text
			.'</strong>'
			.'</a>';
		}
		
		echo '</div>';
	}
	
	echo '<br />';
}

?>
