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
| File:		ext_syndication.php
| Version:	0.0.8
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');






if($use_syndication == 1){
	if($use_syn_title == 1){
		echo tcms_html::subtitle(_NEWS_SYNDICATION);
	}
	
	echo '<br />';
	
	if($use_rss091 == 1){
		$link = '?id=frontpage&amp;feed=RSS0.91&amp;save=true';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<div align="center">'
		.'<a href="'.$link.'">'
		.'<img src="'.$imagePath.'engine/images/logos/f_rss091.png" alt="RSS 0.91" title="RSS 0.91 Syndication" align="middle" name="image" border="0" /></a>'
		.'</div>';
	}
	
	if($use_rss10 == 1){
		$link = '?id=frontpage&amp;feed=RSS1.0&amp;save=true';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<div align="center">'
		.'<a href="'.$link.'">'
		.'<img src="'.$imagePath.'engine/images/logos/f_rss10.png" alt="RSS 1.0" title="RSS 1.0 Syndication" align="middle" name="image" border="0" /></a>'
		.'</div>';
	}
	
	if($use_rss20 == 1){
		$link = '?id=frontpage&amp;feed=RSS2.0&amp;save=true';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<div align="center">'
		.'<a href="'.$link.'">'
		.'<img src="'.$imagePath.'engine/images/logos/f_rss20.png" alt="RSS 2.0" title="RSS 2.0 Syndication" align="middle" name="image" border="0" /></a>'
		.'</div>';
	}
	
	if($use_atom03 == 1){
		$link = '?id=frontpage&amp;feed=ATOM0.3&amp;save=true';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<div align="center">'
		.'<a href="'.$link.'">'
		.'<img src="'.$imagePath.'engine/images/logos/atom03.gif" alt="ATOM 0.3" title="ATOM 0.3 Syndication" align="middle" name="image" border="0" /></a>'
		.'</div>';
	}
	
	if($use_opml == 1){
		$link = '?id=frontpage&amp;feed=OPML&amp;save=true';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<div align="center">'
		.'<a href="'.$link.'">'
		.'<img src="'.$imagePath.'engine/images/logos/opml.png" alt="OPML" title="OPML Syndication" align="middle" name="image" border="0" /></a>'
		.'</div>';
	}
	
	echo '<br />';
}

?>
