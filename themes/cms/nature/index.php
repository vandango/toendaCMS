<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'data/';

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>basic.css" rel="stylesheet" type="text/css">

</head>


<body>

<div id="page">
	<div id="mainbox">
		<div class="headerbox">
			<? echo $sitelogo; ?>
			<span class="title"><? echo _SITE_NAME; ?></span>
			<br />
			<span class="subtitle"><? echo _SITE_KEY; ?></span>
		</div>
		
		<div class="menubox">
			<? include(_TOP_MENU); ?>
		</div>
		
		<div class="pathwaybox">
			<span class="pathway">
				<? include(_PATHWAY); ?></span>
		</div>
		
		<div class="sidebox">
			<?
			include(_SIDE_MENU);
			include(_CATEGORIES); 
			include(_SIDE_LINKS); 
			include(_SEARCH); 
			include(_CS); 
			include(_LAST_IMAGES); 
			include(_LOGIN); 
			include(_SHOW_LC); 
			include(_NEWSLETTER); 
			include(_POLL); 
			include(_SIDE); 
			include(_SYNDICATION);
			?>
		</div>
		
		<div class="maincontentbox">
			<div class="imagebox">
				<script language="JavaScript">
				var theImages = new Array();
				
				theImages[0] = '<? echo $skinPath; ?>image00.jpeg';
				theImages[1] = '<? echo $skinPath; ?>image01.jpeg';
				theImages[2] = '<? echo $skinPath; ?>image02.jpeg';
				
				var j = 0
				var p = theImages.length;
				var preBuffer = new Array()
				for (i = 0; i < p; i++){
					preBuffer[i] = new Image();
					preBuffer[i].src = theImages[i];
				}
				
				var whichImage = Math.round(Math.random()*(p-1));
				function showImage(){
					document.write('<img border="0" height="150" width="544" alt="Top Banner" src="' + theImages[whichImage] + '" />');
				}
				
				showImage();
				</script>
			</div>
			
			<br />
			<br />
			
			<div class="contentbox">
				<? include(_CONTENT); ?>
			</div>
		</div>
		
		<div class="contentfooterbox">
			<? include(_CONTENT_FOOTER); ?>
		</div>
	</div>
	
	<div id="bottom">
		&nbsp;
		<div class="bottombox">
			<? include(_FOOTER); ?>
		</div>
	</div>
</div>

</body>
</html>
