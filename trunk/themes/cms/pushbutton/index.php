<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="{language}" xml:lang="{language}">
<?

$skinPath = $templatePath.'data/';

/*
	if you want to use only
	one sidebar, change the value to 1
*/
$onlyOneSidebar = 0;


?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>style.css" rel="stylesheet" type="text/css" />
</head>


<body bgcolor="#ffffff">

<? include(_LANG_SELECTOR); ?>

<table id="primary-menu" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td id="home" width="144">
	<img style="margin: 0px !important; padding: 0px !important;" src="<? echo $skinPath; ?>logo-active.jpg" border="0" alt="Logo" />
</td>
<td id="site-info" width="100%" class="primary-links">
    <br />
    <span class="title"><? echo _SITE_LOGO; ?><? echo _SITE_NAME; ?></span>
    <br />
    <span class="subtitle"><? echo _SITE_KEY; ?></span>
    <br />
    <br />
</td></tr>
</table>

<table id="secondary-menu" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="25%" valign="bottom" style="padding-top: 4px; padding-left: 4px;">
	<nobr>
	<? include(_SEARCH); ?>	
	</nobr>
</td><td class="secondary-links" width="75%" align="left" valign="middle">
	<? include(_TOP_MENU); ?>
</td></tr>
</table>

<table id="content" border="0" cellpadding="15" cellspacing="0" width="100%" height="100%">
<tr><td id="sidebar-left">
	<?
	
	include(_SIDE_MENU);
	include(_FRONT_NEWS);
	include(_LOGIN);
	include(_CATEGORIES);
	include(_MONTHVIEW);
	include(_SIDE_LINKS);
	
	if($onlyOneSidebar == 1){
		include(_LAST_IMAGES);
		include(_POLL);
		include(_SHOW_LC);
		include(_CS);
		include(_SIDE);
		include(_NEWSLETTER);
		include(_SYNDICATION);
	}
	
	?>
</td><td valign="top">
	<table cellpadding="0" cellspacing="0" border="0" style="height: 100%; width: 97%;<? if($onlyOneSidebar == 1){ echo ' max-width: 900px;'; } ?>">
	<tr><td valign="top">
		<?
		
		echo '<div style="padding-left: 18px; padding-top: 5px;" class="pathway">URL: ';
		include(_PATHWAY);
		echo '</div>';
		
		?>
		<br />
	</td></tr>
	<tr><td height="100%" valign="top">
		<? include(_CONTENT); ?>
		<br />
	</td></tr>
	<tr><td valign="bottom">
		<? include(_CONTENT_FOOTER); ?>
	</td></tr>
	</table>
</td>
<?

if($onlyOneSidebar == 0){
	?><td id="sidebar-right">
	<?
	
	include(_LAST_IMAGES);
	include(_POLL);
	include(_SHOW_LC);
	include(_CS);
	include(_SIDE);
	include(_NEWSLETTER);
	include(_SYNDICATION);
	
	?>
	</td><?
}

?></tr>
</table>

<table id="footer-menu" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="center" valign="middle"><?
	include(_FOOTER);
?></td></tr>
</table>

</body>

</html>
