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

$skinPath = $templatePath.'images/';

?>

<?php

echo _SITE_META_DATA;



?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<?php
$user_browser = browser_detection('browser');
if ( $user_browser == 'mozilla' )
{
	echo "<link href=".$skinPath.'solid_moz.css rel="stylesheet" type="text/css">' ;
	//echo "<br>"."MOZ" . "<br>";
}


else
{
	
	echo "<link href=".$skinPath.'solid_ie.css rel="stylesheet" type="text/css">' ;
	//echo "NON MOZ";
}
?>

</head>




<body class="twocolumns">

<div id="page">
	<div id="header">
		<? include(_LANG_SELECTOR); ?>
		
		<h1 class="title"><? echo _SITE_LOGO; ?><? echo _SITE_NAME; ?></h1>
		<div class="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></div>
		
		<div class="menu">
			<ul>
				<li><? include(_TOP_MENU); ?></li>
			</ul>
		</div>
	</div>
	
	<hr />
	
	<? echo '<div style="padding: 10px 0 0 36px;" class="pathway">&raquo; ';
	include(_PATHWAY);
	echo '</div>';?>
	
	<? if($k2CSS != 4){ ?>
		<div class="mainText"><div class="item"><br /><? include(_CONTENT); ?></div></div>
	<? } ?>
 	
 	<div class="sidebar">
 		<div class="livesearchform"><? include(_SEARCH); ?></div>
 		<br />
		<?
		include(_SIDE_MENU);
		include(_FRONT_NEWS);
		?>
		<div class="categorylist"><? include(_CATEGORIES); ?></div>
		<div class="categorylist"><? include(_MONTHVIEW); ?></div>
		<?
		include(_SIDE_LINKS);
		include(_LAST_IMAGES);
		include(_LOGIN);
		include(_POLL);
		include(_SHOW_LC);
		include(_NEWSLETTER);
		include(_SIDE);
		include(_CS);
		include(_SYNDICATION);
		?>
	</div>
	
	<? if($k2CSS == 4){ ?>
		<div class="mainText"><div class="item"><br /><? include(_CONTENT); ?></div></div>
	<? } ?>
	
	<div class="clear">
		<br />
		<br />
		<? include(_CONTENT_FOOTER); ?>
	</div>
</div>

<hr />

<div id="footer"><? include(_FOOTER); ?></div>

<br />

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/ -->

</body>

</html>
