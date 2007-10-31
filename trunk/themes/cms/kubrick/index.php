<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'images/';

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>kubrick.css" rel="stylesheet" type="text/css" />

</head>


<body>

<div id="page">
	<div id="header">
		<div id="headerimg">
			<h1 class="title"><? echo _SITE_NAME; ?></h1>
			<div class="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></div>
		</div>
	</div>
	
	<hr />
	
	<div style="padding-left: 18px; padding-top: 5px;" class="pathway">
		&raquo;
		<?
		include(_LANG_SELECTOR);
		include(_PATHWAY);
		?>
	</div>
	
	<hr />
	
	<div id="contentpage" class="narrowcolumn"><? include(_CONTENT); ?></div>

	<div id="sidebar">
		<?
		include(_SEARCH);
		include(_SIDE_MENU);
		include(_FRONT_NEWS);
		include(_CATEGORIES);
		include(_MONTHVIEW);
		include(_SIDE_LINKS);
		include(_CS);
		include(_LOGIN);
		include(_POLL);
		include(_SHOW_LC);
		include(_NEWSLETTER);
		include(_SIDE);
		include(_SYNDICATION);
		?>
	</div>
	
	<hr />
	
	<div id="footer"><?
		echo '<div style="padding-left: 37px;">';
		include(_CONTENT_FOOTER);
		echo '</div><br />';
		include(_FOOTER);
	?></div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->

</body>

</html>
