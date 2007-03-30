<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skin_path  = 'theme/autumnfog/data/';

$footer_xml = new xmlparser('data/tcms_global/footer.xml','r');
$owner_url  = $footer_xml->read_section('footer', 'owner_url');

$char_xml   = new xmlparser('data/tcms_global/var.xml','r');
$charset    = $char_xml->read_section('global', 'charset');

?>
<head>
<head>
<title><? echo $sitetitle.' :: '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2004 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<link href="<? echo $skin_path; ?>css.css" rel="stylesheet" type="text/css">
</head>

<body>
<a name="top" id="top"></a>

<table height="100%" border="0" cellpadding="0" cellspacing="0" width="100%">

<tr><td width="42" bgcolor="#F0F0F0" height="43" background="<? echo $skin_path; ?>border_left_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_top_left.png" width="42" height="43" />
</td><td width="716" height="43" bgcolor="#E0E0E0" background="<? echo $skin_path; ?>shading_top_middle.jpg">
	<?
	
	//====================================
	//	_PATHWAY
	//
	include(_PATHWAY);
	
	?>
</td><td bgcolor="#F0F0F0" height="43" style="background-repeat:repeat-x;" background="<? echo $skin_path; ?>border_top_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_top_right.png" width="42" height="43" />
</td></tr>

<tr><td width="42" bgcolor="#F0F0F0" height="120" background="<? echo $skin_path; ?>border_left_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_left.png" width="42" height="120" />
</td><td width="716" bgcolor="#A0C0D0" height="120" background="<? echo $skin_path; ?>logo_back.jpg" align="left" valign="top">
	<h1 class="title"><a class="index" href="<? echo $owner_url; ?>"><? echo _SITE_NAME; ?></a></h1>
	<h3 class="subtitle"><? echo _SITE_KEY; ?></h3>
</td><td bgcolor="#F0F0F0" height="120" style="background-repeat:repeat-y;" background="<? echo $skin_path; ?>border_right_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_right.jpg" width="42" height="120" />
</td></tr>

<tr><td width="42" bgcolor="#F0F0F0" height="42" background="<? echo $skin_path; ?>border_left_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_bottom_left.png" width="42" height="42" />
</td><td width="716" bgcolor="#E0E0E0" height="42" background="<? echo $skin_path; ?>shading_bottom_middle.jpg">&nbsp;<?
	
	//====================================
	//	_PATHWAY
	//
	include(_TOP_MENU);
	
?></td><td bgcolor="#F0F0F0" height="42" style="background-repeat:repeat-x;" background="<? echo $skin_path; ?>border_bottom_back.png">
	<img border="0" src="<? echo $skin_path; ?>shading_bottom_right.jpg" width="42" height="42" />
</td></tr>

<tr><td width="42" bgcolor="#F0F0F0" background="<? echo $skin_path; ?>border_left_back.png">&nbsp;</td>
<td width="716" bgcolor="#E0E0E0" valign="top">
	<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr><td width="150" valign="top" style="border-right:1px dotted #ccc"><?
		
		//====================================
		//	_SIDE_MENU
		//
		include(_SIDE_MENU);
		
		//====================================
		//	_CATEGORIES
		//
		include(_CATEGORIES);
		
		//====================================
		//	_SHOW_LC
		//
		include(_CS);
		
		//====================================
		//	_NEWSLETTER
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
		
	?></td><td valign="top"><?
		
		//====================================
		// _PATHWAY
		//
		include(_CONTENT);
		
	?></td></tr>
	</table><?
	
	//====================================
	//	_CONTENT_FOOTER
	//
	include(_CONTENT_FOOTER);
	
	?><div id="footer"><?
	
	//====================================
	//	_FOOTER
	//
	include(_FOOTER);
	
	?></div>
</td>
<td bgcolor="#F0F0F0" style="background-repeat:repeat-y;" background="<? echo $skin_path; ?>border_right_back.png">&nbsp;</td></tr>

</table>

</body>
</html>
