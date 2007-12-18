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

$k2CSS = 1;

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<?php

echo _SITE_META_DATA;

switch($k2CSS){
	case 1:
		echo '
		<style type="text/css">@import "'.$skinPath.'k2_moz.css";</style>
		<!--[if lt IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 6]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 7]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		';
		break;
	
	case 2:
		echo '<style type="text/css">@import "'.$skinPath.'k2_big.css";</style>';
		break;
	
	case 3:
		echo '<style type="text/css">@import "'.$skinPath.'vader.css";</style>';
		break;
	
	case 4:
		echo '
		<style type="text/css">@import "'.$skinPath.'k2_moz.css";</style>
		<!--[if lt IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 6]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 7]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->'
		.'<style type="text/css">@import "'.$skinPath.'k2_garciasolar.css";</style>
		';
		break;
	
	default:
		echo '
		<style type="text/css">@import "'.$skinPath.'k2_moz.css";</style>
		<!--[if lt IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 5.5000]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 6]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		<!--[if IE 7]><style type="text/css">@import "'.$skinPath.'k2_ie.css";</style><![endif]-->
		';
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
 		<?
 		echo '<div class="livesearchform">';
		include(_SEARCH);
		echo '</div>';
		
		include(_SIDE_MENU);
		include(_FRONT_NEWS);
		
		if($use_side_category == 1) {
			echo '<div class="categorylist">';
			include(_CATEGORIES);
			echo '</div>';
		}
		
		if($use_side_archives == 1) {
			echo '<div class="categorylist">';
			include(_MONTHVIEW);
			echo '</div>';
		}
		
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


</body>

</html>
