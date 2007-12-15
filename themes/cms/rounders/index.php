<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = 'theme/rounders/data/';

$char_xml   = new xmlparser('data/tcms_global/var.xml','r');
$charset    = $char_xml->read_section('global', 'charset');

?>
<head>
<title><? echo $sitetitle.' :: '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2005 Toenda Software Development.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<link href="<? echo $skinPath; ?>rounders.css" rel="stylesheet" type="text/css" />


<style type="text/css">
@import url("http://www.blogger.com/css/blog_controls.css");
@import url("http://www.blogger.com/dyn-css/authorization.css?blogID=14694387");
</style>
<style type="text/css">@import url(http://www.blogger.com/css/navbar/main.css);
@import url(http://www.blogger.com/css/navbar/2.css);
</style></head>





<body>

<div>
	<div id="content">
		<div id="header"><div>
		
		<h1 id="blog-title" class="title"><? echo _SITE_NAME; ?></h1>
		<p id="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></p>
		<? include(_TOP_MENU); ?>
	</div>
</div>


<? echo '<div style="padding-left: 18px; padding-top: 5px;" class="pathway">Adress: ';
include(_PATHWAY);
echo '</div>'; ?>


<div id="main">
	<div id="main2">
		<div id="main3">
			<div class="post"><? include(_CONTENT); ?></div>
			<div class="post"><? include(_CONTENT_FOOTER); ?></div>
		</div>
	</div>
</div>


<div id="sidebar">
	<div id="profile-container">
		<h2 class="profile-datablock">
			<? include(_LANG_SELECTOR); ?>
			<? include(_SEARCH); ?>
		</h2>
	</div>
	
	<div class="box">
		<div class="box2">
			<div class="box3">
				<h2 class="sidebar-title"></h2>
				<ul><? include(_SIDE_MENU); ?></ul>
				<ul><? include(_CATEGORIES); ?></ul>
				<ul><? include(_LOGIN); ?></ul>
				<ul><? include(_SIDE_LINKS); ?></ul>
				<ul><? include(_POLL); ?></ul>
				<ul><? include(_LAST_IMAGES); ?></ul>
				<ul><? include(_SHOW_LC); ?></ul>
				<ul><? include(_NEWSLETTER); ?></ul>
				<ul><? include(_SIDE); 	?></ul>
				<ul><? include(_CS); ?></ul>
				<ul><? include(_SYNDICATION);?></ul>

			</div>
		</div>
	</div>
</div>

<div id="footer"><div>

<div style="text-align: center;" align="center">
	<hr />
	<p style="text-align: center;"><? include(_FOOTER); ?></p>
</div>

</body>

</html>
