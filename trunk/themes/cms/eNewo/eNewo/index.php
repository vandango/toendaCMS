<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'';

$char_xml = new xmlparser('data/tcms_global/var.xml','r');
$charset = $char_xml->read_section('global', 'charset');

//
// CHANGE THIS VALUE TO
// 1 = Dark Theme
//

$eNewsColor = 1;

?>
<head>
<title><?
	echo _SITE_TITLE.' :: ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>Basic/basic_theme.css" rel="stylesheet" type="text/css" />
<?

switch($eNewsColor){
	case 1:
		echo '<link href="'.$skinPath.'Dark/dark_theme.css" rel="stylesheet" type="text/css" />';
		$eNewsThemeFolder = 'Dark';
		break;
	
	default:
		echo '<link href="'.$skinPath.'Dark/dark_theme.css" rel="stylesheet" type="text/css" />';
		$eNewsThemeFolder = 'Dark';
		break;
}

?>
<!--[if lte IE 6]>
<link href="" rel="stylesheet" type="text/css" />
<![endif]-->
</head>



<body class="page_bg">

<div id="wrapper">
	<div id="shadow_left">
		<div id="shadow_right">
			<!-- HEADER -->
			<div id="header_box">
				<div class="contentpadding">
					<h1 class="title"><? echo $sitelogo; ?><? echo _SITE_NAME; ?></h1>
					<div class="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></div>
				</div>
				
				<div id="search_box">
					<div class="contentpadding">
						<div class="search">
							<? include(_SEARCH); ?>
						</div>
					</div>
				</div>
			</div>
			
			
			<!-- MENU -->
			<div id="header_menu" align="center">
				<? include(_TOP_MENU); ?>
			</div>
			
			
			<!-- CONTENT -->
			<table id="content" class="nospace" border="0">
			<tr valign="top">
				<td class="maincontent">
					<!-- PATHWAY -->
					<div id="pathway_box">
						<div class="pathway_mods">
							<img src="<? echo $skinPath.$eNewsThemeFolder; ?>/bullet_grey.png" border="0" />
							<? include(_PATHWAY); ?>
						</div>
					</div>
					
					
					<!-- CONTENT -->
					<div id="maincontent">
						<? include(_CONTENT); ?>
					</div>
				</td>
				<td class="right_mods">
					<div class="shadow_top">
						<div id="shadow_tl">
							<div id="sidebar">
								<?
								
								if($navigation == 1){
									echo '<div class="moduletable">';
									include(_LANG_SELECTOR);
									include(_SIDE_MENU);
									echo '</div>';
								}
								
								if($sb_news_enabled == 1){// && $id == 'frontpage'){
									echo '<div class="moduletable">';
									include(_FRONT_NEWS);
									echo '</div>';
								}
								
								if($use_side_category == 1){
									echo '<div class="moduletable">';
									include(_CATEGORIES);
									echo '</div>';
								}
								
								if($use_side_archives == 1){
									echo '<div class="moduletable">';
									include(_MONTHVIEW);
									echo '</div>';
								}
								
								if($use_side_links == 1){
									echo '<div class="moduletable">';
									include(_SIDE_LINKS);
									echo '</div>';
								}
								
								if($use_side_gallery == 1){
									echo '<div class="moduletable">';
									include(_LAST_IMAGES);
									echo '</div>';
								}
								
								if($use_login == 1){
									echo '<div class="moduletable">';
									include(_LOGIN);
									echo '</div>';
								}
								
								if($use_poll == 1){
									echo '<div class="moduletable">';
									include(_POLL);
									echo '</div>';
								}
								
								if($use_layout_chooser == 1){
									echo '<div class="moduletable">';
									include(_SHOW_LC);
									echo '</div>';
								}
								
								if($use_newsletter == 1){
									echo '<div class="moduletable">';
									include(_NEWSLETTER);
									echo '</div>';
								}
								
								if($use_sidebar == 1){
									echo '<div class="moduletable">';
									include(_SIDE);
									echo '</div>';
								}
								
								if($use_components == 1){
									if(is_array($arrSideCS) && !empty($arrSideCS)){
										echo '<div class="moduletable">';
										include(_CS);
										echo '</div>';
									}
								}
								
								if($use_syndication == 1){
									echo '<div class="moduletable">';
									include(_SYNDICATION);
									echo '</div>';
								}
								
								?>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<td class="footer">
					<div id="footer_mods">
						<? include(_CONTENT_FOOTER); ?>
						<br />
					</div>
				</td>
				<td class="right_mods">
					&nbsp;
				</td>
			</tr>
			</table>
			
			<div id="padbottom"></div>
		</div>
	</div>
</div>

<br />

<div align="center">
	<? include(_FOOTER); ?>
</div>

<br />

</body>

</html>
