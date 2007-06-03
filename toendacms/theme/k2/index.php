<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'images/';

//
// CHANGE THIS VALUE TO
// 1 = K2
// 2 = K2 BIG
// 3 = K2 Vader
// 4 = KS Garcia Solar Landscape
//

$k2CSS = 4;

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<script type="text/javascript" language="JavaScript">
var name = navigator.userAgent.toLowerCase()
var css = 'moz';

var ie = (name.indexOf("msie")>-1 && name.indexOf("opera") == -1)
var netscape = (name.indexOf("mozilla") >=-1 && name.indexOf("msie")==-1)

if(ie) css = 'ie';
else css = 'moz';
</script>
<?

switch($k2CSS){
	case 1:
		echo '<script type="text/javascript" language="JavaScript">'
		.'document.write (\'<link href="'.$skinPath.'k2_\' + css + \'.css" rel="stylesheet" type="text/css" />\');'
		.'</script>';
		break;
	
	case 2:
		echo '<link href="'.$skinPath.'k2_big.css" rel="stylesheet" type="text/css" />';
		break;
	
	case 3:
		echo '<link href="'.$skinPath.'vader.css" rel="stylesheet" type="text/css" />';
		break;
	
	case 4:
		echo '<script type="text/javascript" language="JavaScript">'
		.'document.write (\'<link href="'.$skinPath.'k2_\' + css + \'.css" rel="stylesheet" type="text/css" />\');'
		.'</script>';
		echo '<link href="'.$skinPath.'k2_garciasolar.css" rel="stylesheet" type="text/css" />';
		break;
	
	default:
		echo '<link href="'.$skinPath.'k2_moz.css" rel="stylesheet" type="text/css" />';
		break;
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
	
	<? if($k2CSS != 5){ ?>
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
	
	<? if($k2CSS == 5){ ?>
		<div class="mainText"><div class="item"><br /><? include(_CONTENT); ?></div></div>
	<? } ?>
	
	<div class="clear">
		<br />
		<br />
		<? include(_CONTENT_FOOTER); ?>
	</div>
</div>

<hr />

<div id="footer">
	<?
	include(_FOOTER);
	?>
</div>

<br />

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/ -->

</body>

</html>
