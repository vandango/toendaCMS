<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><?


$skinPath = $templatePath.'777/';


$char_xml   = new xmlparser('data/tcms_global/var.xml','r');
$charset    = $char_xml->read_section('global', 'charset');


?><title><? echo $sitetitle.' | '; include(_SITETITLE); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset; ?>" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2005 Toenda Software Development.  All rights reserved." />
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

document.write ('<link href="<? echo $skinPath; ?>777_' + css + '.css" rel="stylesheet" type="text/css" />');
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
		<span class="pageHeaderPathText pathway">URL |<?
			
			//====================================
			//	_PATHWAY
			//
			include(_PATHWAY);
			
		?></span>
	</div>
	
	
	<div id="complete">
		<div id="linkList">
			<div id="linkList2">
				<?
				
				include(_SIDE_MENU);
				include(_SEARCH);
				echo '<br />';
				include(_CATEGORIES);
				include(_SIDE_LINKS);
				include(_POLL);
				include(_SHOW_LC);
				include(_NEWSLETTER);
				
				if($id == 'products'){ $show_sbt_ever = true; }
				elseif($id == 'contactform' && $show_cisb == 1){ $show_sbt_ever = true; }
				else{
					if($choosenDB == 'xml'){
						if(file_exists('data/tcms_sidebar/'.$id.'.xml')){ $show_sbt_ever = true; }
						else{ $show_sbt_ever = false; }
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						$sqlQR = $sqlAL->sqlQuery("SELECT * FROM tcms_sidebar WHERE uid='".$id."'");
						$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
						if($sqlNR != 0){ $show_sbt_ever = true; }
						else{ $show_sbt_ever = false; }
					}
				}
				
				if($show_sbt_ever == true){ include(_SIDE); }
				
				include(_LOGIN);
				
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
		//	_CONTENT_FOOTER
		//
		include(_FOOTER);
		
	?></div>
</div>

</body>

</html>
