<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'data/';

$char_xml   = new xmlparser('data/tcms_global/var.xml','r');
$charset    = $char_xml->read_section('global', 'charset');

?>
<head>
<head>
<title><? echo $sitetitle.' :: '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2005 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<link href="<? echo $skinPath; ?>styles.css" rel="stylesheet" type="text/css" />
</head>


<body>

<div id="container">
	<div id="banner">
		<? echo $sitelogo; ?>
		<h1 class="title"><? echo _SITE_NAME; ?></h1>
		<h3 class="subtitle"><? echo _SITE_KEY; ?></h3>
	</div><?
	
	echo '<div style="display: block; width: 100%; background-color: #f8f8f8; height: 18px; margin: 0 0 2px 0;">';
	//====================================
	//	_PATHWAY
	//
	include(_TOP_MENU);
	echo '</div>';
	
	?><div style="display: block;"><?
		
		echo '<div style="background-color: #f8f8f8;">';
		//====================================
		//	_PATHWAY
		//
		include(_PATHWAY);
		echo '</div>';
		
		?><div id="center">
			<div class="content"><?
			
			//====================================
			//	_PATHWAY
			//
			include(_CONTENT);
			
			?></div>
		</div>
		
		<div id="right">
			<div class="sidebar"><?
				
				//====================================
				//	_SIDE_MENU
				//
				include(_SIDE_MENU);
				
				//====================================
				//	_CATEGORIES
				//
				include(_CATEGORIES);
				
				//====================================
				//	_CS
				//
				include(_CS);
				
				//====================================
				//	_SIDE_LINKS
				//
				include(_SIDE_LINKS);
				
				//====================================
				//	_SEARCH
				//
				include(_SEARCH);
				
				echo '<br />';
				
				//====================================
				//	_LOGIN
				//
				include(_LOGIN);
				
				//====================================
				//	_SHOW_LC
				//
				include(_SHOW_LC);
				
				//====================================
				//	_NEWSLETTER
				//
				include(_NEWSLETTER);
				
				//====================================
				//	_POLL
				//
				include(_POLL);
				
				//====================================
				//	_SIDE
				//
				include(_SIDE);
				
				?>
			</div>
		</div>
	</div>
	<div style="clear: both;">&nbsp;</div><?
	
	//====================================
	//	_FOOTER
	//
	include(_CONTENT_FOOTER);
	
	?><br />
</div>

<div align="center" id="footer"><?
	
	//====================================
	//	_FOOTER
	//
	include(_FOOTER);
	
?></div>

</body>

</html>
