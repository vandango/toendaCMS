<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><? echo $sitetitle; ?></title>
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2004 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<link href="theme/white_byte/data/basic.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="img/favicon.png">

<script language="JavaScript">
//***************************************
// ROTATE IMAGES
//***************************************
var theImages = new Array();

theImages[0] = 'image00.jpeg';
theImages[1] = 'image01.jpeg';
theImages[2] = 'image02.jpeg';

var j = 0
var p = theImages.length;
var preBuffer = new Array()
for (i = 0; i < p; i++){
	preBuffer[i] = new Image()
	preBuffer[i].src = theImages[i]
}

var whichImage = Math.round(Math.random()*(p-1));
function showImage(){
	document.write('<img border="0" height="150" width="544" alt="Top Banner" src="theme/white_byte/data/'+theImages[whichImage]+'">');
}
</script>

</head><?

$footer_xml = new xmlparser('data/tcms_global/footer.xml','r');
$owner_url=$footer_xml->read_section('footer', 'owner_url');

?><body>

<table class="mainbox" align="center" border="0" cellpadding="0" cellspacing="0">

<tr><td class="headerbox">
	<div class="logobox">
	<? echo $sitelogo; ?>
	<a class="index" href="<? echo $owner_url; ?>">
	<span class="title"><? echo _SITE_NAME; ?></span>
	<br />
	<span class="subtitle"><? echo _SITE_KEY; ?></span>
	</a>
	</div>
</td></tr>

<tr><td class="pathwaybox">
	<span class="pathway"><?
	
	//====================================
	//	_PATHWAY
	//
	include(_PATHWAY);
	
	?></span>
</td></tr>

<tr><td valign="top">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td class="sidebox" valign="top">
		<table class="modulebox" cellpadding="0" cellspacing="0">
		<tr><td><?
			
			//====================================
			//	_SIDE_MENU
			//
			include(_SIDE_MENU);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_CATEGORIES
			//
			include(_CATEGORIES);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_CS
			//
			include(_CS);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_LOGIN
			//
			include(_LOGIN);
			
		?><br /></td></tr>
		<tr><td><?
			
			//====================================
			//	_SHOW_LC
			//
			include(_SHOW_LC);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_NEWSLETTER
			//
			include(_NEWSLETTER);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_POLL
			//
			include(_POLL);
			
		?><br /></td></tr>
		<tr><td><?
		
			//====================================
			//	_SIDE
			//
			include(_SIDE);
			
		?></td></tr>
		</table>
	</td><td style="padding-left: 10px;" valign="top">
		<div class="imagebox">
		<script language="JavaScript">
		//====================================
		//	ROTATE IMAGES
		//
		
		showImage();
		
		</script>
		</div>
		
		<br />
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%" height="350">
		<tr><td valign="top" height="100%"><?
			
			//====================================
			//	_CONTENT
			//
			include(_CONTENT);
			
		?></td></tr>
		<tr><td valign="bottom"><?
			
			//====================================
			//	_CONTENT_FOOTER
			//
			include(_CONTENT_FOOTER);
			
		?></td></tr>
		</table>
	</td></tr>
	</table>
</td></tr>
</table>

<table class="bottombox" align="center" border="0" cellpadding="5" cellspacing="0" width="760">
<tr><td><?

	//====================================
	//	_FOOTER
	//
	include(_FOOTER);
	
?></td></tr>
</table>

</body>
</html>
