<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skin_path = 'theme/blue_label/data/';

$footer_xml = new xmlparser('data/tcms_global/footer.xml','r');
$owner_url=$footer_xml->read_section('footer', 'owner_url');

?>
<head>
<title><? echo $sitetitle.' :: '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2004 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<link href="<? echo $skin_path; ?>basic.css" rel="stylesheet" type="text/css">
</head>

<body>

<div align="center" width="100%"><img src="<? echo $skin_path; ?>top.gif" border="0" /></div>

<div align="center" class="bg">
	
	<!--TOP-->
	<table cellpadding="0" cellspacing="1" border="0" width="749">
	<tr><td class="header" valign="top">
		<? echo $sitelogo; ?>
		<h1 class="title"><a class="index" href="<? echo $owner_url; ?>"><? echo _SITE_NAME; ?></a></h1>
		<h3 class="subtitle"><? echo _SITE_KEY; ?></h3>
		
		<div id="pathwaybox"><?
		
		//====================================
		//	_PATHWAY
		//
		include(_PATHWAY);
		
		?></div>
	</td></tr>
	</table>
	
	<!--CONTENT
	<div style="position: relative; top: 155px;"></div>-->
	<table height="155"><tr><td></td></tr></table>
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="80%">
	
	<tr><td valign="top" style="padding-left: 20px; padding-right: 17px;">
		
		<?
			
			//====================================
			//	_CONTENT
			//
			include(_CONTENT);
			
		?>
		
	</td><td valign="top" width="190">
		
		<table cellpadding="0" cellspacing="0">
		<tr><td style="padding-left: 10px;"><?
			
			//====================================
			//	_SIDE_MENU
			//
			include(_SIDE_MENU);
			
		?><br /></td></tr>
		<tr><td style="padding-left: 10px;"><?
		
			//====================================
			//	_CATEGORIES
			//
			include(_CATEGORIES);
			
		?><br /></td></tr>
		<tr><td style="padding-left: 10px;"><?
		
			//====================================
			//	_CS
			//
			include(_CS);
			
		?><br /></td></tr>
		<tr><td style="padding-left: 10px;"><?
		
			//====================================
			//	_NEWSLETTER
			//
			include(_LOGIN);
			
		?><br /></td></tr>
		<tr><td><?
			
			//====================================
			//	_SHOW_LC
			//
			include(_SHOW_LC);
			
		?></td></tr>
		<tr><td style="padding-left: 10px;"><br /><?
		
			//====================================
			//	_SIDE
			//
			include(_SIDE);
			
		?></td></tr>
		<tr><td style="padding-left: 10px;"><br /><?
		
			//====================================
			//	_NEWSLETTER
			//
			include(_NEWSLETTER);
			
		?></td></tr>
		<tr><td style="padding-left: 10px;"><br /><?
		
			//====================================
			//	_POLL
			//
			include(_POLL);
			
		?></td></tr>
		</table>
		
	</td></tr>
	
	<tr><td style="padding-left: 17px;"><?
		
		//====================================
		//	_CONTENT_FOOTER
		//
		include(_CONTENT_FOOTER);
		
	?></td><td>
		&nbsp;
	</td></tr>
	
	</table>
</div>

<div align="center" width="100%"><img src="<? echo $skin_path; ?>bottom.gif" border="0" /></div>
<br /><?
		
	
	//====================================
	//	_FOOTER
	//
	echo '<span class="legal">';
	include(_FOOTER);
	echo '</span>';
	
?>

</body>

</html>
