<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

/*
Script Name: Simple 'if' PHP Browser detection
Author: Harald Hope, Website: http://TechPatterns.com/
Script Source URI: http://TechPatterns.com/downloads/php_browser_detection.php
Version 2.0.2
Copyright (C) 29 June 2007

This program is free software; you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT 
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

Get the full text of the GPL here: http://www.gnu.org/licenses/gpl.txt

Coding conventions:
http://cvs.sourceforge.net/viewcvs.py/phpbb/phpBB2/docs/codingstandards.htm?rev=1.3
*/

/*
the order is important, because opera must be tested first, and ie4 tested for before ie general
same for konqueror, then safari, then gecko, since safari navigator user agent id's with 'gecko' in string.
note that $dom_browser is set for all  modern dom browsers, this gives you a default to use, unfortunately we
haven't figured out a way to do this with actual method testing, which would be much better and reliable.

Please note: you have to call the function in order to get access to the variables, you call it by this:

browser_detection('browser');

then put you code that you want to use the variables with after that.

*/

function browser_detection( $which_test ) {

	// initialize the variables
	$browser = '';
	$dom_browser = '';

	// set to lower case to avoid errors, check to see if http_user_agent is set
	$navigator_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

	// run through the main browser possibilities, assign them to the main $browser variable
	if (stristr($navigator_user_agent, "opera")) 
	{
		$browser = 'opera';
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "msie 4")) 
	{
		$browser = 'msie4'; 
		$dom_browser = false;
	}

	elseif (stristr($navigator_user_agent, "msie")) 
	{
		$browser = 'msie'; 
		$dom_browser = true;
	}

	elseif ((stristr($navigator_user_agent, "konqueror")) || (stristr($navigator_user_agent, "safari"))) 
	{
		$browser = 'safari'; 
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "gecko")) 
	{
		$browser = 'mozilla';
		$dom_browser = true;
	}
	
	elseif (stristr($navigator_user_agent, "mozilla/4")) 
	{
		$browser = 'ns4';
		$dom_browser = false;
	}
	
	else 
	{
		$dom_browser = false;
		$browser = false;
	}

	// return the test result you want
	if ( $which_test == 'browser' )
	{
		return $browser;
	}
	elseif ( $which_test == 'dom' )
	{
		return $dom_browser;
		//  note: $dom_browser is a boolean value, true/false, so you can just test if
		// it's true or not.
	}
}

//echo browser_detection('browser');






/*
you would call it like this:

$user_browser = browser_detection('browser');

if ( $user_browser == 'opera' )
{
	do something;
}

or like this:

if ( browser_detection('dom') )
{
	execute the code for dom browsers
}
else
{
	execute the code for non DOM browsers
}

and so on.......


*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<?

$skinPath = $templatePath.'data/';

?>

<?php

echo _SITE_META_DATA;



?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><? echo $sitetitle; ?></title>
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2008 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />

<link rel="shortcut icon" href="img/favicon.png">

<script language="JavaScript">
//***************************************
// ROTATE IMAGES
//***************************************
var theImages = new Array();

theImages[0] = 'image00.jpeg';
theImages[1] = 'image01.jpeg';
theImages[2] = 'image02.jpeg';

var j = 0
var p = theImages.length;
var preBuffer = new Array()
for (i = 0; i < p; i++){
	preBuffer[i] = new Image()
	preBuffer[i].src = theImages[i]
}

var whichImage = Math.round(Math.random()*(p-1));
function showImage(){
	document.write('<img border="0" height="150" width="544" alt="Top Banner" src="theme/white_byte/data/'+theImages[whichImage]+'">');
}
</script>
<?php
$user_browser = browser_detection('browser');
if ( $user_browser == 'mozilla' )
{
	echo "<link href=".$skinPath.'basic.css rel="stylesheet" type="text/css">' ;
	//echo "<br>"."MOZ" . "<br>";
}


else
{
	
	echo "<link href=".$skinPath.'basic_ie.css rel="stylesheet" type="text/css">' ;
	//echo "NON MOZ";
}
?>


</head>


<body>

<table class="mainbox" align="center" border="0" cellpadding="0" cellspacing="0">

<tr><td class="headerbox">
	<div class="logobox">
	<? echo $sitelogo; ?>
	<a class="index" href="<? echo $owner_url; ?>">
	<span class="title"><? echo _SITE_NAME; ?></span>
	<br />
	<span class="subtitle"><? echo _SITE_KEY; ?></span>
	</a>
	</div>
</td></tr>

<tr><td class="pathwaybox">
	<span class="pathway">
		You are Here&nbsp;|&nbsp;<?include(_PATHWAY);?> <right><?include(_LANG_SELECTOR);?></right>
	
	</span>
</td></tr>

<tr><td valign="top">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td class="sidebox" valign="top">
		<table class="modulebox" cellpadding="0" cellspacing="0">
		
		<tr><td>  <?
			
			//====================================
			//	_SIDE_MENU
			//
			include(_SIDE_MENU);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_CATEGORIES
			//
			include(_CATEGORIES);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_MONTHVIEW
			//
			include(_MONTHVIEW);
			
		?><br /></td></tr>

		<tr><td><?
		
			//====================================
			//	_CS
			//
			include(_CS);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_LOGIN
			//
			include(_LOGIN);
			
		?><br /></td></tr>
	<tr><td><?
		
			//====================================
			//	_SITE_LINKS
			//
			include(_SIDE_LINKS);
			
		?><br /></td></tr>

		<tr><td><?
		
			//====================================
			//	_Last_IMAGES
			//
			include(_LAST_IMAGES);
			
		?><br /></td></tr>

		<tr><td><?
			
			//====================================
			//	_SHOW_LC
			//
			include(_SHOW_LC);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_NEWSLETTER
			//
			include(_NEWSLETTER);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_POLL
			//
			include(_POLL);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_SIDE
			//
			include(_SIDE);
			
		?></td></tr>
		<tr><td><?
		
			//====================================
			//	_SYNDICATION
			//
			include(_SYNDICATION);
			
		?></td></tr>

		</table>
	</td><td style="padding-left: 10px;" valign="top">
		<div class="imagebox">
		<script language="JavaScript">
		//====================================
		//	ROTATE IMAGES
		//
		
		showImage();
		
		</script>
		</div>
		
		<br />
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%" height="350">
		<tr><td valign="top" height="100%"><?
			
			//====================================
			//	_CONTENT
			//
			include(_CONTENT);
			
		?></td></tr>

		<tr><td valign="bottom"><?
			
			//====================================
			//	_CONTENT_FOOTER
			//
			include(_CONTENT_FOOTER);
			
		?></td></tr>

		</table>
	</td></tr>
	</table>
</td></tr>
</table>

<table class="bottombox" align="center" border="0" cellpadding="5" cellspacing="0" width="760">
<tr><td>
<center>Theme edit by Themeportal.de</center>
<?include(_FOOTER);?>
	
</td></tr>
</table>

</body>
</html>
