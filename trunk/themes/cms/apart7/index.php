<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><?


$skinPath = $templatePath.'Images/';


$char_xml   = new xmlparser('data/tcms_global/var.xml','r');
$charset    = $char_xml->read_section('global', 'charset');


?><title><? echo $sitetitle.' | '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2008 Toenda Software Development.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
<script type="text/javascript" language="JavaScript">
var name = navigator.userAgent.toLowerCase()
var css = 'moz';

var ie = (name.indexOf("msie")>-1 && name.indexOf("opera") == -1)
var netscape = (name.indexOf("mozilla") >=-1 && name.indexOf("msie")==-1)

if(ie) css = 'ie';
else css = 'moz';

document.write ('<link href="<? echo $skinPath; ?>apart_' + css + '.css" rel="stylesheet" type="text/css" />');
</script>
</head>



<body>

<div id="container">
	<div id="intro">
		<?
		echo $sitelogo;
		echo '<span class="title">'._SITE_NAME.'</span>';
		echo '<br />';
		echo '<span class="subtitle">'._SITE_KEY.'</span>';
		?>
	</div>
	
	
	
	<div id="pageHeader">
		<span class="pageHeaderPathText pathway">You are here-><?
			
			//====================================
			//	_PATHWAY
			//
			include(_PATHWAY);
			include(_LANG_SELECTOR);
			
		?></span>
	</div>
	
	
	<div id="complete">
		<div id="linkList">
			<div id="linkList2">
				<?
				
				include(_SIDE_MENU);
				include(_SEARCH); ?>
				<br>
				<?
				include(_MONTHVIEW);
				include(_CATEGORIES);
				include(_FRONT_NEWS);
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
		</div>
		
		
		
		<div id="mainText"><?
			
			//====================================
			//	_PATHWAY
			//
			include(_CONTENT);
			
			?><div id="footer"><?
				
				//====================================
				//	_CONTENT_FOOTER
				//
				include(_CONTENT_FOOTER);
				
				?>
			</div>
		</div>
	</div>
	
	<div id="pageFooter"><?
		
		//====================================
		//	_FOOTER
		//
		include(_FOOTER);
		
	?></div>
</div>

</body>

</html>
