<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skin_path  = 'theme/salt/data/';

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

<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="700">
<tr><td>
	<img src="<? echo $skin_path; ?>footer.gif" border="0" />
	<div style="border-right: 1px solid #cccccc; border-left: 1px solid #cccccc;">
	&nbsp;where do we go &raquo;<?
	
	//====================================
	// _PATHWAY
	//
	include(_PATHWAY);
	
	?></div>
	
	<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="700">
	
	<tr><td background="<? echo $skin_path; ?>header.gif" height="30" style="background-repeat: no-repeat;">
		&nbsp;
	</td></tr>
	
	<tr><td>
		<table border="0" cellpadding="0" cellspacing="0" width="700">
		<tr><td colspan="5" valign="top" background="<? echo $skin_path; ?>top.gif" height="123" style="background-repeat: no-repeat;">
			<? echo $sitelogo; ?>
			<div  style="padding-top: 5px;">
			<span class="title"><a class="index" href="<? echo $owner_url; ?>"><? echo _SITE_NAME; ?></a></span>
			<br />
			<span class="subtitle"><? echo _SITE_KEY; ?></span>
			</div>
		</td></tr>
		</table>
		
		
		<table border="0" cellpadding="0" cellspacing="0" width="700">
		<tr><td width="500" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="500">
			<tr><td colspan="5" style="padding: 10px;">
				<br /><?
				
				//====================================
				// _CONTENT
				//
				include(_CONTENT);
				
			?></td></tr>
			</table>
		</td><td background="<? echo $skin_path; ?>dot.gif" width="5" style="background-repeat: repeat-y;">
		</td><td valign="top" width="195" bgcolor="f5f5f5">
			<table class="moduletable" cellpadding="0" cellspacing="0">
			<tr><td style="padding: 3px;"><?
				
				//====================================
				// _SIDE_MENU
				//
				include(_SIDE_MENU);
				
				//====================================
				// _CATEGORIES
				//
				include(_CATEGORIES);
				
				//====================================
				// _CS
				//
				include(_CS);
				
				//====================================
				// _LOGIN
				//
				include(_LOGIN);
				
				//====================================
				// _SHOW_LC
				//
				include(_SHOW_LC);
				
				//====================================
				// _NEWSLETTER
				//
				include(_NEWSLETTER);
				
				//====================================
				// _POLL
				//
				include(_POLL);
				
				//====================================
				// _SIDE
				//
				include(_SIDE);
				
			?></td></tr>
			</table>
		</td></tr>
		<tr><td><?
			
			//====================================
			// _CONTENT_FOOTER
			//
			include(_CONTENT_FOOTER);
			
		?></td><td background="<? echo $skin_path; ?>dot.gif" width="5" style="background-repeat: repeat-y;">
		</td><td valign="top" width="195" bgcolor="f5f5f5">&nbsp;
		</td></tr>
		</table>
	</td></tr>
	<tr><td bgcolor="#eeeeee">
		<div style="padding: 10px;"><?
		
		//====================================
		// _FOOTER
		//
		include(_FOOTER);
		
		?></div>
		<img src="<? echo $skin_path; ?>footer.gif" border="0" />
	</td></tr>
	</table>
</td></tr>
</table>

</body>

</html>
