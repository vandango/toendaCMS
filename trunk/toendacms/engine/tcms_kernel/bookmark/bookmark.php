
<!--
* Social Bookmark Script
* @ Version 1.8
* @ Copyright (C) 2006-2007 by Alexander Hadj Hassine - All rights reserved
* @ Website http://www.social-bookmark-script.de/
* @
* @ Bei Nutzung des Scripts muessen alle unsere Copyright-Hinweise und Links in dem Script selbst,
* @ sowie in der Anzeige/Ausgabe unveraendert bleiben!
* @ 
* @ D.h., sie duerfen nicht entfernt, umgewandelt, versteckt oder unsichtbar gemacht werden,
* @ es sei den Sie verlinken http://www.social-bookmark-script.de/ mindestens 1 mal
* @ "suchmaschinenfreundlich" von Ihrer Startseite!
-->

<a target="_blank" style="text-decoration:none; font-size:11px; font-family:Arial; color: #2A4956;" href="http://www.favit.de/tools.php">Social Bookmarking</a>
<br/>
<div style="border-top-style:solid; padding-top:3px; border-top-width: 1px; border-top-color: #2A4956;">

<script language="JavaScript" type="text/JavaScript">
<!--

function Social_Load() { 
	var d = document;
	
	if(d.images) {
		if(!d.Social) {
			d.Social=new Array();
		}
		
		var i, j = d.Social.length, a = Social_Load.arguments;
		
		for(i = 0; i < a.length; i++) {
			if(a[i].indexOf("#") != 0) {
				d.Social[j] = new Image;
				d.Social[j++].src = a[i];
			}
		}
	}
}

Social_Load(
	'http://www.social-bookmark-script.de/img/bookmarks/wong_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/webnews_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/icio_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/oneview_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/folkd_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/yigg_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/linkarena_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/newskick_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/linksilo_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/readster_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/seekxl_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/favit_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/sbdk_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/boni_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/power_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/favoriten_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/bookmarkscc_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/newsider_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/digg_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/del_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/reddit_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/simpy_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/stumbleupon_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/slashdot_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/netscape_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/furl_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/yahoo_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/spurl_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/google_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/blinklist_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/blogmarks_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/diigo_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/technorati_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/newsvine_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/blinkbits_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/ma.gnolia_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/smarking_trans_ani.gif', 
	'http://www.social-bookmark-script.de/img/bookmarks/netvouz_trans_ani.gif', 
	'http://www.social-bookmark-script.de/load.gif'
);

function schnipp() {
	var i, x, a = document.MM_sr;
	
	for(i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) {
		x.src = x.oSrc;
	}
}

function schnupp(n, d) {
	var p, i, x;
	
	if(!d) {
		d = document;
	}
	
	if((p = n.indexOf("?")) > 0 && parent.frames.length) {
		d = parent.frames[n.substring(p+1)].document;
		n = n.substring(0,p);
	}
	
	if(!(x = d[n]) && d.all) {
		x = d.all[n];
	}
	
	for(i = 0; !x && i < d.forms.length; i++) {
		x = d.forms[i][n];
	}
	
	for(i = 0; !x && d.layers && i < d.layers.length; i++) {
		x = schnupp(n, d.layers[i].document);
	}
	
	if(!x && d.getElementById) {
		x = d.getElementById(n);
	}
	
	return x;
}

function schnapp() {
	var i, j = 0, x, a = schnapp.arguments;
	
	document.MM_sr = new Array;
	
	for(i = 0; i < (a.length - 2); i += 3) {
		if((x = schnupp(a[i])) != null) {
			document.MM_sr[j++] = x;
			
			if(!x.oSrc) {
				x.oSrc = x.src;
			}
			
			x.src = a[i+2];
		}
	}
}
//-->

</script>
<a rel="nofollow" style="text-decoration:none;" href="http://www.mister-wong.de/" onclick="window.open('http://www.mister-wong.de/index.php?action=addurl&amp;bm_url='+encodeURIComponent(location.href)+'&amp;bm_notice=&amp;bm_description='+encodeURIComponent(document.title)+'&amp;bm_tags=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Mr. Wong" onmouseover="schnapp('wong',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/wong_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/wong_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Mr. Wong" name="wong" border="0" id="wong"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.webnews.de/" onclick="window.open('http://www.webnews.de/einstellen?url='+encodeURIComponent(document.location)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Webnews" onmouseover="schnapp('Webnews',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/webnews_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/webnews_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Webnews" name="Webnews" border="0" id="Webnews"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.icio.de/" onclick="window.open('http://www.icio.de/add.php?url='+encodeURIComponent(location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Icio" onmouseover="schnapp('Icio',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/icio_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/icio_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Icio" name="Icio" border="0" id="Icio"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.oneview.de/" onclick="window.open('http://www.oneview.de/quickadd/neu/addBookmark.jsf?URL='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Oneview" onmouseover="schnapp('Oneview',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/oneview_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/oneview_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Oneview" name="Oneview" border="0" id="Oneview"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.linkarena.com/" onclick="window.open('http://linkarena.com/bookmarks/addlink/?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title)+'&amp;desc=&amp;tags=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Linkarena" onmouseover="schnapp('Linkarena',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/linkarena_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/linkarena_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Linkarena" name="Linkarena" border="0" id="Linkarena"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.favoriten.de/" onclick="window.open('http://www.favoriten.de/url-hinzufuegen.html?bm_url='+encodeURIComponent(location.href)+'&amp;bm_title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Favoriten" onmouseover="schnapp('Favoriten',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/favoriten_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/favoriten_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Favoriten" name="Favoriten" border="0" id="Favoriten"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://social-bookmarking.seekxl.de/" onclick="window.open('http://social-bookmarking.seekxl.de/?add_url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Seekxl" onmouseover="schnapp('Seekxl',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/seekxl_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/seekxl_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Seekxl" name="Seekxl" border="0" id="Seekxl"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.favit.de/" onclick="window.open('http://www.favit.de/submit.php?url='+(document.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Favit" onmouseover="schnapp('Favit',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/favit_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/favit_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Favit" name="Favit" border="0" id="Favit"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.social-bookmarking.dk/" onclick="window.open('http://www.social-bookmarking.dk/bookmarks/?action=add&amp;title='+encodeURIComponent(document.title)+'&amp;address='+(document.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Social Bookmarking Tool" onmouseover="schnapp('Sbdk',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/sbdk_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/sbdk_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Social Bookmarking Tool" name="Sbdk" border="0" id="Sbdk"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.bonitrust.de/" onclick="window.open('http://www.bonitrust.de/account/bookmark/?bookmark_url='+ unescape(location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: BoniTrust" onmouseover="schnapp('Boni',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/boni_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/boni_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: BoniTrust" name="Boni" border="0" id="Boni"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.power-oldie.com/" onclick="window.open('http://www.power-oldie.com/');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Power Oldie" onmouseover="schnapp('Power',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/power_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/power_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Power Oldie" name="Power" border="0" id="Power"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.bookmarks.cc/" onclick="window.open('http://www.bookmarks.cc/bookmarken.php?action=neu&amp;url='+(document.location.href)+'&amp;title='+(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Bookmarks.cc" onmouseover="schnapp('Bookmarkscc',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/bookmarkscc_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/bookmarkscc_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Bookmarks.cc" name="Bookmarkscc" border="0" id="Bookmarkscc"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.newskick.de/" onclick="window.open('http://www.newskick.de/submit.php?url='+(document.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Newskick" onmouseover="schnapp('Newskick',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/newskick_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/newskick_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Newskick" name="Newskick" border="0" id="Newskick"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.newsider.de/" onclick="window.open('http://www.newsider.de/submit.php?url='+(document.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Newsider" onmouseover="schnapp('Newsider',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/newsider_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/newsider_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Newsider" name="Newsider" border="0" id="Newsider"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.linksilo.de" onclick="window.open('http://www.linksilo.de/index.php?area=bookmarks&amp;func=bookmark_new&amp;addurl='+encodeURIComponent(location.href)+'&amp;addtitle='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Linksilo" onmouseover="schnapp('Linksilo',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/linksilo_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/linksilo_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Linksilo" name="Linksilo" border="0" id="Linksilo"/></a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.readster.de/" onclick="window.open('http://www.readster.de/submit/?url='+encodeURIComponent(document.location)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Readster" onmouseover="schnapp('Readster',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/readster_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/readster_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Readster" name="Readster" border="0" id="Readster"/></a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.folkd.com/" onclick="window.open('http://www.folkd.com/submit/'+(dokument.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Folkd" onmouseover="schnapp('Folkd',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/folkd_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/folkd_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Folkd" name="Folkd" border="0" id="Folkd"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://yigg.de/" onclick="window.open('http://yigg.de/neu?exturl='+encodeURIComponent(location.href));return false" title="<?php echo _TABLE_BOOKMARK; ?>: Yigg" onmouseover="schnapp('Yigg',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/yigg_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/yigg_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Yigg" name="Yigg" border="0" id="Yigg"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://digg.com/" onclick="window.open('http://digg.com/submit?phase=2&amp;url='+encodeURIComponent(location.href)+'&amp;bodytext=&amp;tags=&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Digg" onmouseover="schnapp('Digg',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/digg_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/digg_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Digg" name="Digg" border="0" id="Digg"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://del.icio.us/" onclick="window.open('http://del.icio.us/post?v=2&amp;url='+encodeURIComponent(location.href)+'&amp;notes=&amp;tags=&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Del.icio.us" onmouseover="schnapp('Delicious',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/del_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/del_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Del.icio.us" name="Delicious" border="0" id="Delicious"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://reddit.com/" onclick="window.open('http://reddit.com/submit?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Reddit" onmouseover="schnapp('Reddit',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/reddit_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/reddit_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Reddit" name="Reddit" border="0" id="Reddit"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.simpy.com/" onclick="window.open('http://www.simpy.com/simpy/LinkAdd.do?title='+encodeURIComponent(document.title)+'&amp;tags=&amp;note=&amp;href='+encodeURIComponent(location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Simpy" onmouseover="schnapp('Simpy',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/simpy_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/simpy_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Simpy" name="Simpy" border="0" id="Simpy"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.stumbleupon.com/" onclick="window.open('http://www.stumbleupon.com/submit?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: StumbleUpon" onmouseover="schnapp('StumbleUpon',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/stumbleupon_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/stumbleupon_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: StumbleUpon" name="StumbleUpon" border="0" id="StumbleUpon"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://slashdot.org/" onclick="window.open('http://slashdot.org/bookmark.pl?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Slashdot" onmouseover="schnapp('Slashdot',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/slashdot_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/slashdot_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Slashdot" name="Slashdot" border="0" id="Slashdot"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.netscape.com/" onclick="window.open('http://www.netscape.com/submit/?U='+encodeURIComponent(location.href)+'&amp;T='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Netscape" onmouseover="schnapp('Netscape',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/netscape_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/netscape_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Netscape" name="Netscape" border="0" id="Netscape"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.furl.net/" onclick="window.open('http://www.furl.net/storeIt.jsp?u='+encodeURIComponent(location.href)+'&amp;keywords=&amp;t='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Furl" onmouseover="schnapp('Furl',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/furl_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/furl_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Furl" name="Furl" border="0" id="Furl"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.yahoo.com/" onclick="window.open('http://myweb2.search.yahoo.com/myresults/bookmarklet?t='+encodeURIComponent(document.title)+'&amp;d=&amp;tag=&amp;u='+encodeURIComponent(location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Yahoo" onmouseover="schnapp('Yahoo',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/yahoo_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/yahoo_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Yahoo" name="Yahoo" border="0" id="Yahoo"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.spurl.net/" onclick="window.open('http://www.spurl.net/spurl.php?v=3&amp;tags=&amp;title='+encodeURIComponent(document.title)+'&amp;url='+encodeURIComponent(document.location.href));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Spurl" onmouseover="schnapp('Spurl',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/spurl_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/spurl_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Spurl" name="Spurl" border="0" id="Spurl"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.google.com/" onclick="window.open('http://www.google.com/bookmarks/mark?op=add&amp;hl=de&amp;bkmk='+encodeURIComponent(location.href)+'&amp;annotation=&amp;labels=&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Google" onmouseover="schnapp('Google',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/google_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/google_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Google" name="Google" border="0" id="Google"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.blinklist.com/" onclick="window.open('http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=&amp;Tag=&amp;Url='+encodeURIComponent(location.href)+'&amp;Title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Blinklist" onmouseover="schnapp('Blinklist',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/blinklist_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/blinklist_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Blinklist" name="Blinklist" border="0" id="Blinklist"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://blogmarks.net/" onclick="window.open('http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url='+encodeURIComponent(location.href)+'&amp;content=&amp;public-tags=&amp;title='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Blogmarks" onmouseover="schnapp('Blogmarks',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/blogmarks_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/blogmarks_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Blogmarks" name="Blogmarks" border="0" id="Blogmarks"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.diigo.com/" onclick="window.open('http://www.diigo.com/post?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title)+'&amp;tag=&amp;comments='); return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Diigo" onmouseover="schnapp('Diigo',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/diigo_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/diigo_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Diigo" name="Diigo" border="0" id="Diigo"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.technorati.com/" onclick="window.open('http://technorati.com/faves?add='+encodeURIComponent(location.href)+'&amp;tag=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Technorati" onmouseover="schnapp('Technorati',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/technorati_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/technorati_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Technorati" name="Technorati" border="0" id="Technorati"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.newsvine.com/" onclick="window.open('http://www.newsvine.com/_wine/save?popoff=1&amp;u='+encodeURIComponent(location.href)+'&amp;tags=&amp;blurb='+encodeURIComponent(document.title));return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Newsvine" onmouseover="schnapp('Newsvine',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/newsvine_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/newsvine_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Newsvine" name="Newsvine" border="0" id="Newsvine"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.blinkbits.com/" onclick="window.open('http://www.blinkbits.com/bookmarklets/save.php?v=1&amp;title='+encodeURIComponent(document.title)+'&amp;source_url='+encodeURIComponent(location.href)+'&amp;source_image_url=&amp;rss_feed_url=&amp;rss_feed_url=&amp;rss2member=&amp;body=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Blinkbits" onmouseover="schnapp('Blinkbits',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/blinkbits_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/blinkbits_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Blinkbits" name="Blinkbits" border="0" id="Blinkbits"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://ma.gnolia.com/" onclick="window.open('http://ma.gnolia.com/bookmarklet/add?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title)+'&amp;description=&amp;tags=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Ma.Gnolia" onmouseover="schnapp('MaGnolia',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/ma.gnolia_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/ma.gnolia_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Ma.Gnolia" name="MaGnolia" border="0" id="MaGnolia"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://smarking.com/" onclick="window.open('http://smarking.com/editbookmark/?url='+ location.href +'&amp;description=&amp;tags=');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Smarking" onmouseover="schnapp('Smarking',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/smarking_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/smarking_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Smarking" name="Smarking" border="0" id="Smarking"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://www.netvouz.com/" onclick="window.open('http://www.netvouz.com/action/submitBookmark?url='+encodeURIComponent(location.href)+'&amp;description=&amp;tags=&amp;title='+encodeURIComponent(document.title)+'&amp;popup=yes');return false;" title="<?php echo _TABLE_BOOKMARK; ?>: Netvouz" onmouseover="schnapp('Netvouz',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/netvouz_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/netvouz_trans.gif" alt="<?php echo _TABLE_BOOKMARK; ?>: Netvouz" name="Netvouz" border="0" id="Netvouz"/> </a>
<a rel="nofollow" style="text-decoration:none;" href="http://de.wikipedia.org/wiki/Social_Bookmarks" target="_Blank" title="Information" onmouseover="schnapp('Information',  	'',  	'http://www.social-bookmark-script.de/img/bookmarks/what_trans_ani.gif',1)" onmouseout="schnipp()" > <img style="padding-bottom:1px;" src="http://www.social-bookmark-script.de/img/bookmarks/what_trans.gif" alt="Information" name="Information" border="0" id="Information"/> </a>
</div>
