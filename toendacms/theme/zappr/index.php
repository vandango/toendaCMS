<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'merge/';

$mainLink = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'s='.$s;
$mainLink = $tcms_main->urlAmpReplace($mainLink);

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>moz.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link href="<? echo $skinPath; ?>ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 6]>
<link href="<? echo $skinPath; ?>ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 7]>
<link href="<? echo $skinPath; ?>ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>


<body>

<div id="page">
	<div id="header">
		<!--<h1 class="title">
			<?
			//echo _SITE_LOGO;
			//echo _SITE_NAME;
			?>
		</h1>
		<div class="description">
			<span class="subtitle">
				<? //echo _SITE_KEY; ?>
			</span>
		</div>-->
		<div class="logo">
			<a href="<? echo $mainLink; ?>">
			<img src="<? echo $skinPath; ?>ZapprBlogLogo.png" border="0" />
			</a>
		</div>
		
		<div class="menu">
			<ul>
				<li><? include(_TOP_MENU); ?></li>
			</ul>
		</div>
		
		<div class="livesearchform">
			<? include(_SEARCH); ?>
		</div>
	</div>
	
	<hr />
	
	<? echo '<div style="padding: 10px 0 0 36px;" class="pathway">&raquo; ';
	include(_PATHWAY);
	echo '</div>';?>
	
	<div class="mainText">
		<div class="item">
			<br />
			<? include(_CONTENT); ?>
		</div>
	</div>
 	
 	<div class="sidebar">
 		<?
		include(_SIDE_MENU);
		include(_FRONT_NEWS);
		include(_CATEGORIES);
		include(_MONTHVIEW);
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
	
	<div class="clear">
		<br />
		<br />
		<? include(_CONTENT_FOOTER); ?>
	</div>
</div>

<hr />

<div id="footer">
	<? include(_FOOTER); ?>
</div>

<br />

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/ -->

</body>

</html>
